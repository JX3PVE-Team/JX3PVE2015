<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$news = $this->getnews($news['tid']);
echo $this->responsenews($postObj, $news);
?>