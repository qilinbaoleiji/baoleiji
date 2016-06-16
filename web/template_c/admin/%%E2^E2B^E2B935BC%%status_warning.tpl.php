<?php /* Smarty version 2.6.18, created on 2014-04-26 16:20:55
         compiled from status_warning.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />

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
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ssh">认证配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  
  <tr><td><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=status_warning">
  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">

	<tr><th colspan="3" class="list_bg"></th></tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">CPU告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="cpu_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['cpu_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="cpu_highvalue" value="<?php echo $this->_tpl_vars['alarm']['cpu_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="cpu_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['cpu_mail_alarm']): ?> checked<?php endif; ?>/>&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="cpu_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['cpu_sms_alarm']): ?> checked<?php endif; ?>/>&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="cpu_send_interval" value="<?php echo $this->_tpl_vars['alarm']['cpu_send_interval']; ?>
" />
		</td>
</tr>	
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">内存告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="memory_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['memory_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="memory_highvalue" value="<?php echo $this->_tpl_vars['alarm']['memory_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="memory_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['memory_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="memory_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['memory_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="memory_send_interval" value="<?php echo $this->_tpl_vars['alarm']['memory_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">SWAP告警阀值:</td>
		<td align=left>&nbsp;		
		下限:<input type="text" class="wbk" name="swap_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['swap_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="swap_highvalue" value="<?php echo $this->_tpl_vars['alarm']['swap_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="swap_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['swap_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="swap_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['swap_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="swap_send_interval" value="<?php echo $this->_tpl_vars['alarm']['swap_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">硬盘告警阀值:</td>
		<td align=left>&nbsp;		
		下限:<input type="text" class="wbk" name="disk_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['disk_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="disk_highvalue" value="<?php echo $this->_tpl_vars['alarm']['disk_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="disk_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['disk_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="disk_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['disk_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="disk_send_interval" value="<?php echo $this->_tpl_vars['alarm']['disk_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">SSH告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="ssh_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['ssh_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="ssh_highvalue" value="<?php echo $this->_tpl_vars['alarm']['ssh_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="ssh_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['ssh_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="ssh_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['ssh_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="ssh_send_interval" value="<?php echo $this->_tpl_vars['alarm']['ssh_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">TELNET告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="telnet_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['telnet_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="telnet_highvalue" value="<?php echo $this->_tpl_vars['alarm']['telnet_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="telnet_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['telnet_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="telnet_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['telnet_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="telnet_send_interval" value="<?php echo $this->_tpl_vars['alarm']['telnet_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">FTP告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="ftp_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['ftp_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="ftp_highvalue" value="<?php echo $this->_tpl_vars['alarm']['ftp_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="ftp_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['ftp_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="ftp_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['ftp_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="ftp_send_interval" value="<?php echo $this->_tpl_vars['alarm']['ftp_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">DB告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="db_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['db_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="db_highvalue" value="<?php echo $this->_tpl_vars['alarm']['db_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="db_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['db_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="db_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['db_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="db_send_interval" value="<?php echo $this->_tpl_vars['alarm']['db_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">图形会话并发数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="graph_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['graph_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="graph_highvalue" value="<?php echo $this->_tpl_vars['alarm']['graph_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="graph_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['graph_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="graph_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['graph_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="graph_send_interval" value="<?php echo $this->_tpl_vars['alarm']['graph_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">mysql连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="mysql_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['mysql_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="mysql_highvalue" value="<?php echo $this->_tpl_vars['alarm']['mysql_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="mysql_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['mysql_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="mysql_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['mysql_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="mysql_send_interval" value="<?php echo $this->_tpl_vars['alarm']['mysql_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">http连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="http_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['http_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="http_highvalue" value="<?php echo $this->_tpl_vars['alarm']['http_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="http_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['http_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="http_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['http_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="http_send_interval" value="<?php echo $this->_tpl_vars['alarm']['http_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">tcp连接数告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="tcp_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['tcp_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="tcp_highvalue" value="<?php echo $this->_tpl_vars['alarm']['tcp_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="tcp_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['tcp_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="tcp_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['tcp_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="tcp_send_interval" value="<?php echo $this->_tpl_vars['alarm']['tcp_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">eth0流入告警阀值:</td>
	<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth0in_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['eth0in_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth0in_highvalue" value="<?php echo $this->_tpl_vars['alarm']['eth0in_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth0in_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth0in_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth0in_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth0in_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth0in_send_interval" value="<?php echo $this->_tpl_vars['alarm']['eth0in_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">eth0流出告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth0out_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['eth0out_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth0out_highvalue" value="<?php echo $this->_tpl_vars['alarm']['eth0out_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth0out_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth0out_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth0out_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth0out_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth0out_send_interval" value="<?php echo $this->_tpl_vars['alarm']['eth0out_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">eth1流入告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth1in_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['eth1in_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth1in_highvalue" value="<?php echo $this->_tpl_vars['alarm']['eth1in_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth1in_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth1in_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth1in_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth1in_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth1in_send_interval" value="<?php echo $this->_tpl_vars['alarm']['eth1in_send_interval']; ?>
" />
		</td>
</tr>
<?php $this->assign('trnumber', 0); ?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	<td align="right">eth1流出告警阀值:</td>
		<td align=left>&nbsp;
		下限:<input type="text" class="wbk" name="eth1out_lowvalue" value="<?php echo $this->_tpl_vars['alarm']['eth1out_lowvalue']; ?>
" />&nbsp;&nbsp;&nbsp;上限:<input type="text" class="wbk" name="eth1out_highvalue" value="<?php echo $this->_tpl_vars['alarm']['eth1out_highvalue']; ?>
" />&nbsp;&nbsp;&nbsp;邮件告警:<input type="checkbox" class="wbk" name="eth1out_mail_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth1out_mail_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;短信告警:<input type="checkbox" class="wbk" name="eth1out_sms_alarm" value="1" <?php if ($this->_tpl_vars['alarm']['eth1out_sms_alarm']): ?> checked<?php endif; ?> />&nbsp;&nbsp;&nbsp;发送间隔:<input type="text" class="wbk" name="eth1out_send_interval" value="<?php echo $this->_tpl_vars['alarm']['eth1out_send_interval']; ?>
" />
		</td>
</tr>

	<tr bgcolor="f7f7f7">
			<td colspan="2" align="center"><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
		</tr>

	</table>
	<input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['alarm']): ?>edit<?php else: ?>new<?php endif; ?>" />
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
	alert('地址为<?php echo $this->_tpl_vars['language']['HostName']; ?>
时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请<?php echo $this->_tpl_vars['language']['Input']; ?>
正确掩码');
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

