<?php /* Smarty version 2.6.18, created on 2014-07-03 13:56:44
         compiled from login.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>login</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jquery-1.2.6.pack.js"></script>
<META name=GENERATOR content="MSHTML 9.00.8112.16470">
</HEAD>
<BODY>
<P>&nbsp;</P>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style=" margin:0 auto; width:634px;">
<TABLE width="634" border=0 align=center cellPadding=0 cellSpacing=0>
      <FORM name="l" action="admin.php?controller=admin_index&amp;action=chklogin&amp;ref=" 
      method="post" target="_top">  <TBODY>
  <TR>
    <TD align=center><IMG border=0 src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/logo1.jpg" 
      width=634 height=73></TD>
  </TR>
  <TR>
    <TD height=251 align=center valign="top" background="<?php echo $this->_tpl_vars['template_root']; ?>
/images/bottom_bg.jpg"><table width="60%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="180" align="center" valign="bottom"><table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="a8c6d8">
          <tr>
            <td height="32" bgcolor="dae4e4"><strong> &nbsp;欢迎登陆</strong></td>
          </tr>
          <tr>
            <td bgcolor="ffffff"><TABLE width="100%" border="0" cellspacing="1" 
cellpadding="0">
              <TBODY>
                <TR>
                  <TD width="24%" height="30" align="right" bgcolor="#edf6f6">用户名：</TD>
                  <TD width="" id="tdusername">
<?php if ($this->_tpl_vars['Certificate'] == 2 || ! $this->_tpl_vars['Certificate']): ?>
<?php if ($this->_tpl_vars['memberscount'] == 0): ?>
<input type="text" name="username" id="username" <?php if ($this->_tpl_vars['nametype'] == 'realname'): ?>disabled='disabled'<?php endif; ?>  style="width: <?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>240<?php else: ?>110<?php endif; ?>px;<?php if ($this->_tpl_vars['nametype'] == 'realname'): ?>display:none<?php endif; ?>">
<input type="text" name="username" id="realname" <?php if ($this->_tpl_vars['nametype'] == 'username' || ! $this->_tpl_vars['nametype']): ?>disabled='disabled'<?php endif; ?>  style="width: <?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>240<?php else: ?>110<?php endif; ?>px;<?php if ($this->_tpl_vars['nametype'] == 'username'): ?>display:none<?php endif; ?>">

<?php else: ?>
<select name='username' id="username"  style="width: <?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>240<?php else: ?>110<?php endif; ?>px;">
<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
<option value='<?php echo $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']; ?>
'  <?php if ($_COOKIE['username'] == $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']): ?>selected<?php endif; ?>  ><?php echo $this->_tpl_vars['members'][$this->_sections['m']['index']]['username']; ?>
</option>
<?php endfor; endif; ?>
</select>
<select name='username' id="realname" disabled style="display:none">
<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
<option value='<?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['realname']; ?>
'  <?php if ($_COOKIE['username'] == $this->_tpl_vars['members'][$this->_sections['m']['index']]['realname']): ?>selected<?php endif; ?>  ><?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['realname']; ?>
</option>
<?php endfor; endif; ?>
</select>
<?php endif; ?>

<?php if (! $this->_tpl_vars['logintype']['ldapauth'] && ! $this->_tpl_vars['logintype']['radiusauth'] && ! $this->_tpl_vars['logintype']['adauth']): ?>
<input type="hidden" name="authtype" value="localauth">
<?php else: ?>
&nbsp;&nbsp;<select name='authtype' style="width:120px;">
<option value='localauth' <?php if ($this->_tpl_vars['authtype'] == 'localauth'): ?>selected<?php endif; ?>>本地认证</option>
<?php if ($this->_tpl_vars['logintype']['radiusauth']): ?>
<option value='radiusauth' <?php if ($this->_tpl_vars['authtype'] == 'radiusauth'): ?>selected<?php endif; ?>>RADIUS认证</option>
<?php endif; ?>
<?php if ($this->_tpl_vars['logintype']['ldapauth']): ?>
<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['ldaps']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
<option value='ldapauth_<?php echo $this->_tpl_vars['ldaps'][$this->_sections['l']['index']]['address']; ?>
' <?php if ($this->_tpl_vars['authtype'] == 'ldapauth'): ?>selected<?php endif; ?>>LDAP <?php echo $this->_tpl_vars['ldaps'][$this->_sections['l']['index']]['domain']; ?>
</option>
<?php endfor; endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['logintype']['adauth']): ?>
<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['ads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
<option value='adauth_<?php echo $this->_tpl_vars['ads'][$this->_sections['a']['index']]['address']; ?>
' <?php if ($this->_tpl_vars['authtype'] == 'adauth'): ?>selected<?php endif; ?>>AD <?php echo $this->_tpl_vars['ads'][$this->_sections['a']['index']]['domain']; ?>
</option>
<?php endfor; endif; ?>
<?php endif; ?>
<?php endif; ?>
</select>
<input type="hidden" name="memberscount" id="memberscountid" value="<?php echo $this->_tpl_vars['memberscount']; ?>
" />
<input type="hidden" name="cacn" id="cacn" value="<?php echo $this->_tpl_vars['cacn']; ?>
" />
<?php endif; ?>
                  </TD>
                </TR>
                <TR>
                  <TD height="30" align="right" 
                      bgcolor="#edf6f6">口&nbsp;令：</TD>
                  <TD><INPUT name="password" id="textfield2" style="width: 240px;" type="password"></TD>
                </TR>
                <TR>
                  <TD height="30" align="right" bgcolor="#edf6f6">动态密码：</TD>
                  <TD><INPUT name="dpassword" id="textfield2" style="width: 240px; color: rgb(153, 153, 153);" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" type="text" value="令牌用户输入"></TD>
                </TR>
                <TR>
                  <TD height="30" align="right" bgcolor="#edf6f6">认证方式：</TD>
                  <TD><INPUT name="nametype" id="radio" onClick="changelogintype('username');" 
                        type="radio" checked="" <?php if ($this->_tpl_vars['nametype'] == 'username'): ?>checked<?php endif; ?> value="username">
                    登录名
                    <INPUT name="nametype" id="radio2" 
                        onclick="changelogintype('realname');" type="radio" <?php if ($this->_tpl_vars['nametype'] == 'realname'): ?>checked<?php endif; ?> 
                        value="realname">
                    别名</TD>
                </TR>
              </TBODY>
            </TABLE></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="35" align="center"><input name="button" type="submit" class="btn1" id="button" value="登 录"></td>
      </tr>
    </table></TD>
  </TR>
  </FORM></TABLE>
  </div>
   <?php if ($this->_tpl_vars['Certificate'] == 1): ?>
  <OBJECT id="capicom" codeBase="capicom.cab#version=2,0,0,3" classid="clsid:A996E48C-D3DC-4244-89F7-AFA33EC60679" VIEWASTEXT>
</OBJECT>
<?php endif; ?>
  <script >
 /* <?php if ($this->_tpl_vars['memberscount'] > 0): ?>
  Members = new Array();
  var i=0;
  <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
  Members[i++]={username: '<?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['username']; ?>
', realname: '<?php echo $this->_tpl_vars['members'][$this->_sections['n']['index']]['realname']; ?>
'};
  <?php endfor; endif; ?>
  <?php endif; ?>*/
  

 function changelogintype(ltype)
  {
	  <?php if ($this->_tpl_vars['Certificate']): ?>
    if(ltype=='username'){
		document.getElementById('username').style.display='';
		document.getElementById('username').disabled=false;
		document.getElementById('realname').style.display='none';
		document.getElementById('realname').disabled=true;
	}else{
		document.getElementById('username').style.display='none';
		document.getElementById('username').disabled=true;
		document.getElementById('realname').style.display='';
		document.getElementById('realname').disabled=false;
	}
	  <?php endif; ?>
  }
