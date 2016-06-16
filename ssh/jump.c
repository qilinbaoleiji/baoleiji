#define _GNU_SOURCE
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "ssh.h"
#include "ssh1.h"
#include "ssh2.h"
#include "dispatch.h"
#include "kex.h"
#include "compat.h"
#include "message.h"
#include "mysql.h"

#define SUPER_MAX_PACKET_SIZE   (1024*1024)

extern Kex *xxx_kex;

struct simple_packet
{
	u_int type;
	u_int len;
	char data[SUPER_MAX_PACKET_SIZE+12];
};

int jump_analyze_stream( fd_set *readset, int nfd, int sfd, int pfd, char *keyword[], int crlf )
{
	fd_set readtmp;
	struct simple_packet spkt;
	int n, i, select_ret, set_timeout = 0, reply_len = 0;
	char reply_str[2048], *pt, *sp, *rp;
	struct timeval timeout;

	memset( reply_str, 0x00, sizeof( reply_str ) );

	for( ;; )
	{
		memcpy( &readtmp, readset, sizeof( readtmp ) );

		if( set_timeout > 0 )
		{
			timeout.tv_sec  = 6;
			timeout.tv_usec = 0;
			if( ( select_ret = select( nfd, &readtmp, NULL, NULL, &timeout ) ) <= 0 )
			{
				if( select_ret == 0 )
				{
					printf( "[%s] Wait for server reply timeout.\n", __func__ );
					return -1;
				}

				if( errno == EINTR )
					continue;

				break;
			}
		}
		else
		{
			if( ( select_ret = select( nfd, &readtmp, NULL, NULL, NULL ) ) <= 0 )
			{
				if( select_ret == 0 )
				{
					continue;
				}

				if( errno == EINTR )
					continue;

				break;
			}
		}

		/* Read from client and write to socketpair */
		/* Log the stream of client */
		if( FD_ISSET( sfd, &readtmp ) )
		{
			debug( "[FREESVR-SSH-PROXY] Reading from client on server side %d", getpid() );

			while(( spkt.type = packet_read_next( sfd ) ) != SSH_MSG_NONE )
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
					}
					else if( spkt.type != 94 )
					{
						writen( pfd, &spkt, spkt.len + 8 );
					}
				}
				else
				{
					if(( spkt.type != SSH_CMSG_STDIN_DATA ) &&
							( spkt.type != SSH_SMSG_STDOUT_DATA ) &&
							( spkt.type != SSH_SMSG_STDERR_DATA ) )
					{
						writen( pfd, &spkt, spkt.len + 8 );
					}
				}
			}
		}

		if( FD_ISSET( pfd, &readtmp ) )
		{
			debug4( "[FREESVR-SSH-PROXY] Reading spkt header on server side" );

			if(( n = readn( pfd, &spkt, 8 ) ) <= 0 )
				break;

			if( spkt.len > sizeof( spkt.data ) )
			{
				fatal( "** Darn, buffer to small (%u) for received packet (%u)\n",
						spkt.len, sizeof( spkt.data ) );
			}

			debug4( "[FREESVR-SSH-PROXY] Reading %u bytes from socketpair on server side", spkt.len );

			if( spkt.len && ( n = readn( pfd, spkt.data, spkt.len ) ) <= 0 )
				break;

			if( 1 )
			{
				printf( "[%s] len=%d type=%d set_timeout = %d: ", __func__, spkt.len, spkt.type, set_timeout );

				for( i = 0; i < spkt.len; i++ )
				{
					if( isprint( spkt.data[i] ) ) printf( "%c", spkt.data[i] );
					else printf( " %02x ", ( unsigned char )spkt.data[i] );
				}

				printf( "\n" );
			}

			for( i = 8; i < spkt.len; i++ )
			{
				reply_str[reply_len++] = spkt.data[i];
			}

			packet_start( spkt.type );
			packet_put_raw( spkt.data, spkt.len );
			packet_send();
			packet_write_wait();

			if( set_timeout == 0 && crlf > 0 )
			{
				for( i = 0; i < reply_len; i++ )
				{
					if( isprint( reply_str[i] ) ) printf( "%c", reply_str[i] );
					else printf( " %02x ", ( unsigned char )reply_str[i] );
				}
				printf( "\n" );

				for( i = 0, sp = reply_str; i < crlf; i++ )
				{
					rp = strstr( sp, "\xd\xa" );

					if( rp == NULL )
						break;
					else
						sp = rp + 2;
				}

				if( rp != NULL )
				{
					/*set_timeout = 1;
					  memset( reply_str, 0x00, sizeof( reply_str ) );
					  reply_len = 0;*/

					if( sp - reply_str < reply_len )
					{
						set_timeout = 2;
						i = 0;
						while( keyword[i] != NULL )
						{
							printf( "keyword = %s\n", keyword[i] );
							if( strcasestr( sp, keyword[i] ) != NULL )
								return i;
							i++;
						}
					}
					else
					{
						set_timeout = 1;
						memset( reply_str, 0x00, sizeof( reply_str ) );
						reply_len = 0;
					}

				}
			}
			else
			{
				for( i = 0; i < reply_len; i++ )
				{
					if( isprint( reply_str[i] ) ) printf( "%c", reply_str[i] );
					else printf( " %02x ", ( unsigned char )reply_str[i] );
				}
				printf( "\n" );
				set_timeout = 2;
				i = 0;
				while( keyword[i] != NULL )
				{
					printf( "keyword = %s\n", keyword[i] );
					if( strcasestr( reply_str, keyword[i] ) != NULL )
						return i;
					i++;
				}
			}

		}
	}

}

