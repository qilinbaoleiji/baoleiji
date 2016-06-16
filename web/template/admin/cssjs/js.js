	var openid="";
	function show_box(box_id){
		if(openid!=""&&openid!=box_id)
		document.getElementById(openid).style.display = "none";
		openid=box_id
		if(document.getElementById(box_id).style.display != "block"){
			document.getElementById(box_id).style.display = "block";
		} else {
			document.getElementById(box_id).style.display = "none";
		}
	}

	var selectedItem = '';
	function jumpto(obj){
		if(selectedItem)
		selectedItem.parentNode.className='zcd01';
		obj.parentNode.className = "zcd";
		selectedItem = obj;
		return true;
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

	function menuhide(){
		 if(document.getElementById('left').style.display=='none'){
			document.getElementById('left').style.display='block'
			document.getElementById('left2').style.display='none'
		 }else{
			document.getElementById('left').style.display='none'
			document.getElementById('left2').style.display='block'
		 }
	
	
}


function setScroll(){
	window.scrollTo(0,0);
}

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
window.attachEvent("onload", correctPNG);


function displaySubMenu(li) { 
var subMenu = li.getElementsByTagName("ul")[0]; 
subMenu.style.display = "block"; 
} 
function hideSubMenu(li) { 
var subMenu = li.getElementsByTagName("ul")[0]; 
subMenu.style.display = "none"; 
} 

document.ondblclick= function(){
	menuhide();
}
document.getElementById("main").contentWindow.document.ondblclick= function(){
	menuhide();
}

function reinitIframe(){
	var iframe = document.getElementById("main");
	var version = 0;
	var minHeight = 600;
	var bHeight = 0;
	if(navigator.userAgent.indexOf("MSIE")>0){
		bHeight = iframe.contentWindow.document.body.scrollHeight;
	}else if(navigator.userAgent.indexOf("Firefox")>0){
		bHeight = iframe.contentWindow.document.body.scrollHeight;
	}//alert(bHeight);	
	//var bHeight2 = iframe.contentWindow.document.body.scrollHeight;
	bHeight = Math.max(bHeight, minHeight)
	iframe.height =  bHeight;

}

    

  
show_box('audit');
jumpto(document.getElementById('sshaudit'));
document.getElementById('sshaudit').parentNode.className='zcd';
document.getElementById('main').src=document.getElementById('sshaudit').href;
 
