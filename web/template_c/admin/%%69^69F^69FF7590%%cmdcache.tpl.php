<?php /* Smarty version 2.6.18, created on 2014-06-11 09:24:24
         compiled from cmdcache.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=configreport">报表配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cronreports">报表自动生成配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=downloadcronreport">下载报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cmdcache">命令Cache</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_reports&action=forbidden_groups_list&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="ip_list" action="admin.php?controller=admin_reports&action=del_cmdcache" method="post">
			<tr>
				<th class="list_bg"  width="3%">选择</th>
				<th class="list_bg"  width="30%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=gid&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >命令</a></th>
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
				<td><input type="checkbox" name="chk_gid[]" value="<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cmd']; ?>
</td>
				<td>
				<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_reports&action=cmdcache_edit&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
">编辑</a>
				| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_reports&action=del_cmdcache&id=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>				
				</td>
			</tr>
			<?php endfor; endif; ?>
			
			
			<tr>
			<td align="left" colspan="2"><input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_gid[]')e.checked=this.form.select_all.checked;}" value="checkbox">全选&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="my_confirm('删除所选IP');if(chk_form()) document.ip_list.action='admin.php?controller=admin_config&action=delete_all_ip'; else return false;" class="an_02">&nbsp;&nbsp;
			<input type="button"  onclick="window.location='admin.php?controller=admin_reports&action=cmdcache_edit'" name="submit"  value="<?php echo $this->_tpl_vars['language']['Add']; ?>
" class="an_02">
			&nbsp;&nbsp;
			<input type="button"  onclick="window.location='admin.php?controller=admin_reports&action=cmdcache_import'" name="submit"  value="导入" class="an_02">

			<input type="hidden" name="add" value="new" >
			</td>
				<td colspan="5" align="right">
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
<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_reports&action=cmdcache&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

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

