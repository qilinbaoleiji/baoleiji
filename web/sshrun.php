<?php
error_reporting(1);
define('CAN_RUN',1);
require_once("include/global.func.php");
require_once("include/db_connect.inc.php");
require_once("include/config.inc.php");
global $_CONFIG;
if($cutoff||$_GET['cutoff']){
	if($stype=='ssh'||$_GET['stype']=='ssh'){
		$pid = get_request('pid', 0, 1);
		$b   = explode(".", $pid);
		$rs = mysql_query("SELECT * FROM sessionsrun WHERE sid=".$b[1]);
		$session = mysql_fetch_array($rs);
		$sship = $session['baoleiip'];
		if(!$_GET['fromauditmc']){
			if($sship!=$_SERVER['HTTP_HOST']){
				$opts = array(
					'http'=>array(
					'method'=>"GET",
					'timeout'=>2,
				 )
				 );
				$context = stream_context_create($opts);
				$content = file_get_contents($url, false, $context);
				$url = "http://".$sship."/sshrun.php?cutoff=1&stype=ssh&fromauditmc=1&pid=".$pid;
				echo file_get_contents($url);
				exit;
			}
		}
		$cmd = 'sudo ' . $_CONFIG['RUNNING_CUTOFF'] . ' ' . $b[0];
		exec($cmd, $out, $return);
		if ($return == 0) {
			echo("<script>alert('执行成功');history.go(-1);</script>");
			exit;
		} else {
			echo("<script>alert('执行失败');history.go(-1);</script>");
			exit;
		}
	}else{
		$sid = get_request('sid');
		$rs = mysql_query("SELECT * FROM rdpsessions WHERE sid=".$sid);
		$session = mysql_fetch_array($rs);
		if(!$_GET['fromauditmc']){
			if($session['proxy_addr']!='127.0.0.1'){
				$opts = array(
					'http'=>array(
					'method'=>"GET",
					'timeout'=>2,
				 )
				 );
				$context = stream_context_create($opts);
				$content = file_get_contents($url, false, $context);
				$url = "http://".$session['proxy_addr']."/sshrun.php?cutoff=1&stype=rdp&fromauditmc=1&sid=".$sid;
				echo file_get_contents($url);
				exit;
			}
		}
		//$cmd='sudo '.$_CONFIG['RDP_CUTOFF'].' localhost S'.$session['threadid'];
		$cmd = "sudo /bin/kill -9 ".$session['threadid'];
		exec($cmd, $out, $return);
		mysql_query("UPDATE rdpsessions SET rdp_runnig=0, end=NOW() WHERE sid=$sid");
		echo("<script>alert('执行成功');history.go(-1);</script>");
		exit;
	}
}
if($sshrun||$_GET['sshrun']){
	exec(" ps -ef | grep ssh-audit", $output);
	$s = array();
	for($i=0; $i<count($output); $i++){
		$_s = preg_split("/[\s]+/", $output[$i]);
		if($_s[2]==1&&substr($_s[7],0,4)=='/opt'){
			$mainid= $_s[1];
		}else{
			$s[]=$_s;
		}
		
	}
	for($i=0; $i<count($s); $i++){
		if($s[$i][2]==$mainid){
			$sess[]=$s[$i][1];
		}
	}
	if($sess){
		$sids = mysql_query("SELECT MAX(sid) sid FROM sessions WHERE pid IN(".implode(',', $sess).") and type='ssh' GROUP BY pid");
		$sess=null;
		while($row=mysql_fetch_array($sids)){
			if($row['sid'])
			$sess[] = $row['sid'];
		}
	}
	if($_GET['fromauditmc']){
		if($sess){
			$rs = mysql_query("SELECT s.*,m.realname FROM sessions s LEFT JOIN member m ON s.luser=m.username WHERE sid IN(".implode(',', $sess).") and type='ssh'");
			while($row[]=mysql_fetch_array($rs, MYSQL_NUM));
			$a = serialize($row);
			echo $a;
		}
		//var_dump(unserialize($a));
		exit;
	}
	mysql_query("delete from sessionsrun where type='ssh'");
	if($sess)
	mysql_query("INSERT INTO sessionsrun SELECT s.*,m.realname,'".$_SERVER['HTTP_HOST']."' FROM sessions s LEFT JOIN member m ON s.luser=m.username where sid IN(".implode(',', $sess).") and type='ssh'") or var_dump(mysql_error());
	$slaveip = mysql_query("show slave status");
	$slaveip = mysql_fetch_array($slaveip);//var_dump($slaveip);
	$slaveip = $slaveip['Master_Host'];
	//$ip='127.0.0.1';
	if($slaveip){
		$url = "http://".$slaveip."/sshrun.php?fromauditmc=1&sshrun=1";
		echo "\n";
		$opts = array(
			'http'=>array(
			'method'=>"GET",
			'timeout'=>2,
		 )
		 );
		$context = stream_context_create($opts);
		$content = file_get_contents($url, false, $context);
		$row = unserialize($content);
		if($row){
			$sql = "INSERT INTO sessionsrun VALUES ";
			for($i=0; $i<count($row); $i++){
				if(!$row[$i]) continue;//var_dump($row[$i]);
				$sql .= "(";
				for($j=0; $j<count($row[$i]); $j++){
					$sql .= "'".$row[$i][$j]."',";
				}
				$sql .= "'".$slaveip."'";
				$sql .= "),";
			}
			$sql = substr($sql, 0, strlen($sql)-1);
			echo $sql ;
			if(count($row)>0) mysql_query($sql) or var_dump(mysql_error());
		}
	}
}elseif($telnetrun||$_GET['telnetrun']){
	exec(" ps -ef | grep telnet", $output);
	$s = array();
	for($i=0; $i<count($output); $i++){
		$_s = preg_split("/[\s]+/", $output[$i]);
		$sess[]=$_s[1];
	}
	if($sess){
		$sids = mysql_query("SELECT MAX(sid) sid FROM sessions WHERE pid IN(".implode(',', $sess).") and type='telnet' GROUP BY pid");
		$sess=null;
		while($row=mysql_fetch_array($sids)){
			if($row['sid'])
			$sess[] = $row['sid'];
		}
	}
	if($_GET['fromauditmc']){
		if($sess){
			$rs = mysql_query("SELECT s.*,m.realname FROM sessions s LEFT JOIN member m ON s.luser=m.username WHERE sid IN(".implode(',', $sess).") and type='telnet'");
			while($row[]=mysql_fetch_array($rs, MYSQL_NUM));
			$a = serialize($row);
			echo $a;
		}
		//var_dump(unserialize($a));
		exit;
	}
	mysql_query("delete from sessionsrun where type='telnet'");
	if($sess)
	mysql_query("INSERT INTO sessionsrun SELECT s.*,m.realname,'".$_SERVER['HTTP_HOST']."' FROM sessions s LEFT JOIN member m ON s.luser=m.username where sid IN(".implode(',', $sess).") and type='telnet'") or var_dump(mysql_error());
	$slaveip = mysql_query("show slave status");
	$slaveip = mysql_fetch_array($slaveip);//var_dump($slaveip);
	$slaveip = $slaveip['Master_Host'];
	//$ip='127.0.0.1';
	if($slaveip){
		$opts = array(
			'http'=>array(
			'method'=>"GET",
			'timeout'=>2,
		 )
		 );
		$context = stream_context_create($opts);
		$content = file_get_contents($url, false, $context);
		$url = "http://".$slaveip."/sshrun.php?fromauditmc=1&telnetrun=1";
		echo "\n";
		$content = file_get_contents($url);
		$row = unserialize($content);//var_dump($row);
		if($row){
			$sql = "INSERT INTO sessionsrun VALUES";
			for($i=0; $i<count($row); $i++){
				if(!$row[$i]) continue;//var_dump($row[$i]);
				$sql .= "(";
				for($j=0; $j<count($row[$i]); $j++){
					$sql .= "'".$row[$i][$j]."',";
				}
				$sql .= "'".$slaveip."'";
				$sql .= "),";
			}
			$sql = substr($sql, 0, strlen($sql)-1);
			echo $sql ;
			if(count($row)>0) mysql_query($sql) or var_dump(mysql_error());
		}
	}

}
?>