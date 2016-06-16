#include <stdio.h>
#define _GNU_SOURCE
#include <errno.h>
#include <string.h>
#include <unistd.h>
#include <fcntl.h>
#include <ctype.h>
#include <time.h>
#include <sys/signal.h>
#include <sys/time.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <termios.h>
#include <pwd.h>
#include <openssl/err.h>
#include <iconv.h>
#include <sys/stat.h>
#include <term.h>

#ifndef __dead
#define __dead     __attribute__((noreturn))
#endif

#include "canohost.h"
#include "entropy.h"
#include "ssh.h"
#include "ssh1.h"
#include "ssh2.h"
#include "log.h"
#include "kex.h"
#include "compat.h"
#include "packet.h"
#include "readconf.h"
#include "sshconnect.h"
#include "pathnames.h"
#include "authfile.h"
#include "xmalloc.h"
#include "servconf.h"
#include "sftp.h"
#include "dispatch.h"
#include "mitm-ssh.h"
#include "mysql.h"
#include "command.h"
#include "licenses-key.h"
#include "sftp-common.h"
#include "message.h"

#define SUPER_MAX_PACKET_SIZE   (1024*1024)
#define MAXQUEUESIZE  1024
#define MAXARRAYSIZE  1024
#define STRLENGTH     1024

#define CONN_MODE_MYSQL   1
#define CONN_MODE_SELECT  2
#define CONN_MODE_NOVPN   3
#define CONN_MODE_INVALID 4

#define MITM_REQ_MAX      32

/* Transfers packet data between processes */
#define BINPATH "/opt/freesvr/audit/gateway/log"
#define REMOTEID(x) (client_is_putty?256:(x))
struct timeval ts1, ts2, ts3;

extern int radius_auth_new( char *, char * );
extern Kex *xxx_kex;
extern int sftp_backup_size;
extern int telnet_port;

/* SSH username and password from Radius */
char conn2server_saddress[128];
char conn2server_username[128];
char conn2server_password[512];
char radius__username[64];
char supasswd[512];
u_short conn2server_port;
int  device_table_id = -1;
int  block_channel_cnt;
char audit_address[64];
char mysql_address[64];
char mysql_username[64];
char mysql_password[64];
char mysql_database[64];

char privatekey_path[256];
int  novpn = 0, autosu = 0, router = 0;
int use_vpn = 1, auto_su, login_method = 3, conn_mode, publickey_auth, keylinenum = -1;
char *su_command, *su_password, *forbidden, *serverip, *sourceip;
int  session_trans[1024], session_map[1024], proxy_server_session_id = 0;
char *needle;
int did;

extern int show_stream, no_daemon_flag, forbidden_x11;

int client_is_putty = 0, tmpsp, no_shell = 0;

int code_convert( char *from_charset, char *to_charset, char *inbuf, size_t inlen, char *outbuf, size_t outlen )
{
	iconv_t cd;
	char **pin  = &inbuf;
	char **pout = &outbuf;

	cd = iconv_open( to_charset, from_charset );

	if( cd == 0 ) return -1;

	if( iconv( cd, pin, ( size_t * )&inlen, pout, ( size_t * )&outlen ) == -1 )
	{
		perror( "iconv" );
		return -1;
	}

	iconv_close( cd );
	return 0;
}

char *g2u( char *inbuf )
{
	size_t outlen = 1024, inlen = strlen( inbuf );
	static char outbuf[1024];

	bzero( outbuf, sizeof(outbuf) );
	if( code_convert( "GB2312", "UTF-8", inbuf, inlen, outbuf, outlen ) == 0 )
		return outbuf;
	else
		return inbuf;
}

/* Transfers packet data between processes */
struct simple_packet
{
	u_int type;
	u_int len;
	char data[SUPER_MAX_PACKET_SIZE+12];
};

static struct queue_element
{
	u_int session_id;
	u_int transfer_id;
	u_char client_command_type;
	u_char server_command_type;
	Buffer * client_queue_buf;
	Buffer * server_queue_buf;
} transfer_queue[MAXQUEUESIZE];

static int queue_length, queue_head, queue_tail;

static void queue_clear()
{
	queue_length = 0;
	queue_head   = 0;
	queue_tail   = -1;
}

static int queue_top()
{
	return queue_head;
}

static int queue_push( u_int s_id, u_int t_id, u_char c_c_t, u_char s_c_t, Buffer * buf_c, Buffer * buf_s )
{
	if( queue_length == MAXQUEUESIZE ) return 0;
	else
	{
		queue_length++;
		queue_tail = ( queue_tail + 1 + MAXQUEUESIZE ) % MAXQUEUESIZE;
		transfer_queue[queue_tail].session_id = s_id;
		transfer_queue[queue_tail].transfer_id = t_id;
		transfer_queue[queue_tail].client_command_type = c_c_t;
		transfer_queue[queue_tail].server_command_type = s_c_t;
		transfer_queue[queue_tail].client_queue_buf = buf_c;
		transfer_queue[queue_tail].server_queue_buf = buf_s;
	}

	return 1;
}

static int queue_pop()
{
	if( queue_length == 0 ) return 0;
	else
	{
		queue_length--;
		buffer_free( transfer_queue[queue_head].client_queue_buf );
		buffer_free( transfer_queue[queue_head].server_queue_buf );
		queue_head = ( queue_head + 1 + MAXQUEUESIZE ) % MAXQUEUESIZE;
	}

	return 1;
}

static int queue_size()
{
	return queue_length;
}

static struct client_buffer_array_element
{
	int used;
	u_int sid;
	u_int id;
	u_char type;
	Buffer * buf;
} client_buffer_array[MAXARRAYSIZE];

static int store_client_buf( u_int sid, u_int id, u_char type, struct Buffer * buf )
{
	int i;

	for( i = 0; i < MAXARRAYSIZE; i++ )
	{
		if( client_buffer_array[i].used == 0 )
		{
			client_buffer_array[i].used = 1;
			client_buffer_array[i].sid  = sid;
			client_buffer_array[i].id   = id;
			client_buffer_array[i].type = type;
			client_buffer_array[i].buf  = buf;
			return 1;
		}
	}

	return 0;
}

static int store_scpair_buf( u_int sid, u_int id, u_char type, struct Buffer * buf )
{
	int i;

	for( i = 0; i < MAXARRAYSIZE; i++ )
	{
		if( client_buffer_array[i].used && client_buffer_array[i].sid == sid && client_buffer_array[i].id == id )
		{
			if( queue_push( sid, id, client_buffer_array[i].type, type, client_buffer_array[i].buf, buf ) )
			{
				client_buffer_array[i].used = 0;
				client_buffer_array[i].sid  = 0;
				client_buffer_array[i].id   = 0;
				client_buffer_array[i].type = 0;
				client_buffer_array[i].buf  = 0;
				return 1;
			}
			else
			{
				return -1;
			}
		}
	}

	return 0;
}

static char backup_filename[256];

static char * modify_filename( char * fn, int len )
{
	int i;
	char * start = NULL;
	memset( backup_filename, 0x00, sizeof( backup_filename ) );

	for( i = 0; i < len; i++ )
	{
		if( *( fn + i ) == '/' ) start = fn + i + 1;
	}

	if( start != NULL )
	{
		strcpy( backup_filename, start );
	}

	return backup_filename;
}

/* Flag a connection to the real target */
volatile int target_connected   = 0;
//volatile int block_command_flag = 0;

/* Local routines */
 const char *str_time( time_t, const char * );
void target_connect( u_int, u_short, int, u_int );
static ssize_t writen( int, void *, size_t );
static ssize_t readn( int, void *, size_t );
 int process_packet( int, char * );
static int ssh1_process_packet( int, char * );
static int ssh2_process_packet( int, char * );
 int packet_read_next( int );


/* Global variables */
extern struct mitm_ssh_opts mopt;
extern u_int max_packet_size;
extern ServerOptions options;

#define LINUX24

#ifdef FREEBSD
#define LINUX22
#endif

/*
 * Get the real target of a spoofed/NATed client
 * Returns -1 on error or if no real target was found,
 * 0 on success with dst set to the target.
 */
	int
get_real_target( int sock, struct sockaddr_in *tgt )
{
	socklen_t addrlen;
	addrlen = sizeof( struct sockaddr_in );

#ifdef LINUX22

	if( getsockname( sock, ( struct sockaddr* )tgt, &addrlen ) < 0 )
	{
		logit( "** Error: getsockname: %s", strerror( errno ) );
		return( -1 );
	}

#elif defined(LINUX24)
#include "netfilter.h"

	if( getsockopt( sock, SOL_IP, SO_ORIGINAL_DST, tgt, &addrlen ) < 0 )
	{
		logit( "** Error: getsockopt: %s", strerror( errno ) );
		return( -1 );
	}

#else
#error "Real destination through socket options not supported on this OS"
#endif


	/* Avoid loops (clients connecting back to us again) */
	if(( tgt->sin_addr.s_addr == net_inetaddr( get_local_ipaddr( sock ) ) ) ) //&& (tgt->sin_port == htons(get_local_port())) )
	{
		printf( "ori ip = %s, ori port = %d, source ip = %s\n",
				inet_ntoa( tgt->sin_addr ), ntohs( tgt->sin_port ), get_local_ipaddr( sock ) );

		logit( "[FREESVR-SSH-PROXY] Loop detected when resolving real target, "
				"refusing to connect client back to me again!" );
		memset( tgt, 0x00, addrlen );
		novpn = 1;
		use_vpn = 0;
		return( -1 );
	}

	printf( "ori ip = %s, ori port = %d, source ip = %s\n",
			inet_ntoa( tgt->sin_addr ), ntohs( tgt->sin_port ), get_local_ipaddr( sock ) );

	if( ntohs( tgt->sin_port ) == telnet_port ) login_method = 5;
	else if( ntohs( tgt->sin_port ) == 513 ) login_method = 24;

	logit( "[FREESVR-SSH-PROXY] Found real target %s for NAT host %s:%u",
			net_sockstr( tgt, mopt.resolve ), get_remote_ipaddr(), get_remote_port() );
	return( 0 );
}


/*
 * Read data available from descriptor.
 * Returns the type of the packet if a packet is
 * available, SSH_MSG_NONE otherwise.
 */
	 int
packet_read_next( int fd )
{
	char buf[1024*1024];
	ssize_t n;
	int type;

	debug4( "[FREESVR-SSH-PROXY] Reading next packet" );

	if(( type = packet_read_poll() ) != SSH_MSG_NONE )
	{
		debug4( "[FREESVR-SSH-PROXY] Next packet was in buffer" );
		return( type );
	}

	n = read( fd, buf, sizeof( buf ) );

	if( n == 0 )
	{
		packet_close();
		fatal( "[FREESVR-SSH-PROXY] Connection from %s:%u closed",
				get_local_ipaddr( fd ), get_remote_port() );
	}

	if( n < 0 )
	{
		if( errno == EAGAIN )
		{
			debug4( "[FREESVR-SSH-PROXY] Packet read would block" );
			return( SSH_MSG_NONE );
		}

		fatal( "Network error" );
	}

	packet_process_incoming( buf, n );
	return( packet_read_poll() );
}


/*
 * Convert time given in seconds to a string.
 * If fmt is NULL, time is given as 'year-month-day hour:min:sec'
 * Returns a pointer to the time string on succes, NULL on error
 * with errno set to indicate the error.
 */
	 const char *
str_time( time_t caltime, const char *fmt )
{
	static char tstr[256];
	struct tm *tm;

	if( fmt == NULL )
		fmt = "%Y-%m-%d--%H:%M:%S";

	memset( tstr, 0x00, sizeof( tstr ) );

	if(( tm = localtime( &caltime ) ) == NULL )
		return( NULL );

	if( strftime( tstr, sizeof( tstr ) - 1, fmt, tm ) == 0 )
		return( NULL );

	return( tstr );
}


/*
 * Write N bytes to a file descriptor
 */
	static ssize_t
writen( int fd, void *buf, size_t n )
{
	size_t tot = 0;
	ssize_t w;

	do
	{
		if(( w = write( fd, ( void * )(( u_char * )buf + tot ), n - tot ) ) <= 0 )
			return( w );

		tot += w;
	}
	while( tot < n );

	return( tot );
}


/*
 * Read N bytes from a file descriptor
 */
	static ssize_t
readn( int fd, void *buf, size_t n )
{
	size_t tot = 0;
	ssize_t r;

	do
	{
		if(( r = read( fd, ( void * )(( u_char * )buf + tot ), n - tot ) ) <= 0 )
			return( r );

		tot += r;
	}
	while( tot < n );

	return( tot );
}


/*
 * Terminate process when child exits or flag connection to target
 */
	static void
sighandler( int signo )
{
	if( signo == SIGCHLD )
	{
		debug( "Child terminated connection" );
		wait( NULL );
		exit( EXIT_SUCCESS );
	}

	else if( signo == SIGUSR1 )
	{
		debug( "[FREESVR-SSH-PROXY] Connection to real target established" );
		target_connected = 1;
		signal( SIGUSR1, SIG_DFL );
	}

	/* Add for command block */
	else if( signo == SIGRTMIN + 1 )
	{
		printf( "[FREESVR-SSH-PROXY] Block this command! signal = %d\n", signo );
		block_command_flag = 1;
		signal( SIGRTMIN + 1, sighandler );
	}
	else if( signo == SIGRTMIN + 2 )
	{
		printf( "[FREESVR-SSH-PROXY] Recv exit signal from perl! signal = %d\n", signo );
		cleanup_exit( 255 );
	}
	else if( signo == SIGRTMIN + 3 )
	{
	}
	else
		logit( "** Unrecognized signal %u", signo );
}

/*
 * Check for packets that do not need to be redirected
 */
	 int
process_packet( int type, char *raw )
{
	if( compat20 )
		return( ssh2_process_packet( type, raw ) );
	else
		return( ssh1_process_packet( type, raw ) );
}

	static int
ssh1_process_packet( int type, char *raw )
{
	int processed = 0;
	int success = 0;
	int compression_level = 0;
	int enable_compression_after_reply = 0;

	switch( type )
	{
		case SSH_CMSG_REQUEST_COMPRESSION:
			processed = 1;

			debug2( "Got SSH_CMSG_REQUEST_COMPRESSION" );
			compression_level = *(( int * )( raw + 4 ) );

			if( compression_level < 1 || compression_level > 9 )
			{
				packet_send_debug( "Received invalid compression level %d.",
						compression_level );
				break;
			}

			/* Enable compression after we have responded with SUCCESS. */
			enable_compression_after_reply = 1;
			success = 1;
			break;

		case SSH_CMSG_MAX_PACKET_SIZE:
			debug2( "Got SSH_CMSG_MAX_PACKET_SIZE" );
			processed = 1;

			if( packet_set_maxsize( *(( int * )( raw + 4 ) ) ) > 0 )
				success = 1;

			break;

			/*
			 * We may want to handle this when hijacking
			 * case SSH_CMSG_EXIT_CONFIRMATION:
			 *  debug2("Got SSH_CMSG_EXIT_CONFIRMATION");
			 *  fatal("Closing connection");
			 *  break;
			 */

	}

	if( processed )
	{
		debug3( "Process %s", success ? "failed" : "succeded" );
		packet_start( success ? SSH_SMSG_SUCCESS : SSH_SMSG_FAILURE );
		packet_send();
		packet_write_poll();

		/* Enable compression now that we have replied if appropriate. */
		if( enable_compression_after_reply )
		{
			enable_compression_after_reply = 0;
			packet_start_compression( compression_level );
			debug3( "Compression enabled" );
		}
	}

	return( processed );
}

static int
ssh2_process_packet( int type, char *raw )
{
	/* There is really not much to do with a SSH2 packet since
	 * important stuff like compression is handled by packet.c. */
	return( 0 );
}

int fetch_sftp_flag(MYSQL *sql_conn, int devices_id)
{
	MYSQL_RES *query_result;
	MYSQL_ROW row;
	int query, ret;
	char buf[256];

	snprintf (buf, sizeof( buf ), "SELECT sftp FROM devices WHERE id=%d", devices_id);
	query = mysql_query(sql_conn, buf);
	query_result = mysql_store_result(sql_conn);
	row = mysql_fetch_row( query_result );

	if (row == NULL || row[0] == NULL)
	{
		ret = 0;
	}
	else
	{
		ret = atoi(row[0]);
	}

	mysql_free_result(query_result);
	return ret;
}

int get_privatekey_path( int line, char *path )
{
	MYSQL *radius_sql_conn;
	MYSQL_RES *query_result;
	MYSQL_ROW row;
	int ret = -1;
	char buf[256];

	radius_sql_conn = mysql_init( NULL );
	radius_sql_conn = mysql_real_connect( radius_sql_conn, mysql_address, mysql_username, mysql_password, mysql_database, 0, NULL, 0 );

	bzero( buf, sizeof(buf) );
	snprintf( buf, sizeof( buf ), "SELECT privatekey FROM sshpublickey WHERE line=%d", line );
	mysql_query( radius_sql_conn, buf );
	query_result = mysql_store_result( radius_sql_conn );
	row = mysql_fetch_row( query_result );

	if( row && row[0] )
	{
		strcpy( path, row[0] );
		ret = 0;
	}

	mysql_close( radius_sql_conn );
	return ret;
}

char * fetch_audit_menu_ip(MYSQL *sql_conn, const char *radius_username, int *rows)
{
    MYSQL_RES *res;
    MYSQL_ROW row;

    char buf[1024];
    char (*menu)[64];
    int numrows, index = 0;

    snprintf(buf, sizeof(buf), "SELECT distinct devices.device_ip FROM `devices` LEFT JOIN (SELECT devicesid FROM luser WHERE memberid=(SELECT uid from member where username='%s') "\
             "AND 1 UNION SELECT devicesid FROM lgroup WHERE groupid=(SELECT groupid from member where username='%s') AND 1 UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM luser_resourcegrp a "\
             "LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.memberid=(SELECT uid from member where username='%s') AND 1=1) UNION SELECT devicesid FROM resourcegroup WHERE groupname "\
             "IN (SELECT b.groupname FROM lgroup_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.groupid=(SELECT groupid from member where username='%s') AND 1=1)) d "\
             "ON devices.id=d.devicesid LEFT JOIN servers ON devices.device_ip=servers.device_ip AND devices.hostname=servers.hostname WHERE 1=1 "\
             "AND devices.login_method!=26 AND (devices.login_method=3 or devices.login_method=5) AND d.devicesid IS NOT NULL ORDER BY devices.device_ip asc",
radius_username, radius_username, radius_username, radius_username);
    mysql_query(sql_conn, buf);
	res = mysql_store_result(sql_conn);
	numrows = mysql_num_rows(res);

	menu = (char (*)[64])malloc(sizeof(char) * 64 * (numrows + 1));
	memset(menu, 0x00, sizeof(char) * 64 * (numrows + 1));

	while ((row = mysql_fetch_row(res)) != NULL)
	{
	    strcpy(menu[index], row[0]);
		index ++;
	}

    if (rows) *rows = numrows;
	mysql_free_result(res);
	return menu;
}

char * fetch_audit_menu_username(MYSQL *sql_conn, const char *radius_username, const char *ip, int *rows, int **dsid, int **lm)
{
    MYSQL_RES *res;
    MYSQL_ROW row;

    char buf[4096];
    char (*menu)[64];
    int numrows, index = 0;
    int *deviceid, *lmethod;

    snprintf(buf, sizeof(buf), "SELECT IF(devices.login_method=3,'ssh','telnet') AS type,devices.id,devices.username,devices.login_method FROM `devices` LEFT JOIN "\
	"(SELECT devicesid FROM luser WHERE memberid=(SELECT uid from member where username='%s') AND 1 UNION SELECT devicesid FROM lgroup "\
	"WHERE groupid=(SELECT groupid from member where username='%s') AND 1 UNION SELECT devicesid FROM resourcegroup WHERE groupname IN "\
	"(SELECT b.groupname FROM luser_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.memberid=(SELECT uid from member where username='%s')"\
	" AND 1=1) UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM lgroup_resourcegrp a LEFT JOIN resourcegroup b "\
	"ON a.resourceid=b.id WHERE a.groupid=(SELECT groupid from member where username='%s') AND 1=1)) d ON devices.id=d.devicesid "\
	"LEFT JOIN servers ON devices.device_ip=servers.device_ip AND devices.hostname=servers.hostname WHERE 1=1 AND devices.login_method!=26 "\
	"AND (devices.login_method=3 or devices.login_method=5) AND d.devicesid IS NOT NULL AND devices.device_ip='%s' ORDER BY devices.device_ip asc",
        radius_username, radius_username, radius_username, radius_username, ip);
    	mysql_query(sql_conn, buf);
	printf("%s\n%s\n", buf, mysql_error(sql_conn));
	res = mysql_store_result(sql_conn);
	numrows = mysql_num_rows(res);
	menu = (char (*)[64])malloc(sizeof(char) * 64 * numrows);
	deviceid = (int *)malloc(sizeof(int) * numrows);
	lmethod = (int *)malloc(sizeof(int) * numrows);
	memset(menu, 0x00, sizeof(char) * 64 * numrows);

	while ((row = mysql_fetch_row(res)) != NULL)
	{
	    snprintf(menu[index], 64, "%s(%s)", row[2], row[0]);
	    deviceid[index] = atoi(row[1]);
	    lmethod[index] = atoi(row[3]);
		index ++;
	}

    if (rows) *rows = numrows;
    if (dsid) *dsid = deviceid;
    if (lm) *lm = lmethod;
 	mysql_free_result(res);
	return menu;
}

char select_buf[64][4][128];
int  select_cnt = 0;
MYSQL *sql_conn = NULL;
struct simple_packet    mitm_channel_request[MITM_REQ_MAX];
int                     mitm_channel_reply  [MITM_REQ_MAX];
int                     mitm_channel_cnt = 0;

int process_select_username_input_ssh1( int cfd, int remote_id )
{
	int choose = -1, char_num = 0, i, len = 0, ret = 0, rchan;
	struct simple_packet spkt;
	char *pt;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x01, 0x07 };
	char crreply[]   = { 0x00, 0x00, 0x00, 0x02, 0x0d, 0x0a };
	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );

	while( 1 )
	{
		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );
		memset( &spkt, 0x00, sizeof( spkt ) );

		if( select( cfd + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( cfd, &readtmp ) )
		{
			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				//            for ( i = 0; i < spkt.len; i++ )
				//            {
				//                printf( "%02x ", (u_char)spkt.data[i] );
				//            }
				//            printf("\n");
				if( !compat20 )
				{

					if( spkt.type == SSH_CMSG_STDIN_DATA )
					{
						//char_num++;
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							//char_num = 0;
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_raw( crreply, sizeof( crreply ) );
							packet_send();
							packet_write_wait();
							//printf( "ret = %d\n", ret );
							return ret;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 0;
							ret = 0;
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_string( "\x0d\x0aInput: ", 9 );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num --;
							packet_start( SSH_SMSG_STDOUT_DATA );

							if( char_num < 0 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 0;
								ret = 0;
							}
							else
							{
								ret = ret / 10;
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else if( len == 1 && ctrl[0] >= '0' && ctrl[0] <= '9' )
						{
							char_num++;
							ret = ret * 10 + ( ctrl[0] - '0' );
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
				}
			}
		}
	}
}

int process_select_username_input( int cfd, int remote_id )
{
	int choose = -1, char_num = 0, i, len = 0, ret = 0, rchan, rflag;
	struct simple_packet spkt;
	char *pt;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0x07 };
	char crreply[]   = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x02, 0x0d, 0x0a };

	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );

	while( 1 )
	{

		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );
		memset( &spkt, 0x00, sizeof( spkt ) );

		printf( "[%s] Wait for input\n", __func__ );
		if( select( cfd + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( cfd, &readtmp ) )
		{

			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						packet_get_int();
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_raw( crreply, sizeof( crreply ) );
							packet_send();
							packet_write_wait();
							//printf( "ret = %d\n", ret );
							return ret;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 0;
							ret = 0;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_int( remote_id );
							packet_put_string( "\x0d\x0aInput: ", 9 );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num--;
							//printf("%d\n", remote_id );
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
							{
								delreply1[2] = 0x01;
								delreply2[2] = 0x01;
							}

							if( char_num < 0 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 0;
								ret = 0;
							}
							else
							{
								ret = ret / 10;
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else if( len == 1 && ctrl[0] >= '0' && ctrl[0] <= '9' )
						{
							char_num++;
							ret = ret * 10 + ( ctrl[0] - '0' );
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								spkt.data[2] = 0x01;
							//spkt.data[3] = 0x00;

							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
						else if (len == 1 && (ctrl[0] == 'i' || ctrl[0] == 'I'))
						{
							return -1;
						}
						else if (len == 1 && (ctrl[0] == 'p' || ctrl[0] == 'P'))
						{
							return -2;
						}
						else if (len == 1 && (ctrl[0] == 'n' || ctrl[0] == 'N'))
						{
							return -3;
						}
						else if (len == 1 && (ctrl[0] == 'q' || ctrl[0] == 'Q'))
						{
							return -4;
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );
						rchan = packet_get_int();
						packet_start( SSH2_MSG_CHANNEL_OPEN_FAILURE );
						packet_put_int( rchan );
						packet_put_int( 1 );
						packet_put_cstring( "open failed" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						block_channel_cnt = mitm_channel_cnt;
						packet_get_int();
						packet_get_string( NULL );
						rflag = packet_get_char();

						if( !rflag )
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
					else if( spkt.type == 20 )
					{
						dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
					}
				}

				memset( &spkt, 0x00, sizeof( spkt ) );
			}
		}
	}
}

