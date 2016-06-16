#include "/opt/freesvr/sql/include/mysql/mysql.h"
#include <sys/stat.h>
#include <fcntl.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include <termios.h>
#include <unistd.h>
#define _XOPEN_SOURCE
#include <stdlib.h>
#define monitor_path "/opt/freesvr/audit/log/monitor_shell_%d"
#include <string.h>
#include <pcre.h>
#include "rsyslog.h"

static int string_length=100000;

struct black_cmd
{
    int level;
    char cmd[50];
};

MYSQL my_connection;
MYSQL_RES *res_ptr;
MYSQL_ROW sqlrow;

extern char mysql_address[64];
extern char mysql_username[64];
extern char mysql_password[64];
extern char mysql_database[64];
extern int did;
char wincmd[16][16];
char wincmd_ant[16][16];
char pass_prompt[16][16];

int wincmd_count=0;
int pass_prompt_count=0;

volatile int block_command_flag = 0;
volatile int block_session_id = 0;


void freesvr_alarm(char * my_alarm_content,int level, char * syslogserver,char * syslogfacility,char * mailserver,char * mailaccount,char * mailpassword,char adminmailaccount[10][128],int syslogalarm,int mailalarm,int adminmailaccount_num)
{
//    pid_t alarm_pid;

    if(syslogalarm>0)
    {
//        alarm_pid=fork();
//        if(alarm_pid==0)
        {
            if(level==0)
            {
                rsyslog(syslogserver,514,syslogfacility,"info",my_alarm_content);
            }
            else if(level==1)
            {
                rsyslog(syslogserver,514,syslogfacility,"emerg",my_alarm_content);
            }
            else if(level==2)
            {
                rsyslog(syslogserver,514,syslogfacility,"alert",my_alarm_content);
            }
//            exit(0);
        }
    }

    if(level>0 && mailalarm>0)
    {
//        alarm_pid=fork();
//        if(alarm_pid==0)
        {

            for(int i=0;i<adminmailaccount_num;i++)
            {
				printf("adminmailaccount=%s\nmailserver=%s\nmailaccount=%s\nmailpassword=%s\nmy_alarm_content=%s\n",adminmailaccount[i],mailserver,mailaccount,mailpassword,my_alarm_content);
                int ret=lib_send_mail(adminmailaccount[i],mailserver,mailaccount,mailpassword
,"freesvr dangerous command alarm mail",my_alarm_content,0);
    	        printf("\nemail ret=%d\n",ret);
            }

//           exit(0);
        }
    }
}


void deal_special_char(char * sql)
{
	int length=strlen(sql);
	int i = 0;
	while(i<length+1)
	{
		if(sql[i]=='\\' || sql[i]=='\'' || sql[i]=='(' || sql[i]==')')
		{
			for(int j=length;j>i-1;j--)
			{
				sql[j+1]=sql[j];
			}
			length++;
			sql[i]='\\';
			i++;
		}
		i++;
	}
	printf("deal_sql=%s\n",sql);
}

