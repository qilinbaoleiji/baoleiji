<?php /* Smarty version 2.6.18, created on 2014-04-24 23:48:08
         compiled from resourcegrp_selgroup.tpl */ ?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="generator" content="editplus">
<meta name="author" content="nuttycoder">
<link href="<?php echo $this->_tpl_vars['template_root']; ?>
/all_purpose_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root']; ?>
/Calendarandtime.js"></script>
</head>

<body>
 <FORM name="f1" onSubmit="return check()" action="admin.php?controller=admin_pro&action=resourcegrp_selgroup_save" 
            method="post">

              <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" valign="top"  class="BBtable">
                <TBODY>
                  <TR bgcolor="#f7f7f7">
                    <TD colspan="2" class="list_bg">设置</TD>
                  </TR>
                  <TR id="autosutr" bgcolor="#f7f7f7">
                    <TD width="50%" align="right"><?php echo $this->_tpl_vars['language']['automaticallyloginassuperadministrator']; ?>
</TD>
                    <TD><INPUT id="autosu" <?php if ($this->_tpl_vars['lgroup']['autosu'] == 1): ?> checked <?php endif; ?> type=checkbox name=autosu value="on">                      </TD>
                  </TR>
                  <TR id="autosutr">
                    <TD width="50%" align="right"><?php echo $this->_tpl_vars['language']['syslogAlertwhenloginin']; ?>
</TD>
                    <TD><INPUT id="syslogalert" <?php if ($this->_tpl_vars['lgroup']['syslogalert'] == 1): ?> checked <?php endif; ?> type=checkbox name=syslogalert value="on">                  </TD>
                  </TR>
                  <TR id="autosutr" bgcolor="#f7f7f7">
                    <TD width="50%" align="right"><?php echo $this->_tpl_vars['language']['mailalertwhenloginin']; ?>
