<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include 'source/plugin/aljwsq/com/com.php';
include 'source/plugin/aljwsq/include/msgtypes.php';
include 'source/plugin/aljwsq/function_core.php';
$config = array();
foreach ($pluginvars as $key => $val) {
    $config[$key] = $val['value'];
}
if ($_GET['act'] == 'update' && $_GET['formhash'] == formhash()) {
    $appid = $config['appid'];
    $appsecret = $config['appsecret'];
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $result = https_request($url);
    //debug((Array)json_decode($result));

    $jsoninfo = json_decode($result, true);
    $access_token = $jsoninfo["access_token"];
    $i = 0;
    $umenus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
    foreach ($umenus as $m) {
        $menus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid($m['id']);
        if ($menus) {
            $jsonmenu['button'][$i]['name'] = urlencode(diconv($m['name'], CHARSET, 'UTF-8'));
            foreach ($menus as $menu) {
                if ($menu['type'] == 'click') {
                    $keyurl = 'key';
                } else {
                    $keyurl = 'url';
                    if (strpos($menu['keyurl'], 'http://') === false) {
                        $menu['keyurl'] = $_G['siteurl'] . $menu['keyurl'];
                    }
                }

                $jsonmenu['button'][$i]['sub_button'][] = array('type' => $menu['type'], 'name' => urlencode(diconv($menu['name'], CHARSET, 'UTF-8')), $keyurl => urlencode(diconv($menu['keyurl'], CHARSET, 'UTF-8')));
            }
        } else {
            if ($m['type'] == 'click') {
                $keyurl = 'key';
            } else {
                $keyurl = 'url';
                if (strpos($m['keyurl'], 'http://') === false) {
                    $m['keyurl'] = $_G['siteurl'] . $m['keyurl'];
                }
            }

            $jsonmenu['button'][$i] = array('type' => $m['type'], 'name' => urlencode(diconv($m['name'], CHARSET, 'UTF-8')), $keyurl => urlencode(diconv($m['keyurl'], CHARSET, 'UTF-8')));
        }
        $i++;
    }
    $jsonmenu = stripslashes(urldecode(json_encode($jsonmenu)));
    $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
    $result = https_request($url, $jsonmenu);
    $result=(Array)json_decode($result);
    if($result['errmsg']=='ok'){
        cpmsg(lang('plugin/aljwsq', 'menu1'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=menu', 'succeed');
    }else{
        cpmsg(lang('plugin/aljwsq', 'menu2').$result['errmsg']);
    }
} else if ($_GET['act'] == 'add') {
    if (file_exists('source/plugin/aljwsq/com/menu.php')) {
        include 'source/plugin/aljwsq/com/menu.php';
    }
} else if ($_GET['act'] == 'edit') {
    $menu = C::t('#aljwsq#aljwsq_menu')->fetch($_GET['mid']);
    if (submitcheck('formhash')) {
        C::t('#aljwsq#aljwsq_menu')->update($_GET['mid'], array(
            'displayorder' => $_GET['displayorder'],
            'upid' => $_GET['upid'],
            'type' => $_GET['type'],
            'name' => $_GET['name'],
            'keyurl' => $_GET['keyurl'],
        ));
        cpmsg(lang('plugin/aljwsq', 'menu3'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=menu', 'succeed');
    } else {
        $menus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
        include template('aljwsq:add');
    }
} else if ($_GET['act'] == 'delete') {
    if($_GET['formhash']==formhash()){
        if ($_GET['mid']) {
            C::t('#aljwsq#aljwsq_menu')->delete($_GET['mid']);
        }
        cpmsg(lang('plugin/aljwsq', 'menu4'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=menu', 'succeed');
    }
} else {
    $umenus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
    $menus = C::t('#aljwsq#aljwsq_menu')->fetch_all();
    if (file_exists('source/plugin/aljwsq/com/menu.php')) {
        include template('aljwsq:menu');
    } else {
        $_GET['gettype']='menu';
        include template('aljwsq:com');
    }
    
}

