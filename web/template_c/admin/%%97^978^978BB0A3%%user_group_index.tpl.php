<?php /* Smarty version 2.6.18, created on 2014-07-01 13:37:20
         compiled from user_group_index.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>
	
  <tr>
	<td class="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
                <TBODY>
				                     <TR>

                    <th class="list_bg" ><a href="admin.php?controller=admin_member&action=usergroup&orderby1=GroupName&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['GroupName']; ?>
</a></TD>
					<th class="list_bg" width="10%">用户数</TD>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</TD>
                  </TR>

            </tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td> <?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['GroupName']; ?>
</td>
				<td> <?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['userct']; ?>
</td>
				<td style="TEXT-ALIGN: left;"><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico9.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_member&action=groupuser&gid=<?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['language']['User']; ?>
</a>
				<!--| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico18.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_member&action=protect_group&gid=<?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['id']; ?>
&type=group" ><?php echo $this->_tpl_vars['language']['devicebind']; ?>
</a>
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico3.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_member&action=protect_group_devgrp&gid=<?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['language']['Devicegroupbind']; ?>
</a>
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/database.png' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_member&action=protect_group_resgrp&gid=<?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['id']; ?>
" >资源组绑定</a>-->
				| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('<?php echo $this->_tpl_vars['language']['Delete_sure_']; ?>
？')) {return false;} else { location.href='admin.php?controller=admin_member&action=delete_usergroup&id=<?php echo $this->_tpl_vars['allgroup'][$this->_sections['t']['index']]['id']; ?>
';}"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			<tr>
	           <td align="left">
		           <form action="admin.php?controller=admin_member&action=addgroup" method="post">
					<input type="text" class="wbk" name="gname" />
					<input type="submit"  value="添加" class="an_02">
					</form>
		   		</td>
		   	
				<td align="right" colspan="2">
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_group_index&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

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
