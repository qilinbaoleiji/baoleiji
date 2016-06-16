<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<style type="text/css">

a {
    color: #003499;
    text-decoration: none;
}
 
a:hover {
    color: #000000;
    text-decoration: underline;
}
 

 
</style>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ssh">认证配置</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  
  <tr><td><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=status_warning">
  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">

	<tr><th colspan="3" class="list_bg"></th></tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">CPU告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="cpu_lowvalue" value="{{$alarm.cpu_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="cpu_highvalue" value="{{$alarm.cpu_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="cpu_mail_alarm" value="1" {{if $alarm.cpu_mail_alarm}} checked{{/if}}/>&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="cpu_sms_alarm" value="1" {{if $alarm.cpu_sms_alarm}} checked{{/if}}/>&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="cpu_send_interval" value="{{$alarm.cpu_send_interval}}" />
		</td>
</tr>	
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">内存告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="memory_lowvalue" value="{{$alarm.memory_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="memory_highvalue" value="{{$alarm.memory_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="memory_mail_alarm" value="1" {{if $alarm.memory_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="memory_sms_alarm" value="1" {{if $alarm.memory_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="memory_send_interval" value="{{$alarm.memory_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">SWAP告警阀值:</td>
		<td align=left>&nbsp;		
		下限:<input type="text" class="wbk" name="swap_lowvalue" value="{{$alarm.swap_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="swap_highvalue" value="{{$alarm.swap_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="swap_mail_alarm" value="1" {{if $alarm.swap_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="swap_sms_alarm" value="1" {{if $alarm.swap_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="swap_send_interval" value="{{$alarm.swap_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">硬盘告警阀值:</td>
		<td align=left>&nbsp;		
		下限:<input type="text" class="wbk" name="disk_lowvalue" value="{{$alarm.disk_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="disk_highvalue" value="{{$alarm.disk_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="disk_mail_alarm" value="1" {{if $alarm.disk_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="disk_sms_alarm" value="1" {{if $alarm.disk_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="disk_send_interval" value="{{$alarm.disk_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">SSH告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="ssh_lowvalue" value="{{$alarm.ssh_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="ssh_highvalue" value="{{$alarm.ssh_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="ssh_mail_alarm" value="1" {{if $alarm.ssh_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="ssh_sms_alarm" value="1" {{if $alarm.ssh_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="ssh_send_interval" value="{{$alarm.ssh_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">TELNET告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="telnet_lowvalue" value="{{$alarm.telnet_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="telnet_highvalue" value="{{$alarm.telnet_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="telnet_mail_alarm" value="1" {{if $alarm.telnet_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="telnet_sms_alarm" value="1" {{if $alarm.telnet_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="telnet_send_interval" value="{{$alarm.telnet_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">FTP告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="ftp_lowvalue" value="{{$alarm.ftp_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="ftp_highvalue" value="{{$alarm.ftp_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="ftp_mail_alarm" value="1" {{if $alarm.ftp_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="ftp_sms_alarm" value="1" {{if $alarm.ftp_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="ftp_send_interval" value="{{$alarm.ftp_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">DB告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="db_lowvalue" value="{{$alarm.db_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="db_highvalue" value="{{$alarm.db_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="db_mail_alarm" value="1" {{if $alarm.db_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="db_sms_alarm" value="1" {{if $alarm.db_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="db_send_interval" value="{{$alarm.db_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">图形会话并发数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="graph_lowvalue" value="{{$alarm.graph_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="graph_highvalue" value="{{$alarm.graph_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="graph_mail_alarm" value="1" {{if $alarm.graph_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="graph_sms_alarm" value="1" {{if $alarm.graph_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="graph_send_interval" value="{{$alarm.graph_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">mysql连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="mysql_lowvalue" value="{{$alarm.mysql_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="mysql_highvalue" value="{{$alarm.mysql_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="mysql_mail_alarm" value="1" {{if $alarm.mysql_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="mysql_sms_alarm" value="1" {{if $alarm.mysql_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="mysql_send_interval" value="{{$alarm.mysql_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">http连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="http_lowvalue" value="{{$alarm.http_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="http_highvalue" value="{{$alarm.http_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="http_mail_alarm" value="1" {{if $alarm.http_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="http_sms_alarm" value="1" {{if $alarm.http_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="http_send_interval" value="{{$alarm.http_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">tcp连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="tcp_lowvalue" value="{{$alarm.tcp_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="tcp_highvalue" value="{{$alarm.tcp_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="tcp_mail_alarm" value="1" {{if $alarm.tcp_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="tcp_sms_alarm" value="1" {{if $alarm.tcp_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="tcp_send_interval" value="{{$alarm.tcp_send_interval}}" />
		</td>
</tr>
{{*
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">eth0流入告警阀值:</td>
	<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth0in_lowvalue" value="{{$alarm.eth0in_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth0in_highvalue" value="{{$alarm.eth0in_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth0in_mail_alarm" value="1" {{if $alarm.eth0in_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth0in_sms_alarm" value="1" {{if $alarm.eth0in_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth0in_send_interval" value="{{$alarm.eth0in_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">eth0流出告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth0out_lowvalue" value="{{$alarm.eth0out_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth0out_highvalue" value="{{$alarm.eth0out_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth0out_mail_alarm" value="1" {{if $alarm.eth0out_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth0out_sms_alarm" value="1" {{if $alarm.eth0out_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth0out_send_interval" value="{{$alarm.eth0out_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">eth1流入告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth1in_lowvalue" value="{{$alarm.eth1in_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth1in_highvalue" value="{{$alarm.eth1in_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth1in_mail_alarm" value="1" {{if $alarm.eth1in_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth1in_sms_alarm" value="1" {{if $alarm.eth1in_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth1in_send_interval" value="{{$alarm.eth1in_send_interval}}" />
		</td>
</tr>
{{assign var="trnumber" value=0}}
<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	<td align="right">eth1流出告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth1out_lowvalue" value="{{$alarm.eth1out_lowvalue}}" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth1out_highvalue" value="{{$alarm.eth1out_highvalue}}" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth1out_mail_alarm" value="1" {{if $alarm.eth1out_mail_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth1out_sms_alarm" value="1" {{if $alarm.eth1out_sms_alarm}} checked{{/if}} />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth1out_send_interval" value="{{$alarm.eth1out_send_interval}}" />
		</td>
</tr>
*}}
	<tr bgcolor="f7f7f7">
			<td colspan="2" align="center"><input type="submit"  value="{{$language.Save}}" class="an_02"></td>
		</tr>

	</table>
	<input type="hidden" name="ac" value="{{if $alarm}}edit{{else}}new{{/if}}" />
</form>

		</table>
	</td>
  </tr>
</table>


<script language="javascript">
<!--
function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为{{$language.HostName}}时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请{{$language.Input}}正确掩码');
	return false;
   }
*/
   return true;

}//end check
// -->

function checkIP(ip)
{
	var ips = ip.split('.');
	if(ips.length==4 && ips[0]>=0 && ips[0]<256 && ips[1]>=0 && ips[1]<256 && ips[2]>=0 && ips[2]<256 && ips[3]>=0 && ips[3]<256)
		return ture;
	else
		return false;
}

function checknum(num)
{

	if( isDigit(num) && num > 0 && num < 65535)
		return ture;
	else
		return false;

}

function isDigit(s)
{
var patrn=/^[0-9]{1,20}$/;
if (!patrn.exec(s)) return false;
return true;
}

</script>
</body>
</html>


