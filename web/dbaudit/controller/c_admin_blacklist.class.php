<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_blacklist extends c_base {
	function index(){
		$this->blacklist_list();
	}
	
	function blacklist_list(){
		$page_num = get_request('page');
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'device_ip';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = '1=1';
		$row_num = $this->blacklist_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$s = $this->blacklist_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2);
		$this->assign('title', language('来源IP列表'));
		$this->assign('s', $s);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('blacklist_list.tpl');
	}
	
	function blacklist_edit(){
		$id = get_request("id");
		$sip = $this->blacklist_set->select_by_id($id);
		$this->assign("title", language('添加来源IP组'));
		$this->assign("blacklist", $sip);
		$this->display('blacklist_edit.tpl');
	}

	function blacklist_save(){
		$id = get_request("id");
		$device_ip = get_request("device_ip", 1, 1);
		$netmask = get_request("netmask", 1, 1);
		$desc = get_request("desc", 1, 1);
		if(empty($device_ip)){
			alert_and_back('请填写IP');
			exit;
		}
	
		$blacklist = new blacklist();
		$blacklist->set_data('device_ip', $device_ip);
		$blacklist->set_data('netmask', $netmask);
		$blacklist->set_data('desc', $desc);
		if($id){
			$blacklist->set_data("id", $id);
			$this->blacklist_set->edit($blacklist);
			//记录日志
			$adminlog = new admin_log();
			$adminlog->set_data('resource', '探针-'.$ip);
			$adminlog->set_data('action', '修改');
			$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
			$this->admin_log_set->add($adminlog);	
			alert_and_back('修改成功','admin.php?controller=admin_blacklist');
			exit;
		}
		$this->blacklist_set->add($blacklist);
		//记录日志
		$adminlog = new admin_log();
		$adminlog->set_data('resource', '探针-'.$ip);
		$adminlog->set_data('action', '增加');
		$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
		$this->admin_log_set->add($adminlog);	
		alert_and_back('操作成功','admin.php?controller=admin_blacklist');
	}

	function blacklist_delete(){
		$id = get_request("id");
		
		$this->blacklist_set->delete($id);
		alert_and_back('删除成功','admin.php?controller=admin_blacklist');
	}
	
}
?>
