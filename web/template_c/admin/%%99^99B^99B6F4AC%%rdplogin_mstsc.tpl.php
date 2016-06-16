<?php /* Smarty version 2.6.18, created on 2014-06-23 11:46:15
         compiled from rdplogin_mstsc.tpl */ ?>
<html>
<head>
<title>MSTSC Player</title>
</head>
<body>
<h1><center>MSTSC Player : <?php echo $this->_tpl_vars['app_act']; ?>
</center></h1>
<center>

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
	<applet code = "com.free.mstsc.MstscLogin",	name = "Mstsc Player", archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/utilities.jar", width = 0, height = 0>
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
	  <param name = "bpp" value = "16" />
	  <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	  <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	  <param name = "localhost" value = "<?php echo $this->_tpl_vars['localhost']; ?>
" />
	  <param name = "screen" value = "<?php echo $this->_tpl_vars['screen']; ?>
" />
	  <?php if ($this->_tpl_vars['console'] == 'TRUE'): ?>
	  <param name = "rdparg" value= "admin" />	  
	  <?php endif; ?>
	   <?php if ($this->_tpl_vars['rdpdiskauth_up']): ?>
	  <param name = "disk" value= "<?php echo $this->_tpl_vars['member']['rdpdisk']; ?>
" />	  
	  <?php endif; ?>
	   <?php if ($this->_tpl_vars['rdpclipauth_up']): ?>
	  <param name = "clipboard" value= "1" />	  
	  <?php else: ?>
	  <param name = "clipboard" value= "0" />	
	  <?php endif; ?>

	   <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />	  
	</applet>
<?php else: ?>
<object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=<?php echo $this->_tpl_vars['activex_version']; ?>
" width="0" height="0" id="CMstsc">
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
	  <param name = "bpp" value = "16" />
	  <param name = "password" value = "<?php echo $this->_tpl_vars['password']; ?>
<?php echo $this->_tpl_vars['dynamic_pwd']; ?>
" />
	  <param name = "entrust_password" value = "<?php echo $this->_tpl_vars['entrust_password']; ?>
" />
	  <param name = "localhost" value = "<?php echo $this->_tpl_vars['localhost']; ?>
" />
	  <param name = "screen" value = "<?php echo $this->_tpl_vars['screen']; ?>
" />
	   <?php if ($this->_tpl_vars['console'] == 'TRUE'): ?>
	  <param name = "rdparg" value= "admin" />	  
	  <?php endif; ?>
	  
	  <param name = "disk" value= "<?php if ($this->_tpl_vars['rdpdiskauth_up']): ?><?php echo $this->_tpl_vars['member']['rdpdisk']; ?>
<?php endif; ?>" />	  
	  
	   <?php if ($this->_tpl_vars['rdpclipauth_up']): ?>
	  <param name = "clipboard" value= "1" />	 
	  <?php else: ?>
	  <param name = "clipboard" value= "0" />	  
	  <?php endif; ?>
	   <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />	  
	</object>

	<script type = "text/javascript">
        function Mstsc() 
        {
            if (window.ActiveXObject) 
            {
                try {
                    document.getElementById("CMstsc").StartMstsc();
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
		Mstsc();
    </script>

<?php endif; ?>
</center>		
	
</body>
</html>

