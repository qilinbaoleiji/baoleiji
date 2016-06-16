<?php /* Smarty version 2.6.18, created on 2013-09-12 23:21:41
         compiled from sqloptions_cmd_edit.tpl */ ?>
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

<tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>         
 <tr>
	<td align="right"><a href="admin.php?controller=admin_sqloptions&action=sqloptions_cmd&optionsname=<?php echo $this->_tpl_vars['optionsname']; ?>
&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back.png" width="50" border=0 width="60" /></a></td>
  </tr>
<tr>

            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_sqloptions&action=sqloptions_cmd_save&optionsname=<?php echo $this->_tpl_vars['optionsname']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<?php $this->assign('trnumber', 0); ?>
	<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=20) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right  valign="top">
		命令<?php echo $this->_sections['c']['index']+1; ?>
:
		</td>
		<td width="67%">
		<input type = text name="commands[]">
	  </td>
	</tr>
	<?php endfor; endif; ?>

	<tr>
		<td></td>
		<td><input type="submit"  value=" <?php echo $this->_tpl_vars['language']['Add']; ?>
 " class="an_02"></td>
	</tr>
	</table>
<br>
<input type="hidden" name="add" value="new" />
<input type="hidden" name="optionsname" value="<?php echo $this->_tpl_vars['optionsname']; ?>
" />
</form>
	</td>
  </tr>
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

