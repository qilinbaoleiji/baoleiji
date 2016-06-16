<?php

if(!defined('CAN_RUN')) {
	exit('Access Denied');
}
$dbhost = 'localhost';
$dbuser = 'freesvr';
$dbpwd = 'freesvr';
$dbname = 'dbaudit';
$dbcharset = 'utf8';

$link = mysql_connect($dbhost, $dbuser, $dbpwd) or die(mysql_error());

mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary");

?>
