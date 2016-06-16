<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_sqlneton extends c_base {
	function sourceip(){
		$this->index();
	}
	function index($where = NULL) {
		//$table_name = get_request('table_name', 0, 1);
		//if($table_name) {
		//	$this->session_set->set_table_name($table_name);
		//}
		//else {
		//	$table_name = $this->session_set->get_table_name();
		//}
		global $_CONFIG;
		$this->assign("logindebug",$_CONFIG['LOGIN_DEBUG']);

		$page_num = get_request('page');
		$derive = get_request('derive');
		$delete = get_request('delete');
		$where = "1=1";

		$member = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		$this->assign('member', $member);

		$s_addr = get_request('s_addr', 0, 1);
		$d_addr = get_request('d_addr', 0 ,1);
		$s_mac = get_request('s_mac', 0, 1);
		$d_mac = get_request('d_mac', 0 ,1);
		$user = get_request('user', 0, 1);
		$luser = get_request('luser', 0, 1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		$sid1 = get_request('sid1', 0, 1);
		$sid2 = get_request('sid2', 0, 1);
		$start1 = get_request('start1', 0, 1);
		$end1 = get_request('end1', 0, 1);
		$start2 = get_request('start2', 0, 1);
		$end2 = get_request('end2', 0, 1);
		$command = get_request('command', 0, 1);

		if($s_addr) {
			if(is_ip($s_addr)) {
				$where .= " AND s_addr = '$s_addr'";
			}
			else {
				$where .= " AND s_addr LIKE '%$s_addr%'";
			}
		}
		

		if($d_addr) {
			if(is_ip($d_addr)) {
				$where .= " AND d_addr = '$d_addr'";
			}
			else {
				$where .= " AND d_addr LIKE '%$d_addr%'";
			}
		}

		if($s_mac) {
			if(is_ip($d_addr)) {
				$where .= " AND s_mac = '$s_mac'";
			}
			else {
				$where .= " AND s_mac LIKE '$s_mac%'";
			}
		}

		if($d_mac) {
			if(is_ip($d_addr)) {
				$where .= " AND d_mac = '$d_mac'";
			}
			else {
				$where .= " AND d_mac LIKE '$d_mac%'";
			}
		}

		if($user) {
			$where .= " AND user like '%$user%'";
		}

		if($luser) {
			$where .= " AND user like '%$luser%'";
		}

		if(empty($orderby1)){
			$orderby1 = 'sid';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);

		if($sid1 !== NULL && $sid2 !== NULL) {
			$where .= " AND (sid >= $sid1 AND sid <= $sid2)";
		}

		if($start1 ) {
			$where .= " AND (start >= '$start1') ";
		}

		if($start2 ) {
			$where .= " AND (start <= '$start2') ";
		}
		
		if($end1 && $end2) {
			$where .= " AND (end >= '$end1' AND end <= '$end2')";
		}



		if($command) {
			$where .= " AND (SELECT COUNT(*) FROM `oracle_commands` WHERE cmd LIKE '%$command%' AND oracle_commands.sid = oracle_sessions.sid) > 0";
		}

		if($delete) {
			if($_SESSION['ADMIN_LEVEL'] == 1) {
				$this->delete($where);
			}
			else {
				die('æ²¡ææé');
			}
		}
		else if($derive) {
			$this->derive($where);
		}
		else {		
			//$table_list = $this->get_table_list();

			$curr_url = $_SERVER['PHP_SELF'] . "?";
			if(strstr($_SERVER['QUERY_STRING'], "&page=")) {
				$curr_url .= substr($_SERVER['QUERY_STRING'], 0 , strpos($_SERVER['QUERY_STRING'], "&page="));
			}
			else {
				$curr_url .= $_SERVER['QUERY_STRING'];
			
			}
			//echo $curr_url;
			
			$row_num = $this->sqlcommands_set->select_count($where);
			
			$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
			$this->assign('page_list', $newpager->showSerialList());
			$this->assign('session_num', $row_num);
			$this->assign('curr_page', $newpager->intCurrentPageNumber);
			$this->assign('total_page', $newpager->intTotalPageCount);
			$this->assign('items_per_page', $newpager->intItemsPerPage);
			$this->assign('curr_url', $curr_url);
			$this->assign('command', $command);
			$sql = "SELECT a.*, b.s_addr,b.d_addr,b.user FROM ".$this->sqlcommands_set->get_table_name()." a LEFT JOIN ".$this->sqlnet_set->get_table_name()." b ON a.sid=b.sid WHERE $where ORDER BY $orderby1 $orderby2 LIMIT $newpager->intStartPosition, $newpager->intItemsPerPage";
			$this->assign('allcommand', $this->sqlcommands_set->base_select($sql));

			//$this->assign('now_table_name', $table_name);
			//$this->assign('table_list', $table_list);
			$this->display("sqlcommands.tpl");
		}
	}

	function search() {
		//$table_list = $this->get_table_list();
		//$this->assign('table_list', $table_list);
		$this->assign('alldev', $this->dev_set->select_all());
		$this->display("sqlnet_search.tpl");
	}

	//function get_table_list() {
	//	$result = $this->info_set->base_select("SHOW TABLES LIKE 'info%'");
	//	$table_list = array();
	//	foreach($result as $table_name) {
	//		$table_list[] = $table_name['Tables_in_log (info%)'];
	//	}
	//	return $table_list;	
	//}

	function derive($where) {
		$result = $this->sqlnet_set->select_limit(0, 10000, $where);
		$handle = fopen(ROOT . '/tmp/sessions.xls', 'w');
		fwrite($handle, "ID\t");
		fwrite($handle, "è®¾å¤å°å\t");
		fwrite($handle, "ä¼è¯ç±»å\t");
		fwrite($handle, "ç¨æ·å\t");
		fwrite($handle, "å¼å§æ¶é´\t");
		fwrite($handle, "ç»ææ¶é´\t\n");
		$row = 1;
		foreach($result as $info) {
			$col = 0;
			foreach($info as $t) {
				fwrite($handle, "$t\t");
				$col++;
			}
			fwrite($handle, "\n");
			$row++;
		}
		fclose($handle);
		go_url("tmp/sessions.xls?c=" . rand());
	}

	
	function del_command() {
		$cid = get_request('cid');
		$this->sqlcommands_set->delete($cid);
		alert_and_back('删除成功');
	}
	
	function del_session() {
		global $_CONFIG;
		$sid = get_request('sid');
		$session = $this->sqlnet_set->select_by_id($sid);
		if ($this->sqlnet_set->select_count("logfile = '".str_replace('\'','\\\'',$session['logfile'])."'") == 1 ) {
			if(file_exists($_CONFIG['ORACLE_LOG_PATH_PREFIX'].$session['logfile'])) {
				unlink($_CONFIG['ORACLE_LOG_PATH_PREFIX'].$session['logfile']);
			}
		}
		$this->sqlnet_set->delete($sid);
		$this->sqlcommands_set->query("DELETE FROM `" . $this->sqlcommands_set->get_table_name() . "` WHERE sid = '$sid'");
		alert_and_back('删除成功');
	}

	function delete($where) {


		$this->sqlcommands_set->query("DELETE FROM `" . $this->sqlcommands_set->get_table_name() . "` WHERE `sid` IN (SELECT `sid` FROM `sessions` WHERE $where)");
		$this->sqlnet_set->query("DELETE FROM `" . $this->sqlnet_set->get_table_name() . "` WHERE $where");
		alert_and_back('æåå é¤æå®ä¼è¯');
	}

}
?>
