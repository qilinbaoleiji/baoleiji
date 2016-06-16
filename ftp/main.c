
/*

    File: ftpproxy/main.c

    Copyright (C) 1999, 2000  Wolfgang Zekoll  <wzk@quietsche-entchen.de>
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
#include <unistd.h>
#include <stdarg.h>

#include <signal.h>
#include <sys/wait.h>

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


#if defined(__linux__) || defined(__FreeBSD__) || defined(__NetBSD__)
#define LOGFACILITY	LOG_FTP
#else
#define LOGFACILITY	LOG_DAEMON
#endif


char	*program =		"";
char	progname[80] =		"";

int	debug =			0;
int	extralog =		0;

int	bindport =		0;
int	daemonmode =		0;

int	showconfig =		0;

extern int acceptloop(int sock);


void missing_arg(int c, char *string)
{
	fprintf (stderr, "%s: missing arg: -%c, %s\n", program, c, string);
	exit (-1);
}

int main(int argc, char *argv[], char *envp[])
{
	int	c, i, k;
	char	*p, option[80];
	config_t *config;
	

	if ((p = strrchr(argv[0], '/')) == NULL)
		program = argv[0];
	else {
		copy_string(progname, &p[1], sizeof(progname));
		program = progname;
		}

	config = allocate(sizeof(config_t));
	config->allow_blanks = 1;//Add by zhangzhong
	config->timeout = 15 * 60;
    config->allow_passwdblanks = 1;//Add by zhangzhong
	config->allow_anyremote = 0;
	strcpy(config->varname, "PROXY_");

	openlog(program, LOG_PID, LOGFACILITY);

	k = 1;
	while (k < argc  &&  argv[k][0] == '-'  &&  argv[k][1] != 0) {
		copy_string(option, argv[k++], sizeof(option));
		for (i=1; (c = option[i]) != 0; i++) {
			if (c == 'd') {
				if (debug == 1)
					debug = 2;
				else
					debug = 1;
				}
			else if (c == 'a') {
				if (k >= argc)
					missing_arg(c, "access control program");

				copy_string(config->acp, argv[k++], sizeof(config->acp));
				}
			else if (c == 'B')
				config->allow_passwdblanks = 1;
			else if (c == 'b')
				config->allow_blanks = 1;
			else if (c == 'c') {
				if (k >= argc)
					missing_arg(c, "command control program");

				copy_string(config->ccp, argv[k++], sizeof(config->ccp));
				}
			else if (c == 'e')
				config->selectserver = 1;
			else if (c == 'f'  ||  c == 'F') {
				if (k >= argc)
					missing_arg(c, "configuration file");

				if (c == 'F')
					showconfig = 1;

				copy_string(config->configfile, argv[k++], sizeof(config->configfile));
				}
			else if (c == 'l')
				extralog = 1;
			else if (c == 'm')
				config->monitor = 1;
			else if (c == 'n')
				config->numeric_only = 1;
			else if (c == 'p') {
				if (k >= argc)
					missing_arg(c, "data port");

				config->dataport = strtoul(argv[k++], NULL, 10);
				if (config->dataport == 0)
					config->dataport = 20;
				}
			else if (c == 'q') {

				/*
				 * Specify source interface for outgoing
				 * connections -- 26JAN04asg
				 */

				if (k >= argc)
					missing_arg(c, "source interface");

				copy_string(config->sourceip, argv[k++], sizeof(config->sourceip));
				}
			else if (c == 's') {
				if (k >= argc)
					missing_arg(c, "server list");

				config->serverlist = argv[k++];
				}
			else if (c == 't') {
				if (k >= argc)
					missing_arg(c, "timeout");

				config->timeout = atoi(argv[k++]);
				if (config->timeout < 1)
					config->timeout = 60;
				}
			else if (c == 'u')
				config->use_last_at = 1;
			else if (c == 'v') {
				if (k >= argc)
					missing_arg(c, "varname prefix");

				copy_string(config->varname, argv[k++], sizeof(config->varname));
				}
                        else if (c == 'x') {
                                if (k >= argc)
                                        missing_arg(c, "dynamic configuration program");

                                copy_string(config->ctp, argv[k++], sizeof(config->ctp));
                                }
			else if (c == 'X') {
				if (k >= argc)
					missing_arg(c, "xferlog file");

				copy_string(config->xferlog, argv[k++], sizeof(config->xferlog));
				}
			else if (c == 'y') {
				
				/*
				 * To make 'bad multihomed servers' happy and
				 * to allow server-server transfers through the
				 * proxy -- 31JAN02asg
				 */

				config->allow_anyremote = 1;
				}
 			else if (c == 'z') {
				if (k >= argc)
					missing_arg(c, "buffer size");

				config->bsize = atoi(argv[k++]);
				}
			else if (c == 'V') {
 				printf("ftp-audit version: %s\n", VERSION);
 				exit (0);
 				}	
			else if (c == 'D') {
				if (k >= argc)
					missing_arg(c, "port number");

				bindport = strtoul(argv[k++], NULL, 10);
				daemonmode = 1;
				}
			else {
				fprintf (stderr, "%s: unknown option: -%c\n", program, c);
				exit (-1);
				}
			}
		}


	/*
	 * Print configuration if requested and exit
	 */

	if (showconfig != 0) {
		int	havesection = 0;
		char	*interface = "";

		readconfig(config, config->configfile, "");
		if (k < argc) {
			interface = argv[k++];
			havesection = readconfig(config, config->configfile, interface);
			}

		if (*interface == 0)
			printf ("interface: global\n");
		else {
			printf ("interface: %s\n", interface);
			printf ("status: %s\n", (havesection != 0)? "configured": "unconfigured");
			}

		printconfig(config);
		exit (0);
		}



	/*
	 * Normal processing starts here.
	 */


	if (config->selectserver == 0) {

		/*
		 * Fixed proxy server together with CTP doesn't make
		 * much sense -- 040303asg
		 */

		if (*config->ctp != 0) {
			p = argv[k++];
/*			syslog(LOG_NOTICE, "configured to use ctp, ignoring server argument: %s", p); */
			fprintf (stderr, "%s: configured to use ctp, ignoring server argument: %s", program, p);
			}
		else {
			if (k >= argc) {
				fprintf (stderr, "usage: %s [<options>] <server>\n", program);
				exit (1);
				}

			copy_string(config->server, argv[k++], sizeof(config->server));
			}
		}

	if (k < argc) {
		fprintf (stderr, "%s: extra arguments on command line: %s ...\n", program, argv[k]);
		exit (1);
		}


	if (*config->configfile != 0) {
		syslog(LOG_NOTICE, "configured to use config file. %s", p);
		readconfig(config, config->configfile, "");
		}
	else
	{
		syslog(LOG_NOTICE, "configured to use config file. %s", CONFIG);
		readconfig(config, CONFIG, "");
	}

	if (daemonmode != 0) {
		signal(SIGCHLD, SIG_IGN);
		config->standalone = 1;
		if (bindport > 0) {
			int     sock;

			sock = bind_to_port("", bindport);
			acceptloop(sock);
			}
		signal(SIGCHLD, SIG_DFL);
		}	

	proxy_request(config);
	exit (0);
}


