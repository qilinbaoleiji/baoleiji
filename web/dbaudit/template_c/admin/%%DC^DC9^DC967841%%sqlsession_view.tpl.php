<?php /* Smarty version 2.6.18, created on 2013-12-31 09:13:10
         compiled from sqlsession_view.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>

<body>


	<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><span class="back_img">过滤:<input type="checkbox" value="1" <?php if ($this->_tpl_vars['filter']): ?>checked<?php endif; ?> id="filter" name="filter" onclick="dofilter()" />&nbsp;&nbsp;<a href="admin.php?controller=admin_sqlnet&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
			<tr>
				<th class="list_bg"  width="10%"><?php echo $this->_tpl_vars['language']['ExcuteTime']; ?>
</th>
				<th class="list_bg"  width="15%"><?php echo $this->_tpl_vars['language']['Command']; ?>
</th>				
				<th class="list_bg"   width="5%">命令字节</th>
				<th class="list_bg"   width="5%">结果字节</th>
				<th class="list_bg"   width="5%">响应时间</th>
				<th class="list_bg"   width="5%">返回代码</th>
				<th class="list_bg"   width="5%">字段审计</th>
				<th class="list_bg"   width="5%">级别</th>
				<th class="list_bg"   width="5%">详细</th>
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
			<tr <?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] > 5): ?>bgcolor="red"<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] > 0): ?>bgcolor="yellow" <?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>

				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['at']; ?>
</ td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cmd']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cmd_bytes']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['result_bytes']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['return_time']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['return_code']; ?>
</td>
				<td><?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['return_result_content'] && $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['return_result_title']): ?>是<?php else: ?>不<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['level'] == 1): ?>正常<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['level'] == 2): ?>关注<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['level'] == 3): ?>低风险<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['level'] == 4): ?>中风险<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['level'] == 5): ?>高风险<?php endif; ?></td>
				<td><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/doc_table.gif" width="16" height="16" align="absmiddle"><a style="cursor:hand" onclick="javascript:window.open('admin.php?controller=admin_sqlnet&action=cmddetail&cid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
&tablename=<?php echo $this->_tpl_vars['tablename']; ?>
','newwin')" >详细</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				<td colspan="12" align="right">
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
<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_sqlnet&action=view&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
  
				<!--
				<select  class="wbk"  name="table_name">
				<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['table_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
" <?php if ($this->_tpl_vars['table_list'][$this->_sections['t']['index']] == $this->_tpl_vars['now_table_name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
</option>
				<?php endfor; endif; ?>
				</select>
				-->
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>
</td>
<script>
function dofilter(){
	if(document.getElementById('filter').checked){
		document.location="admin.php?controller=admin_sqlnet&action=view&sid=<?php echo $this->_tpl_vars['sid']; ?>
&filter=1&page=<?php echo $this->_tpl_vars['curr_page']; ?>
";
	}else{
		document.location="admin.php?controller=admin_sqlnet&action=view&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
";
	}
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