void termfunc(char * string,char * ret1,char * ret2, int chomp)
{       
    char *p=string;
	if(chomp==1 && (*(p+strlen(p)-1)=='\r' || *(p+strlen(p)-1)=='\n'))
	{
    	*(p+strlen(p)-1)=0;
	}
    int i=0;


    while(i<strlen(p))
    {
        if(p[i]==0x0f)
        {
//			printf("here1\n");
            i+=1;
            continue;
        }
        if((i+2)<strlen(p) && p[i+2]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='m')
        {
//			printf("here2\n");
            i+=3;
            continue;
        }
        if((i+3)<strlen(p) && p[i+3]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]=='m')
        {
//			printf("here3\n");
            i+=4;
            continue;
        }
        if((i+4)<strlen(p) && p[i+4]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]<('9'+1) && p[i+3]>('0'-1) && p[i+4]=='m')
        {
//			printf("here4\n");
            i+=5;
            continue;
        }
        if((i+5)<strlen(p) && p[i+5]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]==';' && p[i+4]<('9'+1) && p[i+4]>('0'-1) && (p[i+5]=='H' || p[i+5]=='m'))
        {
//			printf("here5\n");
            i+=6;
            continue;
        }
        if((i+6)<strlen(p) && p[i+6]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]==';' && p[i+4]<('9'+1) && p[i+4]>('0'-1) && p[i+5]<('9'+1) && p[i+5]>('0'-1) && (p[i+6]=='H' || p[i+6]=='m'))
        {
//			printf("here6\n");
            i+=7;
            continue;
        }
        if((i+6)<strlen(p) && p[i+6]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]<('9'+1) && p[i+3]>('0'-1) && p[i+4]==';' && p[i+5]<('9'+1) && p[i+5]>('0'-1) && (p[i+6]=='H' || p[i+6]=='m'))
        {
//			printf("here7\n");
            i+=7;
            continue;
        }
        if((i+7)<strlen(p) && p[i+7]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]<('9'+1) && p[i+3]>('0'-1) && p[i+4]==';' && p[i+5]<('9'+1) && p[i+5]>('0'-1) && p[i+6]<('9'+1) && p[i+6]>('0'-1) && (p[i+7]=='H' || p[i+7]=='m'))
        {
//			printf("here8\n");
            i+=8;
            continue;
        }
        if((i+6)<strlen(p) && p[i+6]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='0' && p[i+3]=='0' && p[i+4]==0x1b && p[i+5]=='[' && p[i+6]=='m')
        {
//			printf("here9\n");
            i+=7;
            continue;
        }
        if((i+4)<strlen(p) && p[i+4]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='4' && p[i+3]<('9'+1) && p[i+3]>('0'-1) && p[i+4]=='m')
        {
//			printf("here10\n");
            i+=5;
            continue;
        }
        if((i+10)<strlen(p) && p[i+10]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]<('9'+1) && p[i+2]>('0'-1) && p[i+3]<('9'+1) && p[i+3]>('0'-1) && p[i+4]==';' && p[i+5]<('9'+1) && p[i+5]>('0'-1) && p[i+6]=='H' && p[i+7]==0x1b && p[i+8]=='[' && p[i+9]<('9'+1) && p[i+9]>('0'-1) && p[i+10]=='K')
        {
			printf("here11\n");
            i+=11;
            continue;
        }
        if((i+21)<strlen(p) && p[i+21]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='7' && p[i+3]=='m' && p[i+4]=='S' && p[i+5]=='t'
                && p[i+6]=='a' && p[i+7]=='n' && p[i+8]=='d' && p[i+9]=='a' && p[i+10]=='r' && p[i+11]=='d'
                && p[i+12]==' ' && p[i+13]=='i' && p[i+14]=='n' && p[i+15]=='p' && p[i+16]=='u' && p[i+17]=='t'
                && p[i+18]==0x1b && p[i+19]=='[' && p[i+20]=='0' && p[i+21]=='m')
        {
			printf("here12\n");
            i+=22;
            continue;
        }


        if((i+7)<strlen(p) && p[i+7]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='0' && p[i+3]=='1' && p[i+4]==';' && p[i+7]=='m')
        {
			printf("here13\n");
            i+=8;
            continue;
        }
        if((i+4)<strlen(p) && p[i+4]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='0' && p[i+3]=='0' && p[i+4]=='m')
        {
			printf("here14\n");
            i+=5;
            continue;
        }
        if((i+2)<strlen(p) && p[i+2]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='m')
        {
			printf("here15\n");
            i+=3;
            continue;
        }
        if((i+1)<strlen(p) && p[i+1]!=0 && p[i]=='[' && p[i+1]=='m')
        {
			printf("here16\n");
            i+=2;
            continue;
        }

		if(i<strlen(p))
		{
	        strncat(ret2+strlen(ret2),p+i,1);
		}
        i++;
    }

    bzero(ret1,string_length);
    p=ret2;i=0;
    while(i<strlen(ret2))
    {
        if(p[i+2]!=0 && p[i]==0x1b && p[i+1]==0x5d && p[i+2]==0x30)
        {
            int j=1;
            while(i+j<strlen(ret2))
            {
                if(p[i+j]==0x07)
                {
                    i+=j;
                    break;
                }
                j++;
            }
        }
        strncat(ret1+strlen(ret1),ret2+i,1);
        i++;
    }

    bzero(ret2,string_length);
    if(ret1[0]==0x0d)
    {
        strcpy(ret2,ret1+1);
    }
    else
    {
        strcpy(ret2,ret1);
    }

    if(*(ret2+strlen(ret2)-1)==0x0d)
    {
        *(ret2+strlen(ret2)-1)=0;
    }

    i=strlen(ret2);
    bzero(ret1,string_length);
    p=ret2;


    while(i>0)
    {
        if(p[i+5]!=0 && p[i]==0x1b && p[i+1]==0x5b && p[i+2]==0x48 && p[i+3]==0x1b && p[i+4]==0x5b && p[i+5]==0x4a)
        {
            i+=6;
            break;
        }
        i--;
    }

    strcpy(ret1,ret2+i);

    bzero(ret2,string_length);
    p=ret1;
    i=0;

    while(i<strlen(ret1))
    {
        if(p[i]==0x07)
        {
            i++;
            continue;
        }
        strncpy(ret2+strlen(ret2),ret1+i,1);
        i++;
    }


    p=ret2;

	/*
    i=0;
    bzero(ret1,string_length);
    int H_count=0;
    int H_from=0;
    int H_to=0;
	int g_H_count=0;

	while(i<strlen(ret2))
	{
		while(i<strlen(ret2))
		{
			if(p[i]==8)
			{
				if(H_count==0)
				{
					H_from=i;
				}
				H_count++;
			}
			else
			{
				if(H_count>30 && (g_H_count==0 || H_count>g_H_count-2))
				{
					g_H_count=H_count;
					H_to=i+2;
					break;
				}
				H_count=0;
				H_to=0;
				H_from=0;
			}
			i++;
		}
		printf("H_from=%d,H_to=%d,H_count=%d\n",H_from,H_to,H_count);

		if(H_to!=0)
		{
			strncpy(ret1,ret2,H_from);
			char H_arr[H_count/2];
			for(int i=0;i<H_count/2;i++)
			{
				H_arr[i]=8;
			}
			strncpy(ret1+strlen(ret1),H_arr,H_count/2);
			strncpy(ret1+strlen(ret1),ret2+H_to,strlen(ret2)-H_to);

			bzero(ret2,string_length);
			strcpy(ret2,ret1);
			bzero(ret1,string_length);
			H_from=0;
			H_to=0;
			H_count=0;
		}
		else
		{
			strcpy(ret1,ret2);
		}
		i++;
	}
	*/


    bzero(ret1,string_length);
    strcpy(ret1,ret2);

    p=ret1;
    i=0;
    bzero(ret2,string_length);
//    int column=132;
    int ant=0;


    for(i=0;i<strlen(ret1);i++)
    {
//        if(ant==column)
        {
//            ant=0;
        }
        if(ant<0)
        {
            ant=0;
        }

        if(ret1[i]==0x0d)
        {
            if(ret1[i+1]==0x0d)
            {
                bzero(ret2,string_length);
                ant=0;
                i++;
                continue;
            }
            else if(ret1[i+1]==0x1b && ret1[i+2]=='[' &&  ret1[i+3]>('0'-1) && ret1[i+3]<('9'+1) && ret1[i+4]>('0'-1) && ret1[i+4]<('9'+1) && ret1[i+5]=='G')
            {
                bzero(ret2,string_length);
                ant=0;
                i+=5;
                continue;
            }
            else
            {
                ant=0;
                continue;
            }
        }

        if(ret1[i]==0x08)
        {
            ant--;
            continue;
        }

        if(ret1[i]==0x1b)
        {
            if(ret1[i+1]=='[' && ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]=='D')
            {
                int times = ret1[1+2]-'0';
                ant=ant-times;
//              ret2[ant]=0;
                i+=3;
                continue;
            }
            else if(ret1[i+1]=='[' &&  ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]>('0'-1) && ret1[i+3]<('9'+1) && ret1[i+4]=='D')
            {
                int times=(ret1[i+2]-'0') * 10 + (ret1[i+3]-'0');
                ant = ant-times;
                i+=4;
                continue;
            }
            else if(ret1[i+1]=='[' && ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]=='C')
            {
                int times = ret1[1+2]-'0';
                ant=ant+times;
//              ret2[ant]=0;
                i+=3;
                continue;
            }
            else if(ret1[i+1]=='[' &&  ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]>('0'-1) && ret1[i+3]<('9'+1) && ret1[i+4]=='C')
            {
                int times=(ret1[i+2]-'0') * 10 + (ret1[i+3]-'0');
                ant = ant+times;
                i+=4;
                continue;
            }
            else if(ret1[i+1]=='[' && ret1[i+2]=='K')
            {
                i+=2;
                int j=0;
                bzero(ret2+ant,string_length-ant);
                continue;
            }
            else if(ret1[i+1]=='[' && ret1[i+2]=='A')
            {
                i+=2;
                continue;
            }
            else if(ret1[i+1]=='[' &&  ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]>('0'-1) && ret1[i+3]<('9'+1) && ret1[i+4]=='P')
            {
                int times=(ret1[i+2]-'0') * 10 + (ret1[i+3]-'0');
                char * tmp_p = ret2+strlen(ret2)-times;
                int len=strlen(ret2);
                memmove(ret2+ant,ret2+ant+times,len-ant-times);
                bzero(tmp_p,times);
                i+=4;
                continue;
            }
            else if(ret1[i+1]=='[' &&  ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]=='P')
            {
                int times=ret1[i+2]-'0';
                char * tmp_p = ret2+strlen(ret2)-times;
                int len=strlen(ret2);
                memmove(ret2+ant,ret2+ant+times,len-ant-times);
                bzero(tmp_p,times);
                i+=3;
                continue;
            }
            else if(ret1[i+1]=='[' &&  ret1[i+2]>('0'-1) && ret1[i+2]<('9'+1) && ret1[i+3]=='@')
            {
                int len=strlen(ret2);
                memmove(ret2+ant,ret2+ant-1,len-ant+1);
                ret2[ant]=ret1[i+4];
                i+=4;
                ant++;
                //printf("ret2=%s\n",ret2);
                continue;
            }
            else if(ret1[i+1]=='[')
            {
                i+=2;
                continue;
            }
        }

        ret2[ant]=ret1[i];
        ant++;
    }
}

