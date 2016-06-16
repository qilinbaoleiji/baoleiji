<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/border-radius.css" />

<script language="javascript">
	function check_add_user(){
		return(true);
	}

var AllUsbKey = new Array();
var i=0;
{{section name=kk loop=$allusbkey}}
AllUsbKey[i++]='{{$allusbkey[kk].keyid}}';
{{/section}}
function filter(){
	var filterStr = document.getElementById('filtertext').value;
	var usbkeyid = document.getElementById('usbkeyid');
	usbkeyid.options.length=1;
	for(var i=0; i<AllUsbKey.length;i++){
		if(filterStr.length==0 || AllUsbKey[i].indexOf(filterStr) >= 0){
			usbkeyid.options[usbkeyid.options.length++] = new Option(AllUsbKey[i],AllUsbKey[i]);
		}
	}
}
</script>
<script language=javascript>  
//CharMode函数
//测试某个字符{{$language.Yes}}属于哪一类.  
function CharMode(iN){  
	if (iN>=48 && iN <=57) //数字  
		return 1;  
	if (iN>=65 && iN <=90) //大写字母  
		return 2;  
	if (iN>=97 && iN <=122) //小写  
		return 4;  
	else  
		return 8; //特殊字符  
}  
//bitTotal函数  
//计算出当前{{$language.Password}}当{{$language.normal}}一{{$language.all}}有多少种模式  
function bitTotal(num){  
	modes=0;  
	for (i=0;i<4;i++){  
		if (num & 1) modes++;  
		num>>>=1;  
	}  
	return modes;  
}  
//checkStrong函数  
//返回{{$language.Password}}的{{$language.strong}}度级别  
function checkStrong(sPW){  
	if (sPW.length<=8)  
	return 0; //{{$language.Password}}太短  
	Modes=0;  
	for (i=0;i<sPW.length;i++){  
	//测试每{{$language.one}}字符的类别并统计一{{$language.all}}有多少种模式.  
		Modes|=CharMode(sPW.charCodeAt(i));  
	}  
	return bitTotal(Modes);  
}  
//pwStrength函数  
//当{{$language.User}}放开键盘{{$language.or}}{{$language.Password}}{{$language.Input}}框失去焦点时,根据不同的级别{{$language.displayed}}不同的颜色  
function pwStrength(pwd){  
	O_color="#eeeeee";  
	L_color="#FF0000";  
	M_color="#FF9900";  
	H_color="#33CC00";  
if (pwd==null||pwd==''){  
	Lcolor=Mcolor=Hcolor=O_color;  
}else{  
	S_level=checkStrong(pwd);  
switch(S_level) {  
	case 0:  
	Lcolor=Mcolor=Hcolor=O_color;  
	case 1:  
	Lcolor=L_color;  
	Mcolor=Hcolor=O_color;  
	break;  
	case 2:  
	Lcolor=Mcolor=M_color;  
	Hcolor=O_color;  
	break;  
	default:  
	Lcolor=Mcolor=Hcolor=H_color;  
}  
}
document.getElementById("strength_L").style.background=Lcolor;  
document.getElementById("strength_M").style.background=Mcolor;  
document.getElementById("strength_H").style.background=Hcolor;  
return;  
}  
</script>  

</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1">
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_member&back=1" ><img src="{{$template_root}}/images/back1.png" border=0 /></a></span></div></td></tr>
	  <tr>
		<td >
			
	<form method="post" name="add_user" action="admin.php?controller=admin_member&action=save&uid={{$member.uid}}" onSubmit="javascript: return check_add_user();">
				<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable" >
				{{assign var="trnumber" value=0}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Username}}：</td>
						<td><input type="text" name="username" class="wbk input_shorttext" {{if $member.uid}}readonly{{/if}} value="{{$member.username}}"></td>
					</tr>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Password}}：</td>
						<td>
						<span style="float:left; padding-top:10px;"><input type="password" id="password1" name="password1" value="{{$member.password}}" class="input_shorttext" onKeyUp=pwStrength(this.value) 
onBlur=pwStrength(this.value) > {{$pwdshould}} <input onClick="setrandompwd();" id="autosetpwd" type="checkbox" name="autosetpwd" value="1" />随机密码</span><span style="float:left; padding-left:10px;"><table valign="middle" width="217" border="1" cellspacing="0" cellpadding="1" bordercolor="#ffffff"
 style='display:inline' class="BBtable">  
