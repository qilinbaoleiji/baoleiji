<?php /* Smarty version 2.6.18, created on 2014-07-01 11:43:32
         compiled from as400session_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_as400&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
";
	document.search.action += "&addr="+document.search.ip.value;
	document.search.action += "&user="+document.search.user.value;
	document.search.action += "&usergroup="+document.search.usergroup.value;
	document.search.action += "&start1="+document.search.f_rangeStart.value;
	document.search.action += "&start2="+document.search.f_rangeEnd.value;
	
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/border-radius.css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F1F1F1"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">Telnet/SSH</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_sftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">SFTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">FTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
<?php if ($_SESSION['ADMIN_LEVEL'] != 0): ?>
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_as400&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">AS400</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li> 
<?php endif; ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_rdp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">RDP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_vnc&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">VNC</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
<?php if ($this->_tpl_vars['backupdb_id']): ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_apppub&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_x11&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">X11</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=login4approve">登录审批</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
</ul>
</div></td></tr>

 <tr>
        <td >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content"><form action="admin.php?controller=admin_sqlserver&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
" method="post" name="search" >
  <tr>
    <td></td>
    <td>
设备地址：<input type="text" class="wbk" name="ip"  size="13" />
用户：<input type="text" class="wbk" name="user" size="13" />&nbsp;运维组:<select name='usergroup' id="usergroup">
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
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="" />
 <input type="button" onClick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd" value="" />
 <input type="button" onClick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">
	  &nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</td>
  </tr></form> 
</table>
					
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
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"    width="5%"><a href="admin.php?controller=admin_as400&orderby1=cli_addr&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['SourceAddress']; ?>
</a></th>
						<th class="list_bg"    width="5%"><a href="admin.php?controller=admin_as400&orderby1=addr&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['DeviceAddress']; ?>
</a></th>
						<th class="list_bg"   width="5%"><a href="admin.php?controller=admin_as400&orderby1=user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['User']; ?>
</a></th>
						<th class="list_bg"   width="7%"><a href="admin.php?controller=admin_as400&orderby1=start&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['StartTime']; ?>
</a></th>
						<th class="list_bg"  width="7%"><a href="admin.php?controller=admin_as400&orderby1=end&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['EndTime']; ?>
</a></th>
						<th class="list_bg"    width="19%"><?php echo $this->_tpl_vars['language']['Detail']; ?>
</th>
						
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
						<td><a href="admin.php?controller=admin_as400&cli_addr=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['cli_addr']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['cli_addr']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_as400&addr=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['addr']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['addr']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_as400&user=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
</a></td>
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['start']; ?>
</ td>
						<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['end']; ?>
</td>
						<td style="TEXT-ALIGN: left;"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/replay.gif" width="16" height="16" align="absmiddle"><?php echo $this->_tpl_vars['language']['Replay']; ?>
(<a href="#" onClick="window.open('admin.php?controller=admin_as400&action=replay&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
','','menubar=no,toolbar=no,resizable=yes,height=700,width=700')">Web</a>|<a href="admin.php?controller=admin_as400&action=replay&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&tool=putty.Putty" target="hide" >putty</a> | <a href="admin.php?controller=admin_as400&action=replay&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&tool=securecrt.SecureCRT" target="hide" >securecrt</a>)&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/file.gif" width="16" height="16" align="absmiddle"><a href="#" onclick=window.open("admin.php?controller=admin_as400&action=download&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&start_page=1")><?php echo $this->_tpl_vars['language']['File']; ?>
</a>&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/cmd.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_as400&action=view&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&cid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub'][$this->_sections['g']['index']]['parent_cmd']; ?>
&command=<?php echo $this->_tpl_vars['command']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['language']['View']; ?>
</a>
						&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1-1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_session&desc=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['desc']; ?>
&action=logindesc&type=as400&sessionid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
" target="hide" ><font style="color:<?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['desc']): ?>red<?php else: ?>black<?php endif; ?>">备注</font></a>
						<?php if (0): ?> &nbsp;|  <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_as400&action=del_session&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a><?php endif; ?>
						
						</td>
					</tr>
						<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							
							<tr <?php if ($this->_sections['g']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
									<td>子<?php echo $this->_tpl_vars['language']['Session']; ?>
</td>
									<td ><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub'][$this->_sections['g']['index']]['addr']; ?>
</td>
									<td colspan=5><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub'][$this->_sections['g']['index']]['type']; ?>
</td>
									<td style="TEXT-ALIGN: left;"><?php if (! $this->_tpl_vars['backupdb_id']): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico2.gif" width="16" height="16" align="absmiddle"><a href="#" onClick="window.open('admin.php?controller=admin_as400&action=replay&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&cid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub'][$this->_sections['g']['index']]['parent_cmd']; ?>
','','menubar=no,toolbar=no,resizable=yes,height=700,width=700')"><?php echo $this->_tpl_vars['language']['Replay']; ?>
</a><?php endif; ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ckico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_as400&action=view&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&cid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sub'][$this->_sections['g']['index']]['parent_cmd']; ?>
"><?php echo $this->_tpl_vars['language']['View']; ?>
</a><?php if ($this->_tpl_vars['admin_level'] == 2): ?> <?php if (! $this->_tpl_vars['backupdb_id']): ?>| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_as400&action=del_session&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a><?php endif; ?><?php endif; ?></td>
								</tr>
						<?php endfor; endif; ?>

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

