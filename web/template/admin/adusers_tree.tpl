<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="{{$template_root}}/cssjs/jquery.csv-0.71.min.js"></script>
<script type="text/javascript" src="{{$template_root}}/cssjs/ajaxdtree.js"></script>
</head>
<style>
.dtree {width: auto;overflow: scroll;height:400px;}
</style>
<script type="text/javascript">
function checkgroup(c, g){
	var elements = document.getElementsByTagName('input');
	for(var i=0; i<elements.length; i++){
		if(elements[i].type=='checkbox'&&elements[i].id.indexOf('u_'+g+'_')>=0){
			document.getElementById(elements[i].id).checked = c;
		}
	}

	return true;
}

var foundparent = false;
var servergroup = new Array();
var usergroup = new Array();
var alluser = new Array();
var allserver = new Array();
var i=0;
{{section name=a loop=$allsgroup}}
servergroup[i++]={id:{{$allsgroup[a].id}},name:'{{$allsgroup[a].groupname}}',ldapid:{{$allsgroup[a].ldapid}},level:{{$allsgroup[a].level}}};
{{/section}}
var i=0;
{{section name=au loop=$alluser}}
alluser[i++]={uid:{{$alluser[au].uid}},username:'{{$alluser[au].username}}',realname:'{{$alluser[au].realname}}',groupid:{{$alluser[au].groupid}},level:{{$alluser[au].level}}};
{{/section}}
var i=0;
{{section name=as loop=$allserver}}
allserver[i++]={hostname:'{{$allserver[as].hostname}}',device_ip:'{{$allserver[as].device_ip}}',groupid:{{$allserver[as].groupid}}};
{{/section}}

