<?php /* Smarty version 2.6.18, created on 2014-07-01 11:56:03
         compiled from app_priority_search.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_priority_search">系统权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=app_priority_search">应用权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	
  
   <tr>
    <td class="main_content">
<form name ='f1' action='admin.php?controller=admin_pro&action=app_priority_search&type=luser' method=post>
					<?php echo $this->_tpl_vars['language']['4AUsername']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
<input type="text" class="wbk" name="user">
					<?php echo $this->_tpl_vars['language']['device']; ?>
IP<input type="text" class="wbk" name="device_ip">
					应用发布IP<input type="text" class="wbk" name="appserverip">
					应用名称<input type="text" class="wbk" name="appname">
					<?php echo $this->_tpl_vars['language']['System']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
<input type="text" class="wbk" name="s_user">&nbsp;&nbsp;<input type="button" height="35" align="middle" onClick="return search();" border="0" value=" 确定 " class="bnnew2"/>
					</form>
</td>
  </tr>
   
  <tr>
	<td class="">
<TABLE border=0 cellSpacing=1 cellPadding=5 width="100%" bgColor=#ffffff valign="top" class="BBtable">
<script type="text/javascript">
function search(){
var form = document.f1;
form.action += "&device_ip="+form.device_ip.value+"&s_user="+form.s_user.value+"&user="+form.user.value+"&appserverip="+form.appserverip.value+"&appname="+form.appname.value
form.submit();
return true;

}
function search2(){
var form = document.f2;
form.action += "&device_ip="+form.device_ip.value+"&s_user="+form.s_user.value+"&group="+form.group.value+"&appserverip="+form.appserverip.value
form.submit();
return true;
}
</script>
                <TBODY>
				
                  <TR>
                    <th class="list_bg" >&nbsp;</th>
                    <th class="list_bg" ><?php if ($this->_tpl_vars['type'] == 'luser'): ?><a href="admin.php?controller=admin_pro&action=dev_priority_search&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维账号</a><?php elseif ($this->_tpl_vars['type'] == 'lgroup'): ?><a href="admin.php?controller=admin_pro&action=dev_group&orderby1=gname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['UserGroup']; ?>
<?php endif; ?></a></th>                    
					<th class="list_bg" ><a href="admin.php?controller=admin_pro&action=dev_priority_search&orderby1=addr&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >设备IP</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_pro&action=dev_priority_search&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用发布IP</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_pro&action=dev_priority_search&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用名称</a></th> 
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=dev_priority_search&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用用户名</a></th>  
					<th class="list_bg" >自动修改密码</th>
					<th class="list_bg" >激活</th>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
                  </TR>

            </tr>
			<form name="member_list" action="admin.php?controller=admin_config&action=appdevice_delete" method="post">
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
			<tr <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ct'] > 0): ?>bgcolor="red" <?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
" /></td>
				<td><?php if ($this->_tpl_vars['type'] == 'luser'): ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['webuser']; ?>
<?php elseif ($this->_tpl_vars['type'] == 'lgroup'): ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['gname']; ?>
<?php endif; ?></td>				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appserverip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
</td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['change_password']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td style="TEXT-ALIGN: left;"><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['orderby'] == 1 || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['orderby'] == 3): ?>admin_config&action=apppub_edit&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['apppubid']; ?>
&appserverip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appserverip']; ?>
<?php elseif ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['orderby'] == 2): ?>admin_app&action=appresourcegroup_bind&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['lurid']; ?>
<?php endif; ?>&from=search"><?php echo $this->_tpl_vars['language']['Edit']; ?>
</a></td>
				
			</tr>
			<?php endfor; endif; ?>
			
                <tr>
				<td colspan="2"><input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
的<?php echo $this->_tpl_vars['language']['All']; ?>
&nbsp;&nbsp;<input type="submit"  value="<?php echo $this->_tpl_vars['language']['UsersDelete']; ?>
" onClick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_config&action=appdevice_delete'; else return false;" class="an_06"></td>
	           <td  colspan="8" align="right">
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) {window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;return false;}"><?php echo $this->_tpl_vars['language']['page']; ?>

		   </td>
		</tr>
		 </form>
		</TBODY>
              </TABLE>
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

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

