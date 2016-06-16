<?php
$time_start = getmicrotime(); 

function getmicrotime() {
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec);
}

require_once('./include/common.inc.php');
require_once(ROOT . './include/global.func.php');
require_once(ROOT . './include/email.php');
require_once(ROOT . './controller/c_base.class.php');


session_cache_limiter("no-cache");
session_start();

ob_start();
$settingobj = new setting_set();		
//$logintimeout = $setting->select_all(" sname='logintimeout'");
$setting = $settingobj->select_all(" sname='password_policy'");
$pwdconfig = unserialize($setting[0]['svalue']);
ob_end_clean();		

if(isset($_SESSION["ADMIN_LOGINED"]) && mktime()-$_SESSION['startonlinetime'] > $pwdconfig['logintimeout']*60){
	session_destroy();
	$ref = get_request('ref', 0, 1);
	if(empty($ref)){
		$ref = $_SERVER["QUERY_STRING"]; 
	}
	if(strstr($ref,"login") || strstr($ref,"ref")){
		$ref='';
	}
	go_url("../admin.php?controller=admin_index&action=login&ref=".urlencode($ref), 1);
	exit;
}else if(isset($_SESSION["ADMIN_LOGINED"])){
	$_SESSION['startonlinetime'] = time();
	$_SESSION['sess_user_id']=1;
}

if(isset($_GET['controller'])) {
	$controller = 'c_' . $_GET['controller'];
}
else {
	$controller = 'c_admin_index';
}

if(isset($_GET['action'])) {
	$action = $_GET['action'];
}
else {
	$action = 'index';
}
$language = array('en','cn');
define("LANGUAGE", 'cn');
require_once(ROOT . './include/language_cn.php');
if(in_array(LANGUAGE,$language)){
	require_once(ROOT . './include/language_'.LANGUAGE.'.php');
}
if($_SESSION['ADMIN_LOGINED']){

	ob_start();
	$member = new member_set();		
	//$logintimeout = $setting->select_all(" sname='logintimeout'");
	$minfo = $member->select_all("username='".$_SESSION['ADMIN_USERNAME']."'");
	$minfo=$minfo[0];
	$_SESSION['ADMIN_LEVEL'] = $minfo['level'];					
	$_SESSION['ADMIN_UID'] = $minfo['uid'];
	$_SESSION['ADMIN_GROUP'] = (int)$minfo['groupid'];
	ob_end_clean();	
	
	/*if(!isset($_SESSION['JUSTLOGINSHOWPWDEDIT'])&&((mktime()-$minfo['lastdateChpwd'])/(24*3600) > ($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']))&&$action!='menu'&&!($controller=='c_admin_index'&&$action=='index')&&$action!='save_self'&&$action!='logout'){
			$controller = 'c_admin_member';
			$action = 'edit_self';
			$_GET['msg']='changepwd';
			$_SESSION['JUSTLOGINSHOWPWDEDIT']='on';
	}*/
	
	/*if(((mktime()-$minfo['lastdateChpwd'])/(24*3600) > ($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']))&&$action!='menu'&&!($controller=='c_admin_index'&&$action=='index')&&$action!='save_self'&&$action!='logout')
	{
			$controller = 'c_admin_member';
			$action = 'edit_self';
			$_GET['msg']='changepwd';
	}*/
}
if(file_exists(ROOT ."./controller/$controller.class.php")) {
	require_once(ROOT ."./controller/$controller.class.php");	
	
	if((!isset($_SESSION["ADMIN_LOGINED"]) || $_SESSION["ADMIN_LOGINED"] == false) && ($action != 'login' && $action !='chklogin' && $action != 'getpwd')) {
		//go_url("admin.php?controller=admin_index&action=login");
		go_url("../admin.php?controller=admin_index&action=login", 1);
	}else if($_SESSION["ADMIN_LEVEL"]!=1&&$_SESSION["ADMIN_LEVEL"]!=2){
		alert_and_back("请以管理员/审计员身份登录", "../admin.php?controller=admin_index&action=login");
		exit;
	}
	else {
		//权限控制
		if(!isset($_SESSION["ADMIN_LEVEL"]) || $_SESSION["ADMIN_LEVEL"] != 1) {
			$nopower = false;
			if($controller == 'c_admin_backup' ) {
				$nopower = true;	
			}
			else if($controller == 'c_admin_session' && $_SESSION["ADMIN_LEVEL"]!=2) {
				if($action == 'del_command' || $action == 'del_session' || $action == 'delete') {
					$nopower = true;
				}	
			}
			else if($controller == 'c_admin_member' && $_SESSION["ADMIN_LEVEL"]!=3) {
				if($action != 'edit_self' && $action != 'save_self'&& $action != 'userdisk') {
					$nopower = true;
				}
			}
			else if($controller == 'c_admin_facility') {
				if($action == 'add' || $action == 'delete' || $action == 'edit' || $action == 'cover') {
					$nopower = true;
				}
			}
			else if($controller == 'c_admin_auto') {
				if($action == 'user_del' || $action == 'net_del') {
					$nopower = true;
				}
			}
			
			if($nopower) {
				die('没有权限');
			}
		}
		//Smarty初始化
		$smarty = new Smarty(); 
		$smarty->template_dir = ROOT . "./template/admin";
		$smarty->compile_dir = ROOT . "./template_c/admin";
		$smarty->cache_dir = './template_cache/admin';
		$smarty->left_delimiter = "{{"; 
		$smarty->right_delimiter = "}}";
		$smarty->caching = 0;
		$smarty->assign('template_root', './template/admin');
		$smarty->assign("page_nav_tabs", $tab[$controller]);
		$smarty->assign("page_nav_tabs_selected", $controller);
		if($action=='search'){
			$smarty->assign("page_nav_tabs", $tab[$controller.'_'.$action]);
			$smarty->assign("page_nav_tabs_selected", 'c_admin_sqlnet'.'_'.$action);
		}
		
		
		//设置语言
		//print_r($$_CONFIG['site']['Language']);
		//var_dump($_COOKIE['LANGUAGE']);
		$smarty->assign("language", ${LANGUAGE});
		//设置语言结束
		//创建控制器
		$newcontroller = new $controller();

		$newcontroller->init($smarty, $_CONFIG);
		//执行控制器的方法的
		if(method_exists($newcontroller, $action)) {
			if(isset($_SESSION["ADMIN_LEVEL"])) {
				$newcontroller->assign('admin_level', $_SESSION['ADMIN_LEVEL']);
			}
			$ref = get_request('ref', 0, 1);
			//echo urldecode($ref);
			if(strstr($ref,"login") || strstr($ref,"ref")){
				$ref='';
			}
			$newcontroller->assign("ref", urldecode($ref));
			$newcontroller->$action();
		}
		else {
			echo "无效的操作";
		}
	}
}
else {
	echo "无效的操作";
}

$time_end = getmicrotime(); 

//printf ("[页面执行时间: %.2f毫秒]",($time_end - $time_start)*1000); 

?>
