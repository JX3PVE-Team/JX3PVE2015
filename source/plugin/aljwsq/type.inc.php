<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if ($_GET['aid']) {
    $reply = C::t('#aljwsq#aljwsq_autoreply')->fetch($_GET['aid']);
}
if ($_GET['gettype'] == 'multinews') {
    $alist = C::t('#aljwsq#aljwsq_autoreply')->fetch_all_by_upid(0, 'multinews', $_GET['aid']);
}
include template('aljwsq:text');

