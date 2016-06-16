<?php /* Smarty version 2.6.18, created on 2014-06-28 23:16:13
         compiled from sshkey.tpl */ ?>
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

<body>
<script>
	function searchit(){
		document.search.action = "admin.php?controller=admin_pro&action=sshkey";
		document.search.action += "&username="+document.search.username.value;
		document.search.action += "&ip="+document.search.ip.value;
		document.search.action += "&dusername="+document.search.dusername.value;
		document.search.submit();
		return true;
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
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
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥上传</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autotemplate">巡检脚本</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	
</ul>
</div></td></tr>
	
   <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form name ='search' action='admin.php?controller=admin_pro&action=sshkey' method=post onsubmit="return searchit();">
  <tr>
    <td >
</td>
    <td >	
					堡垒机用户：<input type="text" name="username" size="13" class="wbk"/>&nbsp;&nbsp; 设备IP：<input type="text" name="ip" size="13" class="wbk"/>&nbsp;&nbsp;系统用户：<input type="text" name="dusername" size="13" class="wbk"/>&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>

					</td>
  </tr>
</form>	
</table>
</TD>
                  </TR>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
                <TBODY>
				  
                  <TR>
					<th class="list_bg">&nbsp;</th>
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=sshkey&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >名称</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_pro&action=sshkey&orderby1=dusername&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >描述</a></th>
					
					<th class="list_bg" >公钥</th>
					<th class="list_bg" >私钥</th>
					<th class="list_bg" >操作</th>
                  </TR>

            </tr>
			<form name="a" action="admin.php?controller=admin_pro&action=sshkey_delete" method="POST" >
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['sshdevices']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['id']; ?>
"></td>	
				<td> <a href='admin.php?controller=admin_pro&action=sshkey&device_ip=<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['device_ip']; ?>
'><?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['sshkeyname']; ?>
</a></td>
				<td> <a href='admin.php?controller=admin_pro&action=sshkey&hostname=<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['hostname']; ?>
'><?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['desc']; ?>
</a></td>
				<td><?php if ($this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['private_key_file']): ?>已上传<?php else: ?><font color='red'>未上传</font><?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['public_key_file']): ?>已上传<?php else: ?><font color='red'>未上传</font><?php endif; ?></td>	
				<td> <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href='admin.php?controller=admin_pro&action=sshkey_edit&id=<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['id']; ?>
'>编辑</a> | &nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/left_dot1.gif" width="16" height="16" align="absmiddle"><a href='admin.php?controller=admin_pro&action=sshkey_list&id=<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['id']; ?>
'>列表</a> | &nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href='admin.php?controller=admin_pro&action=sshkey_delete&id=<?php echo $this->_tpl_vars['sshdevices'][$this->_sections['t']['index']]['id']; ?>
'>删除</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
	           <td  colspan="3" align="left">
				<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="删除" onClick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=delete_all'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="添加" onclick="document.location='admin.php?controller=admin_pro&action=sshkey_edit'"  class="an_02" />&nbsp;&nbsp;&nbsp;
		   </td>
               
	           <td  colspan="5" align="right">
		   			共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=sshkey&page='+this.value;">页
		   </td>
		</tr>
			</form>
		</TBODY>
              </TABLE>	</td>
  </tr>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}
window.parent.menu.document.getElementById('devtree').style.display='none';
window.parent.menu.document.getElementById('ldaptree').style.display='none';
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

