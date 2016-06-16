
/*

    File: ftpproxy/ftp.c

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

#include <time.h>
#include <signal.h>
#include <sys/wait.h>
#include <ctype.h>
#include <errno.h>

#include <sys/types.h>
#include <sys/stat.h>
#include <sys/fcntl.h>
#include <sys/socket.h>
#include <netdb.h>
#include <netinet/in.h>
#include <netinet/tcp.h>
#include <arpa/inet.h>
#include <syslog.h>
#include <sys/time.h>

#include "ftp.h"
#include "ip-lib.h"
#include "lib.h"
#include "tools.h"
#include "mysql.h"

typedef struct _ftpcmd {
    char	name[20];
    int		par, ispath, useccp;
    int		resp;
    int		log;
    } ftpcmd_t;

ftpcmd_t cmdtab[] = {

	/*
	 * Einfache FTP Kommandos.
	 */

    { "ABOR", 0, 0, 0,	225, 1 },		/* oder 226 */
    { "ACCT", 1, 0, 0,	230, 0 },
    { "CDUP", 1, 1, 1,	200, 1 },
    { "CWD",  1, 1, 1,	250, 1 },
    { "DELE", 1, 1, 1,	250, 1 },
    { "NOOP", 0, 0, 0,	200, 0 },
    { "MDTM", 1, 1, 1,	257, 1 },
    { "MKD",  1, 1, 1,	257, 1 },
    { "MODE", 1, 0, 0,	200, 0 },
    { "PWD",  0, 0, 0,	257, 0 },
    { "QUIT", 0, 0, 0,	221, 0 },
    { "REIN", 0, 0, 0,	0, /* 220, */ 0 },	/* wird nicht unterstuetzt */
    { "REST", 1, 0, 0,	350, 0 },
    { "RNFR", 1, 1, 1,	350, 1 },
    { "RNTO", 1, 1, 1,	250, 1 },
    { "RMD",  1, 1, 1,	250, 1 },
    { "SITE", 1, 0, 1,	200, 0 },
    { "SIZE", 1, 1, 1,	213, 1 },
    { "SMNT", 1, 0, 0,	250, 0 },
    { "STAT", 1, 1, 1,	211, 0 },			/* oder 212, 213 */
    { "STRU", 1, 0, 0,	0, /* 200, */ 0 },	/* wird nicht unterstuetzt */
    { "SYST", 0, 0, 0,	215, 0 },
    { "TYPE", 1, 0, 0,	200, 0 },
    { "XCUP", 1, 1, 1,	200, 1 },
    { "XCWD", 1, 1, 1,	250, 1 },
    { "XMKD", 1, 1, 1,	257, 1 },
    { "XPWD", 0, 0, 0,	257, 0 },
    { "XRMD", 1, 1, 1,	250, 1 },

	/*
	 * Nur der Vollstaendigkeit halber: FTP Kommandos die gesondert
	 * behandelt werden.
	 */

    { "LIST", 1, 1, 1,	0, 0 },
    { "NLST", 1, 1, 1,	0, 0 },
    { "PORT", 1, 0, 0,	0, /* 200, */ 0 },
    { "PASV", 0, 0, 0,	0, /* 200, */ 0 },
    { "ALLO", 1, 0, 0,	0, /* 200, */ 0 },
    { "RETR", 1, 1, 1,	0, 0 },
    { "STOR", 1, 1, 1,	0, 0 },
    { "STOU", 0, 0, 1,	0, 0 },
    { "APPE", 1, 1, 1,	0, 0 },
    { "HELP", 0, 0, 0,	0, 0 },
    { "FEAT", 0, 0, 0,	0, 0 },
    { "",     0, 0, 0,	0, 0 }
    };


unsigned get_interface_info(int pfd, char *ip, int max)
{
	int	size;
	unsigned int port;
	struct sockaddr_in saddr;

	size = sizeof(saddr);
	if (getsockname(pfd, (struct sockaddr *) &saddr, &size) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't get interface info: %s", strerror(errno));
		exit (-1);
		}

	copy_string(ip, (char *) inet_ntoa(saddr.sin_addr), max);
	port = ntohs(saddr.sin_port);

	return (port);
}

int get_client_info(ftp_t *x, int pfd)
{
	int	size;
	struct sockaddr_in saddr;
	struct in_addr *addr;
	struct hostent *hostp = NULL;

	*x->client = 0;
	size = sizeof(saddr);
	if (getpeername(pfd, (struct sockaddr *) &saddr, &size) < 0 )
		return (-1);
		
	copy_string(x->client_ip, (char *) inet_ntoa(saddr.sin_addr), sizeof(x->client_ip));

	if (x->config->numeric_only == 1)
		copy_string(x->client, x->client_ip, sizeof(x->client));
	else {
		addr = &saddr.sin_addr,
		hostp = gethostbyaddr((char *) addr,
				sizeof (saddr.sin_addr.s_addr), AF_INET);

		copy_string(x->client, hostp == NULL? x->client_ip: hostp->h_name, sizeof(x->client));
		}

	strlwr(x->client);

	return (0);
}


	/*
	 * Basic I/O functions
	 */

int close_ch(ftp_t *x, dtc_t *ch)
{
	if (ch->isock >= 0)
		close(ch->isock);

	if (ch->osock >= 0)
		close (ch->osock);

	ch->isock     = -1;
	ch->osock     = -1;
	ch->state     = 0;
	ch->operation = 0;
	ch->seen150   = 0;

	return (0);
}

