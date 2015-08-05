<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class aljwsq_api {

	function forumdisplay_topBar() {
		global $_G;
		$config = $_G['cache']['plugin']['aljwsq'];
		require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
		$return = array();
		$url = WeChatHook::getPluginUrl('aljwsq:mes',array('mobile' => '2'));
		$index_url = WeChatHook::getPluginUrl('aljwsq:index',array('mobile' => '2'));
		$return[] = array(
			'name' => $config['wsq_1'],
			'html' => '<a href="'.$index_url.'">'.$config['wsq_2'].'</a><br/><br/><a href="'.$url.'">'.$config['wsq_3'].'</a>',
			'more' => '',
		);
		return $return;
	}

}

?>
