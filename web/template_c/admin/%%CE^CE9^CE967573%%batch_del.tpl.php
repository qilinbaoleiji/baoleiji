<?php /* Smarty version 2.6.18, created on 2014-06-16 14:39:01
         compiled from batch_del.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['LogList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
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
<script type="text/javascript">
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
var servers = new Array();
var j=0;
<?php unset($this->_sections['as']);
$this->_sections['as']['name'] = 'as';
$this->_sections['as']['loop'] = is_array($_loop=$this->_tpl_vars['servers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['as']['show'] = true;
$this->_sections['as']['max'] = $this->_sections['as']['loop'];
$this->_sections['as']['step'] = 1;
$this->_sections['as']['start'] = $this->_sections['as']['step'] > 0 ? 0 : $this->_sections['as']['loop']-1;
if ($this->_sections['as']['show']) {
    $this->_sections['as']['total'] = $this->_sections['as']['loop'];
    if ($this->_sections['as']['total'] == 0)
        $this->_sections['as']['show'] = false;
} else
    $this->_sections['as']['total'] = 0;
if ($this->_sections['as']['show']):

            for ($this->_sections['as']['index'] = $this->_sections['as']['start'], $this->_sections['as']['iteration'] = 1;
                 $this->_sections['as']['iteration'] <= $this->_sections['as']['total'];
                 $this->_sections['as']['index'] += $this->_sections['as']['step'], $this->_sections['as']['iteration']++):
$this->_sections['as']['rownum'] = $this->_sections['as']['iteration'];
$this->_sections['as']['index_prev'] = $this->_sections['as']['index'] - $this->_sections['as']['step'];
$this->_sections['as']['index_next'] = $this->_sections['as']['index'] + $this->_sections['as']['step'];
$this->_sections['as']['first']      = ($this->_sections['as']['iteration'] == 1);
$this->_sections['as']['last']       = ($this->_sections['as']['iteration'] == $this->_sections['as']['total']);
?>
servers[j++]={ip:'<?php echo $this->_tpl_vars['servers'][$this->_sections['as']['index']]['device_ip']; ?>
', groupid:<?php echo $this->_tpl_vars['servers'][$this->_sections['as']['index']]['groupid']; ?>
};
<?php endfor; endif; ?>

function changelevel(v, d){
	document.getElementById('ldapid2').options.length=0;
	document.getElementById('groupid').options.length=0;
	document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option('无', 0);
	document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option('无', 0);
	var found = 0;
	var class2_i = 0;
	var class2 = new Array();
	
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==2){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
			class2[class2_i++]=i;
		}
		if(servergroup[i].ldapid==v&& servergroup[i].level==0){
			if(d==servergroup[i].id){
				found = 1;
				document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}	

	var found = 0;
	for(var j=0; j<class2.length; j++){
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==servergroup[class2[j]].id&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}
	//changelevel2(found,0);
}

function changelevel2(v, d){
	document.getElementById('groupid').options.length=0;
	document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option('无', 0);
	if(v!=0){
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('groupid').options[document.getElementById('groupid').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}else{
		changelevel(document.getElementById('ldapid1').options[document.getElementById('ldapid1').options.selectedIndex].value, d);
	}
}

function changegroup(groupid){
	var serverObj = document.getElementById('serverlist');
	serverObj.options.length=0;
	for(var i=0; i<servers.length; i++){
		if(servers[i].groupid==groupid){
			serverObj.options[serverObj.options.length]=new Option(servers[i].ip, servers[i].ip, true, true);
		}
	}
	checkall('serverlist');
}

function checkall(selectID){
	var obj = document.getElementById(selectID);
	var len = obj.options.length;
	for(var i=0; i<len; i++){
		obj.options[i].selected = true;
	}
	return true;
}
</script>
<body>


<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=batch_del&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">日志删除</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=autodelete&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">自动删除</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul></div></td></tr>
  <tr>
	<td class="">
		<form method="post" name="session_search" action="admin.php?controller=admin_session&action=batch_del" enctype="multipart/form-data">
			<table bordercolor="white" cellspacing="0" cellpadding="0" border="0" width="98%"  class="BBtable">
				
				<tr bgcolor="f7f7f7"> 
					<td class="td_line" valign="top"><?php echo $this->_tpl_vars['language']['Search']; ?>
<?php echo $this->_tpl_vars['language']['Session']; ?>
<?php echo $this->_tpl_vars['language']['Content']; ?>
</td>
					<td>
						<input type="checkbox" name="ssh" value="admin_session" > telnet/ssh<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="rdp" value="admin_rdp" > rdp<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />		
						<input type="checkbox" name="ftp" value="admin_ftp" > Ftp<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="sftp" value="admin_sftp" > SFtp<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="as400" value="admin_sftp" > AS400<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="apppub" value="admin_apppub" > 应用<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="vnc" value="admin_vnc" > VNC<?php echo $this->_tpl_vars['language']['Session']; ?>
<br />
						<input type="checkbox" name="loginacct" value="loginacct" > 登录记录<br /><br />
					</td>
					<td class="td_line" width="70%">
						一级目录:<select width="30"  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevel(this.value,0)" style="width:100px">
								<OPTION VALUE="0">无</option>
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
							<?php if ($this->_tpl_vars['sgroup']['id'] != $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']): ?>
							<?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
							<OPTION VALUE="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['sgroup']['ldapid']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
							<?php endif; ?>
							<?php endif; ?>
						<?php endfor; endif; ?>
						</select>
						二级目录<select width="30" class="wbk"  name="ldapid2" id="ldapid2" onchange="changelevel2(this.value,0)" style="width:100px">
						</select>
						设备组		<select  class="wbk"  name="groupid" id="groupid" onchange="changegroup(this.value)">
								<option value="0" >所有</option>
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
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['groupid']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
						<?php endif; ?>
						<?php endfor; endif; ?>
						</select><br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select  class="wbk"  name="device_ip[]" id="serverlist" size="7" style="width:140px;height:110px;" multiple="multiple">
						<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['servers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option value="<?php echo $this->_tpl_vars['servers'][$this->_sections['s']['index']]['device_ip']; ?>
" selected><?php echo $this->_tpl_vars['servers'][$this->_sections['s']['index']]['device_ip']; ?>
</option>
						<?php endfor; endif; ?>
						</select>
					</td>
				</tr>
			
				<tr bgcolor="f7f7f7">
					<td class="td_line" width="10%"><?php echo $this->_tpl_vars['language']['StartTime']; ?>
：</td>
					<td class="td_line" width="70%" colspan="2"><?php echo $this->_tpl_vars['language']['from']; ?>
：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="" class="wbk"/>&nbsp;&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="bnnew2"> <?php echo $this->_tpl_vars['language']['to']; ?>
<input type="text" class="wbk" name="f_rangeStart2" id="f_rangeStart2" value="" />&nbsp;&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger2" name="f_rangeStart_trigger2" value="选择时间" class="bnnew2"></td>
				</tr>
				
				<tr>
					<td class="td_line" colspan="3" align="center"><input name="submit" type="submit" class="an_02" value="删除"></td>
				</tr>
			</table>
			<input type="hidden" name="ac" value="del" />
		</form>
	</td>
  </tr>
</table>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeStart_trigger2", "f_rangeStart2", "%Y-%m-%d %H:%M:%S");
//checkall('serverlist');
</script>