int getc_fd(ftp_t *x, int fd)
{
	int	c;
	bio_t	*bio;

	if (fd == 0)
		bio = &x->cbuf;
	else if (fd == x->fd.server)
		bio = &x->sbuf;
	else {
		syslog(LOG_NOTICE, "-ERR: internal bio/fd error");
		exit (1);
		}

	if (bio->here >= bio->len) {
		int	rc, max, bytes, earlyreported;
		struct timeval tov;
		fd_set	available, fdset;

		bio->len = bio->here = 0;
		earlyreported = 0;

		FD_ZERO(&fdset);
		FD_SET(fd, &fdset);
/*		x->fd.max = fd; */
		max = fd;

		if (x->ch.operation == 0)
			/* nichts */ ;
		else if (x->ch.state == PORT_LISTEN) {
			if (x->ch.mode == MODE_PORT) {
				FD_SET(x->ch.osock, &fdset);
				if (x->ch.osock > max)
					max = x->ch.osock;

				x->ch.active = x->ch.osock;
				}
			else if (x->ch.mode == MODE_PASSIVE) {
				FD_SET(x->ch.isock, &fdset);
				if (x->ch.isock > max)
					max = x->ch.isock;

				x->ch.active = x->ch.isock;
				}
			else {
				syslog(LOG_NOTICE, "-ERR: internal mode error");
				exit (-1);
				}
			}
		else if (x->ch.state == PORT_CONNECTED  &&  x->ch.seen150 == 1) {
			FD_SET(x->ch.active, &fdset);
			if (x->ch.active > max)
				max = x->ch.active;
			}
			
		bytes = 0;
		while (1) {
/*			memmove(&available, &fdset, sizeof(fd_set)); */
			available = fdset;
			tov.tv_sec  = x->config->timeout;
			tov.tv_usec = 0;

			if (debug >= 2)
				fprintf (stderr, "select max= %d\n", max);

			rc = select(max + 1, &available, (fd_set *) NULL, (fd_set *) NULL, &tov);
			if (rc < 0) {
				syslog(LOG_NOTICE, "select() error: %s\n", strerror(errno));
				break;
				}
			else if (rc == 0) {
				syslog(LOG_NOTICE, "connection timed out: client= %s, server= %s:%u",
					x->client, x->server.name, x->server.port);
				return (-1);
				}

			if (FD_ISSET(fd, &available)) {
				if ((bytes = read(fd, bio->buffer, sizeof(bio->buffer) - 2)) <= 0) {
					if (debug != 0) {
						if (bytes == 0)
							fprintf (stderr, "received zero bytes on fd %d\n", fd);
						else
							fprintf (stderr, "received %d bytes on fd %d, errno= %d, error= %s\n", bytes, fd, errno, strerror(errno));
						}

					return (-1);
					}

				break;
				}
			else if (FD_ISSET(x->ch.active, &available)) {
				if (x->ch.state == PORT_LISTEN) {
					int	sock, adrlen;
					struct sockaddr_in adr;

					earlyreported = 0;
					adrlen = sizeof(struct sockaddr);
					sock = accept(x->ch.active, (struct sockaddr *) &adr, &adrlen);
					if (debug != 0)
						fprintf (stderr, "accept() on socket\n");

					if (sock < 0) {
						syslog(LOG_NOTICE, "-ERR: accept error: %s", strerror(errno));
						exit (1);
						}
					else {
						char	remote[80];

						copy_string(remote, inet_ntoa(adr.sin_addr), sizeof(remote));
						if (debug)
							fprintf (stderr, "connection from %s\n", remote);

						/*
						 * Gegenstelle ueberpruefen.
						 */

						if (x->ch.mode == MODE_PORT) {
							if (strcmp(x->server.ipnum, remote) != 0) {
								if (x->config->allow_anyremote != 0)
									/* configuration tells us not to care -- 31JAN02asg */ ;
								else {
									syslog(LOG_NOTICE, "-ERR: unexpected connect: %s, expected= %s", remote, x->server.ipnum);
									exit (1);
									}
								}
							}
						else {
							if (strcmp(x->client_ip, remote) != 0) {
								if (x->config->allow_anyremote != 0)
									/* ok -- 31JAN02asg */ ;
								else {
									syslog(LOG_NOTICE, "-ERR: unexpected connect: %s, expected= %s", remote, x->client_ip);
									exit (1);
									}
								}
							}
						}

					/*
					 * Datenkanal zur anderen Seite aufbauen.
					 */

					if (x->ch.mode == MODE_PORT) {
						dup2(sock, x->ch.osock);
						close (sock);
						x->ch.state = PORT_CONNECTED;
						if (debug)
							fprintf (stderr, "osock= %d\n", x->ch.osock);

						if ((x->ch.isock = openip(x->ch.client.ipnum, x->ch.client.port, x->interface, x->config->dataport)) < 0) {
							syslog(LOG_NOTICE, "-ERR: can't connect to client: %s", strerror(errno));
							exit (1);
							}

						if (debug)
							fprintf (stderr, "isock= %d\n", x->ch.isock);
						}
					else if (x->ch.mode == MODE_PASSIVE) {
						dup2(sock, x->ch.isock);
						close (sock);
						x->ch.state = PORT_CONNECTED;
						if (debug)
							fprintf (stderr, "isock= %d\n", x->ch.isock);

						if (x->ipv6 == 1) {
							if ((x->ch.osock = openip6(x->ch.server.ipnum, x->ch.server.port, x->config->sourceip, 0)) < 0) {
								syslog(LOG_NOTICE, "-ERR: can't connect to server: %s", strerror(errno));
								exit (1);
							}
						}
						else {
							if ((x->ch.osock = openip(x->ch.server.ipnum, x->ch.server.port, x->config->sourceip, 0)) < 0) {
								syslog(LOG_NOTICE, "-ERR: can't connect to server: %s", strerror(errno));
								exit (1);
							}
						}
						if (debug)
							fprintf (stderr, "osock= %d\n", x->ch.osock);
						}


					/*
					 * Setzen der Datenquelle (Server oder Client).
					 */

					if (x->ch.operation == OP_GET) {
						x->ch.active = x->ch.osock;
						x->ch.other  = x->ch.isock;
						}
					else if (x->ch.operation == OP_PUT) {
						x->ch.active = x->ch.isock;
						x->ch.other  = x->ch.osock;
						}
					else {
						syslog(LOG_NOTICE, "-ERR: transfer operation error");
						exit (1);
						}

					if (x->ch.seen150 == 0) {

						/*
						 * And finally ... another attempt to solve the short
						 * data transmission timing problem: If we didn't receive
						 * the 150 response yet from the server we deactivate the
						 * data channel until we have the 150 -- 030406asg
						 */

						if (debug >= 2)
							fprintf (stderr, "150 not seen, deactivating data channel\n");

						FD_ZERO(&fdset);
						FD_SET(fd, &fdset);
						max = fd;
						}
					else {
						if (debug >= 2)
							fprintf (stderr, "150 already seen, activating data channel\n");

						FD_ZERO(&fdset);
						FD_SET(fd, &fdset);
						FD_SET(x->ch.active, &fdset);
						max = (fd > x->ch.active)? fd: x->ch.active;
						}

					if (debug)
						fprintf (stderr, "active= %d, other= %d\n", x->ch.active, x->ch.other);

					x->ch.bytes = 0;
					x->ch.started = time(NULL);
					}
				else if (x->ch.state == PORT_CONNECTED) {
					int	wrote;
					char	buffer[FTPMAXBSIZE + 10];

					/* Add by zhangzhong */
					if (x->backup_fd == -1 &&
						(!strcmp(x->ch.command, "RETR") || !strcmp(x->ch.command, "STOR")))
					{
						//fprintf(stderr, "%s\n", __func__);
						char fn[256], utf8[256];
						if (strlen(x->ch.filename))
						{
							bzero(fn, sizeof(fn));
							strcpy(fn, strrchr(x->ch.filename, '/') + 1);
						}
						bzero(x->backup_fn, sizeof(x->backup_fn));
						snprintf(x->backup_fn, sizeof(x->backup_fn), "/opt/freesvr/audit/ftp-audit/backup/%s/%s%s", 
								strcmp(x->ch.command, "RETR") ? "upload" : "download",
								str_time(time(NULL), NULL), g2u(fn));
						fprintf(stderr, "Backup filename is %s\n", x->backup_fn);
						x->backup_fd = open(x->backup_fn, O_WRONLY|O_APPEND|O_CREAT, 0x0777);
					}
					/* Add by zhangzhong */

					if (x->ch.operation == 0) {
						if (earlyreported == 0) {
							earlyreported = 1;
							syslog(LOG_NOTICE, "early write/read event, sleeping 2 seconds");
							sleep(2);
							continue;
							}
						}

					bytes = read(x->ch.active, buffer, x->config->bsize /* sizeof(buffer) */ );

					/*
					 * Handling servers that close the data connection -- 24APR02asg
					 */

					wrote = 0;
					if ((bytes > 0)  &&  ((wrote = write(x->ch.other, buffer, bytes)) == bytes))
					{
						x->ch.bytes += bytes;
						/* Add by zhangzhong */
						if (x->ch.bytes > x->config->backup_size * 1024 * 1024)
						{
							if (x->backup_fd > 0)
								close(x->backup_fd);
							remove(x->backup_fn);
						}
						else
							write(x->backup_fd, buffer, bytes);
						fprintf(stderr, "ch.bytes = %d ", x->ch.bytes);
						fprintf(stderr, "%s %s: bytes = %d, wrote = %d\n", x->ch.command, x->ch.filename, bytes, wrote);
					}
					else {
						if (wrote < 0)
							syslog(LOG_NOTICE, "error writing data channel, error= %s", strerror(errno));

						if (debug)
							fprintf (stderr, "closing data connection\n");

						/* Add by zhangzhong*/
						if (x->backup_fd > 0) 
						{
							close(x->backup_fd);
							fprintf(stderr, "Close fd of backup file, fd = %d\n", x->backup_fd);
							x->backup_fd = -1;
						}
						/* Add by zhangzhong */

						close_ch(x, &x->ch);
						FD_ZERO(&fdset);
						FD_SET(fd, &fdset);
						max = fd;

						return (1);
						}
					}
				}
			}

		bio->len  = bytes;
		bio->here = 0;
		}

	if (bio->here >= bio->len)
		return (-1);

	c = (unsigned char) bio->buffer[bio->here++];
	return (c);
}

char *readline_fd(ftp_t *x, int fd, char *line, int size)
{
	int	c, k;

	*line = 0;
	size = size - 2;

	c = getc_fd(x, fd);
	if (c < 0)
		return (NULL);
	else if (c == 1) {
		strcpy(line, "\001");
		return (line);
		}

	k = 0;
	while (c > 0  &&  c != '\n'  &&  c != 0) {
		if (k < size)
			line[k++] = c;

		c = getc_fd(x, fd);
		}

	line[k] = 0;
	noctrl(line);

	k = 0;
	while ((c = (unsigned char ) line[k]) != 0  &&  c > 126)
		k++;

	if (k > 0)
		copy_string(line, &line[k], size);

	return (line);
}


char *cfgets(ftp_t *x, char *line, int size)
{
	char	*p;

	*line = 0;
	if ((p = readline_fd(x, 0, line, size)) == NULL)
		return (NULL);
	else if (debug != 0)
		fprintf (stderr, "CLI >>>: %s\n", p);
	//fprintf(stderr, "[%s]: line is %s\n", __func__, line);
	return (line);
}

