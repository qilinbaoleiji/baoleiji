<?php /* Smarty version 2.6.18, created on 2014-07-04 00:30:43
         compiled from loginacct_statistic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'loginacct_statistic.tpl', 116, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
	document.search.action = "<?php echo $this->_tpl_vars['curr_url']; ?>
";
	document.search.action += "&protocol="+document.search.protocol.options[document.search.protocol.options.selectedIndex].value;
	document.search.action += "&from="+document.search.from.value;
	document.search.action += "&serverip="+document.search.serverip.value;
	document.search.action += "&audituser="+document.search.audituser.value;
	document.search.action += "&systemuser="+document.search.systemuser.value;
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&usergroup="+document.search.usergroup.value;
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="#">授权明细</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search_diy">自定义报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_reports&action=<?php if ($_GET['dateinterval'] == 'diy'): ?>report_search_diy<?php else: ?>report_search<?php endif; ?>&back=1"><IMG src="./template/admin/images/back1.png" width="80" height="25" border="0"></A></span>
</div></td></tr>


 
   <tr>
    <td class="main_content">
<form action="admin.php?controller=admin_reports&action=loginacct" method="post" name="search" >
登录协议：<select  class="wbk"  name="protocol" >
<option value="" ></option>
<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['alltem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
<option value="<?php echo $this->_tpl_vars['alltem'][$this->_sections['p']['index']]['login_method']; ?>
"><?php echo $this->_tpl_vars['alltem'][$this->_sections['p']['index']]['login_method']; ?>
</option>
<?php endfor; endif; ?>
</select>
来源地址：<input type="text" class="wbk" size="13" name="from" />
主机地址：<input type="text" class="wbk" size="13" name="serverip" />
运维用户：<input type="text" class="wbk" size="8" name="audituser" />
运维组：<select name='usergroup' id="usergroup">
			<option value="">所有组</option>
			<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<option value="<?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['GroupName']; ?>
"><?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['GroupName']; ?>
</option>
			<?php endfor; endif; ?>
		</select>
系统用户：<input type="text" class="wbk" size="8" name="systemuser" />
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="10" id="f_rangeStart" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
<!-- 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd" value="" class="wbk"/>
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
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d");
//cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");


</script>
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=sourceip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['SourceAddress']; ?>
</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=auditip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >审计系统</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=serverip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Ipaddress']; ?>
</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=portocol&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >登录协议</a></th>
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >时间</a></th>
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=audituser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维账号</a></th>
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=audituser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >别名</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=audituser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维组</a></th>
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=systemuser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >系统用户</a></th>						
						<th class="list_bg"   width="10%"><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=authenticationstatus&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >状态</a></th>
						<th class="list_bg"   width=""><a href="admin.php?controller=admin_reports&action=loginacct&orderby1=failreason&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >出错原因</a></th>
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
	
						<td><a href="admin.php?controller=admin_reports&action=loginacct&from=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sourceip']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sourceip']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=loginacct&auditip=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['auditip']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['auditip']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=loginacct&serverip=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['serverip']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['serverip']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=loginacct&protocol=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['portocol']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['portocol']; ?>
</a></td>
						<td><?php echo ((is_array($_tmp=$this->_tpl_vars['alllog'][$this->_sections['t']['index']]['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M')); ?>
</td>
						<td><a href="admin.php?controller=admin_reports&action=loginacct&audituser=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['audituser']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['audituser']; ?>
</a></td>	
						<td><a href="admin.php?controller=admin_reports&action=loginacct&audituser=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['audituser']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['realname']; ?>
</a></td>	
						<td><a href="admin.php?controller=admin_reports&action=loginacct&systemuser=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['systemuser']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['groupname']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=loginacct&systemuser=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['systemuser']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['systemuser']; ?>
</a></td>
						<td><?php if ($this->_tpl_vars['alllog'][$this->_sections['t']['index']]['authenticationstatus']): ?>成功<?php else: ?>失败<?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['failreason']; ?>
</td>
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
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/html.png" border=0></a> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/word.png" border=0></a><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/pdf.png" border=0></a><?php endif; ?>   
						</td>
					</tr>
					<?php if (0 && $this->_tpl_vars['str']): ?>
					<tr><td colspan="12" align="right"><?php echo $this->_tpl_vars['language']['ExcelExporttoExcel']; ?>
Excel:<?php echo $this->_tpl_vars['str']; ?>
 </td></tr>
					<tr><td colspan="12" align="right">导出到HTML:<?php echo $this->_tpl_vars['strhtml']; ?>
</td></tr>
					<tr><td colspan="12" align="right">导出到DOC:<?php echo $this->_tpl_vars['strdoc']; ?>
</td></tr>
					<?php endif; ?>
				</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