void to_get_a_prompt(char prompts[50][128],char * aprompt,int n,MYSQL * my_connection,char * sql_query)
{
    for(int i=49;i>0;i--)
    {
		if(strcmp(prompts[i],aprompt)==0)
		{
			return;
		}
    }

    if(n<128)
    {       
        for(int i=49;i>0;i--)
        {
            bzero(prompts[i],128);
            strncpy(prompts[i],prompts[i-1],128);
        }
            
        bzero(prompts[0],128);
        strncpy(prompts[0],aprompt,n);
        
        bzero(sql_query,string_length);
        sprintf(sql_query,"insert into device_prompts values (%d,'%s',now())",did,prompts[0]);
                
        int res = mysql_query(my_connection,sql_query);
        if (res)
        {   
//          printf("insert error: %s\n", mysql_error(&my_connection));
        }
    }
}


void check_invim(char * p,int * invim,char prompts[50][128],MYSQL * my_connection,char * sql_query)
{
    for(int i=0;i<wincmd_count;i++)
    {
        if(pcre_match(p,wincmd[i])==0)
        {
//          printf("invim,wincmd+ant=%s\n",wincmd_ant[i]);
            char * t = strstr(p,wincmd_ant[i]);
//          printf("t=%p,p=%p\n",t,p);
            int j = t-p;
//          printf("j=%d\n",j);
            int get_a_prompt=0;
            while(j>0)
            {
                if(p+j!=' ')
                {
                    get_a_prompt=1;
                    break;
                }
            }
            if(get_a_prompt==1)
            {
                to_get_a_prompt(prompts,p,t-p,my_connection,sql_query);
//              printf("myprompt=%s\n",myprompt);
            }

            (* invim)=2;
			printf("invim\n");
			for(int j=0;j<50;j++)
			{
				printf("prompt[%d]=%s\n\r",j,prompts[j]);
			}
            return;
        }
    }
}

void check_outvim(char * p,int n,char prompts[50][128],int * invim,int * justoutvim)
{
	/*
    int i = 0;
    while(i<n)
    {
        if(p[i+20]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='?' && p[i+3]=='2' && p[i+4]=='5' && p[i+5]=='h' && p[i+6]==0x1b && p[i+7]=='[' && p[i+9]==';' && p[i+10]=='1' && p[i+11]=='H' && p[i+12]==0x1b && p[i+13]=='[' && p[i+14]=='K'
 && p[i+15]==0x1b && p[i+16]=='[' && p[i+18]==';' && p[i+19]=='1' && p[i+20]=='H')
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim1\n\r");
            return;
        }   
        else if(p[i+18]!=0 && p[i]==0x0d && p[i+1]=='?' && p[i+2]==0x1b && p[i+3]=='[' && p[i+4]=='2' && p[i+5]=='5' && p[i+6]==';' && p[i+7]=='1' && p[i+8]=='H' && p[i+9]==0x1b && p[i+10]=='[' && p[i+11]=='K' && p[i+12]==0x1b && p[i+13]
=='[' && p[i+14]=='2' && p[i+15]=='5' && p[i+16]==';' && p[i+17]=='1' && p[i+18]=='H') 
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim2\n\r");
            return;
        }
        else if(p[i+5]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='?' && p[i+3]=='1' && p[i+4]=='l' && p[i+5]==0x1b)
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim3\n\r");
            return;
        }
        else if(p[i+6]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='?' && p[i+3]=='1' && p[i+4]=='0' && p[i+5]=='4' && p[i+6]=='9')
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim4\n\r");
            return;
        }
        else if(p[i+1]!=0 && p[i]==0x1b && p[i+1]=='>')
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim5\n\r");
            return;
        }
		else if(p[i+2]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='J')
		{
			(* invim)=0;
			(* justoutvim)=1;
			printf("\n\routvim5.1\n\r");
			return;
		}
//		else if(p[i+4]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='?' && p[i+3]=='1' && p[i+4]=='l')
		else if(p[i]=='[' && p[i+1]=='?' && p[i+2]=='1' && p[i+3]=='l')
		{
			(* invim)=0;
			(* justoutvim)=1;
			printf("\n\n\n\noutvim5.5\n\n\n\n");
			return;
		}
        i++;
    }
	*/

	for(int i=0;i<50;i++)
	{
		if(strlen(prompts[i])>0 && strstr(p,prompts[i])!=0)
		{
			(* invim)=0;
			(* justoutvim)=1;
			return;
		}
	}
	/*
    i = 0;
    while(i<n)
    {
        if(p[i+8]!=0 && p[i]=='[' && p[i+1]=='?' && p[i+2]=='7' && p[i+3]=='h' && p[i+4]=='>' && p[i+5]=='[' && p[i+6]=='?' && p[i+7]=='7' && p[i+8]=='h' && strstr(p,prompt)!=0)
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim7\n\r");
            return;
        }
        else if(p[i+6]!=0 && p[i]=='[' && p[i+1]=='?' && p[i+2]=='1' && p[i+3]=='0' && p[i+4]=='4' && p[i+5]=='9' && p[i+6]=='l' && strstr(p,prompt)!=0)
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim8\n\r");
            return;
        }
		else if(p[i+15]!=0 && p[i]==0x1b && p[i+1]=='[' && p[i+2]=='?' && p[i+3]=='1' && p[i+4]=='c' && p[i+5]==0x1b && p[i+6]=='[' && p[i+7]=='?' && p[i+8]=='2' && p[i+9]=='5' && p[i+10]=='h' && p[i+11]==0x1b && p[i+12]=='[' && p[i+13]=='?' && p[i+14]=='0' && p[i+15]=='c')
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim9\n\r");
            return;
        }
        else if(p[i+4]!=0 && p[i]=='[' && p[i+1]=='H' && p[i+2]=='[' && p[i+3]=='2' && p[i+4]=='J' && strstr(p,prompt)!=0)
        {
            (* invim)=0;
            (* justoutvim)=1;
            printf("\n\routvim10\n\r");
            return;
        }
        i++;
    }*/
}

