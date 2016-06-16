<?php /* Smarty version 2.6.18, created on 2014-06-29 08:36:50
         compiled from usrdev.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'addslashes', 'usrdev.tpl', 369, false),array('function', 'math', 'usrdev.tpl', 377, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jquery-1.2.6.pack.js"></script>
</head>
<script>
function userlogin(aid,tid){
	tid = document.getElementById(tid);
	aid = document.getElementById(aid);
	aid.href=aid.href + "&logintool=" + tid.options[tid.options.selectedIndex].value;
}

function search(){
	var form = document.f1;
	if(form.sip==undefined){
		form.action += "&appname="+form.appname.value;
	}else{
		form.action += "&sip="+form.sip.value;
		form.action += "&hostname=" + form.hostname.value;
	}
	form.submit();
	return true;
}

function windows_version(){
	var pos = navigator.appVersion.indexOf("Windows NT");
	if(pos > 0){
		return parseFloat(navigator.appVersion.substring(pos+10, navigator.appVersion.indexOf(";",pos)));
	}
}

var OSVersion = windows_version();
function checkieNT52(obj){
	return true;
	if(OSVersion==5.2&&obj.checked){
		alert('Windows2003不支持剪切板');
		obj.checked=false;
	}
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
	var wWidth=200;
	var wHeight=240;
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
	mesW.innerHTML='<div id="light" class="white_content" style="height:240px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#eeeeee" align="right" height="25"><a href="javascript:void(0)" onclick="closeWindow()">关闭</a></td></tr></table>'+c+"</div>";
	//styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";//鼠标点击位置
	//styleStr="left:"+(bWidth-wWidth)/2+"px;top:"+(bHeight-wHeight)/2+"px;position:absolute;width:"+wWidth+"px;";//屏幕中间
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
	//window.parent.document.getElementById("frame_content").height=pos.y+1000;
	//window.parent.parent.document.getElementById("main").height=bHeight+1000;	
	
	document.getElementById('fade').style.display='block'
	return false;
}
function changeuser(u){
	if(u==0){
		document.getElementById('passwordsave').value=-1;		
		document.getElementById('username').value='';
		document.getElementById('password').value='';

	}else if(u!=0){
		var u1 = u.substring(0, u.indexOf('_'));
		var u2 = u.substring(u.indexOf('_')+1);
		var username = u2.split('.,?');
		document.getElementById('passwordsave').value=u1;
		document.getElementById('username').value=username[0];
		document.getElementById('password').value=username[1];
	}
}

function loadurl(url){
	$.get(url, {Action:"get",Name:"lulu","1":Math.round(new Date().getTime()/1000)}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		//alert(data);
		showImg('',data);
	});
}
</script>
<body>
<div id="fade" class="black_overlay"></div> 
<?php if ($_SESSION['ADMIN_LEVEL'] == 0 || $_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
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
<?php if ($_SESSION['ADMIN_LEVEL'] == 0): ?>
<?php if ($_GET['logintype'] != 'apppub'): ?>
<li class=<?php if ($_GET['logintype']): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&gid=<?php echo $this->_tpl_vars['gid']; ?>
&all=1">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'ssh'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'ssh'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=ssh&gid=<?php echo $this->_tpl_vars['gid']; ?>
">SSH设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'ssh'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'telnet'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'telnet'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=telnet&gid=<?php echo $this->_tpl_vars['gid']; ?>
">TELNET设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'telnet'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'rdp'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'rdp'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=rdp&gid=<?php echo $this->_tpl_vars['gid']; ?>
">RDP设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'rdp'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'vnc'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'vnc'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=vnc&gid=<?php echo $this->_tpl_vars['gid']; ?>
">VNC设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'vnc'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'ftp'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'ftp'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=ftp&gid=<?php echo $this->_tpl_vars['gid']; ?>
">FTP设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'ftp'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<li class=<?php if ($_GET['logintype'] != 'x11'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'x11'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=x11">X11设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'x11'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>

<li class=<?php if ($_GET['logintype'] != '_apppub'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != '_apppub'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=_apppub&gid=<?php echo $this->_tpl_vars['gid']; ?>
">应用</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != '_apppub'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<?php else: ?>
<li class=<?php if ($_GET['logintype'] != 'apppub'): ?>"me_b"<?php else: ?>"me_a"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_GET['logintype'] != 'apppub'): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main&logintype=apppub&gid=<?php echo $this->_tpl_vars['gid']; ?>
">应用发布设备</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_GET['logintype'] != 'apppub'): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
<?php endif; ?>
<?php elseif ($_SESSION['ADMIN_LEVEL'] == 10 || $_SESSION['ADMIN_LEVEL'] == 101): ?>
<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
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
<?php endif; ?><?php endif; ?>
</ul>
</div></td></tr>

<?php endif; ?>

	
<?php if ($_SESSION['ADMIN_LEVEL'] != 0 && $_SESSION['ADMIN_LEVEL'] != 10 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
  <tr>
    <td  class="hui_bj"><?php echo $this->_tpl_vars['title']; ?>
</td>
          
          
          <td width="2"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/main_right.gif" width="2" height="31"></td>
        </tr>

      </table></td>
  </tr>
  <?php endif; ?>
   <tr>
    <td class="main_content">
<form  name="f1" action="<?php echo $this->_tpl_vars['curr_url']; ?>
" method="post" name="report" onsubmit="return search();" >
<?php if ($this->_tpl_vars['logintype'] == 'apppub' || $this->_tpl_vars['logintype'] == '_apppub'): ?>
应用名称：<input type="text" class="wbk" id="appname" name="appname" value="<?php echo $this->_tpl_vars['sip']; ?>
" >
<?php else: ?>
IP：<input type="text" class="wbk" id="sip" name="sip" value="<?php echo $this->_tpl_vars['sip']; ?>
" >&nbsp;&nbsp;主机名：<input type="text" class="wbk" id="hostname" name="hostname" value="<?php echo $this->_tpl_vars['hostname']; ?>
" >
<?php endif; ?>
<?php if ($this->_tpl_vars['admin_level'] == 0): ?>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;负载均衡：<select  class="wbk"  id="lb" name="lb" >
  <option value="">未指定</option>
<option value="<?php echo $this->_tpl_vars['localip']; ?>
"><?php echo $this->_tpl_vars['localip']; ?>
</option>
<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['lb']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
<option value="<?php echo $this->_tpl_vars['lb'][$this->_sections['l']['index']]['ip']; ?>
"><?php echo $this->_tpl_vars['lb'][$this->_sections['l']['index']]['ip']; ?>
</option>
<?php endfor; endif; ?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;<span id="slogin_template" style="display:none">登录方式：<select  class="wbk"  id="app_act" >
					<option value="applet">applet</option>
					<option value="activeX">activeX</option>
					</select></span>
<?php endif; ?>&nbsp;&nbsp;<input type="submit" height="35" align="middle" value=" 确定 " border="0" class="bnnew2"/><?php if ($_SESSION['ADMIN_LEVEL'] == 0): ?>&nbsp;&nbsp;&nbsp;&nbsp;磁盘映射:<input type="checkbox" name="rdpdiskauth_" id="rdpdiskauth_" <?php if (! $this->_tpl_vars['member']['rdpdiskauth_up']): ?>disabled<?php endif; ?> <?php if ($this->_tpl_vars['rdpdiskauth_up']): ?>checked<?php endif; ?> value="1"  />&nbsp;&nbsp;&nbsp;&nbsp;剪切版:<input type="checkbox" name="rdpclipauth_" id="rdpclipauth_" <?php if (! $this->_tpl_vars['member']['rdpclipauth_up']): ?>disabled<?php endif; ?>  onclick="checkieNT52(this)" <?php if ($this->_tpl_vars['member']['rdpclipauth_up']): ?>checked<?php endif; ?> value="1"  />&nbsp;&nbsp;&nbsp;&nbsp;本地:<input type="checkbox" name="consoleauth_" id="consoleauth_" <?php if (! $this->_tpl_vars['member']['rdplocal']): ?>disabled<?php endif; ?> value="1"  />&nbsp;&nbsp;<select  class="wbk"  name='fenbianlv' id='fenbianlv' > 
					<option value="3" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 3): ?>selected<?php endif; ?>>全屏</option>
					<option value="1" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 1): ?>selected<?php endif; ?>>800*600</option>
					<option value="2" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 2): ?>selected<?php endif; ?>>1024*768</option>
					</select>&nbsp;&nbsp;<select  class="wbk"  name='login_type' id='login_type' > 
					<option value="web" <?php if ($this->_tpl_vars['member']['default_appcontrol'] == 0): ?>selected<?php endif; ?>>WEB</option>
					<option value="rdp" <?php if ($this->_tpl_vars['member']['default_appcontrol'] == 1): ?>selected<?php endif; ?>>RDP</option>
					</select><?php endif; ?>
</form>
	  </td>
  </tr>
  <tr>
	<td class="">
<TABLE border=0 cellSpacing=1 cellPadding=5 width="100%" bgColor=#ffffff valign="top" class="BBtable">
                <TBODY>
		<?php if ($this->_tpl_vars['logintype'] != 'apppub' && $this->_tpl_vars['logintype'] != '_apppub'): ?>		
                  <TR>
					<th class="list_bg"  width="5%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=id&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >ID</a></th>
         			<?php if ($this->_tpl_vars['logintype'] == 'apppub' || $this->_tpl_vars['logintype'] == '_apppub'): ?>
					 <th class="list_bg"  width="13%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=name&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用程序</a></th>
					  <th class="list_bg"  width="10%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >目标地址</a></th>
					 <th class="list_bg"  width="10%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=appserverip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >应用发布服务</a></th>
					 
					<?php else: ?>
					<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >服务器地址</a></th>
					<?php endif; ?>
                   <?php if ($this->_tpl_vars['logintype'] != 'apppub' && $this->_tpl_vars['logintype'] != '_apppub'): ?>
					 <th class="list_bg"  width="20%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >主机名</a></th>
					 <?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
					 <th class="list_bg"  width="7%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >设备组</a></th>
					 <?php endif; ?>
					<?php endif; ?>
					
					<th class="list_bg"  width="20%">主机信息</th>
                    <?php if ($this->_tpl_vars['type'] != 'fort'): ?>
                    <th class="list_bg"  width="10%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >登陆用户</a></th>
                    <?php endif; ?>   
					<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
					 <th class="list_bg"  width="7%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >系统</a></th>
					 <?php endif; ?>
				    <th class="list_bg"  width="7%"><a href="admin.php?controller=admin_index&action=main&logintype=<?php echo $_GET['logintype']; ?>
&orderby1=login_method&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >登录协议</a></th>
					 <?php if ($_SESSION['ADMIN_LEVEL'] != 10): ?>
					<th class="list_bg"  width="7%">连接检测</th>
					 <?php endif; ?>
                   	<th class="list_bg"  width="20%"><?php if ($_SESSION['ADMIN_LEVEL'] != 0): ?>操作<?php else: ?>工具<?php endif; ?></th>
                  </TR>
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
			<tr bgcolor='<?php if (! $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>#cccccc<?php elseif ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['passwordtry'] == 1 || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['passwordtry'] == 2): ?>red<?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>f7f7f7<?php endif; ?>'>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
</td>
				<?php if ($this->_tpl_vars['logintype'] == 'apppub' || $this->_tpl_vars['logintype'] == '_apppub'): ?>
				<td></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appserverip']; ?>
</td>
				<?php endif; ?>
				
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
</td>
				<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['groupname']; ?>
</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['logintype'] == 'apppub' || $this->_tpl_vars['logintype'] == '_apppub'): ?>					 
				<?php else: ?>
				<td><span  title="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
" ><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['hostname']; ?>
</span></td>
				<?php endif; ?>
				
				<td><a href='#' onclick='loadurl("admin.php?controller=admin_pro&action=showdesc&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
");return false;' target="hide"><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/1-1.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['desc']; ?>
</a></td>
				<?php if ($this->_tpl_vars['type'] != 'fort'): ?>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username'] == ''): ?>空用户<?php else: ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
<?php endif; ?></td>
				<?php endif; ?>
				
				<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_type']; ?>
</td>
				<?php endif; ?>
				<td><font style="font-size:12px;" <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['puttyhong'] == 1): ?>color="red"<?php endif; ?> ><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'apppub'): ?>应用发布<?php else: ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method']; ?>
<?php endif; ?><font>				
				</td>
				<?php if ($_SESSION['ADMIN_LEVEL'] != 10): ?>
				<td><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico2.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='#' onclick='loadurl("admin.php?controller=admin_pro&action=test_port&ip=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip']; ?>
&port=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['port']; ?>
&devicesid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
");return false;' target="hide">检测</a></td>
				<?php endif; ?>
				<td class="td_line" width="30%">
					<?php if ($this->_tpl_vars['admin_level'] == 0): ?>					
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'RDP' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'X11'): ?>					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
1" onclick="rdpgo(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,0,true);return false;" href='admin.php?controller=admin_pro&rdptype=activex&action=dev_login&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mstsc_ico.gif" border=0></a><?php if ($this->_tpl_vars['windows_version'] != '5.2'): ?>&nbsp;&nbsp;&nbsp;<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
2" onclick="rdpgo2(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,0,true)" href='#' target="_blank"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie_ico.png" border=0></a><?php endif; ?>					<?php else: ?>
					(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method']; ?>
<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie_ico.png" border=0>					<?php endif; ?>
				
					<?php endif; ?>
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'ssh1' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'ssh' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'telnet' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'rlogin'): ?>	<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					<a id="p<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
" href="admin.php?controller=admin_pro&action=dev_login&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&logintool=putty&type=<?php echo $this->_tpl_vars['type']; ?>
" onclick="return goto3(this.id)" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/putty_ico.gif" border=0></a>&nbsp;&nbsp;&nbsp;
			
					 <a id="s<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
" href="admin.php?controller=admin_pro&action=dev_login&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
&logintool=securecrt&type=<?php echo $this->_tpl_vars['type']; ?>
" onclick="return goto3(this.id)"  target="hide" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scrt_ico.gif" border=0></a></a>
					 <?php else: ?>
					 <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/putty_ico.gif" border=0>&nbsp;&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scrt_ico.gif" border=0>
					<?php endif; ?>
					<?php elseif ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'ftp' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'sftp'): ?>
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
" href='admin.php?controller=admin_pro&action=dev_login&logintool=winscp&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'  onclick="return goto3(this.id)" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/winscp_ico.gif" border=0></a>
					<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/winscp_ico.gif" border=0>
					<?php endif; ?>
					<?php elseif ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'RDP2008' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'vnc' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'Web' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'Sybase' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'Oracle' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'DB2' || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'apppub'): ?>
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
1" onclick="rdpgo(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,0,false);return false;" href='admin.php?controller=admin_pro&rdptype=activex&action=dev_login&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'><font style="font-size:12px;" <?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['puttyhong'] == 1): ?>color="red"<?php endif; ?> ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mstsc_ico.gif" border=0></font></a> <?php if ($this->_tpl_vars['windows_version'] != '5.2'): ?><a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
2" onclick="rdpgo2(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,0,false)" href='#' target="_blank"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie_ico.png" border=0></a>
<?php endif; ?>					<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mstsc_ico.gif" border=0>&nbsp;&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie_ico.png" border=0>
					<?php endif; ?>	
					<?php endif; ?>			
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'ssh' && $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['sftp']): ?>
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					&nbsp;&nbsp;&nbsp;<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
" href='admin.php?controller=admin_pro&action=dev_login&logintool=winscp&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'  onclick="return goto3(this.id)" target="hide"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/winscp_ico.gif" border=0></a>
					<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/winscp_ico.gif" border=0>
					<?php endif; ?>	
				
					<?php endif; ?>	
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['change_password']): ?>
					<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a  onclick="window.open ('admin.php?controller=admin_pro&action=change_device_pwd&sid=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
', 'newwindow', 'height=330, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;" href='#'>修改密码</a>
					<?php endif; ?>
					
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['admin_level'] == 10): ?>
					<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/down.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='#' onclick='loadurl("admin.php?controller=admin_pro&action=showpwddownauth");return false;'>下载密码</a>
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico2.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=dev_checkpass&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'>查看密码</a>
					| <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=dev_edit&gid=<?php echo $this->_tpl_vars['gid']; ?>
&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['serverid']; ?>
'>修改</a>
					<?php endif; ?>				
</td> 
			</tr>
			<?php unset($this->_sections['tt']);
$this->_sections['tt']['name'] = 'tt';
$this->_sections['tt']['loop'] = is_array($_loop=$this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tt']['show'] = true;
$this->_sections['tt']['max'] = $this->_sections['tt']['loop'];
$this->_sections['tt']['step'] = 1;
$this->_sections['tt']['start'] = $this->_sections['tt']['step'] > 0 ? 0 : $this->_sections['tt']['loop']-1;
if ($this->_sections['tt']['show']) {
    $this->_sections['tt']['total'] = $this->_sections['tt']['loop'];
    if ($this->_sections['tt']['total'] == 0)
        $this->_sections['tt']['show'] = false;
} else
    $this->_sections['tt']['total'] = 0;
if ($this->_sections['tt']['show']):

            for ($this->_sections['tt']['index'] = $this->_sections['tt']['start'], $this->_sections['tt']['iteration'] = 1;
                 $this->_sections['tt']['iteration'] <= $this->_sections['tt']['total'];
                 $this->_sections['tt']['index'] += $this->_sections['tt']['step'], $this->_sections['tt']['iteration']++):
$this->_sections['tt']['rownum'] = $this->_sections['tt']['iteration'];
$this->_sections['tt']['index_prev'] = $this->_sections['tt']['index'] - $this->_sections['tt']['step'];
$this->_sections['tt']['index_next'] = $this->_sections['tt']['index'] + $this->_sections['tt']['step'];
$this->_sections['tt']['first']      = ($this->_sections['tt']['iteration'] == 1);
$this->_sections['tt']['last']       = ($this->_sections['tt']['iteration'] == $this->_sections['tt']['total']);
?>
			<tr bgcolor='<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['passwordtry'] == 1 || $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['passwordtry'] == 2): ?>red<?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>f7f7f7<?php endif; ?>'>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
</td>
				<td><span  title="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['name']; ?>
" ><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['name']; ?>
</span></td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['device_ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appserverip']; ?>
</td>
				
				<?php if ($this->_tpl_vars['type'] != 'fort'): ?>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username'] == ''): ?>空用户<?php else: ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['username']; ?>
<?php endif; ?></td>
				<?php endif; ?>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['entrust_password']): ?>自动登录<?php else: ?>手填密码<?php endif; ?></td>
				<td><?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'apppub'): ?>应用发布<?php else: ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method']; ?>
<?php endif; ?></td>
				<td class="td_line" width="30%">
					<?php if ($this->_tpl_vars['admin_level'] == 0): ?>
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['login_method'] == 'apppub'): ?>	
					<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['enable']): ?>
					<a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
0<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
1" onclick="rdpgo(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
,false);return false;" href='admin.php?controller=admin_pro&rdptype=activex&action=dev_login&id=<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
'><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mstsc_ico.gif" border=0></a> | <a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
0<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
2" onclick="rdpgo2(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
,<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
,false);" href='#' target="_blank"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie_ico.png" border=0></a>
<?php else: ?>
<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/mstsc_ico.gif" border=0> <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ie.png" border=0>
<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
					
</td> 
			</tr>
			<?php endfor; endif; ?>
			<?php endfor; endif; ?>

			<?php else: ?>
<style type="text/css">
<!--
#navi{width:auto;}
.ul {
 list-style-type: none;margin:0; padding:0
}
.li {
 float:left;width: 100px;
}

-->
</style>
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
			<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['device_ip'] == $this->_tpl_vars['appserverip'] || $this->_tpl_vars['logintype'] == '_apppub'): ?>
			<tr>
			<?php $this->assign('i', 2); ?>
			<td align="center" class="" background="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tubiao_bg.jpg">
<table border="0" width="100%"><tr><?php if ($this->_tpl_vars['logintype'] != '_apppub'): ?><td style="width:140px;text-align:center;border:0px" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/windows.jpg" width='32' height='32' ><br><a id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
2"  href="#" onclick="return rdpOne(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
, 0, false);" target="_blank">桌面</a></li>
<?php endif; ?>
				
					<?php unset($this->_sections['tt']);
$this->_sections['tt']['name'] = 'tt';
$this->_sections['tt']['loop'] = is_array($_loop=$this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tt']['show'] = true;
$this->_sections['tt']['max'] = $this->_sections['tt']['loop'];
$this->_sections['tt']['step'] = 1;
$this->_sections['tt']['start'] = $this->_sections['tt']['step'] > 0 ? 0 : $this->_sections['tt']['loop']-1;
if ($this->_sections['tt']['show']) {
    $this->_sections['tt']['total'] = $this->_sections['tt']['loop'];
    if ($this->_sections['tt']['total'] == 0)
        $this->_sections['tt']['show'] = false;
} else
    $this->_sections['tt']['total'] = 0;
if ($this->_sections['tt']['show']):

            for ($this->_sections['tt']['index'] = $this->_sections['tt']['start'], $this->_sections['tt']['iteration'] = 1;
                 $this->_sections['tt']['iteration'] <= $this->_sections['tt']['total'];
                 $this->_sections['tt']['index'] += $this->_sections['tt']['step'], $this->_sections['tt']['iteration']++):
$this->_sections['tt']['rownum'] = $this->_sections['tt']['iteration'];
$this->_sections['tt']['index_prev'] = $this->_sections['tt']['index'] - $this->_sections['tt']['step'];
$this->_sections['tt']['index_next'] = $this->_sections['tt']['index'] + $this->_sections['tt']['step'];
$this->_sections['tt']['first']      = ($this->_sections['tt']['iteration'] == 1);
$this->_sections['tt']['last']       = ($this->_sections['tt']['iteration'] == $this->_sections['tt']['total']);
?>
					<td style="width:140px;text-align:center;border:0px">
					<a  id="a<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
0<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
2" href="#" onclick="return rdpOne(<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
, <?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
, false);" target="_blank"><img src="upload/<?php if ($this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['icon']): ?><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['icon']; ?>
<?php else: ?>nopic.jpg<?php endif; ?>" width="32" height="32"  id="img_<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
0<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
" onmouseover="popit('img_<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['id']; ?>
0<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appdeviceid']; ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['name'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['path'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['appserverip']; ?>
', '<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['device_ip']; ?>
', '<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['url']; ?>
')" onmouseout="closeit()" title="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['name']; ?>
"><br><span style="display:block;width:100px;text-align:center;margin-left:20px;"><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['appmember'][$this->_sections['tt']['index']]['name']; ?>
</span></a>
					
					</td>
					<?php if (( $this->_tpl_vars['i']++ ) % 7 == 0): ?>
					</tr><tr>
					<?php endif; ?>
					<?php endfor; endif; ?>
					<?php if (( $this->_tpl_vars['i']++ ) % 7 != 0): ?>
					<?php echo smarty_function_math(array('equation' => "8-".($this->_tpl_vars['i']),'assign' => 'm'), $this);?>

					<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['m']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
					<td style="border:1px"></td>
					<?php endfor; endif; ?>
					</tr><tr>
					<?php endif; ?>
					</tr></table>
			</td>
			</tr>
			<?php endif; ?>
			<?php endfor; endif; ?>
			<?php endif; ?>
                <tr>
	           <td  colspan="10" align="right">
		   			<?php if ($_SESSION['ADMIN_LEVEL'] == 10): ?><input type="button"  value="密码打印" onClick="alert('未发现可驱动的密码打印机');" class="an_06"><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['logintype'] != 'apppub'): ?>共<?php echo $this->_tpl_vars['total']; ?>
个记录<?php endif; ?>  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php if ($this->_tpl_vars['logintype'] != 'apppub'): ?><?php echo $this->_tpl_vars['items_per_page']; ?>
个记录/页<?php endif; ?>  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='<?php echo $this->_tpl_vars['curr_url']; ?>
&page='+this.value;">页
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
function rdpgo(iid,appdeviceid,isrdp){	
	if(isrdp){
		var consoleauth = document.getElementById('consoleauth_').checked ? '1' : '0';
	}
	var fenbian = document.getElementById('fenbianlv').options[document.getElementById('fenbianlv').selectedIndex].value;
	var hid = document.getElementById('hide');
	var lbip = document.getElementById('lb').options[document.getElementById('lb').options.selectedIndex].value;
	var app_act = document.getElementById('app_act').options[document.getElementById('app_act').options.selectedIndex].value;
	var rdpclipauth = document.getElementById('rdpclipauth_').checked ? '1' : '0';
	var rdpdiskauth = document.getElementById('rdpdiskauth_').checked ? '1' : '0';
	
	var weburl='admin.php?controller=admin_pro&action=dev_login&id='+iid+'&screen='+fenbian+'&selectedip='+lbip+'&app_act='+app_act+'&rdparg=0&appdeviceid='+appdeviceid+'&rdpclipauth='+rdpclipauth+'&rdpdiskauth='+rdpdiskauth;
	if(isrdp){
		weburl +='&consoleauth='+consoleauth;
	}
	hid.src=weburl+'&'+Math.round(new Date().getTime()/1000);;
//alert(hid.src);
	<?php if ($this->_tpl_vars['logindebug']): ?>
	window.open(document.getElementById('hide').src,'','rdp');
	<?php endif; ?>
	return false;	
}
function rdpgo2(iid,appdeviceid,isrdp){
	if(isrdp){		
		if(appdeviceid>0){
			var aid = 'a'+iid+"0"+appdeviceid+'2';			
		}else{
			var aid = 'a'+iid+'2';
		}		
		var consoleauth = document.getElementById('consoleauth_').checked ? '1' : '0';
	}else{		
		if(appdeviceid>0){
			var aid = 'a'+iid+"0"+appdeviceid+'2';
		}else{
			var aid = 'a'+iid+'2';
		}
	}
	var fenbian = document.getElementById('fenbianlv').options[document.getElementById('fenbianlv').selectedIndex].value;
	var hid = document.getElementById('hide');
	var lbip = document.getElementById('lb').options[document.getElementById('lb').options.selectedIndex].value;
	var app_act = document.getElementById('app_act').options[document.getElementById('app_act').options.selectedIndex].value;
	var rdpclipauth = document.getElementById('rdpclipauth_').checked ? '1' : '0';
	var rdpdiskauth = document.getElementById('rdpdiskauth_').checked ? '1' : '0';
	
	document.getElementById(aid).href='admin.php?controller=admin_pro&rdptype=activex&action=dev_login&id='+iid+'&screen='+fenbian+'&selectedip='+lbip+'&app_act='+app_act+'&rdparg=0&appdeviceid='+appdeviceid+'&rdpclipauth='+rdpclipauth+'&rdpdiskauth='+rdpdiskauth;
	if(isrdp){
		document.getElementById(aid).href+='&consoleauth='+consoleauth;
	}
	document.getElementById(aid).href+='&'+Math.round(new Date().getTime()/1000);
	//alert(hid.src);
<?php if ($this->_tpl_vars['logindebug']): ?>
	window.open(document.getElementById(aid).href);
<?php endif; ?>
	return true;	
}

function goto3(iid){
	var idnumber = iid.substring(1);
	var lbip = document.getElementById('lb').options[document.getElementById('lb').options.selectedIndex].value;
	if(!lbip){
		//alert('请选择负载均衡');
		//return false;
	}
	var app_act = document.getElementById('app_act').options[document.getElementById('app_act').options.selectedIndex].value;
	document.getElementById(iid).href=document.getElementById(iid).href+'&selectedip='+lbip+'&app_act='+app_act+'&'+Math.round(new Date().getTime()/1000);
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

<?php if ($this->_tpl_vars['logintype'] == 'apppub'): ?>
<?php endif; ?>

function rdpOne(devid, appdeviceid, isrdp){
	var logintype = document.getElementById('login_type');
	if(logintype.options[logintype.options.selectedIndex].value=='web'){
		if(appdeviceid>0){
			return rdpgo2(devid, appdeviceid,isrdp);
		}else{
			return rdpgo2(devid, 0, false);
		}

	}else{
		if(appdeviceid>0){
			return rdpgo(devid, appdeviceid,isrdp);
		}else{
			return rdpgo(devid, 0, isrdp);
		}
		
	}
}

var $ = function(x){
	return document.getElementById(x);
};
function mousePosition(ev){
    if(ev.pageX || ev.pageY){
        return {x:ev.pageX, y:ev.pageY};
    }
    return {
        x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
        y:ev.clientY + document.body.scrollTop  - document.body.clientTop
    };
}

function popit(id, program, path, appserverip, device_ip, url){
	//easyDialog.close();
	var e = window.event || arguments.callee.caller.arguments[0];
	var ev = mousePosition(e);
	document.getElementById('pop_programname').innerHTML=program;

	document.getElementById('pop_path').innerHTML=path;
	document.getElementById('pop_appserverip').innerHTML=appserverip;
	document.getElementById('pop_device_ip').innerHTML=device_ip;
	document.getElementById('pop_url').innerHTML=url;
	var classname='hide_box'
	pageWidth = document.documentElement.offsetWidth;
	pageHight = document.documentElement.offsetHeight;
	divWidth = jQuery("." + classname).width();
	divHight = jQuery("." + classname).height();
	if (ev.x + divWidth/2 < pageWidth) {
		pagex = ev.x-divWidth/2;
	} else {
		pagex = ev.x - divWidth;
	}
	pagey = ev.y ;
	//alert(document.getElementById('testBox').style.display);
	jQuery("." + classname).css("position", "absolute").css("top", pagey + "px").css("left", pagex + "px").show();

}

function closeit(){
	document.getElementById('testBox').style.display='none';
}

</script>
<style>
.hide_box{width:350;color:#fff;color:#444;background:#fff;box-shadow:1px 2px 2px #555;display:none;}
.hide_box h4{height:26px;line-height:26px;overflow:hidden;background:#0884C4;color:#fff;padding:0 10px;border:1px solid #0884C4;font-size:14px;border-bottom:1px solid #0884C4;}
.hide_box h4 a{width:14px;line-height:13px;_line-height:15px;height:13px;font-family:arial;overflow:hidden;display:block;background:#fff;color:#c77405;float:right;text-align:center;text-decoration:none;margin-top:7px;font-size:14px;font-weight:normal;border-radius:2px;_font-size:12px;}
.hide_box p{font-size:13px;border:1px solid #ccc;}
</style>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jquery-1.7.2.min.js"></script>
<div class="hide_box" id="testBox">
	<h4><a href="javascript:void(0);" onclick="closeit();" title="关闭窗口">&times;</a>提示</h4>
	<p align="left"><b>程序名称：</b><span id="pop_programname"></span><br />
	<b>程序路径：</b><span id="pop_path"></span><br />
	<b>应用服务器：</b><span id="pop_appserverip"></span><br />
	<b>目标服务器IP：</b><span id="pop_device_ip"></span><br />
	<b>URL：</b><span id="pop_url"></span></p>
</div>
</body>
<iframe id="hide" name="hide" height="0"  frameborder="0" scrolling="no"></iframe>
</html>


