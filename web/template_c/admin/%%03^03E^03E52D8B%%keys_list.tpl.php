<?php /* Smarty version 2.6.18, created on 2014-05-15 16:03:37
         compiled from keys_list.tpl */ ?>
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
<script>
function searchit(){
document.route.submit();
return true;
}
</script>
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

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=keys_index">USBKEY列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
		<form name='route' action='admin.php?controller=admin_member&action=keys_index' method='post'>
			<td colspan="3" class="main_content">&nbsp;USBKEY 序列号：<input type="text" class="wbk" size="20" name="keyid" value="" />&nbsp;&nbsp; 用户名：<input type="text" class="wbk" size="20" name="username" value="" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>&nbsp;&nbsp;</td>
			
			<input type="hidden" name="ac" value="new" />
		</form>
		</tr>
  <tr>
	<td class="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>		
		<tr >
			<th class="list_bg" align="center" width="30%"><a href="admin.php?controller=admin_member&action=keys_index&orderby1=keyid&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><strong>USBKEY 序列号</strong></a></td>
			<th class="list_bg" width="30%" align="center"><a href="admin.php?controller=admin_member&action=keys_index&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><b>绑定用户</b></a></td>
			<th class="list_bg" align="center"><b>操作</b></td>
		</tr>		
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allkeys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td width="30%"><?php echo $this->_tpl_vars['allkeys'][$this->_sections['t']['index']]['keyid']; ?>
</td>
			<td width="30%"><?php if (! $this->_tpl_vars['allkeys'][$this->_sections['t']['index']]['username']): ?>未绑定<?php else: ?><?php echo $this->_tpl_vars['allkeys'][$this->_sections['t']['index']]['username']; ?>
<?php endif; ?></td>
			<td >
			
			<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=keybinduser&keyid=<?php echo $this->_tpl_vars['allkeys'][$this->_sections['t']['index']]['id']; ?>
">修改</a> 
			 | <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif" width="16" height="16" hspace="5" border="0" align="absmiddle"><a href="#" onClick="if(!confirm('您确定要删除key？')) {return false;} else { location.href='admin.php?controller=admin_member&action=keys_delete&id=<?php echo $this->_tpl_vars['allkeys'][$this->_sections['t']['index']]['id']; ?>
';}">删除</a>
			
			</td>
		</tr>
		<?php endfor; endif; ?>
		
				
                <tr>
				<td colspan="1"><input type="button"  value="导入USBKEY" onclick="javascript:document.location='admin.php?controller=admin_member&action=importusbkey';" class="an_06">
		</td>
	           <td  colspan="3" align="right">
		   			共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&action=keys_index&page='+this.value;">页
		   </td>
		</tr>
		
		</TBODY>
              </TABLE>	</td>
  </tr>
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


