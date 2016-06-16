#!/bin/bash
mv /opt/freesvr/web/htdocs/freesvr/audit /opt/freesvr/web/htdocs/freesvr/audit.627
mkdir /opt/freesvr/web/htdocs/freesvr/audit
mv web.tar.gz /opt/freesvr/web/htdocs/freesvr/audit
cd /opt/freesvr/web/htdocs/freesvr/audit
tar xpvf web.tar.gz
