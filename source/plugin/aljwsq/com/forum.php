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
$threads = C::t('forum_thread')->fetch_all_by_fid_displayorder($news['fid'], 0, null, null, 0, $news['threadnum']);
$i = 0;
foreach ($threads as $thread) {
    $tmp = $this->getnews($thread['tid'], $news);
    if (empty($i)) {
        if (empty($tmp['picurl'])) {
            $tmp['picurl'] = 'http://static.jx3pve.com/img/m/banner/default.png';
        }
    }
    $items[] = $tmp;

    $i++;
}
$items[] = array('title' => lang('plugin/aljwsq', 'forum1'), 'url' => $_G[siteurl] . 'forum.php?mod=forumdisplay&fid=' . $news['fid'] . "&openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>