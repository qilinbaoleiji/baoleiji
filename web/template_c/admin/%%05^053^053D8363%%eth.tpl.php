<?php /* Smarty version 2.6.18, created on 2014-04-26 09:51:40
         compiled from eth.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'eth.tpl', 41, false),)), $this); ?>
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
   <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ifcfgeth">网络配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=config_route">静态路由</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ping">PING</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
  <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=tracepath">TRACE</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_eth&action=ifcfgeth&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>



  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_eth&action=eth_save&file=<?php echo ((is_array($_tmp=$this->_tpl_vars['file'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&name=<?php echo $this->_tpl_vars['name']; ?>
">
<tr><th colspan="3" class="list_bg"></th></tr>
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
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>><td width="33%" align=right>启动:</td>
		<td align=left width="67%">
		<select name="onboot" >
		<option value="yes" <?php if ($this->_tpl_vars['onboot'] == 'yes'): ?>selected<?php endif; ?>>启用</option>
		<option value="no" <?php if ($this->_tpl_vars['onboot'] == 'no'): ?>selected<?php endif; ?>>禁用</option>
		</select>
		</td>		
	</tr>
<?php if ($this->_tpl_vars['name'] == 'ETH0'): ?>
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
	
<?php endif; ?>	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td  align="center" colspan=2><input  type="submit" onclick="return reset();" value="重启网络" class="an_02">&nbsp;&nbsp;<input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
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
		document.location='admin.php?controller=admin_eth&action=network_restart'
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

