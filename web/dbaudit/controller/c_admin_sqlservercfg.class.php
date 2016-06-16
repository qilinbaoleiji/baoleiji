<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}


class c_admin_sqlservercfg extends c_base {
	function index(){
		$this->sqlserver_list();
	}
	function sqlserver_list() {
		global $_CONFIG;
		$file = $_CONFIG['SQLSERVER_CONFIGFILE'];
		$page_num = get_request('page');
		$add = get_request('add', 1,1);
		$optionsname = get_request('optionsname', 1,1);
		$orderby1 = get_request('orderby1', 0, 1);
		$orderby2 = get_request('orderby2', 0, 1);
		if(empty($orderby1)){
			$orderby1 = 'id';
		}
		if(strcasecmp($orderby2, 'desc') != 0 ) {
			$orderby2 = 'desc';
		}else{
			$orderby2 = 'asc';
		}
		$this->assign("orderby2", $orderby2);
		$lines = @file($file);
		$servers = array();
		$j=-1;
		for($i=0; $i<count($lines); $i++){
			if(preg_match('/^\[[a-zA-Z]+\]$/', $lines[$i], $matches)){
				$j++;
				$name = $matches[0];
				
			}elseif(preg_match('/Server/', $lines[$i], $matches)){
				$matches2=preg_split('/=/', $lines[$i]);
				$users = $this->sqlserver_login_template_set->select_all("server='".trim($matches2[1])."'");
				$servers[$j]['name']=trim($users[0]['name']);
				$servers[$j]['id']=trim($users[0]['id']);
				$servers[$j]['server']=trim($matches2[1]);
				$servers[$j]['username']=trim($users[0]['username']);
			}			
		}

		$row_num = count($servers);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('command_num', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);

		$this->assign("servers",$servers);

		$this->display("sqlservercfg_list.tpl");
	}
	
	function sqlserver_edit(){
		$server = get_request("server", 0, 1);
		$users = $this->sqlserver_login_template_set->select_all("server='".trim($server)."'");
		$this->assign("users", $users[0]);
		$this->display("sqlserver_edit.tpl");
	}

	function sqlserver_save(){
		global $_CONFIG;
		$file = $_CONFIG['SQLSERVER_CONFIGFILE'];
		$id = get_request('id');
		$name = get_request('name', 1,1);
		$server = get_request('server', 1,1);
		$username = get_request('username', 1,1);
		$password = get_request('password', 1,1);
		$repassword = get_request('repassword', 1,1);
		
		if($password!=$repassword){
			alert_and_back('两次输入的密码不正确');
			exit;
		}elseif(!preg_match('/^[a-zA-Z]+$/', $name)){
			alert_and_back('名称中不能包含非字母');
			exit;
		}elseif(($e=$this->sqlserver_login_template_set->select_all("server='$server' and id!=$id"))!=null){
			alert_and_back('ip已经存在');
			exit;
		}
		$sqlserver_login_template = new sqlserver_login_template();
		$sqlserver_login_template->set_data('username', $username );
		$sqlserver_login_template->set_data('password', $password );
		if($id){
			$sqlserver_login_template->set_data('id', $id );
			$this->sqlserver_login_template_set->edit($sqlserver_login_template);
		}else{
			$sqlserver_login_template->set_data('name', $name );
			$sqlserver_login_template->set_data('server', $server );
			$this->sqlserver_login_template_set->add($sqlserver_login_template);
			$lines = @file($file);
			$servers = array();
			$j=0;
			for($i=0; $i<count($lines); $i++){
				if(preg_match('/^\['.$name.'+\]$/', $lines[$i], $matches)){
					$j++;					
				}		
			}
			if($j==0){
				$lines[]='['.$name.']'."\n";
				$lines[]='Driver = TDS'."\n";
				$lines[]='Server = '.$server.''."\n";
				$lines[]='Database = master'."\n";
				$lines[]='Port = 1433'."\n";
				$lines[]='TDS_Version =8.0'."\n";
				$lines[]='Socket ='."\n";
				$lines[]='Option ='."\n";
				$lines[]='Stmt ='."\n";
				$lines[]='UserID ='."\n";
				$lines[]='Password ='."\n";
			}
			$this->Array2File($lines, $file);
		}
		
		alert_and_back('操作成功','admin.php?controller=admin_sqlservercfg&action=sqlserver_list');
		exit;
	
	}

	function del_server_from_file($name){
		global $_CONFIG;
		$file = $_CONFIG['SQLSERVER_CONFIGFILE'];
		$lines = @file($file);
		$servers = array();
		$j=0;
		for($i=0; $i<count($lines); $i++){
			if(preg_match('/^\[[a-zA-Z]+\]$/', $lines[$i], $matches)){
				
				if('['.$name.']' == trim($matches[0])){
					$j=1;
				}else{
					$servers[]=$lines[$i];
					$j=0;
				}
			}else{
				if($j==0){
					$servers[]=$lines[$i];
				}else{
					continue;
				}
			}
		}
		//exit;
		$this->Array2File($servers, $file);
	}

	function del_sqlserver() {
		$id = get_request('id');
		if($_POST['chk_gid']){			
			for($i=0; $i<count($_POST['chk_gid']); $i++){
				$users = $this->sqlserver_login_template_set->select_by_id($_POST['chk_gid'][$i]);
				$this->del_server_from_file($users['name']);
			}
			$this->sqlserver_login_template_set->delete($_POST['chk_gid']);
		}else{
			$users = $this->sqlserver_login_template_set->select_by_id($id);
			$this->del_server_from_file($users['name']);
			$this->sqlserver_login_template_set->delete($id);
		}
		alert_and_back('操作成功');
			exit;
	}

	function String2File($sIn, $sFileOut) {
	  $rc = false;
	  do {
	   if (!($f = @fopen($sFileOut, "wa+"))) {
	     $rc = 1; 
	     alert_and_back('打开文件失败,请检查文件权限');
	     break;
	   }
	   if (!@fwrite($f, $sIn)) {
	     $rc = 2; 
	     alert_and_back('打开文件失败,请检查文件权限');
	     break;
	   }
	   $rc = true;
	  } while (0);
	  if ($f) {
	   fclose($f);
	  }
	  return ($rc);
	}

	function Array2File($aIn, $sFileOut) {
	  return ($this->String2File(implode("", $aIn), $sFileOut));
	}
}
?>
