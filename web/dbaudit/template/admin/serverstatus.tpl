<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>服务{{$language.List}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}</div></td></tr>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<tr>
				<th class="list_bg"  width="20%">{{$language.ServiceName}}</th>
				<th class="list_bg"  width="10%">{{$language.Status}}</th>
				<th class="list_bg"  width="10%">{{$language.version}}</th>
				<th class="list_bg"  width="10%">{{$language.Operate}}</th>
			</tr>
			{{section name=t loop=$allcommand}}
			<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
				<td>{{$allcommand[t].name}}</td>
				<td>{{if $allcommand[t].status eq 1}}<font color="green">正常</font>{{else}}<font color="red">{{$language.Failed}}</font>{{/if}}</ td>
				<td>{{$allcommand[t].version}}</td>
				<td>
				{{if $allcommand[t].status eq 1}}<img src='{{$template_root}}/images/069.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname={{$allcommand[t].sname}}&ac=restart">{{$language.Restart}}</a>{{/if}}
				{{if $allcommand[t].status eq 0}}<img src='{{$template_root}}/images/069.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname={{$allcommand[t].sname}}&ac=start">{{$language.Start}}</a>{{/if}}
				{{if $allcommand[t].status eq 1}}<img src='{{$template_root}}/images/070.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_sysmanage&action=serverstatus&sname={{$allcommand[t].sname}}&ac=stop">{{$language.Stop}}</a>{{/if}}
				
				</td>
			</tr>
			{{/section}}
			
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


