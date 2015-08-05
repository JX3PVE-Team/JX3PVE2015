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
if($_GET['act']=='delete' && $_GET['formhash']==FORMHASH){
	DB::query('delete from %t',array('aljwsq_ggk_log'));
	DB::query('delete from %t',array('aljwsq_ggk_user'));
	cpmsg(lang('plugin/aljwsq', 'a2'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=adminggk', 'succeed');
}else{
	$recordlist=C::t('#aljwsq#aljwsq_ggk_log')->fetch_all_by_rid();

	$_GET['gettype'] = 'ggk';
	if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
		include template('aljwsq:adminggk');
	}else{
		include template('aljwsq:com');
	}
}

?>