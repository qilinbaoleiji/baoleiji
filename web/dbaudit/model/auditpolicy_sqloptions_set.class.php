<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class auditpolicy_sqloptions_set extends base_set {
	protected $table_name = 'dbauditpolicy_sqloption';
	protected $id_name = 'id';

}
?>