int get_pcre(char * name,struct black_cmd black_cmd_list[],int * black_cmd_num,MYSQL * my_connection,MYSQL_RES * my_res_ptr,MYSQL_ROW my_sqlrow,int * black_or_white, char * sql_query)
{
	printf("\n\rblack = %s\n\r",name);
    int res;
	bzero(sql_query,string_length);
    sprintf(sql_query,"select cmd,level from forbidden_commands_groups where gid = '%s'",name);
	printf("\n\n\n\n\nsql_query=%s\n\n\n\n\n\n\n",sql_query);
//	mysql_init(my_connection);
    if (mysql_real_connect(my_connection,mysql_address,mysql_username,mysql_password,mysql_database,3306,NULL,0))
    {
        //printf("Connection DB success\n");
        res = mysql_query(my_connection,sql_query);
    if (res)
    {
        //printf("SELECT error: %s\n", mysql_error(my_connection));
    }
    else
    {
        my_res_ptr = mysql_store_result(my_connection);
        if (my_res_ptr)
        {
            if((unsigned long)mysql_num_rows(my_res_ptr)==0)
            {
                //printf("USER not in config error\n");
                mysql_free_result(my_res_ptr);
//              mysql_close(my_connection);
                return 1;
            }
            while ((my_sqlrow = mysql_fetch_row(my_res_ptr)))
            {
				printf("black_cmd=%s,level=%s\n",my_sqlrow[0],my_sqlrow[1]);
				printf("\n1\n");
                strcpy(black_cmd_list[* black_cmd_num].cmd,my_sqlrow[0]);
				printf("\n2\n");
                black_cmd_list[* black_cmd_num].level=atoi(my_sqlrow[1]);
				printf("\n3\n");
                (* black_cmd_num)++;
				printf("\n4\n");
            }
            if (mysql_errno(my_connection))
            {
                fprintf(stderr, "Retrive error: s\n",mysql_error(my_connection));
            }
        }
        mysql_free_result(my_res_ptr);
    }
//  mysql_close(my_connection);
    }

	bzero(sql_query,string_length);
	sprintf(sql_query,"select black_or_white from forbidden_groups where gname='%s'",name);
	printf("\n\n\n\nsql_query = %s\n\n\n",sql_query);
    res = mysql_query(my_connection,sql_query);
    if(res)
    {
    }
    else
    {   
        my_res_ptr = mysql_store_result(my_connection);
        if (my_res_ptr)
        {   
            if((unsigned long)mysql_num_rows(my_res_ptr)==0)
            {   
                //printf("USER not in config error\n");
                mysql_free_result(my_res_ptr);
                return 1;
            }   
            while ((my_sqlrow = mysql_fetch_row(my_res_ptr)))
            {   
                * black_or_white=atoi(my_sqlrow[0]);
				printf("\n\n\n\nblack_or_white=%d\n\n\n\n",* black_or_white);
            }   
            if (mysql_errno(my_connection))
            {   
                fprintf(stderr, "Retrive error: s\n",mysql_error(my_connection));
            }
        }   
        mysql_free_result(my_res_ptr);
    }
}

int pcre_match (char *src, char *pattern)
{
    pcre *re;

    const char *error;

    int erroffset;

    int rc;

    re = pcre_compile (pattern,       /* the pattern */
               0,       /* default options */
               &error,       /* for error message */
               &erroffset, /* for error offset */
               NULL);       /* use default character tables */

/* Compilation failed: print the error message and exit */
    if (re == NULL)
    {
    printf ("PCRE compilation failed at offset %d: %s\n", erroffset,
        error);
    return -1;
    }

    rc = pcre_exec (re,        /* the compiled pattern */
            NULL, /* no extra data - we didn't study the pattern */
            src, /* the src string */
            strlen (src), /* the length of the src */
            0,        /* start at offset 0 in the src */
            0,        /* default options */
            NULL, 0);

/* If Matching failed: */
    if (rc < 0)
    {
    free (re);
    return -1;
    }

    free (re);
    return rc;
}



void telnet_writelogfile(char * buff,int n,char * monitor_shell_pipe_name,
                        int fd1,int fd2,char * inputcommandline,char * commandline,char * cache1,char * cache2,
						char * linebuffer,char * cmd,char * sql_query, char prompts[50][128],
                        struct black_cmd black_cmd_list[],int black_cmd_num,int sid,int * waitforline, int * g_bytes, int * invim,int * justoutvim, int session_id,int black_or_white, MYSQL * my_connection,char * syslogserver,char * syslogfacility,char * mailserver,char * mailaccount,char * mailpassword,char adminmailaccount[10][128],char * alarm_content,int syslogalarm,int mailalarm,int adminmailaccount_num,char * radius_username,char * sstr,char * user,int encode,int * get_first_prompt)
{
    (* g_bytes)+=n; 
    int monitor_fd;
	//printf("monitor_shell_pipe_name=%s\n",monitor_shell_pipe_name);
    if(access(monitor_shell_pipe_name,W_OK)==0)
    {   
        monitor_fd=open(monitor_shell_pipe_name,O_WRONLY);
        if(monitor_fd<0)
        {
            perror("monitor fd open fail\n");
        }
        else
        {
            write(monitor_fd,buff,n);
        }
    }   

	int alarm_length=74;
    struct timeval tv;
	struct timezone tz;
    gettimeofday (&tv , &tz);
    write(fd2,&tv,sizeof(tv));
    //printf("\n\rsec=%d,usec=%d\n\r",tv.tv_sec,tv.tv_usec);
    write(fd2,&n,sizeof(n));
    write(fd2,buff,n);
    int i=0;
    
	//printf("\ninvim==%d\n",(* invim));

	char * p=buff;

