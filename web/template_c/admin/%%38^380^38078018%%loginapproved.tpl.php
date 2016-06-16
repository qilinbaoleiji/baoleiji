<?php /* Smarty version 2.6.18, created on 2014-07-01 13:33:29
         compiled from loginapproved.tpl */ ?>
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
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
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

</script>
<script>
	function searchit(){
		document.search.action = "admin.php?controller=admin_reports&action=loginapproved";
		document.search.action += "&webuser="+document.search.webuser.value;
		document.search.action += "&usergroup="+document.search.usergroup.value;
		document.search.action += "&ip="+document.search.ip.value;
		document.search.action += "&start="+document.search.f_rangeStart.value;
		document.search.submit();
		return true;
	}
	
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 2 || $_SESSION['ADMIN_LEVEL'] == 21 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=logintims">登录统计</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=loginacct">授权明细</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 2 || $_SESSION['ADMIN_LEVEL'] == 21 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=loginfailed">登录尝试</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=devloginreport">系统登录报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=apploginreport">应用登录报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=loginapproved">登录审批</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
<body>
	
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form name ='search' action='admin.php?controller=admin_member' method=post onsubmit="return searchit();">
  <tr>
    <td >
</td>
    <td >	
					用户名：<input type="text" name="webuser" size="13" class="wbk"/>
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
ip：<input type="text" name="ip" size="13" class="wbk"/>
系统用户名：<input type="text" name="username" size="13" class="wbk"/>
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="10" id="f_rangeStart" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">
					&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>

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
</form>	
</table>
</TD>
                  </TR>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_all" method="post">
					<tr>
						<th class="list_bg"  width="3%" ><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >用户名</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >别名</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >运维组</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >服务器IP</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >系统用户名</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >登录协议</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >申请时间</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >审批时间</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=approveuser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >申请人</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >登录时间</a></th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['approves']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td><?php if (( $_SESSION['ADMIN_LEVEL'] == 4 && ( ! $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] || $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] == 3 ) ) || ( $_SESSION['ADMIN_LEVEL'] == 1 ) || ( $_SESSION['ADMIN_LEVEL'] == 3 )): ?><?php if ($this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 10 && $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 2 && $this->_tpl_vars['approves'][$this->_sections['t']['index']]['level'] != 1): ?><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['uid']; ?>
"><?php endif; ?><?php endif; ?></td>			
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['webuser']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['realname']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['groupname']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['ip']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['username']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['login_method']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['applytime']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['approvetime']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['approveuser']; ?>
</td>
						<td><?php echo $this->_tpl_vars['approves'][$this->_sections['t']['index']]['logintime']; ?>
</td>
					</tr>
					<?php endfor; endif; ?>
					
					<tr>
						<td colspan="1" align="left">
							
						</td></form><form name="pageto" action="#" method="post">
						<td colspan="10" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
个/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) {window.location='admin.php?controller=admin_member&page='+this.value;return false;}else this.value=this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
<?php if (! $this->_tpl_vars['str']): ?>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><?php echo $this->_tpl_vars['language']['ExcelExporttoExcel']; ?>
Excel</a> <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" target="hide">导出到HTML</a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" >导出到DOC</a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" >导出到PDF</a><?php endif; ?>
							
						</td></form>
					</tr>
					
				
		  
					<tr>
						
					</tr>
				</table>
			
	  </table>
		</td>
	  </tr>
	</table>
	<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>

</body>
</html>

