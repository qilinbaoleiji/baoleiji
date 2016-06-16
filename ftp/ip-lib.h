
/*

    File: ftpproxy/ip-lib.h

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

#ifndef _IP_LIB_INCLUDED
#define	_IP_LIB_INCLUDED

extern char *program;


int openip(char *server, unsigned int port, char *srcip, unsigned int srcport);
int openip6(char *server, unsigned int port, char *srcip, unsigned int srcport);

unsigned int getportnum(char *name);
unsigned int get_port(char *server, unsigned int def_port);

int bind_to_port(char *interface, unsigned int port);
int accept_loop(int sock);

#endif
