<?php /* Smarty version 2.6.18, created on 2014-07-03 18:26:12
         compiled from batchedit.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>b<?php else: ?>a<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>a<?php else: ?>b<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if (! $_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if (! $_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
   
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_member&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
</head>

<body>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="3%" align="center" bgcolor="#E0EDF8"><b>序列</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>用户名</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>RDP磁盘映射</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>RDP剪切版</b></th>
			<th class="list_bg"  width="8%" align="center" bgcolor="#E0EDF8"><b>RDP磁盘映射</b></th>
			<th class="list_bg"  width="8%" align="center" bgcolor="#E0EDF8"><b>密码</b></th>
			<th class="list_bg"  width="8%" align="center" bgcolor="#E0EDF8"><b>确认密码</b></th>
			<th class="list_bg"  width="15%" align="center" bgcolor="#E0EDF8"><b>过期时间</b></th>
		</tr>		
		<form name='route' action='admin.php?controller=admin_member&action=batchedit_save' method='post'>
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		
		<tr>
			<td width="5%" class="td_line"><?php echo $this->_sections['t']['index']+1; ?>
<input type="hidden" name="uid[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" /><input type="hidden" name="username[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['username']; ?>
" /></td>
			<td width="10%" class="td_line"><?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['username']; ?>
</td>			
			<td width="5%" class="td_line"><input type="checkbox" name="rdpdiskauth_up_<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" class="" value="1" <?php if ($this->_tpl_vars['users'][$this->_sections['t']['index']]['rdpdiskauth_up']): ?>checked<?php endif; ?>></td>
			<td width="5%" class="td_line"><input type="checkbox" name="rdpclipauth_up_<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" class="" value="1" <?php if ($this->_tpl_vars['users'][$this->_sections['t']['index']]['rdpclipauth_up']): ?>checked<?php endif; ?>></td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="rdpdisk[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['rdpdisk']; ?>
" size=15 /></td>
			<td width="10%" class="td_line"><input type="password" class="wbk" name="password[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['password']; ?>
" size=15 /></td>
			<td width="10%" class="td_line"><input type="password" class="wbk" name="confirm_password[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['password']; ?>
" size=15 /></td>
			<td width="10%" class="td_line"><INPUT size=15 value="<?php if ($this->_tpl_vars['users'][$this->_sections['t']['index']]['end_time'] != '2037-01-01 00:00:00'): ?><?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['end_time']; ?>
<?php endif; ?>" id="limit_time_<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" name="limit_time[]" onFocus="setday(this)">&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger_<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" name="f_rangeEnd_trigger_<?php echo $this->_tpl_vars['users'][$this->_sections['t']['index']]['uid']; ?>
" value="选择时间" class="wbk"> </td>
		</tr>		
		<?php endfor; endif; ?>
		  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true,
	popupDirection:'down'
});
<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
cal.manageFields("f_rangeEnd_trigger_<?php echo $this->_tpl_vars['users'][$this->_sections['m']['index']]['uid']; ?>
", "limit_time_<?php echo $this->_tpl_vars['users'][$this->_sections['m']['index']]['uid']; ?>
", "%Y-%m-%d");
<?php endfor; endif; ?>


</script>
		 <tr>
			<td colspan="9" align="center" ><input type='submit'  name="batch" value='确定' class="an_02"></td>
		  </tr>
		</form>

		</table>
	</td>
  </tr>

</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}
function change_level(obj, num){
<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>
	obj.selectedIndex=0;
<?php endif; ?>
	if(obj.value==11){
		var group = document.getElementById('groupid_'+num);
		var o_value = null;
		for(var i=0; i<group.options.length; i++){
			o_value = group.options[i].text.toLowerCase();
			if(o_value.indexOf("radius")>=0){
				group.options[i].selected = true;
				break;
			}
		}
	}
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


