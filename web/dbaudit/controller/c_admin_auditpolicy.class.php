<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_auditpolicy extends c_base {
	function index(){
		
		
		$this->auditpolicy_list();
	}
	function auditpolicy_list() {
		$page_num = get_request('page');
		$add = get_request('add', 1,1);
		$optionsname = get_request('optionsname', 1,1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		
		$dbtype = get_request('dbtype', 0, 1);
		
		
		if(empty($dbtype)){
			
			$dbtype = 'oracle';
		
		}
		if(empty($orderby1)){
			$orderby1 = 'policy_order';
		}
		if(strcasecmp($orderby2, 'asc') != 0 ) {
			$orderby2 = 'asc';
		}else{
			$orderby2 = 'desc';
		}
		$this->assign("orderby2", $orderby2);
		
		
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());

		$row_num = $this->auditpolicy_set->select_count();
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('command_num', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);		
		$allcommand =  $this->auditpolicy_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, "1=1", $orderby1, $orderby2);
		$this->assign("allcommand",$allcommand);
		
		$this->assign('dbtype', $dbtype);			
		
		$this->assign("page_nav_tabs_selected", 'c_admin_auditpolicy_'.$dbtype);
		$this->display("auditpolicy_list.tpl");
	}
	
	function auditpolicy_edit(){
		$id = get_request("id");
		
		$dbtype = get_request('dbtype', 0, 1);
		
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());
		$this->auditpolicy_sqloptions_set->set_table_name($dbtype.'_'.$this->auditpolicy_sqloptions_set->get_table_name());
		$auditpolicy = $this->auditpolicy_set->select_by_id($id);
		
		//$this->sqloptions_set->set_table_name($dbtype.'_'.$this->sqloptions_set->get_table_name());
		$sqloptions = $this->sqloptions_set->select_all("id IN(SELECT sqlopt_id FROM ".$this->auditpolicy_sqloptions_set->get_table_name()." WHERE db_policy_id='$id')");

		$sqloptions_grp = $this->sqloptions_group_set->select_all();
		for($i=0; $i<count($sqloptions_grp); $i++){
			for($j=0; $j<count($sqloptions); $j++){
				if($sqloptions_grp[$i]['optionsname']==$sqloptions[$j]['optionsname']){
					$sqloptions_grp[$i]['check']='checked';
					break;
				}
			}
		}
		$this->auditpolicy_ipgroup_set->set_table_name($dbtype.'_'.$this->auditpolicy_ipgroup_set->get_table_name());
		$auditipgroup = $this->auditpolicy_ipgroup_set->select_all('db_policy_id='.$id);	
		$ipgroup = $this->ipgroup_desc_set->select_all();
		for($i=0; $i<count($ipgroup); $i++){
			for($j=0; $j<count($auditipgroup); $j++){
				if($ipgroup[$i]['id']==$auditipgroup[$j]['trust_ipgroup']){
					$ipgroup[$i]['check']='checked';
					break;
				}
			}
		}
		if($auditpolicy['success']===null){
			$auditpolicy['success']='-1';
		}
		$allpolicies = $this->auditpolicy_set->select_all("id!=$id", "policy_order", "ASC");
		$this->assign("allpolicies", $allpolicies);
		$this->assign("allpolicies_ct", count($allpolicies));
		$this->assign("auditpolicy", $auditpolicy);
		$this->assign("sqloptions", $sqloptions_grp);
		$this->assign("ipgroup", $ipgroup);
		
		$this->assign("dbtype", $dbtype);
		
		$this->assign("page_nav_tabs_selected", 'c_admin_auditpolicy_'.$dbtype);
		$this->display("auditpolicy_edit.tpl");
	}

	function auditpolicy_save(){
		$add = get_request('add', 1,1);
		$id = get_request('id');
		$name = get_request('name', 1,1);
		$policy_order = get_request('policy_order', 1,0);
		$systemuser = get_request('systemuser', 1,1);
		$dbuser = get_request('dbuser', 1,1);
		$sourcemac = get_request('sourcemac', 1,1);
		$replyinfo = get_request('replyinfo', 1,1);
		$enable  = get_request('enable', 1,0);
		
		$mail  = get_request('mail', 1,0);
	
		$syslog  = get_request('syslog', 1,0);
		$server_ipgroup = get_request('server_ipgroup', 1,0);
		$client_ipgroup = get_request('client_ipgroup', 1,0); 
		$success = get_request('success', 1,0);
		$return_line_number = get_request('return_line_number', 1,0);
		$result_title = get_request('result_title', 1,1);
		$result_content = get_request('result_content', 1,1);
		$level = get_request('level', 1,0);
		
		$dbtype = get_request('dbtype', 0, 1);
		
		if(empty($dbtype)){
			
			alert_and_back('系统错误');
			
			exit;
		
		}
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());
		
		$this->auditpolicy_sqloptions_set->set_table_name($dbtype.'_'.$this->auditpolicy_sqloptions_set->get_table_name());
		$this->auditpolicy_ipgroup_set->set_table_name($dbtype.'_'.$this->auditpolicy_ipgroup_set->get_table_name());
		
		if(empty($name)){
			alert_and_back('请输入名称');
			exit;	
		}
		$a = $this->auditpolicy_set->select_all("name='".$name."' and id!='$id'");
		if(!empty($a[0])){
			alert_and_back('名称已经存在');
			exit;
		}
		$old = $this->auditpolicy_set->select_by_id($id);
		if($old){
			if($policy_order < $old['policy_order']-1){
				$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order+1 WHERE policy_order>".$policy_order." AND policy_order <".$old['policy_order']);
				$policy_order=$policy_order+1;
			}elseif($policy_order != $old['policy_order']-1){
				$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order-1 WHERE policy_order<=".$policy_order."  AND policy_order >".$old['policy_order']);
				$policy_order=$policy_order;
			}else{
				$policy_order=$policy_order+1;
			}
			
		}else{
			$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order+1 WHERE policy_order>".$policy_order);
			$policy_order=$policy_order+1;
		}
		$auditpolicy = new auditpolicy();
		$auditpolicy->set_data('name', $name);
		$auditpolicy->set_data('enable', $enable );
		
		$auditpolicy->set_data('mail', $mail );
		
		$auditpolicy->set_data('syslog', $syslog );
	
		if($dbtype == 'oracle'){
			$auditpolicy->set_data('systemuser', empty($systemuser) ? null : $systemuser );
			
			$auditpolicy->set_data('return_line_number', empty($return_line_number) ? null : $return_line_number );
		
			$auditpolicy->set_data('result_title', $result_title );
			$auditpolicy->set_data('result_content', $result_content );
			$auditpolicy->set_data('replyinfo', empty($replyinfo) ? null : $replyinfo );
	
		}
		$auditpolicy->set_data('dbuser', empty($dbuser) ? null : $dbuser );
		$auditpolicy->set_data('sourcemac', empty($sourcemac) ? null : $sourcemac );
		$auditpolicy->set_data('server_ipgroup', empty($server_ipgroup) ? null : $server_ipgroup );
		$auditpolicy->set_data('client_ipgroup', empty($client_ipgroup) ? null : $client_ipgroup );
		$auditpolicy->set_data('success', $success=='-1' ? null : $success );
		$auditpolicy->set_data('level', $level );
		$auditpolicy->set_data('policy_order', $policy_order);
		if($id){
			
			$auditpolicy->set_data('id', $id);
			$this->auditpolicy_set->edit($auditpolicy);
			//记录日志
			$adminlog = new admin_log();
			$adminlog->set_data('resource', '审计规则-'.$name);
			$adminlog->set_data('action', '编辑');
			$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
			$this->admin_log_set->add($adminlog);	
		}else{
			$this->auditpolicy_set->add($auditpolicy);
			$id = mysql_insert_id();				
			//记录日志
			$adminlog = new admin_log();
			$adminlog->set_data('resource', '审计规则-'.$name);
			$adminlog->set_data('action', language('增加'));
			$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
			$this->admin_log_set->add($adminlog);	
		}
		if($_POST['auditsqloptions']){
			$insert_sqloption = "INSERT INTO ".$this->auditpolicy_sqloptions_set->get_table_name()." (db_policy_id, sqlopt_id) VALUES";
			$sqloptions = $this->sqloptions_set->select_all("optionsname IN(SELECT optionsname FROM ".$this->sqloptions_group_set->get_table_name()." WHERE id IN(".implode(',',$_POST['auditsqloptions'])."))");
			for($i=0; $i<count($sqloptions); $i++){
				$insert_sqloption .= "(".$id.",".$sqloptions[$i]['id']."),";
			}
		}
		$this->auditpolicy_sqloptions_set->delete_all(" db_policy_id='$id'");

		if(count($sqloptions)){
			$this->auditpolicy_sqloptions_set->query(substr($insert_sqloption, 0, strlen($insert_sqloption)-1));
		}
		$insert_ipgroup = "INSERT INTO ".$this->auditpolicy_ipgroup_set->get_table_name()." (db_policy_id, trust_ipgroup) VALUES";
		for($i=0; $i<count($_POST['trustipgroup']); $i++){
			$insert_ipgroup .= "(".$id.",".$_POST['trustipgroup'][$i]."),";
		}
		$this->auditpolicy_ipgroup_set->delete_all(" db_policy_id='$id'");
		if(count($_POST['trustipgroup'])){
			$this->auditpolicy_ipgroup_set->query(substr($insert_ipgroup, 0, strlen($insert_ipgroup)-1));
		}
		
		alert_and_back('操作成功','admin.php?controller=admin_auditpolicy&action=auditpolicy_list&dbtype='.$dbtype);
		exit;
	
	}

	function del_auditpolicy() {
		$id = get_request('id');
		$gid = get_request('gid',0,1);
		
		$dbtype = get_request('dbtype', 0, 1);
		
		if(empty($dbtype)){
			
			alert_and_back('系统错误');
			
			exit;
		
		}
		
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());
	
		$this->sqloptions_set->set_table_name($dbtype.'_'.$this->sqloptions_set->get_table_name());
		if($_POST['chk_gid']){			
			for($i=0; $i<count($_POST['chk_gid']);$i++){
				$old = $this->auditpolicy_set->select_by_id($_POST['chk_gid'][$i]);
				$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order-1 WHERE policy_order>".$old['policy_order']);
			}
			$this->auditpolicy_set->delete($_POST['chk_gid']);
			$this->auditpolicy_ipgroup_set->delete_all("db_policy_id IN(".implode(',', $_POST['chk_gid']).")");
			$this->auditpolicy_sqloptions_set->delete_all("db_policy_id IN(".implode(',', $_POST['chk_gid']).")");
		}else{
			$old = $this->auditpolicy_set->select_by_id($id);
			$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order-1 WHERE policy_order>".$old['policy_order']);
			$this->auditpolicy_set->delete($id);
			$this->auditpolicy_ipgroup_set->delete_all("db_policy_id IN($id)");
			$this->auditpolicy_sqloptions_set->delete_all("db_policy_id IN($id)");
		}
		alert_and_back('操作成功', 'admin.php?controller=admin_auditpolicy&dbtype='.$dbtype);
		exit;
	}

	function setorder(){
		$id = get_request('id');
		
		$dbtype = get_request('dbtype', 0, 1);
		
		if(empty($dbtype)){
			
			alert_and_back('系统错误');
			
			exit;
		
		}
		
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());
	
		$this->sqloptions_set->set_table_name($dbtype.'_'.$this->sqloptions_set->get_table_name());
		$auditpolicy = $this->auditpolicy_set->select_by_id($id);
		$allpolicies = $this->auditpolicy_set->select_all("id!=$id", "policy_order", "ASC");
		$this->assign("allpolicies", $allpolicies);
		$this->assign("allpolicies_ct", count($allpolicies));
		$this->assign("auditpolicy", $auditpolicy);
		$this->assign("dbtype", $dbtype);
		$this->display("auditpolicy_order.tpl");
	}

	function setorder_save(){
		$id = get_request('id');
		$policy_order = get_request('policy_order', 1,0);
		
		$dbtype = get_request('dbtype', 0, 1);
		
		if(empty($dbtype)){
		
			alert_and_back('系统错误');
			
			exit;
		
		}
		
		$this->auditpolicy_set->set_table_name($dbtype.'_'.$this->auditpolicy_set->get_table_name());

		$this->sqloptions_set->set_table_name($dbtype.'_'.$this->sqloptions_set->get_table_name());
		$old = $this->auditpolicy_set->select_by_id($id);
		if($old){
			
			if($policy_order < $old['policy_order']-1){
				$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order+1 WHERE policy_order>".$policy_order." AND policy_order <".intval($old['policy_order']));
				$policy_order=$policy_order+1;
			}elseif($policy_order != $old['policy_order']-1){
				$this->auditpolicy_set->query("UPDATE ".$this->auditpolicy_set->get_table_name()." SET policy_order=policy_order-1 WHERE policy_order<=".$policy_order."  AND policy_order >".intval($old['policy_order']));
				$policy_order=$policy_order;
			}else{
				$policy_order=$policy_order+1;
			}
			$auditpolicy = new auditpolicy();
			$auditpolicy->set_data('policy_order', $policy_order);
			$auditpolicy->set_data('id', $id);
			$this->auditpolicy_set->edit($auditpolicy);
			echo '<script>  window.opener.location.reload();</script>';
			alert_and_close('操作成功','admin.php?controller=admin_auditpolicy&action=auditpolicy_list&dbtype='.$dbtype);
		}
		exit;
	
	}
	
}
?>
