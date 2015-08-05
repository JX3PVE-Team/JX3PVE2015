<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$news = C::t('#aljwsq#aljwsq_autoreply')->fetch_by_mykeyword($scan['mykeyword']);
?>