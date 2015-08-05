<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_mes extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_mes';
        $this->_pk = 'id';

        parent::__construct();
    }
	public function fetch_all_by_upid(){
		return DB::fetch_all('select * from %t where upid=0 order by dateline desc',array($this->_table));
	}
	public function fetch_all_by_upid0($upid){
		return DB::fetch_all('select * from %t where upid=%d order by dateline desc',array($this->_table,$upid));
	}
    

}

?>