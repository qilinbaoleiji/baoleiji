<?php /* Smarty version 2.6.18, created on 2013-12-31 00:34:29
         compiled from auditpolicy_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>黑名单分组列表</title>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div></td></tr>
  <tr>
	<td class="">
	
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<form name="ip_list" action="admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
" method="post">
			<tr>
				<th class="list_bg"  width="3%">选择</th>
				<th class="list_bg"  width="15%"><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_list&orderby1=optionsname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
" >审计策略</a></th>
				<th class="list_bg"  width="15%">操作</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allcommand']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><input type="checkbox" name="chk_gid[]" value="<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['name']; ?>
</a></td>
				<td style="TEXT-ALIGN: left;"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
">编辑</a>	| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="#" onclick="window.open('admin.php?controller=admin_auditpolicy&action=setorder&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
', 'newwindow', 'height=80, width=100, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no'); return false;">移动</a>
			
				| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
">删除</a>
				</td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				<td colspan="2" align="left">
					<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_gid[]')e.checked=this.form.select_all.checked;}" value="checkbox">选中本页显示的所有项目&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="my_confirm('删除所选IP');if(chk_form()) document.ip_list.action='admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="window.location='admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
'" type="button"  value="增加" class="an_02" />
									</td>	
									
		
			
				<td colspan="2" align="right">
				
					共<?php echo $this->_tpl_vars['command_num']; ?>
执行命令  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  页 
						</td>
			</tr>
			</form>
			
			
			
		</table>
		
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


