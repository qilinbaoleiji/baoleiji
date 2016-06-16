<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_loginaccount extends c_base {
	
	function index(){
		$this->day(get_request('action', 0, 1));
	}

	function week(){
		$this->day(get_request('action', 0, 1));
	}

	function month(){
		$this->day(get_request('action', 0, 1));
	}

	function day($action="") {
		$back = get_request('back');
		if($back){
			if(is_array($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING'])){
				$_GET = array_merge($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING'], $_GET);
				$_SERVER['QUERY_STRING'] = http_build_query($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING']);
			}
		}else{
			$_SESSION[$_GET['controller'].'_'.$_GET['action'].'_'.'QUERY_STRING'] = null;
		}
		if(empty($action)){
			$action = 'day';
		}
		$page_num = get_request('page');
		$derive = get_request('derive');
		$where = "1=1";
		$start = get_request('start');

		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		$time_start = get_request('f_rangeStart', 0, 1);
		$time_end = get_request('f_rangeEnd', 0, 1);
		
		if(empty($orderby1)){
			$orderby1 = 'id';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);

		if($time_start){
			//$where .= " AND  DATE_FORMAT(day, '%Y-%m-%d')='".$time_start."'";
			$ymd = explode('-', $time_start);
			if($action=='week'){
				$where .= " AND  DATE_FORMAT(`to`, '%u')='".date('W',mktime(0,0,0,$ymd[1],$ymd[2],$ymd[0]))."'";
			}elseif($action=='month'){
				$where .= " AND  DATE_FORMAT(`day`, '%Y-%m')='".date('Y-m',mktime(0,0,0,$ymd[1],$ymd[2],$ymd[0]))."'";
			}else{
				$where .= " AND  DATE_FORMAT(day, '%Y-%m-%d')='".date('Y-m-d',mktime(0,0,0,$ymd[1],$ymd[2],$ymd[0]))."'";
			}
		}else{
			if($action=='week'){
				$where .= " AND  DATE_FORMAT(`to`, '%u')='".date('W',mktime(0,0,0,date('m'),date('d'),date('Y')))."'";
			}elseif($action=='month'){
				$where .= " AND  DATE_FORMAT(`day`, '%Y-%m')='".date('Y-m',mktime(0,0,0,date('m')-1,date('d'),date('Y')))."'";
			}else{
				$where .= " AND  DATE_FORMAT(day, '%Y-%m-%d')='".date('Y-m-d',mktime(0,0,0,date('m'),date('d')-1,date('Y')))."'";
			}
		}
		if($_SESSION['ADMIN_LEVEL']==0){
			$where .= " AND (audituser = '".$_SESSION['ADMIN_USERNAME']."')";
		}
		$get_user_flist = $this->get_user_flist();
		if($_SESSION['ADMIN_LEVEL'] != 1 and !empty($get_user_flist)) {
			$where .= " AND host IN (" . implode(",", $get_user_flist) . ")";
		}

		
		$curr_url = $_SERVER['PHP_SELF'] . "?";
		if(strstr($_SERVER['QUERY_STRING'], "&page=")) {
			$curr_url .= substr($_SERVER['QUERY_STRING'], 0 , strpos($_SERVER['QUERY_STRING'], "&page="));
		}
		else {
			$curr_url .= $_SERVER['QUERY_STRING'];
		
		}
		parse_str($_SERVER['QUERY_STRING'], $_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING']);
		if($delete) {
			if($_SESSION['ADMIN_LEVEL'] == 1) {
				$this->delete_loginlog($where);
			}
			else {
				die(language('没有权限'));
			}
		}
		
		else if($derive) {
			if($derive==1){
				$this->derive_loginacct($start, $where, $action);
			}else if($derive==2){
				$this->derive_loginacct_tohtml($start, $where, $action);
				return;
			}
		}
		else {
			if($action=='week'){
				
				$row_num = $this->db_login_account_weekly_set->select_count($where);
				$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
				$alllog=$this->db_login_account_weekly_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2 );
			}elseif($action=='month'){
				
				$row_num = $this->db_login_account_monthly_set->select_count($where);
				$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
				$alllog=$this->db_login_account_monthly_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2 );
			}else{
				
				$row_num = $this->db_login_account_set->select_count($where);
				$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
				$alllog=$this->db_login_account_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2 );
			}
			if($row_num>10000){				
				$num = ceil($row_num/10000);
				$str = "";
				$strhtml = "";
				for($i=0; $i<$num; $i++){
					$str .= "<a href='".$curr_url."&derive=1&start=".($i*10000+1)."' target='_blank'>".($i*10000+1)."-".(($i+1)*10000 < $row_num ? ($i+1)*10000 : $row_num)."</a>  ";
					$strhtml .= "<a href='".$curr_url."&derive=2&start=".($i*10000+1)."' target='_blank'>".($i*10000+1)."-".(($i+1)*10000 < $row_num ? ($i+1)*10000 : $row_num)."</a>  ";
				}
			}
			$this->assign("alltem", $alltem);
			$this->assign("str", $str);
			$this->assign("strhtml", $strhtml);
			$this->assign('page_list', $newpager->showSerialList());
			$this->assign('log_num', $row_num);
			$this->assign('curr_page', $newpager->intCurrentPageNumber);
			$this->assign('total_page', $newpager->intTotalPageCount);
			$this->assign('items_per_page', $newpager->intItemsPerPage);
			$this->assign('curr_url', $curr_url);
			$this->assign('alllog', $alllog);
			$this->assign("page_nav_tabs_selected", $action);
			$this->assign("action", $action);
			$this->display("loginacct.tpl");
		}
	}

	function derive_loginacct($start, $where, $action) {
		switch($action){
			case 'week':
				$class = 'db_login_account_weekly_set';
			break;
			case 'month':
				$class = 'db_login_account_monthly_set';
			break;
			default:
				$class = 'db_login_account_set';
			break;
		}
		$result = $this->$class->select_limit($start, 10000, $where );
		$str = language("序号")."SID,";
		$str .= language("日期").",";
		$str .= language("服务器").",";
		$str .= language("数据库类型").",";
		$str .= language("用户").",";
		$str .= language("登录次数").",";
		$str .= "\n";
		$row = 1;
		if(!empty($result))
		foreach($result as $info) {
			$str .= $row.",";
			$str .= $info['day'].",";
			$str .= $info['server'].",";
			$str .= $info['db_type'].",";
			$str .= $info['user'].",";
			$str .= $info['total'].",";
			$str .= "\n";		
			
			$row++;
		}
		$str = mb_convert_encoding($str, "GB2312", "UTF-8");
		Header('Cache-Control: private, must-revalidate, max-age=0');
		Header("Content-type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=loginacct.csv"); 
		echo $str;
		exit();	
	}
	
	function derive_loginacct_tohtml($start, $where, $action){
		switch($action){
			case 'week':
				$class = 'db_login_account_weekly_set';
			break;
			case 'month':
				$class = 'db_login_account_monthly_set';
			break;
			default:
				$class = 'db_login_account_set';
			break;
		}
		$alllog=$this->$class->select_limit($start, 10000, $where );
		ob_start();
		$this->assign('alllog', $alllog);
		$this->assign('title', language('登录日志'));
		$this->display('loginacct_export_tohtml.tpl');
		$str = ob_get_clean();
		if($_GET['derive_forcron']){
			echo $str;
			return ;
		}
		Header('Cache-Control: private, must-revalidate, max-age=0');
		Header("Content-type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=loginacct.html"); 
		echo $str;
		exit();
	}

}
?>
