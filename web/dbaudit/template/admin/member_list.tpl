<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有{{$language.select}}任何{{$language.User}}！");
		return false;
	}

</script>
<script>
	function searchit(){
		document.search.action = "admin.php?controller=admin_member";
		document.search.action += "&username="+document.search.username.value;
		document.search.submit();
		return true;
	}
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}</div></td></tr>
<body>
	
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form name ='search' action='admin.php?controller=admin_member' method=post>
  <tr>
    <td >
</td>
    <td >	
					用户名：<input type="text" name="username" size="12" class="wbk"/>&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>

					</td>
  </tr>
</form>	
</table>
</TD>
                  </TR>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_all" method="post">
					<tr>
						<th class="list_bg"  width="3%" >{{$language.select}}</th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_member&orderby1=username&orderby2={{$orderby2}}' >{{$language.Username}}</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_member&orderby1=start_time&orderby2={{$orderby2}}' >开始时间</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_member&orderby1=end_time&orderby2={{$orderby2}}' >{{$language.EndTime}}</a></th>
						<th class="list_bg"  width="6%" ><a href='admin.php?controller=admin_member&orderby1=level&orderby2={{$orderby2}}' >等级</a></th>
						<th class="list_bg"  width="24%" >{{$language.Operate}}{{$language.Link}}</th>
					</tr>
					{{section name=t loop=$allmember}}
					<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="dbe7f2"{{/if}}>
						<td>{{if $allmember[t].level != 10 &&  $allmember[t].level != 2 &&  $allmember[t].level != 1}}<input type="checkbox" name="chk_member[]" value="{{$allmember[t].uid}}">{{/if}}</td>
						<td>{{if $allmember[t].onlinenumber > 0}}<a href='admin.php?controller=admin_member&action=online&username={{$allmember[t].username}}' ><img  border="0" src='{{$template_root}}/images/user_online.gif' title='在线' /></a>{{else}}<img border="0" src='{{$template_root}}/images/user_offline.gif'  title='离线' />{{/if}}{{$allmember[t].username}}</td>
						<td>{{$allmember[t].start_time}}</td>
						<td>{{if $allmember[t].end_time eq '2037-01-01 00:00:00'}}{{$language.AlwaysValid}}{{else}}{{$allmember[t].end_time}}{{/if}}</td>
						<td><a href='admin.php?controller=admin_member&level={{$allmember[t].level}}' >{{if $allmember[t].level == 0}}{{$language.common}}{{$language.User}}{{elseif $allmember[t].level == 1}}{{$language.Administrator}}{{elseif $allmember[t].level == 3}}{{$language.group}}{{$language.Administrator}}{{elseif $allmember[t].level == 10}}{{$language.Password}}{{$language.Administrator}}{{else}}{{$language.auditadministrator}}{{/if}}</a></td>
						<td>
						<!--<img src="{{$template_root}}/images/ckico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_dev&action=index&uid={{$allmember[t].uid}}">{{$language.Edit}}{{$language.device}}</a> |-->
						{{if $allmember[t].username ne 'admin'}}<img src="{{$template_root}}/images/list_ico1.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=loginlock&uid={{$allmember[t].uid}}&loginlock={{$allmember[t].loginlock}}">{{if $allmember[t].loginlock eq 1}}{{$language.unlock}}{{else}}{{$language.Addlock}}{{/if}}</a> |{{/if}}
						<img src="{{$template_root}}/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=edit&uid={{$allmember[t].uid}}">{{$language.Edit}}</a>  
						{{if $allmember[t].level != 10 &&  $allmember[t].level != 2 &&  $allmember[t].level != 1}}|&nbsp;<img src="{{$template_root}}/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_member&action=delete&uid={{$allmember[t].uid}}">{{$language.Delete}}</a>{{/if}} 						
						</td>
					</tr>
					{{/section}}
					<tr>
						<td colspan="4" align="left">
							<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">{{$language.select}}{{$language.this}}{{$language.page}}{{$language.displayed}}的{{$language.All}}{{$language.User}}&nbsp;&nbsp;<input type="submit"  value="{{$language.UsersDelete}}" onClick="my_confirm('{{$language.DeleteUsers}}');if(chk_form()) document.member_list.action='admin.php?controller=admin_member&action=delete_all'; else return false;" class="an_02">&nbsp;&nbsp;<input type="button"  value="{{$language.Add}}{{$language.User}}" onClick="javascript:document.location='admin.php?controller=admin_member&action=add';" class="an_02">
						</td>
						<td colspan="2" align="right">
							{{$language.all}}{{$total}}个{{$language.User}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}个{{$language.User}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&page='+this.value;">{{$language.page}}&nbsp;&nbsp;<br /><a href="{{$curr_url}}&derive=1" target="hide">{{$language.ExportresulttoExcel}}</a> 
						</td>
					</tr>
					
				
		  </form>
					<tr>
						
					</tr>
				</table>
			
	  </table>
		</td>
	  </tr>
	</table>
	<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>

</body>
</html>


