<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/dtree.js"></script>
</head>
<style>
.dtree {width: auto;overflow: scroll;height:400px;}
</style>
<script type="text/javascript">
function checkgroup(c, g, num){
	for(var i=1; i<=num; i++){
		document.getElementById('u_'+g+''+i).checked = c;
	}
}
</script>
<body>
{{if !$step }}
<FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=ldapusers" method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
				<tr bgcolor="f7f7f7"><td align="right">LDAP 服务器:</td>		
	<td>
		<input type="text" class="wbk" name="address" value="{{$adconfig.address}}" />	
		</td>	
	<td align="right">
		 LDAP域 :</td>		
	<td>
		<input type="text" class="wbk" name="domain" value="{{$adconfig.domain}}" />	
		</td>		
	</tr>

	<tr bgcolor="f7f7f7"><td align="right">LDAP 服务器账号:</td>		
	<td>
		<input type="text" class="wbk" name="adusername" value="{{$adconfig.adusername}}" />	
		</td>
<td align="right"> LDAP 服务器密码:</td>		
	<td>
		<input type="password" class="wbk" name="adpassword" value="{{$adconfig.adpassword}}" />	</td>
	</tr>
<tr bgcolor="f7f7f7"><td align="right">OU:</td>		
	<td>
		<input type="text" class="wbk" name="ou" value="{{$adconfig.ou}}" />	
		</td>
<td align="right"> </td>		
	<td>
</td>
	</tr>
                  <TR>
                    <TD colspan="4" align="center"><INPUT class="an_02" type="submit" value="提交"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>

{{else}}
 <FORM name="f1" onSubmit="return check()" enctype="multipart/form-data" action="admin.php?controller=admin_config&action=ldapusers_save" method="post">

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

	<script type="text/javascript">
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		ddev.add(0,-1,'{{$domain}}','#','','main');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		{{section name=nu loop=$nogroupusers}}
			ddev.add({{$smarty.section.nu.index+1}},0,'<input type="checkbox" name="username[]" value="{{$nogroupusers[nu].username}}" >{{$nogroupusers[nu].username}}({{$nogroupusers[nu].name}})','#','{{$nogroupusers[nu].username}}({{$nogroupusers[nu].name}})','main');
		{{/section}}
		document.write(ddev);		
		ddev.s(0);
	</script>
					</TD>
                  </TR>
                  <TR>
                    <TD colspan="2" align="center">密码<input type='password' name='password' class="input_shorttext" />&nbsp;&nbsp;&nbsp;<input type="checkbox" name="radiusauth" class="" value="1" {{if $member.radiusauth}}checked{{/if}}>RADIUS证&nbsp;&nbsp;<input type="checkbox" name="ldapauth" class="" value="1" {{if $member.ldapauth}}checked{{/if}}>LDAP认证&nbsp;&nbsp;&nbsp;<INPUT class="an_02" type="submit" value="保存修改"></TD>
                  </TR>
                </TBODY>
              </TABLE>
</FORM>
{{/if}}
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



