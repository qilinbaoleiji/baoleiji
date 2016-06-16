<?php /* Smarty version 2.6.18, created on 2014-04-27 00:03:55
         compiled from loadbalance_edit.tpl */ ?>
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
 <SCRIPT type=text/javascript>
var siteUrl = "<?php echo $this->_tpl_vars['template_root']; ?>
/images/date";
</SCRIPT>
<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ssh">认证配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_config&action=loadbalance&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
<form name="f1" method=post action="admin.php?controller=admin_config&action=loadbalance">
          <tr><th colspan="3" class="list_bg"></th></tr>
	<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>IP</td>
		<td width="67%"><input type="text" name="ip" value="<?php echo $this->_tpl_vars['p']['ip']; ?>
" /></td>
	</tr>
	
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>主机名</td>
		<td width="67%"><input type="text"  name="hostname" value="<?php echo $this->_tpl_vars['p']['hostname']; ?>
" /></td>
	  </tr>
		 	 
	<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
					<td  align="center" colspan=2><input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['p']['sid']): ?>modify<?php else: ?>new<?php endif; ?>" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['p']['sid']; ?>
" />
<input type=submit  value="保存修改" class="an_02">

	</td>
  </tr></form>
</table>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


