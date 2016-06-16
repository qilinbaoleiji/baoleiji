<?php /* Smarty version 2.6.18, created on 2013-12-31 00:37:07
         compiled from auditpolicy_edit.tpl */ ?>
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
<tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><span class="back_img"><a href="admin.php?controller=admin_auditpolicy&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&back=1" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_auditpolicy&action=auditpolicy_save&dbtype=<?php echo $this->_tpl_vars['dbtype']; ?>
&id=<?php echo $this->_tpl_vars['auditpolicy']['id']; ?>
">
<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>规则名称：</td>
						<td><input type="text" name="name" class="wbk input_shorttext" <?php if ($this->_tpl_vars['auditpolicy']['id']): ?>readonly<?php endif; ?> value="<?php echo $this->_tpl_vars['auditpolicy']['name']; ?>
"></td>
					</tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
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
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="change_passwordtr">
		<TD width="33%" align=right>是否启用：</TD>
                  <TD width="67%"><input type="checkbox" name="enable" value="1" <?php if ($this->_tpl_vars['auditpolicy']['enable']): ?>checked<?php endif; ?>>      </TD>
                </TR>  
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="change_passwordtr">
		<TD width="33%" align=right>是否发送邮件：</TD>
                  <TD width="67%"><input type="checkbox" name="mail" value="1" <?php if ($this->_tpl_vars['auditpolicy']['mail']): ?>checked<?php endif; ?>>      </TD>
                </TR>  
		<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="change_passwordtr">
		<TD width="33%" align=right>是否syslog：</TD>
                  <TD width="67%"><input type="checkbox" name="syslog" value="1" <?php if ($this->_tpl_vars['auditpolicy']['syslog']): ?>checked<?php endif; ?>>      </TD>
                </TR>  
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>数据库用户：</td>
						<td><input type="text"  name="dbuser" class="wbk input_shorttext" value="<?php echo $this->_tpl_vars['auditpolicy']['dbuser']; ?>
"></td>
					</tr>
					<?php if ($this->_tpl_vars['dbtype'] == 'oracle'): ?>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>系统用户：</td>
						<td><input type="text" name="systemuser" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['auditpolicy']['systemuser']; ?>
