<?php /* Smarty version 2.6.18, created on 2013-08-19 22:27:52
         compiled from upgradeserver.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['site_title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
function resto()
{
 if(document.getElementById('filesql').value=='' ){
   alert("<?php echo $this->_tpl_vars['language']['UploadFile']; ?>
");
   return false;
  }
  return true;
}
</script>
</head>

<body>

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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr>
				<th class="list_bg"  width="12%">服务名</th>
				<th class="list_bg"  width="15%">当前版本</th>
				<th class="list_bg" >上传</th>
			</tr>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_sysmanage&action=upgradeServerStatusSave" method="post">	
			<?php $this->assign('trnumber', 0); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td>telnet</td>
			<td><?php echo $this->_tpl_vars['version']['telnet']['version']; ?>
</td>
			<td><input name="file" id="" type="file" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="提交" class="an_02" /></td>
			</tr>
			<input type="hidden" name="stype" value="telnet" />
			</form>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_sysmanage&action=upgradeServerStatusSave" method="post">	
			<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td>ssh</td>
			<td><?php echo $this->_tpl_vars['version']['ssh']['version']; ?>
</td>
			<td><input name="file" id="" type="file" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="提交" class="an_02" /></td>
			</tr>
			<input type="hidden" name="stype" value="ssh" />
			</form>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_sysmanage&action=upgradeServerStatusSave" method="post">	
			<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td>rdp</td>
			<td><?php echo $this->_tpl_vars['version']['rdp']['version']; ?>
</td>
			<td><input name="file" id="" type="file" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="提交" class="an_02" /></td>
			</tr>
			<input type="hidden" name="stype" value="rdp" />
			</form>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_sysmanage&action=upgradeServerStatusSave" method="post">	
			<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td>play</td>
			<td><?php echo $this->_tpl_vars['version']['play']['version']; ?>
</td>
			<td><input name="file" id="" type="file" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="提交" class="an_02" /></td>
			</tr>
			<input type="hidden" name="stype" value="play" />
			</form>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_sysmanage&action=upgradeServerStatusSave" method="post">	
			<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td>ftp</td>
			<td><?php echo $this->_tpl_vars['version']['ftp']['version']; ?>
</td>
			<td><input name="file" id="" type="file" />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="提交" class="an_02" /></td>
			</tr>
			<input type="hidden" name="stype" value="ftp" />
			</form>
			
		</table>
	</td>
  </tr>
</table>
</body>
</html>
