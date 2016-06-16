<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
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
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_eth&action=eth_save">
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		ip地址		
		</td>
		<td width="67%">
		<input type=text name="ipaddr" size=35 value="{{$ipaddr}}" >
	  </td>
	</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		掩码		
		</td>
		<td width="67%">
		<input type=text name="netmask" size=35 value="{{$netmask}}" >
	  </td>
	</tr>
{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		网关		
		</td>
		<td width="67%">
		<input type=text name="gateway" size=35 value="{{$gateway}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}><td width="33%" align=right>DNS{{$language.Server}}一:</td>
		<td align=left width="67%">
		<input type="text" class="wbk" name="nameserver1" value="{{$sshconfig.nameserver1}}" />	
		</td>
		
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}><td width="33%" align=right>DNS{{$language.Server}}二:</td>
		<td align=left width="67%">
		<input type="text" class="wbk" name="nameserver2" value="{{$sshconfig.nameserver2}}" />	
		</td>
		
	</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td  align="center" colspan=2><input  type="submit" onclick="return reset();" value="重{{$language.new}}{{$language.Start}}" class="an_02">&nbsp;&nbsp;<input type="submit"  value="{{$language.Save}}" class="an_02"></td>
		</tr>

	</table>
</form>

		</table>
	</td>
  </tr>
</table>


<script language="javascript">
function reset(){
	if(confim('确定要重{{$language.new}}{{$language.Start}}吗?')){
		document.location='admin.php?controller=admin_eth&action=system_init_6'
		return false;
	}
	return false;
}
<!--
function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为{{$language.HostName}}时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请{{$language.Input}}正确掩码');
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


