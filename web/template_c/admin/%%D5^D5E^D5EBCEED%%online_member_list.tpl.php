<?php /* Smarty version 2.6.18, created on 2014-04-22 13:23:30
         compiled from online_member_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
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
		alert("您没有<?php echo $this->_tpl_vars['language']['select']; ?>
任何<?php echo $this->_tpl_vars['language']['User']; ?>
！");
		return false;
	}
</script>
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
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>

	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>

	  <tr><td>
	<form name="member_list" action="admin.php?controller=admin_member&action=offline" method="post">
				<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"  width="3%" class="list_bg"><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="9%" class="list_bg">用户名</th>
						<th class="list_bg"  width="9%" class="list_bg">用户等级</th>
						<th class="list_bg"  width="9%" class="list_bg">登录时间</th>
						<th class="list_bg"  width="9%" class="list_bg">最近活动时间</th>
						<th class="list_bg"  width="6%" class="list_bg">IP</th>
						<th class="list_bg"  width="24%" class="list_bg"><?php echo $this->_tpl_vars['language']['Operate']; ?>
<?php echo $this->_tpl_vars['language']['Link']; ?>
</th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['online_users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td><?php if ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['ssid'] != $this->_tpl_vars['current_session_id']): ?><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['ssid']; ?>
"><?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['username']; ?>
</td>
						<td><?php if ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 1): ?>管理员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 2): ?>审计员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 21): ?>部门审计员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 3): ?>部门管理员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 10): ?>密码管理员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 101): ?>部门密码管理员<?php elseif ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['level'] == 0): ?>运维用户<?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['logindate']; ?>
</td>
						<td><?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['lastactime']; ?>
</td>
						<td><?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['ip']; ?>
</td>
						<td align="center">
						<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
						<?php if ($this->_tpl_vars['online_users'][$this->_sections['t']['index']]['ssid'] != $this->_tpl_vars['current_session_id']): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/disconnect.png" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=offline&ssid=<?php echo $this->_tpl_vars['online_users'][$this->_sections['t']['index']]['ssid']; ?>
" >断开</a><?php endif; ?><?php endif; ?>
						</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="8" align="left">
							<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
的<?php echo $this->_tpl_vars['language']['All']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
&nbsp;&nbsp;<input type="submit"  value=" 断开选定的用户" onclick="my_confirm('确定要断开用户?');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=offline_all'; else return false;" class="an_06">
						</td>
					</tr>
			</form>
					
			
			</table>
		</td>
	  </tr>
	</table>
	
</body>
</html>

