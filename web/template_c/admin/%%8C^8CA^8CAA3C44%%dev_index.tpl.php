<?php /* Smarty version 2.6.18, created on 2014-07-03 00:09:24
         compiled from dev_index.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
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
<script>
function searchit(){
	document.f1.action = "admin.php?controller=admin_pro&action=dev_index";
	document.f1.action += "&ip="+document.f1.ip.value;
	document.f1.action += "&hostname="+document.f1.hostname.value;
	return true;
}
</script>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
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
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=logs_index">改密日志</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
<?php else: ?>
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=resource_group">系统用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥上传</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autotemplate">巡检脚本</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
<?php endif; ?>
</ul>
</div></td></tr>

  <tr>
	<td class="" colspan = "7"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="main_content">

                <TBODY>
				 <TR>
                    <TD >
					<form name ='f1' action='admin.php?controller=admin_pro&action=dev_index' method=post>
					IP<input type="text" class="wbk" name="ip">
					主机名<input type="text" class="wbk" name="hostname">
					&nbsp;&nbsp;<input  type="submit" value=" 搜索 " onclick="return searchit();" class="bnnew2">
					</form>
					</TD>
                  </TR>
				  </table></td></tr>
                  <TR><td>
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
				  <tr>
                    <th class="list_bg"  width="15%"><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">服务器地址</a></th>
                    <th class="list_bg" width="20%"><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">主机名</a></th>
					
                    <th class="list_bg"  width="10%"><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=device_type&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">系统</a></th>
                    <th class="list_bg" width="10%"><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=groupid&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">设备组</a></th>
					<th class="list_bg"  width="30%">操作</TD>
                  </TR>
            </tr>
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
			<tr  <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ct'] > 0 || ( $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['asset_warrantdate'] != '0000-00-00 00:00:00' && $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['warrantdays'] < 0 )): ?>bgcolor="red" <?php elseif (( $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['asset_warrantdate'] != '0000-00-00 00:00:00' && $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['warrantdays'] < 30 )): ?>bgcolor="yellow"<?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><span  title="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
" ><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
</span></td>
				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_type']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['groupname']; ?>
</td>
				<td>
				
					<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 4): ?><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=dev_edit&gid=<?php echo $this->_tpl_vars['gid']; ?>
&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'>修改</a>
					
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/left_dot1.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=devpass_index&ip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
&serverid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
'>用户(<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['userct']): ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['userct']; ?>
<?php else: ?>0<?php endif; ?>)</a>
					
					
															
					<?php endif; ?>
					<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 4): ?>
					
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=dev_del&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
';}">删除</a>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['gid']): ?>
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=dev_delfromgroup&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
';}">从当前组删除</a>
					<?php endif; ?>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			
                <tr>

	           <td  colspan="3" align="left">
			   <?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 4): ?>
			   <input type="button"  value="添加" onClick="location.href='admin.php?controller=admin_pro&action=dev_edit&gid=<?php echo $this->_tpl_vars['gid']; ?>
'" class="an_02">
			   &nbsp;&nbsp;<input type="button"  value="批量添加" onClick="location.href='admin.php?controller=admin_pro&action=devbatchadd&gid=<?php echo $this->_tpl_vars['gid']; ?>
'" class="an_02">
			   &nbsp;&nbsp;<input type="button"  value="批量修改" onClick="window.open('admin.php?controller=admin_pro&action=devbatchdel&gid=<?php echo $this->_tpl_vars['gid']; ?>
','new');" class="an_02">
			   &nbsp;&nbsp;<input type="button"  value="导入" onClick="location.href='admin.php?controller=admin_pro&action=devimport&gid=<?php echo $this->_tpl_vars['gid']; ?>
'" class="an_02">
				
				<?php if ($this->_tpl_vars['gid']): ?>
				<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
				&nbsp;&nbsp;
				
				<input type="button"  value="添加已有资源" onClick="location.href='admin.php?controller=admin_pro&action=groupadddev&gid=<?php echo $this->_tpl_vars['gid']; ?>
'" class="an_06">
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				<input  type="button"  value="导出" onClick="location.href='<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=3'" class="an_02">
		   </td>

		    <td  colspan="4" align="right">
		   			&nbsp&nbsp;&nbsp;共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_index&page='+this.value;">页&nbsp;&nbsp;&nbsp;<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>  导出：<a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&derive=1" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/excel.png" border=0></a><?php endif; ?>
		   </td>
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

window.parent.menu.document.getElementById('devtree').style.display='';
window.parent.menu.document.getElementById('ldaptree').style.display='none';
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


