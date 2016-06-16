<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function is_ip($ip) {
	return (!strcmp(long2ip(sprintf("%u",ip2long($ip))),$ip));
}


function get_sess_username( $data, $name = 'ADMIN_USERNAME', $vtype = 's' )
{
    if(  strlen( $data) == 0)
    {
        return '';
    }
    $name_pos = strpos($data,$name);
	if($name_pos===false){
		return '';
	}
	if($vtype=='i'){
		$aftername1 = strpos($data, ':', $name_pos)+1;
		$aftername2 = strpos($data, ';', $aftername1);
		return substr($data, $aftername1, $aftername2-$aftername1);		
	}else{
		$aftername1 = strpos($data, '"', $name_pos)+1;
		$aftername2 = strpos($data, '"', $aftername1);
		return substr($data, $aftername1, $aftername2-$aftername1);
	}
   
}

function get_online_number_by_users($username, $max_online_time){
	$session_path = ini_get('session.save_path');
	if(empty($session_path)){
		$session_path = '/tmp';
	}
	$exist_count = 0;
	if ($handle = @opendir($session_path)) {
		while (false !== ($file = @readdir($handle))) {
			if (substr($file,0,4)=='sess') {
				$sess_content = @file_get_contents($session_path.'/'.$file);
				$uname = get_sess_username($sess_content);
				$online_time = get_sess_username($sess_content,"startonlinetime", 'i');
				//var_dump($online_time);
				//var_dump($uname);
				if($uname==$username&&(mktime()-$online_time < $max_online_time)){
					$exist_count++;
				}else if($uname==$username){
					@unlink($session_path.'/'.$file);
				}
			}
		}
		@closedir($handle);
	}
	return $exist_count;
}

function get_online_users($username, $max_online_time){
	$session_path = ini_get('session.save_path');
	if(empty($session_path)){
		$session_path = '/tmp';
	}
	$exist_count = 0;
	$user = array();
	/*if($username==$_SESSION['ADMIN_USERNAME']){
		$user[$exist_count]['ssid'] = session_id();
		$user[$exist_count]['ip'] = $_SESSION["ADMIN_IP"];
		$user[$exist_count]['username'] = $_SESSION['ADMIN_USERNAME'];
		$user[$exist_count]['logindate'] = $_SESSION["ADMIN_LOGINDATE"];
		$user[$exist_count]['lastactime'] = date('Y-m-d H:i:s', mktime());
		$exist_count++;
	}*/
	if ($handle = opendir($session_path)) {
		while (false !== ($file = readdir($handle))) {
			if (substr($file,0,4)=='sess'/*&&substr($file,5)!=session_id()*/) {
				$sess_content = @file_get_contents($session_path.'/'.$file);
				$uname = get_sess_username($sess_content);
				$online_time = get_sess_username($sess_content,"startonlinetime", 'i');
				$testusername = ($uname!="")&&($username=="" ? 1 : $uname==$username);
				if($testusername&&(mktime()-$online_time < $max_online_time)){
					$user[$exist_count]['ssid'] = substr($file,5);
					$user[$exist_count]['ip'] = get_sess_username($sess_content,"ADMIN_IP");
					$user[$exist_count]['username'] = get_sess_username($sess_content,"ADMIN_USERNAME");
					$user[$exist_count]['level'] = get_sess_username($sess_content,"ADMIN_LEVEL");
					$user[$exist_count]['logindate'] = get_sess_username($sess_content,"ADMIN_LOGINDATE");
					$user[$exist_count]['lastactime'] = date('Y-m-d H:i:s',$online_time);
					$exist_count++;
				}else if($uname==$username){
					@unlink($session_path.'/'.$file);
				}
			}
		}
		closedir($handle);
	}
	return $user;
}

function offline_user($ssid){
	$session_path = ini_get('session.save_path');
	if(empty($session_path)){
		$session_path = '/tmp';
	}
	return unlink($session_path.'/sess_'.$ssid);
}

function genRandomPassword($len)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", 
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", 
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", 
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", 
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", 
        "3", "4", "5", "6", "7", "8", "9" ,"!", "@", "#", "$", "%",
		"^", "&", "*", "(", ")"
    );
    $charsLen = count($chars) - 1;
 
    shuffle($chars);    // 将数组打乱
    
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
 
    return $output;
 
} 

function genRandomString($len)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", 
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", 
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", 
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", 
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", 
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
 
    shuffle($chars);    // 将数组打乱
    
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
 
    return $output;
 
} 

function language($msg){	
	global $en,$cn;
	$newmsg = $msg;
	if(LANGUAGE == 'cn'){
		return $msg;
	}
	$num = count($cn);
	if($num){
		foreach($cn AS $key => $value){		
			if($value == $msg){
				$newmsg = $en[$key];
			}
		}
	}
	return $newmsg;
} 

