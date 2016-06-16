<?php /* Smarty version 2.6.18, created on 2014-05-02 22:57:02
         compiled from cronreports.tpl */ ?>
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
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=configreport">报表配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cronreports">报表自动生成配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=downloadcronreport">下载报表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	 <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_reports&action=cmdcache">命令Cache</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="5"  class="BBtable">
		<form name="f1" method=post action="admin.php?controller=admin_reports&action=cronreports">
          <tr><th colspan="2" class="list_bg">&nbsp;</th></tr>
<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>周发送的报表 </TD>
                  <TD width="67%"><INPUT <?php if ($this->_tpl_vars['defaultp']['week_commandreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[]  value="commandreport">命令统计
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['week_appreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[] value="appreport">应用报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['week_sftpreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[] value="sftpreport">SFTP命令报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['week_ftpreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[] value="ftpreport">FTP命令报表<br />
					<INPUT <?php if ($this->_tpl_vars['defaultp']['week_dangercmdreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[] value="dangercmdreport">违规报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['week_logintims'] == 1): ?> checked <?php endif; ?> type=checkbox name=week[] value="logintims">登录统计
										</TD>
                </TR>
                <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
	<tr <?php if ($this->_tpl_vars['trnumber']++ % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>月发送的报表 </TD>
                  <TD width="67%"><INPUT <?php if ($this->_tpl_vars['defaultp']['month_commandreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[]  value="commandreport">命令报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['month_appreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[] value="appreport">应用报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['month_sftpreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[] value="sftpreport">SFTP命令报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['month_ftpreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[] value="ftpreport">FTP命令报表<br />
					<INPUT <?php if ($this->_tpl_vars['defaultp']['month_dangercmdreport'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[] value="dangercmdreport">违规报表
					&nbsp;&nbsp;<INPUT <?php if ($this->_tpl_vars['defaultp']['month_logintims'] == 1): ?> checked <?php endif; ?> type=checkbox name=month[] value="logintims">登录统计
										</TD>
                </TR>
				  <TR >
<tr>
<td align="center" colspan=2>
<input type=button onclick="document.getElementById('hide').src='admin.php?controller=admin_reports&action=docronreports'"  value="生成报表" class="an_02">&nbsp;&nbsp;
<input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['defaultp']): ?>edit<?php else: ?>new<?php endif; ?>" />
<input type=submit  value="保存修改" class="an_02">

</td></tr>
</form>
	</table>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


