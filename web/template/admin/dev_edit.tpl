<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>{{$title}}</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="{{$template_root}}/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<script src="./template/admin/cssjs/global.functions.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
</head>

<body>
<script>

{{if $_config.LDAP}}
var foundparent = false;
var servergroup = new Array();
var i=0;
{{section name=a loop=$allsgroup}}
servergroup[i++]={id:{{$allsgroup[a].id}},name:'{{$allsgroup[a].groupname}}',ldapid:{{$allsgroup[a].ldapid}},level:{{$allsgroup[a].level}}};
{{/section}}

{{/if}}

function change_option(number,index){
 for (var i = 0; i <= number; i++) {
      document.getElementById('current' + i).className = '';
      document.getElementById('content' + i).style.display = 'none';
 }
  document.getElementById('current' + index).className = 'current';
  document.getElementById('content' + index).style.display = 'block';
  if(index==1 || index==2 || index==3){
	document.getElementById('finalsubmit').style.display = 'block';
  }else{
	document.getElementById('finalsubmit').style.display = 'none';
  }
  return false;
}
</script>
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
{{if $smarty.session.ADMIN_LEVEL eq 10}}
<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordedit">修改密码</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=password_cron">定时任务</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_backup&action=backup_setting_forpassword">自动备份</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=passdown">密码文件下载</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordcheck">密码校验</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
{{elseif $smarty.session.ADMIN_LEVEL eq 10 or $smarty.session.ADMIN_LEVEL eq 101}}
<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=main">密码查看</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
{{else}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">用户管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{if $from eq 'dir'}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{else}}
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备管理</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	{{/if}}
	{{if $from eq 'dir'}}
	<li class="me_a"><img src="{{$template_root}}/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">目录管理</a><img src="{{$template_root}}/images/an3.jpg" align="absmiddle"/></li>
	{{else}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">目录管理</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{/if}}
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=workdept">用户属性</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS用户</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=passwordkey">密码密钥</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{if $smarty.session.ADMIN_LEVEL eq 1}}
    <li class="me_b"><img src="{{$template_root}}/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="{{$template_root}}/images/an33.jpg" align="absmiddle"/></li>
	{{/if}}
{{/if}}
</ul><span class="back_img"><A href="admin.php?controller={{if $smarty.session.ADMIN_LEVEL eq 10 or $smarty.session.ADMIN_LEVEL eq 101}}admin_index&action=main{{else}}{{if $smarty.get.appconfigedit}}admin_pro&action=dev_edit&id={{$id}}&gid={{$gid}}&apptable=1{{else}}admin_pro&action=dev_index&gid={{$gid}}{{/if}}{{/if}}&back=1"><IMG src="{{$template_root}}/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>

   
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_pro&action=dev_save&id={{$id}}&appconfigedit={{$appconfigedit}}&appconfigid={{$appconfig1.seq}}&gid={{$gid}}">
			 <DIV style="WIDTH:100%" id=navbar>
 {{if !$appconfigedit}}
				 <div id="content1" class="content">
				   <div class="contentMain">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<TR>
      <TD height="27" colspan="4" class="tb_t_bg">基本信息</TD>
    </TR>
	{{assign var="trnumber" value=0}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		主机名		
		</td>
		<td width="35%">
		<input type=text name="hostname" size=35 value="{{$hostname}}" >
	  </td>
	  <td width="15%" align=right>
			系统类型  </td>
		<td width="35%"><select  class="wbk"  name="type_id">
		{{section name=g loop=$alltype}}
			<OPTION VALUE="{{$alltype[g].id}}" {{if $alltype[g].id == $type_id}}selected{{/if}}>{{$alltype[g].device_type}}</option>
		{{/section}}
		</select>
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		IPv4地址
		</td>
		<td width="35%">
		<input type=text name="IP" size=35 value="{{$IP}}" {{if $id}}readonly{{/if}}>
	  </td>
	  <td width="15%" align=right>
			IPv6 </td>
		<td width="35%"><input type=text name="ipv6" size=35 value="{{$ipv6}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	  <td width="15%" align=right>
		设备组
		</td>
		<td width="35%" colspan="3">
		{{include file="select_sgroup.tpl" }} 
			
		</td>
	</tr>

	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		超级管理员口令:	
		</td>
		<td width="35%">
				<input type="password" size=35 name="superpassword" value="{{$superpassword}}"/>
	  </td>
	  <td width="15%" align=right>
		再输一次口令:	
		</td>
		<td width="35%">
				<input type="password" size=35 name="superpassword2" value="{{$superpassword}}"/>
	  </td>

	</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		修改方式	
		</td>
		<td width="35%">
		<input type='radio' name="stra_type" value='mon' {{if $method == 'mon' || $method ==''}}checked{{/if}}>
		按月
		<input type='radio' name="stra_type" value='week' {{if $method == 'week'}}checked{{/if}}>
		每周
		<input type='radio' name="stra_type" value='custom'{{if $method == 'user'}}checked{{/if}}>
		自定义
	  </td>
	  <td width="15%" align=right>
		频率
		</td>
		<td width="35%">
		<input type=text name="freq" size=35 value="{{if $freq}}{{$freq}}{{else}}1{{/if}}" >**
		</td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td colspan='4'>
		**频率的说明：如果修改方式选择每周，这里填写周几（1—7）,如果是按月，填写几号（1—31）,如果是自定义，这里是几日更新一次（大于0的整数）
		</td>
	</tr>
	
{{if $smarty.session.ADMIN_LEVEL eq 1 or $smarty.session.ADMIN_LEVEL eq 3 or $smarty.session.ADMIN_LEVEL eq 21 or $smarty.session.ADMIN_LEVEL eq 101}}
	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		SSH默认端口	
		</td>
		<td width="35%">
		<input type=text name="sshport" size=35 value="{{if $id }}{{$sshport}}{{else}}22{{/if}}" >
	  </td>
	  <td width="15%" align=right>
		TELNET默认端口	
		</td>
		<td width="35%">
		<input type=text name="telnetport" size=35 value="{{if $id }}{{$telnetport}}{{else}}23{{/if}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		FTP默认端口
		</td>
		<td width="35%">
		<input type=text name="ftpport" size=35 value="{{if $id }}{{$ftpport}}{{else}}21{{/if}}" >
	  </td>
	  <td width="15%" align=right>
		RDP默认端口
		</td>
		<td width="35%">
		<input type=text name="rdpport" size=35 value="{{if $id }}{{$rdpport}}{{else}}3389{{/if}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		VNC默认端口	
		</td>
		<td width="35%">
		<input type=text name="vncport" size=35 value="{{if $id }}{{$vncport}}{{else}}5900{{/if}}" >
	  </td>
	  <td width="15%" align=right>
		X11默认端口	
		</td>
		<td width="35%">
		<input type=text name="x11port" size=35 value="{{if $id }}{{$x11port}}{{else}}3389{{/if}}" >
	  </td>
	</tr>
{{else}}
<input type="hidden" name="transport" value="{{$transport}}" >
<input type="hidden" name="sshport" value="{{if $id }}{{$sshport}}{{else}}22{{/if}}" >
<input type="hidden" name="telnetport" value="{{if $id }}{{$telnetport}}{{else}}23{{/if}}" >
<input type="hidden" name="ftpport" value="{{if $id }}{{$ftpport}}{{else}}21{{/if}}" >
<input type="hidden" name="rdpport" value="{{if $id }}{{$rdpport}}{{else}}3389{{/if}}" >
<input type="hidden" name="vncport" value="{{if $id }}{{$vncport}}{{else}}3389{{/if}}" >
<input type="hidden" name="x11port" value="{{if $id }}{{$x11port}}{{else}}3389{{/if}}" >
	{{/if}}
	</table> </div>
				 </div>
				 <div id="content2" class="content" >
				   <div class="contentMain">
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				   <TR>
      <TD height="27" colspan="4" class="tb_t_bg">扩展信息</TD>
    </TR>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		固定资产名称	
		</td>
		<td width="35%">
		<input type=text name="asset_name" size=35 value="{{$asset_name}}" >
	  </td>
	  <td width="15%" align=right>
		规格型号	
		</td>
		<td width="35%">
		<input type=text name="asset_specification" size=35 value="{{$asset_specification}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		部门名称	
		</td>
		<td width="35%">
		<input type=text name="asset_department" size=35 value="{{$asset_department}}" >
	  </td>
	  <td width="15%" align=right>
		存放地点	
		</td>
		<td width="35%">
		<input type=text name="asset_location" size=35 value="{{$asset_location}}" >
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		支持厂商	
		</td>
		<td width="35%">
		<input type=text name="asset_company" size=35 value="{{$asset_company}}" >
	  </td>
	  <td width="15%" align=right>
		开始使用日期	
		</td>
		<td width="35%">
		<input type=text name="asset_start" id="asset_start" size=35 value="{{$asset_start}}" >&nbsp;&nbsp;<input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk"> 

	  </td>
	</tr>	
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		使用年限	
		</td>
		<td width="35%">
		<input type=text name="asset_usedtime" size=35 value="{{$asset_usedtime}}" >
	  </td>
	  <td width="15%" align=right>
		保修日期	
		</td>
		<td width="35%">
		<input type=text name="asset_warrantdate" id="asset_warrantdate" size=35 value="{{$asset_warrantdate}}" >&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk"> 
	  </td>
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		<td width="15%" align=right>
		使用状况	
		</td>
		<td width="35%">
		<input type=text name="asset_status" size=35 value="{{$asset_status}}" >
	  </td>
	  <td width="15%" align=right>
		</td>
		<td width="35%">
	  </td>
	</tr>
</table>
 </div>
</div>
{{if $caction}}
 <div id="content3" class="content" >
				   <div class="contentMain">
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				   <TR>
      <TD height="27" colspan="4" class="tb_t_bg">系统监控</TD>
    </TR>
	{{assign var="trnumber" value=$trnumber+1}}
	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
		<td width="15%" align=right>
		巡检模式	
		</td>
		
		<td width="35%">
		<select  class="wbk"  name="monitor">		
			<OPTION VALUE="0" {{if $monitor == 0}}selected{{/if}}>关闭</option>
			<OPTION VALUE="1" {{if $monitor == 1}}selected{{/if}}>SNMP</option>
			<OPTION VALUE="2" {{if $monitor == 2}}selected{{/if}}>登录</option>
		<OPTION VALUE="3" {{if $monitor == 3}}selected{{/if}}>上传</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;端口监控:<input type=checkbox name="snmpnet" {{if $snmpnet }}checked{{/if}} size=35 value="1" >
		</td>
		<td width="15%" align=right>
		SNMP字符串	
		</td>
		
	<td width="35%">
		<input type=text name="snmpkey" size=35 value="{{$snmpkey}}" >
	  </td>
		</tr>
	
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>		
	<td width="15%" align=right>
		监控端口	
		</td>
		
	<td width="35%">
		<input type=text name="port_monitor" size=35 value="{{$port_monitor}}" >
	  </td>	
	  <td width="15%" align=right>
		端口监控阀值	
		</td>
		
	<td width="35%">
		<input type=text name="port_monitor_time" size=35 value="{{$port_monitor_time}}" >
	  </td>
</table>
 </div>
				 </div>
{{/if}}
{{/if}}
{{if $caction}}
		{{if !$appconfigedit}}
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<TR>
				<TD height="27" colspan="8" class="tb_t_bg"><img src="template/admin/cssjs/img/nolines_plus.gif" onclick="opentable('apptable');" id="apptable_img" align="middle" />应用监控</TD>
			</TR>
		</table>
		<table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable" id="apptable" style="display:none;">
				  <tr>
				    <th class="list_bg" >说明</th>	
                    <th class="list_bg" >应用名称</th>	
                    <th class="list_bg" >用户名</th>
					<th class="list_bg" >是否监控</th>
					<th class="list_bg" >操作</TD>
                  </TR>

            </tr>
			{{section name=t loop=$appconfig}}
			<tr  {{if $smarty.section.t.index % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
				<td>{{$appconfig[t].desc}}</td>
				<td><span  title="{{$appconfig[t].app_name}}" >{{$appconfig[t].app_name}}</span></td>	
				<td>{{$appconfig[t].username}}</td>
				<td>{{if $appconfig[t].enable eq 1}}是{{else}}否{{/if}}</td>
				<td><img src='{{$template_root}}/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=dev_edit&id={{$id}}&tab=4&appconfigedit=1&appconfigid={{$appconfig[t].seq}}'>修改</a> | <img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('您确定要删除？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=app_config_del&id={{$appconfig[t].seq}}&devid={{$id}}';}">删除</a></td>
			</tr>
			{{/section}}
			<tr >
				<td colspan="8" > <input type="button" value="添加" onClick="location.href='admin.php?controller=admin_pro&action=dev_edit&id={{$id}}&gid={{$gid}}&tab=4&appconfigedit=1'" class="an_02"></td>
			</tr>
		</table>
		{{else}}
				   <table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
				     <TR>
      <TD height="27" colspan="8" class="tb_t_bg">应用监控</TD>
    </TR>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>		
	<td width="15%" align=right>
		说明	
		</td>
		
	<td width="35%">
		<input type=text name="desc" size=35 value="{{$appconfig1.desc}}" >
	  </td>
	
	</tr>

	{{assign var="trnumber" value=$trnumber+1}}
	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
		<td width="15%" align=right>
		应用名称	
		</td>
		
		<td width="35%">
		<select  class="wbk"  name="app_name" onchange="changeapp(this.value);">		
			<OPTION VALUE="mysql" {{if $appconfig1.app_name == 'mysql'}}selected{{/if}}>mysql</option>
			<OPTION VALUE="apache" {{if $appconfig1.app_name == 'apache'}}selected{{/if}}>apache</option>
			<OPTION VALUE="tomcat" {{if $appconfig1.app_name == 'tomcat'}}selected{{/if}}>tomcat</option>
			<OPTION VALUE="nginx" {{if $appconfig1.app_name == 'nginx'}}selected{{/if}}>nginx</option>
			<OPTION VALUE="dns" {{if $appconfig1.app_name == 'dns'}}selected{{/if}}>DNS</option>
</select>
		</td></tr>
	
	
	
	{{assign var="trnumber" value=$trnumber+1}}
	
	<tr id="apache_type" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">系统占用&nbsp;&nbsp;&nbsp;&nbsp;请求速率&nbsp;&nbsp;&nbsp;&nbsp;流量
	  </td>
	
	</tr>
	<tr id="mysql_type" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">查询速率&nbsp;&nbsp;&nbsp;&nbsp;打开表数&nbsp;&nbsp;&nbsp;&nbsp;打开文件&nbsp;&nbsp;&nbsp;&nbsp;连接数
	  </td>
	
	</tr>
	<tr id="tomcat_type" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">每秒流量(KB/s)&nbsp;&nbsp;&nbsp;&nbsp;CPU平均占用率(%)&nbsp;&nbsp;&nbsp;&nbsp;每秒请求数量&nbsp;&nbsp;&nbsp;&nbsp;当前jvm内存使用率&nbsp;&nbsp;&nbsp;&nbsp;当前工作线程数
	  </td>
	
	</tr>
	<tr id="nginx_type" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">nginx 请求率(点击率)&nbsp;&nbsp;&nbsp;&nbsp;nginx连接数(并发数)
	  </td>
	
	</tr>
	<tr id="dns_type" {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>
		
	<td width="15%" align=right>
		参数类型	
		</td>
		
	<td width="35%">授权域可用性(ms)&nbsp;&nbsp;&nbsp;&nbsp;非授权域可用性(ms)
	  </td>
	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="app_username">		
	<td width="15%" align=right>
		用户名	
		</td>
		
	<td width="35%">
		<input type=text name="username" size=35 value="{{$appconfig1.username}}" >
	  </td>	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="app_userpwd">		
	<td width="15%" align=right>
		密码	
		</td>
		
	<td width="35%">
		<input type=password name="password" size=35 value="{{$appconfig1.password}}" >
	  </td>
	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="app_userrepwd">		
	<td width="15%" align=right>
		重复密码	
		</td>
		
	<td width="35%">
		<input type=password name="repassword" size=35 value="{{$appconfig1.password}}" >
	  </td>
	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="app_enable">		
	<td width="15%" align=right>
		是否启用
		</td>
		
	<td width="35%">
		<input type=checkbox name="enable" value="1" {{if $appconfig1.enable}}checked{{/if}} >
	  </td>
	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}} id="app_port">		
	<td width="15%" align=right>
		应用端口	
		</td>
		
	<td width="35%">
		<input type=text name="appport" size=35 value="{{$appconfig1.port}}" >
	  </td>	
	</tr>
	{{assign var="trnumber" value=$trnumber+1}}	
	<tr {{if $trnumber % 2 == 0}}bgcolor="f7f7f7"{{/if}}>		
	<td colspan="2" align=center>
		
		<input type=submit  value="保存修改" class="an_02">
	  </td>
	
	</tr>

</table>
<input type="hidden" name="doappconfigedit" value="1" />
<script>
function changeapp(name){
	document.getElementById('apache_type').style.display='none';
	document.getElementById('mysql_type').style.display='none';
	document.getElementById('tomcat_type').style.display='none';
	document.getElementById('nginx_type').style.display='none';
	document.getElementById('dns_type').style.display='none';
	document.getElementById(name+'_type').style.display='';
	if(name=='dns'){
		document.getElementById('app_username').style.display='none';
		document.getElementById('app_userpwd').style.display='none';
		document.getElementById('app_userrepwd').style.display='none';
		document.getElementById('app_enable').style.display='none';
		document.getElementById('app_port').style.display='none';
	}else{
		document.getElementById('app_username').style.display='';
		document.getElementById('app_userpwd').style.display='';
		document.getElementById('app_userrepwd').style.display='';
		document.getElementById('app_enable').style.display='';
		document.getElementById('app_port').style.display='';
	}
}
changeapp('{{$appconfig1.app_name}}');
</script>
{{/if}}{{/if}}
 {{if !$appconfigedit}}
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
				  <TR>
					  <TD height="27" colspan="8" class="tb_t_bg"><img src="template/admin/cssjs/img/nolines_plus.gif" onclick="opentable('accounttable');" id="accounttable_img" align="middle" />账号信息</TD>
				  </TR>
				  </table>
				  <table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable" id="accounttable" style="display:none;">
				  <form name="member_list" action="admin.php?controller=admin_pro&action=accountlinux2devices&serverid={{$id}}" method="post" >
		   
                  <TR>
					<th class="list_bg" >选</TD>
                    <th class="list_bg" >{{$language.HostName}}</TD>
                    <th class="list_bg" >IP</TD>
                    <th class="list_bg" >用户名</TD>
					<th class="list_bg" >同步时间</TD>
                    <th class="list_bg" >ID号</TD>
                    <th class="list_bg" >Shell</TD>
					<th class="list_bg" >{{$language.Operate}}</TD>
                  </TR>

            </tr>
			{{section name=t loop=$alldev}}
			<tr {{if !$alldev[t].radiususer_is_in_member and $alldev[t].radiususer}}bgcolor='red'{{/if}}>
				<td><input type="checkbox" name="chk_member[]" value="{{$alldev[t].id}}"></td>
				<td>{{$server.hostname}}</td>
				<td>{{$alldev[t].ip}}</td>
				<td>{{$alldev[t].user}}</td>
				<td>{{$alldev[t].date}}</td>				
				<td>{{$alldev[t].uid}}</td>
				<td>{{$alldev[t].shell}}</td>
				<td>
				{{if $smarty.session.ADMIN_LEVEL eq 1 or $smarty.session.ADMIN_LEVEL eq 3 or $smarty.session.ADMIN_LEVEL eq 4}}
				<!--<img src='{{$template_root}}/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_pro&action=pass_edit&ip={{$alldev[t].ip}}&serverid={{$serverid}}&user={{$alldev[t].user}}&accountlinux=1'>绑定</a>-->

				<img src='{{$template_root}}/images/delete_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="#" onClick="if(!confirm('{{$language.Delete_sure_}}？')) {return false;} else { location.href='admin.php?controller=admin_pro&action=accountlinux_del&id={{$alldev[t].id}}';}">{{$language.Delete}}</a>
				{{/if}}
				</td> 
			</tr>
			{{/section}}
			<tr>
	           <td  colspan="4" align="left">
				<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="加入到从账号" onclick="my_confirm('确定加入从账号?');document.f1.elements.action='admin.php?controller=admin_pro&action=accountlinux2devices&serverid={{$id}}'; return true;" class="an_06">&nbsp;&nbsp;<input type="button"  value="同步" onClick="location.href='admin.php?controller=admin_pro&action=accountlinux_listacct&ip={{$server.device_ip}}&id={{$id}}'"  class="an_02">&nbsp;&nbsp;<input type="button"  value="创建" onClick="window.open ('admin.php?controller=admin_pro&action=accountlinux_edit&ip={{$server.device_ip}}&id={{$id}}', 'newwindow', 'height=230, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');" class="an_02">
		   </td>
              
	           <td  colspan="4" align="right">
		   			{{$language.all}}{{$total}}{{$language.Recorder}}  {{$page_list}}  {{$language.Page}}：{{$curr_page}}/{{$total_page}}{{$language.page}}  {{$items_per_page}}{{$language.Recorder}}/{{$language.page}}  {{$language.Goto}}<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_pro&action=dev_edit&id={{$id}}&page='+this.value;">{{$language.page}}&nbsp;&nbsp;&nbsp;{{if $smarty.session.ADMIN_LEVEL eq 3}}  导出：<a href="{{$curr_url}}&derive=1" target="hide"><img src="{{$template_root}}/images/excel.png" border=0></a>{{/if}}
		   </td>
		</tr>
</table></div>
	<tr id="finalsubmit"><td align="center">{{if $id and $monitor==1}}{{if !$appconfigedit}}<input type=button {{if !$id}}readonly{{/if}} onclick="admin.php?controller=admin_pro&action=server_detect&ip={{$IP}}"  value="硬件检测" class="an_02">{{/if}}{{/if}}&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit  value="保存修改" class="an_02" onclick="save();return true;"></td></tr></table>

</form>
{{/if}}
	</td>
  </tr>
</table>
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true,
	popupDirection: 'up'
});
cal.manageFields("f_rangeStart_trigger", "asset_start", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "asset_warrantdate", "%Y-%m-%d %H:%M:%S");


</script>
<script language="javascript">
function save(){
	if(document.getElementById('accounttable').style.display!='none'){
		document.f1.elements.action += "&accounttable=1";
	}
	if(document.getElementById('apptable').style.display!='none'){
		document.f1.elements.action += "&apptable=1";
	}
}
function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

{{if $smarty.session.ADMIN_LEVEL eq 3 and $smarty.session.ADMIN_MSERVERGROUP}}
var ug = document.getElementById('servergroup');
for(var i=0; i<ug.options.length; i++){
	if(ug.options[i].value=={{$smarty.session.ADMIN_MSERVERGROUP}}){
		ug.selectedIndex=i;
		ug.onchange = function(){ug.selectedIndex=i;}
		break;
	}
}
{{/if}}

</script>
<script>

function opentable(id){
	if(document.getElementById(id).style.display=='none'){
		document.getElementById(id+"_img").src='template/admin/cssjs/img/nolines_minus.gif'
		document.getElementById(id).style.display=''
	}else{
		document.getElementById(id+"_img").src='template/admin/cssjs/img/nolines_plus.gif'
		document.getElementById(id).style.display='none'
	}
    window.parent.reinitIframe();
}
{{if $smarty.get.accounttable}}
opentable('accounttable');
{{/if}}
{{if $smarty.get.apptable}}
opentable('apptable');
{{/if}}


//change_option({{if $smarty.session.CACTI_CONFIG_ON}}4{{else}}2{{/if}},{{$tab}});
{{if $_config.LDAP}}
{{$changelevelstr}}
{{/if}}

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>



