<?php /* Smarty version 2.6.18, created on 2014-07-03 18:37:19
         compiled from member_add2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'member_add2.tpl', 256, false),)), $this); ?>
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
<script src="./template/admin/cssjs/jscal2.js"></script>
<script src="./template/admin/cssjs/cn.js"></script>
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/jscal2.css" />
<link type="text/css" rel="stylesheet" href="./template/admin/cssjs/border-radius.css" />

<script language="javascript">
	function check_add_user(){
		return(true);
	}

var AllUsbKey = new Array();
var i=0;
<?php unset($this->_sections['kk']);
$this->_sections['kk']['name'] = 'kk';
$this->_sections['kk']['loop'] = is_array($_loop=$this->_tpl_vars['allusbkey']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['kk']['show'] = true;
$this->_sections['kk']['max'] = $this->_sections['kk']['loop'];
$this->_sections['kk']['step'] = 1;
$this->_sections['kk']['start'] = $this->_sections['kk']['step'] > 0 ? 0 : $this->_sections['kk']['loop']-1;
if ($this->_sections['kk']['show']) {
    $this->_sections['kk']['total'] = $this->_sections['kk']['loop'];
    if ($this->_sections['kk']['total'] == 0)
        $this->_sections['kk']['show'] = false;
} else
    $this->_sections['kk']['total'] = 0;
if ($this->_sections['kk']['show']):

            for ($this->_sections['kk']['index'] = $this->_sections['kk']['start'], $this->_sections['kk']['iteration'] = 1;
                 $this->_sections['kk']['iteration'] <= $this->_sections['kk']['total'];
                 $this->_sections['kk']['index'] += $this->_sections['kk']['step'], $this->_sections['kk']['iteration']++):
$this->_sections['kk']['rownum'] = $this->_sections['kk']['iteration'];
$this->_sections['kk']['index_prev'] = $this->_sections['kk']['index'] - $this->_sections['kk']['step'];
$this->_sections['kk']['index_next'] = $this->_sections['kk']['index'] + $this->_sections['kk']['step'];
$this->_sections['kk']['first']      = ($this->_sections['kk']['iteration'] == 1);
$this->_sections['kk']['last']       = ($this->_sections['kk']['iteration'] == $this->_sections['kk']['total']);
?>
AllUsbKey[i++]='<?php echo $this->_tpl_vars['allusbkey'][$this->_sections['kk']['index']]['keyid']; ?>
';
<?php endfor; endif; ?>
function filter(){
	var filterStr = document.getElementById('filtertext').value;
	var usbkeyid = document.getElementById('usbkeyid');
	usbkeyid.options.length=1;
	for(var i=0; i<AllUsbKey.length;i++){
		if(filterStr.length==0 || AllUsbKey[i].indexOf(filterStr) >= 0){
			usbkeyid.options[usbkeyid.options.length++] = new Option(AllUsbKey[i],AllUsbKey[i]);
		}
	}
}
</script>
<script language=javascript>  
//CharMode函数
//测试某个字符<?php echo $this->_tpl_vars['language']['Yes']; ?>
属于哪一类.  
function CharMode(iN){  
	if (iN>=48 && iN <=57) //数字  
		return 1;  
	if (iN>=65 && iN <=90) //大写字母  
		return 2;  
	if (iN>=97 && iN <=122) //小写  
		return 4;  
	else  
		return 8; //特殊字符  
}  
//bitTotal函数  
//计算出当前<?php echo $this->_tpl_vars['language']['Password']; ?>
当<?php echo $this->_tpl_vars['language']['normal']; ?>
一<?php echo $this->_tpl_vars['language']['all']; ?>
有多少种模式  
function bitTotal(num){  
	modes=0;  
	for (i=0;i<4;i++){  
		if (num & 1) modes++;  
		num>>>=1;  
	}  
	return modes;  
}  
//checkStrong函数  
//返回<?php echo $this->_tpl_vars['language']['Password']; ?>
的<?php echo $this->_tpl_vars['language']['strong']; ?>
度级别  
function checkStrong(sPW){  
	if (sPW.length<=8)  
	return 0; //<?php echo $this->_tpl_vars['language']['Password']; ?>
太短  
	Modes=0;  
	for (i=0;i<sPW.length;i++){  
	//测试每<?php echo $this->_tpl_vars['language']['one']; ?>
字符的类别并统计一<?php echo $this->_tpl_vars['language']['all']; ?>
有多少种模式.  
		Modes|=CharMode(sPW.charCodeAt(i));  
	}  
	return bitTotal(Modes);  
}  
//pwStrength函数  
//当<?php echo $this->_tpl_vars['language']['User']; ?>
放开键盘<?php echo $this->_tpl_vars['language']['or']; ?>
<?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Input']; ?>
框失去焦点时,根据不同的级别<?php echo $this->_tpl_vars['language']['displayed']; ?>
不同的颜色  
function pwStrength(pwd){  
	O_color="#eeeeee";  
	L_color="#FF0000";  
	M_color="#FF9900";  
	H_color="#33CC00";  
if (pwd==null||pwd==''){  
	Lcolor=Mcolor=Hcolor=O_color;  
}else{  
	S_level=checkStrong(pwd);  
switch(S_level) {  
	case 0:  
	Lcolor=Mcolor=Hcolor=O_color;  
	case 1:  
	Lcolor=L_color;  
	Mcolor=Hcolor=O_color;  
	break;  
	case 2:  
	Lcolor=Mcolor=M_color;  
	Hcolor=O_color;  
	break;  
	default:  
	Lcolor=Mcolor=Hcolor=H_color;  
}  
}
document.getElementById("strength_L").style.background=Lcolor;  
document.getElementById("strength_M").style.background=Mcolor;  
document.getElementById("strength_H").style.background=Hcolor;  
return;  
}  

var foundparent = false;
var servergroup = new Array();
var i=0;
<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['allsgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
servergroup[i++]={id:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['id']; ?>
,name:'<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['groupname']; ?>
',ldapid:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['ldapid']; ?>
,level:<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['a']['index']]['level']; ?>
};
<?php endfor; endif; ?>

function changelevels(v, d){
	document.getElementById('ldapid2').options.length=0;
	<?php if ($this->_tpl_vars['logined_user_level'] == 1): ?>
	document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option('无', 0);
	<?php endif; ?>
	var found = 0;
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==2){
			if(d==servergroup[i].id){
				found = 1;
				var selected_i = document.getElementById('ldapid2').options.length;
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('ldapid2').options[document.getElementById('ldapid2').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
	}
	document.getElementById('ldapid2').options.selectedIndex = selected_i;

	document.getElementById('servergroup').options.length=0;
	
	<?php if ($this->_tpl_vars['logined_user_level']): ?>
	document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option('无', 0);
	<?php endif; ?>
	var found = 0;
	var class2_i = 0;
	var class2 = new Array();
	for(var i=0; i<servergroup.length; i++){
		if(servergroup[i].ldapid==v&& servergroup[i].level==0){
			if(d==servergroup[i].id){
				found = 1;
				var selected_i = document.getElementById('servergroup').options.length;
				document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
			}else{				
				document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
			}
		}
		if(servergroup[i].ldapid==v && servergroup[i].level==2){
			class2[class2_i++]=i;
		}
	}
	document.getElementById('servergroup').options.selectedIndex = selected_i;
	/*
	for(var j=0; j<class2.length; j++){
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==servergroup[class2[j]].id&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}*/
	//changelevel2(found,0);
}

