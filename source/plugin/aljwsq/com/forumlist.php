<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
$config = $_G['cache']['plugin']['aljwsq'];
$items[] = array('title' => lang('plugin/aljwsq', 'forumlist1'), 'picurl' => 'source/plugin/aljwsq/images/newthread.png', 'url' => $_G[siteurl] . 'forum.php' . "?openid=" . $postObj->FromUserName);
if($news['description']){
	$forums = DB::fetch_all('select * from %t where fid in (%i)',array('forum_forum',$news['description']));
}else{
	$forums = C::t('forum_forum')->fetch_all_info_by_fids('',1,$news['forumnum'],'','','','','forum');
}

//DB::fetch_all('select * from %t where');
foreach ($forums as $forum) {
    $items[] = array('title' => $forum['name'], 'url' => $_G[siteurl] . 'forum.php?mod=forumdisplay&fid=' . $forum['fid'] . "&openid=" . $postObj->FromUserName);
}
$items[] = array('title' => lang('plugin/aljwsq', 'forumlist2'), 'url' => $_G[siteurl] . 'forum.php' . "?openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>