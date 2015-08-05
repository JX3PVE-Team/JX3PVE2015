<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_ggk_log extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_ggk_log';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function count_by_uid_dateline($uid) {
        //$s = '%Y%m%d';
        $curtime = strtotime(gmdate('Ymd', TIMESTAMP + 3600 * 8));
        return DB::result_first('select count(*) from %t where dateline>%s and uid=%d', array($this->_table, $curtime, $uid));
    }
    public function fetch_all_by_rid(){
        return DB::fetch_all('select * from %t where rid!=0 order by dateline desc',array($this->_table));
    }

}

?>