function changelevel2(v, d){
	if(v!=0){
		document.getElementById('servergroup').options.length=0;
		<?php if ($this->_tpl_vars['logined_user_level']): ?>
		document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option('无', 0);
		<?php endif; ?>
		for(var i=0; i<servergroup.length; i++){
			if(servergroup[i].ldapid==v&& servergroup[i].level==0){
				if(d==servergroup[i].id){
					found = 1;
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id, true, true);
				}else{				
					document.getElementById('servergroup').options[document.getElementById('servergroup').options.length]=new Option(servergroup[i].name, servergroup[i].id);
				}
			}
		}
	}else{
		changelevels(document.getElementById('ldapid1').options[document.getElementById('ldapid1').options.selectedIndex].value, d);
	}
}
</script>  
<style>
A {
	COLOR: #000000; TEXT-DECORATION: none
}
#navbar {WIDTH: 98%; 
	
}
#header {
	LINE-HEIGHT: normal; WIDTH: 98%;  FONT-SIZE:12px; 
}
#header UL {
	 LIST-STYLE-TYPE: none; MARGIN: 0px 0px 0px 0px; height:27px;
}
#header LI {
	PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; WIDTH: 109px; PADDING-RIGHT: 0px;  FLOAT: left;  color:#FFFFFF;   background-image:url(<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_bg2.jpg);height:32px; padding-top:5px;
}

#header A {
	PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 15px; DISPLAY: block; PADDING-TOP: 5px;
}
#header .current {
	  BACKGROUND: #ffffff;   background-image:url(<?php echo $this->_tpl_vars['template_root']; ?>
/images/tab_bg1.jpg);
}
#header .current A {
	PADDING-BOTTOM: 0px; font-weight:bold; color:#FFFFFF;
}
.content {
	MARGIN-TOP: 0px;
}
.content .contentMain {
	TEXT-ALIGN: left
}
</style>
</head>

<body>


	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1"><tr><td valign="middle" class="hui_bj"><div class="menu">
