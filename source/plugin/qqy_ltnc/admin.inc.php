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
$url = "admin.php?action=plugins&operation=config&do=$do&identifier={$_GET['identifier']}&pmod={$_GET['pmod']}";
$uid = $_REQUEST['uid']>0?(int)$_REQUEST['uid']:'';
$nickname = $_REQUEST['nickname'];
$username = $_REQUEST['username'];
$limit = 15;
$page = $_GET['page']>0?(int)$_GET['page']:1;
$start = ($page-1)*$limit;

if($uid || $nickname || $username){
	if(!empty($uid)){
		$url.="&uid=$uid";
		$info = DB::fetch_first('SELECT uid,username as nickname FROM '.DB::table('common_member')." WHERE uid=$uid ");
		if($info['uid']){
			$info['username'] = DB::result_first("SELECT username FROM ".DB::table('ucenter_members')." WHERE uid=$uid ");
			$logs['lists'] = DB::fetch_all("SELECT uid,name,logtime FROM ".DB::table('qqy_ltnclog')." WHERE uid=$uid ORDER BY logtime DESC LIMIT $start,$limit ");
			$logs['num'] = DB::result_first("SELECT count(*) FROM ".DB::table('qqy_ltnclog')." WHERE uid=$uid");
		}
	}elseif(!empty($nickname)){
		$url.="&nickname=$nickname";
		$nickname = addslashes($nickname);
		$info = DB::fetch_first('SELECT uid,username as nickname FROM '.DB::table('common_member')." WHERE username='$nickname'");
		if($info['uid']){
			$info['username'] = DB::result_first("SELECT username FROM ".DB::table('ucenter_members')." WHERE uid=$info[uid] ");
		}
		$logs['lists'] = DB::fetch_all("SELECT uid,name,logtime FROM ".DB::table('qqy_ltnclog')." WHERE name='$nickname' ORDER BY logtime DESC LIMIT $start,$limit ");
		$logs['num'] = DB::result_first("SELECT count(*) FROM ".DB::table('qqy_ltnclog')." WHERE name='$nickname'");
	}else{
		$url.="&username=$username";
		$username = addslashes($username);
		$info = DB::fetch_first("SELECT uid,username FROM ".DB::table('ucenter_members')." WHERE username='$username' ");
		if($info['uid']){
			$f_uid = $info['uid'];
			$info['nickname'] = DB::result_first('SELECT username as nickname FROM '.DB::table('common_member')." WHERE uid=$f_uid ");
			$logs['lists'] = DB::fetch_all("SELECT uid,name,logtime FROM ".DB::table('qqy_ltnclog')." WHERE uid=$f_uid ORDER BY logtime DESC LIMIT $start,$limit ");
			$logs['num'] = DB::result_first("SELECT count(*) FROM ".DB::table('qqy_ltnclog')." WHERE uid=$f_uid");
		}
	}
	$isquery = 1;
	$logs['num']>0 && $pagebar = multi($logs['num'], $limit, $page, $url);
}
include template('qqy_ltnc:admin');

?>