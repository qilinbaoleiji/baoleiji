<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>
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
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">{{include file="tabs.tpl"}}<span class="back_img"><a href="admin.php?controller=admin_auditpolicy&dbtype={{$dbtype}}&back=1" ><img src="{{$template_root}}/images/back1.png" border=0  /></a></span></div></td></tr>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_auditpolicy&action=auditpolicy_save&dbtype={{$dbtype}}&id={{$auditpolicy.id}}">
{{assign var="trnumber" value=0}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>规则名称：</td>
						<td><input type="text" name="name" class="wbk input_shorttext" {{if $auditpolicy.id}}readonly{{/if}} value="{{$auditpolicy.name}}"></td>
					</tr>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>位置: </TD>
                  <TD>
                  <select  class="wbk"  name=policy_order id="policy_order">
				   <OPTION value="{{$allpolicies_ct}}">最后</OPTION>
				   <OPTION value="1" {{if $auditpolicy.policy_order eq 1}}selected{{/if}}>最前</OPTION>                     
                     	{{section name=o loop=$allpolicies}}
							<option value="{{$allpolicies[o].policy_order}}" {{if $allpolicies[o].policy_order == $auditpolicy.policy_order-1}}selected{{/if}}>{{$allpolicies[o].name}} 之后</option>
						{{/section}}
						
                  </SELECT>     
				  </TD>
                </TR>
						{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="change_passwordtr">
		<TD width="33%" align=right>是否启用：</TD>
                  <TD width="67%"><input type="checkbox" name="enable" value="1" {{if $auditpolicy.enable}}checked{{/if}}>      </TD>
                </TR>  
		{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="change_passwordtr">
		<TD width="33%" align=right>是否发送邮件：</TD>
                  <TD width="67%"><input type="checkbox" name="mail" value="1" {{if $auditpolicy.mail}}checked{{/if}}>      </TD>
                </TR>  
		{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="change_passwordtr">
		<TD width="33%" align=right>是否syslog：</TD>
                  <TD width="67%"><input type="checkbox" name="syslog" value="1" {{if $auditpolicy.syslog}}checked{{/if}}>      </TD>
                </TR>  
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>数据库用户：</td>
						<td><input type="text"  name="dbuser" class="wbk input_shorttext" value="{{$auditpolicy.dbuser}}"></td>
					</tr>
					{{if $dbtype eq 'oracle'}}
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>系统用户：</td>
						<td><input type="text" name="systemuser" class="wbk input_shorttext"value="{{$auditpolicy.systemuser}}"></td>
					</tr>
					{{/if}}
				
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>来源地址组: </TD>
                  <TD>
                  <select  class="wbk"  name=server_ipgroup id="server_ipgroup">
                      <OPTION value="">请选择</OPTION>
                     	{{section name=k loop=$ipgroup}}
				<option value="{{$ipgroup[k].id}}" {{if $ipgroup[k].id == $auditpolicy.server_ipgroup}}selected{{/if}}>{{$ipgroup[k].description}}</option>
			{{/section}}
                  </SELECT>     
				  </TD>
                </TR>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>目标地址组: </TD>
                  <TD>
                  <select  class="wbk"  name=client_ipgroup id="client_ipgroup">
                      <OPTION value="">请选择</OPTION>
                     	{{section name=k2 loop=$ipgroup}}
				<option value="{{$ipgroup[k2].id}}" {{if $ipgroup[k2].id == $auditpolicy.client_ipgroup}}selected{{/if}}>{{$ipgroup[k2].description}}</option>
			{{/section}}
                  </SELECT>     
				  </TD>
                </TR>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>来源MAC地址: </TD>
                  <TD>
                 <input type="text" name="sourcemac" class="wbk input_shorttext"value="{{$auditpolicy.sourcemac}}">
				  </TD>
                </TR>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>SQL指令组: </TD>
                  <TD>
                  <table><tr >
		{{section name=g loop=$sqloptions}}
		<td width="100"><input type="checkbox" name='auditsqloptions[]' value='{{$sqloptions[g].id}}'  {{$sqloptions[g].check}}>{{$sqloptions[g].optionsname}}</td>{{if ($smarty.section.g.index +1) % 5 == 0}}</tr><tr>{{/if}}
		{{/section}}
		</tr></table>   
				  </TD>
                </TR>
		{{if $dbtype eq 'oracle'}}
				  {{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>SQL返回行:</td>
						<td><input type="text" name="return_line_number" class="wbk input_shorttext"value="{{$auditpolicy.return_line_number}}"></td>
					</tr>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>监控字段:</td>
						<td><input type="text" name="result_title" class="wbk input_shorttext"value="{{$auditpolicy.result_title}}"></td>
					</tr>
				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>字段内容:</td>
						<td><input type="text" name="result_content" class="wbk input_shorttext"value="{{$auditpolicy.result_content}}"></td>
					</tr>
		
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td width="33%" align=right>SQL返回值:</td>
						<td><textarea name="replyinfo"  cols=50 rows=10 >{{$auditpolicy.replyinfo}}</textarea></td>
					</tr>
		{{/if}}
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>是否执行成功: </TD>
                  <TD>
                  <SELECT  class="wbk"  name=success id="success">
					<OPTION value="-1">请选择</OPTION>
                      <OPTION value="1" {{if 1 == $auditpolicy.success}}selected{{/if}}>是</OPTION>
					  <OPTION value="0" {{if 0 == $auditpolicy.success}}selected{{/if}}>否</OPTION>
                  </SELECT>     
				  </TD>
                </TR>

				{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="leveltr">
		<TD width="33%" align=right>审计风险等级：</TD>
                  <TD width="67%"><input type="radio" name="level" value="5" {{if $auditpolicy.level eq 5}}checked{{/if}}>高风险&nbsp;&nbsp;<input type="radio" name="level" value="4" {{if $auditpolicy.level eq 4}}checked{{/if}}>中风险&nbsp;&nbsp;<input type="radio" name="level" value="3" {{if $auditpolicy.level eq 3}}checked{{/if}}>低风险&nbsp;&nbsp;<input type="radio" name="level" value="2" {{if $auditpolicy.level eq 2}}checked{{/if}}>关注行为&nbsp;&nbsp;<input type="radio" name="level" value="1" {{if $auditpolicy.level eq 1}}checked{{/if}}>一般行为&nbsp;&nbsp;</TD>
                </TR>  

				{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
                  <TD  width="33%" align=right>可信任IP地址组: </TD>
                  <TD>
				  <table><tr >
		{{section name=g loop=$ipgroup}}
		<td width="100"><input type="checkbox" name='trustipgroup[]' value='{{$ipgroup[g].id}}'  {{$ipgroup[g].check}}>{{$ipgroup[g].description}}</td>{{if ($smarty.section.g.index +1) % 5 == 0}}</tr><tr>{{/if}}
		{{/section}}
		</tr></table>
                  
				  </TD>
                </TR>

			
				
					{{assign var="trnumber" value=$trnumber+1}}
					<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td colspan="2" align="center"><input type="submit"  value="{{$language.Save}}" class="an_02"></td>
					</tr>	
</form>
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


