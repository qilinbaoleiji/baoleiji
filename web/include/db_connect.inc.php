<?php

if(!defined('CAN_RUN')) {
	exit('Access Denied');
}
$dbhost = 'localhost';
$dbuser = 'root';
$dbpwd = '';
$dbname = 'audit_sec';
$dbcharset = 'utf8';

$log_dbhost = 'localhost';
$log_dbuser = 'root';
$log_dbpwd = '';
$log_dbname = 'audit_sec';
$log_dbcharset = 'utf8';

$link = mysql_connect($dbhost, $dbuser, _encrypt($dbpwd, 'D', 'freesvr' )) or die(mysql_error());

mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary");

?>
