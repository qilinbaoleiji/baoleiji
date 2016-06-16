<?php /* Smarty version 2.6.18, created on 2014-04-27 00:11:17
         compiled from inputauth.tpl */ ?>
  <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD align="center" class="tb_t_bg">登录信息 </TD>
  </TR>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
           <form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_pro&action=doinputauth" target="hide">
            <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top">
              <TBODY> 
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
" <?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['selected']; ?>
 ><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['username']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
				</TD></TR>
              <TR>
			  <?php endif; ?>
              <TR bgcolor="#f7f7f7">
                <TD width="50%" height="32" align="right">用户: </TD>
                <TD><INPUT name="username" id="username" type="text" value="<?php echo $this->_tpl_vars['username']; ?>
" autocomplete="off"></TD></TR>
              <TR>
                <TD width="50%" height="32" align="right">密码: </TD>
                <TD><INPUT name="password" id="password" type="password" value="<?php echo $this->_tpl_vars['password']; ?>
" autocomplete="off"></TD></TR>
              <TR>
                <TD height="32" align="right"><?php if ($this->_tpl_vars['showusers']): ?><INPUT type="hidden" id="passwordsave" value="<?php echo $this->_tpl_vars['passwordsave']; ?>
" name="passwordsave"><INPUT type="checkbox" <?php if ($this->_tpl_vars['saveedit']): ?>checked<?php endif; ?> value="1" name="saveedit">保存<?php endif; ?>&nbsp;&nbsp;</TD>
                <TD><INPUT class="an_02" type="submit" value="登录" name="actions">&nbsp;&nbsp;<?php if ($this->_tpl_vars['showusers']): ?><INPUT type="submit"  class="an_02" value="删除" name="actions"><?php endif; ?></TD></TR></TBODY></TABLE>
	<input type="hidden" name="url" value="<?php echo $this->_tpl_vars['url']; ?>
" />
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['devicesid']; ?>
" />
      </FORM></TD></TR></TBODY></TABLE>
<SCRIPT>

document.getElementById('username').value='';
document.getElementById('password').value='';
</SCRIPT></TR></TBODY></TABLE>