char *process_input_ip_address(int cfd, int remote_id, char *ip)
{
	int choose = -1, char_num = 0, i, len = 0, ret = 0, rchan, rflag;
	struct simple_packet spkt;
	char *pt;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0x07 };
	char crreply[]   = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x02, 0x0d, 0x0a };

	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );

	while( 1 )
	{

		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );
		memset( &spkt, 0x00, sizeof( spkt ) );

		printf( "[%s] Wait for input\n", __func__ );
		if( select( cfd + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( cfd, &readtmp ) )
		{

			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						packet_get_int();
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_raw( crreply, sizeof( crreply ) );
							packet_send();
							packet_write_wait();
							ip[char_num] = 0x00;
							//printf( "ret = %d\n", ret );
							return ret;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 0;
							ret = 0;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_int( remote_id );
							packet_put_string( "\x0d\x0aInput IP Address: ", 9 );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num--;
							//printf("%d\n", remote_id );
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
							{
								delreply1[2] = 0x01;
								delreply2[2] = 0x01;
							}

							if( char_num < 0 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 0;
								ret = 0;
							}
							else
							{
								ret = ret / 10;
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else if( len == 1 && (ctrl[0] >= '0' && ctrl[0] <= '9') || ctrl[0] == '.' || ctrl[0] == ':')
						{
							ip[char_num] = ctrl[0];
							char_num++;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								spkt.data[2] = 0x01;
							//spkt.data[3] = 0x00;

							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );
						rchan = packet_get_int();
						packet_start( SSH2_MSG_CHANNEL_OPEN_FAILURE );
						packet_put_int( rchan );
						packet_put_int( 1 );
						packet_put_cstring( "open failed" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						block_channel_cnt = mitm_channel_cnt;
						packet_get_int();
						packet_get_string( NULL );
						rflag = packet_get_char();

						if( !rflag )
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
					else if( spkt.type == 20 )
					{
						dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
					}
				}

				memset( &spkt, 0x00, sizeof( spkt ) );
			}
		}
	}
}

void send_message_2_client(int block_session_id, const char *str)
{
    packet_start( SSH2_MSG_CHANNEL_DATA );

						if( client_is_putty )
							packet_put_int( 256 );
						else
							packet_put_int( block_session_id );

						packet_put_cstring(str);
						packet_send();
						packet_write_wait();
}

char *process_client_input_string(int cfd, int block_session_id, const char *prompt, int echo)
{
    int choose = -1, char_num = 0, i, len = 0, ret = 0, rchan, rflag, remote_id;
	struct simple_packet spkt;
	char *pt;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0x07 };
	char crreply[]   = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x02, 0x0d, 0x0a };
    static char str[1024];

    if( client_is_putty )
        remote_id = 256;
    else
        remote_id = block_session_id;

	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );

	while( 1 )
	{
		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );
		memset( &spkt, 0x00, sizeof( spkt ) );

		printf( "[%s] Wait for input\n", __func__ );
		if( select( cfd + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( cfd, &readtmp ) )
		{
			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						packet_get_int();
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_raw( crreply, sizeof( crreply ) );
							packet_send();
							packet_write_wait();
							str[char_num] = 0x00;
							return ret;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 0;
							ret = 0;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								crreply[2] = 0x01;

							packet_put_int( remote_id );
							packet_put_cstring(prompt);
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num--;
							//printf("%d\n", remote_id );
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
							{
								delreply1[2] = 0x01;
								delreply2[2] = 0x01;
							}

							if( char_num < 0 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 0;
								ret = 0;
							}
							else
							{
								ret = ret / 10;
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else if(len == 1)
						{
							str[char_num] = ctrl[0];
							char_num++;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( remote_id == 256 )
								spkt.data[2] = 0x01;
							//spkt.data[3] = 0x00;
							if(echo == 0)
								spkt.data[8] = '*';

							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );
						rchan = packet_get_int();
						packet_start( SSH2_MSG_CHANNEL_OPEN_FAILURE );
						packet_put_int(rchan);
						packet_put_int(1);
						packet_put_cstring( "open failed" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						block_channel_cnt = mitm_channel_cnt;
						packet_get_int();
						packet_get_string( NULL );
						rflag = packet_get_char();

						if( !rflag )
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
					else if( spkt.type == 20 )
					{
						dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
					}
				}

				memset( &spkt, 0x00, sizeof( spkt ) );
			}
		}
	}
	return str;
}


char * radius_Authenticate( int cfd, u_int server_ip )
{
	struct simple_packet spkt;
	int  i, length, remote_id, rflag, ret = 1, radius_ret = -1, snum, uret;
	char *pt, *client_userid, *client_method, *client_autype, *rtype;;
	char *radius_username = NULL, *radius_password, *ssh_username = NULL, *ssh_password;
	char client_userid_cpy[1024];
	Select *sinfo;
	unsigned short int dest_port;
	char *dest_ip, *dest_username, *dest_password;
	char reply[] =
	{
		0x00, 0x00, 0x00, 0x22, 0x70, 0x75, 0x62, 0x6c, 0x69, 0x63, 0x6b, 0x65, 0x79, 0x2c, 0x67,
		0x73, 0x73, 0x61, 0x70, 0x69, 0x2d, 0x77, 0x69, 0x74, 0x68, 0x2d, 0x6d, 0x69, 0x63, 0x2c,
		0x70, 0x61, 0x73, 0x73, 0x77, 0x6f, 0x72, 0x64, 0x00
	};
	fd_set readset;

	/* Initial */
	for( i = 0; i < MITM_REQ_MAX; i++ )
	{
		mitm_channel_reply[i] = 1;
	}

	/*usleep( 900000 );
	  packet_start( SSH2_MSG_SERVICE_ACCEPT );
	  packet_put_raw( spkt.data, spkt.len );
	  packet_send();
	  packet_write_wait();*/

	FD_ZERO( &readset );
	FD_SET( cfd, &readset );

	debug4( "[FREESVR-SSH-PROXY] Selecting on server side" );

	//fflush(cfd);

	while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
	{
		pt = ( char * )packet_get_raw(( int * )&spkt.len );

		/* Do not send along packets that only affect us */
		if( process_packet( spkt.type, spkt.data ) != 0 )
		{
			memset( &spkt, 0x00, spkt.len + 8 );
			continue;
		}

		if( spkt.len > sizeof( spkt.data ) )
		{
			fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
					spkt.len, sizeof( spkt.data ) );
		}

		debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
		memcpy( spkt.data, pt, spkt.len );

		if( show_stream )
		{
			printf( "[radius@%d] from client. type=%d  %d: ", getpid(), spkt.type, spkt.len );

			for( i = 0; i < spkt.len; i++ )
			{
				if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
				else
					printf( " %02x ", ( u_char )spkt.data[i] );
			}

			printf( "\n" );
		}

		if( compat20 )
		{
			//if( 0 && spkt.type == SSH2_MSG_SERVICE_REQUEST )
			if( spkt.type == SSH2_MSG_SERVICE_REQUEST )
			{
				packet_start( SSH2_MSG_SERVICE_ACCEPT );
				packet_put_raw( spkt.data, spkt.len );
				packet_send();
				packet_write_wait();
			}
		}
		else
		{
			if( spkt.type == SSH_CMSG_USER )
			{
				client_userid = packet_get_string( &length );
				strcpy( client_userid_cpy, client_userid );

				//printf( "client_userid = %s, cpy = %s\n", client_userid, client_userid_cpy );

				packet_start( SSH_SMSG_FAILURE );
				packet_put_raw( spkt.data, 0 );
				packet_send();
				packet_write_wait();
			}
		}
	}

	while( ret )
	{
		printf( "looping\n" );
		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );
		memset( &spkt, 0x00, sizeof( spkt ) );

		if( select( cfd + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
			{
				printf( "recv a signal!\n" );
				continue;
			}

			break;
		}

		/* Read from client and write to socketpair */
		/* Log the stream of client */
		if( FD_ISSET( cfd, &readtmp ) )
		{
			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( show_stream )
				{
					printf( "[radius@%d] from client. type=%d  %d: ", getpid(), spkt.type, spkt.len );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else
							printf( " %02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );
				}

				if( compat20 )
				{
					//if( 0 && spkt.type == SSH2_MSG_SERVICE_REQUEST )
					if( spkt.type == SSH2_MSG_SERVICE_REQUEST )
					{
						packet_start( SSH2_MSG_SERVICE_ACCEPT );
						packet_put_raw( spkt.data, spkt.len );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_REQUEST )
					{
						client_userid = packet_get_string( &length );
						client_method = packet_get_string( &length );
						client_autype = packet_get_string( &length );

						//                    printf( "client_userid = %s, client_method = %s, client_autype = %s\n",
						//                            client_userid, client_method, client_autype );

						/* none of password */
						if( strcmp( client_autype, "none" ) == 0 || strcmp( client_autype, "gssapi-with-mic" ) == 0 )
						{
							memcpy( spkt.data, reply, sizeof( reply ) );
							packet_start( SSH2_MSG_USERAUTH_FAILURE );
							packet_put_raw( spkt.data, sizeof( reply ) );
							packet_send();
							packet_write_wait();
						}
						else if( strcmp( client_autype, "publickey" ) == 0 )
						{
							printf("AUTH PUBLIC KEY, authorized_keys = %s, authorized_keys2 = %s\n",
									options.authorized_keys_file, options.authorized_keys_file2 );
							radius_ret = query2authserver( 1, client_userid, NULL, serverip, sourceip, login_method, use_vpn, 1,
									NULL, NULL, &conn_mode, &radius_username, &snum, &sinfo, &dest_ip, &dest_port, &dest_username, &dest_password,
									&auto_su, &su_command, &su_password, &forbidden, -1, NULL, NULL, NULL, &did );
							if ( radius_ret == 0 )
							{
								strcpy( conn2server_saddress, dest_ip );
								conn2server_port = dest_port;
							}
							else
							{
								printf( "authd reply failed, exit. auth_ret = %d\n", radius_ret );
								cleanup_exit( 255 );
							}
							chmod( options.authorized_keys_file, 0644 );
							uret = userauth_pubkey_mitm( client_userid, client_autype );
							printf( "userauth_pubkey_mitm ret = %d\n", uret );
							if ( uret == 1 )
							{
								packet_start( 52 );
								packet_send();
								packet_write_wait();
								strcpy( conn2server_username, client_userid );
								publickey_auth = 1;
								printf( "key line number is %d\n", keylinenum );
								if ( get_privatekey_path( keylinenum, privatekey_path ) == -1 )
								{
									printf( "ERROR: Can't find the privatekey in mysql.\n" );
									cleanup_exit( 255 );
								}
								printf( "Private key path is %s\n", privatekey_path );
								//ret = 0;
							}
							else
							{
								printf( "key line number is %d\n", keylinenum );
								if ( keylinenum == -1 )
									fatal( "Can't fetch the public key in audit's authorized_keys." );
							}
						}
						/* password */
						else if( strcmp( client_autype, "password" ) == 0 )
						{
							/* skip one byte */
							packet_get_char();
							radius_password = packet_get_string( &length );
							//printf("radius_password = %s\n",radius_password);

							spkt.data[0] = 0x00;

							needle = strstr(radius_password, "---");
							if (needle)
							{
								*needle = 0x00;
								strcpy(conn2server_password, needle + 3);
							}

							radius_ret = query2authserver( 1, client_userid, radius_password, serverip, sourceip, login_method, use_vpn, 1,
									NULL, NULL, &conn_mode, &radius_username, &snum, &sinfo, &dest_ip, &dest_port, &dest_username, &dest_password,
									&auto_su, &su_command, &su_password, &forbidden, -1, NULL, &publickey_auth, privatekey_path, &did );

							//conn_mode = get_radius_username( client_userid, &radius_username, &ssh_username );
							printf( "publickey_auth = %d, privatekey_path = %s, forbidden = %s\n", publickey_auth, privatekey_path, forbidden );
							//if ( radius_username ) printf( "radius_username = %s\n", radius_username );
							//if ( ssh_username    ) printf( "ssh_username = %s\n", ssh_username );

							/* radius authenticate */
							//radius_ret = radius_auth_new( radius_username, radius_password );

							/* All radius server did not respond */
							/*if ( radius_ret  == 0  || radius_ret == 1 )
							  {
							  cleanup_exit(255);
							  }*/
							/* radius authenticate success */
							if( radius_ret == 0 )
							{
								printf( "Radius auth successed!\n" );
								printf( "conn_mode = %d\n", conn_mode );
								packet_start( SSH2_MSG_USERAUTH_SUCCESS );
								packet_put_raw( spkt.data, 0x00 );
								packet_send();
								packet_write_wait();

								/* Read Mysql */
								if( conn_mode == CONN_GWVPN_UNIQUE || conn_mode == CONN_AUDIT_UNIQUE )
								{
									//get_ssh_username_password_from_mysql(radius_username, ssh_username, server_ip);
									//ret = 0;
									strcpy( conn2server_saddress, dest_ip );
									conn2server_port = dest_port;
									strcpy( conn2server_username, dest_username );
									//strcpy( conn2server_password, dest_password );
									if (!needle) strcpy( conn2server_password, dest_password );
								}
								/* Maybe only one ssh username */
								else if( conn_mode == CONN_GWVPN_SELECT )
								{
									//get_ssh_username_password_from_mysql2( radius_username, server_ip );
									/*if ( snum == 1 )
									  {
									//strcpy( conn2server_username, select_buf[0][0] );
									//strcpy( conn2server_password, select_buf[0][1] );
									//conn2server_port = (unsigned int)atoi( select_buf[0][2] );
									//ret = 0;
									conn_mode = CONN_GWVPN_UNIQUE;
									strcpy( conn2server_saddress, dest_ip );
									conn2server_port = dest_port;
									strcpy( conn2server_username, dest_username );
									strcpy( conn2server_password, dest_password );
									}*/
								}
								else if( conn_mode == CONN_AUDIT_SELECT )
								{

								}
								else if( conn_mode == CONN_PROXY_TELNET || conn_mode == CONN_PROXY_RLOGIN )
								{
									printf("okok\n");
									printf( "%d\n", dest_port );
									strcpy( conn2server_saddress, dest_ip );
									conn2server_port = dest_port;
									strcpy( conn2server_username, dest_username );
									strcpy( conn2server_password, dest_password );
									printf( "%s\n", dest_username );
									//get_ssh_username_password_from_mysql_method3( device_table_id, radius_username );
									//printf("ok\n");
									//no_shell = 1;
									//ret = 0;
								}
								else if( conn_mode == CONN_PROXY_REPLAY )
								{
									strcpy( conn2server_saddress, dest_ip );
									conn2server_port = dest_port;
									strcpy( conn2server_username, dest_username );
									strcpy( conn2server_password, dest_password );
								}
							}
							/* radius authenticate fail */
							else if( radius_ret == 2 )
							{
								printf( "Radius auth failed! Radius ret = %d\n", radius_ret );
								memcpy( spkt.data, reply, sizeof( reply ) );
								packet_start( SSH2_MSG_USERAUTH_FAILURE );
								packet_put_raw( spkt.data, sizeof( reply ) );
								packet_send();
								packet_write_wait();
							}
							else
							{
								printf( "authd reply failed, exit. auth_ret = %d\n", radius_ret );
								cleanup_exit( 255 );
							}
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						packet_get_string( &length );
						remote_id = packet_get_int();
						//printf("test length = %d", length );

						/* Client is putty */
						if( remote_id == 256 )
						{
							client_is_putty = 1;
							packet_start( SSH2_MSG_CHANNEL_OPEN_CONFIRMATION );
							packet_put_int( remote_id );
							packet_put_int( proxy_server_session_id );
							packet_put_int( 0 );
							packet_put_int( 0x8000 );
							packet_send();
							packet_write_wait();
						}
						else
						{
							packet_start( SSH2_MSG_CHANNEL_OPEN_CONFIRMATION );
							packet_put_int( remote_id );
							packet_put_int( proxy_server_session_id );
							packet_put_int( 0 );
							packet_put_int( 0x8000 );
							packet_send();
							packet_write_wait();
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						packet_get_int();
						rtype = packet_get_string( NULL );
						rflag = packet_get_char();

						printf( "rflag = %d\n", rflag );
						if( remote_id != 256 ) remote_id = 0;

						if( strcmp( rtype, "shell" ) == 0 )
						{
							packet_start( SSH2_MSG_CHANNEL_WINDOW_ADJUST );
							packet_put_int( remote_id );
							packet_put_int( 0x20000 );
							packet_send();
							packet_write_wait();
							block_channel_cnt = mitm_channel_cnt;
							ret = 0;
						}
						else if( forbidden_x11 && strcmp( rtype, "x11-req" ) == 0 )
						{
							printf("Forbidden X11 forwarding.\n");
							cleanup_exit(255);
						}
						else if( strcmp( rtype, "exec" ) == 0 || strcmp( rtype, "x11-req" ) == 0 || strcmp( rtype, "subsystem" ) == 0 )
						//else if( strcmp( rtype, "exec" ) == 0 || strcmp( rtype, "subsystem" ) == 0 )
						{
							printf("%s\n", rtype );
							block_channel_cnt = mitm_channel_cnt;
							ret = 0;
							printf( "No shell,\n" );
							no_shell = 1;
						}

						else {}

						if( rflag )
						{
							if( !no_shell )
							{
								packet_start( SSH2_MSG_CHANNEL_SUCCESS );
								packet_put_int( remote_id );
								packet_send();
								packet_write_wait();
							}
						}
						else
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
				}
				else//ssh1
				{
					if( spkt.type == SSH_CMSG_USER )
					{
						client_userid = packet_get_string( &length );
						strcpy( client_userid_cpy, client_userid );

						//printf( "client_userid = %s, cpy = %s\n", client_userid, client_userid_cpy );

						packet_start( SSH_SMSG_FAILURE );
						packet_put_raw( spkt.data, 0 );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH_CMSG_AUTH_TIS )
					{
						packet_start( SSH_SMSG_FAILURE );
						packet_put_raw( spkt.data, 0 );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH_CMSG_AUTH_PASSWORD )
					{
						radius_password = packet_get_string( &length );
						//printf("radius_password = %s\n", radius_password);

						/* Add @ 2013-01-20 */
							needle = strstr(radius_password, "---");
							if (needle)
							{
								*needle = 0x00;
								strcpy(conn2server_password, needle + 3);
							}
						strcpy( client_userid, client_userid_cpy );
						//char *cpy = client_userid_cpy;
						//conn_mode = get_radius_username( client_userid, &radius_username, &ssh_username );
						//printf( "conn_mode = %d\n", conn_mode );
						//if ( radius_username ) printf( "radius_username = %s\n", radius_username );
						//if ( ssh_username    ) printf( "ssh_username = %s\n", ssh_username );

						//radius_ret = radius_auth_new( radius_username, radius_password );
						radius_ret = query2authserver( 1, client_userid, radius_password, serverip, sourceip, login_method, use_vpn, 1,
								NULL, NULL, &conn_mode, &radius_username, &snum, &sinfo, &dest_ip, &dest_port, &dest_username, &dest_password,
								&auto_su, &su_command, &su_password, &forbidden, -1, NULL, NULL, NULL, &did );


						/* radius authenticate success */
						if( radius_ret  == 0 )
						{
							packet_start( SSH_SMSG_SUCCESS );
							packet_put_raw( spkt.data, 0x00 );
							packet_send();
							packet_write_wait();

							/* Read Mysql */
							if( conn_mode == CONN_GWVPN_UNIQUE || conn_mode == CONN_AUDIT_UNIQUE )
							{
								//get_ssh_username_password_from_mysql(radius_username, ssh_username, server_ip);
								//ret = 0;
								strcpy( conn2server_saddress, dest_ip );
								conn2server_port = dest_port;
								strcpy( conn2server_username, dest_username );
								//strcpy( conn2server_password, dest_password );

								if (!needle) strcpy( conn2server_password, dest_password );
							}
							else if( conn_mode == CONN_GWVPN_SELECT )
							{

							}
							else if( conn_mode == CONN_AUDIT_SELECT )
							{

							}
							else if( conn_mode == CONN_PROXY_TELNET || conn_mode == CONN_PROXY_RLOGIN )
							{
								strcpy( conn2server_saddress, dest_ip );
								conn2server_port = dest_port;
								strcpy( conn2server_username, dest_username );
								strcpy( conn2server_password, dest_password );
								//get_ssh_username_password_from_mysql_method3( device_table_id, radius_username );
								//printf("ok\n");
								//no_shell = 1;
								//ret = 0;
							}
							else if( conn_mode == CONN_PROXY_REPLAY )
							{
								strcpy( conn2server_saddress, dest_ip );
								conn2server_port = dest_port;
								strcpy( conn2server_username, dest_username );
								strcpy( conn2server_password, dest_password );
							}

							/* Maybe only one ssh username */

						}
						else if( radius_ret == 2 )
						{
							packet_start( SSH_SMSG_FAILURE );
							packet_put_raw( spkt.data, 0 );
							packet_send();
							packet_write_wait();
						}
						else
						{
							printf( "authd reply failed, exit. auth_ret = %d\n", radius_ret );
							cleanup_exit( 255 );
						}
					}
					else if( spkt.type == SSH_CMSG_REQUEST_PTY )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						packet_start( SSH_SMSG_SUCCESS );
						packet_put_raw( spkt.data, 0x00 );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH_CMSG_EXEC_SHELL )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						mitm_channel_reply[mitm_channel_cnt-1] = 0;
						ret = 0;
					}
					else if( spkt.type == SSH_CMSG_EXEC_CMD )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						mitm_channel_reply[mitm_channel_cnt-1] = 0;
						no_shell = 1;
						ret = 0;
					}
				}

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}
	}

	/* SSH2 */
	if( compat20 )
	{

		int choose, page, line, odd;
		char (*menu)[64];
		char sel[1024];
		int menu_rows, *devicesid, *lmethod;

		/* Print select interface */
		if( conn_mode == CONN_GWVPN_SELECT )
		{

		}
		else if( conn_mode == CONN_AUDIT_SELECT )
		{
			ret = 1;

			while( ret )
			{
				menu = fetch_audit_menu_ip(sql_conn, radius_username, &menu_rows);
				/*for( i = 0; i < (menu_rows-1)/40; i++ )
				  {
				  packet_start( SSH2_MSG_CHANNEL_DATA );
				  packet_put_int( remote_id );
				  snprintf(sel, sizeof(sel), "[%d]%s\x0d\x0a", i + 1, menu[i]);
				  packet_put_string( sel, strlen( sel ) );
				  packet_send();
				  packet_write_wait();
				  }*/
				page = 0;
				while (1)
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					//char sel[1024];
					snprintf( sel, sizeof( sel ), "\033[2J\033[0;0HPlease select an IP Address:\x0d\x0a" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();

					for(line = 2, i = 0, odd = 0; line <= 21 && page * 40 + i < menu_rows; line++, i += 2, odd++)
					{
						packet_start( SSH2_MSG_CHANNEL_DATA );
						packet_put_int( remote_id );
						snprintf(sel, sizeof(sel), "\033[%d;0H[%d]%s\033[%d;40H[%d]%s\x0d\x0a", line, i + 1, menu[page * 40 + i], line, i + 2, menu[page * 40 + i + 1]);
						packet_put_string( sel, strlen( sel ) );
						packet_send();
						packet_write_wait();
					}
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					snprintf( sel, sizeof( sel ), "[I]Input IP Address.\x0d\x0a[Q]Quit ssh-audit system.\x0d\x0aInput: ", menu_rows + 1 );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
					choose = process_select_username_input( cfd, remote_id );
					if (choose == -2)//prev
					{
						page -= 1;
						page = page < 0 ? 0 : page;
					}
					else if (choose == -3)//next
					{
						page += 1;
						page = (page > (menu_rows - 1) / 40 + 1) ? (menu_rows - 1) / 40 + 1 : page;
					}
					else
						break;
				}
				if (choose == -4)
				{
					fatal( "Exit from ssh-audit system.\n" );
				}
				else if( choose > 0 && choose <= menu_rows )
				{
					printf("choose=%d\n", choose);
					choose = page * 40 + choose;
				}
				else if(choose == -1)
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					snprintf( sel, sizeof( sel ), "\r\033[KInput IP Address: ");
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();

					process_input_ip_address(cfd, remote_id, menu[menu_rows]);
					printf("Input IP Address: %s\n", menu[menu_rows]);
				}
				else
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					snprintf( sel, sizeof( sel ), "Invalid Number!\x0d\x0a" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
					ret = 1;
				}

				packet_start( SSH2_MSG_CHANNEL_DATA );
				packet_put_int( remote_id );
				snprintf( sel, sizeof( sel ), "\033[2J\033[0;0H" );
				packet_put_string( sel, 10 );
				packet_send();
				packet_write_wait();

				packet_start( SSH2_MSG_CHANNEL_DATA );
				packet_put_int( remote_id );
				//char sel[1024];
				snprintf( sel, sizeof( sel ), "Please choose an username:\x0d\x0a" );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();

                menu = fetch_audit_menu_username(sql_conn, radius_username, menu[choose-1], &menu_rows, &devicesid, &lmethod);
				if (menu_rows == 0) continue;
				for( i = 0; i < menu_rows; i++ )
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					//char sel[1024];
					//snprintf( sel, sizeof( sel ), "[%d]%-20s%-35s<%s>\x0d\x0a",
					//		i + 1, sinfo[i].dest_ip, sinfo[i].dest_username, sinfo[i].login_method == 3 ? "ssh" : "telnet" );
					snprintf(sel, sizeof(sel), "[%d]%s\x0d\x0a", i + 1, menu[i]);
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
				}

				packet_start( SSH2_MSG_CHANNEL_DATA );
				packet_put_int( remote_id );
				snprintf( sel, sizeof( sel ), "[%d]Exit from this system!\x0d\x0aInput: ", menu_rows + 1 );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();
				choose = process_select_username_input( cfd, remote_id );

				if(choose < 0)
				{
					fatal( "Exit from ssh-audit system.\n" );
				}
				else if( choose > 0 && choose <= menu_rows )
				{
					ret = 0;
					did = devicesid[choose-1];
					radius_ret = select2authserver( radius_username, devicesid[choose-1], sourceip, 3, &conn_mode,
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden );

					if( radius_ret == 0 )
					{
					    printf("%s %s %s\n", dest_ip, dest_username, dest_password);
						strcpy( conn2server_saddress, dest_ip );
						conn2server_port = dest_port;
						strcpy( conn2server_username, dest_username );
						strcpy( conn2server_password, dest_password );
					}
					else
					{
						printf( "select 2 authd reply failed. exit. ret=%d\n", radius_ret );
						cleanup_exit( 255 );
					}

				}
				else
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					packet_put_int( remote_id );
					snprintf( sel, sizeof( sel ), "Invalid Number!\x0d\x0a" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
					ret = 1;
				}
			}
		}

        if( !strlen(conn2server_username) && !strlen(conn2server_password) )//null account
		{
				packet_start( SSH2_MSG_CHANNEL_DATA );
				packet_put_int( remote_id );
				char sel[64];
				snprintf( sel, sizeof( sel ), "Input target server username:" );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();

				process_input( cfd, "username" );

				printf( "input username = %s\n", conn2server_username);

				packet_start( SSH2_MSG_CHANNEL_DATA );
				packet_put_int( remote_id );
				bzero( sel, sizeof(sel) );
				snprintf( sel, sizeof( sel ), "Input target server password:" );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();
				process_input( cfd, "password" );

		}

	}
	/* SSH1 */
	else
	{
		int choose;

		if( conn_mode == CONN_GWVPN_SELECT )
		{
			ret = 1;

			//get_ssh_username_password_from_mysql2( radius_username, server_ip );
			while( ret )
			{

				packet_start( SSH_SMSG_STDOUT_DATA );
				char sel[1024];
				snprintf( sel, sizeof( sel ), "Please choose a username:\x0d\x0a" );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();

				for( i = 0; i < snum; i++ )
				{
					packet_start( SSH_SMSG_STDOUT_DATA );
					//char sel[1024];
					snprintf( sel, sizeof( sel ), "[%d]%s\x0d\x0a", i + 1, sinfo[i].dest_username );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
				}

				packet_start( SSH_SMSG_STDOUT_DATA );
				snprintf( sel, sizeof( sel ), "[%d]Exit from this system!\x0d\x0aInput: ", snum + 1 );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();
				choose = process_select_username_input_ssh1( cfd, remote_id );

				if( choose == snum + 1 )
				{
					fatal( "Exit from radius system.\n" );
				}
				else if( choose > 0 && choose <= snum )
				{
					ret = 0;
					did = sinfo[choose-1].devices_id;
					radius_ret = select2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, 3, &conn_mode,
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden );

					if( radius_ret == 0 )
					{
						strcpy( conn2server_saddress, dest_ip );
						conn2server_port = dest_port;
						strcpy( conn2server_username, dest_username );
						strcpy( conn2server_password, dest_password );
					}
					else
					{
						printf( "select 2 authd reply failed. exit. ret=%d\n", radius_ret );
						cleanup_exit( 255 );
					}
				}
				else
				{
					packet_start( SSH_SMSG_STDOUT_DATA );
					snprintf( sel, sizeof( sel ), "Invalid Number!\x0d\x0a" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
					ret = 1;
				}
			}
		}
		else if( conn_mode == CONN_AUDIT_SELECT )
		{
			ret = 1;

			//get_ssh_username_password_from_mysql2( radius_username, server_ip );
			while( ret )
			{
				packet_start( SSH_SMSG_STDOUT_DATA );
				char sel[1024];
				snprintf( sel, sizeof( sel ), "Please choose a username:\x0d\x0a" );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();

				for( i = 0; i < snum; i++ )
				{
					packet_start( SSH_SMSG_STDOUT_DATA );
					//char sel[1024];
					snprintf( sel, sizeof( sel ), "[%d]%-20s%-35s<%s>\x0d\x0a",
							i + 1, sinfo[i].dest_ip, sinfo[i].dest_username, sinfo[i].login_method == 3 ? "ssh" : "telnet" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
				}

				packet_start( SSH_SMSG_STDOUT_DATA );
				snprintf( sel, sizeof( sel ), "[%d]Exit from this system!\x0d\x0aInput: ", snum + 1 );
				packet_put_string( sel, strlen( sel ) );
				packet_send();
				packet_write_wait();
				choose = process_select_username_input_ssh1( cfd, remote_id );

				if( choose == snum + 1 )
				{
					fatal( "Exit from radius system.\n" );
				}
				else if( choose > 0 && choose <= snum )
				{
					ret = 0;
					did = sinfo[choose-1].devices_id;
					radius_ret = select2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, 3, &conn_mode,
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden );

					if( radius_ret == 0 )
					{
						strcpy( conn2server_saddress, dest_ip );
						conn2server_port = dest_port;
						strcpy( conn2server_username, dest_username );
						strcpy( conn2server_password, dest_password );
					}
					else
					{
						printf( "select 2 authd reply failed. exit. ret=%d\n", radius_ret );
						cleanup_exit( 255 );
					}
				}
				else
				{
					packet_start( SSH_SMSG_STDOUT_DATA );
					snprintf( sel, sizeof( sel ), "Invalid Number!\x0d\x0a" );
					packet_put_string( sel, strlen( sel ) );
					packet_send();
					packet_write_wait();
					ret = 1;
				}
			}
		}
	}

	return radius_username;
}

