<?php /* Smarty version 2.6.18, created on 2014-07-03 00:06:57
         compiled from adminlog_report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'adminlog_report.tpl', 76, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
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
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有<?php echo $this->_tpl_vars['language']['select']; ?>
任何<?php echo $this->_tpl_vars['language']['User']; ?>
！");
		return false;
	}
	function searchit(){
		document.search.action = "admin.php?controller=admin_reports&action=admin_log";
		document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
		document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
		document.search.action += "&administrator="+document.search.administrator.value;
		document.search.action += "&luser="+document.search.luser.value;
		document.search.action += "&resource_user="+document.search.resource_user.value;
		document.search.action += "&usergroup="+document.search.usergroup.value;
		document.search.submit();
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
   <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=systemaccount">系统账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=appaccount">应用账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=admin_log">变更报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
			<tr><td class="main_content" >
			<form name ='search' action='admin.php?controller=admin_log&action=adminlog' method=post>
管理员:<input  type="text" class="wbk" name="administrator" size="13" id="administrator"   />&nbsp;&nbsp;
运维用户:<input  type="text" class="wbk" name="luser" size="13" id="luser"   />&nbsp;&nbsp;
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
			<option value="<?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['GroupName']; ?>
</option>
			<?php endfor; endif; ?>
		</select>
资源用户:<input  type="text" class="wbk" name="resource_user" size="13" id="resource_user"   />&nbsp;&nbsp;
<?php echo $this->_tpl_vars['language']['Starttime']; ?>
：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeStart'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">


 <?php echo $this->_tpl_vars['language']['Endtime']; ?>
：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeEnd'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
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
	<tr>
		<td>	
			<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
					<tr>
						<th class="list_bg"  width="8%">序号</th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=administrator&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Administrator']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=luser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['WebUser']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</a></th>	
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=luser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >别名</a></th>	
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=luser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维组</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=action&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=resource&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >资源</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=resource_user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >资源<?php echo $this->_tpl_vars['language']['User']; ?>
</a></th>
						<th class="list_bg"  ><a href="admin.php?controller=admin_reports&action=admin_log&orderby1=optime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['OperateTime']; ?>
</a></th>
					</tr>
					<form name="member_list" action="admin.php?controller=admin_reports&action=admin_log" method="post">
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allmember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td><?php echo $this->_sections['t']['index']+1; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['administrator']; ?>
</td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['luser']): ?><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['luser']; ?>
<?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['realname']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['groupname']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['action']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['resource']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['resource_user']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['optime']; ?>
</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="9" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
  导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/html.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/word.png" border=0></a> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/pdf.png" border=0></a> <?php if ($this->_tpl_vars['admin_level'] == 1): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&delete=1"></a><?php endif; ?>
						</td>
					</tr>
					
					</form>
					
				</table>
		</td>
	  </tr>
	</table>
	
</body>
</html>

