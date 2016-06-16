<?php /* Smarty version 2.6.18, created on 2014-07-03 00:08:40
         compiled from systempriority.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=systempriority_search">系统权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=apppriority_search">应用权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
   <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=systemaccount">系统账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=appaccount">应用账号</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=admin_log">变更报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	
 
  

  <tr>
	<td class="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">

                <TBODY>
				
                  <TR>
					<th class="list_bg" >序号</TD>
					<?php if ($this->_tpl_vars['type'] == 'luser'): ?>
                    <th class="list_bg"  width="12%"><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维用户</a></TD>
					 <th class="list_bg"  width="12%"><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >别名</a></TD>
					<?php elseif ($this->_tpl_vars['type'] == 'lgroup'): ?>
					<th class="list_bg"  width="12%"><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=gname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['UserGroup']; ?>
</a></TD>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['type'] == 'luser'): ?><th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维组</a></TD><?php endif; ?>
                    <th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['device']; ?>
IP</a></TD>
                    <th class="list_bg"  width="12%"><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['System']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=ludfcg,lgfcg,lgdfcg&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Black']; ?>
</a></TD>
					<th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=ludpolicyname,lgpolicyname,lgdpolicyname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['WeekTimepolicy']; ?>
</a></TD>
					<th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=ludsourceip,lgsourceip,ldgsourceip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >来源IP</a></TD>
					<th class="list_bg" width="9%">自动为超级用户</TD>
					<th class="list_bg" width="9%">SYSLOG告警</TD>					
					<th class="list_bg" >Mail告警</TD>
					<th class="list_bg" >账号锁定</TD>
					<?php if ($this->_tpl_vars['type'] == 'user'): ?><th class="list_bg" ><a href="admin.php?controller=admin_reports&action=systempriority&orderby1=lastdate&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['Logintime']; ?>
</TD><?php endif; ?>
					<th class="list_bg" >协议</TD>
                  </TR>

            </tr>
			<form name="member_list" action="admin.php?controller=admin_pro&action=devpass_del&ip=<?php echo $this->_tpl_vars['alldev'][0]['device_ip']; ?>
&serverid=<?php echo $this->_tpl_vars['serverid']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
" method="post">
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['alldev']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ct'] > 0): ?>bgcolor="red" <?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><?php echo $this->_sections['t']['index']+1; ?>
</td>
				<?php if ($this->_tpl_vars['type'] == 'luser'): ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['webuser']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['webrealname']; ?>
</td>
				<?php elseif ($this->_tpl_vars['type'] == 'lgroup'): ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['gname']; ?>
</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['type'] == 'luser'): ?><td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['usergroup']; ?>
</td><?php endif; ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['forbidden_commands_groups']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['policyname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['sourceip']; ?>
</td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['autosu']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['syslogalert']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['mailalert']): ?>是<?php else: ?>否<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['loginlock']): ?>是<?php else: ?>否<?php endif; ?></td>
				<?php if ($this->_tpl_vars['type'] == 'user'): ?><td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['lastdate']; ?>
</td><?php endif; ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method']; ?>
</td>
				
			</tr>
			<?php endfor; endif; ?>			
                <tr>				
	           <td  colspan="14" align="right">
		   			<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_index&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
  导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/html.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/word.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/pdf.png" border=0></a> <?php if ($this->_tpl_vars['admin_level'] == 1): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&delete=1"></a><?php endif; ?>
		   </td>
		</tr>
		</form>
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

