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
$threads = C::t('portal_article_title')->range(0, $news['threadnum']);
$i = 0;
foreach ($threads as $thread) {
    $tmp = $this->getarticlenews($thread['aid'], $news);
    if (empty($i)) {
        if (empty($tmp['picurl'])) {
            $tmp['picurl'] = $config['default'];
        }
    }
    $items[] = $tmp;
    $i++;
}
$items[] = array('title' => lang('plugin/aljwsq', 'newmore'), 'url' => $_G[siteurl] . 'portal.php?mod=list&catid=' . $news['catid'] . "&openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>