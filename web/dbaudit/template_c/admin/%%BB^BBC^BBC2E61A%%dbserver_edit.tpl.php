<?php /* Smarty version 2.6.18, created on 2013-08-31 01:07:32
         compiled from dbserver_edit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/Calendarandtime.js"></script>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
  <tr>
	<td align="right"><a href="admin.php?controller=admin_dbserver&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back.png" width="50" border=0 width="60" /></a></td>
  </tr>
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_dbserver&action=dbserver_save&id=<?php echo $this->_tpl_vars['dbserver']['id']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	<?php $this->assign('trnumber', 0); ?>
	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		服务器IP
		</td>
		<td width="67%">
		<input type=text name="ip_addr" size=35 value="<?php echo $this->_tpl_vars['dbserver']['ip_addr']; ?>
" >
	  </td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		服务器名称
		</td>
		<td width="67%">
		<input type=text name="hostname" size=35 value="<?php echo $this->_tpl_vars['dbserver']['hostname']; ?>
" >
	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		数据库类型
		</td>
		<td width="67%">
		<select name="dbtype" >
		<option value="oracle" <?php if ($this->_tpl_vars['dbserver']['dbtype'] == 'oracle'): ?>selected<?php endif; ?>>oracle</option>
		<option value="db2" <?php if ($this->_tpl_vars['dbserver']['dbtype'] == 'db2'): ?>selected<?php endif; ?>>db2</option>
		<option value="mysql" <?php if ($this->_tpl_vars['dbserver']['dbtype'] == 'mysql'): ?>selected<?php endif; ?>>mysql</option>
		<option value="sqlserver" <?php if ($this->_tpl_vars['dbserver']['dbtype'] == 'sqlserver'): ?>selected<?php endif; ?>>sqlserver</option>
		<option value="sybase" <?php if ($this->_tpl_vars['dbserver']['dbtype'] == 'sybase'): ?>selected<?php endif; ?>>sybase</option>
		</select>
	  </td>
	</tr>
	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		描述
		</td>
		<td width="67%">
		<textarea name="desc" cols=50 rows=10 ><?php echo $this->_tpl_vars['dbserver']['desc']; ?>
</textarea>
	  </td>
	</tr>
	<tr><td></td><td><input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td></tr></table>

</form>
	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

