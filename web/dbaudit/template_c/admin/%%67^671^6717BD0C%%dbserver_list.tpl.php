<?php /* Smarty version 2.6.18, created on 2013-12-31 10:34:15
         compiled from dbserver_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>
				                     <TR>

                    <th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器IP</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器名称</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=dbtype&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >数据库类型</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=desc&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >描述</a></th>
					<th class="list_bg" >操作</th>
                  </TR>

            </tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['s']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr  <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&groupid=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['ip_addr']; ?>
</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&hostname=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['hostname']; ?>
" ><?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['hostname']; ?>
</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&dbtype=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['dbtype']; ?>
" ><?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['dbtype']; ?>
</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&desc=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['desc']; ?>
" ><?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['desc']; ?>
</a></td>
				<td style="TEXT-ALIGN: left;"><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_dbserver&action=dbserver_edit&id=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['id']; ?>
" >编辑</a>
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_dbserver&action=dbserver_delete&id=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['id']; ?>
';}">删除</a>
				</td> 
			</tr>
			<?php endfor; endif; ?>
	          <tr>
	          
				<td  colspan="5" align="right"><input type="button" onclick="window.location='admin.php?controller=admin_dbserver&action=dbserver_edit'" name="submit" value=" 增加 " class="an_02" />&nbsp;&nbsp;&nbsp;&nbsp;
		   			共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_dbserver&action=dev_group_index&page='+this.value;">页
		   </td>
		   		</tr>
	           
		</TBODY>
              </TABLE>	</td>
  </tr>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

