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

$threads = DB::fetch_all('select * from %t where displayorder >= 0 order by tid desc limit %d,%d',array('forum_thread',0,$news['threadnum']));

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
$items[] = array('title' => lang('plugin/aljwsq', 'newthread1'), 'url' => $_G[siteurl] . 'forum.php?mod=forumdisplay&fid=' . $news['fid'] . "&openid=" . $postObj->FromUserName);
echo $this->reponsemultinews($postObj, $items);
?>