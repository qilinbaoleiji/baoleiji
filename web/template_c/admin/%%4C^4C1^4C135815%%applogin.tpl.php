<?php /* Smarty version 2.6.18, created on 2014-05-06 16:36:28
         compiled from applogin.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>
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

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appserver_list">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_app&action=app_group">应用用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appprogram_list">应用程序</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=applogin">应用填密</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appicon_list">应用图标</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>
 
  <tr>
	<td class="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
				<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				<tr><th colspan="1" class="list_bg">用户名</th><th colspan="1" class="list_bg">密码</th></tr>	
				  <tr>
				  <td width="50%" align=center>
					<select  class="wbk"  style="width:400;height:400;"  name="first" size="30" id="first" multiple="multiple" onclick="showit('u');">
					<?php unset($this->_sections['ra']);
$this->_sections['ra']['name'] = 'ra';
$this->_sections['ra']['loop'] = is_array($_loop=$this->_tpl_vars['usernames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ra']['show'] = true;
$this->_sections['ra']['max'] = $this->_sections['ra']['loop'];
$this->_sections['ra']['step'] = 1;
$this->_sections['ra']['start'] = $this->_sections['ra']['step'] > 0 ? 0 : $this->_sections['ra']['loop']-1;
if ($this->_sections['ra']['show']) {
    $this->_sections['ra']['total'] = $this->_sections['ra']['loop'];
    if ($this->_sections['ra']['total'] == 0)
        $this->_sections['ra']['show'] = false;
} else
    $this->_sections['ra']['total'] = 0;
if ($this->_sections['ra']['show']):

            for ($this->_sections['ra']['index'] = $this->_sections['ra']['start'], $this->_sections['ra']['iteration'] = 1;
                 $this->_sections['ra']['iteration'] <= $this->_sections['ra']['total'];
                 $this->_sections['ra']['index'] += $this->_sections['ra']['step'], $this->_sections['ra']['iteration']++):
$this->_sections['ra']['rownum'] = $this->_sections['ra']['iteration'];
$this->_sections['ra']['index_prev'] = $this->_sections['ra']['index'] - $this->_sections['ra']['step'];
$this->_sections['ra']['index_next'] = $this->_sections['ra']['index'] + $this->_sections['ra']['step'];
$this->_sections['ra']['first']      = ($this->_sections['ra']['iteration'] == 1);
$this->_sections['ra']['last']       = ($this->_sections['ra']['iteration'] == $this->_sections['ra']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['usernames'][$this->_sections['ra']['index']]['uid']; ?>
" title="<?php echo $this->_tpl_vars['usernames'][$this->_sections['ra']['index']]['username']; ?>
"><?php echo $this->_tpl_vars['usernames'][$this->_sections['ra']['index']]['username']; ?>
</option>
					<?php endfor; endif; ?>
					</select>
					</td>
					 <td align="center">
					<select  class="wbk"   style="width:400;height:400;" size="30" id="secend" name="secend[]" multiple="multiple"  onclick="showit('p');">
					<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['passwords']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="<?php echo $this->_tpl_vars['passwords'][$this->_sections['r']['index']]['uid']; ?>
" title="<?php echo $this->_tpl_vars['passwords'][$this->_sections['r']['index']]['password']; ?>
" ><?php echo $this->_tpl_vars['passwords'][$this->_sections['r']['index']]['password']; ?>
</option>
					<?php endfor; endif; ?>
					</select>
				  </td>
				</tr>
				<tr>
				<td align="center">
				<input type="hidden"  value="0" id="uid">
				<input type="text" name="username" id="username" />
				&nbsp;&nbsp;<input type="submit"  value="保存" onclick="fsave('u');" class="an_02">
				&nbsp;&nbsp;<input type="submit"  value="删除" onclick="fdel('u');" class="an_02">
				</td>
				<td align="center">
				<input type="text" name="password" id="password" />
				&nbsp;&nbsp;<input type="submit"  value="保存" onclick="fsave('p');" class="an_02">
				&nbsp;&nbsp;<input type="submit"  value="删除" onclick="fdel('p');" class="an_02">
				</td>
				</tr>
				</table>
			</td>
		</tr>
		
</table>

<script language="javascript">
var changed = false;
function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

</script>
<script type="text/javascript" >
	function fsave(up){
		if(up=='u'){
			window.location='admin.php?controller=admin_pro&action=applogin_save&username='+document.getElementById('username').value+'&uid='+document.getElementById('uid').value;
		}else{
			window.location='admin.php?controller=admin_pro&action=applogin_save&password='+document.getElementById('password').value+'&uid='+document.getElementById('uid').value;
		}
		return true;
	}

	function fdel(up){
		if(up=='u'){
			window.location='admin.php?controller=admin_pro&action=delapplogin&username='+document.getElementById('username').value+'&uid='+document.getElementById('uid').value;
		}else{
			window.location='admin.php?controller=admin_pro&action=delapplogin&password='+document.getElementById('password').value+'&uid='+document.getElementById('uid').value;
		}
		return true;
	}

	function showit(up){
		if(up=='u'){
			document.getElementById('username').value=document.getElementById('first').options[document.getElementById('first').options.selectedIndex].text;
			document.getElementById('uid').value=document.getElementById('first').options[document.getElementById('first').options.selectedIndex].value;
		}else{
			document.getElementById('password').value=document.getElementById('secend').options[document.getElementById('secend').options.selectedIndex].text;
			document.getElementById('uid').value=document.getElementById('secend').options[document.getElementById('secend').options.selectedIndex].value;
		}
		return true;
	}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

