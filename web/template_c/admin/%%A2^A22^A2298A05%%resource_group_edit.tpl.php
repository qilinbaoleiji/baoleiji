<?php /* Smarty version 2.6.18, created on 2014-06-29 03:50:04
         compiled from resource_group_edit.tpl */ ?>
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
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=resource_group">系统用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
</ul><span class="back_img"><A href="admin.php?controller=admin_pro&action=resource_group&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
 <style>
.ul{list-style-type:none; margin:0;width:100%; }
.ul li{ width:80px; float:left;}
</style>

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
  <tr>
   <td >	
	<form name="f1" method=post onsubmit="changegroup();return false;" action="admin.php?controller=admin_pro&action=resource_group_save"  enctype="multipart/form-data" >
		
		一级目录<select width="30"  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevel(this.value,0)" style="width:100px">
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
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		二级目录<select width="30" class="wbk"  name="ldapid2" id="ldapid2" onchange="changelevel2(this.value,0)" style="width:100px">
		</select>
		设备组		<select  class="wbk"  name="groupid" id="groupid">
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
		</select>
		&nbsp;&nbsp;&nbsp;
		IP:<input type=text name="ip" width="8" id="ip" value="<?php echo $this->_tpl_vars['ip']; ?>
">&nbsp;&nbsp;&nbsp;
		主机名:<input type=text name="hostname" size="8" id="hostname" value="<?php echo $this->_tpl_vars['hostname']; ?>
">&nbsp;&nbsp;&nbsp;
		用户名:<input type=text name="username" size="8" id="username" value="<?php echo $this->_tpl_vars['username']; ?>
">&nbsp;&nbsp;&nbsp;
		<select name="lm" id="lm" >
		<option value="0">选择协议</option>
		<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['allmethod']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['allmethod'][$this->_sections['l']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allmethod'][$this->_sections['l']['index']]['id'] == $this->_tpl_vars['lm']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allmethod'][$this->_sections['l']['index']]['login_method']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		<input type='submit' value='确定' onclick='changegroup();' />
		</form>
					</td>
  </tr>
</table>
</TD>
                  </TR>
				  
            <td align="center">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th class="list_bg">未选设备</th><th class="list_bg"></th><th class="list_bg">已选设备</th></tr>

	<form name="f1" method=post action="admin.php?controller=admin_pro&action=resource_group_save"  enctype="multipart/form-data" >
	  <tr>
  <td align="right" colspan="1">系统用户组:<input type=text size="8" name="gname" id="gname" value="<?php echo $this->_tpl_vars['ginfo']['groupname']; ?>
"> </td><td align="left" colspan="2">描述:<input type=text size="50" name="desc" id="desc" value="<?php echo $this->_tpl_vars['ginfo']['desc']; ?>
"></td>
  <tr>
	  <tr>
	  <td width="45%" align=right>
		<select  class="wbk"  style="width:400;height:400;"  name="first" size="30" id="first" multiple="multiple" ondblclick="moveRight()">
		<?php unset($this->_sections['ra']);
