<?php /* Smarty version 2.6.18, created on 2014-05-26 17:12:26
         compiled from ldapusers_tree.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.js"></script>
</head>
<style>
.dtree {width: auto;overflow: scroll;height:400px;}
</style>
<script type="text/javascript">
function checkgroup(c, g, num){
	for(var i=1; i<=num; i++){
		document.getElementById('u_'+g+''+i).checked = c;
	}
}
</script>
<body>
<?php if (! $this->_tpl_vars['step']): ?>
<FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=ldapusers" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<tr bgcolor="f7f7f7"><td align="right">LDAP 服务器:</td>		
	<td>
		<input type="text" class="wbk" name="address" value="<?php echo $this->_tpl_vars['adconfig']['address']; ?>
" />	
		</td>	
	<td align="right">
		 LDAP域 :</td>		
	<td>
		<input type="text" class="wbk" name="domain" value="<?php echo $this->_tpl_vars['adconfig']['domain']; ?>
" />	
		</td>		
	</tr>

	<tr bgcolor="f7f7f7"><td align="right">LDAP 服务器账号:</td>		
	<td>
		<input type="text" class="wbk" name="adusername" value="<?php echo $this->_tpl_vars['adconfig']['adusername']; ?>
" />	
		</td>
<td align="right"> LDAP 服务器密码:</td>		
	<td>
		<input type="password" class="wbk" name="adpassword" value="<?php echo $this->_tpl_vars['adconfig']['adpassword']; ?>
" />	</td>
	</tr>
                  <TR>
                    <TD colspan="4" align="center"><INPUT class="an_02" type="submit" value="提交"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>

<?php else: ?>
 <FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=ldapusers_save" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<TR id="autosutr" <?php if ($this->_sections['i']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                    <TD width="20%" align="center">用户名 选择				
					</TD>
                  </TR>
				
                  <TR id="autosutr" <?php if ($this->_sections['i']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                    <TD>
					<table><tr >
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<?php if (! $this->_tpl_vars['members'][$this->_sections['i']['index']]['checked']): ?>
		<td width="150"><input type='checkbox' name='username[]' value='<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['username']; ?>
' ><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['username']; ?>
</td><?php if (( $this->_sections['i']['index'] + 1 ) % 5 == 0): ?></tr><tr>
		
				 <?php endif; ?> <?php endif; ?> 
				<?php endfor; endif; ?>
		</tr></table>

	<script type="text/javascript">
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		ddev.add(0,-1,'<?php echo $this->_tpl_vars['domain']; ?>
','#','','main');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		<?php unset($this->_sections['nu']);
$this->_sections['nu']['name'] = 'nu';
$this->_sections['nu']['loop'] = is_array($_loop=$this->_tpl_vars['nogroupusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nu']['show'] = true;
$this->_sections['nu']['max'] = $this->_sections['nu']['loop'];
$this->_sections['nu']['step'] = 1;
$this->_sections['nu']['start'] = $this->_sections['nu']['step'] > 0 ? 0 : $this->_sections['nu']['loop']-1;
if ($this->_sections['nu']['show']) {
    $this->_sections['nu']['total'] = $this->_sections['nu']['loop'];
    if ($this->_sections['nu']['total'] == 0)
        $this->_sections['nu']['show'] = false;
} else
    $this->_sections['nu']['total'] = 0;
if ($this->_sections['nu']['show']):

            for ($this->_sections['nu']['index'] = $this->_sections['nu']['start'], $this->_sections['nu']['iteration'] = 1;
                 $this->_sections['nu']['iteration'] <= $this->_sections['nu']['total'];
                 $this->_sections['nu']['index'] += $this->_sections['nu']['step'], $this->_sections['nu']['iteration']++):
$this->_sections['nu']['rownum'] = $this->_sections['nu']['iteration'];
$this->_sections['nu']['index_prev'] = $this->_sections['nu']['index'] - $this->_sections['nu']['step'];
$this->_sections['nu']['index_next'] = $this->_sections['nu']['index'] + $this->_sections['nu']['step'];
$this->_sections['nu']['first']      = ($this->_sections['nu']['iteration'] == 1);
$this->_sections['nu']['last']       = ($this->_sections['nu']['iteration'] == $this->_sections['nu']['total']);
?>
			ddev.add(<?php echo $this->_sections['nu']['index']+1; ?>
,0,'<input type="checkbox" name="username[]" value="<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]['username']; ?>
" ><?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]['username']; ?>
(<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]['name']; ?>
)','#','<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]['username']; ?>
(<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]['name']; ?>
)','main');
		<?php endfor; endif; ?>
		document.write(ddev);		
		ddev.s(0);
	</script>
					</TD>
                  </TR>
                  <TR>
                    <TD colspan="2" align="center">密码<input type='password' name='password' class="input_shorttext" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT class="an_02" type="submit" value="保存修改"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>
<?php endif; ?>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


