<?php /* Smarty version 2.6.18, created on 2014-05-09 22:49:59
         compiled from login4approve.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有<?php echo $this->_tpl_vars['language']['select']; ?>
任何<?php echo $this->_tpl_vars['language']['User']; ?>
！");
		return false;
	}

</script>
<script>
	function searchit(){
		document.search.action = "admin.php?controller=admin_member&action=login4approve";
		document.search.action += "&username="+document.search.username.value;
		document.search.submit();
		return true;
	}
	
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">Telnet/SSH</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_sftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">SFTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">FTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
	<?php if ($_SESSION['ADMIN_LEVEL'] != 0): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_as400&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">AS400</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
	<?php endif; ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_rdp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">RDP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_vnc&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">VNC</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($this->_tpl_vars['backupdb_id']): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_apppub&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_x11&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">X11</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=login4approve">登录审批</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li> 
</ul>
</div></td></tr>
<body>
	
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form name ='search' action='admin.php?controller=admin_member' method=post onsubmit="return searchit();">
  <tr>
    <td >
</td>
    <td >	
					用户名：<input type="text" name="username" size="13" class="wbk"/>&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>

					</td>
  </tr>
</form>	
</table>
</TD>
                  </TR>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_all" method="post">
					<tr>
						<th class="list_bg"  width="3%" ><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&action=login4approve&orderby1=webuser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >用户名</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&action=login4approve&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >服务器IP</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&action=login4approve&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >系统用户名</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&action=login4approve&orderby1=login_method&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >登录协议</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&action=login4approve&orderby1=applytime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >申请时间</a></th>
						<th class="list_bg"  width="24%" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
<?php echo $this->_tpl_vars['language']['Link']; ?>
</th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['approves']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?>
					<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td><?php if (( $_SESSION['ADMIN_LEVEL'] == 4 && ( ! $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] || $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] == 3 ) ) || ( $_SESSION['ADMIN_LEVEL'] == 1 ) || ( $_SESSION['ADMIN_LEVEL'] == 3 )): ?><?php if ($this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 10 && $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 2 && $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 1): ?><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['id']; ?>
"><?php endif; ?><?php endif; ?></td>			
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['webuser']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['ip']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['username']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['login_method']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['applytime']; ?>
</td>
						<td>
						
						<!--<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ckico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_dev&action=index&uid=<?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['language']['Edit']; ?>
<?php echo $this->_tpl_vars['language']['device']; ?>
</a> |-->
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=dologin4approve&id=<?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['approves'][$this->_sections['t']['index']]['approved']): ?>已<?php endif; ?>批准</a> |
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=dellogin4approve&id=<?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['id']; ?>
">删除</a>
						</td>
					</tr>
					<?php endfor; endif; ?>
					
					<tr>
						<td colspan="4" align="left">
						<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=document.member_list.elements[i];if(e.name=='chk_member[]')e.checked=document.member_list.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="删除审批" onClick="my_confirm('确定要删除审批?');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=dellogin4approve'; else return false;" class="an_02">&nbsp;&nbsp;<input type="submit"  value="批量审批" onClick="my_confirm('确定要批量审批?');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=dologin4approve'; else return false;" class="an_02">
						</td></form><form name="pageto" action="#" method="post">
						<td colspan="5" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
个/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) {window.location='admin.php?controller=admin_member&page='+this.value;return false;}else this.value=this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

							
						</td></form>
					</tr>
					
				
		  
					<tr>
						
					</tr>
				</table>
			
	  </table>
		</td>
	  </tr>
	</table>
	<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>

</body>
</html>

