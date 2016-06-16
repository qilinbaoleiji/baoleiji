<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_sqloptions extends c_base {
	function index(){
		$this->sqloptions_list();
	}
	function sqloptions_list() {
		$page_num = get_request('page');
		$add = get_request('add', 1,1);
		$optionsname = get_request('optionsname', 1,1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'optionsname';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);		
		
		$row_num = $this->sqloptions_group_set->select_count();
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('command_num', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		
		$allcommand =  $this->sqloptions_group_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, "1=1", $orderby1, $orderby2);

		$this->assign("allcommand",$allcommand);

		$this->display("sqloptions_list.tpl");
	}
	
	function sqloptions_edit(){
		$id = get_request("id", 0, 1);
		$sqloptions = $this->sqloptions_group_set->select_by_id($id);
		$this->assign("sqloptions", $sqloptions);
		$this->display("sqloptions_edit.tpl");
	}

	function sqloptions_save(){
		$add = get_request('add', 1,1);
		$id = get_request('id', 1,1);
		$optionsname = get_request('optionsname', 1,1);
		$sql_cmd = get_request('sql_cmd', 1,1);
		$desc = get_request('desc', 1,1);
		if($add == 'new'){
			if(empty($optionsname)){
				alert_and_back('请输入名称');
				exit;	
			}
			$a = $this->sqloptions_group_set->select_all("optionsname='".$optionsname."' and id!='$id'");
			if(!empty($a[0])){
				alert_and_back('名称已经存在');
				exit;
			}
			$sqloptions_group = new sqloptions_group();
			$sqloptions_group->set_data('optionsname', $optionsname);
			$sqloptions_group->set_data('desc', $desc);
			if($id){
				$sqloptions_group->set_data('id', $id);
				$this->sqloptions_group_set->edit($sqloptions_group);
			}else{
				$this->sqloptions_group_set->add($sqloptions_group);
			}
			alert_and_back('操作成功','admin.php?controller=admin_sqloptions&action=sqloptions_list');
			exit;
		}
	}

	function del_sqloptions() {
		$id = get_request('id');
		$gid = get_request('gid',0,1);
		
		if($_POST['chk_gid']){
			$binded_audit = $this->auditpolicy_set->select_all("id IN(SELECT db_policy_id FROM ".$this->auditpolicy_sqloptions_set->get_table_name()." WHERE sqlopt_id IN(SELECT id FROM ".$this->sqloptions_set->get_table_name()." WHERE optionsname IN(SELECT optionsname FROM ".$this->sqloptions_group_set->get_table_name()." WHERE id IN( ".implode(',', $_POST['chk_gid'])."))))");
			for($i=0; $i<count($binded_audit); $i++){
				$already_[] = $binded_audit[$i]['name'];
			}
			if($already_){
				alert_and_back('删除失败,已经绑定了如下审计规则，请先删除：\n'.implode(',', $already_));
				exit;
			}
			$names = $this->sqloptions_group_set->select_all("id IN(".implode(',', $_POST['chk_gid']).")");
			$arr_name = Array();
			for($i=0; $i<count($names); $i++){
				$arr_name[]="'".$names[$i]['optionsname']."'";
			}
			$this->sqloptions_set->delete_all("optionsname IN(".implode(',', $arr_name).")");
			$this->sqloptions_group_set->delete($_POST['chk_gid']);
		}else{
			$binded_audit = $this->auditpolicy_set->select_all("id IN(SELECT db_policy_id FROM ".$this->auditpolicy_sqloptions_set->get_table_name()." WHERE sqlopt_id IN(SELECT id FROM ".$this->sqloptions_set->get_table_name()." WHERE optionsname IN(SELECT optionsname FROM ".$this->sqloptions_group_set->get_table_name()." WHERE id IN( $id ))))");
			for($i=0; $i<count($binded_audit); $i++){
				$already_[] = $binded_audit[$i]['name'];
			}
			if($already_){
				alert_and_back('删除失败,已经绑定了如下审计规则，请先删除：\n'.implode(',', $already_));
				exit;
			}
			$_info = $this->sqloptions_set->select_by_id($id);
			$this->sqloptions_set->delete_all("optionsname ='".$_info['optionsname']."'");
			$this->sqloptions_group_set->delete($id);
		}
		alert_and_back('操作成功');
			exit;
	}

	function del_sqloptions_cmd() {
		$id = get_request('id');
		if(empty($id)){
			$id = $_POST['chk_member'];
		}
		$this->sqloptions_set->delete($id);
		alert_and_back('操作成功');

	}


	function sqloptions_cmd() {
		$page_num = get_request('page');
		$optionsname = get_request('optionsname',0,1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'sql_cmd';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$where = "1 = 1 AND optionsname='".$optionsname."' and sql_cmd!=''";
		$row_num = $this->sqloptions_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('command_num', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->assign("gid", $gid);
		
		$allcommand =  $this->sqloptions_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,"$where", $orderby1, $orderby2);

		$this->assign("allcommand",$allcommand);
		$this->assign("optionsname",$optionsname);
		$this->display("sqloptions_cmd.tpl");
	}

	function sqloptions_cmd_edit(){
		$optionsname = get_request('optionsname',0,1);
		$this->assign("optionsname", $optionsname);
		$this->display("sqloptions_cmd_edit.tpl");
	}

	function sqloptions_cmd_save(){
		$add = get_request('add', 1,1);
		$level = get_request('level', 1,1);
		$optionsname = get_request('optionsname', 0,1);
		//$commands = get_request('commands', 1,1);		
		if($add == 'new'){
			for($i=0; $i<count($_POST['commands']); $i++){
				if($_POST['commands'][$i]==""){
					continue;
					exit;
				}
				$sqloptions = new sqloptions();
				$sqloptions->set_data('sql_cmd', $_POST['commands'][$i]);
				$sqloptions->set_data('optionsname', $optionsname);
				$this->sqloptions_set->add($sqloptions);
				$sqloptions = null;
			}
			alert_and_back('操作成功','admin.php?controller=admin_sqloptions&action=sqloptions_cmd&optionsname='.$optionsname);
			
		}
	}
}
?>
