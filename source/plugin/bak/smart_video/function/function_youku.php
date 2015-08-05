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
function get_youkuvideo_by_vid($vid){
$params['client_id']="f1652f5ab2517d4d";
$params['video_id']=$vid;
$base_url="https://openapi.youku.com/v2/videos/show.json";
$url=$base_url."?".http_build_query($params);
$s =file_data($url);
$result= json_decode($s, true);
return $result;
}
function get_playlist_byid($id){
$params['client_id']="f1652f5ab2517d4d";
$params['playlist_id']=$id;
$params['count']=100;
$base_url="https://openapi.youku.com/v2/playlists/videos.json";
$url=$base_url."?".http_build_query($params);
$s =file_data($url);
$result= json_decode($s, true);
$video=$result['videos'];
if(empty($video)) return false;
$result['videoname']=array();
$result['videolink']=array();
$result['videoimg']=array();
$result['videotime']=array();
foreach($video as$vk=>$vv){//http://player.56.com/cpm_MTA4NzEzNDUz.swf
$result['videoname'][$vk]= diconv($vv['title'],"utf-8"); 
$result['videolink'][$vk]='http://player.youku.com/player.php/Type/Folder/Fid/19466264/Ob/1/sid/'.$vv['id'].'/v.swf';
$result['videoimg'][$vk]= $vv['thumbnail'];
$result['videotime'][$vk]= strtotime($vv['published']); 
}
unset($result['videos']);
return $result;	
	}
function file_data($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        @ $data = curl_exec($ch);
        curl_close($ch);
		if (!$data) {
		$data = file_get_contents($url);
		return $data;
		}
        return $data;
}