int cfputs(ftp_t *x, char *line)
{
	char	buffer[310];

	if (debug)
		fprintf (stderr, ">>> CLI: %s\n", line);

	snprintf (buffer, sizeof(buffer) - 2, "%s\r\n", line);
	//fprintf(stderr, "[%s]: len of buffer = %d\n", __func__, strlen(buffer));
	write(1, buffer, strlen(buffer));

	return (0);
}


char *sfgets(ftp_t *x, char *line, int size)
{
	char *p;

	*line = 0;
	if ((p = readline_fd(x, x->fd.server, line, size)) == NULL)
		return (NULL);
	else if (debug != 0)
		fprintf (stderr, "SVR >>>: %s\n", p);

	return (line);
}

int sfputs(ftp_t *x, char *format, ...)
{
	int	len;
	char	buffer[310];
	va_list	ap;

	va_start(ap, format);
	vsnprintf (buffer, sizeof(buffer) - 10, format, ap);
	va_end(ap);

	if (debug)
	{
		fprintf (stderr, ">>> SVR: %s\n", buffer);
	}

	/*
	 * There are firewalls that don't like command to be split in
	 * two packets.  Notice: the `- 10' above is really important
	 * to protect the proxy against buffer overflows.
	 */

	strcat(buffer, "\r\n");
	len = strlen(buffer);
	
	/*
	 * SIGPIPE is catched but then ignored, we have to handle it
	 * one our own now -- 24APR02asg
	 */

	if (write(x->fd.server, buffer, len) != len) {
		syslog(LOG_NOTICE, "-ERR: error writing control connect, error= %s", strerror(errno));
		exit (1);
		}

/*
 *	write(x->fd.server, buffer, strlen(buffer));
 *	write(x->fd.server, "\r\n", 2);
 */
	return (0);
}

int sfputc(ftp_t *x, char *command, char *parameter, char *line, int size, char **here)
{
	int	rc;
	char	*p, buffer[300];

	if (command != NULL  &&  *command != 0) {
		if (parameter != NULL  &&  *parameter != 0)
		{
			//fprintf(stderr, "[%s]: buffer is %s, parameter is %s\n", __func__, buffer, g2u(parameter));
			if (strcmp(command, "PASS") == 0)//Add by zhangzhong, blanks in password
				snprintf (buffer, sizeof(buffer) - 2, "%s %s", command, parameter);
			else
				snprintf (buffer, sizeof(buffer) - 2, "%s %s", command, skip_ws(parameter));
		}
		else
			copy_string(buffer, command, sizeof(buffer));

		fprintf(stderr, "[%s]: buffer is %s, parameter is %s\n", __func__, buffer, parameter);
		sfputs(x, "%s", buffer);
		}
	
	if (sfgets(x, line, size) == NULL) {
		if (debug != 0)
			fprintf (stderr, "server disappered in sfputc(), pos #1\n");

		return (-1);
		}
	else if (strlen(line) < 3) {
		if (debug != 0)
			fprintf (stderr, "short server reply in sfputc()\n");

		return (-1);
		}

	rc = atoi(line);
	if (line[3] != ' '  &&  line[3] != 0) {
        	while (1) {
                	if (sfgets(x, line, size) == NULL) {
				syslog(LOG_NOTICE, "-ERR: lost server while reading client greeting: %s", x->server.name);
				exit (1);
				}

			if (strlen(line) < 3)
				/* line too short to be response's last line */ ;
			else if (line[3] != ' '  &&  line[3] != 0)
				/* neither white space nor EOL at position #4 */ ;
			else if (line[0] >= '0'  &&  line[0] <= '9'  &&  atoi(line) == rc)
                       		break;		/* status code followed by EOL or blank detected */
			}
        	}

	if (here != NULL) {
		p = skip_ws(&line[3]);
		*here = p;
		}

	return (rc);
}



int doquit(ftp_t *x)
{
	int	rc;
	char	resp[200];

	if ((rc = sfputc(x, "QUIT", "", resp, sizeof(resp), NULL)) != 221)
		syslog(LOG_NOTICE, "unexpected resonse to QUIT: %s", resp);

	cfputs(x, "221 goodbye");
	syslog(LOG_NOTICE, "%d QUIT", rc);
	
	return (0);
}


char *_getipnum(char *line, char **here, char *ip, int size)
{
	int	c, i, k;

	copy_string(ip, line, size);
	k = 0;
	for (i=0; (c = ip[i]) != 0; i++) {
		if (c == ',') {
			if (k < 3) {
				ip[i] = '.';
				k++;
				}
			else {
				ip[i++] = 0;
				break;
				}
			}
		}

	if (here != NULL)
		*here = &line[i];

	return (ip);
}

unsigned long _getport(char *line, char **here)
{
	unsigned long port;
	char	*p;

	p = line;
	port = strtoul(p, &p, 10);
	if (*p != ',')
		return (0);

	p++;
	port = (port << 8) + strtoul(p, &p, 10);
	if (here != NULL)
		*here = p;

	return (port);
}

int doport(ftp_t *x, char *command, char *par)
{
	int	c, rc;
	char	*p, line[200];
	dtc_t	*ch;

	ch = &x->ch;
	_getipnum(par, &p, ch->client.ipnum, sizeof(ch->client.ipnum));
	ch->client.port = _getport(p, &p);
	if (debug)
		fprintf (stderr, "client listens on %s:%u\n", ch->client.ipnum, ch->client.port);

	get_interface_info(x->fd.server, ch->outside.ipnum, sizeof(ch->outside.ipnum));
	ch->osock = bind_to_port(ch->outside.ipnum, 0);
	ch->outside.port = get_interface_info(ch->osock, line, sizeof(line));
	if (debug)
		fprintf (stderr, "listening on %s:%u\n", ch->outside.ipnum, ch->outside.port);

	copy_string(line, ch->outside.ipnum, sizeof(line));
	for (p=line; (c = *p) != 0; p++) {
		if (c == '.')
			*p = ',';
		}

	*p++ = ',';
	snprintf (p, 20, "%u,%u", ch->outside.port >> 8, ch->outside.port & 0xFF);


	/* Open port first */		
	ch->isock     = -1;
	ch->mode      = MODE_PORT;
	ch->state     = PORT_LISTEN;

	/* then send PORT cmd */
	rc = sfputc(x, "PORT", line, line, sizeof(line), &p);

	/* check return code */
	if (rc != 200){
		cfputs(x, "500 not accepted");
		close_ch(x, &x->ch);
		}
	else 
		cfputs(x, "200 ok, port allocated");



/*	if (rc != 200)
		cfputs(x, "500 not accepted");
	else {
		cfputs(x, "200 ok, port allocated");

		ch->isock  = -1;
		ch->mode   = MODE_PORT;
		ch->state  = PORT_LISTEN;
		}
*/

	*ch->command = 0;
	return (rc);
}

int dopasv(ftp_t *x, char *command, char *par)
{
	int	c, k, rc;
	char	*p, line[200];
	dtc_t	*ch;

	ch = &x->ch;
	rc = sfputc(x, "PASV", "", line, sizeof(line), &p);
	if (rc != 227) {
		cfputs(x, "500 not accepted");
		return (0);
		}


	/*
	 * Ende der Port-Koordinaten im Server-Response suchen.
	 */

	k = strlen(line);
	while (k > 0  &&  isdigit(line[k-1]) == 0)
		k--;

	if (isdigit(line[k-1])) {
		line[k--] = 0;
		while (k > 0  &&  (isdigit(line[k-1])  ||  line[k-1] == ','))
			k--;
		}

	/*
	 * line[k] sollte jetzt auf die erste Ziffer des PASV Response
	 * zeigen.
	 */

	if (isdigit(line[k]) == 0) {
		syslog(LOG_NOTICE, "can't locate passive response: %s", line);
		cfputs(x, "500 not accepted");
		return (0);
		}

	/*
	 * Auslesen der PASV IP-Nummer und des Ports.
	 */

	p = &line[k];
	_getipnum(p, &p, ch->server.ipnum, sizeof(ch->server.ipnum));
	ch->server.port = _getport(p, &p);
	if (debug)
		fprintf (stderr, "server listens on %s:%u\n", ch->server.ipnum, ch->server.port);

	get_interface_info(0, ch->inside.ipnum, sizeof(ch->inside.ipnum));
	ch->isock = bind_to_port(ch->inside.ipnum, 0);
	ch->inside.port = get_interface_info(ch->isock, line, sizeof(line));
	if (debug)
		fprintf (stderr, "listening on %s:%u\n", ch->inside.ipnum, ch->inside.port);

	snprintf (line, sizeof(line) - 2, "227 Entering Passive Mode (%s,%u,%u)",
			ch->inside.ipnum,
			ch->inside.port >> 8, ch->inside.port & 0xFF);
	for (p=line; (c = *p) != 0; p++) {
		if (c == '.')
			*p = ',';
		}

	cfputs(x, line);
	ch->osock = -1;
	ch->mode  = MODE_PASSIVE;
	ch->state = PORT_LISTEN;

	*ch->command = 0;
	ch->operation = 0;

	return (rc);
}


