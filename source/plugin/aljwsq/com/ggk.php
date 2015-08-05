<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$config = $_G['cache']['plugin']['aljwsq'];
$check = C::t('#aljwsq#aljwsq_ggk_user')->fetch($_G['uid']);
$str = str_replace("\r", "", $config ['rewardlist']);
$prize_list = explode("\n", $str);
$count = C::t('#aljwsq#aljwsq_ggk_log')->count_by_uid_dateline($_G['uid']);
foreach ($prize_list as $k => $v) {
    $arrt = explode('|', $v);
    $prize_arr[$arrt['0']]['id'] = $arrt['0'];
    $prize_arr[$arrt['0']]['prize'] = $arrt['1'];
    $prize_arr[$arrt['0']]['prizename'] = $arrt['2'];
    $prize_arr[$arrt['0']]['v'] = $arrt['3'];
    $prize_arr[$arrt['0']]['num'] = $arrt['4'];
    $prize_arr[$arrt['0']]['extcredit'] = $arrt['5'];
}
$datas = DB::fetch_all("select rid,count(*) num from %t group by rid", array('aljwsq_ggk_log'));
foreach ($datas as $data) {
    $rids[$data['rid']] = $data['num'];
}
if (!$check && $_G['uid']) {
    C::t('#aljwsq#aljwsq_ggk_user')->insert(array('uid' => $_G['uid'], 'username' => $_G['username'], 'anum' => 0, 'dateline' => TIMESTAMP, 'lasttime' => TIMESTAMP));
}
if ($_GET['act'] == 'ggk') {
    if ($_GET['formhash'] == formhash()) {
        if (!$_G['uid']) {
            echo json_encode(array('status' => 1));
            exit;
        }
        if (!in_array($_G['groupid'], unserialize($config['usergroup']))) {
            echo json_encode(array('status' => 2));
            exit;
        }
        if ($count >= $config['mm']) {
            echo json_encode(array('status' => 3));
            exit;
        }
        if ($config['extnum'] > getuserprofile('extcredits' . $config['extcredit'])) {
            echo json_encode(array('status' => 4));
            exit;
        }
        $ext = 'extcredits' . $config['extcredit'];
        $count = C::t('#aljwsq#aljwsq_ggk_log')->count_by_uid_dateline($_G['uid']);
        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['v'];
        }
        $rid = getRand($arr, $rids); 
        $res = $prize_arr[$rid]; 
        if ($rid != 0) {
            $result['status'] = 88;
        } else {
            $result['status'] = 0;
            $prize_arr[$rid]['prize'] = lang('plugin/aljwsq', 'ggk1');
        }
        $result['prize'] = diconv($prize_arr[$rid]['prize'], CHARSET, 'utf-8'); 
        if ($prize_arr[$rid]['prize']) {
            updatemembercount($_G['uid'], array($config['extcredit'] => intval('-' . $config['extnum'])));
            if ($prize_arr[$rid]['extcredit'] != 0) {
                updatemembercount($_G['uid'], array($config['extcredit'] => $prize_arr[$rid]['extcredit']));
            }
            C::t('#aljwsq#aljwsq_ggk_log')->insert(array('uid' => $_G['uid'], 'username' => $_G['username'], 'dateline' => $_G['timestamp'], 'isnot' => $prize_arr[$rid]['extcredit'], 'rid' => $rid, 'reward' => $prize_arr[$rid]['prize'], 'prizename' => $prize_arr[$rid]['prizename']));
        }
        echo json_encode($result);
    } else {
        echo -1;
    }
} else if ($_GET['act'] == 'submitinfo') {
    echo 'ok';
} else if($_GET['act']=='ggkrecord'){
    $recordlist=C::t('#aljwsq#aljwsq_ggk_log')->fetch_all_by_rid();
    include template("aljwsq:ggkrecord");
}else {
    include template("aljwsq:ggk"); 
}

function getRand($proArr, $rids) {
    global $prize_arr, $config;
    $result = '';
    $proSum = $config['per'];
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur && intval($rids[$key]) < intval($prize_arr[$key]['num'])) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset($proArr);
    if (empty($result)) {
        $result = 0;
    }
    return $result;
}

function g2u($a) {
    return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
    return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}
?>