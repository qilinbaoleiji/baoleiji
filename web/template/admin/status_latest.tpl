<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$language.Master}}{{$language.page}}面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/border-radius.css" />
<STYLE>HTML {
	MARGIN: 0px; HEIGHT: 100%; FONT-SIZE: 12px
}
BODY {
	MARGIN: 0px; HEIGHT: 100%; FONT-SIZE: 12px
}
.mesWindow {
	BORDER-BOTTOM: #666 1px solid; BORDER-LEFT: #666 1px solid; BACKGROUND: #fff; BORDER-TOP: #666 1px solid; BORDER-RIGHT: #666 1px solid
}
.mesWindowTop {
	BORDER-BOTTOM: #eee 1px solid; TEXT-ALIGN: left; PADDING-BOTTOM: 3px; PADDING-LEFT: 3px; PADDING-RIGHT: 3px; MARGIN-LEFT: 4px; FONT-SIZE: 12px; FONT-WEIGHT: bold; PADDING-TOP: 3px
}
.mesWindowContent {
	MARGIN: 4px; FONT-SIZE: 12px
}
.mesWindow .close {
	BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; WIDTH: 28px; BACKGROUND: #fff; HEIGHT: 15px; BORDER-TOP: medium none; CURSOR: pointer; BORDER-RIGHT: medium none; TEXT-DECORATION: underline
}
</STYLE>
<script src="./template/admin/cssjs/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="{{$template_root}}/cssjs/launchprogram.js"></script>
<script src="./template/admin/cssjs/highcharts.js"></script>
<script src="./template/admin/cssjs/exporting.js"></script>
<script language="JavaScript">
var chart;
	/*$(document).ready(function() {

		var cpu = {{$latest[0].cpu}};
		var memory = {{$latest[0].memory}};
		var disk = {{$latest[0].disk}};
		var swap = {{$latest[0].swap}};
		
//		alert(cpu);
		
	 	var arr = getArray(cpu);
		getPie('cpu','cpu',arr);
		var arr = getArray(memory);
		getPie('memory','memory',arr);
		var arr = getArray(disk);
		getPie('disk','disk',arr);
		var arr = getArray(swap);
		getPie('swap','swap',arr);
		

	});*/
	
	function getArray(param){
		var tmp = new Array();
		var o = new Object();
		var o1 = new Object();
		o.name = "利用率";
		o.num = parseInt(param);
		o1.name = "未利用率";
		o1.num = 100-parseInt(param);
		tmp.push(o1);
		tmp.push(o);
		
		return tmp;
	}

	function getPie(divid,title,arr){
            var data = new Array();
            for(var i=0; i<arr.length;i++){
                    var o = new Object();
                    o.y =  arr[i].num ;
                    o.name = arr[i].name;
                                                
                    data[i] =  o;
              }
	
		chart = new Highcharts.Chart({
					chart: {
						renderTo: divid,
						plotBorderWidth: null,
						marginRight: 0,
						marginLeft: 0,
						marginTop: 0,
						marginBottom: 0,
						plotShadow: false

					},
					title: {
						text: ''
					},
					exporting: { 
			            enabled: false  //设置导出按钮不可用 
			        }, 
					tooltip: {
						formatter: function() {
							return   this.point.name+":"+this.y+"%";
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								formatter: function() {
									return  this.point.name+":<br>"+this.y;
									//return  this.y;
								}
							},
							showInLegend: false
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						data: data
					}]
				});
	}

var isIe=(document.all)?true:false;
//设置select的可见状态
function setSelectState(state)
{
	var objl=document.getElementsByTagName('select');
	for(var i=0;i<objl.length;i++)
	{
		objl[i].style.visibility=state;
	}
}
function mousePosition(ev)
{
	if(ev.pageX || ev.pageY)
	{
		return {x:ev.pageX, y:ev.pageY};
	}
	return {
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,y:ev.clientY + document.body.scrollTop - document.body.clientTop
	};
}

