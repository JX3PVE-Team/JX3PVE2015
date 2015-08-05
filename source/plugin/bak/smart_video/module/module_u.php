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
session_start();
if(submitcheck('usubmit',1)){
	if($_FILES['file']['size']){
		       $mark=trim($_GET['mark']);
				$ext=smart_get_ext($_FILES['file']['name']);
				$filename=time().rand(1, 10000).".$ext";
				$dir=check_uploaddir();
				$object=$dir.$filename;		
				move_uploaded_file($_FILES['file']['tmp_name'],DISCUZ_ROOT.$object);		
				echo $object;
				}					
}else{
	if($_GET['type']=='video')$type='mp4';
	elseif($_GET['type']=='audio')$type='mp3';
	elseif($_GET['type']=='swf')$type='swf';
	else{$type="png";}
	$ext=$type;
	$upurl='';
	$filename=time().rand(1, 10000).".$ext";
	if($smart['oss']){
	$upurl='http://up.qiniu.com/';
	$token=init_qn()->get_purl();	
	$y=date("Y");$m=date("m");$d=date("d");
	$object="$y/$m/$d/$filename";
	$robject="qn:".$object;
		}else{
	$upurl='plugin.php?id=smart_video&mod=u';
	}
	$max_size=ini_get('post_max_size')."B";
	include template("smart_video:up");
}