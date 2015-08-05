<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if (submitcheck('formhash')) {
    $count=C::t('#aljwsq#aljwsq_menu')->count_by_upid($_GET['upid']);
    if($count>=5){
        cpmsg(lang('plugin/aljwsq', 'menu11'),'','error');
    }
    C::t('#aljwsq#aljwsq_menu')->insert(array(
        'displayorder' => $_GET['displayorder'],
        'upid' => $_GET['upid'],
        'type' => $_GET['type'],
        'name' => $_GET['name'],
        'keyurl' => $_GET['keyurl'],
        'dateline' => TIMESTAMP
    ));
    cpmsg(lang('plugin/aljwsq', 'menu12'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=menu', 'succeed');
} else {
    $menus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
    include template('aljwsq:add');
}
?>