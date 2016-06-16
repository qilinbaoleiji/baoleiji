<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{$site_title}}</title>
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<FORM method=post action=admin.php?controller=admin_index&action=chklogin&ref={{$ref}} 
target=_top>
  <tr>
    <td align="center" valign="middle" bgcolor="#0884C4"><table width="1000" height="570" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_02.jpg" width="239" height="147" /></td>
        <td align="left" valign="top"><img src="{{$template_root}}/images/01.jpg" width="555" height="147" /></td>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_04.jpg" width="206" height="147" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_05.jpg" width="239" height="315" /></td>
        <td align="center" valign="middle" background="{{$template_root}}/images/an_06.jpg">
		<table width="327" height="189" border="0" cellpadding="0" cellspacing="0" class="dlwb">
          <tr>
            <td width="104" align="right">用户名：</td>
            <td colspan="2"><input type="text" name="username" class="dlwb_01"></td>
            </tr>
          <tr>
            <td align="right">密码：</td>
            <td colspan="2"><input type="password" name="password" class="dlwb_02"></td>
            </tr>
          <tr>
            <td align="right">动态密码：</td>
            <td colspan="2"><input type="password" name="dpassword" class="dlwb_03"></td>
            </tr>
          <tr>
		    {{*<tr>
            <td align="right">语言：</td>
            <td colspan="2"><select  class="wbk"  name=language> <OPTION selected 
                    value="">language</OPTION> <OPTION value=en>English</OPTION> 
                    <OPTION value=cn>中文</OPTION></SELECT></td>
            </tr>*}}
          <tr>
            <td height="51" align="right"></td>
            <td width="102" valign="bottom"><input type="image"  src="{{$template_root}}/images/dl_17.jpg" width="89" height="42" border="0" style="border:0px;"></td>
            <td width="121" valign="bottom"><a href="admin.php?controller=admin_index&action=getpwd"><img src="{{$template_root}}/images/dl_19.jpg" width="86" height="42" border="0"></a></td>
          </tr>
        </table></td>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_07.jpg" width="206" height="315" /></td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_08.jpg" width="239" height="108" /></td>
        <td width="555" height="108" align="center" valign="middle" class="bq"> 运维管理平台</td>
        <td align="left" valign="top"><img src="{{$template_root}}/images/an_10.jpg" width="206" height="108" /></td>
      </tr>
    </table></td>
  </tr>
  </FORM>
</table>
</body>
</html>


