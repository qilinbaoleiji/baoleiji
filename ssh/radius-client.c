/*
 * radclient.c	General radius packet debug tool.
 *
 * Version:	$Id$
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * Copyright 2000  The FreeRADIUS server project
 * Copyright 2000  Miquel van Smoorenburg <miquels@cistron.nl>
 * Copyright 2000  Alan DeKok <aland@ox.org>
 */
static const char rcsid[] = "$Id$";
//#define SERVER_PORT 1812
//#define SERVER_IPADDR "124.160.111.60"
//#define SECRET "freesvr"

#include "autoconf.h"

#include <stdio.h>
#include <stdlib.h>
#include <termios.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#ifdef HAVE_UNISTD_H
#include <unistd.h>
#endif

#include <string.h>
#include <ctype.h>
#include <netdb.h>
#include <sys/socket.h>

#ifdef HAVE_NETINET_IN_H
#include <netinet/in.h>
#endif

#ifdef HAVE_SYS_SELECT_H
#include <sys/select.h>
#endif

#ifdef HAVE_GETOPT_H
#include <getopt.h>
#endif

#include <assert.h>
#include <arpa/telnet.h>
#include "conf.h"
#include "radpaths.h"
#include "missing.h"
#include "libradius.h"

static int retries = 10;
static float timeout = 3;
static const char *secret = NULL;
static int do_output = 1;
static int totalapp = 0;
static int totaldeny = 0;
static int totallost = 0;

static int server_port = 0;
static int packet_code = 0;
static uint32_t server_ipaddr = 0;
static int resend_count = 1;
static int done = 1;

static int sockfd;
static int radius_id[256];
static int last_used_id = -1;

static rbtree_t *filename_tree = NULL;
static rbtree_t *request_tree = NULL;

static int sleep_time = -1;

extern int master, slave;

/* extern val */ 
char               radius_address[2][32];
unsigned short int radius_port[2];
char               radius_secret[2][32];
/* extern val */

typedef struct radclient_t
{
    struct		radclient_t *prev;
    struct		radclient_t *next;

    const char	*filename;
    int		    packet_number; /* in the file */
    char		password[256];
    time_t		timestamp;
    RADIUS_PACKET	*request;
    RADIUS_PACKET	*reply;
    int		resend;
    int		tries;
    int		done;
}radclient_t;

static radclient_t *radclient_head = NULL;
static radclient_t *radclient_tail = NULL;


static void NEVER_RETURNS usage(void)
{
    fprintf(stderr, "Usage: radclient [options] server[:port] <command> [<secret>]\n");

    fprintf(stderr, "  <command>   One of auth, acct, status, coa, or disconnect.\n");
    fprintf(stderr, "  -c count    Send each packet 'count' times.\n");
    fprintf(stderr, "  -d raddb    Set dictionary directory.\n");
    fprintf(stderr, "  -f file     Read packets from file, not stdin.\n");
    fprintf(stderr, "  -i id       Set request id to 'id'.  Values may be 0..255\n");
    fprintf(stderr, "  -n num      Send N requests/s\n");
    fprintf(stderr, "  -p num      Send 'num' packets from a file in parallel.\n");
    fprintf(stderr, "  -q          Do not print anything out.\n");
    fprintf(stderr, "  -r retries  If timeout, retry sending the packet 'retries' times.\n");
    fprintf(stderr, "  -s          Print out summary information of auth results.\n");
    fprintf(stderr, "  -S file     read secret from file, not command line.\n");
    fprintf(stderr, "  -t timeout  Wait 'timeout' seconds before retrying (may be a floating point number).\n");
    fprintf(stderr, "  -v          Show program version information.\n");
    fprintf(stderr, "  -x          Debugging mode.\n");

    exit(1);
}

/*
 *	Free a radclient struct, which may (or may not)
 *	already be in the list.
 */
