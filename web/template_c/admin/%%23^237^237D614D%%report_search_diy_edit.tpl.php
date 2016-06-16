<?php /* Smarty version 2.6.18, created on 2014-06-23 00:12:38
         compiled from report_search_diy_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_search_diy_edit.tpl', 92, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['LogList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
<script>
function setScroll(){
	window.parent.scrollTo(0,0);
}

function changelevel(val){
	var ldapid2 = document.getElementById('ldapid2');
	ldapid2.options.length = 0;
	switch(val){
		case '1':
			ldapid2.options[ldapid2.options.length] = new Option('变更报表', 'admin_log_statistic');
		break;
		case '2':
			ldapid2.options[ldapid2.options.length] = new Option('登录统计报表', 'login_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('授权明细', 'loginacct_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('登录尝试', 'loginfailed_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('系统登录报表', 'devlogin_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('应用登录报表', 'applogin_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('审批报表', 'loginapproved_statistic');
		break;
		case '3':
			ldapid2.options[ldapid2.options.length] = new Option('命令报表', 'command_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('命令统计', 'cmdcache_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('命令列表', 'cmdlist_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('应用报表', 'app_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('SFTP命令报表', 'sftpcmd_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('FTP命令报表', 'ftpcmd_statistic');
		break;
		case '4':
			ldapid2.options[ldapid2.options.length] = new Option('违规统计', 'dangercmd_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('违规操作', 'dangercmdlist_statistic');
		break;
	}
}
</script>
</head>

<body>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search">定期报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search_diy">自定义报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_reports&action=report_search_diy&back=1"><IMG src="./template/admin/images/back1.png" width="80" height="25" border="0"></A></span>
</div></td></tr>  
  <tr>
	<td class="">
<form method="get" name="session_search" action="admin.php?controller=admin_reports&action=doreport_search_diy_edit" >
<input type="hidden" name="controller" value="admin_reports" />
<input type="hidden" name="action" value="doreport_search_diy_edit" />
				<table bordercolor="white" cellspacing="0" cellpadding="0" border="0" width="100%"  class="BBtable">
					<tr>
						<th class="list_bg" colspan="2"> </th>
					</tr>
					<?php $this->assign('trnumber', 0); ?>		
					<tr  <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" width="30%" align="right">报表类型：</td>
						<td class="td_line" width="70%">
						<select width="30"  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevel(this.value)" style="width:100px">
							<OPTION VALUE="1">权限报表</option>	
							<OPTION VALUE="2">登录报表</option>
							<OPTION VALUE="3">操作报表</option>
							<OPTION VALUE="4">违规报表</option>
						</select>
						&nbsp;&nbsp;<select width="30" class="wbk"  name="type" id="ldapid2" style="width:100px">
						</select>
						</td>
					</tr>
					<tr  <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" width="30%" rowspan="2" align="right" >时间选择：</td>
						<td class="td_line" width="70%">
							&nbsp;&nbsp;开始时间：<input type="text" class="wbk" name="f_rangeStart" size="16" id="f_rangeStart" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeStart'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
							<input type="button" onclick="changetype('day')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
						</td>
					</tr>
					<tr  <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" width="70%">
							&nbsp;&nbsp;结束时间：<input type="text" class="wbk" name="f_rangeEnd" size="16" id="f_rangeEnd" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeStart'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
							<input type="button" onclick="changetype('day')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
						</td>
					</tr>
					<tr  <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" width="30%" align="right" >生成时间：</td>
						<td class="td_line" width="70%">
							<input type="text" class="wbk" name="f_rangeCreate" size="16" id="f_rangeCreate" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeStart'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
							<input type="button" onclick="changetype('day')" id="f_rangeCreate_trigger" name="f_rangeCreate_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
						</td>
					</tr>
					<tr  <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" colspan="2" align="center"><input name="submit" type="submit" onclick="setScroll();"  value=" 提 交 " class="an_02">
					</tr>
				</table>
				
			</form>
	</td>
  </tr>
</table>

  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d");
cal.manageFields("f_rangeEnd_trigger", "f_rangeEnd", "%Y-%m-%d");
cal.manageFields("f_rangeCreate_trigger", "f_rangeCreate", "%Y-%m-%d %H:%M:%S");
</script>
<script>
changelevel('1');
</script>
