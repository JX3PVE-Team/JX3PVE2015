<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if ($news['url'] && strpos($news['url'], 'http://') === false) {
    $news['url'] = $_G['siteurl'] . $news['url'];
}
if ($news['picurl'] && strpos($news['picurl'], 'http://') === false) {
    $news['picurl'] = $_G['siteurl'] . $news['picurl'];
}
echo $this->responsemusic($postObj, $news);
?>