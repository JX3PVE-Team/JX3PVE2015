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
if ($news['url'] && strpos($news['url'], 'http://') === false) {
    $news['url'] = $_G['siteurl'] . $news['url'];
}
if (strpos($news['url'], '?') === false) {
    $news['url'] = $news['url'] . '?&openid=' . $postObj->FromUserName;
} else {
    $news['url'] = $news['url'] . '&openid=' . $postObj->FromUserName;
}
echo $this->responsetext($postObj, $news['description'] . '<a href="' . $news['url'] . '">' . $news['title'] . '</a>');
?>