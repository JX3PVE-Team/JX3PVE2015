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
$config = $_G['cache']['plugin']['aljwsq'];
$threads = C::t('forum_thread')->fetch_all_for_guide('hot', '', '', '', '', 0, $news['threadnum']);
$i = 0;
foreach ($threads as $thread) {
    $tmp = $this->getnews($thread['tid'], $news);
    if (empty($i)) {
        if (empty($tmp['picurl'])) {
            $tmp['picurl'] = $config['default'];
        }
    }
    $items[] = $tmp;
    $i++;
}
$items[] = array('title' => lang('plugin/aljwsq', 'hotthread1'), 'url' => $_G[siteurl] . 'forum.php?mod=forumdisplay&fid=' . $news['fid'] . "&openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>