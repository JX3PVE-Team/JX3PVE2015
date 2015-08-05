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
if($_G[groupid]!=1&&!in_array($_G[groupid],unserialize($smart['allow_r']))||!$_G[uid]){
	$forbide_reply=1;
	}
$tid=intval($_GET['tid']);
$tid=max(1,$tid);
C::t("#smart_video#video")->increase_by_where("smart_video_thread",'play',"tid=$tid");
$thread=C::t("#smart_video#video")->fetch_first("smart_video_thread","tid=$tid");
if(empty($thread))showmessage('&#x5BF9;&#x4E0D;&#x8D77;,&#x4F60;&#x6240;&#x67E5;&#x770B;&#x7684;&#x5185;&#x5BB9;&#x4E0D;&#x5B58;&#x5728;&#xFF01;',dreferer());
if($_G[groupid]==1||($_G['uid']==$thread['authorid']&&$_G['uid'])){$self=1;}
if(!$thread['visiable']&&!$self)showmessage("&#23545;&#19981;&#36215;&#44;&#27492;&#35270;&#39057;&#27491;&#22312;&#23457;&#26680;&#20013;&#65281;","plugin.php?id=smart_video");
require_once libfile("function/reply","plugin/smart_video");
$post=C::t("#smart_video#video")->fetch_first("smart_video_post","tid=$tid and first=1");
$relt_video=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread','fcid='.$thread['fcid']." and num=1",'play desc,dateline desc',0,$smart['renum']);
$relt_album=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread','num>1','play desc,dateline desc',0,6);
$navtitle=$thread['subject'];
$mes=stripslashes($post['message']);
$video=unserialize(stripslashes($post['audio']));
$metakeywords=$navtitle.','.$post['fname'].','.$thread['subject'];
$metadescription=cutstr($mes,90,'');
$num=$thread['num'];
$perpage=max(1,$smart['per_reply']);
$page=1;
$where="tid=$tid and first<>1";
$replys=C::t("#smart_video#video")->fetch_all_by_where('smart_video_post',$where,'dateline desc',0,$perpage);
$maxnum=C::t("#smart_video#video")->count_by_where('smart_video_post',$where); 
$url=SMART_VIDEO_URL.":ajax&type=reply&tid=$tid";
$multi=get_smart_page($maxnum,$perpage,$page,$url,10,1,"reply_reajax");
$smiley=get_smiley();
$value=intval(getcookie("ping_video_".$thread[tid]));
$ext=smart_get_ext($video[0]['link']);
$first_url=get_smart_url($video[0][link],$tid,0);
if($num>1){	
$height=506;
include template("smart_video:vl");
}else{
$height=409;
include template("smart_video:v");	
}	
?>