function alert_and_back($msg, $url = NULL, $type = 0) {
	if($url == NULL) $url = $_SERVER['HTTP_REFERER'];
	$msg = language($msg);
	if($type == 0) {
		echo "<script language='javascript'>alert('$msg');location.href='$url';</script>";
	}
	else {
		echo "<script language='javascript'>alert('$msg');history.go(-1);</script>";
	}
}

function prompt($msg, $accurl = NULL, $refuurl= NULL)
{
	$msg = language($msg);
	echo "<script>if(confirm('".$msg."')) location.href='".$accurl."';else location.href='".$refuurl."'</script>";
}

function alert_and_close($msg) {
	$msg = language($msg);
	echo "<script language='javascript'>alert('$msg');window.close();</script>";
}

function go_url($url = NULL, $parent=0) {
	if($url == NULL) $url = $_SERVER['HTTP_REFERER'];
	if($parent==0)
		echo "<script language='javascript'>location.href='$url';</script>";
	else 
		echo "<script language='javascript'>parent.location.href='$url';</script>";
}

function sort_cat($allcat) {
	if(empty($allcat)) return;
	$i = 0;
	while (list($key, $val) = each($allcat)) {
		if($val['parentid'] == 0) {
			for($j = 0, $k = 1; $j < count($allcat); $j++) {
				if($allcat[$j]['parentid'] == $val['catid']) {
					$newcat[$i][$k]['catid'] = $allcat[$j]['catid'];
					$newcat[$i][$k++]['catname'] = $allcat[$j]['catname'];
				}
			}
			$newcat[$i][0]['catid'] = $val['catid'];
			$newcat[$i][0]['catname'] = $val['catname'];
			$i++;
		}
	}
	return $newcat;
}

function daddslashes($string, $force = 0) {
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}

function get_request($data, $from = 0, $type = 0, $default = NULL) {
	switch($from) {
		case 0: $_from = &$_GET;break;
		case 1; $_from = &$_POST;break;
		case 2; $_from = &$_COOKIE;break;
	}
	
	if(isset($_from[$data])) {
		$return_data = daddslashes($_from[$data]);	
	}
	else {
		$return_data = NULL;
	}
	
	if($type == 0 && !is_numeric($return_data)) {
		return $default === NULL ? 0 : $default;
	}
	else {
		return $return_data === NULL ? $default : $return_data;
	}
}

function is_admin() {
	if(!isset($_SESSION['ADMIN_LEVEL']) || $_SESSION['ADMIN_LEVEL'] != 1) {
		return false;
	}
	else {
		return true;
	}
}

function analyse_from_templet($templet) {
	/*
	$tmp = explode("\n", $templet);
	$config_file_count = $tmp[0];
	$result['config_file_list'] = array();
	$result['state_list'] = array();
	for($i = 1; $i <= $config_file_count; $i++) {
		array_push($result['config_file_list'], $tmp[$i]);
	}
	if(isset($tmp[$tmp[0] + 1])) {
		$state_count = $tmp[$tmp[0] + 1];
	}
	else {
		$state_count = 0;
	}

	for($i = $tmp[0] + 2; $i <= $state_count; $i++) {
		array_push($result['state_list'], $tmp[$i]);
	}
	*/
	//var_dump($templet);
	return unserialize($templet);
}

function analyse_to_templet($config_file_list, $state_list = null) {
	global $_CONFIG;
	$result = array();
	$result['config_file_list'] = array();
	for($i = 0; $i < count($config_file_list); $i++) {
		if(trim($config_file_list[$i]) != '') {
			array_push($result['config_file_list'], $config_file_list[$i]);
		}
	}
	$result['config_file_list'] = array_unique($result['config_file_list']);
	if($state_list != null) {
		$result['state_list'] = array();
		for($i = 0; $i < count($state_list); $i++) {
			if(is_numeric($state_list[$i])) {
				if(array_key_exists($state_list[$i], $_CONFIG['states'])) {
					array_push($result['state_list'], $_CONFIG['states'][$state_list[$i]]['name']);
				}
			}
			else {
				array_push($result['state_list'], $state_list[$i]);
			}
		}
		
		$result['state_list'] = array_unique($result['state_list']);
	}
	return serialize($result);
}

