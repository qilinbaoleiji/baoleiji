<?php /* Smarty version 2.6.18, created on 2014-06-29 14:23:36
         compiled from config_ftp.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
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
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>


 
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ntpset">
		<tr><th colspan="3" class="list_bg"></th></tr>
	<tr bgcolor="f7f7f7"><td>NTP设置:(<?php echo $this->_tpl_vars['current_time']; ?>
)</td>
		<td align=left>KEY:
		<input type="text" class="wbk" name="ntpkey" value="<?php echo $this->_tpl_vars['sshconfig']['ntpkey']; ?>
" />	
		NTP服务器:
		<input type="text" class="wbk" name="ntpserver" value="<?php echo $this->_tpl_vars['sshconfig']['ntpserver']; ?>
" />	
		
		</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr><td>ftp堡垒机备份阈值:</td>
		<td align=left>
		<input type="text" class="wbk" name="ftpbackupsize" value="<?php echo $this->_tpl_vars['sshconfig']['ftpbackupsize']; ?>
" />	
		MB(大于此阈值堡垒机不备份上传下载文件,为0表示所有上传下载文件都不备份)</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=sftp_save">
	<tr bgcolor="f7f7f7"><td>sftp堡垒机备份阈值:</td>
		<td align=left>
		<input type="text" class="wbk" name="sftpbackupsize" value="<?php echo $this->_tpl_vars['sshconfig']['sftpbackupsize']; ?>
" />	
		MB(大于此阈值堡垒机不备份上传下载文件,为0表示所有上传下载文件都不备份)</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ping_save">
	<tr><td>允许Ping:</td>
		<td align=left>
		<input type="checkbox" class="" name="ping" value="on" <?php if ($this->_tpl_vars['sshconfig']['ping']): ?>checked<?php endif; ?> />	</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=snmp_save">
	<tr bgcolor="f7f7f7"><td>SNMP服务开启:</td>
		<td align=left>
		<input type="checkbox" class="" name="snmp" value="on" <?php if ($this->_tpl_vars['sshconfig']['snmp']): ?>checked<?php endif; ?> /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=snmpcommunity_save">
	<tr><td>SNMP通讯字符串:</td>
		<td align=left>
		<input type="text" class="wbk" name="community" value="<?php echo $this->_tpl_vars['sshconfig']['community']; ?>
" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr bgcolor="f7f7f7"><td>系统时间修改:</td>
		<td align=left>
		<input type="text" class="wbk" name="year" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['year']; ?>
" />年<input type="text" class="wbk" name="month" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['month']; ?>
" />月<input type="text" class="wbk" name="day" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['day']; ?>
" />日<input type="text" class="wbk" name="hour" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['hour']; ?>
" />时<input type="text" class="wbk" name="minute" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['minute']; ?>
" />分<input type="text" class="wbk" name="second" size="4" value="<?php echo $this->_tpl_vars['sshconfig']['second']; ?>
" />秒&nbsp;&nbsp;</td>
		<td><input type="submit" name="settime" class="an_02" value="设定时间"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=autodelete_save">
	<tr><td>自动删除周期:</td>
		<td align=left>
		<input type="text" class="wbk" name="autodelete" value="<?php echo $this->_tpl_vars['autodelcycle']; ?>
" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=keyedit">
	<tr bgcolor="f7f7f7"><td>证书修改:</td>
		<td align=left>
		<input type="text" class="wbk" name="eth0" value="<?php echo $this->_tpl_vars['eth0']; ?>
" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=logintype">
	<tr bgcolor=""><td>登录方式:</td>
		<td align=left>
		Radius:<input type="checkbox" class="wbk" name="radiusauth" <?php if ($this->_tpl_vars['logintype']['radiusauth']): ?>checked<?php endif; ?> value="1" /> &nbsp;&nbsp;&nbsp;LDAP:<input type="checkbox" class="wbk" name="ldapauth" <?php if ($this->_tpl_vars['logintype']['ldapauth']): ?>checked<?php endif; ?> value="1" /> &nbsp;&nbsp;&nbsp;AD:<input type="checkbox" class="wbk" name="adauth" <?php if ($this->_tpl_vars['logintype']['adauth']): ?>checked<?php endif; ?> value="1" /> </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=priority_cache_save">
	<tr bgcolor=""><td>强制使用权限缓存:</td>
		<td align=left>
		<select name="priority_cache">
		<option value="0" <?php if (! $this->_tpl_vars['priority_cache']): ?>selected<?php endif; ?>>否</option>
		<option value="1" <?php if ($this->_tpl_vars['priority_cache']): ?>selected<?php endif; ?>>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr>
			<td  align="center" colspan=3><input name='reset' type="submit" onclick="return confirm('重启系统?')" class="an_02" value="重启系统"> &nbsp;&nbsp;&nbsp;<input name='shutdown' type="submit"  onclick="return confirm('关闭系统?')" value="关闭系统" class="an_02">&nbsp;&nbsp;&nbsp;<input name='clearaccount' type="submit" onclick="return confirm('账号清空?')"  value="账号清空" class="an_02"></td>
		</tr>
</form>
	</table>


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
	alert('地址为主机名时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请录入正确掩码');
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


