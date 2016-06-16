<?php /* Smarty version 2.6.18, created on 2014-04-26 09:53:03
         compiled from ifgeth.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'ifgeth.tpl', 54, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>服务<?php echo $this->_tpl_vars['language']['List']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
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
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ifcfgeth">网络配置</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=config_route">静态路由</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=ping">PING</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
  <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=tracepath">TRACE</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
 <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
			<tr>
				<th class="list_bg"  width="15%">网卡名称</th>                            
				<th class="list_bg"  width="20%">启用</th>
				<th class="list_bg"  width="10%">网卡IP</th>
				<th class="list_bg"  width="10%">掩码</th>
				<th class="list_bg"  width="10%">网关</th>
				<th class="list_bg"  width="10%">状态</th>
				<th class="list_bg"  width=""><?php echo $this->_tpl_vars['language']['Operate']; ?>
</th>
			</tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if (! $this->_tpl_vars['files'][$this->_sections['t']['index']]['lo']): ?>
				<tr <?php if ($this->_tpl_vars['files'][$this->_sections['t']['index']]['backup']): ?>bgcolor="red"<?php elseif ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
					<td><?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['name']; ?>
</td>
					<td><?php if ($this->_tpl_vars['files'][$this->_sections['t']['index']]['ONBOOT'] == 1): ?><font color="green">启用</font><?php else: ?>禁用<?php endif; ?></ td>
					<td><?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['IPADDR']; ?>
</td>
					<td><?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['NETMASK']; ?>
</td>
					<td><?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['GATEWAY']; ?>
</td>
					<td><?php if ($this->_tpl_vars['files'][$this->_sections['t']['index']]['STATUS'] == 'yes'): ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/Green.gif" ><?php else: ?><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/hong.gif" ><?php endif; ?></td>
					<td>
					<?php if ($this->_tpl_vars['files'][$this->_sections['t']['index']]['lo'] != 1): ?><img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_eth&action=config_eth&file=<?php echo ((is_array($_tmp=$this->_tpl_vars['files'][$this->_sections['t']['index']]['file'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&name=<?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['name']; ?>
">修改</a>
					<?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp; 
					<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/chart_organisation.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href="admin.php?controller=admin_eth&action=ifcfg_br&file=<?php echo ((is_array($_tmp=$this->_tpl_vars['files'][$this->_sections['t']['index']]['file'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&name=<?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['name']; ?>
&filename=<?php echo $this->_tpl_vars['files'][$this->_sections['t']['index']]['filename']; ?>
">网卡绑定</a>
					</td>
				</tr>
				<?php endif; ?>
			<?php endfor; endif; ?>			
		</table>
	</td>
  </tr>
</table>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

