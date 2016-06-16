<?php /* Smarty version 2.6.18, created on 2013-12-31 10:33:33
         compiled from syslog_mail_alarm.tpl */ ?>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div></td></tr>
  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=syslog_mail_alarm">
	
	<tr bgcolor="f7f7f7"><td align="right"><?php echo $this->_tpl_vars['language']['StartupMailAlert']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="radio" name="Mail_Alarm" <?php if ($this->_tpl_vars['alarm']['Mail_Alarm'] == '1'): ?>checked<?php endif; ?> value="1" /><?php echo $this->_tpl_vars['language']['Startup']; ?>
 <input type="radio" name="Mail_Alarm" <?php if ($this->_tpl_vars['alarm']['Mail_Alarm'] == '0'): ?>checked<?php endif; ?> value="0" /><?php echo $this->_tpl_vars['language']['Shutdown']; ?>

		</td>
		
	</tr>
	<tr><td align="right"><?php echo $this->_tpl_vars['language']['MailServer']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="Mailserver" value="<?php echo $this->_tpl_vars['alarm']['MailServer']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right"><?php echo $this->_tpl_vars['language']['EmailAccount']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="account" value="<?php echo $this->_tpl_vars['alarm']['account']; ?>
" />
		</td>
		
	</tr>
	<tr><td align="right"><?php echo $this->_tpl_vars['language']['AccountPassword']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="password" name="password" value="<?php echo $this->_tpl_vars['alarm']['password']; ?>
" />
		</td>
		
	</tr>
	
	<tr bgcolor="f7f7f7"><td align="right"><?php echo $this->_tpl_vars['language']['StartupsyslogAlert']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="radio" name="syslog_alarm" <?php if ($this->_tpl_vars['alarm']['Syslog_Alarm'] == '1'): ?>checked<?php endif; ?> value="1" /><?php echo $this->_tpl_vars['language']['Startup']; ?>
 <input type="radio" name="syslog_alarm" <?php if ($this->_tpl_vars['alarm']['Syslog_Alarm'] == '0'): ?>checked<?php endif; ?> value="0" /><?php echo $this->_tpl_vars['language']['Shutdown']; ?>

		</td>
		
	</tr>
	<tr><td align="right">syslog<?php echo $this->_tpl_vars['language']['Server']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="syslogserver" value="<?php echo $this->_tpl_vars['alarm']['syslogserver']; ?>
" />
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7"><td align="right">syslog<?php echo $this->_tpl_vars['language']['port']; ?>
:</td>
		<td align=left>&nbsp;
		<input type="text" class="wbk" name="syslogport" value="<?php echo $this->_tpl_vars['alarm']['syslogport']; ?>
" />
		</td>
		
	</tr>
	<tr><td align="right">syslog<?php echo $this->_tpl_vars['language']['device']; ?>
:</td>
		<td align=left>&nbsp;
		<select  class="wbk"  name="syslog_facility" >
		<option value="local0" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local0'): ?>selected<?php endif; ?>>local0</option>
		<option value="local1" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local1'): ?>selected<?php endif; ?>>local1</option>
		<option value="local2" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local2'): ?>selected<?php endif; ?>>local2</option>
		<option value="local3" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local3'): ?>selected<?php endif; ?>>local3</option>
		<option value="local4" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local4'): ?>selected<?php endif; ?>>local4</option>
		<option value="local5" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local5'): ?>selected<?php endif; ?>>local5</option>
		<option value="local6" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local6'): ?>selected<?php endif; ?>>local6</option>
		<option value="local7" <?php if ($this->_tpl_vars['alarm']['syslog_facility'] == 'local7'): ?>selected<?php endif; ?>>local7</option>
		</select>
		</td>
		
	</tr>
	<tr bgcolor="f7f7f7">
			<td colspan="2" align="center"><input type="submit"  value="<?php echo $this->_tpl_vars['language']['Save']; ?>
" class="an_02"></td>
		</tr>

	</table>
	<input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['alarm']): ?>edit<?php else: ?>new<?php endif; ?>" />
</form>

		</table>
	</td>
  </tr>
</table>


<script language="javascript">
<!--
function check()
{
/*
   if(!checkIP(f1.ip.value) && f1.netmask.value != '32' ) {
	alert('地址为<?php echo $this->_tpl_vars['language']['HostName']; ?>
时，掩码应为32');
	return false;
   }   
   if(checkIP(f1.ip.value) && !checknum(f1.netmask.value)) {
	alert('请<?php echo $this->_tpl_vars['language']['Input']; ?>
正确掩码');
	return false;
   }
*/
   return true;

}//end check
// -->

function checkIP(ip)
{
	var ips = ip.split('.');
	if(ips.length==4 && ips[0]>=0 && ips[0]<256 && ips[1]>=0 && ips[1]<256 && ips[2]>=0 && ips[2]<256 && ips[3]>=0 && ips[3]<256)
		return ture;
	else
		return false;
}

function checknum(num)
{

	if( isDigit(num) && num > 0 && num < 65535)
		return ture;
	else
		return false;

}

function isDigit(s)
{
var patrn=/^[0-9]{1,20}$/;
if (!patrn.exec(s)) return false;
return true;
}

</script>
</body>
</html>

