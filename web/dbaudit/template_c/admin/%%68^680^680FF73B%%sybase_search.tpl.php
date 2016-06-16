<?php /* Smarty version 2.6.18, created on 2013-09-12 23:49:13
         compiled from sybase_search.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['language']['LogList']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/all_purpose_style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/border-radius.css" />
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/jscal2.js"></script>
<script src="<?php echo $this->_tpl_vars['template_root']; ?>
/cssjs/cn.js"></script>
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
<td width="84%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle" class="hui_bj"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
	


    <tr>
    <td class="main_content" height="30"><?php echo $this->_tpl_vars['language']['Man']; ?>
：<?php echo $this->_tpl_vars['language']['Search']; ?>
<?php echo $this->_tpl_vars['language']['Session']; ?>
,留空表示<?php echo $this->_tpl_vars['language']['no']; ?>
限制 </td>
  </tr>
  <tr>
	<td class="main_content">
<form method="get" name="session_search" action="admin.php">
				<table bordercolor="white" cellspacing="0" cellpadding="0" border="0" width="100%"  class="BBtable">
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
							<input type="radio" name="controller" value="admin_sqlnet" onClick="location.href='admin.php?controller=admin_sqlnet&action=search' ">Oracle<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td><td width="100">
							<input type="radio" name="controller" value="admin_db2"  onClick="location.href='admin.php?controller=admin_db2&action=search'" >DB2<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td><td width="100">
							<input type="radio" name="controller" value="admin_db2"  onClick="location.href='admin.php?controller=admin_sqlserver&action=search'" >SqlServer<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_sybase" checked>Sybase<?php echo $this->_tpl_vars['language']['Session']; ?>

							</td>
							<td width="100">
							<input type="radio" name="controller" value="admin_mysql" onClick="location.href='admin.php?controller=admin_mysql&action=search'">Mysql<?php echo $this->_tpl_vars['language']['Session']; ?>

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
							<option value='s_addr'><?php echo $this->_tpl_vars['language']['SourceAddress']; ?>
</option>
							<option value='d_addr'><?php echo $this->_tpl_vars['language']['DestinationAddress']; ?>
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
					<tr>
						<td class="td_line" width="30%">本地用户：</td>
						<td class="td_line" width="70%"><input name="user" type="text" class="wbk"></td>
					</tr>
					<?php endif; ?>
					<tr bgcolor="f7f7f7">
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['SourceAddress']; ?>
：</td>
						<td class="td_line" width="70%">
							<input name="s_addr" type="text" class="wbk" /><br />
						</td>
					</tr>
					<tr>
						<td class="td_line" width="30%"><?php echo $this->_tpl_vars['language']['DestinationAddress']; ?>
：</td>
						<td class="td_line" width="70%">
							<input name="d_addr" type="text" class="wbk" />&nbsp;<?php echo $this->_tpl_vars['language']['PleaseinputcorrectAddress']; ?>
<br />
						</td>
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
						<td class="td_line" colspan="2" align="center"><input name="submit" type="submit"  value="<?php echo $this->_tpl_vars['language']['Search']; ?>
" onclick="setScroll();" class="an_02"></td>
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
function setScroll(){
	window.parent.scrollTo(0,0);
}
</script>
