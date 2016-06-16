<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_log extends c_base {
	
	function adminlog() {
		$page_num = get_request('page');
		$luser = get_request('luser', 1, 1);
		$operation = get_request('operation', 1, 1);
		$administrator = get_request('administrator', 1, 1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'optime';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);

		$where = '1=1';
		if($luser){
			$where .= " AND luser='$luser'" ;
		}
		if($operation){
			$where .= " AND action='$operation'" ;
		}
		if($administrator){
			$where .= " AND administrator='$administrator'" ;
		}
		$row_num = $this->admin_log_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$allmember = $this->admin_log_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where, $orderby1, $orderby2);
		
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);

		$out = $allmember;

		for($i=0;$i<count($out);$i++) {
			$out[$i]['username'] = $allmember[$i]['username'];
		}
		$this->assign('allmember', $out);
		$this->display('adminlog_list.tpl');
	}

	function delete_adminlog() {
		$uid = get_request('chk_member', 1, 1);
		$this->admin_log_set->delete($uid);		
		alert_and_back('成功删除用户');
	}
}
?>
