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

class table_plugin_daka extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_daka';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function fetch_by_tables(){
		return DB :: result_first("show tables like '" . DB :: table('plugin_daka') . "'");
	}
	public function fetch_by_uid($uid){
		return DB :: result_first("select count(*) from " . DB :: table($this->_table) . " where uid=$uid and timestamp>='".strtotime(date('Y-m-d 00:00:00'))."'");
	}
	public function fetch_by_uid_yesterday($uid,$mytime){
		return DB :: result_first("select alldays from " . DB :: table($this->_table) . " where uid=$uid and timestamp >='".(strtotime(date('Y-m-d 00:00:00'))-86400)."' and timestamp <='".strtotime(date('Y-m-d 00:00:00'))."'");
	}
}


?>