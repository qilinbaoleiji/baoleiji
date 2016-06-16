#ifndef __TOOLS_H__
#define __TOOLS_H__

#include <stdio.h>
#include <string.h>
#include <iconv.h>
#include <time.h>
#include <syslog.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>
#include <mysql.h>

#include "ftp.h"

char *g2u(char *);
const char *str_time(time_t, const char *);
int record_endtime(ftp_t *);
int record_command(ftp_t *, const char *, const char *, int, int);

#endif
