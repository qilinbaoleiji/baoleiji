<?php /* Smarty version 2.6.18, created on 2014-05-09 22:49:58
         compiled from x11session_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'x11session_list.tpl', 175, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>会话列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jquery-1.2.6.pack.js"></script>
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_x11&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
";
	document.search.action += "&addr="+document.search.ip.value;
	document.search.action += "&luser="+document.search.user.value;
	document.search.action += "&usergroup="+document.search.usergroup.value;
	document.search.action += "&start1="+document.search.f_rangeStart.value;
	document.search.action += "&start2="+document.search.f_rangeEnd.value;
	
	//alert(document.search.action);
	//return false;
	return true;
}

var isIe=(document.all)?true:false;

function closeWindow()
{
	if(document.getElementById('back')!=null)
	{
		document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
	}
	if(document.getElementById('mesWindow')!=null)
	{
		document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
	}
	document.getElementById('fade').style.display='none';
}

function showImg(wTitle, c)
{
	closeWindow();
	//var pos = mousePosition(ev);
	var wWidth=240;
	var wHeight=300;
	var bWidth=parseInt(w=window.innerWidth|| document.documentElement.clientWidth|| document.body.clientWidth);
	var bHeight=parseInt(window.innerHeight|| document.documentElement.clientHeight|| document.body.clientHeight)+20;
	bHeight=700+20;
	var back=document.createElement("div");
	back.id="back";
	var styleStr="top:0px;left:0px;position:absolute;width:"+bWidth+"px;height:"+bHeight+"px;z-index:1002;";
	//styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
	back.style.cssText=styleStr;
	document.body.appendChild(back);
	var mesW=document.createElement("div");
	mesW.id="mesWindow";
	mesW.className="mesWindow";
	mesW.innerHTML='<div id="light" class="white_content" style="height:230px;width:32%"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#eeeeee" align="right" height="25"><a href="javascript:void(0)" onclick="closeWindow()">关闭</a></td></tr></table>'+c+"</div>";
	//styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";//鼠标点击位置
	//styleStr="left:"+(bWidth-wWidth)/2+"px;top:"+(bHeight-wHeight)/2+"px;position:absolute;width:"+wWidth+"px;";//屏幕中间
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
	//window.parent.document.getElementById("frame_content").height=pos.y+1000;
	//window.parent.parent.document.getElementById("main").height=bHeight+1000;	
	
	document.getElementById('fade').style.display='block'
	return false;
}

function loadurl(url){
	$.get(url, {Action:"get",Name:"lulu"}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		//alert(data);
		showImg('',data);
	});
}
</script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/border-radius.css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
</head>

<body>
<div id="fade" class="black_overlay"></div> 
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
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_x11&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">X11</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li> 
<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=login4approve">登录审批</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li> 
</ul>
</div></td></tr>
  <tr>
         <td >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content"><form action="admin.php?controller=admin_x11&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
" method="post" name="search" >
  <tr>
    <td></td>
    <td>
设备地址：<input type="text" class="wbk" name="ip"  size="13" />
运维用户：<input type="text" class="wbk" name="user" size="13" />
&nbsp;运维组：<select name='usergroup' id="usergroup">
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
开始日期：<input type="text" class="wbk"  name="f_rangeStart" size="13" id="f_rangeStart" value=""/>
 <input type="button" onClick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="13" id="f_rangeEnd" value=""/>
 <input type="button" onClick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">
	  

  <select  class="wbk"  id="app_act" style="display:none"><option value="applet" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'applet'): ?>selected<?php endif; ?>>applet</option><option value="activeX" <?php if ($_SESSION['ADMIN_DEFAULT_CONTROL'] == 'activeX'): ?>selected<?php endif; ?>>activeX</option></select>&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
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
						<th class="list_bg"   width="9%"><a href="admin.php?controller=admin_rdp&orderby1=cli_addr&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">来源地址</a></th>
						<th class="list_bg"   width="9%"><a href="admin.php?controller=admin_rdp&orderby1=addr&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">设备地址</a></th>
						
						<th class="list_bg"   width="6%"><a href="admin.php?controller=admin_rdp&orderby1=luser&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">运维</a></th>
						<th class="list_bg"   width="6%"><a href="admin.php?controller=admin_rdp&orderby1=realname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">真实姓名</a></th>
						<th class="list_bg"   width="7%"><a href="admin.php?controller=admin_rdp&orderby1=user&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">本地</a></th>
						<th class="list_bg"   width="11%"><a href="admin.php?controller=admin_rdp&orderby1=start&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">开始时间</a></th>
						<th class="list_bg"   width="11%"><a href="admin.php?controller=admin_rdp&orderby1=end&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">结束时间</a></th>
						<th class="list_bg"   width="5%"><a href="admin.php?controller=admin_rdp&orderby1=filesize&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
">文件(K)</a></th>
						<th class="list_bg"   width="">详细信息</th>
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

										<td><a href="admin.php?controller=admin_rdp&srcaddr=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['cli_addr']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['cli_addr']; ?>
</a></td>
					
					<td><a href="admin.php?controller=admin_rdp&addr=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['addr']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['addr']; ?>
</a></td>
					
					<td><a href="admin.php?controller=admin_rdp&luser=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['luser']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['luser']; ?>
</a></td>
					<td><a href="admin.php?controller=admin_rdp&luser=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['realname']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['realname']; ?>
</a></td>
					<td><a href="admin.php?controller=admin_rdp&user=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
"><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['user']; ?>
</a></td>
					<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['start']; ?>
</ td>
					<td><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['end']; ?>
</td>
					<td><?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['filesize'] >= 1000): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['allsession'][$this->_sections['t']['index']]['filesize']/1000)) ? $this->_run_mod_handler('string_format', true, $_tmp, '%.1f') : smarty_modifier_string_format($_tmp, '%.1f')); ?>
<?php else: ?><?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['filesize']/1000; ?>
<?php endif; ?></td>
					<td style="TEXT-ALIGN: left;"><?php if (! $this->_tpl_vars['backupdb_id']): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/replay.gif" width="16" height="16" align="absmiddle">
					<a  id="p_<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
" onClick="return go('<?php echo $this->_tpl_vars['curr_url']; ?>
&mstsc=1&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
','p_<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
')" href="#" target="hide">回放</a>&nbsp;<?php if ($this->_tpl_vars['windows_version'] != '5.2'): ?>| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie.png" width="16" height="16" align="absmiddle">
					<a href='<?php echo $this->_tpl_vars['curr_url']; ?>
&activex=1&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
' target="_blank">ACTIVEX</a><?php endif; ?>
					
						&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/input.gif" width="16" height="16" align="absmiddle"><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&activex=1&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&action=inputview" target="_blank">录入</a>
						&nbsp;| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mouse.png" width="16" height="16" align="absmiddle"><a href="<?php echo $this->_tpl_vars['curr_url']; ?>
&activex=1&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&action=rdpmouse" >鼠标</a><?php else: ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/file.gif" width="16" height="16" align="absmiddle"> <a href="#" onclick='window.open("admin.php?controller=admin_rdp&action=download&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
&start_page=1&command=<?php echo $this->_tpl_vars['command']; ?>
&backupdb_id=<?php echo $this->_tpl_vars['backupdb_id']; ?>
");return false;'><?php echo $this->_tpl_vars['language']['File']; ?>
</a>&nbsp;&nbsp;<?php endif; ?> 
						&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1-1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_session&desc=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['desc']; ?>
&action=logindesc&type=x11&sessionid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
" target="hide" ><font style="color:<?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['desc']): ?>red<?php else: ?>black<?php endif; ?>">备注</font></a>
						<?php if ($this->_tpl_vars['allsession'][$this->_sections['t']['index']]['logincommit']): ?>&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1-1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_session&commit=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['logincommit']; ?>
&action=logincommit&type=rdp" target="hide" >说明</a><?php endif; ?>
						<?php if (0): ?> | <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_rdp&action=del_session&sid=<?php echo $this->_tpl_vars['allsession'][$this->_sections['t']['index']]['sid']; ?>
">删除</a><?php endif; ?></td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="12" align="right">
							共<?php echo $this->_tpl_vars['session_num']; ?>
条会话  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;">页 <!--当前数据表: <?php echo $this->_tpl_vars['now_table_name']; ?>
--> 
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
<iframe id="hide" name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

