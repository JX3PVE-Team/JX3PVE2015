<?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(submitcheck('urlsubmit',1)){
$tid=intval($_GET['tid']);$order=intval($_GET['order']);
$post=C::t("#smart_video#video")->fetch_first("smart_video_post","tid=$tid and first=1");
$video=unserialize(stripslashes($post['audio']));
if(empty($video[$order]['link'])){
$url="http://player.56.com/w_100247966.swf/1031_smartcome.swf";
}else{
$url=$_G['siteurl'].$video[$order]['link'];	
	}	
header("location:$url");			
	}else{
	header("location:http://player.56.com/w_100247966.swf/1031_smartcome.swf");		
		}
?>