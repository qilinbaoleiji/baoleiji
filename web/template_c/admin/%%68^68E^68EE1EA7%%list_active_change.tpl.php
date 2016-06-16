<?php /* Smarty version 2.6.18, created on 2014-06-09 09:35:15
         compiled from list_active_change.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['PasswordKey']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
		<form name="member_list" action="admin.php?controller=admin_pro&action=lac_save" method="post">
					<tr>	
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">服务器IP</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">主机名</th>	
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">协议</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">用户名</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">新密码</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">即将修改</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">保存修改</th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allsession']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['device_ip']; ?>
</a></td>						
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['hostname']; ?>
</td>					
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['login_method']; ?>
</td>				
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['username']; ?>
</td>				
						<td><input type="text" name="new_password_<?php echo $this->_sections['t']['index']; ?>
" value="已生成" /></td>				
						<td><input type="checkbox" name="active_change_<?php echo $this->_sections['t']['index']; ?>
" value="2" <?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['active_change']): ?>checked<?php endif; ?> /></td>
						<td><input type="hidden" name="id_<?php echo $this->_sections['t']['index']; ?>
" value="<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['id']; ?>
" /><input type="submit" name="save_<?php echo $this->_sections['t']['index']; ?>
" value="保存" onClick="javascript: window.location='admin.php?controller=admin_member&action=memberimport';" class="an_02"></td>
					</tr>
						
					<?php endfor; endif; ?>
					<tr><td colspan="2" align="left"><input type="button"  value="修改密码" onClick="javascript: document.location='admin.php?controller=admin_pro&action=lac_save2&cmd=<?php echo $this->_tpl_vars['cmd']; ?>
';" class="an_02"></td>
						<td colspan="8" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['session_num']; ?>
<?php echo $this->_tpl_vars['language']['Session']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
<?php echo $this->_tpl_vars['language']['item']; ?>
<?php echo $this->_tpl_vars['language']['Log']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) {window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;return false;}"><?php echo $this->_tpl_vars['language']['page']; ?>
 <!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
--> 
						
						</td>
					</tr>
				</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

