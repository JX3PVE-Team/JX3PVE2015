<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

include 'source/plugin/aljwsq/com/com.php';
include 'source/plugin/aljwsq/include/msgtypes.php';
if ($_GET['act'] == 'removebind') {
    C::t('#aljwsq#aljwsq_user')->delete($_GET['openid']);
    cpmsg(lang('plugin/aljwsq', 'bind7'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=bindrecord', 'succeed');
} else {
    if (file_exists('source/plugin/aljwsq/com/bindrecord.php')) {
        include 'source/plugin/aljwsq/com/bindrecord.php';
    }
    if (file_exists('source/plugin/aljwsq/com/bindrecord.php')) {
        include template('aljwsq:bindrecord');
    } else {
        $_GET['gettype'] = 'bindrecord';
        include template('aljwsq:com');
    }
}
?>