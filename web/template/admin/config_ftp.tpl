<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
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

function loadurl(url){
	$.get(url, {"1":Math.round(new Date().getTime()/1000)}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		//alert(data);
		showImg('',data);
	});
}
function changeStyle(obj,c)
{
	if(c!='o'){
		obj.style.backgroundColor=c;
	}else{
		obj.style.backgroundColor="#FFCC80";
	}
}

</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ssh">认证配置</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>


 
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ntpset">
		<tr><th colspan="3" class="list_bg"></th></tr>
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>NTP设置:({{$current_time}})</td>
		<td align=left>KEY:
		<input type="text" class="wbk" name="ntpkey" value="{{$sshconfig.ntpkey}}" />	
		NTP服务器:
		<input type="text" class="wbk" name="ntpserver" value="{{$sshconfig.ntpserver}}" />	
		
		</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>ftp堡垒机备份阈值:</td>
		<td align=left>
		<input type="text" class="wbk" name="ftpbackupsize" value="{{$sshconfig.ftpbackupsize}}" />	
		MB(大于此阈值堡垒机不备份上传下载文件,为0表示所有上传下载文件都不备份)</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=sftp_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>sftp堡垒机备份阈值:</td>
		<td align=left>
		<input type="text" class="wbk" name="sftpbackupsize" value="{{$sshconfig.sftpbackupsize}}" />	
		MB(大于此阈值堡垒机不备份上传下载文件,为0表示所有上传下载文件都不备份)</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ping_save">
	<tr  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>允许Ping:</td>
		<td align=left>
		<input type="checkbox" class="" name="ping" value="on" {{if $sshconfig.ping}}checked{{/if}} />	</td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=snmp_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>SNMP服务开启:</td>
		<td align=left>
		<input type="checkbox" class="" name="snmp" value="on" {{if $sshconfig.snmp}}checked{{/if}} /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=snmpcommunity_save">
	<tr  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>SNMP通讯字符串:</td>
		<td align=left>
		<input type="text" class="wbk" name="community" value="{{$sshconfig.community}}" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>系统时间修改:</td>
		<td align=left>
		<input type="text" class="wbk" name="year" size="4" value="{{$sshconfig.year}}" />年<input type="text" class="wbk" name="month" size="4" value="{{$sshconfig.month}}" />月<input type="text" class="wbk" name="day" size="4" value="{{$sshconfig.day}}" />日<input type="text" class="wbk" name="hour" size="4" value="{{$sshconfig.hour}}" />时<input type="text" class="wbk" name="minute" size="4" value="{{$sshconfig.minute}}" />分<input type="text" class="wbk" name="second" size="4" value="{{$sshconfig.second}}" />秒&nbsp;&nbsp;</td>
		<td><input type="submit" name="settime" class="an_02" value="设定时间"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=autodelete_save">
	<tr  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>自动删除周期:</td>
		<td align=left>
		<input type="text" class="wbk" name="autodelete" value="{{$autodelcycle}}" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=keyedit">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>证书修改:</td>
		<td align=left>
		<input type="text" class="wbk" name="eth0" value="{{$eth0}}" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=logintype">
	<tr bgcolor=""  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>登录方式:</td>
		<td align=left>
		Radius:<input type="checkbox" class="wbk" name="radiusauth" {{if $logintype.radiusauth}}checked{{/if}} value="1" /> &nbsp;&nbsp;&nbsp;LDAP:<input type="checkbox" class="wbk" name="ldapauth" {{if $logintype.ldapauth}}checked{{/if}} value="1" /> &nbsp;&nbsp;&nbsp;AD:<input type="checkbox" class="wbk" name="adauth" {{if $logintype.adauth}}checked{{/if}} value="1" /> </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=priority_cache_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>强制使用权限缓存:</td>
		<td align=left>
		<select name="priority_cache">
		<option value="0" {{if !$priority_cache}}selected{{/if}}>否</option>
		<option value="1" {{if $priority_cache}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=blankuser_save">
	<tr bgcolor="" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>弹出空用户认证:</td>
		<td align=left>
		<select name="blankuser">
		<option value="0" {{if !$blankuser}}selected{{/if}}>否</option>
		<option value="1" {{if $blankuser}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ldap_save">
	<tr bgcolor="f7f7f7" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>使用目录结构:</td>
		<td align=left>
		<select name="ldap">
		<option value="0" {{if !$ldap}}selected{{/if}}>否</option>
		<option value="1" {{if $ldap}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=certificate_save">
	<tr bgcolor="" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>是否开启证书认证:</td>
		<td align=left>
		<select name="Certificate" id="Certificate" >
		<option value="0" {{if $Certificate eq 0}}selected{{/if}}>否</option>
		<option value="2" {{if $Certificate eq 2}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" onclick="return certificate();" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>

	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=async_save">
	<tr bgcolor="f7f7f7" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>是否开启同步服务(Async):</td>
		<td align=left>
		<select name="Async" id="Async" >
		<option value="0" {{if $Async eq 0}}selected{{/if}}>否</option>
		<option value="1" {{if $Async eq 1}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=rdpinput_save">
	<tr bgcolor=""  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>是否显示RDP会话的"录入":</td>
		<td align=left>
		<select name="rdpinput" id="rdpinput" >
		<option value="0" {{if $rdpinput eq 0}}selected{{/if}}>否</option>
		<option value="1" {{if $rdpinput eq 1}}selected{{/if}}>是</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=diskfull_save">
	<tr bgcolor="f7f7f7" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>存贮无空间时操作:</td>
		<td align=left>
		<select name="diskfull" id="diskfull" >
		<option value="0" {{if $diskfull eq 0}}selected{{/if}}>覆盖旧文件</option>
		<option value="1" {{if $diskfull eq 1}}selected{{/if}}>停止操作</option>
		</select>
		 </td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=diskfull_save">
	<tr bgcolor="" onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'');"><td>发送密码文件加密密码:</td>
		<td align=left>
		<a href="#" onclick="loadurl('admin.php?controller=admin_config&action=viewthreepripwd_twopwd');return false;" >查看</a>
		 </td>
		<td><input type="button" onclick="loadurl('admin.php?controller=admin_config&action=threepripwd');" class="an_02" value="密码设置"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=dpwdtime_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>动态密码及时间显示:</td>
		<td align=left>
		<input type="checkbox" class="" name="dpwdtime" value="1" {{if $dpwdtime}}checked{{/if}} /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=rdprunning_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>RDP当前连接提示:</td>
		<td align=left>
		<input type="checkbox" class="" name="rdprunning" value="1" {{if $rdprunning}}checked{{/if}} /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=loginauthtype_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>首页是否显示登录方式:</td>
		<td align=left>
		<input type="checkbox" class="" name="loginauthtype" value="1" {{if $loginauthtype}}checked{{/if}} /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=radiustolocal_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>Radius认证转本地:</td>
		<td align=left>
		<input type="checkbox" class="" name="radiustolocal" value="1" {{if $radiustolocal}}checked{{/if}} /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=rrdpauthtips_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>RADIUS登录错误提示:</td>
		<td align=left>
		<input type="text" class="" name="rdpauthtips" value="{{$rdpauthtips}}" size="100" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=loginwrongtips_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>WEB登录错误提示:</td>
		<td align=left>
		<input type="text" class="" name="loginwrongtips" value="{{$loginwrongtips}}" size="100" /></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=asyncoutpass_save">
	<tr bgcolor="f7f7f7"  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'f7f7f7');"><td>同步外部密码：</td>
		<td align=left>
		<select  class="wbk" id=asyncoutpass name=asyncoutpass>
		<OPTION value="-1" {{if -1 eq $member.asyncoutpass}}selected{{/if}}>关闭</OPTION>
		{{section name=asyn loop=11}}
		<OPTION value="{{$smarty.section.asyn.index}}" {{if $smarty.section.asyn.index eq $asyncoutpass}}selected{{/if}}>{{$smarty.section.asyn.index}}</OPTION>
		{{/section}}
                  </SELECT></td>
		<td><input type="submit" class="an_02" value="保存修改"></td>
		
	</tr>
	</form>
	<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=ftp_save">
	<tr>
			<td  align="center" colspan=3><input name='reset' type="submit" onclick="return confirm('重启系统?')" class="an_02" value="重启系统"> &nbsp;&nbsp;&nbsp;<input name='shutdown' type="submit"  onclick="return confirm('关闭系统?')" value="关闭系统" class="an_02">&nbsp;&nbsp;&nbsp;<input name='clearaccount' type="submit" onclick="return confirm('清除配置?')"  value="清除配置" class="an_02">&nbsp;&nbsp;&nbsp;<input name='correctdata' type="submit" onclick="return confirm('整理数据?')"  value="整理数据" class="an_02"></td>
		</tr>
</form>
	</table>
		</table>
	</td>
  </tr>
</table>


<script language="javascript">
<!--

function certificate()
{
	{{if $Certificate eq 0}}
	if(document.getElementById('Certificate').options[document.getElementById('Certificate').options.selectedIndex].value==2){
		if(confirm('确定要开启认证？')){
			return true;
		}
		return false;
	}
	{{/if}}
}

function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为主机名时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请录入正确掩码');
	return false;
   }
*/
   return true;

}//end check
// -->

function checkIP(ip)
{
	var ips = ip.split('.');
	if(ips.length==4 && ips[0]>=0 && ips[0]<256 && ips[1]>=0 && ips[1]<256 && ips[2]>=0 && ips[2]<256 && ips[3]>=0 && ips[3]<256)
		return ture;
	else
		return false;
}

function checknum(num)
{

	if( isDigit(num) && num > 0 && num < 65535)
		return ture;
	else
		return false;

}

function isDigit(s)
{
var patrn=/^[0-9]{1,20}$/;
if (!patrn.exec(s)) return false;
return true;
}

</script>
<iframe id="hide" name="hide" height="0"  frameborder="0" scrolling="no"></iframe>
</body>
</html>



