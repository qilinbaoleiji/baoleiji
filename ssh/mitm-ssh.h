#ifndef _MITM_SSH_H
#define _MITM_SSH_H

#ifndef __dead
#define __dead       __attribute__((noreturn))
#endif

#include <stdio.h>
#include <stdlib.h>
#include "net.h"
#include "log.h"

//#include "print.h"
//#include "str.h"

struct mitm_ssh_opts {
	const char *c_logdir;
	const char *s_logdir;
	u_int resolve:1;
	u_int r_addr;       /* Route all non-NAT:ed traffic to host */
	u_short r_port;
};

/* mitm-ssh.c */
extern void mitm_ssh(int);

/* sshd.c */
extern void do_ssh1_kex(void);
extern void do_ssh2_kex2( char*, u_int );
extern void do_ssh2_kex(void);
extern void sshd_exchange_identification(int, int);

/* sshconnect.c */
extern void ssh_exchange_identification(void);

#endif /* _MITM_SSH_H */