function diff($old, $new) 
{
   # split the source text into arrays of lines
   $t1 = explode("\n", $old);
   $x = array_pop($t1); 
   if ($x > '') $t1[] = "$x\n\\ No newline at end of file";
   $t2 = explode("\n", $new);
   $x = array_pop($t2); 
   if ($x > '') $t2[] = "$x\n\\ No newline at end of file";

   $t1_start = 0; $t1_end = count($t1);
   $t2_start = 0; $t2_end = count($t2);

   # stop with a common ending
   while ($t1_start < $t1_end && $t2_start < $t2_end 
          && $t1[$t1_end-1] == $t2[$t2_end-1]) { $t1_end--; $t2_end--; }

   # skip over any common beginning
   while ($t1_start < $t1_end && $t2_start < $t2_end 
          && $t1[$t1_start] == $t2[$t2_start]) { $t1_start++; $t2_start++; }

   # build a reverse-index array using the line as key and line number as value
   # don't store blank lines, so they won't be targets of the shortest distance
   # search
   for($i = $t1_start; $i < $t1_end; $i++) if ($t1[$i]>'') $r1[$t1[$i]][] = $i;
   for($i = $t2_start; $i < $t2_end; $i++) if ($t2[$i]>'') $r2[$t2[$i]][] = $i;

   $a1 = $t1_start; $a2 = $t2_start;   # start at beginning of each list
   $actions = array();

   # walk this loop until we reach the end of one of the lists
   while ($a1 < $t1_end && $a2 < $t2_end) {
     # if we have a common element, save it and go to the next
     if ($t1[$a1] == $t2[$a2]) { $actions[] = 4; $a1++; $a2++; continue; } 

     # otherwise, find the shortest move (Manhattan-distance) from the
     # current location
     $best1 = $t1_end; $best2 = $t2_end;
     $s1 = $a1; $s2 = $a2;
     while(($s1 + $s2 - $a1 - $a2) < ($best1 + $best2 - $a1 - $a2)) {
       $d = -1;
       foreach((array)@$r1[$t2[$s2]] as $n) 
         if ($n >= $s1) { $d = $n; break; }
       if ($d >= $s1 && ($d + $s2 - $a1 - $a2) < ($best1 + $best2 - $a1 - $a2))
         { $best1 = $d; $best2 = $s2; }
       $d = -1;
       foreach((array)@$r2[$t1[$s1]] as $n) 
         if ($n >= $s2) { $d = $n; break; }
       if ($d >= $s2 && ($s1 + $d - $a1 - $a2) < ($best1 + $best2 - $a1 - $a2))
         { $best1 = $s1; $best2 = $d; }
       $s1++; $s2++;
     }
     while ($a1 < $best1) { $actions[] = 1; $a1++; }  # deleted elements
     while ($a2 < $best2) { $actions[] = 2; $a2++; }  # added elements
  }

  # we've reached the end of one list, now walk to the end of the other
  while($a1 < $t1_end) { $actions[] = 1; $a1++; }  # deleted elements
  while($a2 < $t2_end) { $actions[] = 2; $a2++; }  # added elements

  # and this marks our ending point
  $actions[] = 8;

  # now, let's follow the path we just took and report the added/deleted
  # elements into $out.
  $op = 0;
  $x0 = $x1 = $t1_start; $y0 = $y1 = $t2_start;
  $out = array();
  foreach($actions as $act) {
    if ($act == 1) { $op |= $act; $x1++; continue; }
    if ($act == 2) { $op |= $act; $y1++; continue; }
    if ($op > 0) {
      $xstr = ($x1 == ($x0+1)) ? $x1 : ($x0+1) . ",$x1";
      $ystr = ($y1 == ($y0+1)) ? $y1 : ($y0+1) . ",$y1";
      if ($op == 1) $out[] = "{$xstr}d{$y1}";
      elseif ($op == 3) $out[] = "{$xstr}c{$ystr}";
      while ($x0 < $x1) { $out[] = '< ' . $t1[$x0]; $x0++; }   # deleted elems
      if ($op == 2) $out[] = "{$x1}a{$ystr}";
      elseif ($op == 3) $out[] = '---';
      while ($y0 < $y1) { $out[] = '> '.$t2[$y0]; $y0++; }   # added elems
    }
    $x1++; $x0 = $x1;
    $y1++; $y0 = $y1;
    $op = 0;
  }
  $out[] = '';
  return join("\n",$out);
}

function rsync($ip, $port, $username, $password, $remote_path, $locale_path, &$out) {
	//$cmd = "/usr/bin/sudo /usr/bin/rsync -t --timeout=5 -e 'ssh -p $port' '$username@'$ip:$remote_path $locale_path";
	$cmd = "./do_config/rsync.pl \"$port\" \"$username\" \"$password\" $ip \"$remote_path\" \"$locale_path\"";
	//echo $cmd . '<br/>';
	//die();
	//return;
	$descriptorspec = array(
				0 => array('pipe', 'r'),
				1 => array('pipe', 'w'),
				2 => array('pipe', 'w')
			);

	$process = proc_open($cmd, $descriptorspec, $pipes);
	$return = 0;
	if(is_resource($process)) {
		//fwrite($pipes[0], 'ys');
		//fwrite($pipes[0], $password);
		//fclose($pipes[0]);	
		while(!feof($pipes[2])) {
			$out .= fgets($pipes[2]);
		}
		fclose($pipes[2]);
		
		while(!feof($pipes[1])) {
			$out .= fgets($pipes[1]);
		}
		fclose($pipes[1]);
		$return = proc_close($process);
	}
	else {
		$out = '无法执行命令!';
		$return = -1;
	}
	return $return;
}