{{if $_config.LDAP}}
function change_user_or_server_group(v, d, id_servergroup, id_usergroup)
{
	if(id_servergroup.length>0){
		document.getElementById(id_servergroup).options.length=0;		
		{{if $logined_user_level }}
		document.getElementById(id_servergroup).options[document.getElementById(id_servergroup).options.length]=new Option('无', 0);
		{{/if}}
		var found = 0;
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					var selected_i = document.getElementById(id_servergroup).options.length;
					document.getElementById(id_servergroup).options[document.getElementById(id_servergroup).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById(id_servergroup).options[document.getElementById(id_servergroup).options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
		document.getElementById(id_servergroup).options.selectedIndex = selected_i;
	}

	if(id_usergroup.length>0){
		document.getElementById(id_usergroup).options.length=0;		
		{{if $logined_user_level }}
		document.getElementById(id_usergroup).options[document.getElementById(id_usergroup).options.length]=new Option('无', 0);
		{{/if}}
		var found = 0;
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v ){
				if(d==servergroup[i].id){
					found = 1;
					var selected_i = document.getElementById(id_usergroup).options.length;
					document.getElementById(id_usergroup).options[document.getElementById(id_usergroup).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById(id_usergroup).options[document.getElementById(id_usergroup).options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
		document.getElementById(id_usergroup).options.selectedIndex = selected_i;
	}
}

function changelevels(v, d, id_ldapid1, id_ldapid2, id_servergroup, id_usergroup){
	document.getElementById(id_ldapid2).options.length=0;
	{{if $logined_user_level eq 1}}
	document.getElementById(id_ldapid2).options[document.getElementById(id_ldapid2).options.length]=new Option('无', 0);
	{{/if}}
	var found = 0;
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==2){
			if(d==servergroup[i].id){
				found = 1;
				var selected_i = document.getElementById(id_ldapid2).options.length;
				document.getElementById(id_ldapid2).options[document.getElementById(id_ldapid2).options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById(id_ldapid2).options[document.getElementById(id_ldapid2).options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}
	document.getElementById(id_ldapid2).options.selectedIndex = selected_i;

	change_user_or_server_group(v, d, id_servergroup, id_usergroup);	
}

function changelevel2(v, d, id_ldapid1, id_ldapid2, id_servergroup, id_usergroup){
	if(v!=0){
		change_user_or_server_group(v, d, id_servergroup, id_usergroup);
	}else{
		//changelevels(document.getElementById(id_ldapid1).options[document.getElementById(id_ldapid1).options.selectedIndex].value, d, id_ldapid1, id_ldapid2, id_servergroup, id_usergroup);
		change_user_or_server_group(v, d, id_servergroup, id_usergroup);
	}
}
{{/if}}
</script>
<body>
{{if !$step }}
<FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=adusers" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<tr bgcolor="f7f7f7"><td align="right">AD 服务器:</td>		
	<td>
		<input type="text" class="wbk" name="address" value="{{$adconfig.address}}" />	
		</td>	
	<td align="right">
		 AD域 :</td>		
	<td>
		<input type="text" class="wbk" name="domain" value="{{$adconfig.domain}}" />	
		</td>		
	</tr>

	<tr bgcolor=""><td align="right">AD 服务器账号:</td>		
	<td>
		<input type="text" class="wbk" name="adusername" value="{{$adconfig.adusername}}" />	
		</td>
<td align="right"> AD 服务器密码:</td>		
	<td>
		<input type="password" class="wbk" name="adpassword" value="{{$adconfig.adpassword}}" />	</td>
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">OU:</td>		
	<td colspan="3">
		<input type="text" class="wbk" name="ou" value="{{$adconfig.ou}}" />&nbsp;&nbsp;&nbsp;&nbsp;ou=ou名称1,ou=ou名称2
		</td>
	</tr>
                  <TR>
                    <TD colspan="4" align="center"><INPUT class="an_02" type="submit" value="提交"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>

{{elseif $step eq 1}}
 <FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=adusers_save" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<TR id="autosutr" {{if $smarty.section.i.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                    <TD width="20%" align="center">用户名 选择				
					</TD>
                  </TR>
				
                  <TR id="autosutr" {{if $smarty.section.i.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                    <TD>
					<table><tr >
		{{section name=i loop=$members}}
		{{if !$members[i].checked}}
		<td width="150"><input type='checkbox' name='username[]' value='{{$members[i].username}}' >{{$members[i].username}}</td>{{if ($smarty.section.i.index +1) % 5 == 0}}</tr><tr>
		
				 {{/if}} {{/if}} 
				{{/section}}
		</tr></table>
<div class="dtree" id="dtree1">
	<script type="text/javascript">

		ddev = new dTree('ddev',"dtree1",'users');
		ddev.icon['folder'] = 'template/admin/cssjs/img/group.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/groupopen.png';
		ddev.icon['node'] = 'template/admin/cssjs/img/user.gif';
		var i=0;
		ddev.add(0,-1,'{{$domain}}','#','');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		{{section name=ac loop=$cns}}
			ddev.add({{$smarty.section.ac.index+1}},0,'<input type="checkbox" id="{{$smarty.section.ac.index+1}}" name="cn[]" value="" onclick="checkgroup(this.checked,{{$smarty.section.ac.index+1}});">{{$cns[ac]}}','javascript:ddev.getChildren({{$smarty.section.ac.index+1}}, \'\', \'\', \'{{$cns[ac]}}\', \'{{$dn}}\');','{{$cns[ac]}}',null,ddev.icon.folder);
		{{/section}}
		{{section name=ao loop=$ous}}
			ddev.add({{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}},0,'<input type="checkbox" id="{{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}" name="group[]" value="" onclick="checkgroup(this.checked,{{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}});">{{$ous[ao]}}','javascript:ddev.getChildren({{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}, \'\', \'{{$ous[ao]}}\', \'\', \'{{$dn}}\');','{{$ous[ao]}}',null,ddev.icon.folder);
		{{/section}}
		{{section name=ag loop=$groups}}
			ddev.add({{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}},0,'<input type="checkbox" id="{{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}}" name="group[]" value="" onclick="ddev.o({{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}});checkgroup(this.checked,{{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}});">{{$groups[ag].groupname}}','javascript:ddev.getChildren({{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}}, \'{{$groups[ag].groupname}}\', \'\',\'\', \'{{$dn}}\');','{{$groups[ag].groupname}}',null,ddev.icon.folder);
		{{/section}}
		{{section name=nu loop=$nogroupusers}}
			ddev.add({{$smarty.section.ac.index+1}}{{$smarty.section.ao.index+1}}{{$smarty.section.ag.index+1}}{{$smarty.section.nu.index}},0,'<input type="checkbox" name="username[]" value="{{$nogroupusers[nu]}}" >{{$nogroupusers[nu]}}','#','{{$nogroupusers[nu]}}');
		{{/section}}
		ddev.show();	
		ddev.s(0);
	</script>
</div>
					</TD>
                  </TR>				
                  <TR>
                    <TD colspan="2" align="center">密码<input type='password' name='password' class="input_shorttext" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT class="an_02" type="submit" value="保存修改"></TD>
                  </TR>
                </TBODY>
              </TABLE>
			  <input type="hidden" name="step" value="2" />
</FORM>
{{else}}
<FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=adusers_save" method="post">

              <TABLE width="50%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<tr bgcolor="f7f7f7"><td align="center">OU</td>		
	<td align="center">
		 运维组</td>
	</tr>
{{section name=o loop=$ous}}
	<tr bgcolor=""><td align="center">{{$ous[o]}}</td>		
<td align="center">
<select name="g_{{$smarty.section.o.index}}" >
{{section name=g loop=$groups}}
<option value="{{$groups[g].id}}">{{$groups[g].groupname}}</option>
{{/section}}
</select>
</td>		
	</tr>
{{/section}}
                  <TR>
                    <TD colspan="4" align="center"><INPUT class="an_02" type="submit" value="提交"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>
{{/if}}
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



