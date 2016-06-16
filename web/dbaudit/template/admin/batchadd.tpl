<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_member&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
</head>

<body>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="3%" align="center" bgcolor="#E0EDF8"><b>序列</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>用户名</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>密码</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>确认密码</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>等级</b></th>
			<th class="list_bg"  width="10%" align="center" bgcolor="#E0EDF8"><b>用户组</b></th>
		</tr>		
		<form name='route' action='admin.php?controller=admin_member&action=batchadd_save' method='post'>
		{{section name=t loop=20}}
		
		<tr>
			<td width="3%" class="td_line">{{$smarty.section.t.index+1}}</td>
			<td width="10%" class="td_line"><input type="text" class="wbk" name="username[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" name="password[]" value="" /></td>
			<td width="10%" class="td_line"><input type="password" name="confirm_password[]" value="" /></td>
			<td width="10%" class="td_line"><select  class="wbk"  name="level[]" {{if $smarty.session.ADMIN_LEVEL == 3}}onchange="change_level(this);"{{/if}}>
							<option value="0" >{{$language.common}}{{$language.User}}</option>
							<option value="1" >{{$language.Administrator}}</option>
							<option value="3" >{{$language.group}}{{$language.Administrator}}</option>
							<option value="2" >{{$language.auditadministrator}}</option>
							<option value="10" >{{$language.Password}}{{$language.Administrator}}</option>
						</select></td>
			<td width="10%" class="td_line"><select  class="wbk"  name="groupid[]" >
						<option value="0" >请选择</option>
						{{section name=g loop=$usergroup}}
						<option value="{{$usergroup[g].id}}" >{{$usergroup[g].groupname}}</option>
						{{/section}}
						</select></td>
		</tr>
		
		{{/section}}
		 <tr>
			<td colspan="9" align="center" ><input type='submit'  name="batch" value='确定' class="an_02"></td>
		  </tr>
		</form>

		</table>
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
function change_level(obj){
	obj.selectedIndex=0;
}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



