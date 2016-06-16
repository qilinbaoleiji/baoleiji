<?php /* Smarty version 2.6.18, created on 2014-04-26 16:20:56
         compiled from loadbalance.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>主页面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
</head>

<body>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ssh">认证配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=config_ftp">系统参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=login_times">密码策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=ha">高可用性</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=syslog_mail_alarm">告警配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=status_warning">告警参数</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=loadbalance">负载均衡</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=loadbalance">
	
<tr>
				<th class="list_bg"  width="3%">选择</th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=loadbalance&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >IP</a></th>
				<th class="list_bg"  width="20%"><a href="admin.php?controller=admin_config&action=loadbalance&orderby1=hostname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >主机名</a></th>
				<th class="list_bg"  width="15%">操作</th>
			</tr>
			
			
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['lb']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			
			<tr <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
				<td><input type="checkbox" name="chk_sid[]" value="<?php echo $this->_tpl_vars['lb'][$this->_sections['t']['index']]['sid']; ?>
"></td>
				<td><?php echo $this->_tpl_vars['lb'][$this->_sections['t']['index']]['ip']; ?>
</td>
				<td><?php echo $this->_tpl_vars['lb'][$this->_sections['t']['index']]['hostname']; ?>
</td>
				<td>
				<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_config&action=loadbalance_edit&id=<?php echo $this->_tpl_vars['lb'][$this->_sections['t']['index']]['sid']; ?>
">编辑</a>
				 | <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_config&action=loadbalance&delete=<?php echo $this->_tpl_vars['lb'][$this->_sections['t']['index']]['sid']; ?>
">删除</a>
				</td>
			</tr>
			<?php endfor; endif; ?>
			
			<tr>
				<td colspan="2" align="left">
					<input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i < this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_sid[]')e.checked=this.form.select_all.checked;}" value="checkbox">选中本页显示的所有项目&nbsp;&nbsp;<input type="submit" name="delete"  value="删除选中" onclick="return confirm('删除所选IP');" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.location='admin.php?controller=admin_config&action=loadbalance_edit'"  name="add" value="添加" class="an_02">
						
				</td><input type="hidden" name="ac" value="delete" />
			</form>
			<form name="f1" method=post OnSubmit='return check()' action="admin.php?controller=admin_config&action=loadbalance">

				<td colspan="2" align="right">
					共<?php echo $this->_tpl_vars['command_num']; ?>
执行命令  <?php echo $this->_tpl_vars['page_list']; ?>
  页次：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
页  <?php echo $this->_tpl_vars['items_per_page']; ?>
条日志/页  转到第<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_config&action=loadbalance&page='+this.value;">页
				
				</td>
				</form>
			
			</tr>
			
			

		</table>
	</td>
  </tr>
</table>

</body>
</html>


