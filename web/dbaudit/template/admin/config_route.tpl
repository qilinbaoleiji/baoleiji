<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
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
		<td align=center>序号</td>
		<td align=center>网段</td>
		<td align=center>网关</td>
		<td align=center>操作</td>
	</tr>
	{{section name=r loop=$route}}
	<form action='admin.php?controller=admin_eth&action=route_save' method='post'>
	<tr {{if $smarty.section.r.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td align=center>{{$smarty.section.r.index+1}}</td>
		<td align=center><input name='section' value='{{$route[r].3}}'></td>
		<td align=center><input name='gateway' value='{{$route[r].5}}'></td>
		<td align=center><input type='submit' name="modify" value='修改'>&nbsp;&nbsp;<input type="submit" name="delete" value='删除' ></td>
		
	</tr>
	<input type="hidden" name="sectionold" value="{{$route[r].3}}">
	<input type="hidden" name="gatewayold" value="{{$route[r].5}}">
	</form>
	{{/section}}
	<form action='admin.php?controller=admin_eth&action=route_add2' method='post'>
	<tr bgcolor="f7f7f7">
		<td align=center>增加</td>
		<td align=center><input name='section' value='{{$route[r].3}}'></td>
		<td align=center><input name='gateway' value='{{$route[r].5}}'></td>
		<td align=center><input type='submit' value='增加' class="an_02"></td>
		
	</tr>
	</form>
	</table>


		</table>
	</td>
  </tr>
</table>


<script language="javascript">
<!--
function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为主机名时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请录入正确掩码');
	return false;
   }
*/
   return true;

}//end check
// -->

function checkIP(ip)
{
	var ips = ip.split('.');
	if(ips.length==4 && ips[0]>=0 && ips[0]<256 && ips[1]>=0 && ips[1]<256 && ips[2]>=0 && ips[2]<256 && ips[3]>=0 && ips[3]<256)
		return ture;
	else
		return false;
}

function checknum(num)
{

	if( isDigit(num) && num > 0 && num < 65535)
		return ture;
	else
		return false;

}

function isDigit(s)
{
var patrn=/^[0-9]{1,20}$/;
if (!patrn.exec(s)) return false;
return true;
}

</script>
</body>
</html>



