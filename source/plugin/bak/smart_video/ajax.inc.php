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
require_once libfile("function/video","plugin/smart_video");
require_once libfile("function/reply","plugin/smart_video");
$smart=$_G['cache']['plugin']['smart_video'];
include template('common/header_ajax');
if(submitcheck('rsubmit')){
	$tid=$_POST['tid'];
	if(getcookie("reply_".$tid)){
		showmessage("<font color='red'>&#x5BF9;&#x4E0D;&#x8D77;&#x4F60;&#x56DE;&#x590D;&#x7684;&#x8FC7;&#x4E8E;&#x9891;&#x7E41;&#xFF01;</font>");
	exit;
	}else{
		if(!$_POST['tid'])showmessage("&#x5BF9;&#x4E0D;&#x8D77; tid&#x4E0D;&#x80FD;&#x4E3A;&#x7A7A;");
		if(!$_POST['content'])showmessage("&#x8BF7;&#x586B;&#x5199;&#x5185;&#x5BB9;");
		$pid=insert_new_reply();
		$touid=$_POST['authorid'];
		if(preg_match('/^@/',$_POST['content'])){$touid=$_POST['touid'];}
		if($touid!=$_G['uid']){
          $note=$_G['username'].'&#x8BC4;&#x8BBA;&#x4E86;&#x4F60;&#x7684;&#x4E00;&#x6761;&#x5185;&#x5BB9;<a href="'.SMART_VIDEO_URL.'&mod=v&tid='.$tid.'#reply_list">&#x70B9;&#x6B64;&#x770B;&#x4E00;&#x770B;</a>';
			notification_add($touid,'post', $note);
			}
		 updatemembercount($_G['uid'], array($smart['rjftype'] => $smart['rjfvalue']));	
		dsetcookie('reply_'.$tid,1,max(30,$smart['dtime']));
		$replys[0]['message']=$_POST['content'];
		$replys[0]['author']=$_G['username'];
		$replys[0]['authorid']=$_G['uid'];
		$replys[0]['pid']=$pid;
		$replys[0]['dateline']=time();
		include template('smart_video:ajax_reply');}
}elseif($_GET['type']=='reply'){
	$perpage=max(1,$smart['per_reply']);
	$page=max(1,$_GET['page']);$tid=intval($_GET['tid']);
	$start=$perpage*$page-$perpage;
	$where="tid=$tid and first<>1";
	$replys=C::t("#smart_video#video")->fetch_all_by_where('smart_video_post',$where,'dateline desc',$start,$perpage);
	$maxnum=C::t("#smart_video#video")->count_by_where('smart_video_post',$where); 
	$url=SMART_VIDEO_URL.":ajax&type=reply&tid=$tid";
	$multi=get_smart_page($maxnum,$perpage,$page,$url,10,1,"reply_reajax");
	include template('smart_video:ajax_reply');
	
}elseif($_GET['type']=='delete'){
	if(submitcheck('dsubmit',1)){
		C::t("#smart_video#video")->delete_by_where('pid='.intval($_GET[pid]),'smart_video_post');
		}
}elseif($_GET['type']=='grade'){
	@list($tid,$value)=array(intval($_GET['tid']),intval($_GET['value']));
	if(!$tid)showmessage("&#x5BF9;&#x4E0D;&#x8D77;&#x7CFB;&#x7EDF;&#x51FA;&#x9519;&#xFF01;");
	$thread=C::t("#smart_video#video")->fetch_first('smart_video_thread',"tid=$tid");
	$grade=$thread['grade'];$gnum=$thread['gnum'];
	$ngnum=$gnum+1;$ngrade=(($grade*$gnum)+$value)/$ngnum; 
	$uparr=array('grade'=>$ngrade,'gnum'=>$ngnum);
	C::t("#smart_video#video")->update_by_where('smart_video_thread',$uparr,"tid=$tid");
	dsetcookie('ping_video_'.$tid,$value,2592000);
	for($i=1;$i<6;$i++){
		if($i<=$ngrade)echo '<li class="smart_x hover"></li>';
		else echo '<li class="smart_x"></li>';
		}
	echo '<div class="smart_grade"><font  color="#FF0000">'.number_format($ngrade,1).'</font>&#x5206;</div>';	
}elseif($_GET['list']){
	    @list($fcid,$scid)=array(intval($_GET[fcid]),intval($_GET[scid]));
		$key=array('fcid','scid');
		$where='';
		foreach($key as$k=>$v){
		if($$v!=0){
		$where.="$v=".$$v." and ";
		}
		}
		$where.="1=1";
		$smart=$_G['cache']['plugin']['smart_video'];
		$perpage=max(4,$smart['perpage']);$page=max(1,intval($_GET['page']));
		$start=$perpage*$page-$perpage;
		$posts=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread',$where,'displayorder desc,dateline desc',$start,$perpage);
		$maxnum=C::t("#smart_video#video")->count_by_where('smart_video_thread',$where); 
		$url="plugin.php?id=smart_video:ajax&list=1&fcid=$fcid&scid=$scid";
		$multi=get_smart_page($maxnum,$perpage,$page,$url);
	    include template('smart_video:ajax_post');
	}else{
		@list($type,$cup)=array(intval($_GET[type]),intval($_GET[cup]));
		$class= C::t("#smart_video#video")->fetch_all("type=$type and cup=$cup");
        include template('smart_video:ajax');
	}
	 include template('common/footer_ajax');
?>