void jump_sendto_server( int pfd, const char *data_str, int data_len, int c2p_sid )
{
	struct simple_packet spkt;

	memset( &spkt, 0x00, sizeof( spkt ) );
	spkt.type = SSH2_MSG_CHANNEL_DATA;
	spkt.len  = data_len + 8;
	put_u32( &spkt.data[0], c2p_sid );
	put_u32( &spkt.data[4], data_len );
	memcpy( &spkt.data[8], data_str, data_len );
	writen( pfd, &spkt, spkt.len + 8 );
}

int login_server( const char *dest_ip, unsigned short int dest_port, const char *dest_username, const char *dest_password,
		int auto_su, const char *su_command, const char *su_password, int login_method,
		int sfd, int pfd, int c2p_sid )
{
	char *keyword[] = { "yes/no", "password", "\xbf\xda\xc1\xee", "Username:", "Login:", "last login", "no host", "Connection refused", "Error:", "Info:", 0 };
	char buf[512], cmd[256];
	char *keyword2[] = { "\x0d\x0a", 0 };
	int nfd, ret, i;
	fd_set readset;

	FD_ZERO( &readset );
	FD_SET( sfd, &readset );
	FD_SET( pfd, &readset );

	/* Max file descriptor */
	nfd = ( sfd > pfd ? sfd : pfd ) + 1;

	memset( buf, 0x00, sizeof( buf ) );

	//jump_sendto_server( pfd, "\x03", 1, c2p_sid );
	//ret = jump_analyze_stream( &readset, nfd, sfd, pfd, keyword2, 0 );

	for( i = 0; i < 50; i++ )
	{
		buf[i] = 0x7f;
	}
	
	if( login_method ==5 )
	{
		snprintf( &buf[50], sizeof( buf ), "telnet %s %d\xd", dest_ip, dest_port );
		if ( strlen(dest_username) )
			snprintf( &cmd, sizeof( cmd ), "telnet %s %d -l %s", dest_ip, dest_port, dest_username );
		else 
			snprintf( &cmd, sizeof( cmd ), "telnet %s %d", dest_ip, dest_port );
	}
	else if( strlen(dest_username) )
	{
		snprintf( &buf[50], sizeof( buf ), "ssh %s@%s -p %d\xd", dest_username, dest_ip, dest_port );
		snprintf( &cmd, sizeof( cmd ), "ssh %s@%s -p %d", dest_username, dest_ip, dest_port );
	}
	else
	{
		snprintf( &buf[50], sizeof( buf ), "ssh %s -p %d\xd", dest_ip, dest_port );
		snprintf( &cmd, sizeof( cmd ), "ssh %s -p %d", dest_ip, dest_port );
	}

	

	jump_sendto_server( pfd, buf, strlen( buf ), c2p_sid );

	ret = jump_analyze_stream( &readset, nfd, sfd, pfd, keyword, 1 );

	if( ret == -1 )
	{
		/* time out */
		return -1;
	}

	update_mysql( cmd );

	/* yes/no */
	if( ret == 0 )
	{
		memset( buf, 0x00, sizeof( buf ) );
		snprintf( buf, sizeof( buf ), "yes\xd" );
		jump_sendto_server( pfd, buf, strlen( buf ), c2p_sid );

		ret = jump_analyze_stream( &readset, nfd, sfd, pfd, keyword, 1 );
	}

	/* username of telnet */
	if( ret == 3 || ret == 4 )
	{
		memset( buf, 0x00, sizeof( buf ) );
		snprintf( buf, sizeof( buf ), "%s\xd", dest_username );
		jump_sendto_server( pfd, buf, strlen( buf ), c2p_sid );
		ret = jump_analyze_stream( &readset, nfd, sfd, pfd, keyword, 1 );
	}

	/* password , kouling */
	if( ret == 1 || ret == 2 )
	{
		memset( buf, 0x00, sizeof( buf ) );
		snprintf( buf, sizeof( buf ), "%s\xd", dest_password );
		jump_sendto_server( pfd, buf, strlen( buf ), c2p_sid );

		ret = jump_analyze_stream( &readset, nfd, sfd, pfd, keyword, 1 );
	}

	return 0;
}

