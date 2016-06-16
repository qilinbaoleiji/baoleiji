<?php /* Smarty version 2.6.18, created on 2014-07-03 00:06:54
         compiled from systemaccount.tpl */ ?>
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
	document.search.action = "admin.php?controller=admin_reports&action=systemaccount";
	document.search.action += "&device_type="+document.search.device_type.value;
	document.search.action += "&login_method="+document.search.login_method.value;
	document.search.action += "&ip="+document.search.ip.value;
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
<ul>
 

	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=systempriority_search">系统权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=apppriority_search">应用权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=systemaccount">系统账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=appaccount">应用账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=admin_log">变更报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>


<tr>
    <td class="main_content">
			<form name ='search' action='admin.php?controller=admin_reports&action=systemaccount' method=post>
			
系统：<select  class="wbk"  name="device_type" onchange="">
			<option value="0" >全部</option>
		<?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['alltem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>
			<?php if ($this->_tpl_vars['alltem'][$this->_sections['d']['index']]['device_type'] != ''): ?>
			<OPTION id ="<?php echo $this->_tpl_vars['alltem'][$this->_sections['d']['index']]['device_type']; ?>
" VALUE="<?php echo $this->_tpl_vars['alltem'][$this->_sections['d']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['alltem'][$this->_sections['d']['index']]['id'] == $this->_tpl_vars['device_type']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['alltem'][$this->_sections['d']['index']]['device_type']; ?>
</option>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select> &nbsp;&nbsp;
协议：<select  class="wbk"  name="login_method" onchange="">
			<option value="0" >全部</option>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['alltem']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['alltem'][$this->_sections['g']['index']]['login_method'] != ''): ?>
			<OPTION id ="<?php echo $this->_tpl_vars['alltem'][$this->_sections['g']['index']]['login_method']; ?>
" VALUE="<?php echo $this->_tpl_vars['alltem'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['alltem'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['login_method']): ?>selected<?php endif; ?>><?php if ($this->_tpl_vars['alltem'][$this->_sections['g']['index']]['login_method'] == 'apppub'): ?>应用发布<?php else: ?><?php echo $this->_tpl_vars['alltem'][$this->_sections['g']['index']]['login_method']; ?>
<?php endif; ?></option>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select> &nbsp;&nbsp;
IP：
<input  type="text" class="wbk" name="ip" size="13"  value="<?php echo $this->_tpl_vars['ip']; ?>
" />
 &nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: false
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d");
cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d");
</script>
			</form>
			</td></tr>
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
 
					<tr>
						<th class="list_bg" width="10%">序号</th>
						<th class="list_bg" width="10%"><a href="admin.php?controller=admin_reports&action=systemaccount&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器IP</a></th>
						
						<th class="list_bg" width="10%"><a href="admin.php?controller=admin_reports&action=systemaccount&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >主机名</a></th>						
						<th class="list_bg" width="10%"><a href="admin.php?controller=admin_reports&action=systemaccount&orderby1=device_type&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >系统</a></th>
						
						<th class="list_bg" width="10%"><a href="admin.php?controller=admin_reports&action=systemaccount&orderby1=login_method&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >协议</a></th>
						<th class="list_bg" width="10%"><a href="admin.php?controller=admin_reports&action=systemaccount&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >系统用户</a></th>					
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
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['hostname']; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['device_type_name']; ?>
</td>
						<td width="10%"><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['login_method_name']; ?>
</td>
						<td width="10%"><?php if ($this->_tpl_vars['reports'][$this->_sections['t']['index']]['username']): ?><?php echo $this->_tpl_vars['reports'][$this->_sections['t']['index']]['username']; ?>
<?php else: ?>空用户<?php endif; ?></td>
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