<tr align="center" bgcolor="#eeeeee">  
<td width="33%" id="strength_L">{{$language.weak}}</td>  
<td width="33%" id="strength_M">{{$language.normal}}</td>  
<td width="33%" id="strength_H">{{$language.strong}}</td>  
</tr>  
</table></span></td>
					</tr>
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Commitpassword}}：</td>
						<td><input type="password"  id="password2" name="password2" value="{{$member.password}}" class="input_shorttext"></td>
						</tr>
						
						{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="change_passwordtr">
		<TD width="33%" align=right>允许改密：</TD>
                  <TD width="67%"><input type="checkbox" name="allowchange" value="on" {{if $member.allowchange}}checked{{/if}}>      </TD>
                </TR>  
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Name}}：</td>
						<td><input type="text"  name="realname" class="wbk input_shorttext" value="{{$member.realname}}"></td>
					</tr>
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Mailbox}}：</td>
						<td><input type="text" name="email" class="wbk input_shorttext"value="{{$member.email}}"></td>
					</tr>
					
					
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>usbkey： </TD>
                  <TD>含有字符<input type="text" class="wbk" size="10" id="filtertext" onChange="filter();" />
                  <select  class="wbk"  name=usbkey id="usbkeyid">
                      <OPTION value="">{{$language.nobind}}</OPTION>
                     	{{section name=k loop=$allusbkey}}
				<option value="{{$allusbkey[k].keyid}}" {{if $allusbkey[k].keyid == $member.usbkey}}selected{{/if}}>{{$allusbkey[k].keyid}}</option>
			{{/section}}
                  </SELECT>       
                  &nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.php?controller=admin_member&action=create_file_usbkey&username={{$member.username}}" target="_blank">{{$language.createfilekey}}</a>           
				  </TD>
                </TR>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr id="loginleveltr" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
               
                  <TD  width="33%" align=right>登录级别： </TD>
                  <TD><select  class="wbk"  name=priv>
                     	{{section name=k loop=16}}
				<option value="{{$smarty.section.k.index}}" {{if $smarty.section.k.index == $priv}}selected{{/if}}>{{$smarty.section.k.index}}</option>
			{{/section}}
                  </SELECT>                  
				  </TD>
                </TR>
             
                
                {{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>默认控件： </TD>
                  <TD><select  class="wbk"  name=default_control>
                     <OPTION value="0" {{if $member.default_control eq 0}}selected{{/if}}>自动检测</OPTION>
                     <OPTION value="1" {{if $member.default_control eq 1}}selected{{/if}}>applet</OPTION>
                     <OPTION value="2" {{if $member.default_control eq 2}}selected{{/if}}>activeX</OPTION>
                  </SELECT>                  
				  </TD>
                </TR>
				{{if !$member.uid}}
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>{{$language.Level}}：</td>
						<td>
						<select  class="wbk"  name="level" onchange='changelevel(this.value);' {{if $smarty.session.ADMIN_LEVEL eq 3}}disabled='true'{{/if}}>
							<option value="1" {{if $member.level == 1}}selected{{/if}}>{{$language.Administrator}}</option>
							<option value="2" {{if $member.level == 2}}selected{{/if}}>{{$language.auditadministrator}}</option>
						</select>&nbsp;&nbsp;<input id="common_user_pri" type="checkbox" name="common_user_pri" {{if $member.common_user_pri}}checked{{/if}} value="on" />具有运维权限
						</td>
					</tr>
				{{/if}}
				{{if $member.level}}
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>具有运维权限：</td>
						<td>
						<input id="common_user_pri" type="checkbox" name="common_user_pri" {{if $member.common_user_pri}}checked{{/if}} value="on" />
						</td>
					</tr>
				{{/if}}
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		{{$language.effectatdate}}：		</td>
       <TD>
       <INPUT value="{{$member.start_time}}" id="start_time" name="start_time" >&nbsp;&nbsp;
<input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk"></TD>
	</tr>
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		{{$language.Expiretime}}：		</td>
       <TD>
       
       <INPUT value="{{if $member.end_time ne '2037-01-01 00:00:00'}}{{$member.end_time}}{{/if}}" id="limit_time" name="limit_time" onFocus="setday(this)">&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk"> 
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "start_time", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "limit_time", "%Y-%m-%d %H:%M:%S");


</script>
                      {{$language.AlwaysValid}}<INPUT value="1" {{if $member.end_time eq '2037-01-01 00:00:00' or !$member.end_time}} checked {{/if}} type=checkbox name="nolimit">  </TD>
	</tr>
					
				
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td colspan="2" align="center"><input type="submit"  value="{{$language.Save}}" class="an_02"></td>
					</tr>
				</table>
			</form>
			
		</td>
	  </tr>
	</table>
<script>
function changelevel(iid){
	if(iid!=0){
		document.getElementById('change_passwordtr').style.display = 'none';
		document.getElementById('loginleveltr').style.display = 'none';
		document.getElementById('common_user_pri').style.display = '';
	}else{
		
		document.getElementById('change_passwordtr').style.display = 'block';
		document.getElementById('loginleveltr').style.display = 'block';
		document.getElementById('common_user_pri').style.display = 'none';
	}
}
{{if $member.uid and $member.level > 0}}
	document.getElementById('loginleveltr').style.display = 'none';
	
{{/if}}

function setrandompwd(){
	if(document.getElementById('autosetpwd').checked){
		document.getElementById('password1').value='abc123!@#';
		document.getElementById('password2').value='abc123!@#';
	}else{
		document.getElementById('password1').value='';
		document.getElementById('password2').value='';
	}
}
{{if $member.level ne ''}}
changelevel({{$member.level}});
{{else}}
changelevel(0);
{{/if}}
{{if $smarty.session.ADMIN_LEVEL eq 3 and $smarty.session.ADMIN_MUSERGROUP}}
changelevel(0);
var ug = document.getElementById('usergroup');
for(var i=0; i<ug.options.length; i++){
	if(ug.options[i].value=={{$smarty.session.ADMIN_MUSERGROUP}}){
		ug.selectedIndex=i;
		ug.onchange = function(){ug.selectedIndex=i;}
		break;
	}
}
{{/if}}
</script>
</body>
</html>


