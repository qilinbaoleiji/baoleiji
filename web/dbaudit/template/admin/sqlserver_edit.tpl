<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>
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
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_sqlservercfg&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_sqlservercfg&action=sqlserver_save&id={{$users.id}}">
					{{assign var="trnumber" value=0}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>名称：</td>
						<td><input type="text" name="name" class="wbk input_shorttext" {{if $users.id}}readonly{{/if}} value="{{$users.name}}"></td>
					</tr>
					{{assign var="trnumber" value=0}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>服务器：</td>
						<td><input type="text" name="server" class="wbk input_shorttext" {{if $users.id}}readonly{{/if}} value="{{$users.server}}"></td>
					</tr>
				
						
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>数据库用户：</td>
						<td><input type="text"  name="username" class="wbk input_shorttext" value="{{$users.username}}"></td>
					</tr>
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>数据库密码：</td>
						<td><input type="password" name="password" class="wbk input_shorttext"value="{{$users.password}}"></td>
					</tr>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>重复数据库密码：</td>
						<td><input type="password" name="repassword" class="wbk input_shorttext"value="{{$users.password}}"></td>
					</tr>
				
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td colspan="2" align="center"><input type="submit"  value="{{$language.Save}}" class="an_02"></td>
					</tr>	
</form>
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


