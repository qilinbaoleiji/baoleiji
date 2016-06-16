<?php /* Smarty version 2.6.18, created on 2014-07-01 13:30:57
         compiled from appserver_edit.tpl */ ?>
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
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>
 <SCRIPT type=text/javascript>
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
</SCRIPT>
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
<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appserver_list">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_app&action=app_group">应用用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appprogram_list">应用程序</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appicon_list">应用图标</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_config&action=appserver_list&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center">
    <form name="f1" method=post action="admin.php?controller=admin_config&action=appserver_save">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
		<tr><th colspan="3" class="list_bg"></th></tr>
	<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>发布服务器名称</td>
		<td width="67%"><input type="text" name="name" value="<?php echo $this->_tpl_vars['p']['name']; ?>
" /></td>
	</tr>
	
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>发布服务器IP</td>
		<td width="67%"><input type="text" name="appserverip" value="<?php echo $this->_tpl_vars['p']['appserverip']; ?>
" /></td>
	  </tr>
	  <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>服务器描述</td>
		<td width="67%"><textarea name="description" ><?php echo $this->_tpl_vars['p']['description']; ?>
</textarea></td>
	  </tr>
	 
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
					<td></td><td><input type="hidden" name="ac" value="new" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['p']['id']; ?>
" />
<input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td></tr>
	</table>
<br>


</form>
	</td>
  </tr>
</table>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

