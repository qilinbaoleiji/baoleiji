<?php /* Smarty version 2.6.18, created on 2014-05-08 16:04:14
         compiled from createrdpfile.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['site_title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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


<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=createrdpfile">列表导出</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
		
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_index&action=createrdpfile&tool=mremote" method="post">	
			<tr>
			<td>mRemote</td>
			<td>堡垒机IP:<input name="baoleijiip" id="" value="<?php echo $this->_tpl_vars['eth0']; ?>
" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;端口:<input name="port" id="" value="3389" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="<?php echo $this->_tpl_vars['language']['Commit']; ?>
" /></td>
			</tr>
			</form>

			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_index&action=createrdpfile&tool=rdcman" method="post">	
			<tr>
			<td>RDCMAN</td>
			<td>堡垒机IP:<input name="baoleijiip" id="" value="<?php echo $this->_tpl_vars['eth0']; ?>
" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;端口:<input name="port" id="" value="3389" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="<?php echo $this->_tpl_vars['language']['Commit']; ?>
" /></td>
			</tr>
			</form>

			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_index&action=createrdpfile&tool=securecrt" method="post" target="hide">	
			<tr>
			<td>SecureCRT</td>
			<td>堡垒机IP:<input name="baoleijiip" id="" value="<?php echo $this->_tpl_vars['eth0']; ?>
" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;端口:<input name="port" id="" value="22" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;默认:<select name="template" ><option value="">无</option><option value="6">SecureCRT6</option><option value="6">SecureCRT7</option></select>模版:<input name="crttemplate" id="" type="file" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="<?php echo $this->_tpl_vars['language']['Commit']; ?>
" /></td>
			</tr>
			</form>
			<form name="backup" enctype="multipart/form-data" action="admin.php?controller=admin_index&action=createrdpfile&tool=xshell" method="post" target="hide">	
			<tr>
			<td>Xshell</td>
			<td>堡垒机IP:<input name="baoleijiip" id="" value="<?php echo $this->_tpl_vars['eth0']; ?>
" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;端口:<input name="port" id="" value="22" type="text" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;默认:<select name="template" ><option value="">无</option><option value="3">XShell3</option><option value="4">XShell4</option></select>模版:<input name="xshelltemplate" id="" type="file" width=50 />&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="<?php echo $this->_tpl_vars['language']['Commit']; ?>
" /></td>
			</tr>
			</form>
		</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>
</body>
</html>