<ul>
    <li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>b<?php else: ?>a<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if ($_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member">运维账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if ($_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
	<li class="me_<?php if ($_SESSION['RADIUSUSERLIST']): ?>a<?php else: ?>b<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an1<?php if (! $_SESSION['RADIUSUSERLIST']): ?>1<?php endif; ?>.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=radiususer">RADIUS账号列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an3<?php if (! $_SESSION['RADIUSUSERLIST']): ?>3<?php endif; ?>.jpg" align="absmiddle"/></li>
	<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=usergroup">运维账号组列表</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
	<?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?>
    <li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_member&action=online">在线用户</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<li class="me_b"><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an11.jpg" align="absmiddle"/><a href="admin.php?controller=admin_ipacl&action=loginpolicy">登录策略</a><img src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/an33.jpg" align="absmiddle"/></li>
	<?php endif; ?>
</ul><span class="back_img"><A href="admin.php?controller=admin_member&action=<?php if ($this->_tpl_vars['radiususer']): ?><?php echo $this->_tpl_vars['radiususer']; ?>
<?php elseif ($_GET['fromgroup']): ?>groupuser&gid=<?php echo $_GET['fromgroup']; ?>
<?php else: ?>index<?php endif; ?>&back=1"><IMG src="<?php echo $this->_tpl_vars['template_root']; ?>
/images/back1.png" 
      width="80" height="25" border="0"></A></span>
</div></td></tr>
	
	 </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1"><tr><td>	<FORM onSubmit="javascript: return check_add_user();" method=post 
      name=add_user 
      action=admin.php?controller=admin_member&action=save&uid=<?php echo $this->_tpl_vars['member']['uid']; ?>
>
      <?php if ($_SESSION['RADIUSUSERLIST']): ?>
<table bordercolor="white" cellspacing="0" cellpadding="1" border="0" width="100%"  class="BBtable" >
<tr><th colspan="3" class="list_bg"></th></tr>
				<?php $this->assign('trnumber', 0); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right><font color="red">*</font><?php echo $this->_tpl_vars['language']['Username']; ?>
：</td>
						<td><input type="text" name="username" class="wbk input_shorttext" <?php if ($this->_tpl_vars['member']['uid']): ?>readonly<?php endif; ?> value="<?php echo $this->_tpl_vars['member']['username']; ?>
"></td>
					</tr>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right><font color="red">*</font><?php echo $this->_tpl_vars['language']['Password']; ?>
：</td>
						<td>
						<span style="float:left; padding-top:10px;"><input type="password" id="password1" name="password1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['member']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="input_shorttext" onKeyUp=pwStrength(this.value) 
onBlur=pwStrength(this.value) > <?php echo $this->_tpl_vars['pwdshould']; ?>
 <input onClick="setrandompwd();" id="autosetpwd" type="checkbox" name="autosetpwd" value="1" />随机密码</span>
 <SPAN class="passwordcss">
                  <TABLE  border=0 cellSpacing=0  cellPadding=0 >
                    <TBODY>
                      <TR align=center bgColor=#F1F1F1>
                        <TD id=strength_L width="33%">弱</TD>
                        <TD id=strength_M width="33%">中</TD>
                        <TD id=strength_H  width="33%">强</TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </SPAN></td>
					</tr>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
						<td width="33%" align=right><font color="red">*</font><?php echo $this->_tpl_vars['language']['Commitpassword']; ?>
：</td>
						<td><input type="password"  id="password2" name="password2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['member']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="input_shorttext"></td>
						</tr>
					
					
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr id="loginleveltr" <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
               
                  <TD  width="33%" align=right>Cisco授权级别： </TD>
                  <TD><select  class="wbk"  name=priv>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=16) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_sections['k']['index']; ?>
" <?php if ($this->_sections['k']['index'] == $this->_tpl_vars['priv']): ?>selected<?php endif; ?>><?php echo $this->_sections['k']['index']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>                  
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr id="loginleveltr" <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
               
                  <TD  width="33%" align=right>华为授权级别： </TD>
                  <TD><select  class="wbk"  name=huaweipriv>
                     	<?php unset($this->_sections['h']);
$this->_sections['h']['name'] = 'h';
$this->_sections['h']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['h']['show'] = true;
$this->_sections['h']['max'] = $this->_sections['h']['loop'];
$this->_sections['h']['step'] = 1;
$this->_sections['h']['start'] = $this->_sections['h']['step'] > 0 ? 0 : $this->_sections['h']['loop']-1;
if ($this->_sections['h']['show']) {
    $this->_sections['h']['total'] = $this->_sections['h']['loop'];
    if ($this->_sections['h']['total'] == 0)
        $this->_sections['h']['show'] = false;
} else
    $this->_sections['h']['total'] = 0;
if ($this->_sections['h']['show']):

            for ($this->_sections['h']['index'] = $this->_sections['h']['start'], $this->_sections['h']['iteration'] = 1;
                 $this->_sections['h']['iteration'] <= $this->_sections['h']['total'];
                 $this->_sections['h']['index'] += $this->_sections['h']['step'], $this->_sections['h']['iteration']++):
$this->_sections['h']['rownum'] = $this->_sections['h']['iteration'];
$this->_sections['h']['index_prev'] = $this->_sections['h']['index'] - $this->_sections['h']['step'];
$this->_sections['h']['index_next'] = $this->_sections['h']['index'] + $this->_sections['h']['step'];
$this->_sections['h']['first']      = ($this->_sections['h']['iteration'] == 1);
$this->_sections['h']['last']       = ($this->_sections['h']['iteration'] == $this->_sections['h']['total']);
?>
				<option value="<?php echo $this->_sections['h']['index']; ?>
" <?php if ($this->_sections['h']['index'] == $this->_tpl_vars['huaweipriv']): ?>selected<?php endif; ?>><?php echo $this->_sections['h']['index']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>                  
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr id="loginleveltr" <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
               
                  <TD  width="33%" align=right>登录协议： </TD>
                  <TD><input type="checkbox" name="radiusssh" <?php if (! $this->_tpl_vars['member']['uid'] || $this->_tpl_vars['radiusssh']): ?>checked<?php endif; ?> value="1" />SSH&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="radiustelnet"  <?php if (! $this->_tpl_vars['member']['uid'] || $this->_tpl_vars['radiustelnet']): ?>checked<?php endif; ?> value="1" />TELNET
				  </TD>
                </TR>
				<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['effectatdate']; ?>
：		</td>
       <TD>
       <INPUT value="<?php echo $this->_tpl_vars['member']['start_time']; ?>
