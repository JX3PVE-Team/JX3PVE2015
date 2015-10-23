<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']){
	showmessage('to_login', '', array(), array('showmsg' => true,'login' => 1));
}

$setting = $_G['cache']['plugin']['k_gaiming'];
$setting['usergroups'] = unserialize($setting['usergroups']);
/*
if(!in_array($_G['member']['groupid'], $setting['usergroups'])){
	showmessage(lang('plugin/k_gaiming', 'notp'));
}

*/
foreach ($setting['usergroups'] as $k => $v){
	$grouptitle[] = $_G['cache']['usergroups'][$v]['grouptitle'];
}
$allowgroup['num'] = count($grouptitle);
$c = getuserprofile('extcredits'.$setting['creditunit']);
//print_r($grouptitle);

$re   = '';
$hash = formhash();

if(submitcheck('formhash')){
	if(!in_array($_G['member']['groupid'], $setting['usergroups'])){
		showmessage(lang('plugin/k_gaiming', 'notp'));
	}
	$lastlog = DB::fetch_first("SELECT * FROM ".DB::table("plugin_k_gaiming_log")." WHERE uid='".$_G['uid']."' ORDER BY dateline DESC");
	if($lastlog['dateline'] && ($_G['timestamp'] - $lastlog['dateline'] < 60*60*$setting['jianxie']) ){
		showmessage(lang('plugin/k_gaiming', 'notp2').$setting['jianxie'].lang('plugin/k_gaiming', 'notp2_unit'));
	}
	
	loaducenter();
	$oldusername = $_G['username'];
	$olduserid   = $_G['uid'];
	$newusername = addslashes(htmlspecialchars($_GET['newname']));
	if ($newusername == '') {
		$re = lang('plugin/k_gaiming', 'nonewusername');
	} else {
		$check = uc_user_checkname($newusername);
		$error_info = array(
			'-1' => lang('plugin/k_gaiming', 'error_1'),
			'-2' => lang('plugin/k_gaiming', 'error_2'),
			'-3' => lang('plugin/k_gaiming', 'error_3')
		);
		if ($check != 1) {
			$re = $error_info[$check];
		}else{
			if($setting['creditunit']){
				if($setting['creditnum'] && $c < $setting['creditnum']){
					showmessage(lang('plugin/k_gaiming', 'nocredit'));
				}
			}
			changename($oldusername, $newusername);
			changename_for_uc($oldusername, $newusername);
			if($setting['creditunit'] && $setting['creditnum']){
				updatemembercount($_G['uid'], array('extcredits'.$setting['creditunit'] => '-'.$setting['creditnum']), true, 'KGM', $_G['uid']);
			}
			$logdata = array(
				'uid' => $_G['uid'],
				'creditunit' => $setting['creditunit'],
				'creditnum' => $setting['creditnum'],
				'oldname' => addslashes($oldusername),
				'newname' => addslashes($newusername),
				'dateline' => $_G['timestamp'],
			);
			DB::insert('plugin_k_gaiming_log', $logdata);
			$re = '<font color="green">'.lang('plugin/k_gaiming', 'success').'</font>';
		}
	}
}

function changename($oldname, $newname){
	$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE username='$oldname'");
	if($member){
		DB::query("UPDATE ".DB::table('common_adminnote')." SET admin='$newname' WHERE admin='$oldname'");
		DB::query("UPDATE ".DB::table('common_block')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_block_item')." SET title='$newname' WHERE title='$oldname'");
		DB::query("UPDATE ".DB::table('common_block_item_data')." SET title='$newname' WHERE title='$oldname'");
		DB::query("UPDATE ".DB::table('common_card_log')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_failedlogin')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_grouppm')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('common_invite')." SET fusername='$newname' WHERE fusername='$oldname'");
		DB::query("UPDATE ".DB::table('common_member')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_member_security')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_member_validate')." SET admin='$newname' WHERE admin='$oldname'");
		DB::query("UPDATE ".DB::table('common_member_verify_info')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_member_security')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_mytask')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_report')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_session')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('common_word')." SET admin='$newname' WHERE admin='$oldname'");
		DB::query("UPDATE ".DB::table('forum_activityapply')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_announcement')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collection')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectioncomment')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectionfollow')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectionteamworker')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_forumrecommend')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_groupuser')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_imagetype')." SET name='$newname' WHERE name='$oldname'");
		DB::query("UPDATE ".DB::table('forum_order')." SET buyer='$newname' WHERE buyer='$oldname'");
		DB::query("UPDATE ".DB::table('forum_order')." SET admin='$newname' WHERE admin='$oldname'");
		DB::query("UPDATE ".DB::table('forum_pollvoter')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_post')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_postcomment')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_promotion')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_ratelog')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_rsscache')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_thread')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('forum_threadmod')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_trade')." SET seller='$newname' WHERE seller='$oldname'");
		DB::query("UPDATE ".DB::table('forum_tradelog')." SET seller='$newname' WHERE seller='$oldname'");
		DB::query("UPDATE ".DB::table('forum_tradelog')." SET buyer='$newname' WHERE buyer='$oldname'");
		DB::query("UPDATE ".DB::table('forum_warning')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('home_album')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_blog')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_clickuser')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_comment')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('home_docomment')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_doing')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_feed')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_feed_app')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow')." SET fusername='$newname' WHERE fusername='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow_feed')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow_feed_archiver')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_friend')." SET fusername='$newname' WHERE fusername='$oldname'");
		DB::query("UPDATE ".DB::table('home_friend_request')." SET fusername='$newname' WHERE fusername='$oldname'");
		DB::query("UPDATE ".DB::table('home_notification')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('home_pic')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_poke')." SET fromusername='$newname' WHERE fromusername='$oldname'");
		DB::query("UPDATE ".DB::table('home_share')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_show')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_specialuser')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_visitor')." SET vusername='$newname' WHERE vusername='$oldname'");
		DB::query("UPDATE ".DB::table('home_specialuser')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('portal_article_title')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('portal_comment')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('portal_rsscache')." SET author='$newname' WHERE author='$oldname'");
		DB::query("UPDATE ".DB::table('portal_topic')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('portal_topic_pic')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collection')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectioncomment')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectionfollow')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('forum_collectionteamworker')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow')." SET username='$fusername' WHERE username='$fusername'");
		DB::query("UPDATE ".DB::table('home_follow_feed')." SET username='$newname' WHERE username='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow_feed_archiver')." SET username='$newname' WHERE username='$oldname'");
	}
	return $member;
}

function changename_for_uc($oldname, $newname){
	DB::query("UPDATE ".UC_DBTABLEPRE."admins SET username='$newname' WHERE username='$oldname'");
	DB::query("UPDATE ".UC_DBTABLEPRE."badwords SET admin='$newname' WHERE admin='$oldname'");
	DB::query("UPDATE ".UC_DBTABLEPRE."feeds SET username='$newname' WHERE username='$oldname'");
	DB::query("UPDATE ".UC_DBTABLEPRE."members SET username='$newname' WHERE username='$oldname'");
	DB::query("UPDATE ".UC_DBTABLEPRE."mergemembers SET username='$newname' WHERE username='$oldname'");
	DB::query("UPDATE ".UC_DBTABLEPRE."protectedmembers SET username='$newname' WHERE username='$oldname'");
}
?>