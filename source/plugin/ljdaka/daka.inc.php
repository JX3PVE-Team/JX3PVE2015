<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 
$action = $_GET['action'];
if($action == 'qz'&&$_G['uid']){
	include template('ljdaka:qz');
}
if ($action == 'msg') {
	if($_GET['formhash']==formhash()){
		$uid = $_G['uid'];
		if(!$_G['uid']){
			showmessage(lang('plugin/ljdaka','daka18'), '', array(), array('login' => true));
		}
		$username = $_G['username'];
		$config = $_G['cache']['plugin']['ljdaka'];
		$dizhi = $config['dizhi'];
		$url = $config['url'];
		$wenzi = $config['wenzi'];
		$checksql = C::t('#ljdaka#plugin_daka')->fetch_by_tables();
		if ($checksql) {
			$check = C::t('#ljdaka#plugin_daka')->fetch_by_uid($uid);
			if (!$check) {
				$timestamp = $_G['timestamp'];
				$jljifen = $config['jljifen'];
				$zhouqi = $config['zhouqi'];
				$beishu = $config['beishu'];
				$mytime = $timestamp-86400;
				$mytime = date('Y-m-d', $mytime);
				$alldays = C::t('#ljdaka#plugin_daka')->fetch_by_uid_yesterday($uid,$mytime);
				$countday=intval($alldays+1);
				if (!$alldays || ($alldays >= $zhouqi&&$zhouqi)) {
					$alldays = 0;
				} 
				$jljifen1 = ($alldays + 1) * $beishu + $jljifen;
				$money=intval($jljifen1);
				$creditname = $_G['setting']['extcredits'][$config['leixing']]['title'];
				$jljifen2 = $jljifen1 . $creditname;
				$leixing = 'extcredits' . $config['leixing'];
				updatemembercount($uid , array($leixing => $jljifen1));
				$myall = $alldays + 1;
				if($myall>= $zhouqi&&$zhouqi){
					$mall = 1 * $beishu + $jljifen;
				}else{
					$mall = ($myall + 1) * $beishu + $jljifen;
				}
				
				$mall .= $creditname;
				$record = array('uid' => $uid, 'timestamp' => $timestamp, 'jinbi' => $jljifen1, 'alldays' => $myall);
				DB :: insert('plugin_daka', $record);
				if(!DB::result_first('select * from '.DB::table('plugin_daka_user')." where uid=".$_G['uid'])){
					DB::insert('plugin_daka_user',array(
						'uid'=>$_G['uid'],
						'username'=>$_G['username'],
						'timestamp'=>$_G['timestamp'],
						'money'=>$money,
						'allday'=>$countday,
						'day'=>$myall,
						'fen'=>$mall,
					));
				}else{
					C::t('#ljdaka#plugin_daka_user')->update_by_uid($uid,$money,$myall,$mall,$_G['timestamp']);
				}
			} 
		}
	 
		$web_root = $_G ['siteurl'];
		if (substr($web_root, -1) != '/') {
			$web_root = $web_root . '/';
		} 
		if($news['msgtype'] == 'sign'){
				if($check){
					echo $this->responsetext($postObj, lang('plugin/ljdaka','aljwsq_1'));
				}else{
					echo $this->responsetext($postObj, lang('plugin/ljdaka','aljwsq_2').$myall.lang('plugin/ljdaka','aljwsq_3').$jljifen2.lang('plugin/ljdaka','aljwsq_4').$mall);
				}
		}else{
			include template('ljdaka:msg');
		}
	}
} 

?>