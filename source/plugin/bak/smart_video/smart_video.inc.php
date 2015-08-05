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
   $lan=lang("plugin/smart_video");
   $smart=$_G['cache']['plugin']['smart_video'];
   $navtitle=$smart['title'];
   $metakeywords=$navtitle;
   require_once libfile("function/video","plugin/smart_video");
   $mods=array('s','m','p','v','u','url');
   $mod=$_GET['mod'];
   if(!in_array($mod,$mods)){
	   if(!defined('IN_MOBILE')){$mod='m';
	   }else{$mod='s';}
	   }
   require libfile("module/$mod","plugin/smart_video")
?>