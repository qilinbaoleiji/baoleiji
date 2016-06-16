<?php /* Smarty version 2.6.18, created on 2014-06-28 22:09:49
         compiled from default_policy.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/Calendarandtime.js"></script>
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
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=default_policy">策略设置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php endif; ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sourceip">来源IP组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=weektime">周组策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=forbidden_groups_list">命令权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=autochange_pwd">自动改密</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=cmdgroup_list">命令组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>	
	<?php endif; ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl">授权策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>

</ul>
</div></td></tr>
	

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="5"  class="BBtable">

		<form name="f1" method=post action="admin.php?controller=admin_config&action=default_policy&id=<?php echo $this->_tpl_vars['defaultp']['id']; ?>
">
          <tr><th colspan="3" class="list_bg"></th></tr>
<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>自动登录为超级用户 </TD>
                  <TD width="67%"><INPUT id="autosu" <?php if ($this->_tpl_vars['defaultp']['autosu'] == 1): ?> checked <?php endif; ?> type=checkbox name=autosu value="on">                  </TD>
                </TR>
                <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>是否登录时进行syslog告警 </TD>
                  <TD width="67%"><INPUT id="syslogalert" <?php if ($this->_tpl_vars['defaultp']['syslogalert'] == 1): ?> checked <?php endif; ?> type=checkbox name=syslogalert value="on">                  </TD>
                </TR>
                <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>是否登录时发送邮件进行告警</TD>
                  <TD width="67%"><INPUT id="mailalert" <?php if ($this->_tpl_vars['defaultp']['mailalert'] == 1): ?> checked <?php endif; ?> type=checkbox name=mailalert value="on">                  </TD>
                </TR>
             <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>账号是否被锁定 </TD>
                  <TD width="67%"><INPUT id="loginlock" <?php if ($this->_tpl_vars['defaultp']['loginlock'] == 1): ?> checked <?php endif; ?> type=checkbox name=loginlock value="on">                  </TD>
                </TR>
     <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
		<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD width="33%" align=right>周组策略 </TD>
                  <TD><select  class="wbk"  name=weektime>
                      <OPTION value="">无</OPTION>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['weektime']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname']; ?>
" <?php if ($this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname'] == $this->_tpl_vars['defaultp']['weektime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>                  
				  </TD>
                </TR>
                <TR>
                  <TD width="33%" align=right>来源IP组 </TD>
                  <TD><select  class="wbk"  name=sourceip>
                      <OPTION value="">无</OPTION>
                     	<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['sourceip']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname']; ?>
" <?php if ($this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname'] == $this->_tpl_vars['defaultp']['sourceip']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>                  
				  </TD>
                </TR>
               <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD width="33%" align=right>命令权限 </TD>
                  <TD><select  class="wbk"  name=forbidden_commands_groups>
                      <OPTION value="">无</OPTION>
                     	<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['allforbiddengroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['f']['show'] = true;
$this->_sections['f']['max'] = $this->_sections['f']['loop'];
$this->_sections['f']['step'] = 1;
$this->_sections['f']['start'] = $this->_sections['f']['step'] > 0 ? 0 : $this->_sections['f']['loop']-1;
if ($this->_sections['f']['show']) {
    $this->_sections['f']['total'] = $this->_sections['f']['loop'];
    if ($this->_sections['f']['total'] == 0)
        $this->_sections['f']['show'] = false;
} else
    $this->_sections['f']['total'] = 0;
if ($this->_sections['f']['show']):

            for ($this->_sections['f']['index'] = $this->_sections['f']['start'], $this->_sections['f']['iteration'] = 1;
                 $this->_sections['f']['iteration'] <= $this->_sections['f']['total'];
                 $this->_sections['f']['index'] += $this->_sections['f']['step'], $this->_sections['f']['iteration']++):
$this->_sections['f']['rownum'] = $this->_sections['f']['iteration'];
$this->_sections['f']['index_prev'] = $this->_sections['f']['index'] - $this->_sections['f']['step'];
$this->_sections['f']['index_next'] = $this->_sections['f']['index'] + $this->_sections['f']['step'];
$this->_sections['f']['first']      = ($this->_sections['f']['iteration'] == 1);
$this->_sections['f']['last']       = ($this->_sections['f']['iteration'] == $this->_sections['f']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname']; ?>
" <?php if ($this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname'] == $this->_tpl_vars['defaultp']['forbidden_commands_groups']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname']; ?>
(<?php if ($this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['black_or_white']): ?>允许<?php else: ?>禁止<?php endif; ?>)</option>
			<?php endfor; endif; ?>
                  </SELECT>                  
				  </TD>
                </TR>
                <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td align=right>网络硬盘：</td>
						<td><input type="text" class="wbk" name="netdisksize" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['netdisksize']; ?>
">MB</td>
					</tr>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  align=right>默认控件 </TD>
                  <TD><select  class="wbk"  name=default_control>
                     <OPTION value="0" <?php if ($this->_tpl_vars['defaultp']['default_control'] == 0): ?>selected<?php endif; ?>>自动检测</OPTION>
                     <OPTION value="1" <?php if ($this->_tpl_vars['defaultp']['default_control'] == 1): ?>selected<?php endif; ?>>applet</OPTION>
                     <OPTION value="2" <?php if ($this->_tpl_vars['defaultp']['default_control'] == 2): ?>selected<?php endif; ?>>activeX</OPTION>
                  </SELECT>                  
				  </TD>
                </TR>
               <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>自动登录: </TD>
                  <TD width="67%"><INPUT id="entrust_password" <?php if ($this->_tpl_vars['defaultp']['entrust_password'] == 1): ?> checked <?php endif; ?> type=checkbox name=entrust_password value="on">                  </TD>
                </TR>    
                </div></td></tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>RDP磁盘映射: </TD>
                  <TD width="67%"><INPUT id="rdpdiskauth_up" <?php if ($this->_tpl_vars['defaultp']['rdpdiskauth_up'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpdiskauth_up value="on">                  </TD>
                </TR>    
                </div></td></tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>剪切板上行: </TD>
                  <TD width="67%"><INPUT id="rdpclipauth_up" <?php if ($this->_tpl_vars['defaultp']['rdpclipauth_up'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpclipauth_up value="on">                  </TD>
                </TR>    
                </div></td></tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>剪切板下行: </TD>
                  <TD width="67%"><INPUT id="rdpclipauth_down" <?php if ($this->_tpl_vars['defaultp']['rdpclipauth_down'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpclipauth_down value="on">                  </TD>
                </TR>    
                </div></td></tr>
				  <TR >
<tr>
<td align="center" colspan=2>
<input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['defaultp']): ?>edit<?php else: ?>new<?php endif; ?>" />
<input type=submit  value="保存修改" class="an_02">

</td></tr>
</form>
	</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


