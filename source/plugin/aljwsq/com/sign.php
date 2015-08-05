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
$config = $_G['cache']['plugin']['aljwsq'];
$openid=$postObj->FromUserName;
$user=DB::fetch_first('select * from %t where openid=%s and bindtime!=0',array('aljwsq_user',$openid));

if($user){
    $user=C::t('common_member')->fetch_by_username($user['username']);
    $_G['username']=$user['username'];
    $_G['uid'] = $user['uid'];
    $_G['groupid'] = $user['groupid'];
    $_GET['action'] = 'msg';
    $_GET['cont1'] = lang('plugin/aljwsq', 'com51');
    $_GET['formhash'] = formhash();
    $_GET['cont2'] = $config['tips'];
}else{
    echo $this->responsetext($postObj, $config['btips']);
    exit;
}


if (file_exists('source/plugin/ljdaka/daka.inc.php')) {
    include 'source/plugin/ljdaka/daka.inc.php';
} else {
    echo $this->responsetext($postObj, lang('plugin/aljwsq', 'com52'));
}
?>