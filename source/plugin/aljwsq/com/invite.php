<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$code = strtolower(random(6));
$invitedata = array(
				'uid' => $_G['uid'],
				'code' => $code,
				'dateline' => $_G['timestamp'],
				'endtime' => $_G['group']['maxinviteday'] ? ($_G['timestamp']+$_G['group']['maxinviteday']*24*3600) : 0,
				'inviteip' => $_G['clientip']
		);
C::t('common_invite')->insert($invitedata);
echo $this->responsetext($postObj, $code);
?>