function showImg(wTitle, ev ,id)
{
	closeWindow();
	//var pos = mousePosition(ev);
	var wWidth=600;
	var wHeight=600;
	var bWidth=parseInt(w=window.innerWidth|| document.documentElement.clientWidth|| document.body.clientWidth);
	var bHeight=parseInt(window.innerHeight|| document.documentElement.clientHeight|| document.body.clientHeight)+20;
	bHeight=700+20;
	if(isIe){
		setSelectState('hidden');
	}
	var back=document.createElement("div");
	back.id="back";
	var styleStr="top:0px;left:0px;position:absolute;background:#666;width:"+bWidth+"px;height:"+bHeight+"px;";
	styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
	back.style.cssText=styleStr;
	document.body.appendChild(back);
	var mesW=document.createElement("div");
	mesW.id="mesWindow";
	mesW.className="mesWindow";
	mesW.innerHTML="<div><img id=\"1d\" src='{{$template_root}}/images/1d.gif' onClick=\"reloadimg();\" style=\"cursor:hand;\" alt=\"最近1天\">&nbsp; <img id=\"7d\" src='{{$template_root}}/images/7d.gif' onClick=\"reloadimg('week');\" style=\"cursor:hand;\" alt=\"最近7天\">&nbsp; <img id=\"30d\" src='{{$template_root}}/images/30d.gif' onClick=\"reloadimg('month');\" style=\"cursor:hand;\" alt=\"最近30天\">&nbsp; <img id=\"365d\" src='{{$template_root}}/images/365d.gif' onClick=\"reloadimg('year');\" style=\"cursor:hand;\" alt=\"最近365天\"><div style=\"float:right\"><img id=\"f_rangeStart_trigger\" name=\"f_rangeStart_trigger\" src='{{$template_root}}/images/period.gif' style=\"cursor:hand;\" alt=\"自定义时间段\" title=\"自定义时间段\"><input type=\"hidden\"  name=\"f_rangeStart\" size=\"13\" id=\"f_rangeStart\" value=\"\" class=\"wbk\"/></div>&nbsp;&nbsp;<div onclick='closeWindow();'><div class='mesWindowContent' id='mesWindowContent'><img id='zoomGraphImage'  src='admin.php?controller=admin_monitor&action=status_image&type=localstatus&id="+id+"&"+parseInt(10000*Math.random())+"' border=0 ></div><div class='mesWindowBottom'></div></div></div>";
	//styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";//鼠标点击位置
	styleStr="left:"+(bWidth-wWidth)/2+"px;top:"+(bHeight-wHeight)/2+"px;position:absolute;width:"+wWidth+"px;";
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
	//window.parent.document.getElementById("frame_content").height=pos.y+1000;
	//window.parent.parent.document.getElementById("main").height=bHeight+1000;		
	var cal = Calendar.setup({
    onSelect: function(cal) { 
				cal.hide();
				var img = document.getElementById("zoomGraphImage");
				img.src=img.src+"&duration=&date="+cal.selection.sel[0]+"&"+parseInt(10000*Math.random());
			 },
    showTime: true
});
	cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d %H:%M:%S");
	return false;
}


//关闭窗口
function closeWindow()
{
	if(document.getElementById('back')!=null)
	{
		document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
	}
	if(document.getElementById('mesWindow')!=null)
	{
		document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
	}
	if(document.getElementById('_mesWindow')!=null)
	{
		document.getElementById('_mesWindow').parentNode.removeChild(document.getElementById('_mesWindow'));
	}
	if(isIe){
		setSelectState('');
	}
	document.getElementById('fade').style.display='none'
	window.parent.reinitIframe();
}
document.onclick=function(){
	var pos = mousePosition(event);
	if(event.srcElement['tagName']!='A'&&event.srcElement['tagName']!='IMG'&&event.srcElement['tagName']!='FONT'){
		closeWindow();
	}
}

function reloadimg(duration){
	var img = document.getElementById("zoomGraphImage");
	img.src=img.src+"&duration="+duration+"&"+parseInt(10000*Math.random());
}

