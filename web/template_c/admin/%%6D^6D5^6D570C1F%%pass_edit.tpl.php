<?php /* Smarty version 2.6.18, created on 2014-06-28 03:36:31
         compiled from pass_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', 'pass_edit.tpl', 137, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function check_add_user(){
		return(true);
	}

var AllMember = new Array();
var i=0;
<?php unset($this->_sections['kk']);
$this->_sections['kk']['name'] = 'kk';
$this->_sections['kk']['loop'] = is_array($_loop=$this->_tpl_vars['allradiusmem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['kk']['show'] = true;
$this->_sections['kk']['max'] = $this->_sections['kk']['loop'];
$this->_sections['kk']['step'] = 1;
$this->_sections['kk']['start'] = $this->_sections['kk']['step'] > 0 ? 0 : $this->_sections['kk']['loop']-1;
if ($this->_sections['kk']['show']) {
    $this->_sections['kk']['total'] = $this->_sections['kk']['loop'];
    if ($this->_sections['kk']['total'] == 0)
        $this->_sections['kk']['show'] = false;
} else
    $this->_sections['kk']['total'] = 0;
if ($this->_sections['kk']['show']):

            for ($this->_sections['kk']['index'] = $this->_sections['kk']['start'], $this->_sections['kk']['iteration'] = 1;
                 $this->_sections['kk']['iteration'] <= $this->_sections['kk']['total'];
                 $this->_sections['kk']['index'] += $this->_sections['kk']['step'], $this->_sections['kk']['iteration']++):
$this->_sections['kk']['rownum'] = $this->_sections['kk']['iteration'];
$this->_sections['kk']['index_prev'] = $this->_sections['kk']['index'] - $this->_sections['kk']['step'];
$this->_sections['kk']['index_next'] = $this->_sections['kk']['index'] + $this->_sections['kk']['step'];
$this->_sections['kk']['first']      = ($this->_sections['kk']['iteration'] == 1);
$this->_sections['kk']['last']       = ($this->_sections['kk']['iteration'] == $this->_sections['kk']['total']);
?>
AllMember[<?php echo $this->_sections['kk']['index']; ?>
] = Array();
AllMember[<?php echo $this->_sections['kk']['index']; ?>
]['username']='<?php echo $this->_tpl_vars['allradiusmem'][$this->_sections['kk']['index']]['username']; ?>
';
AllMember[<?php echo $this->_sections['kk']['index']; ?>
]['uid']='<?php echo $this->_tpl_vars['allradiusmem'][$this->_sections['kk']['index']]['uid']; ?>
';
<?php endfor; endif; ?>

function filter(){
	var filterStr = document.getElementById('username').value;
	var usbkeyid = document.getElementById('memberselect');
	usbkeyid.options.length=1;
	for(var i=0; i<AllMember.length;i++){
		if(filterStr.length==0 || AllMember[i]['username'].indexOf(filterStr) >= 0){
			usbkeyid.options[usbkeyid.options.length++] = new Option(AllMember[i]['username'],AllMember[i]['uid']);
		}
	}
}
function change_for_user_auth(){
	<?php if ($this->_tpl_vars['radiususer']): ?>
	 document.getElementById('fort_user_auth').checked=true;
	 <?php endif; ?>
	var change_user_auth = document.getElementById('fort_user_auth').checked;
	if(change_user_auth){
		document.getElementById('username').readOnly  = true;
		document.getElementById('password_confirm').readOnly  = true;
		document.getElementById('password').readOnly  = true;
		<?php if (empty ( $this->_tpl_vars['id'] )): ?>document.getElementById('memberselect').style.display='';<?php endif; ?>		
	}else{
		document.getElementById('username').readOnly  = false;
		document.getElementById('password_confirm').readOnly  = false;
		document.getElementById('password').readOnly  = false;
		document.getElementById('memberselect').style.display='none';
	}
}

function usernameselect(){
	document.getElementById('username').value = (document.getElementById('memberselect').options.selectedIndex==0 ? document.getElementById('username').value : document.getElementById('memberselect').options[document.getElementById('memberselect').options.selectedIndex].text);
}

function temptyuser(check){
	if(check){
		document.getElementById('username').value='';
		//document.getElementById('password').value='';
		//document.getElementById('password_confirm').value='';
		document.getElementById('automp').checked=false;
		document.getElementById('automp2').checked=false;
		document.getElementById('publickey_auth').checked=false;
		document.getElementById('autotr').style.display='none';
		document.getElementById('publickey_authtr').style.display='none';
		document.getElementById('automutr').style.display='none';
	}else{
		document.getElementById('autotr').style.display='';
		document.getElementById('publickey_authtr').style.display='';
		document.getElementById('automutr').style.display='';
	}
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
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu" style="width:1100px;">
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
</ul><span class="back_img"><A href="admin.php?controller=admin_pro&action=<?php if ($this->_tpl_vars['fromdevpriority']): ?>dev_priority_search<?php else: ?>devpass_index&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
<?php endif; ?>&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center"><form name="f1" method=post action="admin.php?controller=admin_pro&action=pass_save&id=<?php echo $this->_tpl_vars['id']; ?>
&ip=<?php echo $this->_tpl_vars['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
" enctype="multipart/form-data">
	<table border=0 width=100% cellpadding=5 cellspacing=0 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th colspan="3" class="list_bg"></th></tr>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="usernametr">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Username']; ?>

		</td>
		<td width="67%">
		<input type=text name="username" id="username" size=35 value="<?php echo $this->_tpl_vars['username']; ?>
"  onchange="filter();" <?php if ($this->_tpl_vars['id']): ?>disabled<?php endif; ?>>&nbsp;&nbsp;
			<select  class="wbk"  id="memberselect" name="memberselect" style="display:none" onchange="usernameselect();">
				<OPTION value="">请选择</OPTION>
				<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['allradiusmem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['allradiusmem'][$this->_sections['k']['index']]['uid']; ?>
" <?php if ($this->_tpl_vars['allradiusmem'][$this->_sections['k']['index']]['uid'] == $this->_tpl_vars['radiususer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allradiusmem'][$this->_sections['k']['index']]['username']; ?>
</option>
				<?php endfor; endif; ?>
			</SELECT> &nbsp;&nbsp;<input type="checkbox" name="entrust_username" value="on" <?php if ($this->_tpl_vars['id']): ?> disabled="disabled"<?php endif; ?><?php if ($this->_tpl_vars['id'] && $this->_tpl_vars['entrust_username'] == 0): ?>checked<?php endif; ?> onclick="temptyuser(this.checked);">空用户
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="originalpasswordtr">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['originalpassword']; ?>

		</td>
		<td width="67%">
		<input type=password name="password" id="password" size=35 value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" >&nbsp;&nbsp;<span >RADIUS用户认证：<input type="checkbox" name="radiususer" id="fort_user_auth" <?php if ($this->_tpl_vars['radiususer']): ?> checked <?php endif; ?> value="on" onclick="change_for_user_auth();" /></span>
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>  id="originalpassword2tr">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Inputoriginalpasswordagain']; ?>

		</td>
		<td width="67%">
		<input type=password name="password_confirm" id="password_confirm" size=35 value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" >
	  </td>
	</tr>

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="loginmodetr">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Loginmode']; ?>
	
		</td>
		<td width="67%">
				<select  class="wbk"  name="l_id" onchange="changeport(1)">
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
" VALUE="<?php echo $this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['l_id']): ?>selected<?php endif; ?>><?php if ($this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['login_method'] == 'apppub'): ?>应用发布<?php else: ?><?php echo $this->_tpl_vars['allmethod'][$this->_sections['g']['index']]['login_method']; ?>
<?php endif; ?></option>
		<?php endfor; endif; ?>
		</select>
		<span id="sftp_tr">是否支持sftp传输:<INPUT id="sftp" <?php if ($this->_tpl_vars['sftp'] == 1): ?> checked <?php endif; ?> type=checkbox name=sftp value="on"> </span>
	  </td>
	</tr>

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>  id="porttr">
	  		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['port']; ?>
	
		</td>
		<td width="67%">
		<input type=text name="port" id="port" size=4 value="<?php if ($this->_tpl_vars['port']): ?><?php echo $this->_tpl_vars['port']; ?>
<?php else: ?><?php echo $this->_tpl_vars['sshport']; ?>
<?php endif; ?>" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="expiretr">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Expiretime']; ?>

		</td>
       <TD width="67%"><INPUT value="<?php echo $this->_tpl_vars['limit_time']; ?>
" id="limit_time" name="limit_time">
                      <IMG onClick="getDatePicker('limit_time', event)" 
                                src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/time.gif"> <?php echo $this->_tpl_vars['language']['clicktoselectdate']; ?>
<?php echo $this->_tpl_vars['language']['or']; ?>
<?php echo $this->_tpl_vars['language']['select']; ?>
 <?php echo $this->_tpl_vars['language']['AlwaysValid']; ?>
<INPUT <?php if ($this->_tpl_vars['nolimit'] == 1): ?> checked <?php endif; ?> type=checkbox name="nolimit">  
                                </TD>
	</tr>
    <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="loginmodetr">
		<td width="33%" align=right>
		用户终端
		</td>
		<td width="67%">
		<select  class="wbk"  name="encoding" >
			<OPTION VALUE="0" <?php if (! $this->_tpl_vars['encoding']): ?>selected<?php endif; ?>>默认</option>
			<OPTION VALUE="1" <?php if ($this->_tpl_vars['encoding']): ?>selected<?php endif; ?>>GB2312</option>
		</select>
		
	  </td>
	</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="loginmodetr">
		<td width="33%" align=right>
		命令授权用户
		</td>
		<td width="67%">
		<select  class="wbk"  name="commanduser" >
		<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['allmembers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
		<?php if ($this->_tpl_vars['allmembers'][$this->_sections['m']['index']]['username'] == 'admin'): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allmembers'][$this->_sections['m']['index']]['uid']; ?>
" <?php if ($this->_tpl_vars['allmembers'][$this->_sections['m']['index']]['uid'] == $this->_tpl_vars['commanduser']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allmembers'][$this->_sections['m']['index']]['username']; ?>
</option>
		<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="rdpmode">
		<td width="33%" align=right>
		RDP加密模式
		</td>
		<td width="67%">
		<select  class="wbk"  name="mode" >
			<OPTION VALUE="0" <?php if (! $this->_tpl_vars['mode']): ?>selected<?php endif; ?>>自动</option>
			<OPTION VALUE="1" <?php if ($this->_tpl_vars['mode'] == 1): ?>selected<?php endif; ?>>RDP加密</option>
			<OPTION VALUE="2" <?php if ($this->_tpl_vars['mode'] == 2): ?>selected<?php endif; ?>>SSL加密</option>
		</select>
		
	  </td>
	</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> >
		<TD width="33%" align=right>启用 </TD>
                  <TD width="67%"><INPUT id="enable" <?php if ($this->_tpl_vars['enable'] == 1): ?> checked <?php endif; ?> type=checkbox name=enable value="on">                  </TD>
                </TR>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="autotr">
		<TD width="33%" align=right><?php echo $this->_tpl_vars['language']['automaticallyeditpassword']; ?>
 </TD>
                  <TD width="67%"><INPUT id="automp" <?php if ($this->_tpl_vars['auto'] == 1): ?> checked <?php endif; ?> type=checkbox name=auto value="on">                  </TD>
                </TR>
	
          <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="automutr">
		<TD width="33%" align=right><?php echo $this->_tpl_vars['language']['masteraccountforeditingpassword']; ?>
 </TD>
                  <TD width="67%"><INPUT id="automp2" <?php if ($this->_tpl_vars['master_user'] == 1): ?> checked <?php endif; ?> type=checkbox name=automu value="on">                  </TD>
                </TR>    
           <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="entrust_passwordtr" >
		<TD width="33%" align=right>自动登录: </TD>
                  <TD width="67%"><INPUT id="entrust_password" <?php if ($this->_tpl_vars['entrust_password'] == 1): ?> checked <?php endif; ?> type=checkbox name=entrust_password value="on">                  </TD>
                </TR>    	
	 <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="logincommittr" >
		<TD width="33%" align=right>操作记录: </TD>
                  <TD width="67%"><INPUT id="logincommit" <?php if ($this->_tpl_vars['logincommit'] == 1): ?> checked <?php endif; ?> type=checkbox name=logincommit value="on">                  </TD>
                </TR>    
	 <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="publickey_authtr" >
		<TD width="33%" align=right>公钥私钥认证: </TD>
                  <TD width="67%"><INPUT id="publickey_auth" <?php if ($this->_tpl_vars['publickey_auth'] == 1): ?> checked <?php endif; ?> onclick="privatekey_set()" type=checkbox name=publickey_auth value="on">  
                </TR>    
     

         <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	  <td width="33%" align="right"  valign=top><?php echo $this->_tpl_vars['language']['bind']; ?>
<?php echo $this->_tpl_vars['language']['group']; ?>
</td>
	  <td >
	  <table>
	<tr>
	  <?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
		<td width="150"><input type="checkbox" name='Group<?php echo $this->_sections['u']['index']; ?>
' value='<?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['id']; ?>
'  <?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['check']; ?>
><a onclick="window.open ('admin.php?controller=admin_pro&action=passedit_selgroup&gid=<?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['id']; ?>
&sid=<?php echo $this->_tpl_vars['id']; ?>
&sessionlgroup=<?php echo $this->_tpl_vars['sessionlgroup']; ?>
', 'newwindow', 'height=410, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;"  href="#" target="_blank" ><?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['GroupName']; ?>
</a></td><?php if (( $this->_sections['u']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
	</tr></table>
	  </td>
	  </tr>
	  <tr><td></td><td></td></tr>
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right  valign=top>
		<?php echo $this->_tpl_vars['language']['bind']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>

		</td>
		<td width="67%">
		<table><tr >
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allmem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td width="150"><input type="checkbox" name='Check<?php echo $this->_sections['g']['index']; ?>
' value='<?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['uid']; ?>
'  <?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['check']; ?>
><a onclick="window.open ('admin.php?controller=admin_pro&action=passedit_seluser&uid=<?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['uid']; ?>
&sid=<?php echo $this->_tpl_vars['id']; ?>
&sessionluser=<?php echo $this->_tpl_vars['sessionluser']; ?>
', 'newwindow', 'height=410, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;" href="#" target="_blank" ><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['username']; ?>
(<?php if ($this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']): ?><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']; ?>
<?php else: ?>未设置<?php endif; ?>)</a></td><?php if (( $this->_sections['g']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>
	  </td>
	  </tr>
	 
	<tr><td></td><td><input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input type=button  value="检测" onclick="test_port();" class="an_02"></td></tr></table>
<input type="hidden" name="logtab" value="<?php echo $this->_tpl_vars['logtab']['id']; ?>
" />
<input type="hidden" name="sessionlgroup" value="<?php echo $this->_tpl_vars['sessionlgroup']; ?>
" />
<input type="hidden" name="sessionluser" value="<?php echo $this->_tpl_vars['sessionluser']; ?>
" />
</form>
	</td>
  </tr>
  <tr><td colspan="2" height="25"></td></tr>
</table>
 <SCRIPT type=text/javascript>
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
function test_port(){
	var port = document.getElementById('port').value;
	if(!/[0-9]+/.test(port)){
		alert('端口请输入数字');
		return ;
	}
	document.getElementById('hide').src='admin.php?controller=admin_pro&action=test_port&ip=<?php echo $this->_tpl_vars['ip']; ?>
&port='+port;
	//alert(document.getElementById('hide').src);
}
function changeport(cp) {
	if(document.getElementById("ssh").selected==true)  {	
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='';
		document.getElementById("sftp_tr").style.display='';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("telnet").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['telnetport']; ?>
;
	}
	if(document.getElementById("ftp").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='none';
		document.getElementById("automutr").style.display='none';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['ftpport']; ?>
;
	}
	if(document.getElementById("sftp").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='none';
		document.getElementById("automutr").style.display='none';
		document.getElementById("entrust_password").style.display='block';
		document.getElementById("publickey_authtr").style.display='block';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("RDP").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("rdpmode").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("vnc").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['vncport']; ?>
;
	}
	if(document.getElementById("X11").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['x11port']; ?>
;
	}
	if(document.getElementById("rlogin").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';//alert(document.getElementById("sftp_tr").style.display);
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("ssh1").selected==true)  {
		//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='block';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("apppub").selected==true)  {
		//appset('none');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("Web").selected==true)  {
		//appset('');
		
		document.getElementById("webmethod1").style.display='';
		document.getElementById("webmethod2").style.display='';
		document.getElementById("webmethod3").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = 3389;
	}
	if(document.getElementById("Oracle").selected==true)  {
		appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("Sybase").selected==true)  {
	document.getElementById("publickey_authtr").style.display='none';
	document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
	//appset('');
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("DB2").selected==true)  {;
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['sshport']; ?>
;
	}
	if(document.getElementById("RDP2008").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	if(document.getElementById("replay").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
	}
	
	
}
function appset(enable){
	document.getElementById("usernametr").style.display=enable;
	document.getElementById("originalpasswordtr").style.display=enable;
	document.getElementById("originalpassword2tr").style.display=enable;
	document.getElementById("porttr").style.display=enable;
	document.getElementById("expiretr").style.display=enable;
	document.getElementById("autotr").style.display=enable;
	document.getElementById("automutr").style.display=enable;
	document.getElementById("entrust_passwordtr").style.display=enable;
}

<?php if (! $this->_tpl_vars['id']): ?>
<?php if ($this->_tpl_vars['devicetype'] == 'windows' || $this->_tpl_vars['devicetype'] == 'Win2008' || $this->_tpl_vars['devicetype'] == 'Windows 2008'): ?>
document.getElementById("RDP").selected=true;
f1.port.value = <?php echo $this->_tpl_vars['rdpport']; ?>
;
<?php elseif ($this->_tpl_vars['devicetype'] == 'linux'): ?>
document.getElementById("ssh").selected=true;
<?php elseif ($this->_tpl_vars['devicetype'] == 'unix'): ?>
document.getElementById("telnet").selected=true;
<?php endif; ?>
<?php else: ?>
if(document.getElementById("ssh").selected==true)
document.getElementById("sftp_tr").style.display='';
<?php endif; ?>

function privatekey_set(){
}

<?php if ($this->_tpl_vars['entrust_username'] == 0 && $this->_tpl_vars['id']): ?>
temptyuser(true);
<?php endif; ?>
change_for_user_auth();
usernameselect();
changeport(0);
</SCRIPT>
</body>
<iframe name="hide" id="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


