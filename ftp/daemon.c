
/*

    File: ftpproxy/daemon.c 

    Copyright (C) 2002,2003  Andreas Schoenberg  <asg@ftpproxy.org> 
  
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
#include <unistd.h>
#include <stdarg.h>
#include <ctype.h>

#include <errno.h>
#include <signal.h>
#include <sys/wait.h>
#include <pwd.h>

#include <sys/types.h>
#include <sys/stat.h>
#include <sys/fcntl.h>
#include <sys/socket.h>
#include <netdb.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <syslog.h>
#include <sys/time.h>

#include "ftp.h"
#include "ip-lib.h"
#include "lib.h"

int clientport;
int acceptloop(int sock)
{
	int	connect, pid, len;
	struct sockaddr_in client;

	/*
	 * Go into background.
	 */
	
	if (debug != 0)
		; /* Do not fork in debug mode */

	else if ((pid = fork()) > 0)
		exit (0);

	fprintf (stderr, "\nstarting FTP-AUDIT %s in daemon mode ...\n", VERSION);
	while (1) {

		/*
		 * hier kommt ein accept an
		 */

		len = sizeof(client);
		if ((connect = accept(sock, (struct sockaddr *) &client, &len)) < 0) {
			if (errno == EINTR  ||  errno == ECONNABORTED)
				continue;

			fprintf (stderr, "%04X: accept error: %s\n", getpid(), strerror(errno));
			continue;
			}

		if ((pid = fork()) < 0) {
			fprintf (stderr, "%04X: can't fork process: %s\n", getpid(), strerror(errno));
			exit (1);
			}
		else if (pid == 0) {
			int optlen;
			struct linger linger;

			/* Add by zhangzhong */
			clientport = ntohs(client.sin_port);
			fprintf(stderr, "Client port is %d\n", clientport);

			linger.l_onoff = 1;
			linger.l_linger = 2;
			optlen = sizeof(linger);
			if (setsockopt(connect, SOL_SOCKET, SO_LINGER, &linger, optlen) != 0)
				fprintf (stderr, "%04X: can't set linger\n", getpid());

			dup2(connect, 0);
			dup2(connect, 1);

			close (connect);
			close (sock);

			return (0);
			}

		/*
		 * Der folgende Teil wird nur im parent Prozess ausgefuehrt.
		 */

		close(connect);
		}

	close (1);
	fprintf (stderr, "%04X: terminating\n", getpid());

	exit (0);
}

