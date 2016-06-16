<?php /* Smarty version 2.6.18, created on 2013-07-05 22:25:50
         compiled from passwordpolicy.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />

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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>

  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=passwordpolicy_save">
	
	<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td><?php echo $this->_tpl_vars['language']['Minimumpasswordlength']; ?>
:</td>
		<td align=left>
		<input type="text" class="wbk" name="login_pwd_length" value="<?php echo $this->_tpl_vars['loginsetting']['login_pwd_length']; ?>
" /><?php echo $this->_tpl_vars['language']['greaterthaneight']; ?>

		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>错误登陆锁定:</td>
		<td align=left>
		<input type="text" class="wbk" name="login_times" value="<?php echo $this->_tpl_vars['loginsetting']['login_times']; ?>
" /><?php echo $this->_tpl_vars['language']['fivenum']; ?>

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
		<input type="checkbox" name="pwdstrong1" value="1" <?php if ($this->_tpl_vars['loginsetting']['pwdstrong1']): ?> checked<?php endif; ?> />包含数字
		<input type="checkbox" name="pwdstrong2" value="1" <?php if ($this->_tpl_vars['loginsetting']['pwdstrong2']): ?> checked<?php endif; ?>  />包含字母
		<input type="checkbox" name="pwdstrong4" value="1" <?php if ($this->_tpl_vars['loginsetting']['pwdstrong4']): ?> checked<?php endif; ?>  />包含特殊字符
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
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>密码存贮:</td>
		<td align=left>
		<select name="encrypt" id="encrypt">
		<option value="yes" <?php if ($this->_tpl_vars['udf']['encrypt'] == 'yes'): ?>selected<?php endif; ?>>加密</option>
		<option value="no" <?php if ($this->_tpl_vars['udf']['encrypt'] == 'no'): ?>selected<?php endif; ?>>明文</option>
		</select>
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
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td>令牌漂移:</td>
		<td align=left>
		<input type="text" class="wbk" name="nr_minute" value="<?php echo $this->_tpl_vars['udf']['nr_minute']; ?>
" />
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

