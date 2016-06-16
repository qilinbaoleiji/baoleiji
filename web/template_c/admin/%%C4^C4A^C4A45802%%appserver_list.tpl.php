<?php /* Smarty version 2.6.18, created on 2014-07-03 00:09:05
         compiled from appserver_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>会话列表</title>
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
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appserver_list">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_app&action=app_group">应用用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appprogram_list">应用程序</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appicon_list">应用图标</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>

	
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<tr>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_config&action=appserver_list&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用发布服务器名称</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_config&action=appserver_list&orderby1=appserverip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用发布服务器IP</a></th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=appserver_list&orderby1=description&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >描述</a></th>
				<th class="list_bg"  width="15%">操作</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['apppub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['appserverip']; ?>
</ td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['description']; ?>
</ td>
				<td style="TEXT-ALIGN: left;"><img src='./template/admin/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_config&action=appserver_edit&id=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['id']; ?>
'>修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
				| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a onclick="if(confirm('确定删除吗?')) return true;else return false;" href="admin.php?controller=admin_config&action=appserver_delete&id=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['id']; ?>
">删除</a>&nbsp;| <img src='./template/admin/images/app.png' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['appserverip']; ?>
'>应用发布</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				
				<td align="left">
				<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
					<input type="button" onclick="location.href='admin.php?controller=admin_config&action=appserver_edit'" value="增加" class="an_02">
				<?php endif; ?>
				</td><td colspan="3" align="right">
					共<?php echo $this->_tpl_vars['command_num']; ?>
执行命令  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_session&action=dangerlist&page='+this.value;">页
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>
<script type="text/javascript">
window.parent.menu.document.getElementById('devtree').style.display='none';
window.parent.menu.document.getElementById('ldaptree').style.display='none';
</script>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