" id="start_time" name="start_time" >&nbsp;&nbsp;
<input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk"></TD>
	</tr>
					<?php $this->assign('trnumber', $this->_tpl_vars['trnumber']+1); ?>
					<tr <?php if ($this->_tpl_vars['trnumber'] % 2 == 0): ?>bgcolor="f7f7f7"<?php endif; ?>>
		<td width="33%" align=right>
		<?php echo $this->_tpl_vars['language']['Expiretime']; ?>
：		</td>
       <TD>
       
       <INPUT value="<?php if ($this->_tpl_vars['member']['end_time'] != '2037-01-01 00:00:00'): ?><?php echo $this->_tpl_vars['member']['end_time']; ?>
<?php endif; ?>" id="limit_time" name="limit_time" onFocus="setday(this)">&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk"> 
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true,
	popupDirection:'up'
});
cal.manageFields("f_rangeStart_trigger", "start_time", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "limit_time", "%Y-%m-%d %H:%M:%S");


</script>
                      <?php echo $this->_tpl_vars['language']['AlwaysValid']; ?>
<INPUT value="1" <?php if ($this->_tpl_vars['member']['end_time'] == '2037-01-01 00:00:00' || ! $this->_tpl_vars['member']['end_time']): ?> checked <?php endif; ?> type=checkbox name="nolimit">  </TD>
	</tr>
		<tr><td>&nbsp;</td><td align="left"><input type=submit  value="保存修改" class="an_02"></td></tr></table>
		<?php else: ?>
  <DIV style="WIDTH:98%" id=navbar>
    <DIV  class=content>
        <TABLE width="98%" border="0" align="center" cellpadding="5" 
      cellspacing="0" class="BBtable">
	  <TR>
      <TD height="27" colspan="4" class="tb_t_bg">基本信息</TD>
    </TR>
          <TR bgcolor="#f7f7f7">
            <TD width="14%" align="right"><font color="red">*</font>用户名：</TD>
            <TD width="36%"><input type="text" name="username" class="wbk input_shorttext" <?php if ($this->_tpl_vars['member']['uid']): ?>readonly<?php endif; ?> value="<?php echo $this->_tpl_vars['member']['username']; ?>
"></TD>
            <TD width="14%" align="right"><font color="red">*</font>真实姓名：</TD>
            <TD><input type="text"  name="realname" class="wbk input_shorttext" value="<?php echo $this->_tpl_vars['member']['realname']; ?>
"></TD>
          </TR>
          <TR>
            <TD width="14%" align="right"><font color="red">*</font>密码：</TD>
            <TD width="36%"><SPAN style=" padding-top:5px;float: left; width:250px;">
              <input type="password" id="password1" name="password1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['member']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="input_shorttext" onKeyUp=pwStrength(this.value) 
onBlur=pwStrength(this.value) > <?php echo $this->_tpl_vars['pwdshould']; ?>
 <input onClick="setrandompwd();" id="autosetpwd" type="checkbox" name="autosetpwd" value="1" />
              随机密码</SPAN>
              <SPAN class="passwordcss">
                  <TABLE  border=0 cellSpacing=0  cellPadding=0 style="width:50px;">
                    <TBODY>
                      <TR align=center bgColor=#F1F1F1>
                        <TD id=strength_L width="33%">弱</TD>
                        <TD id=strength_M width="33%">中</TD>
                        <TD id=strength_H  width="33%">强</TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </SPAN></TD>
            <TD align="right"><font color="red">*</font>确认密码：</TD>
            <TD><input type="password"  id="password2" name="password2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['member']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="input_shorttext"></TD>
          </TR>
          <TR bgcolor="#f7f7f7">
            <TD align="right">电子邮件：</TD>
            <TD><input type="text" name="email" class="wbk input_shorttext"value="<?php echo $this->_tpl_vars['member']['email']; ?>
"></TD>
            <TD align="right">手机号码：</TD>
            <TD><input type="text" name="mobilenum" class="input_shorttext" value="<?php echo $this->_tpl_vars['member']['mobilenum']; ?>
"></TD>
          </TR>
          <INPUT name="priv2" type="hidden" 
        value="0">
          <TR>
            <TD align="right">工作单位：</TD>
            <TD><input type="text" name="workcompany" class="input_shorttext" value="<?php echo $this->_tpl_vars['member']['workcompany']; ?>
"> </TD>
            <TD align="right">工作部门：</TD>
            <TD><INPUT name="workdepartment" class="input_shorttext" type="text" 
            value="<?php echo $this->_tpl_vars['member']['workdepartment']; ?>
">            </TD>
          </TR>
          <TR bgcolor="#f7f7f7">
            <TD align="right">运维组： </TD>
            <TD><select  class="wbk"  name=groupid id="usergroup" >
                            <?php if ($_SESSION['ADMIN_LEVEL'] == 1): ?><option value="" >无</option><?php endif; ?>
                     	<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<option value="<?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['member']['groupid']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['usergroup'][$this->_sections['g']['index']]['GroupName']; ?>
