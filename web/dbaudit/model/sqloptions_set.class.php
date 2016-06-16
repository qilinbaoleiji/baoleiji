<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class sqloptions_set extends base_set {
	protected $table_name = 'sqloptions';
	protected $id_name = 'id';

}
?>
