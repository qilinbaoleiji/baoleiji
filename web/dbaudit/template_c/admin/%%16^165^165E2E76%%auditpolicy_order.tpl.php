<?php /* Smarty version 2.6.18, created on 2013-09-12 23:25:59
         compiled from auditpolicy_order.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_auditpolicy&action=setorder_save&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&id=<?php echo $this->_tpl_vars['auditpolicy']['id']; ?>
">
<?php $this->assign('trnumber', 0); ?>
				
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>位置: </TD>
                  <TD>
                  <select  class="wbk"  name=policy_order id="policy_order">
				   <OPTION value="<?php echo $this->_tpl_vars['allpolicies_ct']; ?>
">最后</OPTION>
				   <OPTION value="1" <?php if ($this->_tpl_vars['auditpolicy']['policy_order'] == 1): ?>selected<?php endif; ?>>最前</OPTION>                     
                     	<?php unset($this->_sections['o']);
$this->_sections['o']['name'] = 'o';
$this->_sections['o']['loop'] = is_array($_loop=$this->_tpl_vars['allpolicies']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['o']['show'] = true;
$this->_sections['o']['max'] = $this->_sections['o']['loop'];
$this->_sections['o']['step'] = 1;
$this->_sections['o']['start'] = $this->_sections['o']['step'] > 0 ? 0 : $this->_sections['o']['loop']-1;
if ($this->_sections['o']['show']) {
    $this->_sections['o']['total'] = $this->_sections['o']['loop'];
    if ($this->_sections['o']['total'] == 0)
        $this->_sections['o']['show'] = false;
} else
    $this->_sections['o']['total'] = 0;
if ($this->_sections['o']['show']):

            for ($this->_sections['o']['index'] = $this->_sections['o']['start'], $this->_sections['o']['iteration'] = 1;
                 $this->_sections['o']['iteration'] <= $this->_sections['o']['total'];
                 $this->_sections['o']['index'] += $this->_sections['o']['step'], $this->_sections['o']['iteration']++):
$this->_sections['o']['rownum'] = $this->_sections['o']['iteration'];
$this->_sections['o']['index_prev'] = $this->_sections['o']['index'] - $this->_sections['o']['step'];
$this->_sections['o']['index_next'] = $this->_sections['o']['index'] + $this->_sections['o']['step'];
$this->_sections['o']['first']      = ($this->_sections['o']['iteration'] == 1);
$this->_sections['o']['last']       = ($this->_sections['o']['iteration'] == $this->_sections['o']['total']);
?>
							<option value="<?php echo $this->_tpl_vars['allpolicies'][$this->_sections['o']['index']]['policy_order']; ?>
" <?php if ($this->_tpl_vars['allpolicies'][$this->_sections['o']['index']]['policy_order'] == $this->_tpl_vars['auditpolicy']['policy_order']-1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allpolicies'][$this->_sections['o']['index']]['name']; ?>
 之后</option>
						<?php endfor; endif; ?>
						
                  </SELECT>     
				  </TD>
                </TR>		
				
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td colspan="2" align="center"><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
					</tr>	
</form>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

