<?php /* Smarty version 2.6.18, created on 2013-07-05 22:25:44
         compiled from member_list.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
		document.search.action = "admin.php?controller=admin_member";
		document.search.action += "&username="+document.search.username.value;
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
<body>
	
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form name ='search' action='admin.php?controller=admin_member' method=post>
  <tr>
    <td >
</td>
    <td >	
					用户名：<input type="text" name="username" size="12" class="wbk"/>&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>

					</td>
  </tr>
</form>	
</table>
</TD>
                  </TR>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_all" method="post">
					<tr>
						<th class="list_bg"  width="3%" ><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' ><?php echo $this->_tpl_vars['language']['Username']; ?>
</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >开始时间</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_member&orderby1=end_time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' ><?php echo $this->_tpl_vars['language']['EndTime']; ?>
</a></th>
						<th class="list_bg"  width="6%" ><a href='admin.php?controller=admin_member&orderby1=level&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >等级</a></th>
						<th class="list_bg"  width="24%" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
<?php echo $this->_tpl_vars['language']['Link']; ?>
</th>
					</tr>
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
					<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="dbe7f2"<?php endif; ?>>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 10 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 2 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 1): ?><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
"><?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['onlinenumber'] > 0): ?><a href='admin.php?controller=admin_member&action=online&username=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['username']; ?>
' ><img  border="0" src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/user_online.gif' title='在线' /></a><?php else: ?><img border="0" src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/user_offline.gif'  title='离线' /><?php endif; ?><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['username']; ?>
</td>
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['start_time']; ?>
</td>
						<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['end_time'] == '2037-01-01 00:00:00'): ?><?php echo $this->_tpl_vars['language']['AlwaysValid']; ?>
<?php else: ?><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['end_time']; ?>
<?php endif; ?></td>
						<td><a href='admin.php?controller=admin_member&level=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level']; ?>
' ><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 0): ?><?php echo $this->_tpl_vars['language']['common']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 1): ?><?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 3): ?><?php echo $this->_tpl_vars['language']['group']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php elseif ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] == 10): ?><?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
<?php else: ?><?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
<?php endif; ?></a></td>
						<td>
						<!--<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ckico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_dev&action=index&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['language']['Edit']; ?>
<?php echo $this->_tpl_vars['language']['device']; ?>
</a> |-->
						<?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['username'] != 'admin'): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=loginlock&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
&loginlock=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['loginlock']; ?>
"><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['loginlock'] == 1): ?><?php echo $this->_tpl_vars['language']['unlock']; ?>
<?php else: ?><?php echo $this->_tpl_vars['language']['Addlock']; ?>
<?php endif; ?></a> |<?php endif; ?>
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=edit&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['language']['Edit']; ?>
</a>  
						<?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 10 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 2 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 1): ?>|&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=delete&uid=<?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a><?php endif; ?> 						
						</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="4" align="left">
							<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
的<?php echo $this->_tpl_vars['language']['All']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
&nbsp;&nbsp;<input type="submit"  value="<?php echo $this->_tpl_vars['language']['UsersDelete']; ?>
" onClick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=delete_all'; else return false;" class="an_02">&nbsp;&nbsp;<input type="button"  value="<?php echo $this->_tpl_vars['language']['Add']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
" onClick="javascript:document.location='admin.php?controller=admin_member&action=add';" class="an_02">
						</td>
						<td colspan="2" align="right">
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
&nbsp;&nbsp;<br /><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><?php echo $this->_tpl_vars['language']['ExportresulttoExcel']; ?>
</a> 
						</td>
					</tr>
					
				
		  </form>
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

