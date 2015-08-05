<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include 'source/plugin/aljwsq/com/com.php';
include 'source/plugin/aljwsq/include/msgtypes.php';
if($_GET['act']=='delete' && $_GET['formhash'] == FORMHASH){
	C::t('#aljwsq#aljwsq_mes')->delete($_GET['mid']);
	cpmsg('&#21024;&#38500;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=adminmes', 'succeed');
}else{
	$currpage = $_GET['page'] ? $_GET['page'] : 1;
    $perpage = 11;
    $num = C::t('#aljwsq#aljwsq_mes')->count();
    $start = ($currpage - 1) * $perpage;
    $meslist = C::t('#aljwsq#aljwsq_mes')->range($start, $perpage,'desc');
    $paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 0, 11, false, false);
	$_GET['gettype'] = 'mes';
	if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
		include template('aljwsq:adminmes');
	}else{
		include template('aljwsq:com');
	}
	
}
