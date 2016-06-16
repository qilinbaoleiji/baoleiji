<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_eth extends c_base {

	function index() {
		$this->config_eth();

	}

	function config_eth() {
		//var_dump(PHP_EOL);echo strlen('\r\n');
		//$filename = '/etc/sysconfig/network-scripts/ifcfg-eth0';
		//$filename = './controller/ifcfg-eth0';	
		//$networkfile = './controller/network';	
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['IFGETH0'];
		$networkfile = $_CONFIG['CONFIGFILE']['NETWORK'];
		
		if(file_exists($networkfile))
		{
			$lines = @file($networkfile);
			for($ii=0; $ii<count($lines); $ii++)
			{
				if(strstr(strtoupper($lines[$ii]), "GATEWAY"))
				{
						$tmp = explode("=", $lines[$ii]);
						$network['GATEWAY']['value'] = $tmp[1];
						$network['GATEWAY']['file'] = $networkfile;
				}
			}
		}

		if(file_exists($filename))
		{
			$lines = @file($filename);
			for($ii=0; $ii<count($lines); $ii++)
			{
								
				if(strstr(strtoupper($lines[$ii]), "IPADDR"))
				{
					$tmp = explode("=", $lines[$ii]);
					$network['IPADDR']['value'] = $tmp[1];
					$network['IPADDR']['file'] = $filename;
				}
				if(strstr(strtoupper($lines[$ii]), "NETMASK"))
				{
					$tmp = explode("=", $lines[$ii]);
					$network['NETMASK']['value'] = $tmp[1];
					$network['NETMASK']['file'] = $filename;
				}
				if(strstr(strtoupper($lines[$ii]), "GATEWAY"))
				{
					$tmp = explode("=", $lines[$ii]);
					$network['GATEWAY']['value'] = $tmp[1];
					$network['GATEWAY']['file'] = $filename;
				}
			}
		}
		else
		{
			alert_and_back("IFCFG配置文件不存在或没有权限",'admin.php?controller=admin_index',1);
			exit;
		}
		
		$filename = $_CONFIG['CONFIGFILE']['DNS'];
		//$filename = './controller/resolv.conf';
		if(file_exists($filename))
		{
			$lines = @file($filename);
			$jj=0;
			for($ii=0; $ii<count($lines); $ii++)
			{								
				if(strstr(strtolower($lines[$ii]), "nameserver"))
				{
					$tmp = preg_split("/ /", $lines[$ii]);
					$jj = $jj + 1;
					$network['nameserver'.$jj] = trim($tmp[1]);
				}
			}
		}
		else
		{
			alert_and_back('配置文件不存在或没有权限');
			exit;
		}
		$this->assign("sshconfig", $network);
		$this->assign('netmask',$network['NETMASK']['value']);
		$this->assign('ipaddr',$network['IPADDR']['value']);
		$this->assign("num", $_CONFIG['CONFIGFILE']['IFGETH_NUMBER']);
		$this->assign('gateway',$network['GATEWAY']['value']);
		$this->assign("page_nav_tabs_selected", "config_eth");
		$this->display('eth.tpl');
	}

	function eth_save() {
		$new_netmask = get_request('netmask',1,1);
		$new_ipaddr = get_request('ipaddr',1,1);
		$new_gateway = get_request('gateway',1,1);
		$nameserver1 = get_request('nameserver1',1,1);
		$nameserver2 = get_request('nameserver2',1,1);
		$wins = get_request("wins", 1, 1);
		
		if(!is_ip($new_ipaddr)){
			alert_and_back('IP地址格式不正确 ');
			exit;
		}
		if(!is_ip($new_netmask)){
			alert_and_back('掩码格式不正确 ');
			exit;
		}
		if(!is_ip($new_gateway)){
			alert_and_back('网关输入不正确 ');
			exit;
		}
		if($nameserver1&&!is_ip($nameserver1)){
			alert_and_back('域名服务器1输入不正确 ');
			exit;
		}
		if($nameserver2&&!is_ip($nameserver2)){
			alert_and_back('域名服务器2输入不正确 ');
			exit;
		}

		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['IFGETH0'];
		$linestmp = @file($filename);
		if(!$linestmp) {
			alert_and_back("文件不存在或没有权限");
			exit;
		}
		$ipaddr = 0;
		$netmask = 0;
		$gateway = 0;
		$jj=0;
		//echo '<pre>';print_r($linestmp);echo '</pre>';
		for($ii=0; $ii<count($linestmp); $ii++)
			{
				
				if(strlen(trim($linestmp[$ii]))==0)
				{
					continue;
				}
				//echo $linestmp[$ii].':'.strlen($linestmp[$ii])."<br />";
				$lines[$jj] = str_replace("\r\n","\n",$linestmp[$ii]);
				if(strstr(strtoupper($lines[$jj]), "IPADDR"))
				{
					$lines[$jj] = "IPADDR=$new_ipaddr\n";
					$ipaddr = 1;
				}
				if(strstr(strtoupper($lines[$jj]), "NETMASK"))
				{
					$lines[$jj] = "NETMASK=$new_netmask\n";
					$netmask = 1;
				}
				if(strstr(strtoupper($lines[$jj]), "GATEWAY"))
				{
					$lines[$jj] = "GATEWAY=$new_gateway\n";
					$gateway = 1;
				}
				$jj++;
			}
		if(strstr($lines[count($lines)-1],"\n"))
				$lines[count($lines)-1] = str_replace("\n","",$lines[count($lines)-1]);
		if(!$ipaddr)
		{
			$lines[count($lines)] = "\nIPADDR=$new_ipaddr";
		}
		if(!$netmask)
		{
			$lines[count($lines)] = "\nNETMASK=$new_netmask";
		}
		if(!$gateway)
		{
			$lines[count($lines)] = "\nGATEWAY=$new_gateway";
		}
		
		$this->Array2File($lines,$filename);
		
		$filename = $_CONFIG['CONFIGFILE']['DNS'];
		//$filename = './controller/resolv.conf';

		
		$jj=0;
		if(file_exists($filename))
		{
			$lines = @file($filename);
			for($ii=0; $ii<count($lines); $ii++)
			{
								
				if(strstr(strtolower($lines[$ii]), "nameserver"))
				{
					$jj = $jj + 1;
					$tmp = preg_split("/ /", $lines[$ii]);
					$lines[$ii] = $tmp[0].' '.${'nameserver'.$jj}."\n";
				}
			}
			
		}
		else
		{
			alert_and_back('配置文件不存在或没有权限');
			exit;
		}
		$this->Array2File($lines,$filename);
		
		prompt("修改成功,系统将重新启动,确定重启吗?",'admin.php?controller=admin_eth&action=system_init_6','admin.php?controller=admin_eth&action=config_eth');
		
		//alert_and_back('修改成功','admin.php?controller=admin_eth&action=config_eth');
	}
	
	function config_ethx(){
		$number = get_request('number');
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['IFGETH'.$number];
		//$filename = './controller/ifcfg-eth'.$number;
		$linestmp = @file($filename);
		if(!$linestmp) {
			alert_and_back("文件不存在或没有权限");
			exit;
		}
		$ipaddr = 0;
		$netmask = 0;
		$gateway = 0;
		$jj=0;
		//echo '<pre>';print_r($linestmp);echo '</pre>';
		for($ii=0; $ii<count($linestmp); $ii++)
			{
				
				if(strlen(trim($linestmp[$ii]))==0)
				{
					continue;
				}
				//echo $linestmp[$ii].':'.strlen($linestmp[$ii])."<br />";
				if(strstr(strtoupper($linestmp[$ii]), "IPADDR"))
				{
					$tmp = explode("=", $linestmp[$ii]);
					$network['ipaddr'] = $tmp[1];
				}
				if(strstr(strtoupper($linestmp[$ii]), "NETMASK"))
				{
					$tmp = explode("=", $linestmp[$ii]);
					$network['netmask'] = $tmp[1];
				}
				if(strstr(strtoupper($linestmp[$ii]), "ONBOOT"))
				{
					$tmp = explode("=", $linestmp[$ii]);
					$network['onboot'] = strtolower($tmp[1]);
				}
				$jj++;
			}
	
		$this->assign("number", $number);	
		$this->assign("network", $network);
		$this->assign("num", $_CONFIG['CONFIGFILE']['IFGETH_NUMBER']);
		$this->assign("page_nav_tabs_selected", "config_ethx");
		$this->display('ethx.tpl');
	}
	
	function ethx_save(){
		$number = get_request('number');
		$new_netmask = get_request('netmask',1,1);
		$new_ipaddr = get_request('ipaddr',1,1);
		$new_onboot = get_request('onboot',1,1);
		
		if($new_ipaddr&&!is_ip($new_ipaddr)){
			alert_and_back('IP地址格式不正确 ');
			exit;
		}
		if($new_netmask&&!is_ip($new_netmask)){
			alert_and_back('子网掩码格式不正确 ');
			exit;
		}

		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['IFGETH'.$number];
		$linestmp = @file($filename);
		if(!$linestmp) {
			alert_and_back("文件不存在或没有权限");
			exit;
		}
		$ipaddr = 0;
		$netmask = 0;
		$jj=0;
		//echo '<pre>';print_r($linestmp);echo '</pre>';
		for($ii=0; $ii<count($linestmp); $ii++)
		{
				
			if(strlen(trim($linestmp[$ii]))==0)
			{
				continue;
			}
			//echo $linestmp[$ii].':'.strlen($linestmp[$ii])."<br />";
			$lines[$jj] = str_replace("\r\n","\n",$linestmp[$ii]);
			if(strstr(strtoupper($lines[$jj]), "IPADDR"))
			{
				$lines[$jj] = "IPADDR=$new_ipaddr\n";
				$ipaddr = 1;
			}
			if(strstr(strtoupper($lines[$jj]), "NETMASK"))
			{
				$lines[$jj] = "NETMASK=$new_netmask\n";
				$netmask = 1;
			}
			if(strstr(strtoupper($lines[$ii]), "ONBOOT"))
			{
				$lines[$jj] = "ONBOOT=$new_onboot\n";
				$onboot =1;
			}
			$jj++;
		}
		if(strstr($lines[count($lines)-1],"\n"))
		{
				$lines[count($lines)-1] = str_replace("\n","",$lines[count($lines)-1]);
		}
		if(!$ipaddr)
		{
			$lines[count($lines)] = "\nIPADDR=$new_ipaddr";
		}
		if(!$onboot)
		{
			$lines[count($lines)] = "\nONBOOT=$onboot";
		}
		
		$this->Array2File($lines,$filename);
		alert_and_back("修改成功",'admin.php?controller=admin_eth&action=config_ethx&number='.$number);
	}
	
	function config_route()
	{
		global $_CONFIG;
		//$filename = './controller/rc.local';
		$filename = $_CONFIG['CONFIGFILE']['RCLOCAL'];
		if(file_exists($filename))
		{
			$lines = @file($filename);
			$jj=0;
			for($ii=0; $ii<count($lines); $ii++)
			{
				if(strstr(strtolower($lines[$ii]), "route add "))
				{
					$tmp = preg_split ("/\s{1,}/",$lines[$ii]);
					$route[$jj++]= $tmp;
				}
			}
		}
		//var_dump($route);
		$this->assign("route", $route);
		$this->assign("num", $_CONFIG['CONFIGFILE']['IFGETH_NUMBER']);
		$this->assign("page_nav_tabs_selected", "config_route");
		$this->display('config_route.tpl');
	}
	
	function route_save()
	{
		$sectionold = get_request('sectionold',1,1);
		$gatewayold = get_request('gatewayold',1,1);
		$section = get_request('section',1,1);
		$gateway = get_request('gateway',1,1);
		$delete = get_request('delete', 1, 1);
		//$filename = './controller/rc.local';
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['RCLOCAL'];
		if(file_exists($filename))
		{
			$linestmp = @file($filename);
			if(!$linestmp) {
				alert_and_back("文件不存在或没有权限");
				exit;
			}
			for($ii=0; $ii<count($linestmp); $ii++)
			{
				if(strstr(strtolower($linestmp[$ii]), "route add ") && strstr(strtolower($linestmp[$ii]), $sectionold) && strstr(strtolower($linestmp[$ii]), $gatewayold))
				{
					if($delete)
						continue;
					else 
						$lines[]= "route add -net ".$section." gw ".$gateway."\n";
				}else{
					$lines[] = $linestmp[$ii];
				}
			}
			if(count($lines) > 0 && !strstr($lines[count($lines)-1],"\n"))
				$lines[count($lines)-1] .= "\n";
		}
		if(!empty($lines))
		$lines = implode("", $lines);
		
		$this->String2File($lines, $filename);
		//prompt("修改成功,系统将重新启动,确定重启吗?",'admin.php?controller=admin_eth&action=system_init_6','admin.php?controller=admin_eth&action=config_route');
		alert_and_back('修改成功','admin.php?controller=admin_eth&action=config_route');
		//echo $route.':'.strlen($route)."<br />";
		//var_dump(strstr($route,"\n"));
	}
	
	
	function route_add2(){
		$section = get_request('section',1,1);
		$gateway = get_request('gateway',1,1);
		//$filename = './controller/rc.local';
		global $_CONFIG;
		$filename = $_CONFIG['CONFIGFILE']['RCLOCAL'];
		$found = 0;
		$iparr = explode('/', $section);
		if(!is_ip($iparr[0])||(!is_numeric($iparr[1])&&!is_ip($iparr[1]))){
			alert_and_back('网段输入不正确');
			exit;
		}
		if(!is_ip($gateway)){
			alert_and_back('网关输入不正确');
			exit;
		}
		if(file_exists($filename))
		{
			$linestmp = @file($filename);
			for($ii=0; $ii<count($linestmp); $ii++)
			{
				if(strstr(strtolower($linestmp[$ii]), "route add ") && strstr(strtolower($linestmp[$ii]), $section) && strstr(strtolower($linestmp[$ii]), $gateway))
				{
						$found = 1;
				}
			}
			if(count($linestmp) > 0 && !strstr($linestmp[count($linestmp)-1],"\n"))
				$linestmp[count($linestmp)-1] .= "\n";
		}
		
		if($found==0){
			$linestmp[count($linestmp)] .= "route add -net ".$section." gw ".$gateway."\n";
		}
		$linestmp = implode("", $linestmp);
		$this->String2File($linestmp, $filename);
		//prompt("修改成功,系统将重新启动,确定重启吗?",'admin.php?controller=admin_eth&action=system_init_6','admin.php?controller=admin_eth&action=config_route');
		alert_and_back('修改成功','admin.php?controller=admin_eth&action=config_route');
		//echo $route.':'.strlen($route)."<br />";
		//var_dump(strstr($route,"\n"));
	}
	
	function system_init_6()
	{
		system('sudo /sbin/init 6',$out);
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
