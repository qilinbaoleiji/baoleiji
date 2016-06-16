<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

//站点配置
$_CONFIG = array();
$_CONFIG['site']['Language'] = "cn";
$_CONFIG['site']['SERVER_CONF'] = "conf/server.conf";
$_CONFIG['site']['items_per_page'] = 10;
$_CONFIG['site']['title'] = 'Audit';
$_CONFIG['site']['admin_email'] = '也云 <cfreely@hotmail>';
$_CONFIG['site']['probackup'] = '/home/hewu/release/pro-backup/';
$_CONFIG['site']['DATA_PATH'] = dirname(__FILE__).'/../';

$_CONFIG['backup']['authcode'] = 'abcdef';
//指定tftp根目�?
$_CONFIG['TFTP_ROOT'] = '/tftpboot/';
//指定外部访问本机的tftp使用的ip
$_CONFIG['TFTP_SERVER_IP'] = '10.254.0.254';
$_CONFIG['DEVLOGIN_FORTIP'] = '127.0.0.1';
$_CONFIG['DEVLOGIN_FORTIP2'] = '222.35.62.134';
$_CONFIG['MONITORPORT'] = '22';
$_CONFIG['MONITORUSER'] = 'qq';
$_CONFIG['MONITORPASSWORD'] = 'marsec';
$_CONFIG['FTP_DOWNLOAD_PREFIX'] = '/opt/freesvr/audit/';
$_CONFIG['FTP_LOG_PATH_PREFIX'] = '/ftplog/backup/';
$_CONFIG['HTTP_LOG_PATH_PREFIX'] = '/httplog/backup/';
$_CONFIG['ORACLE_LOG_PATH_PREFIX'] = '/oraclelog/backup/';


$_CONFIG['CONFIGFILE']['SERVERCONF'] = '/opt/freesvr/vpn/etc/server.conf';
$_CONFIG['CONFIGFILE']['IFGETH_NUMBER'] = 2;
$_CONFIG['CONFIGFILE']['IFGETH0'] = '/etc/sysconfig/network-scripts/ifcfg-eth0';
$_CONFIG['CONFIGFILE']['IFGETH1'] = '/etc/sysconfig/network-scripts/ifcfg-eth1';
$_CONFIG['CONFIGFILE']['IFGETH2'] = '/etc/sysconfig/network-scripts/ifcfg-eth2';
$_CONFIG['CONFIGFILE']['IFGETH3'] = '/etc/sysconfig/network-scripts/ifcfg-eth3';
$_CONFIG['CONFIGFILE']['IFGETH4'] = '/etc/sysconfig/network-scripts/ifcfg-eth4';
$_CONFIG['CONFIGFILE']['IFGETH5'] = '/etc/sysconfig/network-scripts/ifcfg-eth5';

$_CONFIG['CONFIGFILE']['NETWORK'] = '/etc/sysconfig/network';
$_CONFIG['CONFIGFILE']['OPENVPGLOG'] = '/opt/freesvr/vpn/etc/openvpn-status.log';
$_CONFIG['CONFIGFILE']['RCLOCAL'] = '/etc/rc.local';
$_CONFIG['CONFIGFILE']['SSH'] = '/opt/freesvr/audit/authd/etc/freesvr_authd_config';
$_CONFIG['CONFIGFILE']['SFTP'] = '/opt/freesvr/audit/sshgw-audit/etc/freesvr-ssh-proxy_config';
$_CONFIG['CONFIGFILE']['FTP'] = '/opt/freesvr/audit/ftp-audit/etc/freesvr-ftp-audit.conf';
$_CONFIG['CONFIGFILE']['TELNET'] = '/opt/freesvr/audit/etc/global.cfg';
$_CONFIG['CONFIGFILE']['RADCONF'] = '/opt/freesvr/vpn/etc/rad.conf';
$_CONFIG['CONFIGFILE']['RDP'] = '/etc/freesvr-rdp/freesvr/global.cfg';
$_CONFIG['CONFIGFILE']['DNS'] = '/etc/resolv.conf';

$attributes = array();

$attributes[] = array(
					'name' => 'Crypt-Password',
					'op' => ':=',
					'default' => '',
				);

$attributes[] = array(
					'name' => 'Service-Type',
					'op' => '=',	
					'default' => 'NAS-Prompt-User',
				);

$attributes[] = array(
					'name' => 'cisco-avpair',
					'op' => '=',	
					'default' => 'shell:priv-lvl=',
				);
$attributes[] = array(
					'name' => 'Reply-Message',
					'op' => '=',
					'default' => '',
				);
$_CONFIG['attributes'] = $attributes;
$config_type = array();

$config_type[] = array(
			'name' => 'Linux配置文件',
			'facility' => array(
				0 => 2,
			),
			'class' => 'linux_config',
			'type' => 'rsync',
			'path' => '',
		);
$config_type[] = array(
			'name' => 'Tripwire文件',
			'facility' => array(
				0 => 2,
			),
			'class' => 'linux_config',
			'type' => 'rsync',
			'path' => '',
		);
$config_type[] = array(
			'name' => 'running-config',
			'facility' => array(
				0 => 1,
			),
			'class' => 'cisco_config',
			'type' => 'cisco_config',
			'file' => 'running-config',
		);
