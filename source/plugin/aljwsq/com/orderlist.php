<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
include 'source/plugin/aljwsq/include/msgtypes.php';
$ws=C::t('#aljwsq#aljwsq_autoreply')->fetch_all_by_upid_mykeyword();
$i=1;
foreach($ws as $w){
    $orderlist.=$i.':  '.$w['mykeyword']."\n";
    $i++;
}
echo $this->responsetext($postObj, $orderlist);
?>