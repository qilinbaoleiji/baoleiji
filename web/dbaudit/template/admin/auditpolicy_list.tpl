<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>黑名单分组列表</title>
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
  <tr>
	<td class="">
	
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<form name="ip_list" action="admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype={{$dbtype}}" method="post">
			<tr>
				<th class="list_bg"  width="3%">选择</th>
				<th class="list_bg"  width="15%"><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_list&orderby1=optionsname&orderby2={{$orderby2}}&dbtype={{$dbtype}}" >审计策略</a></th>
				<th class="list_bg"  width="15%">操作</th>
			</tr>
			{{section name=t loop=$allcommand}}
			<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
				<td><input type="checkbox" name="chk_gid[]" value="{{$allcommand[t].id}}"></td>
				<td><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&id={{$allcommand[t].id}}">{{$allcommand[t].name}}</a></td>
				<td style="TEXT-ALIGN: left;"><img src="{{$template_root}}/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&dbtype={{$dbtype}}&id={{$allcommand[t].id}}">编辑</a>	| <img src="{{$template_root}}/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="#" onclick="window.open('admin.php?controller=admin_auditpolicy&action=setorder&dbtype={{$dbtype}}&id={{$allcommand[t].id}}', 'newwindow', 'height=80, width=100, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no'); return false;">移动</a>
			
				| <img src="{{$template_root}}/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype={{$dbtype}}&id={{$allcommand[t].id}}">删除</a>
				</td>
			</tr>
			{{/section}}
			<tr>
				<td colspan="2" align="left">
					<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_gid[]')e.checked=this.form.select_all.checked;}" value="checkbox">选中本页显示的所有项目&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="my_confirm('删除所选IP');if(chk_form()) document.ip_list.action='admin.php?controller=admin_auditpolicy&action=del_auditpolicy&dbtype={{$dbtype}}'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="window.location='admin.php?controller=admin_auditpolicy&action=auditpolicy_edit&dbtype={{$dbtype}}'" type="button"  value="增加" class="an_02" />
									</td>	
									
		
			
				<td colspan="2" align="right">
				
					共{{$command_num}}执行命令  {{$page_list}}  页次：{{$curr_page}}/{{$total_page}}页  {{$items_per_page}}条日志/页  页 
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



