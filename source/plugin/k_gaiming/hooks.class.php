<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_k_gaiming {
}

class plugin_k_gaiming_home extends plugin_k_gaiming{
	function spacecp_credit_bottom_output(){
		global $_G;
		$setting = $_G['cache']['plugin']['k_gaiming'];
		
		lang('spacecp');
		$_G['lang']['spacecp']['logs_credit_update_KGM'] = lang('plugin/k_gaiming', 'gaiming');

	}
}

?>