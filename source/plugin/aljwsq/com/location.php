<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$config = $_G['cache']['plugin']['aljwsq'];
$openid = u2g($postObj->FromUserName);
$lasttime = DB::result_first('select lasttime from %t where openid = %s',array('aljwsq_user',$openid));
$lasttime = intval($lasttime);
if($lasttime + $config['time'] < TIMESTAMP){
	$news = C::t('#aljwsq#aljwsq_autoreply')->fetch_by_mykeyword($location['bindkeyword']);
	DB::query('update %t set lasttime = %d where openid = %s',array('aljwsq_user',TIMESTAMP,$openid));
}else{
	exit;
}
function g2u($a) {
    return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
    return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}
?>