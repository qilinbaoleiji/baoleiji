<?php /* Smarty version 2.6.18, created on 2014-07-03 00:09:07
         compiled from apppub_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
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
</head>
<script>
function chk_form(){
return true;
}
</script>
<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
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
</ul><span class="back_img"><A href="admin.php?controller=admin_config&action=appserver_list&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
			<tr>
				<th class="list_bg"  width="5%">#</th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用名称</a></th>
				<th class="list_bg"  width="8%"><a href="admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >用户名</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器</a></th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >程序路径</a></th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >描述</a></th>
				<th class="list_bg"  width="15%"><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
			</tr>
			<form action='#' method='post' name='member_list' >
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
				<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['name']; ?>
</td>
				<td><?php if ($this->_tpl_vars['apppub'][$this->_sections['t']['index']]['username']): ?><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['username']; ?>
<?php else: ?>空用户<?php endif; ?></td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['path']; ?>
</td>
				<td><?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['description']; ?>
</td>
				<td>
				
			<img src='./template/admin/images/left_dot1.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_config&action=apppub_edit&id=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['id']; ?>
&appserverip=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['appserverip']; ?>
'><?php echo $this->_tpl_vars['language']['Edit']; ?>
</a>	
				&nbsp;|&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a onclick="if(confirm('确定<?php echo $this->_tpl_vars['language']['Delete']; ?>
吗?')) return true;else return false;" href="admin.php?controller=admin_config&action=apppub_delete&id=<?php echo $this->_tpl_vars['apppub'][$this->_sections['t']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
						<td colspan="8" align="left">
							<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
的<?php echo $this->_tpl_vars['language']['All']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="if(confirm('确定要删除?')) document.member_list.action='admin.php?controller=admin_config&action=apppub_delete&appserverip=<?php echo $this->_tpl_vars['appserverip']; ?>
';else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="location.href='admin.php?controller=admin_config&action=apppub_edit&appserverip=<?php echo $this->_tpl_vars['appserverip']; ?>
'"  value="<?php echo $this->_tpl_vars['language']['Add']; ?>
" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button"  value="导入" onClick="javascript: document.location='admin.php?controller=admin_config&action=apppubimport&appserverip=<?php echo $this->_tpl_vars['appserverip']; ?>
';" class="an_02">
							&nbsp;&nbsp;<input type="button"  value="导出" onClick="javascript:document.getElementById('hide').src='admin.php?controller=admin_config&action=apppubexport&appserverip=<?php echo $this->_tpl_vars['appserverip']; ?>
';" class="an_02">
						</td>
					</tr>
			<tr>
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_config&action=apppub_list&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

				</td>
			</tr>
			</form>
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" id="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

