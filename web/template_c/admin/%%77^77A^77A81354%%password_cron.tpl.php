<?php /* Smarty version 2.6.18, created on 2014-05-07 15:41:32
         compiled from password_cron.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >
var group = new Array();
<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
group[<?php echo $this->_sections['g']['index']; ?>
] = new Array();
group[<?php echo $this->_sections['g']['index']; ?>
]['name']='<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
'
group[<?php echo $this->_sections['g']['index']; ?>
]['id']='<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
'
<?php endfor; endif; ?>
var server = new Array();
<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['server']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
server[<?php echo $this->_sections['s']['index']; ?>
] = new Array();
server[<?php echo $this->_sections['s']['index']; ?>
]['device_ip']='<?php echo $this->_tpl_vars['server'][$this->_sections['s']['index']]['device_ip']; ?>
'
server[<?php echo $this->_sections['s']['index']; ?>
]['group']='<?php echo $this->_tpl_vars['server'][$this->_sections['s']['index']]['groupid']; ?>
'
<?php endfor; endif; ?>
var devices = new Array();
j=0;
<?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['devices']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
<?php if ($this->_tpl_vars['devices'][$this->_sections['d']['index']]['username']): ?>
devices[j] = new Array();
devices[j]['username']='<?php echo $this->_tpl_vars['devices'][$this->_sections['d']['index']]['username']; ?>
'
devices[j]['device_ip']='<?php echo $this->_tpl_vars['devices'][$this->_sections['d']['index']]['device_ip']; ?>
'
j++;
<?php endif; ?>
<?php endfor; endif; ?>
function changesg(selected_group){
	for(var j=0; j<group.length; j++){
		if(selected_group==group[j]['name']){
			selected_group=group[j]['id'];
			break;
		}
	}
	var iid=document.getElementById("server");
	iid.options.length=0;
	iid.options[iid.options.length] = new Option('所有设备','99999999');
	for(var i=0; i<server.length; i++){
		if(selected_group==server[i]['group']){
			iid.options[iid.options.length] = new Option(server[i]['device_ip'],server[i]['device_ip']);
		}else if(selected_group==1000){
			iid.options[iid.options.length] = new Option(server[i]['device_ip'],server[i]['device_ip']);
		}
	}
}

function changes(selected_server){
	var iid=document.getElementById("device");
	iid.options.length=0;
	iid.options[iid.options.length] = new Option('所有用户','99999999');
	for(var i=0; i<devices.length; i++){
		if(selected_server==devices[i]['device_ip']){
			iid.options[iid.options.length] = new Option(devices[i]['username'],devices[i]['username']);
		}
	}
}
</script>
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
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
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=password_cron">定时任务</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
<?php if ($_SESSION['ADMIN_LEVEL'] != 10 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_pro&action=password_cron">
	<tr><td>改密服务:</td>
		<td align=left>
		<input type="checkbox" class="wbk" name="chpwdservice" value="1" <?php if ($this->_tpl_vars['chpwdservice']): ?>checked<?php endif; ?> />
		</td>		
	</tr>
	<tr bgcolor="f7f7f7"><td>改密调度:</td>
		<td align=left>
		分钟:<select name="minute" >
		<option value="*" <?php if ($this->_tpl_vars['minute'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<option value="<?php echo $this->_sections['m']['index']; ?>
" <?php if ($this->_tpl_vars['minute'] != '*' && $this->_tpl_vars['minute'] == $this->_sections['m']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['m']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		小时:<select name="hour" >
		<option value="*" <?php if ($this->_tpl_vars['hour'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['h']);
$this->_sections['h']['name'] = 'h';
$this->_sections['h']['loop'] = is_array($_loop=24) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['h']['show'] = true;
$this->_sections['h']['max'] = $this->_sections['h']['loop'];
$this->_sections['h']['step'] = 1;
$this->_sections['h']['start'] = $this->_sections['h']['step'] > 0 ? 0 : $this->_sections['h']['loop']-1;
if ($this->_sections['h']['show']) {
    $this->_sections['h']['total'] = $this->_sections['h']['loop'];
    if ($this->_sections['h']['total'] == 0)
        $this->_sections['h']['show'] = false;
} else
    $this->_sections['h']['total'] = 0;
if ($this->_sections['h']['show']):

            for ($this->_sections['h']['index'] = $this->_sections['h']['start'], $this->_sections['h']['iteration'] = 1;
                 $this->_sections['h']['iteration'] <= $this->_sections['h']['total'];
                 $this->_sections['h']['index'] += $this->_sections['h']['step'], $this->_sections['h']['iteration']++):
$this->_sections['h']['rownum'] = $this->_sections['h']['iteration'];
$this->_sections['h']['index_prev'] = $this->_sections['h']['index'] - $this->_sections['h']['step'];
$this->_sections['h']['index_next'] = $this->_sections['h']['index'] + $this->_sections['h']['step'];
$this->_sections['h']['first']      = ($this->_sections['h']['iteration'] == 1);
$this->_sections['h']['last']       = ($this->_sections['h']['iteration'] == $this->_sections['h']['total']);
?>
		<option value="<?php echo $this->_sections['h']['index']; ?>
" <?php if ($this->_tpl_vars['hour'] != '*' && $this->_tpl_vars['hour'] == $this->_sections['h']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['h']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		天:<select name="day" >
		<option value="*" <?php if ($this->_tpl_vars['day'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
		<option value="<?php echo $this->_sections['d']['index']+1; ?>
" <?php if ($this->_tpl_vars['day'] != '*' && $this->_tpl_vars['day'] == $this->_sections['d']['index']+1): ?>selected<?php endif; ?>><?php echo $this->_sections['d']['index']+1; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		周:<select name="week" >
		<option value="*" <?php if ($this->_tpl_vars['week'] == '*'): ?>selected<?php endif; ?>>*</option>
		<option value="0" <?php if ($this->_tpl_vars['week'] == '0'): ?>selected<?php endif; ?>>日</option>
		<option value="1" <?php if ($this->_tpl_vars['week'] == '1'): ?>selected<?php endif; ?>>一</option>
		<option value="2" <?php if ($this->_tpl_vars['week'] == '2'): ?>selected<?php endif; ?>>二</option>
		<option value="3" <?php if ($this->_tpl_vars['week'] == '3'): ?>selected<?php endif; ?>>三</option>
		<option value="4" <?php if ($this->_tpl_vars['week'] == '4'): ?>selected<?php endif; ?>>四</option>
		<option value="5" <?php if ($this->_tpl_vars['week'] == '5'): ?>selected<?php endif; ?>>五</option>
		<option value="6" <?php if ($this->_tpl_vars['week'] == '6'): ?>selected<?php endif; ?>>六</option>
		</select>
		</td>		
	</tr>
	<tr><td>账号同步服务:</td>
		<td align=left>
		<input type="checkbox" class="wbk" name="accountservice" value="1" <?php if ($this->_tpl_vars['accountservice']): ?>checked<?php endif; ?> />
		</td>		
	</tr>
	<tr bgcolor="f7f7f7"><td>账号同步调度:</td>
		<td align=left>
		分钟:<select name="uminute" >
		<option value="*" <?php if ($this->_tpl_vars['uminute'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['um']);
$this->_sections['um']['name'] = 'um';
$this->_sections['um']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['um']['show'] = true;
$this->_sections['um']['max'] = $this->_sections['um']['loop'];
$this->_sections['um']['step'] = 1;
$this->_sections['um']['start'] = $this->_sections['um']['step'] > 0 ? 0 : $this->_sections['um']['loop']-1;
if ($this->_sections['um']['show']) {
    $this->_sections['um']['total'] = $this->_sections['um']['loop'];
    if ($this->_sections['um']['total'] == 0)
        $this->_sections['um']['show'] = false;
} else
    $this->_sections['um']['total'] = 0;
if ($this->_sections['um']['show']):

            for ($this->_sections['um']['index'] = $this->_sections['um']['start'], $this->_sections['um']['iteration'] = 1;
                 $this->_sections['um']['iteration'] <= $this->_sections['um']['total'];
                 $this->_sections['um']['index'] += $this->_sections['um']['step'], $this->_sections['um']['iteration']++):
$this->_sections['um']['rownum'] = $this->_sections['um']['iteration'];
$this->_sections['um']['index_prev'] = $this->_sections['um']['index'] - $this->_sections['um']['step'];
$this->_sections['um']['index_next'] = $this->_sections['um']['index'] + $this->_sections['um']['step'];
$this->_sections['um']['first']      = ($this->_sections['um']['iteration'] == 1);
$this->_sections['um']['last']       = ($this->_sections['um']['iteration'] == $this->_sections['um']['total']);
?>
		<option value="<?php echo $this->_sections['um']['index']; ?>
" <?php if ($this->_tpl_vars['uminute'] != '*' && $this->_tpl_vars['uminute'] == $this->_sections['um']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['um']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		小时:<select name="uhour" >
		<option value="*" <?php if ($this->_tpl_vars['uhour'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['uh']);
$this->_sections['uh']['name'] = 'uh';
$this->_sections['uh']['loop'] = is_array($_loop=24) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['uh']['show'] = true;
$this->_sections['uh']['max'] = $this->_sections['uh']['loop'];
$this->_sections['uh']['step'] = 1;
$this->_sections['uh']['start'] = $this->_sections['uh']['step'] > 0 ? 0 : $this->_sections['uh']['loop']-1;
if ($this->_sections['uh']['show']) {
    $this->_sections['uh']['total'] = $this->_sections['uh']['loop'];
    if ($this->_sections['uh']['total'] == 0)
        $this->_sections['uh']['show'] = false;
} else
    $this->_sections['uh']['total'] = 0;
if ($this->_sections['uh']['show']):

            for ($this->_sections['uh']['index'] = $this->_sections['uh']['start'], $this->_sections['uh']['iteration'] = 1;
                 $this->_sections['uh']['iteration'] <= $this->_sections['uh']['total'];
                 $this->_sections['uh']['index'] += $this->_sections['uh']['step'], $this->_sections['uh']['iteration']++):
$this->_sections['uh']['rownum'] = $this->_sections['uh']['iteration'];
$this->_sections['uh']['index_prev'] = $this->_sections['uh']['index'] - $this->_sections['uh']['step'];
$this->_sections['uh']['index_next'] = $this->_sections['uh']['index'] + $this->_sections['uh']['step'];
$this->_sections['uh']['first']      = ($this->_sections['uh']['iteration'] == 1);
$this->_sections['uh']['last']       = ($this->_sections['uh']['iteration'] == $this->_sections['uh']['total']);
?>
		<option value="<?php echo $this->_sections['uh']['index']; ?>
" <?php if ($this->_tpl_vars['uhour'] != '*' && $this->_tpl_vars['uhour'] == $this->_sections['uh']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['uh']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		天:<select name="uday" >
		<option value="*" <?php if ($this->_tpl_vars['uday'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['ud']);
$this->_sections['ud']['name'] = 'ud';
$this->_sections['ud']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ud']['show'] = true;
$this->_sections['ud']['max'] = $this->_sections['ud']['loop'];
$this->_sections['ud']['step'] = 1;
$this->_sections['ud']['start'] = $this->_sections['ud']['step'] > 0 ? 0 : $this->_sections['ud']['loop']-1;
if ($this->_sections['ud']['show']) {
    $this->_sections['ud']['total'] = $this->_sections['ud']['loop'];
    if ($this->_sections['ud']['total'] == 0)
        $this->_sections['ud']['show'] = false;
} else
    $this->_sections['ud']['total'] = 0;
if ($this->_sections['ud']['show']):

            for ($this->_sections['ud']['index'] = $this->_sections['ud']['start'], $this->_sections['ud']['iteration'] = 1;
                 $this->_sections['ud']['iteration'] <= $this->_sections['ud']['total'];
                 $this->_sections['ud']['index'] += $this->_sections['ud']['step'], $this->_sections['ud']['iteration']++):
$this->_sections['ud']['rownum'] = $this->_sections['ud']['iteration'];
$this->_sections['ud']['index_prev'] = $this->_sections['ud']['index'] - $this->_sections['ud']['step'];
$this->_sections['ud']['index_next'] = $this->_sections['ud']['index'] + $this->_sections['ud']['step'];
$this->_sections['ud']['first']      = ($this->_sections['ud']['iteration'] == 1);
$this->_sections['ud']['last']       = ($this->_sections['ud']['iteration'] == $this->_sections['ud']['total']);
?>
		<option value="<?php echo $this->_sections['ud']['index']+1; ?>
" <?php if ($this->_tpl_vars['uday'] != '*' && $this->_tpl_vars['uday'] == $this->_sections['ud']['index']+1): ?>selected<?php endif; ?>><?php echo $this->_sections['ud']['index']+1; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		周:<select name="uweek" >
		<option value="*" <?php if ($this->_tpl_vars['uweek'] == '*'): ?>selected<?php endif; ?>>*</option>
		<option value="0" <?php if ($this->_tpl_vars['uweek'] == '0'): ?>selected<?php endif; ?>>日</option>
		<option value="1" <?php if ($this->_tpl_vars['uweek'] == '1'): ?>selected<?php endif; ?>>一</option>
		<option value="2" <?php if ($this->_tpl_vars['uweek'] == '2'): ?>selected<?php endif; ?>>二</option>
		<option value="3" <?php if ($this->_tpl_vars['uweek'] == '3'): ?>selected<?php endif; ?>>三</option>
		<option value="4" <?php if ($this->_tpl_vars['uweek'] == '4'): ?>selected<?php endif; ?>>四</option>
		<option value="5" <?php if ($this->_tpl_vars['uweek'] == '5'): ?>selected<?php endif; ?>>五</option>
		<option value="6" <?php if ($this->_tpl_vars['uweek'] == '6'): ?>selected<?php endif; ?>>六</option>
		</select>
		</td>		
	</tr>
	<tr><td>立即上传服务:</td>
		<td align=left>
		<input type="checkbox" class="wbk" name="uploadservice" value="1" <?php if ($this->_tpl_vars['uploadservice']): ?>checked<?php endif; ?> />
		</td>		
	</tr>
	<tr bgcolor="f7f7f7"><td>立即上传调度:</td>
		<td align=left>
		分钟:<select name="pminute" >
		<option value="*" <?php if ($this->_tpl_vars['pminute'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['pm']);
$this->_sections['pm']['name'] = 'pm';
$this->_sections['pm']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pm']['show'] = true;
$this->_sections['pm']['max'] = $this->_sections['pm']['loop'];
$this->_sections['pm']['step'] = 1;
$this->_sections['pm']['start'] = $this->_sections['pm']['step'] > 0 ? 0 : $this->_sections['pm']['loop']-1;
if ($this->_sections['pm']['show']) {
    $this->_sections['pm']['total'] = $this->_sections['pm']['loop'];
    if ($this->_sections['pm']['total'] == 0)
        $this->_sections['pm']['show'] = false;
} else
    $this->_sections['pm']['total'] = 0;
if ($this->_sections['pm']['show']):

            for ($this->_sections['pm']['index'] = $this->_sections['pm']['start'], $this->_sections['pm']['iteration'] = 1;
                 $this->_sections['pm']['iteration'] <= $this->_sections['pm']['total'];
                 $this->_sections['pm']['index'] += $this->_sections['pm']['step'], $this->_sections['pm']['iteration']++):
$this->_sections['pm']['rownum'] = $this->_sections['pm']['iteration'];
$this->_sections['pm']['index_prev'] = $this->_sections['pm']['index'] - $this->_sections['pm']['step'];
$this->_sections['pm']['index_next'] = $this->_sections['pm']['index'] + $this->_sections['pm']['step'];
$this->_sections['pm']['first']      = ($this->_sections['pm']['iteration'] == 1);
$this->_sections['pm']['last']       = ($this->_sections['pm']['iteration'] == $this->_sections['pm']['total']);
?>
		<option value="<?php echo $this->_sections['pm']['index']; ?>
" <?php if ($this->_tpl_vars['pminute'] != '*' && $this->_tpl_vars['pminute'] == $this->_sections['pm']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['pm']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		小时:<select name="phour" >
		<option value="*" <?php if ($this->_tpl_vars['phour'] == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['ph']);
$this->_sections['ph']['name'] = 'ph';
$this->_sections['ph']['loop'] = is_array($_loop=24) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ph']['show'] = true;
$this->_sections['ph']['max'] = $this->_sections['ph']['loop'];
$this->_sections['ph']['step'] = 1;
$this->_sections['ph']['start'] = $this->_sections['ph']['step'] > 0 ? 0 : $this->_sections['ph']['loop']-1;
if ($this->_sections['ph']['show']) {
    $this->_sections['ph']['total'] = $this->_sections['ph']['loop'];
    if ($this->_sections['ph']['total'] == 0)
        $this->_sections['ph']['show'] = false;
} else
    $this->_sections['ph']['total'] = 0;
if ($this->_sections['ph']['show']):

            for ($this->_sections['ph']['index'] = $this->_sections['ph']['start'], $this->_sections['ph']['iteration'] = 1;
                 $this->_sections['ph']['iteration'] <= $this->_sections['ph']['total'];
                 $this->_sections['ph']['index'] += $this->_sections['ph']['step'], $this->_sections['ph']['iteration']++):
$this->_sections['ph']['rownum'] = $this->_sections['ph']['iteration'];
$this->_sections['ph']['index_prev'] = $this->_sections['ph']['index'] - $this->_sections['ph']['step'];
$this->_sections['ph']['index_next'] = $this->_sections['ph']['index'] + $this->_sections['ph']['step'];
$this->_sections['ph']['first']      = ($this->_sections['ph']['iteration'] == 1);
$this->_sections['ph']['last']       = ($this->_sections['ph']['iteration'] == $this->_sections['ph']['total']);
?>
		<option value="<?php echo $this->_sections['ph']['index']; ?>
" <?php if ($this->_tpl_vars['phour'] != '*' && $this->_tpl_vars['phour'] == $this->_sections['ph']['index']): ?>selected<?php endif; ?>><?php echo $this->_sections['ph']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		天:<select name="pday" >
		<option value="*" <?php if (pday == '*'): ?>selected<?php endif; ?>>*</option>
		<?php unset($this->_sections['pd']);
$this->_sections['pd']['name'] = 'pd';
$this->_sections['pd']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pd']['show'] = true;
$this->_sections['pd']['max'] = $this->_sections['pd']['loop'];
$this->_sections['pd']['step'] = 1;
$this->_sections['pd']['start'] = $this->_sections['pd']['step'] > 0 ? 0 : $this->_sections['pd']['loop']-1;
if ($this->_sections['pd']['show']) {
    $this->_sections['pd']['total'] = $this->_sections['pd']['loop'];
    if ($this->_sections['pd']['total'] == 0)
        $this->_sections['pd']['show'] = false;
} else
    $this->_sections['pd']['total'] = 0;
if ($this->_sections['pd']['show']):

            for ($this->_sections['pd']['index'] = $this->_sections['pd']['start'], $this->_sections['pd']['iteration'] = 1;
                 $this->_sections['pd']['iteration'] <= $this->_sections['pd']['total'];
                 $this->_sections['pd']['index'] += $this->_sections['pd']['step'], $this->_sections['pd']['iteration']++):
$this->_sections['pd']['rownum'] = $this->_sections['pd']['iteration'];
$this->_sections['pd']['index_prev'] = $this->_sections['pd']['index'] - $this->_sections['pd']['step'];
$this->_sections['pd']['index_next'] = $this->_sections['pd']['index'] + $this->_sections['pd']['step'];
$this->_sections['pd']['first']      = ($this->_sections['pd']['iteration'] == 1);
$this->_sections['pd']['last']       = ($this->_sections['pd']['iteration'] == $this->_sections['pd']['total']);
?>
		<option value="<?php echo $this->_sections['pd']['index']+1; ?>
" <?php if ($this->_tpl_vars['pday'] != '*' && $this->_tpl_vars['pday'] == $this->_sections['pd']['index']+1): ?>selected<?php endif; ?>><?php echo $this->_sections['pd']['index']+1; ?>
</option>
		<?php endfor; endif; ?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		周:<select name="pweek" >
		<option value="*" <?php if ($this->_tpl_vars['pweek'] == '*'): ?>selected<?php endif; ?>>*</option>
		<option value="0" <?php if ($this->_tpl_vars['pweek'] == '0'): ?>selected<?php endif; ?>>日</option>
		<option value="1" <?php if ($this->_tpl_vars['pweek'] == '1'): ?>selected<?php endif; ?>>一</option>
		<option value="2" <?php if ($this->_tpl_vars['pweek'] == '2'): ?>selected<?php endif; ?>>二</option>
		<option value="3" <?php if ($this->_tpl_vars['pweek'] == '3'): ?>selected<?php endif; ?>>三</option>
		<option value="4" <?php if ($this->_tpl_vars['pweek'] == '4'): ?>selected<?php endif; ?>>四</option>
		<option value="5" <?php if ($this->_tpl_vars['pweek'] == '5'): ?>selected<?php endif; ?>>五</option>
		<option value="6" <?php if ($this->_tpl_vars['pweek'] == '6'): ?>selected<?php endif; ?>>六</option>
		</select>
		</td>		
	</tr>
	<tr>
			<td colspan="2" align="center"><input type="submit"  value="保存修改" class="an_02">&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.location='admin.php?controller=admin_backup&action=runupload'" value="立即上传运行" class="an_06">&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.location='admin.php?controller=admin_backup&action=runchangepwd'" value="立即改密运行" class="an_06">&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.location='admin.php?controller=admin_backup&action=runtongbu'"  value="立即同步运行" class="an_06"></td>
		</tr>

	</table>
	<input type="hidden" name="ac" value="doit" />
</form>

		</table>
	</td>
  </tr>
</table>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");


</script>

<script language="javascript">
<!--
function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为主机名时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请录入正确掩码');
	return false;
   }
*/
   return true;

}//end check
// -->

function checkIP(ip)
{
	var ips = ip.split('.');
	if(ips.length==4 && ips[0]>=0 && ips[0]<256 && ips[1]>=0 && ips[1]<256 && ips[2]>=0 && ips[2]<256 && ips[3]>=0 && ips[3]<256)
		return ture;
	else
		return false;
}

function checknum(num)
{

	if( isDigit(num) && num > 0 && num < 65535)
		return ture;
	else
		return false;

}

function isDigit(s)
{
var patrn=/^[0-9]{1,20}$/;
if (!patrn.exec(s)) return false;
return true;
}
changesg(document.getElementById('group').options[document.getElementById('group').options.selectedIndex].value);
</script>
</body>
</html>


