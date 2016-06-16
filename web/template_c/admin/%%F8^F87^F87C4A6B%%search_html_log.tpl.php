<?php /* Smarty version 2.6.18, created on 2014-04-22 12:08:00
         compiled from search_html_log.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
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
<script>
function searchit(){
		document.search.action = "admin.php?controller=admin_session&action=search_html_log";
		document.search.action += "&ssh_or_rdp="+document.search.ssh_or_rdp.options[document.search.ssh_or_rdp.options.selectedIndex].value;
		document.search.action += "&content="+document.search.content.value;
		document.search.action += "&ip="+document.search.ip.value;
		document.search.action += "&remote_user="+document.search.remote_user.value;
		document.search.action += "&radius_user="+document.search.radius_user.value;
		document.search.action += "&start_date="+document.search.start_date.value;
		document.search.action += "&end_date="+document.search.end_date.value;
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=search">会话搜索</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=search_html_log">内容搜索</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	
  
  <tr>
    <td class="main_content">
<form name ='search' action='admin.php?controller=admin_session&action=search_html_log' method=post>
					<select name="ssh_or_rdp" id="ssh_or_rdp" >
					<option value="ssh" <?php if ($this->_tpl_vars['ssh_or_rdp'] == 'ssh'): ?>selected<?php endif; ?>>SSH/Telnet</option>
					<option value="rdp" <?php if ($this->_tpl_vars['ssh_or_rdp'] == 'rdp'): ?>selected<?php endif; ?>>RDP</option>
					</select>
					<?php echo $this->_tpl_vars['language']['Content']; ?>
<input type="text" class="wbk" size="13" name="content">
					IP<input type="text" class="wbk" name="ip" size="13">
					运维用户<input type="text" class="wbk" size="8" name="radius_user">
					本地用户<input type="text" class="wbk" size="8" name="remote_user">
					
	 
	  <input type="hidden" name="ac" value="1" />

     <?php echo $this->_tpl_vars['language']['Starttime']; ?>
：<input type="text" class="wbk" name="start_date" size="13" id="f_rangeStart" value="<?php echo $this->_tpl_vars['f_rangeStart']; ?>
" />
 <input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="bnnew2">
 <?php echo $this->_tpl_vars['language']['Endtime']; ?>
：
<input  type="text" class="wbk" name="end_date" size="13" id="f_rangeEnd"  value="<?php echo $this->_tpl_vars['f_rangeEnd']; ?>
" />
 <input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="bnnew2">
 <select  class="wbk"  id="app_act" style="display:none"><option value="applet" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'applet'): ?>selected<?php endif; ?>>applet</option><option value="activeX" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'activeX'): ?>selected<?php endif; ?>>activeX</option></select>&nbsp;&nbsp;<script language="javascript">
function go(url,iid){
	var app_act = document.getElementById('app_act').options[document.getElementById('app_act').options.selectedIndex].value;
	var hid = document.getElementById('hide');
	document.getElementById(iid).href=url+'&app_act='+app_act;
	//alert(hid.src);
	<?php if ($this->_tpl_vars['logindebug']): ?>
	window.open(document.getElementById(iid).href);
	<?php endif; ?>
	return true;	
}
<?php if ($this->_tpl_vars['member']['default_control'] == 0): ?>
	if(navigator.userAgent.indexOf("MSIE")>0) {
		document.getElementById('app_act').options.selectedIndex = 1;
	}
	<?php elseif ($this->_tpl_vars['member']['default_control'] == 1): ?>
		document.getElementById('app_act').options.selectedIndex = 0;
	<?php elseif ($this->_tpl_vars['member']['default_control'] == 2): ?>
		document.getElementById('app_act').options.selectedIndex = 1;
<?php endif; ?>
</script><input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</form> 
<script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");
</script>
	  </td>
  </tr>
  <tr>
	<td class="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">

                <TBODY>
				
  

					</TD>
                  </TR>
                  <TR>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['Session']; ?>
id</TD>
                    <th class="list_bg" >ip</TD>
                    <th class="list_bg" >本地用户</TD>
                    <th class="list_bg" >运维用户</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['SessionDate']; ?>
</TD>
					<?php if ($this->_tpl_vars['ssh_or_rdp'] != 'rdp'): ?>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['Log']; ?>
<?php echo $this->_tpl_vars['language']['File']; ?>
</TD>
                    <th class="list_bg" ><?php echo $this->_tpl_vars['language']['rows']; ?>
</TD>
					<?php else: ?>
					<th class="list_bg" >操作</TD>
					<?php endif; ?>
                  </TR>

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
			<tr <?php if ($this->_tpl_vars['alllog'][$this->_sections['t']['index']]['ct'] > 0): ?>bgcolor="red" <?php endif; ?>>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sid']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['user']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['luser']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['start']; ?>
</td>				
				<?php if ($this->_tpl_vars['ssh_or_rdp'] != 'rdp'): ?>
				<td><a href="admin.php?controller=admin_session&action=search_html_log_download&file=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['logfile']; ?>
&start_page=1&line=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['line_num']; ?>
" target="_blank"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['logfile']; ?>
</a></td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['line_num']; ?>
</td>
				<?php else: ?>
				<td><a  id="p_<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
" onClick="return go('admin.php?controller=admin_rdp&mstsc=1&sid=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sid']; ?>
','p_<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
')" href="#" target="hide">回放</a>&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie.png" width="16" height="16" align="absmiddle">
					<a href='admin.php?controller=admin_rdp&activex=1&sid=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sid']; ?>
' target="_blank">ACTIVEX</a>
					
						&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/input.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_rdp&activex=1&sid=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['sid']; ?>
&action=inputview" target="_blank">录入</a></TD>
				<?php endif; ?>
				
			</tr>
			<?php endfor; endif; ?>
			
               <tr>
						<td height="45" colspan="12" align="right" bgcolor="#FFFFFF">
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

							  <input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;" class="wbk">
							  <?php echo $this->_tpl_vars['language']['page']; ?>
&nbsp;  
						  <!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
--> 
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
						-->					  </td>
					</tr>
		</TBODY>
              </TABLE>
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

</script>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

