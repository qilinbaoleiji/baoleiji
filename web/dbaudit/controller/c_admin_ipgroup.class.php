<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_ipgroup extends c_base {
	function index(){
		$page_num = get_request('page');
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'description';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = '1=1';
		$row_num = $this->ipgroup_desc_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$s = $this->ipgroup_desc_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2);
		$this->assign('title', language('来源IP列表'));
		$this->assign('s', $s);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('ipgroup.tpl');
	}
	
	function ipgroup_list(){
		$page_num = get_request('page');
		$groupid = get_request('groupid', 0, 1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		$groupid = get_request("groupid");
		if(empty($orderby1)){
			$orderby1 = 'id';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = ' group_id='.$groupid;
		$row_num = $this->ipgroup_set->select_count($where);
		$groupinfo = $this->ipgroup_desc_set->select_by_id($groupid);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$s = $this->ipgroup_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where, $orderby1, $orderby2);
		$this->assign('title', language('来源IP列表'));
		$this->assign('s', $s);
		$this->assign("groupid", $groupid);
		$this->assign("groupinfo", $groupinfo);
		$this->assign("description", $description);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('ipgroup_list.tpl');
	}
	
	function ipgroup_edit(){
		$id = get_request("id");
		$sip = $this->ipgroup_desc_set->select_by_id($id);
		$this->assign("title", language('添加来源IP组'));
		$this->assign("sip", $sip);
		$this->display('ipgroup_edit.tpl');
	}

	function ipgroup_ip_edit(){
		$id = get_request("id");
		$groupid = get_request("groupid");
		$sip = $this->ipgroup_set->select_by_id($id);
		$this->assign("title", language('添加来源IP组'));
		$this->assign("sip", $sip);
		$this->assign("groupid", $groupid);
		$this->display('ipgroup_ip_edit.tpl');
	}
	
	function ipgroup_delete(){
		$id = get_request("id");
		$binded_audit = $this->auditpolicy_set->select_all("id IN(SELECT db_policy_id FROM ".$this->auditpolicy_ipgroup_set->get_table_name()." WHERE trust_ipgroup IN($id))");
		for($i=0; $i<count($binded_audit); $i++){
			$already_[] = $binded_audit[$i]['name'];
		}
		if($already_){
			alert_and_back('删除失败,已经绑定了如下审计规则，请先删除：\n'.implode(',', $already_));
			exit;
		}
		$this->ipgroup_desc_set->delete($id);
		alert_and_back('删除成功','admin.php?controller=admin_ipgroup');
	}
	
	function ipgrouplist_delete(){
		$id = get_request("id");
		$sip = $this->ipgroup_set->select_by_id($id);
		$this->ipgroup_set->delete($id);
		alert_and_back('删除成功','admin.php?controller=admin_ipgroup&action=ipgroup_list&groupid='.$sip['group_id']);
	}
	
	function ipgrouplist_save(){
		$id = get_request("id", 0, 1);
		$ip = get_request("ip", 1, 1);
		$netmask = get_request("netmask", 1, 1);
		$groupid = get_request("groupid", 1, 1);
		if(empty($groupid)&&empty($id)){
			alert_and_back('系统错误,请重新打开');
			exit;
		}
		//$iparr = explode('/', $ip);
		if(!is_ip($ip)){
			alert_and_back('请输入正确的ip');
			exit;
		}
		$ipgroup = new ipgroup();
		$ipgroup->set_data('ip', $ip);
		$ipgroup->set_data('netmask', $netmask);
		$ipgroup->set_data('group_id', $groupid);
		if(empty($id)){
			$this->ipgroup_set->add($ipgroup);
		}else{
			$ipgroup->set_data('id', $id);
			$this->ipgroup_set->edit($ipgroup);
		}
		
		alert_and_back('操作成功','admin.php?controller=admin_ipgroup&action=ipgroup_list&groupid='.$groupid);
	}
	
	function ipgroup_save(){
		$id = get_request("id");
		$description = get_request("description", 1, 1);
		$descr = get_request("descr", 1, 1);
		if(empty($description)){
			alert_and_back('请填写组名');
			exit;
		}
		$allgp = $this->ipgroup_desc_set->select_all('description="'.$description.'" and id!='.$id);
		if(!empty($allgp)){
			alert_and_back('该组名已经存在');
			exit;
		}
		$ipgroup = new ipgroup_desc();
		$ipgroup->set_data('description', $description);
		$ipgroup->set_data('descr', $descr);
		if($id){
			$ipgroup->set_data("id", $id);
			$this->ipgroup_desc_set->edit($ipgroup);
			alert_and_back('修改成功');
			exit;
		}
		$this->ipgroup_desc_set->add($ipgroup);
		alert_and_back('操作成功','admin.php?controller=admin_ipgroup');
	}
}
?>