int dofeat(ftp_t *x)
{
	/*
	 * Not so easy because we have to align with the server response. 
	 */

	int	rc;
	char	*p, word[80], serverfeature[80], line[300];
	static char *proxyfeatlist = "SIZE:MDTM";

	sfputs(x, "%s", "FEAT");
	if (sfgets(x, line, sizeof(line)) == NULL) {
		syslog(LOG_NOTICE, "monitor: server not responding");
		exit (1);
		}

	rc = atoi(line);
	if (rc != 211) {
		/* kein FEAT Support */ ;
		cfputs(x, "502 command not implemented");
		return (1);
		}


	cfputs(x, "211-feature list follows");
	while (1) {
		if (sfgets(x, line, sizeof(line)) == NULL) {
			syslog(LOG_NOTICE, "lost server in FEAT response");
			exit (1);
			}
		else if (*line != ' ') { 

			/*
			 * RFC2389 specifies exactly one space in this
			 * multi-line response.  Nothing else.
			 */

			break;
			}


		/* Get feature from server response ...
		 */

		copy_string(serverfeature, line, sizeof(serverfeature));
		strupr(serverfeature);


		/* ... and compare it against our feature list
		 */


		p = proxyfeatlist;
		while (*get_quoted(&p, ':', word, sizeof(word)) != 0) {
			if (strcmp(word, serverfeature) == 0) {
				snprintf (line, sizeof(line) - 4, " %s", word);
				cfputs(x, line);
				break;
				}
			}
		}

	cfputs(x, "211 end");
	return (0);
}

int setvar(ftp_t *x, char *var, char *value)
{
	char	varname[200];

	#if defined SOLARIS
	snprintf (varname, sizeof(varname) - 2, "%s%s=%s", x->config->varname, var, value != NULL? value: "");
	putenv(varname);
	#else
	snprintf (varname, sizeof(varname) - 2, "%s%s", x->config->varname, var);
	setenv(varname, value != NULL? value: "", 1);
	#endif

	return (0);
}

int set_variables(ftp_t *x)
{
	char	val[200];

	setvar(x, "INTERFACE", x->interface);
	snprintf (val, sizeof(val) - 2, "%u", x->port);
	setvar(x, "PORT", val);

	setvar(x, "CLIENT", x->client_ip);
	setvar(x, "CLIENTNAME", x->client);

	setvar(x, "SERVER", x->server.ipnum);
	snprintf (val, sizeof(val) - 2, "%u", x->server.port);
	setvar(x, "SERVERPORT", val);

	setvar(x, "SERVERNAME", x->server.name);
	setvar(x, "SERVERLOGIN", x->username);
	setvar(x, "USERNAME", x->local.username);
	setvar(x, "PASSWD", x->local.password);

	return (0);
}

int run_acp(ftp_t *x)
{
	int	rc, pid, pfd[2];
	char	line[300];
	
	if (*x->config->acp == 0)
		return (0);

	rc = 0;
	if (pipe(pfd) != 0) {
		syslog(LOG_NOTICE, "-ERR: can't pipe: %s", strerror(errno));
		exit (1);
		}
	else if ((pid = fork()) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't fork acp: %s", strerror(errno));
		exit (1);
		}
	else if (pid == 0) {
		int	argc;
		char	*argv[32];

		close(0);		/* Das acp kann nicht vom client lesen. */
		dup2(pfd[1], 2);	/* stderr wird vom parent gelesen. */
		close(pfd[0]);
		set_variables(x);
		
		copy_string(line, x->config->acp, sizeof(line));
		argc = split(line, argv, ' ', 30);
		argv[argc] = NULL;
		execvp(argv[0], argv);

		syslog(LOG_NOTICE, "-ERR: can't exec acp %s: %s", argv[0], strerror(errno));
		exit (1);
		}
	else {
		int	len;
		char	message[300];

		close(pfd[1]);
		*message = 0;
		if ((len = read(pfd[0], message, sizeof(message) - 2)) < 0)
			len = 0;

		message[len] = 0;
		noctrl(message);
		close(pfd[0]);

		if (waitpid(pid, &rc, 0) < 0) {
			syslog(LOG_NOTICE, "-ERR: error while waiting for acp: %s", strerror(errno));
			exit (1);
			}

		rc = WIFEXITED(rc) != 0? WEXITSTATUS(rc): 1;
		if (*message == 0)
			copy_string(message, rc == 0? "access granted": "access denied", sizeof(message));

		if (*message != 0)
			syslog(LOG_NOTICE, "%s (rc= %d)", message, rc);
		}
		
	return (rc);
}

static char *getvarname(char **here, char *var, int size)
{
	int	c, k;

	size = size - 2;
	k = 0;
	while ((c = **here) != 0) {
		*here += 1;
		if (c == ' '  ||  c == '\t'  ||  c == '=')
			break;

		if (k < size)
			var[k++] = c;
		}

	var[k] = 0;
	strupr(var);
	*here = skip_ws(*here);

	return (var);
}

int run_ctp(ftp_t *x)
{
	int	rc, pid, pfd[2];
	char	line[300];
	FILE	*fp;
	
	if (*x->config->ctp == 0)
		return (0);

	rc = 0;
	if (pipe(pfd) != 0) {
		syslog(LOG_NOTICE, "-ERR: can't pipe: %s", strerror(errno));
		exit (1);
		}
	else if ((pid = fork()) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't fork trp: %s", strerror(errno));
		exit (1);
		}
	else if (pid == 0) {
		int	argc;
		char	*argv[32];

		close(0);		/* Das trp kann nicht vom client lesen. */
		dup2(pfd[1], 1);	/* stdout wird vom parent gelesen. */
		close(pfd[0]);
		set_variables(x);
			
		copy_string(line, x->config->ctp, sizeof(line));
		argc = split(line, argv, ' ', 30);
		argv[argc] = NULL;
		execvp(argv[0], argv);

		syslog(LOG_NOTICE, "-ERR: can't exec trp %s: %s",
			argv[0], strerror(errno));
		exit (1);
		}
	else {
		char	*p, var[80], line[300];

		close(pfd[1]);
		fp = fdopen(pfd[0], "r");
		while (fgets(line, sizeof(line), fp)) {
			p = skip_ws(noctrl(line));
			getvarname(&p, var, sizeof(var));

			if (strcmp(var, "SERVERNAME") == 0  ||  strcmp(var, "SERVER") == 0)
				copy_string(x->server.name, p, sizeof(x->server.name));
			else if (strcmp(var, "SERVERLOGIN") == 0  ||  strcmp(var, "LOGIN") == 0)
				copy_string(x->username, p, sizeof(x->username));
			else if (strcmp(var, "SERVERPASSWD") == 0  ||  strcmp(var, "PASSWD") == 0)
				copy_string(x->password, p, sizeof(x->password));
			else if (strcmp(var, "SERVERPORT") == 0  ||  strcmp(var, "PORT") == 0)
				x->server.port = atoi(p);

			/*
			 * Enable the trp to send error messages.
			 */

			else if (strcmp(var, "-ERR") == 0  ||  strcmp(var, "-ERR:") == 0) {
				syslog(LOG_NOTICE, "-ERR: %s", skip_ws(p));
				exit (1);
				}
			}

		fclose(fp);

		/*
		 * In standalone mode we do not receive the SIGCHLD because
		 * we set it to SIG_IGN -- 030406asg
		 */

		if (x->config->standalone == 0  &&  waitpid(pid, &rc, 0) < 0) {
			syslog(LOG_NOTICE, "-ERR: error while waiting for trp: %s", strerror(errno));
			exit (1);
			}

		rc = WIFEXITED(rc) != 0? WEXITSTATUS(rc): 1;
		if (rc != 0) {
			syslog(LOG_NOTICE, "-ERR: trp signals error condition, rc= %d", rc);
			exit (1);
			}
		}

	return (rc);
}

