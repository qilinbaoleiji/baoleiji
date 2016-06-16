<td width="15%" align="left" valign="top" id="left" >
	<table width="229" height="648" border="0" cellpadding="0" cellspacing="0"  class="zuo_bj" >
      <tr>
        <td height="42" colspan="2" align="center" valign="middle" class="hui_bj"><img src="{{$template_root}}/images/yw_53.jpg" width="16" height="13" align="absmiddle" /> {{$Year}}年{{$Month}}月{{$Day}}日 星期{{$Week}}&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td width="209" height="606" align="center" valign="top">
		 <div style="width:100%; height:700px; overflow-y:no; overflow-x:auto;" > 
			<table width="189" height="117" border="0" cellpadding="0" cellspacing="0" class="sy">
				<tr>
				  <td height="29" colspan="2" align="left">&nbsp;&nbsp;&nbsp;<img src="{{$template_root}}/images/yw_47.jpg" width="22" height="22" align="absmiddle" />&nbsp;<strong class="bd">管理首页</strong></td>
				</tr>
				<tr>
				  <td width="87" align="center" valign="middle"><img src="{{$template_root}}/images/yw_43.jpg" width="67" height="62" /></td>
				  <td width="98" align="left" valign="middle">{{$username}}<br />
					  <br />
					{{if $admin_level == 2}}审计员{{elseif $admin_level == 1}}管理员{{/if}}</td>
				</tr>
			</table>
            <br />
            <table width="178"  border="0" cellpadding="0" cellspacing="0" id="audit_menu">

              <tr>
                <td align="left" class="anniu" onclick="javascript:show_box('audit');"><img src="{{$template_root}}/images/1_1.png"  style="vertical-align:middle"/> 审计管理</td>
              </tr>
              <tr >
                <td align="left" valign="top" id="audit" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
				 <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_98.jpg" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_sqlneton" target="main" onclick="return jumpto(this)">实时审计</a></td>
                    </tr>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_86.jpg" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_sqlnet" target="main" id="sshaudit" onclick="return jumpto(this)">综合审计</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/tb_86.jpg" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_sqlnet&action=search" target="main" id="auditsearch" onclick="return jumpto(this)">审计查询</a></td>
                    </tr>
					 {{if $admin_level == 2}}
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_pie.gif"  align="absmiddle"/> <a href="admin.php?controller=admin_log&action=adminlog" target="main" onclick="return jumpto(this)">Admin操作</a></td>
                    </tr>  
					
					{{/if}}
                </table></td>
              </tr>
			  {{if $admin_level != 2}}
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('report');" class="anniu"><img src="{{$template_root}}/images/1_2.png" width="18" height="18" style="vertical-align:middle"/> 策略管理</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="report" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
					  <img src="{{$template_root}}/images/chart_bar.gif" width="16" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_ipgroup" id="statisticreport" target="main" onclick="return jumpto(this)">IP地址组</a></td>
                    </tr>    
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_line.gif" align="absmiddle"/> <a href="admin.php?controller=admin_sqloptions" target="main" onclick="return jumpto(this)">SQL命令组</a></td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_curve.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_auditpolicy" target="main" onclick="return jumpto(this)">审计规则</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_curve.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_blacklist" target="main" onclick="return jumpto(this)">过滤列表</a></td>
                    </tr>  
					
                </table></td>
              </tr>
		

              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('resource');" class="anniu"><img src="{{$template_root}}/images/1_3.png" width="18" height="15" style="vertical-align:middle"/> 资源管理</td>
              </tr>
			  <tr >
                <td align="left" valign="top" id="resource" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/group.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_dbsniffer" target="main" id="membermenu" onclick="return jumpto(this)">探针管理</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/coins.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_dbserver" target="main" onclick="return jumpto(this)">数据库管理</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/coins.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=syslog_mail_alarm" target="main" onclick="return jumpto(this)">告警配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/doc_table.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_backup" target="main" onclick="return jumpto(this)">备份删除</a></td>
                    </tr>
                </table></td>
              </tr>
			
			 
			{{/if}}
			   <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('cpassword2');" class="anniu"><img src="{{$template_root}}/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> 报表管理</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="cpassword2" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_bar.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_loginaccount" target="main" onclick="return jumpto(this)">登录统计</a></td>
                    </tr>   
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="{{$template_root}}/images/chart_curve.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_sqlaccount" target="main" onclick="return jumpto(this)">操作统计</a></td>
                    </tr> 
					
                </table></td>
              </tr>

             
          </table>
		</div>  </td>
       
      </tr>
    </table></td>
	