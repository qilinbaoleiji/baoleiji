<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
function adconfig(){
	window.location = "admin.php?controller=admin_member&action=adconfig";
}
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<body>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
					<tr>
						<th class="list_bg"  width="25%" >导入成功的用户</th>
						<th class="list_bg"  width="25%" >导入失败的用户</th>
						<th class="list_bg"  width="25%" >禁用用户</th>
						<th class="list_bg"  width="25%" >移动用户</th>
					</tr>
					{{section name=t loop=$allmember}}
					<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					{{/section}}
					
					<tr>
						<td colspan="9" align="left">
							<input type="button"  value="确定" onClick="batchloginlock();" class="an_02">
						</td>
					</tr>		  
					<tr>						
					</tr>
				</table>
			
	  </table>
		</td>
	  </tr>
	</table>
	<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>
</body>
</html>