static void radclient_free(radclient_t *radclient)
{
    radclient_t *prev, *next;

    if (radclient->request) rad_free(&radclient->request);
    if (radclient->reply) rad_free(&radclient->reply);

    prev = radclient->prev;
    next = radclient->next;

    if (prev)
    {
        assert(radclient_head != radclient);
        prev->next = next;
    }
    else if (radclient_head)
    {
        assert(radclient_head == radclient);
        radclient_head = next;
    }

    if (next)
    {
        assert(radclient_tail != radclient);
        next->prev = prev;
    }
    else if (radclient_tail)
    {
        assert(radclient_tail == radclient);
        radclient_tail = prev;
    }

    free(radclient);
}

/*
 *	Initialize a radclient data structure
 */
static radclient_t *radclient_init(char * auth_statement)
{
    VALUE_PAIR *vp;
    radclient_t *start, *radclient, *prev = NULL;
    int filedone = 0;
    int packet_number = 1;

    start = NULL;
    /*
     *	Determine where to read the VP's from.
     */

    /*
     *	Loop until the file is done.
     */
    /*
     *	Allocate it.
     */
    radclient = malloc(sizeof(*radclient));
    memset(radclient, 0, sizeof(*radclient));

    radclient->request = rad_alloc(1);

    radclient->request->id = -1; /* allocate when sending */
    radclient->packet_number = packet_number++;

    /*
     *	Read the VP's.
     */
    radclient->request->vps = readvp2(auth_statement, &filedone, "radclient: X");
    if (!radclient->request->vps)
    {
        radclient_free(radclient);
        return radclient; /* done: return the list */
    }

    /*
     *	Keep a copy of the the User-Password attribute.
     */
    if ((vp = pairfind(radclient->request->vps, PW_PASSWORD)) != NULL)
    {
        strNcpy(radclient->password, (char *)vp->strvalue, sizeof(radclient->password));
        /*
         *	Otherwise keep a copy of the CHAP-Password attribute.
         */
    }
    else if ((vp = pairfind(radclient->request->vps, PW_CHAP_PASSWORD)) != NULL)
    {
        strNcpy(radclient->password, (char *)vp->strvalue, sizeof(radclient->password));
    }
    else
    {
        radclient->password[0] = '\0';
    }

    /*
     *  Fix up Digest-Attributes issues
     */
    for (vp = radclient->request->vps; vp != NULL; vp = vp->next)
    {
        switch (vp->attribute)
        {
        default:
            break;

            /*
             *	Allow it to set the packet type in
             *	the attributes read from the file.
             */
        case PW_PACKET_TYPE:
            radclient->request->code = vp->lvalue;
            break;

        case PW_PACKET_DST_PORT:
            radclient->request->dst_port = (vp->lvalue & 0xffff);
            break;

        case PW_DIGEST_REALM:
        case PW_DIGEST_NONCE:
        case PW_DIGEST_METHOD:
        case PW_DIGEST_URI:
        case PW_DIGEST_QOP:
        case PW_DIGEST_ALGORITHM:
        case PW_DIGEST_BODY_DIGEST:
        case PW_DIGEST_CNONCE:
        case PW_DIGEST_NONCE_COUNT:
        case PW_DIGEST_USER_NAME:
            /* overlapping! */
            memmove(&vp->strvalue[2], &vp->strvalue[0], vp->length);
            vp->strvalue[0] = vp->attribute - PW_DIGEST_REALM + 1;
            vp->length += 2;
            vp->strvalue[1] = vp->length;
            vp->attribute = PW_DIGEST_ATTRIBUTES;
            break;
        }
    } /* loop over the VP's we read in */

    if (!start)
    {
        start = radclient;
        prev = start;
    }
    else
    {
        prev->next = radclient;
        radclient->prev = prev;
        prev = radclient;
    }

    /*
     *	And we're done.
     */
    return radclient;
}


/*
 *	Sanity check each argument.
 */
static int radclient_sane(radclient_t *radclient)
{
    if (radclient->request->dst_port == 0)
    {
        radclient->request->dst_port = server_port;
    }
    radclient->request->dst_ipaddr = server_ipaddr;

    if (radclient->request->code == 0)
    {
        if (packet_code == -1)
        {
            fprintf(stderr, "radclient: Request was \"auto\", but request %d in file %s did not contain Packet-Type\n",
                    radclient->packet_number, radclient->filename);
            return -1;
        }

        radclient->request->code = packet_code;
    }
    radclient->request->sockfd = sockfd;

    return 0;
}


