
/*

    File: ftpproxy/ftp.h

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

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#ifndef	_FTP_INCLUDED
#define	_FTP_INCLUDED

#include "mysql.h"

extern char *version;

extern char *program;
extern char progname[80];

extern int debug;
extern int extralog;
extern int bindport;
extern int daemonmode;
extern int clientport;

extern int acceptloop (int sock);

#define	FTPMAXBSIZE		4096


typedef struct _config
{
  char configfile[200];

  int standalone;
  int timeout;

  int selectserver;
  int allow_anyremote;

  char server[200];
  char *serverlist;

  char acp[200];
  char ccp[200];
  char ctp[200];
  char varname[80];

  int allow_blanks;
  int allow_passwdblanks;
  int use_last_at;
  int monitor;
  int bsize;
  char xferlog[200];

  int numeric_only;
  char sourceip[200];
  unsigned int dataport;
  
  /* Add by zhangzhong */
  int use_radius_auth;
  int backup_size;
  int mac_record;
  char mac_device[8];
  char audit_ipnum[32];
  char mysql_ipnum[32];
  char mysql_username[32];
  char mysql_password[32];
  char mysql_database[32];
  
} config_t;


#define	DIR_MAXDEPTH		15


#define	CCP_OK			0
#define	CCP_ERROR		1


#define	PORT_LISTEN		1
#define	PORT_CONNECTED		2
#define	PORT_CLOSED		3

#define	MODE_PORT		1
#define	MODE_PASSIVE		2

#define	OP_GET			1
#define	OP_PUT			2

#define	TYPE_ASC		1	/* Transfer modes for xferlog */
#define	TYPE_BIN		2

typedef struct _port
{
  char ipnum[80];
  unsigned int port;
} port_t;

typedef struct _dtc
{
  int state;			/* LISTEN, CONNECTED, CLOSED */
  int seen150;

  int isock;
  int osock;

  int operation;		/* GET oder PUT */
  int active;
  int other;

  int mode;			/* PORT oder PASV */
  port_t server;
  port_t outside;
  port_t inside;
  port_t client;

  int type;			/* Transfer type for xferlog */
  unsigned long started;	/* Timestamp for xferlog */

  char command[20];		/* Fuer syslog Meldungen */
  char filename[200];
  unsigned long bytes;
} dtc_t;


typedef struct _bio
{
  int here, len;
  char buffer[512];
} bio_t;


typedef struct _ftp
{
  config_t *config;

  char interface[80];
  unsigned int port;

  char client[200];
  char client_ip[80];

  char username[200];
  char password[200];

  struct
  {
    char username[80];
    char password[80];
  } local;

  struct
  {
    char name[80];
    unsigned int port;

    char ipnum[80];
  } server;

  struct
  {
    int server;			/* Kontrollverbindung zum Server */

    int cfd;			/* Datenverbindung zum Client */
    int sfd;			/* Datenverbindung zum Server */

    fd_set fdset;
    int max;
  } fd;

  dtc_t ch;
  char cwd[200];
  char home[200];
  char filepath[200];

  bio_t cbuf, sbuf;

  char session[80];
  int ccpcoll;

  FILE *xlfp;
  char logusername[100];

  int commands;
  unsigned long datain, dataout;

  /* Add by zhangzhong */
  int sid;//MySQL last insert id
  int cmd_cnt;
  unsigned int client_port;
  unsigned int server_port;
  char audit_ipnum[32];
  char radius_username[64];
  char client_macaddr[64];
  char server_macaddr[64];
  MYSQL *sql_conn;
  char backup_fn[256];
  int backup_fd;
  int login_commit;
  int ipv6;
  int timeout;
  int report;
} ftp_t;


extern int readconfig (config_t * config, char *filename, char *section);
extern int printconfig (config_t * config);

extern int proxy_request (config_t * config);

#endif
