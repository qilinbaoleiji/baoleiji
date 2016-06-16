<?php /* Smarty version 2.6.18, created on 2013-12-31 00:37:23
         compiled from sqlserver_edit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><span class="back_img"><a href="admin.php?controller=admin_sqlservercfg&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" border=0  /></a></span></div></td></tr>

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_sqlservercfg&action=sqlserver_save&id=<?php echo $this->_tpl_vars['users']['id']; ?>
">
					<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>名称：</td>
						<td><input type="text" name="name" class="wbk input_shorttext" <?php if ($this->_tpl_vars['users']['id']): ?>readonly<?php endif; ?> value="<?php echo $this->_tpl_vars['users']['name']; ?>
"></td>
					</tr>
					<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>服务器：</td>
						<td><input type="text" name="server" class="wbk input_shorttext" <?php if ($this->_tpl_vars['users']['id']): ?>readonly<?php endif; ?> value="<?php echo $this->_tpl_vars['users']['server']; ?>
"></td>
					</tr>
				
						
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>数据库用户：</td>
						<td><input type="text"  name="username" class="wbk input_shorttext" value="<?php echo $this->_tpl_vars['users']['username']; ?>
"></td>
					</tr>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>数据库密码：</td>
						<td><input type="password" name="password" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['users']['password']; ?>
"></td>
					</tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>重复数据库密码：</td>
						<td><input type="password" name="repassword" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['users']['password']; ?>
"></td>
					</tr>
				
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td colspan="2" align="center"><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
					</tr>	
</form>
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

