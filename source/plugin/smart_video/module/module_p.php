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
if(submitcheck('submit')){
	if($_GET['type']=="collect"){
		$url=trim($_POST['url']);
		require_once libfile("function/collect","plugin/smart_video");	
		smart_collect($url);
		insert_new_thread($lan,1);
		}
	if($_POST['tid']){
		if($_FILES['coverimg']['size']){
			$dir=check_uploaddir();
			$filename=time().rand(1, 10000).".png";
			move_uploaded_file($_FILES['coverimg']['tmp_name'],DISCUZ_ROOT.$dir.$filename);
			@unlink($_POST['coverimg']);
			$coverimg=$dir.$filename;
			}else{$coverimg=$_POST['coverimg'];}
			$up=array(
			'subject'=>$_POST['subject'],
			'coverimg'=>$coverimg,
			'fcid'=>intval($_POST['fcid']),
			'scid'=>intval($_POST['scid']),
			'tcid'=>intval($_POST['tcid']),
			'num'=>count($_POST['videoname']),
		    'dateline'=>time()
			);	
	   C::t("#smart_video#video")->update_by_where("smart_video_thread",daddslashes($up),'tid='.intval($_POST['tid']));
	  $fcid=intval($_POST['fcid']);
		$fname=C::t("#smart_video#video")->result_first('name',"smart_video","cid=$fcid");
		$mes=preg_replace('/\<\s?script\s?\>/','<pre class="brush:js;toolbar:false">&lt;script&gt;',$_POST['editorValue']);
        $mes=preg_replace('/\<\/\s?script\s?\>/','&lt;/script&gt;</pre>',$mes);
		$videoname=$_POST['videoname'];$audio=array();$videolink=$_POST['videolink'];$videotime=time();
		$videoimg=$_POST['videoimg'];
		foreach($videoname as$kvideo=>$vvideo){
			$tmp['name']=$vvideo;$tmp['link']=$videolink[$kvideo];
			$tmp['img']=$videoimg[$kvideo];$tmp['time']=$videotime;
			$audio[]=$tmp;
			}
		$audio=serialize($audio);	
		$post=array(
		'audio'=>$audio,
		'message'=>$mes,
		'fname'=>$fname,
		'dateline'=>time()
		);
		 C::t("#smart_video#video")->update_by_where("smart_video_post",daddslashes($post),'tid='.intval($_POST['tid'])." and first=1");
	   showmessage($lan['update'],'plugin.php?id=smart_video&mod=v&tid='.intval($_POST['tid']),'succeed');		
	}else{
	   insert_new_thread($lan);
	}
}else{if($_G[groupid]!=1&&!in_array($_G[groupid],unserialize($smart['allow_p']))||!$_G[uid]){
	showmessage('&#x5BF9;&#x4E0D;&#x8D77;,&#x4F60;&#x6CA1;&#x6709;&#x6743;&#x9650;&#x6267;&#x884C;&#x6B64;&#x64CD;&#x4F5C;!',dreferer());
	}
        $type=trim($_GET['type']);	
		$tid=intval($_GET['tid']);
		$post=array();
		if($tid){
		$post=C::t("#smart_video#video")->fetch_first("smart_video_post","tid=$tid and first=1");
		$thread=C::t("#smart_video#video")->fetch_first("smart_video_thread","tid=$tid");
		if($_G[groupid]!=1&&intval($thread['authorid'])!=$_G['uid']){
			showmessage('&#x5BF9;&#x4E0D;&#x8D77;,&#x4F60;&#x6CA1;&#x6709;&#x6743;&#x9650;&#x6267;&#x884C;&#x6B64;&#x64CD;&#x4F5C;!',dreferer());
			}
		if($thread[scid])$sclass= C::t("#smart_video#video")->fetch_all("type=2 and cup=".intval($thread[fcid]));
		if($thread[tcid])$tclass= C::t("#smart_video#video")->fetch_all("type=2 and cup=".intval($thread[scid]));
		$mes=stripslashes($post['message']);
        $audio=unserialize(stripslashes($post['audio']));
		}		
		$fclass= C::t("#smart_video#video")->fetch_all("type=1");		
		include template('smart_video:p');
	}