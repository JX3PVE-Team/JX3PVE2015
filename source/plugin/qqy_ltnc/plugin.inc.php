<?php
/**
 * Plugin For Discuz! X2.5-X3.0
 
 * Copyright (c) 2006 - 2016 Zhanzhangzu.com.

 * 作者:      全球鹰
 
 * 邮箱:      641500953@qq.com
 
 * 网站:      www.zhanzhangzu.com
  
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
    $charset=$_G['config']['output']['charset'];
    $wordlists = $keyfilter = $is_exit = $response='';
	$uid=$_G['uid'];
	$uidname=$_G[member][username];
	
	$useids 	= $_G['cache']['plugin']['qqy_ltnc']['useids'];
	$credit 	= $_G['cache']['plugin']['qqy_ltnc']['credit'];
	$credits 	= $_G['cache']['plugin']['qqy_ltnc']['credits'];
	$format 	= $_G['cache']['plugin']['qqy_ltnc']['format'];
	$usetime 	= $_G['cache']['plugin']['qqy_ltnc']['usetime'];
	$wordlist 	= $_G['cache']['plugin']['qqy_ltnc']['wordlist'];
	$writelog 	= $_G['cache']['plugin']['qqy_ltnc']['writelog'];
	if(!in_array($_G['groupid'],(array)unserialize($useids))){
		$error=1;
		return '';
	}

    if($credit){
	    $user_credit=getuserprofile('extcredits'.$credit);
		$user_left=$user_credit -$credits;
	    if($user_left<0){
			$error_credit=1;
			return '';
		}
	}
    $wordlists = explode("\n", $wordlist);

	$fname=$_POST['fname'];
	if($charset=='gbk'){
		$fname=iconv( 'UTF-8','gbk',$fname);
	}

	$fname=trim($fname);
	$fname=addslashes(strip_tags($fname));
	if($fname){
		if(!empty($wordlists)){
			foreach($wordlists as $banword){//是否在禁用关键词范围内
				$banword=trim($banword);
				$blurmatch = trim($banword,'*');
				if( '*'.$blurmatch.'*' == $banword ){
					if( strstr($fname,$blurmatch)){
						$keyfilter=1;
					}	
				}else{
					if( $banword ==$fname){
						$keyfilter=1;
					}		
				}	
			}
		}
		if($keyfilter==1){
			echo -1;	
		}else{
			$is_exit = DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$fname' and uid<>$uid");
			if($is_exit){
				echo 0;
			}else{
				echo 1;
			}	
		}  
	}
	
	$is_setss = DB::result_first("SELECT addname FROM ".DB::table('common_member')." WHERE uid=$uid");
	
	if($is_setss && ($usetime<=1 || !$usetime || $usetime<=$is_setss)){
		$is_sets=1;
		return '';
	}
    elseif(!$is_setss || ($is_setss < $usetime)){
		$nicheng= $_POST['nicheng'];
		$action = $_GET['action'];
		$nicheng=addslashes(trim($nicheng));
		if($nicheng && $action=='submit'){
	    	$is_have = DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$nicheng' and uid!=$uid");
		
		foreach($is_wordlist as $wordssss){
			$wordssss=trim($wordssss);
			if( $wordssss == $nicheng){
				$is_keysss=1;
			}
		}
		
    if($is_have || $is_keysss==1){
		$error_exist=1;
		return '';
	}else{
		$nowtime = time();
		$oldname = addslashes($uidname);
	    if(!$is_setss){$c_count=1;}else{ $c_count=$is_setss+1;}
		DB::query("UPDATE ".DB::table('common_member')." SET username='$nicheng',addname='$c_count' where uid=$uid");
		if($writelog){//write log
			DB::query("INSERT INTO ".DB::table('qqy_ltnclog')." (uid,name,logtime) VALUES ($uid,'$nicheng','$nowtime')");
		}	
		DB::query("UPDATE ".DB::table('forum_post')." SET author='$nicheng' where authorid=$uid");
		DB::query("UPDATE ".DB::table('forum_thread')." SET author='$nicheng' where authorid=$uid");
		DB::query("UPDATE ".DB::table('forum_thread')." SET lastposter='$nicheng' where lastposter='$oldname'");
		DB::query("UPDATE ".DB::table('home_follow')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_follow')." SET fusername='$nicheng' where followuid=$uid");
		DB::query("UPDATE ".DB::table('home_friend')." SET fusername='$nicheng' where fuid=$uid");
		DB::query("UPDATE ".DB::table('home_doing')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_blog')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_comment')." SET author='$nicheng' where authorid=$uid");
		DB::query("UPDATE ".DB::table('home_docomment')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('forum_ratelog')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('forum_collection')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_pic')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_feed')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_feed_app')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_follow_feed')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_album')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_visitor')." SET vusername='$nicheng' where vuid=$uid");
		DB::query("UPDATE ".DB::table('home_share')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_follow_feed')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_follow_feed_archiver')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_specialuser')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('home_notification')." SET author='$nicheng' where authorid=$uid");
		DB::query("UPDATE ".DB::table('forum_groupuser')." SET username='$nicheng' where uid=$uid");
		DB::query("UPDATE ".DB::table('forum_forumfield')." SET foundername ='$nicheng' where founderuid=$uid and gviewperm=1");
		//moderators 
		$is_forummod = DB::result_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid=$uid");
		$forummods =array(1,2,3,16,19);
		if(in_array($is_forummod,$forummods)){
			$forumfids =array();
			$queryfids = DB::query("SELECT moderators,fid FROM ".DB::table('forum_forumfield')." WHERE gviewperm=0 and moderators is not null");
			while($itemfids=DB::fetch($queryfids))$forumfids[]=$itemfids;
				foreach($forumfids as $forumfid){
					$fid_moderators = $forumfid['moderators'];
					$get_fid =$forumfid['fid'];
					$arraymoderator = explode("\t", $fid_moderators);
					if(in_array($uidname,$arraymoderator)){
						$moderators = $comma = '';
						foreach($arraymoderator as $moderator){
							if($moderator==$uidname){
								$moderator = $nicheng;
							}
							$moderators.=$comma.$moderator;
							$comma = "\t";
						}
						DB::query("UPDATE ".DB::table('forum_forumfield')." SET moderators ='$moderators' where fid=$get_fid");
					}
				}	
		}
	$querygroup = DB::query("SELECT moderators,fid FROM ".DB::table('forum_forumfield')." WHERE gviewperm=1");
	$groupfids =array();
	while($itemfidss=DB::fetch($querygroup))$groupfids[]=$itemfidss;
	foreach($groupfids as $groupfid){
		$group_mods = $groupfid['moderators'];
		$group_fid = $groupfid['fid'];
		$group_mods =unserialize($group_mods);
		foreach($group_mods as $modinfs){
			$new_group[$modinfs['uid']] = $modinfs;
			if($modinfs['uid']==$uid){
			$thisfid = 1;
			$new_group[$modinfs['uid']]['username'] =$nicheng;;
			}
		}
		if($thisfid){
			$new_group = serialize($new_group);
			DB::query("UPDATE ".DB::table('forum_forumfield')." SET moderators ='$new_group' where fid=$group_fid");
		}
	}

	if($credit && $user_left){
		DB::query("UPDATE ".DB::table('common_member_count')." SET extcredits".$credit."=$user_left where uid=$uid");
	}
	$success=1;
	dheader('Location:home.php?mod=spacecp&ac=plugin&id=qqy_ltnc:plugin&action=success');
	}
}	
}

?>