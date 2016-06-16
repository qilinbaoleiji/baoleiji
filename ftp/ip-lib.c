
/*

    File: ftpproxy/ip-lib.c

    Copyright (C) 1999  Wolfgang Zekoll  <wzk@quietsche-entchen.de>
    Copyright (C) 2000, 2003  Andreas Schoenberg  <asg@ftpproxy.org>
  
    This software is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
  
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
  
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

 */
 
#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <ctype.h>

#include <signal.h>
#include <syslog.h>

#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <sys/wait.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <netdb.h>
#include <errno.h>

#include "lib.h"
#include "ip-lib.h"


static void alarm_handler()
{
	return;
}


int openip(char *host, unsigned int port, char *srcip, unsigned int srcport)
{
	int	socketd;
	struct sockaddr_in server;
	struct hostent *hostp, *gethostbyname();

	socketd = socket(AF_INET, SOCK_STREAM, 0);
	if (socketd < 0)
		return (-1);

	/*
	 * Enhancement to use a particular local interface and source port,
	 * mentioned by Juergen Ilse, <ilse@asys-h.de>.
	 */

	if (srcip != NULL  &&  *srcip != 0) {
		struct sockaddr_in laddr;

		if (srcport != 0) {
			int	one;

			one = 1;
			setsockopt (socketd, SOL_SOCKET, SO_REUSEADDR, (int *) &one, sizeof(one));
		}

		/*
		 * Bind local socket to srcport and srcip
		 */

		memset(&laddr, 0, sizeof(laddr));
		laddr.sin_family = AF_INET;
		laddr.sin_port   = htons(srcport);

		if (srcip == NULL  ||  *srcip == 0)
			srcip = "0.0.0.0";	/* Can't happen but who cares. */
		else {
			struct hostent *ifp;

			ifp = gethostbyname(srcip);
			if (ifp == NULL) {
				syslog(LOG_NOTICE, "-ERR: can't lookup %s", srcip);
				exit (1);
			}

			memcpy(&laddr.sin_addr, ifp->h_addr, ifp->h_length);
		}

		if (bind(socketd, (struct sockaddr *) &laddr, sizeof(laddr))) {
			syslog(LOG_NOTICE, "-ERR: can't bind to %s:%u", srcip, ntohs(laddr.sin_port));
			exit (1);
		}
	}


	server.sin_family = AF_INET;
	hostp = gethostbyname(host);
	if (hostp == NULL)
		return (-1);

	memcpy(&server.sin_addr, hostp->h_addr, hostp->h_length);
	server.sin_port = htons(port);

	signal(SIGALRM, alarm_handler);
	alarm(10);
	if (connect(socketd, (struct sockaddr *) &server, sizeof(server)) < 0)
		return (-1);

	alarm(0);
	signal(SIGALRM, SIG_DFL);

	return (socketd);
}	

int openip6(char *host, unsigned int port, char *srcip, unsigned int srcport)
{
	int	socketd;
	struct sockaddr_in6 server;
	struct hostent *hostp, *gethostbyname();

	socketd = socket(AF_INET6, SOCK_STREAM, 0);
	if (socketd < 0)
		return (-1);

	/*
	 * Enhancement to use a particular local interface and source port,
	 * mentioned by Juergen Ilse, <ilse@asys-h.de>.
	 */

	if (srcip != NULL  &&  *srcip != 0) {
		struct sockaddr_in6 laddr;

		if (srcport != 0) {
			int	one;

			one = 1;
			setsockopt (socketd, SOL_SOCKET, SO_REUSEADDR, (int *) &one, sizeof(one));
		}

		/*
		 * Bind local socket to srcport and srcip
		 */

		memset(&laddr, 0, sizeof(laddr));
		laddr.sin6_family = AF_INET6;
		laddr.sin6_port   = htons(srcport);

		if (srcip == NULL  ||  *srcip == 0)
			srcip = "0.0.0.0";	/* Can't happen but who cares. */
		else {
			inet_pton(AF_INET6, srcip, &laddr.sin6_addr);
		}

		if (bind(socketd, (struct sockaddr *) &laddr, sizeof(laddr))) {
			syslog(LOG_NOTICE, "-ERR: can't bind to %s:%u", srcip, ntohs(laddr.sin6_port));
			exit (1);
		}
	}


	server.sin6_family = AF_INET6;
	server.sin6_port = htons(port);
	inet_pton(AF_INET6, host, &server.sin6_addr);

	signal(SIGALRM, alarm_handler);
	alarm(10);
	if (connect(socketd, (struct sockaddr *) &server, sizeof(server)) < 0)
		return (-1);

	alarm(0);
	signal(SIGALRM, SIG_DFL);

	return (socketd);
}	

unsigned int getportnum(char *name)
{
	unsigned int port;
	struct servent *portdesc;
	
	if (isdigit(*name) != 0)
		port = atol(name);
	else {
		portdesc = getservbyname(name, "tcp");
		if (portdesc == NULL) {
			syslog(LOG_NOTICE, "-ERR: service not found: %s", name);
			exit (-1);
			}

		port = ntohs(portdesc->s_port);
		if (port == 0) {
			syslog(LOG_NOTICE, "-ERR: port error: %s\n", name);
			exit (-1);
			}
		}
	
	return (port);
}

unsigned int get_port(char *server, unsigned int def_port)
{
	unsigned int port;
	char	*p;

	if ((p = strchr(server, ':')) == NULL)
		return (def_port);

	*p++ = 0;
	port = getportnum(p);

	return (port);
}

int bind_to_port(char *interface, unsigned int port)
{
	struct sockaddr_in saddr;
	int	sock;

	if ((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't create socket: %s", strerror(errno));
		exit (-1);
		}
	else {
		int	opt;

		opt = 1;
		setsockopt(sock, SOL_SOCKET, SO_REUSEADDR, &opt, sizeof(opt));
		}


	memset(&saddr, 0, sizeof(saddr));
	saddr.sin_family = AF_INET;
	saddr.sin_port   = htons(port);
	
	if (interface == NULL  ||  *interface == 0)
		interface = "0.0.0.0";
	else {
		struct hostent *ifp;

		ifp = gethostbyname(interface);
		if (ifp == NULL) {
			syslog(LOG_NOTICE, "-ERR: can't lookup %s", interface);
			exit (-1);
			}

		memcpy(&saddr.sin_addr, ifp->h_addr, ifp->h_length);
		}
		
		
	if (bind(sock, (struct sockaddr *) &saddr, sizeof(saddr))) {
		fprintf(stderr, "-ERR: can't bind to %s:%u\n", interface, port);
		syslog(LOG_NOTICE, "-ERR: can't bind to %s:%u", interface, port);
		exit (-1);
		}
		
		
	if (listen(sock, 5) < 0) {
		syslog(LOG_NOTICE, "-ERR: listen error:  %s", strerror(errno));
		exit (-1);
		}

	return (sock);
}

