<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if(file_exists(DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php')){
	require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
}else{
	echo lang('plugin/aljwsq', 'a1');
}
if($_GET['formhash']==FORMHASH){
WeChatHook::updateResponse(array(
    'receiveMsg::text' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
	'receiveMsg::voice' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
    'receiveEvent::subscribe' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
	'receiveEvent::location' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
    'receiveEvent::click' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
    'receiveEvent::scan' => array('plugin' => 'aljwsq', 'include' => 'aljwsq.inc.php', 'class' => 'wechatCallbackapi', 'method' => 'responsemsg'),
));
WeChatHook::updateRedirect(array('plugin' => 'wechat', 'include' => 'response.class.php', 'class' => 'WSQResponse', 'method' => 'redirect'));
WeChatHook::updateViewPluginId('aljwsq');
cpmsg(lang('plugin/aljwsq', 'register1'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=register', 'succeed');
}else{
$p=WeChatHook::getViewPluginId();
include template('aljwsq:register');
}

