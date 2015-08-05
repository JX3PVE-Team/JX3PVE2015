<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_plugin_lj_exam.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_plugin_daka_user extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_daka_user';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function fetch_all_by_allday($curnum,$perpage){
		if($perpage){
			return DB :: fetch_all("select * from %t order by allday desc,money desc limit %d,%d",array($this->_table,$curnum,$perpage));
		}else{
			return DB :: fetch_all("select * from %t order by allday desc,money desc ",array($this->_table));
		}
	} 
	public function fetch_by_uid($uid){
		return DB::result_first("select * from %t where uid=%d",array($this->_table,$uid));
	}
	public function update_by_uid($uid,$money,$myall,$mall,$timestamp){
		return DB::query('update %t set money=money+%d,allday=allday+1,day=%d,fen=%d,timestamp=%s where uid=%d',array($this->_table,$money,$myall,$mall,$timestamp,$uid));
	}
}


?>