/*
 *	For request handline.
 */

/*
 *	Compare two RADIUS_PACKET data structures, based on a number
 *	of criteria.
 */
static int send_one_packet(radclient_t *radclient)
{
    int i;

    assert(radclient->done == 0);

    /*
     *	Remember when we have to wake up, to re-send the
     *	request, of we didn't receive a response.
     */
    if ((sleep_time == -1) ||
            (sleep_time > (int) timeout))
    {
        sleep_time = (int) timeout;
    }

    /*
     *	Haven't sent the packet yet.  Initialize it.
     */
    if (radclient->request->id == -1)
    {
        int found = 0;

        assert(radclient->reply == NULL);

        /*
         *	Find a free packet Id
         */
        for (i = 0; i < 256; i++)
        {
            if (radius_id[(last_used_id + i) & 0xff] == 0)
            {
                last_used_id = (last_used_id + i) & 0xff;
                radius_id[last_used_id] = 1;
                radclient->request->id = last_used_id++;
                found = 1;
                break;
            }
        }

        /*
         *	Didn't find a free packet ID, we're not done,
         *	we don't sleep, and we stop trying to process
         *	this packet.
         */
        if (!found)
        {
            done = 0;
            sleep_time = 0;
            return 0;
        }

        assert(radclient->request->id != -1);
        assert(radclient->request->data == NULL);

        librad_md5_calc(radclient->request->vector, radclient->request->vector,
                        sizeof(radclient->request->vector));

        /*
         *	Update the password, so it can be encrypted with the
         *	new authentication vector.
         */
        if (radclient->password[0] != '\0')
        {
            VALUE_PAIR *vp;

            if ((vp = pairfind(radclient->request->vps, PW_PASSWORD)) != NULL)
            {
                strNcpy((char *)vp->strvalue, radclient->password, sizeof(vp->strvalue));
                vp->length = strlen(vp->strvalue);

            }
            else if ((vp = pairfind(radclient->request->vps, PW_CHAP_PASSWORD)) != NULL)
            {
                strNcpy((char *)vp->strvalue, radclient->password, sizeof(vp->strvalue));
                vp->length = strlen(vp->strvalue);

                rad_chap_encode(radclient->request, (char *) vp->strvalue, radclient->request->id, vp);
                vp->length = 17;
            }
        }

        radclient->timestamp = time(NULL);
        radclient->tries = 1;
        radclient->resend++;

        /*
         *	Duplicate found.  Serious error!
         */
    }
    else  		/* radclient->request->id >= 0 */
    {
        time_t now = time(NULL);

        /*
         *	FIXME: Accounting packets are never retried!
         *	The Acct-Delay-Time attribute is updated to
         *	reflect the delay, and the packet is re-sent
         *	from scratch!
         */

        /*
         *	Not time for a retry, do so.
         */
        if ((now - radclient->timestamp) < timeout)
        {
            /*
             *	When we walk over the tree sending
             *	packets, we update the minimum time
             *	required to sleep.
             */
            if ((sleep_time == -1) ||
                    (sleep_time > (now - radclient->timestamp)))
            {
                sleep_time = now - radclient->timestamp;
            }
            return 0;
        }

        /*
         *	We're not trying later, maybe the packet is done.
         */
        if (radclient->tries == retries)
        {
            assert(radclient->request->id >= 0);

            /*
             *	Delete the request from the tree of
             *	outstanding requests.
             */

            fprintf(stderr, "radclient: no response from server for ID %d\n", radclient->request->id);
            /*
             *	Normally we mark it "done" when we've received
             *	the response, but this is a special case.
             */
            if (radclient->resend == resend_count)
            {
                radclient->done = 1;
            }
            totallost++;
            return -1;
        }

        /*
         *	We are trying later.
         */
        radclient->timestamp = now;
        radclient->tries++;
    }


    /*
     *	Send the packet.
     */
    if (rad_send(radclient->request, NULL, secret) < 0)
    {
        fprintf(stderr, "radclient: Failed to send packet for ID %d: %s\n",
                radclient->request->id, librad_errstr);
    }

    return 0;
}

