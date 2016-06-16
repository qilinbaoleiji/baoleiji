<?php /* Smarty version 2.6.18, created on 2014-07-03 00:09:18
         compiled from app_group_edit.tpl */ ?>
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
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appserver_list">应用发布</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_app&action=app_group">应用用户组</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appprogram_list">应用程序</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_config&action=appicon_list">应用图标</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_app&action=app_group&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="30" border="0"></A></span>
</div></td></tr>
 <style>
.ul{list-style-type:none; margin:0;width:100%; }
.ul li{ width:80px; float:left;}
</style>
  <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
  <tr>
   <td >	
	应用服务器列表：<select name="appserverip" onchange="window.location='admin.php?controller=admin_app&action=app_group_edit&id=<?php echo $this->_tpl_vars['ginfo']['id']; ?>
&appserverip='+this.value">
		<option value="0">请选择</option>
		<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['appserver']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['appserver'][$this->_sections['a']['index']]['appserverip']; ?>
"><?php echo $this->_tpl_vars['appserver'][$this->_sections['a']['index']]['appserverip']; ?>
</option>
		<?php endfor; endif; ?>
		</select>	</td>
  </tr>
</table>
</TD>
                  </TR>
  <tr>
	<td class="">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>

            <td align="center"><form name="f1" method=post OnSubmit='return checkall("secend")' action="admin.php?controller=admin_app&action=app_group_save">
	<table border=0 width=100% cellpadding=5 cellspacing=1 bgcolor="#FFFFFF" valign=top class="BBtable">
<tr><th colspan="3" class="list_bg"></th></tr>
	  <tr bgcolor="f7f7f7">
		<td align=right colspan=1>
		应用用户组:<input type=text size="8" name="gname" id="gname" value="<?php echo $this->_tpl_vars['ginfo']['appgroupname']; ?>
"> </td><td align="left" colspan="2">描述:<input type=text size="50" name="desc" id="desc" value="<?php echo $this->_tpl_vars['ginfo']['desc']; ?>
">
	  </td>
	  </tr>
	  <tr>
	  <td align=center>
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
		<option value="<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['appserverip']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['apppubname']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['username']; ?>
_<?php echo $this->_tpl_vars['resource'][$this->_sections['ra']['index']]['device_ip']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		</td>
		<td width="5%" align=center>
		<div class="select_move_2">
                <input type="button" value=" 添加--> " onclick="moveRight()"/><br />
                <input type="button" value=" <--删除 "  onclick="moveLeft()"/><br />
          </div>
         </td>
         <td align=center>
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
		<option value="<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['id']; ?>
" selected><?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['appserverip']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['apppubname']; ?>
_<?php echo $this->_tpl_vars['res'][$this->_sections['r']['index']]['username']; ?>
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
<input type="hidden" name="oldgname" value="<?php echo $this->_tpl_vars['ginfo']['appgroupname']; ?>
">
<input type="submit"  value="保存" class="an_02">
</form>
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

function changeport() {
	if(document.getElementById("ssh").selected==true)  {
		f1.port.value = 22;
	}
	if(document.getElementById("telnet").selected==true)  {
		f1.port.value = 23;
	}
}

document.getElementById("telnet").selected = true;


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
					if(selectElement.selectedIndex>=0)
					selectElement2.appendChild(optionElements[selectElement.selectedIndex]);
				}
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

