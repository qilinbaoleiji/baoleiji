<?php /* Smarty version 2.6.18, created on 2013-10-24 16:16:49
         compiled from sqloptions_cmd.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Black']; ?>
<?php echo $this->_tpl_vars['language']['group']; ?>
<?php echo $this->_tpl_vars['language']['List']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
  <tr>
    <td  align="right"><a href="admin.php?controller=admin_sqloptions&back=1"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back.png" width="50" border=0 width="60" /></a></td>
  </tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_sqloptions&action=del_sqloptions_cmd" method="post">
			<tr>
<th width="3%">&nbsp;</th>
				<th class="list_bg"  width="35%"><a href="admin.php?controller=admin_sqloptions&action=forbiddengps_cmd&orderby1=commands&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Command']; ?>
</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_sqloptions&action=forbiddengps_cmd&orderby1=groupname&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['GroupName']; ?>
</a></th>
				<th class="list_bg"><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
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
				<td ><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
" /></td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sql_cmd']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['optionsname']; ?>
</td>
				<td>
				<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_sqloptions&action=del_sqloptions_cmd&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>				
				</td>
			</tr>
			<?php endfor; endif; ?>
			
			
			<tr>
			<td align="left" colspan="2"><input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
&nbsp;&nbsp;<input type="submit"  value="批量删除" onClick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=delete_all'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button"  onclick="window.location='admin.php?controller=admin_sqloptions&action=sqloptions_cmd_edit&optionsname=<?php echo $this->_tpl_vars['optionsname']; ?>
'" name="submit"  value="<?php echo $this->_tpl_vars['language']['Add']; ?>
" class="an_02">

			<input type="hidden" name="add" value="new" >
			</td>
				<td colspan="<?php if (! $this->_tpl_vars['ginfo']['black_or_white']): ?>4<?php else: ?>3<?php endif; ?>" align="right">
					<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['command_num']; ?>
<?php echo $this->_tpl_vars['language']['Command']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
<?php echo $this->_tpl_vars['language']['item']; ?>
<?php echo $this->_tpl_vars['language']['Log']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_sqloptions&action=dangerlist&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

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

