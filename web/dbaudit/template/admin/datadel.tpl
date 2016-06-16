<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
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

	
 
  <tr>
	<td class="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="BBtable">
                <TBODY>
            </tr>
			<form method="post" action="admin.php?controller=admin_backup&action=dodel_session_table">			
			{{assign var="trnumber" value=0}}
			<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td width="15%"> Oracle</td>
				<td style="TEXT-ALIGN: left;">
				<select name="stable" >
				<option value="">请选择</option>
				{{section name=t loop=$oracle}}
				<option value="{{$oracle[t].n}}" >{{$oracle[t].n}}</option>
				{{/section}}
				</select>
			<input type="submit" value="删除" class="an_02" ></a>
				</td> 
			</tr>
			</form>
			
			<form method="post" action="admin.php?controller=admin_backup&action=dodel_session_table">
			<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td width="15%"> DB2</td>
				<td style="TEXT-ALIGN: left;">
				<select name="stable" >
				<option value="">请选择</option>
				{{section name=t loop=$db2}}
				<option value="{{$db2[t].n}}" >{{$db2[t].n}}</option>
				{{/section}}
				</select>
			<input type="submit" value="删除" class="an_02" ></a>
				</td> 
			</tr>
			</form>

			<form method="post" action="admin.php?controller=admin_backup&action=dodel_session_table">
			<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td width="15%"> SqlServer</td>
				<td style="TEXT-ALIGN: left;">
				<select name="stable" >
				<option value="">请选择</option>
				{{section name=t loop=$sqlserver}}
				<option value="{{$sqlserver[t].n}}" >{{$sqlserver[t].n}}</option>
				{{/section}}
				</select>
			<input type="submit" value="删除" class="an_02" ></a>
				</td> 
			</tr>
			</form>

			<form method="post" action="admin.php?controller=admin_backup&action=dodel_session_table">
			<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td width="15%"> SyBase</td>
				<td style="TEXT-ALIGN: left;">
				<select name="stable" >
				<option value="">请选择</option>
				{{section name=t loop=$sybase}}
				<option value="{{$sybase[t].n}}" >{{$sybase[t].n}}</option>
				{{/section}}
				</select>
			<input type="submit" value="删除" class="an_02" ></a>
				</td> 
			</tr>
			</form>

			<form method="post" action="admin.php?controller=admin_backup&action=dodel_session_table">
			<tr {{if $trnumber++ % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
			<td width="15%"> MySQL</td>
				<td style="TEXT-ALIGN: left;">
				<select name="stable" >
				<option value="">请选择</option>
				{{section name=t loop=$mysql}}
				<option value="{{$mysql[t].n}}" >{{$mysql[t].n}}</option>
				{{/section}}
				</select>
			<input type="submit" value="删除" class="an_02" ></a>
				</td> 
			</tr>
			</form>
			
	          <tr>
	          

				<td  colspan="3" align="right">
		   			共{{$total}}个记录  {{$page_list}}  页次：{{$curr_page}}/{{$total_page}}页  {{$items_per_page}}个记录/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_ipgroup&action=dev_group_index&page='+this.value;">页
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


