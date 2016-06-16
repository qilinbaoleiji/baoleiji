<?php /* Smarty version 2.6.18, created on 2013-09-12 23:15:52
         compiled from ipgroup_list.tpl */ ?>
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


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
  <tr>
    <td  align="right"><a href="admin.php?controller=admin_ipgroup&back=1"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back.png" width="50" border=0 width="60" /></a></td>
  </tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
                <TBODY>
				  
                  <TR>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >IP</a></TD>
					<th class="list_bg" ><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&orderby1=netmask&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >网络掩码</a></TD>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</TD>
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
 <td> <?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['ip']; ?>
</td>	
  <td> <?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['netmask']; ?>
</td>
				<td>
				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_ipgroup&action=ipgroup_ip_edit&id=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['id']; ?>
&groupid=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['group_id']; ?>
" >编辑</a>
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('<?php echo $this->_tpl_vars['language']['Delete_sure_']; ?>
？')) {return false;} else { location.href='admin.php?controller=admin_ipgroup&action=ipgrouplist_delete&id=<?php echo $this->_tpl_vars['s'][$this->_sections['t']['index']]['id']; ?>
';}"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			<tr>

	           <td  colspan="5" align="right"><input type="button" onclick="window.location='admin.php?controller=admin_ipgroup&action=ipgroup_ip_edit&groupid=<?php echo $this->_tpl_vars['groupid']; ?>
'" name="submit" class="wbk" value="<?php echo $this->_tpl_vars['language']['Add']; ?>
" />&nbsp;&nbsp;&nbsp;&nbsp;
		   			<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_ipgroup&action=dev_group_index&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

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
