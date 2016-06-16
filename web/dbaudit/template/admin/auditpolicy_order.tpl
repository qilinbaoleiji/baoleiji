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
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="BBtable">
         <form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_auditpolicy&action=setorder_save&dbtype={{$dbtype}}&id={{$auditpolicy.id}}">
{{assign var="trnumber" value=0}}
				
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


