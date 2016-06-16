<?php /* Smarty version 2.6.18, created on 2014-07-03 12:23:13
         compiled from menu.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['site_title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<body>
<table width="213" height="500" border="0" cellpadding="0" cellspacing="0"  class="zuo_bj" >
      <tr>
        <td height="42" colspan="2" align="center" valign="middle" class="hui_bj"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_53.jpg" width="16" height="13" align="absmiddle" /> <?php echo $this->_tpl_vars['Year']; ?>
年<?php echo $this->_tpl_vars['Month']; ?>
月<?php echo $this->_tpl_vars['Day']; ?>
日 星期<?php echo $this->_tpl_vars['Week']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td width="209" height="606" align="center" valign="top">
			<table width="189" height="117" border="0" cellpadding="0" cellspacing="0" class="sy">
				<tr>
				  <td height="29" colspan="2" align="left">&nbsp;&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_47.jpg" width="22" height="22" align="absmiddle" />&nbsp;<strong class="bd">管理首页</strong></td>
				</tr>
				<tr>
				  <td width="87" align="center" valign="middle"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/yw_43.jpg" width="67" height="62" /></td>
				  <td width="98" align="left" valign="middle"><?php echo $this->_tpl_vars['username']; ?>
<br />(<?php echo $this->_tpl_vars['user']['realname']; ?>
)<br />
					<?php if ($this->_tpl_vars['admin_level'] == 0): ?>普通用户<?php elseif ($this->_tpl_vars['admin_level'] == 1): ?>管理员<?php elseif ($this->_tpl_vars['admin_level'] == 3): ?>部门管理员<?php elseif ($this->_tpl_vars['admin_level'] == 4): ?>配置管理员<?php elseif ($this->_tpl_vars['admin_level'] == 10): ?>密码管理员<?php elseif ($this->_tpl_vars['admin_level'] == 21): ?>部门审计员<?php elseif ($this->_tpl_vars['admin_level'] == 101): ?>部门密码员<?php endif; ?></td>
				</tr>
			</table>
            <br />
            <table width="178"  border="0" cellpadding="0" cellspacing="0" id="audit_menu">

			<?php if ($this->_tpl_vars['admin_level'] == 0): ?>
			  <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('password');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_6.png" width="18" height="21" style="vertical-align:middle"/> 设备管理</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="password" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.js"></script>
<div class="dtree" >
	<script type="text/javascript">
		<?php if ($this->_tpl_vars['user']['ldap']): ?>
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		ddev.add(0,-1,'设备组','admin.php?controller=admin_index&action=main&all=1','','main');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		<?php unset($this->_sections['ag']);
$this->_sections['ag']['name'] = 'ag';
$this->_sections['ag']['loop'] = is_array($_loop=$this->_tpl_vars['sgroups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ag']['show'] = true;
$this->_sections['ag']['max'] = $this->_sections['ag']['loop'];
$this->_sections['ag']['step'] = 1;
$this->_sections['ag']['start'] = $this->_sections['ag']['step'] > 0 ? 0 : $this->_sections['ag']['loop']-1;
if ($this->_sections['ag']['show']) {
    $this->_sections['ag']['total'] = $this->_sections['ag']['loop'];
    if ($this->_sections['ag']['total'] == 0)
        $this->_sections['ag']['show'] = false;
} else
    $this->_sections['ag']['total'] = 0;
if ($this->_sections['ag']['show']):

            for ($this->_sections['ag']['index'] = $this->_sections['ag']['start'], $this->_sections['ag']['iteration'] = 1;
                 $this->_sections['ag']['iteration'] <= $this->_sections['ag']['total'];
                 $this->_sections['ag']['index'] += $this->_sections['ag']['step'], $this->_sections['ag']['iteration']++):
$this->_sections['ag']['rownum'] = $this->_sections['ag']['iteration'];
$this->_sections['ag']['index_prev'] = $this->_sections['ag']['index'] - $this->_sections['ag']['step'];
$this->_sections['ag']['index_next'] = $this->_sections['ag']['index'] + $this->_sections['ag']['step'];
$this->_sections['ag']['first']      = ($this->_sections['ag']['iteration'] == 1);
$this->_sections['ag']['last']       = ($this->_sections['ag']['iteration'] == $this->_sections['ag']['total']);
?>
			<?php if ($this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['sct'] > 0): ?>
			ddev.add(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['id']; ?>
,<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['ldapid']; ?>
,'<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['sct']; ?>
)','admin.php?controller=admin_index&action=main&gid=<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['sct']; ?>
)','main','template/admin/cssjs/img/<?php if ($this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['level'] == 1): ?>folderlevel1.png<?php elseif ($this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['level'] == 2): ?>folderlevel2.png<?php else: ?>servergroup.png<?php endif; ?>','template/admin/cssjs/img/<?php if ($this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['level'] == 1): ?>folderlevel1.png<?php elseif ($this->_tpl_vars['sgroups'][$this->_sections['ag']['index']]['level'] == 2): ?>folderlevel2.png<?php else: ?>servergroup.png<?php endif; ?>');
			<?php endif; ?>
		<?php endfor; endif; ?>	
		document.write(ddev);		
		ddev.s(0);
		<?php else: ?>
		d = new dTree('d');
		d.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		d.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		d.icon['node'] = 'template/admin/cssjs/img/servergroup.png';
		//d.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		d.add(0,-1,'设备组','admin.php?controller=admin_index&action=main&all=1','','main');
		//d.add(10000,0,'所有主机','admin.php?controller=admin_index&action=main','','main');
		<?php unset($this->_sections['ug']);
$this->_sections['ug']['name'] = 'ug';
$this->_sections['ug']['loop'] = is_array($_loop=$this->_tpl_vars['sgroups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ug']['show'] = true;
$this->_sections['ug']['max'] = $this->_sections['ug']['loop'];
$this->_sections['ug']['step'] = 1;
$this->_sections['ug']['start'] = $this->_sections['ug']['step'] > 0 ? 0 : $this->_sections['ug']['loop']-1;
if ($this->_sections['ug']['show']) {
    $this->_sections['ug']['total'] = $this->_sections['ug']['loop'];
    if ($this->_sections['ug']['total'] == 0)
        $this->_sections['ug']['show'] = false;
} else
    $this->_sections['ug']['total'] = 0;
if ($this->_sections['ug']['show']):

            for ($this->_sections['ug']['index'] = $this->_sections['ug']['start'], $this->_sections['ug']['iteration'] = 1;
                 $this->_sections['ug']['iteration'] <= $this->_sections['ug']['total'];
                 $this->_sections['ug']['index'] += $this->_sections['ug']['step'], $this->_sections['ug']['iteration']++):
$this->_sections['ug']['rownum'] = $this->_sections['ug']['iteration'];
$this->_sections['ug']['index_prev'] = $this->_sections['ug']['index'] - $this->_sections['ug']['step'];
$this->_sections['ug']['index_next'] = $this->_sections['ug']['index'] + $this->_sections['ug']['step'];
$this->_sections['ug']['first']      = ($this->_sections['ug']['iteration'] == 1);
$this->_sections['ug']['last']       = ($this->_sections['ug']['iteration'] == $this->_sections['ug']['total']);
?>
			<?php if ($this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['sct'] > 0): ?>
			d.add(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['id']; ?>
,0,'<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['sct']; ?>
)','admin.php?controller=admin_index&action=main&gid=<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['sgroups'][$this->_sections['ug']['index']]['sct']; ?>
)','main');
			<?php endif; ?>
		<?php endfor; endif; ?>
		document.write(d);		
		d.s(0);
		<?php endif; ?>
	</script>
</div>
					  </td>
                    </tr> 
		     <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><?php echo $this->_tpl_vars['member']['apphost']; ?>

<div class="dtree" >
	<script type="text/javascript">
		dapp = new dTree('dapp');
		dapp.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		dapp.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		dapp.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		dapp.add(0,-1,'应用发布','admin.php?controller=admin_index&action=main&logintype=apppub','','main');
		<?php if ($this->_tpl_vars['user']['apphost']): ?>
		<?php unset($this->_sections['ap']);
$this->_sections['ap']['name'] = 'ap';
$this->_sections['ap']['loop'] = is_array($_loop=$this->_tpl_vars['appservers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ap']['show'] = true;
$this->_sections['ap']['max'] = $this->_sections['ap']['loop'];
$this->_sections['ap']['step'] = 1;
$this->_sections['ap']['start'] = $this->_sections['ap']['step'] > 0 ? 0 : $this->_sections['ap']['loop']-1;
if ($this->_sections['ap']['show']) {
    $this->_sections['ap']['total'] = $this->_sections['ap']['loop'];
    if ($this->_sections['ap']['total'] == 0)
        $this->_sections['ap']['show'] = false;
} else
    $this->_sections['ap']['total'] = 0;
if ($this->_sections['ap']['show']):

            for ($this->_sections['ap']['index'] = $this->_sections['ap']['start'], $this->_sections['ap']['iteration'] = 1;
                 $this->_sections['ap']['iteration'] <= $this->_sections['ap']['total'];
                 $this->_sections['ap']['index'] += $this->_sections['ap']['step'], $this->_sections['ap']['iteration']++):
$this->_sections['ap']['rownum'] = $this->_sections['ap']['iteration'];
$this->_sections['ap']['index_prev'] = $this->_sections['ap']['index'] - $this->_sections['ap']['step'];
$this->_sections['ap']['index_next'] = $this->_sections['ap']['index'] + $this->_sections['ap']['step'];
$this->_sections['ap']['first']      = ($this->_sections['ap']['iteration'] == 1);
$this->_sections['ap']['last']       = ($this->_sections['ap']['iteration'] == $this->_sections['ap']['total']);
?>
			dapp.add(++i,0,'<?php echo $this->_tpl_vars['appservers'][$this->_sections['ap']['index']]['hostname']; ?>
','admin.php?controller=admin_index&action=main&logintype=apppub&appserverip=<?php echo $this->_tpl_vars['appservers'][$this->_sections['ap']['index']]['appserverip']; ?>
','<?php echo $this->_tpl_vars['appservers'][$this->_sections['ap']['index']]['hostname']; ?>
','main');
		<?php endfor; endif; ?>
		<?php endif; ?>
		document.write(dapp);	
		
		//dapp.s(1);
	</script>
</div>
		      </td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico18.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=createrdpfile" target="main" id='devlist3' onclick="return jumpto(this)">列表导出</a></td>
                    </tr> 
					<?php if ($this->_tpl_vars['user']['allowchange']): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/wall_disable.png" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=chpwd" target="main" onclick="return jumpto(this)">密码修改</a></td>
                    </tr> 
					<?php endif; ?>
                </table></td>
              </tr>
			  <?php endif; ?>

			<?php if ($this->_tpl_vars['admin_level'] != 10 && $this->_tpl_vars['admin_level'] != 101 && $this->_tpl_vars['admin_level'] != 4): ?>
              <tr>
                <td align="left" class="anniu" onclick="javascript:show_box('audit');"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_1.png"  style="vertical-align:middle"/> 运维审计</td>
              </tr>
              <tr >
                <td align="left" valign="top" id="audit" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tb_86.jpg" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_session" target="main" id="sshaudit" onclick="return jumpto(this)">操作审计</a></td>
                    </tr>
					<?php if ($this->_tpl_vars['admin_level'] == 1 || $this->_tpl_vars['admin_level'] == 2 || $this->_tpl_vars['admin_level'] == 3 || $this->_tpl_vars['admin_level'] == 0): ?>
                   
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tb_93.jpg" width="18" height="18"  align="absmiddle"/> <a href="admin.php?controller=admin_apppub" target="main" onclick="return jumpto(this)">应用审计</a></td>
                    </tr>
					
					<?php if ($this->_tpl_vars['admin_level'] == 1 || $this->_tpl_vars['admin_level'] == 2 || $this->_tpl_vars['admin_level'] == 3): ?>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tb_98.jpg" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=gateway_running_list" target="main" onclick="return jumpto(this)">实时监控</a></td>
                    </tr>
					<?php if ($this->_tpl_vars['admin_level'] != 3): ?>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot20.gif" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=search" target="main" onclick="return jumpto(this)">审计查询</a></td>
                    </tr>
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['admin_level'] == 2): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tb_101.jpg" width="18" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_session&action=batch_del" target="main" onclick="return jumpto(this)">日志删除</a></td>
                    </tr>
					<?php endif; ?>
                </table></td>
              </tr>
			  <?php endif; ?>
			 <?php if ($this->_tpl_vars['admin_level'] != 10 && $this->_tpl_vars['admin_level'] != 4 && $this->_tpl_vars['admin_level'] != 0 && $this->_tpl_vars['admin_level'] != 21): ?>
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('report');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_2.png" width="18" height="18" style="vertical-align:middle"/> 日志报表</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="report" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<?php if ($this->_tpl_vars['admin_level'] != 0): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/chart_line.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=systempriority_search" target="main" onclick="return jumpto(this)">系统权限</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot1.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=logintims" target="main" onclick="return jumpto(this)">登录报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot2.gif" align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=commandreport" target="main" onclick="return jumpto(this)">操作报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot3.gif" align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=dangercmdreport" target="main" onclick="return jumpto(this)">告警报表</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
					  <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot4.gif" width="16" height="16"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=reportgraph" id="statisticreport" target="main" onclick="return jumpto(this)">图形输出</a></td>
                    </tr>  
					
					<?php else: ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/chart_curve.gif"   align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=loginacct" target="main" onclick="return jumpto(this)">授权明细</a></td>
                    </tr>  
					<?php endif; ?>
					<?php if ($this->_tpl_vars['admin_level'] == 2): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/chart_pie.gif"  align="absmiddle"/> <a href="admin.php?controller=admin_log&action=adminlog" target="main" onclick="return jumpto(this)">系统操作</a></td>
                    </tr>  
					
					<?php endif; ?>

					<?php if ($this->_tpl_vars['admin_level'] == 1): ?>
					
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=configreport" target="main" onclick="return jumpto(this)">报表配置</a></td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_reports&action=report_search" target="main" onclick="return jumpto(this)">定期报表</a></td>
                    </tr> 
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot6.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_backup&action=backup_log" target="main" onclick="return jumpto(this)">系统状态</a></td>
                    </tr>  
					<?php endif; ?>
                </table></td>
              </tr>
			  <?php endif; ?>
			


			<?php if ($this->_tpl_vars['admin_level'] == 1 || $this->_tpl_vars['admin_level'] == 3 || $this->_tpl_vars['admin_level'] == 4 || $this->_tpl_vars['admin_level'] == 101): ?>
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('resource');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_3.png" width="18" height="15" style="vertical-align:middle"/> 资源管理</td>
              </tr>
			  <tr >
                <td align="left" valign="top" id="resource" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<?php if ($this->_tpl_vars['admin_level'] != 10): ?>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/group.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member" target="main" id="membermenu" onclick="return jumpto(this)">运维账号</a></td>
                    </tr>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/coins.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=dev_index" target="main" id="devmenu"  onclick="return jumpto(this)">资产管理</a></td>
                    </tr>	
					<tr id="tree"><td><table>
<tr id="devtree" style="display:none">
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.js"></script>
<div class="dtree" >
	<script type="text/javascript">
		ddev = new dTree('ddev');
		ddev.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ddev.icon['node'] = 'template/admin/cssjs/img/pc.gif';
		var i=0;
		ddev.add(0,-1,'设备组','admin.php?controller=admin_pro&action=dev_index&all=1','','main');
		//ddev.add(10000,0,'所有主机','admin.php?controller=admin_pro&action=dev_index','','main');
		<?php unset($this->_sections['ag']);
$this->_sections['ag']['name'] = 'ag';
$this->_sections['ag']['loop'] = is_array($_loop=$this->_tpl_vars['allsgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ag']['show'] = true;
$this->_sections['ag']['max'] = $this->_sections['ag']['loop'];
$this->_sections['ag']['step'] = 1;
$this->_sections['ag']['start'] = $this->_sections['ag']['step'] > 0 ? 0 : $this->_sections['ag']['loop']-1;
if ($this->_sections['ag']['show']) {
    $this->_sections['ag']['total'] = $this->_sections['ag']['loop'];
    if ($this->_sections['ag']['total'] == 0)
        $this->_sections['ag']['show'] = false;
} else
    $this->_sections['ag']['total'] = 0;
if ($this->_sections['ag']['show']):

            for ($this->_sections['ag']['index'] = $this->_sections['ag']['start'], $this->_sections['ag']['iteration'] = 1;
                 $this->_sections['ag']['iteration'] <= $this->_sections['ag']['total'];
                 $this->_sections['ag']['index'] += $this->_sections['ag']['step'], $this->_sections['ag']['iteration']++):
$this->_sections['ag']['rownum'] = $this->_sections['ag']['iteration'];
$this->_sections['ag']['index_prev'] = $this->_sections['ag']['index'] - $this->_sections['ag']['step'];
$this->_sections['ag']['index_next'] = $this->_sections['ag']['index'] + $this->_sections['ag']['step'];
$this->_sections['ag']['first']      = ($this->_sections['ag']['iteration'] == 1);
$this->_sections['ag']['last']       = ($this->_sections['ag']['iteration'] == $this->_sections['ag']['total']);
?>
			ddev.add(<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['id']; ?>
,<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['ldapid']; ?>
,'<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['count']; ?>
)','admin.php?controller=admin_pro&action=dev_index&gid=<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['count']; ?>
)','main','template/admin/cssjs/img/<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['level'] == 1): ?>folderlevel1.png<?php elseif ($this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['level'] == 2): ?>folderlevel2.png<?php else: ?>servergroup.png<?php endif; ?>','template/admin/cssjs/img/<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['level'] == 1): ?>folderlevel1.png<?php elseif ($this->_tpl_vars['allsgroup'][$this->_sections['ag']['index']]['level'] == 2): ?>folderlevel2.png<?php else: ?>servergroup.png<?php endif; ?>');
		<?php endfor; endif; ?>
		document.write(ddev);		
		ddev.s(0);
	</script>
</div>

					  </td>
                    </tr> 
					<tr id="ldaptree" style="display:none">
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/dtree.js"></script>
<div class="ltree" >
	<script type="text/javascript">
		ldap = new dTree('ldap');
		ldap.icon['folder'] = 'template/admin/cssjs/img/pcgroup.gif';
		ldap.icon['folderOpen'] = 'template/admin/cssjs/img/pcgroup.gif';
		ldap.icon['node'] = 'template/admin/cssjs/img/servergroup.png';
		var i=0;
		ldap.add(0,-1,'设备目录','admin.php?controller=admin_pro&action=dev_group&all=1','','main');
		//ldap.add(10000,0,'所有目录','admin.php?controller=admin_pro&action=dev_group','','main');
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allldap']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
			ldap.add(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['id']; ?>
, <?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['ldapid']; ?>
, '<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['count']; ?>
)', 'admin.php?controller=admin_pro&action=dev_group&ldapid=<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['id']; ?>
', '<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['count']; ?>
)', 'main', 'template/admin/cssjs/img/folderlevel1.png', 'template/admin/cssjs/img/folderlevel1.png');
			<?php unset($this->_sections['cg']);
$this->_sections['cg']['name'] = 'cg';
$this->_sections['cg']['loop'] = is_array($_loop=$this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cg']['show'] = true;
$this->_sections['cg']['max'] = $this->_sections['cg']['loop'];
$this->_sections['cg']['step'] = 1;
$this->_sections['cg']['start'] = $this->_sections['cg']['step'] > 0 ? 0 : $this->_sections['cg']['loop']-1;
if ($this->_sections['cg']['show']) {
    $this->_sections['cg']['total'] = $this->_sections['cg']['loop'];
    if ($this->_sections['cg']['total'] == 0)
        $this->_sections['cg']['show'] = false;
} else
    $this->_sections['cg']['total'] = 0;
if ($this->_sections['cg']['show']):

            for ($this->_sections['cg']['index'] = $this->_sections['cg']['start'], $this->_sections['cg']['iteration'] = 1;
                 $this->_sections['cg']['iteration'] <= $this->_sections['cg']['total'];
                 $this->_sections['cg']['index'] += $this->_sections['cg']['step'], $this->_sections['cg']['iteration']++):
$this->_sections['cg']['rownum'] = $this->_sections['cg']['iteration'];
$this->_sections['cg']['index_prev'] = $this->_sections['cg']['index'] - $this->_sections['cg']['step'];
$this->_sections['cg']['index_next'] = $this->_sections['cg']['index'] + $this->_sections['cg']['step'];
$this->_sections['cg']['first']      = ($this->_sections['cg']['iteration'] == 1);
$this->_sections['cg']['last']       = ($this->_sections['cg']['iteration'] == $this->_sections['cg']['total']);
?>
			ldap.add(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['id']; ?>
, <?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['ldapid']; ?>
, '<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['count']; ?>
)', 'admin.php?controller=admin_pro&action=dev_group&ldapid=<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['id']; ?>
', '<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['groupname']; ?>
(<?php echo $this->_tpl_vars['allldap'][$this->_sections['g']['index']]['children'][$this->_sections['cg']['index']]['count']; ?>
)', 'main', 'template/admin/cssjs/img/folderlevel2.png', 'template/admin/cssjs/img/folderlevel2.png');
			<?php endfor; endif; ?>
		<?php endfor; endif; ?>
		document.write(ldap);		
		ddev.s(0);
	</script>
</div>

					  </td>
                    </tr> 
</table></td></tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot19.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=appserver_list" target="main" onclick="return jumpto(this)">应用发布</a></td>
                    </tr>
					<?php if ($this->_tpl_vars['admin_level'] != 3): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot18.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=dev_priority_search" target="main" onclick="return jumpto(this)"><?php echo $this->_tpl_vars['language']['AuthoritySearch']; ?>
</a></td>
                    </tr>					
					<?php endif; ?>
					<?php if ($this->_tpl_vars['admin_level'] != 4): ?>
					<?php if ($this->_tpl_vars['admin_level'] == 3 || $this->_tpl_vars['admin_level'] == 21 || $this->_tpl_vars['admin_level'] == 101): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/hammer_screwdriver.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=sourceip" target="main" onclick="return jumpto(this)">策略设置</a></td>
                    </tr>	
					<?php else: ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/hammer_screwdriver.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=default_policy" target="main" onclick="return jumpto(this)">策略设置</a></td>
                    </tr>	
					<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['admin_level'] != 3 && $this->_tpl_vars['admin_level'] != 4): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico3.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=passwordkey" target="main" onclick="return jumpto(this)">密码密钥</a></td>
                    </tr>
					<?php endif; ?>
					 <?php endif; ?>
                </table></td>
              </tr>
			  <?php endif; ?>

			<?php if ($this->_tpl_vars['admin_level'] == 10 || $this->_tpl_vars['admin_level'] == 101): ?>
			  <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('password');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> <?php if ($this->_tpl_vars['admin_level'] == 10 || $this->_tpl_vars['admin_level'] == 101): ?><?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['manage']; ?>
<?php else: ?><?php echo $this->_tpl_vars['language']['device']; ?>
<?php echo $this->_tpl_vars['language']['manage']; ?>
<?php endif; ?></td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="password" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<?php if ($this->_tpl_vars['admin_level'] == 10 || $this->_tpl_vars['admin_level'] == 101): ?>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/wall.png"  width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=main" id='passlist' target="main" onclick="return jumpto(this)"><?php if ($this->_tpl_vars['admin_level'] == 10 || $this->_tpl_vars['admin_level'] == 101): ?>密码管理<?php else: ?><?php echo $this->_tpl_vars['language']['DevicesList']; ?>
<?php endif; ?></a></td>
                    </tr>
					<?php endif; ?>
                </table></td>
              </tr>

			
			  <?php endif; ?>


			<?php if ($this->_tpl_vars['admin_level'] == 1): ?>
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('configure');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_4.png" width="18" height="21" style="vertical-align:middle"/> 系统配置</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="configure" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/cog.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_config&action=config_ssh" target="main" onclick="return jumpto(this)">参数配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/chart_line.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=ifcfgeth" target="main" onclick="return jumpto(this)"><?php echo $this->_tpl_vars['language']['Network']; ?>
</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/application_double.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=serverstatus" target="main" id="serverstatus" onclick="return jumpto(this)">系统管理</a></td>
                    </tr>
                </table></td>
              </tr>
			  <?php endif; ?>
			
			<?php if ($this->_tpl_vars['admin_level'] == 1): ?>
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('vpn');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_5.png" width="18" height="19" style="vertical-align:middle"/> VPN</td>
              </tr>
			   <tr >
                <td align="left" valign="top" id="vpn" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot8.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=vpnconfig" target="main" onclick="return jumpto(this)">VPN配置</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=vpn_list" target="main" onclick="return jumpto(this)">VPN策略</a></td>
                    </tr>
                    <tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_dot10.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_eth&action=route_list" target="main" onclick="return jumpto(this)"><?php echo $this->_tpl_vars['language']['VpnRouter']; ?>
</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_vpnlog&action=online" target="main" onclick="return jumpto(this)">在线用户</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/doc_table.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_vpnlog" target="main" onclick="return jumpto(this)">VPN LOG</a></td>
                    </tr>
                </table></td>
              </tr>
			
			<?php endif; ?>
              <tr>
                <td align="left" valign="middle" onclick="javascript:show_box('other');" class="anniu"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/1_6.png" width="18" height="19" style="vertical-align:middle"/> 其它</td>
              </tr>

			   <tr>
                <td align="left" valign="top"  id="other" style="display:none" ><table width="100%"  border="0" cellpadding="0" cellspacing="2">
					<?php if ($this->_tpl_vars['amdin_level'] == 1): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/key.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=keys_index" target="main" onclick="return jumpto(this)">usbkey<?php echo $this->_tpl_vars['language']['List']; ?>
</a></td>
                    </tr>
					<?php endif; ?>  
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico9.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=edit_self" target="main" onclick="return jumpto(this)"><?php echo $this->_tpl_vars['language']['OwnInformation']; ?>
</a></td>
                    </tr>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/list_ico4.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=license" target="main" onclick="return jumpto(this)">License</a></td>
                    </tr>
					<?php if ($this->_tpl_vars['amdin_level'] == 0): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/drive_disk.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_member&action=userdisk" target="main" onclick="return jumpto(this)">网络硬盘</a></td>
                    </tr>
					<?php if ($this->_tpl_vars['amdin_level'] == 1): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/ico5.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_pro&action=sshpublickey" target="main" onclick="return jumpto(this)">私钥管理</a></td>
                    </tr>
					<?php endif; ?>
					<?php endif; ?> 
					<?php if ($this->_tpl_vars['admin_level'] != 10 && $this->_tpl_vars['admin_level'] != 2): ?>
					<tr>
                      <td height="25" align="left" bgcolor="52A1D4" class="zcd01"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/down.gif" width="18" height="21"  align="absmiddle"/> <a href="admin.php?controller=admin_index&action=tool_list" target="main" onclick="return jumpto(this)">工具下载</a></td>
                    </tr>
					<?php endif; ?>
                </table></td>
              </tr>
          </table>
		  </td>
       
      </tr>
    </table>
	
	<script>
	var openid="";
	function show_box(box_id){
		<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
		document.getElementById('devtree').style.display='none';
		document.getElementById('ldaptree').style.display='none';
		<?php endif; ?>
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
		if(obj.id!='devmenu' && obj.id!='passlist' && obj.id!='sshaudit' ){
			if(document.getElementById('devtree')!=undefined){
			document.getElementById('devtree').style.display='none';
			}
			if(document.getElementById('devtree')!=undefined){
			document.getElementById('ldaptree').style.display='none';
			}
		}
		if(obj.id=='devmenu'&&selectedItem==obj){
			if(document.getElementById('tree').style.display=='none'){
				document.getElementById('tree').style.display=''
			}else{
				document.getElementById('tree').style.display='none'
			}
			return false;
		}
		if(selectedItem)
		selectedItem.parentNode.className='zcd01';
		obj.parentNode.className = "zcd";
		selectedItem = obj;
		return true;
	}

<?php if ($this->_tpl_vars['amdin_level'] == 10 || $this->_tpl_vars['amdin_level'] == 101): ?>
show_box('password');
jumpto(document.getElementById('passlist'));
document.getElementById('passlist').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('passlist').href;
<?php elseif ($this->_tpl_vars['admin_level'] == 0): ?>
show_box('password');
//jumpto(document.getElementById('devlist2'));
//document.getElementById('devlist2').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_index&action=main';
//ddev.s(0);

<?php elseif ($this->_tpl_vars['admin_level'] == 3): ?>
show_box('resource');
jumpto(document.getElementById('membermenu'));
document.getElementById('membermenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('membermenu').href;
<?php elseif ($this->_tpl_vars['admin_level'] == 4): ?>
show_box('resource');
jumpto(document.getElementById('devmenu'));
document.getElementById('devmenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('devmenu').href;
<?php endif; ?>  
<?php if ($this->_tpl_vars['login_tip'] == 1): ?>
window.open ('admin.php?controller=admin_index&action=login_tip', 'newwindow', 'height=330, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');
<?php endif; ?>
<?php if ($this->_tpl_vars['amdin_level'] == 2 || $this->_tpl_vars['amdin_level'] == 21): ?>
show_box('audit');
jumpto(document.getElementById('sshaudit'));
document.getElementById('sshaudit').parentNode.className='zcd';
window.parent.document.getElementById('main').src=document.getElementById('sshaudit').href;
<?php endif; ?> 
<?php if ($this->_tpl_vars['amdin_level'] == 1): ?>
show_box('configure');
jumpto(document.getElementById('serverstatus'));
document.getElementById('serverstatus').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_status&action=latest';
<?php endif; ?> 
<?php if ($_GET['actions'] == 'dev_group'): ?>
show_box('resource');
jumpto(document.getElementById('devmenu'));
document.getElementById('devmenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_pro&action=dev_group&ldapid=<?php echo $_GET['ldapid']; ?>
';
<?php elseif ($_GET['actions'] == 'dev_server'): ?>
show_box('resource');
jumpto(document.getElementById('devmenu'));
document.getElementById('devmenu').parentNode.className='zcd';
window.parent.document.getElementById('main').src='admin.php?controller=admin_pro&action=dev_index&gid=<?php echo $_GET['gid']; ?>
';
<?php endif; ?>

</script>

</body>
</html>