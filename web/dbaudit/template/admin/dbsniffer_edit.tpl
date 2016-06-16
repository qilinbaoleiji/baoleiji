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
 <tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_dbsniffer&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_dbsniffer&action=dbsniffer_save&id={{$dbsniffer.id}}">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		探针名称
		</td>
		<td width="67%">
		<input type=text name="hostname" size=35 value="{{$dbsniffer.hostname}}" >
	  </td>
	</tr>
	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		探针IP
		</td>
		<td width="67%">
		<input type=text name="ip" size=35 value="{{$dbsniffer.ip}}" >
	  </td>
	</tr>	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		监听接口
		</td>
		<td width="67%">
		<input type=text name="interface" size=35 value="{{$dbsniffer.interface}}" >
	  </td>
	</tr>
	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		服务状态
		</td>
		<td width="67%">
		<select name="status" >
		<option value="0" {{if !$dbsniffer.status}}selected{{/if}}>禁止</option>
		<option value="1" {{if $dbsniffer.status}}selected{{/if}}>允许</option>
		</select>
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		同步时间
		</td>
		<td width="67%">
		<input type=text name="time" size=35 value="{{$dbsniffer.time}}" >
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		录相记录
		</td>
		<td width="67%">
		<select name="record" >
		<option value="0" {{if !$dbsniffer.record}}selected{{/if}}>不记录</option>
		<option value="1"{{if $dbsniffer.record}}selected{{/if}} >记录</option>
		</select>
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		描述
		</td>
		<td width="67%">
		<textarea name="description" cols=50 rows=10 >{{$dbsniffer.description}}</textarea>
	  </td>
	</tr>
	<tr><td></td><td><input type=submit  value="{{$language.Save}}" class="an_02"></td></tr></table>

</form>
	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


