<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>
				   {{*<TR>
<form name="f1" method=post action="admin.php?controller=dbserver&action=dev_group_save">
服务器组名称称<input type = text name="groupname">
<input type="submit"  value="增加服务器组" class="an_02">
</form>
                  </TR>*}}
                  <TR>

                    <th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=ip&orderby2={{$orderby2}}" >服务器IP</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=hostname&orderby2={{$orderby2}}" >服务器名称</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=dbtype&orderby2={{$orderby2}}" >数据库类型</a></th>
					<th class="list_bg" ><a href="admin.php?controller=admin_dbserver&action=dbserver&orderby1=desc&orderby2={{$orderby2}}" >描述</a></th>
					<th class="list_bg" >操作</th>
                  </TR>

            </tr>
			{{section name=t loop=$s}}
			<tr  {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&groupid={{$s[t].id}}" >{{$s[t].ip_addr}}</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&hostname={{$s[t].hostname}}" >{{$s[t].hostname}}</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&dbtype={{$s[t].dbtype}}" >{{$s[t].dbtype}}</a></td>
 <td> <a href="admin.php?controller=admin_dbserver&action=dbserver_list&desc={{$s[t].desc}}" >{{$s[t].desc}}</a></td>
				<td style="TEXT-ALIGN: left;"><img src='{{$template_root}}/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_dbserver&action=dbserver_edit&id={{$s[t].id}}" >编辑</a>
				| <img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_dbserver&action=dbserver_delete&id={{$s[t].id}}';}">删除</a>
				</td> 
			</tr>
			{{/section}}
	          <tr>
	          
				<td  colspan="5" align="right"><input type="button" onclick="window.location='admin.php?controller=admin_dbserver&action=dbserver_edit'" name="submit" value=" 增加 " class="an_02" />&nbsp;&nbsp;&nbsp;&nbsp;
		   			共{{$total}}个记录  {{$page_list}}  页次：{{$curr_page}}/{{$total_page}}页  {{$items_per_page}}个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_dbserver&action=dev_group_index&page='+this.value;">页
		   </td>
		   		</tr>
	           
		</TBODY>
              </TABLE>	</td>
  </tr>
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


