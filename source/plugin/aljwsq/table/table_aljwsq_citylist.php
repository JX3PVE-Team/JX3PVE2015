<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_citylist extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_citylist';
        $this->_pk = 'd1';

        parent::__construct();
    }
	public function fetch_d1_by_d2($d2){
		return DB::result_first('select d1 from %t where d2=%s',array($this->_table,$d2));
	}
    

}

?>