<?php /* Smarty version 2.6.18, created on 2014-06-28 23:42:30
         compiled from usersbylevel.tpl */ ?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
          <form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_pro&action=docommit" target="hide">
            <TABLE width="90%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top" class="BBtable">
              <TBODY>
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
              <TR <?php if ($this->_sections['m']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                <TD align="left" width="35%">
				<?php if ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 0): ?>运维<?php echo $this->_tpl_vars['language']['User']; ?>
<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 1): ?><?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 3): ?>部门<?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 4): ?>配置<?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 10): ?><?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 21): ?>部门审计员<?php elseif ($this->_tpl_vars['members'][$this->_sections['m']['index']]['level'] == 101): ?>部门密码员<?php else: ?><?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
<?php endif; ?>
				</TD>
				<td align="left"><?php echo $this->_tpl_vars['members'][$this->_sections['m']['index']]['count']; ?>
</td>
				</TR>
            <?php endfor; endif; ?>
			</TBODY></TABLE>
           <input type="hidden" name="url" value="<?php echo $this->_tpl_vars['url']; ?>
" />
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['devicesid']; ?>
" />
      </FORM></TD></TR></TBODY></TABLE></TR></TBODY></TABLE>