    if((* invim)==1)
    {      
        bzero(commandline,string_length);
        bzero(inputcommandline,string_length);
        bzero(linebuffer,string_length);     
        check_outvim(buff,n,prompts,invim,justoutvim);
        return; 
    }           
    else if((* invim)==2)
    {     
        bzero(cache1,string_length);
        bzero(cache2,string_length);
        termfunc(linebuffer,cache1,cache2,1);

        write(fd1,cache2,strlen(cache2));
        write(fd1,"\n",1);
		char * t = strlen(cmd)>0 ? strstr(cache2,cmd) : 0;
		printf("invim==2\n");
		printf("cmd=%s\n",cmd);
		printf("cache2=%s\n",cache2);
        if((* justoutvim)==0 && t!=0 && t!=cache2 && (t-cache2)<128)
        {
			printf("get_a_prompt here\n");
			to_get_a_prompt(prompts,cache2,t-cache2,my_connection,sql_query);
            if((*get_first_prompt)>0)
            {
                bzero(sql_query,string_length);
                sprintf(sql_query,"update devices set first_prompt='%s' where id=%d",prompts[0],did);
                printf("sql_query1=%s\n",sql_query);
                mysql_query(my_connection,sql_query);
                (*get_first_prompt)=0;
            }
		//	printf("p=%p,cache2=%p,myprompt=#%s#,p-cache2=%d\n",p,cache2,myprompt,p-cache2);
			bzero(cache2,string_length); //lwm
        //    printf("cmd=%s\n,myprompt=%s\n",cmd,myprompt);
        }
        (* invim)--;
        return; 
    }
    

    while(i<n)  
    {           
        if(p[i]=='\n')
        {   
			bzero(cache1,string_length);
            bzero(cache2,string_length);
            termfunc(linebuffer,cache1,cache2,1);
                            
            write(fd1,cache2,strlen(cache2));
            write(fd1,"\n",1);
			char * t = strlen(cmd)>0 ? strstr(cache2,cmd) : 0;
			
			if((* justoutvim)==0 && t!=0 && t!=cache2 && (t-cache2)<128)
			{   
				to_get_a_prompt(prompts,cache2,t-cache2,my_connection,sql_query);
				if((*get_first_prompt>0))
				{
					bzero(sql_query,string_length);
					sprintf(sql_query,"update devices set first_prompt='%s' where id=%d",prompts[0],did);
					printf("sql_query2=%s\n",sql_query);
					mysql_query(my_connection,sql_query);
					(*get_first_prompt)=0;
				}
		//		printf("p=%p,cache2=%p,myprompt=#%s#,p-cache2=%d\n",p,cache2,myprompt,p-cache2);
				bzero(cache2,string_length);//lwm
				bzero(cmd,string_length);
            }               
            else if((* justoutvim)==1)
            {               
                (* justoutvim)=0;
            }
            bzero(linebuffer,string_length);
        }       
        else
        {       
            //printf("\n\rstrlen(linebuffer)=%d\n\r",strlen(linebuffer));
            strncpy(linebuffer+strlen(linebuffer),p+i,1);
            if(strlen(linebuffer)>(string_length-5000))
            {
                bzero(cache1,string_length);
                bzero(cache2,string_length);
                termfunc(linebuffer,cache1,cache2,1);
             	write(fd1,cache2,strlen(cache2));
             	write(fd1,"\n",1);
                bzero(linebuffer,string_length);
            }
        }
        i++;
    }


    i=0;
    p=buff;

    while(i<n)
    {
        memcpy(commandline+strlen(commandline),p+i,1);

        if(strlen(commandline)>(string_length-5000))
        {
            bzero(commandline,string_length);
            bzero(inputcommandline,string_length);
            return;
        }

        if(p[i]=='\n')
        {
            if((* waitforline)==0)
            {
                bzero(commandline,string_length);
            }
            else
            {
				printf("\n\nwaitforline\n\n");
                bzero(cache1,string_length);
                bzero(cache2,string_length);
                termfunc(commandline,cache1,cache2,1);

				if(strlen(cache2)>0)
				{
					sprintf(cmd,"%s",cache2);
					check_invim(cmd,invim,prompts,my_connection,sql_query);

                    int level=black_or_white;

                    for(int j=0;j<black_cmd_num;j++)
                    {
                        if(black_or_white==0)
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = black_cmd_list[j].level + 1;
                                break;
                            }
                        }
                        else
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = 0;
                                break;
                            }
                        }
                    }

                    for(int i=0;i<pass_prompt_count;i++)
                    {
                        if(pcre_match(commandline,pass_prompt[i])==0)
                        {
                            bzero(inputcommandline,string_length);
                            bzero(commandline,string_length);
                            return;
                        }
                    }

                    if((*get_first_prompt)>0)
                    {
                        (*get_first_prompt)--;
                    }

					bzero(sql_query,string_length);

                    if(encode==1)
                    {
                        bzero(cache1,string_length);
                        myg2u(cache2,strlen(cache2),cache1,string_length);
                        deal_special_char(cache1);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                    }
                    else
                    {
                        deal_special_char(cache2);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache2,level);
                    }

					printf("\n\nsql1=%s\n\nencode=%d\n",sql_query,encode);
					mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
					mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
					mysql_query(my_connection,sql_query);

                    bzero(alarm_content,string_length);
                    sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,cache2,sstr,user,sid);
                    freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

					if(level==1)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						block_command_flag = 1;
						block_session_id = session_id;
					}
					else if(level==2)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						cleanup_exit( 255 );
					}
				}

                bzero(inputcommandline,string_length);
                bzero(commandline,string_length);
                (* waitforline)=0;
            }
        }
        i++;
    }
}

