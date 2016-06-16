<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{$site_title}}</title>
<link href="{{$template_root}}/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/jquery-1.10.2.min.js"></script>
<script >
function showNodeCount0(check){
	var els = document.getElementsByTagName('div');
	for(var i=0; i<els.length; i++){
		if($(els[i]).attr("class")=='dTreeNode'&&$(els[i]).attr("count")==0){
			$(els[i]).css("display",check ? "" : "none");
		}
	}
}

function showLongTitle(check){
	var els = document.getElementsByTagName('a');
	for(var i=0; i<els.length; i++){
		if($(els[i]).attr("class")=='node'){
			if(check){
				$(els[i])[0].innerText = $(els[i]).attr("shorttitle");
			}else{
				$(els[i])[0].innerText = $(els[i]).attr("longtitle");
			}
		}
	}
}
</script>
<body>
<table width="213" height="500" border="0" cellpadding="0" cellspacing="0"  class="zuo_bj" >
      <tr>
        <td height="42" colspan="2" align="center" valign="middle" class="hui_bj"><img src="{{$template_root}}/images/yw_53.jpg" width="16" height="13" align="absmiddle" /> {{$Year}}年{{$Month}}月{{$Day}}日 星期{{$Week}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td width="209" height="606" align="center" valign="top">
			<table width="189" height="117" border="0" cellpadding="0" cellspacing="0" class="sy">
				<tr>
				  <td height="29" colspan="2" align="left">&nbsp;&nbsp;&nbsp;<img src="{{$template_root}}/images/yw_47.jpg" width="22" height="22" align="absmiddle" />&nbsp;<strong class="bd">管理首页</strong></td>
				</tr>
				<tr>
				  <td width="87" align="center" valign="middle"><img src="{{$template_root}}/images/yw_43.jpg" width="67" height="62" /></td>
				  <td width="98" align="left" valign="middle">{{$username}}<br />({{$user.realname}})<br />
					{{if $admin_level == 0}}普通用户{{elseif $admin_level == 1}}管理员{{elseif $admin_level == 3}}部门管理员{{elseif $admin_level == 4}}配置管理员{{elseif $admin_level == 10}}密码管理员{{elseif $admin_level == 21}}部门审计员{{elseif $admin_level == 101}}部门密码员{{/if}}</td>
				</tr>
			</table>
            <br />
            <table width="178"  border="0" cellpadding="0" cellspacing="0" id="audit_menu">

			{{if $admin_level == 0}}
			  <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('password');" class="anniu"><img src="{{$template_root}}/images/1_5.png" width="18" height="21" style="vertical-align:middle"/> 设备管理</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="password" style="display:none" >
				<table width="178"  border="0" cellpadding="0" cellspacing="2">
					
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
					  
<div style=" width:180px; overflow-x:auto;">
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/dtree.js"></script>
<div class="dtree" >
	<script type="text/javascript">
		{{if $user.ldap}}
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';		
		ddev.config['noshorttitle']=false;
		var i=0;
		ddev.add(0,-1,'设备组','admin.php?controller=admin_index&action=main&all=1','','main');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		{{section name=ag loop=$sgroups}}
			{{if $sgroups[ag].count gt 0}}
			ddev.add({{$sgroups[ag].id}},{{if !$sgroups[ag].ldapid}}0{{else}}{{$sgroups[ag].ldapid}}{{/if}},'{{if $sgroups[ag].level eq 1}}{{$sgroups[ag].groupname}}{{elseif $sgroups[ag].level eq 2}}{{$sgroups[ag].groupname}}{{else}}{{$sgroups[ag].groupname}}{{/if}}({{$sgroups[ag].count}})','admin.php?controller=admin_index&action=main&gid={{$sgroups[ag].id}}','{{$sgroups[ag].groupname}}({{$sgroups[ag].count}})','main','template/admin/cssjs/img/servergroup.png','template/admin/cssjs/img/servergroup.png',null,{{$sgroups[ag].count}},'{{$sgroups[ag].groupname}}({{$sgroups[ag].count}})','{{$sgroups[ag].groupname}}({{$sgroups[ag].count}})');
			{{/if}}
		{{/section}}	
		document.write(ddev);		
		ddev.s(0);
		{{else}}
		d = new dTree('d');
		d.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		d.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		d.icon['node'] = 'template/admin/cssjs/img/servergroup.png';
		d.config['noshorttitle']=false;
		//d.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		d.add(0,-1,'设备组','admin.php?controller=admin_index&action=main&all=1','','main');
		//d.add(10000,0,'所有主机','admin.php?controller=admin_index&action=main','','main');
		{{section name=ug loop=$sgroups}}
			{{if $sgroups[ug].count gt 0 and $sgroup[ug].level eq 0}}
			d.add({{$sgroups[ug].id}},0,'{{$sgroups[ug].groupname}}({{$sgroups[ug].count}})','admin.php?controller=admin_index&action=main&gid={{$sgroups[ug].id}}','{{$sgroups[ug].groupname}}({{$sgroups[ug].count}})','main',null,null,null,{{$sgroups[ug].count}},'{{$sgroups[ug].groupname}}({{$sgroups[ug].count}})','{{$sgroups[ug].groupname}}({{$sgroups[ug].count}})');
			{{/if}}
		{{/section}}
		document.write(d);		
		d.s(0);
		{{/if}}
	</script>
</div>
					  </td>
                    </tr> 
					</table></div>
					</td>
					</tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/list_ico18.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=createrdpfile" target="main" id='devlist3' onclick="return jumpto(this)">列表导出</a></td>
                    </tr> 
					{{if $cacti_on&& $netmanageenable}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_monitor&action=index" target="main" id="configure1" onclick="return jumpto(this)">监控信息</a></td>
                    </tr>
					{{/if}}
					{{if $user.allowchange}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/wall_disable.png" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=chpwd" target="main" onclick="return jumpto(this)">密码修改</a></td>
                    </tr> 
					{{/if}}
                </table></td>
              </tr>




			   <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('apppub');" class="anniu"><img src="{{$template_root}}/images/1_2.png" width="18" height="21" style="vertical-align:middle"/> 应用发布</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="apppub" style="display:none" >
				<div style=" width:180px; overflow-x:auto;">
				<table width="178"  border="0" cellpadding="0" cellspacing="2">
		     <tr>
                      <td height="25" align="left" bgcolor="52A1D4">{{$member.apphost}}
<div class="dtree" >
	<script type="text/javascript">
		dapp = new dTree('dapp');
		dapp.icon['folder'] = 'template/admin/cssjs/img/servergroup.png';
		dapp.icon['folderOpen'] = 'template/admin/cssjs/img/servergroup.png';
		dapp.icon['node'] = 'template/admin/cssjs/img/servergroup.png';
		dapp.config['noshorttitle']=false;
		var i=0;
		dapp.add(0,-1,'应用发布','admin.php?controller=admin_index&action=main&logintype=apppub','','main');
		{{if $user.apphost}}
		
		{{section name=ap loop=$appservers}}
			dapp.add({{$smarty.section.ap.index+1}},0,'{{$appservers[ap].hostname}}({{$appservers[ap].count}})','admin.php?controller=admin_index&action=main&logintype=apppub&appserverip={{$appservers[ap].appserverip}}','{{$appservers[ap].hostname}}({{$appservers[ap].count}})','main',null,null,null,1);
			{{section name=apg loop=$appservers[ap].appsgroups}}
				dapp.add({{$smarty.section.ap.index+1}}{{$appservers[ap].appsgroups[apg].id}},{{$smarty.section.ap.index+1}}{{if $appservers[ap].appsgroups[apg].ldapid}}{{$appservers[ap].appsgroups[apg].ldapid}}{{/if}},'{{$appservers[ap].appsgroups[apg].groupname}}({{$appservers[ap].appsgroups[apg].count}})','admin.php?controller=admin_index&action=main&logintype=apppub&appserverip={{$appservers[ap].appserverip}}&gid={{$appservers[ap].appsgroups[apg].id}}','{{$appservers[ap].appsgroups[apg].groupname}}({{$appservers[ap].appsgroups[apg].count}})','main',null,null,null,1);		
			{{/section}}
			{{*{{section name=app loop=$appservers[ap].appname}}
			dapp.add({{$smarty.section.ap.index+1}}{{$smarty.section.app.index+1}},i,'{{$appservers[ap].appname[app].appprogramname}}','admin.php?controller=admin_index&action=main&logintype=apppub&appserverip={{$appservers[ap].appserverip}}&appprogramname={{$appservers[ap].appname[app].appprogramname}}','{{$appservers[ap].appname[app].appprogramname}}','main',{{if $appservers[ap].appname[app].icon ne ''}}'upload/{{$appservers[ap].appname[app].icon}}'{{else}}null{{/if}},null,null,1);
			{{/section}}*}}
		{{/section}}
		{{/if}}
		document.write(dapp);	
		
		//dapp.s(1);
	</script>
</div>
		      </td>
                    </tr> 
					</table></div></td>
              </tr>

			  {{/if}}





			{{if $admin_level != 10 and $admin_level != 101 and $admin_level != 4}}
              <tr>
                <td align="left" class="anniu" onclick="javascript:show_box('audit');"><img src="{{$template_root}}/images/1_1.png"  style="vertical-align:middle"/> 运维审计</td>
              </tr>
              <tr >
                <td align="left" valign="top" id="audit" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_86.jpg" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_session" target="main" id="sshaudit" onclick="return jumpto(this)">操作审计</a></td>
                    </tr>
					{{if $admin_level == 1 or $admin_level == 2 or $admin_level == 3 or $admin_level == 0 or $admin_level == 21 or $admin_level == 31}}
                   
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_93.jpg" width="18" height="18"  align="absmiddle"/> <a href="admin.php?controller=admin_apppub" target="main" onclick="return jumpto(this)">应用审计</a></td>
                    </tr>
					
					{{if $admin_level == 1 or $admin_level == 2 or $admin_level == 3 or $admin_level == 21 or $admin_level == 31}}
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_98.jpg" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=gateway_running_list" target="main" onclick="return jumpto(this)">实时监控</a></td>
                    </tr>
					{{if $admin_level != 3}}
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot20.gif" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=search" target="main" onclick="return jumpto(this)">审计查询</a></td>
                    </tr>
					{{/if}}
					{{/if}}
					{{/if}}
					{{if $admin_level==2}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_101.jpg" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=batch_del" target="main" onclick="return jumpto(this)">日志删除</a></td>
                    </tr>
					{{/if}}
                </table></td>
              </tr>
			  {{/if}}
			 {{if $admin_level != 10  and $admin_level != 4 and $admin_level != 0 and $admin_level != 21 and $admin_level != 101}}
              <tr >
                <td align="left" valign="middle" onclick="javascript:show_box('report');" class="anniu"><img src="{{$template_root}}/images/1_2.png" width="18" height="18" style="vertical-align:middle"/> 报表统计</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="report" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					{{if $admin_level != 0}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_line.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=systempriority_search" target="main" onclick="return jumpto(this)">系统权限</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot1.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=logintims" target="main" onclick="return jumpto(this)">登录报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot2.gif" align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=commandreport" target="main" onclick="return jumpto(this)">操作报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot3.gif" align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=dangercmdreport" target="main" onclick="return jumpto(this)">告警报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
					  <img src="{{$template_root}}/images/tab_dot4.gif" width="16" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=reportgraph" id="statisticreport" target="main" onclick="return jumpto(this)">图形输出</a></td>
                    </tr>  
					
					{{else}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_curve.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=loginacct" target="main" onclick="return jumpto(this)">授权明细</a></td>
                    </tr>  
					{{/if}}
					{{if $admin_level == 2}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_pie.gif"  align="absmiddle"/> <a href="admin.php?controller=admin_log&action=adminlog" target="main" onclick="return jumpto(this)">系统操作</a></td>
                    </tr>  
					
					{{/if}}

					{{if $admin_level == 1}}
					
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=configreport" target="main" onclick="return jumpto(this)">报表配置</a></td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=report_search" target="main" onclick="return jumpto(this)">定期报表</a></td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot6.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_backup&action=backup_log" target="main" onclick="return jumpto(this)">系统状态</a></td>
                    </tr>  
					{{/if}}
                </table></td>
              </tr>
			  {{/if}}
			


			{{if $admin_level == 1 || $admin_level == 3 || $admin_level == 4 }}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('resource');" class="anniu"><img src="{{$template_root}}/images/1_3.png" width="18" height="15" style="vertical-align:middle"/> 资源管理</td>
              </tr>
			  <tr >
                <td align="left" valign="top" id="resource" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					{{if $admin_level!=10}}
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/group.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member" target="main" id="membermenu" onclick="return jumpto(this)">资产管理</a></td>
                    </tr>  
<tr id="_tree"><td>     
<div style=" width:180px; overflow-x:auto;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr id="mtree" style="display:none">
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/dtree.js"></script>
<div class="dtree" >
	<script type="text/javascript">
		mddev = new dTree('mddev');
		mddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		mddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		mddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		mddev.config['noshorttitle']=false;
		var i=0;
		mddev.add(0,-1,'目录','admin.php?controller=admin_member&all=1','','main',null,null,null,1,'目录','目录');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		{{section name=ag loop=$allsgroup}}
			{{if (!$_config.LDAP and $allsgroup[ag].level eq 0 ) or $_config.LDAP}}
			mddev.add({{$allsgroup[ag].id}},{{if $_config.LDAP eq 0}}0{{else}}{{$allsgroup[ag].ldapid}}{{/if}},'{{if $allsgroup[ag].level eq 1}}{{$allsgroup[ag].groupname}}{{elseif $allsgroup[ag].level eq 2}}{{$allsgroup[ag].groupname}}{{else}}{{$allsgroup[ag].groupname}}{{/if}}({{$allsgroup[ag].mcount}})','admin.php?controller=admin_member&ldapid={{$allsgroup[ag].id}}','{{$allsgroup[ag].groupname}}({{$allsgroup[ag].mcount}})','main','template/admin/cssjs/img/servergroup.png','template/admin/cssjs/img/servergroup.png',null,{{$allsgroup[ag].mcount}},'{{$allsgroup[ag].groupname}}({{$allsgroup[ag].mcount}})','{{$allsgroup[ag].groupname}}({{$allsgroup[ag].mcount}})');
			{{/if}}
		{{/section}}
		document.write(mddev);		
		mddev.s(0);
	</script>
</div>

					  </td>
                    </tr> 
{{if $_config.LDAP }}
					<tr id="mldaptree" style="display:none">
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/dtree.js"></script>
<div class="gtree" >
	<script type="text/javascript">
		mldap = new dTree('mldap');
		mldap.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		mldap.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		mldap.icon['node'] = 'template/admin/cssjs/img/servergroup.png';
		mldap.config['noshorttitle']=false;
		var i=0;
		mldap.add(0,-1,'目录','admin.php?controller=admin_member&action=usergroup&all=1','','main',null,null,null,1,'目录','目录');
		//ldap.add(10000,0,'所有目录','admin.php?controller=admin_pro&action=dev_group','','main');
		{{section name=g loop=$allldap}}
			mldap.add({{$allldap[g].id}},{{if $allldap[g].id}}0{{else}}{{$allldap[g].ldapid}}{{/if}}, '{{if $allldap[g].level eq 1}}{{$allldap[g].groupname}}{{elseif $allldap[g].level eq 2}}{{$allldap[g].groupname}}{{else}}{{$allldap[g].groupname}}{{/if}}({{$allldap[g].mcount}})', 'admin.php?controller=admin_member&action=usergroup&ldapid={{$allldap[g].id}}', '{{$allldap[g].groupname}}({{$allldap[g].mcount}})', 'main', 'template/admin/cssjs/img/servergroup.png', 'template/admin/cssjs/img/servergroup.png',null,{{$allldap[g].mcount}},'{{$allldap[g].groupname}}({{$allldap[g].mcount}})','{{$allldap[g].groupname}}({{$allldap[g].mcount}})');
			{{section name=cg loop=$allldap[g].children}}
			mldap.add({{$allldap[g].children[cg].id}}, {{$allldap[g].children[cg].ldapid}}, '{{$allldap[g].children[cg].groupname}}({{$allldap[g].children[cg].mcount}})', 'admin.php?controller=admin_member&action=usergroup&ldapid={{$allldap[g].children[cg].id}}', '{{$allldap[g].children[cg].groupname}}({{$allldap[g].children[cg].mcount}})', 'main', 'template/admin/cssjs/img/servergroup.png', 'template/admin/cssjs/img/servergroup.png',null,{{$allldap[g].children[cg].mcount}},'{{$allldap[g].children[cg].groupname}}({{$allldap[g].children[cg].mcount}})','{{$allldap[g].children[cg].groupname}}({{$allldap[g].children[cg].mcount}})');
			{{/section}}
		{{/section}}
		document.write(mldap);		
		mldap.s(0);
	</script>
</div>
					  </td>
                    </tr> 
{{/if}}


<tr id="devtree" style="display:none">
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="{{$template_root}}/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{$template_root}}/cssjs/dtree.js"></script>
<div class="dtree" >
	<script type="text/javascript">
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		ddev.config['noshorttitle']=false;
		var i=0;
		ddev.add(0,-1,'设备组','admin.php?controller=admin_pro&action=dev_index&all=1','','main',null,null,null,1,'设备组','设备组');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		{{section name=ag loop=$allsgroup}}
			{{if (!$_config.LDAP and $allsgroup[ag].level eq 0 ) or $_config.LDAP}}
			ddev.add({{$allsgroup[ag].id}},{{if $_config.LDAP eq 0}}0{{else}}{{$allsgroup[ag].ldapid}}{{/if}},'{{if $allsgroup[ag].level eq 1}}{{$allsgroup[ag].groupname}}{{elseif $allsgroup[ag].level eq 2}}{{$allsgroup[ag].groupname}}{{else}}{{$allsgroup[ag].groupname}}{{/if}}({{$allsgroup[ag].count}})','admin.php?controller=admin_pro&action=dev_index&gid={{$allsgroup[ag].id}}','{{$allsgroup[ag].groupname}}({{$allsgroup[ag].count}})','main','template/admin/cssjs/img/{{if $allsgroup[ag].level eq 1}}folderlevel1.png{{elseif $allsgroup[ag].level eq 2}}folderlevel2.png{{else}}servergroup.png{{/if}}','template/admin/cssjs/img/{{if $allsgroup[ag].level eq 1}}folderlevel1.png{{elseif $allsgroup[ag].level eq 2}}folderlevel2.png{{else}}servergroup.png{{/if}}',null,{{$allsgroup[ag].count}},'{{$allsgroup[ag].groupname}}({{$allsgroup[ag].count}})','{{$allsgroup[ag].groupname}}({{$allsgroup[ag].count}})');
			{{/if}}
		{{/section}}
		document.write(ddev);		
		ddev.s(0);
	</script>
</div>

					  </td>
                    </tr> 
</table>
</div>
</td></tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot19.gif" width="18" height="21"  align="absmiddle"/> <a href="{{if $appenable }}admin.php?controller=admin_config&action=appserver_list{{else}}#{{/if}}" target="main" onclick="{{if !$appenable }}alert('Licenses不包含应用发布');return false;{{/if}}return jumpto(this)">应用发布</a></td>
                    </tr>
					{{if $admin_level!=4}}
					{{if $admin_level==3 or $admin_level==21 or $admin_level==101}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/hammer_screwdriver.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=sourceip" target="main" onclick="return jumpto(this)">策略管理</a></td>
                    </tr>	
					{{else}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/hammer_screwdriver.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=default_policy" target="main" onclick="return jumpto(this)">策略设置</a></td>
                    </tr>	
					{{/if}}
					{{/if}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot19.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=resource_group" target="main" onclick="return jumpto(this)">授权权限</a></td>
                    </tr>
					{{if $xunjianbackup }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot19.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_autorun&action=autobackup_list" target="main" onclick="return jumpto(this)">巡检备份</a></td>
                    </tr>
					{{/if}}
					 {{/if}}
                </table></td>
              </tr>
			  {{/if}}

			{{if $admin_level == 10  or $admin_level == 101}}
			  <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('password');" class="anniu"><img src="{{$template_root}}/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> {{if $admin_level == 10 or $admin_level == 101}}{{$language.Password}}{{$language.manage}}{{else}}{{$language.device}}{{$language.manage}}{{/if}}</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="password" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					{{if $admin_level == 10 or $admin_level == 101}}
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/wall.png"  width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=main" id='passlist' target="main" onclick="return jumpto(this)">{{if $admin_level == 10 or $admin_level == 101}}密码管理{{else}}{{$language.DevicesList}}{{/if}}</a></td>
                    </tr>
					 <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/wall.png"  width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=logs_index" id='passlist' target="main" onclick="return jumpto(this)">改密报表</a></td>
                    </tr>
					{{/if}}
                </table></td>
              </tr>

			
			  {{/if}}


			{{if $admin_level == 1}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('configure');" class="anniu"><img src="{{$template_root}}/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> 系统配置</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="configure" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=config_ssh" target="main" id="configure1" onclick="return jumpto(this)">参数配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_line.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=ifcfgeth" target="main" onclick="return jumpto(this)">{{$language.Network}}</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/application_double.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=serverstatus" target="main" id="serverstatus" onclick="return jumpto(this)">系统管理</a></td>
                    </tr>
                </table></td>
              </tr>
			  {{/if}}
			{{if $cacti_on && $netmanageenable}}
			  {{if $admin_level == 1}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('monitor');" class="anniu"><img src="{{$template_root}}/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> 网管监控</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="monitor" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_monitor&action=index" target="main" id="configure1" onclick="return jumpto(this)">监控信息</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_monitor&action=apache_monitor" target="main" id="configure1" onclick="return jumpto(this)">应用监控</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_line.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_thold" target="main" onclick="return jumpto(this)">阈值配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/application_double.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_thold&action=snmp_alert" target="main" id="monitor_conf" onclick="return jumpto(this)">配置管理</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot1.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=host_reports" target="main" id="monitor_report" onclick="return jumpto(this)">报表管理</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot3.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_thold&action=snmp_status_warning_log" target="main" id="monitor_alert" onclick="return jumpto(this)">告警统计</a></td>
                    </tr>
                </table></td>
              </tr>
			  {{/if}}
			{{/if}}
			{{if $_config.LOG_ON && $logenable}}
			  {{if $admin_level == 1}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('log');" class="anniu"><img src="{{$template_root}}/images/1_2.png" width="18" height="21" style="vertical-align:middle"/> 日志管理</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="log" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_search&action=index" target="main" id="configure1" onclick="return jumpto(this)">日志查看</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_systemNew" target="main" id="configure1" onclick="return jumpto(this)">告警配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_line.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_slaveserver" target="main" onclick="return jumpto(this)">日志配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/application_double.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_countlogs" target="main" id="monitor_conf" onclick="return jumpto(this)">报表分析</a></td>
                    </tr>
                </table></td>
              </tr>
			  {{/if}}
			{{/if}}
			{{if $admin_level == 1}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('vpn');" class="anniu"><img src="{{$template_root}}/images/1_5.png" width="18" height="19" style="vertical-align:middle"/> VPN</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="vpn" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot8.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=vpnconfig" target="main" onclick="return jumpto(this)">VPN配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=vpn_list" target="main" onclick="return jumpto(this)">VPN策略</a></td>
                    </tr>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tab_dot10.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=route_list" target="main" onclick="return jumpto(this)">{{$language.VpnRouter}}</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/ico9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_vpnlog&action=online" target="main" onclick="return jumpto(this)">在线用户</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/doc_table.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_vpnlog" target="main" onclick="return jumpto(this)">VPN LOG</a></td>
                    </tr>
                </table></td>
              </tr>
			
			{{/if}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('other');" class="anniu"><img src="{{$template_root}}/images/1_6.png" width="18" height="19" style="vertical-align:middle"/> 其它</td>
              </tr>

			   <tr>
                <td align="left" valign="top"  id="other" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					{{if $amdin_level ==1 }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/key.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=keys_index" target="main" onclick="return jumpto(this)">动态令牌</a></td>
                    </tr>
					{{/if}}  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/ico9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=edit_self" target="main" onclick="return jumpto(this)">{{$language.OwnInformation}}</a></td>
                    </tr>
					{{if $amdin_level ==1 }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/list_ico4.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=license" target="main" onclick="return jumpto(this)">License</a></td>
                    </tr>
					{{/if}}  
					{{if $amdin_level ==0 }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/drive_disk.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=userdisk" target="main" onclick="return jumpto(this)">网络硬盘</a></td>
                    </tr>
					{{if $amdin_level ==1 }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/ico5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=sshpublickey" target="main" onclick="return jumpto(this)">私钥管理</a></td>
                    </tr>
					{{/if}}
					{{/if}} 
					{{if $admin_level !=10 && $admin_level !=2 }}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/down.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=tool_list" target="main" onclick="return jumpto(this)">工具下载</a></td>
                    </tr>
					{{/if}}
                </table></td>
              </tr>
          </table>
		  </td>
       
      </tr>
    </table>
	
	<script>
	var openid="";
	var cururl = "";
	function show_box(box_id){
		{{if $smarty.session.ADMIN_LEVEL eq 1}}
		document.getElementById('_tree').style.display='none';
		document.getElementById('devtree').style.display='none';
		document.getElementById('mtree').style.display='none';
		{{/if}}
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
		if(obj.id=='membermenu'&&selectedItem==obj){
			if(document.getElementById(cururl).style.display=='none'){
				document.getElementById(cururl).style.display='';
			}else{
				document.getElementById(cururl).style.display='none';
			}
			return false;
		}	
		{{if $smarty.session.ADMIN_LEVEL eq 1}}
		document.getElementById('_tree').style.display='none';
		document.getElementById('mtree').style.display='none';
		document.getElementById('devtree').style.display='none';
		{{/if}}
		if(selectedItem)
		selectedItem.parentNode.className='zcd01';
		obj.parentNode.className = "zcd";
		selectedItem = obj;
		return true;
	}

{{if $smarty.get.actions eq 'dev_group'}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_pro&action=dev_group&ldapid={{$smarty.get.ldapid}}&back={{$smarty.get.back}}'+'&'+Math.round(new Date().getTime()/1000);
{{elseif $smarty.get.actions eq 'dev_server'}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_pro&action=dev_index&gid={{$smarty.get.gid}}&back={{$smarty.get.back}}'+'&'+Math.round(new Date().getTime()/1000);
{{elseif $smarty.get.actions eq 'member'}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_member&ldapid={{$smarty.get.ldapid}}&gid={{$smarty.get.gid}}&back={{$smarty.get.back}}'+'&'+Math.round(new Date().getTime()/1000);
{{elseif $smarty.get.actions eq 'radiusmember'}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_member&action=radiususer&ldapid={{$smarty.get.ldapid}}&gid={{$smarty.get.gid}}&back={{$smarty.get.back}}'+'&'+Math.round(new Date().getTime()/1000);
{{elseif $smarty.get.actions eq 'usergroup'}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_member&action=usergroup&ldapid={{$smarty.get.ldapid}}&back={{$smarty.get.back}}'+'&'+Math.round(new Date().getTime()/1000);
{{elseif $smarty.get.actions eq 'config_ftp'}}
show_box('configure');
jumpto(document.getElementById('configure1'));
document.getElementById('configure1').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_config&action=config_ftp'+'&'+Math.round(new Date().getTime()/1000);

{{elseif  $amdin_level ==10 or $amdin_level ==101}}
show_box('password');
jumpto(document.getElementById('passlist'));
document.getElementById('passlist').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('passlist').href;
{{elseif $admin_level == 0}}
show_box('password');
//jumpto(document.getElementById('devlist2'));
//document.getElementById('devlist2').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_index&action=main';
//ddev.s(0);

{{elseif $admin_level == 3}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('membermenu').href;
{{elseif $admin_level==4}}
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('membermenu').href;
{{elseif $amdin_level ==2 or $amdin_level ==21}}
show_box('audit');
jumpto(document.getElementById('sshaudit'));
document.getElementById('sshaudit').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('sshaudit').href;
{{elseif $amdin_level ==1 }}
show_box('configure');
jumpto(document.getElementById('serverstatus'));
document.getElementById('serverstatus').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_status&action=latest';
{{/if}} 
{{if $login_tip == 1}}
window.open ('admin.php?controller=admin_index&action=login_tip', 'newwindow', 'height=330, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');
{{/if}}


</script>

</body>
</html>
