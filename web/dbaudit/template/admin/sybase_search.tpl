<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.LogList}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="{{$template_root}}/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="{{$template_root}}/cssjs/border-radius.css" />
<script src="{{$template_root}}/cssjs/jscal2.js"></script>
<script src="{{$template_root}}/cssjs/cn.js"></script>
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
    <td class="main_content" height="30">{{$language.Man}}：{{$language.Search}}{{$language.Session}},留空表示{{$language.no}}限制 </td>
  </tr>
  <tr>
	<td class="main_content">
<form method="get" name="session_search" action="admin.php">
				<table bordercolor="white" cellspacing="0" cellpadding="0" border="0" width="100%"  class="BBtable">
					<!--
					<tr>
						<td class="td_line" width="30%">数据表：</td>
						<td class="td_line" width="70%">
						<select  class="wbk"  name="table_name">
						{{section name=t loop=$table_list}}
						<option value="{{$table_list[t]}}">{{$table_list[t]}}</option>
						{{/section}}
						</select>
						{{$language.Sort}}
						</td>
					</tr>
					-->
					<tr  {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
 <td> {{$language.Search}}{{$language.Session}}{{$language.Content}}</td>
						<td>
												<table><tr >
						
							<td width="100">
							<input type="radio" name="controller" value="admin_sqlnet" onClick="location.href='admin.php?controller=admin_sqlnet&action=search' ">Oracle{{$language.Session}}
							</td><td width="100">
							<input type="radio" name="controller" value="admin_db2"  onClick="location.href='admin.php?controller=admin_db2&action=search'" >DB2{{$language.Session}}
							</td><td width="100">
							<input type="radio" name="controller" value="admin_db2"  onClick="location.href='admin.php?controller=admin_sqlserver&action=search'" >SqlServer{{$language.Session}}
							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_sybase" checked>Sybase{{$language.Session}}
							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_mysql" onClick="location.href='admin.php?controller=admin_mysql&action=search'">Mysql{{$language.Session}}
							</td></tr></table>

						</td>
					</tr>
					<tr>
						<td class="td_line" width="30%">{{$language.Result}}：</td>
						<td class="td_line" width="70%">
						<select  class="wbk"  name="orderby1">
							<option value='sid'>{{$language.default}}</option>
							<option value='s_addr'>{{$language.SourceAddress}}</option>
							<option value='d_addr'>{{$language.DestinationAddress}}</option>
							<option value='user'>{{$language.Username}}</option>
							<option value='start'>{{$language.Session}}{{$language.StartTime}}</option>
							<option value='end'>{{$language.Session}}{{$language.EndTime}}</option>
						</select>
						{{$language.Sort}}
						<select  class="wbk"  name="orderby2">
							<option value='asc'>{{$language.ascendingorder}}</option>
							<option value='desc'>{{$language.decreasingorder}}</option>
						</select>
						</td>
					</tr>
					{{if $admin_level == 1}}
					<tr>
						<td class="td_line" width="30%">本地用户：</td>
						<td class="td_line" width="70%"><input name="user" type="text" class="wbk"></td>
					</tr>
					{{/if}}
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%">{{$language.SourceAddress}}：</td>
						<td class="td_line" width="70%">
							<input name="s_addr" type="text" class="wbk" /><br />
						</td>
					</tr>
					<tr>
						<td class="td_line" width="30%">{{$language.DestinationAddress}}：</td>
						<td class="td_line" width="70%">
							<input name="d_addr" type="text" class="wbk" />&nbsp;{{$language.PleaseinputcorrectAddress}}<br />
						</td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%">{{$language.StartTime}}：</td>
						<td class="td_line" width="70%"><input name="start1" id="f_rangeStart" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="起始时间"  class="wbk">&nbsp;&nbsp;<input name="start2" id="f_rangeEnd" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="终止时间"  class="wbk"></td>
					</tr>
					<tr>
						<td class="td_line" width="30%">{{$language.EndTime}}：</td>
						<td class="td_line" width="70%"><input name="end1" id="f_rangeStart2" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger2" name="f_rangeStart_trigger2" value="起始时间"  class="wbk">&nbsp;&nbsp;<input name="end2" id="f_rangeEnd2" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger2" name="f_rangeEnd_trigger2" value="终止时间"  class="wbk"></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%">{{$language.Historycommands}}：</td>
						<td class="td_line" width="70%"><input type="text" class="wbk" name="command"></td>
					</tr>
					
					<tr>
						<td class="td_line" colspan="2" align="center"><input name="submit" type="submit"  value="{{$language.Search}}" onclick="setScroll();" class="an_02"></td>
					</tr>
				</table>
				<script type="text/javascript">
                  new Calendar({
                          inputField: "f_rangeStart",
                          dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                          trigger: "f_rangeStart_trigger",
                          bottomBar: false,
						  popupDirection:'up',
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                 
                                  this.hide();
                          }
                  });
                  new Calendar({
                      inputField: "f_rangeEnd",
                      dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                      trigger: "f_rangeEnd_trigger",
                      bottomBar: false,
					  popupDirection:'up',
                      onSelect: function() {
                              var date = Calendar.intToDate(this.selection.get());
                             
                              this.hide();
                      }
              });
			   new Calendar({
                          inputField: "f_rangeStart2",
                          dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                          trigger: "f_rangeStart_trigger2",
                          bottomBar: false,
						  popupDirection:'up',
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                 
                                  this.hide();
                          }
                  });
                  new Calendar({
                      inputField: "f_rangeEnd2",
                      dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                      trigger: "f_rangeEnd_trigger2",
                      bottomBar: false,
					  popupDirection:'up',
                      onSelect: function() {
                              var date = Calendar.intToDate(this.selection.get());
                             
                              this.hide();
                      }
              });
                </script>
			</form>
	</td>
  </tr>
</table>


<script>
function setScroll(){
	window.parent.scrollTo(0,0);
}
</script>

