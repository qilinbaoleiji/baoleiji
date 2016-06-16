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
 <tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_ipgroup&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>

  <tr>
	<td class="main_content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
          <tr>
            <td align="center">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top>
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		来源地址
		</td>
		<td width="67%">
		{{$detail.s_addr}}
	  </td>
	</tr>	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		目的地址
		</td>
		<td width="67%">
		{{$detail.d_addr}}
	  </td>
	</tr>	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		登录用户名
		</td>
		<td width="67%">
		{{$detail.user}}
	  </td>
	</tr>
	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		开始
		</td>
		<td width="67%">
		{{$detail.start}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		结束
		</td>
		<td width="67%">
		{{$detail.end}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		日志文件
		</td>
		<td width="67%">
		{{$detail.logfile}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		回放文件
		</td>
		<td width="67%">
		{{$detail.replayfile}}
	  </td>
	</tr>
	
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		来源MAC
		</td>
		<td width="67%">
		{{$detail.s_mac}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		目标MAC
		</td>
		<td width="67%">
		{{$detail.d_mac}}
	  </td>
	</tr>
	<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="33%" align=right>
		命令数
		</td>
		<td width="67%">
		{{$detail.commands}}
	  </td>
	</tr>
	</table>

	</td>
  </tr>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