function showAuditUser(wTitle, c)
{
	closeWindow();
	//var pos = mousePosition(ev);
	var wWidth=260;
	var wHeight=400;
	var bWidth=parseInt(w=window.innerWidth|| document.documentElement.clientWidth|| document.body.clientWidth);
	var bHeight=parseInt(window.innerHeight|| document.documentElement.clientHeight|| document.body.clientHeight)+20;
	bHeight=700+20;
	var back=document.createElement("div");
	back.id="back";
	var styleStr="top:0px;left:0px;position:absolute;width:"+bWidth+"px;height:"+bHeight+"px;z-index:1002;";
	//styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
	back.style.cssText=styleStr;
	document.body.appendChild(back);
	var mesW=document.createElement("div");
	mesW.id="_mesWindow";
	mesW.className="_mesWindow";
	mesW.innerHTML='<div id="light" class="white_content" style="height:330px;" ><table width="96%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#eeeeee" align="left" height="25"><a href="javascript:void(0)" onclick="closeWindow()">关闭</a></td></tr></table>'+c+"</div>";
	//styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";//鼠标点击位置
	//styleStr="left:"+(bWidth-wWidth)/2+"px;top:"+(bHeight-wHeight)/2+"px;position:absolute;width:"+wWidth+"px;";//屏幕中间
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
	//window.parent.document.getElementById("frame_content").height=pos.y+1000;
	//window.parent.parent.document.getElementById("main").height=bHeight+1000;	
	
	document.getElementById('fade').style.display='block'
	return false;
}

function loadurl(url){
	$.get(url, {Action:"get",Name:"lulu"}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		//alert(data);
		showAuditUser('',data);
	});
}

