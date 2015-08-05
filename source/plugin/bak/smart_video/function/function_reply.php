<?php
/**
 * 		Copyright£ºSmartCome
 * 		  WebSite£ºwww.SmartCome.com
 *             QQ: 2811931192
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
define("SMART_SMILEY_DIR","source/plugin/smart_video/static/images/0/");
function insert_new_reply(){
	    global $_G;
		$tid=intval($_POST['tid']);
		$post=array(
		'tid'=>$tid,
		'author'=>$_G['username'],
		'authorid'=>$_G['uid'],
		'audio'=>'',
		'message'=>$_POST['content'],
		'fname'=>'',
		'first'=>0,
		'dateline'=>time()
		);
		C::t("#smart_video#video")->increase_by_where('smart_video_thread','reply',"tid=$tid");
		smart_record(1);
		return C::t("#smart_video#video")->insert_new("smart_video_post",daddslashes($post),true);		
 	}						
function get_smiley(){
return array(
":)"=>"smile.gif",
":("=>"sad.gif",
":D"=>"biggrin.gif",
":@"=>"huffy.gif",
":o"=>"shocked.gif",
":P"=>"tongue.gif",
":$"=>"shy.gif",
";P"=>"titter.gif",
":L"=>"sweat.gif",
":Q"=>"mad.gif",
":lol"=>"lol.gif",
":loveliness:"=>"loveliness.gif",
":funk:"=>"funk.gif",
":curse:"=>"curse.gif",
":dizzy:"=>"dizzy.gif",
":shutup:"=>"shutup.gif",
":sleepy:"=>"sleepy.gif",
":hug:"=>"hug.gif",
":victory:"=>"victory.gif",
":time:"=>"time.gif",
":kiss:"=>"kiss.gif",
":handshake"=>"handshake.gif",
":call:"=>"call.gif");}
function deal_smile($str){
	 $smiley=get_smiley();
	foreach($smiley as$k=>$v){
		$str=str_replace($k,'<img  style=" height:20px;width:20px;"src="'.SMART_SMILEY_DIR.$v.'"/>',$str);
		}
	return $str;	
	}
?>