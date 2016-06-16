<?php /* Smarty version 2.6.18, created on 2013-12-31 10:34:36
         compiled from dbsniffer_edit.tpl */ ?>
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
 <tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><span class="back_img"><a href="admin.php?controller=admin_dbsniffer&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_dbsniffer&action=dbsniffer_save&id=<?php echo $this->_tpl_vars['dbsniffer']['id']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		探针名称
		</td>
		<td width="67%">
		<input type=text name="hostname" size=35 value="<?php echo $this->_tpl_vars['dbsniffer']['hostname']; ?>
" >
	  </td>
	</tr>
	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		探针IP
		</td>
		<td width="67%">
		<input type=text name="ip" size=35 value="<?php echo $this->_tpl_vars['dbsniffer']['ip']; ?>
" >
	  </td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		监听接口
		</td>
		<td width="67%">
		<input type=text name="interface" size=35 value="<?php echo $this->_tpl_vars['dbsniffer']['interface']; ?>
" >
	  </td>
	</tr>
	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		服务状态
		</td>
		<td width="67%">
		<select name="status" >
		<option value="0" <?php if (! $this->_tpl_vars['dbsniffer']['status']): ?>selected<?php endif; ?>>禁止</option>
		<option value="1" <?php if ($this->_tpl_vars['dbsniffer']['status']): ?>selected<?php endif; ?>>允许</option>
		</select>
	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		同步时间
		</td>
		<td width="67%">
		<input type=text name="time" size=35 value="<?php echo $this->_tpl_vars['dbsniffer']['time']; ?>
" >
	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		录相记录
		</td>
		<td width="67%">
		<select name="record" >
		<option value="0" <?php if (! $this->_tpl_vars['dbsniffer']['record']): ?>selected<?php endif; ?>>不记录</option>
		<option value="1"<?php if ($this->_tpl_vars['dbsniffer']['record']): ?>selected<?php endif; ?> >记录</option>
		</select>
	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		描述
		</td>
		<td width="67%">
		<textarea name="description" cols=50 rows=10 ><?php echo $this->_tpl_vars['dbsniffer']['description']; ?>
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

