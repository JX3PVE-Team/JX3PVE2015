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
define("SMART_VIDEO_URL","plugin.php?id=smart_video");
define("SMART_VIDEO_DIR","source/plugin/smart_video/");
function get_turl($tid){
	global $_G;
	$smart=$_G['cache']['plugin']['smart_video'];
	if($smart['seo']){	
	return "smart_video-v&$tid.html";//^(.*)/([a-z]+[a-z0-9_]*)-([a-z0-9_\-]+)\.html$ $1/plugin.php?id=$2:$3&%1
	}else{
	return "plugin.php?id=smart_video:smart_video&mod=v&tid=$tid";			
		}	
}
function get_furl($fcid=0,$scid=0,$tcid=0){
	global $_G;
	$smart=$_G['cache']['plugin']['smart_video'];
	if($smart['seo']){	
	return "smart_video-s&$fcid&$scid&$tcid.html";//^(.*)/([a-z]+[a-z0-9_]*)-([a-z0-9_\-]+)\.html$ $1/plugin.php?id=$2:$3&%1
	}else{
	return "plugin.php?id=smart_video:smart_video&mod=s&fcid=$fcid&scid=$scid&tcid=$tcid";			
		}
		
}	
function check_uploaddir(){
	$ym=date("Ym");$d=date("d");
	$main_dir=DISCUZ_ROOT."source/plugin/smart_video/upload/";
	if(!is_dir($main_dir))mkdir($main_dir);
	if(!is_dir($main_dir.$ym."/")) mkdir($main_dir.$ym."/");
	if(!is_dir($main_dir.$ym."/".$d."/")) mkdir($main_dir.$ym."/".$d."/");
	return "source/plugin/smart_video/upload/".$ym."/".$d."/";
}
function get_all_class(){
		 $class= C::t("#smart_video#video")->fetch_all("1=1");
	     $cache=array();
		 foreach($class as$ck=>$cv){
			 $cache[$cv[cid]]=$cv;
			 }
		return $cache;	  
	}
function is_have_empty($ar){
	foreach($ar as$k=>$v){
		if(!is_array($v)){
			if(empty($v))return true;
			}else{
			is_have_empty($v);
			}	
		}
	return false;
	}
function get_bootstrap_page($num,$perpage=12,$page,$url,$around=10){
	if(!$num)return ;
	$perpage=max(1,$perpage);
	$upage=max(1,$page-1);
	$tpage=$num%$perpage?intval($num/$perpage)+1:intval($num/$perpage);
	if($tpage==1)return;
	$page=min($page,$tpage);
	$nextpage=min(($page+1),$tpage);
		$html='<ul class="pagination">';
	$html.='<li><a href="'.$url."&page=$upage".'">&laquo;</a></li>';
	for($i=0;$i<=2*$around;$i++){
	$thispage=$page-$around+$i;
	if(($thispage>=1)&&($thispage<=$tpage)){
		if($thispage==$page){
			$html.='<li class="active"><a>'.$thispage.'</a></li>';
			}else{
				$html.='<li><a href="'.$url."&page=$thispage".'">'.$thispage.'</a></li>';
				
				}
			
		}
	
		
	}
		$html.='<li><a href="'.$url."&page=$upage".'">&raquo;</a></li></ul>';
return $html;	
}	
function get_smart_page($num,$perpage=12,$page,$url,$around=10,$ajax=1,$id="main"){
	if(!$num)return ;
	$perpage=max(1,$perpage);
	$html='<div class="pg"><a class="prev" ';
	$upage=max(1,$page-1);
	$html.=$ajax?'href="javascript:;" onclick="ajaxget(\''.$url.'&page='.$upage.'\',\''.$id.'\',null,null,null,null)">':'href="'.$url.'&page='.$upage.'">';
	$html.='</a>';
	$tpage=$num%$perpage?intval($num/$perpage)+1:intval($num/$perpage);
	if($tpage==1)return;
	$page=min($page,$tpage);
	for($i=0;$i<=2*$around;$i++){
	$thispage=$page-$around+$i;
	if(($thispage>=1)&&($thispage<=$tpage))
	if($thispage==$page){
	    $html.="<strong>$thispage</strong>";
	}else{
		$html.=$ajax?'<a href="javascript:;" onclick="ajaxget(\''.$url.'&page='.$thispage.'\',\''.$id.'\',null,null,null,null)">'.$thispage.'</a>':'<a href="'.$url.'&page='.$thispage.'">'.$thispage.'</a>';
		}
	
	}
	$js=$ajax?"ajaxget('{$url}&page='+this.value,'$id',null,null,null,null)":"window.location='{url}&page='+this.value";
	$html.='<label><input type="text" name="custompage" class="px" size="2" title="&#x8F93;&#x5165;&#x9875;&#x7801;&#xFF0C;&#x6309;&#x56DE;&#x8F66;&#x5FEB;&#x901F;&#x8DF3;&#x8F6C;" value="'.$page.'" onkeydown="if(event.keyCode==13) {'.$js.'; doane(event);}"><span title="&#x5171; '.$tpage.' &#x9875;"> / '.$tpage.' &#x9875;</span></label>';
	$html.='<a class="nxt" ';
	$nextpage=min(($page+1),$tpage);
	$html.=$ajax?'<a href="javascript:;" onclick="ajaxget(\''.$url.'&page='.$nextpage.'\',\''.$id.'\',null,null,null,null)">':'<a href="'.$url.'&page='.$nextpage.'">';
	$html.='&#x4E0B;&#x4E00;&#x9875;</a>';
	$html.='</div>';
	return $html;
	}