int get_ftpdir(ftp_t *x)
{
	int	rc, len;
	char	*p, *start, line[300];
	static char *quotes = "'\"'`";

	sfputs(x, "%s", "PWD");
	if (sfgets(x, line, sizeof(line)) == NULL) {
		syslog(LOG_NOTICE, "monitor: server not responding");
		exit (1);
		}

	rc = strtol(line, &p, 10);
	if (rc != 257) {
		syslog(LOG_NOTICE, "monitor: PWD status: %d", rc);
		exit (1);
		}

	p = skip_ws(p);
	if (*p == 0) {
		syslog(LOG_NOTICE, "monitor: directory unset");
		exit (1);
		}


	if ((start = strchr(p, '/')) == NULL) {
		syslog(LOG_NOTICE, "monitor: can't find directory in string: %s", p);
		exit (1);
		}

	get_word(&start, x->cwd, sizeof(x->cwd));
	if ((len = strlen(x->cwd)) > 0  &&  strchr(quotes, x->cwd[len-1]) != NULL)
		x->cwd[len - 1] = 0;

	if (*x->cwd != '/') {
		syslog(LOG_NOTICE, "monitor: invalid path: %s", x->cwd);
		exit (1);
		}
		
	syslog(LOG_NOTICE, "cwd: %s", x->cwd);
	return (0);
}

int get_ftppath(ftp_t *x, char *path)
{
	int	i, k, n, m;
	char	cwp[200], ftpdir[200], pbuf[200];
	char	*part[DIR_MAXDEPTH+5], *dir[DIR_MAXDEPTH+5];

	/*
	 * Zuerst wird das aktuelle Verzeichnis (der ftppath) in seine
	 * Einzelteile zerlegt ...
	 */

	if (*path == '/') {

		/*
		 * ... Ausnahme: die path-Angabe ist absolut ...
		 */

		dir[0] = "";
		n = 1;
		}
	else {
		copy_string(ftpdir, x->cwd, sizeof(ftpdir));
		if (*ftpdir != 0  &&  strcmp(ftpdir, "/") != 0)
			n = split(ftpdir, part, '/', DIR_MAXDEPTH);
		else {
			dir[0] = "";
			n = 1;
			}
		}

	/*
	 * ... danach der path.  Die path Teile werden unter Beachtung
	 * der ueblichen Regeln an die Teile des aktuellen Verzeichnisses
	 * angehangen ...
	 */

	copy_string(pbuf, path, sizeof(pbuf));
	m = split(pbuf, dir, '/', 15);
	for (i=0; i<m; i++) {
		if (*dir[i] == 0)
			/* zwei aufeinander folgende `/' */ ;
		else if (strcmp(dir[i], ".") == 0)
			/* nichts */ ;
		else if (strcmp(dir[i], "..") == 0) {
			if (n > 1)
				n = n - 1;
			}
		else
			part[n++] = dir[i];

		if (n < 1  ||  n >= DIR_MAXDEPTH)
			return (1);		/* ungueltiges Verzeichnis */
		}

	/*
	 * ... und das Ergebnis wieder zusammengesetzt.
	 */

	if (n <= 1) {
		strcpy(cwp, "/");
		}
	else {
		k = 0;
		for (i=1; i<n; i++) {
			if ((k + strlen(part[i]) + 1 + 2) >= sizeof(dir))
				return (1);		/* Name zu lang */
				
			cwp[k++] = '/';
			strcpy(&cwp[k], part[i]);
			k += strlen(&cwp[k]);
			}

		cwp[k] = 0;
		}

	/*
	 * Der normalisierte path auf das Objekt (Datei oder Verzeichnis,
	 * ist hier egal) ist fertig.
	 */

	copy_string(x->filepath, cwp, sizeof(x->filepath));
	return (0);
}

int run_ccp(ftp_t *x, char *cmd, char *par)
{
	int	rc, pid, pfd[2], lfd[2];
	char	message[300], line[300];

	/*
	 * Wenn kein ccp angegeben ist ist alles erlaubt.
	 */

	if (*x->config->ccp == 0)
		return (CCP_OK);


	/*
	 * Der Vorgang fuer ccp's ist fast gleich mit dem fuer acp's.
	 */

	rc = 0;
	if (pipe(pfd) != 0  ||  pipe(lfd)) {
		syslog(LOG_NOTICE, "-ERR: can't pipe: %s", strerror(errno));
		exit (1);
		}
	else if ((pid = fork()) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't fork ccp: %s", strerror(errno));
		exit (1);
		}
	else if (pid == 0) {
		int	argc;
		char	*argv[32];

		dup2(pfd[1], 2);	/* stderr nach FTP Client */
		close(pfd[0]);

		dup2(lfd[1], 1);	/* stdout nach syslog */
		close(lfd[0]);

		close(0);
		set_variables(x);

		setvar(x, "COMMAND", cmd);
		setvar(x, "PARAMETER", par);

		setvar(x, "SESSION", x->session);
		snprintf (line, sizeof(line) - 2, "%d", x->ccpcoll);
		setvar(x, "CCPCOLL", line);

		setvar(x, "FTPHOME", x->home);
		setvar(x, "FTPPATH", x->filepath);

		copy_string(line, x->config->ccp, sizeof(line));
		argc = split(line, argv, ' ', 30);
		argv[argc] = NULL;
		execvp(argv[0], argv);

		syslog(LOG_NOTICE, "-ERR: can't exec ccp %s: %s", argv[0], strerror(errno));
		exit (1);
		}
	else {
		int	len;

		/*
		 * Nicht gebrauchte fd's schliessen.
		 */

		close(pfd[1]);
		close(lfd[1]);


		/*
		 * syslog Meldung lesen und entsprechende pipe schliessen.
		 */

		*message = 0;
		if ((len = read(lfd[0], message, sizeof(message) - 2)) < 0)
			len = 0;

		message[len] = 0;
		noctrl(message);
		close(lfd[0]);

		if (*message != 0)
			syslog(LOG_NOTICE, "%s", message);



		/*
		 * Fehlermeldung lesen, pipe schliessen.
		 */

		*message = 0;
		if ((len = read(pfd[0], message, sizeof(message) - 2)) < 0)
			len = 0;

		message[len] = 0;
		noctrl(message);
		close(pfd[0]);


		/*
		 * return code holen.
		 */

		if (waitpid(pid, &rc, 0) < 0) {
			syslog(LOG_NOTICE, "-ERR: error while waiting for ccp: %s", strerror(errno));
			exit (1);
			}

		rc = WIFEXITED(rc) != 0? WEXITSTATUS(rc): 1;
		if (rc == 0)
			return (CCP_OK);

		if (*message == 0)
			copy_string(message, "permission denied", sizeof(message));

/*
 *		snprintf (command, sizeof(command) - 2, "%s%s%s", cmd, (par != 0? " ": ""), par);
 *		syslog(LOG_NOTICE, "ccp: -ERR: %s@%s: %s: %s: rc= %d",
 *				x->username, x->server.name,
 *				command, message, rc);
 */
		}

	x->ccpcoll++;
	if (isdigit(*message))
		cfputs(x, message);
	else {
		snprintf (line, sizeof(line) - 2, "553 %s", message);
		cfputs(x, line);
		}

/*	cfputs(x, "553 permission denied."); */

	return (CCP_ERROR);
}


	/*
	 * dologin() accepts now blanks with in and at the end of
	 * passwords - 22JAN02asg
	 */

