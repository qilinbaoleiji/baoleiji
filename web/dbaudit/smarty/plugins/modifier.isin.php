<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     cat<br>
 * Date:     Feb 24, 2003
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$var|cat:"foo"}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_isin($string, $arr)
{
	if(!is_array($arr)) {
		return false;
	}
   	if(array_search($string, $arr) === false) {
		return false;
	}
	else {
		return true;
	}
}

/* vim: set expandtab: */

?>
