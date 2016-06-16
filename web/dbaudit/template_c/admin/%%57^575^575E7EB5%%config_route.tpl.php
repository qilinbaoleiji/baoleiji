<?php /* Smarty version 2.6.18, created on 2013-08-19 22:09:16
         compiled from config_route.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
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
	
	<tr>
		<td align=center>序号</td>
		<td align=center>网段</td>
		<td align=center>网关</td>
		<td align=center>操作</td>
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
		<td align=center><input name='section' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['3']; ?>
'></td>
		<td align=center><input name='gateway' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['5']; ?>
'></td>
		<td align=center><input type='submit' name="modify" value='修改'>&nbsp;&nbsp;<input type="submit" name="delete" value='删除' ></td>
		
	</tr>
	<input type="hidden" name="sectionold" value="<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['3']; ?>
">
	<input type="hidden" name="gatewayold" value="<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['5']; ?>
">
	</form>
	<?php endfor; endif; ?>
	<form action='admin.php?controller=admin_eth&action=route_add2' method='post'>
	<tr bgcolor="f7f7f7">
		<td align=center>增加</td>
		<td align=center><input name='section' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['3']; ?>
'></td>
		<td align=center><input name='gateway' value='<?php echo $this->_tpl_vars['route'][$this->_sections['r']['index']]['5']; ?>
'></td>
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


