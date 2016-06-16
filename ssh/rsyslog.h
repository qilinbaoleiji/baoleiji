#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <netdb.h>
#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <time.h>
#include <ctype.h>


char ftable[24][8] =
{
	{"kern"}, {"user"}, {"mail"}, {"daemon"}, {"auth"}, {"syslog"}, {"lpr"}, {"news"},
	{"uucp"}, {"cron"}, {"authpriv"}, {"ftp"}, {""}, {""}, {""}, {""},
	{"local0"}, {"local1"}, {"local2"}, {"local3"}, {"local4"}, {"local5"}, {"local6"}, {"local7"}
};
char ltable[8][8] =
{
	{"emerg"}, {"alert"}, {"crit"}, {"err"}, {"warning"}, {"notice"}, {"info"}, {"debug"}
};

char *timestamp()
{
	int i;
	static char stamp[16];
	char buf[32];
	time_t rawtime;

	time ( &rawtime );
	strcpy( buf, ctime(&rawtime) );

	for ( i = 0; i < 15; i++ )
	{
		stamp[i] = buf[i+4];
	}

	return stamp;
}

int f2int( const char *facility )
{
	int ret, i;
	if ( isdigit(*facility) )
	{
		ret = atoi(facility);
		if ( ret > 23 ) return -1;
		else return ret;
	}
	else
	{
		for ( i = 0; i < 24; i++ )
		{
			if ( !strcasecmp(facility,ftable[i]) ) return i;
		}
		return -1;
	}
	return -1;
}

int l2int( const char *level )
{
	int ret, i;
	if ( isdigit(*level) )
	{
		ret = atoi(level);
		if ( ret > 7 ) return -1;
		else return ret;
	}
	else
	{
		for ( i = 0; i < 8; i++ )
		{
			if ( !strcasecmp(level,ltable[i]) ) return i;
		}
		return -1;
	}
	return -1;
}

int rsyslog( const char *syslog_server, unsigned int syslog_port, const char *facility, const char *level, const char *msg )
{
	int sock, length, n, f, l;
	struct sockaddr_in server, from;
	char buf[1024];

	sock= socket(AF_INET, SOCK_DGRAM, 0);
	if (sock < 0)
	{
//write_log("[%s] Cannot create syslog socket.", __func__);
		return -1;
	}

	server.sin_family = AF_INET;
	server.sin_addr.s_addr = inet_addr( syslog_server );
	server.sin_port = htons( syslog_port );
	length = sizeof(struct sockaddr_in);

	f = f2int(facility);
	if ( f == -1 )
	{
		printf("Invalid facility\n");
		return -1;
	}
	l = l2int(level);
	if ( l == -1 )
	{
		printf("Invalid level\n");
		return -1;
	}

	bzero( buf, sizeof(buf) );
	snprintf( buf, sizeof(buf), "<%d>%s auditsec: %s", f*8+l, timestamp(), msg );
	//write_log("[%s] syslog: \"%s\"", __func__, buf);

	n = sendto( sock, buf, strlen(buf), 0, &server, length );
	if (n < 0)
	{
		close( sock );
		return -1;
	}

	close( sock );
	return 0;
}

/*
int main(int ac, char ** av)
{
	rsyslog("127.0.0.1",514,"kern","emerg",av[1]);
	if(rsyslog(av[1],514,av[2],av[3],av[4])<0)
	{
		printf("send error\n");
	}
	return 0;
}
*/
