<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Deined');
}

class plugin_aljwsq {

  
    function __construct() {
        
    }
	function global_cpnav_extra1(){
		global $_G;
		$config=$_G['cache']['plugin']['aljwsq'];
		include template('aljwsq:follow');
		return $return;
	}
}
class plugin_aljwsq_member extends plugin_aljwsq{
	function register_top(){
		global $_G;
		$config=$_G['cache']['plugin']['aljwsq'];
		include template('aljwsq:invite');
		return $return;
	}
}
?>