<?php /* Smarty version 2.6.18, created on 2014-07-03 13:56:55
         compiled from status_latest.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
<script src="./template/admin/cssjs/highcharts.js"></script>
<script src="./template/admin/cssjs/exporting.js"></script>
<script language="JavaScript">
var chart;
	/*$(document).ready(function() {

		var cpu = <?php echo $this->_tpl_vars['latest'][0]['cpu']; ?>
;
		var memory = <?php echo $this->_tpl_vars['latest'][0]['memory']; ?>
;
		var disk = <?php echo $this->_tpl_vars['latest'][0]['disk']; ?>
;
		var swap = <?php echo $this->_tpl_vars['latest'][0]['swap']; ?>
;
		
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
	mesW.innerHTML="<div><img id=\"1d\" src='monitor/<?php echo $this->_tpl_vars['template_root']; ?>
/images/1d.gif' onClick=\"reloadimg();\" style=\"cursor:hand;\" alt=\"最近1天\">&nbsp; <img id=\"7d\" src='monitor/<?php echo $this->_tpl_vars['template_root']; ?>
/images/7d.gif' onClick=\"reloadimg('week');\" style=\"cursor:hand;\" alt=\"最近7天\">&nbsp; <img id=\"30d\" src='monitor/<?php echo $this->_tpl_vars['template_root']; ?>
/images/30d.gif' onClick=\"reloadimg('month');\" style=\"cursor:hand;\" alt=\"最近30天\">&nbsp; <img id=\"365d\" src='monitor/<?php echo $this->_tpl_vars['template_root']; ?>
/images/365d.gif' onClick=\"reloadimg('year');\" style=\"cursor:hand;\" alt=\"最近365天\">&nbsp;&nbsp;<div onclick='closeWindow();'><div class='mesWindowContent' id='mesWindowContent'><img id='zoomGraphImage'  src='monitor/admin.php?controller=admin_monitor&action=status_image&type=localstatus&id="+id+"&"+parseInt(10000*Math.random())+"' border=0 ></div><div class='mesWindowBottom'></div></div></div>";
	//styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";//鼠标点击位置
	styleStr="left:"+(bWidth-wWidth)/2+"px;top:"+(bHeight-wHeight)/2+"px;position:absolute;width:"+wWidth+"px;";
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
	//window.parent.document.getElementById("frame_content").height=pos.y+1000;
	//window.parent.parent.document.getElementById("main").height=bHeight+1000;	
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
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=serverstatus">服务状态</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_status&action=latest">系统状态</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup">配置备份</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting">数据同步</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=upgrade">软件升级</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
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
                    <td height="25">启动时间</td>
                    <td><?php echo $this->_tpl_vars['uptime']; ?>
</td>
                  </tr>
                  <tr>
                    <td height="25">主机IP</td>
                    <td><?php echo $this->_tpl_vars['host_ip']; ?>
</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">软件版本</td>
                    <td><?php echo $this->_tpl_vars['version']; ?>
</td>
                  </tr>
                  <tr>
                    <td height="25">许可协议/到期时间</td>
                    <td><?php echo $this->_tpl_vars['licenses']['1']; ?>
/<?php echo $this->_tpl_vars['licenses']['0']; ?>
</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">SSH连接并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['ssh_conn_a']; ?>
</td>
                  </tr>
                  <tr>
                    <td height="25">Telnet连接并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['telnet_conn_a']; ?>
</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">图形会话并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['graph_conn_a']; ?>
</td>
                  </tr>
                  <tr>
                    <td height="25">FTP会话并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['ftp_conn_a']; ?>
</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">数据库并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['db_conn_a']; ?>
</td>
                  </tr>
				  <tr bgcolor="#f7f7f7">
                    <td height="25">MySQL并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['mysql_conn_a']; ?>
</td>
                  </tr>
				  <tr bgcolor="#f7f7f7">
                    <td height="25">HTTP并发</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['http_conn_a']; ?>
</td>
                  </tr>
                  <tr>
                    <td height="25">设备总数</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['serverct']; ?>
</td>
                  </tr>
                  <tr bgcolor="#f7f7f7">
                    <td height="25">主账号数</td>
                    <td><a href="#" onclick="loadurl('admin.php?controller=admin_member&action=showUsersByLevel');return false;" ><?php echo $this->_tpl_vars['latest'][0]['memberct']; ?>
</a></td>
                  </tr>
                  <tr>
                    <td height="25">从账号数</td>
                    <td><?php echo $this->_tpl_vars['latest'][0]['devpassct']; ?>
</td>
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
          <TD>         <p><img style="cursor:hand;" onclick="showImg('cpu利用率',event,'<?php echo $this->_tpl_vars['latest'][0]['cpu_seq']; ?>
');return false;" src="include/pChart/graphgenerate2.php?data[]=<?php echo $this->_tpl_vars['cpu']['used']; ?>
&data[]=<?php echo $this->_tpl_vars['cpu']['unused']; ?>
&<?php echo $this->_tpl_vars['info']; ?>
&graphtype=pie"></p>
            </TD>
          <TD><img style="cursor:hand;" onclick="showImg('硬盘利用率',event,'<?php echo $this->_tpl_vars['latest'][0]['disk_seq']; ?>
');return false;" src="include/pChart/graphgenerate2.php?data[]=<?php echo $this->_tpl_vars['disk']['used']; ?>
&data[]=<?php echo $this->_tpl_vars['disk']['unused']; ?>
&<?php echo $this->_tpl_vars['info']; ?>
&graphtype=pie"></TD>
           </TR>
        <TR>
          <TH class=list_bg>内存利用率</TH>
          <TH class=list_bg>SWAP利用率</TH>
           </TR>
        <TR align="center" bgColor=#FFFFFF>
          <TD><img style="cursor:hand;" onclick="showImg('内存利用率',event,'<?php echo $this->_tpl_vars['latest'][0]['memory_seq']; ?>
');return false;" src="include/pChart/graphgenerate2.php?data[]=<?php echo $this->_tpl_vars['memory']['used']; ?>
&data[]=<?php echo $this->_tpl_vars['memory']['unused']; ?>
&<?php echo $this->_tpl_vars['info']; ?>
&graphtype=pie">        </TD>
          <TD><img style="cursor:hand;" onclick="showImg('SWAP利用率',event,'<?php echo $this->_tpl_vars['latest'][0]['swap_seq']; ?>
');return false;" src="include/pChart/graphgenerate2.php?data[]=<?php echo $this->_tpl_vars['swap']['used']; ?>
&data[]=<?php echo $this->_tpl_vars['swap']['unused']; ?>
&<?php echo $this->_tpl_vars['info']; ?>
&graphtype=pie"></TD>
         </TR>
      </TBODY>
    </TABLE></td>
  </tr>
 <tr><td colspan="2">
                <TABLE cellSpacing=0 cellPadding=0 width="100%">
                <TR bgColor=#f7f7f7>
                                      <TH class=list_bg ><A href="#">在线用户</A></TH>
                                    </TR>
                <tr><td><TABLE cellSpacing=3 cellPadding=0 width="100%" style="border:#7cb9f2 1px solid;"><tr>
                            <td align="center" valign="middle"  bgcolor="f7f7f7"><font size="-1"><b>在线用户名 </b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7"><font size="-1"><b>等级 </b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7"><font size="-1"><b>登录时间</b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7"><font size="-1"><b>最近活动时间</b></font></td>
                            <td align="center" valign="middle"  bgcolor="f7f7f7"><font size="-1"><b>来访IP </b></font></td>
                          </tr>
                        <?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['onlineusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
                          <tr <?php if ($this->_sections['u']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?> >
                            <td align="center" valign="middle" style="height:40px;"><font size="-1"><?php echo $this->_tpl_vars['onlineusers'][$this->_sections['u']['index']]['username']; ?>
</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1"><?php echo $this->_tpl_vars['onlineusers'][$this->_sections['u']['index']]['levelstr']; ?>
</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1"><?php echo $this->_tpl_vars['onlineusers'][$this->_sections['u']['index']]['logindate']; ?>
</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1"><?php echo $this->_tpl_vars['onlineusers'][$this->_sections['u']['index']]['lastactime']; ?>
</font></td>
                            <td align="center" valign="middle" style="height:40px;"><font size="-1"><?php echo $this->_tpl_vars['onlineusers'][$this->_sections['u']['index']]['ip']; ?>
</font></td>
                          </tr>
                        <?php endfor; endif; ?>
                </table></td></tr></table>
                </td></tr>
</table>
</BODY></HTML>