int jump_select_username( int sfd, int session_id, int snum, Select *sinfo, int use_vpn )
{
	int ret = 1, i = 0, choose;
	char prompt[] = "\xd\xa" \
					 "*********************************************\xd\xa" \
					 "************* AUTO JUMP PROGRAM *************\xd\xa" \
					 "*********************************************\xd\xa" \
					 "Please choose a username:\x0d\x0a", buf[128];

	while( ret )
	{
		/* Send prompt */
		packet_start( SSH2_MSG_CHANNEL_DATA );
		packet_put_int( session_id );
		packet_put_string( prompt, strlen( prompt ) );
		packet_send();
		packet_write_wait();

		for( i = 0; i < snum; i++ )
		{
			packet_start( SSH2_MSG_CHANNEL_DATA );
			packet_put_int( session_id );
			if( use_vpn )
				snprintf( buf, sizeof( buf ), "[%d]%s\x0d\x0a", i + 1, sinfo[i].dest_username );
			else
				snprintf( buf, sizeof( buf ), "[%d]%-20s%-35s<%s>\x0d\x0a",
						i + 1, sinfo[i].dest_ip, sinfo[i].dest_username, sinfo[i].login_method == 5 ? "telnet" : "ssh" );
			packet_put_string( buf, strlen( buf ) );
			packet_send();
			packet_write_wait();
		}

		packet_start( SSH2_MSG_CHANNEL_DATA );
		packet_put_int( session_id );
		snprintf( buf, sizeof( buf ), "[%d]Exit from this system!\x0d\x0aInput: ", snum + 1 );
		packet_put_string( buf, strlen( buf ) );
		packet_send();
		packet_write_wait();

		choose = process_select_username_input( sfd, session_id );

		if( choose == snum + 1 )
		{
			return -1;
		}

		else if( choose > 0 && choose <= snum )
		{
			printf( "choose = %d\n", choose );
			return choose;
		}
		else
		{
			packet_start( SSH2_MSG_CHANNEL_DATA );
			packet_put_int( session_id );
			snprintf( buf, sizeof( buf ), "Invalid Number!\x0d\x0a" );
			packet_put_string( buf, strlen( buf ) );
			packet_send();
			packet_write_wait();

			/* loop until valid number */
			ret = 1;
		}
	}

	return -1;
}

