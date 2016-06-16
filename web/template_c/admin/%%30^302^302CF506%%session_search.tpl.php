<?php /* Smarty version 2.6.18, created on 2014-04-22 12:07:57
         compiled from session_search.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['LogList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
<script>
function setScroll(){
	window.parent.scrollTo(0,0);
}
var member = new Array();
<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['member']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
member[<?php echo $this->_sections['m']['index']; ?>
]={'username':'<?php echo $this->_tpl_vars['member'][$this->_sections['m']['index']]['username']; ?>
','realname':'<?php echo $this->_tpl_vars['member'][$this->_sections['m']['index']]['realname']; ?>
'}
<?php endfor; endif; ?>
</script>
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
/images/an1.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=search">会话搜索</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3.jpg" align="absmiddle"/></li>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_session&action=search_html_log">内容搜索</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
</ul>
</div></td></tr>


  
  <tr>
	<td class="">
<form method="get" name="session_search" action="admin.php" >
				<table bordercolor="white" cellspacing="0" cellpadding="0" border="0" width="100%"  class="BBtable">
				 <tr>
    <th class="list_bg" colspan="2"><?php echo $this->_tpl_vars['language']['Man']; ?>
：<?php echo $this->_tpl_vars['language']['Search']; ?>
<?php echo $this->_tpl_vars['language']['Session']; ?>
,留空表示<?php echo $this->_tpl_vars['language']['no']; ?>
限制 </th>
  </tr>
					<!--
					<tr>
						<td class="td_line" width="30%">数据表：</td>
						<td class="td_line" width="70%">
						<select  class="wbk"  name="table_name">
						<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['table_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option value="<?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
"><?php echo $this->_tpl_vars['table_list'][$this->_sections['t']['index']]; ?>
</option>
						<?php endfor; endif; ?>
						</select>
						<?php echo $this->_tpl_vars['language']['Sort']; ?>

						</td>
					</tr>
					-->
					<tr  <?php if ($this->_sections['t']['index'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
 <td> <?php echo $this->_tpl_vars['language']['Search']; ?>
<?php echo $this->_tpl_vars['language']['Session']; ?>
<?php echo $this->_tpl_vars['language']['Content']; ?>
</td>
						<td>
							<table><tr >
						<td width="100">
							<input type="radio" name="controller" value="admin_session" checked>telnet/ssh<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
						<td width="100">
							<input type="radio" name="controller" value="admin_rdp" onClick="location.href='admin.php?controller=admin_rdp&action=search'">rdp<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_vnc" onClick="location.href='admin.php?controller=admin_vnc&action=search'">vnc<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_ftp" onClick="location.href='admin.php?controller=admin_ftp&action=search'" >Ftp<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td><td width="100">
							<input type="radio" name="controller" value="admin_sftp" onClick="location.href='admin.php?controller=admin_sftp&action=search'">SFtp<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_as400" onClick="location.href='admin.php?controller=admin_as400&action=search'"  >AS400<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td><td width="100">
							<input type="radio" name="controller" value="admin_apppub" onClick="location.href='admin.php?controller=admin_apppub&action=search'" >应用<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td></tr></table>

						</td>
					</tr>
					<tr>
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['Result']; ?>
：</td>
						<td class="td_line" width="70%">
						<select  class="wbk"  name="orderby1">
							<option value='sid'><?php echo $this->_tpl_vars['language']['default']; ?>
</option>
							<option value='addr'><?php echo $this->_tpl_vars['language']['DeviceAddress']; ?>
</option>
							<option value='type'><?php echo $this->_tpl_vars['language']['Sessiontype']; ?>
</option>
							<option value='user'><?php echo $this->_tpl_vars['language']['Username']; ?>
</option>
							<option value='start'><?php echo $this->_tpl_vars['language']['Session']; ?>
<?php echo $this->_tpl_vars['language']['StartTime']; ?>
</option>
							<option value='end'><?php echo $this->_tpl_vars['language']['Session']; ?>
<?php echo $this->_tpl_vars['language']['EndTime']; ?>
</option>
						</select>
						<?php echo $this->_tpl_vars['language']['Sort']; ?>

						<select  class="wbk"  name="orderby2">
							<option value='asc'><?php echo $this->_tpl_vars['language']['ascendingorder']; ?>
</option>
							<option value='desc'><?php echo $this->_tpl_vars['language']['decreasingorder']; ?>
</option>
						</select>
						</td>
					</tr>
				
					<?php if ($this->_tpl_vars['admin_level'] == 1): ?>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%">运维用户：</td>
						<td class="td_line" width="70%">
						<select name='luser' id="luser">
						<option value="">所有用户</option>
						<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['member']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['member'][$this->_sections['m']['index']]['username']; ?>
"><?php echo $this->_tpl_vars['member'][$this->_sections['m']['index']]['username']; ?>
</option>
						<?php endfor; endif; ?>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="toRealname();" id="RealNameToId" value="on" >&nbsp;实名</td>
					</tr>
					<tr>
						<td class="td_line" width="30%">本地用户：</td>
						<td class="td_line" width="70%"><input name="user" type="text" class="wbk"></td>
					</tr>
					<?php endif; ?>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['DeviceAddress']; ?>
：</td>
						<td class="td_line" width="70%">
							<input name="addr" id="addr" type="text" class="wbk" /><br />
							<select  class="wbk"  name="fromlist" size="6" style="width:140px;height:110px;" onchange="javascript:document.getElementById('addr').value=this.options[this.selectedIndex].text">
								<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['alldev']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								<option name="<?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ip']; ?>
"><?php echo $this->_tpl_vars['alldev'][$this->_sections['t']['index']]['ip']; ?>
</option>
								<?php endfor; endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['Sessiontype']; ?>
：</td>
						<td class="td_line" width="70%">
						<select  class="wbk"  name="type">
							<option value='all'><?php echo $this->_tpl_vars['language']['All']; ?>
</option>
							<option value='ssh'>ssh</option>
							<option value='telnet'>telnet</option>
						</select>
					</tr>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['StartTime']; ?>
：</td>
						<td class="td_line" width="70%"><input name="start1" id="f_rangeStart" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="起始时间"  class="wbk">&nbsp;&nbsp;<input name="start2" id="f_rangeEnd" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="终止时间"  class="wbk"></td>
					</tr>
					<tr>
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['EndTime']; ?>
：</td>
						<td class="td_line" width="70%"><input name="end1" id="f_rangeStart2" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeStart_trigger2" name="f_rangeStart_trigger2" value="起始时间"  class="wbk">&nbsp;&nbsp;<input name="end2" id="f_rangeEnd2" type="text" class="wbk">&nbsp;<input type="button" onclick="changetype('timetype3')" id="f_rangeEnd_trigger2" name="f_rangeEnd_trigger2" value="终止时间"  class="wbk"></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['Historycommands']; ?>
：</td>
						<td class="td_line" width="70%"><input type="text" class="wbk" name="command"></td>
					</tr>
					<tr>
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['SourceAddress']; ?>
：</td>
						<td class="td_line" width="70%"><input type="text" class="wbk" name="srcaddr"></td>
					</tr>
					<tr bgcolor="f7f7f7">
						<td class="td_line" colspan="2" align="center"><input name="submit" type="button" onclick="window.location='admin.php?controller=admin_dev&action=update_all'"  value="更新列表" class="an_02">&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" onclick="setScroll();"  value="<?php echo $this->_tpl_vars['language']['Search']; ?>
" class="an_02">
					</tr>
				</table>
				<script type="text/javascript">
                  new Calendar({
                          inputField: "f_rangeStart",
                          dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                          trigger: "f_rangeStart_trigger",
                          bottomBar: false,
						  popupDirection:'up',
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                 
                                  this.hide();
                          }
                  });
                  new Calendar({
                      inputField: "f_rangeEnd",
                      dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                      trigger: "f_rangeEnd_trigger",
                      bottomBar: false,
					  popupDirection:'up',
                      onSelect: function() {
                              var date = Calendar.intToDate(this.selection.get());
                             
                              this.hide();
                      }
              });
			   new Calendar({
                          inputField: "f_rangeStart2",
                          dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                          trigger: "f_rangeStart_trigger2",
                          bottomBar: false,
						  popupDirection:'up',
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                 
                                  this.hide();
                          }
                  });
                  new Calendar({
                      inputField: "f_rangeEnd2",
                      dateFormat: "%Y-%m-%d %H:%M:%S",showTime: true,
                      trigger: "f_rangeEnd_trigger2",
                      bottomBar: false,
					  popupDirection:'up',
                      onSelect: function() {
                              var date = Calendar.intToDate(this.selection.get());
                             
                              this.hide();
                      }
              });
                </script>
			</form>
	</td>
  </tr>
</table>

<script>
function toRealname(){
	document.getElementById('luser').options.length=0;
	document.getElementById('luser').options[document.getElementById('luser').options.length]= new Option('所有用户','');
	if(document.getElementById('RealNameToId').checked){
		
		for(var i=0; i<member.length; i++){
			document.getElementById('luser').options[document.getElementById('luser').options.length]= new Option(member[i].realname,member[i].username);
		}
	}else{
		for(var i=0; i<member.length; i++){
			document.getElementById('luser').options[document.getElementById('luser').options.length]= new Option(member[i].username,member[i].username);
		}
	}
}
</script>
