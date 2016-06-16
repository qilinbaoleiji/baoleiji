<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_interface extends c_base {
	function process_postdata(){
		$r = json_decode($_POST['data']);
		if(!is_array($r)){
			$result['result']=0;
			$result['msg']='json格式解析错误';
			$result['data']=array();
			echo json_encode($result);
			return false;
		}
		return $r;
	}

	function radiususerAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=true;
		$_POST = $data;
		$_GET['uid']=$data['uid'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$id=$newmember->save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$memberset->select_all('uid="'.$id.'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function radiususerDel(){
		global $_CONFIG;		
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=true;
		$_POST['chk_member']=$data['uid'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$newmember->delete_all();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=array();
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function radiususerList(){
		global $_CONFIG;		
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=true;
		$_GET=$data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$datas=$newmember->index(true,true );
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function userAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=false;
		$_POST = $data;
		$_GET['uid']=$data['uid'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$id=$newmember->save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$memberset->select_all('uid="'.$id.'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function userDel(){
		global $_CONFIG;		
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=false;
		$_POST['chk_member']=$data['uid'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$newmember->delete_all();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=array();
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function userList(){
		global $_CONFIG;		
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_SESSION['RADIUSUSERLIST']=false;
		$_GET=$data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_member.class.php");	
		$newmember = new c_admin_member();
		$memberset = new member_set();
		$newmember->init($this->smarty, $this->config);
		ob_start();
		$datas=$newmember->index(false,true );
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function serverAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$serverset = new server_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$newpro->dev_save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$serverset->select_all('device_ip="'.$_POST['device_ip'].'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function serverDel(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_POST['chk_member']=$data['id'];
		
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$serverset = new server_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$newpro->dev_del();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=array();
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function serverList(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_GET = $data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$serverset = new server_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$datas = $newpro->dev_index();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function deviceAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");
		for($i=0; $i<count($_POST['users']); $i++){
			$_POST['Check'.$i]=$_POST['users'][$i];
		}
		for($i=0; $i<count($_POST['groups']); $i++){
			$_POST['Group'.$i]=$_POST['groups'][$i];
		}
		$newpro = new c_admin_pro();
		$deviceset = new devpass_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$id = $newpro->pass_save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$deviceset->select_all('id="'.$id.'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function deviceDel(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$serverset = new server_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$newpro->pass_del();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=array();
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function deviceList(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_GET = $data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$serverset = new server_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$datas=$newpro->devpass_index(true);
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function groupAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$sgroupset = new sgroup_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$id = $newpro->dev_group_save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$sgroupset->select_all('id="'.$id.'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function groupDel(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$sgroupset = new sgroup_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$newpro->dev_group_del();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
		}
		echo json_encode($result);
	}

	function groupList(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_GET = $data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$sgroupset = new sgroup_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$datas=$newpro->dev_group(true);
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}


	function resourceAdd(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['id']=$data['id'];
		for($i=0; $i<count($_POST['users']); $i++){
			$_POST['Check'.$i]=$_POST['users'][$i];
		}
		for($i=0; $i<count($_POST['groups']); $i++){
			$_POST['Group'.$i]=$_POST['groups'][$i];
		}
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$resgroupset = new resgroup_set();
		$newpro->init($this->smarty, $this->config);

		$_POST['secend'] = $_POST['devices'];
		for($i=0; $i<count($_POST['users']); $i++){
			$_POST['Check'.$i]=$_POST['users'][$i];
		}
		for($i=0; $i<count($_POST['groups']); $i++){
			$_POST['Group'.$i]=$_POST['groups'][$i];
		}

		ob_start();
		$id = $newpro->resource_group_save();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$resgroupset->select_all('id="'.$id.'"');
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function resourceDel(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_POST = $data;
		$_GET['gname']=$data['gname'];
		
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$resgroupset = new resgroup_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$newpro->resource_group_del();
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if(strpos($matches[1], '成功')!==false){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=array();
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}

	function resourceList(){
		global $_CONFIG;
		if(($data=$this->process_postdata())===false){
			return ;
		}
		$_GET = $data;
		$_GET['derive']=0;
		$this->config['site']['items_per_page']=$_GET['items_per_page'];
		require_once(ROOT ."./controller/c_admin_pro.class.php");	
		$newpro = new c_admin_pro();
		$resgroupset = new resgroup_set();
		$newpro->init($this->smarty, $this->config);
		ob_start();
		$datas=$newpro->resource_group(true);
		$result = ob_get_clean();
		$r = preg_match("/<script language='javascript'>alert\('(.*?)'\);/", $result, $matches);
		if($r=0){
			$result['result']=1;
			$result['msg']='操作成功';
			$result['data']=$datas;
		}else{
			$result['result']=0;
			$result['msg']=$matches[1];
			$result['data']=array();
		}
		echo json_encode($result);
	}
}
?>
