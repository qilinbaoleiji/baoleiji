<?php /* Smarty version 2.6.18, created on 2014-04-22 23:18:44
         compiled from loginpolicy.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['Master']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
面</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script>
	function my_confirm(str){
		if(!confirm("确认要" + str + "？"))
		{
			window.event.returnValue = false;
		}
	}
	function chk_form(){
		for(var i = 0; i < document.member_list.elements.length;i++){
			var e = document.member_list.elements[i];
			if(e.name == 'chk_member[]' && e.checked == true)
				return true;
		}
		alert("您没有<?php echo $this->_tpl_vars['language']['select']; ?>
任何<?php echo $this->_tpl_vars['language']['User']; ?>
！");
		return false;
	}

</script>
<script>
	function searchit(){
		document.search.action = "admin.php?controller=admin_member";
		document.search.action += "&username="+document.search.username.value;
		document.search.submit();
		return true;
	}
	
	function changeuser(){
		if(document.getElementById('groups').style.display=='none'){
			document.getElementById('groups').style.display=''
			document.getElementById('users').style.display='none'
		}else{
			document.getElementById('users').style.display=''
			document.getElementById('groups').style.display='none'
		}
	}

	function changeserver(){
		if(document.getElementById('resources').style.display=='none'){
			document.getElementById('resources').style.display=''
			document.getElementById('servers').style.display='none'
		}else{
			document.getElementById('servers').style.display=''
			document.getElementById('resources').style.display='none'
		}
	}

	function newit(){
		if(document.getElementById('groups').style.display=='none'){
			document.getElementById('groups').disabled=true;
		}else{
			document.getElementById('users').disabled=true;
		}
		if(document.getElementById('resources').style.display=='none'){
			document.getElementById('resources').disabled=true;
		}else{
			document.getElementById('servers').disabled=true;
		}
	}
</script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3): ?>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_a"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul>
</div></td></tr>
<body>
	
 <TR>
<TD >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main_content">
<form  action='admin.php?controller=admin_ipacl&action=loginpolicy' method=post >
  <tr>
    <td >
</td>
    <td >	
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 用户/运维组 " onclick="changeuser();" />&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="users" id="users" >
					<option value="99999999" >所有</option>
					<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['uid']; ?>
" ><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['username']; ?>
</option>
					<?php endfor; endif; ?>
					</select>
					<select name="groups" id="groups" style="display:none">
					<option value="99999999" >所有</option>
					<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['GroupName']; ?>
</option>
					<?php endfor; endif; ?>
					</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value=" 设备/资源组 " onclick="changeserver();" />
					<select name="servers" id="servers" >
					<option value="99999999" >所有</option>
					<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['servers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['servers'][$this->_sections['s']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['servers'][$this->_sections['s']['index']]['device_ip']; ?>
</option>
					<?php endfor; endif; ?>
					</select>
					<select name="resources" id="resources" style="display:none">
					<option value="99999999" >所有</option>
					<?php unset($this->_sections['sg']);
$this->_sections['sg']['name'] = 'sg';
$this->_sections['sg']['loop'] = is_array($_loop=$this->_tpl_vars['resources']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sg']['show'] = true;
$this->_sections['sg']['max'] = $this->_sections['sg']['loop'];
$this->_sections['sg']['step'] = 1;
$this->_sections['sg']['start'] = $this->_sections['sg']['step'] > 0 ? 0 : $this->_sections['sg']['loop']-1;
if ($this->_sections['sg']['show']) {
    $this->_sections['sg']['total'] = $this->_sections['sg']['loop'];
    if ($this->_sections['sg']['total'] == 0)
        $this->_sections['sg']['show'] = false;
} else
    $this->_sections['sg']['total'] = 0;
if ($this->_sections['sg']['show']):

            for ($this->_sections['sg']['index'] = $this->_sections['sg']['start'], $this->_sections['sg']['iteration'] = 1;
                 $this->_sections['sg']['iteration'] <= $this->_sections['sg']['total'];
                 $this->_sections['sg']['index'] += $this->_sections['sg']['step'], $this->_sections['sg']['iteration']++):
$this->_sections['sg']['rownum'] = $this->_sections['sg']['iteration'];
$this->_sections['sg']['index_prev'] = $this->_sections['sg']['index'] - $this->_sections['sg']['step'];
$this->_sections['sg']['index_next'] = $this->_sections['sg']['index'] + $this->_sections['sg']['step'];
$this->_sections['sg']['first']      = ($this->_sections['sg']['iteration'] == 1);
$this->_sections['sg']['last']       = ($this->_sections['sg']['iteration'] == $this->_sections['sg']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['resources'][$this->_sections['sg']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['resources'][$this->_sections['sg']['index']]['groupname']; ?>
</option>
					<?php endfor; endif; ?>
					</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value=" 规则 "  />
					<select name="restrictacl" id="restrictacl" >
					<option value="" >所有</option>
					<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['acl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="<?php echo $this->_tpl_vars['acl'][$this->_sections['a']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['acl'][$this->_sections['a']['index']]['aclname']; ?>
</option>
					<?php endfor; endif; ?>
					</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" height="35" align="middle" onClick="return newit();" border="0" value=" 新建 " class="bnnew2"/>

					</td>
  </tr>
  <input type="hidden" name="ac" value="doinsert" />
</form>	
</table>
</TD>
                  </TR>
	  <tr><td><table bordercolor="white" cellspacing="0" cellpadding="5" border="0" width="100%" class="BBtable">
	<form name="member_list" action="admin.php?controller=admin_member&action=delete_all" method="post">
					<tr>
						<th class="list_bg"  width="3%" ><?php echo $this->_tpl_vars['language']['select']; ?>
</th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=username&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >用户名</a></th>
						<th class="list_bg"  width="10%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=groupname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >运维组名</a></th>
						<th class="list_bg"  width="9%"><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=device_ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >设备</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=resourceid&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >资源组</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=aclname&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >规则名</a></th>
						<th class="list_bg"  width="18%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=lifetime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >访问日期区间</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=lifetime&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >运行时间</a></th>
						<th class="list_bg"  width="9%" ><a href='admin.php?controller=admin_ipacl&action=loginpolicy&orderby1=ip&orderby2=<?php echo $this->_tpl_vars['orderby2']; ?>
' >客户ip</a></th>
						<th class="list_bg"  width="5%" ><?php echo $this->_tpl_vars['language']['Operate']; ?>
<?php echo $this->_tpl_vars['language']['Link']; ?>
</th>
					</tr>
					<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['respolicy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td><input type="checkbox" name="chk_member[]" value="<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['rid']; ?>
"></td>
						<td><?php if ($this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['memberid'] == '99999999'): ?>所有<?php else: ?><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['username']; ?>
<?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['usergroupid'] == '99999999'): ?>所有<?php else: ?><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['groupname']; ?>
<?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['serverid'] == '99999999'): ?>所有<?php else: ?><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['device_ip']; ?>
<?php endif; ?></td>
						<td><?php if ($this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['resourceid'] == '99999999'): ?>所有<?php else: ?><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['resname']; ?>
<?php endif; ?></td>
						<td><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['aclname']; ?>
</td>
						<td><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['year']; ?>
年<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['year']; ?>
月<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['month']; ?>
日星期<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['day']; ?>
时间<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['time']; ?>
</td>
						<td><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['lifetime']; ?>
</td>
						<td><?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['ip']; ?>
</td>
						<td>						
						<img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/scico.gif" width="16" height="16" align="absmiddle"><a href="admin.php?controller=admin_ipacl&action=delete_policy&id=<?php echo $this->_tpl_vars['respolicy'][$this->_sections['t']['index']]['rid']; ?>
"><?php echo $this->_tpl_vars['language']['Delete']; ?>
</a>			
						</td>
					</tr>
					<?php endfor; endif; ?>
					<tr>
						<td colspan="4" align="left">
							<input name="select_all" type="checkbox" onClick="javascript:for(var i=0;i<this.form.elements.length;i++){var e=this.form.elements[i];if(e.name=='chk_member[]')e.checked=this.form.select_all.checked;}" value="checkbox">&nbsp;&nbsp;<input type="submit"  value="删除" onClick="my_confirm('<?php echo $this->_tpl_vars['language']['DeleteUsers']; ?>
');if(chk_form()) document.member_list.action='admin.php?controller=admin_ipacl&action=delete_policy'; else return false;" class="an_02">
						</td>
						<td colspan="7" align="right">
							<?php echo $this->_tpl_vars['language']['all']; ?>
<?php echo $this->_tpl_vars['total']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
  <?php echo $this->_tpl_vars['page_list']; ?>
  <?php echo $this->_tpl_vars['language']['Page']; ?>
：<?php echo $this->_tpl_vars['curr_page']; ?>
/<?php echo $this->_tpl_vars['total_page']; ?>
<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['items_per_page']; ?>
个<?php echo $this->_tpl_vars['language']['User']; ?>
/<?php echo $this->_tpl_vars['language']['page']; ?>
  <?php echo $this->_tpl_vars['language']['Goto']; ?>
<input name="pagenum" type="text" class="wbk" size="2" onKeyPress="if(event.keyCode==13) window.location='admin.php?controller=admin_member&page='+this.value;"><?php echo $this->_tpl_vars['language']['page']; ?>

						</td>
					</tr>
					
				
		  </form>
					<tr>
						
					</tr>
				</table>
			
	  </table>
		</td>
	  </tr>
	</table>
	<iframe name="hide" height="0" frameborder="0" scrolling="no" id="hide"></iframe>

</body>
</html>

