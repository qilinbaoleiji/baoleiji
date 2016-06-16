<?php /* Smarty version 2.6.18, created on 2014-06-26 16:01:31
         compiled from devbatchdel.tpl */ ?>
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
	document.f1.action = "admin.php?controller=admin_pro&action=devbatchdel";
	document.f1.action += "&ip="+document.f1.ip.value;
	document.f1.action += "&hostname="+document.f1.hostname.value;
	document.f1.action += "&username="+document.f1.username.value;
	return true;
}
</script>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td class="" colspan = "7"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="main_content">

                <TBODY>
				 <TR>
                    <TD >
					<form name ='f1' action='admin.php?controller=admin_pro&action=devbatchdel' method=post>
					IP<input type="text" class="wbk" name="ip" value="<?php echo $this->_tpl_vars['ip']; ?>
">
					主机名<input type="text" class="wbk" name="hostname" value="<?php echo $this->_tpl_vars['hostname']; ?>
">
					账号<input type="text" class="wbk" name="username" value="<?php echo $this->_tpl_vars['username']; ?>
">
					&nbsp;&nbsp;<input  type="submit" value="搜索" onclick="return searchit();" class="bnnew2">
					</form>
					</TD>
                  </TR>
				  </table></td></tr>
                  <TR><td>
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
				  <tr>
					<th class="list_bg"  width="3%" ><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">服务器地址</a></th>
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">主机名</a></th>
					
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=device_type&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">系统</a></th>
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=groupid&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">设备组</a></th>
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=week&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">修改策略</a></th>
                    <th class="list_bg" ><a href = "admin.php?controller=admin_pro&action=dev_index&orderby1=monitor&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
">状态监控</a></th>
					<th class="list_bg" >操作</TD>
                  </TR>

            </tr>
			<form name ='dev' action='admin.php?controller=admin_pro&action=dodevbatchdel' method=post>
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
				<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<td><span  title="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
" ><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
</span></td>
				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_type']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['groupname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['method']; ?>
</td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['monitor'] == 1): ?>SNMP<?php elseif ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['monitor'] == 2): ?>登录<?php else: ?>关闭<?php endif; ?></td>
				<td>
				
					<?php if ($_SESSION['ADMIN_LEVEL'] == 1 || $_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 4): ?>
					
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/left_dot1.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=devpass_index&ip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
&serverid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&gid=<?php echo $this->_tpl_vars['gid']; ?>
'>用户(<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['userct']): ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['userct']; ?>
<?php else: ?>0<?php endif; ?>)</a>
					
	
					<?php endif; ?>
				</td> 
			</tr>
			<?php endfor; endif; ?>
			
                <tr>

	           <td  colspan="2" align="left">
			  <input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=document.dev.elements[i];if(e.name=='chk_member[]')e.checked=document.dev.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="批量删除" onClick="my_confirm('所有选中的主机和主机中的帐号都会被删除,确定要删除?');if(chk_form()) document.dev.action='admin.php?controller=admin_pro&action=dodevbatchdel'; else return false;" class="an_02">&nbsp;&nbsp;<input type="button"  value="批量移除" onClick="batchremove()" class="an_02">
		   </td>
				<td colspan="6" align="right">&nbsp&nbsp;&nbsp;共<?php echo $this->_tpl_vars['total']; ?>
个记录  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_index&page='+this.value;">页</td>
		   
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

function batchedit(){
	var ips = new Array();
	var ii=0;
	for(var i=0;i<document.dev.elements.length;i++){
		var e=document.dev.elements[i];
		if(e.name=='chk_member[]'&&e.checked){
			ips[ii++]=e.value;
		}
	}
	window.open('admin.php?controller=admin_pro&action=devbatchedit&ips='+ips.join(','));
}

function batchremove(){
	var ips = new Array();
	var ii=0;
	for(var i=0;i<document.dev.elements.length;i++){
		var e=document.dev.elements[i];
		if(e.name=='chk_member[]'&&e.checked){
			ips[ii++]=e.value;
		}
	}
	window.location='admin.php?controller=admin_pro&action=dodevbatchremove&ips='+ips.join(',');
}

function devpassbatchedit(){
	var ips = new Array();
	var ii=0;
	for(var i=0;i<document.dev.elements.length;i++){
		var e=document.dev.elements[i];
		if(e.name=='chk_member[]'&&e.checked){
			ips[ii++]=e.value;
		}
	}
	window.open('admin.php?controller=admin_pro&action=devpassbatchedit&ips='+ips.join(',')+"&username="+'<?php echo $this->_tpl_vars['username']; ?>
');
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


