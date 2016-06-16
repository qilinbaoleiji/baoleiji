<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_dbserver extends c_base {
	function index(){
		$this->dbserver_list();
	}
	
	function dbserver_list(){
		$page_num = get_request('page');
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'ip_addr';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = '1=1';
		$row_num = $this->dbserver_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$s = $this->dbserver_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2);
		$this->assign('title', language('来源IP列表'));
		$this->assign('s', $s);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('dbserver_list.tpl');
	}
	
	function dbserver_edit(){
		$id = get_request("id");
		$sip = $this->dbserver_set->select_by_id($id);
		$this->assign("title", language('添加来源IP组'));
		$this->assign("dbserver", $sip);
		$this->display('dbserver_edit.tpl');
	}

	function dbserver_save(){
		$id = get_request("id");
		$ip = get_request("ip_addr", 1, 1);
		$hostname = get_request("hostname", 1, 1);
		$dbtype = get_request("dbtype", 1, 1);
		$desc = get_request("desc", 1, 1);
		if(empty($ip)){
			alert_and_back('请填写IP');
			exit;
		}
		$allgp = $this->dbserver_set->select_all('ip_addr="'.$ip.'" and id!='.$id);
		if(!empty($allgp)){
			alert_and_back('该IP已经存在');
			exit;
		}
		$dbserver = new dbserver();
		$dbserver->set_data('ip_addr', $ip);
		$dbserver->set_data('hostname', $hostname);
		$dbserver->set_data('dbtype', $dbtype);
		$dbserver->set_data('desc', $desc);
		if($id){
			$dbserver->set_data("id", $id);
			$this->dbserver_set->edit($dbserver);
			alert_and_back('修改成功','admin.php?controller=admin_dbserver');
			exit;
		}
		$this->dbserver_set->add($dbserver);
		alert_and_back('操作成功','admin.php?controller=admin_dbserver');
	}

	function dbserver_delete(){
		$id = get_request("id");
		
		$this->dbserver_set->delete($id);
		alert_and_back('删除成功','admin.php?controller=admin_dbserver');
	}
	
}
?>
