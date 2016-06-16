<?php /* Smarty version 2.6.18, created on 2014-06-27 13:59:19
         compiled from sshkey_list.tpl */ ?>
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
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_index">设备列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
    <?php if ($_SESSION['ADMIN_LEVEL'] != 10): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=dev_group">设备目录</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=resource_group">系统用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_pro&action=sshkey">SSH公私钥上传</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list">备份管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autobackup_list&type=run">巡检管理</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_autorun&action=autotemplate">巡检脚本</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul><span class="back_img"><A href="admin.php?controller=admin_pro&action=sshkey&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
 <style>
.ul{list-style-type:none; margin:0;width:100%; }
.ul li{ width:80px; float:left;}
</style>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>

            <td align="center"><form name="f1" method=post OnSubmit='return checkall("secend")' action="admin.php?controller=admin_pro&action=sshkey_list_save&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
	<tr><th colspan="3" class="list_bg"></th></tr>
	<tr bgcolor="f7f7f7">
		<td width="33%" align=right>
		SSH私钥
		</td>
		<td width="67%" colspan='2'>
		<?php echo $this->_tpl_vars['ginfo']['sshkeyname']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="groupid" onchange="changegroup(this.value);">
		<option value="0">所有</option>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['groupid'] == $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
	  </td>
	  </tr><tr>
	  <td width="33%" align=right>
		<select  class="wbk"  style="width:400;height:400;"  name="first" size="30" id="first" multiple="multiple" ondblclick="moveRight()">
		<?php unset($this->_sections['ra']);
