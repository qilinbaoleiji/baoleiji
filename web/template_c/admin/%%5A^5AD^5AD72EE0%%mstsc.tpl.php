<?php /* Smarty version 2.6.18, created on 2014-06-11 00:55:30
         compiled from mstsc.tpl */ ?>
<html>
<head>
<title>MSTSC Player</title>
</head>
<body>
<h1><center>MSTSC Player: <?php echo $this->_tpl_vars['app_act']; ?>
</center></h1>
	
	<center>
	<?php if ($this->_tpl_vars['app_act'] == 'applet'): ?>
	<applet
	code = "com.free.mstsc.ControlPlayer.class",
	archive = "<?php echo $this->_tpl_vars['template_root']; ?>
/rdpcontrol.jar",
	width = 0,
	height = 0>
     <param name="host" value="<?php echo $this->_tpl_vars['session']['proxy_addr']; ?>
"/>
	  <param name = "port" value="3390"/>
	  <param name = "username" value = "<?php echo $this->_tpl_vars['sid']; ?>
" />
	  <param name = "window_size" value = "<?php echo $this->_tpl_vars['session']['window_size']; ?>
" />
	  <param name = "bpp" value = "<?php echo $this->_tpl_vars['session']['bpp']; ?>
" />
	  <param name = "cport" value = "8888" />
	</applet>
	<?php else: ?>
	 <object classid="clsid:9B63D7FE-1BF8-4888-B5D3-715D5A0E51E2"  codebase="<?php echo $this->_tpl_vars['template_root']; ?>
/ProgramActiveX.cab#version=<?php echo $this->_tpl_vars['activex_version']; ?>
" width="0" height="0" id="Crdpdisplay">
     <param name="host" value="<?php echo $this->_tpl_vars['session']['proxy_addr']; ?>
"/>
	  <param name = "port" value="3390"/>
	  <param name = "username" value = "<?php echo $this->_tpl_vars['sid']; ?>
" />
	  <param name = "window_size" value = "<?php echo $this->_tpl_vars['session']['window_size']; ?>
" />
	  <param name = "bpp" value = "<?php echo $this->_tpl_vars['session']['bpp']; ?>
" />
	  <param name = "cport" value = "8888" />
	</object>
	<script type = "text/javascript">
       function rdpdisplay() 
        {
            if (window.ActiveXObject) 
            {
                try {
                    document.getElementById("Crdpdisplay").StartRdpReplay();
                }
                catch (e) 
                {
                    alert(e.description)
                    alert(e.name)
                    alert(e.message)
                }
            }
        }
       rdpdisplay();
    </script>
	<?php endif; ?>
</center>
</body>
</html>

