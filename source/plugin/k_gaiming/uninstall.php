<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_gaiming_log')."");
$finish = TRUE;
?>