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
  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
          <tr>
            <td align="center">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		执行时间
		</td>
		<td width="67%">
		{{$detail.at}}
	  </td>
	</tr>	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		命令
		</td>
		<td width="67%">
		{{$detail.cmd}}
	  </td>
	</tr>	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		命令字节
		</td>
		<td width="67%">
		{{$detail.cmd_bytes}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		结果字节
		</td>
		<td width="67%">
		{{$detail.result_bytes}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		响应时间
		</td>
		<td width="67%">
		{{$detail.return_time}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		返回代码
		</td>
		<td width="67%">
		{{$detail.return_code}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		字段审计
		</td>
		<td width="67%">
		{{if $detail.return_result_content and $detail.return_result_title}}是{{else}}不{{/if}}
	  </td>
	</tr>
	</table>

	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


