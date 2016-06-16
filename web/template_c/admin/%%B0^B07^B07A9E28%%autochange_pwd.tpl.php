<?php /* Smarty version 2.6.18, created on 2014-04-26 16:20:39
         compiled from autochange_pwd.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=default_policy">策略设置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sourceip">来源IP组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=weektime">周组策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=forbidden_groups_list">命令权限</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=autochange_pwd">自动改密</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_forbidden&action=cmdgroup_list">命令组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=systemtype">系统类型</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl">授权策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
	

  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="5"  class="BBtable">
          <form name="f1" method=post action="admin.php?controller=admin_config&action=autochange_pwd&id=<?php echo $this->_tpl_vars['defaultp']['id']; ?>
">
	<tr><th colspan="3" class="list_bg"></th></tr>
<?php $this->assign('trnumber', 0); ?>
					
		<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD width="33%" align=right>最小长度 </TD>
                  <TD><input type="text" class="wbk" name="minlen" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['minlen']; ?>
">
				  </TD>
                </TR>
				 <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
                <TR>
                  <TD width="33%" align=right>最少字母数 </TD>
                  <TD><input type="text" class="wbk" name="minalpha" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['minalpha']; ?>
">                
				  </TD>
                </TR>
               <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD width="33%" align=right>最少其它字符数 </TD>
                  <TD><input type="text" class="wbk" name="minother" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['minother']; ?>
">                
				  </TD>
                </TR>
                <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td align=right>与旧口令最少不同字符</td>
						<td><input type="text" class="wbk" name="mindiff" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['mindiff']; ?>
"></td>
					</tr>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
                  <TD  align=right>密码最大重复字符数 </TD>
                  <TD><input type="text" class="wbk" name="maxrepeats" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['maxrepeats']; ?>
">               
				  </TD>
                </TR>
               <?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>记录旧密码时间 </TD>
                  <TD width="67%"><input type="text" class="wbk" name="histexpire" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['histexpire']; ?>
">单位：天</TD>
                </TR>    
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<TD width="33%" align=right>记录旧密码次数 </TD>
                  <TD width="67%"><input type="text" class="wbk" name="histsize" class="input_shorttext" value="<?php echo $this->_tpl_vars['defaultp']['histsize']; ?>
">                  </TD>
                </TR>    
                </div></td></tr>
				  <TR >
<tr>
<td align="center" colspan=2>
<input type="hidden" name="ac" value="<?php if ($this->_tpl_vars['defaultp']): ?>edit<?php else: ?>new<?php endif; ?>" />
<input type=submit  value="保存修改" class="an_02">

	</td>
  </tr></form>
</table>

</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