$this->_sections['ra']['name'] = 'ra';
$this->_sections['ra']['loop'] = is_array($_loop=$this->_tpl_vars['resource']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ra']['show'] = true;
$this->_sections['ra']['max'] = $this->_sections['ra']['loop'];
$this->_sections['ra']['step'] = 1;
$this->_sections['ra']['start'] = $this->_sections['ra']['step'] > 0 ? 0 : $this->_sections['ra']['loop']-1;
if ($this->_sections['ra']['show']) {
    $this->_sections['ra']['total'] = $this->_sections['ra']['loop'];
    if ($this->_sections['ra']['total'] == 0)
        $this->_sections['ra']['show'] = false;
} else
    $this->_sections['ra']['total'] = 0;
if ($this->_sections['ra']['show']):

            for ($this->_sections['ra']['index'] = $this->_sections['ra']['start'], $this->_sections['ra']['iteration'] = 1;
                 $this->_sections['ra']['iteration'] <= $this->_sections['ra']['total'];
                 $this->_sections['ra']['index'] += $this->_sections['ra']['step'], $this->_sections['ra']['iteration']++):
$this->_sections['ra']['rownum'] = $this->_sections['ra']['iteration'];
$this->_sections['ra']['index_prev'] = $this->_sections['ra']['index'] - $this->_sections['ra']['step'];
$this->_sections['ra']['index_next'] = $this->_sections['ra']['index'] + $this->_sections['ra']['step'];
$this->_sections['ra']['first']      = ($this->_sections['ra']['iteration'] == 1);
$this->_sections['ra']['last']       = ($this->_sections['ra']['iteration'] == $this->_sections['ra']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['devicesid']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['memberid']; ?>
" title="<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['device_ip']; ?>
"><?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['device_ip']; ?>
</option>
		<?php endfor; endif; ?>
		<?php unset($this->_sections['rr']);
$this->_sections['rr']['name'] = 'rr';
$this->_sections['rr']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rr']['show'] = true;
$this->_sections['rr']['max'] = $this->_sections['rr']['loop'];
$this->_sections['rr']['step'] = 1;
$this->_sections['rr']['start'] = $this->_sections['rr']['step'] > 0 ? 0 : $this->_sections['rr']['loop']-1;
if ($this->_sections['rr']['show']) {
    $this->_sections['rr']['total'] = $this->_sections['rr']['loop'];
    if ($this->_sections['rr']['total'] == 0)
        $this->_sections['rr']['show'] = false;
} else
    $this->_sections['rr']['total'] = 0;
if ($this->_sections['rr']['show']):

            for ($this->_sections['rr']['index'] = $this->_sections['rr']['start'], $this->_sections['rr']['iteration'] = 1;
                 $this->_sections['rr']['iteration'] <= $this->_sections['rr']['total'];
                 $this->_sections['rr']['index'] += $this->_sections['rr']['step'], $this->_sections['rr']['iteration']++):
$this->_sections['rr']['rownum'] = $this->_sections['rr']['iteration'];
$this->_sections['rr']['index_prev'] = $this->_sections['rr']['index'] - $this->_sections['rr']['step'];
$this->_sections['rr']['index_next'] = $this->_sections['rr']['index'] + $this->_sections['rr']['step'];
$this->_sections['rr']['first']      = ($this->_sections['rr']['iteration'] == 1);
$this->_sections['rr']['last']       = ($this->_sections['rr']['iteration'] == $this->_sections['rr']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['devicesid']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['memberid']; ?>
" title="<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['device_ip']; ?>
" move="no"><?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['rr']['index']]['device_ip']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		</td>
		<td width="10%">
		<div class="select_move_2">
                <input type="button" value="添加-->" onclick="moveRight()"/><br />
                <input type="button" value="<--删除"  onclick="moveLeft()"/><br />
          </div>
         </td>
         <td>
		<select  class="wbk"   style="width:400;height:400;" size="30" id="secend" name="secend[]" multiple="multiple">
		<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['devicesid']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['memberid']; ?>
" title="<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['device_ip']; ?>
" selected><?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['uname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['lmname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['device_ip']; ?>
</option>
		<?php endfor; endif; ?>
   		</select>
	  </td>
	</tr>
	</table>
<br>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['ginfo']['id']; ?>
">
<input type="hidden" name="oldgname" value="<?php echo $this->_tpl_vars['ginfo']['groupname']; ?>
">
<input type="submit"  value="保存" class="an_02">
</form>
	</td>
  </tr>
</table>

<script language="javascript">
var changed = false;
function my_confirm(str){
	if(!confirm(str + "？"))
	{
		window.event.returnValue = false;
	}
}

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

function changegroup(value){
	if(changed){
		if(confirm('确定要放弃更改?')){
			window.location='admin.php?controller=admin_pro&action=sshkey_list&groupid='+value+'&gname=<?php echo $this->_tpl_vars['ginfo']['groupname']; ?>
&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
';
		}
	}else{
		window.location='admin.php?controller=admin_pro&action=sshkey_list&groupid='+value+'&gname=<?php echo $this->_tpl_vars['ginfo']['groupname']; ?>
&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
';
	}
}


</script>
<script type="text/javascript" >

	
	/**选中的元素向右移动**/
 	function moveRight()
	{
		
			//得到第一个select对象
		var selectElement = document.getElementById("first");
		var optionElements = selectElement.getElementsByTagName("option");
		var len = optionElements.length;
		var selectElement2 = document.getElementById("secend");

		if(!(selectElement.selectedIndex==-1))   //如果没有选择元素，那么selectedIndex就为-1
		{
			
			//得到第二个select对象
			
	
				// 向右移动
				for(var i=0;i<len ;i++)
				{
					var found = false;
					for(var j=0; j<selectElement2.length; j++){
						if(optionElements[i].value=selectElement2.options[j].value){
							found = true;
							break;
						}
					}
					if(found){
						continue;
					}
					if(selectElement.selectedIndex>=0)
					selectElement2.appendChild(optionElements[selectElement.selectedIndex]);
				}
				changed = true;
		} else
		{
			alert("您还没有选择需要移动的元素！");
		}
	}
	

	
	//移动选中的元素到左边
	function moveLeft()
	{
		//首先得到第二个select对象
		var selectElement = document.getElementById("secend");
		
		var optionElement = selectElement.getElementsByTagName("option");
		var len = optionElement.length;
		var firstSelectElement = document.getElementById("first");
		
		
		//再次得到第一个元素
		if(!(selectElement.selectedIndex==-1))
		{
			
			for(i=0;i<len;i++)
			{
				if(selectElement.selectedIndex>=0)
					firstSelectElement.appendChild(optionElement[selectElement.selectedIndex]);//被选中的那个元素的索引
			}
			changed = true;
		}else
		{
			alert("您还没有选中要移动的项目!");
		}
	}
	
	function checkall(selectID){
		var obj = document.getElementById(selectID);
		var len = obj.options.length;
		for(var i=0; i<len; i++){
			obj.options[i].selected = true;
		}
		return true;
	}
</script>
</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

