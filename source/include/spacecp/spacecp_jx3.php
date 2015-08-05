<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_profile.php 33688 2013-08-02 03:00:15Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$actives = array('jx3' =>' class="a"');
$verifyuids= array();
$verifyuids[0]=$_G[uid];
$verify= '';

if($_G['setting']['verify']['enabled'] && $verifyuids) {
	foreach(C::t('common_member_verify')->fetch_all($verifyuids) as $value) {
		foreach($_G['setting']['verify'] as $vid => $vsetting) {
			if($vsetting['available'] && $vsetting['showicon'] && $value['verify'.$vid] == 1 ) {
				$srcurl = '';
					if(!empty($vsetting['icon'])) {
				$srcurl = $vsetting['icon'];
					}
				$verify .= "<a href=\"home.php?mod=spacecp&ac=profile&op=verify&vid=$vid\" target=\"_blank\">".(!empty($srcurl) ? '<img src="'.$srcurl.'" class="vm" alt="'.$vsetting['title'].'" title="'.$vsetting['title'].'" />' : $vsetting['title']).'</a>';
			}else {
				$srcurl = '';
				$srcurl =   $vsetting['unverifyicon'];
				$verify.= "<a href=\"home.php?mod=spacecp&ac=profile&op=verify&vid=$vid\" target=\"_blank\">".(!empty($srcurl) ? '<img src="'.$srcurl.'" class="vm" alt="'.$vsetting['title'].'" title="'.$vsetting['title'].'" />' : $vsetting['title']).'</a>';
			 }  
		}

	}
}


$sql = "SELECT g.icon FROM ".DB::table('common_usergroup')." g WHERE g.groupid=".$_G[group][groupid]." LIMIT 0, 1";

$query = DB::query($sql);

$groupicon= '';

while($result = DB::fetch($query)) {
		$groupicon =$result['icon'] ;
}

include template("home/spacecp_jx3");

