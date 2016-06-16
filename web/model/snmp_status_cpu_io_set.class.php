<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class snmp_status_cpu_io_set extends base_set {
	protected $table_name = 'snmp_status_cpu_io';
	protected $id_name = 'seq';
}