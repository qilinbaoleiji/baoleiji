<?php /* Smarty version 2.6.18, created on 2014-04-26 23:56:39
         compiled from autobackup_save.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
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
<script>
var foundparent = false;
var servergroup = new Array();
var servers = new Array();
var devices = new Array();
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
i=0;
<?php unset($this->_sections['b']);
$this->_sections['b']['name'] = 'b';
$this->_sections['b']['loop'] = is_array($_loop=$this->_tpl_vars['allservers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['b']['show'] = true;
$this->_sections['b']['max'] = $this->_sections['b']['loop'];
$this->_sections['b']['step'] = 1;
$this->_sections['b']['start'] = $this->_sections['b']['step'] > 0 ? 0 : $this->_sections['b']['loop']-1;
if ($this->_sections['b']['show']) {
    $this->_sections['b']['total'] = $this->_sections['b']['loop'];
    if ($this->_sections['b']['total'] == 0)
        $this->_sections['b']['show'] = false;
} else
    $this->_sections['b']['total'] = 0;
if ($this->_sections['b']['show']):

            for ($this->_sections['b']['index'] = $this->_sections['b']['start'], $this->_sections['b']['iteration'] = 1;
                 $this->_sections['b']['iteration'] <= $this->_sections['b']['total'];
                 $this->_sections['b']['index'] += $this->_sections['b']['step'], $this->_sections['b']['iteration']++):
$this->_sections['b']['rownum'] = $this->_sections['b']['iteration'];
$this->_sections['b']['index_prev'] = $this->_sections['b']['index'] - $this->_sections['b']['step'];
$this->_sections['b']['index_next'] = $this->_sections['b']['index'] + $this->_sections['b']['step'];
$this->_sections['b']['first']      = ($this->_sections['b']['iteration'] == 1);
$this->_sections['b']['last']       = ($this->_sections['b']['iteration'] == $this->_sections['b']['total']);
?>
servers[i++]={id:<?php echo $this->_tpl_vars['allservers'][$this->_sections['b']['index']]['id']; ?>
,ip:'<?php echo $this->_tpl_vars['allservers'][$this->_sections['b']['index']]['device_ip']; ?>
',groupid:<?php echo $this->_tpl_vars['allservers'][$this->_sections['b']['index']]['groupid']; ?>
};
<?php endfor; endif; ?>
i=0;
<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['alldevices']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
devices[i++]={id:<?php echo $this->_tpl_vars['alldevices'][$this->_sections['c']['index']]['id']; ?>
,ip:'<?php echo $this->_tpl_vars['alldevices'][$this->_sections['c']['index']]['device_ip']; ?>
',username:'<?php if (! $this->_tpl_vars['alldevices'][$this->_sections['c']['index']]['username']): ?>空用户<?php else: ?><?php echo $this->_tpl_vars['alldevices'][$this->_sections['c']['index']]['username']; ?>
<?php endif; ?>', login_method: '<?php echo $this->_tpl_vars['alldevices'][$this->_sections['c']['index']]['lmname']; ?>
'};
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

function changesgroup(v, d){
	document.getElementById('serverip').options.length=0;	
	document.getElementById('serverip').options[document.getElementById('serverip').options.length]=new Option('无', 0);
	for(var i=0; i<servers.length; i++){
		if(servers[i].groupid==v){
			if(d==servers[i].ip){
				found = 1;
				document.getElementById('serverip').options[document.getElementById('serverip').options.length]=new Option(servers[i].ip, servers[i].ip, true, true);
			}else{				
				document.getElementById('serverip').options[document.getElementById('serverip').options.length]=new Option(servers[i].ip, servers[i].ip);
			}
		}
	}
}

function changeserver(v, d){
	document.getElementById('deviceid').options.length=0;	
	document.getElementById('deviceid').options[document.getElementById('deviceid').options.length]=new Option('无', 0);
	for(var i=0; i<devices.length; i++){
		if(devices[i].ip==v){
			if(d==devices[i].ip){
				found = 1;
				document.getElementById('deviceid').options[document.getElementById('deviceid').options.length]=new Option(devices[i].username+'('+devices[i].login_method+')', devices[i].id, true, true);
			}else{				
				document.getElementById('deviceid').options[document.getElementById('deviceid').options.length]=new Option(devices[i].username+'('+devices[i].login_method+')', devices[i].id);
			}
		}
	}
}

function change_option(number,index){
 for (var i = 0; i < number; i++) {
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
<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <?php if ($_SESSION['ADMIN_LEVEL'] != 10): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
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
</ul><span class="back_img"><A href="javascript:history.back();"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>

    <td align="center">
	<form name="f1" method=post enctype="multipart/form-data"  action="admin.php?controller=admin_autorun&action=autobackup_dosave&id=<?php echo $this->_tpl_vars['id']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th colspan="3" class="list_bg"></th></tr>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称:
		</td>
		<td width="67%"><input type="text" class="wbk" name="name" value="<?php echo $this->_tpl_vars['auto']['name']; ?>
"></td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		一级目录:
		</select>
		</td>
		<td width="67%"><select  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevel(this.value,0)">
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
			<?php if ($this->_tpl_vars['sgroup']['id'] != $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']): ?>
			<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['sgroup']['ldapid']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php endif; ?>
		<?php endfor; endif; ?></td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		二级目录:
		</td>
		<td width="67%">
		<select  class="wbk"  name="ldapid2" id="ldapid2" onchange="changelevel2(this.value,0)">
		</select></td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		设备组:
		</td>
		<td width="67%">
			<select  class="wbk"  name="g_id" id="servergroup" onchange="changesgroup(this.value,0);">
			</select>
		</td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		服务器:
		</td>
		<td width="67%">
			<select  class="wbk"  name="serverip" id="serverip" onchange="changeserver(this.value,0);">
			</select>
		</td>
	</tr>	
	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		用户:
		</td>
		<td width="67%">
			<select  class="wbk"  name="deviceid" id="deviceid">
			</select>
			</td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		备份周期:
		</td>
		<td width="67%">				
			<input type="text" class="wbk" name="period" value="<?php echo $this->_tpl_vars['auto']['period']; ?>
">天
	  </td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		是否sudo:
		</td>
		<td width="67%">				
			<select  class="wbk"  name="su" >
			<option value="1" <?php if ($this->_tpl_vars['auto']['su'] == 1): ?>selected<?php endif; ?>>是</option>
			<option value="0" <?php if ($this->_tpl_vars['auto']['su'] == 0): ?>selected<?php endif; ?>>否</option>
			</select>
	  </td>
	</tr>	
	<?php if ($this->_tpl_vars['type'] == 'run'): ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		备份脚本:
		</td>
		<td width="67%">				
			<select  class="wbk"  name="scriptpath" >
			<option value="" >请选择</option>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['templates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<option value="<?php echo $this->_tpl_vars['templates'][$this->_sections['t']['index']]['scriptpath']; ?>
" <?php if ($this->_tpl_vars['templates'][$this->_sections['t']['index']]['scriptpath'] == $this->_tpl_vars['auto']['scriptpath']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['templates'][$this->_sections['t']['index']]['name']; ?>
</option>
			<?php endfor; endif; ?>
			</select>
	  </td>
	</tr>	
	<?php else: ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		备份脚本:
		</td>
		<td width="67%">				
			<input type="file" name="scriptpath" >
	  </td>
	</tr>	
	<?php endif; ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		巡检内容:
		</td>
		<td width="67%">				
			<textarea name="desc" rows="10" cols="50"><?php echo $this->_tpl_vars['templates'][$this->_sections['t']['index']]['desc']; ?>
</textarea>
	  </td>
	</tr>	
	<tr>
		<td></td>
		<td><input type="submit"  value="保存" class="an_02"></td>
	</tr>
	</table>
<br>
<input type="hidden" name="add" value="new" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
</form>
	</td>
  </tr>
</table>

<script language="javascript">

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

