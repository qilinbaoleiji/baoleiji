<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class sqloptions_group_set extends base_set {
	protected $table_name = 'sqloptions_group';
	protected $id_name = 'id';

}
?>
