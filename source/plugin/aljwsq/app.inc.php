<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$sql ="ALTER TABLE `".DB::table('aljwsq_user')."` ADD `lasttime` int(10) NOT NULL ;" ;
DB::query($sql,'SILENT');

if(file_exists( DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php')){
	$pluginid = 'aljwsq';
	$Hooks = array(
		'forumdisplay_topBar',
	);
	$data = array();
	foreach ($Hooks as $Hook) {
		$data[] = array($Hook => array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid . '_api', 'method' => $Hook));
	}
	require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
	WeChatHook::updateAPIHook($data);
}

function is_utf8($word) {
    if (preg_match("/^([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}/", $word) == true || preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}$/", $word) == true || preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){2,}/", $word) == true) {
        return true;
    } else {
        return false;
    }
}

// function is_utf8
$str = file_get_contents('http://addon.discuz.com/?@liangjian');
if ($_G['charset'] == 'utf-8') {
    if (!is_utf8($str)) {
        $str = iconv('gbk', 'utf-8', $str);
    }
}

echo str_replace('resource/template/', 'http://addon.discuz.com/resource/template/', str_replace('resource/developer/', 'http://addon.discuz.com/resource/developer/', str_replace('resource/plugin/', 'http://addon.discuz.com/resource/plugin/', $str)));
?>