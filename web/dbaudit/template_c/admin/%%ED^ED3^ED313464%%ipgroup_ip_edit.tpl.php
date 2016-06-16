<?php /* Smarty version 2.6.18, created on 2013-09-12 23:09:20
         compiled from ipgroup_ip_edit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/Calendarandtime.js"></script>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
  <tr>
    <td  align="right"><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&groupid=<?php echo $this->_tpl_vars['groupid']; ?>
&back=1"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back.png" width="50" border=0 width="60" /></a></td>
  </tr>
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_ipgroup&action=ipgrouplist_save&id=<?php echo $this->_tpl_vars['sip']['id']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr >
		<td width="33%" align=right>
		ip
		</td>
		<td width="67%">
		<input type=text name="ip" size=35 value="<?php echo $this->_tpl_vars['sip']['ip']; ?>
" ></td>
	  </td>
	</tr>	
	<tr >
		<td width="33%" align=right>
		掩码
		</td>
		<td width="67%">
		<select name="netmask" >
		<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<option value="<?php echo $this->_sections['n']['index']+1; ?>
" <?php if ($this->_tpl_vars['sip']['netmask'] == $this->_sections['n']['index']+1): ?>selected<?php endif; ?>><?php echo $this->_sections['n']['index']+1; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		</td>
	  </td>
	</tr>	
	<tr bgcolor="f7f7f7"><td></td><td><input type=submit  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td></tr></table>
<input type=hidden name="groupid" size=35 value="<?php echo $this->_tpl_vars['groupid']; ?>
" >
</form>
	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

