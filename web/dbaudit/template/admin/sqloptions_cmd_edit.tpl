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

<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_sqloptions&action=sqloptions_cmd&optionsname={{$optionsname}}&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
<tr>

            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_sqloptions&action=sqloptions_cmd_save&optionsname={{$optionsname}}">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	{{assign var="trnumber" value=0}}
	{{section name=c loop=20}}
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right  valign="top">
		命令{{$smarty.section.c.index+1}}:
		</td>
		<td width="67%">
		<input type = text name="commands[]">
	  </td>
	</tr>
	{{/section}}

	<tr>
		<td></td>
		<td><input type="submit"  value=" {{$language.Add}} " class="an_02"></td>
	</tr>
	</table>
<br>
<input type="hidden" name="add" value="new" />
<input type="hidden" name="optionsname" value="{{$optionsname}}" />
</form>
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

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

document.getElementById("telnet").selected = true;


</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


