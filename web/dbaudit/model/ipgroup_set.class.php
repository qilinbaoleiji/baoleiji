<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class ipgroup_set extends base_set {
	protected $table_name = 'db_ipgroup';
	protected $id_name = 'id';

}
?>