</option>
					<?php endfor; endif; ?>
              </SELECT>            </TD>
            <TD align="right">认证方式：</TD>
            <TD><input type="checkbox" name="localauth" class="" value="1" <?php if ($this->_tpl_vars['member']['localauth']): ?>checked<?php endif; ?>>本地认证&nbsp;&nbsp;<input type="checkbox" name="radiusauth" class="" value="1" <?php if ($this->_tpl_vars['member']['radiusauth']): ?>checked<?php endif; ?>>RADIUS认证&nbsp;&nbsp;<input type="checkbox" name="ldapauth" class="" value="1" <?php if ($this->_tpl_vars['member']['ldapauth']): ?>checked<?php endif; ?>>LDAP认证&nbsp;&nbsp;<input type="checkbox" name="adauth" class="" value="1" <?php if ($this->_tpl_vars['member']['adauth']): ?>checked<?php endif; ?>>AD认证&nbsp;&nbsp;</TD>
          </TR>
           <TR bgcolor="">
      <TD align="right">生效时间： </TD>
      <TD><INPUT value="<?php echo $this->_tpl_vars['member']['start_time']; ?>
" id="start_time" name="start_time" >&nbsp;&nbsp;
<input type="button"  id="f_rangeStart_trigger" name="f_rangeStart_trigger" value="选择时间" class="wbk">
      </TD>
      <TD align="right">过期时间：</TD>
      <TD><INPUT value="<?php if ($this->_tpl_vars['member']['end_time'] != '2037-01-01 00:00:00'): ?><?php echo $this->_tpl_vars['member']['end_time']; ?>
<?php endif; ?>" id="limit_time" name="limit_time" onFocus="setday(this)">&nbsp;&nbsp;<input type="button"  id="f_rangeEnd_trigger" name="f_rangeEnd_trigger" value="选择时间" class="wbk"> 
  <script type="text/javascript">
var cal = Calendar.setup({
    onSelect: function(cal) { cal.hide() },
    showTime: true,
	popupDirection:'up'
});
cal.manageFields("f_rangeStart_trigger", "start_time", "%Y-%m-%d %H:%M:%S");
cal.manageFields("f_rangeEnd_trigger", "limit_time", "%Y-%m-%d %H:%M:%S");


</script>
                      <?php echo $this->_tpl_vars['language']['AlwaysValid']; ?>
<INPUT value="1" <?php if ($this->_tpl_vars['member']['end_time'] == '2037-01-01 00:00:00' || ! $this->_tpl_vars['member']['end_time']): ?> checked <?php endif; ?> type=checkbox name="nolimit"> 
      </TD>
    </TR>
	<TR bgcolor="#f7f7f7">
      <TD align="right">锁定：</TD>
      <TD><input type="checkbox" name="loginlock" value="on" <?php if ($this->_tpl_vars['member']['loginlock']): ?>checked<?php endif; ?>></TD>
      <TD align="right">来源IP：</TD>
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
" <?php if ($this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname'] == $this->_tpl_vars['member']['sourceip']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['sourceip'][$this->_sections['t']['index']]['groupname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>  
      </TD>
    </TR>
	<TR bgcolor="">
      <TD align="right">周组策略：</TD>
      <TD><select  class="wbk" id=weektime name=weektime>
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
" <?php if ($this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname'] == $this->_tpl_vars['member']['weektime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['weektime'][$this->_sections['k']['index']]['policyname']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT> </TD>
      <TD align="right">限制工具登录：</TD>
      <TD><input type="checkbox" name="restrictweb" value="on" <?php if ($this->_tpl_vars['member']['restrictweb']): ?>checked<?php endif; ?>> 
      </TD>
    </TR>

	<TR bgcolor="#f7f7f7">
      <TD align="right">证书CN：</TD>
      <TD><input type="text" name="cacn" class="input_shorttext" value="<?php echo $this->_tpl_vars['member']['cacn']; ?>
" style="width:380px"></TD>
      <TD align="right"></TD>
      <TD> 
      </TD>
    </TR>
    <TR>
      <TD height="27" colspan="4" class="tb_t_bg">权限信息</TD>
    </TR>
    <TR bgcolor="#f7f7f7">
      <TD align="right">用户权限：</TD>
      <TD colspan="3"><ul style="LIST-STYLE-TYPE: none;"><li style=" float:left;width:100">
						<select  class="wbk"  name="level" onchange='changelevel(this.value);' <?php if (0 && $this->_tpl_vars['member']['uid']): ?>disabled<?php endif; ?>>
							<?php if ($_SESSION['ADMIN_LEVEL'] == 3): ?>
							<option value="0" <?php if ($this->_tpl_vars['member']['level'] == 0): ?>selected<?php endif; ?>>运维<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="21" <?php if ($this->_tpl_vars['member']['level'] == 21): ?>selected<?php endif; ?>>部门<?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
</option>
							<option value="101" <?php if ($this->_tpl_vars['member']['level'] == 101): ?>selected<?php endif; ?>>部门<?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<?php else: ?>
							<option value="0" <?php if ($this->_tpl_vars['member']['level'] == 0): ?>selected<?php endif; ?>>运维<?php echo $this->_tpl_vars['language']['User']; ?>
