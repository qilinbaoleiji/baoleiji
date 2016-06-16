<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_ipgroup&back=1"><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
                <TBODY>
				  
                  <TR>
                    <th class="list_bg" ><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&orderby1=ip&orderby2={{$orderby2}}" >IP</a></TD>
					<th class="list_bg" ><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&orderby1=netmask&orderby2={{$orderby2}}" >网络掩码</a></TD>
					<th class="list_bg" >{{$language.Operate}}</TD>
                  </TR>

            </tr>
			{{section name=t loop=$s}}
			<tr  {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
 <td> {{$s[t].ip}}</td>	
  <td> {{$s[t].netmask}}</td>
				<td>
				<img src='{{$template_root}}/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_ipgroup&action=ipgroup_ip_edit&id={{$s[t].id}}&groupid={{$s[t].group_id}}" >编辑</a>
				| <img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('{{$language.Delete_sure_}}？')) {return false;} else { location.href='admin.php?controller=admin_ipgroup&action=ipgrouplist_delete&id={{$s[t].id}}';}">{{$language.Delete}}</a>
				</td> 
			</tr>
			{{/section}}
			<tr>

	           <td  colspan="5" align="right"><input type="button" onclick="window.location='admin.php?controller=admin_ipgroup&action=ipgroup_ip_edit&groupid={{$groupid}}'" name="submit" class="wbk" value="{{$language.Add}}" />&nbsp;&nbsp;&nbsp;&nbsp;
		   			{{$language.all}}{{$total}}{{$language.Recorder}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}{{$language.Recorder}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_ipgroup&action=dev_group_index&page='+this.value;">{{$language.page}}
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

