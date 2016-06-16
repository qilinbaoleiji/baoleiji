<?php /* Smarty version 2.6.18, created on 2014-06-20 13:24:06
         compiled from system_alert.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>Audit<?php echo $this->_tpl_vars['language']['List']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />


<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
<script type="text/javascript">
function changetype(sid){
document.getElementById(sid).checked=true;
}
function searchit(){
	document.search.action = "admin.php?controller=admin_status&action=system_alert";
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul><li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_log">同步日志</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_status&action=system_alert">系统告警</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>



  <tr>
    <td class="main_content">
<form action="<?php echo $this->_tpl_vars['curr_url']; ?>
" method="post" name="search" >
<?php echo $this->_tpl_vars['language']['Starttime']; ?>
：<input type="text" class="wbk"  name="f_rangeStart" size="16" id="f_rangeStart" value="<?php echo $this->_tpl_vars['f_rangeStart']; ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">


 <?php echo $this->_tpl_vars['language']['Endtime']; ?>
：
<input  type="text" class="wbk" name="f_rangeEnd" size="16" id="f_rangeEnd"  value="<?php echo $this->_tpl_vars['f_rangeEnd']; ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
 &nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</form> 
	  </td>
  </tr>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: false
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d");
cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d");
</script>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"   width="5%">序号</th>
						<th class="list_bg"   width="50%"><a href="admin.php?controller=admin_status&action=system_alert&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >内容</a></th>
						
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_status&action=system_alert&orderby1=protocol&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >当前值</a></th>						
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_status&action=system_alert&orderby1=local_user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >时间</a></th>
						
						<th class="list_bg"   width="5%"><a href="admin.php?controller=admin_status&action=system_alert&orderby1=mail_status&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >发送邮件</a></th>
						<th class="list_bg"   width="5%"><a href="admin.php?controller=admin_status&action=system_alert&orderby1=fort_user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >发送短信</a></th>
					
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['reports']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<td width="10%"><?php echo $this->_sections['t']['index']+1; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['context']; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['value']; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['datetime']; ?>
</td>
						<td width="10%"><?php if ($this->_tpl_vars['reports'][$this->_sections['t']['index']]['mail_status']): ?>成功<?php else: ?>失败<?php endif; ?></td>
						<td width="10%"><?php if ($this->_tpl_vars['reports'][$this->_sections['t']['index']]['sms_status']): ?>成功<?php else: ?>失败<?php endif; ?></td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="12" align="right">
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
 <!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
-->   导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/html.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/word.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/pdf.png" border=0></a> <?php if ($this->_tpl_vars['admin_level'] == 1): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&delete=1"></a><?php endif; ?>
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
  <?php if ($this->_tpl_vars['data']): ?>
  <tr><td class="main_content"><img src="include/pChart/graphgenerate.php?<?php echo $this->_tpl_vars['data']; ?>
<?php echo $this->_tpl_vars['info']; ?>
graphtype=pie"</td></tr>
  <tr><td class="main_content"><img src="include/pChart/graphgenerate.php?<?php echo $this->_tpl_vars['data']; ?>
<?php echo $this->_tpl_vars['info']; ?>
graphtype=bar"</td></tr>
  <?php endif; ?>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

