<?php
define('CAN_RUN', 1);
require_once('include/db_connect.inc.php');

$sql = "SELECT uid,username,groupid FROM member";
$rs = mysql_query($sql) or die(mysql_error());
if($_GET['tool']=='mremote'){
	$str = '<?xml version="1.0" encoding="utf-8"?>'."\n";
	$str .= '<Connections Name="Connections" Export="False" Protected="V859XVQWq9JS5+BO6z6ZYPXJVuQVwCvgaKZLm65IFNXAHDLWTAOtHla5rcluX+YH" ConfVersion="2.1">'."\n";
	while($row=mysql_fetch_array($rs)){
		$sql1 = 'SELECT devicesid FROM luser WHERE memberid='.$row['uid'].' UNION SELECT devicesid FROM lgroup WHERE groupid='.$row['groupid'].' UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM luser_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.memberid='.$row['uid'].') UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM lgroup_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.groupid='.$row['groupid'].')';	
		$sql = "SELECT devices.* FROM `devices` WHERE id IN(".$sql1.") AND login_method=8";
		$rs1 = mysql_query($sql) or die(mysql_error());
		while($row1=mysql_fetch_array($rs1)){
			$str .=  '<Node Name="'.$row1['device_ip'].'" Type="Connection" Descr="" Icon="mRemote" Panel="General" Username="'.$row['username'].'--'.$row1['id'].'" Domain="" Password="RXX+R0uPe0hHm0nbxQXdfzRoB+ld3sg5rU+GcAQUHZA=" Hostname="118.186.17.101" Protocol="RDP" PuttySession="Default Settings" Port="3389" ConnectToConsole="False" RenderingEngine="IE" ICAEncryptionStrength="EncrBasic" RDPAuthenticationLevel="NoAuth" Colors="Colors16Bit" Resolution="FitToWindow" DisplayWallpaper="False" DisplayThemes="False" CacheBitmaps="True" RedirectDiskDrives="False" RedirectPorts="False" RedirectPrinters="False" RedirectSmartCards="False" RedirectSound="DoNotPlay" RedirectKeys="False" Connected="False" PreExtApp="" PostExtApp="" MacAddress="" UserField="" ExtApp="" VNCCompression="CompNone" VNCEncoding="EncHextile" VNCAuthMode="AuthVNC" VNCProxyType="ProxyNone" VNCProxyIP="" VNCProxyPort="0" VNCProxyUsername="" VNCProxyPassword="" VNCColors="ColNormal" VNCSmartSizeMode="SmartSAspect" VNCViewOnly="False" InheritCacheBitmaps="False" InheritColors="False" InheritDescription="False" InheritDisplayThemes="False" InheritDisplayWallpaper="False" InheritDomain="False" InheritIcon="False" InheritPanel="False" InheritPassword="False" InheritPort="False" InheritProtocol="False" InheritPuttySession="False" InheritRedirectDiskDrives="False" InheritRedirectKeys="False" InheritRedirectPorts="False" InheritRedirectPrinters="False" InheritRedirectSmartCards="False" InheritRedirectSound="False" InheritResolution="False" InheritUseConsoleSession="False" InheritRenderingEngine="False" InheritUsername="False" InheritICAEncryptionStrength="False" InheritRDPAuthenticationLevel="False" InheritPreExtApp="False" InheritPostExtApp="False" InheritMacAddress="False" InheritUserField="False" InheritExtApp="False" InheritVNCCompression="False" InheritVNCEncoding="False" InheritVNCAuthMode="False" InheritVNCProxyType="False" InheritVNCProxyIP="False" InheritVNCProxyPort="False" InheritVNCProxyUsername="False" InheritVNCProxyPassword="False" InheritVNCColors="False" InheritVNCSmartSizeMode="False" InheritVNCViewOnly="False" />'."\n";
		}
	}

	$str .= '</Connections>';
	Header('Cache-Control: private, must-revalidate, max-age=0');
	Header("Content-type: application/octet-stream"); 
	Header("Content-Disposition: attachment; filename=confCons.xml"); 
	echo $str;
	exit();
}elseif($_GET['tool']=='rdcman'){
	$str = '<?xml version="1.0" encoding="utf-8"?>'."\n";
	$str .= '<version>1.42</version>'."\n";
	$str .= '<properties>'."\n";
	$str .= '<titleText>[C:\Users\cmas.ma\Desktop\x.rdg]</titleText>'."\n";
	$str .= '</properties>'."\n";
	$str .= '<group>'."\n";
	$str .= ' <properties>'."\n";
	$str .= '<name>Remote Desktops</name>'."\n";
	$str .= '<expanded>True</expanded>'."\n";
	$str .= '<inheritDisplay>True</inheritDisplay>'."\n";
	$str .= '<logonSettings inherit="FromParent" />'."\n";
	$str .= '<remoteDesktop inherit="FromParent" />'."\n";
	$str .= '<localResources inherit="FromParent" />'."\n";
	$str .= '</properties>'."\n";

	while($row=mysql_fetch_array($rs)){
		$sql1 = 'SELECT devicesid FROM luser WHERE memberid='.$row['uid'].' UNION SELECT devicesid FROM lgroup WHERE groupid='.$row['groupid'].' UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM luser_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.memberid='.$row['uid'].') UNION SELECT devicesid FROM resourcegroup WHERE groupname IN (SELECT b.groupname FROM lgroup_resourcegrp a LEFT JOIN resourcegroup b ON a.resourceid=b.id WHERE a.groupid='.$row['groupid'].')';	
		$sql = "SELECT devices.* FROM `devices` WHERE id IN(".$sql1.")  AND login_method=8";
		$rs1 = mysql_query($sql) or die(mysql_error());
		while($row1=mysql_fetch_array($rs1)){
			$str .= '<server>'."\n";
			$str .= '<name>118.186.17.101</name>'."\n";
			$str .= '<displayName>'.$row1['device_ip'].'</displayName>'."\n";
			$str .= '<thumbnailScale>1</thumbnailScale>'."\n";
			$str .= '<logonSettings inherit="None">'."\n";
            $str .= '<userName>test</userName>'."\n";
            $str .= '<password>AQAAANCMnd8BFdERjHoAwE/Cl+sBAAAALz7IaWiVOU6/q3WaERHHmwAAAAACAAAAAAAQZgAAAAEAACAAAAC6lN79Pg3WmS54tNGojqNuA2LV9ohkyQkJrM04brk2MAAAAAAOgAAAAAIAACAAAADWFWvNc0Xu8KFWvYbvrG2kRGPF/06R1Hp1CGPSp+aafiAAAACtS2OrKs/UyRfg9Hy3WzUmNE6cicJfFck6wAXoY/266UAAAADKTQ/Moj0YwIByiP4UOPiGwmqb2i3g+B5Nn7x4ydM8zP6RhKZmNPY9DgxmVbmwL+xuj2AnruR+17JbY/XcjTgY</password>'."\n";
            $str .= '<domain />'."\n";
            $str .= '<port>3389</port>'."\n";
            $str .= '<connectToConsole>False</connectToConsole>'."\n";
            $str .= '<startProgram />'."\n";
            $str .= '<workingDir />'."\n";
            $str .= '</logonSettings>'."\n";
			$str .= '<remoteDesktop inherit="FromParent" />'."\n";
			$str .= '<localResources inherit="FromParent" />'."\n";
			$str .= '</server>'."\n";
		}
	}   
	$str .= ' </group>'."\n";
	$str .= ' </RDCMan>'."\n";
	Header('Cache-Control: private, must-revalidate, max-age=0');
	Header("Content-type: application/octet-stream"); 
	Header("Content-Disposition: attachment; filename=rdcman.rdg"); 
	echo $str;
	exit();
}


?>
√‹¬Î:<input type="text">
<a href = "?tool=mremote" >mRemote</a>&nbsp;&nbsp;&nbsp; <a href = "?tool=rdcman" >RDCMAN</a>