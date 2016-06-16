<?php /* Smarty version 2.6.18, created on 2014-04-27 00:19:46
         compiled from commit.tpl */ ?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD align="center" class="tb_t_bg">填写操作内容 </TD>
  </TR>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>
          <TD align="center">
          <form name="f1" method=post enctype="multipart/form-data" action="admin.php?controller=admin_pro&action=docommit" target="hide">
            <TABLE width="100%" bgcolor="#ffffff" border="0" cellspacing="1" 
            cellpadding="5" valign="top">
              <TBODY>
              <TR>
                <TD align="center"><TEXTAREA name="prelogincommit" rows="5" cols="50" value=""></TEXTAREA>                  				   </TD></TR>
              <TR>
                <TD align="center"><INPUT class="an_02" type="submit" value="登录"></TD></TR></TBODY></TABLE>
           <input type="hidden" name="url" value="<?php echo $this->_tpl_vars['url']; ?>
" />
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['devicesid']; ?>
" />
      </FORM></TD></TR></TBODY></TABLE></TR></TBODY></TABLE>