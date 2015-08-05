<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$currpage = $_GET['page'] ? $_GET['page'] : 1;
$perpage = 10;
$num = C::t('#aljwsq#aljwsq_user')->count_by_bindtime();

$start = ($currpage - 1) * $perpage;
$users = C::t('#aljwsq#aljwsq_user')->fetch_all_by_bindtime($start, $perpage);
$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=bindrecord', 0, 11, false, false);
?>