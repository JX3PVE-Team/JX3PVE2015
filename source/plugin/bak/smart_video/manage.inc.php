<?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile("function/video","plugin/smart_video");
loadcache('plugin');
$smart=$_G['cache']['plugin']['smart_video'];
$lan=lang("plugin/smart_video");
   if(submitcheck('submit')){
	   $key=stripsearchkey(trim($_POST['key']));
	   $where="subject LIKE '%".$key."%'";
	}else{
	  $key=stripsearchkey(htmlspecialchars_decode($_GET['key']));	
	  if(empty($key))$where='1=1';
	  else{$where="subject LIKE '%".$key."%'";}
		}
   $htmlkey=htmlspecialchars($key);	
   $url=ADMINSCRIPT."?action=plugins&identifier=smart_video&pmod=manage&key=".$htmlkey;
  if(submitcheck('msubmit')){
	   $type=trim($_POST['type']);
	   $select=$_POST['smart_select'];
	   if($type=="t"){
			 foreach($select as $sk=>$sv){
			 C::t("#smart_video#video")->update_by_where("smart_video_thread",array('visiable'=>1),"tid=".intval($sv));  
			 $authorid=C::t("#smart_video#video")->result_first('authorid','smart_video_thread',"tid=".intval($sv));
             $note='&#24685;&#21916;&#20320;&#44;&#20320;&#21457;&#24067;&#30340;&#35270;&#39057;&#36890;&#36807;&#23457;&#26680;&#20102;&#65281;<a href="'.SMART_VIDEO_URL.'&mod=v&tid='.intval($sv).'">&#x70B9;&#x6B64;&#x770B;&#x4E00;&#x770B;</a>';
              notification_add($authorid,'post', $note);
			  updatemembercount($authorid, array($smart['pjftype'] => $smart['pjfvalue']));
			 }
			 cpmsg("&#25805;&#20316;&#25104;&#21151;&#65281;","action=plugins&identifier=smart_video&pmod=manage&key=".$htmlkey,'error'); 		   
		   }elseif($type=="d"){
			   foreach($select as $sk=>$sv){
				   $imgsrc=C::t("#smart_video#video")->result_first('coverimg','smart_video_thread',"tid=".intval($sv));
	               @unlink($imgsrc);
				   C::t("#smart_video#video")->delete_by_where("tid=".intval($sv),'smart_video_thread'); 
				   C::t("#smart_video#video")->delete_by_where("tid=".intval($sv),'smart_video_post'); 
				   }
				   cpmsg($lan['cp_del'],"action=plugins&identifier=smart_video&pmod=manage&key=".$htmlkey,'error'); 
			   }
	}else{
   $class= get_all_class();
   $perpage=5;$page=max(1,intval($_GET['page']));
   $start=$perpage*$page-$perpage;
   $posts=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread',$where,'visiable asc,displayorder desc,dateline desc',$start,$perpage);
   $maxnum=C::t("#smart_video#video")->count_by_where('smart_video_thread',$where); 
   $multi=multi($maxnum,$perpage,$page,$url,0,10,true,FALSE);
   showtableheader('', 'psetting');
   include template('smart_video:manage');	
   showtablefooter();
   
   }
?>