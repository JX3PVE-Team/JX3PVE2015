<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

include 'source/plugin/aljwsq/include/index.php';
$config = $_G['cache']['plugin']['aljwsq'];
if($config['iswx']){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if (strpos($user_agent, 'MicroMessenger') === false) {
		echo '<script>alert("'.lang('plugin/aljwsq','band').'");</script>';
		exit;
	}
}
include template('aljwsq:index');
?>