int dologin(ftp_t *x)
{
	int	c, i, rc;
	char	*p, word[80], line[300];
	struct hostent *hostp;
	struct sockaddr_in saddr;
			
	while (1) {
		if (readline_fd(x, 0, line, sizeof(line)) == NULL)
			return (1);

		if (x->config->allow_passwdblanks == 0)
			p = noctrl(line);
		else {
			p = line;
			for (i=strlen(line)-1; i>=0; i--) {
				if ((c = line[i]) != '\n'  &&  c != '\r') {
					line[i+1] = 0;
					break;
					}
				}
			}

		get_word(&p, word, sizeof(word));
		strupr(word);
		if (strcmp(word, "USER") == 0) {
			get_word(&p, x->username, sizeof(x->username));
			fprintf(stderr, "After get_word, username = %s\n", x->username);
			cfputs(x, "331 password required");
			}
		else if (strcmp(word, "PASS") == 0) {
			if (*x->username == 0) {
				cfputs(x, "503 give USER first");
				continue;
				}

			if (x->config->allow_passwdblanks == 0)
				get_word(&p, x->password, sizeof(x->password)); 
			else
				copy_string(x->password, p, sizeof(x->password));

			fprintf(stderr, "After get_word or copy_string, password = %s\n", x->password);

			break;
			}
		else if (strcmp(word, "QUIT") == 0) {
			cfputs(x, "221 goodbye");
			return (2);
			}
		else {
			cfputs(x, "530 login first");
			}
		}
		
		fprintf(stderr, "Get username and password from client.\n");
#if 0
	if (*x->config->ctp != 0) {

		/*
		 * We are extremly liberate here with server selection
		 * if we have a dynamic control program, we accept
		 * anything here -- 030404asg
		 */
		fprintf(stderr, "x->config->ctp != 0\n");

		if ((p = strchr(x->username, '@')) == NULL  &&  (p = strchr(x->username, '%')) == NULL)
			*x->server.name = 0;
		else if (x->config->use_last_at == 0) {
			*p++ = 0;
			copy_string(x->server.name, p, sizeof(x->server.name));
			}
		else {
			if ((p = strrchr(x->username, '@')) == NULL)
				p = strrchr(x->username, '%');

			*p++ = 0;
			copy_string(x->server.name, p, sizeof(x->server.name));
			}
		}
	else if (x->config->selectserver == 0) {
		fprintf(stderr, "x->config->selectserver == 0\n");
		if ((p = strchr(x->username, '@')) != NULL  &&  (p = strchr(x->username, '%')) != NULL) {
			cfputs(x, "500 service unavailable");
			syslog(LOG_NOTICE, "-ERR: hostname supplied: %s", p);
			exit (1);
			}

		copy_string(x->server.name, x->config->server, sizeof(x->server.name));
		}
	else {

		/*
		 * Normally we search for the first '@' so that the client can 
		 * not use "proxy hopping". The option "-u" can override
		 * this behaviour.
		 */

		if (x->config->use_last_at == 0) {
			fprintf(stderr, "x->config->use_last_at == 0\n");
			if ((p = strchr(x->username, '@')) == NULL  &&  (p = strchr(x->username, '%')) == NULL) {
				cfputs(x, "500 service unavailable");
				syslog(LOG_NOTICE, "-ERR: missing hostname");
				exit (1);
				}
			}
		else {
			fprintf(stderr,"ELSE\n");
			if ((p = strrchr(x->username, '@')) == NULL  &&  (p = strrchr(x->username, '%')) == NULL) {
				cfputs(x, "500 service unavailable");
				syslog(LOG_NOTICE, "-ERR: missing hostname");
				exit (1);
				}
			}


		*p++ = 0;
		copy_string(x->server.name, p, sizeof(x->server.name));
		/*
		 * Den Server auf der Serverliste suchen, wenn eine Liste
		 * vorhanden ist.
		 */

/*
 * Checking the server against the given list is done later now,
 * see below.  Code quoted -- 030404asg
 *
 *		if ((p = x->config->serverlist) != NULL  &&  *p != 0) {
 *			int	permitted;
 *			char	pattern[80];
 *
 *			permitted = 0;
 *			while ((p = skip_ws(p)), *get_quoted(&p, ',', pattern, sizeof(pattern)) != 0) {
 *				noctrl(pattern);
 *				if (strpcmp(x->server.name, pattern) == 0) {
 *					permitted = 1;
 *					break;
 *					}
 *				}
 *
 *			if (permitted == 0) {
 *				cfputs(x, "500 service unavailable");
 *				syslog(LOG_NOTICE, "-ERR: hostname not permitted: %s", x->server.name);
 *				exit (1);
 *				}
 *			}
 */
		}


	/*
	 * Wenn vorhanden Proxy Login und Passwort auslesen.
	 */

	if ((p = strchr(x->username, ':')) != NULL) {
		*p++ = 0;
		copy_string(x->local.username, x->username, sizeof(x->local.username));
		copy_string(x->username, p, sizeof(x->username));
		}

	if ((p = strchr(x->password, ':')) != NULL) {
		*p++ = 0;
		copy_string(x->local.password, x->password, sizeof(x->local.password));
		copy_string(x->password, p, sizeof(x->password));
		}

        /*
         * Call the dynamic configuration program.
         */

        if (*x->config->ctp != 0) {
		x->server.port = get_port(x->server.name, 21);

                if (run_ctp(x) != 0)
                        exit (0);       /* Never happens, we exit in run_ctp() */

		if (debug != 0) {
	                fprintf (stderr, "trp debug: server= %s:%u, login= %s, passwd= %s",
					x->server.name, x->server.port,
					x->username, x->password);
			}
                }


	/*
	 * Get port an IP number of server.  Moved code here -- 030404asg
	 */

	x->server.port = get_port(x->server.name, 21);
	if ((hostp = gethostbyname(x->server.name)) == NULL) {
		cfputs(x, "500 service unavailable");
		syslog(LOG_NOTICE, "-ERR: can't resolve hostname: %s", x->server.name);
		exit (1);
		}

	memcpy(&saddr.sin_addr, hostp->h_addr, hostp->h_length);
	copy_string(x->server.ipnum, inet_ntoa(saddr.sin_addr), sizeof(x->server.ipnum));


	/*
	 * Call the access control program to check if the proxy
	 * request is allowed.  Moved code here -- 030404asg
	 */

	if (*x->config->acp != 0) {
		if (run_acp(x) != 0)
			exit (0);
		}


	/*
	 * Verification if the destination server is on the given list
	 * is done now here.
	 *
	 * Notice: Prior to this change you could give a fixed desination
	 * server as command line argument and a list of allowed server
	 * too.  Meaningless because the proxy didn't care when the `server
	 * selection' option wasn't turned on.  Now also the fixed server
	 * is checked against the list.
	 *
	 * I don't expect that this breaks an already running configuration
	 * because as said above this configuration was senseless in earlier
	 * proxy versions -- 030404asg
	 */

	if ((p = x->config->serverlist) != NULL  &&  *p != 0) {
		int	permitted;
		char	pattern[80];

		permitted = 0;
		while ((p = skip_ws(p)), *get_quoted(&p, ',', pattern, sizeof(pattern)) != 0) {
			noctrl(pattern);
			if (strpcmp(x->server.name, pattern) == 0) {
				permitted = 1;
				break;
				}
			}

		if (permitted == 0) {
			cfputs(x, "500 service unavailable");
			syslog(LOG_NOTICE, "-ERR: hostname not permitted: %s", x->server.name);
			exit (1);
			}
		}

#endif
	/*
	 * Establish connection to the server
	 */
	/* Add by zhangzhong */
	fprintf(stderr, "username = %s\n", x->username);
	fprintf(stderr, "password = %s\n", x->password);
	fprintf(stderr, "local username = %s\n", x->local.username);
	fprintf(stderr, "local password = %s\n", x->local.password);
	fprintf(stderr,	"server name = %s\nserver ipnum = %s\nclient = %s\nclient ip = %s\n",
		x->server.name, x->server.ipnum, x->client, x->client_ip);
	fprintf(stderr, "session = %s\nlogusername = %s\n", x->session, x->logusername);

	int auth_ret;
	char *radius_user, *dest_ip, *dest_username, *dest_password;
	char *needle = NULL, null_password[64];

	bzero(null_password, sizeof(null_password));
	needle = strstr(x->password, "---");
	if (needle)
	{
		*needle = 0x00;
		strcpy(null_password, needle + 3);
	}

	auth_ret = ftp2authserver(x->username, x->password, x->server.ipnum, x->client_ip, 0, 1, 
			&radius_user, &dest_ip, &(x->server.port), &dest_username, &dest_password, &x->login_commit,
			&x->ipv6, &x->timeout, &x->report);

	if (auth_ret == 0)
	{
		strcpy(x->server.name, dest_ip);
		strcpy(x->server.ipnum, dest_ip);
		strcpy(x->username, dest_username);
		if (needle == NULL)
			strcpy(x->password, dest_password);
		else
			strcpy(x->password, null_password);
	}
	else
	{
		cfputs(x, "500 service unavailable");
		syslog(LOG_NOTICE, "-ERR: Auth ret = %d", auth_ret);
		exit (1);
	}

	fprintf(stderr,	"server name = %s\nserver ipnum = %s\nclient = %s\nclient ip = %s\nlogin_commit = %d\n"\ 
			"ipv6 = %d\ntimeout = %d\nreport = %d\n",
		x->server.name, x->server.ipnum, x->client, x->client_ip, x->login_commit, 
		x->ipv6, x->timeout, x->report);

	if (x->ipv6 == 1) {
		if ((x->fd.server = openip6(x->server.name, x->server.port, x->config->sourceip, 0)) < 0) {
			cfputs(x, "500 service unavailable");
			syslog(LOG_NOTICE, "-ERR: can't connect to server6: %s", x->server.name);
			exit (1);
		}
	}
	else {
		if ((x->fd.server = openip(x->server.name, x->server.port, x->config->sourceip, 0)) < 0) {
			cfputs(x, "500 service unavailable");
			syslog(LOG_NOTICE, "-ERR: can't connect to server: %s", x->server.name);
			exit (1);
		}
	}
	syslog(LOG_NOTICE, "connected to server: %s", x->server.name);


	if (sfputc(x, NULL, NULL, line, sizeof(line), NULL) != 220) {
		cfputs(x, "500 service unavailable");
		syslog(LOG_NOTICE, "-ERR: unexpected server greeting: %s", line);
		exit (1);
		}

	/*
	 * Login auf FTP-Server.
	 *
	 * Complete rewrite because of servers wanting no password after
	 * login of anonymous user.
	 */

	/* Add by zhangzhong */
	x->backup_fd = -1;
	MYSQL *sql_conn = NULL;
	MYSQL_RES *res;
	MYSQL_ROW row;
	char sql_buf[256];
	/*x->sql_conn = mysql_init(NULL);
	x->sql_conn = mysql_real_connect(x->sql_conn, NULL, "freesvr", "freesvr", "audit_sec", 0, NULL, 0);
	if (x->sql_conn)
	{
		//x->sql_conn = sql_conn;
		syslog(LOG_NOTICE, "Connect to MySQL, sql_conn = %p, x->sql_conn = %p.", sql_conn, x->sql_conn);
		//todo
	}
	else
	{
		//todo
	}*/

	snprintf(sql_buf, sizeof(sql_buf), 
			"INSERT INTO ftpsessions(cliaddr,sport,svraddr,dport,auditaddr,radius_user,ftp_user,start,SMAC,DMAC,logincommit)"\
			" VALUES('%s','%d','%s','%d','%s','%s','%s',now(),'%s','%s',%d)",
			x->client_ip, clientport, 
			x->server.name, x->server.port, 
			"127.0.0.1",
			radius_user,
			x->username,
			"","", x->login_commit);
	fprintf(stderr, "%s\n", sql_buf);
	/* Add by zhangzhong */

	rc = sfputc(x, "USER", x->username, line, sizeof(line), NULL);

	if (rc == 230) {
		cfputs(x, "230 login accepted");
		syslog(LOG_NOTICE, "login accepted: %s@%s, no password needed.", x->username, x->server.name);

		/* Add by zhangzhong */
		mysql_query(x->sql_conn, sql_buf);
		mysql_query(x->sql_conn, "SELECT LAST_INSERT_ID()");
		res = mysql_use_result(x->sql_conn);
		row = mysql_fetch_row(res);
		x->sid = atoi(row[0]);
		mysql_free_result(res);

		return (0);
		}
	else if (rc != 331) {
		cfputs(x, "500 service unavailable");
		syslog(LOG_NOTICE, "-ERR: unexpected reply to USER: %s", line);
		exit (1);
		}
	else if (sfputc(x, "PASS", x->password, line, sizeof(line), NULL) != 230) {
		cfputs(x, "530 bad login");
		syslog(LOG_NOTICE, "-ERR: reply to PASS: %s", line);
		exit (1);
		}

	cfputs(x, "230 login accepted");
	syslog(LOG_NOTICE, "login accepted: %s@%s", x->username, x->server.name);
	
	/* Add by zhangzhong */
	mysql_query(x->sql_conn, sql_buf);
	mysql_query(x->sql_conn, "SELECT LAST_INSERT_ID()");
	res = mysql_use_result(x->sql_conn);
	row = mysql_fetch_row(res);
	x->sid = atoi(row[0]);
	mysql_free_result(res);
	fprintf(stderr, "sid = %d\n", x->sid);
	
	return (0);

/*
	if (sfputc(x, "USER", x->username, line, sizeof(line), NULL) != 331) {
		cfputs(x, "500 service unavailable");
		syslog(LOG_NOTICE, "-ERR: unexpected reply to USER: %s", line);
		exit (1);
		}
	else if (sfputc(x, "PASS", x->password, line, sizeof(line), NULL) != 230) {
		cfputs(x, "530 bad login");
		syslog(LOG_NOTICE, "-ERR: reply to PASS: %s", line);
		exit (1);
		}

	cfputs(x, "230 login accepted");
	syslog(LOG_NOTICE, "login accepted: %s@%s", x->username, x->server.name);

	return (0);
*/


}

