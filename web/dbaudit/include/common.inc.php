<?php
header('Content-Type: text/html; charset=UTF-8');
header("Cache-Control: no-cache"); 

define ('CAN_RUN', true);
define('ROOT', substr(dirname(__FILE__), 0, -7));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());


require_once ROOT. './include/config.inc.php';
require_once ROOT. './include/tabs.php';
require_once ROOT. './include/db_connect.inc.php';
require_once ROOT. './include/pager.class.php';
require_once ROOT. './smarty/Smarty.class.php';




define('DATA_PATH', $_CONFIG['site']['DATA_PATH']);

function __autoload($class_name) {
	if(file_exists(ROOT. './model/' . $class_name . '.class.php')) {
    	require_once ROOT. './model/' . $class_name . '.class.php';
	}
}
?>