/*
 *	Receive one packet, maybe.
 */
static int recv_one_packet(int wait_time)
{
    fd_set		    set;
    struct timeval  tv;
    radclient_t	    myclient, radclient;
    RADIUS_PACKET	myrequest, *reply;

    /* And wait for reply, timing out as necessary */
    FD_ZERO(&set);
    FD_SET(sockfd, &set);

    if (wait_time <= 0)
    {
        tv.tv_sec = 0;
    }
    else
    {
        tv.tv_sec = wait_time;
    }
    tv.tv_usec = 0;

    /*
     *	No packet was received.
     */
    if (select(sockfd + 1, &set, NULL, NULL, &tv) != 1)
    {
        return 0;
    }

    /*
     *	Look for the packet.
     */
    reply = rad_recv(sockfd);
    if (!reply)
    {
        fprintf(stderr, "radclient: received bad packet: %s\n",
                librad_errstr);
        return -1;	/* bad packet */
    }
    myclient.request = &myrequest;
    myrequest.id = reply->id;
    myrequest.dst_ipaddr = reply->src_ipaddr;
    myrequest.dst_port = reply->src_port;
    radclient.reply = reply;
    /*
     *	FIXME: Do stuff to process the reply.
     */
#if 0
    if (rad_verify(reply, radclient->request, secret) != 0)
    {
        printf("rad_verify\n");
        librad_perror("rad_verify");
        totallost++;
        goto packet_done; /* shared secret is incorrect */
    }
#endif

    if (rad_decode(reply, radclient.request, secret) != 0)
    {
        librad_perror("rad_decode");
        totallost++;
        goto packet_done; /* shared secret is incorrect */
    }
    /* libradius debug already prints out the value pairs for us */

    if (reply->code != PW_AUTHENTICATION_REJECT)
    {
        totalapp++;
    }
    else
    {
        totaldeny++;
    }
packet_done:
    /*
     *	Once we've sent the packet as many times as requested,
     *	mark it done.
     */

    return reply->code;
}


static int getport(const char *name)
{
    struct  servent     *svp;

    svp = getservbyname (name, "udp");
    if (!svp)
    {
        return 0;
    }

    return ntohs(svp->s_port);
}