$config_type[] = array(
			'name' => 'startup-config',
			'facility' => array(
				0 => 1,
			),
			'class' => 'cisco_config',
			'type' => 'cisco_config',
			'file' => 'startup-config',
		);
$config_type[] = array(
			'name' => 'devlogin-config',
			'network_segment' => '10.0.0.0',
			'fortip' => '222.35.62.134'
		);

$_CONFIG['config_type'] = $config_type;
$_CONFIG['textname']='User-Password';
$_CONFIG['password'] = "\$1\$qY9g/6K4";

$_CONFIG['crypt']=0;
$_CONFIG['Web_AUTORUN']="c:\\freesvr\\desktop\\web_browser.exe";
$_CONFIG['Sysbase_AUTORUN']="c:\\zy\\database.exe";
$_CONFIG['Oracle_AUTORUN']="c:\\zy\\database.exe";
$_CONFIG['apppub_AUTORUN']="c:\\new\\DesktopApp.exe";
$_CONFIG['REPORT_PATH'] = '/home/hewu/workbench/report/';
$_CONFIG['SEARCH_HTML_LOG'] = '/opt/freesvr/audit/gateway/log/bin/search_html_log.pl';
$_CONFIG['SEARCH_RDP_LOG'] = '/opt/freesvr/audit/gateway/log/bin/search_rdp_log.pl';
$_CONFIG['PASSWORD_USER_DOWNLOAD'] = '/opt/freesvr/audit/etc/desdevs.txt.gz';
$_CONFIG['EDITPASSWORD'] = '/home/hewu/workbench/pwd_changer/pwd-changer-1.1.0';
$_CONFIG['PASSWORD_USER_DOWN'] = '/opt/freesvr/audit/etc/password';
$_CONFIG['TIMEOUT_MINUTES'] = 30;
$_CONFIG['RDP_CUTOFF'] = '/etc/freesvr-monitor/bin/client';
$_CONFIG['RUNNING_CUTOFF'] = '/opt/freesvr/audit/gateway/log/bin/kill_pid.pl';
$_CONFIG['HACF'] = '/etc/ha.d/ha.cf';
$_CONFIG['HARESOURCES'] = '/etc/ha.d/haresources';
$_CONFIG['SSHPUBLICKEY'] = '/opt/freesvr/authorized_keys';
$_CONFIG['SSHPRIVATEKEYDIR'] = '/opt/freesvr/sshprivatekey';
$_CONFIG['NTPKEYS'] = '/etc/ntp/keys';
$_CONFIG['NTPNAGIOS'] = '/var/spool/cron/freesvr';
$_CONFIG['RDPSERVER1'] = '/etc/freesvr-play/freesvr/global.cfg';
$_CONFIG['RDPSERVER2'] = '/etc/freesvr-monitor/freesvr/global.cfg';
$_CONFIG['DATABASE_BLACKLIST'] = '/opt/freesvr/audit//etc/oracle_black_list.conf';
$_CONFIG['EDITPASSWORD2'] = '/opt/freesvr/audit/passwd/sbin/freesvr-passwd';
$_CONFIG['NETDISKPATH'] = '/opt/freesvr/audit/netdisk';
$_CONFIG['PASSEDITSSHPRIVATEKEY'] = '/opt/freesvr/audit/sshgw-audit/keys';//sshprivatekey���е�
$_CONFIG['LOGIN_DEBUG'] = 0;
$_CONFIG['ACTIVEX_VERSION'] = '1,0,1,2';
$_CONFIG['PASSWORD_BAN_WORD'] = '\'1"1`';
$_CONFIG['PASSWORDUSER'] = 1;
$_CONFIG['OTHER_MEMBER_RADIUS'] = 0;
$_CONFIG['AUTOBACKUPDIR'] = '/opt/freesvr/audit/autorun/script';
$_CONFIG['AUTORUNDIR'] = '/opt/freesvr/audit/autorun';
$_CONFIG['AUTOTEMPLATEDIR'] = '/opt/freesvr/audit/autorun/script';
$_CONFIG['Version'] = '2.1';
$_CONFIG['CACTI_ON'] = '1';
$_CONFIG['DBAUDIT_ON'] = '1';
$_CONFIG['LOG_ON'] = '1';
$_CONFIG['RANDOM_DB'] = '0';
$_CONFIG['APP_HOST'] = '118.186.17.101';
$_CONFIG['IE']="C:\\Program Files\\Internet Explorer\\iexplore.exe";
$_CONFIG['Radmin']="C:\\freesvr\\radmin\\Radmin.exe";
$_CONFIG['Xbrowser']="C:\\Program Files\\NetSarang\\Xmanager Enterprise 3\\Xbrowser.exe";
$_CONFIG['PLSQL']="C:\\Program Files\\PLSQL Developer\\plsqldev.exe";
$_CONFIG['PL_SQL']=20;
$_CONFIG['BACKUP_SCRIPT']="/home/lwm/backup_script/backup_script.pl";
$_CONFIG['FREESVR_UDF']="/opt/freesvr/audit/udf/etc/freesvr_udf.conf";
$_CONFIG['SQLSERVER_CONFIGFILE'] = '/usr/local/unixODBC/etc/odbc.ini';
?>