void telnet_writelogfile2(char * buff,int n,char * monitor_shell_pipe_name,
                        int fd1, int fd2, char * inputcommandline,char * commandline,char * cache1,char * cache2,char * linebuffer,char * cmd,char * sql_query,char prompts[50][128],
                        struct black_cmd black_cmd_list[], int black_cmd_num,int sid,int * waitforline,int * g_bytes,int * invim,
						int session_id, int black_or_white, MYSQL * my_connection,char * syslogserver,char * syslogfacility,char * mailserver,char * mailaccount,char * mailpassword,char adminmailaccount[10][128],char * alarm_content,int syslogalarm,int mailalarm,int adminmailaccount_num,char * radius_username,char * sstr,char * user,int encode,int * get_first_prompt)
{
    if((* invim)!=0)
    {
        return;
    }
	int alarm_length=74;
    struct timeval tv;
    struct timezone tz;

    (* g_bytes)+=n;
    (* waitforline)=0;
    char * p=buff;
    int i=0;
    int j=0;
    while(i<n)
    {
        if(p[i]=='')
        {
            bzero(commandline,string_length);
            bzero(inputcommandline,string_length);
        }
        i++;
    }
    i=0;
    int inputok=1;
    int selfhandle_mode=0;
    char * t=inputcommandline;
    while(i<n)
    {
        if(p[i]=='\n' || p[i]=='\r')
        {
            selfhandle_mode=1;
            break;
        }
        i++;
    }
    i=0;
    p=buff;
    while(i<strlen(inputcommandline))
    {
        if(((int)t[i]>126 || (int)t[i]<33 || t[i]=='q' || t[i]==9) && t[i]!=' ' && t[i]!="\n" && t[i]!="\r") // 9 is tab
        {
            inputok=0;
            break;
        }
        else
        {
            inputok=1;
        }
        i++;
    }
    i=0;
    p=buff;
    if(p[0]=='\r' || p[0]=='\n' && selfhandle_mode==0 )
    {
        if(inputok==1)
        {
            if((* invim)==0)
            {
                bzero(cache1,string_length);
                bzero(cache2,string_length);
                termfunc(commandline,cache1,cache2,1);


				if(strlen(inputcommandline)>0)
				{
					sprintf(cmd,"%s",inputcommandline);
					check_invim(cmd,invim,prompts,my_connection,sql_query);

                    int level=black_or_white;

                    for(int j=0;j<black_cmd_num;j++)
                    {
                        if(black_or_white==0)
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = black_cmd_list[j].level + 1;
                                break;
                            }
                        }
                        else
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = 0;
                                break;
                            }
                        }
                    }

                    for(int i=0;i<pass_prompt_count;i++)
                    {
                        if(pcre_match(commandline,pass_prompt[i])==0)
                        {
                            bzero(inputcommandline,string_length);
                            bzero(commandline,string_length);
                            return;
                        }
                    }

					bzero(sql_query,string_length);

                    if((*get_first_prompt)>0)
                    {
                        (*get_first_prompt)--;
                    }

                    if(encode==1)
                    {
                        bzero(cache1,string_length);
                        myg2u(inputcommandline,strlen(inputcommandline),cache1,string_length);
                        deal_special_char(cache1);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                    }
                    else
                    {
                        deal_special_char(inputcommandline);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,inputcommandline,level);
                    }
					printf("\n\nsql2=%s\n\nencode=%d\n",sql_query,encode);
					mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
					mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
					mysql_query(my_connection,sql_query);

					bzero(alarm_content,string_length);
					sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,inputcommandline,sstr,user,sid);
					printf("3\n");
					freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);
					if(level==1)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						block_command_flag = 1;
						block_session_id = session_id;
					}
					else if(level==2)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						cleanup_exit( 255 );
					}
					printf("4\n");
				}
				else
				{
                    if(strlen(linebuffer)>0 && strlen(linebuffer)<128)
                    {
						to_get_a_prompt(prompts,linebuffer,strlen(linebuffer),my_connection,sql_query);
						if((*get_first_prompt)>0)
						{
							bzero(sql_query,string_length);
							sprintf(sql_query,"update devices set first_prompt='%s' where id=%d",prompts[0],did);
			                printf("sql_query1=%s\n",sql_query);
							mysql_query(my_connection,sql_query);
							(*get_first_prompt)=0;
						}
                    }
				}
            }
        bzero(inputcommandline,string_length);
        bzero(commandline,string_length);
        return;
        }
        if((* invim)==0)
        {
            if((char)(commandline+strlen(commandline)=='\n'))
            {
                bzero(cache1,string_length);
                bzero(cache2,string_length);
                termfunc(commandline,cache1,cache2,1);

				if(strlen(cache2)>0)
				{
					sprintf(cmd,"%s",cache2);
					check_invim(cmd,invim,prompts,my_connection,sql_query);

                    int level=black_or_white;

                    for(int j=0;j<black_cmd_num;j++)
                    {
                        if(black_or_white==0)
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = black_cmd_list[j].level + 1;
                                break;
                            }
                        }
                        else
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = 0;
                                break;
                            }
                        }
                    }

                    for(int i=0;i<pass_prompt_count;i++)
                    {
                        if(pcre_match(commandline,pass_prompt[i])==0)
                        {
                            bzero(inputcommandline,string_length);
                            bzero(commandline,string_length);
                            return;
                        }
                    }

					bzero(sql_query,string_length);

                    if((*get_first_prompt)>0)
                    {
                        (*get_first_prompt)--;
                    }

                    if(encode==1)
                    {
                        bzero(cache1,string_length);
                        myg2u(cache2,strlen(cache2),cache1,string_length);
                        deal_special_char(cache1);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                    }
                    else
                    {
                        deal_special_char(cache2);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache2,level);
                    }
					printf("\n\nsql3=%s\n\nencode=%d\n",sql_query,encode);
					mysql_query(my_connection,sql_query);


					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
					mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
					mysql_query(my_connection,sql_query);

					bzero(alarm_content,string_length);
					sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,cache2,sstr,user,sid);
					freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

					if(level==1)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						block_command_flag = 1;
						block_session_id = session_id;
					}
					else if(level==2)
					{
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

						cleanup_exit( 255 );
					}
				}

                bzero(inputcommandline,string_length);
                bzero(commandline,string_length);
            }
            else
            {
                (* waitforline)=1;
				bzero(cache1,string_length);
				bzero(cache2,string_length);
				termfunc(commandline,cache1,cache2,0);

                if(strlen(cache2)>0)
                {
					printf("\n\ncache2=%s\n\n",cache2);
                    sprintf(cmd,"%s",cache2);
                    check_invim(cmd,invim,prompts,my_connection,sql_query);

                    int level=black_or_white;

                    for(int j=0;j<black_cmd_num;j++)
                    {
                        if(black_or_white==0)
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = black_cmd_list[j].level + 1;
                                break;
                            }
                        }
                        else
                        {
                            if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
                            {
                                level = 0;
                                break;
                            }
                        }
                    }

                    for(int i=0;i<pass_prompt_count;i++)
                    {
                        if(pcre_match(commandline,pass_prompt[i])==0)
                        {
                            bzero(inputcommandline,string_length);
                            bzero(commandline,string_length);
                            return;
                        }
                    }

					(* waitforline)=0; 
                    bzero(sql_query,string_length);

                    if((*get_first_prompt)>0)
                    {
                        (*get_first_prompt)--;
                    }

                    if(encode==1)
                    {
                        bzero(cache1,string_length);
                        myg2u(cache2,strlen(cache2),cache1,string_length);
                        deal_special_char(cache1);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                    }
                    else
                    {
                        deal_special_char(cache2);
                        sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache2,level);
                    }
					printf("\n\nsql4=%s\n\nencode=%d\n",sql_query,encode);
                    mysql_query(my_connection,sql_query);

                    bzero(sql_query,string_length);
                    sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
                    mysql_query(my_connection,sql_query);

					bzero(sql_query,string_length);
					sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
					mysql_query(my_connection,sql_query);

					bzero(alarm_content,string_length);
					sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,cache2,sstr,user,sid);
					freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

                    if(level==1)
                    {
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

                        block_command_flag = 1;
                        block_session_id = session_id;
                    }
                    else if(level==2)
                    {
						write(fd1,"\n**************************",27);
						write(fd1,"\nforbidden command!\n",20);
						write(fd1,"**************************\n",27);

						gettimeofday (&tv , &tz);
						write(fd2,&tv,sizeof(tv));
						write(fd2,&alarm_length,sizeof(alarm_length));

						write(fd2,"\n**************************",27);
						write(fd2,"\nforbidden command!\n",20);
						write(fd2,"**************************\n",27);

                        cleanup_exit( 255 );
                    }
                }

                bzero(inputcommandline,string_length);
                bzero(commandline,string_length);
            }
        }
        bzero(inputcommandline,string_length);
        return;
    }

    if(selfhandle_mode==0)
    {
    }
    if(selfhandle_mode)
    {
        int count=0;
        i=0;
        while(i<n)
        {
            if((p[i]=='\n' || p[i]=='\r') && count==0 && inputok==0)
            {
                if((* invim)==0)
                {
                    if((char)(commandline+strlen(commandline)=='\n'))
                    {
                        bzero(cache1,string_length);
                        bzero(cache2,string_length);
                        termfunc(commandline,cache1,cache2,1);

						if(strlen(cache2)>0)
						{
							sprintf(cmd,"%s",cache2);
							check_invim(cmd,invim,prompts,my_connection,sql_query);

							int level=black_or_white;

							for(int j=0;j<black_cmd_num;j++)
							{
								if(black_or_white==0)
								{
									if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
									{
										level = black_cmd_list[j].level + 1;
										break;
									}
								}
								else
								{
									if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
									{
										level = 0;
										break;
									}
								}
							}

							for(int i=0;i<pass_prompt_count;i++)
							{
								if(pcre_match(commandline,pass_prompt[i])==0)
								{
									bzero(inputcommandline,string_length);
									bzero(commandline,string_length);
									return;
								}
							}

							bzero(sql_query,string_length);

							if((*get_first_prompt)>0)
							{
								(*get_first_prompt)--;
							}

                            if(encode==1)
                            {
                                bzero(cache1,string_length);
                                myg2u(cache2,strlen(cache2),cache1,string_length);
                                deal_special_char(cache1);
                                sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                            }
                            else
                            {
                                deal_special_char(cache2);
                                sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache2,level);
                            }
							printf("\n\nsql5=%s\n\nencode=%d\n",sql_query,encode);

							mysql_query(my_connection,sql_query);


							bzero(sql_query,string_length);
							sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
							mysql_query(my_connection,sql_query);

							bzero(sql_query,string_length);
							sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
							mysql_query(my_connection,sql_query);

							bzero(alarm_content,string_length);
							sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,cache2,sstr,user,sid);
							freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

							if(level==1)
							{
								write(fd1,"\n**************************",27);
								write(fd1,"\nforbidden command!\n",20);
								write(fd1,"**************************\n",27);

								gettimeofday (&tv , &tz);
								write(fd2,&tv,sizeof(tv));
								write(fd2,&alarm_length,sizeof(alarm_length));

								write(fd2,"\n**************************",27);
								write(fd2,"\nforbidden command!\n",20);
								write(fd2,"**************************\n",27);

								block_command_flag = 1;
								block_session_id = session_id;
							}
							else if(level==2)
							{
								write(fd1,"\n**************************",27);
								write(fd1,"\nforbidden command!\n",20);
								write(fd1,"**************************\n",27);

								gettimeofday (&tv , &tz);
								write(fd2,&tv,sizeof(tv));
								write(fd2,&alarm_length,sizeof(alarm_length));

								write(fd2,"\n**************************",27);
								write(fd2,"\nforbidden command!\n",20);
								write(fd2,"**************************\n",27);

								cleanup_exit( 255 );
							}
						}
                        bzero(inputcommandline,string_length);
                        bzero(commandline,string_length);
                    }
                    else
                    {
                        (* waitforline)=1;
						bzero(cache1,string_length);
						bzero(cache2,string_length);
						termfunc(commandline,cache1,cache2,0);

						if(strlen(cache2)>0)
						{   
							printf("\n\ncache2=%s\n\n",cache2);
							sprintf(cmd,"%s",cache2);
							check_invim(cmd,invim,prompts,my_connection,sql_query);
							
				
							int level=black_or_white;

							for(int j=0;j<black_cmd_num;j++)
							{
								if(black_or_white==0)
								{
									if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
									{
										level = black_cmd_list[j].level + 1;
										break;
									}
								}
								else
								{
									if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
									{
										level = 0;
										break;
									}
								}
							}


							for(int i=0;i<pass_prompt_count;i++)
							{
								if(pcre_match(commandline,pass_prompt[i])==0)
								{
									bzero(inputcommandline,string_length);
									bzero(commandline,string_length);
									return;
								}
							}

                            bzero(sql_query,string_length);

							if((*get_first_prompt)>0)
							{
								(*get_first_prompt)--;
							}

                            if(encode==1)
                            {
                                bzero(cache1,string_length);
                                myg2u(cache2,strlen(cache2),cache1,string_length);
                                deal_special_char(cache1);
                                sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                            }
                            else
                            {
                                deal_special_char(cache2);
                                sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache2,level);
                            }
							printf("\n\nsql6=%s\n\nencode=%d\n",sql_query,encode);

                            mysql_query(my_connection,sql_query);
                                    
                                    
                            bzero(sql_query,string_length);
                            sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
                            mysql_query(my_connection,sql_query);

							bzero(sql_query,string_length);
							sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
							mysql_query(my_connection,sql_query);

							bzero(alarm_content,string_length);
							sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,cache2,sstr,user,sid);
							freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);
                                
                            if(level==1)
                            {   
                                block_command_flag = 1;
                                block_session_id = session_id;
                                bzero(inputcommandline,string_length); 
                                bzero(commandline,string_length); 
                                return; 
                            }           
                            else if(level==2)
                            {       
                                cleanup_exit( 255 );
                            }
						}
                    }
                }
                count=1;
                i++;
                continue;
            }
            else if((p[i]=='\n' || p[i]=='\r') && count==0 && inputok==1)
            {
                if((* invim)==0)
                {
					if(strlen(inputcommandline)>0)
					{
						sprintf(cmd,"%s",inputcommandline);
						check_invim(cmd,invim,prompts,my_connection,sql_query);

						int level=black_or_white;

						
						for(int j=0;j<black_cmd_num;j++)
						{
							if(black_or_white==0)
							{
								if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
								{
									level = black_cmd_list[j].level + 1;
									break;
								}
							}
							else
							{
								if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
								{
									level = 0;
									break;
								}
							}
						}

						for(int i=0;i<pass_prompt_count;i++)
						{
							if(pcre_match(commandline,pass_prompt[i])==0)
							{
								bzero(inputcommandline,string_length);
								bzero(commandline,string_length);
								return;
							}
						}

						bzero(sql_query,string_length);

						if((*get_first_prompt)>0)
						{
							(*get_first_prompt)--;
						}

                        if(encode==1)
                        {
                            bzero(cache1,string_length);
                            myg2u(inputcommandline,strlen(inputcommandline),cache1,string_length);
                            deal_special_char(cache1);
                            sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                        }
                        else
                        {
                            deal_special_char(inputcommandline);
                            sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,inputcommandline,level);
                        }
						printf("\n\nsql7=%s\n\nencode=%d\n",sql_query,encode);

						mysql_query(my_connection,sql_query);


						bzero(sql_query,string_length);
						sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
						mysql_query(my_connection,sql_query);

						bzero(sql_query,string_length);
						sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
						mysql_query(my_connection,sql_query);

						bzero(alarm_content,string_length);
						sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,inputcommandline,sstr,user,sid);
						freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

						if(level==1)
						{
							block_command_flag = 1;
							block_session_id = session_id;
						}
						else if(level==2)
						{
							cleanup_exit( 255 );
						}
					}
					else
					{
						if(strlen(linebuffer)>0 && strlen(linebuffer)<128)
						{
							to_get_a_prompt(prompts,linebuffer,strlen(linebuffer),my_connection,sql_query);
							if((*get_first_prompt)>0)
							{
								bzero(sql_query,string_length);
								sprintf(sql_query,"update devices set first_prompt='%s' where id=%d",prompts[0],did);
								printf("sql_query1=%s\n",sql_query);
								mysql_query(my_connection,sql_query);
								(*get_first_prompt)=0;
							}
						}
					}
                }
                bzero(inputcommandline,string_length);
                bzero(commandline,string_length);
                i++;
                continue;
            }
            else if((p[i]=='\n' || p[i]=='\r') && count==1)
            {
                if((* invim)==0)
                {
					if(strlen(inputcommandline))
					{
						sprintf(cmd,"%s",inputcommandline);
						check_invim(cmd,invim,prompts,my_connection,sql_query);

						int level=black_or_white;

						for(int j=0;j<black_cmd_num;j++)
						{
							if(black_or_white==0)
							{
								if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
								{
									level = black_cmd_list[j].level + 1;
									break;
								}
							}
							else
							{
								if(pcre_match(cmd,black_cmd_list[j].cmd)==0)
								{
									level = 0;
									break;
								}
							}
						}

						for(int i=0;i<pass_prompt_count;i++)
						{
							if(pcre_match(commandline,pass_prompt[i])==0)
							{
								bzero(inputcommandline,string_length);
								bzero(commandline,string_length);
								return;
							}
						}

						bzero(sql_query,string_length);

						if((*get_first_prompt)>0)
						{
							(*get_first_prompt)--;
						}

                        if(encode==1)
                        {
                            bzero(cache1,string_length);
                            myg2u(inputcommandline,strlen(inputcommandline),cache1,string_length);
                            deal_special_char(cache1);
                            sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,cache1,level);
                        }
                        else
                        {
                            deal_special_char(inputcommandline);
                            sprintf(sql_query,"insert into commands (cid,sid,at,cmd,dangerlevel,jump_session) values  (NULL,%d,now(),'%s',%d,0)",sid,inputcommandline,level);
                        }
						printf("\n\nsql8=%s\n\nencode=%d\n",sql_query,encode);

						mysql_query(my_connection,sql_query);

						bzero(sql_query,string_length);
						sprintf(sql_query,"update sessions set total_cmd=total_cmd+1,end=now(),s_bytes=%lf where sid=%d",(float)(* g_bytes)/1000,sid);
						mysql_query(my_connection,sql_query);

						bzero(sql_query,string_length);
						sprintf(sql_query,"update sessions set dangerous=%d where sid=%d and dangerous<%d",level,level);
						mysql_query(my_connection,sql_query);

						bzero(alarm_content,string_length);
						sprintf(alarm_content,"%s run command '%s' on device '%s' as the account '%s' in session %d",radius_username,inputcommandline,sstr,user,sid);
						freesvr_alarm(alarm_content,level,syslogserver,syslogfacility,mailserver,mailaccount,mailpassword,adminmailaccount,syslogalarm,mailalarm,adminmailaccount_num);

						if(level==1)
						{   
							block_command_flag = 1;
							block_session_id = session_id;
						}
						else if(level==2)
						{   
							cleanup_exit( 255 );
						}
					}
                }
                bzero(inputcommandline,string_length);
                bzero(commandline,string_length);
                i++;
                continue;
            }
            memcpy(inputcommandline+strlen(inputcommandline),&p[i],1);

			if(strlen(inputcommandline)>(string_length-5000))
			{
				bzero(inputcommandline,string_length);
			}
            i++;
        }
        return;
    }
    memcpy(inputcommandline+strlen(inputcommandline),buff,n);
    if(strlen(inputcommandline)>(string_length-5000))
    {
        bzero(inputcommandline,string_length);
    }
}

int myu2g(char *inbuf,int inlen,char *outbuf,int outlen)
{
    return mycode_convert("utf-8","gb2312",inbuf,inlen,outbuf,outlen);
}

int myg2u(char *inbuf,size_t inlen,char *outbuf,size_t outlen)
{
    return mycode_convert("gb2312","utf-8",inbuf,inlen,outbuf,outlen);
}

int mycode_convert(char *from_charset,char *to_charset,char *inbuf,int inlen,char *outbuf,int outlen)
{
    iconv_t cd;
    int rc;
    char **pin = &inbuf;
    char **pout = &outbuf;

    cd = iconv_open(to_charset,from_charset);
    if (cd==0) return -1;
    memset(outbuf,0,outlen);
    if (iconv(cd,pin,&inlen,pout,&outlen)==-1) return -1;
    iconv_close(cd);
    return 0;
}
