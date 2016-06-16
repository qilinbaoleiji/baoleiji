<?php /* Smarty version 2.6.18, created on 2014-07-01 16:16:20
         compiled from tools_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'tools_list.tpl', 53, false),)), $this); ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
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
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=tool_list">工具下载</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <?php if ($this->_tpl_vars['usbkeyshow'] == 1): ?>
  <tr>
  	<td class="">
  	
  		<a href="admin.php?controller=admin_index&action=download_usbkeyfile" >口令证书下载</a>
  	
  	</td>
  </tr>
  <?php endif; ?>
  <tr>
	<td class=""><TABLE border=0 cellSpacing=1 cellPadding=5 
                                width="100%" bgColor=#ffffff valign="top" class="BBtable">

                <TBODY>
                  <TR>

					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['ToolsName']; ?>
</TD>
					<th class="list_bg" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
</TD>
                  </TR>

            </tr>
			<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['allTools']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr  <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
 <td> <?php echo $this->_tpl_vars['allTools'][$this->_sections['t']['index']]['name']; ?>
</td>
				<td>									
				<img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/down.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_index&action=tool_down&name=<?php echo ((is_array($_tmp=$this->_tpl_vars['allTools'][$this->_sections['t']['index']]['name'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
'><?php echo $this->_tpl_vars['language']['Download']; ?>
</a><?php if ($_SESSION['ADMIN_USERNAME'] == 'admin'): ?> | <img src='<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif' width=16 height='16' hspace='5' border='0' align='absmiddle'><a href='admin.php?controller=admin_index&action=tool_delete&name=<?php echo ((is_array($_tmp=$this->_tpl_vars['allTools'][$this->_sections['t']['index']]['name'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
'>删除</a><?php endif; ?>
				</td> 
			</tr>
			<?php endfor; endif; ?>
<tr><td  align="left"><?php if ($_SESSION['ADMIN_USERNAME'] == 'admin'): ?><input type="button" onclick="window.location='admin.php?controller=admin_index&action=upload_tool'"  name="add" value="上传文件" class="an_02"><?php endif; ?></td>
		<td  colspan="5" align="right">
			<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
<?php echo $this->_tpl_vars['language']['Recorder']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&action=keys_index&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
		</TBODY>
              </TABLE>

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


