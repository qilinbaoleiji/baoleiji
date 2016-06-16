<?php /* Smarty version 2.6.18, created on 2014-07-03 19:10:50
         compiled from adminlog_statistic.tpl */ ?>
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
		document.search.action = "<?php echo $this->_tpl_vars['curr_url']; ?>
";
		document.search.action += "&luser="+document.search.luser.value;
		document.search.action += "&operation="+document.search.operation.value;
		document.search.action += "&operation="+document.search.operation.value;
		document.search.action += "&administrator="+document.search.administrator.value;
		document.search.action += "&resource_user="+document.search.resource_user.value;
		document.search.action += "&resource="+document.search.resource.value;
		document.search.action += "&start="+document.search.start.value;
		document.search.action += "&end="+document.search.end.value;
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
 
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="#">系统操作</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search_diy">自定义报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_reports&action=<?php if ($_GET['dateinterval'] == 'diy'): ?>report_search_diy<?php else: ?>report_search<?php endif; ?>&back=1"><IMG src="./template/admin/images/back1.png" width="80" height="25" border="0"></A></span>
</div></td></tr>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  
	  
	  <tr>
		<td class="" >
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" >
			<tr><td>
			<form name ='search' action='admin.php?controller=admin_log&action=adminlog' method=post>
			<?php echo $this->_tpl_vars['language']['WebUser']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
：<input type="text" class="wbk" name="luser">
			<?php echo $this->_tpl_vars['language']['Operate']; ?>
：<input type="text" class="wbk" name="operation">
			<?php echo $this->_tpl_vars['language']['Administrator']; ?>
：<input type="text" class="wbk" name="administrator">&nbsp;&nbsp;
			资源：<input type="text" class="wbk" name="resource">&nbsp;&nbsp;
			资源用户：<input type="text" class="wbk" name="resource_user">&nbsp;&nbsp;
			<?php echo $this->_tpl_vars['language']['Starttime']; ?>
：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="<?php echo $this->_tpl_vars['f_rangeStart']; ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
 <?php echo $this->_tpl_vars['language']['Endtime']; ?>
：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd"  value="<?php echo $this->_tpl_vars['f_rangeEnd']; ?>
" />
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">&nbsp;&nbsp;
 <input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
			</form>
			</td></tr>
	<tr>
		<td>	
			<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
					<tr>
						<th class="list_bg"  width="8%"><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=adminlog&orderby1=administrator&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Administrator']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=adminlog&orderby1=luser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['WebUser']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=adminlog&orderby1=action&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=admin_log&orderby1=resource&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >资源</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=admin_log&orderby1=resource_user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >资源<?php echo $this->_tpl_vars['language']['User']; ?>
</a></th>
						<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_log&action=admin_log&orderby1=result&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >结果</a></th>
						<th class="list_bg"  ><a href="admin.php?controller=admin_log&action=adminlog&orderby1=optime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['OperateTime']; ?>
</a></th>
					</tr>
					<form name="member_list" action="admin.php?controller=admin_log&action=delete_adminlog" method="post">
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
						<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['id']; ?>
"></td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['administrator']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['luser']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['action']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['resource']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['resource_user']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['result']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['optime']; ?>
</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="4" align="left">
						</td>
						<td colspan="4" align="right">
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

						</td>
					</tr>
					
					</form>
					
				</table>
			  </td>
			</tr>
		  </table>
		</td>
	  </tr>
	</table>
	
</body>
</html>

