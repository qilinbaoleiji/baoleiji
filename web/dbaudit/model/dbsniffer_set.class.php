<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class dbsniffer_set extends base_set {
	protected $table_name = 'dbsniffer';
	protected $id_name = 'id';

}
?>
