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
	$main_video=explode("|",$smart['main_video']);
	$cache_dir=DISCUZ_ROOT.'./data/sysdata/cache_smart_video.php';
	if(!file_exists($cache_dir)){
	$smart_video=smart_cache();
	}else{
	include($cache_dir);
	$dtime=time()-$smart_video['time'];
	if($dtime>=intval($smart['cache'])){
	$smart_video=smart_cache();}
	}
	$hot=$smart_video['hot'];
	$new=$smart_video['new'];
	$fclass= $smart_video['fclass'];
	$enew=$smart_video['enew'];
	$boke=$smart_video['boke'];
	$metakeywords=$smart['keyword'];
    $metadescription=$smart['descript'];
	include template("smart_video:m");
  
  ?>