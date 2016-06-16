<?php /* Smarty version 2.6.18, created on 2014-07-03 00:09:09
         compiled from appdevice_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'addslashes', 'appdevice_edit.tpl', 41, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
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
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>
 <SCRIPT type=text/javascript>
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
var apppub = new Array();
<?php unset($this->_sections['ap']);
$this->_sections['ap']['name'] = 'ap';
$this->_sections['ap']['loop'] = is_array($_loop=$this->_tpl_vars['apppubs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ap']['show'] = true;
$this->_sections['ap']['max'] = $this->_sections['ap']['loop'];
$this->_sections['ap']['step'] = 1;
$this->_sections['ap']['start'] = $this->_sections['ap']['step'] > 0 ? 0 : $this->_sections['ap']['loop']-1;
if ($this->_sections['ap']['show']) {
    $this->_sections['ap']['total'] = $this->_sections['ap']['loop'];
    if ($this->_sections['ap']['total'] == 0)
        $this->_sections['ap']['show'] = false;
} else
    $this->_sections['ap']['total'] = 0;
if ($this->_sections['ap']['show']):

            for ($this->_sections['ap']['index'] = $this->_sections['ap']['start'], $this->_sections['ap']['iteration'] = 1;
                 $this->_sections['ap']['iteration'] <= $this->_sections['ap']['total'];
                 $this->_sections['ap']['index'] += $this->_sections['ap']['step'], $this->_sections['ap']['iteration']++):
$this->_sections['ap']['rownum'] = $this->_sections['ap']['iteration'];
$this->_sections['ap']['index_prev'] = $this->_sections['ap']['index'] - $this->_sections['ap']['step'];
$this->_sections['ap']['index_next'] = $this->_sections['ap']['index'] + $this->_sections['ap']['step'];
$this->_sections['ap']['first']      = ($this->_sections['ap']['iteration'] == 1);
$this->_sections['ap']['last']       = ($this->_sections['ap']['iteration'] == $this->_sections['ap']['total']);
?>
apppub[<?php echo $this->_sections['ap']['index']; ?>
] = new Array();
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['ip'] = '<?php echo $this->_tpl_vars['apppubs'][$this->_sections['ap']['index']]['ip']; ?>
';
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['apps']=new Array();
<?php unset($this->_sections['ap2']);
$this->_sections['ap2']['name'] = 'ap2';
$this->_sections['ap2']['loop'] = is_array($_loop=$this->_tpl_vars['apppubs'][$this->_sections['ap']['index']]['apps']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ap2']['show'] = true;
$this->_sections['ap2']['max'] = $this->_sections['ap2']['loop'];
$this->_sections['ap2']['step'] = 1;
$this->_sections['ap2']['start'] = $this->_sections['ap2']['step'] > 0 ? 0 : $this->_sections['ap2']['loop']-1;
if ($this->_sections['ap2']['show']) {
    $this->_sections['ap2']['total'] = $this->_sections['ap2']['loop'];
    if ($this->_sections['ap2']['total'] == 0)
        $this->_sections['ap2']['show'] = false;
} else
    $this->_sections['ap2']['total'] = 0;
if ($this->_sections['ap2']['show']):

            for ($this->_sections['ap2']['index'] = $this->_sections['ap2']['start'], $this->_sections['ap2']['iteration'] = 1;
                 $this->_sections['ap2']['iteration'] <= $this->_sections['ap2']['total'];
                 $this->_sections['ap2']['index'] += $this->_sections['ap2']['step'], $this->_sections['ap2']['iteration']++):
$this->_sections['ap2']['rownum'] = $this->_sections['ap2']['iteration'];
$this->_sections['ap2']['index_prev'] = $this->_sections['ap2']['index'] - $this->_sections['ap2']['step'];
$this->_sections['ap2']['index_next'] = $this->_sections['ap2']['index'] + $this->_sections['ap2']['step'];
$this->_sections['ap2']['first']      = ($this->_sections['ap2']['iteration'] == 1);
$this->_sections['ap2']['last']       = ($this->_sections['ap2']['iteration'] == $this->_sections['ap2']['total']);
?>
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['apps'][<?php echo $this->_sections['ap2']['index']; ?>
]=new Array();
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['apps'][<?php echo $this->_sections['ap2']['index']; ?>
]['id']='<?php echo $this->_tpl_vars['apppubs'][$this->_sections['ap']['index']]['apps'][$this->_sections['ap2']['index']]['id']; ?>
';
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['apps'][<?php echo $this->_sections['ap2']['index']; ?>
]['name']='<?php echo $this->_tpl_vars['apppubs'][$this->_sections['ap']['index']]['apps'][$this->_sections['ap2']['index']]['name']; ?>
';
apppub[<?php echo $this->_sections['ap']['index']; ?>
]['apps'][<?php echo $this->_sections['ap2']['index']; ?>
]['url']='<?php echo $this->_tpl_vars['apppubs'][$this->_sections['ap']['index']]['apps'][$this->_sections['ap2']['index']]['url']; ?>
';

<?php endfor; endif; ?>
<?php endfor; endif; ?>

</SCRIPT>
 <SCRIPT type=text/javascript>
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
var appprogram = new Array();
<?php unset($this->_sections['pp']);
$this->_sections['pp']['name'] = 'pp';
$this->_sections['pp']['loop'] = is_array($_loop=$this->_tpl_vars['appprogram']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pp']['show'] = true;
$this->_sections['pp']['max'] = $this->_sections['pp']['loop'];
$this->_sections['pp']['step'] = 1;
$this->_sections['pp']['start'] = $this->_sections['pp']['step'] > 0 ? 0 : $this->_sections['pp']['loop']-1;
if ($this->_sections['pp']['show']) {
    $this->_sections['pp']['total'] = $this->_sections['pp']['loop'];
    if ($this->_sections['pp']['total'] == 0)
        $this->_sections['pp']['show'] = false;
} else
    $this->_sections['pp']['total'] = 0;
if ($this->_sections['pp']['show']):

            for ($this->_sections['pp']['index'] = $this->_sections['pp']['start'], $this->_sections['pp']['iteration'] = 1;
                 $this->_sections['pp']['iteration'] <= $this->_sections['pp']['total'];
                 $this->_sections['pp']['index'] += $this->_sections['pp']['step'], $this->_sections['pp']['iteration']++):
$this->_sections['pp']['rownum'] = $this->_sections['pp']['iteration'];
$this->_sections['pp']['index_prev'] = $this->_sections['pp']['index'] - $this->_sections['pp']['step'];
$this->_sections['pp']['index_next'] = $this->_sections['pp']['index'] + $this->_sections['pp']['step'];
$this->_sections['pp']['first']      = ($this->_sections['pp']['iteration'] == 1);
$this->_sections['pp']['last']       = ($this->_sections['pp']['iteration'] == $this->_sections['pp']['total']);
?>
appprogram[<?php echo $this->_tpl_vars['appprogram'][$this->_sections['pp']['index']]['id']; ?>
]='<?php echo ((is_array($_tmp=$this->_tpl_vars['appprogram'][$this->_sections['pp']['index']]['path'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
';
<?php endfor; endif; ?>
function setappaddress(value){
	var name = document.getElementById('autologinflag').options[document.getElementById('autologinflag').options.selectedIndex].text.toLowerCase();
	document.getElementById('url').style.display='none';
	document.getElementById('troracle_auth').style.display='none';
	if(name=='ie'||name=='ie6'||name=='ie7'||name=='ie8'||name=='ie9'||name=='ie10'||name=='ie11'||appprogram[value].indexOf('iexplore.exe')>0){
		document.getElementById('url').style.display='';
	}else if(name=='toad' || name=='plsql'){
		document.getElementById('troracle_auth').style.display='';
	}
	document.getElementById('path').value=appprogram[value];
	document.getElementById('path').readonly=true;
}

var AllServers = new Array();
var i=0;
<?php unset($this->_sections['kk']);
$this->_sections['kk']['name'] = 'kk';
$this->_sections['kk']['loop'] = is_array($_loop=$this->_tpl_vars['servers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
AllServers[i++]='<?php echo $this->_tpl_vars['servers'][$this->_sections['kk']['index']]['device_ip']; ?>
';
<?php endfor; endif; ?>

function filter(){
	var filterStr = document.getElementById('filtertext').value;
	var appserver = document.getElementById('device_ip');
	appserver.options.length=1;
	for(var i=0; i<AllServers.length;i++){
		if(filterStr.length==0 || AllServers[i].indexOf(filterStr) >= 0){
			appserver.options[appserver.options.length++] = new Option(AllServers[i],AllServers[i]);
		}
	}
}
</SCRIPT>
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
</ul><span class="back_img"><A href="admin.php?controller=<?php if ($this->_tpl_vars['fromapp'] == 'search'): ?>admin_pro&action=app_priority_search<?php else: ?>admin_config&action=apppub_list&ip=<?php echo $this->_tpl_vars['appserverip']; ?>
<?php endif; ?>&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0" >
	
          <tr>
            <td align="center">
    <form name="f1" method=post action="admin.php?controller=admin_config&action=apppub_save&id=<?php echo $this->_tpl_vars['apppubid']; ?>
&appserverip=<?php echo $this->_tpl_vars['appserverip']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=0 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th colspan="3" class="list_bg"></th></tr>
		
	<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>应用名称</td>
		<td width="67%"><input type="text" name="name" value="<?php echo $this->_tpl_vars['pp']['name']; ?>
" /></td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>用户名</td>
		<td width="67%"><input type="text" name="username" value="<?php echo $this->_tpl_vars['p']['username']; ?>
" /></td>
	</tr>
	
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>密码</td>
		<td width="67%"><input type="password" name="password" value="<?php echo $this->_tpl_vars['p']['cur_password']; ?>
" /></td>
	  </tr>
	   <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>确认密码</td>
		<td width="67%"><input type="password" name="repassword" value="<?php echo $this->_tpl_vars['p']['cur_password']; ?>
" /></td>
	  </tr>
	 
	   <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	  <tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>服务器列表</td>
		<td width="67%">
		<input type="text" class="wbk" size="10" id="filtertext" onChange="filter();" />
                  <select  class="wbk"  name="device_ip" id="device_ip">
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['nobind']; ?>
</OPTION>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['servers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['servers'][$this->_sections['k']['index']]['device_ip']; ?>
" <?php if ($this->_tpl_vars['servers'][$this->_sections['k']['index']]['device_ip'] == $this->_tpl_vars['p']['device_ip']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['servers'][$this->_sections['k']['index']]['device_ip']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>
		</td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	  <tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>程序列表</td>
		<td width="67%">
			<select  class="wbk" id="autologinflag"  onchange="setappaddress(this.value)" name="autologinflag" >
			<option value="" >请选择</option>
			<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['appprogram']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['appprogram'][$this->_sections['p']['index']]['id']; ?>
" id="program_<?php echo $this->_tpl_vars['appprogram'][$this->_sections['p']['index']]['name']; ?>
" <?php if ($this->_tpl_vars['pp']['appprogramname'] == $this->_tpl_vars['appprogram'][$this->_sections['p']['index']]['name']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['appprogram'][$this->_sections['p']['index']]['name']; ?>
 </option>
			<?php endfor; endif; ?>
			</select>
		</td>
	  </tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="troracle_auth"  style="display:none">
		<td width="33%" align=right>ORACLE认证</td>
		<td width="67%">
			<select  class="wbk" id="oracle_auth"  name="oracle_auth" >
			<option value="Normal" <?php if ($this->_tpl_vars['p']['oracle_auth'] == 'Normal'): ?>selected<?php endif; ?>>Normal</option>
			<option value="SYSDBA" <?php if ($this->_tpl_vars['p']['oracle_auth'] == 'SYSDBA'): ?>selected<?php endif; ?>>SYSDBA</option>
			<option value="SYSOPER" <?php if ($this->_tpl_vars['p']['oracle_auth'] == 'SYSOPER'): ?>selected<?php endif; ?>>SYSOPER</option>
			</select>
		</td>
	  </tr>
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>程序地址</td>
		<td width="67%"><input type="text" size="100" id="path" name="path" value="<?php echo $this->_tpl_vars['pp']['path']; ?>
" /></td>
	  </tr>
	   <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="url" style="display:none">
		<td width="33%" align=right>URL</td>
		<td width="67%"><input type="text" size="100" name="url" value="<?php echo $this->_tpl_vars['pp']['url']; ?>
" /></td>
	  </tr>
	  <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>描述</td>
		<td width="67%"><textarea name="description" cols="50" rows="5"><?php echo $this->_tpl_vars['pp']['description']; ?>
</textarea></td>
	  </tr>
	   <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	  <tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>是否允许密码自动修改</td>
		<td width="67%"><input type="checkbox" name="change_password" value="1" <?php if ($this->_tpl_vars['p']['change_password']): ?>checked<?php endif; ?> /></td>
	</tr>
	  <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	  <tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>激活</td>
		<td width="67%"><input type="checkbox" name="enable" value="1" <?php if ($this->_tpl_vars['p']['enable']): ?>checked<?php endif; ?> /></td>
	</tr>
	  <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
	  <td width="33%" align="right"  valign=top>绑定分组</td>
	  <td >
	  <table><tr >
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
		<td width="150"><input type="checkbox" name='group[]' value='<?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['id']; ?>
'  <?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['check']; ?>
><?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['GroupName']; ?>
</td><?php if (( $this->_sections['u']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
	</tr></table>
	  </td>
	  </tr>
	 
<td></td><td></td></tr>
		 <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right  valign=top>
		绑定用户
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
		<td width="150"><input type="checkbox" name='member[]' value='<?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['uid']; ?>
'  <?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['check']; ?>
><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['username']; ?>
(<?php if ($this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']): ?><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']; ?>
<?php else: ?>未设置<?php endif; ?>)</td><?php if (( $this->_sections['g']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>
	  </td>
	  </tr>
	 
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
					<td></td><td><input type="hidden" name="ac" value="new" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['p']['id']; ?>
" />
<input type=submit  value="保存修改" class="an_02"></td></tr>
	</table>
<br>
<input type="hidden" name="sessionlgroup" value="<?php echo $this->_tpl_vars['sessionlgroup']; ?>
" />
<input type="hidden" name="sessionluser" value="<?php echo $this->_tpl_vars['sessionluser']; ?>
" />
</form>
	</td>
  </tr>
</table>
<script>
/*if(document.getElementById('program_IE').selected||(document.getElementById('program_IE6')!=undefined&&document.getElementById('program_IE6').selected)||(document.getElementById('program_IE7')!=undefined&&document.getElementById('program_IE7').selected)||(document.getElementById('program_IE8')!=undefined&&document.getElementById('program_IE8').selected)||(document.getElementById('program_IE9')!=undefined&&document.getElementById('program_IE9').selected)||(document.getElementById('program_IE10')!=undefined&&document.getElementById('program_IE10').selected)||(document.getElementById('program_IE11')!=undefined&&document.getElementById('program_IE11').selected)){
	document.getElementById('url').style.display='';
}*/
var appid = document.getElementById('autologinflag').options[document.getElementById('autologinflag').options.selectedIndex].value;
if(/^[0-9]+$/.test(appid)&&appprogram[appid].indexOf('iexplore.exe')>0){
	document.getElementById('url').style.display='';
}
if(document.getElementById('program_TOAD').selected || document.getElementById('program_PLSQL').selected){
	document.getElementById('troracle_auth').style.display='';
}
</script>
</body>

<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>