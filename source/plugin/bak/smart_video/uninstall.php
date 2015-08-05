<?php
/**
 * 		Copyright£ºSmartCome
 * 		  WebSite£ºwww.SmartCome.com
 *             QQ:2811931192
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<SQL
DROP TABLE IF EXISTS pre_smart_video;
DROP TABLE IF EXISTS pre_smart_video_thread;
DROP TABLE IF EXISTS pre_smart_video_post;
DROP TABLE IF EXISTS pre_smart_video_user;
SQL;
   runquery($sql);
	$finish=true;

?>