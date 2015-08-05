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
function smart_collect($url){
	if(preg_match('/56\.com/',$url)){//56
	  require_once libfile("function/56","plugin/smart_video");
		if(preg_match('/album\-aid\-([0-9]{1,20})/',$url,$match)){
		   $post=get_album_by_aid($match[1]);
		   $_POST['subject']=diconv($post['title'],"utf-8");
		   $_POST['videoname']=$post['videoname'];
		   $_POST['videolink']=$post['videolink'];
		   $_POST['videoimg']=$post['videoimg'];
		   $_POST['videotime']=$post['videotime'];
		   $_POST['coverimg']=$post['cover'];
		   $_POST['editorValue']=diconv($post['info'],"utf-8");
		   }elseif(preg_match('/v_([0-9a-zA-Z]{6,20}|[0-9]{1,20})/',$url,$match)){
			 $post=get_video_by_vid($match[1]);
			 $_POST['videoname']=$_POST['subject']=diconv($post['title'],"utf-8");
			 $_POST['coverimg']=$post['bimg'];
			 $_POST['videolink']=$post['swf'];
			 $_POST['videoimg']=$post['bimg'];
			 $_POST['videotime']=time();
			 $_POST['editorValue']=diconv($post['desc'],"utf-8");
		   }	
	}elseif(preg_match('/youku\.com/',$url)){//youku
	 if(!fopen(libfile("function/youku","plugin/smart_video"),'r'))showmessage('&#23545;&#19981;&#36215;&#44;&#27492;&#32593;&#31449;&#23578;&#26410;&#36141;&#20080;&#20248;&#37239;&#37319;&#38598;&#27169;&#22359;&#65281;');
		 require_once libfile("function/youku","plugin/smart_video");
		 if(preg_match('/v_show\/id_([0-9a-zA-Z]{6,20})/',$url,$match)){//video
			$post=get_youkuvideo_by_vid($match[1]);
				$_POST['videoname']=$_POST['subject']=diconv($post['title'],"utf-8");
				$_POST['coverimg']=$post['bigThumbnail'];
				$_POST['videolink']=$post['player'];
				$_POST['videoimg']=$post['bigThumbnail'];
				$_POST['videotime']=time();
				$_POST['editorValue']=diconv($post['description'],"utf-8");
			 }elseif(preg_match('/playlist_show\/id_([0-9a-zA-Z]{6,20})/',$url,$match)){
				 $post=get_playlist_byid($match[1]);
					$_POST['subject']=$post['videoname'][0];
					$_POST['videoname']=$post['videoname'];
					$_POST['videolink']=$post['videolink'];
					$_POST['videoimg']=$post['videoimg'];
					$_POST['videotime']=$post['videotime'];
					$_POST['coverimg']=$post['videoimg'][0];
				 }
		 
	}elseif(preg_match('/tudou\.com/',$url)){
	if(!fopen(libfile("function/tudou","plugin/smart_video"),'r'))showmessage('&#23545;&#19981;&#36215;&#44;&#27492;&#32593;&#31449;&#23578;&#26410;&#36141;&#20080;&#22303;&#35910;&#37319;&#38598;&#27169;&#22359;&#65281;');
	  require_once libfile("function/tudou","plugin/smart_video");
		 if(preg_match('/view\/([0-9a-zA-Z\-_]{6,20})/',$url,$match)){//video//http://www.tudou.com/programs/view/vxwNHdeN79o/
			$post=get_tudouv_by_id($match[1]);
				$_POST['videoname']=$_POST['subject']=diconv($post['title'],"utf-8");
				$_POST['coverimg']=$post['bigPicUrl'];
				$_POST['videolink']=$post['outerPlayerUrl'];
				$_POST['videoimg']=$post['bigPicUrl'];
				$_POST['videotime']=time();
				$_POST['editorValue']=diconv($post['description'],"utf-8");
			 }elseif(preg_match('/listplay\/([0-9a-zA-Z\-_]{6,20})/',$url,$match)){//http://www.tudou.com/listplay/31kTSBmnsKk/JUFDsHRypSo.html
				 $post=get_tplaylist_byid($match[1]);
					$_POST['subject']=$post['videoname'][0];
					$_POST['videoname']=$post['videoname'];
					$_POST['videolink']=$post['videolink'];
					$_POST['videoimg']=$post['videoimg'];
					$_POST['videotime']=$post['videotime'];
					$_POST['coverimg']=$post['videoimg'][0];
				 }
	}
if(empty($_POST['subject'])){
	showmessage("&#23545;&#19981;&#36215;&#65292;&#19981;&#25903;&#25345;&#27492;&#85;&#82;&#76;&#35268;&#21017;&#30340;&#37319;&#38598;&#32;&#65281;");
	}	
}
?>