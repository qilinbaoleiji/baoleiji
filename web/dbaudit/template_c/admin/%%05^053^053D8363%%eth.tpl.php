<?php /* Smarty version 2.6.18, created on 2013-07-16 15:36:05
         compiled from eth.tpl */ ?>
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
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_eth&action=eth_save">
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		ip地址		
		</td>
		<td width="67%">
		<input type=text name="ipaddr" size=35 value="<?php echo $this->_tpl_vars['ipaddr']; ?>
" >
	  </td>
	</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		掩码		
		</td>
		<td width="67%">
		<input type=text name="netmask" size=35 value="<?php echo $this->_tpl_vars['netmask']; ?>
" >
	  </td>
	</tr>
<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		网关		
		</td>
		<td width="67%">
		<input type=text name="gateway" size=35 value="<?php echo $this->_tpl_vars['gateway']; ?>
" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td width="33%" align=right>DNS<?php echo $this->_tpl_vars['language']['Server']; ?>
一:</td>
		<td align=left width="67%">
		<input type="text" class="wbk" name="nameserver1" value="<?php echo $this->_tpl_vars['sshconfig']['nameserver1']; ?>
" />	
		</td>
		
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td width="33%" align=right>DNS<?php echo $this->_tpl_vars['language']['Server']; ?>
二:</td>
		<td align=left width="67%">
		<input type="text" class="wbk" name="nameserver2" value="<?php echo $this->_tpl_vars['sshconfig']['nameserver2']; ?>
" />	
		</td>
		
	</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td  align="center" colspan=2><input  type="submit" onclick="return reset();" value="重<?php echo $this->_tpl_vars['language']['new']; ?>
<?php echo $this->_tpl_vars['language']['Start']; ?>
" class="an_02">&nbsp;&nbsp;<input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
		</tr>

	</table>
</form>

		</table>
	</td>
  </tr>
</table>


<script language="javascript">
function reset(){
	if(confim('确定要重<?php echo $this->_tpl_vars['language']['new']; ?>
<?php echo $this->_tpl_vars['language']['Start']; ?>
吗?')){
		document.location='admin.php?controller=admin_eth&action=system_init_6'
		return false;
	}
	return false;
}
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

