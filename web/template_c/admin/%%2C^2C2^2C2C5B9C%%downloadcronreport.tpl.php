<?php /* Smarty version 2.6.18, created on 2014-06-11 09:24:23
         compiled from downloadcronreport.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
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
</head>
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_reports&action=downloadcronreport";
	document.search.action += "&template="+document.search.template.options[document.search.template.options.selectedIndex].value;
	document.search.action += "&subject="+document.search.subject.value;
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
	document.search.submit();
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
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
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=configreport">报表配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cronreports">报表自动生成配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=downloadcronreport">下载报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cmdcache">命令Cache</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
   <tr>
    <td class="main_content">
<form action="admin.php?controller=admin_reports&action=downloadcronreport" method="post" name="search" >
标题：<input type="text" class="wbk" name="subject" />
模板：<select  class="wbk"  name="template" id="template">
				<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['templates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['templates'][$this->_sections['t']['index']]['name']; ?>
" <?php if ($this->_tpl_vars['downloadcronreport']['template'] == $this->_tpl_vars['templates'][$this->_sections['t']['index']]['name']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['templates'][$this->_sections['t']['index']]['title']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">
 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">
	&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
</form> 
	  </td>
  </tr>
<script type="text/javascript">
	var cal = Calendar.setup({
		onSelect: function(cal) { cal.hide() },
		showTime: true
	});
	cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
	cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");
</script>
  
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
		 <form name="member_list" action="admin.php?controller=admin_reports&action=crontabreportsdelete" method="post" >
					<tr>
					<th class="list_bg"  bgcolor="d9ecfa" width="3%">选</th>
						<th class="list_bg"  bgcolor="d9ecfa" width="8%"><a href="admin.php?controller=admin_reports&action=downloadcronreport&orderby1=subject&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >标题</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="20%"><a href="admin.php?controller=admin_reports&action=downloadcronreport&orderby1=createtime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >路径</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_reports&action=downloadcronreport&orderby1=cycle&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >开始</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_reports&action=downloadcronreport&orderby1=template&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >结束</a></th>	
						<th class="list_bg"  bgcolor="d9ecfa" width="5%">操作</th>
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
					<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
"></td>
						<td><a href="admin.php?controller=admin_reports&action=downloadcronreport&subject=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['title']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['title']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=downloadcronreport&createtime=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['filepath']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['filepath']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=downloadcronreport&cycle=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['start']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['start']; ?>
</a></td>
						<td><a href="admin.php?controller=admin_reports&action=downloadcronreport&template=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['end']; ?>
"><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['end']; ?>
</a></td>						
						<td>
						<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie.png' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_reports&action=downloadcronreport&derive=1&id=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
" target="hide">下载</a>
						</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
					<td colspan="3" align="left"><input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="my_confirm('删除选中的');if(chk_form()) document.member_list.action='admin.php?controller=admin_reports&action=crontabreportsdelete'; else return false;" class="an_02">
					</td>
					<td colspan="12" align="right">
						<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['log_num']; ?>
<?php echo $this->_tpl_vars['language']['item']; ?>
<?php echo $this->_tpl_vars['language']['Log']; ?>
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

					</td>
					</tr>
				</form>
				</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

