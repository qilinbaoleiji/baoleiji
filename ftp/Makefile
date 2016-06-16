
#
# Uncomment following for Solaris compile (need gnu make for top level
# make file)
#
#OSFLAG = -DSOLARIS
#OSLIB = -lnsl -lsocket

CC =		gcc
CFLAGS =	-O2 -Wall -ggdb -DVERSION=\"$(VERSION)\" \
			-DCONFIG=\"/opt/freesvr/audit/ftp-audit/etc/freesvr-ftp-audit.conf\" \
			${OSFLAG} -I/opt/freesvr/sql/include/mysql/
LFLAGS =	-L/opt/freesvr/sql/lib/mysql -L/opt/freesvr/audit/authd/lib

FTPPROXY =	main.o config.o ftp.o daemon.o ip-lib.o lib.o iconv.o

TARGETS =	ftp-audit


all:		$(TARGETS)
	-ctags *.[ch]

$(TARGETS):	$(FTPPROXY)
	$(CC) -o $@ $(FTPPROXY) ${OSLIB} ${LFLAGS} -lmysqlclient -lauthclient -I/opt/freesvr/sql/include/mysql/

	
clean:
	rm -f *.o cut out $(TARGETS) $(TAR).tgz

