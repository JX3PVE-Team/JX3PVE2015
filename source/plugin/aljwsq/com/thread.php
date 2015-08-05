<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$news = $this->getnews($news['tid']);
echo $this->responsenews($postObj, $news);
?>