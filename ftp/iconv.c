#include "tools.h"

int
code_convert(char *from_charset, char *to_charset, char *inbuf, size_t inlen, char *outbuf,
			 size_t outlen)
{
	iconv_t cd;
	char **pin = &inbuf;
	char **pout = &outbuf;

	cd = iconv_open(to_charset, from_charset);
	if (cd == 0)
		return -1;

	if (iconv(cd, pin, (size_t *) & inlen, pout, (size_t *) & outlen) == -1)
		return -1;

	iconv_close(cd);
	return 0;
}

char *
g2u(char *inbuf)
{
	size_t outlen = 1024;
	size_t inlen = strlen(inbuf);
	static char outbuf[1024];

	bzero(outbuf, sizeof(outbuf));
	if (code_convert("GB2312", "UTF-8", inbuf, inlen, outbuf, outlen) == 0)
	{
		return outbuf;
	}
	else
	{
		return inbuf;
	}
}

const char *
str_time(time_t caltime, const char *fmt)
{
	static char tstr[256];
	struct tm *tm;

	if (fmt == NULL)
		fmt = "%Y_%m_%d_%H_%M_%S";

	memset(tstr, 0x00, sizeof(tstr));

	if ((tm = localtime(&caltime)) == NULL)
		return (NULL);

	if (strftime(tstr, sizeof(tstr) - 1, fmt, tm) == 0)
		return (NULL);

	return (tstr);
}

int
record_endtime(ftp_t *x)
{
	char buf[256];

	syslog(LOG_NOTICE, "%s x->sql_conn = %p.", __func__, x->sql_conn);
	//if (x->sql_conn == NULL)
		//return -1;
	/*fprintf(stderr, "%s\n", query);
	mysql_close(x->sql_conn);*/

	//x->sql_conn = mysql_init(NULL);
	//x->sql_conn = mysql_real_connect(x->sql_conn, NULL, "freesvr", "freesvr", "audit_sec", 0, NULL, 0);

	snprintf(buf, sizeof(buf), "UPDATE ftpsessions SET end=NOW() WHERE sid=%d", x->sid);
	if (mysql_query(x->sql_conn, buf) != 0) 
	{
		fprintf(stderr, "MySQL -ERR: %s\n", mysql_error(x->sql_conn));
		syslog(LOG_NOTICE, "MySQL -ERR: %s", mysql_error(x->sql_conn));
	}

	if (x->sql_conn);
		mysql_close(x->sql_conn);

	return 0;
}

int
update_mysql(ftp_t *x, const char *query)
{
	char buf[256];

	//syslog(LOG_NOTICE, "%s", query);
	//if (x->sql_conn == NULL)
		//return -1;
	/*fprintf(stderr, "%s\n", query);
	mysql_close(x->sql_conn);*/

	//x->sql_conn = mysql_init(NULL);
	//x->sql_conn = mysql_real_connect(x->sql_conn, NULL, "freesvr", "freesvr", "audit_sec", 0, NULL, 0);

	//mysql_query(x->sql_conn, "set names utf8");
	if (mysql_query(x->sql_conn, query) != 0) 
	{
		fprintf(stderr, "MySQL -ERR: %s\n", mysql_error(x->sql_conn));
		syslog(LOG_NOTICE, "MySQL -ERR: %s", mysql_error(x->sql_conn));
	}

	snprintf(buf, sizeof(buf), "UPDATE ftpsessions SET total_cmd=%d WHERE sid=%d", ++x->cmd_cnt, x->sid);
	mysql_query(x->sql_conn, buf);

	//mysql_close(x->sql_conn);
	return 0;
}

unsigned long int
get_file_size(const char *filename)
{
	struct stat buf;
	if(stat(filename, &buf)<0)
	{
		return 0;
	}
	return (unsigned long)buf.st_size;
}

int
record_command(ftp_t *x, const char *command, const char *parameter, int rc, int bytes)
{
	char buf[1024];
	static char rename_from[256];

	fprintf(stderr, "command = %s, parameter = %s, rc = %d, bytes = %d\n", command, parameter, rc, bytes);

	if (strcmp(command, "RNFR") == 0 && rc == 350)//rename and src file exists, ready for destination name
	{
		bzero(rename_from, sizeof(rename_from));
		strcpy(rename_from, g2u(parameter));
	}
	else if (strcmp(command, "RNTO") == 0 && rc == 250)//RNTO command successful
	{
		snprintf(buf, sizeof(buf), 
			"INSERT INTO ftpcomm(sid,comm,at,run) VALUES(%d,'rename %s %s',now(),1)", 
			x->sid, rename_from, g2u(parameter));
		update_mysql(x, buf);
	}
	else if ((strcmp(command, "XMKD") == 0 || strcmp(command, "MKD") == 0) && rc == 257)//directory created
	{
		snprintf(buf, sizeof(buf),
			"INSERT INTO ftpcomm(sid,comm,at,run) VALUES(%d,'mkdir %s',now(),1)",
			x->sid, g2u(parameter));
		update_mysql(x, buf);
	}
	else if ((strcmp(command, "XRMD") == 0 || strcmp(command, "RMD") == 0) && rc == 250)//RMD command successful
	{
		snprintf(buf, sizeof(buf),
			"INSERT INTO ftpcomm(sid,comm,at,run) VALUES(%d,'rmdir %s',now(),1)",
			x->sid, g2u(parameter));
		update_mysql(x, buf);
	}
	else if (strcmp(command, "DELE") == 0 && rc == 250)
	{
		snprintf(buf, sizeof(buf),
		    "INSERT INTO ftpcomm(sid,comm,at,run) VALUES(%d,'delete %s',now(),1)",
			x->sid, g2u(parameter));
		update_mysql(x, buf);
	}
	/* Get */
	else if (strcmp(command, "RETR") == 0)
	{
		if (bytes > x->config->backup_size * 1024 * 1024)
		{
			snprintf(buf, sizeof(buf),
				"INSERT INTO ftpcomm(sid,comm,at,run,backupflag,backupsize) VALUES(%d,'get %s',now(),1,0,%d)",
				x->sid, g2u(parameter), bytes);
		}
		else
		{
			snprintf(buf, sizeof(buf),
				"INSERT INTO ftpcomm(sid,comm,at,filename,run,backupflag,backupsize) VALUES(%d,'get %s',now(),'%s',1,1,%ld)",
				x->sid, g2u(parameter), x->backup_fn, bytes);
		}
		update_mysql(x, buf);
	}
	else if (strcmp(command, "STOR") == 0)
	{
		if (bytes > x->config->backup_size * 1024 * 1024)
		{
			snprintf(buf, sizeof(buf),
				"INSERT INTO ftpcomm(sid,comm,at,run,backupflag,backupsize) VALUES(%d,'put %s',now(),1,0,%d)",
				x->sid, g2u(parameter), bytes);
		}
		else
		{
			snprintf(buf, sizeof(buf),
				"INSERT INTO ftpcomm(sid,comm,at,filename,run,backupflag,backupsize) VALUES(%d,'put %s',now(),'%s',1,1,%ld)",
				x->sid, g2u(parameter), x->backup_fn, bytes);
		}
		update_mysql(x, buf);
	}
	return 0;
}



