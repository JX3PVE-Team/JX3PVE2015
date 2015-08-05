<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_menu extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_menu';
        $this->_pk = 'id';
        parent::__construct();
    }

    public function count_by_upid($upid) {
        return DB::result_first('select count(*) from %t where upid=%d and upid!=0 order by displayorder desc', array($this->_table, $upid));
    }

    public function fetch_all_by_upid($upid) {
        return DB::fetch_all('select * from %t where upid=%d order by displayorder desc', array($this->_table, $upid));
    }
    public function fetch_all() {
        return DB::fetch_all('select * from %t  order by displayorder desc', array($this->_table));
    }

}

?>