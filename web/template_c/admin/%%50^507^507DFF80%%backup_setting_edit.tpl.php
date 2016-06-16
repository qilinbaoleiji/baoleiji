<?php /* Smarty version 2.6.18, created on 2014-06-19 11:42:29
         compiled from backup_setting_edit.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=serverstatus">服务状态</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_status&action=latest">系统状态</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
   <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup">配置备份</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting">数据同步</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=upgrade">软件升级</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_backup&action=backup_setting&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_backup&action=backup_setting_save&id=<?php echo $this->_tpl_vars['bs']['seq']; ?>
">
	<tr><th colspan="2" class="list_bg"></th></tr>
	<tr><td align="right" width="33%">描述</td>
		<td align="left"  width="66%">&nbsp;
		<input type="text" class="wbk" name="desc" value="<?php echo $this->_tpl_vars['bs']['desc']; ?>
" >
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">同步模式:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="session_flag" onchange="chgmode(this.value);">
		<option value="0" <?php if ($this->_tpl_vars['bs']['session_flag'] == '0'): ?>selected<?php endif; ?>>审计日志</option>
		<option value="100" <?php if ($this->_tpl_vars['bs']['session_flag'] == '100'): ?>selected<?php endif; ?>>资产权限</option>
		<option value="1" <?php if ($this->_tpl_vars['bs']['session_flag'] == '1'): ?>selected<?php endif; ?>>主从数据</option>
		<option value="2" <?php if ($this->_tpl_vars['bs']['session_flag'] == '2'): ?>selected<?php endif; ?>>密码文件</option>
		</select>
		</td>
		
	</tr>
	<tr><td align="right">同步地址</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="ip" value="<?php echo $this->_tpl_vars['bs']['ip']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">同步端口:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="port" id="port" value="<?php echo $this->_tpl_vars['bs']['port']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="" id="db_synchro"><td align="right">数据库同步:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="dbactive" >
		<option value="0" <?php if ($this->_tpl_vars['bs']['dbactive'] == '0'): ?>selected<?php endif; ?>>不做同步</option>
		<option value="1" <?php if ($this->_tpl_vars['bs']['dbactive'] == '1'): ?>selected<?php endif; ?>>完全同步</option>
		<option value="2" <?php if ($this->_tpl_vars['bs']['dbactive'] == '2'): ?>selected<?php endif; ?>>配置同步</option>
		</select>
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7" id="file_synchro"><td align="right">审计文件同步:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="fileactive" >
		<option value="0" <?php if ($this->_tpl_vars['bs']['fileactive'] == '0'): ?>selected<?php endif; ?>>否</option>
		<option value="1" <?php if ($this->_tpl_vars['bs']['fileactive'] == '1'): ?>selected<?php endif; ?>>是</option>
		</select>
		</td>
		
	</tr>

	<tr bgcolor="" id="user_synchro"><td align="right">系统用户:</td>
		<td align=left>&nbsp;
		<input type="text" name="user" id="user" value="<?php echo $this->_tpl_vars['bs']['user']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7" id="passwd_synchro"><td align="right">系统用户密码:</td>
		<td align=left>&nbsp;
		<input type="password" class="wbk" name="passwd" value="<?php echo $this->_tpl_vars['bs']['passwd']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="" id="passwdc_synchro"><td align="right">确认系统用户密码:</td>
		<td align=left>&nbsp;
		<input type="password" class="wbk" name="passwdc" value="<?php echo $this->_tpl_vars['bs']['passwd']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"  id="mysqluser_synchro"><td align="right">数据库用户:</td>
		<td align=left>&nbsp;
		<input type="text" name="mysqluser" value="<?php echo $this->_tpl_vars['bs']['mysqluser']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="" id="mysqlpasswd_synchro"><td align="right">数据库用户密码:</td>
		<td align=left>&nbsp;
		<input type="password" class="wbk" name="mysqlpasswd" value="<?php echo $this->_tpl_vars['bs']['mysqlpasswd']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7" id="mysqlpasswdc_synchro"><td align="right">确认数据库用户密码:</td>
		<td align=left>&nbsp;
		<input type="password" class="wbk" name="mysqlpasswdc" value="<?php echo $this->_tpl_vars['bs']['mysqlpasswd']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="" id="dbname_synchro"><td align="right">目标数据库名称:</td>
		<td align=left>&nbsp;
		<input type="text" name="dbname" value="<?php echo $this->_tpl_vars['bs']['dbname']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7" id="path_synchro"><td align="right">备份目录:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="path" value="<?php echo $this->_tpl_vars['bs']['path']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="" id="type_synchro"><td align="right">同步协议:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="protocol" id="protocol" onchange="chgtype(this.value);">
		<option value="sftp" <?php if ($this->_tpl_vars['bs']['protocol'] == 'sftp'): ?>selected<?php endif; ?>>sftp</option>
		<option value="ftp" <?php if ($this->_tpl_vars['bs']['protocol'] == 'ftp'): ?>selected<?php endif; ?>>ftp</option>
		</select>
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7">
			<td colspan="2" align="center"><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="手动同步" class="an_02"></td>
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

function chgmode(v){
	if(v==0){
		document.getElementById('db_synchro').style.display='';
		document.getElementById('file_synchro').style.display='';
		document.getElementById('passwd_synchro').style.display='';
		document.getElementById('passwdc_synchro').style.display='';
		document.getElementById('mysqluser_synchro').style.display='';
		document.getElementById('mysqlpasswd_synchro').style.display='';
		document.getElementById('mysqlpasswdc_synchro').style.display='';
		document.getElementById('dbname_synchro').style.display='';
		document.getElementById('path_synchro').style.display='';
		document.getElementById('type_synchro').style.display='';
	}else if(v==1){
		document.getElementById('db_synchro').style.display='none';
		document.getElementById('file_synchro').style.display='none';
		document.getElementById('passwd_synchro').style.display='none';
		document.getElementById('passwdc_synchro').style.display='none';
		document.getElementById('mysqluser_synchro').style.display='none';
		document.getElementById('mysqlpasswd_synchro').style.display='none';
		document.getElementById('mysqlpasswdc_synchro').style.display='none';
		document.getElementById('dbname_synchro').style.display='none';
		document.getElementById('path_synchro').style.display='none';
		document.getElementById('type_synchro').style.display='none';
		document.getElementById('port').value='2288';
		document.getElementById('user').value='root';
	}else{
		document.getElementById('db_synchro').style.display='none';
		document.getElementById('file_synchro').style.display='none';
		document.getElementById('passwd_synchro').style.display='';
		document.getElementById('passwdc_synchro').style.display='';
		document.getElementById('mysqluser_synchro').style.display='none';
		document.getElementById('mysqlpasswd_synchro').style.display='none';
		document.getElementById('mysqlpasswdc_synchro').style.display='none';
		document.getElementById('dbname_synchro').style.display='none';
		document.getElementById('path_synchro').style.display='';
		document.getElementById('type_synchro').style.display='';
	}
}

function chgtype(v){
	if(v=='sftp'){
		document.getElementById('port').value='22';
	}else if(v=='ftp'){
		document.getElementById('port').value='21';
	}
}

<?php if ($this->_tpl_vars['bs']['seq']): ?>
chgmode(<?php echo $this->_tpl_vars['bs']['session_flag']; ?>
);
<?php else: ?>
chgtype(document.getElementById('protocol').options[document.getElementById('protocol').options.selectedIndex].value);
<?php endif; ?>
</script>
</body>
</html>

