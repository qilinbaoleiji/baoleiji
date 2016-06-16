/*
 * net.c - Commonly used network related routines
 *
 *  Copyright (c) 2004 Claes M. Nyberg <md0claes@mdstud.chalmers.se>
 *  All rights reserved, all wrongs reversed.
 *
 *  Redistribution and use in source and binary forms, with or without
 *  modification, are permitted provided that the following conditions
 *  are met:
 *
 *  1. Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *  2. Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *  3. The name of author may not be used to endorse or promote products
 *     derived from this software without specific prior written permission.
 *
 *  THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 *  INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 *  AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL
 *  THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 *  PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 *  OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 *  WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 *  OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 *  ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * $Id: net.c,v 1.1.1.1 2005/02/27 17:08:48 cmn Exp $
 */

#include <stdio.h>
#include <string.h>
#include "net.h"

#ifndef MAXHOSTNAMELEN
#define MAXHOSTNAMELEN 512
#endif /* MAXHOSTNAMELEN */


/*
 * Get official name of service as a string
 * by port number (network byte order).
 */
const char *
net_tcpserv_byport(unsigned short port)
{
    struct servent *sent;
    if ( (sent = getservbyport(port, "tcp")) != NULL)
        return(sent->s_name);
    return(NULL);
}


/*
 * Get official port (network byte order) of service
 * given the name as a string.
 * Returns -1 if no service was found.
 */
int
net_tcpserv_byname(const char *name)
{
    struct servent *sent;
    if ( (sent = getservbyname(name, "tcp")) != NULL)
        return(sent->s_port);
    return(-1);
}


/*
 * Translate hostname or dotted decimal host address
 * into a network byte ordered IP address.
 * Returns -1 on error.
 */
long
net_inetaddr(const char *host)
{
    long haddr;
    struct hostent *hent;

    if ( (haddr = inet_addr(host)) < 0) {
        if ( (hent = gethostbyname(host)) == NULL)
            return(-1);

        memcpy(&haddr, (hent->h_addr), sizeof(haddr));
    }
    return(haddr);
}


/*
 * Returns official name of host from network byte
 * ordered IP address on success, NULL on error.
 */
const char *
net_hostname(struct in_addr *addr)
{
    static char hname[MAXHOSTNAMELEN+1];
    struct hostent *hent;

    if ( (hent = gethostbyaddr((char *)&(addr->s_addr),
            sizeof(addr->s_addr), AF_INET)) == NULL) {
        return(NULL);
    }
    snprintf(hname, sizeof(hname) -1, "%s", hent->h_name);
    return(hname);
}


/*
 * Returns official name of host from network byte
 * ordered IP address on success, NULL on error.
 */
const char *
net_hostname_ip(uint32_t ip)
{
    struct in_addr ipa;
    ipa.s_addr = ip;
    return(net_hostname(&ipa));
}

/*
 * Translate network byte ordered IP address into its
 * dotted decimal representation.
 */
const char *
net_ntoa_ip(uint32_t ip)
{
    struct in_addr ipa;
    ipa.s_addr = ip;
    return(inet_ntoa(ipa));
}


/*
 * Translate Inet socket address to a string.
 * If resolve is non zero, the official hostname
 * is added to the string (if any).
 * "hostname.port or aaa.bbb.ccc.ddd:port"
 * Returns NULL on error.
 */
const char *
net_sockstr(struct sockaddr_in *addr, int resolve)
{
	static char sockstr[MAXHOSTNAMELEN+48];	
	const char *ip = NULL;
	
	memset(sockstr, 0x00, sizeof(sockstr));
	
	if (resolve)
		ip = net_hostname(&addr->sin_addr);
	if (ip == NULL)
		ip = inet_ntoa(addr->sin_addr);

	snprintf(sockstr, sizeof(sockstr)-1, "%s:%u", 
		ip, ntohs(addr->sin_port));
	return(sockstr);
}


/*
 * Translate Inet socket address to a string.
 * If resolve is non zero, the official hostname
 * is added to the string (if any).
 * "hostname:port or aaa.bbb.ccc.ddd:port"
 * Returns NULL on error.
 * ip and port is assumed to be in network byte order.
 */
const char *
net_sockstr_ip(uint32_t ip, uint16_t port, int resolve)
{
	struct sockaddr_in addr;

	memset(&addr, 0x00, sizeof(struct sockaddr_in));
	addr.sin_family = AF_INET;
	addr.sin_port = port;
	addr.sin_addr.s_addr = ip;
	return(net_sockstr(&addr, resolve));
}


/*
 * Convert 6 byte MAC address to string
 */
const char *
net_macstr(const char *mac)
{
    static char mstr[48];

    memset(mstr, 0x00, sizeof(mstr));
    snprintf(mstr, sizeof(mstr)-1, "%02x:%02x:%02x:%02x:%02x:%02x",
        mac[0], mac[1], mac[2], mac[3], mac[4], mac[5]);
    return(mstr);
}

/*
 * Convert TCP control flags into string.
 */
const char *
net_tcpflags(unsigned short flags)
{
    static char buf[28];
    memset(buf, 0x00, sizeof(buf));

    /* FIN No more data from sender */
    if (flags & 0x01)
        strncat(buf, "FIN ", 4);

    /* SYN:  Synchronize sequence numbers */
    if (flags & 0x02)
        strncat(buf, "SYN ", 4);

    /* RST:  Reset the connection */
    if (flags & 0x04)
        strncat(buf, "RST ", 4);

    /* PSH:  Push Function */
    if (flags & 0x08)
        strncat(buf, "PSH ", 4);

    /* ACK:  Acknowledgment field significant */
    if (flags & 0x010)
        strncat(buf, "ACK ", 4);

    /* URG:  Urgent Pointer field significant */
    if (flags & 0x020)
        strncat(buf, "URG ", 4);

    return(buf);
}

/*
 * Convert TCP control flags into string.
 */
const char *
net_tcpflags_short(unsigned short flags)
{
    static char buf[8];
    char *pt = buf;
    memset(buf, 0x00, sizeof(buf));

    /* FIN No more data from sender */
    if (flags & 0x01)
        *pt++ = 'F';

    /* SYN:  Synchronize sequence numbers */
    if (flags & 0x02)
        *pt++ = 'S';

    /* RST:  Reset the connection */
    if (flags & 0x04)
        *pt++ = 'R';

    /* PSH:  Push Function */
    if (flags & 0x08)
        *pt++ = 'P';

    /* ACK:  Acknowledgment field significant */
    if (flags & 0x010)
        *pt++ = 'A';

    /* URG:  Urgent Pointer field significant */
    if (flags & 0x020)
        *pt++ = 'U';

    return(buf);
}

