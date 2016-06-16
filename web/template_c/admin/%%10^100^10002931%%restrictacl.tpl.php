<?php /* Smarty version 2.6.18, created on 2014-04-26 16:20:42
         compiled from restrictacl.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=default_policy">策略设置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sourceip">来源IP组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=weektime">周组策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=forbidden_groups_list">命令权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=autochange_pwd">自动改密</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=cmdgroup_list">命令组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl">授权策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	
 
  <tr>
	<td class="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>

                  <TR>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=aclname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >规则名</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=year&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >年</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=month&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >月</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=day&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >日</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=week&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >星期</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >时间</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=lifetime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >会话时间</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipacl&action=index&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >客户IP</a></TD>
					<th class="list_bg" >操作</TD>
                  </TR>

            </tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['acl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['aclname']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['year']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['month']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['day']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['week']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['time']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['lifetime']; ?>
</td>
				<td ><?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['ip']; ?>
</td>		
				<td >
				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_ipacl&action=edit&id=<?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['id']; ?>
" >修改</a>
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_ipacl&action=delete&id=<?php echo $this->_tpl_vars['acl'][$this->_sections['t']['index']]['id']; ?>
';}">删除</a>
				</td> 
			</tr>
			<?php endfor; endif; ?>
	           <tr>
						<td colspan="2" align="left">
							<input type="button"  value=" 增加 " onclick="javascript:document.location='admin.php?controller=admin_ipacl&action=edit';" class="an_02">
						</td>
						<td  colspan="7" align="right">
		   			共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_ipacl&action=index&page='+this.value;">页
		   </td>
					</tr>
	           
		
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

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

