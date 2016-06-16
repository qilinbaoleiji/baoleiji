<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.SessionsList}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="{{$template_root}}/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="{{$template_root}}/cssjs/border-radius.css" />
<script src="{{$template_root}}/cssjs/jscal2.js"></script>
<script src="{{$template_root}}/cssjs/cn.js"></script>
</head>
<script type="text/javascript">
function searchit(){
	document.search.action = "admin.php?controller=admin_loginaccount&action={{$action}}";
	document.search.action += "&f_rangeStart="+document.search.f_rangeStart.value;
	document.search.action += "&f_rangeEnd="+document.search.f_rangeEnd.value;
	//alert(document.search.action);
	//return false;
	return true;
}
</script>
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
    <td class="main_content">
<form action="admin.php?controller=admin_loginaccount&action={{$action}}" method="post" name="search" >

日期：<input type="text" class="wbk"  name="f_rangeStart" size="20" id="f_rangeStart" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">

&nbsp;&nbsp;<input type="submit" height="35" align="middle" onClick="return searchit();" border="0" value=" 确定 " class="bnnew2"/>
<!-- 结束日期：
<input  type="text" class="wbk" name="f_rangeEnd" size="12" id="f_rangeEnd" value="" class="wbk"/>
 <input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk">

     &nbsp;&nbsp;状态：<select  class="wbk"  name="authenticationstatus" >
     <option value="" ></option>
     <option value="1">成功</option>
     <option value="0">失败</option>
     </select>
	  -->
</form> 
	  </td>
  </tr>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
//cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d %H:%M:%S");


</script>
  
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action={{$action}}&orderby1=day&orderby2={{$orderby2}}" >日期</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action={{$action}}&orderby1=ip&orderby2={{$orderby2}}" >服务器</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action={{$action}}&orderby1=db_type&orderby2={{$orderby2}}" >数据库类型</a></th>
						<th class="list_bg"   width="8%"><a href="admin.php?controller=admin_loginaccount&action={{$action}}&orderby1=user&orderby2={{$orderby2}}" >用户</a></th>
						<th class="list_bg"   width="15%"><a href="admin.php?controller=admin_loginaccount&action={{$action}}&orderby1=total&orderby2={{$orderby2}}" >登录次数</a></th>
					</tr>
					{{section name=t loop=$alllog}}
					<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
	
						<td><a href="admin.php?controller=admin_loginaccount&action={{$action}}&day={{$alllog[t].day}}">{{if $action eq 'week'}}{{$alllog[t].from}}/{{$alllog[t].to}}{{else}}{{$alllog[t].day}}{{/if}}</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action={{$action}}&ip={{$alllog[t].server}}">{{$alllog[t].server}}</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action={{$action}}&db_type={{$alllog[t].db_type}}">{{$alllog[t].db_type}}</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action={{$action}}&user={{$alllog[t].user}}">{{$alllog[t].user}}</a></td>
						<td><a href="admin.php?controller=admin_loginaccount&action={{$action}}&total={{$alllog[t].total}}">{{$alllog[t].total}}</a></td>
					</tr>
					{{/section}}
					<tr>
						<td colspan="12" align="right">
							{{$language.all}}{{$log_num}}{{$language.item}}{{$language.Log}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}{{$language.item}}{{$language.Log}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='{{$curr_url}}&page='+this.value;">{{$language.page}} <!--当前数据表: {{$now_table_name}}-->{{if !$str}}<a href="{{$curr_url}}&derive=1" target="hide">{{$language.ExcelExporttoExcel}}Excel</a> <a href="{{$curr_url}}&derive=2" target="hide">导出到HTML</a>{{/if}}   
						</td>
					</tr>
					{{if 0&&$str}}
					<tr><td colspan="12" align="right">{{$language.ExcelExporttoExcel}}Excel:{{$str}} </td></tr>
					<tr><td colspan="12" align="right">导出到HTML:{{$strhtml}}</td></tr>
					{{/if}}
				</table>
	</td>
  </tr>
</table>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>


