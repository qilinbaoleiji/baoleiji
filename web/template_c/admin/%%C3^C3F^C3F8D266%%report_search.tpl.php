<?php /* Smarty version 2.6.18, created on 2014-06-23 21:02:23
         compiled from report_search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_search.tpl', 137, false),)), $this); ?>
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
			ldapid2.options[ldapid2.options.length] = new Option('告警统计', 'dangercmd_statistic');
			ldapid2.options[ldapid2.options.length] = new Option('告警操作', 'dangercmdlist_statistic');
		break;
	}
}

function changetype(val){
	var inputs = document.getElementsByTagName('input');
	for(var i=0; i<inputs.length; i++){
		if(inputs[i].type=='radio' && inputs[i].value==val){
			inputs[i].checked = true;
		}
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
    <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search">定期报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=report_search_diy">自定义报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>  
  <tr>
	<td class="">
<form method="get" name="session_search" action="admin.php?controller=admin_reports&action=doreport_search" >
<input type="hidden" name="controller" value="admin_reports" />
<input type="hidden" name="action" value="doreport_search" />
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
							<OPTION VALUE="4">告警报表</option>
						</select>
						&nbsp;&nbsp;<select width="30" class="wbk"  name="type" id="ldapid2" style="width:100px">
						</select>
						</td>
					</tr>
					<tr  <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td class="td_line" width="30%" rowspan="3" align="right" >时间选择：</td>
						<td class="td_line" width="70%">
							按月：<input name="dateinterval" type="radio" class="wbk" checked onclick="changetype('month')" value="month">
							&nbsp;&nbsp;年:<select width="30" class="wbk" onclick="changetype('month')"  name="myear" style="width:100px">
							<?php unset($this->_sections['my']);
$this->_sections['my']['name'] = 'my';
$this->_sections['my']['loop'] = is_array($_loop=$this->_tpl_vars['years']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['my']['show'] = true;
$this->_sections['my']['max'] = $this->_sections['my']['loop'];
$this->_sections['my']['step'] = 1;
$this->_sections['my']['start'] = $this->_sections['my']['step'] > 0 ? 0 : $this->_sections['my']['loop']-1;
if ($this->_sections['my']['show']) {
    $this->_sections['my']['total'] = $this->_sections['my']['loop'];
    if ($this->_sections['my']['total'] == 0)
        $this->_sections['my']['show'] = false;
} else
    $this->_sections['my']['total'] = 0;
if ($this->_sections['my']['show']):

            for ($this->_sections['my']['index'] = $this->_sections['my']['start'], $this->_sections['my']['iteration'] = 1;
                 $this->_sections['my']['iteration'] <= $this->_sections['my']['total'];
                 $this->_sections['my']['index'] += $this->_sections['my']['step'], $this->_sections['my']['iteration']++):
$this->_sections['my']['rownum'] = $this->_sections['my']['iteration'];
$this->_sections['my']['index_prev'] = $this->_sections['my']['index'] - $this->_sections['my']['step'];
$this->_sections['my']['index_next'] = $this->_sections['my']['index'] + $this->_sections['my']['step'];
$this->_sections['my']['first']      = ($this->_sections['my']['iteration'] == 1);
$this->_sections['my']['last']       = ($this->_sections['my']['iteration'] == $this->_sections['my']['total']);
?>
							<option value=<?php echo $this->_tpl_vars['years'][$this->_sections['my']['index']]; ?>
><?php echo $this->_tpl_vars['years'][$this->_sections['my']['index']]; ?>
</option>
							<?php endfor; endif; ?>
							</select>
							&nbsp;&nbsp;月:<select width="30" class="wbk" onclick="changetype('month')"  name="mmonth" style="width:100px">
							<?php unset($this->_sections['mm']);
$this->_sections['mm']['name'] = 'mm';
$this->_sections['mm']['loop'] = is_array($_loop=12) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mm']['show'] = true;
$this->_sections['mm']['max'] = $this->_sections['mm']['loop'];
$this->_sections['mm']['step'] = 1;
$this->_sections['mm']['start'] = $this->_sections['mm']['step'] > 0 ? 0 : $this->_sections['mm']['loop']-1;
if ($this->_sections['mm']['show']) {
    $this->_sections['mm']['total'] = $this->_sections['mm']['loop'];
    if ($this->_sections['mm']['total'] == 0)
        $this->_sections['mm']['show'] = false;
} else
    $this->_sections['mm']['total'] = 0;
if ($this->_sections['mm']['show']):

            for ($this->_sections['mm']['index'] = $this->_sections['mm']['start'], $this->_sections['mm']['iteration'] = 1;
                 $this->_sections['mm']['iteration'] <= $this->_sections['mm']['total'];
                 $this->_sections['mm']['index'] += $this->_sections['mm']['step'], $this->_sections['mm']['iteration']++):
$this->_sections['mm']['rownum'] = $this->_sections['mm']['iteration'];
$this->_sections['mm']['index_prev'] = $this->_sections['mm']['index'] - $this->_sections['mm']['step'];
$this->_sections['mm']['index_next'] = $this->_sections['mm']['index'] + $this->_sections['mm']['step'];
$this->_sections['mm']['first']      = ($this->_sections['mm']['iteration'] == 1);
$this->_sections['mm']['last']       = ($this->_sections['mm']['iteration'] == $this->_sections['mm']['total']);
?>
							<option value=<?php echo $this->_sections['mm']['index']+1; ?>
><?php echo $this->_sections['mm']['index']+1; ?>
</option>
							<?php endfor; endif; ?>
							</select>
						</td>
					</tr>
					<tr >					
						<td class="td_line" width="70%">
							按周：<input name="dateinterval" type="radio" class="wbk" value="week">
							&nbsp;&nbsp;年:<select width="30" class="wbk" onclick="changetype('week')"  name="wyear" style="width:100px">
							<?php unset($this->_sections['wy']);
$this->_sections['wy']['name'] = 'wy';
$this->_sections['wy']['loop'] = is_array($_loop=$this->_tpl_vars['years']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['wy']['show'] = true;
$this->_sections['wy']['max'] = $this->_sections['wy']['loop'];
$this->_sections['wy']['step'] = 1;
$this->_sections['wy']['start'] = $this->_sections['wy']['step'] > 0 ? 0 : $this->_sections['wy']['loop']-1;
if ($this->_sections['wy']['show']) {
    $this->_sections['wy']['total'] = $this->_sections['wy']['loop'];
    if ($this->_sections['wy']['total'] == 0)
        $this->_sections['wy']['show'] = false;
} else
    $this->_sections['wy']['total'] = 0;
if ($this->_sections['wy']['show']):

            for ($this->_sections['wy']['index'] = $this->_sections['wy']['start'], $this->_sections['wy']['iteration'] = 1;
                 $this->_sections['wy']['iteration'] <= $this->_sections['wy']['total'];
                 $this->_sections['wy']['index'] += $this->_sections['wy']['step'], $this->_sections['wy']['iteration']++):
$this->_sections['wy']['rownum'] = $this->_sections['wy']['iteration'];
$this->_sections['wy']['index_prev'] = $this->_sections['wy']['index'] - $this->_sections['wy']['step'];
$this->_sections['wy']['index_next'] = $this->_sections['wy']['index'] + $this->_sections['wy']['step'];
$this->_sections['wy']['first']      = ($this->_sections['wy']['iteration'] == 1);
$this->_sections['wy']['last']       = ($this->_sections['wy']['iteration'] == $this->_sections['wy']['total']);
?>
							<option value=<?php echo $this->_tpl_vars['years'][$this->_sections['wy']['index']]; ?>
><?php echo $this->_tpl_vars['years'][$this->_sections['wy']['index']]; ?>
</option>
							<?php endfor; endif; ?>
							</select>
							&nbsp;&nbsp;月:<select width="30" class="wbk" onclick="changetype('week')"  name="wmonth" style="width:100px">
							<?php unset($this->_sections['wm']);
$this->_sections['wm']['name'] = 'wm';
$this->_sections['wm']['loop'] = is_array($_loop=12) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['wm']['show'] = true;
$this->_sections['wm']['max'] = $this->_sections['wm']['loop'];
$this->_sections['wm']['step'] = 1;
$this->_sections['wm']['start'] = $this->_sections['wm']['step'] > 0 ? 0 : $this->_sections['wm']['loop']-1;
if ($this->_sections['wm']['show']) {
    $this->_sections['wm']['total'] = $this->_sections['wm']['loop'];
    if ($this->_sections['wm']['total'] == 0)
        $this->_sections['wm']['show'] = false;
} else
    $this->_sections['wm']['total'] = 0;
if ($this->_sections['wm']['show']):

            for ($this->_sections['wm']['index'] = $this->_sections['wm']['start'], $this->_sections['wm']['iteration'] = 1;
                 $this->_sections['wm']['iteration'] <= $this->_sections['wm']['total'];
                 $this->_sections['wm']['index'] += $this->_sections['wm']['step'], $this->_sections['wm']['iteration']++):
$this->_sections['wm']['rownum'] = $this->_sections['wm']['iteration'];
$this->_sections['wm']['index_prev'] = $this->_sections['wm']['index'] - $this->_sections['wm']['step'];
$this->_sections['wm']['index_next'] = $this->_sections['wm']['index'] + $this->_sections['wm']['step'];
$this->_sections['wm']['first']      = ($this->_sections['wm']['iteration'] == 1);
$this->_sections['wm']['last']       = ($this->_sections['wm']['iteration'] == $this->_sections['wm']['total']);
?>
							<option value=<?php echo $this->_sections['wm']['index']+1; ?>
><?php echo $this->_sections['wm']['index']+1; ?>
</option>
							<?php endfor; endif; ?>
							</select>
							&nbsp;&nbsp;第:<select width="30" class="wbk" onclick="changetype('week')" name="wweek" style="width:100px">
							<?php unset($this->_sections['ww']);
$this->_sections['ww']['name'] = 'ww';
$this->_sections['ww']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ww']['show'] = true;
$this->_sections['ww']['max'] = $this->_sections['ww']['loop'];
$this->_sections['ww']['step'] = 1;
$this->_sections['ww']['start'] = $this->_sections['ww']['step'] > 0 ? 0 : $this->_sections['ww']['loop']-1;
if ($this->_sections['ww']['show']) {
    $this->_sections['ww']['total'] = $this->_sections['ww']['loop'];
    if ($this->_sections['ww']['total'] == 0)
        $this->_sections['ww']['show'] = false;
} else
    $this->_sections['ww']['total'] = 0;
if ($this->_sections['ww']['show']):

            for ($this->_sections['ww']['index'] = $this->_sections['ww']['start'], $this->_sections['ww']['iteration'] = 1;
                 $this->_sections['ww']['iteration'] <= $this->_sections['ww']['total'];
                 $this->_sections['ww']['index'] += $this->_sections['ww']['step'], $this->_sections['ww']['iteration']++):
$this->_sections['ww']['rownum'] = $this->_sections['ww']['iteration'];
$this->_sections['ww']['index_prev'] = $this->_sections['ww']['index'] - $this->_sections['ww']['step'];
$this->_sections['ww']['index_next'] = $this->_sections['ww']['index'] + $this->_sections['ww']['step'];
$this->_sections['ww']['first']      = ($this->_sections['ww']['iteration'] == 1);
$this->_sections['ww']['last']       = ($this->_sections['ww']['iteration'] == $this->_sections['ww']['total']);
?>
							<option value=<?php echo $this->_sections['ww']['index']+1; ?>
><?php echo $this->_sections['ww']['index']+1; ?>
</option>
							<?php endfor; endif; ?>
							</select>周
						</td>
					</tr>
					<tr>					
						<td class="td_line" width="70%">
							按日：<input name="dateinterval" type="radio" class="wbk" value="day">
							&nbsp;&nbsp;<input type="text" class="wbk" onclick="changetype('day')" name="dday" size="16" id="f_rangeStart" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['f_rangeStart'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" />
							<input type="button" onclick="changetype('day')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="<?php echo $this->_tpl_vars['language']['Edittime']; ?>
"  class="wbk">
						</td>
					</tr>
					
					<tr bgcolor="f7f7f7">
						<td class="td_line" colspan="2" align="center"><input name="submit" type="submit" onclick="setScroll();"  value="<?php echo $this->_tpl_vars['language']['Search']; ?>
" class="an_02">
					</tr>
				</table>
				
			</form>
	</td>
  </tr>
</table>

  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: false
});
cal.manageFields("f_rangeStart_trigger", "f_rangeStart", "%Y-%m-%d");
</script>
<script>
changelevel('1');
</script>
