<?php /* Smarty version 2.6.18, created on 2014-07-03 19:40:48
         compiled from dev_edit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
</head>

<body>
<script>
var foundparent = false;
var servergroup = new Array();
var i=0;
<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['allsgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
servergroup[i++]={id:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['id']; ?>
,name:'<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['groupname']; ?>
',ldapid:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['ldapid']; ?>
,level:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['level']; ?>
};
<?php endfor; endif; ?>

function changelevel(v, d){
	document.getElementById('ldapid2').options.length=0;
	document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option('无', 0);
	var found = 0;
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==2){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}
	
	document.getElementById('servergroup').options.length=0;
	document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option('无', 0);
	var found = 0;
	var class2_i = 0;
	var class2 = new Array();
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==0){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
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
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}
	//changelevel2(found,0);
}

function changelevel2(v, d){
	document.getElementById('servergroup').options.length=0;
	document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option('无', 0);
	if(v!=0){
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}else{
		changelevel(document.getElementById('ldapid1').options[document.getElementById('ldapid1').options.selectedIndex].value, d);
	}
}

function change_option(number,index){
 for (var i = 0; i <= number; i++) {
      document.getElementById('current' + i).className = '';
      document.getElementById('content' + i).style.display = 'none';
 }
  document.getElementById('current' + index).className = 'current';
  document.getElementById('content' + index).style.display = 'block';
  if(index==1 || index==2 || index==3){
	document.getElementById('finalsubmit').style.display = 'block';
  }else{
	document.getElementById('finalsubmit').style.display = 'none';
  }
  return false;
}
</script>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
</ul><span class="back_img"><A href="admin.php?controller=<?php if ($_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 101): ?>admin_index&action=main<?php else: ?><?php if ($_GET['appconfigedit']): ?>admin_pro&action=dev_edit&id=<?php echo $this->_tpl_vars['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
&apptable=1<?php else: ?>admin_pro&action=dev_index&gid=<?php echo $this->_tpl_vars['gid']; ?>
<?php endif; ?><?php endif; ?>&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>

   
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_pro&action=dev_save&id=<?php echo $this->_tpl_vars['id']; ?>
&appconfigedit=<?php echo $this->_tpl_vars['appconfigedit']; ?>
&appconfigid=<?php echo $this->_tpl_vars['appconfigid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
">
			 <DIV style="WIDTH:100%" id=navbar>
 <?php if (! $this->_tpl_vars['appconfigedit']): ?>
				 <div id="content1" class="content">
				   <div class="contentMain">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<TR>
      <TD height="27" colspan="4" class="tb_t_bg">基本信息</TD>
    </TR>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		服务器地址		
		</td>
		<td width="35%">
		<input type=text name="IP" size=35 value="<?php echo $this->_tpl_vars['IP']; ?>
" <?php if ($this->_tpl_vars['id']): ?>readonly<?php endif; ?>>&nbsp;&nbsp;&nbsp;ipv6<input type=checkbox name="ipv6" value="1" <?php if ($this->_tpl_vars['ipv6']): ?>checked<?php endif; ?> <?php if ($this->_tpl_vars['id']): ?>readonly<?php endif; ?>>
	  </td>
	  <td width="15%" align=right>
		设备组	
		</td>
		<td width="35%">
		一级<select  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevel(this.value,0)">
		<OPTION VALUE="0">无</option>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allsgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		二级<select  class="wbk"  name="ldapid2" id="ldapid2" onchange="changelevel2(this.value,0)">
		</select>
		设备组		<select  class="wbk"  name="g_id" id="servergroup">
				<option value="0" >无</option>
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
		<?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['level'] == 0): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['g_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
		<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
	  <td width="15%" align=right>
		主机名	
		</td>
		<td width="35%">
		<input type=text name="hostname" size=35 value="<?php echo $this->_tpl_vars['hostname']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		系统类型	
		</td>
		<td width="35%">
				<select  class="wbk"  name="type_id">
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

	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		超级管理员口令:	
		</td>
		<td width="35%">
				<input type="password" size=35 name="superpassword" value="<?php echo $this->_tpl_vars['superpassword']; ?>
"/>
	  </td>
	  <td width="15%" align=right>
		再输一次口令:	
		</td>
		<td width="35%">
				<input type="password" size=35 name="superpassword2" value="<?php echo $this->_tpl_vars['superpassword']; ?>
"/>
	  </td>

	</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		修改方式	
		</td>
		<td width="35%">
		<input type='radio' name="stra_type" value='mon' <?php if ($this->_tpl_vars['method'] == 'mon' || $this->_tpl_vars['method'] == ''): ?>checked<?php endif; ?>>
		按月
		<input type='radio' name="stra_type" value='week' <?php if ($this->_tpl_vars['method'] == 'week'): ?>checked<?php endif; ?>>
		每周
		<input type='radio' name="stra_type" value='custom'<?php if ($this->_tpl_vars['method'] == 'user'): ?>checked<?php endif; ?>>
		自定义
	  </td>
	  <td width="15%" align=right>
		频率
		</td>
		<td width="35%">
		<input type=text name="freq" size=35 value="<?php if ($this->_tpl_vars['freq']): ?><?php echo $this->_tpl_vars['freq']; ?>
<?php else: ?>1<?php endif; ?>" >**
		</td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td colspan='4'>
		**频率的说明：如果修改方式选择每周，这里填写周几（1—7）,如果是按月，填写几号（1—31）,如果是自定义，这里是几日更新一次（大于0的整数）
		</td>
	</tr>
	
<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 21 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		SSH默认端口	
		</td>
		<td width="35%">
		<input type=text name="sshport" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['sshport']; ?>
<?php else: ?>22<?php endif; ?>" >
	  </td>
	  <td width="15%" align=right>
		TELNET默认端口	
		</td>
		<td width="35%">
		<input type=text name="telnetport" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['telnetport']; ?>
<?php else: ?>23<?php endif; ?>" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		FTP默认端口
		</td>
		<td width="35%">
		<input type=text name="ftpport" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['ftpport']; ?>
<?php else: ?>21<?php endif; ?>" >
	  </td>
	  <td width="15%" align=right>
		RDP默认端口
		</td>
		<td width="35%">
		<input type=text name="rdpport" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['rdpport']; ?>
<?php else: ?>3389<?php endif; ?>" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		VNC默认端口	
		</td>
		<td width="35%">
		<input type=text name="vncport" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['vncport']; ?>
<?php else: ?>5900<?php endif; ?>" >
	  </td>
	  <td width="15%" align=right>
		X11默认端口	
		</td>
		<td width="35%">
		<input type=text name="x11port" size=35 value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['x11port']; ?>
<?php else: ?>3389<?php endif; ?>" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		Oracle实例	
		</td>
		<td width="35%">
		<input type=text name="oracle_name" size=35 value="<?php echo $this->_tpl_vars['oracle_name']; ?>
" >
	  </td>
	</tr>
<?php else: ?>
<input type="hidden" name="transport" value="<?php echo $this->_tpl_vars['transport']; ?>
" >
<input type="hidden" name="sshport" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['sshport']; ?>
<?php else: ?>22<?php endif; ?>" >
<input type="hidden" name="telnetport" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['telnetport']; ?>
<?php else: ?>23<?php endif; ?>" >
<input type="hidden" name="ftpport" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['ftpport']; ?>
<?php else: ?>21<?php endif; ?>" >
<input type="hidden" name="rdpport" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['rdpport']; ?>
<?php else: ?>3389<?php endif; ?>" >
<input type="hidden" name="vncport" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['vncport']; ?>
<?php else: ?>3389<?php endif; ?>" >
<input type="hidden" name="x11port" value="<?php if ($this->_tpl_vars['id']): ?><?php echo $this->_tpl_vars['x11port']; ?>
<?php else: ?>3389<?php endif; ?>" >
	<?php endif; ?>
	</table> </div>
				 </div>
				 <div id="content2" class="content" >
				   <div class="contentMain">
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				   <TR>
      <TD height="27" colspan="4" class="tb_t_bg">扩展信息</TD>
    </TR>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		固定资产名称	
		</td>
		<td width="35%">
		<input type=text name="asset_name" size=35 value="<?php echo $this->_tpl_vars['asset_name']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		规格型号	
		</td>
		<td width="35%">
		<input type=text name="asset_specification" size=35 value="<?php echo $this->_tpl_vars['asset_specification']; ?>
" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		部门名称	
		</td>
		<td width="35%">
		<input type=text name="asset_department" size=35 value="<?php echo $this->_tpl_vars['asset_department']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		存放地点	
		</td>
		<td width="35%">
		<input type=text name="asset_location" size=35 value="<?php echo $this->_tpl_vars['asset_location']; ?>
" >
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		支持厂商	
		</td>
		<td width="35%">
		<input type=text name="asset_company" size=35 value="<?php echo $this->_tpl_vars['asset_company']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		开始使用日期	
		</td>
		<td width="35%">
		<input type=text name="asset_start" id="asset_start" size=35 value="<?php echo $this->_tpl_vars['asset_start']; ?>
" >&nbsp;&nbsp;<input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk"> 

	  </td>
	</tr>	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		使用年限	
		</td>
		<td width="35%">
		<input type=text name="asset_usedtime" size=35 value="<?php echo $this->_tpl_vars['asset_usedtime']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		保修日期	
		</td>
		<td width="35%">
		<input type=text name="asset_warrantdate" id="asset_warrantdate" size=35 value="<?php echo $this->_tpl_vars['asset_warrantdate']; ?>
" >&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk"> 
	  </td>
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="15%" align=right>
		使用状况	
		</td>
		<td width="35%">
		<input type=text name="asset_status" size=35 value="<?php echo $this->_tpl_vars['asset_status']; ?>
" >
	  </td>
	  <td width="15%" align=right>
		</td>
		<td width="35%">
	  </td>
	</tr>
</table>
 </div>
</div>
<?php if ($this->_tpl_vars['caction']): ?>
 <div id="content3" class="content" >
				   <div class="contentMain">
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				   <TR>
      <TD height="27" colspan="4" class="tb_t_bg">系统监控</TD>
    </TR>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
		<td width="15%" align=right>
		巡检模式	
		</td>
		
		<td width="35%">
		<select  class="wbk"  name="monitor">		
			<OPTION VALUE="0" <?php if ($this->_tpl_vars['monitor'] == 0): ?>selected<?php endif; ?>>关闭</option>
			<OPTION VALUE="1" <?php if ($this->_tpl_vars['monitor'] == 1): ?>selected<?php endif; ?>>SNMP</option>
			<OPTION VALUE="2" <?php if ($this->_tpl_vars['monitor'] == 2): ?>selected<?php endif; ?>>登录</option>
		<OPTION VALUE="3" <?php if ($this->_tpl_vars['monitor'] == 3): ?>selected<?php endif; ?>>上传</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;端口监控:<input type=checkbox name="snmpnet" <?php if ($this->_tpl_vars['snmpnet']): ?>checked<?php endif; ?> size=35 value="1" >
		</td>
		<td width="15%" align=right>
		SNMP字符串	
		</td>
		
	<td width="35%">
		<input type=text name="snmpkey" size=35 value="<?php echo $this->_tpl_vars['snmpkey']; ?>
" >
	  </td>
		</tr>
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		监控端口	
		</td>
		
	<td width="35%">
		<input type=text name="port_monitor" size=35 value="<?php echo $this->_tpl_vars['port_monitor']; ?>
" >
	  </td>	
	  <td width="15%" align=right>
		端口监控阀值	
		</td>
		
	<td width="35%">
		<input type=text name="port_monitor_time" size=35 value="<?php echo $this->_tpl_vars['port_monitor_time']; ?>
" >
	  </td>
</table>
 </div>
				 </div>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['caction']): ?>
		<?php if (! $this->_tpl_vars['appconfigedit']): ?>
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<TR>
				<TD height="27" colspan="8" class="tb_t_bg"><img src="template/admin/cssjs/img/nolines_plus.gif" onclick="opentable('apptable');" id="apptable_img" align="middle" />应用监控</TD>
			</TR>
		</table>
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable" id="apptable">
				  <tr>
                    <th class="list_bg" >服务器地址</th>
                    <th class="list_bg" >应用名称</th>					
                    <th class="list_bg" >主被动</th>
                    <th class="list_bg" >URL</th>
                    <th class="list_bg" >用户名</th>
                    <th class="list_bg" >密码</th>
					<th class="list_bg" >是否监控</th>
					<th class="list_bg" >操作</TD>
                  </TR>

            </tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['appconfig']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><span  title="<?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['app_name']; ?>
" ><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['app_name']; ?>
</span></td>				
				<td><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['app_get']; ?>
</td>
				<td><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['url']; ?>
</td>
				<td><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['username']; ?>
</td>
				<td><?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['password']; ?>
</td>
				<td><?php if ($this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['monitor'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=dev_edit&id=<?php echo $this->_tpl_vars['id']; ?>
&tab=4&appconfigedit=1&appconfigid=<?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['seq']; ?>
'>修改</a> | <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=app_config_del&id=<?php echo $this->_tpl_vars['appconfig'][$this->_sections['t']['index']]['seq']; ?>
&devid=<?php echo $this->_tpl_vars['id']; ?>
';}">删除</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr >
				<td colspan="8" > <input type="button" value="添加" onClick="location.href='admin.php?controller=admin_pro&action=dev_edit&id=<?php echo $this->_tpl_vars['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
&tab=4&appconfigedit=1'" class="an_02"></td>
			</tr>
		</table>
		<?php else: ?>
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				     <TR>
      <TD height="27" colspan="8" class="tb_t_bg">应用监控</TD>
    </TR>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
		<td width="15%" align=right>
		应用名称	
		</td>
		
		<td width="35%">
		<select  class="wbk"  name="app_name" onchange="changeapp(this.value);">		
			<OPTION VALUE="mysql" <?php if ($this->_tpl_vars['appconfig1']['app_name'] == 'mysql'): ?>selected<?php endif; ?>>mysql</option>
			<OPTION VALUE="apache" <?php if ($this->_tpl_vars['appconfig1']['app_name'] == 'apache'): ?>selected<?php endif; ?>>apache</option>
</select>
		</td></tr>
	
	
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
	<td width="15%" align=right>
		主动被动	
		</td>
		
	<td width="35%">
	<select  class="wbk"  name="app_get" >		
			<OPTION VALUE="0" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == '0'): ?>selected<?php endif; ?>>主动</option>
			<OPTION VALUE="1" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == '1'): ?>selected<?php endif; ?>>被动</option>
</select>
	  </td>
	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	
	<tr id="apache_type" <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">
	<select  class="wbk"  name="apache_type">		
			<OPTION VALUE="cpu" <?php if ($this->_tpl_vars['appconfig1']['app_type'] == 'cpu'): ?>selected<?php endif; ?>>系统占用</option>
			<OPTION VALUE="request rate" <?php if ($this->_tpl_vars['appconfig1']['app_type'] == 'request rate'): ?>selected<?php endif; ?>>请求速率</option>
			<OPTION VALUE="traffic rate" <?php if ($this->_tpl_vars['appconfig1']['app_type'] == 'traffic rate'): ?>selected<?php endif; ?>>流量</option>
</select>
	  </td>
	
	</tr>
	<tr id="mysql_type" <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">
	<select  class="wbk"  name="mysql_type">		
			<OPTION VALUE="questions rate" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == 'questions rate'): ?>selected<?php endif; ?>>查询速率</option>
			<OPTION VALUE="open tables" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == 'open tables'): ?>selected<?php endif; ?>>打开表数</option>
			<OPTION VALUE="opens" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == 'opens'): ?>selected<?php endif; ?>>打开文件</option>
			<OPTION VALUE="threads" <?php if ($this->_tpl_vars['appconfig1']['app_get'] == 'threads'): ?>selected<?php endif; ?>>连接数</option>
</select>
	  </td>
	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		URL	
		</td>
		
	<td width="35%">
		<input type=text name="url" size=35 value="<?php echo $this->_tpl_vars['appconfig1']['url']; ?>
" >
	  </td>	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		用户名	
		</td>
		
	<td width="35%">
		<input type=text name="username" size=35 value="<?php echo $this->_tpl_vars['appconfig1']['username']; ?>
" >
	  </td>	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		密码	
		</td>
		
	<td width="35%">
		<input type=text name="password" size=35 value="<?php echo $this->_tpl_vars['appconfig1']['password']; ?>
" >
	  </td>
	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		端口	
		</td>
		
	<td width="35%">
		<input type=text name="port" size=35 value="<?php echo $this->_tpl_vars['appconfig1']['port']; ?>
" >
	  </td>
	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td width="15%" align=right>
		是否启用
		</td>
		
	<td width="35%">
		<input type=checkbox name="enable" value="1" <?php if ($this->_tpl_vars['appconfig1']['enable']): ?>checked<?php endif; ?> >
	  </td>
	
	</tr>
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>	
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>		
	<td colspan="2" align=center>
		
		<input type=submit  value="保存修改" class="an_02">
	  </td>
	
	</tr>

</table>
<input type="hidden" name="doappconfigedit" value="1" />
<script>
function changeapp(name){
	document.getElementById('apache_type').style.display='none';
	document.getElementById('mysql_type').style.display='none';
	document.getElementById(name+'_type').style.display='';
}

changeapp(<?php if ($this->_tpl_vars['appconfig1']['app_type'] == 'apache'): ?>'apache'<?php else: ?>'mysql'<?php endif; ?>);
</script>
<?php endif; ?><?php endif; ?>
 <?php if (! $this->_tpl_vars['appconfigedit']): ?>
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
				  <TR>
					  <TD height="27" colspan="8" class="tb_t_bg"><img src="template/admin/cssjs/img/nolines_plus.gif" onclick="opentable('accounttable');" id="accounttable_img" align="middle" />账号信息</TD>
				  </TR>
				  </table>
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable" id="accounttable">
				  <form name="member_list" action="admin.php?controller=admin_pro&action=accountlinux2devices&serverid=<?php echo $this->_tpl_vars['id']; ?>
" method="post" >
		   
                  <TR>
					<th class="list_bg" >选</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['HostName']; ?>
</TD>
                    <th class="list_bg" >IP</TD>
                    <th class="list_bg" >用户名</TD>
					<th class="list_bg" >同步时间</TD>
                    <th class="list_bg" >ID号</TD>
                    <th class="list_bg" >Shell</TD>
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
			<tr <?php if (! $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['radiususer_is_in_member'] && $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['radiususer']): ?>bgcolor='red'<?php endif; ?>>
				<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['server']['hostname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['user']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['date']; ?>
</td>				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['uid']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['shell']; ?>
</td>
				<td>
				<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 4): ?>
				<!--<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=pass_edit&ip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&user=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['user']; ?>
&accountlinux=1'>绑定</a>-->

				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('<?php echo $this->_tpl_vars['language']['Delete_sure_']; ?>
？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=accountlinux_del&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
';}"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>
				<?php endif; ?>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			<tr>
	           <td  colspan="4" align="left">
				<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="加入到从账号" onclick="my_confirm('确定加入从账号?');document.f1.action='admin.php?controller=admin_pro&action=accountlinux2devices&serverid=<?php echo $this->_tpl_vars['id']; ?>
'; return true;" class="an_06">&nbsp;&nbsp;<input type="button"  value="同步" onClick="location.href='admin.php?controller=admin_pro&action=accountlinux_listacct&ip=<?php echo $this->_tpl_vars['server']['device_ip']; ?>
&id=<?php echo $this->_tpl_vars['id']; ?>
'"  class="an_02">&nbsp;&nbsp;<input type="button"  value="创建" onClick="window.open ('admin.php?controller=admin_pro&action=accountlinux_edit&ip=<?php echo $this->_tpl_vars['server']['device_ip']; ?>
&id=<?php echo $this->_tpl_vars['id']; ?>
', 'newwindow', 'height=230, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');" class="an_02">
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_edit&id=<?php echo $this->_tpl_vars['id']; ?>
&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
&nbsp;&nbsp;&nbsp;<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>  导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a><?php endif; ?>
		   </td>
		</tr>
</table></div>
	<tr id="finalsubmit"><td align="center"><?php if ($this->_tpl_vars['id'] && $this->_tpl_vars['monitor'] == 1): ?><?php if (! $this->_tpl_vars['appconfigedit']): ?><input type=button <?php if (! $this->_tpl_vars['id']): ?>readonly<?php endif; ?> onclick="admin.php?controller=admin_pro&action=server_detect&ip=<?php echo $this->_tpl_vars['IP']; ?>
"  value="硬件检测" class="an_02"><?php endif; ?><?php endif; ?>&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit  value="保存修改" class="an_02" onclick="save();return true;"></td></tr></table>

</form>
<?php endif; ?>
	</td>
  </tr>
</table>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true,
	popupDirection: 'up'
});
cal.manageFields("f_rangeStart_trigger", "asset_start", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "asset_warrantdate", "%Y-%m-%d %H:%M:%S");


</script>
<script language="javascript">
function save(){
	if(document.getElementById('accounttable').style.display!='none'){
		document.f1.action += "&accounttable=1";
	}
	if(document.getElementById('apptable').style.display!='none'){
		document.f1.action += "&apptable=1";
	}
}
function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

<?php if ($_SESSION['ADMIN_LEVEL'] == 3 && $_SESSION['ADMIN_MSERVERGROUP']): ?>
var ug = document.getElementById('servergroup');
for(var i=0; i<ug.options.length; i++){
	if(ug.options[i].value==<?php echo $_SESSION['ADMIN_MSERVERGROUP']; ?>
){
		ug.selectedIndex=i;
		ug.onchange = function(){ug.selectedIndex=i;}
		break;
	}
}
<?php endif; ?>
function changeapp(name){
	document.getElementById('apache_type').style.display='none';
	document.getElementById('mysql_type').style.display='none';
	document.getElementById(name+'_type').style.display='';
}
</script>
<script>

//change_option(<?php if ($_SESSION['CACTI_CONFIG_ON']): ?>4<?php else: ?>2<?php endif; ?>,<?php echo $this->_tpl_vars['tab']; ?>
);

<?php if ($this->_tpl_vars['sgroup']['id'] || $this->_tpl_vars['gid']): ?>
changelevel(<?php echo $this->_tpl_vars['ldapid1']; ?>
, <?php echo $this->_tpl_vars['ldapid2']; ?>
);
changelevel2(<?php echo $this->_tpl_vars['ldapid2']; ?>
, <?php echo $this->_tpl_vars['servergroup']; ?>
);
<?php endif; ?>

function opentable(id){
	if(document.getElementById(id).style.display=='none'){
		document.getElementById(id+"_img").src='template/admin/cssjs/img/nolines_minus.gif'
		document.getElementById(id).style.display=''
	}else{
		document.getElementById(id+"_img").src='template/admin/cssjs/img/nolines_plus.gif'
		document.getElementById(id).style.display='none'
	}
    window.parent.reinitIframe();
}
<?php if ($_GET['accounttable']): ?>
opentable('accounttable');
<?php endif; ?>
<?php if ($_GET['apptable']): ?>
opentable('apptable');
<?php endif; ?>
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


