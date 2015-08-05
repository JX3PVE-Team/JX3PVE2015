<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
include template('aljwsq:adminindexnav');
if($_GET['wid']=='menu'){
	include 'source/plugin/aljwsq/c.inc.php';
}else{
	include 'source/plugin/aljwsq/include/index.php';
	$config = array();
	foreach ($pluginvars as $key => $val) {
		$config[$key] = $val['value'];
	}
	if ($_GET['act'] == 'add') {
	   if (submitcheck('formhash')) {
			C::t('#aljwsq#aljwsq_index')->insert(array(
				'displayorder' => $_GET['displayorder'],
				'upid' => $_GET['upid'],
				'type' => $_GET['type'],
				'name' => $_GET['name'],
				'keyurl' => $_GET['keyurl'],
				'dateline' => TIMESTAMP
			));
			cpmsg(lang('plugin/aljwsq', 'menu22'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=indexsetting', 'succeed');
		} else {
			
			include template('aljwsq:addindex');
		}
	} else if ($_GET['act'] == 'edit') {
		$menu = C::t('#aljwsq#aljwsq_index')->fetch($_GET['mid']);
		if (submitcheck('formhash')) {
			C::t('#aljwsq#aljwsq_index')->update($_GET['mid'], array(
				'displayorder' => $_GET['displayorder'],
				'upid' => $_GET['upid'],
				'type' => $_GET['type'],
				'name' => $_GET['name'],
				'keyurl' => $_GET['keyurl'],
			));
			cpmsg(lang('plugin/aljwsq', 'menu3'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=indexsetting', 'succeed');
		} else {
			$menus = C::t('#aljwsq#aljwsq_index')->fetch_all_by_upid(0);
			include template('aljwsq:addindex');
		}
	} else if ($_GET['act'] == 'delete') {
		if($_GET['formhash']==formhash()){
			if ($_GET['mid']) {
				C::t('#aljwsq#aljwsq_index')->delete($_GET['mid']);
			}
			cpmsg(lang('plugin/aljwsq', 'menu4'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=indexsetting', 'succeed');
		}
	} else {
		$umenus = C::t('#aljwsq#aljwsq_index')->fetch_all_by_upid(0);
		$menus = C::t('#aljwsq#aljwsq_index')->fetch_all();
	   
		include template('aljwsq:indexsetting');
		
		
	}
}
