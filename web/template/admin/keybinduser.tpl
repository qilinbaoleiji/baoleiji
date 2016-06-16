<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />

</head>
 <SCRIPT language=javascript src="{{$template_root}}/images/selectdate.js"></SCRIPT>
 <style>
 .operate {
	width: 60px; height: 20px; padding-top:5px; padding-bottom:5px;
}

.operate_common{
	position: absolute; top: 0px; left: 0px;  background-color: #FFFFFF; visibility: hidden; margin-bottom:8px; overflow: hidden; border: 1px solid #92B7E5; 
}
 </style>
<script>
var menuTimer = null;

function show_menu(obj1,obj2,state,location,keyid){ 
    var btn=document.getElementById(obj1);
    var obj=document.getElementById(obj2);
    var h=btn.offsetHeight;
    var w=btn.offsetWidth;
    var x=btn.offsetLeft;
    var y=btn.offsetTop;
    obj.innerHTML=keyid;
   /* obj.onmouseover =function(){
        show_menu(obj1,obj2,'show',location,keyid);
    }*/
    obj.onmouseout =function(){
        show_menu(obj1,obj2,'hide',location);
    }
    
    while(btn=btn.offsetParent){y+=btn.offsetTop;x+=btn.offsetLeft;}
    
    var hh=obj.offsetHeight;
    var ww=obj.offsetWidth;
    var xx=obj.offsetLeft;
    var yy=obj.offsetTop;
    var obj2state=state.toLowerCase();
    var obj2location=location.toLowerCase();
    
    var showx,showy;

    if(obj2location=="left" || obj2location=="top" || obj2location=="right" || obj2location=="bottom"){
        if(obj2location=="left"){showx=x-ww;showy=y;}
        if(obj2location=="top"){showx=x;showy=y-hh;}
        if(obj2location=="right"){showx=x+w;showy=y;}
        if(obj2location=="bottom"){showx=x;showy=y+h;}
    }else{ 
        showx=xx;showy=yy;
    }
    obj.style.left=showx+"px";
    obj.style.top=showy+"px";
    if(state =="hide"){
        menuTimer =setTimeout("_hide_menu('"+ obj2 +"')", 1);
    }else{
        clearTimeout(menuTimer);
        obj.style.visibility ="visible";
    }
}
function _hide_menu(id){
    document.getElementById(id).style.visibility ="hidden";
}

</script>
<body>

<div id="opdiv" class="operate operate_common">

</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="hui_bj">{{$title}}</td>
  </tr>
  <tr>
	<td class="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><form name="f1" method=post action="admin.php?controller=admin_member&action=keybinduser_save&keyid={{$keyid}}">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top  class="BBtable">
		
	  <tr bgcolor="f7f7f7"><td></td><td>key:{{$key.keyid}}</td></tr>
		<tr>
		<td width="33%" align=right>
		{{$language.bind}}{{$language.User}}
		</td>
		<td width="67%">
		<table><tr bgcolor="f7f7f7">
		{{section name=g loop=$allmem}}
		<td width="150"><input type="radio" name='member' value='{{$allmem[g].uid}}'  {{if $allmem[g].usbkey eq $key.keyid}}checked{{/if}}><a id="op_{{$allmem[g].uid}}" onMouseOut="show_menu('op_{{$allmem[g].uid}}','opdiv','hide','left','{{$allmem[g].usbkeystr}}');" onclick="show_menu('op_{{$allmem[g].uid}}','opdiv','show','left','{{$allmem[g].usbkeystr}}');return false" href="#" target="_blank" style="color:{{$allmem[g].color}}" >{{$allmem[g].username}}</a></td>{{if ($smarty.section.g.index +1) % 5 == 0}}</tr><tr {{if ($smarty.section.g.index +1) % 10 == 0}}bgcolor="f7f7f7"{{/if}}>{{/if}}
		{{/section}}
		</tr></table>
	  </td>
	  </tr>
	 
	<tr><td></td><td><input type=submit  value="{{$language.Save}}" class="an_02"></td></tr></table>
</form>
	</td>
  </tr>
</table>
 
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



