<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class auditpolicy_ipgroup_set extends base_set {
	protected $table_name = 'dbtrustip';
	protected $id_name = 'id';

}
?>
