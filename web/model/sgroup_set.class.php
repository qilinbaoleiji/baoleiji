<?php
if(!defined('CAN_RUN')) {
	exit('Access Denied');
}

class sgroup_set extends base_set {
	protected $table_name = 'servergroup';
	protected $id_name = 'id';
	var $allsgroup;

	function insert_user($gid) {
		$this->query("UPDATE $this->table_name SET count = (SELECT count(*) FROM servers WHERE groupid=$gid ) WHERE id = $gid");
	}

	function remove_user($gid) {
		$this->query("UPDATE $this->table_name SET count = (SELECT count(*) FROM servers WHERE groupid=$gid ) WHERE  id = $gid");
	}

	function countsgroups($gid, $index){
		$_child[]=$gid;
		$count = 0;
		$mcount = 0;//var_dump($this->allsgroup[$index]['groupname']);echo ':';
		for($i=0; $i<count($this->allsgroup); $i++){//var_dump($this->allsgroup[$i]['groupname']);
			if($gid==$this->allsgroup[$i]['ldapid']){
				$child = $this->countsgroups($this->allsgroup[$i]['id'], $i);//echo '<br>';
				$count +=$child['count'];
				$mcount+=$child['mcount'];
				$_child=array_merge($_child, $child['child']);
			}
		}
		$this->allsgroup[$index]['count']+=$count;
		$this->allsgroup[$index]['mcount']+=$mcount;//echo '------';
		$this->allsgroup[$index]['child']=$_child;
		//var_dump($this->allsgroup[$index]['id']);echo '<pre>';var_dump($this->allsgroup[$index]['child']);echo '</pre>';
		return array('count'=>$this->allsgroup[$index]['count'],'mcount'=>$this->allsgroup[$index]['mcount'],'child'=>$this->allsgroup[$index]['child']);
	}
	function updatechild(){
		$this->query("UPDATE servergroup a SET count=(select count(*) FROM servers b WHERE a.id=b.groupid)");
		$this->query("UPDATE servergroup a SET mcount=(select count(*) FROM member b WHERE a.id=b.groupid)");
		$this->query("UPDATE servergroup a SET child=id");
		$this->allsgroup=$this->base_select("SELECT id,ldapid,count,mcount FROM servergroup");
		for($ii=0; $ii<count($this->allsgroup); $ii++){
			if($this->allsgroup[$ii]['ldapid']==0){
				$child = $this->countsgroups($this->allsgroup[$ii]['id'], $ii);
				$this->allsgroup[$ii]['child']=$child['child'];
				$this->allsgroup[$ii]['count']=$child['count'];
				$this->allsgroup[$ii]['mcount']=$child['mcount'];
			}
		}
		for($ii=0; $ii<count($this->allsgroup); $ii++){//var_dump($this->allsgroup[$ii]['child']);echo '</pre>';
			$this->query("UPDATE servergroup SET child='".(!empty($this->allsgroup[$ii]['child']) ? implode(',', $this->allsgroup[$ii]['child']) : '')."',count=".intval($this->allsgroup[$ii]['count']).",mcount=".intval($this->allsgroup[$ii]['mcount'])." WHERE id=".$this->allsgroup[$ii]['id']);
		}
	}

}