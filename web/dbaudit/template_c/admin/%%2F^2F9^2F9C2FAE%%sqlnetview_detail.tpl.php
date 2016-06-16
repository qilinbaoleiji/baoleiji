<?php /* Smarty version 2.6.18, created on 2013-10-21 10:13:31
         compiled from sqlnetview_detail.tpl */ ?>
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
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
          <tr>
            <td align="center">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		执行时间
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['at']; ?>

	  </td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		命令
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['cmd']; ?>

	  </td>
	</tr>	
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		命令字节
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['cmd_bytes']; ?>

	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		结果字节
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['result_bytes']; ?>

	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		响应时间
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['return_time']; ?>

	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		返回代码
		</td>
		<td width="67%">
		<?php echo $this->_tpl_vars['detail']['return_code']; ?>

	  </td>
	</tr>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		字段审计
		</td>
		<td width="67%">
		<?php if ($this->_tpl_vars['detail']['return_result_content'] && $this->_tpl_vars['detail']['return_result_title']): ?>是<?php else: ?>不<?php endif; ?>
	  </td>
	</tr>
	</table>

	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

