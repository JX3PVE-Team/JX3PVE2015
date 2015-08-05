<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_user extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_user';
        $this->_pk = 'openid';

        parent::__construct();
    }
	public function count_by_bindtime(){
		return DB::result_first('select count(*) from %t',array($this->_table));
	}
	public function fetch_all_by_bindtime($start,$limit){
		return DB::fetch_all('select * from %t  order by bindtime desc limit %d,%d',array($this->_table,$start,$limit));
	}
	public function update_username_bindtime_by_openid($openid){
		return DB::query("update %t set username='',bindtime=0 where openid=%s",array($this->_table,$openid));
	}
    

}

?>