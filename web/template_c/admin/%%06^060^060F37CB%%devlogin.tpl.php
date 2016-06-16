<?php /* Smarty version 2.6.18, created on 2014-06-10 23:47:46
         compiled from devlogin.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['System']; ?>
登陆</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td class="main_content">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
			<tr bgcolor="f7f7f7">
				<td><div id="applet" >
	<?php if ($this->_tpl_vars['app_act'] == 'applet'): ?>
<script language="JavaScript">  
function DetectJava(){
    var   javawsInstalled   =   0; 
    var   javaws142Installed=0;
    var   javaws150Installed=0;
    isIE   =   "false";  
    if(navigator.mimeTypes   &&   navigator.mimeTypes.length){   
        x=navigator.mimeTypes['application/x-java-jnlp-file'];
        if(x){
          javawsInstalled=1;
          javaws142Installed=1;   
          javaws150Installed=1; 
         }
        } else { 
            isIE   =   "true"; 
         try {
            var java = new ActiveXObject("JavaWebStart.isInstalled");         // var java15 = new ActiveXObject("JavaWebStart.isInstalled.1.5.0.0");//1.5版本
            if(java) {
                //alert('已安装Java虚拟机');
				return true;
            } else {
                alert('未安装Java虚拟机');
				return false;
            }
          } catch(ex) {
                alert('未安装Java虚拟机');
				return false;
          }
	}   
 }
//DetectJava();
</script>
	<?php if ($this->_tpl_vars['logintool'] == 'putty'): ?>
	
<applet	code = "com.free.putty.PuttyApplet",	name = "PuttyApplet",	archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/utilities.jar",	width = 0,	height = 0>
	  <param name = "putty_path" value = "c:\freesvr\ssh\putty.exe" />
  <param  name="protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	  <param name="host" value="<?php echo $this->_tpl_vars['ip']; ?>
"/>
<param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
<param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
 <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
 <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
 <param name = "vpnip" value= "1.1.1.1" />
 <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
 </applet>
	
	<?php elseif ($this->_tpl_vars['logintool'] == 'securecrt'): ?>
	
<applet	code = "com.free.securecrt.SecureCRTApplet",	name = "SecureCRTApplet",	archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/utilities.jar",	width = 0,	height = 0>

	  <param name = "securecrt_path" value = "c:\freesvr\ssh\SecureCRT.lnk" />
	  <param name = "protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	  <param name = "host" value="<?php echo $this->_tpl_vars['ip']; ?>
"/>
	  <param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
	  <param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
	  <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
	  <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
	  <param name = "vpnip" value= "1.1.1.1" />
	  <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	  </applet>
	
	<?php elseif ($this->_tpl_vars['loginmethod'] == 'ftp' || $this->_tpl_vars['loginmethod'] == 'sftp'): ?>
<applet	code = "com.free.winscp.WinScpApplet",	name = "WinScpApplet",	archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/utilities.jar",	width = 0,	height = 0>
	 <param name = "winscp_path" value = "c:\freesvr\sftp\WinSCP.exe" />
	 <param  name="protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	 <param name="host" value="<?php echo $this->_tpl_vars['proxy_addr']; ?>
"/>
	 <param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
	 <param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
	 <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
	 <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
	 <param name = "vpnip" value= "1.1.1.1" />
	 <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	 <!-- make sure, non-java-capable browser get a message: -->
</applet>
	<?php endif; ?>
	<?php else: ?>
<?php if ($this->_tpl_vars['logintool'] == 'putty'): ?>
	

 <object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=<?php echo $this->_tpl_vars['activex_version']; ?>
" width="0" height="0" id="Cputty">

	  <param name = "putty_path" value = "c:\freesvr\ssh\putty.exe" />
  <param  name="protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	  <param name="host" value="<?php echo $this->_tpl_vars['ip']; ?>
"/>
<param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
<param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
 <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
 <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
 <param name = "vpnip" value= "1.1.1.1" />
 <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	</object>
<script type = "text/javascript">
        function putty() 
        {
            if (window.ActiveXObject) 
            {
                try 
                {
                    document.getElementById("Cputty").StartPutty();
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
		putty();
    </script>
	<?php elseif ($this->_tpl_vars['logintool'] == 'securecrt'): ?>
	
<object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=<?php echo $this->_tpl_vars['activex_version']; ?>
" width="0" height="0" id="CSecureCRT">

	  <param name = "securecrt_path" value = "c:\freesvr\ssh\SecureCRT.lnk" />
	  <param name = "protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	  <param name = "host" value="<?php echo $this->_tpl_vars['ip']; ?>
"/>
	  <param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
	  <param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
	  <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
	  <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
	  <param name = "vpnip" value= "1.1.1.1" />
	  <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	  </object>
	 <script type = "text/javascript">
        function SecureCRT() 
        {
            if (window.ActiveXObject) 
            {
                try {
                    document.getElementById("CSecureCRT").StartSecureCRT();
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
		SecureCRT();
    </script>

	<?php elseif ($this->_tpl_vars['loginmethod'] == 'ftp' || $this->_tpl_vars['loginmethod'] == 'sftp'): ?>
<object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=<?php echo $this->_tpl_vars['activex_version']; ?>
" width="0" height="0" id="CWinscp">
	 <param name = "winscp_path" value = "c:\freesvr\sftp\WinSCP.exe" />
	 <param  name="protocol" value="<?php echo $this->_tpl_vars['loginmethod']; ?>
" /> 
	 <param name="host" value="<?php echo $this->_tpl_vars['proxy_addr']; ?>
"/>
	 <param name = "port" value="<?php echo $this->_tpl_vars['port']; ?>
"/>
	  <param name = "target_username" value = "<?php echo $this->_tpl_vars['dusername']; ?>
" />
	  <param name = "target_ip" value = "<?php echo $this->_tpl_vars['ip']; ?>
" />
	 <param name = "username" value = "<?php echo $this->_tpl_vars['username']; ?>
" />
	 <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	 <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	 <?php if ($this->_tpl_vars['loginmethod'] == 'ssh' || $this->_tpl_vars['loginmethod'] == 'ssh2'): ?>
  <param name = "entrust_username" value = "<?php echo $this->_tpl_vars['entrust_username']; ?>
" />
  <?php endif; ?>
	 <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />
	 <param name = "vpnip" value= "1.1.1.1" />
	 <param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	 </object>

	 <script type = "text/javascript">
        function WinSCP() 
        {
            if (window.ActiveXObject) 
            {
                try {
                    document.getElementById("CWinscp").StartWinscp();
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
		WinSCP();
    </script>
	<?php endif; ?>


	<?php endif; ?>
	</div>
			</td>
			</tr>
		</table>
	</td>
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

