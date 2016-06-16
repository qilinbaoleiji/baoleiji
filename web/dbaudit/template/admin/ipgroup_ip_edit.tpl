<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/Calendarandtime.js"></script>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_ipgroup&action=ipgroup_list&groupid={{$groupid}}&back=1"><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_ipgroup&action=ipgrouplist_save&id={{$sip.id}}">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr >
		<td width="33%" align=right>
		ip
		</td>
		<td width="67%">
		<input type=text name="ip" size=35 value="{{$sip.ip}}" ></td>
	  </td>
	</tr>	
	<tr >
		<td width="33%" align=right>
		掩码
		</td>
		<td width="67%">
		<select name="netmask" >
		{{section name=n loop=33}}
		<option value="{{$smarty.section.n.index}}" {{if $sip.netmask eq $smarty.section.n.index}}selected{{/if}}>{{$smarty.section.n.index}}</option>
		{{/section}}
		</select>
		</td>
	  </td>
	</tr>	
	<tr bgcolor="f7f7f7"><td></td><td><input type=submit  value="{{$language.Save}}" class="an_02"></td></tr></table>
<input type=hidden name="groupid" size=35 value="{{$groupid}}" >
</form>
	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