function insert_new_thread($lan,$collect=0){
	if(!$_POST['subject'])showmessage("&#19981;&#25903;&#25345;&#27492;&#117;&#114;&#108;&#38142;&#25509;&#26679;&#24335;&#30340;&#37319;&#38598;&#44;&#25110;&#32773;&#26631;&#39064;&#20026;&#31354;&#65281;");
	    global $_G;
		$smart=$_G['cache']['plugin']['smart_video'];
		$shen=unserialize($smart['shen']);
		$visiable=in_array($_G[groupid],$shen)?0:1;
		if(!$collect){
		$dir=check_uploaddir();
		$filename=time().rand(1, 10000).".png";
		move_uploaded_file($_FILES['coverimg']['tmp_name'],DISCUZ_ROOT.$dir.$filename);
		$imgsrc=$dir.$filename;
		}else{
		$imgsrc=$_POST['coverimg'];	
			}
		$thread=array(
		'author'=>$_G['username'],
		'authorid'=>$_G['uid'],
		'subject'=>$_POST['subject'],
		'coverimg'=>$imgsrc,
		'grade'=>0,
		'gnum'=>0,
		'fcid'=>intval($_POST['fcid']),
		'scid'=>intval($_POST['scid']),
		'tcid'=>intval($_POST['tcid']),
		'visiable'=>$visiable,
		'num'=>count($_POST['videoname']),
		'dateline'=>time()
		);
		$check_t=$thread;
		$tid=C::t("#smart_video#video")->insert_new("smart_video_thread",daddslashes($thread),true);
		$fcid=intval($_POST['fcid']);
		$fname=C::t("#smart_video#video")->result_first('name',"smart_video","cid=$fcid");
		$mes=preg_replace('/\<\s?script\s?\>/','<pre class="brush:js;toolbar:false">&lt;script&gt;',$_POST['editorValue']);
        $mes=preg_replace('/\<\/\s?script\s?\>/','&lt;/script&gt;</pre>',$mes);
		$videoname=$_POST['videoname'];$audio=array();$videolink=$_POST['videolink'];$videotime=$_POST['videotime'];
		$videoimg=$_POST['videoimg'];
		if(is_array($videoname)){
		foreach($videoname as$kvideo=>$vvideo){
			$tmp['name']=$vvideo;$tmp['link']=$videolink[$kvideo];
			$tmp['img']=$videoimg[$kvideo];$tmp['time']=$videotime[$kvideo]?$videotime[$kvideo]:time();
			$audio[]=$tmp;
			}
		}else{
			$audio[0]['name']=$videoname;
			$audio[0]['link']=$videolink;
			$audio[0]['img']=$videoimg;
			$audio[0]['time']=$videotime;
			}
		$audio=serialize($audio);	
		$post=array(
		'tid'=>$tid,
		'author'=>$_G['username'],
		'authorid'=>$_G['uid'],
		'audio'=>$audio,
		'message'=>$mes,
		'fname'=>$fname,
		'first'=>1,
		'dateline'=>time()
		);
		$pid=C::t("#smart_video#video")->insert_new("smart_video_post",daddslashes($post),true);
		smart_record(0,$tid,$_POST['subject']);
		showmessage($lan['p1'],"plugin.php?id=smart_video&mod=v&tid=$tid",'succeed');
	}
