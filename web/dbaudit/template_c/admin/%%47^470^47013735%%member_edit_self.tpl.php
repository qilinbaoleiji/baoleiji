<?php /* Smarty version 2.6.18, created on 2013-07-18 22:23:59
         compiled from member_edit_self.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function check_add_user(){
		return(true);
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
<body>

	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	 <tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=edit_self">修改个人信息</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	  <tr>
		<td class="">
			<form method="post" name="add_user" action="admin.php?controller=admin_member&action=save_self">
				<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
				<?php if ($this->_tpl_vars['msg']): ?>
					<tr bgcolor="red">
						<td>提示：</td>
						<td><?php echo $this->_tpl_vars['msg']; ?>
</td>
					</tr>
				<?php endif; ?>
					<tr bgcolor="f7f7f7">
						<td align="right" width="33%">原密码：</td>
						<td><input type="password" name="oripassword" class="input_shorttext"> <?php echo $this->_tpl_vars['pwdshould']; ?>
</td>
					</tr>
					<tr>
						<td align="right" width="33%"><?php echo $this->_tpl_vars['language']['Password']; ?>
：</td>
						<td><input type="password" name="password1" class="input_shorttext"></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td align="right" width="33%"><?php echo $this->_tpl_vars['language']['Commitpassword']; ?>
：</td>
						<td><input type="password" name="password2" class="input_shorttext"></td>
					<tr>
						<td align="right" width="33%"><?php echo $this->_tpl_vars['language']['Name']; ?>
：</td>
						<td><input type="text" name="realname" class="input_shorttext" value="<?php echo $this->_tpl_vars['member']['realname']; ?>
"></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td align="right" width="33%"><?php echo $this->_tpl_vars['language']['Mailbox']; ?>
：</td>
						<td><input type="text" name="email" class="input_shorttext" value="<?php echo $this->_tpl_vars['member']['email']; ?>
"></td>
					</tr>
					<tr>
						<td align="right" width="33%">登录提示：</td>
						<td><input type="checkbox" name="login_tip" value="1" <?php if ($this->_tpl_vars['member']['login_tip']): ?>checked<?php endif; ?>></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td align="right" width="33%">RDP分辨率：</td>
						<td>
						<select  class="wbk"  name='rdp_screen' id='rdp_screen' > 
					<option value="3" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 3): ?>selected<?php endif; ?>>全屏</option>
					<option value="1" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 1): ?>selected<?php endif; ?>>800*600</option>
					<option value="2" <?php if ($this->_tpl_vars['member']['rdp_screen'] == 2): ?>selected<?php endif; ?>>1024*768</option>
					</select>

						</td>
					</tr>
					<TR bgcolor="f7f7f7">
                  <TD align="right" width="33%">默认控件 </TD>
                  <TD><select  class="wbk"  name=default_control>
                     <OPTION value="0" <?php if ($this->_tpl_vars['member']['default_control'] == 0): ?>selected<?php endif; ?>>自动检测</OPTION>
                     <OPTION value="1" <?php if ($this->_tpl_vars['member']['default_control'] == 1): ?>selected<?php endif; ?>>applet</OPTION>
                     <OPTION value="2" <?php if ($this->_tpl_vars['member']['default_control'] == 2): ?>selected<?php endif; ?>>activeX</OPTION>
                  </SELECT>                  
				  </TD>
                </TR>

					<tr >
						<td  align="center" colspan=2><input  type="submit" value="<?php echo $this->_tpl_vars['language']['Commit']; ?>
" class="an_02"></td>
					</tr>
				</table>
			</form>
			
		</td>
	  </tr>
	</table>
</body>
</html>