int radius_auth(char *username, char *password, char *radius_server_ip_address, unsigned short int radius_server_port, char * radius_server_secret)
{
	/*
	printf("radius server = %s, port = %d\n", radius_server_ip_address, radius_server_port);
	printf("radius secret = %s\n", radius_server_secret);
	*/
	const char *radius_dir = RADDBDIR;
    int persec = 0;
    int parallel = 1;
    radclient_t	*this;

    librad_debug = 0;

    if (dict_init(radius_dir, RADIUS_DICTIONARY) < 0)
    {
        librad_perror("radclient");
        return 1;
    }

    /*
     *	Strip port from hostname if needed.
     */
	server_port = radius_server_port;

    packet_code = PW_AUTHENTICATION_REQUEST;

    /*
     *	Grab the socket.
     */
    if ((sockfd = socket(AF_INET, SOCK_DGRAM, 0)) < 0)
    {
        perror("radclient: socket: ");
        exit(1);
    }
    memset(radius_id, 0, sizeof(radius_id));

    /*
     *	Resolve hostname.
     */
    server_ipaddr = ip_getaddr(radius_server_ip_address);

    /*
     *	Add the secret.
     */
    secret = radius_server_secret;

    /*
     *	If no '-f' is specified, we're reading from stdin.
     */

    if (last_used_id < 0) last_used_id = getpid() & 0xff;

    /*
     *	Walk over the packets to send, until
     *	we're all done.
     *
     *	FIXME: This currently busy-loops until it receives
     *	all of the packets.  It should really have some sort of
     *	send packet, get time to wait, select for time, etc.
     *	loop.
     */
    int n = parallel;
    const char *filename = NULL;

    done = 1;
    sleep_time = -1;

    /*
     *	Walk over the packets, sending them.
     */

    /* Send username and password to radius server */
    char auth_context[128];
    memset( auth_context, 0x00, sizeof(auth_context) );

    sprintf(auth_context,"User-Name = %s, User-Password = %s", username, password);
    /* Send username and password to radius server */

    this = radclient_init(auth_context);

    if (radclient_sane(this) != 0)
    {
        exit(1);
    }
    /*
     *	If there's a packet to receive,
     *	receive it, but don't wait for a
     *	packet.
     */
    recv_one_packet(0);

    /*
     *	This packet is done.  Delete it.
     */
    /*
     *	Packets from multiple '-f' are sent
     *	in parallel.
     *
     *	Packets from one file are sent in
     *	series, unless '-p' is specified, in
     *	which case N packets from each file
     *	are sent in parallel.
     */
    if (this->filename != filename)
    {
        filename = this->filename;
        n = parallel;
    }

    if (n > 0)
    {
        n--;

        /*
         *	Send the current packet.
         */
        send_one_packet(this);

        /*
         *	Wait a little before sending
         *	the next packet, if told to.
         */
        if (persec)
        {
            struct timeval tv;

            /*
             *	Don't sleep elsewhere.
             */
            sleep_time = 0;

            if (persec == 1)
            {
                tv.tv_sec = 1;
                tv.tv_usec = 0;
            }
            else
            {
                tv.tv_sec = 0;
                tv.tv_usec = 1000000/persec;
            }

            /*
             *	Sleep for milliseconds,
             *	portably.
             *
             *	If we get an error or
             *	a signal, treat it like
             *	a normal timeout.
             */
            select(0, NULL, NULL, NULL, &tv);
        }

        /*
         *	If we haven't sent this packet
         *	often enough, we're not done,
         *	and we shouldn't sleep.
         */
        if (this->resend < resend_count)
        {
            done = 0;
            sleep_time = 0;
        }
    }
    else   /* haven't sent this packet, we're not done */
    {
        assert(this->done == 0);
        assert(this->reply == NULL);
        done = 0;
    }

    /*
     *	Still have outstanding requests.
     */
    if (rbtree_num_elements(request_tree) > 0)
    {
        done = 0;
    }
    else
    {
        sleep_time = 0;
    }

    /*
     *	Nothing to do until we receive a request, so
     *	sleep until then.  Once we receive one packet,
     *	we go back, and walk through the whole list again,
     *	sending more packets (if necessary), and updating
     *	the sleep time.
     */
    int ret = recv_one_packet(3);

    rbtree_free(filename_tree);
    rbtree_free(request_tree);

    return ret;
}

int radius_auth_new ( char * username, char * password )
{
	int ret1, ret2;
	
	printf ( "master = %d, slave = %d\n", master, slave );

	/* Server did not respond  */
	if ( ( ret1 = radius_auth( username, password, radius_address[master], radius_port[master], radius_secret[master] ) ) == 0 )
	{
		kill( getppid(), 37 );
		
		printf ( "[RADIUS CLIENT] Radius authentication master server %s did not respond to authentication requests!\n", radius_address[master] );
		printf ( "[RADIUS CLIENT] Use radius authentication slave server %s .\n", radius_address[slave] );
		
		ret2 = radius_auth( username, password, radius_address[slave], radius_port[slave], radius_secret[slave] );
			
		if ( ret2  == 0 )
		{
			printf ( "[RADIUS CLIENT] Radius authentication slave server %s did not respond to authentication requests!\n", radius_address[slave] );
			return 0;
		}
		else if ( ret2 == 2 )
		{	
			return 2;
		}
		else if ( ret2 == 3 )
		{
			return 3;
		}
		else
		{
			return 1;
		}
	}
	/* Success */
	else if ( ret1 == 2 )
	{
		return 2;
	}
	/* Invalid username or password */
	else if ( ret1 == 3 )
	{
		return 3;
	}
	/* Unknow error */
	else
	{
		return 1;
	}
}

