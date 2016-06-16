<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_config extends c_base {
	function index() {
		$this->passwordpolicy();
	}

	function passwordpolicy(){
		global $_CONFIG;
		$config = $this->setting_set->select_all(" sname='password_policy'");
		
		$filename = $_CONFIG['FREESVR_UDF'];
		
		$lines = @file($filename);
		if(!empty($lines))
		{
			
			for($ii=0; $ii<count($lines); $ii++)
			{
								
				if(strstr(strtolower($lines[$ii]), "encrypt"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$network['encrypt'] = trim($tmp[1]);
				}
				if(strstr(strtolower($lines[$ii]), "debug"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$network['debug'] = trim($tmp[1]);
				}
				if(strstr(strtolower($lines[$ii]), "nr_minute"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$network['nr_minute'] = trim($tmp[1]);
				}
			}
		}
		else
		{
			alert_and_back('配置文件不存在');
			exit;
		}
		unset($lines);

		$this->assign("loginsetting", unserialize($config[0]['svalue']));
		$this->assign("sid", $config[0]['sid']);
		$this->assign("udf", $network);
		$this->assign("page_nav_tabs_selected", "passwordpolicy");
		$this->display('passwordpolicy.tpl');
	}
	function passwordpolicy_save(){
		global $_CONFIG;
		$id = get_request('id',1,1);
		$times = get_request('login_times',1,1);
		$length = get_request('login_pwd_length',1,1);
		$logintimeout = get_request('logintimeout',1,1);
		$oldpassnumber = get_request('oldpassnumber',1,1);
		$pwdautolength = get_request('pwdautolength',1,1);
		$pwdstrong1 = get_request('pwdstrong1',1,1);
		$pwdstrong2 = get_request('pwdstrong2',1,1);
		$pwdstrong3 = get_request('pwdstrong3',1,1);
		$pwdstrong4 = get_request('pwdstrong4',1,1);
		$pwdexpired = get_request('pwdexpired',1,1);
		$pwdahead = get_request('pwdahead',1,1);
		$onlinecountmax = get_request('onlinecountmax',1,1);

		$filename = $_CONFIG['FREESVR_UDF'];
		$encrypt = get_request('encrypt',1,1);
		$encrypt2 = get_request('encrypt2',1,1);
		$debug = get_request('debug',1,1);
		$nr_minute = get_request('nr_minute',1,1);
		
		
		
		
		if(!is_numeric($logintimeout)){
			alert_and_back('时间请输入数字');
			exit;
		}
		if(!is_numeric($times) || ($times >5 ) || $times <1 ){
			alert_and_back("次数输入不正确");
			exit;
		}
		if(!is_numeric($length) || ($length <8 )  ){
			alert_and_back("密码最小长度 输入不正确");
			exit;
		}
		if(!is_numeric($pwdautolength)){
			alert_and_back('自动长度请输入数字');
			exit;
		}
		if(!is_numeric($pwdexpired)){
			alert_and_back('密码有效期请输入数字');
			exit;
		}
		if(!is_numeric($pwdahead)){
			alert_and_back('提前天数请输入数字');
			exit;
		}
		if(!is_numeric($onlinecountmax)){
			alert_and_back('同时现在数量请输入数字');
			exit;
		}
		$pwd['login_times']=$times;$pwd['login_pwd_length']=$length;$pwd['logintimeout']=$logintimeout;$pwd['pwdautolength']=$pwdautolength;
		$pwd['pwdstrong1']=$pwdstrong1;$pwd['pwdstrong2']=$pwdstrong2;$pwd['pwdstrong3']=$pwdstrong3;$pwd['pwdstrong4']=$pwdstrong4;
		$pwd['pwdexpired']=$pwdexpired;$pwd['pwdahead']=$pwdahead;$pwd['onlinecountmax']=$onlinecountmax;$pwd['oldpassnumber']=$oldpassnumber;
		//print_r($pwd);
		$newsetting = new setting();
		$newsetting->set_data('sid', $id);
		$newsetting->set_data('svalue', serialize($pwd));		
		$this->setting_set->edit($newsetting);

		$lines = @file($filename);
		if(!empty($lines))
		{
			
			for($ii=0; $ii<count($lines); $ii++)
			{
								
				if(strstr(strtolower($lines[$ii]), "encrypt"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$lines[$ii] = str_replace($tmp[1], $encrypt, $lines[$ii]);
				}
				if(strstr(strtolower($lines[$ii]), "debug"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$lines[$ii] = str_replace($tmp[1], $debug, $lines[$ii]);
				}
				if(strstr(strtolower($lines[$ii]), "nr_minute"))
				{
					$tmp = preg_split("/[\s]+/", $lines[$ii]);
					$lines[$ii] = str_replace($tmp[1], $nr_minute, $lines[$ii]);
				}
			}
			
		}
		else
		{
			echo ('配置文件不存在或没有权限');
			exit;
		}
		$this->Array2File($lines,$filename);
		if($encrypt!=$encrypt2){
			if($encrypt=='no'){
				$this->setting_set->query("UPDATE member set `password`=udf_decrypt(`password`)");
				$this->setting_set->query("UPDATE devices set `cur_password`=udf_decrypt(`cur_password`), `old_password`=udf_decrypt(`old_password`)");
			}else{
				$this->setting_set->query("UPDATE member set `password`=udf_encrypt(`password`)");
				$this->setting_set->query("UPDATE devices set `cur_password`=udf_encrypt(`cur_password`), `old_password`=udf_encrypt(`old_password`)");
			}
		}
		alert_and_back('设置成功','admin.php?controller=admin_config&action=passwordpolicy');
		
	}

	function syslog_mail_alarm(){
		$ac = get_request('ac', 1, 1);
		$Mail_Alarm = get_request('Mail_Alarm', 1, 0);
		$Mailserver = get_request('Mailserver', 1, 1);
		$account = get_request('account', 1, 1);
		$password = get_request('password', 1, 1);
		$syslog_alarm = get_request('syslog_alarm', 1, 0);
		$syslogserver = get_request('syslogserver', 1, 1);
		$syslogport = get_request('syslogport', 1, 1);
		$syslog_facility = get_request('syslog_facility', 1, 1);
		if($ac){
			$sql = ($ac != 'new' ? 'UPDATE' : 'INSERT INTO ')." alarm SET Mail_Alarm='".$Mail_Alarm."',Mailserver='".$Mailserver."', account='".$account."', password='".$password."',syslog_alarm='".$syslog_alarm."', syslogserver='".$syslogserver."', syslogport='".$syslogport."',syslog_facility='".$syslog_facility."'";
			$this->config_set->query($sql);
			alert_and_back('修改成功');
		}
		$ha = $this->config_set->base_select("SELECT * FROM alarm LIMIT 1");
		$this->assign("alarm", $ha[0]);
		$this->assign("title", '告警设置');
		$this->assign("page_nav_tabs_selected", "syslog_mail_alarm");
		$this->display('syslog_mail_alarm.tpl');
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
