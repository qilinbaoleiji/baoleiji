<?php /* Smarty version 2.6.18, created on 2014-04-22 23:19:57
         compiled from syslog_mail_alarm.tpl */ ?>
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
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>


  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=syslog_mail_alarm">
	<tr><th colspan="3" class="list_bg"></th></tr>
	<tr bgcolor="f7f7f7"><td align="right"><?php echo $this->_tpl_vars['language']['StartupMailAlert']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="radio" name="Mail_Alarm" <?php if ($this->_tpl_vars['alarm']['Mail_Alarm'] == '1'): ?>checked<?php endif; ?> value="1" /><?php echo $this->_tpl_vars['language']['Startup']; ?>
 <input type="radio" name="Mail_Alarm" <?php if ($this->_tpl_vars['alarm']['Mail_Alarm'] == '0'): ?>checked<?php endif; ?> value="0" /><?php echo $this->_tpl_vars['language']['Shutdown']; ?>

		</td>
		
	</tr>
	<tr><td align="right"><?php echo $this->_tpl_vars['language']['MailServer']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="Mailserver" value="<?php echo $this->_tpl_vars['alarm']['MailServer']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right"><?php echo $this->_tpl_vars['language']['EmailAccount']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="account" value="<?php echo $this->_tpl_vars['alarm']['account']; ?>
" />
		</td>
		
	</tr>
	<tr><td align="right"><?php echo $this->_tpl_vars['language']['AccountPassword']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="password" name="password" value="<?php echo $this->_tpl_vars['alarm']['password']; ?>
" />
		</td>
		
	</tr>

	<tr bgcolor="f7f7f7"><td align="right">认证邮件告警:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="mailalarm" >
		<option value="yes" <?php if ($this->_tpl_vars['alarm']['mailalarm'] == 'yes'): ?>selected<?php endif; ?>>是</option>
		<option value="no" <?php if ($this->_tpl_vars['alarm']['mailalarm'] == 'no'): ?>selected<?php endif; ?>>否</option>
		</select>&nbsp;打开认证告警邮件，如果告警邮件过多可能造成邮件堵塞，修改后请到系统管理中重启认证服务
		</td>
		
	</tr>
	
	<tr><td align="right"><?php echo $this->_tpl_vars['language']['StartupsyslogAlert']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="radio" name="syslog_alarm" <?php if ($this->_tpl_vars['alarm']['Syslog_Alarm'] == '1'): ?>checked<?php endif; ?> value="1" /><?php echo $this->_tpl_vars['language']['Startup']; ?>
 <input type="radio" name="syslog_alarm" <?php if ($this->_tpl_vars['alarm']['Syslog_Alarm'] == '0'): ?>checked<?php endif; ?> value="0" /><?php echo $this->_tpl_vars['language']['Shutdown']; ?>

		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">syslog<?php echo $this->_tpl_vars['language']['Server']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="syslogserver" value="<?php echo $this->_tpl_vars['alarm']['syslogserver']; ?>
" />
		</td>
		
	</tr>
	<tr><td align="right">syslog<?php echo $this->_tpl_vars['language']['port']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="syslogport" value="<?php echo $this->_tpl_vars['alarm']['syslogport']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">syslog<?php echo $this->_tpl_vars['language']['device']; ?>
:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="syslog_facility" >
		<option value="local0" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local0'): ?>selected<?php endif; ?>>local0</option>
		<option value="local1" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local1'): ?>selected<?php endif; ?>>local1</option>
		<option value="local2" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local2'): ?>selected<?php endif; ?>>local2</option>
		<option value="local3" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local3'): ?>selected<?php endif; ?>>local3</option>
		<option value="local4" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local4'): ?>selected<?php endif; ?>>local4</option>
		<option value="local5" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local5'): ?>selected<?php endif; ?>>local5</option>
		<option value="local6" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local6'): ?>selected<?php endif; ?>>local6</option>
		<option value="local7" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local7'): ?>selected<?php endif; ?>>local7</option>
		</select>
		</td>
		
	</tr>
	<tr>
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

