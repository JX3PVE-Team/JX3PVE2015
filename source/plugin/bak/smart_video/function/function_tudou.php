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
function get_tudouv_by_id($id){
	$url="http://api.tudou.com/v6/video/info?app_key=a3f35cc3746929ab&format=json&itemCodes=".$id;
	$s = file_get_contents($url);
	$result= json_decode($s, true);
	$result=$result['results'][0];
	if(empty($result))return false;
	return $result;
	}
function get_tplaylist_byid($id){
	  $url="http://api.tudou.com/v6/playlist/video_list?app_key=a3f35cc3746929ab&format=json&pageSize=100&playlistCode=".$id;
	  $s = file_get_contents($url);
	  $result= json_decode($s, true);
	  $video=$result['results'];
	  if(empty($result))return false;
		$result['videoname']=array();
		$result['videolink']=array();
		$result['videoimg']=array();
		$result['videotime']=array();
		foreach($video as$vk=>$vv){//http://player.56.com/cpm_MTA4NzEzNDUz.swf
		$result['videoname'][$vk]= diconv($vv['title'],"utf-8"); 
		$result['videolink'][$vk]=$vv['outerPlayerUrl'];
		$result['videoimg'][$vk]= $vv['picUrl'];
		$result['videotime'][$vk]= strtotime($vv['pubDate']); 
		}
	  return $result;
	}	