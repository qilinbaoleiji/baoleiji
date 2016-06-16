# $Id: Makefile.in,v 1.309 2010/03/13 21:41:34 djm Exp $

# uncomment if you run a non bourne compatable shell. Ie. csh
#SHELL = /bin/sh

AUTORECONF=autoreconf

prefix=/opt/freesvr/audit/sshgw-audit
exec_prefix=${prefix}
bindir=${exec_prefix}/bin
sbindir=${exec_prefix}/sbin
libexecdir=${exec_prefix}/libexec
datadir=${datarootdir}
datarootdir=${prefix}/share
mandir=${datarootdir}/man
mansubdir=man
sysconfdir=${prefix}/etc
piddir=/var/run
srcdir=.
top_srcdir=.
logdir=${prefix}/var/log/freesvr-ssh-proxy
backupdir=/opt/freesvr/audit/log/sftp
getdir=${backupdir}/download
putdir=${backupdir}/upload

DESTDIR=

STRIP_OPT=-s

VERSION_CODE=0.8.7
COMPILE_TIME=`date -d now +%F-%T`
PATHS= -DSSHDIR=\"$(sysconfdir)\" \
	-D_PATH_SSH_PIDDIR=\"$(piddir)\" \
	-D_PATH_SSH_LOGDIR=\"$(logdir)\" \
	-DVERSION_CODE=\"$(VERSION_CODE)\" -DCOMPILE_TIME=\"$(COMPILE_TIME)\"

CC=gcc
LD=gcc
CFLAGS=-g -O2 -Wall -Wpointer-arith -Wuninitialized -Wsign-compare -Wno-pointer-sign -Wformat-security \
	   -fno-strict-aliasing -fno-builtin-memset -fstack-protector-all -std=gnu99 \
	   -I/opt/freesvr/sql/include/mysql -Iradius/include -I/opt/freesvr/audit/authd/include
CPPFLAGS=-I. -I$(srcdir)  $(PATHS) -DHAVE_CONFIG_H
LIBS=-lcrypto -ldl -lutil -lz -lnsl  -lcrypt -lresolv -lmysqlclient -llicauth -lradius -lauthclient -lpcre -L/home/zhangzhong/mail -lmailclient
SSHDLIBS=
LIBEDIT=
AR=/usr/bin/ar
AWK=gawk
RANLIB=ranlib
INSTALL=/usr/bin/install -c
PERL=/usr/bin/perl
SED=/bin/sed
ENT=
XAUTH_PATH=/usr/bin/xauth
LDFLAGS=-L. -Lopenbsd-compat/ -Llicense/ -fstack-protector-all -L/opt/freesvr/sql/lib/mysql -L/opt/radius/lib -L/opt/freesvr/audit/authd/lib
EXEEXT=

INSTALL_SSH_PRNG_CMDS=
INSTALL_SSH_RAND_HELPER=

TARGETS=freesvr-ssh-proxy$(EXEEXT)

LIBSSH_OBJS=acss.o authfd.o authfile.o bufaux.o bufbn.o buffer.o \
	canohost.o channels.o cipher.o cipher-acss.o cipher-aes.o \
	cipher-bf1.o cipher-ctr.o cipher-3des1.o cleanup.o \
	compat.o compress.o crc32.o deattack.o fatal.o hostfile.o \
	log.o match.o md-sha256.o moduli.o nchan.o packet.o \
	readpass.o rsa.o ttymodes.o xmalloc.o addrmatch.o \
	atomicio.o key.o dispatch.o kex.o mac.o uidswap.o uuencode.o misc.o \
	monitor_fdpass.o rijndael.o ssh-dss.o ssh-rsa.o dh.o kexdh.o \
	kexgex.o kexdhc.o kexgexc.o msg.o progressmeter.o dns.o \
	entropy.o gss-genr.o umac.o jpake.o schnorr.o \
	ssh-pkcs11.o

MITMSSH_OBJS=sshd.o auth-rhosts.o auth-passwd.o auth-rsa.o auth-rh-rsa.o \
	sshpty.o sshlogin.o servconf.o serverloop.o \
	auth.o auth1.o auth2.o auth-options.o session.o \
	auth-chall.o auth2-chall.o groupaccess.o \
	auth-skey.o auth-bsdauth.o auth2-hostbased.o auth2-kbdint.o \
	auth2-none.o auth2-passwd.o auth2-pubkey.o auth2-jpake.o \
	monitor_mm.o monitor.o monitor_wrap.o kexdhs.o kexgexs.o \
	auth-krb5.o \
	auth2-gss.o gss-serv.o gss-serv-krb5.o \
	loginrec.o auth-pam.o auth-shadow.o auth-sia.o md5crypt.o \
	audit.o audit-bsm.o platform.o sftp-server.o sftp-common.o \
	roaming_common.o roaming_serv.o radius-client.o\
	sshconnect.o sshconnect1.o sshconnect2.o mitm-ssh.o readconf.o net.o jump.o

MANPAGES	= 
MANPAGES_IN	= 
MANTYPE	= doc

CONFIGFILES=freesvr-ssh-proxy_config.out 
CONFIGFILES_IN=freesvr-ssh-proxy_config

PATHSUBS	= \
	-e 's|/etc/ssh/ssh_prng_cmds|$(sysconfdir)/ssh_prng_cmds|g' 

FIXPATHSCMD	= $(SED) $(PATHSUBS)

all: $(CONFIGFILES) ssh_prng_cmds.out $(MANPAGES) $(TARGETS)

