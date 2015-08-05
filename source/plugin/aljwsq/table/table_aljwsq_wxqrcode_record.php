<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_wxqrcode_record extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_wxqrcode_record';
        $this->_pk = 'id';
        parent::__construct();
    }
	public function count_by_scene_id($scene_id){
		return DB::result_first('select count(*) from %t where scene_id=%d',array($this->_table,$scene_id));
	}
	public function fetch_all_by_scene_id($scene_id,$start,$perpage){
		return DB::fetch_all('select * from %t where scene_id=%d  order by id desc limit %d,%d',array($this->_table,$scene_id,$start,$perpage));
	}
	public function count_by_openid_dateline($openid,$dateline){
		return DB::result_first('select count(*) from %t where openid=%s and dateline=%d',array($this->_table,$openid,$dateline));
	}

}

?>