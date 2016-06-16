<?php /* Smarty version 2.6.18, created on 2014-05-07 14:26:16
         compiled from session_view.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">Telnet/SSH</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_sftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">SFTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ftp&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">FTP</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 0): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_as400&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">AS400</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
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
</ul><span class="back_img"><A href="admin.php?controller=admin_session<?php if (! $this->_tpl_vars['subsession']): ?>&action=<?php echo $this->_tpl_vars['action']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['jumpsession']): ?>&subsession=1<?php endif; ?>&sid=<?php echo $this->_tpl_vars['sid']; ?>
&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="5">
 
   <tr class="main_content">
    <td>
<select  class="wbk"  id="app_act" style="display:none"><option value="applet" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'applet'): ?>selected<?php endif; ?>>applet</option><option value="activeX" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'activeX'): ?>selected<?php endif; ?>>activeX</option></select>
					
			</td><td align="right"></td>
  </tr>
  <tr>
	<td colspan="2" class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
			<tr>
				<th class="list_bg"  width="20%"><?php echo $this->_tpl_vars['language']['ExcuteTime']; ?>
</th>
				<th class="list_bg"  width="40%"><?php echo $this->_tpl_vars['language']['Command']; ?>
</th>
				<th class="list_bg"  width="30%"><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allcommand']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr <?php if ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] == 2): ?>bgcolor="red"<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] == 3): ?>bgcolor="yellow"<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] == 4): ?>bgcolor="#0373BF"<?php elseif ($this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['dangerlevel'] == 1): ?>bgcolor="orange"<?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['at']; ?>
</ td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cmd']; ?>
</td>
				<td><?php if (! $this->_tpl_vars['backupdb_id']): ?>
				<?php if ($_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 10): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/down.gif" width="16" height="16" align="absmiddle"><a href="#" onclick=window.open("admin.php?controller=admin_session&action=download&sid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sid']; ?>
&start_page=1")><?php echo $this->_tpl_vars['language']['Download']; ?>
</a>  &nbsp;|<?php endif; ?> <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/cmd.png" width="16" height="16" align="absmiddle"><a id="p_<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
" onclick="return go('admin.php?controller=admin_session&action=replay&cid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
&sid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sid']; ?>
&tool=putty.Putty','p_<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
')" href="#" target="hide" >putty</a>   &nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/application_osx.png" width="16" height="16" align="absmiddle"><a  id="c_<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
" onclick="return go('admin.php?controller=admin_session&action=replay&cid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
&sid=<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['sid']; ?>
&tool=securecrt.SecureCRT','c_<?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['cid']; ?>
');" href="#" target="hide" >CRT</a>
				<?php endif; ?>
				</td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				<td colspan="12" align="right">
					<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['command_num']; ?>
<?php echo $this->_tpl_vars['language']['Command']; ?>
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
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_session&action=view&sid=<?php echo $this->_tpl_vars['sid']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><?php echo $this->_tpl_vars['language']['ExportresulttoExcel']; ?>
</a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" >导出到HTML</a>
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


</body>
<script language="javascript">
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
</script>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

