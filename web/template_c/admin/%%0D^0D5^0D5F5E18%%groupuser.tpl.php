<?php /* Smarty version 2.6.18, created on 2014-07-01 13:37:24
         compiled from groupuser.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有选择任何用户！");
		return false;
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
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
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
</ul><span class="back_img"><A href="admin.php?controller=admin_member&action=usergroup&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
	  <tr>
		<td class="">
			<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_usergroup" method="post">
				<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
					<tr>
						
						<th class="list_bg"  width="10%">用户名</th>
						<th class="list_bg"  width="10%">用户姓名</th>
						<th class="list_bg"  width="10%">启动时间</th>
						<th class="list_bg"  width="10%">结束时间</th>
						<th class="list_bg"  width="10%">等级</th>
						<th class="list_bg"  width="20%" >操作链接</th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allmember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['username']; ?>
</td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['realname']): ?><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['realname']; ?>
<?php else: ?>未设置<?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['start_time']; ?>
</td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['end_time'] == '2037-01-01 00:00:00'): ?>永不过期<?php else: ?><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['end_time']; ?>
<?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 0): ?>运维用户<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 1): ?>管理员<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 3): ?>部门管理员<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 2): ?>审计员<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 21): ?>部门审计员<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 10): ?>密码管理员<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 101): ?>部门密码管理员<?php endif; ?></td>
						<td align="center">
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=edit&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
&fromgroup=<?php echo $this->_tpl_vars['gid']; ?>
">修改</a> |
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=delete_user_from_group&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
">删除</a> 						
						</td>
					</tr>
					<?php endfor; endif; ?>					
					<tr>
						<td colspan="8" align="left">
							<input type="button"  value="加入用户" onclick="javascript:document.location='admin.php?controller=admin_member&action=groupadduser&gid=<?php echo $this->_tpl_vars['gid']; ?>
';" class="an_02">
						</td>
					</tr>
				
			</form>
					<tr>
						<td colspan="8" align="left">
							共<?php echo $this->_tpl_vars['total']; ?>
个用户  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个用户/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&page='+this.value;">页
						</td>
					</tr>
				</table>
			</table>
		</td>
	  </tr>
	</table>
	
</body>
</html>


