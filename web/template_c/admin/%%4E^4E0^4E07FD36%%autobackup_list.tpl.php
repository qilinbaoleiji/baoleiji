<?php /* Smarty version 2.6.18, created on 2014-07-01 13:53:17
         compiled from autobackup_list.tpl */ ?>
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
<?php if ($_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=password_cron">定时任务</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting_forpassword">自动备份</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=passdown">密码文件下载</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordcheck">密码校验</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=logs_index">改密日志</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
<?php else: ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=resource_group">系统用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥上传</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_GET['type'] == 'run'): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php else: ?>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autotemplate">巡检脚本</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
</ul>
</div></td></tr>

  <tr><td><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_autorun&action=autobackup_delete&type=<?php echo $_GET['type']; ?>
"><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		
			<tr>
				<th class="list_bg"  width="3%">选</th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >名称</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器IP</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器名称</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['word']; ?>
账号</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=desc&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['word']; ?>
内容</a></th>
				<th class="list_bg"  width="5%"><a href="admin.php?controller=admin_assets&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=su&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >SUDO</a></th>
				<th class="list_bg"  width="5%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=interval&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >周期</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=<?php echo $_GET['type']; ?>
&orderby1=lastruntime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >上次<?php echo $this->_tpl_vars['word']; ?>
时间</a></th>
				<th class="list_bg"  width="">操作</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['alldev']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['desc']; ?>
</td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['su']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['period']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['lastruntime']; ?>
</td>
				<td style="TEXT-ALIGN: left;"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico2.gif" width="16" height="16" align="absmiddle"><a href="#" onclick="window.open('admin.php?controller=admin_autorun&action=viewfile&type=<?php echo $this->_tpl_vars['type']; ?>
&sid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&start_page=1');" target="hide">查看脚本</a> | <img src='./template/admin/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_autorun&action=autobackup_save&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&devicesid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['deviceid']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
'>修改</a> | 
				<img src='./template/admin/images/ico2.gif' width='16' height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_autorunlog&name=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['name']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
'>查看</a>
				</td>
			</tr>
			<?php endfor; endif; ?>
			
			<tr>
				<td  colspan="3" align="left">	<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value=" 删除 " onclick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.f1.action='admin.php?controller=admin_autorun&action=autobackup_delete'; else return false;" class="an_02">
				&nbsp;&nbsp;
				<input type="button" onclick="javascript:window.location='admin.php?controller=admin_autorun&action=autobackup_save&type=<?php echo $this->_tpl_vars['type']; ?>
'"  value=" 增加 "  class="an_02">
				
				</td>
			
				<td colspan="10" align="right">
					共<?php echo $this->_tpl_vars['command_num']; ?>
执行命令  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_session&action=dangerlist&page='+this.value;">页
				</td>
			</tr>
			</table>
			</form>
			<table  width="100%" >
			<tr><td  colspan="10" width="100%" align="center">
	<table id="f1table"  style="display:none"  border=0 width=100% cellpadding=1 cellspacing=1 bgcolor="#FFFFFF" class="BBtable" valign=top>

	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_autorun&action=autobackup_edit&type=<?php echo $this->_tpl_vars['type']; ?>
">
		<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['InputthedeviceIP']; ?>

		</td>
		<td width="67%">
			<input name="ip" type="text" class="wbk"><input type=submit class=btn1 value="<?php echo $this->_tpl_vars['language']['Input']; ?>
">
	  </td>
	</tr>

	<tr>
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['DeviceGroup']; ?>

		</td>
		<td width="67%">&nbsp;</td>
		
</tr>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['alldevgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr <?php if ($this->_sections['g']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td align=right>
			<input type="radio" name="controller" value="<?php echo $this->_tpl_vars['alldevgroup'][$this->_sections['g']['index']]['id']; ?>
" onClick="location.href='admin.php?controller=admin_autorun&action=autobackup_dev&g_id=<?php echo $this->_tpl_vars['alldevgroup'][$this->_sections['g']['index']]['id']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
'">
		</td>
		<td>
			<?php echo $this->_tpl_vars['alldevgroup'][$this->_sections['g']['index']]['groupname']; ?>

		</td>
		</tr>
		<?php endfor; endif; ?>
		</table>
	  </td>
	</tr>
	
<br>

</form>
</table>
<script type="text/javascript">
window.parent.menu.document.getElementById('devtree').style.display='none';
window.parent.menu.document.getElementById('ldaptree').style.display='none';
</script>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


