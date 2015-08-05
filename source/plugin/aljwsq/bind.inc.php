<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
 if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$config=$_G['cache']['plugin']['aljwsq'];
require_once 'source/plugin/aljwsq/function_core.php';
if ($_GET['act'] == 'bind') {
    if (submitcheck('formhash')) {
		$openid = (string)$_GET['openid'];
        $check = C::t('common_member')->fetch_by_username($_GET['username']);
        if (empty($check)) {
            showmessage(lang('plugin/aljwsq', 'bind2'));
        }
        $user = C::t('#aljwsq#aljwsq_user')->fetch($openid);
        if ($user['username']) {
            showmessage(lang('plugin/aljwsq', 'bind3'));
        }
        require_once libfile('function/member');
        $result = userlogin($_GET['username'], $_GET['password']);
        if (empty($result['status'])) {
            showmessage(lang('plugin/aljwsq', 'bind4'));
        }
        if (empty($openid)) {
            showmessage(lang('plugin/aljwsq', 'bind5'));
        }
        $config = $_G['cache']['plugin']['aljwsq'];
		if($config['appid'] && $config['appsecret']){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $config['appid'] . "&secret=" . $config['appsecret'];
			$result = https_request($url);
			$jsoninfo = json_decode($result, true);
			$access_token = $jsoninfo["access_token"];
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $_GET['openid'] . "&lang=zh_CN";
			$wuser = https_request($url);
			$wuser = json_decode($wuser, true);
		}
		if($openid){
			if (!$user && $openid) {
				C::t('#aljwsq#aljwsq_user')->insert(array(
					'nickname' => u2g($wuser['nickname']),
					'username' => $_GET['username'],
					'openid' => $openid,
					'latitude' => $_GET['latitude'],
					'longitude' => $_GET['longitude'],
					'bindtime' => TIMESTAMP,
					'sex' => $wuser['sex'],
					'city' => u2g($wuser['city']),
					'country' => u2g($wuser['country']),
					'province' => u2g($wuser['province']),
					'language' => $wuser['language'],
					'headimgurl' => $wuser['headimgurl'],
					'subscribe_time' => TIMESTAMP
				));
			} else {
				C::t('#aljwsq#aljwsq_user')->update($openid, array(
					'nickname' => u2g($wuser['nickname']),
					'username' => $_GET['username'],
					'latitude' => $_GET['latitude'],
					'longitude' => $_GET['longitude'],
					'bindtime' => TIMESTAMP,
					'sex' => $wuser['sex'],
					'city' => u2g($wuser['city']),
					'country' => u2g($wuser['country']),
					'province' => u2g($wuser['province']),
					'language' => $wuser['language'],
					'headimgurl' => $wuser['headimgurl'],
				));
			}
		}
        showmessage(lang('plugin/aljwsq', 'bind6'), 'forum.php?openid=' . $openid);
    } else {
		$binduser = DB::fetch_first('SELECT * FROM %t WHERE openid=%s', array('aljwsq_user', $openid));
		if($binduser && $binduser['username']){
			echo '<script>alert("'.$config['albindtips'].'");location.href="forum.php?mobile=2&openid=' .$openid.'"</script>';
			exit;
		}
        $_GET['nickname'] = u2g($_GET['nickname']);
        include template('aljwsq:bind');
    }
}else if($_GET['act'] == 'showqcode'){
	include template('aljwsq:showqcode');
}else if($_GET['act'] == 'qrcode'){
	if($_GET['qid']){
		DB::query('update %t set num = num+1 where id=%d',array('aljwsq_qrcode',$_GET['qid']));
		$qrcode = C::t('#aljwsq#aljwsq_qrcode')->fetch($_GET['qid']);
		header('Location: '.$qrcode['url']);
	}
}

function g2u($a) {
    return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
    return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}

?>