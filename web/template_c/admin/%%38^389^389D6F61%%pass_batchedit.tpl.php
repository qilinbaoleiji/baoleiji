<?php /* Smarty version 2.6.18, created on 2014-06-28 03:38:15
         compiled from pass_batchedit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>
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
</ul><span class="back_img"><A href="javascript:history.back();"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="5%" align="center" bgcolor="#E0EDF8"><b>序列</b></th>
			<th class="list_bg"  width="9%" align="center" bgcolor="#E0EDF8"><b>用户名</b></th>
			<th class="list_bg"  width="9%" align="center" bgcolor="#E0EDF8"><b>密码</b></th>
			<th class="list_bg"  width="9%" align="center" bgcolor="#E0EDF8"><b>确认密码</b></th>
			<th class="list_bg"  width="9%" align="center" bgcolor="#E0EDF8"><b>登录方式</b></th>
			<th class="list_bg"  width="5%" align="center" bgcolor="#E0EDF8"><b>端口</b></th>
			<th class="list_bg"  align="center" bgcolor="#E0EDF8"><b>过期时间</b></th>
		</tr>		
		<form name='route' action='admin.php?controller=admin_pro&action=pass_batchsave&id=<?php echo $this->_tpl_vars['id']; ?>
&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
' method='post'>
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=20) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		
		<tr>
			<td width="3%" class="td_line"><?php echo $this->_sections['t']['index']+1; ?>
</td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="username[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" name="password[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" name="confirm_password[]" value="" /></td>
			<td width="10%" class="td_line"><select  class="wbk"  name="l_id[]" onchange="changeport(<?php echo $this->_sections['t']['index']+1; ?>
)">
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allmethod']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<OPTION id ="<?php echo $this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['login_method']; ?>
<?php echo $this->_sections['t']['index']+1; ?>
" VALUE="<?php echo $this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['l_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['login_method']; ?>
</option>
		<?php endfor; endif; ?>
		</select></td>
		<td><input type=text name="port[]" id="port<?php echo $this->_sections['t']['index']+1; ?>
" size=4 value="<?php if ($this->_tpl_vars['port']): ?><?php echo $this->_tpl_vars['port']; ?>
<?php else: ?><?php echo $this->_tpl_vars['sshport']; ?>
<?php endif; ?>" ></td>
		<td><INPUT value="<?php echo $this->_tpl_vars['limit_time']; ?>
" id="limit_time<?php echo $this->_sections['t']['index']+1; ?>
" name="limit_time[]"><IMG onClick="getDatePicker('limit_time<?php echo $this->_sections['t']['index']+1; ?>
', event)" src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/time.gif"> <?php echo $this->_tpl_vars['language']['clicktoselectdate']; ?>
<?php echo $this->_tpl_vars['language']['or']; ?>
<?php echo $this->_tpl_vars['language']['select']; ?>
 <?php echo $this->_tpl_vars['language']['AlwaysValid']; ?>
<INPUT <?php if ($this->_tpl_vars['nolimit'] == 1): ?> checked <?php endif; ?> type=checkbox name="nolimit[]">  </td>
		</tr>
		
		<?php endfor; endif; ?>
		 <tr>
			<td colspan="9" align="center" ><input type='submit'  name="batch" value='确定'  class="an_02"></td>
		  </tr>
		</form>

		</table>
	</td>
  </tr>

</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
function changeport(number) {
	var port = document.getElementById('port'+number);
	if(document.getElementById("ssh"+number).selected==true)  {	
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("telnet"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['telnetport']; ?>
;
	}
	if(document.getElementById("ftp"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['ftpport']; ?>
;
	}
	if(document.getElementById("sftp"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("RDP"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("vnc"+number).selected==true)  {
		port.value = 5901;
	}
	if(document.getElementById("Web"+number).selected==true)  {
		port.value = 3389;
	}
	if(document.getElementById("Oracle"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("Sybase"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("DB2"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("RDP2008"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("replay"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("rlogin"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("ssh1"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("apppub"+number).selected==true)  {
		port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


