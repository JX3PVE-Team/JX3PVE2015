<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once libfile('function/member');
$config = $_G['cache']['plugin']['aljwsq'];
$openid = u2g($postObj->FromUserName);
$openid = (string)$openid;
$user = C::t('#aljwsq#aljwsq_user')->fetch($openid);
$user = DB::fetch_first("select * from %t where openid = %s and bindtime != 0 and openid != '' and openid is not null",array('aljwsq_user',$openid));

if(empty($user['username']) && $openid){

	require_once 'source/plugin/aljwsq/function_core.php';
    $wuser = getwuserinfo($postObj, $config['appid'], $config['appsecret']);
	$user = C::t('#aljwsq#aljwsq_user')->fetch($openid);
	loaducenter();
	$nickname = u2g($wuser['nickname']);
	if($config['isname'] && $nickname){
		$username = $nickname;
	}else{
		$username = random(5);
	}
	while(DB::result_first('select count(*) from %t where username = %s',array('common_member',$username))){
		$username = random(5);
	}
	
	$defaultpassword = $config['password'];
	$return = register($username,'',$config['autogroup'],$defaultpassword);

	 if (empty($user) && $openid) {
            C::t('#aljwsq#aljwsq_user')->insert(array(
                'nickname' => u2g($wuser['nickname']),
                'username' => $username,
                'openid' => $openid,
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
                'username' => $username,
                'bindtime' => TIMESTAMP,
                'sex' => $wuser['sex'],
                'city' => u2g($wuser['city']),
                'country' => u2g($wuser['country']),
                'province' => u2g($wuser['province']),
                'language' => $wuser['language'],
                'headimgurl' => $wuser['headimgurl'],
            ));
        }
	$tpl = str_replace('{username}',$return['username'],$config['tpl']);
	$tpl = str_replace('{password}',$return['password'],$tpl);
	$tpl = str_replace('{openid}',$openid,$tpl);
	echo $this->responsetext($postObj, $tpl);
}else{
	$tpl = str_replace('{username}',$user['username'],$config['altpl']);
	echo $this->responsetext($postObj, $tpl);
}

function g2u($a) {
    return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
    return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}
function register($username, $return = 0, $groupid = 0,$defaultpassword) {
	global $_G;
	if(!$username) {
		return;
	}

	if(!$_G['wechat']['setting']) {
		$_G['wechat']['setting'] = unserialize($_G['setting']['mobilewechat']);
	}

	loaducenter();
	$groupid = !$groupid ? ($_G['wechat']['setting']['wechat_newusergroupid'] ? $_G['wechat']['setting']['wechat_newusergroupid'] : $_G['setting']['newusergroupid']) : $groupid;
	$pwd = random(7);
	if($defaultpassword){
		$pwd = $defaultpassword;
	}
	$password = md5($pwd);
	$email = 'wechat_'.strtolower(random(10)).'@null.null';

	$usernamelen = dstrlen($username);
	if($usernamelen < 3) {
		$username = $username.'_'.random(5);
	}
	if($usernamelen > 15) {
		if(!$return) {
			showmessage('profile_username_toolong');
		} else {
			return;
		}
	}

	$censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($_G['setting']['censoruser'] = trim($_G['setting']['censoruser'])), '/')).')$/i';

	if($_G['setting']['censoruser'] && @preg_match($censorexp, $username)) {
		if(!$return) {
			showmessage('profile_username_protect');
		} else {
			return;
		}
	}

	if(!$_G['wechat']['setting']['wechat_disableregrule']) {
		loadcache('ipctrl');
		if($_G['cache']['ipctrl']['ipregctrl']) {
			foreach(explode("\n", $_G['cache']['ipctrl']['ipregctrl']) as $ctrlip) {
				if(preg_match("/^(".preg_quote(($ctrlip = trim($ctrlip)), '/').")/", $_G['clientip'])) {
					$ctrlip = $ctrlip.'%';
					$_G['setting']['regctrl'] = $_G['setting']['ipregctrltime'];
					break;
				} else {
					$ctrlip = $_G['clientip'];
				}
			}
		} else {
			$ctrlip = $_G['clientip'];
		}

		if($_G['setting']['regctrl']) {
			if(C::t('common_regip')->count_by_ip_dateline($ctrlip, $_G['timestamp']-$_G['setting']['regctrl']*3600)) {
				if(!$return) {
					showmessage('register_ctrl', NULL, array('regctrl' => $_G['setting']['regctrl']));
				} else {
					return;
				}
			}
		}

		$setregip = null;
		if($_G['setting']['regfloodctrl']) {
			$regip = C::t('common_regip')->fetch_by_ip_dateline($_G['clientip'], $_G['timestamp']-86400);
			if($regip) {
				if($regip['count'] >= $_G['setting']['regfloodctrl']) {
					if(!$return) {
						showmessage('register_flood_ctrl', NULL, array('regfloodctrl' => $_G['setting']['regfloodctrl']));
					} else {
						return;
					}
				} else {
					$setregip = 1;
				}
			} else {
				$setregip = 2;
			}
		}

		if($setregip !== null) {
			if($setregip == 1) {
				C::t('common_regip')->update_count_by_ip($_G['clientip']);
			} else {
				C::t('common_regip')->insert(array('ip' => $_G['clientip'], 'count' => 1, 'dateline' => $_G['timestamp']));
			}
		}
	}

	$uid = uc_user_register(addslashes($username), $pwd, $email, '', '', $_G['clientip']);
	if($uid <= 0) {
		if(!$return) {
			if($uid == -1) {
				showmessage('profile_username_illegal');
			} elseif($uid == -2) {
				showmessage('profile_username_protect');
			} elseif($uid == -3) {
				showmessage('profile_username_duplicate');
			} elseif($uid == -4) {
				showmessage('profile_email_illegal');
			} elseif($uid == -5) {
				showmessage('profile_email_domain_illegal');
			} elseif($uid == -6) {
				showmessage('profile_email_duplicate');
			} else {
				showmessage('undefined_action');
			}
		} else {
			return;
		}
	}

	$init_arr = array('credits' => explode(',', $_G['setting']['initcredits']));
	C::t('common_member')->insert($uid, $username, $password, $email, $_G['clientip'], $groupid, $init_arr);

	if($_G['setting']['regctrl'] || $_G['setting']['regfloodctrl']) {
		C::t('common_regip')->delete_by_dateline($_G['timestamp']-($_G['setting']['regctrl'] > 72 ? $_G['setting']['regctrl'] : 72)*3600);
		if($_G['setting']['regctrl']) {
			C::t('common_regip')->insert(array('ip' => $_G['clientip'], 'count' => -1, 'dateline' => $_G['timestamp']));
		}
	}

	if($_G['setting']['regverify'] == 2) {
		C::t('common_member_validate')->insert(array(
			'uid' => $uid,
			'submitdate' => $_G['timestamp'],
			'moddate' => 0,
			'admin' => '',
			'submittimes' => 1,
			'status' => 0,
			'message' => '',
			'remark' => '',
		), false, true);
		manage_addnotify('verifyuser');
	}

	setloginstatus(array(
		'uid' => $uid,
		'username' => $username,
		'password' => $password,
		'groupid' => $groupid,
	), 0);

	//ͳ��
	include_once libfile('function/stat');
	updatestat('register');

	return array(
		'uid' => $uid,
		'username' => $username,
		'password' => $pwd,
		'groupid' => $groupid,		
	);
}

?>