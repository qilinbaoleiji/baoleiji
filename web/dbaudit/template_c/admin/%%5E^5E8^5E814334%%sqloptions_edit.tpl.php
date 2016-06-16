<?php /* Smarty version 2.6.18, created on 2013-12-31 00:37:31
         compiled from sqloptions_edit.tpl */ ?>
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
 ?><span class="back_img"><a href="admin.php?controller=admin_sqloptions&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" border=0  /></a></span></div></td></tr>
 
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_sqloptions&action=sqloptions_save&optionsname=<?php echo $this->_tpl_vars['sqloptions']['optionsname']; ?>
">
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		组名组:
		</td>
		<td width="67%">
		<input type = text name="optionsname" value="<?php echo $this->_tpl_vars['sqloptions']['optionsname']; ?>
">
	  </td>
	</tr>
	<tr >
		<td width="33%" align=right>
		描述:
		</td>
		<td width="67%">
		<textarea name="desc" cols="40" rows="10"><?php echo $this->_tpl_vars['sqloptions']['desc']; ?>
</textarea>
	  </td>
	</tr>
	<tr>
		
	<td align="center" colspan=2><input type="submit"  value="保存修改" class="an_02">
			<input type="hidden" name="add" value="new" /><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['sqloptions']['id']; ?>
" />
	</td>
  </tr></form>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

document.getElementById("telnet").selected = true;


</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

