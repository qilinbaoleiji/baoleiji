<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_member extends c_base {
	function index() {
		$back = get_request('back');
		if($back){
			if(is_array($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING'])){
				$_GET = array_merge($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING'], $_GET);
				$_SERVER['QUERY_STRING'] = http_build_query($_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING']);
			}
		}else{
			$_SESSION[$_GET['controller'].'_'.$_GET['action'].'_'.'QUERY_STRING'] = null;
		}
		$page_num = get_request('page');
		$gid = get_request("gid");
		$username = get_request("username", 0, 1);
		$orderby1 = get_request("orderby1", 0, 1);
		$orderby2 = get_request("orderby2", 0, 1);
		$level = get_request("level", 0, 1);
		$derive = get_request("derive");
		//$where = 'level < 10 AND level!=2';
		$where = '1=1';
		if($gid){
			$where .= ' AND group='.$gid;
		}
		if($username){
			$where .= " AND username like '%".$username."%'";
		}

		if($level){
			$where .= ' AND level='.$level;
		}

		if(empty($orderby1)){
			$orderby1 = 'username';
		}
		if(strcasecmp($orderby2, 'asc') != 0 ) {
			$orderby2 = 'asc';
		}else{
			$orderby2 = 'desc';
		}
		$this->assign("orderby2", $orderby2);

		if($_SESSION['ADMIN_LEVEL']==3){
			if(empty($_SESSION['ADMIN_MUSERGROUP'])){
				alert_and_back('没有可管理的组','admin.php?controller=admin_session');
				exit;
			}
			$where .= "  AND groupid=".$_SESSION['ADMIN_MUSERGROUP']." AND uid!=".$_SESSION['ADMIN_UID'];
		}
		
		if($derive){
			$this->memberderive($where);
			exit;
		}

		$curr_url = $_SERVER['PHP_SELF'] . "?";
		if(strstr($_SERVER['QUERY_STRING'], "&page=")) {
			$curr_url .= substr($_SERVER['QUERY_STRING'], 0 , strpos($_SERVER['QUERY_STRING'], "&page="));
		}
		else {
			$curr_url .= $_SERVER['QUERY_STRING'];
		
		}
		parse_str($_SERVER['QUERY_STRING'], $_SESSION[$_GET['controller'].'_'.($_GET['action'] ? $_GET['action'] : 'index' ).'_'.'QUERY_STRING']);

		$row_num = $this->member_set->select_count($where);
		$newpager = new my_pager($row_num, $page_num, $this->config['site']['items_per_page'], 'page');
		$allmember = $this->member_set->select_limit($newpager->intStartPosition, $newpager->intItemsPerPage,$where, $orderby1, $orderby2);
		$this->assign('page_list', $newpager->showSerialList());
		$this->assign('total', $row_num);
		$this->assign('curr_page', $newpager->intCurrentPageNumber);
		$this->assign('total_page', $newpager->intTotalPageCount);
		$this->assign('items_per_page', $newpager->intItemsPerPage);
		$this->assign('curr_url', $curr_url);


		$out = $allmember;
		$config = $this->setting_set->select_all(" sname='password_policy'");
		$pwdconfig = unserialize($config[0]['svalue']);

		for($i=0;$i<count($out);$i++) {
			$out[$i]['username'] = $allmember[$i]['username'];
			$out[$i]['onlinenumber'] = get_online_number_by_users($allmember[$i]['username'], $pwdconfig['logintimeout']*60);
			if($out[$i]['username']==$_SESSION['ADMIN_USERNAME']){
				$out[$i]['onlinenumber'] = $out[$i]['onlinenumber'] + 1;
			}
		}
		$this->assign('allmember', $out);
		$this->display('member_list.tpl');
	}

	function memberderive($where){
		$level = array(
			"0" => '普通用户',
			"1" => '管理员',
			"2" => '审计员',
			"3" => '组管理员',
			"10" => '密码管理员'
		);
		$result = $this->member_set->base_select("SELECT a.*,b.GroupName FROM ".$this->member_set->get_table_name()." a LEFT JOIN ".$this->usergroup_set->get_table_name()." b ON a.groupid=b.id WHERE $where");
		//$handle = @fopen('/tmp/member.xls', 'w');
		
		
		$str = language("用户名").",";
		$str .= language("密码").",";
		$str .= language("等级").",";
		$str .= language("组名").",\n";
		$row = 1;
		if(!empty($result))
		foreach($result as $info) {
			$str .= $info['username'].",";
			$str .= $info['password'].",";
			$str .= $level[$info['level']].",";
			$str .= $info['GroupName'].",";
			$str .= "\n";		
			
			$row++;
		}
		$str = mb_convert_encoding($str, "GB2312", "UTF-8");
		
		//fclose($handle);
		Header('Cache-Control: private, must-revalidate, max-age=0');
		Header("Content-type: application/octet-stream"); 
		Header("Content-Disposition: attachment; filename=member.csv"); 
		echo $str;
		exit;
	}

	

	function online(){
		$username = get_request('username', 0, 1);
		$config = $this->setting_set->select_all(" sname='password_policy'");
		$pwdconfig = unserialize($config[0]['svalue']);
		$online_users = get_online_users($username, $pwdconfig['logintimeout']*60);
		//var_dump($online_users);
		$this->assign("username", $username);
		$this->assign("current_session_id", session_id());
		$this->assign("online_users", $online_users);
		$this->display('online_member_list.tpl');
	}

	function offline(){
		$ssid = get_request('ssid', 0, 1);
		if(offline_user($ssid)){
			alert_and_back('断开成功');
		}else{
			alert_and_back('断开失败');
		}
	}

	function offline_all(){
		$ssids = $_POST['chk_member'];

		for($i=0; $i<count($ssids); $i++){
			offline_user($ssids[$i]);
		}
		alert_and_back('断开成功');
	}

	function add() {
		//$allpass = $this->pass_set->select_all();
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['SERVERCONF'];	
		$lines = @file($filename);
		$i=0;
		if($lines)
		foreach($lines as $line){
			if(preg_match("/group /",$line)==1) {
				$route = preg_split("/\s{1,}/", $line); 
				$routes[$i]['gname']= $route[1];
				$routes[$i]['start']= $route[2];
				$routes[$i]['end']= $route[3];
				$key1[]=$route[1];
				$i++;
			}
		}
		if(!empty($routes))
		array_multisort($key1,SORT_ASC,$routes);
		
		$dp = $this->config_set->base_select("SELECT * FROM defaultpolicy LIMIT 1");
		$dp = $dp[0];
		$member['netdisksize'] = $dp['netdisksize'];
		$member['default_control'] = $dp['default_control'];
		$this->assign('member', $member);

		
		
		$outgroup = array();
		$groupname = '';
		if($acgroups)
		foreach($acgroups as $acgroup) {
			if($acgroup['groupname'] != $groupname) {
				$groupname = $acgroup['groupname'];
				$outgroup[] = $acgroup;
			}
		}
		$this->assign('allusbkey',$allusbkey);
		$this->assign('vpnpool', $routes);
		$this->assign("acgroup",$outgroup);
		$this->assign("allgroup",$allgroup);
		$this->assign("allpasses",$allpass);		
		$this->assign("sourceip", $sourceip);
		$this->assign("weektime", $weektime);
		$this->assign("usergroup", $usergroup);
		$this->assign('title',language('添加新用户'));
		$this->display('member_add.tpl');
	}

	function edit() {
		global $_CONFIG;
		$member = $this->member_set->select_by_id(get_request('uid'));
		$member["password"] = $this->member_set->udf_decrypt($member["password"]);
		$outgroup = array();
		$groupname = '';
		if($acgroups)
		foreach($acgroups as $acgroup) {
			if($acgroup['groupname'] != $groupname) {
				$groupname = $acgroup['groupname'];
				$outgroup[] = $acgroup;
			}
		}
		$this->assign("acgroup",$outgroup);
		$bindedacgroup = $this->acgroup_set->select_all("username = '".$member['username']."'");
		if(count($bindedacgroup)>0) {
			$this->assign('$oldacgroup',$bindedacgroup[0]['Value']);
		}
//		$member['flist'] = unserialize($member['flist']);
		//$member["username"] = $member["username"];//print_r($member);
		//echo time($member['end_time']).'--'.time().'--';
		$end_time_arr = explode(' ',$member['end_time']);
		$end_time_ymd = explode('-',$end_time_arr[0]);
		$end_time_time = explode(':',$end_time_arr[1]);
		//echo mktime($end_time_time[0],$end_time_time[1],$end_time_time[2],$end_time_ymd[1],$end_time_ymd[2],$end_time_ymd[0]);
		if($member['end_time'] && mktime($end_time_time[0],$end_time_time[1],$end_time_time[2],$end_time_ymd[1],$end_time_ymd[2],$end_time_ymd[0])<=time()){
			$member['start_time'] = '2000-01-01 00:00:00';
		}

		$gattr = $this->uattr_set->select_all("UserName = '".$member['username']."' and attribute = '". $_CONFIG['attributes'][2]['name'] ."'");//登陆等级
		$this->assign('priv', substr($gattr[0]['Value'], strpos($gattr[0]['Value'],'=')+1));
		

		$this->assign('member', $member);
/*
		$keyid = $this->keys_set->select_all(" UserName = '".$member["username"]."' ");
		if($keyid[0]['pc_id'] !=0) {
			$allusbkey[] = $this->usbkey_set->select_by_id($keyid[0]['pc_id']);
		}
*/		
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['SERVERCONF'];	
		$lines = @file($filename);
		$i=0;
		if($lines)
		foreach($lines as $line){
			if(preg_match("/group /",$line)==1) {
				$route = preg_split("/\s{1,}/", $line); 
				$routes[$i]['gname']= $route[1];
				$routes[$i]['start']= $route[2];
				$routes[$i]['end']= $route[3];
				$key1[]=$route[1];
				$i++;
			}
		}
		if(!empty($routes))
		array_multisort($key1,SORT_ASC,$routes);

		/**/
		$this->assign('ukid', $keyid[0]['pc_id']);
		$this->assign('vpnpool', $routes);
		$this->assign("sourceip", $sourceip);
		$this->assign("weektime", $weektime);
		$this->assign("usergroup", $usergroup);
		$this->assign("allgroup",$allgroup);
		$this->assign('allusbkey',$allusbkey);
		$this->assign('title',language('编辑用户'));

		$config = $this->setting_set->select_all(" sname='password_policy'");
		//var_dump($config);
		$pwdconfig = unserialize($config[0]['svalue']);
		$pwdshould = '密码中应包含：';
		if($pwdconfig['pwdstrong1']) $pwdshould .= '数字,';
		if($pwdconfig['pwdstrong2']) $pwdshould .= '字母,';
		if($pwdconfig['pwdstrong4']) $pwdshould .= '特殊字符,';
		if($pwdshould != '密码中应包含：'){
		$this->assign("pwdshould", substr($pwdshould,0,strlen($pwdshould)-1));
		}

		$this->display('member_add.tpl');
	}
	
	function edit_self() {
		$msg = get_request('msg', 0, 1);
		$member = $this->member_set->select_by_id($_SESSION['ADMIN_UID']);
		$member["password"] = $this->member_set->udf_decrypt($member["password"]);
		$member["username"] = $member["username"];
		$this->assign('msg', empty($msg) ? '' : '请修改密码');
		$this->assign('member', $member);
		
		$config = $this->setting_set->select_all(" sname='password_policy'");
		//var_dump($config);
		$pwdconfig = unserialize($config[0]['svalue']);
		$pwdshould = '密码中应包含：';
		if($pwdconfig['pwdstrong1']) $pwdshould .= '数字,';
		if($pwdconfig['pwdstrong2']) $pwdshould .= '字母,';
		if($pwdconfig['pwdstrong4']) $pwdshould .= '特殊字符,';
		if($pwdshould != '密码中应包含：'){
			$this->assign("pwdshould", substr($pwdshould,0,strlen($pwdshould)-1));
		}	

		$this->display('member_edit_self.tpl');
	}

	function save() {
		global $_CONFIG;
		$type = get_request('type', 0, 1);
		$newmember = new member();
		$password1 = get_request('password1', 1, 1);
		$password2 = get_request('password2', 1, 1);
		$acgroup = get_request('acgroup',1,1,'');
		$uid = get_request('uid');
		$uname = get_request('username', 1, 1);
		$g_id = get_request('g_id',1,0);
		$usbkey = get_request('usbkey', 1, 1);
		$ip = get_request('ip', 1, 1,'');
		$limit_time = get_request('limit_time', 1, 1);
		$nolimit = get_request('nolimit', 1, 1);
		$sourceip = get_request('sourceip', 1, 1);
		$weektime = get_request('weektime', 1, 1);
		$start_time = get_request('start_time', 1, 1);
		$groupid = get_request('groupid', 1, 0);
		$musergroup = get_request('musergroup', 1, 0);
		$autosetpwd = get_request('autosetpwd', 1, 0);
		$priv = get_request('priv', 1, 0);
		$vpnip = get_request('vpnip', 1, 1);
		$netdisksize = get_request('netdisksize', 1, 1);
		$default_control = get_request('default_control', 1, 0);
		$allowchange = get_request('allowchange', 1, 1);
		$common_user_pri = get_request('common_user_pri', 1, 1);		
	
		if(empty($nolimit) and empty($limit_time)){
			alert_and_back('请选择过期时间');
			exit();
		}
		
		if($start_time){
			$newmember->set_data('start_time', $start_time);
		}
		if($nolimit){
			$newmember->set_data('end_time', '2037:1:1 0:0:0');
		}else{
			$newmember->set_data('end_time', $limit_time);
		}
		if($netdisksize){
			$newmember->set_data('netdisksize', $netdisksize);
		}
		if($allowchange == 'on') {
			$newmember->set_data('allowchange',1);
		}
		else {
			$newmember->set_data('allowchange',0);
		}
		if($common_user_pri == 'on') {
			$newmember->set_data('common_user_pri',1);
		}
		else {
			$newmember->set_data('common_user_pri',0);
		}
		
		$newmember->set_data('default_control', $default_control);
		
		
		if(!empty($password1)){			
			
			$config = $this->setting_set->select_all(" sname='password_policy'");
			//var_dump($config);
			$pwdconfig = unserialize($config[0]['svalue']);
			$reg = '';
			//var_dump($pwdconfig);var_dump($password1);
		
			$pwdmsg = '';
			if($pwdconfig['pwdstrong1']&&!preg_match('/[0-9]+/', $password1)){
				//alert_and_back('密码中需要包含数字');
				//exit;
				$pwdmsg .= '数字'." ";
			}
			if(!$pwdconfig['pwdstrong1']&&preg_match('/[0-9]+/', $password1)){
				//alert_and_back('密码中不能包含数字');
				//exit;
				$pwdmsgn .= '数字'." ";
			}
			if($pwdconfig['pwdstrong2']&&!preg_match('/[a-zA-Z]+/', $password1)){
				//alert_and_back('密码中需要包含小写字母');
				//exit;
				$pwdmsg .= '字母'." ";
			}
			if(!$pwdconfig['pwdstrong2']&&preg_match('/[a-zA-Z]+/', $password1)){
				//alert_and_back('密码中不能包含小写字母');
				//exit;
				$pwdmsgn .= '字母'." ";
			}
			
			$pwd_replace = preg_replace('/[0-9a-zA-Z]+/','', $password1);
			if($pwdconfig['pwdstrong4']&&strlen($pwd_replace)==0){
				//alert_and_back('密码中需要包含特殊字符');
				//exit;
				$pwdmsg .= '特殊字符'." ";
			}
			if(!$pwdconfig['pwdstrong4']&&strlen($pwd_replace)>0){
				//alert_and_back('密码中不能包含特殊字符');
				//exit;
				$pwdmsgn .= '特殊字符'." ";
			}
			if(strlen($password1) < $pwdconfig['login_pwd_length']){
				//alert_and_back(language('密码最少长度为').$pwdconfig['login_pwd_length']);
				//exit();
				$pwdmsgl = language('密码最少长度为').$pwdconfig['login_pwd_length'];
			}

			
			$pwd_ban_word_arr = explode('1', str_replace(' ', '空格', $_CONFIG['PASSWORD_BAN_WORD']));			
			if($pwd_ban_word_arr){
				$pwd_ban_word_str = implode(' ', $pwd_ban_word_arr);
			}			
			for($pi=0; $pi<count($pwd_ban_word_arr); $pi++){
				if(strpos($password1, $pwd_ban_word_arr[$pi])!==false){
					$pwdmsg2='密码中不能包含以下字符:'.addslashes($pwd_ban_word_str).' \n请重新输入';
					break;
				}
			}
			if(!empty($pwdmsg) || !empty($pwdmsgl) || !empty($pwdmsg2)){
				if($pwdconfig['pwdstrong1'] || $pwdconfig['pwdstrong2'] || $pwdconfig['pwdstrong4']){
					$pwdmsgs .= '密码中需要包含:' .  ($pwdconfig['pwdstrong1'] ? '数字' : '').($pwdconfig['pwdstrong2'] ? '字母' : '').($pwdconfig['pwdstrong4'] ? '特殊字符' : ''). "\\n";
				}
				$pwdmsgs .= language('密码最少长度为').$pwdconfig['login_pwd_length']."\\n";
				if(count($pwd_ban_word_str)>0){
					$pwdmsgs .= '密码中不能包含以下字符:'.addslashes($pwd_ban_word_str).' \n\n请重新输入';
				}
				alert_and_back($pwdmsgs);
				exit;
			}
		}

		if($serverIds)
		$serverString=implode(",", $serverIds);
		$newmember->set_data("devs", ",".$serverString.",");
		if($uid != 0) {
			$flist = get_request('flist', 1, 1);
			$uid = get_request('uid');
			$newmember->set_data('uid',$uid);
			
			if(empty($autosetpwd)){
				if(!($password1 == "" && $password2 == "")) {
					if($password1 == $password2) {
						if($_CONFIG['crypt']==1){
							$password1 = encrypt($password1);
						}
						$newmember->set_data('password', $password1);
					}
					else {
						alert_and_back('两次输入的密码不一致');
						exit();
					}
				}
			}else{
				$password1 = genRandomPassword(8);
				$newmember->set_data('password', $password1);
			}
			$this->devpass_set->query("UPDATE ".$this->devpass_set->get_table_name()." SET old_password=cur_password,cur_password='".$password1."' WHERE username='".get_request('username', 1, 1)."' AND radiususer=".$uid);
			$newmember->set_data('flist', serialize($flist));


		}
		else {
			if(empty($autosetpwd)){
				if($password1 == $password2) {
						if($_CONFIG['crypt']==1){
							$password1 = encrypt($password1);
						}
					$newmember->set_data('password', $password1);
					
				}
				else {
					alert_and_back('两次输入的密码不一致');
					exit();
				}
			}else{
				$password1 = genRandomPassword(8);
				$newmember->set_data('password', $password1);
				
			}
			
			$newmember->set_data('username', get_request('username', 1, 1));
		}
		
		

		$email = get_request('email', 1, 1);
		if($autosetpwd&&empty($email)){
			alert_and_back('由于您设置了随机密码,请输入邮件地址');
			exit;
		}
		$newmember->set_data('realname', get_request('realname', 1, 1));
		$newmember->set_data('email', get_request('email', 1, 1));
		$newmember->set_data('vpnip', $vpnip);
		$newmember->set_data("sourceip", $sourceip);		
		$newmember->set_data("weektime", $weektime);
		$newmember->set_data("groupid", $groupid);
		if($_SESSION['ADMIN_LEVEL']==3){
			$newmember->set_data("groupid", $_SESSION['ADMIN_MUSERGROUP']);
		}

		if($uid != 0) {
			$user = $this->member_set->select_by_id($uid);
			if($user['password']!=$password1){
				$adminlog = new admin_log();	
				$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);			
				$adminlog->set_data('action', language('修改密码'));
				$adminlog->set_data('luser', $user['username']);
				$this->admin_log_set->add($adminlog);
				
			}
		}
		
			$this->usbkey_set->query("UPDATE radkey SET isused=1 WHERE keyid='".$usbkey."'");
			$newmember->set_data('usbkey', $usbkey);

		if(!empty($ip)){
			$ip_arr = explode(".", $ip);
			if(count($ip_arr) <= 4 && $ip_arr[0]=='10' && $ip_arr[1]=='11' && ($ip_arr[2]>=0 && $ip_arr[2]<=255) && ($ip_arr[3]>=1 && $ip_arr[3]<=255) && $ip != '10.11.0.1'){
				if($this->member_set->select_all("ip = '" . $ip . "' AND uid != $uid") != NULL ){
					alert_and_back('该IP已存在,请重新选择');exit;
				}
			}else{
				alert_and_back('IP输入不正确');exit;
			}
		}
		$newmember->set_data('ip', $ip);

		if($newmember->get_errnum() == 0) {
			if($uid == 0) {
				//$allpasswd = $this->update_user();
				if($this->member_set->select_all("username = '" . $newmember->get_data('username') . "'") == NULL ) {

					$newgroup = new acgroup();
					$newgroup->set_data('username',$newmember->get_data('username'));
					$newgroup->set_data('value',$acgroup);
					$this->acgroup_set->add($newgroup);

					
					$newmember->set_data('level', get_request('level', 1, 0));
					if($_SESSION['ADMIN_LEVEL']==3){
						$newmember->set_data("level", 0);
					}
					/*只有普通用户才有Radius用户,系统用户和密码托管用户*/
					//if($newmember->get_data('level') == 0) {
						$new_radius = new radius();						
						$new_radius->set_data("UserName",$newmember->get_data('username'));
						$new_radius->set_data("Attribute",'Crypt-Password');
						$new_radius->set_data("email",$newmember->get_data('email'));
						$new_radius->set_data("Value",crypt($newmember->get_data('password'),"\$1\$qY9g/6K4"));
						$this->radius_set->add($new_radius);
						/*
						$new_pro = new pro();
						$new_pro->set_data("username",$this->encryp($newmember->get_data('username')));
						for($i = 1;$i<6;$i++) {
							$new_pro->set_data("user$i",get_request("user$i",1,1));
						}
						$this->pro_set->add($new_pro);
						*/
						$out = '';
						//command("sudo /usr/sbin/useradd ". $newmember->get_data('username'), $out);	
						//command("echo \"".$password1."\" | sudo passwd --stdin " . $newmember->get_data('username'), $out);
					//}
					//else
					//var_dump($newmember->get_data('level')) ;
					if($newmember->get_data('level') == 3) {
						$newmember->set_data('mservergroup',$g_id);
						$newmember->set_data('musergroup',$musergroup);
					}
					$newmember->set_data("password", $this->member_set->udf_encrypt($newmember->get_data("password")));

					$this->member_set->add($newmember);
					
					$passwordlog = new passwordlog();
					$passwordlog->set_data('uid', mysql_insert_id());
					$passwordlog->set_data('password', md5($password1));
					$passwordlog->set_data('time', mktime());
					$this->passwordlog_set->add($passwordlog);

					

					//记录日志
					$adminlog = new admin_log();
					$adminlog->set_data('luser', $newmember->get_data('username'));
					$adminlog->set_data('action', language('添加'));
					$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
					$this->admin_log_set->add($adminlog);	
					if($autosetpwd){
						$ha = $this->config_set->base_select("SELECT * FROM alarm LIMIT 1");
						$smtp = new smtp_mail($ha[0]['MailServer'],"25",$ha[0]['account'],$this->member_set->udf_decrypt($ha[0]['password']), false);
						$smtp->send($ha[0]['account'],$newmember->get_data('email'),$_CONFIG['site']['title']." 随机密码",($newmember->get_data('username')).",你好:\n  你的随机密码是:".$this->member_set->udf_decrypt($newmember->get_data('password')));
					}

					$newuattr = new uattr();//添加登陆等级
					$newuattr->set_data('username', $uname);
					$newuattr->set_data('attribute', $_CONFIG['attributes'][2]['name']);
					$newuattr->set_data('value', $_CONFIG['attributes'][2]['default'].$priv);
					$this->uattr_set->add($newuattr);

					

					alert_and_back('成功添加用户', 'admin.php?controller=admin_member');
				}
				else {
					alert_and_back('该用户已存在', NULL, 1);
					exit();
				}
			}
			else {
				$user = $this->member_set->select_by_id($uid);

				if($user['password'] != $this->member_set->udf_encrypt($newmember->get_data("password"))){
					$passlog = $this->passwordlog_set->select_count(" uid='$uid' and password=md5('$password1')");
					if($passlog>0){
						alert_and_back('该密码已经使用过,请重新选择');
						exit();
					}
				}
				if($user['usbkey'])
				$this->usbkey_set->query("UPDATE radkey SET isused=0 WHERE keyid='".$user['usbkey']."'");
				if($this->acgroup_set->select_count("username = '".$user['username']."'") == 0) {
					$newgroup = new acgroup();
					$newgroup->set_data('username',$user['username']);
					$newgroup->set_data('value',$acgroup);
					$this->acgroup_set->add($newgroup);
				}
				else {
					$newgroup = new acgroup();
					$oldgroup = $this->acgroup_set->select_all("username ='".$user['username']."'");
					$newgroup->set_data('id',$oldgroup[0]['id']);
					$newgroup->set_data('value',$acgroup);
					$this->acgroup_set->edit($newgroup);
				}
				/*只有普通用户才有Radius用户*/
				//if($newmember->get_data('level') != 3)
				{
					$old_radius = $this->radius_set->select_all("UserName = '".$user['username']."'");
					$new_radius = new radius();
					$new_radius->set_data("id",$old_radius[0]['id']);
					$new_radius->set_data("email",$newmember->get_data('email'));
					if($newmember->get_data('password') != '') {
 						$new_radius->set_data("Value",crypt($newmember->get_data('password'),"\$1\$qY9g/6K4"));
						$newmember->set_data('lastdateChpwd', mktime());
					}						
					$this->radius_set->edit($new_radius);

				}
				if($user['level'] == 3) {
						$newmember->set_data('mservergroup',$g_id);
						$newmember->set_data('musergroup',$musergroup);
						
				}

				$adminlog = new admin_log();
				$adminlog->set_data('luser', $user['username']);
				$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
				$adminlog->set_data('action', language('编辑'));
				$this->admin_log_set->add($adminlog);
				if($user['username']=='password'){
						$cmd = "echo \"".$password1."\" | sudo passwd --stdin " . $user['username'];
						command($cmd, $out);	
				}
				$newmember->set_data("password", $this->member_set->udf_encrypt($newmember->get_data("password")));
				if($user['password']!=$newmember->get_data("password")){
					$passwordlog = new passwordlog();
					$passwordlog->set_data('uid', $uid);
					$passwordlog->set_data('password', md5($password1));
					$passwordlog->set_data('time', mktime());
					$this->passwordlog_set->add($passwordlog);
					if($pwdconfig['oldpassnumber']&&($cpnum=$this->passwordlog_set->select_count("uid=".$passwordlog->get_data('uid')))>$pwdconfig['oldpassnumber']){
						
						$this->passwordlog_set->query("DELETE FROM ".$this->passwordlog_set->get_table_name()." WHERE uid=$uid ORDER BY id ASC LIMIT ".($cpnum-$pwdconfig['oldpassnumber']));
					}
				}
				$this->member_set->edit($newmember);
				if($autosetpwd){
						$ha = $this->config_set->base_select("SELECT * FROM alarm LIMIT 1");
						$smtp = new smtp_mail($ha[0]['MailServer'],"25",$ha[0]['account'],$this->member_set->udf_decrypt($ha[0]['password']), false);
						$smtp->send($ha[0]['account'],$newmember->get_data('email'),$_CONFIG['site']['title']." 随机密码",($user['username']).",你好:\n  你的随机密码是:".$this->member_set->udf_decrypt($newmember->get_data('password')));
				}

				$olduattr = $this->uattr_set->select_all("username = '".$user['username']."' and attribute = '". $_CONFIG['attributes'][2]['name'] ."'");
				if(empty($olduattr)){
					$newuattr = new uattr();//添加登陆等级
					$newuattr->set_data('username', $user['username']);
					$newuattr->set_data('attribute', $_CONFIG['attributes'][2]['name']);
					$newuattr->set_data('value',$_CONFIG['attributes'][2]['default'].$priv);
					$this->uattr_set->add($newuattr);
				}else{
					$newuattr = new uattr();//修改登陆等级
					$newuattr->set_data('id', $olduattr[0]['id']);
					$newuattr->set_data('value', $_CONFIG['attributes'][2]['default'].$priv);

					$this->uattr_set->edit($newuattr);
				}
			
			
				alert_and_back('成功编辑用户', 'admin.php?controller=admin_member');
			}
		}
		else {
			alert_and_back($newmember->get_firsterr(), NULL, 1);
			exit();
		}
	}

	
	function batchadd(){
		$usergroup = $this->usergroup_set->select_all('1=1'.($_SESSION['ADMIN_LEVEL']==3 ? ' AND id=(SELECT musergroup FROM member WHERE uid='.$_SESSION['ADMIN_UID'].')' : ''),'GroupName', 'ASC');
		$this->assign("usergroup", $usergroup);
		$this->display('batchadd.tpl');
	}

	function batchadd_save($encrypt){
		global $_CONFIG;
		$error = null;
		$_POSTS=$_POST;
		
		for($i=0; $i<count($_POSTS['username']); $i++){
			
			$newmember = new member();
			$username = $_POSTS['username'][$i];
			if(empty($username)){
				continue;
			}
	
			$password = $_POSTS['password'][$i];
			$confirm_password = $_POSTS['confirm_password'][$i];
			$level = $_POSTS['level'][$i];
			$newmember->set_data('end_time', $limit_time);
			$newmember->set_data('netdisksize', $netdisksize);
			$newmember->set_data('allowchange',0);
			$newmember->set_data('default_control', $default_control);
			$newmember->set_data('end_time', '2037:1:1 0:0:0');

			if(!empty($password)){			
				$config = $this->setting_set->select_all(" sname='password_policy'");
				$pwdconfig = unserialize($config[0]['svalue']);
				$reg = '';			
				$pwdmsg = '';
				if($pwdconfig['pwdstrong1']&&!preg_match('/[0-9]+/', $password)){
					$pwdmsg .= '数字'." ";
				}
				if(!$pwdconfig['pwdstrong1']&&preg_match('/[0-9]+/', $password)){
					$pwdmsgn .= '数字'." ";
				}
				if($pwdconfig['pwdstrong2']&&!preg_match('/[a-zA-Z]+/', $password)){
					$pwdmsg .= '字母'." ";
				}
				if(!$pwdconfig['pwdstrong2']&&preg_match('/[a-zA-Z]+/', $password)){
					$pwdmsgn .= '字母'." ";
				}
				
				$pwd_replace = preg_replace('/[0-9a-zA-Z]+/','', $password);
				if($pwdconfig['pwdstrong4']&&strlen($pwd_replace)==0){
					$pwdmsg .= '特殊字符'." ";
				}
				if(!$pwdconfig['pwdstrong4']&&strlen($pwd_replace)>0){
					$pwdmsgn .= '特殊字符'." ";
				}
				if(strlen($password) < $pwdconfig['login_pwd_length']){
					$pwdmsgl = language('密码最少长度为').$pwdconfig['login_pwd_length'].',';
				}

				
				$pwd_ban_word_arr = explode('1', str_replace(' ', '空格', $_CONFIG['PASSWORD_BAN_WORD']));			
				if($pwd_ban_word_arr){
					$pwd_ban_word_str = implode(' ', $pwd_ban_word_arr);
				}			
				for($pi=0; $pi<count($pwd_ban_word_arr); $pi++){
					if(strpos($password1, $pwd_ban_word_arr[$pi])!==false){
						$pwdmsg2='密码中不能包含以下字符:'.addslashes($pwd_ban_word_str).'';
						break;
					}
				}
				$pwdmsgs=null;
				if(!empty($pwdmsg) || !empty($pwdmsgl) || !empty($pwdmsg2)){
					if($pwdconfig['pwdstrong1'] || $pwdconfig['pwdstrong2'] || $pwdconfig['pwdstrong4']){
						$pwdmsgs .= '密码中需要包含:' .  ($pwdconfig['pwdstrong1'] ? '数字' : '').($pwdconfig['pwdstrong2'] ? '字母' : '').($pwdconfig['pwdstrong4'] ? '特殊字符' : '');
					}
					$pwdmsgs .= language('密码最少长度为').$pwdconfig['login_pwd_length'];
					if(count($pwd_ban_word_str)>0){
						$pwdmsgs .= '密码中不能包含以下字符:'.addslashes($pwd_ban_word_str);
					}
					$error[]=$username.':'.$pwdmsgs.'\n';
					//alert_and_back($pwdmsgs);
					//exit;
					continue;
				}
			}

			
			if($password == $confirm_password) {
				if($_CONFIG['crypt']==1){
					$password1 = encrypt($password);
				}
				$newmember->set_data('password', $this->member_set->udf_encrypt($password));
			}
			else {
				//alert_and_back('两次输入的密码不一致');
				$error[]=$username.':两次输入的密码不一致\n';
				continue;
			}
			$newmember->set_data('username', $username);

			if($this->member_set->select_all("username = '" . $newmember->get_data('username') . "'") != NULL){
				$error[]=$username.':帐户已经存在\n';
				continue;
			}

			$newgroup = new acgroup();
			$newgroup->set_data('username',$newmember->get_data('username'));
			$newgroup->set_data('value',$acgroup);
			$this->acgroup_set->add($newgroup);
			
			$newmember->set_data('level', $level);
			if(isset($_POST['groupid'][$i])){
				$newmember->set_data("groupid", $_POST['groupid'][$i]);
			}
			if($_SESSION['ADMIN_LEVEL']==3){
				$newmember->set_data("level", 0);
				$newmember->set_data("groupid", $_SESSION['ADMIN_MUSERGROUP']);
			}
			/*只有普通用户才有Radius用户,系统用户和密码托管用户*/
			//if($newmember->get_data('level') == 0) {
			$new_radius = new radius();						
			$new_radius->set_data("UserName",$newmember->get_data('username'));
			$new_radius->set_data("Attribute",'Crypt-Password');
			$new_radius->set_data("email",$newmember->get_data('email'));
			$new_radius->set_data("Value",crypt($password,"\$1\$qY9g/6K4"));
			$this->radius_set->add($new_radius);
			$succeed[]=$newmember->get_data('username');
			$this->member_set->add($newmember);

			$passwordlog = new passwordlog();
			$passwordlog->set_data('uid', mysql_insert_id());
			$passwordlog->set_data('password', md5($password1));
			$passwordlog->set_data('time', mktime());
			$this->passwordlog_set->add($passwordlog);
			//记录日志
			$adminlog = new admin_log();
			$adminlog->set_data('luser', $newmember->get_data('username'));
			$adminlog->set_data('action', language('添加'));
			$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
			$this->admin_log_set->add($adminlog);			
		}

		if($succeed){
			$msg = '成功添加用户:'.implode(',',$succeed);
			if($error){
				$msg .= '\n添加失败的用户:\n'.implode('\n',$error).'\n';
			}
			alert_and_back($msg,'admin.php?controller=admin_member');
		}else{
			alert_and_back('添加失败:\n'.implode('\n',$error).'\n');
		}
	}

	
	function delete() {
		$uid = get_request('uid');
		$user = $this->member_set->select_by_id($uid);
		$out = "";
		if($user['level'] == 0) {
			command("who | grep ".$user['username'],$out);
			if(count($out)<1 || $out == "" || 1) {
				if($user['username']=='password'){
					$cmd = "sudo /usr/sbin/userdel -r " . $user['username'];
					//echo $cmd;
					command($cmd, $out);	
				}
				
				$this->acgroup_set->delete($user['username'],'username');
				$this->radius_set->delete($user['username'],'username');
				$this->member_set->delete($uid);
				$this->luser_set->delete_all(' memberid='.$uid);
				$this->luser_resourcegrp_set->delete_all(' memberid='.$uid);
				/*
				$keys = $this->keys_set->select_all("UserName = '$user[username]'");
				$this->usbkey_set->release($keys[0]['pc_id']);
				$this->usbkey_set->remove($keys[0][pc_id]);
				*/
				$adminlog = new admin_log();
				$adminlog->set_data('luser', $user['username']);
				$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
				$adminlog->set_data('action', language('删除'));
				$this->admin_log_set->add($adminlog);
				$radius = $this->radius_set->select_all("UserName='".$user['username']."'");
				for($i=0; $i<count($radius); $i++){
					$rid[]=$radius[$i]['id'];
				}
				if($rid){
					$this->radius_set->delete($rid);
				}
				
				$this->luser_set->query("DELETE FROM luser WHERE memberid=".$user['uid']);
				$this->luser_set->query("DELETE FROM luser_devgrp WHERE memberid=".$user['uid']);
				
				alert_and_back('成功删除用户','admin.php?controller=admin_member');
			}
			else {
				alert_and_back('用户还在线,无法删除','admin.php?controller=admin_member');
			}
		}
		else {
				$this->acgroup_set->delete($user['username'],'username');
				$this->member_set->delete($uid);
				
				$adminlog = new admin_log();
				$adminlog->set_data('luser', $user['username']);
				$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
				$adminlog->set_data('action', language('删除'));
				$this->admin_log_set->add($adminlog);
				

				alert_and_back('成功删除用户','admin.php?controller=admin_member');
		}
	}
	
	function save_self() {
		global $_CONFIG;
		$newmember = new member();
		$oripassword = get_request('oripassword', 1, 1);
		$password1 = get_request('password1', 1, 1);
		$password2 = get_request('password2', 1, 1);
		$default_control = get_request('default_control', 1, 0);
		$rdp_screen = get_request('rdp_screen', 1, 0);
		$login_tip = get_request('login_tip', 1, 0);
		
		$uid = $_SESSION['ADMIN_UID'];
		$user = $this->member_set->select_by_id($uid);
		$newmember->set_data('uid',$uid);		
		$newmember->set_data('rdp_screen', $rdp_screen);
		$newmember->set_data('login_tip', $login_tip);
		if($password1){
			$passlog = $this->passwordlog_set->select_count(" uid='$uid' and password=md5('$password1')");
			if($passlog>0){
				alert_and_back('改密码已经使用过,请重新选择');
				exit();
			}
		}
					
		if(!($password1 == "" && $password2 == "")) {
			
			$config = $this->setting_set->select_all(" sname='password_policy'");
			//var_dump($config);
			$pwdconfig = unserialize($config[0]['svalue']);
			$reg = '';
			//var_dump($pwdconfig);var_dump($password1);
			$pwdmsg = '';
			if($pwdconfig['pwdstrong1']&&!preg_match('/[0-9]+/', $password1)){
				//alert_and_back('密码中需要包含数字');
				//exit;
				$pwdmsg .= '数字'." ";
			}
			if(!$pwdconfig['pwdstrong1']&&preg_match('/[0-9]+/', $password1)){
				//alert_and_back('密码中不能包含数字');
				//exit;
				$pwdmsgn .= '数字'." ";
			}
			if($pwdconfig['pwdstrong2']&&!preg_match('/[a-zA-Z]+/', $password1)){
				//alert_and_back('密码中需要包含小写字母');
				//exit;
				$pwdmsg .= '字母'." ";
			}
			if(!$pwdconfig['pwdstrong2']&&preg_match('/[a-zA-Z]+/', $password1)){
				//alert_and_back('密码中不能包含小写字母');
				//exit;
				$pwdmsgn .= '字母'." ";
			}			
			$pwd_replace = preg_replace('/[0-9a-zA-Z]+/','', $password1);
			if($pwdconfig['pwdstrong4']&&strlen($pwd_replace)==0){
				//alert_and_back('密码中需要包含特殊字符');
				//exit;
				$pwdmsg .= '特殊字符'." ";
			}
			if(!$pwdconfig['pwdstrong4']&&strlen($pwd_replace)>0){
				//alert_and_back('密码中不能包含特殊字符');
				//exit;
				$pwdmsgn .= '特殊字符'." ";
			}
			if(strlen($password1) < $pwdconfig['login_pwd_length']){
				//alert_and_back(language('密码最少长度为').$pwdconfig['login_pwd_length']);
				//exit();
				$pwdmsgl = language('密码最少长度为').$pwdconfig['login_pwd_length'];
			}

			$pwd_ban_word_arr = explode('1', str_replace(' ', '空格', $_CONFIG['PASSWORD_BAN_WORD']));			
			if($pwd_ban_word_arr){
				$pwd_ban_word_str = implode(' ', $pwd_ban_word_arr);
			}			
			for($pi=0; $pi<count($pwd_ban_word_arr); $pi++){
				if(strpos($password1, $pwd_ban_word_arr[$pi])!==false){
					$pwdmsg2='密码中不能包含以下字符:'.addslashes($pwd_ban_word_str).' \n请重新输入';
					break;
				}
			}
			if(!empty($pwdmsg) || !empty($pwdmsgl) || !empty($pwdmsg2)){
				if($pwdconfig['pwdstrong1'] || $pwdconfig['pwdstrong2'] || $pwdconfig['pwdstrong4']){
					$pwdmsgs .= '密码中需要包含:' .  ($pwdconfig['pwdstrong1'] ? '数字' : '').($pwdconfig['pwdstrong2'] ? '字母' : '').($pwdconfig['pwdstrong4'] ? '特殊字符' : ''). "\\n";
				}
				$pwdmsgs .= language('密码最少长度为').$pwdconfig['login_pwd_length']."\\n";
				if(count($pwd_ban_word_str)>0){
					$pwdmsgs .= '密码中不能包含以下字符:'.addslashes($pwd_ban_word_str).' \n\n请重新输入';
				}
				alert_and_back($pwdmsgs);
				exit;
			}

			if($oripassword!=$this->member_set->udf_decrypt($user['password'])){
				alert_and_back('原密码不正确');
				exit();
			}
			if($oripassword==$password1){
				alert_and_back('不能与原密码相同');
				exit();
			}
			if($password1 == $password2) {
				if($_CONFIG['crypt']==1){
					$password1 = encrypt($password1);
				}
				$newmember->set_data('password', $this->member_set->udf_encrypt($password1));
				$newmember->set_data('lastdateChpwd', mktime());
				$this->devpass_set->query("UPDATE ".$this->devpass_set->get_table_name()." SET old_password=cur_password,cur_password='".$this->devpass_set->udf_encrypt('".$password1."')."' WHERE username='".$user['username']."' AND radiususer=".$uid);
				
				$passwordlog = new passwordlog();
				$passwordlog->set_data('uid', $uid);
				$passwordlog->set_data('password', md5($password1));
				$passwordlog->set_data('time', mktime());
				$this->passwordlog_set->add($passwordlog);
				if($pwdconfig['oldpassnumber']&&($cpnum=$this->passwordlog_set->select_count("uid=".$passwordlog->get_data('uid')))>$pwdconfig['oldpassnumber']){
					$this->passwordlog_set->query("DELETE FROM ".$this->passwordlog_set->get_table_name()." WHERE uid=$uid ORDER BY id ASC LIMIT ".($cpnum-$pwdconfig['oldpassnumber']));
				}
			}
			else {
				alert_and_back('两次输入的密码不一致');
				exit();
			}

			
		}
		$newmember->set_data('realname', get_request('realname', 1, 1));
		$newmember->set_data('email', get_request('email', 1, 1));
		$newmember->set_data('default_control', $default_control);
		
		
		//if($user['level'] == 0 || $_CONFIG["OTHER_MEMBER_RADIUS"]==1) 
		{
			$old_radius = $this->radius_set->select_all("UserName = '".$user['username']."'");
			$new_radius = new radius();
			$new_radius->set_data("id",$old_radius[0]['id']);
			$new_radius->set_data("email",$user['email']);
			if($newmember->get_data('password') != '') {
				$new_radius->set_data("Value",crypt($password1,"\$1\$qY9g/6K4"));
			}						
			$this->radius_set->edit($new_radius);
			

			//$cmd = "echo \"".$password1."\" | sudo passwd --stdin " . $user['username'];
			//echo $cmd;
			//command($cmd, $out);	
		}

		$url =  'admin.php?controller=admin_session&action=index';
		if($_SESSION['ADMIN_LEVEL']==10){
			$url = 'admin.php?controller=admin_index&action=main';
		}elseif($_SESSION['ADMIN_LEVEL']==0){
			$url = 'admin.php?controller=admin_index&action=main';
		}
		if($newmember->get_errnum() == 0) {
			$this->member_set->edit($newmember);
			if($user['level'] == 0) {
				alert_and_back('成功编辑个人信息');
			}else{
				alert_and_back('成功编辑个人信息');
			}
		}
	}

	function loginlock() {
		$loginlock = get_request('loginlock', 0, 0);
		$uid = get_request('uid');
		$userinfo = $this->member_set->select_by_id($uid);
		if($userinfo['username'] == 'admin'){
			alert_and_back('管理员不允许被锁');
			exit;
		}
		$member = new member();
		$member->set_data('uid', $uid);
		$member->set_data('logintimes', ($loginlock ? 0 : 100));
		$member->set_data('loginlock', ($loginlock ? 0 : 1));
		$this->member_set->edit($member);
		alert_and_back('操作成功');
	}
	
	function delete_all() {
		$uid = get_request('chk_member', 1, 1);
		$usernames = $this->member_set->select_all(" uid IN (".implode(',', $uid).")");
		for($i=0; $i<count($usernames); $i++){
			$usernames_u[]=$usernames[$i]['username'];
		}
		$radius = $this->radius_set->select_all("UserName IN ('".implode("','",$usernames_u)."')");
		for($i=0; $i<count($radius); $i++){
			$rid[]=$radius[$i]['id'];
		}
		if($rid){
			$this->radius_set->delete($rid);
		}

		$this->member_set->delete($uid);
		
		$adminlog = new admin_log();
		$adminlog->set_data('luser', implode(',', $usernames_u));
		$adminlog->set_data('administrator', $_SESSION['ADMIN_USERNAME']);
		$adminlog->set_data('action', '删除');
		$this->admin_log_set->add($adminlog);
		
		alert_and_back('成功删除用户');
	}
}
?>
