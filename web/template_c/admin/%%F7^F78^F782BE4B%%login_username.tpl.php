<?php /* Smarty version 2.6.18, created on 2014-06-05 12:36:58
         compiled from login_username.tpl */ ?>
<?php if ($this->_tpl_vars['memberscount'] == 0): ?>
<input type="text" name="username" id="username"  style="width: <?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>240<?php else: ?>110<?php endif; ?>px;">
<?php else: ?>
<select name='username' id="username"  style="width: <?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>240<?php else: ?>110<?php endif; ?>px;">
<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
<option value='<?php echo $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']; ?>
' <?php if ($_COOKIE['username'] == $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']; ?>
</option>
<?php endfor; endif; ?>
</select>
<select name='username' id="realname" disabled style="display:none">
<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
<option value='<?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['realname']; ?>
' <?php if ($_COOKIE['username'] == $this->_tpl_vars['members'][$this->_sections['m']['index']]['realname']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['realname']; ?>
</option>
<?php endfor; endif; ?>
</select>
<?php endif; ?>

<?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>
<input type="hidden" name="authtype" value="localauth">
<?php else: ?>
&nbsp;&nbsp;<select name='authtype' style="width:120px;">
<option value='localauth' <?php if ($this->_tpl_vars['authtype'] == 'localauth'): ?>selected<?php endif; ?>>本地认证</option>
<?php if ($this->_tpl_vars['logintype']['radiusauth']): ?>
<option value='radiusauth' <?php if ($this->_tpl_vars['authtype'] == 'radiusauth'): ?>selected<?php endif; ?>>RADIUS认证</option>
<?php endif; ?>
<?php if ($this->_tpl_vars['logintype']['ldapauth']): ?>
<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['ldaps']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
<option value='ldapauth_<?php echo $this->_tpl_vars['ldaps'][$this->_sections['l']['index']]['address']; ?>
' <?php if ($this->_tpl_vars['authtype'] == 'ldapauth'): ?>selected<?php endif; ?>>LDAP <?php echo $this->_tpl_vars['ldaps'][$this->_sections['l']['index']]['domain']; ?>
</option>
<?php endfor; endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['logintype']['adauth']): ?>
<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['ads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
<option value='adauth_<?php echo $this->_tpl_vars['ads'][$this->_sections['a']['index']]['address']; ?>
' <?php if ($this->_tpl_vars['authtype'] == 'adauth'): ?>selected<?php endif; ?>>AD <?php echo $this->_tpl_vars['ads'][$this->_sections['a']['index']]['domain']; ?>
</option>
<?php endfor; endif; ?>
<?php endif; ?>
<?php endif; ?>
</select>
<input type="hidden" name="memberscount" id="memberscountid" value="<?php echo $this->_tpl_vars['memberscount']; ?>
" />
<input type="hidden" name="cacn" id="cacn" value="<?php echo $this->_tpl_vars['cacn']; ?>
" />