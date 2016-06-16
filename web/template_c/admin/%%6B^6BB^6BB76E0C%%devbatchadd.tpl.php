<?php /* Smarty version 2.6.18, created on 2014-07-03 20:27:18
         compiled from devbatchadd.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
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
<script type="text/javascript">
var foundparent = false;
var servergroup = new Array();
var i=0;
<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['allgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
servergroup[i++]={id:<?php echo $this->_tpl_vars['allgroup'][$this->_sections['a']['index']]['id']; ?>
,name:'<?php echo $this->_tpl_vars['allgroup'][$this->_sections['a']['index']]['groupname']; ?>
',ldapid:<?php echo $this->_tpl_vars['allgroup'][$this->_sections['a']['index']]['ldapid']; ?>
,level:<?php echo $this->_tpl_vars['allgroup'][$this->_sections['a']['index']]['level']; ?>
};
<?php endfor; endif; ?>

function changelevel(v, d, id){
	document.getElementById('ldapid2_'+id).options.length=0;
	<?php if ($this->_tpl_vars['logined_user_level'] == 1): ?>
	document.getElementById('ldapid2_'+id).options[document.getElementById('ldapid2_'+id).options.length]=new Option('无', 0);
	<?php endif; ?>
	var found = 0;
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==2){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('ldapid2_'+id).options[document.getElementById('ldapid2_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('ldapid2_'+id).options[document.getElementById('ldapid2_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}

	document.getElementById('servergroup_'+id).options.length=0;

	var found = 0;
	var class2_i = 0;
	var class2 = new Array();
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==0){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
		if(servergroup[i].ldapid==v && servergroup[i].level==2){
			class2[class2_i++]=i;
		}
	}
	for(var j=0; j<class2.length; j++){
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==servergroup[class2[j]].id&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}
	//changelevel2(found,0);
}

function changelevel2(v, d, id){
	document.getElementById('servergroup_'+id).options.length=0;
	if(v!=0){
		
		document.getElementById('servergroup_'+id).options.length=0;
		<?php if ($this->_tpl_vars['logined_user_level']): ?>
		document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option('无', 0);
		<?php endif; ?>
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup_'+id).options[document.getElementById('servergroup_'+id).options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}else{
		changelevel(document.getElementById('ldapid1_'+id).options[document.getElementById('ldapid1_'+id).options.selectedIndex].value, d,id);
	}
}
</script>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
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
</head>

<body>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="3%" align="center" bgcolor="#E0EDF8"><b>序列</b></th>
			<th class="list_bg"  width="18%" align="center" bgcolor="#E0EDF8"><b>服务器地址</b></th>
			<th class="list_bg"  width="18%" align="center" bgcolor="#E0EDF8"><b>主机名</b></th>
			<th class="list_bg"  width="30%" align="center" bgcolor="#E0EDF8"><b>设备组</b></th>
			<th class="list_bg"  width="5%" align="center" bgcolor="#E0EDF8"><b>系统类型</b></th>
		</tr>		
		<form name='route' action='admin.php?controller=admin_pro&action=batchdevsave' method='post'>
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
			<td class="td_line"><?php echo $this->_sections['t']['index']+1; ?>
</td>
			<td class="td_line"><input type="text" class="wbk" name="address[]" size="30" value="" /></td>
			<td class="td_line"><input type="text" class="wbk" name="hostname[]" size="30" value="" /></td>
			<td class="td_line">
			
			一级<select  class="wbk"  name="ldapid1[]" id="ldapid1_<?php echo $this->_sections['t']['index']; ?>
" onchange="changelevel(this.value,0, <?php echo $this->_sections['t']['index']; ?>
)">
			<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
				<OPTION VALUE="0">无</option>
			<?php endif; ?>
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
			<?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		二级<select  class="wbk"  name="ldapid2[]" id="ldapid2_<?php echo $this->_sections['t']['index']; ?>
" onchange="changelevel2(this.value,0, <?php echo $this->_sections['t']['index']; ?>
)">
		</select>
		设备组		<select  class="wbk"  name="g_id[]" id="servergroup_<?php echo $this->_sections['t']['index']; ?>
">
		<?php if ($this->_tpl_vars['logined_user_level']): ?>
				<option value="0" >无</option>
		<?php endif; ?>
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
		<?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['ldapid'] == 0): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
		<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
			
		</td>
			<td class="td_line">
				<select  class="wbk"  name="type_id[]">
				<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['alltype']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<OPTION VALUE="<?php echo $this->_tpl_vars['alltype'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['alltype'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['type_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['alltype'][$this->_sections['g']['index']]['device_type']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
			</td>
		</tr>
		
		<?php endfor; endif; ?>
		 <tr>
			<td colspan="9" align="center" ><input type='submit'  name="batch" value='确定' class="an_02"></td>
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
function change_group(obj){
	<?php if ($_SESSION['ADMIN_LEVEL'] == 3 && $_SESSION['ADMIN_MSERVERGROUP']): ?>
	for(var i=0; i<obj.options.length; i++){
		if(obj.options[i].value==<?php echo $_SESSION['ADMIN_MSERVERGROUP']; ?>
){
			obj.selectedIndex=i;
		}		
	}	
	<?php endif; ?>
}
<?php if ($this->_tpl_vars['sgroup']['id'] || $this->_tpl_vars['gid'] || $_SESSION['ADMIN_MSERVERGROUP']): ?>
for(var i=0; i<20; i++){
	changelevel(<?php echo $this->_tpl_vars['ldapid1']; ?>
, <?php echo $this->_tpl_vars['ldapid2']; ?>
, i);
	changelevel2(<?php echo $this->_tpl_vars['ldapid2']; ?>
, <?php echo $this->_tpl_vars['servergroup']; ?>
, i);
}
<?php endif; ?>
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


