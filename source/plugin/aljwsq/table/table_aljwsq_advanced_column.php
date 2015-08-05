<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_advanced_column extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_advanced_column';
        $this->_pk = 'id';

        parent::__construct();
    }
	public function fetch_all_by_displayorder($displayorder){
		return DB::fetch_all('select * from %t where displayorder=%d',array($this->_table,$displayorder));
	}
	public function fetch_all_by_fid($fid){
		return DB::fetch_all('select * from %t where fid=%d',array($this->_table,$fid));
	}

}

?>