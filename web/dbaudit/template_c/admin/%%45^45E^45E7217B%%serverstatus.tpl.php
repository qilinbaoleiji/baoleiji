<?php /* Smarty version 2.6.18, created on 2013-07-16 15:36:07
         compiled from serverstatus.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>服务<?php echo $this->_tpl_vars['language']['List']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
				<th class="list_bg"  width="20%"><?php echo $this->_tpl_vars['language']['ServiceName']; ?>
</th>
				<th class="list_bg"  width="10%"><?php echo $this->_tpl_vars['language']['Status']; ?>
</th>
				<th class="list_bg"  width="10%"><?php echo $this->_tpl_vars['language']['version']; ?>
</th>
				<th class="list_bg"  width="10%"><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allcommand']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['name']; ?>
</td>
				<td><?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['status'] == 1): ?><font color="green">正常</font><?php else: ?><font color="red"><?php echo $this->_tpl_vars['language']['Failed']; ?>
</font><?php endif; ?></ td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['version']; ?>
</td>
				<td>
				<?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['status'] == 1): ?><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/069.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sname']; ?>
&ac=restart"><?php echo $this->_tpl_vars['language']['Restart']; ?>
</a><?php endif; ?>
				<?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['status'] == 0): ?><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/069.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sname']; ?>
&ac=start"><?php echo $this->_tpl_vars['language']['Start']; ?>
</a><?php endif; ?>
				<?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['status'] == 1): ?><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/070.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sname']; ?>
&ac=stop"><?php echo $this->_tpl_vars['language']['Stop']; ?>
</a><?php endif; ?>
				
				</td>
			</tr>
			<?php endfor; endif; ?>
			
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

