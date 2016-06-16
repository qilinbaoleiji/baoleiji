  <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD align="center" class="tb_t_bg">绑定信息 </TD>
  </TR>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
           <form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_pro&action=doinputauth" target="hide">
            <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top">
              <TBODY> 
              <TR bgcolor="#f7f7f7">
                <TD width="30%" height="32" align="right">用户: </TD>
                <TD><INPUT name="username" id="username" type="text" value="{{$username}}" autocomplete="off">{{if $showusers }}&nbsp;&nbsp;<INPUT type="hidden" id="passwordsave" value="{{$passwordsave}}" name="passwordsave"><INPUT type="checkbox" {{if $saveednameit}}checked{{/if}} value="1" name="saveednameit">保存{{/if}}&nbsp;&nbsp;</TD></TR>
              <TR>
                <TD width="30%" height="32" align="right">密码: </TD>
                <TD><INPUT name="password" id="password" type="password" value="{{$password}}" autocomplete="off">{{if $showusers }}&nbsp;&nbsp;<INPUT type="hidden" id="passwordsave" value="{{$passwordsave}}" name="passwordsave"><INPUT type="checkbox" {{if $saveedpwdit}}checked{{/if}} value="1" name="saveedpwdit">保存{{/if}}&nbsp;&nbsp;</TD></TR>
              <TR>
                <TD height="32" align="right"></TD>
                <TD><INPUT class="an_02" type="submit" value="登录" name="actions">&nbsp;&nbsp;{{if $showusers }}<INPUT type="submit"  class="an_02" value="删除" name="actions">{{/if}}</TD></TR></TBODY></TABLE>
	<input type="hidden" name="url" value="{{$url}}" />
	<input type="hidden" name="id" value="{{$devicesid}}" />
      </FORM></TD></TR></TBODY></TABLE>
<SCRIPT>

document.getElementById('username').value='';
document.getElementById('password').value='';
</SCRIPT></TR></TBODY></TABLE>



