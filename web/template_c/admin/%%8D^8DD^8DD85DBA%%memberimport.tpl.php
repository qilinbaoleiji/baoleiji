<?php /* Smarty version 2.6.18, created on 2014-05-12 05:10:26
         compiled from memberimport.tpl */ ?>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>b<?php else: ?>a<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
	 <?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>a<?php else: ?>b<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if (! $_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if (! $_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
  
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_member&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" width="80" height="30" border="0"></A></span>
</div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><th colspan="3" class="list_bg"></th></tr>
            <tr>
              <td align="center">
              <form action="admin.php?controller=admin_member&action=domemberimport" method="post" enctype="multipart/form-data" >
              <TABLE border=0 cellSpacing=0 cellPadding=5 width="100%" bgColor=#ffffff valign="top" class="BBtable">
                <TBODY>		
		<tr >
			<td width="10%" height="16" align="center" ><b>文件</b></td>
			<td align="left" width="30%">
			加密:<input type="checkbox" name="encrypt" value="1" />&nbsp;&nbsp;<input type="file" name="devfile" />
			</td>
		</tr>	
		<tr >
			<td width="10%" height="16" align="center" ></td>
			<td align="left" width="30%">
			<input type="submit" name="submit" value="提交" class="an_02" />
			</td>
		</tr>		
		
		</TBODY>
              </TABLE>
              </form>
              </td>

        </table>
	</td>
  </tr>
</table>
</body>
</html>

