<?php /* Smarty version 2.6.18, created on 2014-06-28 03:33:51
         compiled from devpass_index.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有<?php echo $this->_tpl_vars['language']['select']; ?>
任何<?php echo $this->_tpl_vars['language']['User']; ?>
！");
		return false;
	}
</script>
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

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
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
<?php else: ?>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=resource_group">系统用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥上传</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autotemplate">巡检脚本</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_pro&action=dev_index&gid=<?php echo $this->_tpl_vars['gid']; ?>
&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
                <TBODY>		   		  <form name="member_list" action="admin.php?controller=admin_pro&action=devpass_index" method="post" >
		   
                  <TR>
                  <th class="list_bg"  width="3%"><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['HostName']; ?>
</TD>
                    <th class="list_bg" >IP</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['System']; ?>
</TD>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['System']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['Loginmode']; ?>
</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['Master']; ?>
账号</TD>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</TD>
                  </TR>

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
			<tr <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['radiususer_is_in_member']): ?>bgcolor='red'<?php endif; ?>>
			<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_type']; ?>
</td>
				<td><?php if (! $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']): ?>空<?php echo $this->_tpl_vars['language']['User']; ?>
<?php else: ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
<?php endif; ?><?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>(<a href='admin.php?controller=admin_pro&action=dev_checkpass&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'>查看</a>)<?php endif; ?></td>				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method']; ?>
</td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['master_user']): ?><?php echo $this->_tpl_vars['language']['Yes']; ?>
<?php else: ?><?php echo $this->_tpl_vars['language']['No']; ?>
<?php endif; ?></td>
				<td>
				<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 4): ?>
				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=pass_edit&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
'><?php echo $this->_tpl_vars['language']['Edit']; ?>
</a>

				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('<?php echo $this->_tpl_vars['language']['Delete_sure_']; ?>
？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=devpass_del&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&ip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
';}"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>
				<?php endif; ?>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			<tr>
	           <td  colspan="4" align="left">
				<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="<?php echo $this->_tpl_vars['language']['UsersDelete']; ?>
" onclick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_pro&action=devpass_del&from=dev_priority_search'; else return false;" class="an_06">&nbsp;&nbsp;<input type="button"  value="<?php echo $this->_tpl_vars['language']['Add']; ?>
<?php echo $this->_tpl_vars['language']['new']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
" onClick="location.href='admin.php?controller=admin_pro&action=pass_edit&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
'"  class="an_06">&nbsp;&nbsp;<input type="button"  value="批量添加用户" onClick="location.href='admin.php?controller=admin_pro&action=pass_batchedit&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
'" class="an_06">
		   </td>
              
	           <td  colspan="4" align="right">
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_index&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
&nbsp;&nbsp;&nbsp;<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>  导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a><?php endif; ?>&nbsp&nbsp;&nbsp;<input type="button"  value="导出该主机下的用户" onClick="location.href='<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3'" class="an_06">
		   </td>
		</tr>
		</form>
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


