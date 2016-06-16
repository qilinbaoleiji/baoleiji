<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" /><script src="./template/admin/cssjs/global.functions.js"></script>
<script language="javascript">
function check_add_user(){
	return(true);
}

var AllRadiusMember = new Array();
var i=0;
{{section name=kk loop=$allradiusmem}}
AllRadiusMember[{{$smarty.section.kk.index}}] = new Array();
AllRadiusMember[{{$smarty.section.kk.index}}]['username']='{{$allradiusmem[kk].username}}';
AllRadiusMember[{{$smarty.section.kk.index}}]['uid']='{{$allradiusmem[kk].uid}}';
{{/section}}

var AllMember = new Array();
i=0;
{{section name=kk loop=$allmem}}
AllMember[{{$smarty.section.kk.index}}] = new Array();
AllMember[{{$smarty.section.kk.index}}]['username']='{{$allmem[kk].username}}';
AllMember[{{$smarty.section.kk.index}}]['realname']='{{$allmem[kk].realname}}';
AllMember[{{$smarty.section.kk.index}}]['uid']='{{$allmem[kk].uid}}';
AllMember[{{$smarty.section.kk.index}}]['groupid']='{{$allmem[kk].groupid}}';
AllMember[{{$smarty.section.kk.index}}]['check']='{{$allmem[kk].check}}';
{{/section}}

function filter(){
	var filterStr = document.getElementById('username').value;
	var usbkeyid = document.getElementById('memberselect');
	usbkeyid.options.length=1;
	for(var i=0; i<AllRadiusMember.length;i++){
		if(filterStr.length==0 || AllRadiusMember[i]['username'].indexOf(filterStr) >= 0){
			usbkeyid.options[usbkeyid.options.length++] = new Option(AllRadiusMember[i]['username'],AllRadiusMember[i]['uid']);
		}
	}
}

function change_for_user_auth(){
	{{if $radiususer}}
	 document.getElementById('fort_user_auth').checked=true;
	 {{/if}}
	var change_user_auth = document.getElementById('fort_user_auth').checked;
	if(change_user_auth){
		document.getElementById('username').readOnly  = true;
		document.getElementById('password_confirm').readOnly  = true;
		document.getElementById('password').readOnly  = true;
		{{if empty($id)}}document.getElementById('memberselect').style.display='';{{/if}}		
	}else{
		document.getElementById('username').readOnly  = false;
		document.getElementById('password_confirm').readOnly  = false;
		document.getElementById('password').readOnly  = false;
		document.getElementById('memberselect').style.display='none';
	}
}

function usernameselect(){
	document.getElementById('username').value = (document.getElementById('memberselect').options.selectedIndex==0 ? document.getElementById('username').value : document.getElementById('memberselect').options[document.getElementById('memberselect').options.selectedIndex].text);
}

function temptyuser(check){
	if(check){
		document.getElementById('username').value='';
		//document.getElementById('password').value='';
		//document.getElementById('password_confirm').value='';
		document.getElementById('automp').checked=false;
		document.getElementById('automp2').checked=false;
		document.getElementById('publickey_auth').checked=false;
		document.getElementById('autotr').style.display='none';
		document.getElementById('publickey_authtr').style.display='none';
		document.getElementById('automutr').style.display='none';
	}else{
		document.getElementById('autotr').style.display='';
		document.getElementById('publickey_authtr').style.display='';
		document.getElementById('automutr').style.display='';
	}
}

function searchit(){
	var url = "admin.php?controller=admin_pro&action=pass_edit&id={{$id}}&ip={{$ip}}&serverid={{$serverid}}&gid={{$gid}}&from={{$smarty.get.from}}";
	url += "&webuser="+document.f1.elements.webuser.value;
	url += "&webgroup="+document.f1.elements.webgroup.value;
	{{if $_config.LDAP}}
	{{if $_config.TREEMODE}}
	var obj1=document.getElementById('groupid1');	
	gid=obj1.value;
	{{else}}
	for(var i=1; true; i++){
		var obj=document.getElementById('groupid'+i);
		if(obj!=null&&obj.options.selectedIndex>-1){
			gid=obj.options[obj.options.selectedIndex].value;
			continue;
		}
		break;
	}
	{{/if}}
	url += "&g_id="+gid;
	{{/if}}
	window.location.href= url;
	return false;
}

