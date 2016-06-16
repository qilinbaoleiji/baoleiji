<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.SessionsList}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
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

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_sqlserver&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>

  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
			<tr>
				<th class="list_bg"  width="10%">{{$language.ExcuteTime}}</th>
				<th class="list_bg"  width="15%">{{$language.Command}}</th>		
				<th class="list_bg"  width="5%">是否运行成功</th>		
				<th class="list_bg"   width="5%">命令字节</th>
				<th class="list_bg"   width="5%">结果字节</th>
				<th class="list_bg"   width="5%">响应时间</th>
				<th class="list_bg"   width="5%">字段审计</th>
				<th class="list_bg"   width="5%">详细</th>
			</tr>
			{{section name=t loop=$allcommand}}
			<tr {{if $allcommand[t].dangerlevel > 5}}bgcolor="red"{{elseif $allcommand[t].dangerlevel > 0}}bgcolor="yellow" {{elseif $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>

				<td>{{$allcommand[t].at}}</ td>
				<td>{{$allcommand[t].cmd}}</td>
				<td>{{if $allcommand[t].success}}成功{{else}}失败{{/if}}</td>
				<td>{{$allcommand[t].cmd_bytes}}</td>
				<td>{{$allcommand[t].result_bytes}}</td>
				<td>{{$allcommand[t].return_time}}</td>
				<td>{{if $allcommand[t].return_result_content and $allcommand[t].return_result_title}}是{{else}}不{{/if}}</td>
				<td>{{*<a href="admin.php?controller=admin_sqlnet&action=download&sid={{$allcommand[t].sid}}")>{{$language.Download}}</a>|*}}<img src="{{$template_root}}/images/doc_table.gif" width="16" height="16" align="absmiddle"><a style="cursor:hand" onclick="javascript:window.open('admin.php?controller=admin_sqlserver&action=cmddetail&cid={{$allcommand[t].cid}}&tablename={{$tablename}}','newwin')" >详细</a></td>
			</tr>
			{{/section}}
			<tr>
				<td colspan="12" align="right">
					{{$language.all}}{{$command_num}}{{$language.Command}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}{{$language.item}}{{$language.Log}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_sqlnet&action=view&page='+this.value;">{{$language.page}}  
				<!--
				<select  class="wbk"  name="table_name">
				{{section name=t loop=$table_list}}
				<option value="{{$table_list[t]}}" {{if $table_list[t] == $now_table_name}}selected{{/if}}>{{$table_list[t]}}</option>
				{{/section}}
				</select>
				-->
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


