<?php /* Smarty version 2.6.18, created on 2014-05-04 12:28:10
         compiled from logs_index.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<SCRIPT language=javascript src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/calendar.js"></SCRIPT>
<script type="text/javascript">
function searchit(){
	document.f1.submit();	
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 	 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=password_cron">定时任务</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting_forpassword">自动备份</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=passdown">密码文件下载</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordcheck">密码校验</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=logs_index">改密日志</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
   <TR>
                    <TD colspan = "7" class="main_content">
					<form name ='f1' action='admin.php?controller=admin_pro&action=logs_index' method=post>
					设备IP<input type="text" class="wbk" name="ip">
					开始时间：<input value="<?php echo $this->_tpl_vars['start_time']; ?>
" id="start_time" name="start_time" onfocus="setday(this)">
					结束时间：<input value="<?php echo $this->_tpl_vars['end_time']; ?>
" id="end_time" name="end_time" onfocus="setday(this)">
					成功：<select  class="wbk"  name="success" ><option value="">请选择</option><option value="Yes">是</option><option value="No">否</option></select>
					&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
					</form>
					</TD>
                  </TR>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>
			<form name="member_list" action="admin.php?controller=admin_pro&action=logs_del" method="post">

                  <TR>
					<th class="list_bg" ></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=logs_index&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器地址</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=logs_index&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >用户名</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=logs_index&orderby1=update_success_flag&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >上次修改结果</a></TD>
                    <th class="list_bg" ><a href="admin.php?controller=admin_pro&action=logs_index&orderby1=time&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >时间</a></TD>
					<th class="list_bg" >操作</TD>
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
			<tr  <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
			<td><?php if ($this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 10 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 2 && $this->_tpl_vars['allmember'][$this->_sections['t']['index']]['level'] != 1): ?><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
"><?php endif; ?></td>
				<td> <?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['username']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['update_success_flag']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['time']; ?>
</td>
				<td><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=logs_del&id=<?php echo $this->_tpl_vars['alllog'][$this->_sections['t']['index']]['id']; ?>
';}">删除</a></td> 
			</tr>
			<?php endfor; endif; ?>

                <tr>
				<td colspan="2" align="left">
							<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="批量删除" onClick="my_confirm('批量删除');if(chk_form()) document.member_list.action='admin.php?controller=admin_pro&action=logs_del'; else return false;" class="an_02">
						</td>
	           <td  colspan="4" align="right">
		   			共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) {window.location='admin.php?controller=admin_pro&action=logs_index&page='+this.value;return false;}">页
		   </td>
		</tr>
		</form>
		</TBODY>
              </TABLE>	</td>
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


