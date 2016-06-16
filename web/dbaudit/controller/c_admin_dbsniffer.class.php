<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_dbsniffer extends c_base {
	function index(){
		$this->dbsniffer_list();
	}
	
	function dbsniffer_list(){
		$page_num = get_request('page');
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'ip';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = '1=1';
		$row_num = $this->dbsniffer_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$s = $this->dbsniffer_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2);
		$this->assign('title', language('来源IP列表'));
		$this->assign('s', $s);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('dbsniffer_list.tpl');
	}
	
	function dbsniffer_edit(){
		$id = get_request("id");
		$sip = $this->dbsniffer_set->select_by_id($id);
		$this->assign("title", language('添加来源IP组'));
		$this->assign("dbsniffer", $sip);
		$this->display('dbsniffer_edit.tpl');
	}

	function dbsniffer_save(){
		$id = get_request("id");
		$ip = get_request("ip", 1, 1);
		$hostname = get_request("hostname", 1, 1);
		$interface = get_request("interface", 1, 1);
		$status = get_request("status", 1, 1);
		$record = get_request("record", 1, 1);
		$desc = get_request("desc", 1, 1);
		if(empty($hostname)){
			alert_and_back('请填写名称');
			exit;
		}
		$allgp = $this->dbsniffer_set->select_all('hostname="'.$hostname.'" and id!='.$id);
		if(!empty($allgp)){
			alert_and_back('该名称已经存在');
			exit;
		}
		$dbsniffer = new dbsniffer();
		$dbsniffer->set_data('ip', $ip);
		$dbsniffer->set_data('hostname', $hostname);
		$dbsniffer->set_data('interface', $interface);
		$dbsniffer->set_data('status', $status);
		$dbsniffer->set_data('record', $record);
		$dbsniffer->set_data('desc', empty($desc)?'':$desc);
		if($id){
			$dbsniffer->set_data("id", $id);
			$this->dbsniffer_set->edit($dbsniffer);
			//记录日志
			$adminlog = new admin_log();
			$adminlog->set_data('resource', '探针-'.$ip);
			$adminlog->set_data('action', '修改');
			$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
			$this->admin_log_set->add($adminlog);	
			alert_and_back('修改成功','admin.php?controller=admin_dbsniffer');
			exit;
		}
		$this->dbsniffer_set->add($dbsniffer);
		//记录日志
		$adminlog = new admin_log();
		$adminlog->set_data('resource', '探针-'.$ip);
		$adminlog->set_data('action', '增加');
		$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
		$this->admin_log_set->add($adminlog);	
		alert_and_back('操作成功','admin.php?controller=admin_dbsniffer');
	}

	function dbsniffer_delete(){
		$id = get_request("id");
		
		$this->dbsniffer_set->delete($id);
		alert_and_back('删除成功','admin.php?controller=admin_dbsniffer');
	}
	
}
?>
