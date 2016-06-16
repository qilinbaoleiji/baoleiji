<?php /* Smarty version 2.6.18, created on 2014-05-08 15:59:47
         compiled from replay.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Replay']; ?>
</title>
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
				<td>   
				<?php if ($this->_tpl_vars['app_act'] == 'applet'): ?>
				 <applet
	code = "com.free.<?php echo $this->_tpl_vars['tool']; ?>
Playback",
	name = "PuttyApplet",
	archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/utilities.jar",
	width = 0,
	height = 0>
	   <param name = "putty_path" value = "c:\freesvr\ssh\putty.exe" />
   <param name="host" value="<?php echo $this->_tpl_vars['proxy_addr']; ?>
"/> 
   <param name = "monitorport" value="22"/>                  
   <param name = "monitoruser" value = "<?php echo $this->_tpl_vars['s']['luser']; ?>
--monitor1" /> 
   <param name = "monitorpassword" value = "<?php echo $this->_tpl_vars['random']; ?>
" /> 
   <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />       
   <param name = "cid" value= "<?php echo $this->_tpl_vars['cid']; ?>
--<?php echo $this->_tpl_vars['random']; ?>
" />       
	<param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	</applet>
	<?php else: ?>
<object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=1,0,0,1" width="0" height="0" id="Csecurecrtdisplay">

	   <param name = "putty_path" value = "c:\freesvr\ssh\putty.exe" />
   <param name="host" value="<?php echo $this->_tpl_vars['proxy_addr']; ?>
"/> 
   <param name = "monitorport" value="22"/>                  
   <param name = "monitoruser" value = "<?php echo $this->_tpl_vars['s']['luser']; ?>
--monitor1" /> 
   <param name = "monitorpassword" value = "<?php echo $this->_tpl_vars['random']; ?>
" /> 
   <param name = "sid" value= "<?php echo $this->_tpl_vars['sid']; ?>
" />       
   <param name = "cid" value= "<?php echo $this->_tpl_vars['cid']; ?>
--<?php echo $this->_tpl_vars['random']; ?>
" />       
	<param name = "proxy_addr" value= "<?php echo $this->_tpl_vars['proxy_addr']; ?>
" />
	</object>
	<script type = "text/javascript">
         function securecrtdisplay() 
        {
            if (window.ActiveXObject) 
            {
                try 
                {
					<?php if ($this->_tpl_vars['tool'] == 'putty.Putty'): ?>
						document.getElementById("Csecurecrtdisplay").StartPuttyDisplay();
					<?php else: ?>
						document.getElementById("Csecurecrtdisplay").StartSecureCRTDisplay();
					<?php endif; ?>
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
		securecrtdisplay();
    </script>

	<?php endif; ?>
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