int jump( const char *client_username, const char *serverip, const char *sourceip, int login_method, int sfd, int pfd, int session_id, int c2p_sid )
{
	int res = 0, ret, auto_su, conn_mode, snum, publickey_auth, choose, app;
	struct simple_packet spkt;
	Select *sinfo;
	unsigned short int dest_port;
	char *dest_ip, *dest_username, *dest_password, *radius_username, *su_command, *su_password, *forbidden, *privatekey_path;
	char error_msg[] = "\x0d\x0a[AUTO-JUMP] Authentication failed. Permission denied.\x0d\x0a"; 
	char exit_msg[] = "\x0d\x0a[AUTO-JUMP] Exit.\x0d\x0a";

	ret = query2authserver(
			login_method == 5 ? 3: 1, /* type */
			client_username, /* username from client input */
			NULL,//radius_password, /* password from client input */
			serverip == NULL ? "127.0.0.1" : serverip, /* ip address to jump */
			sourceip, /* client ip */
			login_method, /* ssh or telnet */
			serverip == NULL ? 0 : 1, /* use vpn */
			0, /* use radius auth */
			NULL,
			NULL,
			&conn_mode,
			&radius_username,
			&snum,
			&sinfo,
			&dest_ip,
			&dest_port,
			&dest_username,
			&dest_password,
			&auto_su,
			&su_command,
			&su_password,
			&forbidden,
			-1,
			NULL,
			&publickey_auth,
			&privatekey_path );

	printf( "[%s] ret = %d\n", __func__, ret );

	if( ret == 0 )
	{
		printf( "[%s] conn_mode = %d\n", __func__, conn_mode );

		if( conn_mode == CONN_GWVPN_SELECT )
		{
			choose = jump_select_username( sfd, session_id, snum, sinfo, 1 );

			if( choose == -1 )
			{
				printf( "[%s] User exit AUTO-JUMP program.\n", __func__ );
				res = -2;
			}
			else
			{
				/*app = sinfo[choose-1].login_method;
				  if( app == 5 )
				  {
				  ret = telnet2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, 
				  &dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden, NULL );
				  }
				  else*/
				{
					ret = select2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, login_method, &conn_mode,
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden );
				}

				if( ret == 0 )
				{
					//printf( "login_method = %d\n", app );
					login_server( dest_ip, dest_port, dest_username, dest_password, auto_su, su_command, su_password, login_method, sfd, pfd, c2p_sid );
				}
				else
				{
					printf( "[%s] Permission auth failed.\n", __func__ );
					res = -1;
				}
			}
		}
		else if( conn_mode == CONN_AUDIT_SELECT )
		{
			choose = jump_select_username( sfd, session_id, snum, sinfo, 0 );

			if( choose == -1 )
			{
				printf( "[%s] User exit AUTO-JUMP program.\n", __func__ );
				res = -2;
			}
			else
			{
				app = sinfo[choose-1].login_method;
				if( app == 5 )
				{
					ret = telnet2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, 
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden, NULL );
				}
				else
				{
					ret = select2authserver( radius_username, sinfo[choose-1].devices_id, sourceip, login_method, &conn_mode,
							&dest_ip, &dest_port, &dest_username, &dest_password, &auto_su, &su_command, &su_password, &forbidden );
				}

				if( ret == 0 )
				{
					printf( "login_method = %d\n", app );
					login_server( dest_ip, dest_port, dest_username, dest_password, auto_su, su_command, su_password, app, sfd, pfd, c2p_sid );
				}
				else
				{
					printf( "[%s] Permission auth failed.\n", __func__ );
					res = -1;
				}
			}
		}
		else if( conn_mode == CONN_GWVPN_UNIQUE )
		{
			login_server( dest_ip, dest_port, dest_username, dest_password, auto_su, su_command, su_password, login_method, sfd, pfd, c2p_sid );
		}

	}
	else
	{
		printf( "[%s] Permission auth failed.\n", __func__ );
		res = -1;
	}

	if( res == -1 )
	{
		packet_start( SSH2_MSG_CHANNEL_DATA );
		packet_put_int( session_id );
		packet_put_string( error_msg, strlen( error_msg ) );
		packet_send();
		packet_write_wait();
		jump_sendto_server( pfd, "\x03", 1, c2p_sid ); 
	}
	else if( res == -2 )
	{
		packet_start( SSH2_MSG_CHANNEL_DATA );
		packet_put_int( session_id );
		packet_put_string( exit_msg, strlen( exit_msg ) );
		packet_send();
		packet_write_wait();
		jump_sendto_server( pfd, "\x03", 1, c2p_sid ); 
	}

	return res;
}

