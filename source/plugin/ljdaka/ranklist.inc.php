<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: ranklist.inc.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$uid=$_G['uid'];
$config = $_G['cache']['plugin']['ljdaka'];
$gg=$config['gg'];
$tips=$config['tips'];
$banquan=$config['banquan'];
$timestamp = $_G['timestamp'];
$jljifen = $config['jljifen'];
$zhouqi = $config['zhouqi'];
$beishu = $config['beishu'];
$mytime = $timestamp;
$mytime = date('Y-m-d', $mytime);
$currpage=$_GET['page']?$_GET['page']:1;
$perpage=25;
$curnum=($currpage-1)*$perpage;
$num=C::t('#ljdaka#plugin_daka_user')->count();

$query = C::t('#ljdaka#plugin_daka_user')->fetch_all_by_allday($curnum,$perpage);
$query_br = C::t('#ljdaka#plugin_daka_user')->fetch_all_by_allday();
$ranklist_br=array();
$i=1;
foreach($query_br as $k=>$rank_br){
	$ranklist_br[$rank_br[uid]]['rank_br']=$i;
	$ranklist_br[$rank_br[uid]]['alldays']=$rank_br['allday'];
	$ranklist_br[$rank_br[uid]]['jljifen1']=$rank_br['money'];
	$creditname = $_G['setting']['extcredits'][$config['leixing']]['title'];
	$ranklist_br[$rank_br[uid]]['jljifen2']=$rank_br['fen'];
	$ranklist_br[$rank_br[uid]]['money']=$rank_br['money'];
	$ranklist_br[$rank_br[uid]]['day']=$rank_br['day'];
	$i++;
}
$paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=ljdaka:ranklist', 0, 10, false, false);
//debug($ranklist);
$leixing = 'extcredits' . $config['leixing'];
include template('ljdaka:ranklist');



?>