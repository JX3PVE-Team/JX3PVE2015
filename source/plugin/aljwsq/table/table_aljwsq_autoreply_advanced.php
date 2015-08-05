<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_autoreply_advanced extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_autoreply_advanced';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function fetch_all_by_upid($upid, $msgtype, $id) {
        return DB::fetch_all('select * from %t where upid=%d and msgtype=%s and id!=%d order by displayorder,id asc', array($this->_table, $upid, $msgtype, $id));
    }

    public function count_by_upid($upid, $msgtype) {
        return DB::result_first('select * from %t where upid=%d and msgtype=%s', array($this->_table, $upid, $msgtype));
    }

    public function count_by_status($status, $msgtype, $start, $perpage) {
        $con[] = $this->_table;
        $where = 'where 1 ';
        if ($status) {
            $con[] = $status;
            $where.=' and status=%d';
        }
        if ($msgtype) {
            $con[] = $msgtype;
            $where.=' and msgtype=%s';
        }
        $where.=' order by displayorder,updatetime ';
        if ($start && $perpage) {
            $con[] = $start;
            $con[] = $perpage;
            $where.=' limit %d,%d';
        }
        return DB::result_first('select count(*) from %t ' . $where, $con);
    }

    public function fetch_all_by_status($status, $msgtype, $start, $perpage) {
        $con[] = $this->_table;
        $where = 'where 1 ';
        if ($status) {
            $con[] = $status;
            $where.=' and status=%d';
        }
        if ($msgtype) {
            $con[] = $msgtype;
            $where.=' and msgtype=%s';
        }
        $where.=' order by displayorder desc';
        if ($start && $perpage) {
            $con[] = $start;
            $con[] = $perpage;
            $where.=' limit %d,%d';
        }
        return DB::fetch_all('select * from %t ' . $where, $con);
    }

    public function fetch_all_by_mykeyword($mykeyword) {
        return DB::fetch_all('select * from %t where mykeyword=%s', array($this->_table, $mykeyword));
    }

    public function fetch_by_mykeyword($mykeyword) {
        return DB::fetch_first('select * from %t where mykeyword=%s', array($this->_table, $mykeyword));
    }

    public function fetch_by_bindkeyword($bindkeyword) {
        return DB::fetch_first('select * from %t where bindkeyword=%s', array($this->_table, $bindkeyword));
    }

    public function fetch_by_msgtype($msgtype) {
        return DB::fetch_first('select * from %t where msgtype=%s and status=1', array($this->_table, $msgtype));
    }
	public function fetch_all_by_msgtype($msgtype) {
        return DB::fetch_all('select * from %t where msgtype=%s and status=1', array($this->_table, $msgtype));
    }
    public function fetch_by_sign($sign) {
        return DB::fetch_first('select * from %t where sign=%d', array($this->_table, $sign));
    }
   public function fetch_all_by_upid_mykeyword(){
       return DB::fetch_all("select * from %t where status=1 and upid=0 and mykeyword<> ''", array($this->_table, $sign));
   }

}

?>