<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::t('#aljwsq#aljwsq_mes')->insert(array(
    'upid' => $_GET['upid'],
    'nickname' => $_GET['nickname'],
    'info' => $_GET['info'],
    'dateline' => TIMESTAMP,
));
if ($_GET['upid']) {
    $tips = '&#22238;&#22797;&#25104;&#21151;&#65281;';
} else {
    $tips = '&#30041;&#35328;&#25104;&#21151;&#65281;';
}
echo json_encode(array('success' => 1, 'msg' => g2u($tips)));
?>