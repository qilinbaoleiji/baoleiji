<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class c_admin_backup extends c_base {
	
	function index() {
		$this->table();
	}

	function table(){
		$tables = array(0=>array('n'=>'oracle','s'=>$this->sqlnet_set->get_table_name(),'c'=>$this->sqlcommands_set->get_table_name()),
						1=>array('n'=>'db2','s'=>$this->db2_set->get_table_name(),'c'=>$this->db2cmmands_set->get_table_name()),
						2=>array('n'=>'sqlserver','s'=>$this->sqlserver_set->get_table_name(),'c'=>$this->sqlservercommands_set->get_table_name()),
						3=>array('n'=>'sybase','s'=>$this->sybase_set->get_table_name(),'c'=>$this->sybasecommands_set->get_table_name()),
						4=>array('n'=>'mysql','s'=>$this->mysql_set->get_table_name(),'c'=>$this->mysqlcommands_set->get_table_name())
			);
		if(get_request('do',0, 1)!=''){
			for($i=0; $i<count($tables); $i++){
				if($tables[$i]['n']==get_request('do',0, 1)){
					$this->bkuptable($tables[$i]['s']);
					$this->bkuptable($tables[$i]['c']);
					alert_and_back("备份成功完成!", "admin.php?controller=admin_backup");
					exit;
				}
			}
		}
		$this->assign("page_nav_tabs_selected", "table");
		$this->assign("tables", $tables);
		$this->display("backuptable.tpl");
	}
	
	private function bkuptable($tablename){
		global $dbname;
		$table_name = $tablename;
		$tmp_table_name = 'temp' . $table_name;
		$today_table_name = $table_name . date("Ymd");
		
		//Query if today's table exists
		$query = "SHOW TABLES FROM `$dbname` LIKE '$today_table_name'";
		$result = $this->sqlnet_set->base_select($query);
		if($result != NULL) {
			alert_and_back("今天已经备份过了!", "admin.php?controller=admin_backup");
			exit();
		}
		// Drop temp table if it exists

		$query = "DROP TABLE IF EXISTS `$tmp_table_name`";
		$this->sqlnet_set->query($query);

		// Create new temp table
		$query = "SHOW CREATE TABLE `$table_name`";

		$result = $this->sqlnet_set->base_select($query);
		$query = $result[0]['Create Table'];
		$search = "CREATE TABLE `$table_name`";
		$replace = "CREATE TABLE `$tmp_table_name`";
		$query = str_replace($search, $replace, $query);
		$result = $this->sqlnet_set->query($query);
		if($result !== false) {
		//echo "<br \>成功创建临时表!<br \>";
		}
		else {
			alert_and_back("创建临时表失败!", "admin.php?controller=admin_backup");
			exit();
		}
		// Rename the two tables
		$query = "RENAME TABLE `$dbname`.`$table_name` TO `$dbname`.`$today_table_name`, `$dbname`.`$tmp_table_name` TO `$dbname`.`$table_name`";
		$result = $this->sqlnet_set->query($query);
		if($result !== false) {
		//echo "<br \>重命名表成功!<br \>";
		}
		else {
			alert_and_back("重命名表失败!", "admin.php?controller=admin_backup");
			exit(); 
		}
		$query = "OPTIMIZE TABLE `$dbname`.`$today_table_name`";
		$result = $this->sqlnet_set->query($query);

		if($result !== false) {
		//echo "<br \>优化$dbname.{$today_table_name}成功!<br \>";
		}
		else {
			alert_and_back("优化$dbname.{$today_table_name}失败!", "admin.php?controller=admin_backup");
			exit(); 
		}
		//

	}

	function del_session_table(){
		$tables = array(0=>array('n'=>'oracle','bn'=>'Oracle','s'=>$this->sqlnet_set->get_table_name(),'c'=>$this->sqlcommands_set->get_table_name()),
						1=>array('n'=>'db2','bn'=>'DB2','s'=>$this->db2_set->get_table_name(),'c'=>$this->db2cmmands_set->get_table_name()),
						2=>array('n'=>'sqlserver','bn'=>'SqlServer','s'=>$this->sqlserver_set->get_table_name(),'c'=>$this->sqlservercommands_set->get_table_name()),
						3=>array('n'=>'sybase','bn'=>'SyBase','s'=>$this->sybase_set->get_table_name(),'c'=>$this->sybasecommands_set->get_table_name()),
						4=>array('n'=>'mysql','bn'=>'MySQL','s'=>$this->mysql_set->get_table_name(),'c'=>$this->mysqlcommands_set->get_table_name())
			);
		for($i=0; $i<count($tables); $i++){
			 $sql = "show tables like '".$tables[$i]['s'].'20%\'';
			 $tnames = $this->sqlnet_set->base_select($sql);
			 $ttnames = null;
			 for($j=0; $j<count($tnames); $j++){
				 $keys =  key($tnames[$j]);//var_dump($keys);
				 $ttnames[$j]['n']=$tnames[$j][$keys];
			 }
			
			 $this->assign($tables[$i]['n'], $ttnames);
		}
		$this->assign("page_nav_tabs_selected", 'del_session_table');
		$this->display("datadel.tpl");
	}
	

	function dodel_session_table(){
		$table = get_request("stable", 1, 1);
		if(empty($table)){
			alert_and_back('请选择表');
			exit;
		}
		$ymd = substr($table, strlen($table)-8);
		$ctable = substr($table,0, strpos($table, "_")+1).'commands'.$ymd;
		//var_dump($table);var_dump($ctable);
		$this->sqlnet_set->query("drop table ".$table);
		$this->sqlnet_set->query("drop table ".$ctable);
		alert_and_back('操作成功');
	}

	function String2File($sIn, $sFileOut) {
	  $rc = false;
	  do {
	   if (!($f = @fopen($sFileOut, "wa+"))) {
	     $rc = 1; 
	     alert_and_back('打开文件失败,请检查文件权限');
	     break;
	   }
	   if (!@fwrite($f, $sIn)) {
	     $rc = 2; 
	     //alert_and_back('写入文件失败,请检查文件权限');
	     break;
	   }
	   $rc = true;
	  } while (0);
	  if ($f) {
	   fclose($f);
	  }
	  return ($rc);
	}

	function Array2File($aIn, $sFileOut) {
	  return ($this->String2File(implode("", $aIn), $sFileOut));
	}
}
?>
