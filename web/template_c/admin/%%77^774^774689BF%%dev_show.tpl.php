<?php /* Smarty version 2.6.18, created on 2014-05-07 15:51:37
         compiled from dev_show.tpl */ ?>
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

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="hui_bj"><?php echo $this->_tpl_vars['title']; ?>
</td>
  </tr>
  <tr>
	<td class="main_content" align='center'>
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['IPAddress']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['IP']; ?>

	  </td>
	</tr>
		<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['HostName']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['hostname']; ?>

	  </td>
			<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Username']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['username']; ?>

	  </td>
	</tr>
		<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['System']; ?>
<?php echo $this->_tpl_vars['language']['LoginMethod']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['device_type']; ?>

	  </td>
	</tr>
		<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Loginmode']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['login_method']; ?>

	  </td>
	</tr>

	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		原始<?php echo $this->_tpl_vars['language']['Password']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['oldpass']; ?>

	  </td>
	</tr>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		现<?php echo $this->_tpl_vars['language']['Password']; ?>

		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['curpass']; ?>

	  </td>
	</tr>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		上次<?php echo $this->_tpl_vars['language']['ChangeTime']; ?>

		</td>
		<td width="67%">
		<?php if ($this->_tpl_vars['update_time'] == '0000-00-00 00:00:00'): ?>尚未<?php echo $this->_tpl_vars['language']['Edit']; ?>
<?php else: ?><?php echo $this->_tpl_vars['update_time']; ?>
<?php endif; ?>
	  </td>
	</tr>
	</table>
<br>
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

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

