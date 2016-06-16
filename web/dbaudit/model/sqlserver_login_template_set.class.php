<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class sqlserver_login_template_set extends base_set {
	protected $table_name = 'sqlserver_login_template';
	protected $id_name = 'id';

}
?>
