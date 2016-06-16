<?php /* Smarty version 2.6.18, created on 2014-05-13 01:37:32
         compiled from license.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['SessionsList']; ?>
</title>
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

	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_index&action=license">License</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>
  <tr>
	<td class="">
		<table bordercolor="white" cellspacing="1" cellpadding="5" border="0" width="100%"  class="BBtable">
					<tr>
						<th class="list_bg"  bgcolor="d9ecfa" width="5%"><a href="admin.php?controller=admin_index&action=license&orderby1=deadline&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['deaddate']; ?>
</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_index&action=license&orderby1=equipnum&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['devicenumber']; ?>
</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="5%"><a href="admin.php?controller=admin_index&action=license&orderby1=company&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" >Licenses 网卡名称:</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="5%"><a href="admin.php?controller=admin_index&action=license&orderby1=company&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['authorizer']; ?>
</a></th>
						<th class="list_bg"  bgcolor="d9ecfa" width="10%"><a href="admin.php?controller=admin_index&action=license&orderby1=key&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
" ><?php echo $this->_tpl_vars['language']['seriesnumber']; ?>
</a></th>
					</tr>
					<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['license']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
<tr <?php if ($this->_sections['l']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
<td><?php echo $this->_tpl_vars['license'][$this->_sections['l']['index']]['deadline']; ?>
</td>
<td><?php echo $this->_tpl_vars['license'][$this->_sections['l']['index']]['equipnum']; ?>
</td>
<td><select name='license' id="license">
		<?php unset($this->_sections['e']);
$this->_sections['e']['name'] = 'e';
$this->_sections['e']['loop'] = is_array($_loop=$this->_tpl_vars['eths']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['e']['show'] = true;
$this->_sections['e']['max'] = $this->_sections['e']['loop'];
$this->_sections['e']['step'] = 1;
$this->_sections['e']['start'] = $this->_sections['e']['step'] > 0 ? 0 : $this->_sections['e']['loop']-1;
if ($this->_sections['e']['show']) {
    $this->_sections['e']['total'] = $this->_sections['e']['loop'];
    if ($this->_sections['e']['total'] == 0)
        $this->_sections['e']['show'] = false;
} else
    $this->_sections['e']['total'] = 0;
if ($this->_sections['e']['show']):

            for ($this->_sections['e']['index'] = $this->_sections['e']['start'], $this->_sections['e']['iteration'] = 1;
                 $this->_sections['e']['iteration'] <= $this->_sections['e']['total'];
                 $this->_sections['e']['index'] += $this->_sections['e']['step'], $this->_sections['e']['iteration']++):
$this->_sections['e']['rownum'] = $this->_sections['e']['iteration'];
$this->_sections['e']['index_prev'] = $this->_sections['e']['index'] - $this->_sections['e']['step'];
$this->_sections['e']['index_next'] = $this->_sections['e']['index'] + $this->_sections['e']['step'];
$this->_sections['e']['first']      = ($this->_sections['e']['iteration'] == 1);
$this->_sections['e']['last']       = ($this->_sections['e']['iteration'] == $this->_sections['e']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['eths'][$this->_sections['e']['index']]['name']; ?>
" <?php if ($this->_tpl_vars['eths'][$this->_sections['e']['index']]['name'] == $this->_tpl_vars['device']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['eths'][$this->_sections['e']['index']]['name']; ?>
</option>
		<?php endfor; endif; ?>
		</select> </td>
<td><?php echo $this->_tpl_vars['license'][$this->_sections['l']['index']]['company']; ?>
</td>
<td><?php echo $this->_tpl_vars['license'][$this->_sections['l']['index']]['key']; ?>
</td>
</tr>
<?php endfor; endif; ?>
	<tr><td  align="left"><input type="button" onclick="window.location='admin.php?controller=admin_index&action=upload_license'"  name="add"  value="上传" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.open('admin.php?controller=admin_index&action=create_license&ld='+document.getElementById('license').options[document.getElementById('license').options.selectedIndex].value,'newwindow', 'height=200, width=200, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no')"  name="add"  value="生成" class="an_02"></td>
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
	</table>
	</td>
  </tr>
</table>
<script>
function createlicense(){

}
</script>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</body>
</html>