$(LIBSSH_OBJS): Makefile.in config.h
$(MITMSSH_OBJS): Makefile.in config.h

.c.o:
	$(CC) $(CFLAGS) $(CPPFLAGS) -c $<

LIBCOMPAT=openbsd-compat/libopenbsd-compat.a
$(LIBCOMPAT): always
	(cd openbsd-compat && $(MAKE))
always:

libssh.a: $(LIBSSH_OBJS)
	$(AR) rv $@ $(LIBSSH_OBJS)
	$(RANLIB) $@

freesvr-ssh-proxy$(EXEEXT): libssh.a	$(LIBCOMPAT) $(MITMSSH_OBJS)
	$(LD) -o $@ $(MITMSSH_OBJS) $(LDFLAGS) -lssh -lopenbsd-compat $(LIBWRAP) $(LIBPAM) $(LIBS)

$(CONFIGFILES): $(CONFIGFILES_IN)
	conffile=`echo $@ | sed 's/.out$$//'`; \
	$(FIXPATHSCMD) $(srcdir)/$${conffile} > $@

ssh_prng_cmds.out:	ssh_prng_cmds
	if test ! -z "$(INSTALL_SSH_PRNG_CMDS)"; then \
		$(PERL) $(srcdir)/fixprogs ssh_prng_cmds $(ENT); \
	fi

# fake rule to stop make trying to compile moduli.o into a binary "moduli.o"
moduli:
	echo

clean:	
	rm -f *.o *.a $(TARGETS) logintest config.cache config.log
	rm -f *.out core
	(cd openbsd-compat && $(MAKE) clean)

catman-do:
	@for f in $(MANPAGES_IN) ; do \
		base=`echo $$f | sed 's/\..*$$//'` ; \
		echo "$$f -> $$base.0" ; \
		nroff -mandoc $$f | cat -v | sed -e 's/.\^H//g' \
			>$$base.0 ; \
	done

install: $(CONFIGFILES) ssh_prng_cmds.out $(TARGETS) install-files host-key

install-files: 
	$(srcdir)/mkinstalldirs $(DESTDIR)$(sbindir)
	(umask 022 ; $(srcdir)/mkinstalldirs $(DESTDIR)$(PRIVSEP_PATH))
	$(INSTALL) -m 0755 $(STRIP_OPT) freesvr-ssh-proxy $(DESTDIR)$(sbindir)/freesvr-ssh-proxy
	if test ! -z "$(INSTALL_SSH_RAND_HELPER)" ; then \
		$(INSTALL) -m 0755 $(STRIP_OPT) ssh-rand-helper $(DESTDIR)$(libexecdir)/ssh-rand-helper ; \
	fi
	if [ ! -d $(DESTDIR)$(sysconfdir) ]; then \
		$(srcdir)/mkinstalldirs $(DESTDIR)$(sysconfdir); \
	fi
	@if [ ! -f $(DESTDIR)$(sysconfdir)/sshd_config ]; then \
		$(INSTALL) -m 644 freesvr-ssh-proxy_config.out $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_config; \
	else \
		echo "$(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_config already exists, install will not overwrite"; \
	fi
	@if [ -f ssh_prng_cmds -a ! -z "$(INSTALL_SSH_PRNG_CMDS)" ]; then \
		if [ ! -f $(DESTDIR)$(sysconfdir)/ssh_prng_cmds ] ; then \
			$(INSTALL) -m 644 ssh_prng_cmds.out $(DESTDIR)$(sysconfdir)/ssh_prng_cmds; \
		else \
			echo "$(DESTDIR)$(sysconfdir)/ssh_prng_cmds already exists, install will not overwrite"; \
		fi ; \
	fi
	if [ ! -d $(DESTDIR)$(logdir) ]; then \
		$(srcdir)/mkinstalldirs $(DESTDIR)$(logdir); \
	fi
	if [ ! -d $(DESTDIR)$(backupdir) ]; then \
		$(srcdir)/mkinstalldirs $(DESTDIR)$(backupdir); \
	fi
	if [ ! -d $(DESTDIR)$(getdir) ]; then \
		$(srcdir)/mkinstalldirs $(DESTDIR)$(getdir); \
	fi
	if [ ! -d $(DESTDIR)$(putdir) ]; then \
		$(srcdir)/mkinstalldirs $(DESTDIR)$(putdir); \
	fi


host-key:
	@if [ -z "$(DESTDIR)" ] ; then \
		if [ -f "$(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_key" ] ; then \
			echo "$(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_key already exists, skipping." ; \
		else \
			ssh-keygen -t rsa1 -f $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_key -N "" ; \
		fi ; \
		if [ -f $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_dsa_key ] ; then \
			echo "$(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_dsa_key already exists, skipping." ; \
		else \
			ssh-keygen -t dsa -f $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_dsa_key -N "" ; \
		fi ; \
		if [ -f $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_rsa_key ] ; then \
			echo "$(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_rsa_key already exists, skipping." ; \
		else \
			ssh-keygen -t rsa -f $(DESTDIR)$(sysconfdir)/freesvr-ssh-proxy_host_rsa_key -N "" ; \
		fi ; \
	fi ;

uninstall:
	-rm -f $(DESTDIR)$(sbindir)/freesvr-ssh-proxy$(EXEEXT)

package: $(CONFIGFILES) ssh_prng_cmds.out $(MANPAGES) $(TARGETS)
	if [ "no" = yes ]; then \
		sh buildpkg.sh; \
	fi