void signal_handler(int sig)
{
	/*
	 * Changed the way we handle broken pipes (broken control or
	 * data connection).  We ignore it here but write() returns -1
	 * and errno is set to EPIPE which is checked.
	 */

	if (sig == SIGPIPE) {
		signal(SIGPIPE, signal_handler);
		return;
		}

	syslog(LOG_NOTICE, "-ERR: received signal #%d", sig);
	exit (1);
}

int set_signals(void)
{
	signal(SIGHUP, signal_handler);
	signal(SIGINT, signal_handler);
	signal(SIGQUIT, signal_handler);
	signal(SIGSEGV, signal_handler);
	signal(SIGPIPE, signal_handler);
	signal(SIGALRM, signal_handler);
	signal(SIGTERM, signal_handler);
	signal(SIGUSR1, signal_handler);
	signal(SIGUSR2, signal_handler);

	return (0);
}


ftpcmd_t *getcmd(char *name)
{
	int	i;

	for (i=0; cmdtab[i].name[0] != 0; i++) {
		if (strcmp(cmdtab[i].name, name) == 0)
			return (&cmdtab[i]);
		}

	return (NULL);
}


int proxy_request(config_t *config)
{
	int	rc;
	char	*p, command[200], parameter[200], line[300];
	ftpcmd_t *cmd;
	ftp_t	*x;

	set_signals();

	/*
	 * Set socket options to prevent us from the rare case that
	 * we transfer data to/from the client before the client has
	 * seen our "150 ..." message.
	 * Seems so that is doesn't work on all systems.
	 * So temporary only enable it on linux. 
	 */

#if defined(__linux__)

	rc = 1;
	if (setsockopt(1, SOL_TCP, TCP_NODELAY, &rc, sizeof(rc)) != 0)
		syslog(LOG_NOTICE, "can't set TCP_NODELAY, error= %s", strerror(errno));

#endif

	if (config->bsize <= 0)
		config->bsize = 1024;
	else if (config->bsize > FTPMAXBSIZE)
		config->bsize = FTPMAXBSIZE;

	x = allocate(sizeof(ftp_t));
	x->config = config;
	snprintf (x->session, sizeof(x->session) - 2, "%lu-%u", time(NULL), getpid());


	/*
	 * Fix potential problems after immediate initial unseccsesful
	 * up/downloads.  Wasn't a problem since we all do a LIST
	 * at first.
	 */

	x->ch.isock = -1;
	x->ch.osock = -1;


	if (get_client_info(x, 0) < 0) {
		syslog(LOG_NOTICE, "-ERR: can't get client info: %s", strerror(errno));
		exit (1);
		}

	x->port = get_interface_info(0, x->interface, sizeof(x->interface));
	syslog(LOG_NOTICE, "connected to client: %s, interface= %s:%u", x->client,
				x->interface, x->port);

	if (*x->config->configfile != 0) {
		if (readconfig(x->config, x->config->configfile, x->interface) == 0) {
			cfputs(x, "421 not available");
			syslog(LOG_NOTICE, "-ERR: unconfigured interface: %s", x->interface);
			exit (1);
			}
		}

	syslog(LOG_NOTICE, "info: monitor mode: %s, ccp: %s",
			x->config->monitor == 0? "off": "on",
			*x->config->ccp == 0? "<unset>": x->config->ccp);

	cfputs(x, "220 server ready - login please");

	/* Add by zhangzhong */
	x->sql_conn = mysql_init(NULL);
	x->sql_conn = mysql_real_connect(x->sql_conn, NULL, "freesvr", "freesvr", "audit_sec", 0, NULL, 0);
	if (x->sql_conn)
	{
		syslog(LOG_NOTICE, "Connect to MySQL, x->sql_conn = %p.", x->sql_conn);
		mysql_query(x->sql_conn, "set names utf8");
	}
	else
	{
		syslog(LOG_NOTICE, "Can't connect to MySQL.");
	}

	if ((rc = dologin(x)) < 0)
		return (1);
	else if (rc == 2)
		return (0);


	/*
	 * Open the xferlog if we have one.
	 */

	if (*x->config->xferlog != 0) {
		if (*x->server.name == 0)
			copy_string(x->logusername, x->username, sizeof(x->logusername));
		else if (x->server.port != 21)
			snprintf (x->logusername, sizeof(x->logusername), "%s@%s:%u", x->username, x->server.name, x->server.port);
		else
			snprintf (x->logusername, sizeof(x->logusername), "%s@%s", x->username, x->server.name);

		x->xlfp = fopen(x->config->xferlog, "a");
		if (x->xlfp == NULL) {
			syslog(LOG_NOTICE, "-WARN: can't open xferlog: %s, error= %s",
					x->config->xferlog, strerror(errno));
			}
		}

	if (x->config->monitor) {
		get_ftpdir(x);
		copy_string(x->home, x->cwd, sizeof(x->home));
		}

	while ((p = cfgets(x, line, sizeof(line))) != NULL) {
		if (*p == '\001') {
			if (*x->ch.command != 0) {
				syslog(LOG_NOTICE, "%s %s: %ld bytes", x->ch.command, x->ch.filename, x->ch.bytes);
				
				/* Add by zhangzhong */
				record_command(x, x->ch.command, x->ch.filename, 0, x->ch.bytes);

				if (x->xlfp != NULL) {
					unsigned long now;
					char	date[80];

					/*
					 * Write xferlog entry but notice that (1) session are never
					 * flagged as anonymous and (2) the transfer type is always
					 * binary (type flag was added to data channel but is
					 * actually not used. 10MAY04wzk
					 */

					now = time(NULL);
					copy_string(date, ctime(&now), sizeof(date));
					fprintf (x->xlfp, "%s %lu %s %lu %s %c %c %c %c %s %s %d %s %c\n",
					//fprintf (stderr, "%s %lu %s %lu %s %c %c %c %c %s %s %d %s %c\n",
							date,
							now - x->ch.started,
							x->client_ip,
							x->ch.bytes,
							x->ch.filename,
							'b',		/* x->ch.type == TYPE_ASC? 'a': 'b', */
							'-',
							strcmp(x->ch.command, "RETR")? 'i': 'o',
							'u',		/* x->isanonymous == 1? 'a': 'u', */
							x->logusername,
							"ftp", 1, x->logusername, 'c');
					fflush(x->xlfp);
					}
				}

			/*
			 * Handle multiline server responses after the
			 * data transfer.
			 */

			sfputc(x, NULL, NULL, line, sizeof(line), NULL);
			cfputs(x, line);

			continue;
			}

		p = noctrl(line);
		get_word(&p, command, sizeof(command));
		strupr(command);

		if ((cmd = getcmd(command)) == NULL  ||  cmd->resp == -1) {
			cfputs(x, "502 command not implemented");
			syslog(LOG_NOTICE, "command not implemented: %s", command);
			continue;
			}

		*x->filepath = 0;
		if (cmd->par == 0)
			*parameter = 0;
		else {
			if (strcmp(command, "CDUP") == 0)
				strcpy(parameter, "..");
			else if (strcmp(command, "SITE") == 0)
				copy_string(parameter, p, sizeof(parameter));
			else {
				/* Add by zhangzhong */
				if (x->config->allow_blanks != 0)
					copy_string(parameter, p, sizeof(parameter));
				else
					get_word(&p, parameter, sizeof(parameter));
					
				if (*parameter == 0) {
					if (strcmp(command, "LIST") == 0  ||  strcmp(command, "NLST") == 0)
						/* nichts, ist ok */ ;
					else {
						syslog(LOG_NOTICE, "parameter required: %s", command);
						exit (1);
						}
					}
				}

			if (cmd->ispath != 0) {
				if (x->config->monitor) {
					if ((strcmp(command, "LIST") == 0  ||  strcmp(command, "NLST") == 0)
					    &&  *parameter == 0) {

						/*
						 * Sonderfall: wir simulieren `*' als Parameter.
						 */

						get_ftppath(x, "*");
						}
					else
						get_ftppath(x, parameter);
					}
				}
			}


		if (cmd->useccp != 0) {
			if (run_ccp(x, command, parameter) != CCP_OK)
				continue;
			}


		if (strcmp(command, "QUIT") == 0) {
/*		        run_ccp(x, "QUIT", ""); */
			doquit(x);
			break;
			}
		else if (strcmp(command, "PORT") == 0)
			doport(x, command, parameter);
		else if (strcmp(command, "FEAT") == 0)
			dofeat(x);
		else if (strcmp(command, "PASV") == 0)
			dopasv(x, command, parameter);
		else if (strcmp(command, "LIST") == 0  ||  strcmp(command, "NLST") == 0) {
			x->ch.operation = OP_GET;	/* fuer PASV mode */
			rc = sfputc(x, command, parameter, line, sizeof(line), NULL);
			if (rc == 125  ||  rc == 150) {
				x->ch.operation = OP_GET;
				x->ch.seen150   = 1;
				if (debug >= 2)
					fprintf (stderr, "received 150 response\n");
				}
			else
				close_ch(x, &x->ch);

			cfputs(x, line);
			*x->ch.command = 0;
			}
		else if (strcmp(command, "RETR") == 0) {
			x->ch.operation = OP_GET;	/* fuer PASV mode */
			rc = sfputc(x, "RETR", parameter, line, sizeof(line), NULL);
			if (rc == 125  ||  rc == 150) {
				x->ch.operation = OP_GET;
				x->ch.seen150   = 1;
				if (debug >= 2)
					fprintf (stderr, "received 150 response\n");
				}
			else
				close_ch(x, &x->ch);

			cfputs(x, line);
			copy_string(x->ch.command, "RETR", sizeof(x->ch.command));
			copy_string(x->ch.filename, x->config->monitor != 0? x->filepath: parameter, sizeof(x->ch.filename));

			if (extralog != 0)
				syslog(LOG_NOTICE, "%d RETR %s", rc, (x->config->monitor != 0)? parameter: x->filepath);
			}
		else if (strcmp(command, "STOR") == 0  ||  strcmp(command, "APPE") == 0  ||  strcmp(command, "STOU") == 0) {
			x->ch.operation = OP_PUT;	/* fuer PASV mode */
			//fprintf(stderr, "[%s]: parameter is %s\n", __func__, parameter);
			rc = sfputc(x, command, parameter, line, sizeof(line), NULL);
			if (rc == 125  ||  rc == 150) {
				x->ch.operation = OP_PUT;
				x->ch.seen150   = 1;
				if (debug >= 2)
					fprintf (stderr, "received 150 response\n");

				copy_string(x->ch.command, command, sizeof(x->ch.command));
				}
			else
				close_ch(x, &x->ch);

			cfputs(x, line);
			copy_string(x->ch.filename, x->config->monitor != 0? x->filepath: parameter, sizeof(x->ch.filename));
			if (extralog != 0) {
				if (strcmp(command, "STOU") == 0)
					syslog(LOG_NOTICE, "%d %s %s", rc, command, "-");
				else
					syslog(LOG_NOTICE, "%d %s %s", rc, command, x->ch.filename);
				}
			}
		else {
			if (strcmp(command, "CDUP") == 0)
				*parameter = 0;

			rc = sfputc(x, command, parameter, line, sizeof(line), NULL);
			cfputs(x, line);

			/* Add by zhangzhong */
			record_command(x, command, parameter, rc, 0);

			if (extralog != 0  &&  cmd->log != 0) {
				if (x->config->monitor != 0  &&  cmd->ispath != 0)
					syslog(LOG_NOTICE, "%d %s # %s", rc, command, x->filepath);
				else
					syslog(LOG_NOTICE, "%d %s-%s-%s", rc, command, *parameter != 0? " ": "", parameter);
				}

			if (strcmp(command, "CWD") == 0  ||  strcmp(command, "CDUP") == 0) {
				if (x->config->monitor)
					get_ftpdir(x);
				}
			}
		}

	if (*x->config->ccp != 0)
		run_ccp(x, "+EXIT", x->session);

	record_endtime(x);
	
	syslog(LOG_NOTICE, "+OK: proxy terminating");
	return (0);
}



