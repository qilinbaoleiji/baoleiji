<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_index extends c_base {
	function index() {
		global $_CONFIG;
		$this->assign("username", $_SESSION["ADMIN_USERNAME"]);
		$this->assign("amdin_level", $_SESSION["ADMIN_LEVEL"]);
		$this->assign("amdin_logindate", $_SESSION["ADMIN_LASTDATE"]);
		$this->assign("amdin_ip", $_SESSION["ADMIN_IP"]);
		$this->assign("cacti_on", $_SESSION['CACTI_CONFIG_ON']);		
		$this->assign("log_on", $_SESSION['LOG_ON']&&$_SESSION['LOG_CONFIG_ON']);		
		$this->assign("dbaudit_on", $_SESSION['DBAUDIT_ON']&&$_SESSION['DBAUDIT_CONFIG_ON']);
		$user=$this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		$this->assign("user", $user);
		$this->assign('Year', date('Y'));
		$this->assign('Month', date('m'));
		$this->assign('Day', date('d'));
		switch(date('w')){
			case 1:
				$this->assign('Week', '一');
				break;
			case 2:
				$this->assign('Week', '二');
				break;
			case 3:
				$this->assign('Week', '三');
				break;
			case 4:
				$this->assign('Week', '四');
				break;
			case 5:
				$this->assign('Week', '五');
				break;
			case 6:
				$this->assign('Week', '六');
				break;
			case 0:
				$this->assign('Week', '日');
				break;
		}
		
		if($_SESSION['ADMIN_LOGIN_TIP']){			
			$this->assign("login_tip", 1);
		}
		$_SESSION['ADMIN_LOGIN_TIP'] = false;

		$this->display("index.tpl");
	}
	
	function menu() {
		global $_CONFIG;
		$this->assign("username", $_SESSION["ADMIN_USERNAME"]);
		$this->assign("amdin_level", $_SESSION["ADMIN_LEVEL"]);
		$this->assign("amdin_logindate", $_SESSION["ADMIN_LASTDATE"]);
		$this->assign("amdin_ip", $_SESSION["ADMIN_IP"]);
		$this->assign("cacti_on", $_CONFIG['CACTI_ON']);
		$user=$this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		$this->assign("user", $user);
		if($_SESSION['ADMIN_LOGIN_TIP']){			
			$this->assign("login_tip", 1);
		}
		$_SESSION['ADMIN_LOGIN_TIP'] = false;
		$this->display("menu.tpl");
	}

	function main() {
			global $_CONFIG;
			$page_num = get_request('page');
			$gid = get_request('gid');
			$resgroup = get_request('resgroup', 0, 1);
			$logintype = get_request('logintype', 0, 1);
			$sip = get_request('sip', 0, 1);
			$where = '1=1';
			$member = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
			$this->assign('member', $member);
			$lb = $this->loadbalance_set->select_all();
			$localhost = $this->get_eth0_ip();
			$localhost = $localhost['eth0'];
			$this->assign("localip",$localhost);
			$this->assign("lb",$lb);
			$this->assign("logindebug",$_CONFIG['LOGIN_DEBUG']);
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

			$curr_url = $_SERVER['PHP_SELF'] . "?";
			if(strstr($_SERVER['QUERY_STRING'], "&page=")) {
				$curr_url .= substr($_SERVER['QUERY_STRING'], 0 , strpos($_SERVER['QUERY_STRING'], "&page="));
			}
			else {
				$curr_url .= $_SERVER['QUERY_STRING'];
			}
			$this->assign('curr_url', $curr_url);

			if(	$_SESSION['ADMIN_LEVEL'] == 0) {
				$alltem = $this->tem_set->select_all();
			
				if($logintype){
					foreach($alltem as $tems) {
						if(strtolower($tems['login_method'])==strtolower($logintype)) {
							if(strtolower($logintype)=='rdp'){
								$where .= " AND (devices.login_method=".$tems['id']." or devices.login_method=22)";
							}else{
								$where .= " AND devices.login_method=".$tems['id'];
							}
							
						}
					}
				}
				if($sip){
					$where .= " AND devices.device_ip like '%$sip%'"; 
				}
				
				$sql = "SELECT devicesid FROM ".$this->luser_set->get_table_name()." WHERE memberid=".$_SESSION['ADMIN_UID'];
				$sql .= " UNION SELECT devicesid FROM ".$this->lgroup_set->get_table_name()." WHERE groupid=".$_SESSION['ADMIN_GROUP'];
				$sql .= " UNION  SELECT devicesid FROM ".$this->resgroup_set->get_table_name()." WHERE groupname IN (SELECT b.groupname FROM ".$this->luser_resourcegrp_set->get_table_name()." a LEFT JOIN ".$this->resgroup_set->get_table_name()." b ON a.resourceid=b.id WHERE  a.memberid=".$_SESSION['ADMIN_UID'].")";
				$sql .= " UNION SELECT devicesid FROM ".$this->resgroup_set->get_table_name()." WHERE groupname IN (SELECT b.groupname FROM ".$this->lgroup_resourcegrp_set->get_table_name()." a LEFT JOIN ".$this->resgroup_set->get_table_name()." b ON a.resourceid=b.id WHERE a.groupid=".$_SESSION['ADMIN_GROUP'].")";
				$alldevid = $this->member_set->base_select($sql);
				$alldevsid = array();
				for($i=0; $i<count($alldevid); $i++){
					$alldevsid[]=$alldevid[$i]['devicesid'];
				}
				if(empty($alldevsid)){
					$alldevsid[]=0;
				}
				$where .=" AND devices.id IN(".implode(',', $alldevsid).")";
				if($gid){
					$where .= " AND servers.groupid='$gid'";
				}
				
				if($resgroup){
					$where .= ' AND devices.id IN(SELECT devicesid FROM resourcegroup WHERE devicesid!=0 AND groupname="'.$resgroup.'" )';
				}
				
				$total = $this->server_set->select_count_ex($_SESSION['ADMIN_UID'].'--'.$_SESSION['ADMIN_GROUP'],$where, $groupby);

				$newpager = new my_pager($total, $page_num, 20, 'page');
				//$alldev = $this->server_set->select_limit_ex1($newpager->intStartPosition, $newpager->intItemsPerPage,$_SESSION['ADMIN_UID'], $where, '', "ASC", $groupby, 'devices.*,GROUP_CONCAT(id SEPARATOR \',\') ids,GROUP_CONCAT(login_method SEPARATOR \',\') login_methods');
				
				$alldev = $this->server_set->select_limit_ex1($newpager->intStartPosition, $newpager->intItemsPerPage,$_SESSION['ADMIN_UID'].'--'.$_SESSION['ADMIN_GROUP'], $where,  $orderby1, $orderby2, $groupby);
				
				$row_num = count($alldev);
				for($i=0;$i<$row_num;$i++) {
					foreach($alltem as $tem) {
						if($alldev[$i]['login_method'] == $tem['id']) {
							$alldev[$i]['login_method'] = $tem['login_method'];
						}
						elseif($alldev[$i]['device_type'] == $tem['id']) {
							$alldev[$i]['device_type'] = $tem['device_type'];
						}
					}
					switch ($alldev[$i]['passwordtry']){
						case '0':
							$alldev[$i]['passwordtrys']=language('登录正常');
							break;
						case '1':
							$alldev[$i]['passwordtrys']=language('密码错误');
							break;
						case '2':
							$alldev[$i]['passwordtrys']=language('无法连接');
							break;
						default:
							$alldev[$i]['passwordtrys']=language('无法判断');
							break;
					}
				}
				
	
				//echo '<pre>';print_r($alldev);echo '</pre>';
				$this->assign("webusername", $_SESSION['ADMIN_USERNAME']);
				$this->assign('sip', $sip);
				$this->assign('title', language('服务器列表'));
				$this->assign('alldev', $alldev);
				$this->assign('page_list', $newpager->showSerialList());
				$this->assign('total', $total);
				$this->assign('curr_page', $newpager->intCurrentPageNumber);
				$this->assign('total_page', $newpager->intTotalPageCount);
				$this->assign('items_per_page', $newpager->intItemsPerPage);

				$this->display("usrdev.tpl");
			}
			elseif($_SESSION['ADMIN_LEVEL'] == 10) {
				if($sip){
					$where = " device_ip like '%$sip%'"; 
				}

				
				$row_num = $this->devpass_set->select_count($where);
				$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
				$alldev = $this->devpass_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where, $orderby1, $orderby2);

				$alltem = $this->tem_set->select_all();
				$row_num = count($alldev);

				for($i=0;$i<$row_num;$i++) {
					foreach($alltem as $tem) {
						if($alldev[$i]['login_method'] == $tem['id']) {
							$alldev[$i]['login_method'] = $tem['login_method'];
						}
						elseif($alldev[$i]['device_type'] == $tem['id']) {
							$alldev[$i]['device_type'] = $tem['device_type'];
						}
					}
					
					switch ($alldev[$i]['passwordtry']){
						case '0':
							$alldev[$i]['passwordtrys']=language('登录正常');
							break;
						case '1':
							$alldev[$i]['passwordtrys']=language('密码错误');
							break;
						case '2':
							$alldev[$i]['passwordtrys']=language('无法连接');
							break;
						default:
							$alldev[$i]['passwordtrys']=language('无法判断');
							break;
					}
				}

				$this->assign('title', language('服务器列表'));
				$this->assign('alldev', $alldev);
				$this->assign('page_list', $newpager->showSerialList());
				$this->assign('total', $row_num);
				$this->assign('curr_page', $newpager->intCurrentPageNumber);
				$this->assign('total_page', $newpager->intTotalPageCount);
				$this->assign('items_per_page', $newpager->intItemsPerPage);
				$this->display("usrdev.tpl");
			}
			else{
				$this->display("main.tpl");
			}
		
	}
	
	function get_eth0_ip() {
		global $_CONFIG;
		$eth0 = explode(":", $_SERVER["HTTP_HOST"]);
		return array('eth0'=>$eth0[0]);
		$filename = $_CONFIG['CONFIGFILE']['IFGETH0'];
		
		$return=array();
		if(file_exists($filename))
		{
			$lines = file($filename);
			for($ii=0; $ii<count($lines); $ii++)
			{
								
				if(strstr(strtoupper($lines[$ii]), "IPADDR"))
				{
					$tmp = explode("=", $lines[$ii]);
					$network['IPADDR']['value'] = $tmp[1];
					$network['IPADDR']['file'] = $filename;
				}
			}
		}
		else
		{
			//alert_and_back('配置文件不存在');
		}
	
		$return['eth0'] = trim($network['IPADDR']['value']);
		return $return;
	}

	function login() {
		$ref = get_request('ref', 0, 1);
		if(strstr($ref,"login") || strstr($ref,"ref")){
			$ref='';
		}
		$this->assign('ref', urlencode($ref));
		$this->display("login.tpl");
	}

	function chklogin() {
		global $_CONFIG;
		$username = get_request("username", 1, 1);
		$language = get_request("language", 1, 1);
		$password = get_request("password", 1, 1);
		$dpassword = get_request("dpassword", 1, 1);
		$ref = get_request('ref', 0, 1);
		$result = $this->member_set->select_all("`username` = '$username' ");
		if($language){
			define("LANGUAGE", $language);
		}elseif($_COOKIE['AUDIT_LANGUAGE']){
			define("LANGUAGE", $_COOKIE['AUDIT_LANGUAGE']);
		}else{
			define("LANGUAGE", 'cn');
		}
		$_SESSION['AUDIT_LANGUAGE'] = LANGUAGE;
		
		if(empty($result)){
			alert_and_back('用户名不存在');
			exit;
		}elseif($result[0]['sourceip']&&!$this->check_ip($result[0])){
			alert_and_back('IP不在允许范围');
			exit;
		}elseif($result[0]['weektime']&&!$this->check_weektime($result[0])){
			alert_and_back('该时间段不允许登录');
			exit;
		}
		$user_start_time = date_parse($result[0]['start_time']);
		$user_end_time = date_parse($result[0]['end_time']);
		if(mktime() < mktime($user_start_time['hour'], $user_start_time['minute'], $user_start_time['second'], $user_start_time['month'], $user_start_time['day'], $user_start_time['year']) || mktime() > mktime($user_end_time['hour'], $user_end_time['minute'], $user_end_time['second'], $user_end_time['month'], $user_end_time['day'], $user_end_time['year']) ){
			alert_and_back('帐号不在有效期范围内,帐号的有效期为:\n开始:'.$result[0]['start_time'].'\n结束:'.$result[0]['end_time']);
			exit;
		}
		//$config = $this->setting_set->select_all(" sname='login_times' ");
		$config = $this->setting_set->select_all(" sname='password_policy'");
		$pwdconfig = unserialize($config[0]['svalue']);
		$login_times = $pwdconfig['login_times'];
	
		$lastdate = date_parse($result[0][lastdate]);
		$newmember = new member();
		$newmember->set_data("uid", $result[0]['uid']);

		$max_online = $pwdconfig['onlinecountmax'];
		$exist_account = get_online_users($username, $pwdconfig['logintimeout']*60);
		for($i=0; $i<count($exist_account); $i++){
			if($exist_account[$i]['ip']==$_SERVER['REMOTE_ADDR']&&session_id()!=$exist_account[$i]['ssid']){
				//alert_and_back('您已经在本机登录,请退出后再登录');
				//exit;
			}
		}
		if(count($exist_account)+1 > $max_online){
			alert_and_back('该用户的在线数已经达到了最大值');
			exit;
		}

		//if($result[0]['loginlock'])
		{
			if($result[0]['logintimes'] >= $login_times-1){
				$lastdate_add_1_day = mktime($lastdate['hour'], $lastdate['minute'], $lastdate['second'], $lastdate['month'], $lastdate['day'] + 1, $lastdate['year']);
				$maxlogintimes = 1;
				if($lastdate_add_1_day < time()){
					$newmember->set_data("logintimes", 1);
				}else{
					$newmember->set_data("loginlock", 1);
					$this->member_set->edit($newmember);
					alert_and_back(language("您登录次数达到了最大次数").":".$login_times.','.language('请明天再试'));
					exit;
				}
			}else{
				$newmember->set_data("logintimes", $result[0]['logintimes'] + 1);
				if($result[0]['logintimes']==0){
					$newmember->set_data("lastdate", date('Y-m-d H:i:s'));
				}
			}
		}
		
		$filename = $_CONFIG['CONFIGFILE']['SSH'];
		$lines = @file($filename);
		if($result[0]['level']==0||$_CONFIG['OTHER_MEMBER_RADIUS']==1){
			if(!empty($lines)){
				for($ii=0; $ii<count($lines); $ii++)
				{
									
					if(strstr($lines[$ii], "MasterRadiusServerAddress"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['address'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "MasterRadiusServerPort"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['port'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "MasterRadiusServerSecret"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['secret'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "SlaveRadiusServerAddress"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['slaveaddress'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "SlaveRadiusServerPort"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['slaveport'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "SlaveRadiusServerSecret"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['slavesecret'] = trim($tmp[1]);
					}
					if(strstr($lines[$ii], "RadiusAuth"))
					{
						$tmp = preg_split("/[\s]+/", $lines[$ii]);
						$radiusconfig['radiusauth'] = trim($tmp[1]);
					}
				}
			}else{
				alert_and_back('打开radius配置文件失败');
				exit;
			}
		}
		if($result[0]['mservergroup'])
		$serverResult = $this->server_set->select_all(" groupid='".$result[0]['mservergroup']."'");
		if($serverResult){
			foreach ($serverResult AS $key => $value){
				$serverIds[] = $value['id'];
			}
		}
		if($serverIds)
		$serverString=implode(",", $serverIds);
		//$radiusconfig['radiusauth']='no';
		if($radiusconfig['radiusauth']=='yes' ){
			$auth_rs = $this->radius_chk($username, $password.$dpassword, $radiusconfig['address'], $radiusconfig['port'],$radiusconfig['secret']);
			//$auth_rs=1;

			switch($auth_rs){
				case 1:
					$_SESSION['ADMIN_LOGINED'] = true;
					$_SESSION['ADMIN_USERNAME'] =  $username;
					$_SESSION['ADMIN_LEVEL'] = $result[0]['level'];					
					$_SESSION['ADMIN_UID'] = $result[0]['uid'];
					$_SESSION['ADMIN_GROUP'] = (int)$result[0]['groupid'];
					$_SESSION['ADMIN_FLIST'] = unserialize($result[0]['flist']);
					$_SESSION['ADMIN_LASTDATE'] = $result[0]['lastdate'];
					$_SESSION['ADMIN_IP'] = $_SERVER['REMOTE_ADDR'];
					$_SESSION['ADMIN_MUSERGROUP'] = $result[0]['musergroup'];
					$_SESSION['ADMIN_MSERVERGROUP'] = $result[0]['mservergroup'];
					$_SESSION['ADMIN_LOGINDATE'] = date('Y-m-d H:i:s');
					if($result[0]['login_tip']){
						$_SESSION['ADMIN_LOGIN_TIP'] = true;
					}
					$_SESSION['DEVS'] = $serverString;
					if(empty($_SESSION['DEVS']))
						$_SESSION['DEVS']=0;
					setcookie("LANGUAGE", $language,time()+3600*24*365*100, '/', '', 1);
					$newmember->set_data("lastdate", date('Y-m-d H:i:s'));
					$newmember->set_data("ip", $_SERVER['REMOTE_ADDR']);
					$newmember->set_data("logintimes", 0); 
					$newmember->set_data('devs',",".$serverString.",");
					$this->member_set->edit($newmember);
					$_SESSION['startonlinetime']=mktime();//var_dump((mktime()-$result[0]['lastdateChpwd'])/(24*3600));var_dump($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']);exit;
					if((((mktime()-$result[0]['lastdateChpwd'])/(24*3600)) > ($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']) )){
						$membercpwd = urlencode("controller=admin_member&action=edit_self&msg=changepwd");
						go_url('admin.php?controller=admin_index&ref='.$membercpwd);
						exit;
					}
					go_url('admin.php?controller=admin_index&ref='.urlencode($ref));
					exit;
					break;
				case -1:					
					if($result[0]['level']!=1&&(1 || $result[0]['loginlock'])){
						$this->member_set->edit($newmember);
						if($login_times-$result[0]['logintimes'] > 0){
							alert_and_back(language('用户名或密码错误,请重试').language('还有').($login_times-$result[0]['logintimes']-1).'次');
							exit;
						}
						else {
							alert_and_back('用户名或密码错误,已经超出系统限制,请明天重试');
							exit;
						}
					}else{
						alert_and_back('用户名或密码错误');
						exit;
					}
					break;
				default:
				{
					if($result[0]['level']==0 || $_CONFIG['OTHER_MEMBER_RADIUS']==1){
						alert_and_back('系统错误,请稍候重试,或联系管理员');
						exit;
					}
				}
			}
			
		}
		if($_CONFIG['crypt']==1){
			$password = encrypt($password);
		}
		if($this->member_set->udf_decrypt($result[0][password])!=$password) 
		{
			if($result[0]['level']!=1&&(1 || $result[0]['loginlock']))
			{
				$this->member_set->edit($newmember);
				alert_and_back(language('用户名或密码错误,请重试').language('还有').($login_times-$result[0]['logintimes']-1).'次');
				exit;
			}else{
				alert_and_back('用户名或密码错误');
				exit;
			}
			
		}
		else {	
			$_SESSION['ADMIN_LOGINED'] = true;
			$_SESSION['ADMIN_USERNAME'] =  $username;
			$_SESSION['ADMIN_LEVEL'] = $result[0]['level'];
			$_SESSION['ADMIN_UID'] = $result[0]['uid'];
			$_SESSION['ADMIN_GROUP'] = (int)$result[0]['groupid'];
			$_SESSION['ADMIN_FLIST'] = unserialize($result[0]['flist']);
			
			$_SESSION['DEVS'] = $serverString;
			$_SESSION['ADMIN_LASTDATE'] = $result[0]['lastdate'];
			$_SESSION['ADMIN_IP'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['ADMIN_MUSERGROUP'] = $result[0]['musergroup'];
			$_SESSION['ADMIN_MSERVERGROUP'] = $result[0]['mservergroup'];
			$_SESSION['ADMIN_LOGINDATE'] = date('Y-m-d H:i:s');
			if($result[0]['login_tip']){
				$_SESSION['ADMIN_LOGIN_TIP'] = true;
			}
			if(empty($_SESSION['DEVS']))
				$_SESSION['DEVS']=0;
			setcookie("LANGUAGE", $language,time()+3600*24*365*100, '/', '', 1);
			$newmember->set_data("lastdate", date('Y-m-d H:i:s'));
			$newmember->set_data("ip", $_SERVER['REMOTE_ADDR']);
			$newmember->set_data("logintimes", 0);
			$newmember->set_data('devs',",".$serverString.",");
			$this->member_set->edit($newmember);
			$_SESSION['startonlinetime']=mktime();//var_dump((mktime()-$result[0]['lastdateChpwd'])/(24*3600));var_dump($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']);exit;
			if((((mktime()-$result[0]['lastdateChpwd'])/(24*3600)) > ($pwdconfig['pwdexpired']-$pwdconfig['pwdahead']) )){
				$membercpwd = urlencode("controller=admin_member&action=edit_self&msg=changepwd");
				go_url('admin.php?controller=admin_index&ref='.$membercpwd);
				exit;
			}
			go_url('admin.php?controller=admin_index&ref='.urlencode($ref));
			exit;
		}	
	}
	function check_ip($member){
		$sources = $this->sourceip_set->select_all( 'groupname=\''.$member['sourceip'].'\' AND sourceip!=\'\'');
		$found = 0;
		$guest = $_SERVER['REMOTE_ADDR'];//var_dump($guest);
		for($i=0; $i<count($sources); $i++){//var_dump($sources[$i]['sourceip']);
			if(ipMatch($sources[$i]['sourceip'], $guest)){
				$found = 1;
				break;
			}
		}
		return $found;
	}
	function check_weektime($member){
		$sources = $this->weektime_set->select_all( 'policyname=\''.$member['weektime'].'\'');
		$w = (date('w')==0 ? '7' : date('w'));
		$found = true;
		if(date('H:i:s')<$sources[0]['start_time'.$w] || date('H:i:s')>$sources[0]['end_time'.$w]){
			$found = false;
		}
		return $found;
	}
	function radius_chk($username, $pwd, $server, $port, $key){

		$radius = radius_auth_open(); 
		
	    if (! radius_add_server($radius,$server,(int)$port,$key,5,3)) 
	    { 
	        die('Radius Error: ' . radius_strerror($radius)); 
	    } 
	
	    if (! radius_create_request($radius,RADIUS_ACCESS_REQUEST)) 
	    { 
	        die('Radius Error: ' . radius_strerror($radius)); 
	    } 
	
	    radius_put_attr($radius,RADIUS_USER_NAME,$username); 
	    radius_put_attr($radius,RADIUS_USER_PASSWORD,$pwd); 
	
	    switch (radius_send_request($radius)) 
	    { 
	        case RADIUS_ACCESS_ACCEPT: 
	            return 1;
	            break; 
	        case RADIUS_ACCESS_REJECT: 
	            return -1;
	            break; 
	        case RADIUS_ACCESS_CHALLENGE: 
	            return -2;
	            break; 
	        default: 
				die('Radius Error: ' . radius_strerror($radius)); 
	        	return -3;
	            
	    } 
		radius_close($radius);
	}

	function encryp($code) {
		$chars = preg_split('//', $code, -1, PREG_SPLIT_NO_EMPTY);
		$i=10;
		$result = array();
		foreach($chars as $char) {
			
			$result[] = ord($char) ^ $i;
			$i++;
		}
		$string = '';
		foreach($result as $char) {
			$string.= chr($char);
		}
		return $string;
	}

	function logout() {
		session_destroy();
		$_SESSION = array();
		go_url('admin.php');
	}

	function license(){
		exec("/opt/freesvr/audit/sbin/licenses", $output, $return);
		//$output = file("./controller/4.txt");
		//print_r($output);
		$targets = array();
		$i = 0;
		$j=0;
		//foreach($output as $line)
		$page_num = get_request('page');
		$page_num = empty($page_num) ? 1 : $page_num;
		$newpager = new my_pager(count($output), $page_num, 20, 'page');
		$num = ($page_num-1)*20+20 > count($output) ? count($output) : ($page_num-1)*20+20;
		for($i=($page_num-1)*20; $i<$num; $i++) 
		{
			$line = $output[$i];
			$arr = preg_split ("/\s{1,}/",$line);
			$targets[$i-($page_num-1)*20]["deadline"] = $arr[0];
			$targets[$i-($page_num-1)*20]["equipnum"] = $arr[1];
			$targets[$i-($page_num-1)*20]["company"] = $arr[2];
			$targets[$i-($page_num-1)*20]["key"] = $arr[3];
			//$i++;
		}
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->assign("license", $targets);
		$this->display("license.tpl");
	}
	
	function upload_license(){
		$ac = get_request('ac', 1, 1);
		if($ac=='upload'){
			if(is_uploaded_file($_FILES['key']['tmp_name'])){	
				if($_FILES['key']['name']!='license.key'){
					alert_and_back('请上传正确的文件','admin.php?controller=admin_index&action=license');
					exit;
				}
				if(move_uploaded_file($_FILES['key']['tmp_name'], "/opt/freesvr/audit/etc/licenses.key")){
					alert_and_back('上传成功','admin.php?controller=admin_index&action=license');
				}else{
					alert_and_back('移动文件失败','admin.php?controller=admin_index&action=license');
				}
				exit;
			}else{
				alert_and_back('请上传正确的文件','admin.php?controller=admin_index&action=license');
				exit;
			}
		}
		$this->display('upload_license.tpl');
	}

	function test() {
		$this->member_set->change_pass();
	}

	function account() {
		$type = get_request('type');
		$page_num = get_request('page');
		$where = '1 = 1';
		if($type == 1) {
			$where = " AcctStopTime = '0000-00-00 00:00:00'";
			$this->assign('type',$type);
		}
		if($_SESSION[ADMIN_LEVEL]==0){
			$where .= " AND username='$_SESSION[ADMIN_USERNAME]'";
		}
		$row_num = $this->account_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$allaccount = $this->account_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage, $where);

		$this->assign('title', language('记账信息'));
		//var_dump($allaccount);
		$this->assign('allaccount', $allaccount);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->display('admin_account.tpl');
	}

	function del_account() {
		$date = get_request('date', 1, 1);
		$this->account_set->delete_all("AcctStopTime < '$date 00:00:00 '");
		alert_and_back('删除成功');
	}

	function tool_list() {
		$memberinfo = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		if($memberinfo['level']=='0' && $memberinfo['usbkeystatus']=='1'){
			$this->assign('usbkeyshow', 1);
		}
		$allTools = array();
		$Tool = array();
		$i = 1;
		$d = @dir("./soft-down");
		if($d){
			while (false !== ($entry = $d->read())) {
				if($entry != '.' && $entry != '..') {
					$Tool['id'] = $i++;
					$Tool['path'] = urlencode($entry);
					$Tool['name'] = mb_convert_encoding($entry, "utf-8", "GB2312");   ;
					$allTools[] = $Tool;
				}
			}
		}else{
			alert_and_back('读取目录失败 ,请检查文件权限','',1);
			exit;
		}
		$d->close();
		$this->assign("allTools",$allTools);
		$this->assign('title',language('工具列表'));
		$this->display('tools_list.tpl');
	}
	
	function passdown(){
		global $_CONFIG;
		
		exec('ls -lh --full-time -t '.$_CONFIG['PASSWORD_USER_DOWN'], $output);
		for($i=1; $i<count($output); $i++){
			$filearr = preg_split("/[\s]+/", $output[$i]);
			$files[$i-1]['name'] = $filearr[8];
			$files[$i-1]['size'] = $filearr[4];
			$files[$i-1]['time'] = $filearr[5].' '.substr($filearr[6], 0, 8);
		}
		
		$this->assign("title", language('密码文件下载'));
		$this->assign('files', $files);
		$this->display('passdown.tpl');
	}
	
	function dopassdown(){
		global $_CONFIG;
		$filename = get_request('name', 0, 1);
		$file = $_CONFIG['PASSWORD_USER_DOWN']."/$filename";
		Header('Cache-Control: private, must-revalidate, max-age=0');
		Header("Content-type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=$filename"); 
		$f=fopen($file,'rb'); 
			if($f!=false){
				$contents = "";
				do {
				    $data = fread($f, 8192);
				    if (strlen($data) == 0) {
				        break;
				    }
				    $contents .= $data;
				} while(true);
				fclose($f); 
				echo $contents;
		}else{
			alert_and_back("打开文件失败");
		}
		exit();
	}
	
	function download_usbkeyfile(){
		$username = $_SESSION['ADMIN_USERNAME'];
		$uid = $_SESSION['ADMIN_UID'];
		$member = $this->member_set->select_by_id($uid);
		if(empty($member['usbkeystatus'])){
			alert_and_close('该文件已经下载过');
			exit;
		}
		$filename = $username;
		$file = "/opt/freesvr/audit/usbkeys/$filename";
		Header('Cache-Control: private, must-revalidate, max-age=0');
		Header("Content-type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=$filename"); 
		$f=fopen($file,'rb'); 
		if($f!=false){
			
			$newmember = new member();
			$newmember->set_data('uid', $uid);
			$newmember->set_data('usbkey', 0);
			$newmember->set_data('usbkeystatus', 0);
			$this->member_set->edit($newmember);
			
			$contents = "";
			do {
			    $data = fread($f, 8192);
			    if (strlen($data) == 0) {
			        break;
			    }
			    $contents .= $data;
			} while(true);
			fclose($f); 
			echo $contents;
			unlink($file);
		}else{
			alert_and_back("打开文件失败");
		}
		exit();
	}

	function appdevice_list(){
		global $_CONFIG;
		$page_num = get_request('page');
		$this->assign("logindebug",$_CONFIG['LOGIN_DEBUG']);
		$lb = $this->loadbalance_set->select_all();
		$localhost = $this->get_eth0_ip();
		$localhost = $localhost['eth0'];
		$this->assign("localip",$localhost);
		$where = "appserverip IN(SELECT appserverip FROM apppub WHERE id IN(SELECT appid FROM appmember WHERE memberid=".$_SESSION['ADMIN_UID'].") OR id IN(SELECT appid FROM appgroup WHERE groupid=".($_SESSION['ADMIN_GROUP']?$_SESSION['ADMIN_GROUP']:0)."))";

		$total = $this->appserver_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$alldev = $this->appserver_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where,'appserverip', 'ASC');
		
		$newpager = new my_pager($total, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $total);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);

		$this->assign('alldev', $alldev);
		$this->display('usrapppubdev.tpl');
	}

	function appdev_login(){
		global $_CONFIG;

		$rdptype = get_request('rdptype', 0, 1);
		$appid = get_request('id', 0, 1);
		$selectedip = get_request('selectedip', 0, 1);
		$app_act = get_request('app_act', 0, 1);
		$screen = get_request('screen', 0 ,1);
		$this->assign("activex_version", $_CONFIG['ACTIVEX_VERSION']);
		$str = genRandomString(8);
		$appserver = $this->appserver_set->select_by_id($appid);
		$this->assign("screen", $screen);
		$this->assign("port", 80);
		$this->assign("app_act",$app_act);
		$this->assign('ip',$appserver['appserverip']);
		$this->assign('localhost', $selectedip);
		$this->assign("id", $appid);
		$this->assign("autorun", $_CONFIG['apppub_AUTORUN']);
		$dynamic_pwd = $this->radkey_set->get_ran_radkey($_SESSION['ADMIN_USERNAME']);
		$this->assign("dynamic_pwd",$dynamic_pwd);
		if($type=='gateway' || $type=='fort' ){
			$this->assign("dynamic_pwd",'');
		}
		if($rdptype=='activex'){
			$this->assign('username',$_SESSION['ADMIN_USERNAME'].'--'.$appid.'--'.$str);
			$this->assign('password',$str.'--');
			$this->assign('sid',$appid.'--'.$str);
			$this->display('rdplogin_activex.tpl');
		}else{			
			$this->assign('username',$_SESSION['ADMIN_USERNAME'].'--'.$appid.'--'.$str);
			$this->assign('password',$str.'--');
			$this->assign('sid',$appid.'--'.$str);
			$this->display('WebSysbaseOraclelogin_mstsc.tpl');
		}
		
	}

	function apppub_list(){
		$page_num = get_request('page');

		$where = " id IN(SELECT appid FROM appmember WHERE memberid=".$_SESSION['ADMIN_UID'].") OR id IN(SELECT appid FROM appgroup WHERE groupid=".($_SESSION['ADMIN_GROUP']?$_SESSION['ADMIN_GROUP']:0).")";

		$total = $this->apppub_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$alldev = $this->apppub_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where,'appserverip', 'ASC');
		
		$newpager = new my_pager($total, $page_num, $this->config['site']['items_per_page'], 'page');
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $total);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);

		$this->assign('apppub', $alldev);
		$this->display('viewapppub.tpl');
	}

	function login_tip(){
		$config = $this->setting_set->select_all(" sname='password_policy'");
		$pwdconfig = unserialize($config[0]['svalue']);
		$pwdexpired = $pwdconfig['pwdexpired'];
		$member = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		$member['nextdateChpwd'] = date('Y-m-d H:i:s', $member['lastdateChpwd']+$pwdexpired*24*60*60);
		$member['lastdateChpwd'] = date('Y-m-d H:i:s', $member['lastdateChpwd']);
		
		$this->assign("member", $member);
		$this->assign("now", date('Y-m-d H:i:s'));
		$this->display("login_tip.tpl");

	}

	function chpwd(){
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

		$sql = "SELECT devicesid FROM ".$this->luser_set->get_table_name()." WHERE memberid=".$_SESSION['ADMIN_UID'];
		$sql .= " UNION SELECT devicesid FROM ".$this->lgroup_set->get_table_name()." WHERE groupid=".$_SESSION['ADMIN_GROUP'];
		$sql .= " UNION  SELECT devicesid FROM ".$this->resgroup_set->get_table_name()." WHERE groupname IN (SELECT b.groupname FROM ".$this->luser_resourcegrp_set->get_table_name()." a LEFT JOIN ".$this->resgroup_set->get_table_name()." b ON a.resourceid=b.id WHERE  a.memberid=".$_SESSION['ADMIN_UID'].")";
		$sql .= " UNION SELECT devicesid FROM ".$this->resgroup_set->get_table_name()." WHERE groupname IN (SELECT b.groupname FROM ".$this->lgroup_resourcegrp_set->get_table_name()." a LEFT JOIN ".$this->resgroup_set->get_table_name()." b ON a.resourceid=b.id WHERE a.groupid=".$_SESSION['ADMIN_GROUP'].")";
		$alldevid = $this->member_set->base_select($sql);
		$alltem = $this->tem_set->select_all();
		$alldevsid = array();
		for($i=0; $i<count($alldevid); $i++){
			$alldevsid[]=$alldevid[$i]['devicesid'];
		}
		if(empty($alldevsid)){
			$alldevsid[]=0;
		}
		$where = " id IN(".implode(",", $alldevsid).") AND entrust_password=1 AND radiususer=0";
		$total = $this->devpass_set->select_count($where);
		$newpager = new my_pager($total, $page_num, 20, 'page');
		$alldev = $this->devpass_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where, $orderby1, $orderby2);

		$row_num = count($alldev);
		for($i=0;$i<$row_num;$i++) {
			foreach($alltem as $tem) {
				if($alldev[$i]['login_method'] == $tem['id']) {
					$alldev[$i]['login_method'] = $tem['login_method'];
				}
				elseif($alldev[$i]['device_type'] == $tem['id']) {
					$alldev[$i]['device_type'] = $tem['device_type'];
				}
			}
		}

		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $total);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);

		



		$this->assign('alldev', $alldev);
		$this->display('chpwd.tpl');
	}

	function chpwd_save(){
		$selected_id = get_request('selected_id');
		$single = get_request('single');

		if($single){
			$id = $_POST['id'][$selected_id];
			$old_password = $_POST['old_password'][$selected_id];
			$new_password = $_POST['new_password'][$selected_id];
			if(empty($new_password)){
				alert_and_back("请输入新密码");
				exit;
			}
			if($row=$this->devpass_set->select_count("cur_password='$old_password' AND id=$id")==0){
				alert_and_back("输入的原密码错误");
				exit;
			}
			$old_dev = $this->devpass_set->select_by_id($id);
			$newdevice = new devpass();
			$newdevice->set_data('id', $id);
			$newdevice->set_data("old_password", $old_dev['cur_password']);
			$newdevice->set_data("cur_password", $new_password);
			$newdevice->set_data("last_update_time", date('Y-m-d H:i:s'));
			$this->devpass_set->edit($newdevice);
			alert_and_back("修改成功");
		}else{
			$msg = "";
			for($i=0; $i<count($_POST['id']); $i++){
				$id = $_POST['id'][$i];
				$old_password = $_POST['old_password'][$i];
				$new_password = $_POST['new_password'][$i];

				if($old_password || $new_password){

					$updatestatus =1;
					$smsg = "设备:".$_POST['id'][$i];
					if(empty($new_password)){
						$smsg .= ",无原始密码";
						$updatestatus = 0;
					}
					if($row=$this->devpass_set->select_count("cur_password='$old_password' AND id=$id")==0){
						$smsg .= ",原始密码不正确";
						$updatestatus = 0;
					}					
					if($updatestatus == 1){
						$old_dev = $this->devpass_set->select_by_id($id);
						$newdevice = new devpass();
						$newdevice->set_data('id', $id);
						$newdevice->set_data("old_password", $old_dev['cur_password']);
						$newdevice->set_data("cur_password", $new_password);
						$newdevice->set_data("last_update_time", date('Y-m-d H:i:s'));
						$this->devpass_set->edit($newdevice);
					}else{
						$msg .= $smsg.'\n';
					}
				}
			}
			if(!empty($msg)){
				//var_dump($msg);
				alert_and_back("部分没有更新:\\n".$msg);
				exit;
			}else{
				alert_and_back("修改成功");
				exit;
			}
		}
		
		//
	}

	function getpwd(){
		global $_CONFIG;
		$ac = get_request("ac", 1, 1);
		$username = get_request("username", 1, 1);
		$email = get_request("email", 1, 1);
		$_SESSION["POST"]=$_POST;
		if($ac=='get'){
			if(empty($username)||empty($email)){
				alert_and_back('请完整的填写信息');
				exit;
			}
			$user = $this->member_set->select_all("username = '" . $username . "' AND email='".$email."'");
			$user = $user[0];
			if(empty($user)){
				alert_and_back('你填写的信息有误');
				exit;
			}
			$password = genRandomPassword(8);
			if($_CONFIG['crypt']==1){
				$password = encrypt($password);
			}
			$newmember = new member();
			$newmember->set_data('uid', $user['uid']);
			$newmember->set_data('password', $this->member_set->udf_encrypt($password));
			$this->member_set->edit($newmember);

			$old_radius = $this->radius_set->select_all("UserName = '".$user['username']."'");
			$new_radius = new radius();
			$new_radius->set_data("id",$old_radius[0]['id']);
			$new_radius->set_data("Value",crypt($password,"\$1\$qY9g/6K4"));
			$newmember->set_data('lastdateChpwd', mktime());		
			$this->radius_set->edit($new_radius);
			
			$ha = $this->config_set->base_select("SELECT * FROM alarm LIMIT 1");
			$smtp = new smtp_mail($ha[0]['MailServer'],"25",$ha[0]['account'],$ha[0]['password'], false);
			$smtp->send($ha[0]['account'],$user['email'],$_CONFIG['site']['title']." 重置密码",($username).",你好:\n  您的新密码是:".$password);
			alert_and_back('密码修改成功,请查阅邮箱', 'admin.php?controller=admin_index&action=login');
		}
		$this->display("getpwd.tpl");
	}

	function changerole(){
		$user = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		if($user['common_user_pri']){
			$level = get_request('level', 0, 1);
			if($level==0){
				$_SESSION['ADMIN_LEVEL'] = 0;
				alert_and_back('切换角色','admin.php?controller=admin_index');
				exit;
			}elseif($user['level']==$level){
				$_SESSION['ADMIN_LEVEL'] = $level;
				alert_and_back('切换角色','admin.php?controller=admin_index');
				exit;
			}			
		}
	}
}
?>