void process_input( int cfd, const char *type )
{
	struct simple_packet spkt;
	char *pt;

	char target_password[512], *ctrl, status, rflag;
	int char_num = 0, j, len, nfd, ret = 1, rchan;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0x07 };
	char ssh1delreply1[] = { 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char ssh1delreply2[] = { 0x00, 0x00, 0x00, 0x01, 0x07 };
	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );
	nfd = cfd + 1;
	memset( &spkt, 0x00, sizeof( spkt ) );

	while( ret )
	{
		FD_ZERO( &readset );
        FD_SET( cfd, &readset );
        nfd = cfd + 1;

		if( select( nfd, &readset, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( cfd, &readset ) )
		{
			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );


				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						packet_get_int();
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH2_MSG_CHANNEL_DATA );
							//if ( remote_id == 256 )
							//crreply[2] = 0x01;
							packet_put_int( REMOTEID( 0 ) );
							packet_put_cstring( "\x0d\x0a" );
							packet_send();
							packet_write_wait();
							target_password[char_num] = '\0';
							if( strcmp( type, "password" ) == 0 )
                                strcpy( conn2server_password, target_password );
                            else
                                strcpy( conn2server_username, target_password );
							char_num = 0;
							ret = 0;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 0;
							packet_start( SSH2_MSG_CHANNEL_DATA );
							packet_put_int( REMOTEID( 0 ) );
							if( strcmp( type, "password" ) == 0 )
                                packet_put_cstring( "\x0d\x0aInput target server password: " );
                            else
                                packet_put_cstring( "\x0d\x0aInput target server username: " );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num--;
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( client_is_putty )
							{
								delreply1[2] = 0x01;
								delreply2[2] = 0x01;
							}

							if( char_num < 0 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 0;
							}
							else
							{
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else
						{
							for( j = 0; j < len; j++ )
							{
								target_password[char_num++] = ctrl[j];
								if( strcmp( type, "password" ) == 0 )
                                    spkt.data[8+j] = '*';
                                else
                                    spkt.data[8+j] = ctrl[j];
							}

							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( client_is_putty )
								spkt.data[2] = 0x01;

							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );
						rchan = packet_get_int();
						packet_start( SSH2_MSG_CHANNEL_OPEN_FAILURE );
						packet_put_int( rchan );
						packet_put_int( 1 );
						packet_put_cstring( "open failed" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
						//memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						packet_get_int();
						packet_get_string( NULL );
						rflag = packet_get_char();

						if( !rflag )
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
					else if( spkt.type == 20 )
					{
						dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
					}
				}
				/*else
				{
					if( spkt.type == SSH_CMSG_STDIN_DATA )
					{
						//char_num++;
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_cstring( "\x0d\x0a" );
							packet_send();
							packet_write_wait();
							target_password[char_num] = '\0';
							//printf( "target_password = %s\n", target_password+4 );
							put_u32( target_password, char_num - 4 );
							writen( sp, target_password, char_num );
							char_num = 4;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 4;
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_cstring( "\x0d\x0aInput target server password: " );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num --;
							packet_start( SSH_SMSG_STDOUT_DATA );

							if( char_num < 4 )
							{
								packet_put_raw( ssh1delreply2, sizeof( ssh1delreply2 ) );
								char_num = 4;
							}
							else
							{
								packet_put_raw( ssh1delreply1, sizeof( ssh1delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else
						{
							for( j = 0; j < len; j++ )
							{
								target_password[char_num++] = ctrl[j];
								spkt.data[4+j] = '*';
							}

							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
				}
*/
				memset( &spkt, 0x00, sizeof( spkt ) );
			}
		}

	}

	return;
}


/*
 * Do the FREESVR-SSH-PROXY
 * We fork and let the child connect to the real target
 * and use a socketpair to send the decrypted data to be transfered
 * between the endpoints.
 * ip and port for route in network byte order.
 */

/* Global Var */

int   last_insert_id[MAXSESSIONNUM];
int   sftp_cmd_cnt[MAXSESSIONNUM];
int   session_channel_mode[MAXSESSIONNUM];
char  *cstr;
char  sstr[32];
/* Global Var */

extern int radius_flag;
extern int original_mode_flag;

void wait_for_target( int cfd, int sp )
{
	struct simple_packet spkt;
	char *pt;

	char target_password[512], *ctrl, status, rflag;
	int char_num = 4, j, len, nfd, ret = 1, rchan;
	char delreply1[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char delreply2[] = { 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x01, 0x07 };
	char ssh1delreply1[] = { 0x00, 0x00, 0x00, 0x04, 0x08, 0x1b, 0x5b, 0x4b };
	char ssh1delreply2[] = { 0x00, 0x00, 0x00, 0x01, 0x07 };
	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );
	FD_SET( sp, &readset );
	nfd = ( cfd > sp ? cfd : sp ) + 1;
	memset( &spkt, 0x00, sizeof( spkt ) );

	while( ret )
	{
		//fd_set readtmp;
		//char spbuf[32];
		//memcpy(&readtmp, &readset, sizeof(readtmp));

		FD_ZERO( &readset );
		FD_SET( cfd, &readset );
		FD_SET( sp, &readset );
		nfd = ( cfd > sp ? cfd : sp ) + 1;

		if( no_shell )
		{
			FD_ZERO( &readset );
			FD_SET( sp, &readset );
			nfd = sp + 1;
		}

		if( select( nfd, &readset, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( sp, &readset ) )
		{
			//bzero(spbuf,sizeof(spbuf));
			//if ( (n = readn(sp[0], spbuf, sizeof(spbuf))) <= 0)
			//break;
			readn( sp, &status, 1 );

			if( status == 0x02 )
			{
				if( compat20 )
				{
					packet_start( SSH2_MSG_CHANNEL_DATA );
					printf( "client is putty %d, %d\n", client_is_putty, REMOTEID( 0 ) );
					packet_put_int( REMOTEID( 0 ) );
					if ( publickey_auth ) packet_put_cstring( "Please input passphrase for Private Key: " );
					else packet_put_cstring( "Target server password error!\x0d\x0aInput target server password: " );
					packet_send();
					packet_write_wait();
				}
				else
				{
					packet_start( SSH_SMSG_STDOUT_DATA );
					packet_put_cstring( "Target server password error!\x0d\x0aInput target server password: " );
					packet_send();
					packet_write_wait();
				}
			}
			else
			{
				ret = 0;
			}
		}

		if( FD_ISSET( cfd, &readset ) )
		{
			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );


				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				//debug("[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type);
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						packet_get_int();
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH2_MSG_CHANNEL_DATA );
							//if ( remote_id == 256 )
							//crreply[2] = 0x01;
							packet_put_int( REMOTEID( 0 ) );
							packet_put_cstring( "\x0d\x0a" );
							packet_send();
							packet_write_wait();
							target_password[char_num] = '\0';
							//printf( "target_password = %s\n", target_password+4 );
							put_u32( target_password, char_num - 4 );
							writen( sp, target_password, char_num );
							char_num = 4;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 4;
							//ret = 0;
							packet_start( SSH2_MSG_CHANNEL_DATA );
							//if ( remote_id == 256 )
							//crreply[2] = 0x01;
							packet_put_int( REMOTEID( 0 ) );
							packet_put_cstring( "\x0d\x0aInput target server password: " );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num--;
							//printf("%d\n", remote_id );
							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( client_is_putty )
							{
								delreply1[2] = 0x01;
								delreply2[2] = 0x01;
							}

							if( char_num < 4 )
							{
								packet_put_raw( delreply2, sizeof( delreply2 ) );
								char_num = 4;
								//ret = 0;
							}
							else
							{
								//ret = ret/10;
								packet_put_raw( delreply1, sizeof( delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else
						{
							for( j = 0; j < len; j++ )
							{
								target_password[char_num++] = ctrl[j];
								spkt.data[8+j] = '*';
							}

							packet_start( SSH2_MSG_CHANNEL_DATA );

							if( client_is_putty )
								spkt.data[2] = 0x01;

							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );
						rchan = packet_get_int();
						packet_start( SSH2_MSG_CHANNEL_OPEN_FAILURE );
						packet_put_int( rchan );
						packet_put_int( 1 );
						packet_put_cstring( "open failed" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
						//memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						memcpy( &mitm_channel_request[mitm_channel_cnt++], &spkt, sizeof( spkt ) );
						packet_get_int();
						packet_get_string( NULL );
						rflag = packet_get_char();

						if( !rflag )
						{
							mitm_channel_reply[mitm_channel_cnt-1] = 0;
						}
					}
					else if( spkt.type == 20 )
					{
						dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
					}
				}
				else
				{
					if( spkt.type == SSH_CMSG_STDIN_DATA )
					{
						//char_num++;
						char *ctrl = packet_get_string( &len );

						if( ctrl[0] == 0x0d )
						{
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_cstring( "\x0d\x0a" );
							packet_send();
							packet_write_wait();
							target_password[char_num] = '\0';
							//printf( "target_password = %s\n", target_password+4 );
							put_u32( target_password, char_num - 4 );
							writen( sp, target_password, char_num );
							char_num = 4;
						}
						else if( ctrl[0] == 0x03 )
						{
							char_num = 4;
							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_cstring( "\x0d\x0aInput target server password: " );
							packet_send();
							packet_write_wait();
						}
						else if( ctrl[0] == 0x08 || ctrl[0] == 0x7f )
						{
							char_num --;
							packet_start( SSH_SMSG_STDOUT_DATA );

							if( char_num < 4 )
							{
								packet_put_raw( ssh1delreply2, sizeof( ssh1delreply2 ) );
								char_num = 4;
							}
							else
							{
								packet_put_raw( ssh1delreply1, sizeof( ssh1delreply1 ) );
							}

							packet_send();
							packet_write_wait();
						}
						else
						{
							for( j = 0; j < len; j++ )
							{
								target_password[char_num++] = ctrl[j];
								spkt.data[4+j] = '*';
							}

							packet_start( SSH_SMSG_STDOUT_DATA );
							packet_put_raw( spkt.data, spkt.len );
							packet_send();
							packet_write_wait();
						}
					}
				}

				memset( &spkt, 0x00, sizeof( spkt ) );
			}
		}

	}

	put_u32( target_password, 1024 );
	writen( sp, target_password, 4 );
	printf( "out of wait!\n" );
	return;
}

int
update_sftp_cmd_cnt(MYSQL *sql_conn, int sid)
{
	char buf[256];

	snprintf(buf, sizeof(buf), "UPDATE sftpsessions SET total_cmd=%d WHERE sid=%d",
			++sftp_cmd_cnt[sid], last_insert_id[sid]);

	mysql_query(sql_conn, buf);
}

	void