int jump_get_option( const char *radius_username, const char *sourceip, const char *str, int sfd, int pfd, int p2c_sid, int c2p_sid )
{
	char *p;
	char delim[] = " \r\n@", opt[4][32], buf[128];
	int index = 0;

	memset( opt, 0x00, sizeof( opt ) );
	p = strtok( str, delim );
	while( p )
	{
		printf( "[%s] %s\n", __func__, p );

		if( strlen(p) > 32 || index >= 4 )
		{
			printf( "[%s] Jump command is invalid format.\n", __func__ );
			return -1;
		}

		strcpy( opt[index++], p );
		p = strtok( NULL, delim );
	}

	if( index < 4 && strcmp( opt[0], "FSSH" ) == 0 )
	{
		/* FSSH */
		if( index == 1 )
		{
			jump( radius_username, NULL, sourceip, 3, sfd, pfd, p2c_sid, c2p_sid );
		}
		/* FSSH ip */
		else if( index == 2 )
		{
			jump( radius_username, opt[1], sourceip, 3, sfd, pfd, p2c_sid, c2p_sid );
		}
		/* FSSH user@ip */
		else
		{
			memset( buf, 0x00, sizeof( buf ) );
			snprintf( buf, sizeof( buf ), "%s--%s", radius_username, opt[1] );
			jump( buf, opt[2], sourceip, 3, sfd, pfd, p2c_sid, c2p_sid );
		}

		return 0;
	}
	else if( index < 4 && strcmp( opt[0], "FTELNET" ) == 0 )
	{
		/* FTELNET */
		if( index == 1 )
		{
			jump( radius_username, NULL, sourceip, 5, sfd, pfd, p2c_sid, c2p_sid );
		}
		/* FTELNET ip */
		else if( index == 2 )
		{
			jump( radius_username, opt[1], sourceip, 5, sfd, pfd, p2c_sid, c2p_sid );
		}
		/* FTELNET user@ip */
		else
		{
			memset( buf, 0x00, sizeof( buf ) );
			snprintf( buf, sizeof( buf ), "%s--%s", radius_username, opt[1] );
			jump( buf, opt[2], sourceip, 5, sfd, pfd, p2c_sid, c2p_sid );
		}

		return 0;
	}

	return -1;
}

struct _list
{
	int prev;
	int next;
	char value;
};

int update_mysql( const char *cmd )
{
	extern char *cstr;
	extern MYSQL *sql_conn;
	MYSQL_RES *query_result;
	MYSQL_ROW row;
	int query, sid, total;
    char buf[4096];

	snprintf( buf, sizeof( buf ), "SELECT sid,jump_total FROM sessions WHERE cli_addr=\"%s\" order by sid DESC limit 1", cstr );
	query = mysql_query( sql_conn, buf );
	query_result = mysql_store_result( sql_conn );
	if( query_result == NULL ) return -1;
	row = mysql_fetch_row( query_result ); 

	sid = atoi( row[0] );
	total = atoi( row[1] );

	snprintf( buf, sizeof( buf ), "UPDATE sessions SET jump_total=%d WHERE sid = %d", total+1, sid );
	query = mysql_query( sql_conn, buf );

	snprintf( buf, sizeof( buf ), "INSERT INTO commands (sid,at,cmd,jump_session) VALUES(%d,now(),\"%s\",%d)", sid, cmd, total+1 );
	query = mysql_query( sql_conn, buf );
	
}

