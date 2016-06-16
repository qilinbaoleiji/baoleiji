<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_sysmanage extends c_base {

	function index() {
		$this->serverstatus();
	}

	function serverstatus(){
		$sname = get_request("sname", 0, 1);
		$action = get_request("ac", 0, 1);
		$serverArr = array(
						array('name'=>'vpn','sname'=>'vpn'),
						//array('name'=>'telnet','sname'=>'tcpproxy'),						
						array('name'=>'ftp','sname'=>'ftp-audit'),
						array('name'=>'ssh','sname'=>'ssh-audit'),
						array('name'=>'rdp','sname'=>'Freesvr_RDP'),
						array('name'=>'authd','sname'=>'freesvr-authd'),
						array('name'=>'radius','sname'=>'radiusd'),
						array('name'=>'monitor','sname'=>'Freesvr_MONITOR'),
						array('name'=>'play','sname'=>'Freesvr_PLAY'),
						array('name'=>'db-audit','sname'=>'tcpreassembly')
					);
		if($sname && $action){
			if(!in_array($action,array('restart','start','stop'))){
				alert_and_back('没有此命令','admin.php?controller=admin_eth&action=serverstatus');
				exit;
			}
			if(!in_array($sname,array('vpn','tcpproxy','ftp-audit','ssh-audit','Freesvr_RDP','Freesvr_PLAY','freesvr-authd','radiusd','Freesvr_MONITOR','tcpreassembly'))){
				alert_and_back('没有此服务','admin.php?controller=admin_eth&action=serverstatus');
				exit;
			}
			if($action!='restart'){
				$cmd= 'sudo  /opt/freesvr/audit/sbin/manageprocess '.$sname.' '.$action;
			}else{
				$cmd= 'sudo  /opt/freesvr/audit/sbin/manageprocess '.$sname.' stop';
				$cmd= 'sudo  /opt/freesvr/audit/sbin/manageprocess '.$sname.' start';
			}
			//echo '<br >';
			exec($cmd, $out1,$return);
			$cmd = 'sudo  /opt/freesvr/audit/sbin/manageprocess '.$sname.' status';
			system($cmd, $out2);
			if((($action=='start' || $action=='restart' )&&$out2==0 )|| ($action=='stop'&&$out2==255)){
				alert_and_back('修改成功','admin.php?controller=admin_eth&action=serverstatus');
			}else{
				alert_and_back('修改失败','admin.php?controller=admin_eth&action=serverstatus');
			}
			exit;
		}
		$versions = $this->version_set->select_all('1=1');
		for($i=0; $i<count($versions); $i++){
			$versionarr[strtolower($versions[$i]['service'])]=$versions[$i];
		}
		//echo '<pre>';print_r($versionarr);echo '</pre>';
		for($i=0; $i<count($serverArr); $i++){
			//echo $serverArr[$i]['name'];
			$cmd = 'sudo  /opt/freesvr/audit/sbin/manageprocess '.$serverArr[$i]['sname'].' status';
			system($cmd, $out2);
			//echo $versionarr[$serverArr[$i]['sname']]['version'];
			$serverArr[$i]['version']=$versionarr[$serverArr[$i]['name']]['version'];
			$serverArr[$i]['start']=$versionarr[$serverArr[$i]['name']]['start'];
			//var_dump($out2);
			switch ($out2){
				case 0:
					$serverArr[$i]['status'] = 1;
					break;
				case 255:
					$serverArr[$i]['status'] = 0;
					break;
				default:
					$serverArr[$i]['status'] = 0;
					break;
			}
			
		}
		
		$this->assign("allcommand", $serverArr);
		$this->assign("page_nav_tabs_selected", "serverstatus");
		$this->display("serverstatus.tpl");
	}
	
	function upgradeServerStatus(){
		$versions = $this->version_set->select_all('1=1');
		for($i=0; $i<count($versions); $i++){
			$versionarr[strtolower($versions[$i]['service'])]=$versions[$i];
		}
		$this->assign("version", $versionarr);
		$this->assign("page_nav_tabs_selected", "upgradeServerStatus");
		$this->display("upgradeserver.tpl");		
	}
	
	function upgradeServerStatusSave(){
		//print_r($_FILES);
		$stype = get_request("stype", 1, 1);
		$serverArr = array(
						array('name'=>'vpn','sname'=>'vpn'),
						array('name'=>'telnet','sname'=>'tcpproxy'),
						array('name'=>'ftp','sname'=>'ftp-audit'),
						array('name'=>'ssh','sname'=>'ssh-audit'),
						array('name'=>'rdp','sname'=>'Freesvr_RDP'),
						array('name'=>'authd','sname'=>'freesvr-authd'),
						array('name'=>'radius','sname'=>'radiusd'),
						array('name'=>'monitor','sname'=>'Freesvr_MONITOR'),
						array('name'=>'play','sname'=>'Freesvr_PLAY')
					);
		if($_FILES['file']['error']==1 or $_FILES['file']['error']==2){
			alert_and_back("上传得文件超过系统限制", 'admin.php?controller=admin_eth&action=upgradeServerStatus');
			exit;
		}
		if(!is_uploaded_file($_FILES['file']['tmp_name']))
		{
			alert_and_back("请上传文件", 'admin.php?controller=admin_eth&action=upgradeServerStatus');
			exit;
		}
		//var_dump(is_dir('/opt/freesvr/audit/update'));
		if(!is_dir('/opt/freesvr/audit/update')){
			mkdir("/opt/freesvr/audit/update");
		}
		if(!is_dir('/opt/freesvr/audit/update/new')){
			mkdir("/opt/freesvr/audit/update/new");
		}
		if(!is_dir('/opt/freesvr/audit/update/old')){
			mkdir("/opt/freesvr/audit/update/old");
		}
		for($i=0; $i<count($serverArr); $i++){
			if($stype==$serverArr[$i]['name']){
				$sname = $serverArr[$i]['sname'];
				break;
			}
		}
		
		move_uploaded_file($_FILES['file']['tmp_name'], "/opt/freesvr/audit/update/new/$sname");
		chmod("/opt/freesvr/audit/update/new/$sname", 0755);
		
		$cmd= 'sudo /opt/freesvr/audit/sbin/manageprocess '.$sname.' stop';		
		//echo '<br >';
		system($cmd, $out1);
		cp("/opt/freesvr/audit/sbin/$sname", "/opt/freesvr/audit/update/old/$sname.bak");
		cp("/opt/freesvr/audit/update/new/$sname", "/opt/freesvr/audit/sbin/$sname");
		
		$cmd= 'sudo /opt/freesvr/audit/sbin/manageprocess '.$sname.' start';
		//echo '<br >';

		system($cmd, $out1);
		//var_dump($out1);
		if(trim($out1)==1){
			alert_and_back("升级成功", 'admin.php?controller=admin_eth&action=upgradeServerStatus');
			exit;
		}else{
			//cp("/opt/freesvr/audit/update/old/$sname.bak", "/opt/freesvr/audit/sbin/$sname");
			//alert_and_back("升级失败", 'admin.php?controller=admin_eth&action=upgradeServerStatus');
			prompt("升级失败,回退?","admin.php?controller=admin_eth&action=upgradeServerBack&sname=$sname","admin.php?controller=admin_eth&action=upgradeServerStatus");
			exit;
		}
	}

	function info(){
		
		$url = 'info/index.php';
		$this->assign("page_nav_tabs_selected", "info");
		$this->assign("url", $url);
		$this->display("info.tpl");
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
	     //alert_and_back('写入文件失败,请检查文件权限');
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
