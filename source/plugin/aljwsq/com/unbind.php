<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
$user=DB::fetch_first('SELECT * FROM %t WHERE openid=%s', array('aljwsq_user', $postObj->FromUserName));

if($user){
	C::t('#wechat#common_member_wechatmp')->delete($_G['uid']);
	DB::query('delete FROM %t WHERE openid=%s', array('aljwsq_user', $postObj->FromUserName));
	echo $this->responsetext($postObj, lang('plugin/aljwsq', 'unbindtips'));
}else{
	echo $this->responsetext($postObj, lang('plugin/aljwsq', 'bindtips'));
	//echo $this->responsetext($postObj, $user['openid'].'123');
}


?>