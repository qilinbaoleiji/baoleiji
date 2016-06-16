<?php /* Smarty version 2.6.18, created on 2013-12-31 10:36:01
         compiled from sqlacct.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
</head>
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_sqlaccount&action=<?php echo $this->_tpl_vars['action']; ?>
";
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
	//alert(document.search.action);
	//return false;
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div></td></tr>
 
   <tr>
    <td class="main_content">
<form action="admin.php?controller=admin_sqlaccount&action=<?php echo $this->_tpl_vars['action']; ?>
" method="post" name="search" >

日期：<input type="text" class="wbk"  name="f_rangeStart" size="20" id="f_rangeStart" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
<!-- 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="12" id="f_rangeEnd" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">

     &nbsp;&nbsp;状态：<select  class="wbk"  name="authenticationstatus" >
     <option value="" ></option>
     <option value="1">成功</option>
     <option value="0">失败</option>
     </select>
	  -->
</form> 
	  </td>
  </tr>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
//cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");


</script>
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=day&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >日期</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=db_type&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >数据库类型</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >用户</a></th>
						<th class="list_bg"   width="15%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=total&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >登录次数</a></th>
						<th class="list_bg"   width="15%"><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&orderby1=sqlcmd&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >sql指令</a></th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['alllog']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&day=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['day']; ?>
"><?php if ($this->_tpl_vars['action'] == 'week'): ?><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['from']; ?>
/<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['to']; ?>
<?php else: ?><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['day']; ?>
<?php endif; ?></a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&ip=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['server']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['server']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&db_type=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['db_type']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['db_type']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&user=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['user']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['user']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&total=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['total']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['total']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action=<?php echo $this->_tpl_vars['action']; ?>
&sqlcmd=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sqlcmd']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sqlcmd']; ?>
</a></td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="12" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['log_num']; ?>
<?php echo $this->_tpl_vars['language']['item']; ?>
<?php echo $this->_tpl_vars['language']['Log']; ?>
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
--><?php if (! $this->_tpl_vars['str']): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><?php echo $this->_tpl_vars['language']['ExcelExporttoExcel']; ?>
Excel</a> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" target="hide">导出到HTML</a><?php endif; ?>   
						</td>
					</tr>
					<?php if (0 && $this->_tpl_vars['str']): ?>
					<tr><td colspan="12" align="right"><?php echo $this->_tpl_vars['language']['ExcelExporttoExcel']; ?>
Excel:<?php echo $this->_tpl_vars['str']; ?>
 </td></tr>
					<tr><td colspan="12" align="right">导出到HTML:<?php echo $this->_tpl_vars['strhtml']; ?>
</td></tr>
					<?php endif; ?>
				</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

