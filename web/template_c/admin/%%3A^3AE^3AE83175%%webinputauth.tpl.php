<?php /* Smarty version 2.6.18, created on 2014-05-13 00:15:05
         compiled from webinputauth.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/Calendarandtime.js"></script>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="hui_bj"><?php echo $this->_tpl_vars['title']; ?>
</td>
  </tr>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_pro&action=doinputauth">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	 <TR bgcolor="">
                  <TD colspan="2" align=center>登录信息 </TD>
                  <td></td>
				   <?php if ($this->_tpl_vars['showusers']): ?>
			  <TR bgcolor="#f7f7f7">
                <TD width="50%" height="32" align="right">用户: </TD>
                <TD>
				<select onchange="changeuser(this.value);">
				<option value="0" >请选择用户</option>
				<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['id']; ?>
_<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['username']; ?>
.,?<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['password']; ?>
"  <?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['username']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
				</TD></TR>
              <TR>
			  <?php endif; ?>
                </TR>
     <TR bgcolor="f7f7f7">
                  <TD width="50%" align=right>用户: </TD>
                  <TD>
					<input type="text" name="username" id="username" value="<?php echo $this->_tpl_vars['username']; ?>
" autocomplete="off"  /> 
				  </TD>
                </TR>
                <TR>
                  <TD width="50%" align=right>密码: </TD>
                  <TD><input type="password" name="password" id="password" value="<?php echo $this->_tpl_vars['password']; ?>
" autocomplete="off" />               
				  </TD>
                </TR>            
	<tr><td align=right><?php if ($this->_tpl_vars['showusers']): ?><INPUT type="hidden" value="<?php echo $this->_tpl_vars['passwordsave']; ?>
" id="passwordsave" name="passwordsave"><INPUT type="checkbox" <?php if ($this->_tpl_vars['saveedit']): ?>checked<?php endif; ?> value="1" name="saveedit">保存<?php endif; ?>&nbsp;&nbsp;</td><td><input type=submit  value="登录" name="actions" class="an_02">&nbsp;&nbsp;<?php if ($this->_tpl_vars['showusers']): ?><INPUT type="submit"  class="an_02" value="删除" name="actions"><?php endif; ?></td></tr></table>
	<input type="hidden" name="rdptype" value="<?php echo $this->_tpl_vars['rdptype']; ?>
" />
	<input type="hidden" name="url" value="<?php echo $this->_tpl_vars['url']; ?>
" />
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['devicesid']; ?>
" />
</form>
	</td>
  </tr>
</table>
<script>
function changeuser(u){
	if(u==0){
		document.getElementById('passwordsave').value=-1;
		document.getElementById('username').value='';
		document.getElementById('password').value='';
	}else if(u!=0){
		var u1 = u.substring(0, u.indexOf('_'));
		var u2 = u.substring(u.indexOf('_')+1);
		var username = u2.split('.,?');
		document.getElementById('passwordsave').value=u1;
		document.getElementById('username').value=username[0];
		document.getElementById('password').value=username[1];
	}
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


