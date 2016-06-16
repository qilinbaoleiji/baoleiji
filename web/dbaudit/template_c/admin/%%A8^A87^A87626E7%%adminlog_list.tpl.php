<?php /* Smarty version 2.6.18, created on 2013-07-18 22:23:48
         compiled from adminlog_list.tpl */ ?>
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
	function searchit(){
		document.search.action = "admin.php?controller=admin_log&action=adminlog";
		document.search.action += "&luser="+document.search.luser.value;
		document.search.action += "&operation="+document.search.operation.value;
		document.search.action += "&operation="+document.search.operation.value;
		document.search.action += "&administrator="+document.search.administrator.value;
		document.search.submit();
		//alert(document.search.action);
		//return false;
		return true;
	}
</script>
</head>

<body>
	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
	  
	  <tr>
		<td class="main_content" >
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" >
			<tr><td>
			<form name ='search' action='admin.php?controller=admin_log&action=adminlog' method=post>
			<?php echo $this->_tpl_vars['language']['WebUser']; ?>
<?php echo $this->_tpl_vars['language']['User']; ?>
：<input type="text" class="wbk" name="luser">
			<?php echo $this->_tpl_vars['language']['Operate']; ?>
：<input type="text" class="wbk" name="operation">
			<?php echo $this->_tpl_vars['language']['Administrator']; ?>
：<input type="text" class="wbk" name="administrator">&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
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
						<td><?php echo $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['optime']; ?>
</td>
						<td align="center">
					</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="4" align="left">
							<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox"><?php echo $this->_tpl_vars['language']['select']; ?>
<?php echo $this->_tpl_vars['language']['this']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
<?php echo $this->_tpl_vars['language']['displayed']; ?>
的<?php echo $this->_tpl_vars['language']['All']; ?>
&nbsp;&nbsp;<input type="submit"  value="批量删除所选记录" onclick="my_confirm('批量删除所选记录');if(chk_form()) document.member_list.action='admin.php?controller=admin_log&action=delete_adminlog'; else return false;" class="an_02">
						</td>
						<td colspan="3" align="right">
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