mitm_ssh( int cfd )
{
	printf( "entry proxy main func!\n" );

	size_t  socksize;
	struct sockaddr_in sock1;
	socksize = sizeof( sock1 );
	getsockopt( cfd, SOL_IP, SO_ORIGINAL_DST, &sock1, &socksize );
	printf( "ori ip = %s, port = %d, %s\n", inet_ntoa( sock1.sin_addr ), ntohs( sock1.sin_port ), get_local_ipaddr( cfd ) );

	/* Mysql */
	MYSQL_RES *res_ptr;
	MYSQL_ROW  sqlrow;

	if( !original_mode_flag )
	{
		sql_conn = mysql_init( NULL );
		sql_conn = mysql_real_connect( sql_conn, mysql_address, mysql_username, mysql_password, mysql_database, 0, NULL, 0 );

		if( sql_conn )
		{
			printf( "Connect to Mysql success!\n" );
			mysql_query( sql_conn, "set names utf8" );
		}
		else
		{
			printf( "Connect to Mysql fail!\n" );

			if( mysql_errno( sql_conn ) )
			{
				printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
			}
		}
	}

	/* Mysql */

	struct sockaddr_in tgt;
	int sp[2], ret;
	pid_t pid;
	fd_set readset;
	size_t nfd;
	int sock_in, sock_out;
	u_int ssh_proto;
	struct simple_packet spkt;
	ssize_t n;
	int src_data = 0;
	int dst_data = 0;
	FILE *logf = NULL;
	char buf[4096];
	int log_info_response = 0;
	char *info_response_user = NULL;
	char oldt[256], newt[256];

	/* Add */
	char * radius_username = NULL;
	u_int session_id = 0, channel_req_str_len = 0, exec_command_len = 0, subsystem_name_len = 0;
	u_char channel_req_str[STRLENGTH], exec_command[STRLENGTH], subsystem_name[STRLENGTH];
	int client_first_init_flag[MAXSESSIONNUM], server_first_init_flag[MAXSESSIONNUM];
	int new_client_buffer_flag[MAXSESSIONNUM], new_server_buffer_flag[MAXSESSIONNUM];
	int i = 0, index = 0;

	for( i = 0; i < MAXSESSIONNUM; i++ )
	{
		client_first_init_flag[i] = 1;
		server_first_init_flag[i] = 1;
		new_client_buffer_flag[i] = 1;
		new_server_buffer_flag[i] = 1;
	}

	Buffer *server_buf[MAXSESSIONNUM], *client_buf[MAXSESSIONNUM];
	memset( server_buf, 0, sizeof( server_buf ) );
	memset( client_buf, 0, sizeof( client_buf ) );

	u_int  transfer_client_id     [MAXSESSIONNUM], transfer_server_id     [MAXSESSIONNUM];
	u_char command_client_type    [MAXSESSIONNUM], command_server_type    [MAXSESSIONNUM];
	int    copy_client_buffer_size[MAXSESSIONNUM], copy_server_buffer_size[MAXSESSIONNUM];
	int    csp                    [MAXSESSIONNUM], ssp                    [MAXSESSIONNUM];

	int buflen3[MAXSESSIONNUM];
	int log_download_file_flag[MAXSESSIONNUM], log_download_file_data[MAXSESSIONNUM], sftp_log = 0;
	int log_upload_file_flag[MAXSESSIONNUM], backup_upload_file[MAXSESSIONNUM];
	int upload_file_size[MAXSESSIONNUM], download_file_size[MAXSESSIONNUM];
	char backup_download_fn[MAXSESSIONNUM][256], backup_upload_fn[MAXSESSIONNUM][256];
	u_int wr_flag, upload_pflag[MAXSESSIONNUM];
	u_char * data, * filename, *filename_tmp;
	u_int datalen, filename_len;
	char *user;
	char ssh1_user[256];
	u_int64_t offset;

	queue_clear();
	memset( client_buffer_array,  0, sizeof( client_buffer_array ) );
	memset( session_channel_mode, 0, sizeof( session_channel_mode ) );
	memset( last_insert_id,       0, sizeof( last_insert_id ) );
	/* Add */

	sock_in = sock_out = cfd;
	ssh_proto = compat20 ? SSH_PROTO_2 : SSH_PROTO_1;

	signal( SIGCHLD, sighandler );
	signal( SIGUSR1, sighandler );

	/* Add */
	signal( 35, sighandler );
	signal( 36, sighandler );
	signal( 37, sighandler );

	/* Static route */
	memset( &tgt, 0x00, sizeof( tgt ) );

	/* Get real target or use static route */
	if( get_real_target( cfd, &tgt ) != 0 )
	{
		tgt.sin_addr.s_addr = mopt.r_addr;
		tgt.sin_port = mopt.r_port;
	}

	printf( "use_vpn = %d, login_method = %d\n", use_vpn, login_method );

	sourceip = get_remote_ipaddr();
	serverip = inet_ntoa( tgt.sin_addr );

	printf( "sourceip = \"%s\", serverip = \"%s\"\n", sourceip, serverip );

	setproctitle("[%s][%s]->Audit", str_time(time(NULL), NULL), sourceip );

	if( tgt.sin_addr.s_addr == 0 )
		fatal( "Failed to get route for client" );

	logit( "[FREESVR-SSH-PROXY] Routing %s %s:%u -> %s",
			compat20 ? "SSH2" : "SSH1", get_remote_ipaddr(),
			get_remote_port(), net_sockstr( &tgt, 0 ) );

	/* Add radius auth*/
	if( !original_mode_flag && radius_flag == 1 )
	{
		printf( "*****Radius auth start!*****\n" );
		radius_username = radius_Authenticate( cfd, tgt.sin_addr.s_addr );
		printf( "*****Radius auth done!*****\n" );
	}

	printf( "conn_mode = %d, forbidden = %s, did = %d\n", conn_mode, forbidden, did );
	alarm(0);
	printf("Release Login Grace time.\n");
	/* Add radius auth*/

	/* Set up the unencrypted data channel to the client */
	if( socketpair( AF_LOCAL, SOCK_STREAM, 0, sp ) < 0 )
		fatal( "socketpair failed: %s", strerror( errno ) );

	/* Fork off the child that connects to the real target */
	if(( pid = fork() ) < 0 )
		fatal( "fork: %s\n", strerror( errno ) );

	if( pid == 0 )
	{
		/* Close the unused socket */
		close( sp[0] );
		signal( SIGUSR1, SIG_DFL );

		//target_connect(tgt.sin_addr.s_addr, tgt.sin_port, sp[1], ssh_proto);
		if( ( !publickey_auth && !original_mode_flag && radius_flag == 1 ) || ( publickey_auth && use_vpn == 0 ) )
		{
			/*if ( device_table_id != -1 )//method3
			  {
			  target_connect(inet_addr(conn2server_saddress), htons(conn2server_port), sp[1], ssh_proto);
			  }
			  else
			  {
			  target_connect(tgt.sin_addr.s_addr, htons(conn2server_port), sp[1], ssh_proto);
			  }*/
			if( strstr( conn2server_username, sourceip ) != NULL )
			{
				char port_buf[8];
				snprintf( port_buf, sizeof(port_buf), ":%d", get_remote_port() );
				strcat( conn2server_username, port_buf );
			}
			printf( "dest_ip = %s\n", conn2server_saddress );
			printf( "dest_port = %d\n", conn2server_port );
			printf( "dest_username = %s\n", conn2server_username );
			printf( "dest_password = %s\n", conn2server_password );

			target_connect( inet_addr( conn2server_saddress ), htons( conn2server_port ), sp[1], ssh_proto );
		}
		else if ( publickey_auth )
		{
			printf( "dest_port = %d\n", conn2server_port );
			target_connect( tgt.sin_addr.s_addr, htons( conn2server_port ), sp[1], ssh_proto );
		}
		else
		{
			target_connect( tgt.sin_addr.s_addr, tgt.sin_port, sp[1], ssh_proto );
		}

		/* Unreached */
		exit( EXIT_FAILURE );
	}

	/* Close the unused socket */
	close( sp[1] );

	/* Wait for a signal telling us that the connection
	 * is established or terminated. */

	if( !original_mode_flag && radius_flag == 1 ) wait_for_target( cfd, sp[0] );

	while( target_connected == 0 )
		pause();
	//cstr = strdup(net_sockstr_ip(net_inetaddr(get_remote_ipaddr()), htons(get_remote_port()), mopt.resolve));
	cstr = strdup(net_sockstr_ip(net_inetaddr(get_remote_ipaddr()), htons(get_remote_port()), 0));
	//cstr = strdup( get_remote_ipaddr() );
	/*sstr = strdup( net_sockstr( &tgt, mopt.resolve ) );

	  if( device_table_id != -1 ) sstr = conn2server_saddress;*/
	bzero( sstr, sizeof(sstr) );
	snprintf( sstr, sizeof(sstr), "%s:%d", conn2server_saddress, conn2server_port );

	packet_set_interactive( 0 );

	printf( "block_channel_cnt = %d, mitm_channel_cnt = %d\n", block_channel_cnt, mitm_channel_cnt );

	if( !original_mode_flag && compat20 && radius_flag == 1 )
	{
		for( i = block_channel_cnt; i < mitm_channel_cnt; i++ )
		{
			writen( sp[0], &mitm_channel_request[i], mitm_channel_request[i].len + 8 );
		}
	}

	/*if( auto_su && conn_mode < 5  && no_shell == 0 )
	{
		struct simple_packet stmp;
		struct timeval timeout;
		stmp.type = 94;
		char command_buf[32];
		bzero( command_buf, sizeof( command_buf ) );
		snprintf( command_buf, sizeof( command_buf ), "%s\x0d", "super 3" );
		printf("****su %s\n", command_buf);
		stmp.len = strlen(command_buf) + 8;
		put_u32(&stmp.data[0], 0);
		put_u32(&stmp.data[4], strlen(command_buf));
		strcpy(&stmp.data[8], command_buf);
		writen(sp[0], &stmp, stmp.len+8);
		static char echo[4096];
		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sp[0], &readset );

		while( 1 )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 1000 * 1000;
			fd_set readtmp;
			memcpy( &readtmp, &readset, sizeof( readtmp ) );

			if( select( sp[0]+1, &readtmp, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;

				break;
			}
			if( FD_ISSET( sp[0], &readtmp ) )
			{

				debug4( "[FREESVR-SSH-PROXY] Reading spkt header on server side" );

				if(( n = readn( sp[0], &spkt, 8 ) ) <= 0 )
					break;

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug4( "[FREESVR-SSH-PROXY] Reading %u bytes from socketpair on server side", spkt.len );

				if( spkt.len && ( n = readn( sp[0], spkt.data, spkt.len ) ) <= 0 )
					break;

				printf( "Wait for welcome info and su command type = %d ", spkt.type );
				for( i = 0; i < spkt.len; i++ )
				{
					if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
					else printf( "%02x ", ( u_char )spkt.data[i] );
				}

				printf( "\n" );

				debug3("[FREESVR-SSH-PROXY] Got %u bytes from child process", spkt.len);
				packet_start(spkt.type);
				packet_put_raw(spkt.data, spkt.len);
				packet_send();
				packet_write_wait();

				strncat(echo, &spkt.data[8], spkt.len - 8);
				if (strstr(echo, command_buf) != NULL)
				{
					printf("\n\necho: %s\n\n", echo);
					break;
				}
				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		stmp.type = 94;
		snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
		stmp.len = strlen(command_buf) + 8;
		put_u32(&stmp.data[0], 0);
		put_u32(&stmp.data[4], strlen(command_buf));
		strcpy(&stmp.data[8], command_buf);
		writen(sp[0], &stmp, stmp.len+8);
	}

	printf("out of su\n");
*/
	/* Do the FREESVR-SSH-PROXY thing */
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );
	FD_SET( sp[0], &readset );

	/* Max file descriptor */
	nfd = ( cfd > sp[0] ? cfd : sp[0] ) + 1;

	/*perl*/
	int fd1[128], fd2[128], waitforline[128],black_or_white[128],sid[128],g_bytes[128],invim[128],justoutvim[128],encode[128],get_first_prompt[128];
	char * inputcommandline[128],
	* commandline[128],
	* cache1[128],
	* cache2[128],
	* linebuffer[128],
	* sql_query[128],
	* monitor_shell_pipe_name[128],
	* cmd[128],
	* replaycache=malloc(128),
	* logcache=malloc(128),
	* dirname=malloc(32),
	* alarm_content=malloc(string_length),
	myprompt[50][128];

	char sip[32];
	char dip[32];
	char * sport=0;
	char * dport=0;

	bzero(sip,32);
	bzero(dip,32);

	sprintf(sip,"%s",cstr);
	sprintf(dip,"%s",sstr);

	sport = strstr(sip,":");
	dport = strstr(dip,":");

	if(sport!=0)
	{
		* sport = 0;
		sport++;
	}
	else
	{
		sport="0";
	}

	if(dport!=0)
	{
		* dport = 0;
		dport++;
	}
	else
	{
		dport="0";
	}

	char syslogserver[128];
	char syslogfacility[128];
	char mailserver[128];
	char mailaccount[128];
	char mailpassword[128];
	char adminmailaccount[10][128];
	int syslogalarm;
	int mailalarm;
	int adminmailaccount_num=0;

	MYSQL my_connection[128];
	MYSQL_RES *my_res_ptr[128];
	MYSQL_ROW my_sqlrow[128];
	time_t timep;
	struct tm *p;
	struct black_cmd black_cmd_list[50];
	int black_cmd_num;


	bzero(dirname,32);
	bzero(replaycache,128);
	bzero(logcache,128);
	time(&timep);
    p=localtime(&timep);
	sprintf(dirname,"%d-%d-%d",(1900+p->tm_year),(1+p->tm_mon),p->tm_mday);
	sprintf(replaycache,"/opt/freesvr/audit/gateway/log/ssh/replay/%s",dirname);
	sprintf(logcache,"/opt/freesvr/audit/gateway/log/ssh/cache/%s",dirname);

    if(access(replaycache,X_OK)<0)
    {
        if(mkdir(replaycache,0755)==-1)
        {
            printf("mkdir %s\n",replaycache);
            exit(0);
        }
    }

    if(access(logcache,X_OK)<0)
    {
        if(mkdir(logcache,0755)==-1)
        {
            printf("mkdir %s\n",logcache);
            exit(0);
        }
    }

	memset( &spkt, 0x00, sizeof( spkt ) );



	if( !original_mode_flag && radius_flag == 1 && conn_mode < 5 )
	{
		if( compat20 )
		{
			user = conn2server_username;
		}
		else
			strcpy( ssh1_user, conn2server_username );

		for( index = 0; index < mitm_channel_cnt; index++ )
		{
			if( compat20 )
			{
				if( mitm_channel_request[index].len >= 4 )
				{
					memcpy( &session_id, &mitm_channel_request[index].data[0], 4 );
					session_id = ntohl( session_id );
				}

				if( mitm_channel_request[index].type == SSH2_MSG_CHANNEL_REQUEST )
				{
					if( mitm_channel_request[index].len >= 8 )
					{
						memcpy( &channel_req_str_len, &mitm_channel_request[index].data[4], 4 );
						channel_req_str_len = ntohl( channel_req_str_len );

						if( channel_req_str_len <= mitm_channel_request[index].len - 8 && channel_req_str_len < STRLENGTH )
						{
							memcpy( channel_req_str, &mitm_channel_request[index].data[8], channel_req_str_len );
							channel_req_str[channel_req_str_len] = '\0';
							//printf( "\nCHANNEL REQUEST:%s\n", channel_req_str );
						}
					}

					if( strcmp( channel_req_str, "shell" ) == 0 )
					{
						//printf("session_id=%d\n",session_id);
						session_channel_mode[session_id] = SSH_MODE;

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2_MSG_CHANNEL_REQUEST: SSH2 CONNECTION, SESSION ID = %d\n",
								str_time( time( NULL ), NULL ), cstr, sstr, session_id );
						logit( "\n%s", buf );

						char logfilename[256];
						char replayfilename[256];

						get_first_prompt[session_id]=2;
						cmd[session_id]=malloc(sizeof(char)*string_length);
						bzero(cmd[session_id],string_length);

						inputcommandline[session_id]=malloc(sizeof(char)*string_length);
						bzero(inputcommandline[session_id],string_length);

						commandline[session_id]=malloc(sizeof(char)*string_length);
						bzero(commandline[session_id],string_length);

						cache1[session_id]=malloc(sizeof(char)*string_length);
						bzero(cache1[session_id],string_length);

						cache2[session_id]=malloc(sizeof(char)*string_length);
						bzero(cache2[session_id],string_length);

						linebuffer[session_id]=malloc(sizeof(char)*string_length);
						bzero(linebuffer[session_id],string_length);

						sql_query[session_id]=malloc(sizeof(char)*string_length);
						bzero(sql_query[session_id],string_length);


						time(&timep);
						p=localtime(&timep);

						sprintf(logfilename,"%s/ssh_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
						sprintf(replayfilename,"%s/ssh_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

						monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
						sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.0", BINPATH, getpid());

						black_or_white[session_id] = 0;

                        mysql_init(&my_connection[session_id]);
                        if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
                        {
                            //printf("Connection DB success\n");
                        }
                        else
                        {
                            printf("Connect DB Fail\n");
                        }

						if(strlen(forbidden)>0)
						{
							printf("\n\n\n\n\nhere1\n\n\n\n");
							get_pcre(forbidden,black_cmd_list,&black_cmd_num,&(my_connection[session_id]),my_res_ptr[session_id],my_sqlrow[session_id],&(black_or_white[session_id]),sql_query[session_id]);
							printf("black_or_white=%d\n",black_or_white[session_id]);
						}

						fd1[session_id] = open( logfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);
						fd2[session_id] = open( replayfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);

						sprintf(replayfilename,"%s/\\\"ssh_replay_%d_%d_%d_%d_%d_%d_%d\\\"",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
						waitforline[session_id] = 0;
						sid[session_id] = 0;
						g_bytes[session_id] = 0;
						invim[session_id] = 0;
						justoutvim[session_id] = 0;

						if( fd1[session_id] < 0 )
						{
							//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
							perror( logfilename );
							exit( -1 );
						}

						if( fd2[session_id] < 0 )
						{
							//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
							perror( replayfilename );
							exit( -1 );
						}


						bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"insert into sessions  (sid,cli_addr,addr,type,user,start,end,luser,logfile,replayfile,s_bytes,server_addr,dangerous,jump_total,total_cmd,pid,sport,dport)  values (NULL,'%s','%s','ssh','%s',now(),now(),'%s','%s','%s',0,'%s',0,0,0,%d,'%s','%s')",sip,dip,user,radius_username,logfilename,replayfilename,audit_address,getpid(),sport,dport);
						if(mysql_query(&my_connection[session_id],sql_query[session_id]))
						{
							printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
							exit(0);
						}

						bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"select last_insert_id()");
						if(mysql_query(&my_connection[session_id],sql_query[session_id]))
						{
							printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
							exit(0);
						}
						my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
						if(my_res_ptr[session_id])
						{
							while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
							{
								sid[session_id]=atoi(my_sqlrow[session_id][0]);
							}
						}
						else
						{
							exit(0);
						}

                        if(mysql_query(&my_connection[session_id],"set NAMES utf8"))
                        {
                            printf("set utf8 err:%s\n", mysql_error(&my_connection));
                            exit(0);
                        }

                            mysql_query(&my_connection[session_id],"show variables like 'character%'");
                            my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

                            if(my_res_ptr[session_id])
                            {
                                while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
                                {
                                    printf("1 %s,%s\n",my_sqlrow[session_id][0],my_sqlrow[session_id][1]);
                                }
                            }


							bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"select encoding from devices where id=%d",did);
						mysql_query(&my_connection[session_id],sql_query[session_id]);
						my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

						encode[session_id]=1;

						if(my_res_ptr[session_id])
						{
							while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
							{
								encode[session_id]=atoi(my_sqlrow[session_id][0]);
							}
						}

						printf("sql1=%s\n",sql_query[session_id]);
						printf("encode=%d\n",encode[session_id]);

						for(int i=0;i<50;i++)
						{
							bzero(myprompt[i],128);
						}

						bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"select prompt from device_prompts where device_id=%d",did);
						mysql_query(&my_connection[session_id],sql_query[session_id]);
						my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

						printf("1\n");
						if(my_res_ptr[session_id])
						{
							int j=0;
							while((my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id])) && j<50)
							{
								strcpy(myprompt[j],my_sqlrow[session_id][0]);
								j++;
							}
						}
						printf("2\n");

						bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"select MailServer,account,password,syslogserver,syslog_facility,Mail_Alarm,syslog_Alarm from alarm");
						int res=mysql_query(&my_connection[session_id],sql_query[session_id]);

						if(res)
						{
							printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
							exit(0);
						}

						my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
						if(my_res_ptr[session_id])
						{
							while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
							{
								strcpy(mailserver,my_sqlrow[session_id][0]);
								strcpy(mailaccount,my_sqlrow[session_id][1]);
								strcpy(mailpassword,my_sqlrow[session_id][2]);
								strcpy(syslogserver,my_sqlrow[session_id][3]);
								strcpy(syslogfacility,my_sqlrow[session_id][4]);
								mailalarm=atoi(my_sqlrow[session_id][5]);
								syslogalarm=atoi(my_sqlrow[session_id][6]);
							}
						}
						else
						{
							printf("select MailServer,account,password,syslogserver,syslog_facility,Mail_Alarm,syslog_Alarm from alarm sql_err\n");
							exit(0);
						}


						bzero(sql_query[session_id],string_length);
						sprintf(sql_query[session_id],"select email from member where level=1 and email!=''");
						res=mysql_query(&my_connection[session_id],sql_query[session_id]);
						if(res)
						{
							printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
							exit(0);
						}

						my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
						if(my_res_ptr[session_id])
						{
							while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
							{
								strcpy(adminmailaccount[adminmailaccount_num],my_sqlrow[session_id][0]);
								adminmailaccount_num++;
							}
						}
						else
						{
							printf("select email from member where level=1 and email!=''\nresult err\n");
							exit(0);
						}
						printf("mailserver=%s\nmailaccount=%s\nmailpassword=%s\nsyslogserver=%s\nsyslogfacility=%s\nmailalarm=%d\nsyslogalarm=%d\nadminmailaccount=%s\nadminmailaccount_num=%d\n",mailserver,mailaccount,mailpassword,syslogserver,syslogfacility,mailalarm,syslogalarm,adminmailaccount[0],adminmailaccount_num);

					}
					else if( strcmp( channel_req_str, "exec" ) == 0 )
					{
						memcpy( &exec_command_len, &mitm_channel_request[index].data[8+channel_req_str_len+1], 4 );
						exec_command_len = ntohl( exec_command_len );
						memcpy( exec_command, &mitm_channel_request[index].data[8+channel_req_str_len+5], exec_command_len );
						exec_command[exec_command_len] = '\0';

						//printf( "%s\n", exec_command );
						if( exec_command[0] == 's' && exec_command[1] == 'c' && exec_command[2] == 'p' )
						{
							session_channel_mode[session_id] == SCP_MODE;
							fprintf(stderr, "THIS IS SCP!!!!!!!!!\n");
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_CHANNEL_REQUEST: %s\n",
									str_time( time( NULL ), NULL ), cstr, sstr, exec_command );
							logit( "\n%s", buf );
						}
					}
					else if( strcmp( channel_req_str, "subsystem" ) == 0 ) //( spkt.data[spkt.len-1] == 'p' )
					{
						memcpy( &subsystem_name_len, &mitm_channel_request[index].data[8+channel_req_str_len+1], 4 );
						subsystem_name_len = ntohl( subsystem_name_len );
						//if ( subsystem_name_len <= spkt.len - 9 - channel_req_str_len && subsystem_name_len < STRLENGTH )
						memcpy( subsystem_name, &mitm_channel_request[index].data[8+channel_req_str_len+5], subsystem_name_len );
						subsystem_name[subsystem_name_len] = '\0';
						//printf( "%s\n", subsystem_name );

						if( strcmp( subsystem_name, "sftp" ) == 0 )
						{
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_CHANNEL_REQUEST: SFTP\n",
									str_time( time( NULL ), NULL ), cstr, sstr );
							logit( "\n%s", buf );

							session_channel_mode[session_id] = SFTP_MODE;

							if (fetch_sftp_flag(sql_conn, did) == 0) fatal("sftp flag is 0, devices id is %d\n", did);

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
										VALUES('%s','%s','%s','%s','%s',now())",
										cstr, sstr, audit_address, radius_username, user );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
									{
										res_ptr = mysql_use_result( sql_conn );

										if( res_ptr )
										{
											while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
											{
												last_insert_id[session_id] = atoi( sqlrow[0] );
											}
										}
									}
									else
									{
										if( mysql_errno( sql_conn ) )
										{
											printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
										}
									}
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
				}
			}
			else
			{
				strcpy( ssh1_user, conn2server_username );

				if( mitm_channel_request[index].type == SSH_CMSG_EXEC_SHELL )
				{
					//channel_mode = SSH_MODE;
					session_channel_mode[0] = SSH_MODE;

					snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
							"SSH1_CMSG_EXEC_SHELL: SSH1\n",
							str_time( time( NULL ), NULL ), cstr, sstr );
					logit( "\n%s", buf );

					/* fork perl ssh1 */

					char logfilename[256];
					char replayfilename[256];
					get_first_prompt[session_id]=2;


					cmd[session_id]=malloc(sizeof(char)*string_length);
					bzero(cmd[session_id],string_length);

					inputcommandline[session_id]=malloc(sizeof(char)*string_length);
					bzero(inputcommandline[session_id],string_length);

					commandline[session_id]=malloc(sizeof(char)*string_length);
					bzero(commandline[session_id],string_length);

					cache1[session_id]=malloc(sizeof(char)*string_length);
					bzero(cache1[session_id],string_length);

					cache2[session_id]=malloc(sizeof(char)*string_length);
					bzero(cache2[session_id],string_length);

					linebuffer[session_id]=malloc(sizeof(char)*string_length);
					bzero(linebuffer[session_id],string_length);

					sql_query[session_id]=malloc(sizeof(char)*string_length);
					bzero(sql_query[session_id],string_length);


					time(&timep);
					p=localtime(&timep);

					sprintf(logfilename,"%s/ssh_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
					sprintf(replayfilename,"%s/ssh_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

					monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
					bzero(monitor_shell_pipe_name[session_id],string_length);

					sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.0", BINPATH, getpid());

					black_or_white[session_id] = 0;

					mysql_init(&my_connection[session_id]);
					if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
					{
						//printf("Connection DB success\n");
					}
					else
					{
						printf("Connect DB Fail\n");
					}

					mysql_query(&my_connection[session_id],"set NAMES utf8");

					if(strlen(forbidden)>0)
					{
						printf("\n\n\n\n\nhere2\n\n\n\n");
						get_pcre(forbidden,black_cmd_list,&black_cmd_num,&my_connection[session_id],my_res_ptr[session_id],&my_sqlrow[session_id],& black_or_white[session_id],sql_query[session_id]);
						printf("black_or_white=%d\n",black_or_white[session_id]);
					}

					fd1[session_id] = open( logfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);
					fd2[session_id] = open( replayfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);

					sprintf(replayfilename,"%s/\\\"ssh_replay_%d_%d_%d_%d_%d_%d_%d\\\"",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
					waitforline[session_id] = 0;
					sid[session_id] = 0;
					g_bytes[session_id] = 0;
					invim[session_id] = 0;
					justoutvim[session_id] = 0;

					if( fd1[session_id] < 0 )
					{
						//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
						perror( logfilename );
						exit( -1 );
					}

					if( fd2[session_id] < 0 )
					{
						//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
						perror( replayfilename );
						exit( -1 );
					}

					bzero(sql_query[session_id],string_length);
					sprintf(sql_query[session_id],"insert into sessions  (sid,cli_addr,addr,type,user,start,end,luser,logfile,replayfile,s_bytes,server_addr,dangerous,jump_total,total_cmd,pid,sport,dport)  values (NULL,'%s','%s','ssh','%s',now(),now(),'%s','%s','%s',0,'%s',0,0,0,%d,'%s','%s')",sip,dip,user,radius_username,logfilename,replayfilename,audit_address,getpid(),sport,dport);
					if(mysql_query(&my_connection[session_id],sql_query[session_id]))
					{
						printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
						exit(0);
					}
					bzero(sql_query[session_id],string_length);
					sprintf(sql_query[session_id],"select last_insert_id()");
					if(mysql_query(&my_connection[session_id],sql_query[session_id]))
					{
						printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
						exit(0);
					}
					my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
					if(my_res_ptr[session_id])
					{
						while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
						{
							sid[session_id]=atoi(my_sqlrow[session_id][0]);
						}
					}
					else
					{
						exit(0);
					}

                        if(mysql_query(&my_connection[session_id],"set NAMES utf8"))
                        {
                            printf("set utf8 err:%s\n", mysql_error(&my_connection));
                            exit(0);
                        }

                            mysql_query(&my_connection[session_id],"show variables like 'character%'");
                            my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

                            if(my_res_ptr[session_id])
                            {
                                while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
                                {
                                    printf("2 %s,%s\n",my_sqlrow[session_id][0],my_sqlrow[session_id][1]);
                                }
                            }

					bzero(sql_query[session_id],string_length);
					sprintf(sql_query[session_id],"select encoding from devices where id=%d",did);
					mysql_query(&my_connection[session_id],sql_query[session_id]);
					my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

					encode[session_id]=1;
					if(my_res_ptr[session_id])
					{
						while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
						{
							encode[session_id]=atoi(my_sqlrow[session_id][0]);
						}
					}

                        printf("sql2=%s\n",sql_query[session_id]);
                        printf("encode=%d\n",encode[session_id]);

                        for(int i=0;i<50;i++)
                        {
                            bzero(myprompt[i],128);
                        }

                        bzero(sql_query[session_id],string_length);
                        sprintf(sql_query[session_id],"select prompt from device_prompts where device_id=%d",did);
                        mysql_query(&my_connection[session_id],sql_query[session_id]);
                        my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

                        if(my_res_ptr[session_id])
                        {
                            int j=0;
                            while((my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id])) && j<50)
                            {
                                strcpy(myprompt[j],my_sqlrow[session_id][0]);
                                j++;
                            }
                        }
				}

				if( mitm_channel_request[index].type == SSH_CMSG_EXEC_CMD )
				{
					if( strcmp( &mitm_channel_request[index].data[4], "/usr/local/libexec/sftp-server" ) == 0 )
					{
						//channel_mode
						session_channel_mode[0] = SFTP_MODE;

							if (fetch_sftp_flag(sql_conn, did) == 0) fatal("sftp flag is 0, devices id is %d\n", did);
						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
									VALUES('%s','%s','%s','%s','%s',now())",
									cstr, sstr, audit_address, radius_username, ssh1_user );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
								{
									res_ptr = mysql_use_result( sql_conn );

									if( res_ptr )
									{
										while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
										{
											last_insert_id[0] = atoi( sqlrow[0] );
										}
									}
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}
			}

		}
	}

	if( conn_mode >= 5 ) original_mode_flag = 1;

	/* Check alive var */
	int select_ret = -1, check_flag = 0, keepalive_cnt = 0;
	struct timeval check_client_alive_timeout;
	extern int check_client_alive_interval;

	struct simple_packet forward2server_packet, forward2client_packet;
	int forward2server_flag = 0, forward2client_flag = 0;

	if( check_client_alive_interval == -1 ) check_client_alive_interval = 180;

	printf( "Proxy check client alive interval is %d seconds.\n", check_client_alive_interval );

	if( radius_username != NULL ) strcpy( radius__username, radius_username );

	if( auto_su && conn_mode < 5  && no_shell == 0 )
	{
		struct simple_packet stmp;
		struct timeval timeout;
		stmp.type = 94;
		char command_buf[32];
		static char echo[4096];
loop:
		bzero( command_buf, sizeof( command_buf ) );
		snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_command);
		printf("****su %s\n", command_buf);
		stmp.len = strlen(command_buf) + 8;
		put_u32(&stmp.data[0], 0);
		put_u32(&stmp.data[4], strlen(command_buf));
		strcpy(&stmp.data[8], command_buf);
		writen(sp[0], &stmp, stmp.len+8);
		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sp[0], &readset );

		while( 1 )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 1000 * 1000;
			fd_set readtmp;
			memcpy( &readtmp, &readset, sizeof( readtmp ) );

			if( select( sp[0]+1, &readtmp, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;
				printf("time out!!!\n");
				goto loop;
				break;
			}
			if( FD_ISSET( sp[0], &readtmp ) )
			{

				debug4( "[FREESVR-SSH-PROXY] Reading spkt header on server side" );

				if(( n = readn( sp[0], &spkt, 8 ) ) <= 0 )
					break;

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug4( "[FREESVR-SSH-PROXY] Reading %u bytes from socketpair on server side", spkt.len );

				if( spkt.len && ( n = readn( sp[0], spkt.data, spkt.len ) ) <= 0 )
					break;

				printf( "Wait for welcome info and su command type = %d ", spkt.type );
				for( i = 0; i < spkt.len; i++ )
				{
					if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
					else printf( "%02x ", ( u_char )spkt.data[i] );
				}

				printf( "\n" );

				debug3("[FREESVR-SSH-PROXY] Got %u bytes from child process", spkt.len);
				packet_start(spkt.type);
				packet_put_raw(spkt.data, spkt.len);
				packet_send();
				packet_write_wait();

				strncat(echo, &spkt.data[8], spkt.len - 8);
				if (strstr(echo, command_buf) != NULL &&
						(strcasestr(echo, "password") != NULL ||
						 strstr(echo, "\xe5\x8f\xa3\xe4\xbb\xa4\xef\xbc") != NULL) ||
						 strstr(echo, "\xe5\xaf\x86\xe7\xa0\x81\xef\xbc") != NULL)
				{
					printf("\n\necho: %s\n\n", echo);
					break;
				}
				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		stmp.type = 94;
		snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
		stmp.len = strlen(command_buf) + 8;
		put_u32(&stmp.data[0], 0);
		put_u32(&stmp.data[4], strlen(command_buf));
		strcpy(&stmp.data[8], command_buf);
		writen(sp[0], &stmp, stmp.len+8);
	}

	printf("out of su\n");

/* Do the FREESVR-SSH-PROXY thing */
	FD_ZERO( &readset );
	FD_SET( cfd, &readset );
	FD_SET( sp[0], &readset );

	/* Max file descriptor */
	nfd = ( cfd > sp[0] ? cfd : sp[0] ) + 1;

	for( ;; )
	{
		char *pt;

		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		debug( "[FREESVR-SSH-PROXY] Selecting on server side %d", getpid() );

		if( check_flag )
		{
			check_client_alive_timeout.tv_sec  = 3;
			check_client_alive_timeout.tv_usec = 0;
		}
		else
		{
			check_client_alive_timeout.tv_sec  = check_client_alive_interval;
			check_client_alive_timeout.tv_usec = 0;
		}

		if(( select_ret = select( nfd, &readtmp, NULL, NULL, &check_client_alive_timeout ) ) <= 0 )
		{
			if( select_ret == 0 )
			{
				if( compat20 )
				{
					/* Check alive to client */
					if( ++keepalive_cnt > 3 )
						cleanup_exit( 255 );

					/* Send check message */
					packet_start( SSH2_MSG_GLOBAL_REQUEST );
					packet_put_cstring( "keepalive@openssh.com" );
					packet_put_char( 1 );
					packet_send();
					packet_write_wait();

					check_flag = 1;

					printf( "Send check alive message to client. @ %s\n", str_time( time( NULL ), NULL ) );
					/* Check alive to client */
				}

				continue;
			}

			if( errno == EINTR )
				continue;

			break;
		}

		/* Read from client and write to socketpair */
		/* Log the stream of client */
		if( FD_ISSET( cfd, &readtmp ) )
		{
			debug( "[FREESVR-SSH-PROXY] Reading from client on server side %d", getpid() );

			while(( spkt.type = packet_read_next( cfd ) ) != SSH_MSG_NONE )
			{
				pt = ( char * )packet_get_raw(( int * )&spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from client [type %u]", spkt.len, spkt.type );
				memcpy( spkt.data, pt, spkt.len );

				if( compat20 )
				{
					if( spkt.type == 20 || spkt.type == 30 || spkt.type == 31 || spkt.type == 32 ||
							spkt.type == 21 || spkt.type == 33 || spkt.type == 34 )
					{
						if( spkt.type == 20 )
						{
							dispatch_run2( DISPATCH_NONBLOCK, NULL, xxx_kex, pt, spkt.len );
						}
					}
					/* Check alive */
					else if( spkt.type == 82 || spkt.type == 81 )
					{
						printf( "Recv echo from client, keep alive. @ %s\n", str_time( time( NULL ), NULL ) );
						keepalive_cnt = 0;
						check_flag = 0;
					}
					else
					{
						//if (writen(sp[0], &spkt, spkt.len+8) != spkt.len+8)
						//break;

						memset( &forward2server_packet, 0x00,  spkt.len + 8 );
						memcpy( &forward2server_packet, &spkt, spkt.len + 8 );
						forward2server_flag = 1;
					}
				}
				else
				{
					//if (writen(sp[0], &spkt, spkt.len+8) != spkt.len+8)
					//break;
					memset( &forward2server_packet, 0x00,  spkt.len + 8 );
					memcpy( &forward2server_packet, &spkt, spkt.len + 8 );
					forward2server_flag = 1;
				}

				/* Log SSH2 data */
				if( compat20 )
				{
					if( spkt.len >= 4 )
					{
						memcpy( &session_id, &spkt.data[0], 4 );
						session_id = ntohl( session_id );
					}

					//printf( "Session id = %d\n", session_id );
					if( show_stream )
					{
						printf( "client@%d session=%d type=%d  %d: ", getpid(), session_id, spkt.type, spkt.len );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else
								printf( " %02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );
					}

					//if ( spkt.type != 94 && spkt.type != 93 )
					//                    {
					//                    printf("client type=%d  %d: ",spkt.type, spkt.len);
					//                    for ( i = 0; i < spkt.len; i++ )
					//                    {
					//                        printf( "%02x ", (u_char)spkt.data[i] );
					//                    }
					//                    printf("\n");
					//                    }

					/* Judge this connection is ssh or scp or sftp */
					if( spkt.type == SSH2_MSG_CHANNEL_OPEN )
					{
						packet_get_string( NULL );

						if( packet_get_int() == 256 )
							client_is_putty = 1;
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_REQUEST )
					{
						if( spkt.len >= 8 )
						{
							memcpy( &channel_req_str_len, &spkt.data[4], 4 );
							channel_req_str_len = ntohl( channel_req_str_len );

							if( channel_req_str_len <= spkt.len - 8 && channel_req_str_len < STRLENGTH )
							{
								memcpy( channel_req_str, &spkt.data[8], channel_req_str_len );
								channel_req_str[channel_req_str_len] = '\0';
								printf( "\nCHANNEL REQUEST:%s\n", channel_req_str );
							}
						}

						if( strcmp( channel_req_str, "shell" ) == 0 )
						{
							session_channel_mode[session_id] = SSH_MODE;

							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_CHANNEL_REQUEST: SSH2 CONNECTION, SESSION ID = %d\n",
									str_time( time( NULL ), NULL ), cstr, sstr, session_id );
							logit( "\n%s", buf );

							/* fork perl ssh2*/
							if( !original_mode_flag )
							{
                                char logfilename[256];
                                char replayfilename[256];
								get_first_prompt[session_id]=2;


								cmd[session_id]=malloc(sizeof(char)*string_length);
								bzero(cmd[session_id],string_length);

								inputcommandline[session_id]=malloc(sizeof(char)*string_length);
								bzero(inputcommandline[session_id],string_length);

								commandline[session_id]=malloc(sizeof(char)*string_length);
								bzero(commandline[session_id],string_length);

								cache1[session_id]=malloc(sizeof(char)*string_length);
								bzero(cache1[session_id],string_length);

								cache2[session_id]=malloc(sizeof(char)*string_length);
								bzero(cache2[session_id],string_length);

								linebuffer[session_id]=malloc(sizeof(char)*string_length);
								bzero(linebuffer[session_id],string_length);

								sql_query[session_id]=malloc(sizeof(char)*string_length);
								bzero(sql_query[session_id],string_length);

								time(&timep);
								p=localtime(&timep);

                                sprintf(logfilename,"%s/ssh_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
                                sprintf(replayfilename,"%s/ssh_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

                                monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
                                sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.0", BINPATH, getpid());

								black_or_white[session_id] = 0;


								mysql_init(&my_connection[session_id]);
								if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
								{
									//printf("Connection DB success\n");
								}
								else
								{
									printf("Connect DB Fail\n");
								}

								mysql_query(&my_connection[session_id],"set NAMES utf8");

                                if(strlen(forbidden)>0)
                                {
									printf("\n\n\n\n\nhere3\n\n\n\n");
                                    get_pcre(forbidden,black_cmd_list,&black_cmd_num,&my_connection[session_id],my_res_ptr[session_id],&my_sqlrow[session_id],& black_or_white[session_id],sql_query[session_id]);
									printf("black_or_white=%d\n",black_or_white[session_id]);
                                }

                                fd1[session_id] = open( logfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);
                                fd2[session_id] = open( replayfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);
								sprintf(replayfilename,"%s/\\\"ssh_replay_%d_%d_%d_%d_%d_%d_%d\\\"",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
								waitforline[session_id] = 0;
								sid[session_id] = 0;
								g_bytes[session_id] = 0;
								invim[session_id] = 0;
								justoutvim[session_id] = 0;

                                if( fd1[session_id] < 0 )
                                {
                                    //  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
                                    perror( logfilename );
                                    exit( -1 );
                                }

                                if( fd2[session_id] < 0 )
                                {
                                    //  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
                                    perror( replayfilename );
                                    exit( -1 );
                                }

								bzero(sql_query[session_id],string_length);
								sprintf(sql_query[session_id],"insert into sessions  (sid,cli_addr,addr,type,user,start,end,luser,logfile,replayfile,s_bytes,server_addr,dangerous,jump_total,total_cmd,pid,sport,dport)  values (NULL,'%s','%s','ssh','%s',now(),now(),'%s','%s','%s',0,'%s',0,0,0,%d,'%s','%s')",sip,dip,user,radius_username,logfilename,replayfilename,audit_address,getpid(),sport,dport);
                                if(mysql_query(&my_connection[session_id],sql_query[session_id]))
                                {
                                    printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
                                    exit(0);
                                }
                                bzero(sql_query[session_id],string_length);
                                sprintf(sql_query[session_id],"select last_insert_id()");
                                if(mysql_query(&my_connection[session_id],sql_query[session_id]))
                                {
                                    printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
                                    exit(0);
                                }
                                my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
                                if(my_res_ptr[session_id])
                                {
                                    while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
                                    {
                                        sid[session_id]=atoi(my_sqlrow[session_id][0]);
                                    }
                                }
                                else
                                {
                                    exit(0);
                                }

                        if(mysql_query(&my_connection[session_id],"set NAMES utf8"))
                        {
                            printf("set utf8 err:%s\n", mysql_error(&my_connection));
                            exit(0);
                        }

                            mysql_query(&my_connection[session_id],"show variables like 'character%'");
                            my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

                            if(my_res_ptr[session_id])
                            {
                                while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
                                {
                                    printf("3 %s,%s\n",my_sqlrow[session_id][0],my_sqlrow[session_id][1]);
                                }
                            }

								bzero(sql_query[session_id],string_length);
								sprintf(sql_query[session_id],"select encoding from devices where id=%d",did);
								mysql_query(&my_connection[session_id],sql_query[session_id]);
								my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

								encode[session_id]=1;

								if(my_res_ptr[session_id])
								{
									while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
									{
										encode[session_id]=atoi(my_sqlrow[session_id][0]);
									}
								}

                        printf("sql3=%s\n",sql_query[session_id]);
                        printf("encode=%d\n",encode[session_id]);

								for(int i=0;i<50;i++)
								{
									bzero(myprompt[i],128);
								}

								bzero(sql_query[session_id],string_length);
								sprintf(sql_query[session_id],"select prompt from device_prompts where device_id=%d",did);
								mysql_query(&my_connection[session_id],sql_query[session_id]);
								my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

								if(my_res_ptr[session_id])
								{
									int j=0;
									while((my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id])) && j<50)
									{
										strcpy(myprompt[j],my_sqlrow[session_id][0]);
										j++;
									}
								}
							}
						}
						else if( strcmp( channel_req_str, "exec" ) == 0 )
						{
							memcpy( &exec_command_len, &spkt.data[8+channel_req_str_len+1], 4 );
							exec_command_len = ntohl( exec_command_len );
							memcpy( exec_command, &spkt.data[8+channel_req_str_len+5], exec_command_len );
							exec_command[exec_command_len] = '\0';
							printf( "%s\n", exec_command );

							if( exec_command[0] == 's' && exec_command[1] == 'c' && exec_command[2] == 'p' )
							{
								session_channel_mode[session_id] == SCP_MODE;

							fprintf(stderr, "THIS IS SCP!!!!!!!!!\n");
								snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
										"SSH2_MSG_CHANNEL_REQUEST: %s\n",
										str_time( time( NULL ), NULL ), cstr, sstr, exec_command );
								logit( "\n%s", buf );
							}
						}
						else if( strcmp( channel_req_str, "subsystem" ) == 0 ) //( spkt.data[spkt.len-1] == 'p' )
						{
							memcpy( &subsystem_name_len, &spkt.data[8+channel_req_str_len+1], 4 );
							subsystem_name_len = ntohl( subsystem_name_len );
							//if ( subsystem_name_len <= spkt.len - 9 - channel_req_str_len && subsystem_name_len < STRLENGTH )
							memcpy( subsystem_name, &spkt.data[8+channel_req_str_len+5], subsystem_name_len );
							subsystem_name[subsystem_name_len] = '\0';
							printf( "%s\n", subsystem_name );

							if( strcmp( subsystem_name, "sftp" ) == 0 )
							{
								snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
										"SSH2_MSG_CHANNEL_REQUEST: SFTP\n",
										str_time( time( NULL ), NULL ), cstr, sstr );
								logit( "\n%s", buf );

								session_channel_mode[session_id] = SFTP_MODE;

							if (fetch_sftp_flag(sql_conn, did) == 0) fatal("sftp flag is 0, devices id is %d\n", did);
								if( sql_conn )
								{
									snprintf( buf, sizeof( buf ),
											"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
											VALUES('%s','%s','%s','%s','%s',now())",
											cstr, sstr, audit_address, radius_username, user );

									/* Insert success */
									if( !mysql_query( sql_conn, buf ) )
									{
										if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
										{
											res_ptr = mysql_use_result( sql_conn );

											if( res_ptr )
											{
												while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
												{
													last_insert_id[session_id] = atoi( sqlrow[0] );
												}
											}
										}
										else
										{
											if( mysql_errno( sql_conn ) )
											{
												printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
											}
										}
									}
									else
									{
										if( mysql_errno( sql_conn ) )
										{
											printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
										}
									}
								}
							}
						}
					}
					else if( spkt.type == SSH2_MSG_CHANNEL_CLOSE )
					{
						if( session_channel_mode[session_id] == SSH_MODE )
						{
							session_channel_mode[session_id] = 0;
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2 EXIT!! SESSION ID = %d\n",
									str_time( time( NULL ), NULL ), cstr, sstr, session_id );
							logit( "\n%s", buf );

							/* kill perl ssh2*/
							if( !original_mode_flag )
							{
								close( fd1[session_id] );
								close( fd2[session_id] );
								mysql_close( &my_connection[session_id] );
								free( inputcommandline[session_id] );
								free( commandline[session_id] );
							}
						}

						if( session_channel_mode[session_id] == SFTP_MODE )
						{
							session_channel_mode[session_id] = 0;

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"UPDATE sftpsessions SET end=now() WHERE sid=%d",
										last_insert_id[session_id] );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									printf( "Mysql insert \"update\" command log success!\n" );
									last_insert_id[session_id] = 0;
									sftp_cmd_cnt[session_id] = 0;
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_REQUEST )
					{
						user = packet_get_string( NULL );
						char *service = packet_get_string( NULL );
						char *method = packet_get_string( NULL );

						debug2( "[FREESVR-SSH-PROXY] %s -> %s SSH2_MSG_USERAUTH_REQUEST: %s %s %s",
								cstr, sstr, user, service, method );

						if( strcmp( method, "password" ) == 0 )
						{
							char c = packet_get_char();
							char *pass = packet_get_string( NULL );

							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
									"SSH2_MSG_USERAUTH_REQUEST: %s %s %s %d %s\n",
									str_time( time( NULL ), NULL ), cstr, sstr,
									user, service, method, c, pass );
							logit( "\n%s", buf );

							if( logf != NULL )
							{
								fprintf( logf, "%s\n", buf );
								fflush( logf );
							}
						}

						if( strcmp( method, "keyboard-interactive" ) == 0 )
						{
							log_info_response = 1;
							info_response_user = strdup( user );
						}
					}
					else if( log_info_response && spkt.type == SSH2_MSG_USERAUTH_INFO_RESPONSE )
					{
						u_int a = packet_get_int();
						char *pass = packet_get_string( NULL );

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2_MSG_USERAUTH_INFO_RESPONSE: (%s) %s\n",
								str_time( time( NULL ), NULL ), cstr, sstr,
								info_response_user, pass );

						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}

						log_info_response = 0;

						if( info_response_user )
						{
							free( info_response_user );
							info_response_user = NULL;
						}
					}

					/* Log the stream from client */
					else if( spkt.type == SSH2_MSG_CHANNEL_DATA )
					{
						//                        if ((src_data > 0) && (spkt.len >= 8))
						//                            writen(src_data, &spkt.data[8], spkt.len-8);
						if( conn_mode == 5 )
						{
							ret = jump_scan_command( &spkt.data[8], spkt.len - 8, radius__username, sourceip, cfd, sp[0], client_is_putty ? 256 :0, session_id, &forward2server_packet );
						}

						if( session_channel_mode[session_id] == SSH_MODE )
						{
							/* auto jump */
							ret = jump_scan_command( &spkt.data[8], spkt.len - 8, radius__username, sourceip, cfd, sp[0], client_is_putty ? 256 :0, session_id, &forward2server_packet );

							/* write to perl ssh2 client */
							if( !original_mode_flag )
							{
					telnet_writelogfile2( &forward2server_packet.data[8], forward2server_packet.len - 8, monitor_shell_pipe_name[session_id],
                        fd1[session_id], fd2[session_id], inputcommandline[session_id], commandline[session_id],
						cache1[session_id], cache2[session_id], linebuffer[session_id], cmd[session_id], sql_query[session_id], myprompt,
                        black_cmd_list, black_cmd_num, sid[session_id],
						&waitforline[session_id] , &g_bytes[session_id] , &invim[session_id], session_id, black_or_white[session_id], &my_connection[session_id],syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,alarm_content,syslogalarm,mailalarm,adminmailaccount_num,radius_username,sstr,user,encode[session_id],&get_first_prompt[session_id]);
/*								telnet_writelogfile2( &forward2server_packet.data[8], forward2server_packet.len - 8, monitor_shell_pipe_name[session_id],
										winopenfile[session_id], fd1[session_id], fd2[session_id],
										inputcommandline[session_id], commandline[session_id], &waitforline[session_id] );*/
								//gettimeofday(&ts2, NULL);
							}
						}

						if( session_channel_mode[session_id] == SFTP_MODE )
						{
#if 0
							/* Skip init message */
							if( client_first_init_flag[session_id] )
							{
								client_first_init_flag[session_id] = 0;
							}
							else
							{
								/* if buffer is larger than spkt.size */
								if( new_client_buffer_flag[session_id] )
								{
#endif
if( client_first_init_flag[session_id] == 1 )
							{
								if (spkt.data[spkt.len-5] == 0x01)
								{
									/*if (spkt.data[spkt.len-1] == 0x03)
										client_first_init_flag[session_id] = 2;
									*/
									if (spkt.len == 13)
										client_first_init_flag[session_id] = 3;
									else
										client_first_init_flag[session_id] = 0;
								}
							}
							else if (client_first_init_flag[session_id] == 2)
							{
								client_first_init_flag[session_id] = 3;
							}
							else if (client_first_init_flag[session_id] == 3 && spkt.len == 12)
							{
								memcpy( &buflen3[session_id], &spkt.data[8], 4 );
								buflen3[session_id] = ntohl( buflen3[session_id] );
								printf("buflen = %d\n", buflen3[session_id]);
							}
							else
							{
								/*if (client_first_init_flag[session_id] ==3 )
								{
									int index;
									char plen[4];
									put_u32(plen, spkt.len - 4);
									for (index = spkt.len + 3; index > 7; index--)
									{
										spkt.data[index] = spkt.data[index-4];
									}
									for (index = 0; index < 4; index ++)
									{
										spkt.data[index+4] = plen[index];
									}
									spkt.len += 4;
								}*/
								/* if buffer is larger than spkt.size */
								if( new_client_buffer_flag[session_id] )
								{

									if (client_first_init_flag[session_id] ==3 )
									{
										int index;
										char plen[4];
										if (spkt.len - 8 == buflen3[session_id])
										{
											put_u32(plen, spkt.len - 4);
											for (index = spkt.len + 3; index > 7; index--)
											{
												spkt.data[index] = spkt.data[index-4];
											}
											for (index = 0; index < 4; index ++)
											{
												spkt.data[index+4] = plen[index];
											}
										}
										else
										{
											put_u32(plen, buflen3[session_id]);
											for (index = spkt.len + 3; index > 11; index--)
											{
												spkt.data[index] = spkt.data[index-4];
											}
											for (index = 0; index < 4; index ++)
											{
												spkt.data[index+8] = plen[index];
											}
										}
										spkt.len += 4;
									}

									u_int buflen;
									copy_client_buffer_size[session_id] = 0;
									csp[session_id] = 8;

									while( copy_client_buffer_size[session_id] < spkt.len - 8 )
									{
										memcpy( &buflen, &spkt.data[csp[session_id]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_client_type[session_id], &spkt.data[csp[session_id] + 4], 1 );
										memcpy( &transfer_client_id[session_id], &spkt.data[csp[session_id] + 5], 4 );
										transfer_client_id[session_id] = ntohl( transfer_client_id[session_id] );

										client_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
										client_buf[session_id]->buf    = ( u_char * )malloc( buflen );
										client_buf[session_id]->alloc  = buflen;
										client_buf[session_id]->offset = 0;
										client_buf[session_id]->end = 0;

										/* Only a part of a new buffer */
										if( copy_client_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
										{
											int copy_size = spkt.len - 8 - copy_client_buffer_size[session_id] - 4;
											memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], copy_size );
											client_buf[session_id]->end += copy_size;

											copy_client_buffer_size[session_id] += ( copy_size + 4 );

											new_client_buffer_flag[session_id] = 0;
										}
										else
										{
											memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], buflen );
											client_buf[session_id]->end += buflen;

											copy_client_buffer_size[session_id] += ( buflen + 4 );
											csp[session_id] += ( buflen + 4 );

											new_client_buffer_flag[session_id] = 1;
											/* do */
											store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
										}
									}
								}
								else
								{
									if( client_buf[session_id]->end + spkt.len - 8 > client_buf[session_id]->alloc )
									{
										copy_client_buffer_size[session_id] = client_buf[session_id]->alloc - client_buf[session_id]->end;
										csp[session_id] = 8 + client_buf[session_id]->alloc - client_buf[session_id]->end;

										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8],
												client_buf[session_id]->alloc - client_buf[session_id]->end );
										client_buf[session_id]->end = client_buf[session_id]->alloc;

										new_client_buffer_flag[session_id] = 1;
										/* do */
										store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );

										u_int buflen;

										while( copy_client_buffer_size[session_id] < spkt.len - 8 )
										{
											memcpy( &buflen, &spkt.data[csp[session_id]], 4 );
											buflen = ntohl( buflen );
											memcpy( &command_client_type[session_id], &spkt.data[csp[session_id] + 4], 1 );
											memcpy( &transfer_client_id[session_id], &spkt.data[csp[session_id] + 5], 4 );
											transfer_client_id[session_id] = ntohl( transfer_client_id[session_id] );

											client_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
											client_buf[session_id]->buf    = ( u_char * )malloc( buflen );
											client_buf[session_id]->alloc  = buflen;
											client_buf[session_id]->offset = 0;
											client_buf[session_id]->end    = 0;

											/* Only a part of a new buffer */
											if( copy_client_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
											{
												int copy_size = spkt.len - 8 - copy_client_buffer_size[session_id] - 4;
												memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], copy_size );
												client_buf[session_id]->end += copy_size;

												copy_client_buffer_size[session_id] += ( copy_size + 4 );

												new_client_buffer_flag[session_id] = 0;
											}
											else
											{
												memcpy( client_buf[session_id]->buf, &spkt.data[csp[session_id] + 4], buflen );
												client_buf[session_id]->end += buflen;

												copy_client_buffer_size[session_id] += ( buflen + 4 );
												csp[session_id] += ( buflen + 4 );

												new_client_buffer_flag[session_id] = 1;
												/* do */
												store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
											}
										}

									}
									else if( client_buf[session_id]->end + spkt.len - 8 == client_buf[session_id]->alloc )
									{
										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
										client_buf[session_id]->end += spkt.len - 8;

										new_client_buffer_flag[session_id] = 1;
										/* do */
										store_client_buf( session_id, transfer_client_id[session_id], command_client_type[session_id], client_buf[session_id] );
									}
									/* client_buf->end + spkt.len - 8 < client_buf->alloc */
									else
									{
										memcpy( client_buf[session_id]->buf + client_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
										client_buf[session_id]->end += spkt.len - 8;
									}
								}
							}
						}
					}
				}
				/* Log SSH1 data */
				else
				{
					session_id = 0;

					if( show_stream )
					{
						printf( "SSH1 client@%d type=%d len=%d: ", getpid(), spkt.type, spkt.len );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", ( u_char )spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );
					}

					/* Judge sftp mode */
					if( spkt.type == SSH_CMSG_EXEC_SHELL )
					{
						//channel_mode = SSH_MODE;
						session_channel_mode[0] = SSH_MODE;

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
								"SSH1_CMSG_EXEC_SHELL: SSH1\n",
								str_time( time( NULL ), NULL ), cstr, sstr );
						logit( "\n%s", buf );

						/* fork perl ssh1 */
						if( !original_mode_flag )
						{
							char logfilename[256];
							char replayfilename[256];
							get_first_prompt[session_id]=2;

							cmd[session_id]=malloc(sizeof(char)*string_length);
							bzero(cmd[session_id],string_length);

							inputcommandline[session_id]=malloc(sizeof(char)*string_length);
							bzero(inputcommandline[session_id],string_length);

							commandline[session_id]=malloc(sizeof(char)*string_length);
							bzero(commandline[session_id],string_length);

							cache1[session_id]=malloc(sizeof(char)*string_length);
							bzero(cache1[session_id],string_length);

							cache2[session_id]=malloc(sizeof(char)*string_length);
							bzero(cache2[session_id],string_length);

							linebuffer[session_id]=malloc(sizeof(char)*string_length);
							bzero(linebuffer[session_id],string_length);

							sql_query[session_id]=malloc(sizeof(char)*string_length);
							bzero(sql_query[session_id],string_length);

							time(&timep);
							p=localtime(&timep);

							sprintf(logfilename,"%s/ssh_log_%d_%d_%d_%d_%d_%d_%d",logcache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
							sprintf(replayfilename,"%s/ssh_replay_%d_%d_%d_%d_%d_%d_%d",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);

							monitor_shell_pipe_name[session_id] = ( char * )malloc( 128 );
							sprintf( monitor_shell_pipe_name[session_id], "%s/monitor_shell=%d.0", BINPATH, getpid());

							black_or_white[session_id] = 0;

							mysql_init(&my_connection[session_id]);
							if (mysql_real_connect(&my_connection[session_id],mysql_address,mysql_username,mysql_password,mysql_database,0,NULL,0))
							{
								//printf("Connection DB success\n");
							}
							else
							{
								printf("Connect DB Fail\n");
							}

							mysql_query(&my_connection[session_id],"set NAMES utf8");

							if(strlen(forbidden)>0)
							{
								printf("\n\n\n\n\nhere4\n\n\n\n");
								get_pcre(forbidden,black_cmd_list,&black_cmd_num,&my_connection[session_id],my_res_ptr[session_id],&my_sqlrow[session_id],& black_or_white[session_id],sql_query[session_id]);
								printf("black_or_white=%d\n",black_or_white[session_id]);
							}

							fd1[session_id] = open( logfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);
							fd2[session_id] = open( replayfilename, O_CREAT|O_WRONLY ,S_IRUSR|S_IRGRP|S_IROTH);

							sprintf(replayfilename,"%s/\\\"ssh_replay_%d_%d_%d_%d_%d_%d_%d\\\"",replaycache,pid,(1900+p->tm_year),(1+p->tm_mon),p->tm_mday,p->tm_hour,p->tm_min,p->tm_sec);
							waitforline[session_id] = 0;
							sid[session_id] = 0;
							g_bytes[session_id] = 0;
							invim[session_id] = 0;
							justoutvim[session_id] = 0;

							if( fd1[session_id] < 0 )
							{
								//  printerror(0,"-ERR","logfile open error:%s\n",logfilename1);
								perror( logfilename );
								exit( -1 );
							}

							if( fd2[session_id] < 0 )
							{
								//  printerror(0,"-ERR","logfile open error:%s\n",logfilename2);
								perror( replayfilename );
								exit( -1 );
							}

							bzero(sql_query[session_id],string_length);
							sprintf(sql_query[session_id],"insert into sessions  (sid,cli_addr,addr,type,user,start,end,luser,logfile,replayfile,s_bytes,server_addr,dangerous,jump_total,total_cmd,pid,sport,dport)  values (NULL,'%s','%s','ssh','%s',now(),now(),'%s','%s','%s',0,'%s',0,0,0,%d,'%s','%s')",sip,dip,user,radius_username,logfilename,replayfilename,audit_address,getpid(),sport,dport);
							if(mysql_query(&my_connection[session_id],sql_query[session_id]))
							{
								printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection));
								exit(0);
							}
							bzero(sql_query[session_id],string_length);
							sprintf(sql_query[session_id],"select last_insert_id()");
							if(mysql_query(&my_connection[session_id],sql_query[session_id]))
							{
								printf("insert error: %s\n%s\n",sql_query[session_id], mysql_error(&my_connection[session_id]));
								exit(0);
							}
							my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);
							if(my_res_ptr[session_id])
							{
								while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
								{
									sid[session_id]=atoi(my_sqlrow[session_id][0]);
								}
							}
							else
							{
								exit(0);
							}

                        if(mysql_query(&my_connection[session_id],"set NAMES utf8"))
                        {
                            printf("set utf8 err:%s\n", mysql_error(&my_connection));
                            exit(0);
                        }

                            mysql_query(&my_connection[session_id],"show variables like 'character%'");
                            my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

                            if(my_res_ptr[session_id])
                            {
                                while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
                                {
									printf("4 %s,%s\n",my_sqlrow[session_id][0],my_sqlrow[session_id][1]);
                                }
                            }

							bzero(sql_query[session_id],string_length);
							sprintf(sql_query[session_id],"select encoding from devices where id=%d",did);
							mysql_query(&my_connection[session_id],sql_query[session_id]);
							my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

							encode[session_id]=1;

							if(my_res_ptr[session_id])
							{
								while(my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id]))
								{
									encode[session_id]=atoi(my_sqlrow[session_id][0]);
								}
							}

                        printf("sql4=%s\n",sql_query[session_id]);
                        printf("encode=%d\n",encode[session_id]);

							for(int i=0;i<50;i++)
							{
								bzero(myprompt[i],128);
							}

							bzero(sql_query[session_id],string_length);
							sprintf(sql_query[session_id],"select prompt from device_prompts where device_id=%d",did);
							mysql_query(&my_connection[session_id],sql_query[session_id]);
							my_res_ptr[session_id] = mysql_store_result(&my_connection[session_id]);

							if(my_res_ptr[session_id])
							{
								int j=0;
								while((my_sqlrow[session_id] = mysql_fetch_row(my_res_ptr[session_id])) && j<50)
								{
									strcpy(myprompt[j],my_sqlrow[session_id][0]);
									j++;
								}
							}
						}
					}

					if( spkt.type == SSH_CMSG_EXEC_CMD )
					{
						if( strcmp( &spkt.data[4], "/usr/local/libexec/sftp-server" ) == 0 )
						{
							//channel_mode
							session_channel_mode[0] = SFTP_MODE;

							if (fetch_sftp_flag(sql_conn, did) == 0) fatal("sftp flag is 0, devices id is %d\n", did);
							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"INSERT INTO sftpsessions(cliaddr,svraddr,audit_addr,radius_user,sftp_user,start) \
										VALUES('%s','%s','%s','%s','%s',now())",
										cstr, sstr, audit_address, radius_username, ssh1_user );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									if( !mysql_query( sql_conn, "SELECT LAST_INSERT_ID()" ) )
									{
										res_ptr = mysql_use_result( sql_conn );

										if( res_ptr )
										{
											while(( sqlrow = mysql_fetch_row( res_ptr ) ) )
											{
												last_insert_id[0] = atoi( sqlrow[0] );
											}
										}
									}
									else
									{
										if( mysql_errno( sql_conn ) )
										{
											printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
										}
									}
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if( spkt.type == SSH_CMSG_EOF || spkt.type == SSH_CMSG_EXIT_CONFIRMATION )
					{
						if( session_channel_mode[0] == SSH_MODE )
						{
							session_channel_mode[0] = 0;
							snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
									"SSH1:Exit!\n",
									str_time( time( NULL ), NULL ), cstr, sstr );
							logit( "\n%s", buf );
							/* kill perl ssh1 */
						}

						if( session_channel_mode[0] == SFTP_MODE )
						{
							session_channel_mode[0] = 0;

							if( sql_conn )
							{
								snprintf( buf, sizeof( buf ),
										"UPDATE sftpsessions SET end=now() WHERE sid=%d",
										last_insert_id[0] );

								/* Insert success */
								if( !mysql_query( sql_conn, buf ) )
								{
									printf( "Mysql insert \"update\" command log success!\n" );
									last_insert_id[0] = 0;
									sftp_cmd_cnt[0]=0;
								}
								else
								{
									if( mysql_errno( sql_conn ) )
									{
										printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
									}
								}
							}
						}
					}
					else if(( spkt.type == SSH_CMSG_STDIN_DATA ) ||
							( spkt.type == SSH_SMSG_STDOUT_DATA ) ||
							( spkt.type == SSH_SMSG_STDERR_DATA ) )
					{
						//                        if (src_data > 0)
						//                            writen(src_data, &spkt.data[4], spkt.len-4);
						if( session_channel_mode[0] == SSH_MODE )
						{
							/* write to perl ssh1 client */
							if( !original_mode_flag )
							{
                    telnet_writelogfile2( &spkt.data[4], spkt.len - 4, monitor_shell_pipe_name[session_id],
                        fd1[session_id], fd2[session_id],inputcommandline[session_id], commandline[session_id],
						cache1[session_id], cache2[session_id], linebuffer[session_id], cmd[session_id], sql_query[session_id], myprompt,
                        black_cmd_list, black_cmd_num, sid[session_id],
                        &waitforline[session_id] , &g_bytes[session_id] , &invim[session_id], session_id, black_or_white[session_id], &my_connection[session_id],syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,alarm_content,syslogalarm,mailalarm,adminmailaccount_num,radius_username,sstr,user,encode[session_id],&get_first_prompt[session_id]);
/*								telnet_writelogfile2( &spkt.data[4], spkt.len - 4, monitor_shell_pipe_name[session_id], winopenfile[session_id],
										fd1[session_id], fd2[session_id], inputcommandline[session_id], commandline[session_id],
										&waitforline[session_id] );*/
							}
						}

						if( session_channel_mode[0] == SFTP_MODE )
						{
							/* Skip init message, SSH1 has two buffers! */
							if( client_first_init_flag[0] > -1 )
							{
								client_first_init_flag[0] --;
							}
							else
							{
								/* if buffer is larger than spkt.size */
								if( new_client_buffer_flag[0] )
								{
									u_int buflen;
									copy_client_buffer_size[0] = 0;
									csp[0] = 4;

									while( copy_client_buffer_size[0] < spkt.len - 4 )
									{
										memcpy( &buflen, &spkt.data[csp[0]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_client_type[0], &spkt.data[csp[0] + 4], 1 );
										memcpy( &transfer_client_id[0], &spkt.data[csp[0] + 5], 4 );
										transfer_client_id[0] = ntohl( transfer_client_id[0] );

										client_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
										client_buf[0]->buf    = ( u_char * )malloc( buflen );
										client_buf[0]->alloc  = buflen;
										client_buf[0]->offset = 0;
										client_buf[0]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_client_buffer_size[0] + buflen + 4 > spkt.len - 4 )
										{
											int copy_size = spkt.len - 4 - copy_client_buffer_size[0] - 4;
											memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], copy_size );
											client_buf[0]->end += copy_size;

											copy_client_buffer_size[0] += ( copy_size + 4 );

											new_client_buffer_flag[0] = 0;
										}
										else
										{
											memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], buflen );
											client_buf[0]->end += buflen;

											copy_client_buffer_size[0] += ( buflen + 4 );
											csp[0] += ( buflen + 4 );

											new_client_buffer_flag[0] = 1;
											/* do */
											store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
										}
									}
								}
								else
								{
									if( client_buf[0]->end + spkt.len - 4 > client_buf[0]->alloc )
									{
										copy_client_buffer_size[0] = client_buf[0]->alloc - client_buf[0]->end;
										csp[0] = 4 + client_buf[0]->alloc - client_buf[0]->end;

										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4],
												client_buf[0]->alloc - client_buf[0]->end );
										client_buf[0]->end = client_buf[0]->alloc;

										new_client_buffer_flag[0] = 1;
										/* do */
										store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );

										u_int buflen;

										while( copy_client_buffer_size[0] < spkt.len - 4 )
										{
											memcpy( &buflen, &spkt.data[csp[0]], 4 );
											buflen = ntohl( buflen );
											memcpy( &command_client_type[0], &spkt.data[csp[0] + 4], 1 );
											memcpy( &transfer_client_id[0], &spkt.data[csp[0] + 5], 4 );
											transfer_client_id[0] = ntohl( transfer_client_id[0] );

											client_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
											client_buf[0]->buf    = ( u_char * )malloc( buflen );
											client_buf[0]->alloc  = buflen;
											client_buf[0]->offset = 0;
											client_buf[0]->end    = 0;

											/* Only a part of a new buffer */
											if( copy_client_buffer_size[0] + buflen + 4 > spkt.len - 4 )
											{
												int copy_size = spkt.len - 4 - copy_client_buffer_size[0] - 4;
												memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], copy_size );
												client_buf[0]->end += copy_size;

												copy_client_buffer_size[0] += ( copy_size + 4 );

												new_client_buffer_flag[0] = 0;
											}
											else
											{
												memcpy( client_buf[0]->buf, &spkt.data[csp[0] + 4], buflen );
												client_buf[0]->end += buflen;

												copy_client_buffer_size[0] += ( buflen + 4 );
												csp[0] += ( buflen + 4 );

												new_client_buffer_flag[0] = 1;
												/* do */
												store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
											}
										}

									}
									else if( client_buf[0]->end + spkt.len - 4 == client_buf[0]->alloc )
									{
										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4], spkt.len - 4 );
										client_buf[0]->end += spkt.len - 4;

										new_client_buffer_flag[0] = 1;
										/* do */
										store_client_buf( 0, transfer_client_id[0], command_client_type[0], client_buf[0] );
									}
									/* client_buf->end + spkt.len - 8 < client_buf->alloc */
									else
									{
										memcpy( client_buf[0]->buf + client_buf[0]->end, &spkt.data[4], spkt.len - 4 );
										client_buf[0]->end += spkt.len - 4;
									}
								}
							}
						}
					}
					else if( spkt.type == SSH_CMSG_USER )
					{
						memset( ssh1_user, 0, sizeof( ssh1_user ) );
						memcpy( ssh1_user, &spkt.data[4], spkt.len - 4 );
						//printf( "SSH1 USER: %s\n", ssh1_user );
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
								"\nSSH_CMSG_USER: %s\n", str_time( time( NULL ), NULL ),
								cstr, sstr, &spkt.data[4] );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
					else if( spkt.type == SSH_CMSG_AUTH_PASSWORD )
					{
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
								"\nSSH_CMSG_AUTH_PASSWORD: %s\n", str_time( time( NULL ),
									NULL ), cstr, sstr, &spkt.data[4] );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
				}

				if( forward2server_flag == 1 )
				{
					forward2server_flag = 0;

					if( block_command_flag == 0 )
					{
						if( writen( sp[0], &forward2server_packet, forward2server_packet.len + 8 )
								!= forward2server_packet.len + 8 )
							break;
					}
					else
					{
						/*
						char block_command_fp[64];
						int sid;
						bzero( block_command_fp, sizeof( block_command_fp ) );
						snprintf( block_command_fp, sizeof( block_command_fp ), "/opt/freesvr/audit/gateway/log/ssh/block_%d", getpid() );
						FILE *block_fp = fopen( block_command_fp, "r" );

						if( block_fp ) fscanf( block_fp, "%d", &sid );

						fclose( block_fp );
						*/

						printf("\n\n\n\n\n\n\nmy block 1\n");
						block_command_flag = 0;
						char block_buf[] =
						{
							0x5e, 0x00, 0x00, 0x00, 0x0b, 0x00, 0x00, 0x00,
							0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x03,
							0x05, 0x15, 0x03
						};
						printf("\nmy block 2\n");

						packet_start( SSH2_MSG_CHANNEL_DATA );

						printf("\nmy block 3\n");

						if( client_is_putty )
							packet_put_int( 256 );
						else
						{
							packet_put_int( block_session_id );
							put_u32( &block_buf[8], block_session_id );
						}

						printf("\nmy block 4\n");

						packet_put_cstring( "\x0d\x0a Forbidden command!\x0d\x0a" );
						packet_send();
						packet_write_wait();

						if( writen( sp[0], &block_buf, 19 ) != 19 ) break;

					}
				}

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		/* Read from socketpair and write to client */
		/* Log the stream of server */
		if( FD_ISSET( sp[0], &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading spkt header on server side" );

			if(( n = readn( sp[0], &spkt, 8 ) ) <= 0 )
				break;

			if( spkt.len > sizeof( spkt.data ) )
			{
				fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
						spkt.len, sizeof( spkt.data ) );
			}

			debug4( "[FREESVR-SSH-PROXY] Reading %u bytes from socketpair on server side", spkt.len );

			if( spkt.len && ( n = readn( sp[0], spkt.data, spkt.len ) ) <= 0 )
				break;

			/*debug3("[FREESVR-SSH-PROXY] Got %u bytes from child process", spkt.len);
			  packet_start(spkt.type);
			  packet_put_raw(spkt.data, spkt.len);
			  packet_send();
			  packet_write_wait();*/

			memset( &forward2client_packet, 0x00,  spkt.len + 8 );
			memcpy( &forward2client_packet, &spkt, spkt.len + 8 );
			forward2client_flag = 1;

			/* Log SSH2 data
			 * TODO: No need to log data that won't appear here */
			if( compat20 )
			{
				if( spkt.len >= 4 )
				{
					memcpy( &session_id, &spkt.data[0], 4 );
					session_id = ntohl( session_id );

					if( session_trans[session_id] )
					{
						session_id = session_trans[session_id];
					}
				}

				if( session_id == 256 ) session_id = 0;

				//                printf( "Server Session id = %d\n", session_id );
				if( show_stream )
				{
					printf( "server@%d session=%d type=%d: ", getpid(), session_id, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( " %02x ", ( unsigned char )spkt.data[i] );
					}

					printf( "\n" );
				}

				//                                for ( i = 8; i < spkt.len; i++ )
				//                                {
				//                                    printf( "%c", (u_char)spkt.data[i] );
				//                                }
				//                                printf("\n");
				//                if ( spkt.type != 94 && spkt.type != 93 )
				//                {
				//                    printf("server type=%d  %d: ",spkt.type, spkt.len);
				//                    for ( i = 0; i < spkt.len; i++ )
				//                    {
				//                        printf( "%02x ", (u_char)spkt.data[i] );
				//                    }
				//                    printf("\n");
				//                }

				if( spkt.type == SSH2_MSG_CHANNEL_OPEN_CONFIRMATION )
				{
					int session_sid, session_cid;
					memcpy( &session_sid, &spkt.data[0], 4 );
					session_sid = ntohl( session_sid );
					memcpy( &session_cid, &spkt.data[4], 4 );
					session_cid = ntohl( session_cid );

					session_trans[session_sid] = session_cid;
				}

				if( spkt.type == SSH2_MSG_CHANNEL_CLOSE )
				{
					if( session_channel_mode[session_id] == SSH_MODE )
					{
						session_channel_mode[session_id] = 0;
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2 EXIT!! SESSION ID = %d\n",
								str_time( time( NULL ), NULL ), cstr, sstr, session_id );
						logit( "\n%s", buf );

						/* kill perl ssh2 */
						if( !original_mode_flag )
						{
							close( fd1[session_id] );
							close( fd2[session_id] );
							mysql_close( &my_connection[session_id] );
							free( inputcommandline[session_id] );
							free( commandline[session_id] );
						}
					}

					if( session_channel_mode[session_id] == SFTP_MODE )
					{
						session_channel_mode[session_id] = 0;

						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"UPDATE sftpsessions SET end=now() WHERE sid=%d",
									last_insert_id[session_id] );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								printf( "Mysql insert \"update\" command log success!\n" );
								last_insert_id[session_id] = 0;
								sftp_cmd_cnt[session_id] = 0;
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}

				if( spkt.type == SSH2_MSG_USERAUTH_REQUEST )
				{
					user = packet_get_string( NULL );
					char *service = packet_get_string( NULL );
					char *method = packet_get_string( NULL );

					if( strcmp( method, "password" ) == 0 )
					{
						char c = packet_get_char();
						char *pass = packet_get_string( NULL );

						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH2) %s -> %s\n"
								"SSH2_MSG_USERAUTH_REQUEST: %s %s %s %d %s\n",
								str_time( time( NULL ), NULL ), cstr, sstr,
								user, service, method, c, pass );
						logit( "\n%s", buf );

						if( logf != NULL )
						{
							fprintf( logf, "%s\n", buf );
							fflush( logf );
						}
					}
				}
				else if( spkt.type == SSH2_MSG_CHANNEL_DATA )
				{
					//                    if ((dst_data > 0) && (spkt.len >= 8))
					//                        writen(dst_data, &spkt.data[8], spkt.len-8);

					if( session_channel_mode[session_id] == SSH_MODE )
					{
						/* write to perl ssh2 server */
						//if ((dst_data > 0) && (spkt.len >= 8))
						if( !original_mode_flag )
						{
					telnet_writelogfile( &spkt.data[8], spkt.len - 8, monitor_shell_pipe_name[session_id],
                        fd1[session_id], fd2[session_id], inputcommandline[session_id], commandline[session_id],
                        cache1[session_id], cache2[session_id], linebuffer[session_id], cmd[session_id], sql_query[session_id], myprompt,
                        black_cmd_list, black_cmd_num, sid[session_id],
                        &waitforline[session_id] , &g_bytes[session_id] , &invim[session_id],  &justoutvim[session_id], session_id, black_or_white[session_id], &my_connection[session_id],syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,alarm_content,syslogalarm,mailalarm,adminmailaccount_num,radius_username,sstr,user,encode[session_id],&get_first_prompt[session_id]);
/*							telnet_writelogfile( &spkt.data[8], spkt.len - 8, monitor_shell_pipe_name[session_id],
									fd1[session_id], fd2[session_id], fd3[session_id], inputcommandline[session_id],
									commandline[session_id], &waitforline[session_id] );*/
						}

					}

					if( session_channel_mode[session_id] == SFTP_MODE )
					{
						if( server_first_init_flag[session_id] )
						{
							server_first_init_flag[session_id] = 0;
						}
						else
						{
							/* if buffer is larger than spkt.size */
							if( new_server_buffer_flag[session_id] )
							{
								u_int buflen;
								copy_server_buffer_size[session_id] = 0;
								ssp[session_id] = 8;

								while( copy_server_buffer_size[session_id] < spkt.len - 8 )
								{
									memcpy( &buflen, &spkt.data[ssp[session_id]], 4 );
									buflen = ntohl( buflen );
									memcpy( &command_server_type[session_id], &spkt.data[ssp[session_id] + 4], 1 );
									memcpy( &transfer_server_id[session_id], &spkt.data[ssp[session_id] + 5], 4 );
									transfer_server_id[session_id] = ntohl( transfer_server_id[session_id] );

									server_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
									server_buf[session_id]->buf    = ( u_char * )malloc( buflen );
									server_buf[session_id]->alloc  = buflen;
									server_buf[session_id]->offset = 0;
									server_buf[session_id]->end    = 0;

									/* Only a part of a new buffer */
									if( copy_server_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
									{
										int copy_size = spkt.len - 8 - copy_server_buffer_size[session_id] - 4;
										memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], copy_size );
										server_buf[session_id]->end += copy_size;

										copy_server_buffer_size[session_id] += ( copy_size + 4 );

										new_server_buffer_flag[session_id] = 0;
									}
									else
									{
										memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], buflen );
										server_buf[session_id]->end += buflen;

										copy_server_buffer_size[session_id] += ( buflen + 4 );
										ssp[session_id] += ( buflen + 4 );

										new_server_buffer_flag[session_id] = 1;
										/* do */
										store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
									}
								}
							}
							else
							{
								if( server_buf[session_id]->end + spkt.len - 8 > server_buf[session_id]->alloc )
								{
									copy_server_buffer_size[session_id] = server_buf[session_id]->alloc - server_buf[session_id]->end;
									ssp[session_id] = 8 + server_buf[session_id]->alloc - server_buf[session_id]->end;

									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8],
											server_buf[session_id]->alloc - server_buf[session_id]->end );
									server_buf[session_id]->end = server_buf[session_id]->alloc;

									new_server_buffer_flag[session_id] = 1;
									/* do */
									store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );

									u_int buflen;

									while( copy_server_buffer_size[session_id] < spkt.len - 8 )
									{
										memcpy( &buflen, &spkt.data[ssp[session_id]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_server_type[session_id], &spkt.data[ssp[session_id] + 4], 1 );
										memcpy( &transfer_server_id[session_id], &spkt.data[ssp[session_id] + 5], 4 );
										transfer_server_id[session_id] = ntohl( transfer_server_id[session_id] );

										server_buf[session_id]         = ( Buffer * )malloc( sizeof( Buffer ) );
										server_buf[session_id]->buf    = ( u_char * )malloc( buflen );
										server_buf[session_id]->alloc  = buflen;
										server_buf[session_id]->offset = 0;
										server_buf[session_id]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_server_buffer_size[session_id] + buflen + 4 > spkt.len - 8 )
										{
											int copy_size = spkt.len - 8 - copy_server_buffer_size[session_id] - 4;
											memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], copy_size );
											server_buf[session_id]->end += copy_size;

											copy_server_buffer_size[session_id] += ( copy_size + 4 );

											new_server_buffer_flag[session_id] = 0;
										}
										else
										{
											memcpy( server_buf[session_id]->buf, &spkt.data[ssp[session_id] + 4], buflen );
											server_buf[session_id]->end += buflen;

											copy_server_buffer_size[session_id] += ( buflen + 4 );
											ssp[session_id] += ( buflen + 4 );

											new_server_buffer_flag[session_id] = 1;
											/* do */
											store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
										}
									}

								}
								else if( server_buf[session_id]->end + spkt.len - 8 == server_buf[session_id]->alloc )
								{
									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
									server_buf[session_id]->end += spkt.len - 8;

									new_server_buffer_flag[session_id] = 1;
									/* do */
									store_scpair_buf( session_id, transfer_server_id[session_id], command_server_type[session_id], server_buf[session_id] );
								}
								/* server_buf->end + spkt.len - 8 < server_buf->alloc */
								else
								{
									memcpy( server_buf[session_id]->buf + server_buf[session_id]->end, &spkt.data[8], spkt.len - 8 );
									server_buf[session_id]->end += spkt.len - 8;
								}
							}
						}
					}
				}
			}
			/* Log SSH1 data
			 * TODO: No need to log data that won't appear here */
			else
			{
				session_id = 0;

				if( show_stream )
				{
					printf( "SSH1 server@%d type=%d len=%d: ", getpid(), spkt.type, spkt.len );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( " %02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );
				}

				if( spkt.type == SSH_SMSG_EXITSTATUS )
				{
					if( session_channel_mode[0] == SSH_MODE )
					{
						session_channel_mode[0] = 0;
						snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s\n"
								"SSH1:Exit!\n",
								str_time( time( NULL ), NULL ), cstr, sstr );
						logit( "\n%s", buf );
						/* kill perl ssh1 */
					}

					if( session_channel_mode[0] == SFTP_MODE )
					{
						session_channel_mode[0] = 0;

						if( sql_conn )
						{
							snprintf( buf, sizeof( buf ),
									"UPDATE sftpsessions SET end=now() WHERE sid=%d",
									last_insert_id[0] );

							/* Insert success */
							if( !mysql_query( sql_conn, buf ) )
							{
								printf( "Mysql insert \"update\" command log success!\n" );
								last_insert_id[0] = 0;
								sftp_cmd_cnt[0] = 0;
							}
							else
							{
								if( mysql_errno( sql_conn ) )
								{
									printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
								}
							}
						}
					}
				}
				else if(( spkt.type == SSH_CMSG_STDIN_DATA ) ||
						( spkt.type == SSH_SMSG_STDOUT_DATA ) ||
						( spkt.type == SSH_SMSG_STDERR_DATA ) )
				{
					//                    if ((dst_data > 0) && (spkt.len >= 4))
					//                        writen(dst_data, &spkt.data[4], spkt.len-4);

					if( session_channel_mode[0] == SSH_MODE )
					{
						/* write to perl ssh1 server */
						if( !original_mode_flag )
						{
					telnet_writelogfile( &spkt.data[4], spkt.len - 4,  monitor_shell_pipe_name[session_id],
                        fd1[session_id], fd2[session_id], inputcommandline[session_id], commandline[session_id],
                        cache1[session_id], cache2[session_id], linebuffer[session_id], cmd[session_id], sql_query[session_id], myprompt,
                        black_cmd_list, black_cmd_num, sid[session_id],
                        &waitforline[session_id] , &g_bytes[session_id] , &invim[session_id],  &justoutvim[session_id], session_id, black_or_white[session_id], &my_connection[session_id],syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,alarm_content,syslogalarm,mailalarm,adminmailaccount_num,radius_username,sstr,user,encode[session_id],&get_first_prompt[session_id]);
/*							telnet_writelogfile( &spkt.data[4], spkt.len - 4, monitor_shell_pipe_name[session_id],
									fd1[session_id], fd2[session_id], fd3[session_id], inputcommandline[session_id],
									commandline[session_id], &waitforline[session_id] );*/
						}

					}

					if( session_channel_mode[0] == SFTP_MODE )
					{
						if( server_first_init_flag[0] )
						{
							server_first_init_flag[0] = 0;
						}
						else
						{
							/* if buffer is larger than spkt.size */
							if( new_server_buffer_flag[0] )
							{
								u_int buflen;
								copy_server_buffer_size[0] = 0;
								ssp[0] = 4;

								while( copy_server_buffer_size[0] < spkt.len - 4 )
								{
									memcpy( &buflen, &spkt.data[ssp[0]], 4 );
									buflen = ntohl( buflen );
									memcpy( &command_server_type[0], &spkt.data[ssp[0] + 4], 1 );
									memcpy( &transfer_server_id[0], &spkt.data[ssp[0] + 5], 4 );
									transfer_server_id[0] = ntohl( transfer_server_id[0] );

									server_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
									server_buf[0]->buf    = ( u_char * )malloc( buflen );
									server_buf[0]->alloc  = buflen;
									server_buf[0]->offset = 0;
									server_buf[0]->end    = 0;

									/* Only a part of a new buffer */
									if( copy_server_buffer_size[0] + buflen + 4 > spkt.len - 4 )
									{
										int copy_size = spkt.len - 4 - copy_server_buffer_size[0] - 4;
										memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], copy_size );
										server_buf[0]->end += copy_size;

										copy_server_buffer_size[0] += ( copy_size + 4 );

										new_server_buffer_flag[0] = 0;
									}
									else
									{
										memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], buflen );
										server_buf[0]->end += buflen;

										copy_server_buffer_size[0] += ( buflen + 4 );
										ssp[0] += ( buflen + 4 );

										new_server_buffer_flag[0] = 1;
										/* do */
										store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
									}
								}
							}
							else
							{
								if( server_buf[0]->end + spkt.len - 4 > server_buf[0]->alloc )
								{
									copy_server_buffer_size[0] = server_buf[0]->alloc - server_buf[0]->end;
									ssp[0] = 4 + server_buf[0]->alloc - server_buf[0]->end;

									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4],
											server_buf[0]->alloc - server_buf[0]->end );
									server_buf[0]->end = server_buf[0]->alloc;

									new_server_buffer_flag[0] = 1;
									/* do */
									store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );

									u_int buflen;

									while( copy_server_buffer_size[0] < spkt.len - 4 )
									{
										memcpy( &buflen, &spkt.data[ssp[0]], 4 );
										buflen = ntohl( buflen );
										memcpy( &command_server_type[0], &spkt.data[ssp[0] + 4], 1 );
										memcpy( &transfer_server_id[0], &spkt.data[ssp[0] + 5], 4 );
										transfer_server_id[0] = ntohl( transfer_server_id[0] );

										server_buf[0]         = ( Buffer * )malloc( sizeof( Buffer ) );
										server_buf[0]->buf    = ( u_char * )malloc( buflen );
										server_buf[0]->alloc  = buflen;
										server_buf[0]->offset = 0;
										server_buf[0]->end    = 0;

										/* Only a part of a new buffer */
										if( copy_server_buffer_size[0] + buflen + 4 > spkt.len - 4 )
										{
											int copy_size = spkt.len - 4 - copy_server_buffer_size[0] - 4;
											memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], copy_size );
											server_buf[0]->end += copy_size;

											copy_server_buffer_size[0] += ( copy_size + 4 );

											new_server_buffer_flag[0] = 0;
										}
										else
										{
											memcpy( server_buf[0]->buf, &spkt.data[ssp[0] + 4], buflen );
											server_buf[0]->end += buflen;

											copy_server_buffer_size[0] += ( buflen + 4 );
											ssp[0] += ( buflen + 4 );

											new_server_buffer_flag[0] = 1;
											/* do */
											store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
										}
									}

								}
								else if( server_buf[0]->end + spkt.len - 4 == server_buf[0]->alloc )
								{
									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4], spkt.len - 4 );
									server_buf[0]->end += spkt.len - 4;

									new_server_buffer_flag[0] = 1;
									/* do */
									store_scpair_buf( 0, transfer_server_id[0], command_server_type[0], server_buf[0] );
								}
								/* server_buf->end + spkt.len - 8 < server_buf->alloc */
								else
								{
									memcpy( server_buf[0]->buf + server_buf[0]->end, &spkt.data[4], spkt.len - 4 );
									server_buf[0]->end += spkt.len - 4;
								}
							}
						}
					}
				}
				else if( spkt.type == SSH_CMSG_USER )
				{
					snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
							"\nSSH_CMSG_USER: %s", str_time( time( NULL ), NULL ),
							sstr, cstr, &spkt.data[4] );
					logit( "%s", buf );

					if( logf )
					{
						fprintf( logf, "%s\n\n", buf );
						fflush( logf );
					}
				}
				else if( spkt.type == SSH_CMSG_AUTH_PASSWORD )
				{
					snprintf( buf, sizeof( buf ), "[%s] FREESVR-SSH-PROXY (SSH1) %s -> %s"
							"\nSSH_CMSG_AUTH_PASSWORD: %s", str_time( time( NULL ), NULL ),
							sstr, cstr, &spkt.data[4] );
					logit( "%s", buf );

					if( logf )
					{
						fprintf( logf, "%s\n\n", buf );
						fflush( logf );
					}
				}
			}

			if( forward2client_flag == 1 )
			{
				forward2client_flag = 0;
				packet_start( forward2client_packet.type );
				packet_put_raw( forward2client_packet.data, forward2client_packet.len );
				packet_send();
				packet_write_wait();
			}

			memset( &spkt, 0x00, spkt.len + 8 );
		}

		while( queue_size() > 0 )
		{
			int index = queue_top();
			u_int ctype, stype, sid;
			Buffer * cbuf, * sbuf;

			sid   = transfer_queue[index].session_id;
			ctype = transfer_queue[index].client_command_type;
			stype = transfer_queue[index].server_command_type;
			cbuf  = transfer_queue[index].client_queue_buf;
			sbuf  = transfer_queue[index].server_queue_buf;

			if( no_daemon_flag )
			{
				printf( "SID:%d\t\tID:%d\t\t", transfer_queue[index].session_id, transfer_queue[index].transfer_id );
				printf( "ctype %d\t\t",     transfer_queue[index].client_command_type );
				printf( "stype %d\n",     transfer_queue[index].server_command_type );

				if( show_stream )
				{
					for( i = 0; i < buffer_len( cbuf ); i++ )
					{
						if( isprint( *( cbuf->buf + i ) ) ) printf( "%c", *( cbuf->buf + i ) );
						else printf( "%02x ", ( unsigned char )*( cbuf->buf + i ) );
					}

					printf( "\n" );

					for( i = 0; i < buffer_len( sbuf ); i++ )
					{
						if( isprint( *( sbuf->buf + i ) ) ) printf( "%c", *( sbuf->buf + i ) );
						else printf( "%02x ", ( unsigned char )*( sbuf->buf + i ) );
					}

					printf( "\n\n" );
				}
			}

			/* Download or upload file */
			if( ctype == SSH2_FXP_OPEN && stype == SSH2_FXP_HANDLE )
			{
				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Get filename */
				filename_tmp = buffer_get_string( cbuf, &filename_len );
				filename = g2u( filename_tmp );
				filename_len = strlen( filename );

				/* Get flag */
				wr_flag = buffer_get_int( cbuf );
				int tmp_wr_flag = wr_flag;
				tmp_wr_flag &= ~0xfffffffd;

				//printf("wr_flag = %d\n",wr_flag);

				if( tmp_wr_flag )
				{
					log_upload_file_flag[sid] = 1;

					/* Get pflag for sftp put command */
					upload_pflag[sid] = buffer_get_int( cbuf );

					/* No pflag */
					if( upload_pflag[sid] == 0x00000004 )
					{
						upload_pflag[sid] = 0;
					}
					/* Have pflag */
					else if( upload_pflag[sid] == 0x0000000c )
					{
						upload_pflag[sid] = 1;
					}
					/* Unknow */
					else upload_pflag[sid] = 2;

					/* Creat backup fd of upload file */
					/*snprintf(buf, sizeof(buf), "%s/backup_put_file/%s %s -> %s [%s]", options.c_logdir,
					  modify_filename(filename,filename_len), cstr, sstr, str_time(time(NULL), NULL) );*/
					snprintf( buf, sizeof( buf ), "/opt/freesvr/audit/log/sftp/upload/%s[%s]",
							modify_filename( filename, filename_len ), str_time( time( NULL ), NULL ) );
					//memset ( backup_upload_fn[sid], 0x00, sizeof(backup_upload_fn[sid]) );
					strcpy( backup_upload_fn[sid], buf );
					upload_file_size[sid] = 0;
					if(( backup_upload_file[sid] = open( buf, O_RDWR | O_APPEND | O_CREAT, 0777 ) ) < 0 )
						error( "Failed to open log_download_file_data: '%s'", buf );
				}
				else if( wr_flag == 0x00000001 )
				{
					log_download_file_flag[sid] = 1;

					/* Creat backup fd of download file */
					/*snprintf(buf, sizeof(buf), "%s/backup_get_file/%s %s <- %s [%s]", options.c_logdir,
					  modify_filename(filename,filename_len), cstr, sstr, str_time(time(NULL), NULL) );*/
					snprintf( buf, sizeof( buf ), "/opt/freesvr/audit/log/sftp/download/%s[%s]",
							modify_filename( filename, filename_len ), str_time( time( NULL ), NULL ) );
					//printf("%s\n",buf);
					strcpy( backup_download_fn[sid], buf );
					download_file_size[sid] = 0;
					if(( log_download_file_data[sid] = open( buf, O_RDWR | O_APPEND | O_CREAT, 0777 ) ) < 0 )
						error( "Failed to open log_download_file_data: '%s'", buf );
				}
			}

			if( ctype == SSH2_FXP_READ && stype == SSH2_FXP_DATA
					&& log_download_file_flag[sid] )
			{
				/* Skip server type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				data = buffer_get_string( sbuf, &datalen );

				/* Skip client type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Skip handle */
				buffer_get_string( cbuf, NULL );

				/* Get offset of file */
				offset = buffer_get_int64( cbuf );

				download_file_size[sid] += datalen;
				if (download_file_size[sid] < sftp_backup_size * 1000000)
				{
					if (log_download_file_data[sid] > 0)
					{
						if( lseek( log_download_file_data[sid], offset, SEEK_SET ) != -1 )
							write( log_download_file_data[sid], data, datalen );
					}
				}
				else
				{
					if (log_download_file_data[sid] > 0)
						close( log_download_file_data[sid] );
					remove( backup_download_fn[sid] );
					strcpy( backup_download_fn[sid], "" );
				}
			}

			if(( ctype == SSH2_FXP_READ || ctype == SSH2_FXP_CLOSE ) && stype == SSH2_FXP_STATUS && log_download_file_flag[sid] )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				//printf( "server_status = %d\n", server_status );
				/*struct stat stmp;
				stat( backup_download_fn[sid], &stmp );

				if( stmp.st_size > sftp_backup_size * 1000000 )
				{
					remove( backup_download_fn[sid] );
					strcpy( backup_download_fn[sid], "" );
				}*/

				/* Download success, close fd and modify the flag */
				if( server_status == SSH2_FX_EOF || server_status == SSH2_FX_OK )
				{
					log_download_file_flag[sid] = 0;
					if (log_download_file_data[sid] > 0)
						close( log_download_file_data[sid] );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] get %s %s <- %s\n",
							str_time( time( NULL ), NULL ), filename, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );


					if( sql_conn )
					{
						if (strcmp(backup_download_fn[sid], "") == 0)
						{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at,filename,backupflag,backupsize) VALUES(%d,'%s %s',now(),'%s',%d,%d)",
								last_insert_id[sid], "get", filename, backup_download_fn[sid], 0, download_file_size[sid] );
						}
						else
						{
							snprintf(buf, sizeof(buf),
									"INSERT INTO sftpcomm(sid,comm,at,filename,backupflag,backupsize)" \
									"VALUES(%d,'%s %s',now(),'%s',%d,%d)",
									last_insert_id[sid], "get", filename, backup_download_fn[sid], 1, download_file_size[sid]);
						}
						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "SID = %d, Mysql insert \"get\" command log success!\n", sid );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
						update_sftp_cmd_cnt(sql_conn, sid);
					}
				}
				else
				{
					//error
				}
			}

			if( ctype == SSH2_FXP_WRITE && stype == SSH2_FXP_STATUS
					&& log_upload_file_flag[sid])
			{
				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				/* Skip handle and offset */
				buffer_get_string( cbuf, NULL );
				offset = buffer_get_int64( cbuf );

				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Write success, log it */
				if( server_status == SSH2_FX_OK )
				{
					data = buffer_get_string( cbuf, &datalen );
					upload_file_size[sid] += datalen;
					if (upload_file_size[sid] < sftp_backup_size * 1000000)
					{
						if (backup_upload_file[sid] > 0)
						{
							if( lseek( backup_upload_file[sid], offset, SEEK_SET ) != -1 )
								write( backup_upload_file[sid], data, datalen );
						}
					}
					else
					{
						remove( backup_upload_fn[sid] );
						strcpy( backup_upload_fn[sid], "" );
						if (backup_upload_file[sid] > 0)
							close( backup_upload_file[sid] );
					}

				}
				else
				{
					log_upload_file_flag[sid] = 0;
					if (backup_upload_file[sid] > 0)
						close( backup_upload_file[sid] );
				}
			}

			if( ctype == SSH2_FXP_CLOSE && stype == SSH2_FXP_STATUS && log_upload_file_flag[sid] )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/*struct stat stmp;
				stat( backup_upload_fn[sid], &stmp );

				if( stmp.st_size > sftp_backup_size * 1000000 )
				{
					remove( backup_upload_fn[sid] );
					strcpy( backup_upload_fn[sid], "" );
				}*/

				/* upload success, close fd and modify the flag */
				if( server_status == SSH2_FX_OK )
				{
					log_upload_file_flag[sid] = 0;
					if (backup_upload_file[sid] > 0)
						close( backup_upload_file[sid] );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] put%s %s %s -> %s\n",
							str_time( time( NULL ), NULL ), ( upload_pflag == 1 ) ? " -p" : "", filename, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );

					if( sql_conn )
					{
						if (strcmp(backup_upload_fn[sid], "") == 0)
						{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at,filename,backupflag,backupsize) VALUES(%d,'%s%s %s',now(),'%s',0,%d)",
								last_insert_id[sid], "put", ( upload_pflag == 1 ) ? " -p" : "", filename, backup_upload_fn[sid], upload_file_size[sid]);
						}
						else
						{
							snprintf(buf, sizeof(buf),
									"INSERT INTO sftpcomm(sid,comm,at,filename,backupflag,backupsize)" \
									"VALUES(%d,'%s%s %s',now(),'%s',%d, %d)",
									last_insert_id[sid], "put", ( upload_pflag == 1 ) ? " -p" : "", filename, backup_upload_fn[sid], 1, upload_file_size[sid]);
						}

						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "SID = %d, Mysql insert \"put\" command log success!\n", sid );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
						update_sftp_cmd_cnt(sql_conn, sid);
					}
				}
				else
				{
					//error
				}
			}

			/* Process mkdir command */
			if( ctype == SSH2_FXP_MKDIR && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *dirpath = buffer_get_string( cbuf, NULL );
				//printf( "g2u: %s\n", g2u( dirpath ) );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "mkdir", g2u( dirpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"mkdir\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
						update_sftp_cmd_cnt(sql_conn, sid);
				}
			}

			/* Process rmdir command */
			if( ctype == SSH2_FXP_RMDIR && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *dirpath = buffer_get_string( cbuf, NULL );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "rmdir", g2u( dirpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"rmdir\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
						update_sftp_cmd_cnt(sql_conn, sid);
				}
			}

			/* Process SYMLINK command */
			if( ctype == SSH2_FXP_SYMLINK && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *oldpath = buffer_get_string( cbuf, NULL );
				char *newpath = buffer_get_string( cbuf, NULL );

				bzero( oldt, sizeof(oldt) );
				bzero( newt, sizeof(newt) );
				strcpy( oldt, g2u(oldpath) );
				strcpy( newt, g2u(newpath) );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s %s',now(),%d)",
							last_insert_id[sid], "ln", oldt, newt, ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"ln\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
						update_sftp_cmd_cnt(sql_conn, sid);
				}
			}

			/* Process rm command */
			if( ctype == SSH2_FXP_REMOVE && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *rmpath = buffer_get_string( cbuf, NULL );

				if( sql_conn )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "rm", g2u( rmpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"rm\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
						update_sftp_cmd_cnt(sql_conn, sid);
				}
			}

			/* Process chmod command */
			if( ctype == SSH2_FXP_SETSTAT && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				/* Skip type and id */
				buffer_get_char( cbuf );
				buffer_get_int( cbuf );

				char *chpath = buffer_get_string( cbuf, NULL );
				Attrib *attr = decode_attrib( cbuf );

				if( attr->flags & SSH2_FILEXFER_ATTR_PERMISSIONS )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %o %s',now(),%d)",
							last_insert_id[sid], "chmod", attr->perm & 07777, g2u( chpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					if( sql_conn )
					{
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"chmod\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
						update_sftp_cmd_cnt(sql_conn, sid);
					}
				}

				if( attr->flags & SSH2_FILEXFER_ATTR_UIDGID )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %d:%d %s',now(),%d)",
							last_insert_id[sid], "chown", attr->uid, attr->gid, g2u( chpath ), ( server_status == SSH2_FX_OK ) ? 1 : 0 );

					if( sql_conn )
					{
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"chown\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
						update_sftp_cmd_cnt(sql_conn, sid);
					}
				}
			}

			/* Process cd command */
			if( ctype == SSH2_FXP_REALPATH )
			{
				char *cdpath;
				int cdret;

				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				if( stype == SSH2_FXP_NAME )
				{
					buffer_get_int( sbuf );
					cdpath = buffer_get_string( sbuf, NULL );
					cdret = 1;
				}
				else
				{
					buffer_get_char( cbuf );
					buffer_get_int( cbuf );
					cdpath = buffer_get_string( cbuf, NULL );
					cdret = 0;
				}

				if( sql_conn && 0 )
				{
					snprintf( buf, sizeof( buf ),
							"INSERT INTO sftpcomm(sid,comm,at,successed) VALUES(%d,'%s %s',now(),%d)",
							last_insert_id[sid], "cd", g2u( cdpath ), ( cdret ) ? 1 : 0 );

					/* Insert success */
					if( !mysql_query( sql_conn, buf ) )
					{
						printf( "Mysql insert \"cd\" command log success!\n" );
					}
					else
					{
						if( mysql_errno( sql_conn ) )
						{
							printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
						}
					}
						update_sftp_cmd_cnt(sql_conn, sid);
				}
			}

			/* Process rename command */
			if(( ctype == SSH2_FXP_RENAME || ctype == SSH2_FXP_EXTENDED ) && stype == SSH2_FXP_STATUS )
			{
				/* Skip type and id */
				buffer_get_char( sbuf );
				buffer_get_int( sbuf );

				/* Get status in server buffer */
				u_int server_status = buffer_get_int( sbuf );

				if( server_status == SSH2_FX_OK )
				{
					/* Skip type and id */
					buffer_get_char( cbuf );
					buffer_get_int( cbuf );

					/* Skip "posix-rename@openssh.com" */
					if( ctype == SSH2_FXP_EXTENDED )
					{
						buffer_get_string( cbuf, NULL );
					}

					char * oldpath = buffer_get_string( cbuf, NULL );
					char * newpath = buffer_get_string( cbuf, NULL );

					bzero( oldt, sizeof(oldt) );
					bzero( newt, sizeof(newt) );
					strcpy( oldt, g2u(oldpath) );
					strcpy( newt, g2u(newpath) );

					//printf( "old:%s  new:%s\n", oldpath, newpath );
					//printf( "old:%s  new:%s\n", oldt, newt );
					//printf( "old:%s  new:%s\n", oldpath, newpath );

					bzero(buf, sizeof(buf));
					snprintf( buf, sizeof( buf ), "[%s] rename %s %s %s <- %s\n",
							str_time( time( NULL ), NULL ), oldt, newt, cstr, sstr );
					write( sftp_log, buf, strlen( buf ) );

					if( sql_conn )
					{
						snprintf( buf, sizeof( buf ),
								"INSERT INTO sftpcomm(sid,comm,at) VALUES(%d,'%s %s %s',now())",
								last_insert_id[sid], "rename", oldt, newt );

						/* Insert success */
						if( !mysql_query( sql_conn, buf ) )
						{
							printf( "Mysql insert \"rename\" command log success!\n" );
						}
						else
						{
							if( mysql_errno( sql_conn ) )
							{
								printf( "Mysql Error: %s\n", mysql_error( sql_conn ) );
							}
						}
						update_sftp_cmd_cnt(sql_conn, sid);
					}
				}
			}

			queue_pop();
		}
	}//end for(;;)

	/* If the spoofed client decided to shut down the connection, this is
	 * a great place for hijacking :-) */
	if( errno && n )
		logit( "** Error: %s\n", strerror( errno ) );

	packet_close();
	kill( SIGTERM, pid );
	wait( NULL );

	if( src_data > 0 )
		close( src_data );

	if( dst_data > 0 )
		close( dst_data );

	if( sftp_log > 0 )
		close( sftp_log );

	if( logf )
		fclose( logf );

	/*if( log_download_file_data > 0 )
		close( log_download_file_data );

	if( backup_upload_file > 0 )
		close( backup_upload_file );
*/
	exit( errno ? EXIT_FAILURE : EXIT_SUCCESS );
}

