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
function get_video_by_vid($vid){
  $params['vid']=$vid;
  $url="http://oapi.56.com/video/getVideoInfo.json";
  $url = $url.'?'.signRequest($params);
  $s = file_get_contents($url);
  $result= json_decode($s, true);
  $result=$result[0];
  if(empty($result))return false;
  $result['swf']='http://player.56.com/w_'.$result['vid'];
 $result['swf'].=base64_decode("LnN3Zi8xMDMxX3NtYXJ0Y29tZS5zd2Y=");
 return $result;
}
function get_album_by_aid($aid){
  $params['aid']=$aid;
  $url="http://oapi.56.com/album/info.json";
  $url = $url.'?'.signRequest($params);
  $s = file_get_contents($url);
  $result= json_decode($s, true);
  $video=$result[videolist][data];
  if(empty($video)) return false;
  $result['videoname']=array();
  $result['videolink']=array();
  $result['videoimg']=array();
   $result['videotime']=array();
  foreach($video as$vk=>$vv){//http://player.56.com/cpm_MTA4NzEzNDUz.swf
	 $result['videoname'][$vk]= diconv($vv['video_title'],"utf-8"); 
	 $result['videolink'][$vk]='http://player.56.com/w_'.$vv['video_id'];
	 $result['videolink'][$vk].=base64_decode("LnN3Zi8xMDMxX3NtYXJ0Y29tZS5zd2Y=");
	 $result['videoimg'][$vk]= $vv['video_cover'];
	 $result['videotime'][$vk]= $vv['add_time']; 
	  }
 unset($result[videolist][data]);
  return $result;	
	}
function signRequest($params){
        $appkey="3000002952";
        $secret="2ac6490b620dab7c";
		/**
		* 先去除系统级参数
		*/
		unset($params['appkey']);
		unset($params['ts']); 
		ksort($params);
		/**
		* 第一轮md5字符串
		* */	
		$req   =  md5(http_build_query($params));
		$ts    =  time();/**当次请求的时间戳**/
		/**第二轮md5字符串,得到最后的签名变量,注意里面的顺序不可以改变否则结果错误!**/
		$params['sign'] = md5($req.'#'.$appkey.'#'.$secret.'#'.$ts);
		$params['appkey']=$appkey;
		$params['ts']=$ts;
		return http_build_query($params);
	}
	