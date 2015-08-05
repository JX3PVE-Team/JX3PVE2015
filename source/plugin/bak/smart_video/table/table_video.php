<?php
/**
 * 		Copyright£ºSmartCome
 * 		 WebSite£ºwww.SmartCome.com
 *       QQ:2811931192
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
 
class table_video  extends discuz_table
{
	public function __construct() {

		$this->_table = 'smart_video';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function recommod_by_author($authorid,$num){
		$authorid=intval($authorid);$num=intval($num);
		$sql="SELECT * FROM ".DB::table("smart_video_thread")." where authorid=$authorid order by dateline desc limit 0,$num";
		return DB::fetch_all($sql);
		}
	public function result_first($key,$table,$where){
		return DB::result_first("select $key from ".DB::table($table)." where ".$where);
		}	
	public function update_by_where($table,$data,$where) {
		return DB::update($table,$data,$where);
	
	}
  public function increase_by_where($table,$key,$where) {
	  $sql="UPDATE ".DB::table($table)." SET $key=$key+1 WHERE ".$where;
		return DB::query($sql);
	
	}
	public function insert_new($table,$data,$return=false) {
		return DB::insert($table,$data,$return);
	
	}	
	public function delete_by_where($where,$table='smart_video') {
		$sql="DELETE FROM ".DB::table($table)." WHERE ".$where;
		return DB::query($sql);
	
	}
	public function count_by_where($table,$where) {
		$sql="SELECT COUNT(*) FROM " .DB::table($table)." WHERE ".$where;
		return DB::result_first($sql);
	}
	public function fetch_first($table,$where){
		return DB::fetch_first("SELECT * FROM ".DB::table($table)." where ".$where);
		}
	public function fetch_all($where){
		return DB::fetch_all("SELECT * FROM ".DB::table($this->_table)." where ".$where." order by displayorder asc");
		}	
	public function fetch_all_by_where($table,$where, $orderby, $start = 0, $ppp = 0) {
		$sql="SELECT * FROM ".DB::table($table)." WHERE ".$where." ORDER BY ".$orderby." LIMIT ".$start.",".$ppp;
		//echo $sql;
		return DB::fetch_all($sql);
	}
	public function get_location_by_where($level,$upid){
		$level=intval($level);$upid=intval($upid);
		if(!$upid){
		$sql="SELECT * FROM ".DB::table("common_district")." WHERE level=$level";
		}else{
		$sql="SELECT * FROM ".DB::table("common_district")." WHERE level=$level and upid=$upid";
			}
		return DB::fetch_all($sql);
		}
    public function  fetch_all_by_array($table,$key,$data){
		 $con=$this->get_condition($data);   
		 $sql="select * FROM ".DB::table($table)." where $key IN $con";
		 return DB::fetch_all($sql);
		 }	 	    
	private function get_condition($data){
		 $con="(";
			 foreach($data as $k=>$v){
				 $con.=intval($v).',';
				 }
		 $con.=$first.')';
		 return str_replace(',)',')',$con);
	}

}


?>