</TD>
                    <TD><INPUT id="mailalert" <?php if ($this->_tpl_vars['lgroup']['mailalert'] == 1): ?> checked <?php endif; ?> type=checkbox name=mailalert value="on">              </TD>
                  </TR>
                  <TR id="autosutr">
                    <TD width="50%" align="right"><?php echo $this->_tpl_vars['language']['accountlocked']; ?>
 </TD>
                    <TD><INPUT id="loginlock" <?php if ($this->_tpl_vars['lgroup']['loginlock'] == 1): ?> checked <?php endif; ?> type=checkbox name=loginlock value="on">                    </TD>
                  </TR>
                  <TR id="autosutr" bgcolor="#f7f7f7">
                    <TD width="50%" align="right">磁盘映射 </TD>
                    <TD><INPUT id="loginlock" <?php if ($this->_tpl_vars['lgroup']['rdpdiskauth_up'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpdiskauth_up value="on">                </TD>
                  </TR>
                  <TR id="autosutr" >
                    <TD width="50%" align="right">剪切板上行 </TD>
                    <TD><INPUT id="loginlock" <?php if ($this->_tpl_vars['lgroup']['rdpclipauth_up'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpclipauth_up value="on">           </TD>
                  </TR>
				    <TR id="autosutr" bgcolor="#f7f7f7">
                    <TD width="50%" align="right">剪切板下行 </TD>
                    <TD><INPUT id="loginlock" <?php if ($this->_tpl_vars['lgroup']['rdpclipauth_down'] == 1): ?> checked <?php endif; ?> type=checkbox name=rdpclipauth_down value="on">           </TD>
                  </TR>
                  <TR>
                    <TD width="50%" align="right">周组策略 </TD>
                    <TD><select  class="wbk"  name=weektime>
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['no']; ?>
</OPTION>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['weektime']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname']; ?>
" <?php if ($this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname'] == $this->_tpl_vars['lgroup']['weektime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>        </TD>
                  </TR>
                  <TR bgcolor="#f7f7f7">
                    <TD width="50%" align="right">来源ip组 </TD>
                    <TD><select  class="wbk"  name=sourceip>
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['no']; ?>
</OPTION>
                     	<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['sourceip']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname']; ?>
" <?php if ($this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname'] == $this->_tpl_vars['lgroup']['sourceip']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>                 </TD>
                  </TR>
                  <TR>
                    <TD width="50%" align="right">命令权限 </TD>
                    <TD><select  class="wbk"  name=forbidden_commands_groups>
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['no']; ?>
</OPTION>
                     	<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['allforbiddengroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['f']['show'] = true;
$this->_sections['f']['max'] = $this->_sections['f']['loop'];
$this->_sections['f']['step'] = 1;
$this->_sections['f']['start'] = $this->_sections['f']['step'] > 0 ? 0 : $this->_sections['f']['loop']-1;
if ($this->_sections['f']['show']) {
    $this->_sections['f']['total'] = $this->_sections['f']['loop'];
    if ($this->_sections['f']['total'] == 0)
        $this->_sections['f']['show'] = false;
} else
    $this->_sections['f']['total'] = 0;
if ($this->_sections['f']['show']):

            for ($this->_sections['f']['index'] = $this->_sections['f']['start'], $this->_sections['f']['iteration'] = 1;
                 $this->_sections['f']['iteration'] <= $this->_sections['f']['total'];
                 $this->_sections['f']['index'] += $this->_sections['f']['step'], $this->_sections['f']['iteration']++):
$this->_sections['f']['rownum'] = $this->_sections['f']['iteration'];
$this->_sections['f']['index_prev'] = $this->_sections['f']['index'] - $this->_sections['f']['step'];
$this->_sections['f']['index_next'] = $this->_sections['f']['index'] + $this->_sections['f']['step'];
$this->_sections['f']['first']      = ($this->_sections['f']['iteration'] == 1);
$this->_sections['f']['last']       = ($this->_sections['f']['iteration'] == $this->_sections['f']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname']; ?>
" <?php if ($this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname'] == $this->_tpl_vars['lgroup']['forbidden_commands_groups']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['gname']; ?>
(<?php if ($this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['black_or_white'] == 1): ?>白名单<?php elseif ($this->_tpl_vars['allforbiddengroup'][$this->_sections['f']['index']]['black_or_white'] == 3): ?>授权命令<?php else: ?>黑名单<?php endif; ?>)</option>
			<?php endfor; endif; ?>
                  </SELECT>      </TD>
                  </TR>
				  <TR bgcolor="#f7f7f7">
                    <TD width="50%" align="right">双人授权 </TD>
                    <TD><select  class="wbk"  name=twoauth>
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['no']; ?>
</OPTION>
                     	<?php unset($this->_sections['w']);
$this->_sections['w']['name'] = 'w';
$this->_sections['w']['loop'] = is_array($_loop=$this->_tpl_vars['webusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['w']['show'] = true;
$this->_sections['w']['max'] = $this->_sections['w']['loop'];
$this->_sections['w']['step'] = 1;
$this->_sections['w']['start'] = $this->_sections['w']['step'] > 0 ? 0 : $this->_sections['w']['loop']-1;
if ($this->_sections['w']['show']) {
    $this->_sections['w']['total'] = $this->_sections['w']['loop'];
    if ($this->_sections['w']['total'] == 0)
        $this->_sections['w']['show'] = false;
} else
    $this->_sections['w']['total'] = 0;
if ($this->_sections['w']['show']):

            for ($this->_sections['w']['index'] = $this->_sections['w']['start'], $this->_sections['w']['iteration'] = 1;
                 $this->_sections['w']['iteration'] <= $this->_sections['w']['total'];
                 $this->_sections['w']['index'] += $this->_sections['w']['step'], $this->_sections['w']['iteration']++):
$this->_sections['w']['rownum'] = $this->_sections['w']['iteration'];
$this->_sections['w']['index_prev'] = $this->_sections['w']['index'] - $this->_sections['w']['step'];
$this->_sections['w']['index_next'] = $this->_sections['w']['index'] + $this->_sections['w']['step'];
$this->_sections['w']['first']      = ($this->_sections['w']['iteration'] == 1);
$this->_sections['w']['last']       = ($this->_sections['w']['iteration'] == $this->_sections['w']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['webusers'][$this->_sections['w']['index']]['uid']; ?>
" <?php if ($this->_tpl_vars['webusers'][$this->_sections['w']['index']]['uid'] == $this->_tpl_vars['lgroup']['twoauth']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['webusers'][$this->_sections['w']['index']]['username']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>       </TD>
                  </TR>
                  <TR>
                    <TD colspan="2" align="center"><INPUT class="an_02" type="submit" value="保存修改"></TD>
                  </TR>
                </TBODY>
              </TABLE>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
<input type="hidden" name="gid" value="<?php echo $this->_tpl_vars['gid']; ?>
" />
<input type="hidden" name="sid" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<input type="hidden" name="sessionlgroup" value="<?php echo $this->_tpl_vars['sessionlgroup']; ?>
" />
</FORM>


</body>
<iframe name="hide" height="0" frameborder="0" scrolling="no"></iframe>
</html>

