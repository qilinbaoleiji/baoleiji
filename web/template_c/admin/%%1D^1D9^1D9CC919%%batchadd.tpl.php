<?php /* Smarty version 2.6.18, created on 2014-07-03 20:27:59
         compiled from batchadd.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
    <li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>b<?php else: ?>a<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>a<?php else: ?>b<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if (! $_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if (! $_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
   
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_member&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
</head>

<body>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="3%" align="center" bgcolor="#E0EDF8"><b>序列</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>用户名</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>真实姓名</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>密码</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>确认密码</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>工作单位</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>用户权限</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>运维组</b></th>
		</tr>		
		<form name='route' action='admin.php?controller=admin_member&action=batchadd_save' method='post'>
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=20) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?>
		
		<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td width="3%" class="td_line"><?php echo $this->_sections['t']['index']+1; ?>
</td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="username[]" value="" /></td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="realname[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" class="wbk" name="password[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" class="wbk" name="confirm_password[]" value="" /></td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="workcompany[]" value="" /></td>
			<td width="10%" class="td_line"><select  class="wbk"  name="level[]" onchange="change_level(this,<?php echo $this->_sections['t']['index']+1; ?>
);">
							<?php if ($_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 21 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
							<?php if ($_SESSION['RADIUSUSERLIST']): ?>
							<?php else: ?>
							<option value="0"><?php echo $this->_tpl_vars['language']['common']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="11" >RADIUS<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="21" >部门审计员</option>
							<option value="101" >部门密码员</option>
							<?php endif; ?>
							<?php else: ?>
							<?php if ($_SESSION['RADIUSUSERLIST']): ?>
							<option value="11" >RADIUS<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<?php else: ?>
							<option value="0" ><?php echo $this->_tpl_vars['language']['common']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="11" >RADIUS<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="1" ><?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>							
							<option value="2" ><?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
</option>
							<option value="3" ><?php echo $this->_tpl_vars['language']['group']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="4" >配置管理员<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="10" ><?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="21" >部门审计员</option>
							<option value="101" >部门密码员</option>
							<?php endif; ?>
							<?php endif; ?>
						</select></td>
			<td width="10%" class="td_line"><select  class="wbk"  name="groupid[]" id="groupid_<?php echo $this->_sections['t']['index']+1; ?>
">
						<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
						<option value="0" >请选择</option>
						<?php endif; ?>
						<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['GroupName']; ?>
</option>
						<?php endfor; endif; ?>
						</select></td>
		</tr>
		
		<?php endfor; endif; ?>
		 <tr>
			<td colspan="9" align="center" ><input type='submit'  name="batch" value='确定' class="an_02"></td>
		  </tr>
		</form>

		</table>
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
function change_level(obj, num){
<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>
	obj.selectedIndex=0;
<?php endif; ?>
	if(obj.value==11){
		var group = document.getElementById('groupid_'+num);
		var o_value = null;
		for(var i=0; i<group.options.length; i++){
			o_value = group.options[i].text.toLowerCase();
			if(o_value.indexOf("radius")>=0){
				group.options[i].selected = true;
				break;
			}
		}
	}
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


