<?php /* Smarty version 2.6.18, created on 2014-04-21 22:06:56
         compiled from test_port.tpl */ ?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
            <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top">
              <TBODY>
               <TR>
               <TD align="center">IP</TD><TD align="center"><?php echo $this->_tpl_vars['c']['device_ip']; ?>
</TD></TR>
			   <TR>
               <TD align="center">协议</TD><TD align="center"><?php echo $this->_tpl_vars['c']['login_method']; ?>
</TD></TR>
			   <TR>
               <TD align="center">端口</TD><TD align="center"><?php echo $this->_tpl_vars['c']['port']; ?>
</TD></TR>
			   <TR>
               <TD align="center">用户名</TD><TD align="center"><?php echo $this->_tpl_vars['c']['username']; ?>
</TD></TR>
			   <TR>
               <TD align="center">授权策略</TD><TD align="center"><?php echo $this->_tpl_vars['c']['forbidden_commands_groups']; ?>
</TD></TR>
			   <TR>
               <TD align="center">周组策略</TD><TD align="center"><?php echo $this->_tpl_vars['c']['weektime']; ?>
</TD></TR>
			   <TR>
               <TD align="center">来源IP组</TD><TD align="center"><?php echo $this->_tpl_vars['c']['sourceip']; ?>
</TD></TR>
			   <TR>
			    <TR>
               <TD align="center">双人操作</TD><TD align="center"><?php echo $this->_tpl_vars['c']['twoauth']; ?>
/<?php echo $this->_tpl_vars['strloginapprove']; ?>
</TD></TR>
			   <TR>
			   <?php if ($this->_tpl_vars['login_method'] == 'RDP'): ?>
			   <TR>
               <TD align="center">上行剪切板</TD><TD align="center"><?php if (! $this->_tpl_vars['c']['rdpclipauth_up']): ?>不<?php endif; ?>允许</TD></TR>
			   <TR>
               <TD align="center">下行剪切板</TD><TD align="center"><?php if (! $this->_tpl_vars['c']['rdpclipauth_down']): ?>不<?php endif; ?>允许</TD></TR>
			   <TR>
			    <TR>
               <TD align="center">磁盘映射</TD><TD align="center"><?php if (! $this->_tpl_vars['c']['rdpdiskauth_up']): ?>不<?php endif; ?>允许</TD></TR>
			   <TR>
			   <?php endif; ?>
               <TD align="center">连接状态</TD><TD align="center"><?php echo $this->_tpl_vars['c']['result']; ?>
</TD></TR>

				</TBODY></TABLE>
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['logininfo']['id']; ?>
" />
     </TD></TR></TBODY></TABLE></TR></TBODY></TABLE>