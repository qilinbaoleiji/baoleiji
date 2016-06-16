<?php /* Smarty version 2.6.18, created on 2014-04-26 10:17:43
         compiled from route.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ifcfgeth">网络配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=config_route">静态路由</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ping">PING</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
  <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=tracepath">TRACE</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>

 
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	
	<tr>
		<th class="list_bg" align=center>序号</th>
		<th class="list_bg" align=center>网段</th>
		<th class="list_bg" align=center>掩码</th>
		<th class="list_bg" align=center>网关</th>
		<th class="list_bg" align=center>操作</th>
	</tr>
	<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['route']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
	<form action='admin.php?controller=admin_eth&action=route_save' method='post'>
	<tr <?php if ($this->_sections['r']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td align=center><?php echo $this->_sections['r']['index']+1; ?>
</td>
		<td align=center><input name='section' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['section']; ?>
'></td>
		<td align=center><input name='netmask' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['netmask']; ?>
'></td>
		<td align=center><input name='gateway' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['gateway']; ?>
'></td>
		<td align=center><input type='submit' name="modify" value='修改' class="an_02">&nbsp;&nbsp;<input type="submit" name="delete" value='删除' class="an_02"></td>
		
	</tr>
	<input type="hidden" name="sectionold" value="<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['section']; ?>
">
	<input type="hidden" name="netmaskold" value="<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['netmask']; ?>
">
	<input type="hidden" name="gatewayold" value="<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['gateway']; ?>
">
	</form>
	<?php endfor; endif; ?>
	<form action='admin.php?controller=admin_eth&action=route_add2' method='post'>
	<tr bgcolor="f7f7f7">
		<td align=center>增加</td>
		<td align=center><input name='section' value=''></td>
		<td align=center><input name='netmask' value=''></td>
		<td align=center><input name='gateway' value=''></td>
		<td align=center><input type='submit' value='增加' class="an_02"></td>
		
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


