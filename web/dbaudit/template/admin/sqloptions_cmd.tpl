<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Black}}{{$language.group}}{{$language.List}}</title>
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
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_sqloptions&back=1"><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
  
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_sqloptions&action=del_sqloptions_cmd" method="post">
			<tr>
<th width="3%">&nbsp;</th>
				<th class="list_bg"  width="35%"><a href="admin.php?controller=admin_sqloptions&action=forbiddengps_cmd&orderby1=commands&gid={{$gid}}&orderby2={{$orderby2}}" >{{$language.Command}}</a></th>
				<th class="list_bg"  width="10%"><a href="admin.php?controller=admin_sqloptions&action=forbiddengps_cmd&orderby1=groupname&gid={{$gid}}&orderby2={{$orderby2}}" >{{$language.groupname}}</a></th>
				<th class="list_bg">{{$language.Operate}}</th>
			</tr>
			{{section name=t loop=$allcommand}}
			<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
				<td ><input type="checkbox" name="chk_member[]" value="{{$allcommand[t].id}}" /></td>
				<td>{{$allcommand[t].sql_cmd}}</td>
				<td>{{$allcommand[t].optionsname}}</td>
				<td>
				<img src="{{$template_root}}/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_sqloptions&action=del_sqloptions_cmd&id={{$allcommand[t].id}}&gid={{$gid}}">{{$language.Delete}}</a>				
				</td>
			</tr>
			{{/section}}
			
			
			<tr>
			<td align="left" colspan="2"><input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">{{$language.select}}{{$language.this}}{{$language.page}}{{$language.displayed}}&nbsp;&nbsp;<input type="submit"  value="批量删除" onClick="my_confirm('{{$language.DeleteUsers}}');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=delete_all'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button"  onclick="window.location='admin.php?controller=admin_sqloptions&action=sqloptions_cmd_edit&optionsname={{$optionsname}}'" name="submit"  value="{{$language.Add}}" class="an_02">

			<input type="hidden" name="add" value="new" >
			</td>
				<td colspan="{{if !$ginfo.black_or_white}}4{{else}}3{{/if}}" align="right">
					{{$language.all}}{{$command_num}}{{$language.Command}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}{{$language.item}}{{$language.Log}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_sqloptions&action=dangerlist&page='+this.value;">{{$language.page}}
				</td>
			</tr>
			</form>
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


