<?php /* Smarty version 2.6.18, created on 2014-05-02 22:57:43
         compiled from vpn_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'vpn_list.tpl', 45, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>路由列表</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
</head>
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
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_eth&action=vpn_list">VPN -策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
	<td class=""><table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%" class="BBtable">
		<tr bgcolor="#F3F8FC">
			<th class="list_bg"  width="5%" align="center" bgcolor="#E0EDF8"><b>选择</b></th>
			<th class="list_bg"  width="25%" align="center" bgcolor="#E0EDF8"><b>来源地址段</b></th>
			<th class="list_bg"  width="25%" align="center" bgcolor="#E0EDF8"><b>目标地址段</b></th>
			<th class="list_bg"  width="25%" align="center" bgcolor="#E0EDF8"><b>映射IP</b></th>
			<th class="list_bg"  width="" align="center" bgcolor="#E0EDF8"><b>操作</b></th>
		</tr>		
		<form name="ip_list" action="admin.php?controller=admin_eth&action=vpn_delete" method="post">
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['routes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td width="10%"><input type="checkbox" name="chk_gid[]" value="<?php echo $this->_tpl_vars['routes'][$this->_sections['t']['index']]['p_addr']; ?>
"></td>
			<td ><?php echo $this->_tpl_vars['routes'][$this->_sections['t']['index']]['s_addr']; ?>
</td>
			<td ><?php echo $this->_tpl_vars['routes'][$this->_sections['t']['index']]['d_addr']; ?>
</td>
			<td ><?php echo $this->_tpl_vars['routes'][$this->_sections['t']['index']]['p_addr']; ?>
</td>
			<td  align="left"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/edit_ico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_eth&action=vpn_edit&p_addr=<?php echo $this->_tpl_vars['routes'][$this->_sections['t']['index']]['p_addr']; ?>
">编辑</a>
				| <img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/cross.png" width="16" height="16" hspace="5" border="0" align="absmiddle"><a href="admin.php?controller=admin_eth&action=vpn_delete&p_addr=<?php echo ((is_array($_tmp=$this->_tpl_vars['routes'][$this->_sections['t']['index']]['p_addr'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
">删除</a></td>
		</tr>
		<?php endfor; endif; ?>
                <tr>           
      <td colspan="5" ><input name="select_all" type="checkbox" onclick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_gid[]')e.checked=this.form.select_all.checked;}" value="checkbox">选中本页显示的所有项目&nbsp;&nbsp;<input type="submit"  value="删除选中" onclick="my_confirm('删除所选IP');if(chk_form()) document.ip_list.action='admin.php?controller=admin_eth&action=vpn_delete'; else return false;" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input  type="button" onclick="window.location='admin.php?controller=admin_eth&action=vpn_edit'" value=" 增加 " class="an_02"></td>
     
		</tr>
		</form>
		</table>
	</td>
  </tr>
</table>

<script language="javascript">

function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>


