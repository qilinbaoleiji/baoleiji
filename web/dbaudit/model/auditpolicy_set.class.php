<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class auditpolicy_set extends base_set {
	protected $table_name = 'dbauditpolicy';
	protected $id_name = 'id';

}
?>
