<?php /* Smarty version 2.6.18, created on 2014-07-01 13:36:49
         compiled from cmdcachereport.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Black']; ?>
<?php echo $this->_tpl_vars['language']['group']; ?>
<?php echo $this->_tpl_vars['language']['List']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_reports&action=cmdcachereport";
	document.search.action += "&usergroup="+document.search.usergroup.value;
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
</script>
<body>



	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=commandreport">命令总计</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cmdcachereport">命令统计</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cmdlistreport">命令列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=appreport&number=2">应用报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=sftpreport&number=3">SFTP<?php echo $this->_tpl_vars['language']['Command']; ?>
<?php echo $this->_tpl_vars['language']['report']; ?>
</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>	
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=ftpreport&number=6">FTP<?php echo $this->_tpl_vars['language']['Command']; ?>
<?php echo $this->_tpl_vars['language']['report']; ?>
</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_reports&action=forbidden_groups_list&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
 <tr>
    <td class="main_content">
<form action="<?php echo $this->_tpl_vars['curr_url']; ?>
" method="post" name="search" >
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
 &nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</form> 
	  </td>
  </tr>
  <tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="ip_list" action="admin.php?controller=admin_reports&action=del_cmdcache" method="post">
			<tr>
				<th class="list_bg"  width="15%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=cmd&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维用户</a></th>
				<th class="list_bg"  width="15%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=cmd&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >别名</a></th>
				<th class="list_bg"  width="15%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=groupname&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >运维组</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=gid&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >系统用户</a></th>				
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=gid&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >设备IP</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=gid&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >命令</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_reports&action=cmdcache&orderby1=gid&gid=<?php echo $this->_tpl_vars['gid']; ?>
&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >命令次数</a></th>
			
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
			<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['luser']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['realname']; ?>
</td>				
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['groupname']; ?>
</td>				
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['user']; ?>
</td>				
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['addr']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['ocmd']; ?>
</td>
				<td><?php echo $this->_tpl_vars['allcommand'][$this->_sections['t']['index']]['ct']; ?>
</td>
			</tr>
			<?php endfor; endif; ?>
			
			
			<tr>
			<td align="left" colspan="1">

			<input type="hidden" name="add" value="new" >
			</td>
				<td colspan="6" align="right">
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
<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_reports&action=cmdcache&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
<!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
-->   导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=2" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/html.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/word.png" border=0></a>  <a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=4" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/pdf.png" border=0></a> <?php if ($this->_tpl_vars['admin_level'] == 1): ?><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&delete=1" target="hide"></a><?php endif; ?>
				</td>
			</tr>
			</form>
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

