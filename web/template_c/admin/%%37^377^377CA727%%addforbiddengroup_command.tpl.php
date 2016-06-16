<?php /* Smarty version 2.6.18, created on 2014-07-01 16:34:31
         compiled from addforbiddengroup_command.tpl */ ?>
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

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=default_policy">策略设置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sourceip">来源IP组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=weektime">周组策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=forbidden_groups_list">命令权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=autochange_pwd">自动改密</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=cmdgroup_list">命令组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl">授权策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_forbidden&action=forbiddengps_cmd&gid=<?php echo $this->_tpl_vars['gid']; ?>
&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr> 
          <tr>

            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_forbidden&action=forbiddengps_cmd_save&cid=<?php echo $this->_tpl_vars['cmdinfo']['cid']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
 <tr><th colspan="3" class="list_bg"></th></tr>
 <?php if ($this->_tpl_vars['cmdinfo']['cid']): ?>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		命令:
		</td>
		<td width="67%">
		<input type = text name="cmd" value="<?php echo $this->_tpl_vars['cmdinfo']['cmd']; ?>
">
	  </td>
	</tr>
	<?php if ($this->_tpl_vars['ginfo']['black_or_white'] == 0): ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		级别:
		</td>
		<td width="67%">				
			<select  class="wbk"  name="level" >
			<option value="1" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '1'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['language']['Disconnect']; ?>
</option>
			<option value="0" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '0'): ?>selected<?php endif; ?>>命令阻断</option>
			<option value="2" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '2'): ?>selected<?php endif; ?>>命令监控</option>
			<option value="3" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '3'): ?>selected<?php endif; ?>>命令授权</option>
			</select>
	  </td>
	</tr>	
	<?php endif; ?>
<?php else: ?>
<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		命令:
		<input type = text name="cmd[]" value="<?php echo $this->_tpl_vars['cmdinfo']['cmd']; ?>
">
	  </td>
	  <td width="67%"><?php if ($this->_tpl_vars['ginfo']['black_or_white'] == 0): ?>				
			<select  class="wbk"  name="level[]" >
			<option value="1" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '1'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['language']['Disconnect']; ?>
</option>
			<option value="0" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '0'): ?>selected<?php endif; ?>>命令阻断</option>
			<option value="2" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '2'): ?>selected<?php endif; ?>>命令监控</option>
			<option value="3" <?php if ($this->_tpl_vars['cmdinfo']['level'] == '3'): ?>selected<?php endif; ?>>命令授权</option>
			</select>
			<?php endif; ?>
	  </td>
	</tr>	
<?php endfor; endif; ?>
<?php endif; ?>
	<tr>
		<td align="right"><input type="submit"  value=" 确定 " class="an_02"></td>
		<td></td>
	</tr>
	</table>
<br>
<input type="hidden" name="add" value="new" />
<input type="hidden" name="gid" value="<?php echo $this->_tpl_vars['gid']; ?>
" />
</form>
	</td>
  </tr>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

document.getElementById("telnet").selected = true;


</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

