<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$qrcodelist = C::t('#aljwsq#aljwsq_wxqrcode')->range();
include template('aljwsq:advanced/wxqrcodelist');
?>