<?php /* Smarty version 2.6.18, created on 2014-07-03 16:50:36
         compiled from devgroup_edit.tpl */ ?>
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
<?php if ($this->_tpl_vars['sgroup']['id'] != $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['id']): ?>
servergroup[i++]={id:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['id']; ?>
,name:'<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['groupname']; ?>
',ldapid:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['ldapid']; ?>
,level:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['level']; ?>
};
<?php endif; ?>
<?php endfor; endif; ?>

function changelevel(v, d){
	/*document.getElementById('level1').disabled =true;
	document.getElementById('level2').disabled =true;
	//v = document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.selectedIndex].value;
	if(v==0){
		document.getElementById('level1').disabled =false;
	}else{		
		document.getElementById('level2').disabled =false;
	}*/
	document.getElementById('ldapid2').options.length=0;
	document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option('无', 0);
	var found = 0;	
	document.getElementById('ldapid1id').value=v;
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v){
			if(d==servergroup[i].id){
				found = 1;				
				document.getElementById('ldapid2id').value=d;
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}
	//changelevel2(found,0);
}

function changelevel2(v, d){
	document.getElementById('ldapid2id').value=v;
	return ;
	document.getElementById('level2').disabled =false;
	if(v!=0)
	document.getElementById('level2').disabled =true;
	//v = document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.selectedIndex].value;

}
</script>
<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
</ul><span class="back_img"><A href="admin.php?controller=admin_pro&action=dev_group&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>

            <td align="center">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_pro&action=dev_group_save&id=<?php echo $this->_tpl_vars['sgroup']['id']; ?>
&ldapid=<?php echo $this->_tpl_vars['ldapid']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th colspan="2" class="list_bg"></th></tr>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		节点名
		</td>
		<td width="67%">
		<input type = text name="groupname" value="<?php echo $this->_tpl_vars['sgroup']['groupname']; ?>
">
	  </td>
	</tr>
	<tr>
		<td width="33%" align=right>
		负载均衡	
		</td>
		<td width="67%">
				<select  class="wbk"  name="loadbalance">
				<OPTION VALUE="0">无</option>
		<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['loadbalances']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<OPTION VALUE="<?php echo $this->_tpl_vars['loadbalances'][$this->_sections['l']['index']]['sid']; ?>
" <?php if ($this->_tpl_vars['loadbalances'][$this->_sections['l']['index']]['sid'] == $this->_tpl_vars['sgroup']['loadbalance']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['loadbalances'][$this->_sections['l']['index']]['ip']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
	  </td>
	</tr>
	<tr>
		<td width="33%" align=right>
		节点类型	
		</td>
		<td width="67%">
		<select  class="wbk" <?php if ($this->_tpl_vars['sgroup']['id']): ?>disabled<?php endif; ?> name="levelx_" onchange="levelxx(this.value)">
				<OPTION VALUE="0">服务器组</option>
				<OPTION VALUE="1" <?php if ($this->_tpl_vars['sgroup']['level'] == 1): ?>selected<?php endif; ?>>一级目录</option>
				<OPTION VALUE="2" <?php if ($this->_tpl_vars['sgroup']['level'] == 2): ?>selected<?php endif; ?>>二级目录</option>
		</select>
	  </td>
	</tr>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		所属目录
		</td>
		<td width="67%">
		一级<select  class="wbk"  name="ldapid1_" id="ldapid1" <?php if ($this->_tpl_vars['sgroup']['level'] == 1): ?>disabled<?php endif; ?> onchange="changelevel(this.value,0)">
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
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		二级<select  class="wbk"  name="ldapid2_" id="ldapid2" <?php if ($this->_tpl_vars['sgroup']['level']): ?>disabled<?php endif; ?> onchange="changelevel2(this.value,0)">
		</select>	  </td>
	</tr>
	
	<tr>
		<td width="33%" align=right valign="top">
		描述
		</td>
		<td width="67%">
		<textarea cols="30" rows="10"  name="description"></textarea>
	  </td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit"  value=" 确    认 " class="an_06"></td>
	</tr>
	</table>
<br>
<input type="hidden" name="levelx" id="levelxid" value="<?php echo $this->_tpl_vars['sgroup']['level']; ?>
" />
<input type="hidden" name="ldapid1" id="ldapid1id" value="<?php if ($this->_tpl_vars['sgroup']['level'] == 2): ?><?php echo $this->_tpl_vars['sgroup']['ldapid']; ?>
<?php endif; ?>" />
<input type="hidden" name="ldapid2" id="ldapid2id" value="0" />
</form>
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


function levelxx(v){
	document.getElementById('levelxid').value = v;
	if(v==1){
		document.getElementById('ldapid1').disabled = true;
		document.getElementById('ldapid2').disabled = true;
	}else if(v==2){
		document.getElementById('ldapid1').disabled = false;
		document.getElementById('ldapid2').disabled = true;
	}else{
		document.getElementById('ldapid1').disabled = false;
		document.getElementById('ldapid2').disabled = false;
	}
	document.getElementById('ldapid1').options.selectedIndex=0;
	document.getElementById('ldapid2').options.selectedIndex=0;
	document.getElementById('ldapid1id').value=0;
	document.getElementById('ldapid2id').value=0;
}

function check(){
	if(document.getElementById('levelxid').value==2&&document.getElementById('ldapid1id').value==0){
		alert('请选择一级目录');
		return false;
	}
	return true;
}
changelevel(<?php if ($this->_tpl_vars['ldapid1']): ?><?php echo $this->_tpl_vars['ldapid1']; ?>
<?php else: ?>0<?php endif; ?>, <?php if ($this->_tpl_vars['ldapid2']): ?><?php echo $this->_tpl_vars['ldapid2']; ?>
<?php else: ?>0<?php endif; ?>)
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