struct simple_packet data_cpy[64];
int data_cnt = 0;
struct simple_packet aareq_cpy[64];
int aareq_cnt = 0;

uid_t original_real_uid;
uid_t original_effective_uid;
pid_t proxy_command_pid;
Options client_options;

extern int supported_authentications;

int target_auth( int sock, int sp, int * client_session_id_arg )
{
	printf( "target_auth!\n" );
	char * pt;
	int i, ret = 1, index, remote_id, size, num_prompts, uret;
	int userauth_failure_cnt = 0, challenge_failure_cnt = 0, is_challenge = 1, passwd_len;
	struct simple_packet spkt;
	struct timeval timeout;
	char * padded, target_password[512], status;
	int client_session_id=0, server_session_id = 0;
	/* Creat SSH2 Request and Password string */
	if( compat20 )
	{
		packet_start( SSH2_MSG_SERVICE_REQUEST );
		packet_put_cstring( "ssh-userauth" );
		packet_send();
		packet_write_wait();
	}
	/* Creat SSH1 Request and Password string */
	else
	{
		packet_start( SSH_CMSG_USER );
		packet_put_cstring( conn2server_username );
		packet_send();
		packet_write_wait();
	}

	fd_set readset;
	FD_ZERO( &readset );
	FD_SET( sock, &readset );
	FD_SET( sp,   &readset );
	memset( &spkt, 0x00, sizeof( spkt ) );

	while( ret )
	{
		fd_set readtmp;
		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		if( select(( sock > sp ? sock : sp ) + 1, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		if( FD_ISSET( sock, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading from client on client side" );

			while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
			{
				pt = packet_get_raw( &spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				memcpy( spkt.data, pt, spkt.len );
				debug( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

				if( show_stream )
				{
					printf( "[target auth@%d] from server. type=%d  %d: ", getpid(), spkt.type, spkt.len );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else
							printf( " %02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );
				}

				if( compat20 )
				{
					if( spkt.type == SSH2_MSG_SERVICE_ACCEPT && !publickey_auth )
					{
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "none" );
						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_SERVICE_ACCEPT && publickey_auth )
					{
						//chmod ( privatekey_path, 0600 );
						//uret = userauth_pubkey_client(conn2server_username, privatekey_path,"");
						chmod ( privatekey_path, 0400 );
						if (strlen(conn2server_password) == 0)
							uret = userauth_pubkey_client(conn2server_username, privatekey_path,"");
						else
							uret = userauth_pubkey_client(conn2server_username, privatekey_path,conn2server_password);

						printf( "userauth_pubkey_client ret = %d\n", uret );
						if ( uret == 10 )
						{
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "Private key need passphrase.\n" );
						}
						else if ( uret == -1 )
						{
							status = 0x01;
							write( sp, &status, 1 );
							usleep(200000);
							fatal( "Can't find private key \"%s\".", privatekey_path );
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_SUCCESS && publickey_auth )
					{
						status = 0x01;
						writen( sp, &status, 1 );
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_FAILURE && publickey_auth )
					{
						status = 0x01;
						write( sp, &status, 1 );
						usleep(200000);
						fatal( "Server can not match this private key. ERROR.\n" );

						//ret = 0;
						//return 0;
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_FAILURE )
					{
						userauth_failure_cnt++;

						if( userauth_failure_cnt == 1 )
						{
							char *method = packet_get_string(NULL);

							if( strstr( method,"keyboard-interactive" ) == NULL )
							{
								packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "password" );
							packet_put_char( 0 );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
							}
							else
							{
							packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "keyboard-interactive" );
							packet_put_cstring( "" );
							packet_put_cstring( "" );
							packet_send();
							packet_write_wait();
							}

							xfree( method );
						}
						else if( is_challenge == 1 && userauth_failure_cnt == 2 )
						{
							packet_start( SSH2_MSG_USERAUTH_REQUEST );
							packet_put_cstring( conn2server_username );
							packet_put_cstring( "ssh-connection" );
							packet_put_cstring( "password" );
							packet_put_char( 0 );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
						}
						else
						{
							//char tmpbuf[] = "password error!";
							//printf("size: %d\n", sizeof(tmpbuf) );
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "PASSWORD ERROR\n" );
						}
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_INFO_REQUEST )
					{
						is_challenge = 1024;
						packet_get_string( NULL );
						packet_get_string( NULL );
						packet_get_string( NULL );
						num_prompts = packet_get_int();

						if( num_prompts > 1 )
						{
							/* debug */
						}

						packet_start( SSH2_MSG_USERAUTH_INFO_RESPONSE );
						packet_put_int( num_prompts );

						for( i = 0; i < num_prompts; i++ )
						{
							packet_get_string( NULL );
							packet_get_char();
							packet_put_cstring( conn2server_password );
						}

						packet_send();
						packet_write_wait();
					}
					else if( spkt.type == SSH2_MSG_USERAUTH_SUCCESS && !publickey_auth )
					{
						//ret = 0;
						status = 0x01;
						writen( sp, &status, 1 );
					}
				}

				else
				{
					if( is_challenge && spkt.type == SSH_SMSG_FAILURE )
					{
						is_challenge --;
						challenge_failure_cnt++;

						/*if ((supported_authentications & (1 << SSH_AUTH_TIS)) &&
						  client_options.challenge_response_authentication &&
						  !client_options.batch_mode)*/
						if( challenge_failure_cnt == 1 )
						{
							packet_start( SSH_CMSG_AUTH_TIS );
							packet_send();
							packet_write_wait();
						}
						else
						{
							status = 0x0;
							writen( sp, &status, 1 );
							printf( "Password error!\n" );
						}

						/*if ((supported_authentications & (1 << SSH_AUTH_PASSWORD)) &&
						  client_options.password_authentication &&
						  !client_options.batch_mode)
						  {
						  packet_start(SSH_CMSG_AUTH_PASSWORD);
						  packet_put_cstring(conn2server_password);
						  packet_send();
						  packet_write_wait();
						  }*/
					}
					else if( !is_challenge && spkt.type == SSH_SMSG_FAILURE )
					{
						/* Password auth */
						userauth_failure_cnt++;

						if( userauth_failure_cnt == 1 )
						{
							packet_start( SSH_CMSG_AUTH_PASSWORD );
							packet_put_cstring( conn2server_password );
							packet_send();
							packet_write_wait();
						}
						else
						{
							status = 0x02;
							writen( sp, &status, 1 );
							printf( "Password error!\n" );
						}
					}
					else if( spkt.type == SSH_SMSG_SUCCESS )
					{
						status = 0x01;
						writen( sp, &status, 1 );
					}
					else if( spkt.type == SSH_SMSG_AUTH_TIS_CHALLENGE )
					{
						is_challenge = 1024;
						packet_start( SSH_CMSG_AUTH_TIS_RESPONSE );
						size = roundup( strlen( conn2server_password ) + 1, 32 );
						padded = xcalloc( 1, size );
						strlcpy( padded, conn2server_password, size );
						packet_put_string( padded, size );
						printf( "size = %d\n", size );
						memset( padded, 0, size );
						xfree( padded );
						packet_send();
						packet_write_wait();
					}
				}

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}

		if( FD_ISSET( sp, &readtmp ) )
		{
			bzero( target_password, sizeof( target_password ) );
			//printf("recv\n");
			readn( sp, target_password, 4 );
			//printf("recv\n");
			passwd_len = get_u32( target_password );

			if( passwd_len == 1024 )
			{
				ret = 0;
			}
			else
			{
				readn( sp, target_password + 4, passwd_len );
				//printf("%d %s\n", passwd_len, target_password+4);

				if( compat20 )
				{
					if ( publickey_auth )
					{
						uret =  userauth_pubkey_client(conn2server_username, privatekey_path,target_password + 4);
						printf( "userauth_pubkey_client ret = %d\n", uret );
						if ( uret != 1 ) fatal("userauth_pubkey_client failed");
					}
					else if( is_challenge == 1 )
					{
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "password" );
						packet_put_char( 0 );
						packet_put_cstring( target_password + 4 );
						packet_send();
						packet_write_wait();
					}
					else
					{
						strcpy( conn2server_password, target_password + 4 );
						packet_start( SSH2_MSG_USERAUTH_REQUEST );
						packet_put_cstring( conn2server_username );
						packet_put_cstring( "ssh-connection" );
						packet_put_cstring( "keyboard-interactive" );
						packet_put_cstring( "" );
						packet_put_cstring( "" );
						packet_send();
						packet_write_wait();
					}
				}
				else//ssh1
				{
					if( is_challenge > 0 )
					{
						/*packet_start(SSH_CMSG_AUTH_TIS_RESPONSE);
						  size = roundup(strlen(target_password+4) + 1, 32);
						  padded = xcalloc(1, size);
						  strlcpy(padded, target_password+4, size);
						  packet_put_string(padded, size);
						  printf("size = %d\n", size);
						  memset(padded, 0, size);
						  xfree(padded);
						  packet_send();
						  packet_write_wait();*/
						strcpy( conn2server_password, target_password + 4 );
						packet_start( SSH_CMSG_AUTH_TIS );
						packet_send();
						packet_write_wait();
					}
					else
					{
						packet_start( SSH_CMSG_AUTH_PASSWORD );
						packet_put_cstring( target_password + 4 );
						packet_send();
						packet_write_wait();
					}
				}
			}
		}
	}

	if( compat20 )
	{
		for( index = 0; index < mitm_channel_cnt; index++ )
		{
			int j;
			printf( "lianjie : spkt.type = %d, spkt.len = %d\n", mitm_channel_request[index].type, mitm_channel_request[index].len );

			/* add for H3C */
			u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(mitm_channel_request[index].data[0]));
			u_char replace_buf[4];
			if( mitm_channel_request[index].type >= 91 && mitm_channel_request[index].type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				//put_u32( replace_buf, session_map[proxy2client_sessionid] );
				put_u32( replace_buf, session_map[client_session_id] );
				printf( "Audit tell client server session id is %d, but the real server sid is %d\n", proxy2client_sessionid, session_map[client_session_id] );
				for( j = 0; j < 4; j++ )
				{
					mitm_channel_request[index].data[j] = replace_buf[j];
				}
			}


			for( j = 0; j < mitm_channel_request[index].len; j++ )
			{
				if( isprint( mitm_channel_request[index].data[j] ) ) printf( "%c", mitm_channel_request[index].data[j] );
				else printf( "%02x ", ( u_char )mitm_channel_request[index].data[j] );
			}

			printf( "\n" );

			/* add for H3C */
			/*u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(mitm_channel_request[index].data[0]));
			u_char replace_buf[4];
			if( mitm_channel_request[index].type >= 91 && mitm_channel_request[index].type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				put_u32( replace_buf, session_map[proxy2client_sessionid] );
				for( j = 0; j < 4; j++ )
				{
					mitm_channel_request[index].data[4+j] = replace_buf[j];
				}
			}*/

			packet_start( mitm_channel_request[index].type );
			packet_put_raw( mitm_channel_request[index].data, mitm_channel_request[index].len );
			packet_send();
			packet_write_wait();
			ret = mitm_channel_reply[index];
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( ret )
			{
				if( select( sock + 1, &readset, NULL, NULL, NULL ) < 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						/*for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}*/
						unsigned char *p1=&spkt;
						for( i = 0; i < spkt.len+8; i++ )
						{
							if( isprint( *(p1+i) ) ) printf( "%c", *(p1+i) );
							else printf( " %02x ", *(p1+i) );
						}

						printf( "\n" );

						if( spkt.type == 94 )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}
						else if( spkt.type == 91 )
						{
							client_session_id = packet_get_int();
							server_session_id = packet_get_int();
							printf( "client_session_id=%d, server_session_id=%d\n", client_session_id, server_session_id );
							session_map[client_session_id] = server_session_id;
							if( client_session_id_arg != NULL ) *client_session_id_arg = client_session_id;
							ret = 0;
						}
						else if( spkt.type == 99 || spkt.type == 93 )
						{
							remote_id = packet_get_int();

							//printf( "remote_id = %d\n", remote_id );
							if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
							{
								/* to fix when will appear type 93 data */
								if( no_shell && spkt.type == 99 && aareq_cnt == 0 )
								{
									unsigned char tmp93[16] = {0x5d,0x00,0x00,0x00,0x08,0x00,0x00,0x00,0x00,0x00,0x01,0x00,0x00,0x20,0x00,0x00 };
									printf ("client session id = %d, session_map = %d\n", client_session_id, session_map[client_session_id]);
									//put_u32( &tmp93[8], session_map[client_session_id] );
									put_u32( &tmp93[8], client_session_id );
									memcpy( &aareq_cpy[aareq_cnt++], tmp93, 16 );
								}
								/* for freesshd*/
								/*else if (remote_id == 256)
								{
									unsigned char tmp93[16] = {0x5d,0x00,0x00,0x00,0x08,0x00,0x00,0x00,0x00,0x00,0x01,0x00,0x00,0x20,0x00,0x00 };
									put_u32( &tmp93[8], session_map[client_session_id] );
									memcpy( &aareq_cpy[aareq_cnt++], tmp93, 16 );
								}
								else*/
									memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
							}

							ret = 0;
						}
						else
						{
							ret = 0;
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}

				printf( "ret = %d\n", ret );
			}
		}

		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sock, &readset );

		while( 0 && conn_mode != CONN_PROXY_REPLAY  )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 3000 * 1000;

			if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;

				break;
			}

			if( FD_ISSET( sock, &readset ) )
			{
				while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
				{
					pt = packet_get_raw( &spkt.len );

					/* Do not send along packets that only affect us */
					if( process_packet( spkt.type, spkt.data ) != 0 )
					{
						memset( &spkt, 0x00, spkt.len + 8 );
						continue;
					}

					if( spkt.len > sizeof( spkt.data ) )
					{
						fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
								spkt.len, sizeof( spkt.data ) );
					}

					memcpy( spkt.data, pt, spkt.len );
					debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
					printf( "lianjie wait for welcome message: copy %d:: type = %d with time out.", index, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( "%02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );

					if( conn_mode != CONN_PROXY_REPLAY && spkt.type == 94 )
					{
						memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
					}
					else if( spkt.type == 99 || spkt.type == 93 )
					{
						remote_id = packet_get_int();

						//printf( "remote_id = %d\n", remote_id );
						if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
						{
							memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
						}

						ret = 0;
					}
					else
					{
						ret = 0;
					}

					memset( &spkt, 0x00, spkt.len + 8 );
				}
			}
		}

		if( 0 && auto_su && conn_mode < 5  && no_shell == 0 )
		{
			packet_start( 94 );
			packet_put_int(session_map[client_session_id]);
			/*if ( !router )
			  packet_put_cstring("su -\x0d");
			  else
			  packet_put_cstring("enable\x0d");*/
			char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", "super 3" );
			printf("****su %s\n", su_command);
			packet_put_cstring( command_buf );
			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( 1 )
			{
				timeout.tv_sec = 0;
				timeout.tv_usec = 1000 * 1000;

				if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );

						if( spkt.type == 94 )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}
						else if( spkt.type == 99 || spkt.type == 93 )
						{
							remote_id = packet_get_int();

							//printf( "remote_id = %d\n", remote_id );
							if( no_shell || ( remote_id != 0 && remote_id != 256 ) )
							{
								memcpy( &aareq_cpy[aareq_cnt++], &spkt, spkt.len + 8 );
							}

							ret = 0;
						}
						else
						{
							ret = 0;
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}

			packet_start( 94 );
			packet_put_int(session_map[client_session_id]);
			//char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
			packet_put_cstring( command_buf );
			packet_send();
			packet_write_wait();
		}

	}
	else
	{

		for( index = 0; index < mitm_channel_cnt; index++ )
		{
			packet_start( mitm_channel_request[index].type );
			packet_put_raw( mitm_channel_request[index].data, mitm_channel_request[index].len );
			packet_send();
			packet_write_wait();
			ret = mitm_channel_reply[index];
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( ret )
			{
				if( select( sock + 1, &readset, NULL, NULL, NULL ) < 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

						//                    printf ("lianjie: ");
						//                    for ( i = 0; i < spkt.len; i++ )
						//                    {
						//                        printf( "%02x ", (u_char)spkt.data[i] );
						//                    }
						//                    printf("\n");
						if( spkt.type == 17 )
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );

						ret = 0;
						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}
		}

		memset( &spkt, 0x00, sizeof( spkt ) );
		FD_ZERO( &readset );
		FD_SET( sock, &readset );

		while( 1 )
		{
			timeout.tv_sec = 0;
			timeout.tv_usec = 200 * 1000;

			if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
			{
				if( errno == EINTR )
					continue;

				break;
			}

			if( FD_ISSET( sock, &readset ) )
			{
				while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
				{
					pt = packet_get_raw( &spkt.len );

					/* Do not send along packets that only affect us */
					if( process_packet( spkt.type, spkt.data ) != 0 )
					{
						memset( &spkt, 0x00, spkt.len + 8 );
						continue;
					}

					if( spkt.len > sizeof( spkt.data ) )
					{
						fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
								spkt.len, sizeof( spkt.data ) );
					}

					memcpy( spkt.data, pt, spkt.len );
					debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
					printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

					for( i = 0; i < spkt.len; i++ )
					{
						if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
						else printf( "%02x ", ( u_char )spkt.data[i] );
					}

					printf( "\n" );

					if( spkt.type == 17 )
					{
						memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
					}
					else
					{
						ret = 0;
					}

					memset( &spkt, 0x00, spkt.len + 8 );
				}
			}
		}

		if( auto_su && conn_mode < 5 && no_shell == 0 )
		{
			packet_start( SSH_CMSG_STDIN_DATA );

			char command_buf[32];
			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_command );
			packet_put_cstring( command_buf );

			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, sizeof( spkt ) );
			FD_ZERO( &readset );
			FD_SET( sock, &readset );

			while( 1 )
			{
				timeout.tv_sec = 0;
				timeout.tv_usec = 200 * 1000;

				if( select( sock + 1, &readset, NULL, NULL, &timeout ) <= 0 )
				{
					if( errno == EINTR )
						continue;

					break;
				}

				if( FD_ISSET( sock, &readset ) )
				{
					while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
					{
						pt = packet_get_raw( &spkt.len );

						/* Do not send along packets that only affect us */
						if( process_packet( spkt.type, spkt.data ) != 0 )
						{
							memset( &spkt, 0x00, spkt.len + 8 );
							continue;
						}

						if( spkt.len > sizeof( spkt.data ) )
						{
							fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
									spkt.len, sizeof( spkt.data ) );
						}

						memcpy( spkt.data, pt, spkt.len );
						debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );
						printf( "lianjie: copy %d:: type = %d ", index, spkt.type );

						for( i = 0; i < spkt.len; i++ )
						{
							if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
							else printf( "%02x ", ( u_char )spkt.data[i] );
						}

						printf( "\n" );

						if( spkt.type == SSH_SMSG_STDOUT_DATA )
						{
							memcpy( &data_cpy[data_cnt++], &spkt, spkt.len + 8 );
						}

						memset( &spkt, 0x00, spkt.len + 8 );
					}
				}
			}

			packet_start( SSH_CMSG_STDIN_DATA );

			bzero( command_buf, sizeof( command_buf ) );
			snprintf( command_buf, sizeof( command_buf ), "%s\x0d", su_password );
			packet_put_cstring( command_buf );

			packet_send();
			packet_write_wait();
		}
	}

	//printf("done!\n");
}


