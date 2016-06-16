<?php /* Smarty version 2.6.18, created on 2014-07-01 13:29:39
         compiled from appresourcegroup_bind.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>

<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appserver_list">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_app&action=app_group">应用用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appprogram_list">应用程序</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appicon_list">应用图标</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=<?php if ($this->_tpl_vars['fromapp'] == 'search'): ?>admin_pro&action=app_priority_search<?php else: ?>admin_app&action=app_group<?php endif; ?>&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center"><form name="f1" method=post action="admin.php?controller=admin_app&action=appresourcegroup_bindsave&id=<?php echo $this->_tpl_vars['id']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=0 bgcolor="#FFFFFF" valign=top class="BBtable">
			<tr><th colspan="3" class="list_bg"></th></tr>
			
	  <tr><td align="right">组名</td><td><?php echo $this->_tpl_vars['ginfo']['appgroupname']; ?>
</td></tr>
	  <tr><td align="right">已绑定资源数</td><td><?php echo $this->_tpl_vars['ginfo']['devicesct']; ?>
</td></tr>
	  <tr><td align="right">描述</td><td><?php echo $this->_tpl_vars['ginfo']['desc']; ?>
</td></tr>
         <tr>

	  <td width="33%" align="right" valign=top><?php echo $this->_tpl_vars['language']['bind']; ?>
<?php echo $this->_tpl_vars['language']['group']; ?>
</td>
	  <td >
	  <table>
	  <tr>
	  <?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
		<td width="150"><input type="checkbox" name='Group<?php echo $this->_sections['u']['index']; ?>
' value='<?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['id']; ?>
'  <?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['check']; ?>
><a onclick="window.open ('admin.php?controller=admin_app&action=appresourcegrp_selgroup&gid=<?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['id']; ?>
&sid=<?php echo $this->_tpl_vars['id']; ?>
&sessionlgroup=<?php echo $this->_tpl_vars['sessionlgroup']; ?>
', 'newwindow', 'height=160, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;"  href="#" target="_blank" ><?php echo $this->_tpl_vars['usergroup'][$this->_sections['u']['index']]['GroupName']; ?>
</a></td><?php if (( $this->_sections['u']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>
	  </td>
	  </tr>
	  <tr><td></td><td></td></tr>
		<tr>
		<td width="33%" align=right valign=top>
		<?php echo $this->_tpl_vars['language']['bind']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>

		</td>
		<td width="67%">
		<table><tr>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allmem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td width="150"><input type="checkbox" name='Check<?php echo $this->_sections['g']['index']; ?>
' value='<?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['uid']; ?>
'  <?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['check']; ?>
><a onclick="window.open ('admin.php?controller=admin_app&action=appresourcegrp_seluser&uid=<?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['uid']; ?>
&sid=<?php echo $this->_tpl_vars['id']; ?>
&sessionluser=<?php echo $this->_tpl_vars['sessionluser']; ?>
', 'newwindow', 'height=160, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;" href="#" target="_blank" ><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['username']; ?>
(<?php if ($this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']): ?><?php echo $this->_tpl_vars['allmem'][$this->_sections['g']['index']]['realname']; ?>
<?php else: ?>未设置<?php endif; ?>)</a></td><?php if (( $this->_sections['g']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>
	  </td>
	  </tr>
	 
	<tr><td></td><td><input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td></tr></table>
<input type="hidden" name="sessionlgroup" value="<?php echo $this->_tpl_vars['sessionlgroup']; ?>
" />
<input type="hidden" name="sessionluser" value="<?php echo $this->_tpl_vars['sessionluser']; ?>
" />
</form>
	</td>
  </tr>
</table>
</body>
</html>


