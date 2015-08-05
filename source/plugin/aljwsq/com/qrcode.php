<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$qrcodelist = C::t('#aljwsq#aljwsq_wxqrcode')->range();
include template('aljwsq:advanced/wxqrcodelist');
?>