/*
 * Connect to the real target
 * IP and port in network byte order.
 */

	void
target_connect( u_int ip, u_short port, int sp, u_int ssh_proto )
{
	//compat20 = 0;
	//printf("port ===== %d\n", port);
	//publickey_auth = 1;
	//strcpy(privatekey_path,"/home/zhangzhong/id_rsa");
	struct sockaddr_storage hostaddr;
	struct sockaddr_in tin;
	struct simple_packet spkt;
	char target_host[48];
	int sock, i;
	int timeout_ms;
	fd_set readset;
	size_t nfd;
	ssize_t n;
	int client_session_id_arg;

	tin.sin_addr.s_addr = ip;
	snprintf( target_host, sizeof( target_host ), "%s", inet_ntoa( tin.sin_addr ) );


	setproctitle("[%s]Audit->[%s]", str_time(time(NULL), NULL), inet_ntoa( tin.sin_addr ) );

	debug2( "[FREESVR-SSH-PROXY] Connecting to real target (%s %s:%u)",
			ssh_proto == SSH_PROTO_2 ? "SSH2" : "SSH1",
			target_host, ntohs( port ) );

	init_rng();
	original_real_uid = getuid();
	original_effective_uid = geteuid();

	/* Init options */
	initialize_options( &client_options );
	client_options.protocol = ssh_proto;
	client_options.address_family = AF_INET;
	client_options.cipher = -1;

	/* Fill configuration defaults. */
	fill_default_options( &client_options );

	SSLeay_add_all_algorithms();
	ERR_load_crypto_strings();

	channel_set_af( client_options.address_family );
	seed_rng();

	timeout_ms = client_options.connection_timeout * 1000;

	if( ssh_connect( target_host, &hostaddr, htons( port ),
				client_options.address_family, client_options.connection_attempts,
				&timeout_ms, client_options.tcp_keep_alive,
				client_options.use_privileged_port, NULL ) != 0 )
		fatal( "** Error: SSH connection to real target failed\n" );

	//extern supported_authentications;
	//printf ( "supported_authentications = %d\n", supported_authentications);
	/* Exchange protocol version identification strings with the server. */
	ssh_exchange_identification();

	/* Put the connection into non-blocking mode. */
	packet_set_nonblocking();

	/* Exchange keys */
	if( compat20 )
		ssh_kex2( target_host, ( struct sockaddr * )&hostaddr );
	else
		ssh_kex( target_host, ( struct sockaddr * )&hostaddr );

	/* Get the connected socket */
	sock = packet_get_connection_in();
	packet_set_interactive( 0 );

	//printf ( "supported_authentications = %d\n", (supported_authentications & (1 << SSH_AUTH_TIS)));
	//printf ( "supported_authentications = %d\n", (supported_authentications & (1 << SSH_AUTH_PASSWORD)));

	/* Add */
	if( !original_mode_flag && radius_flag == 1 ) target_auth( sock, sp, &client_session_id_arg );

	/* Add */

	printf( "auth ok\n" );
	/* Signal connection to parent */
	kill( getppid(), SIGUSR1 );
	char *pt;

	for( i = 0; i < aareq_cnt; i++ )
	{
		printf( "no empty req\n" );
		writen( sp, &aareq_cpy[i], aareq_cpy[i].len + 8 );
	}

	for( i = 0; i < data_cnt; i++ )
	{
		printf( "no empty date\n" );
		writen( sp, &data_cpy[i], data_cpy[i].len + 8 );
	}

	FD_ZERO( &readset );
	FD_SET( sock, &readset );
	FD_SET( sp, &readset );

	/* Max file descriptor */
	nfd = ( sp > sock ? sp : sock ) + 1;

	memset( &spkt, 0x00, sizeof( spkt ) );

	for( ;; )
	{
		fd_set readtmp;

		memcpy( &readtmp, &readset, sizeof( readtmp ) );

		debug4( "[FREESVR-SSH-PROXY] Selecting on client side" );

		if( select( nfd, &readtmp, NULL, NULL, NULL ) < 0 )
		{
			if( errno == EINTR )
				continue;

			break;
		}

		/* Read from socketpair and write to server */
		if( FD_ISSET( sp, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading spkt header on client side" );

			if(( n = readn( sp, &spkt, 8 ) ) <= 0 )
				break;

			if( spkt.len > sizeof( spkt.data ) )
			{
				fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
						spkt.len, sizeof( spkt.data ) );
			}

			debug3( "[FREESVR-SSH-PROXY] Got %u bytes from server process", spkt.len );

			if( spkt.len && ( n = readn( sp, spkt.data, spkt.len ) ) <= 0 )
				break;

			/* add for H3C */
			u_int32_t proxy2client_sessionid;

			proxy2client_sessionid = get_u32(&(spkt.data[0]));
			u_char replace_buf[4];
			int j;
			if( spkt.type >= 91 && spkt.type <= 100 && proxy2client_sessionid == proxy_server_session_id )
			{
				printf("******replace session id \n");
				put_u32( replace_buf, session_map[client_session_id_arg] );
				//put_u32( replace_buf, 1 );
				//put_u32( replace_buf, 256 );
				for( j = 0; j < 4; j++ )
				{
					spkt.data[j] = replace_buf[j];
				}
			}
			for( i = 0; i < spkt.len; i++ )
			{
				if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
				else printf( "%02x ", ( u_char )spkt.data[i] );
			}

			printf( "\n" );

			packet_start( spkt.type );
			packet_put_raw( spkt.data, spkt.len );
			packet_send();
			packet_write_wait();
			memset( &spkt, 0x00, spkt.len + 8 );
		}

		/* Read from target and write to socketpair */
		if( FD_ISSET( sock, &readtmp ) )
		{

			debug4( "[FREESVR-SSH-PROXY] Reading from client on client side" );

			while(( spkt.type = packet_read_next( sock ) ) != SSH_MSG_NONE )
			{
				pt = packet_get_raw( &spkt.len );

				/* Do not send along packets that only affect us */
				if( process_packet( spkt.type, spkt.data ) != 0 )
				{
					memset( &spkt, 0x00, spkt.len + 8 );
					continue;
				}

				if( spkt.len > sizeof( spkt.data ) )
				{
					fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
							spkt.len, sizeof( spkt.data ) );
				}

				memcpy( spkt.data, pt, spkt.len );
				debug3( "[FREESVR-SSH-PROXY] Got %u bytes from target [type %u]", spkt.len, spkt.type );

				if( writen( sp, &spkt, spkt.len + 8 ) != spkt.len + 8 )
					break;

				memset( &spkt, 0x00, spkt.len + 8 );
			}
		}
	}

	if( errno && n )
		logit( "** Error: %s\n", strerror( errno ) );

	packet_close();
	exit( errno ? EXIT_FAILURE : EXIT_SUCCESS );
}
