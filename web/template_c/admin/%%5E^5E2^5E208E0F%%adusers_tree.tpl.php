<?php /* Smarty version 2.6.18, created on 2014-04-18 23:11:38
         compiled from adusers_tree.tpl */ ?>
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
/cssjs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jquery.csv-0.71.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/ajaxdtree.js"></script>
</head>
<style>
.dtree {width: auto;overflow: scroll;height:400px;}
</style>
<script type="text/javascript">
function checkgroup(c, g, num){
	var elements = document.getElementsByTagName('input');
	for(var i=0; i<elements.length; i++){
		if(elements[i].type=='checkbox'&&elements[i].id.indexOf('u_'+g+'_')>=0){
			document.getElementById(elements[i].id).checked = c;
		}
	}

	return true;
}
</script>
<body>
<?php if (! $this->_tpl_vars['step']): ?>
<FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=adusers" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<tr bgcolor="f7f7f7"><td align="right">AD 服务器:</td>		
	<td>
		<input type="text" class="wbk" name="address" value="<?php echo $this->_tpl_vars['adconfig']['address']; ?>
" />	
		</td>	
	<td align="right">
		 AD域 :</td>		
	<td>
		<input type="text" class="wbk" name="domain" value="<?php echo $this->_tpl_vars['adconfig']['domain']; ?>
" />	
		</td>		
	</tr>

	<tr bgcolor="f7f7f7"><td align="right">AD 服务器账号:</td>		
	<td>
		<input type="text" class="wbk" name="adusername" value="<?php echo $this->_tpl_vars['adconfig']['adusername']; ?>
" />	
		</td>
<td align="right"> AD 服务器密码:</td>		
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
 <FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=adusers_save" method="post">

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
<div class="dtree" id="dtree1">
	<script type="text/javascript">

		ddev = new dTree('ddev',"dtree1",'users');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		ddev.add(0,-1,'<?php echo $this->_tpl_vars['domain']; ?>
','#','');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		<?php unset($this->_sections['ag']);
$this->_sections['ag']['name'] = 'ag';
$this->_sections['ag']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ag']['show'] = true;
$this->_sections['ag']['max'] = $this->_sections['ag']['loop'];
$this->_sections['ag']['step'] = 1;
$this->_sections['ag']['start'] = $this->_sections['ag']['step'] > 0 ? 0 : $this->_sections['ag']['loop']-1;
if ($this->_sections['ag']['show']) {
    $this->_sections['ag']['total'] = $this->_sections['ag']['loop'];
    if ($this->_sections['ag']['total'] == 0)
        $this->_sections['ag']['show'] = false;
} else
    $this->_sections['ag']['total'] = 0;
if ($this->_sections['ag']['show']):

            for ($this->_sections['ag']['index'] = $this->_sections['ag']['start'], $this->_sections['ag']['iteration'] = 1;
                 $this->_sections['ag']['iteration'] <= $this->_sections['ag']['total'];
                 $this->_sections['ag']['index'] += $this->_sections['ag']['step'], $this->_sections['ag']['iteration']++):
$this->_sections['ag']['rownum'] = $this->_sections['ag']['iteration'];
$this->_sections['ag']['index_prev'] = $this->_sections['ag']['index'] - $this->_sections['ag']['step'];
$this->_sections['ag']['index_next'] = $this->_sections['ag']['index'] + $this->_sections['ag']['step'];
$this->_sections['ag']['first']      = ($this->_sections['ag']['iteration'] == 1);
$this->_sections['ag']['last']       = ($this->_sections['ag']['iteration'] == $this->_sections['ag']['total']);
?>
			ddev.add(<?php echo $this->_sections['ag']['index']+1; ?>
,0,'<input type="checkbox" id="<?php echo $this->_sections['ag']['index']+1; ?>
" name="group[]" value="" onclick="checkgroup(this.checked,<?php echo $this->_sections['ag']['index']+1; ?>
,<?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['usercount']; ?>
);ddev.o(<?php echo $this->_sections['ag']['index']+1; ?>
);"><?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['groupname']; ?>
','javascript:ddev.getChildren(<?php echo $this->_sections['ag']['index']+1; ?>
, \'<?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['groupname']; ?>
\');','<?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['groupname']; ?>
');			
			/*<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['groups'][$this->_sections['ag']['index']]['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
				ddev.add(<?php echo $this->_sections['ag']['index']+1; ?>
<?php echo $this->_sections['u']['index']+1; ?>
,<?php echo $this->_sections['ag']['index']+1; ?>
,'<input type="checkbox" id="u_<?php echo $this->_sections['ag']['index']+1; ?>
<?php echo $this->_sections['u']['index']+1; ?>
" name="username[]" value="<?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['users'][$this->_sections['u']['index']]; ?>
" ><?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['users'][$this->_sections['u']['index']]; ?>
','#','<?php echo $this->_tpl_vars['groups'][$this->_sections['ag']['index']]['users'][$this->_sections['u']['index']]; ?>
');
			<?php endfor; endif; ?>*/
		<?php endfor; endif; ?>
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
			ddev.add(<?php echo $this->_sections['ag']['index']+1; ?>
<?php echo $this->_sections['nu']['index']; ?>
,0,'<input type="checkbox" name="username[]" value="<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]; ?>
" ><?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]; ?>
','#','<?php echo $this->_tpl_vars['nogroupusers'][$this->_sections['nu']['index']]; ?>
');
		<?php endfor; endif; ?>
		ddev.show();	
		ddev.s(0);
	</script>
</div>
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


