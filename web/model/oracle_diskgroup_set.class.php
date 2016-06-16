<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class oracle_diskgroup_set extends base_set {
	protected $table_name = 'oracle_diskgroup';
	protected $id_name = 'id';

}