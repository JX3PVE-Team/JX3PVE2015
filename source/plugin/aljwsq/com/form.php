<?php
/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$formlist=C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch_all_by_msgtype('form');
include template('aljwsq:adminadvancednav');
include template('aljwsq:advanced/form');
?>