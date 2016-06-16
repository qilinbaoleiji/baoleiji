<?php /* Smarty version 2.6.18, created on 2014-07-03 20:02:27
         compiled from index.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['site_title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />

<script language="javascript">

        function reinitIframe(){
            var iframe = document.getElementById("main");
            var version = 0;
            var minHeight = 600;
            var bHeight = 0;
            if(navigator.userAgent.indexOf("MSIE")>0){
                bHeight = iframe.contentWindow.document.body.scrollHeight;
            }else if(navigator.userAgent.indexOf("Firefox")>0){
                bHeight = iframe.contentWindow.document.body.scrollHeight;
            }else if(navigator.userAgent.indexOf("Chrome")>0){
                bHeight = iframe.contentDocument.body.scrollHeight;
            }else{
				bHeight = iframe.contentWindow.document.body.scrollHeight;
			}//alert(bHeight);	
            //var bHeight2 = iframe.contentWindow.document.body.scrollHeight;
            bHeight = Math.max(bHeight, minHeight)
            iframe.height =  bHeight;

        }

	

	var selectedCactiMenu = '';
	function changeCactiMenu(obj, module){
		if(selectedCactiMenu)
			selectedCactiMenu.parentNode.className='td5';
			obj.parentNode.className = "td6";
			selectedCactiMenu = obj;
			if(module=='cacti'){
				show_box('monitor');
				jumpto(document.getElementById('systemmonitor'));
				document.getElementById('systemmonitor').parentNode.className='zcd';
				document.getElementById('main').src=document.getElementById('systemmonitor').href;

				document.getElementById('audit_menu').style.display='none'
				document.getElementById('log_menu').style.display='none'
				document.getElementById('cacti_menu').style.display='block'
			}else if(module=='audit'){
				show_box('audit');
				jumpto(document.getElementById('sshaudit'));
				document.getElementById('sshaudit').parentNode.className='zcd';
				document.getElementById('main').src=document.getElementById('sshaudit').href;

				document.getElementById('audit_menu').style.display='block'
				document.getElementById('cacti_menu').style.display='none'
				document.getElementById('log_menu').style.display='none'
			}else if(module=='log'){
				show_box('log');
				jumpto(document.getElementById('currentlog'));
				document.getElementById('currentlog').parentNode.className='zcd';
				document.getElementById('main').src=document.getElementById('currentlog').href;

				document.getElementById('audit_menu').style.display='none'
				document.getElementById('cacti_menu').style.display='none'
				document.getElementById('log_menu').style.display='block'
			}else{
				document.getElementById('audit_menu').style.display='none'
				document.getElementById('cacti_menu').style.display='block'
				document.getElementById('log_menu').style.display='none'
			}
		return true;
		
	}
function setScroll(){
	window.scrollTo(0,0);
}
</script>
<script language="JavaScript">
function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6.
{
    var arVersion = navigator.appVersion.split("MSIE")
    var version = parseFloat(arVersion[1])
    if ((version >= 5.5) && (document.body.filters))
    {
       for(var j=0; j<document.images.length; j++)
       {
          var img = document.images[j]
          var imgName = img.src.toUpperCase()
          if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
          {
             var imgID = (img.id) ? "id='" + img.id + "' " : ""
             var imgClass = (img.className) ? "class='" + img.className + "' " : ""
             var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
             var imgStyle = "display:inline-block;" + img.style.cssText
             if (img.align == "left") imgStyle = "float:left;" + imgStyle
             if (img.align == "right") imgStyle = "float:right;" + imgStyle
             if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
             var strNewHTML = "<span " + imgID + imgClass + imgTitle
             + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
             + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
             + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>"
             img.outerHTML = strNewHTML
             j = j-1
          }
       }
    }   
}
//window.attachEvent("onload", correctPNG);


</script>
<style type="text/css">
<!--
body {
	background-color: #F1F1F1;
}
-->
</style>

<style type="text/css"> 
*
#navigation, #navigation li ul { 
list-style-type:none; 
} 
#navigation {
} 
#navigation li { 
float:left; 
text-align:center; 
position:relative; 
} 
#navigation li a:link, #navigation li a:visited { 
display:block; 
text-decoration:none; 
color:#000; 
height:20px; 
line-height:20px; 
padding-left:10px; 
list-style-type:none; 
} 
#navigation li a:hover { 
color:#fff; 
} 
#navigation li ul li a:hover { 
color:#fff; 
left:0; 
width:80px;
background:#6b839c; 
} 
#navigation li ul { 
display:none; 
position:absolute; 
left:0; 
width:80px; 
background:#ADDEFE; 
} 
#navigation li ul li ul { 
display:none; 
position:absolute; 
top:0px; 
left:130px; 
margin-top:0; 
margin-left:1px; 
width:120px; 
} 
</style> 
<script type="text/javascript"> 
function displaySubMenu(li) { 
var subMenu = li.getElementsByTagName("ul")[0]; 
subMenu.style.display = "block"; 
} 
function hideSubMenu(li) { 
var subMenu = li.getElementsByTagName("ul")[0]; 
subMenu.style.display = "none"; 
} 
</script> 
</head>

<body>
<table width="100%" height="486" border="0" cellpadding="0" cellspacing="0" bgcolor="#F1F1F1" >
  <tr>
    <td height="12" valign="top" background="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_03.jpg"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="300" align="left" valign="top"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/02.jpg" /></td>
        <td align="center" valign="top">
			
			<div class="cj" >
				<ul>
				<li><span class="td5"><a href="admin.php?controller=admin_index" onclick="return changeCactiMenu(this, 'audit')"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/home.png"/></a></span><span class="cj_zi">运维</span></li>
				<?php if ($this->_tpl_vars['dbaudit_on']): ?><li><span class="td5"><a href="dbaudit" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/db.png" /></a></span><span class="cj_zi">DB审计</span></li><?php endif; ?>				
				<?php if ($this->_tpl_vars['log_on']): ?><li><span class="td5"><a href="log" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/02.png" /></a></span><span class="cj_zi">日志</span></li><?php endif; ?>
				<?php if ($this->_tpl_vars['cacti_on']): ?><li><span class="td5"><a href="monitor" id="cactimenu" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/01.png"/></a></span><span class="cj_zi">监控</span></li><?php endif; ?>
				</ul>
			</div>
					</td>
        <td width="200" align="right" valign="top"><table width="200" height="31" border="0" cellpadding="0" cellspacing="0" class="lj_hei">
          <tr>
            <td width="18" height="31" bgcolor="ADDEFE"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_05.jpg" width="18" height="31" /></td>
            <td align="center" bgcolor="ADDEFE" ><ul id="navigation"> <li><a href="admin.php?controller=admin_index"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_07.jpg" width="16" height="16" align="absmiddle" />主页</a></li><li><a href="admin.php?controller=admin_index&amp;action=logout"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_09.jpg" width="15" height="16" align="absmiddle" />退出</a></li><?php if ($this->_tpl_vars['user']['common_user_pri'] || $this->_tpl_vars['user']['passwd_user_pri'] || $this->_tpl_vars['user']['audit_user_pri']): ?>
<li onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)"> 
<a href="#" ><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico8.gif" width="15" height="16" align="absmiddle" />切换</a>
<ul style='width:70px;'> 
<?php if ($this->_tpl_vars['user']['common_user_pri']): ?>
<li><a href="admin.php?controller=admin_index&action=changerole&level=0">运维用户</a></li>
<?php endif; ?>
<?php if ($this->_tpl_vars['user']['passwd_user_pri']): ?>
<li><a href="admin.php?controller=admin_index&action=changerole&level=10">密码用户</a></li>
<?php endif; ?>
<?php if ($this->_tpl_vars['user']['audit_user_pri']): ?>
<li><a href="admin.php?controller=admin_index&action=changerole&level=2">审计用户</a></li>
<?php endif; ?>
<li><a href="admin.php?controller=admin_index&action=changerole&level=<?php echo $this->_tpl_vars['user']['level']; ?>
"><?php if ($this->_tpl_vars['user']['level'] == 1): ?><?php elseif ($this->_tpl_vars['user']['level'] == 2): ?>运维<?php elseif ($this->_tpl_vars['user']['level'] == 3): ?>部门<?php elseif ($this->_tpl_vars['user']['level'] == 4): ?>配置<?php elseif ($this->_tpl_vars['user']['level'] == 10): ?>密码<?php endif; ?>管理员</a></li>
</ul> 
</li> 
<a href="admin.php?controller=admin_index&amp;action=changerole"> </a><?php endif; ?></ul></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td width="230" align="left" valign="top" id="left" >
	   <iframe id="menu" name="menu" src="admin.php?controller=admin_index&amp;action=menu&actions=<?php echo $_GET['actions']; ?>
&ldapid=<?php echo $_GET['ldapid']; ?>
" marginwidth="0"  framespacing="0" marginheight="0" height="700" frameborder="0" width="230" allowtransparency="true" scrolling="auto" style="overflow-x:hidden;"></iframe>
	</td>
	 
        
        <td width="" align="left" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>
		<iframe id="main" name="main" marginwidth="0" onload="reinitIframe();setScroll();" framespacing="0" marginheight="0" frameborder="0" width="100%" allowtransparency="true" scrolling="no" ></iframe></td></tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
</table>


</body>
</html>