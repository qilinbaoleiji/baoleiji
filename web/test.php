<?php
error_reporting(1);
session_start();
require_once './smarty/Smarty.class.php';
$smarty = new Smarty; 
$smarty->template_dir =  "./template/admin";
$smarty->compile_dir =  "./template_c/admin";
$smarty->cache_dir = './template_cache/admin';
$smarty->left_delimiter = "{{"; 
$smarty->right_delimiter = "}}";
$smarty->setCaching(0);
$smarty->assign('template_root', './template/admin');
$alldev[]=array('name'=>'hell','sid'=>'233');
$alldev[]=array('name'=>'hell','sid'=>'243');
$alldev[]=array('name'=>'hell','sid'=>'253');var_dump($alldev);
$smarty->assign("alldev", $alldev);
$smarty->display("test.tpl");
?>