{{if $_config.LDAP}}
var foundparent = false;
var servergroup = new Array();
var i=0;
{{section name=a loop=$allsgroup}}
servergroup[i++]={id:{{$allsgroup[a].id}},name:'{{$allsgroup[a].groupname}}',ldapid:{{$allsgroup[a].ldapid}}};
{{/section}}
{{/if}}
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
</head>
 <SCRIPT language=javascript src="{{$template_root}}/images/selectdate.js"></SCRIPT>

<body onbeforeunload="saveTitle(event)">


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu" style="width:1100px;">
<ul>
{{if $smarty.session.ADMIN_LEVEL eq 10}}
<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=password_cron">定时任务</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting_forpassword">自动备份</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=passdown">密码文件下载</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordcheck">密码校验</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
{{elseif $smarty.session.ADMIN_LEVEL eq 10 or $smarty.session.ADMIN_LEVEL eq 101}}
<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
{{else}}
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">用户管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{if $from eq 'dir'}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{else}}
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备管理</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	{{/if}}
	{{if $from eq 'dir'}}
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">目录管理</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	{{else}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">目录管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{/if}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=workdept">用户属性</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS用户</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordkey">密码密钥</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{if $smarty.session.ADMIN_LEVEL eq 1}}
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{/if}}
{{/if}}
</ul><span class="back_img"><A href="admin.php?{{if $smarty.get.from eq 'passview'}}controller=admin_index&action=main{{else}}controller=admin_pro&action={{if $fromdevpriority}}dev_priority_search{{else}}devpass_index&ip={{$ip}}&serverid={{$serverid}}{{/if}}{{/if}}&back=1"><IMG src="{{$template_root}}/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
<tr>
	<td class="">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#ffffff" class="BBtable" >
	<TR>
	<TD colspan="3" height="33" class="main_content">
	<form name ='f1' action='admin.php?controller=admin_pro&action=pass_edit' method=post>
	资源组：{{include file="select_sgroup.tpl" }}&nbsp;&nbsp;&nbsp;&nbsp;运维用户过滤<input type="text" class="wbk" name="webuser" value="{{$webuser}}">
	资源组<input type="text" class="wbk" name="webgroup" value="{{$webgroup}}">
	&nbsp;&nbsp;<input  type="button" value=" 提交 " onClick="return searchit();" class="bnnew2">
	</form>
	</TD>
  </TR>

