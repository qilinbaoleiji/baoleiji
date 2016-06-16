<?php /* Smarty version 2.6.18, created on 2014-06-27 17:19:26
         compiled from groupadddev.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />

</head>
 <SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/selectdate.js"></SCRIPT>

<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="hui_bj"><?php echo $this->_tpl_vars['title']; ?>
</td>
  </tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
          <tr>
            <td align="center"><form name="f1" method=post action="admin.php?controller=admin_pro&action=groupadddev_save&gid=<?php echo $this->_tpl_vars['gid']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	<tr><td colspan="8">组名:<?php echo $this->_tpl_vars['groupinfo']['groupname']; ?>
</td></tr>
	  <?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['alldev']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
	  <?php if ($this->_sections['g']['iteration']%8 == 1): ?>
		<tr <?php if ($this->_sections['g']['index'] % 16 != 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<?php endif; ?>
		<td>		
		<input type="checkbox" name='id[]' value='<?php echo $this->_tpl_vars['alldev'][$this->_sections['g']['index']]['id']; ?>
' ><?php echo $this->_tpl_vars['alldev'][$this->_sections['g']['index']]['device_ip']; ?>
		
	  </td>
	  <?php if ($this->_sections['g']['iteration']%8 == 0): ?>
	  </tr>
	  <?php endif; ?>
	  <?php endfor; endif; ?>
	<tr><td></td><td><input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td></tr></table>
</form>
	</td>
  </tr>
</table>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