int jump_scan_command( const char *str, int len1, const char *radius_username, const char *sourceip, int sfd, int pfd, int p2c_sid, int c2p_sid, struct simple_packet *spkt )
{
	static char buf[2048];
	static int len;
	struct _list list[2048];
	int head, tail, cursor, length;
	int i, j, node, command_len, index, flag, ret = -1;
	char c, command_buf[2048];
	char data[2048];

	for( i = 0, index = 0, flag = 0; i < len1; i++ )
	{
		c = str[i];
		buf[len++] = c;
		data[index++] = c;

		if( len >= 2048 )
		{
			memset( buf, 0x00, sizeof( buf ) );
			len = 0;
			return -1;
		}

		if( c == 0x0d || c == 0x0a )
		{
			memset( list, 0x00, sizeof( list ) );
			printf( "%d\n", sizeof( list ) );
			head = 0;
			cursor = tail = 1;
			length = 2;
			list[head].next = list[tail].next = 1;

			for( j = 0; j < len-1; j++ )
			{
				printf( "j = %d\n", j );
				switch( buf[j] )
				{
					case 0x7f:
						node = list[list[cursor].prev].prev;
						list[node].next = cursor;
						list[cursor].prev = node;
						break;
					case 0x1b:
						/* <- left */
						if( strstr( &buf[j], "\x1b[D" ) == &buf[j] )
						{
							cursor = list[cursor].prev;
							if( cursor == head )
								cursor = list[head].next;
							j += 2;
						}
						/* -> right */
						else if( strstr( &buf[j], "\x1b[C" ) == &buf[j] )
						{
							cursor = list[cursor].next;
							j += 2;
						}
						/* Home */
						else if( strstr( &buf[j], "\x1b[1~" ) == &buf[j] )
						{
							cursor = list[head].next;
							j += 3;
						}
						/* End */
						else if( strstr( &buf[j], "\x1b[4~" ) == &buf[j] )
						{
							cursor = tail;
							j += 3;
						}
						/* Delete */
						else if( strstr( &buf[j], "\x1b[3~" ) == &buf[j] )
						{
							list[list[cursor].prev].next = list[cursor].next;
							list[list[cursor].next].prev = list[cursor].prev;
							cursor = list[cursor].next;
							j += 3;
						}
						/* Page up and Page down */
						else if( strstr( &buf[j], "\x1b[5~" ) == &buf[j] || strstr( &buf[j], "\x1b[6~" ) == &buf[j] )
						{
							/*memset( list, 0x00, sizeof( list ) );
							  head = 0, cursor = tail = 1, length = 2;
							  list[head].next = list[tail].next = 1;*/
							j += 3;
						}
						/* Up and Down */
						else if( strstr( &buf[j], "\x1b[A" ) == &buf[j] || strstr( &buf[j], "\x1b[B" ) == &buf[j] )
						{
							/*memset( list, 0x00, sizeof( list ) );
							  head = 0, cursor = tail = 1, length = 2;
							  list[head].next = list[tail].next = 1;*/
							j += 2;
						}
						break;
					case 0x09:
						break;
					default:
						list[length].value = buf[j];
						list[length].prev = list[cursor].prev;
						list[list[cursor].prev].next = length;
						list[cursor].prev = length;
						list[length].next = cursor;
						length++;
						printf( "%c %d %d\n", buf[j], cursor, list[cursor].prev );
						break;
				}
			}

			j = list[head].next;
			command_len = 0;
			while( j != 1 && command_len < 2048 )
			{
				printf( "%c", list[j].value );
				command_buf[command_len++] = list[j].value;
				j = list[j].next;
			}
			printf("\n");
			command_buf[command_len] = 0x00;

			if( strstr( command_buf, "FSSH" ) )
			{
				ret = jump_get_option( radius_username, sourceip, command_buf, sfd, pfd, p2c_sid, c2p_sid );
			}
			else if( strstr( command_buf, "FTELNET" ) )
			{
				ret = jump_get_option( radius_username, sourceip, command_buf, sfd, pfd, p2c_sid, c2p_sid );
			}

			if( ret == 0 )
			{
				index = flag;
			}
			else
			{
				flag = i+1;
			}

			memset( buf, 0x00, sizeof( buf ) );
			len = 0;
		}
		else if( c == 0x03 )
		{
			flag = i + 1;
			memset( buf, 0x00, sizeof( buf ) );
			len = 0;
		}
	}

	printf( "[%s] ret = %d, index = %d\n", __func__, ret, index );

	memset( &(spkt->data[8]), 0x00, spkt->len - 8 );
	memcpy( &(spkt->data[8]), data, index );
	put_u32( &(spkt->data[4]), index );
	spkt->len = index + 8;

}