function change_option(number,index){
 for (var i = 1; i <= number; i++) {
      document.getElementById('current' + i).className = '';
      document.getElementById('content' + i).style.display = 'none';
 }
  document.getElementById('current' + index).className = 'current1';
  document.getElementById('content' + index).style.display = 'block';

  window.parent.reinitIframe();
  return false;
}
function changeStyle(obj,c)
{
	if(c!='o'){
		obj.style.backgroundColor=c;
	}else{
		obj.style.backgroundColor="#FFCC80";
	}
}
</script>
</head>
<body>
<div id="fade" class="black_overlay"></div> 
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
<td width="84%" align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=serverstatus">服务状态</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_status&action=latest">系统状态</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup">配置备份</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting">数据同步</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=upgrade">软件升级</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=cronjob">定时任务</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=changelogo">图标上传</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=notice">系统通知</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
 <tr><td>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="10" bgcolor="#FFFFFF">
  <tr>
    <td width="40%" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#7cb9f2 1px solid;" height=330>
      <tr>
       


              <TH class=list_bg borderColor=white><A  href="#">系统状态</A></TH>
            </TR>
            <TR>
              <TD><table border=0 cellSpacing=3 cellPadding=6 width="100%">
                  <tr bgcolor="#f7f7f7">
                    <td height="25">系统状态</td>
                    <td>双机({{$ha}})&nbsp;&nbsp;&nbsp;&nbsp;{{$uptime}}</td>
                  </tr>
                  <tr>
                    <td height="25">软件版本</td>
                    <td>{{$version}}</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">SSH连接并发</td>
                    <td>{{$latest[0].ssh_conn_a}}</td>
                  </tr>
                  <tr>
                    <td height="25">Telnet连接并发</td>
                    <td>{{$latest[0].telnet_conn_a}}</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">图形会话并发</td>
                    <td>{{$latest[0].graph_conn_a}}</td>
                  </tr>
                  <tr>
                    <td height="25">FTP会话并发</td>
                    <td>{{$latest[0].ftp_conn_a}}</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">数据库并发</td>
                    <td>{{$latest[0].db_conn_a}}</td>
                  </tr>
				  <tr>
                    <td height="25">MySQL并发</td>
                    <td>{{$latest[0].mysql_conn_a}}</td>
                  </tr>
				  <tr bgcolor="#f7f7f7">
                    <td height="25">HTTP并发</td>
                    <td>{{$latest[0].http_conn_a}}</td>
                  </tr>
                  <tr>
                    <td height="25">设备总数</td>
                    <td>{{$latest[0].serverct}}</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">主账号数</td>
                    <td><a href="#" onclick="loadurl('admin.php?controller=admin_member&action=showUsersByLevel');return false;" >{{$latest[0].memberct}}</a></td>
                  </tr>
                  <tr>
                    <td height="25">从账号数</td>
                    <td>{{$latest[0].devpassct}}</td>
                  </tr>
              </table></TD>
            </TR>    </table></td>
    <td valign="top">
    <TABLE  border=0 cellSpacing=0 style="border:#7cb9f2 1px solid;" cellPadding=5 width="100%"  height=366>
      <TBODY>
        <TR>
          <TH width="40%" class=list_bg>CPU利用率</TH>
          <TH width="40%" class=list_bg>硬盘利用率</TH>
           </TR>
        <TR align="center" bgColor=#FFFFFF>
          <TD>         <p><img style="cursor:hand;" onclick="showImg('cpu利用率',event,'{{$latest[0].cpu_seq}}');return false;" src="include/pChart/graphgenerate2.php?data[]={{$cpu.used}}&data[]={{$cpu.unused}}&{{$info}}&graphtype=pie"></p>
            </TD>
          <TD><img style="cursor:hand;" onclick="showImg('硬盘利用率',event,'{{$latest[0].disk_seq}}');return false;" src="include/pChart/graphgenerate2.php?data[]={{$disk.used}}&data[]={{$disk.unused}}&{{$info}}&graphtype=pie"></TD>
           </TR>
        <TR>
          <TH class=list_bg>内存利用率</TH>
          <TH class=list_bg>SWAP利用率</TH>
           </TR>
        <TR align="center" bgColor=#FFFFFF>
          <TD><img style="cursor:hand;" onclick="showImg('内存利用率',event,'{{$latest[0].memory_seq}}');return false;" src="include/pChart/graphgenerate2.php?data[]={{$memory.used}}&data[]={{$memory.unused}}&{{$info}}&graphtype=pie">        </TD>
          <TD><img style="cursor:hand;" onclick="showImg('SWAP利用率',event,'{{$latest[0].swap_seq}}');return false;" src="include/pChart/graphgenerate2.php?data[]={{$swap.used}}&data[]={{$swap.unused}}&{{$info}}&graphtype=pie"></TD>
         </TR>
      </TBODY>
    </TABLE></td>
  </tr>
 <tr><td colspan="2">
     <DIV id="navbar1" style="width: 100%;">
            <DIV id="header1">
            <UL>
              <LI id="current1"><A onClick="return change_option(6,1);return false;"  href="#">SSH实时监控</A></LI>
              <LI id="current2"><A onClick="return change_option(6,2);return false;"  href="#">Telnet实时监控</A></LI>
              <LI id="current3"><A onClick="return change_option(6,3);return false;"  href="#">RDP实时监控</A></LI>
              <LI id="current4"><A onClick="return change_option(6,4);return false;"  href="#">VNC实时监控</A></LI>
              <LI id="current5"><A onClick="return change_option(6,5);return false;"  href="#">应用发布实时监控</A></LI>
              <LI id="current6"><A onClick="return change_option(6,6);return false;"  href="#">WEB</A></LI></UL></DIV>
            <div id="tabbottom" > 
            <DIV class="content1" id="content1">
            <DIV class="contentMain1">
               <table border=0 cellSpacing=3 cellPadding=6 width="100%">
                  <tr>               
				<th class="list_bg"  width="8%">运维用户</th>
				<th class="list_bg"  width="8%">真实姓名</th>
				<th class="list_bg"  width="8%">系统用户</th>
				<th class="list_bg"  width="10%">来源地址</th>
				<th class="list_bg"  width="10%">目标地址</th>
				<th class="list_bg"  width="10%">开始时间</th>
				<th class="list_bg"  width="10%">堡垒机</th>
				<th class="list_bg"  width="10%">操作</th>
			</tr>
			{{section name=t loop=$ssh}}
			<tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}} onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'{{if $smarty.section.t.index % 2 == 0}}f7f7f7{{/if}}');">
				<td>{{$ssh[t].luser}}</td>
				<td>{{$ssh[t].realname}}</td>
				<td>{{$ssh[t].user}}</td>
				<td>{{$ssh[t].cli_addr}}</td>
				<td>{{$ssh[t].addr}}</td>
				<td>{{$ssh[t].start}}</td>
				<td>{{$ssh[t].baoleiip}}</td>
				<td><img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_session&action=cut_running&pid={{if $ssh[t].type eq 'telnet'}}{{$ssh[t].pid}}{{else}}{{$ssh[t].pid}}.{{$ssh[t]['sid']}}{{/if}}" >断开</a>
				| <img src="{{$template_root}}/images/ico2.gif" width="16" height="16" align="absmiddle"><a  id="p_{{$ssh[t]['sid']}}" href="#" onClick="return go('admin.php?controller=admin_session&action=monitor&luser={{$ssh[t].luser}}&tool=putty.Putty&pid={{if $ssh[t].type eq 'telnet'}}{{$ssh[t].pid}}{{else}}{{$ssh[t].pid}}.{{$ssh[t]['sid']}}{{/if}}&type=gateway','p_{{$ssh[t]['sid']}}')" target="hide" >putty</a> | <a  id="c_{{$ssh[t]['sid']}}" href="#" onClick="return go('admin.php?controller=admin_session&action=monitor&luser={{$ssh[t].luser}}&tool=securecrt.SecureCRT&pid={{if $ssh[t].type eq 'telnet'}}{{$ssh[t].pid}}{{else}}{{$ssh[t].pid}}.{{$ssh[t]['sid']}}{{/if}}&type=gateway','c_{{$ssh[t]['sid']}}')" target="hide" >CRT</a>
				</td>
			</tr>
			{{/section}}
			<tr>
				<td colspan="7" align="right">
					共{{$sshcommand_num}}条  {{$sshpage_list}}  页次：{{$sshcurr_page}}/{{$sshtotal_page}}页  {{$sshitems_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&item=1&page='+this.value;">页
				</td>
			</tr>
                </table>
            </DIV></DIV>
            <DIV class="content1" id="content2" style="display: none;">
            <DIV class="contentMain1">
            <TABLE width="100%" class="BBtable" bgcolor="#ffffff" border="0" 
            cellspacing="1" cellpadding="5" align="center" >
              <TBODY>
			  <tr>
				<th class="list_bg"  width="8%">运维用户</th>
				<th class="list_bg"  width="8%">真实姓名</th>
				<th class="list_bg"  width="8%">系统用户</th>
				<th class="list_bg"  width="10%">来源地址</th>
				<th class="list_bg"  width="10%">目标地址</th>
				<th class="list_bg"  width="10%">开始时间</th>
				<th class="list_bg"  width="10%">堡垒机</th>
				<th class="list_bg"  width="10%">操作</th>
			</tr>
			{{section name=t loop=$telnets}}
              <tr {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}} onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'{{if $smarty.section.t.index % 2 == 0}}f7f7f7{{/if}}');">
				<td>{{$telnets[t].luser}}</td>
				<td>{{$telnets[t].realname}}</td>
				<td>{{$telnets[t].user}}</td>
				<td>{{$telnets[t].cli_addr}}</td>
				<td>{{$telnets[t].addr}}</td>
				<td>{{$telnets[t].start}}</td>
				<td>{{$telnets[t].baoleiip}}</td>
				<td><img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_session&action=cut_running&pid={{if $telnets[t].type eq 'telnet'}}{{$telnets[t].pid}}{{else}}{{$telnets[t].pid}}.{{$telnets[t]['sid']}}{{/if}}">断开</a>
				| <img src="{{$template_root}}/images/ico2.gif" width="16" height="16" align="absmiddle"><a  id="p_{{$telnets[t]['sid']}}" href="#" onClick="return go('admin.php?controller=admin_session&action=monitor&luser={{$telnets[t].luser}}&tool=putty.Putty&pid={{if $telnets[t].type eq 'telnet'}}{{$telnets[t].pid}}{{else}}{{$telnets[t].pid}}.{{$telnets[t]['sid']}}{{/if}}&type=gateway','p_{{$telnets[t]['sid']}}')" target="hide" >putty</a> | <a  id="c_{{$telnets[t]['sid']}}" href="#" onClick="return go('admin.php?controller=admin_session&action=monitor&luser={{$telnets[t].luser}}&tool=securecrt.SecureCRT&pid={{if $telnets[t].type eq 'telnet'}}{{$telnets[t].pid}}{{else}}{{$telnets[t].pid}}.{{$telnets[t]['sid']}}{{/if}}&type=gateway','c_{{$telnets[t]['sid']}}')" target="hide" >CRT</a>
				</td>
			</tr>
			{{/section}}
			<tr>
				<td colspan="7" align="right">
					共{{$telnetcommand_num}}条  {{$telnetpage_list}}  页次：{{$telnetcurr_page}}/{{$telnettotal_page}}页  {{$telnetitems_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&item=2&page='+this.value;">页
				</td>
			</tr>
			</TBODY></TABLE></DIV></DIV>
            <DIV class="content1" id="content3" style="display: none;">
            <DIV class="contentMain1">
             <TABLE width="100%" class="BBtable" bgcolor="#ffffff" border="0" 
            cellspacing="1" cellpadding="5" align="center" >
              <TBODY>
             <tr>
				<th class="list_bg"  width="10%">运维用户</th>
				<th class="list_bg"  width="10%">真实姓名</th>
				<th class="list_bg"  width="10%">系统用户</th>
				<th class="list_bg"  width="10%">来源地址</th>
				<th class="list_bg"  width="10%">目标地址</th>
				<th class="list_bg"  width="10%">开始时间</th>
				<th class="list_bg"  width="10%">操作</th>
					</tr>
					{{section name=t loop=$rdprun}}
					<tr {{if $rdprun[t].dangerous > 1}}bgcolor="red"{{elseif $rdprun[t].dangerous > 0}}bgcolor="yellow" {{elseif $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}} onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'{{if $rdprun[t].dangerous > 1}}red{{elseif $rdprun[t].dangerous > 0}}yellow{{elseif $smarty.section.t.index % 2 == 0}}f7f7f7{{/if}}');">

					<td>{{$rdprun[t].luser}}</td>
					<td>{{$rdprun[t].realname}}</td>
					<td>{{$rdprun[t].user}}</td>
					<td>{{$rdprun[t].cli_addr}}</td>					
					<td>{{$rdprun[t].addr}}</td>					
					<td>{{$rdprun[t].start}}</td>
					<td><img src="{{$template_root}}/images/disconnect.png" width="16" height="16" align="absmiddle">
					<a href="admin.php?controller=admin_rdprun&action=cutoff&sid={{$rdprun[t]['sid']}}" >断开</a> | <img src="{{$template_root}}/images/036.gif" width="16" height="16" align="absmiddle"><a id="p_rdp_{{$rdprun[t]['sid']}}" onclick="return go('admin.php?controller=admin_rdprun&mstsc=1&sid={{$rdprun[t]['sid']}}','p_rdp_{{$rdprun[t]['sid']}}')" href="#" target="hide">监控</a></td>
					</tr>
					{{/section}}
					<tr>
				<td colspan="7" align="right">
					共{{$rdprunsession_num}}条  {{$rdprunpage_list}}  页次：{{$rdpruncurr_page}}/{{$rdpruntotal_page}}页  {{$rdprunitems_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&item=3&page='+this.value;">页
				</td>
			</tr>
					</TBODY></TABLE>
                
                </DIV></DIV>
            <DIV class="content1" id="content4" style="display: none;">
            <DIV class="contentMain1">
             <TABLE width="100%" class="BBtable" bgcolor="#ffffff" border="0" 
            cellspacing="1" cellpadding="5" align="center" >
              <TBODY>
              <tr>
						<th class="list_bg"  width="10%">运维用户</th>
						<th class="list_bg"  width="10%">真实姓名</th>
				<th class="list_bg"  width="10%">系统用户</th>
				<th class="list_bg"  width="10%">来源地址</th>
				<th class="list_bg"  width="10%">目标地址</th>
				<th class="list_bg"  width="10%">开始时间</th>
				<th class="list_bg"  width="10%">操作</th>
					</tr>
					{{section name=t loop=$vncrun}}
					<tr {{if $vncrun[t].dangerous > 1}}bgcolor="red"{{elseif $vncrun[t].dangerous > 0}}bgcolor="yellow" {{elseif $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'{{if $vncrun[t].dangerous > 1}}red{{elseif $vncrun[t].dangerous > 0}}yellow{{elseif $smarty.section.t.index % 2 == 0}}f7f7f7{{/if}}');">

					<td>{{$vncrun[t].luser}}</td>
					<td>{{$vncrun[t].realname}}</td>
					<td>{{$vncrun[t].user}}</td>
					<td>{{$vncrun[t].cli_addr}}</td>					
					<td>{{$vncrun[t].addr}}</td>					
					<td>{{$vncrun[t].start}}</td>
					<td><img src="{{$template_root}}/images/disconnect.png" width="16" height="16" align="absmiddle">
					<a href="admin.php?controller=admin_vncrun&action=cutoff&sid={{$vncrun[t]['sid']}}" >断开</a> | <img src="{{$template_root}}/images/036.gif" width="16" height="16" align="absmiddle"><a id="p_vnc_{{$vncrun[t]['sid']}}" onclick="return go('admin.php?controller=admin_vncrun&mstsc=1&sid={{$vncrun[t]['sid']}}','p_vnc_{{$vncrun[t]['sid']}}')" href="#" target="hide">监控</a></td>
					</tr>
					{{/section}}
					<tr>
				<td colspan="7" align="right">
					共{{$vncrunsession_num}}条  {{$vncrunpage_list}}  页次：{{$vncruncurr_page}}/{{$vncruntotal_page}}页  {{$vncrunitems_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&item=4&page='+this.value;">页
				</td>
			</tr>
					</TBODY></TABLE>
                </DIV></DIV>
                <DIV class="content1" id="content5" style="display: none;">
            <DIV class="contentMain1">
             <TABLE width="100%" class="BBtable" bgcolor="#ffffff" border="0" 
            cellspacing="1" cellpadding="5" align="center" >
              <TBODY>
              <tr>
						<th class="list_bg"   width="7%">来源地址</th>
						<th class="list_bg"   width="10%">设备地址</th>
						
						<th class="list_bg"   width="7%">堡垒</th>
						<th class="list_bg"   width="7%">真实姓名</th>
						<th class="list_bg"   width="7%">本地</th>
						<th class="list_bg"   width="9%">开始时间</th>
						<th class="list_bg"   width="9%">结束时间</th>
						<th class="list_bg"   width="5%">流量(K)</th>
						<th class="list_bg"  width="10%">操作</th>
					</tr>
					{{section name=t loop=$apppubrun}}
					<tr {{if $apppubrun[t].dangerous > 1}}bgcolor="red"{{elseif $apppubrun[t].dangerous > 0}}bgcolor="yellow" {{elseif $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}  onmouseover="changeStyle(this,'o');" onmouseout="changeStyle(this,'{{if $apppubrun[t].dangerous > 1}}red{{elseif $apppubrun[t].dangerous > 0}}yellow{{elseif $smarty.section.t.index % 2 == 0}}f7f7f7{{/if}}');">

										<td><a href="admin.php?controller=admin_apppubrun&cli_addr={{$apppubrun[t].cli_addr}}">{{$apppubrun[t].cli_addr}}</a></td>
					
					<td><a href="admin.php?controller=admin_apppubrun&addr={{$apppubrun[t].addr}}">{{$apppubrun[t].addr}}</a></td>
					
					<td><a href="admin.php?controller=admin_apppubrun&luser={{$apppubrun[t].luser}}">{{$apppubrun[t].luser}}</a></td>
					
					<td><a href="admin.php?controller=admin_apppubrun&realname={{$apppubrun[t].realname|urlencode}}">{{$apppubrun[t].realname}}</a></td>
					<td><a href="admin.php?controller=admin_apppubrun&user={{$apppubrun[t].user}}">{{$apppubrun[t].user}}</a></td>
					<td>{{$apppubrun[t].start}}</ td>
					<td>{{$apppubrun[t].end}}</td>
					<td>{{if $apppubrun[t].filesize ge 1000}} {{$apppubrun[t].filesize/1000|string_format:'%.1f'}}{{else}}{{$apppubrun[t].filesize/1000}}{{/if}}</td>
					<td><img src="{{$template_root}}/images/disconnect.png" width="16" height="16" align="absmiddle">
					<a href="admin.php?controller=admin_vncrun&action=cutoff&sid={{$apppubrun[t]['sid']}}" >断开</a> | <img src="{{$template_root}}/images/036.gif" width="16" height="16" align="absmiddle"><a id="p_apppub_{{$vncrun[t]['sid']}}" onclick="return go('admin.php?controller=admin_vncrun&mstsc=1&sid={{$apppubrun[t]['sid']}}','p_apppub_{{$apppubrun[t]['sid']}}')" href="#" target="hide">监控</a>
					</td>
					</tr>
					{{/section}}
					<tr>
				<td colspan="7" align="right">
					共{{$apppubrunsession_num}}条  {{$apppubrunpage_list}}  页次：{{$apppubruncurr_page}}/{{$apppubruntotal_page}}页  {{$apppubrunitems_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&item=5&page='+this.value;">页
				</td>
			</tr>
					</TBODY></TABLE>
                </DIV></DIV>
                
              <DIV class="content1" id="content6" style="display: none;">
                          <DIV class="contentMain1">
               <TABLE width="100%" class="BBtable" bgcolor="#ffffff" border="0" 
            cellspacing="1" cellpadding="5" align="center" >
              <TBODY>
              <tr>
                            <td align="center" valign="middle"  bgcolor="f7f7f7" class="list_bg"><font size="-1"><b>在线用户名 </b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7" class="list_bg"><font size="-1"><b>等级 </b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7" class="list_bg"><font size="-1"><b>登录时间</b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7" class="list_bg"><font size="-1"><b>最近活动时间</b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7" class="list_bg"><font size="-1"><b>来访IP </b></font></td>
                          </tr>
                        {{section name=u loop=$onlineusers}}
                          <tr {{if $smarty.section.u.index % 2 == 0}}bgcolor="f7f7f7"{{/if}} >
                            <td align="center" valign="middle" style="height:40px;"><font size="-1">{{$onlineusers[u].username}}</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1">{{$onlineusers[u].levelstr}}</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1">{{$onlineusers[u].logindate}}</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1">{{$onlineusers[u].lastactime}}</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1">{{$onlineusers[u].ip}}</font></td>
                          </tr>
                        {{/section}}
						<tr>
				<td colspan="7" align="right">
					共{{$command_num}}条  {{$page_list}}  页次：{{$curr_page}}/{{$total_page}}页  {{$items_per_page}}条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_status&action=latest&page='+this.value;">页
				</td>
			</tr>
               </TBODY></TABLE>
                
                
                </DIV></DIV>
                </DIV>
                
                
                                </DIV>
                                  </td></tr>
</table><select  class="wbk"  id="app_act" style="display:none"><option value="applet" {{if $smarty.session.ADMIN_DEFAULT_CONTROL eq 'applet'}}selected{{/if}}>applet</option><option value="activeX" {{if $smarty.session.ADMIN_DEFAULT_CONTROL eq 'activeX'}}selected{{/if}}>activeX</option></select>
<script language="javascript">
function go(url,iid){
	var app_act = document.getElementById('app_act').options[document.getElementById('app_act').options.selectedIndex].value;
	var hid = document.getElementById('hide');
	//document.getElementById(iid).href=url+'&app_act='+app_act;
	url+'&app_act='+app_act;
	$.get(url, {Action:"get",Name:"lulu"}, function (data, textStatus){
		this; // 在这里this指向的是Ajax请求的选项配置信息，请参考下图
		if(data.substring(0,10)=='freesvr://'){
			launcher(data);
		}else{
			eval(data);
		}
	});
	//alert(hid.src);
	{{if $logindebug}}
	window.open(document.getElementById(iid).href);
	{{/if}}
	return true;	
}
	{{if $member.default_control eq 0}}
	if(navigator.userAgent.indexOf("MSIE")>0) {
	    document.getElementById('app_act').options.selectedIndex = 1;
	}
	{{elseif $member.default_control eq 1}}
	document.getElementById('app_act').options.selectedIndex = 0;
	{{elseif $member.default_control eq 2}}
	document.getElementById('app_act').options.selectedIndex = 1;
	{{/if}}
</script>
<script>
change_option(6,{{if $smarty.get.item}}{{$smarty.get.item}}{{else}}1{{/if}});
</script>
<iframe id="hide" name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</BODY></HTML>
