<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
$items[] = array('title' => lang('plugin/aljwsq', 'post1'), 'picurl' => 'source/plugin/aljwsq/images/newthread.png', 'url' => $_G[siteurl] . 'forum.php' . "?openid=" . $postObj->FromUserName);
if($news['description']){ 
	$forums = DB::fetch_all('select * from %t where fid in (%i)',array('forum_forum',$news['description']));
}else{
	$forums = C::t('forum_forum')->fetch_all_fids('', 'forum', '', 0, $news['forumnum']);
}

foreach ($forums as $forum) {
    $items[] = array('title' => $forum['name'], 'url' => $_G[siteurl] . 'forum.php?mod=post&action=newthread&fid=' . $forum['fid'] . "&openid=" . $postObj->FromUserName);
}
$items[] = array('title' => lang('plugin/aljwsq', 'post2'), 'url' => $_G[siteurl] . 'forum.php' . "?openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>