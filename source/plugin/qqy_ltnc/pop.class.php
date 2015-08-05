<?php
/**
 * Plugin For Discuz! X2.5-X3.0
 
 * Copyright (c) 2006 - 2016 Zhanzhangzu.com.

 * зїеп:      ШЋЧђгЅ
 
 * гЪЯф:      641500953@qq.com
 
 * ЭјеО:      www.zhanzhangzu.com
  
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_qqy_ltnc {

	function global_footer() {
		global $_G;
		$result = '';
		$uid = (int)$_G['uid'];
		if(!empty($uid) && (CURSCRIPT!='home' && $_GET['mod']!='spacecp' ) ){
			$showpop = getcookie('ltncpop');
			if(empty($showpop)){
				$ifset = DB::result_first("SELECT addname FROM ".DB::table('common_member')." WHERE uid=$uid");
				if(empty($ifset)){
					$result = " ";
				}
			}
		}	
		return $result;
		}
}	