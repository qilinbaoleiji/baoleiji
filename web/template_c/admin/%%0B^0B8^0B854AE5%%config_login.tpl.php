<?php /* Smarty version 2.6.18, created on 2014-07-03 15:23:51
         compiled from config_login.tpl */ ?>
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
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=login_save">
	<tr><th colspan="3" class="list_bg"></th></tr>
	<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td><?php echo $this->_tpl_vars['language']['Minimumpasswordlength']; ?>
:</td>
		<td align=left>
		<input type="text" class="wbk" name="login_pwd_length" value="<?php echo $this->_tpl_vars['loginsetting']['login_pwd_length']; ?>
" />
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>错误登陆锁定:</td>
		<td align=left>
		<input type="text" class="wbk" name="login_times" value="<?php echo $this->_tpl_vars['loginsetting']['login_times']; ?>
" />
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>错误登陆锁定时间:</td>
		<td align=left>
		<input type="text" class="wbk" name="login_times_last" value="<?php echo $this->_tpl_vars['loginsetting']['login_times_last']; ?>
" />分钟
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td><?php echo $this->_tpl_vars['language']['Time']; ?>
<?php echo $this->_tpl_vars['language']['Set']; ?>
:</td>
		<td align=left>
		<input type="text" class="wbk" name="logintimeout" value="<?php echo $this->_tpl_vars['loginsetting']['logintimeout']; ?>
" /><?php echo $this->_tpl_vars['language']['minutes']; ?>

		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>自动密码:自动生成的密码长度</td>
		<td align=left>
		<input type="text" class="wbk" name="pwdautolength" value="<?php echo $this->_tpl_vars['loginsetting']['pwdautolength']; ?>
" />
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>记忆旧密码次数</td>
		<td align=left>
		<input type="text" class="wbk" name="oldpassnumber" value="<?php echo $this->_tpl_vars['loginsetting']['oldpassnumber']; ?>
" />
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>密码强度:</td>
		<td align=left>
		包含<input type="text" name="pwdstrong1" size="3" value="<?php echo $this->_tpl_vars['loginsetting']['pwdstrong1']; ?>
" />个数字
		包含<input type="text" name="pwdstrong2" size="3" value="<?php echo $this->_tpl_vars['loginsetting']['pwdstrong2']; ?>
" />个小写字母
		包含<input type="text" name="pwdstrong3" size="3" value="<?php echo $this->_tpl_vars['loginsetting']['pwdstrong3']; ?>
" />个大写字母
		包含<input type="text" name="pwdstrong4" size="3" value="<?php echo $this->_tpl_vars['loginsetting']['pwdstrong4']; ?>
" />个特殊字符
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>密码有效期:</td>
		<td align=left>
		密码有效期：<input type="text" class="wbk" name="pwdexpired" value="<?php echo $this->_tpl_vars['loginsetting']['pwdexpired']; ?>
" />,
		提前<input type="text" class="wbk" name="pwdahead" value="<?php echo $this->_tpl_vars['loginsetting']['pwdahead']; ?>
" />天提醒用户注意
		</td>
		
	</tr>

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>相同用户允许同时登录的最大值:</td>
		<td align=left>
		<input type="text" class="wbk" name="onlinecountmax" value="<?php echo $this->_tpl_vars['loginsetting']['onlinecountmax']; ?>
" />
		</td>
		
	</tr>

	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>认证调试:</td>
		<td align=left>
		<select name="debug" >
		<option value="yes" <?php if ($this->_tpl_vars['udf']['debug'] == 'yes'): ?>selected<?php endif; ?>>打开</option>
		<option value="no" <?php if ($this->_tpl_vars['udf']['debug'] == 'no'): ?>selected<?php endif; ?>>关闭</option>
		</select>
		</td>
		
	</tr>

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>密码存贮:</td>
		<td align=left> 
			<?php if ($this->_tpl_vars['udf']['encrypt'] == 'yes'): ?>加密<?php else: ?>明文<?php endif; ?>
		</td>
		
	</tr>


	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>令牌漂移:</td>
		<td align=left>
		
		<select name="nr_minute" >
		<option value="15" <?php if ($this->_tpl_vars['udf']['nr_minute'] == '15'): ?>selected<?php endif; ?>>15</option>
		<option value="30" <?php if ($this->_tpl_vars['udf']['nr_minute'] == '30'): ?>selected<?php endif; ?>>30</option>
		<option value="60" <?php if ($this->_tpl_vars['udf']['nr_minute'] == '60'): ?>selected<?php endif; ?>>60</option>
		</select>
		</td>
		
	</tr>

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td  align="center" colspan=2><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
		</tr>

	</table>
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
	<input type="hidden" name="encrypt2" value="<?php echo $this->_tpl_vars['udf']['encrypt']; ?>
" />
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
   if(document.getElementById("encrypt").options[document.getElementById("encrypt").options.selectedIndex].value!='<?php echo $this->_tpl_vars['udf']['encrypt']; ?>
'){
		if(confirm("所有的密码将被转换,请注意要先备份!")==false){
			return false;
		}
   }
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