<?php if ($this->_tpl_vars['Certificate'] == 1): ?>
function trimStr(str){return str.replace(/(^\s*)|(\s*$)/g,"");}
function getClientID()
{
	var CAPICOM_CURRENT_USER_STORE = 2;
	var CAPICOM_MY_STORE = "my";//读取的目录名称，如果读取个人证书则应该写入变量"my",如果是根证书则是root
	var CAPICOM_STORE_OPEN_READ_WRITE=1;

	var myStore = new ActiveXObject("CAPICOM.Store");

	myStore.Open(CAPICOM_CURRENT_USER_STORE,CAPICOM_MY_STORE,CAPICOM_STORE_OPEN_READ_WRITE); 
	var myStoreCerts = myStore.Certificates;

	// 获取所有my证书的名字
	var info="";
	for(i = 1; i<= myStoreCerts.Count; i++)
	{  
	   var itmp = myStoreCerts.Item(i).subjectname.split(','); //SerialNumber
	   for(var j=0; j<itmp.length; j++){	  
		   var jtmp = itmp[j].split('=');
		   jtmp[0]=trimStr(jtmp[0]);
		   if(jtmp[0]=='CN'){
			info += trimStr(jtmp[1]) + ";";  
		   }
	   }	  	   
	}
	return info;
}

var url="admin.php?controller=admin_index&action=login_user_field&cacn="+getClientID();//alert(url);
  $.get(url, {Action:"get",Name:"lulu","1":Math.round(new Date().getTime()/1000)}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		document.getElementById('tdusername').innerHTML = data;
		memberscount=document.getElementById('memberscountid').value
	});
<?php else: ?>
changelogintype('<?php echo $this->_tpl_vars['nametype']; ?>
')
<?php endif; ?>
  </script>
</BODY></HTML>