$this->_sections['ra']['name'] = 'ra';
$this->_sections['ra']['loop'] = is_array($_loop=$this->_tpl_vars['resource']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ra']['show'] = true;
$this->_sections['ra']['max'] = $this->_sections['ra']['loop'];
$this->_sections['ra']['step'] = 1;
$this->_sections['ra']['start'] = $this->_sections['ra']['step'] > 0 ? 0 : $this->_sections['ra']['loop']-1;
if ($this->_sections['ra']['show']) {
    $this->_sections['ra']['total'] = $this->_sections['ra']['loop'];
    if ($this->_sections['ra']['total'] == 0)
        $this->_sections['ra']['show'] = false;
} else
    $this->_sections['ra']['total'] = 0;
if ($this->_sections['ra']['show']):

            for ($this->_sections['ra']['index'] = $this->_sections['ra']['start'], $this->_sections['ra']['iteration'] = 1;
                 $this->_sections['ra']['iteration'] <= $this->_sections['ra']['total'];
                 $this->_sections['ra']['index'] += $this->_sections['ra']['step'], $this->_sections['ra']['iteration']++):
$this->_sections['ra']['rownum'] = $this->_sections['ra']['iteration'];
$this->_sections['ra']['index_prev'] = $this->_sections['ra']['index'] - $this->_sections['ra']['step'];
$this->_sections['ra']['index_next'] = $this->_sections['ra']['index'] + $this->_sections['ra']['step'];
$this->_sections['ra']['first']      = ($this->_sections['ra']['iteration'] == 1);
$this->_sections['ra']['last']       = ($this->_sections['ra']['iteration'] == $this->_sections['ra']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['id']; ?>
" title="<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['device_ip']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['hostname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['port']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['ep']; ?>
"><?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['device_ip']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['hostname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['port']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['ep']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		</td>
		<td width="10%" align="center">
		<div class="select_move_2">
                <input size="30" type="button" value=" 添加--> " onclick="moveRight()"/><br /><br /><br />
                <input size="30" type="button" value=" <--删除 "  onclick="moveLeft()"/><br />
          </div>
         </td>
         <td>
		<select  class="wbk"   style="width:400;height:400;" size="30" id="secend" name="secend[]" multiple="multiple">
		<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['id']; ?>
" title="<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['device_ip']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['hostname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['port']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['ep']; ?>
" selected><?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['device_ip']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['hostname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['port']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['ep']; ?>
</option>
		<?php endfor; endif; ?>
   		</select>
	  </td>
	</tr>
	</table>
<br>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['ginfo']['id']; ?>
">
<input type="hidden" name="oldgname" value="<?php echo $this->_tpl_vars['ginfo']['groupname']; ?>
">
<input type="submit"  value="保存" onclick="return fsave();" class="an_02">
</form>
	</td>
  </tr>
</table>

<script language="javascript">
var changed = false;
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

function changegroup(){
	var gid = document.getElementById('groupid').options[document.getElementById('groupid').options.selectedIndex].value;
	var ip = document.getElementById('ip').value;
	var ldapid1 = document.getElementById('ldapid1').value;
	var ldapid2 = document.getElementById('ldapid2').value;
	var gname = document.getElementById('gname').value;
	var hostname = document.getElementById('hostname').value;
	var username = document.getElementById('username').value;
	var lm = document.getElementById('lm').options[document.getElementById('lm').options.selectedIndex].value;
	if(changed){
		if(confirm('确定要放弃更改?')){
			window.location='admin.php?controller=admin_pro&action=resource_group_edit&groupid='+gid+'&gname='+gname+'&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
&ip='+ip+'&hostname='+hostname+'&lm='+lm+'&username='+username+'&ldapid1='+ldapid1+'&ldapid2='+ldapid2;
		}
	}else{
		window.location='admin.php?controller=admin_pro&action=resource_group_edit&groupid='+gid+'&gname='+gname+'&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
&ip='+ip+'&hostname='+hostname+'&lm='+lm+'&username='+username+'&ldapid1='+ldapid1+'&ldapid2='+ldapid2;
	}
	return false;
}


</script>
<script type="text/javascript" >

	
	/**选中的元素向右移动**/
 	function moveRight()
	{
		
			//得到第一个select对象
		var selectElement = document.getElementById("first");
		var optionElements = selectElement.getElementsByTagName("option");
		var len = optionElements.length;
		var selectElement2 = document.getElementById("secend");

		if(!(selectElement.selectedIndex==-1))   //如果没有选择元素，那么selectedIndex就为-1
		{
			
			//得到第二个select对象
			
	
				// 向右移动
				for(var i=0;i<len ;i++)
				{
					if(selectElement.selectedIndex>=0)
					selectElement2.appendChild(optionElements[selectElement.selectedIndex]);
				}
				changed = true;
		} else
		{
			alert("您还没有选择需要移动的元素！");
		}
	}
	

	
	//移动选中的元素到左边
	function moveLeft()
	{
		//首先得到第二个select对象
		var selectElement = document.getElementById("secend");
		
		var optionElement = selectElement.getElementsByTagName("option");
		var len = optionElement.length;
		var firstSelectElement = document.getElementById("first");
		
		
		//再次得到第一个元素
		if(!(selectElement.selectedIndex==-1))
		{
			
			for(i=0;i<len;i++)
			{
				if(selectElement.selectedIndex>=0)
					firstSelectElement.appendChild(optionElement[selectElement.selectedIndex]);//被选中的那个元素的索引
			}
			changed = true;
		}else
		{
			alert("您还没有选中要移动的项目!");
		}
	}
	
	function checkall(selectID){
		var obj = document.getElementById(selectID);
		var len = obj.options.length;
		for(var i=0; i<len; i++){
			obj.options[i].selected = true;
		}
		return true;
	}

	function fsave(){
		//document.getElementById('fgname').value=document.getElementById('gname').value;
		checkall('secend');
		return true;
	}
	changelevel(<?php echo $this->_tpl_vars['ldapid1']; ?>
,<?php echo $this->_tpl_vars['ldapid2']; ?>
);
	changelevel2(<?php echo $this->_tpl_vars['ldapid2']; ?>
, <?php echo $this->_tpl_vars['groupid']; ?>
);
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