"></td>
					</tr>
					<?php endif; ?>
				
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>来源地址组: </TD>
                  <TD>
                  <select  class="wbk"  name=server_ipgroup id="server_ipgroup">
                      <OPTION value="">请选择</OPTION>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['ipgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['ipgroup'][$this->_sections['k']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['ipgroup'][$this->_sections['k']['index']]['id'] == $this->_tpl_vars['auditpolicy']['server_ipgroup']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['ipgroup'][$this->_sections['k']['index']]['description']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>     
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>目标地址组: </TD>
                  <TD>
                  <select  class="wbk"  name=client_ipgroup id="client_ipgroup">
                      <OPTION value="">请选择</OPTION>
                     	<?php unset($this->_sections['k2']);
$this->_sections['k2']['name'] = 'k2';
$this->_sections['k2']['loop'] = is_array($_loop=$this->_tpl_vars['ipgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k2']['show'] = true;
$this->_sections['k2']['max'] = $this->_sections['k2']['loop'];
$this->_sections['k2']['step'] = 1;
$this->_sections['k2']['start'] = $this->_sections['k2']['step'] > 0 ? 0 : $this->_sections['k2']['loop']-1;
if ($this->_sections['k2']['show']) {
    $this->_sections['k2']['total'] = $this->_sections['k2']['loop'];
    if ($this->_sections['k2']['total'] == 0)
        $this->_sections['k2']['show'] = false;
} else
    $this->_sections['k2']['total'] = 0;
if ($this->_sections['k2']['show']):

            for ($this->_sections['k2']['index'] = $this->_sections['k2']['start'], $this->_sections['k2']['iteration'] = 1;
                 $this->_sections['k2']['iteration'] <= $this->_sections['k2']['total'];
                 $this->_sections['k2']['index'] += $this->_sections['k2']['step'], $this->_sections['k2']['iteration']++):
$this->_sections['k2']['rownum'] = $this->_sections['k2']['iteration'];
$this->_sections['k2']['index_prev'] = $this->_sections['k2']['index'] - $this->_sections['k2']['step'];
$this->_sections['k2']['index_next'] = $this->_sections['k2']['index'] + $this->_sections['k2']['step'];
$this->_sections['k2']['first']      = ($this->_sections['k2']['iteration'] == 1);
$this->_sections['k2']['last']       = ($this->_sections['k2']['iteration'] == $this->_sections['k2']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['ipgroup'][$this->_sections['k2']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['ipgroup'][$this->_sections['k2']['index']]['id'] == $this->_tpl_vars['auditpolicy']['client_ipgroup']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['ipgroup'][$this->_sections['k2']['index']]['description']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>     
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>来源MAC地址: </TD>
                  <TD>
                 <input type="text" name="sourcemac" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['auditpolicy']['sourcemac']; ?>
">
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>SQL指令组: </TD>
                  <TD>
                  <table><tr >
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['sqloptions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td width="100"><input type="checkbox" name='auditsqloptions[]' value='<?php echo $this->_tpl_vars['sqloptions'][$this->_sections['g']['index']]['id']; ?>
'  <?php echo $this->_tpl_vars['sqloptions'][$this->_sections['g']['index']]['check']; ?>
><?php echo $this->_tpl_vars['sqloptions'][$this->_sections['g']['index']]['optionsname']; ?>
</td><?php if (( $this->_sections['g']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>   
				  </TD>
                </TR>
		<?php if ($this->_tpl_vars['dbtype'] == 'oracle'): ?>
				  <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>SQL返回行:</td>
						<td><input type="text" name="return_line_number" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['auditpolicy']['return_line_number']; ?>
"></td>
					</tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>监控字段:</td>
						<td><input type="text" name="result_title" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['auditpolicy']['result_title']; ?>
"></td>
					</tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>字段内容:</td>
						<td><input type="text" name="result_content" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['auditpolicy']['result_content']; ?>
"></td>
					</tr>
		
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right>SQL返回值:</td>
						<td><textarea name="replyinfo"  cols=50 rows=10 ><?php echo $this->_tpl_vars['auditpolicy']['replyinfo']; ?>
</textarea></td>
					</tr>
		<?php endif; ?>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>是否执行成功: </TD>
                  <TD>
                  <SELECT  class="wbk"  name=success id="success">
					<OPTION value="-1">请选择</OPTION>
                      <OPTION value="1" <?php if (1 == $this->_tpl_vars['auditpolicy']['success']): ?>selected<?php endif; ?>>是</OPTION>
					  <OPTION value="0" <?php if (0 == $this->_tpl_vars['auditpolicy']['success']): ?>selected<?php endif; ?>>否</OPTION>
                  </SELECT>     
				  </TD>
                </TR>

				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> id="leveltr">
		<TD width="33%" align=right>审计风险等级：</TD>
                  <TD width="67%"><input type="radio" name="level" value="5" <?php if ($this->_tpl_vars['auditpolicy']['level'] == 5): ?>checked<?php endif; ?>>高风险&nbsp;&nbsp;<input type="radio" name="level" value="4" <?php if ($this->_tpl_vars['auditpolicy']['level'] == 4): ?>checked<?php endif; ?>>中风险&nbsp;&nbsp;<input type="radio" name="level" value="3" <?php if ($this->_tpl_vars['auditpolicy']['level'] == 3): ?>checked<?php endif; ?>>低风险&nbsp;&nbsp;<input type="radio" name="level" value="2" <?php if ($this->_tpl_vars['auditpolicy']['level'] == 2): ?>checked<?php endif; ?>>关注行为&nbsp;&nbsp;<input type="radio" name="level" value="1" <?php if ($this->_tpl_vars['auditpolicy']['level'] == 1): ?>checked<?php endif; ?>>一般行为&nbsp;&nbsp;</TD>
                </TR>  

				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  width="33%" align=right>可信任IP地址组: </TD>
                  <TD>
				  <table><tr >
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['ipgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td width="100"><input type="checkbox" name='trustipgroup[]' value='<?php echo $this->_tpl_vars['ipgroup'][$this->_sections['g']['index']]['id']; ?>
'  <?php echo $this->_tpl_vars['ipgroup'][$this->_sections['g']['index']]['check']; ?>
><?php echo $this->_tpl_vars['ipgroup'][$this->_sections['g']['index']]['description']; ?>
</td><?php if (( $this->_sections['g']['index'] + 1 ) % 5 == 0): ?></tr><tr><?php endif; ?>
		<?php endfor; endif; ?>
		</tr></table>
                  
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