function get_by_snmpwalk($ip, $community, $state, &$out, $flag = false) {
	$config = get_config_type_by_name($state);
	if($config) {
		$oid = $config['oid'];
		//@$ret = snmprealwalk($ip, $community, $oid);
		@$ret = my_snmpwalk($ip, $community, $oid, $flag);
		if($ret === false) {
			$out = "无法获取 $state ，服务器没有响应!";
			return -1;
		}
		else {
			$out = $ret;
			return 0;
		}
	}
	else {
		$out = "没有找到 $state 的定义!";
		return -1;
	}
}

function my_snmpwalk($ip, $community, $oid, $flag = false) {
	if($flag == false) {
		$cmd = "snmpwalk -c $community -v 1 $ip $oid -O v 2>&1";
	}
	else {
		$cmd = "snmpwalk -c $community -v 1 $ip $oid 2>&1";
	}
	/*
	$handle = popen($cmd, 'r');
	while(!feof($handle)) {
		$result .= fgets($handle, 4096);
	}
	pclose($handle);
	*/
	$ret = command($cmd, $result);
	if($ret != 0) {	
		return false;
	}
	else {
		return $result;
	}
}

function rm($path) {
	$src = str_replace('..', '', $src);
	$dest = str_replace('..', '', $dest);
	//echo("rm -rf " . DATA_PATH ."$path" . '<br/>');
	system("rm -rf " . DATA_PATH ."$path");
}

function cp($src, $dest) {
	$src = str_replace('..', '', $src);
	$dest = str_replace('..', '', $dest);
	//echo("cp " . DATA_PATH . $src . " " . DATA_PATH . $dest . '<br/>');
	system("cp " . DATA_PATH . $src . " " . DATA_PATH . $dest);
}

function type2id($type) {
	if($type == 'snmp') {
		return 1;
	}
	else if($type == 'rsync') {
		return 2;
	}
	else {
		return 0;
	}
}


function get_config_type_by_name($name) {
	global $_CONFIG;
	foreach($_CONFIG['config_type'] as $config_type) {
		if($config_type['name'] == $name) {
			return $config_type;
		}
	}
	return null;
}

function config2name($templet) {
	if(isset($templet['path'])) {
		return base64_encode($templet['name']) . '@'. base64_encode($templet['path']);
	}
	else {
		return base64_encode($templet['name']); 
	}
}

function name2config($filename) {
	if(($pos = strpos($filename, '@')) !== false) {
		$name = substr($filename, 0, $pos);
		$path = substr($filename, $pos + 1);
		return array(
					'name' => base64_decode($name),
					'path' => base64_decode($path),
				);
	}
	else {
		return array(
				'name' => base64_decode($filename),
				);
	}
}


function command($cmd, &$out) {
	$descriptorspec = array(
				0 => array('pipe', 'r'),
				1 => array('pipe', 'w'),
				2 => array('pipe', 'w'),
				3 => array('pipe', 'w')
			);
	//echo "$cmd\n";
	$cmd =  "( $cmd ) 3>/dev/null; echo \$? >&3\n";
	$process = proc_open($cmd, $descriptorspec, $pipes);
	$return = 0;
	$out = '';
	if(is_resource($process)) {
		$return = (int) str_replace("\n","",stream_get_contents($pipes[3]));
		while(!feof($pipes[2])) {
			$out .= fgets($pipes[2]);
		}
		fclose($pipes[2]);
		
		while(!feof($pipes[1])) {
			$out .= fgets($pipes[1]);
		}
		fclose($pipes[1]);
		fclose($pipes[0]);
		fclose($pipes[3]);
		proc_close($process);

	}
	else {
		$out = '无法执行命令!';
		$return = -1;
	}
	return $return;
}



function encrypt($encrypt,$key="DESS") { 
		$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND ); 
		$passcrypt = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, $key, $encrypt, MCRYPT_MODE_ECB, $iv ); 
		$encode = base64_encode ( $passcrypt ); 
		return $encode; 
	} 

	function ipMatch($network, $ip){
	list ($net, $mask) = explode ('/', $network);
	if (is_numeric($mask)) {
		$result = (ip2long($ip) & ~((1 << (32 - $mask)) - 1)) == ip2long($net);
	}else{     
		$result = (ip2long($ip) & ip2long($mask)) == (ip2long($net) & ip2long($mask));
    } 
	return $result;
}