</option>
							<option value="1" <?php if ($this->_tpl_vars['member']['level'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="3" <?php if ($this->_tpl_vars['member']['level'] == 3): ?>selected<?php endif; ?>>部门<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="2" <?php if ($this->_tpl_vars['member']['level'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
</option>
							<option value="21" <?php if ($this->_tpl_vars['member']['level'] == 21): ?>selected<?php endif; ?>>部门<?php echo $this->_tpl_vars['language']['auditadministrator']; ?>
</option>
							<option value="10" <?php if ($this->_tpl_vars['member']['level'] == 10): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="101" <?php if ($this->_tpl_vars['member']['level'] == 101): ?>selected<?php endif; ?>>部门<?php echo $this->_tpl_vars['language']['Password']; ?>
<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<option value="4" <?php if ($this->_tpl_vars['member']['level'] == 4): ?>selected<?php endif; ?>>配置<?php echo $this->_tpl_vars['language']['Administrator']; ?>
</option>
							<?php endif; ?>
						</select></li><li style=" float:left;width:100" id="common_user_pri_div">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="common_user_pri" type="checkbox" name="common_user_pri" <?php if ($this->_tpl_vars['member']['common_user_pri']): ?>checked<?php endif; ?> value="on" />运维权限</li><li style=" float:left;width:100" id="passwd_user_pri_div">&nbsp;&nbsp;<input id="passwd_user_pri" type="checkbox" name="passwd_user_pri" <?php if ($this->_tpl_vars['member']['passwd_user_pri']): ?>checked<?php endif; ?> value="on" />密码权限</li><li style=" float:left;width:100" id="audit_user_pri_div">&nbsp;&nbsp;<input id="audit_user_pri" type="checkbox" name="audit_user_pri" <?php if ($this->_tpl_vars['member']['audit_user_pri']): ?>checked<?php endif; ?> value="on" />审计权限</li></ul>&nbsp;&nbsp;
      </TD>
    </TR>
	<TR>
      <TD align="right">
	<?php echo $this->_tpl_vars['language']['ManagerDeviceGroup']; ?>
：</TD><TD colspan="3">
						一级<select  class="wbk"  name="ldapid1" id="ldapid1" onchange="changelevels(this.value,0)">
		<?php if ($_SESSION['ADMIN_LEVEL'] != 3 && $_SESSION['ADMIN_LEVEL'] != 21 && $_SESSION['ADMIN_LEVEL'] != 101): ?>
		<OPTION VALUE="0">无</option>
		<?php endif; ?>
		<?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['allsgroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($_SESSION['ADMIN_MSERVERGROUP'] == $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']): ?>
			<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php elseif (! $this->_tpl_vars['member']['uid']): ?>
			<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php else: ?>
			<?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['level'] == 1): ?>
			<OPTION VALUE="<?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['ldapid1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allsgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
			<?php endif; ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		二级<select  class="wbk"  name="ldapid2" id="ldapid2" onchange="changelevel2(this.value,0)">
		</select>
		设备组<select  class="wbk"  name="g_id" id="servergroup">
		<?php if ($this->_tpl_vars['logined_user_level']): ?>
				<option value="0" >无</option>
		<?php endif; ?>
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
		<?php if ($this->_tpl_vars['member']['mservergroup'] == $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']): ?>
		<?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['level'] == 0): ?>
			<option VALUE="<?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['id'] == $this->_tpl_vars['g_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allgroup'][$this->_sections['g']['index']]['groupname']; ?>
</option>
		<?php endif; ?>
		<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
		&nbsp;&nbsp;管理用户组 ：<select  class="wbk" id="ug_id"  name=musergroup>
                     	<?php unset($this->_sections['gg']);
$this->_sections['gg']['name'] = 'gg';
$this->_sections['gg']['loop'] = is_array($_loop=$this->_tpl_vars['usergroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['gg']['show'] = true;
$this->_sections['gg']['max'] = $this->_sections['gg']['loop'];
$this->_sections['gg']['step'] = 1;
$this->_sections['gg']['start'] = $this->_sections['gg']['step'] > 0 ? 0 : $this->_sections['gg']['loop']-1;
if ($this->_sections['gg']['show']) {
    $this->_sections['gg']['total'] = $this->_sections['gg']['loop'];
    if ($this->_sections['gg']['total'] == 0)
        $this->_sections['gg']['show'] = false;
} else
    $this->_sections['gg']['total'] = 0;
if ($this->_sections['gg']['show']):

            for ($this->_sections['gg']['index'] = $this->_sections['gg']['start'], $this->_sections['gg']['iteration'] = 1;
                 $this->_sections['gg']['iteration'] <= $this->_sections['gg']['total'];
                 $this->_sections['gg']['index'] += $this->_sections['gg']['step'], $this->_sections['gg']['iteration']++):
$this->_sections['gg']['rownum'] = $this->_sections['gg']['iteration'];
$this->_sections['gg']['index_prev'] = $this->_sections['gg']['index'] - $this->_sections['gg']['step'];
$this->_sections['gg']['index_next'] = $this->_sections['gg']['index'] + $this->_sections['gg']['step'];
$this->_sections['gg']['first']      = ($this->_sections['gg']['iteration'] == 1);
$this->_sections['gg']['last']       = ($this->_sections['gg']['iteration'] == $this->_sections['gg']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['usergroup'][$this->_sections['gg']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['usergroup'][$this->_sections['gg']['index']]['id'] == $this->_tpl_vars['member']['musergroup']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['usergroup'][$this->_sections['gg']['index']]['GroupName']; ?>
</option>
					<?php endfor; endif; ?>
                  </SELECT>
	</TD>
    </TR>
	<TR bgcolor="#f7f7f7">
      <TD align="right" bordercolor="white">数据库运维权限：</TD>
      <TD bordercolor="white"><select  class="wbk"  name=db_priority <?php if (! $_SESSION['DBAUDIT_CONFIG_ON'] || $_SESSION['ADMIN_LEVEL'] == 3): ?> disabled<?php endif; ?>>                     
							<option value="-1" <?php if (! $this->_tpl_vars['member']['db_priority'] == -1): ?>selected<?php endif; ?>>无</option>
							<option value="1" <?php if ($this->_tpl_vars['member']['db_priority'] == 1): ?>selected<?php endif; ?>>管理员</option>
							<option value="2" <?php if ($this->_tpl_vars['member']['db_priority'] == 2): ?>selected<?php endif; ?>>审计员</option>
						</SELECT> 
      </TD>
      <TD align="right" bordercolor="white">日志审计权限：</TD>
      <TD bordercolor="white"><select  class="wbk"  name=log_priority <?php if (! $_SESSION['LOG_CONFIG_ON'] || $_SESSION['ADMIN_LEVEL'] == 3): ?> disabled<?php endif; ?>>                     
							<option value="-1" <?php if ($this->_tpl_vars['member']['log_priority'] == -1): ?>selected<?php endif; ?>>无</option>
							<option value="0" <?php if ($this->_tpl_vars['member']['log_priority'] == 0): ?>selected<?php endif; ?>>普通用户</option>
							<option value="1" <?php if ($this->_tpl_vars['member']['log_priority'] == 1): ?>selected<?php endif; ?>>管理员</option>
						</SELECT>  </TD>
    </TR>
    <TR>
      <TD align="right">VPN IP：</TD>
      <TD><input type="text" id="vpnip" name="vpnip" class="wbk input_shorttext" value="<?php echo $this->_tpl_vars['member']['vpnip']; ?>
"> &nbsp;&nbsp;&nbsp;&nbsp;  <input type="checkbox" name="vpn" id="vpn"  value="on" onclick="checkvpn(this.checked);"  <?php if (! $this->_tpl_vars['member']['vpn']): ?>checked<?php endif; ?>>不允许使用vpn
      </TD>
      <TD align="right">动态口令卡： </TD>
      <TD>含有字符<input type="text" class="wbk" size="10" id="filtertext" onChange="filter();" />
                  <select  class="wbk"  name=usbkey id="usbkeyid">
                      <OPTION value=""><?php echo $this->_tpl_vars['language']['nobind']; ?>
</OPTION>
                     	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['allusbkey']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo $this->_tpl_vars['allusbkey'][$this->_sections['k']['index']]['keyid']; ?>
" <?php if ($this->_tpl_vars['allusbkey'][$this->_sections['k']['index']]['keyid'] == $this->_tpl_vars['member']['usbkey']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['allusbkey'][$this->_sections['k']['index']]['keyid']; ?>
</option>
			<?php endfor; endif; ?>
                  </SELECT>       
                  &nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.php?controller=admin_member&action=create_file_usbkey&username=<?php echo $this->_tpl_vars['member']['username']; ?>
" target="_blank"><?php echo $this->_tpl_vars['language']['createfilekey']; ?>
</a>      </TD>
    </TR>
    <TR bgcolor="#f7f7f7">
      <TD align="right" bordercolor="white">RDP剪贴版</TD>
      <TD bordercolor="white">上行：<input type="checkbox" name="rdpclipauth_up" class="" value="1" <?php if ($this->_tpl_vars['member']['rdpclipauth_up'] || ! $this->_tpl_vars['member']['uid']): ?>checked<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;下行：<input type="checkbox" name="rdpclipauth_down" class="" value="1" <?php if ($this->_tpl_vars['member']['rdpclipauth_down'] || ! $this->_tpl_vars['member']['uid']): ?>checked<?php endif; ?>>
      </TD>
      <TD align="right" bordercolor="white">RDP磁盘：</TD>
      <TD bordercolor="white"><input type="checkbox" name="rdpdiskauth_up" class="" value="1" <?php if ($this->_tpl_vars['member']['rdpdiskauth_up'] || ! $this->_tpl_vars['member']['uid']): ?>checked<?php endif; ?>>
       </TD>
    </TR>
    <TR>
      <TD align="right">RDP磁盘映射：</TD>
      <TD><input type="text" name="rdpdisk" class="input_shorttext" value="<?php if (! $this->_tpl_vars['member']['uid']): ?>*<?php else: ?><?php echo $this->_tpl_vars['member']['rdpdisk']; ?>
<?php endif; ?>">例子C:;D:;E:;</TD>
      <TD align="right">允许改密：</TD>
      <TD><input type="checkbox" id="allowchange" name="allowchange" value="on" <?php if ($this->_tpl_vars['member']['allowchange']): ?>checked<?php endif; ?>> </TD>
    </TR>
	 <TR bgcolor="#f7f7f7">
      <TD align="right">rdp本地：</TD>
      <TD><input type="checkbox" name="rdplocal" value="on" <?php if ($this->_tpl_vars['member']['rdplocal']): ?>checked<?php endif; ?>></TD>
      <TD align="right"></TD>
      <TD></TD>
    </TR>
    <TR >
      <TD colspan="4" class="tb_t_bg">其它信息</TD>
    </TR>
    <TR bgcolor="#f7f7f7">
      <TD align="right" bordercolor="white">默认控件： </TD>
      <TD bordercolor="white"><select  class="wbk"  name=default_control>
                     <OPTION value="0" <?php if ($this->_tpl_vars['member']['default_control'] == 0): ?>selected<?php endif; ?>>自动检测</OPTION>
                     <OPTION value="1" <?php if ($this->_tpl_vars['member']['default_control'] == 1): ?>selected<?php endif; ?>>applet</OPTION>
                     <OPTION value="2" <?php if ($this->_tpl_vars['member']['default_control'] == 2): ?>selected<?php endif; ?>>activeX</OPTION>
                  </SELECT> &nbsp;&nbsp;&nbsp;应用发布默认控件：<select  class="wbk"  name=default_appcontrol>
                     <OPTION value="0" <?php if ($this->_tpl_vars['member']['default_appcontrol'] == 0): ?>selected<?php endif; ?>>WEB</OPTION>
                     <OPTION value="1" <?php if ($this->_tpl_vars['member']['default_appcontrol'] == 1): ?>selected<?php endif; ?>>RDP</OPTION>
                  </SELECT>  
      </TD>
      <TD align="right" bordercolor="white"> 显示应用发布IP：</TD>
      <TD bordercolor="white"><input type="checkbox" id="apphost" name="apphost" value="on" <?php if ($this->_tpl_vars['member']['apphost']): ?>checked<?php endif; ?>>
      </TD>
    </TR>
        </TABLE>
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="60" align="center"><input type="submit"  value="保存修改" class="an_02"></td>
          </tr>
        </table>
    </DIV>
  </DIV>


  <?php endif; ?>
  <script>
function changelevel(iid){
	if(iid!=0){
		document.getElementById('servergroup').disabled = true;
		document.getElementById('ug_id').disabled = true;
		if(iid==3||iid==21||iid==101){
			document.getElementById('servergroup').disabled = false;
			document.getElementById('ldapid1').disabled = false;
			document.getElementById('ldapid2').disabled = false;
			document.getElementById('ug_id').disabled = false;	
			document.getElementById('vpnip').disabled = true;
			document.getElementById('passwd_user_pri').disabled = false;
			document.getElementById('audit_user_pri').disabled = true;
			document.getElementById('common_user_pri').disabled = false;
		}else if(iid==1||iid==2){			
			document.getElementById('vpnip').disabled = false;
			document.getElementById('passwd_user_pri').disabled = false;
			document.getElementById('audit_user_pri').disabled = true;
			document.getElementById('common_user_pri').disabled = false;
		}else if(iid==10){
			document.getElementById('vpnip').disabled = false;
			document.getElementById('passwd_user_pri').disabled = true;
			document.getElementById('audit_user_pri').disabled = true;
			document.getElementById('common_user_pri').disabled = true;		
		}else if(iid==4){			
			document.getElementById('vpnip').disabled = false;
			document.getElementById('passwd_user_pri').disabled = false;
			document.getElementById('audit_user_pri').disabled = false;
			document.getElementById('common_user_pri').disabled = false;
		}
		document.getElementById('weektime').disabled = true;
		document.getElementById('allowchange').disabled = true;
		document.getElementById('common_user_pri').disabled = false;
	}else{
		document.getElementById('weektime').disabled = false;
		document.getElementById('ldapid1').disabled = true;
		document.getElementById('ldapid2').disabled = true;
		document.getElementById('servergroup').disabled = true;
		document.getElementById('ug_id').disabled = true;
		document.getElementById('allowchange').disabled = false;
		document.getElementById('passwd_user_pri').disabled = true;
		document.getElementById('audit_user_pri').disabled = true;
		document.getElementById('common_user_pri').disabled = true;		
	}
}
<?php if ($this->_tpl_vars['member']['uid'] && $this->_tpl_vars['member']['level'] > 0): ?>
	document.getElementById('weektime').disabled = true;
	
<?php endif; ?>

function setrandompwd(){
	if(document.getElementById('autosetpwd').checked){
		document.getElementById('password1').value='abc123!@#';
		document.getElementById('password2').value='abc123!@#';
	}else{
		document.getElementById('password1').value='';
		document.getElementById('password2').value='';
	}
}

function checkvpn(checked){
	if(document.getElementById('vpn').checked){
		document.getElementById('vpnip').disabled=true;
	}else{
		document.getElementById('vpnip').disabled=false;
	}
}

checkvpn(<?php if ($this->_tpl_vars['member']['vpn']): ?>true<?php else: ?>false<?php endif; ?>)

changelevels(<?php echo $this->_tpl_vars['ldapid1']; ?>
, <?php echo $this->_tpl_vars['ldapid2']; ?>
);
changelevel2(<?php echo $this->_tpl_vars['ldapid2']; ?>
, <?php echo $this->_tpl_vars['servergroup']; ?>
);

<?php if ($this->_tpl_vars['member']['level'] != ''): ?>
changelevel(<?php echo $this->_tpl_vars['member']['level']; ?>
);
<?php else: ?>
changelevel(0);
<?php endif; ?>
<?php if (( $_SESSION['ADMIN_LEVEL'] == 3 || $_SESSION['ADMIN_LEVEL'] == 21 || $_SESSION['ADMIN_LEVEL'] == 101 ) && $_SESSION['ADMIN_MUSERGROUP']): ?>
//changelevel(<?php echo $_SESSION['ADMIN_LEVEL']; ?>
);
var ug = document.getElementById('usergroup');
for(var i=0; i<ug.options.length; i++){
	if(ug.options[i].value==<?php echo $_SESSION['ADMIN_MUSERGROUP']; ?>
){
		ug.selectedIndex=i;
		ug.onchange = function(){ug.selectedIndex=i;}
		break;
	}
}
<?php endif; ?>
</script>
</FORM>