<?php /* Smarty version 2.6.18, created on 2014-06-28 17:20:07
         compiled from sessiondesc.tpl */ ?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD align="center" class="tb_t_bg">填写备注内容 </TD>
  </TR>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
          <form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_session&action=dodesc" target="hide">
            <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top">
              <TBODY>
              <TR>
              <TD align="center"><TEXTAREA name="desc" rows="5" cols="50" ><?php echo $this->_tpl_vars['logininfo']['content']; ?>
</TEXTAREA>                  				   </TD></TR>
              <TR><TD align="center" colspan="2"><INPUT type="submit" class="an_02" value="提交"></TD></TR></TBODY></TABLE>
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['logininfo']['id']; ?>
" />
	<input type="hidden" name="sessionid" value="<?php echo $this->_tpl_vars['sessionid']; ?>
" />
	<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
" />
      </FORM></TD></TR></TBODY></TABLE></TR></TBODY></TABLE>