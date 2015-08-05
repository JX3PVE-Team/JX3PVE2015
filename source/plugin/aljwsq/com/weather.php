<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$perpage = 20;
$currpage = $_GET['page'] ? $_GET['page'] : 1;
$start = ($currpage - 1) * $perpage;
$num = C::t('#aljwsq#aljwsq_citylist')->count();
$citylist = C::t('#aljwsq#aljwsq_citylist')->range($start, $perpage);
$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply&autoact=reflash', 0, 11, false, false);
if (empty($num) || $_GET['autoact'] == 'reflash') {
    C::t('#aljwsq#aljwsq_citylist')->truncate();
    $apiurl = 'http://mobile.weather.com.cn/js/citylist.xml';
    $ch = curl_init($apiurl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $citystr = curl_exec($ch);
    curl_close($ch);
    $cityobj = simplexml_load_string($citystr);
    $len = count($cityobj->c->d);

    for ($i = 0; $i < $len; $i++) {
        if (CHARSET == 'gbk') {
            $d1 = u2g((array) $cityobj->c->d[$i]->attributes()->d1);
            $d2 = u2g((array) $cityobj->c->d[$i]->attributes()->d2);
            $d3 = u2g((array) $cityobj->c->d[$i]->attributes()->d3);
            $d4 = u2g((array) $cityobj->c->d[$i]->attributes()->d4);
        } else {
            $d1 = (array) $cityobj->c->d[$i]->attributes()->d1;
            $d2 = (array) $cityobj->c->d[$i]->attributes()->d2;
            $d3 = (array) $cityobj->c->d[$i]->attributes()->d3;
            $d4 = (array) $cityobj->c->d[$i]->attributes()->d4;
        }
        if ($d1[0]) {
            C::t('#aljwsq#aljwsq_citylist')->insert(
                    array(
                        'd1' => $d1[0],
                        'd2' => $d2[0],
                        'd3' => $d3[0],
                        'd4' => $d4[0],
                    )
            );
        }
    }
}

function g2u($a) {
    return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
    return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}

function https_request($url, $data = null) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>