<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_wxqrcode extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_wxqrcode';
        $this->_pk = 'id';
        parent::__construct();
    }
	public function fetch_by_scene_id($id){
		return DB::fetch_first('select * from %t where scene_id = %d',array($this->_table,$id));
	}

}

?>