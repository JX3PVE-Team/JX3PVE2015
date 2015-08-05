<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$items = C::t('#aljwsq#aljwsq_autoreply')->fetch_all_by_upid($news['id'], multinews, $news['id']);
$items[] = $news;
echo $this->reponsemultinews($postObj, array_reverse($items));
?>