<?php /* Smarty version 2.6.18, created on 2014-05-02 22:57:37
         compiled from vpnlogonline_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>会话列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_vpnlog";
	document.search.action += "&fromip="+document.search.fromip.value;
	document.search.action += "&toip="+document.search.toip.value;
	document.search.action += "&user="+document.search.user.value;
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
	document.search.submit();
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
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
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" >  <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_vpnlog&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
         <td >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
  <tr>
    <td></td>
    <td><form action="admin.php?controller=admin_vpnlog&action=online" method="post" name="search" >
来源地址：<input type="text" class="wbk" name="fromip"  size="13" />
目标地址：<input type="text" class="wbk" name="toip"  size="13" />
用户名：<input type="text" class="wbk" name="user" size="13" />
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="" />
 <input type="button" onClick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd" value=""/>
 <input type="button" onClick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</form> </td>
  </tr>
</table>  
    </td>
  </tr>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");


</script>
  
 <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
  
					<tr>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_vpnlog&action=online&orderby1=user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >用户</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="5%"><a href="admin.php?controller=admin_vpnlog&action=online&orderby1=src_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >源ip</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_vpnlog&action=online&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >目标ip</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_vpnlog&action=online&orderby1=in_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >开始时间</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_vpnlog&action=online&orderby1=out_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >结束时间</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%">操作</th>
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
						<td><a href="admin.php?controller=admin_vpnlog&action=online&user=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_vpnlog&action=online&fromip=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['src_ip']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['src_ip']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_vpnlog&action=online&toip=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['ip']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['ip']; ?>
</a></td>
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['in_time']; ?>
</ td>
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['out_time']; ?>
</td>
						<td><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_vpnlog&action=delon&id=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['id']; ?>
">删除</a></td>
					</tr>
						

					<?php endfor; endif; ?>
					<tr>
						<td colspan="6" align="right">
							共<?php echo $this->_tpl_vars['session_num']; ?>
条会话  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;">页 <!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
--> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide">导出当前结果为Excel</a> <?php if ($this->_tpl_vars['admin_level'] == 1): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&delete=1">删除当前结果</a><?php endif; ?>
						<!--
						<select  class="wbk"  name="table_name">
						<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['table_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option value="<?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
" <?php if ($this->_tpl_vars['table_list'][$this->_sections['t']['index']] == $this->_tpl_vars['now_table_name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
</option>
						<?php endfor; endif; ?>
						</select>
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