function smart_record($reply=0,$tid,$subject){
	global $_G;$uid=$_G['uid'];
	if(!$uid)return ;
	$have=C::t("#smart_video#video")->result_first('uid','smart_video_user',"uid=$uid");
	if(!$have)$id=C::t("#smart_video#video")->insert_new('smart_video_user',array("uid"=>$uid,"username"=>$_G['username'],"dateline"=>time()),true);
    if(!$reply){
		C::t("#smart_video#video")->increase_by_where('smart_video_user','threads',"uid=$uid");
	    C::t("#smart_video#video")->update_by_where('smart_video_user',array('tid'=>intval($tid),'subject'=>daddslashes($subject)),"uid=$uid");
	}
	C::t("#smart_video#video")->increase_by_where('smart_video_user','posts',"uid=$uid");
	}	
function smart_cache(){
	    global $_G;
		$smart=$_G['cache']['plugin']['smart_video'];
        $hot=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread','visiable=1','play desc,dateline desc',0,10);
		$boke=C::t("#smart_video#video")->fetch_all_by_where('smart_video_user','threads<>0','threads desc',0,8);
		if(empty($smart['recom'])){
		$new=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread','visiable=1','dateline desc',0,6);
		}else{
		$n_tids=explode("|",$smart['recom']);
		$new=C::t("#smart_video#video")->fetch_all_by_array('smart_video_thread','tid',$n_tids);
			}
		$fclass= C::t("#smart_video#video")->fetch_all("type=1");
		$enew=array();
		foreach($fclass as $k=>$v){
		$enew[]=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread','fcid='.intval($fclass[$k]['cid'])." and visiable=1",'dateline desc',0,9);
		if($k==8)break;
		}
		$smart_video=array('new'=>$new,'hot'=>$hot,'fclass'=>$fclass,'enew'=>$enew,'boke'=>$boke,'time'=>time());
		require_once libfile("function/cache");
		writetocache('smart_video', getcachevars(array('smart_video' =>$smart_video)));
	return $smart_video;
	}
function smart_get_ext($name){
	$na_ar=explode('.',$name);
	$max=count($na_ar)-1;
	$ext=$na_ar[$max];
	$ext=$ext?$ext:'png';
	return $ext;
	}
function get_smart_url($str,$tid,$order,$img=0){
	global $_G;$smart=$_G['cache']['plugin']['smart_video'];
	if(preg_match('/^source/',$str)){
		return $_G['siteurl'].$str;
		//if($img){return $_G['siteurl'].$str;}
		$tid=intval($tid);$order=intval($order);
		return $_G['siteurl']."plugin.php?id=smart_video&mod=url&tid=$tid&order=$order&urlsubmit=1&formhash=".FORMHASH;
		}elseif(preg_match('/^qn/',$str)){	
		$smart_qn=init_qn();
		$object=str_replace('qn:','',$str);
		$return=$smart_qn?$smart_qn->get_sign_url($object):'not set oss';
		return $return;
		}else{
		return $str;	
			}
	}
function init_qn(){
		global $_G;
		$smart=$_G['cache']['plugin']['smart_video'];
		require_once 'source/plugin/smart_video/qn.class.php';
		$ak=trim($smart["ak"]);
		$sk=trim($smart["sk"]);
		$bucket=trim($smart["bucket"]);
		if($ak&&$sk&&$bucket){
		$smart_qn=new smart_qn($ak,$sk,$bucket);
		return $smart_qn;
		}else{
		return NULL;	
			}
	}
function get_smart_player($url){
if(preg_match('/56\.com/',$url)){
	if(preg_match('/_([0-9a-zA-Z]{1,20})\.swf/',$url,$match)){
	$player='<iframe height="100%" width="100%" src="http://www.56.com/iframe/'.$match[1].'" frameborder=0 allowfullscreen></iframe>';
	}
	}elseif(preg_match('/youku\.com/',$url)){
	if(preg_match('/\/sid\/([0-9a-zA-Z]{6,20})\//',$url,$match)){
	$player='<iframe height="100%" width="100%" src="http://player.youku.com/embed/'.$match[1].'" frameborder=0 allowfullscreen></iframe>';
	}
	}
	if(!$player){
	$player='<embed  width="100%" height="100%" src="'.$url.'" allowFullScreen="true" quality="high"align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
	}
	return $player;
}													
?>