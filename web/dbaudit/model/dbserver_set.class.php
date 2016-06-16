<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class dbserver_set extends base_set {
	protected $table_name = 'dbserverinfo';
	protected $id_name = 'id';

}
?>
