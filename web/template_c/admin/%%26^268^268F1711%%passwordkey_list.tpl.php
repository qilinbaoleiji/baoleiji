<?php /* Smarty version 2.6.18, created on 2014-04-22 23:18:52
         compiled from passwordkey_list.tpl */ ?>
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
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordkey">密码密钥</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
		<form name="member_list" action="admin.php?controller=admin_pro&action=deletepasswordkey" method="post">
					<tr>
						<th class="list_bg" bgcolor="d9ecfa" width="2%">选</td>					
						<th class="list_bg"  bgcolor="d9ecfa" width="7%"><?php echo $this->_tpl_vars['language']['PasswordKey']; ?>
</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%"><?php echo $this->_tpl_vars['language']['Createdate']; ?>
</th>	
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">密码邮件</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">密钥邮件</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="7%">操作</th>
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
					<tr <?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['dangerous'] > 1): ?>bgcolor="red"<?php elseif ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['dangerous'] > 0): ?>bgcolor="yellow" <?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['id']; ?>
"></td>
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['key_str']; ?>
</a></td>						
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['key_date']; ?>
</td>
						<td><?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['key_email']): ?>成功<?php else: ?>失败<?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['zip_email']): ?>成功<?php else: ?>失败<?php endif; ?></td>
						<td>&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_pro&action=deletepasswordkey&id=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a></td>
					</tr>
						
					<?php endfor; endif; ?>
					<tr><td colspan="2" align="left"><input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=document.member_list.elements[i];if(e.name=='chk_member[]')e.checked=document.member_list.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="删除选中" onClick="my_confirm('确定要删除所选密码密钥?');if(chk_form()) document.member_list.action='admin.php?controller=admin_pro&action=deletepasswordkey'; else return false;" class="an_02"></td>
						<td colspan="4" align="right">
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

