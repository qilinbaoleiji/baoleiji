<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class login_month_count_set extends base_set {
	protected $table_name = 'log_login_month_count';
	protected $id_name = 'seq';

}

?>