<form name="f2" method=post action="admin.php?controller=admin_pro&action=pass_save&id={{$id}}&ip={{$ip}}&serverid={{$serverid}}&gid={{$gid}}&from={{$smarty.get.from}}" enctype="multipart/form-data" onsubmit="javascript:saveAccount=false;">
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="usernametr">
		<td width="20%" align=right>
		{{$language.Username}}
		</td>
		<td width="80%">
		<input type=text name="username" id="username" size=35 value="{{$username}}"  onchange="filter();" >&nbsp;&nbsp;
			<select  class="wbk"  id="memberselect" name="memberselect" style="display:none" onchange="usernameselect();">
				<OPTION value="">请选择</OPTION>
				{{section name=k loop=$allradiusmem}}
					<option value="{{$allradiusmem[k].uid}}" {{if $allradiusmem[k].uid == $radiususer}}selected{{/if}}>{{$allradiusmem[k].username}}</option>
				{{/section}}
			</SELECT> &nbsp;&nbsp;<input type="checkbox" name="entrust_username" value="on" {{if $id && $entrust_username eq 0}}checked{{/if}} onclick="temptyuser(this.checked);">空用户
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="originalpasswordtr">
		<td width="20%" align=right>
		{{$language.originalpassword}}
		</td>
		<td width="80%">
		<input type=password name="password" id="password" size=35 value="{{$password|htmlspecialchars}}" >&nbsp;&nbsp;<span >RADIUS用户认证：<input type="checkbox" name="radiususer" id="fort_user_auth" {{if $radiususer}} checked {{/if}} value="on" onclick="change_for_user_auth();" /></span>
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}  id="originalpassword2tr">
		<td width="20%" align=right>
		{{$language.Inputoriginalpasswordagain}}
		</td>
		<td width="80%">
		<input type=password name="password_confirm" id="password_confirm" size=35 value="{{$password|htmlspecialchars}}" >
	  </td>
	</tr>

	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="loginmodetr">
		<td width="20%" align=right>
		{{$language.Loginmode}}	
		</td>
		<td width="80%">
				<select  class="wbk"  name="l_id" onchange="changeport(1)">
		{{section name=g loop=$allmethod}}
			<OPTION id ="{{$allmethod[g].login_method}}" VALUE="{{$allmethod[g].id}}" {{if $allmethod[g].id == $l_id}}selected{{/if}}>{{if $allmethod[g].login_method eq 'apppub'}}应用发布{{else}}{{$allmethod[g].login_method}}{{/if}}</option>
		{{/section}}
		</select>
		<span id="sftp_tr">是否支持sftp传输:<INPUT id="sftp" {{if $sftp == 1}} checked {{/if}} type=checkbox name=sftp value="on"> </span>
	  </td>
	</tr>

	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}  id="porttr">
	  		<td width="20%" align=right>
		{{$language.port}}	
		</td>
		<td width="80%">
		<input type=text name="port" id="port" size=4 value="{{if $port}}{{$port}}{{else}}{{$sshport}}{{/if}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="expiretr">
		<td width="20%" align=right>
		{{$language.Expiretime}}
		</td>
       <TD width="80%"><INPUT value="{{$limit_time}}" id="limit_time" name="limit_time">
                      <IMG onClick="getDatePicker('limit_time', event)" 
                                src="{{$template_root}}/images/time.gif"> {{$language.clicktoselectdate}}{{$language.or}}{{$language.select}} {{$language.AlwaysValid}}<INPUT {{if $nolimit == 1}} checked {{/if}} type=checkbox name="nolimit">  
                                </TD>
	</tr>
    {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="loginmodetr">
		<td width="20%" align=right>
		用户终端
		</td>
		<td width="80%">
		<select  class="wbk"  name="encoding" >
			<OPTION VALUE="0" {{if !$encoding }}selected{{/if}}>默认</option>
			<OPTION VALUE="1" {{if $encoding }}selected{{/if}}>GB2312</option>
		</select>
		
	  </td>
	</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="loginmodetr">
		<td width="20%" align=right>
		命令授权用户
		</td>
		<td width="80%">
		<select  class="wbk"  name="commanduser" >
		{{section name=m loop=$allmembers}}
		{{if $allmembers[m].username eq 'admin'}}
			<OPTION VALUE="{{$allmembers[m].uid}}" {{if $allmembers[m].uid eq $commanduser }}selected{{/if}}>{{$allmembers[m].username}}</option>
		{{/if}}
		{{/section}}
		</select>
		
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="rdpmode">
		<td width="20%" align=right>
		RDP加密模式
		</td>
		<td width="80%">
		<select  class="wbk"  name="mode" >
			<OPTION VALUE="0" {{if !$mode }}selected{{/if}}>自动</option>
			<OPTION VALUE="1" {{if $mode eq 1 }}selected{{/if}}>RDP加密</option>
			<OPTION VALUE="2" {{if $mode eq 2 }}selected{{/if}}>SSL加密</option>
		</select>
		
	  </td>
	</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} >
		<TD width="20%" align=right>启用 </TD>
                  <TD width="80%"><INPUT id="enable" {{if $enable == 1}} checked {{/if}} type=checkbox name=enable value="on">                  </TD>
                </TR>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="autotr">
		<TD width="20%" align=right>{{$language.automaticallyeditpassword}} </TD>
                  <TD width="80%"><INPUT id="automp" {{if $auto == 1}} checked {{/if}} type=checkbox name=auto value="on">                  </TD>
                </TR>
	
          {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="automutr">
		<TD width="20%" align=right>{{$language.masteraccountforeditingpassword}} </TD>
                  <TD width="80%"><INPUT id="automp2" {{if $master_user == 1}} checked {{/if}} type=checkbox name=automu value="on">                  </TD>
                </TR>    
		{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="su_passwdtr" >
		<TD width="20%" align=right>改密时su为超级用户: </TD>
                  <TD width="80%"><INPUT id="su_passwd" {{if $su_passwd == 1}} checked {{/if}} {{if !$id and $su_passwd}}checked{{/if}} type=checkbox name=su_passwd value="on">  
                </TR>    
           {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="entrust_passwordtr" >
		<TD width="20%" align=right>自动登录: </TD>
                  <TD width="80%"><INPUT id="entrust_password" {{if $entrust_password == 1}} checked {{/if}} type=checkbox name=entrust_password value="on">                  </TD>
                </TR>    	
	 {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="logincommittr" >
		<TD width="20%" align=right>操作记录: </TD>
                  <TD width="80%"><INPUT id="logincommit" {{if $logincommit == 1}} checked {{/if}} type=checkbox name=logincommit value="on">                  </TD>
                </TR>    
	 {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="publickey_authtr" >
		<TD width="20%" align=right>公钥私钥认证: </TD>
                  <TD width="80%"><INPUT id="publickey_auth" {{if $publickey_auth == 1}} checked {{/if}} onclick="privatekey_set()" type=checkbox name=publickey_auth value="on">  
                </TR>    
     {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="ipv6tr" >
		<TD width="20%" align=right>IPV6优先: </TD>
                  <TD width="80%"><INPUT id="ipv6enable" {{if $ipv6enable == 1}} checked {{/if}} {{if !$id and $dipv6enable}}checked{{/if}} type=checkbox name=ipv6enable value="on">  
                </TR>    
 {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="keyboardtr" >
		<TD width="20%" align=right>键盘记录: </TD>
                  <TD width="80%"><INPUT id="key_input" {{if $key_input == 1}} checked {{/if}} {{if !$id or $key_input}}checked{{/if}} type=checkbox name=key_input value="on">  
                </TR>    
				 {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="forwardtr" >
		<TD width="20%" align=right>进向加速: </TD>
                  <TD width="80%"><INPUT id="fastpath_input" {{if $fastpath_input == 1}} checked {{/if}} {{if !$id and $fastpath_input}}checked{{/if}} type=checkbox name=fastpath_input value="on">  
                </TR>    
				 {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="outforwardtr" >
		<TD width="20%" align=right>出向加速: </TD>
                  <TD width="80%"><INPUT id="fastpath_output" {{if $fastpath_output == 1}} checked {{/if}} {{if !$id and $fastpath_output}}checked{{/if}} type=checkbox name=fastpath_output value="on">  
                </TR>    
				
         {{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	  <td width="20%" align="right"  valign=top>{{$language.bind}}{{$language.group}}
	  <table border=0 width="100%" style="border:0px;">
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;">只显示已授权<input type="checkbox" name='showcheckeduser' {{if $smarty.get.bindgroup eq 1}}checked{{/if}} onclick="reload('bindgroup=1','bindgroup=0',this.checked);"></td></tr>
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;">只显示未授权<input type="checkbox" name='showuncheckeduser' {{if $smarty.get.bindgroup eq 2}}checked{{/if}} onclick="reload('bindgroup=2','bindgroup=0',this.checked);"></td></tr>
	  </table>
	  </td>
	  <td >
	  <table>
	<tr>
		{{section name=u loop=$usergroup}}
		{{if !$smarty.get.bindgroup or ($smarty.get.bindgroup eq 2 and $usergroup[u].check eq '') or ($smarty.get.bindgroup eq 1 and $usergroup[u].check eq 'checked')}}
		<td width="180"><input type="checkbox" name='Group{{$smarty.section.u.index}}' value='{{$usergroup[u].id}}'  {{$usergroup[u].check}}><a onclick="setSave();window.open ('admin.php?controller=admin_pro&action=passedit_selgroup&gid={{$usergroup[u].id}}&sid={{$id}}&sessionlgroup={{$sessionlgroup}}', 'newwindow', 'height=550, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;"  href="#" target="_blank" >{{$usergroup[u].groupname}}</a></td>{{if ($smarty.section.u.index +1) % 5 == 0}}</tr><tr>{{/if}}
		{{/if}}
		{{/section}}
	</tr></table>
	  </td>
	  </tr>
	  <tr><td></td><td></td></tr>
		{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="20%" align=right  valign=top>
		{{$language.bind}}{{$language.User}}
		<table border=0 width="100%" style="border:0px;">
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;">只显示已授权<input type="checkbox" name='showcheckeduser' {{if $smarty.get.binduser eq 1}}checked{{/if}} value=1 onclick="reload('binduser=1','binduser=0',this.checked);"></td></tr>
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;">只显示未授权<input type="checkbox" name='showuncheckeduser' {{if $smarty.get.binduser eq 2}}checked{{/if}} value=2 onclick="reload('binduser=2','binduser=0',this.checked);"></td></tr>
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;"><input type="button" name='batchselect' class="an_06" value="批量选择" onclick="window.open('admin.php?controller=admin_pro&action=xzuser', 'newwindow','height=650, width=700, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');" ></td></tr>
	  <tr><td align="right" style="border-bottom:0px;border-top:0px;border-left:0px;border-right:0px;">全选<input type="checkbox" value=2 onclick="checkAll(this.checked);"></td></tr>
	  </table>
		</td>
		<td width="80%">
		<table><tr >
		{{section name=g loop=$allmem}}
		{{if !$smarty.get.binduser or ($smarty.get.binduser eq 2 and $allmem[g].check eq '') or ($smarty.get.binduser eq 1 and $allmem[g].check eq 'checked')}}
		<td width="180"><input type="checkbox" name='Check{{$smarty.section.g.index}}' value='{{$allmem[g].uid}}'  {{$allmem[g].check}}><a onclick="setSave();window.open ('admin.php?controller=admin_pro&action=passedit_seluser&uid={{$allmem[g].uid}}&sid={{$id}}&sessionluser={{$sessionluser}}', 'newwindow', 'height=550, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');return false;" href="#" target="_blank" >{{if $allmem[g].binded}}<font color="red">{{/if}}{{$allmem[g].username}}({{if $allmem[g].realname}}{{$allmem[g].realname}}{{else}}未设置{{/if}}){{if $allmem[g].binded}}</font>{{/if}}</a></td>{{if ($smarty.section.g.index +1) % 5 == 0}}</tr><tr>{{/if}}
		{{/if}}
		{{/section}}
		</tr></table>
	  </td>
	  </tr>
	 
	<tr><td></td><td><input type=submit  value="{{$language.Save}}" class="an_02" >&nbsp;&nbsp;&nbsp;&nbsp;<input type=button  value="检测" onclick="test_port();" class="an_02"></td></tr></table>
<input type="hidden" name="logtab" value="{{$logtab.id}}" />
<input type="hidden" name="sessionlgroup" value="{{$sessionlgroup}}" />
<input type="hidden" name="sessionluser" value="{{$sessionluser}}" />
</form>
	</td>
  </tr>
  <tr><td colspan="2" height="25"></td></tr>
</table>
 <SCRIPT type=text/javascript>
var siteUrl = "{{$template_root}}/images/date";
function test_port(){
	var port = document.getElementById('port').value;
	if(!/[0-9]+/.test(port)){
		alert('端口请输入数字');
		return ;
	}
	document.getElementById('hide').src='admin.php?controller=admin_pro&action=test_port&ip={{$ip}}&port='+port;
	//alert(document.getElementById('hide').src);
}
function changeport(cp) {
	if(document.getElementById("ssh").selected==true)  {	
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='';
		document.getElementById("sftp_tr").style.display='';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("telnet").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$telnetport}};
	}
	if(document.getElementById("ftp").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='none';
		document.getElementById("automutr").style.display='none';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$ftpport}};
	}
	if(document.getElementById("sftp").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='none';
		document.getElementById("automutr").style.display='none';
		document.getElementById("entrust_password").style.display='block';
		document.getElementById("publickey_authtr").style.display='block';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("RDP").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("rdpmode").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$rdpport}};
	}
	if(document.getElementById("vnc").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$vncport}};
	}
	/*if(document.getElementById("X11").selected==true)  {
		//appset('');
		
		document.getElementById("autotr").style.display='';
		document.getElementById("automutr").style.display='';
		document.getElementById("entrust_password").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$x11port}};
	}*/
	if(document.getElementById("rlogin").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';//alert(document.getElementById("sftp_tr").style.display);
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$rdpport}};
	}
	if(document.getElementById("ssh1").selected==true)  {
		//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='block';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("apppub").selected==true)  {
		//appset('none');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$rdpport}};
	}
	/*if(document.getElementById("Web").selected==true)  {
		//appset('');
		
		document.getElementById("webmethod1").style.display='';
		document.getElementById("webmethod2").style.display='';
		document.getElementById("webmethod3").style.display='';
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = 3389;
	}
	if(document.getElementById("Oracle").selected==true)  {
		appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("Sybase").selected==true)  {
	document.getElementById("publickey_authtr").style.display='none';
	document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
	//appset('');
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("DB2").selected==true)  {;
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$sshport}};
	}
	if(document.getElementById("RDP2008").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$rdpport}};
	}
	if(document.getElementById("replay").selected==true)  {
	//appset('');
		document.getElementById("publickey_authtr").style.display='none';
		document.getElementById("sftp_tr").style.display='none';
		document.getElementById("rdpmode").style.display='none';
		if(cp==1)
		document.getElementById('port').value = {{$rdpport}};
	}*/
	
	
}
function appset(enable){
	document.getElementById("usernametr").style.display=enable;
	document.getElementById("originalpasswordtr").style.display=enable;
	document.getElementById("originalpassword2tr").style.display=enable;
	document.getElementById("porttr").style.display=enable;
	document.getElementById("expiretr").style.display=enable;
	document.getElementById("autotr").style.display=enable;
	document.getElementById("automutr").style.display=enable;
	document.getElementById("entrust_passwordtr").style.display=enable;
}

function checkAll(c){
	var targets = document.getElementsByTagName('input');
	for(var j=0; j<targets.length; j++){
		if(targets[j].name.substring(0,5)=='Check'){
			targets[j].checked=c;
		}
	}
}

{{if !$id}}
{{if $devicetype eq 'windows' or $devicetype eq 'Win2008' or $devicetype eq 'Windows 2008'}}
document.getElementById("RDP").selected=true;
document.getElementById('port').value = {{$rdpport}};
{{elseif $devicetype eq 'linux'}}
document.getElementById("ssh").selected=true;
{{elseif $devicetype eq 'unix'}}
document.getElementById("telnet").selected=true;
{{/if}}
{{else}}
if(document.getElementById("ssh").selected==true)
document.getElementById("sftp_tr").style.display='';
{{/if}}

function privatekey_set(){
}

{{if $entrust_username eq 0 && $id}}
temptyuser(true);
{{/if}}
change_for_user_auth();
usernameselect();
changeport(0);

var saveAccount = false;
function saveTitle(e){
	if(saveAccount){
		//alert("绑定信息需要点击'保存修改'才能存盘");
		return  e.returnValue='绑定信息需要点击 保存修改 才能存盘,你真的要不保存离开吗？';
		
	}
	return true;
}
function setSave(){
	saveAccount=true;
}
function reload(p1,p2,check){
	window.location=window.location+'&'+(check ? p1 : p2);
}

{{if $_config.LDAP}}
{{$changelevelstr}}
{{/if}}
</SCRIPT>
</body>
<iframe name="hide" id="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



