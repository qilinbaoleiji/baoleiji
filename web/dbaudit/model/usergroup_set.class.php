<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class usergroup_set extends base_set {
	protected $table_name = 'usergroup';
	protected $id_name = 'id';
}