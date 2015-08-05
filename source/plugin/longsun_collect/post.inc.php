<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
define('LONGSUN_PATH',DISCUZ_ROOT.'source/plugin/longsun_collect/');
define('WORD_LIB_PATH', LONGSUN_PATH.'data/word_lib.txt');
define('LIB_PATH', LONGSUN_PATH.'libraries/');
define('FUN_PATH', LONGSUN_PATH.'functions/');
require_once(LIB_PATH.'Output.class.php');
require_once(LIB_PATH.'Utility.class.php');
require_once(LIB_PATH.'json.class.php');
require_once(FUN_PATH.'common.php');

//if(!$_G['uid']) {
	//json(checkCharset(lang('plugin/longsun_collect', 'notlogin')), 'alert');
//}

$s_url = $_REQUEST['s_url'];

if(!preg_match('/^http(s)?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/i', $s_url)){
	json(checkCharset(lang('plugin/longsun_collect', 'urlerror')), 'alert');
}

$gather_type = isset($_REQUEST['gather_type'])?intval($_GET['gather_type']):1;
$positionkey = intval($_GET['positionkey']);

$post_data = array(
   's_url' => $s_url,
   'gather_type' => $gather_type,
   'request_type' => 'post',
   'site_url' => $_G['siteurl'],
   's'=>rand(),
);

$configs = $_G['cache']['plugin']['longsun_collect'];

switch($configs['service'])
{
	case 2:
	    $service = 'http://collect2.longsunhd.com/collect/';	    
        break;
	case 3:
	    $service = 'http://collect3.longsunhd.com/collect/';	    
        break;
	case 4:
	    $service = 'http://collect4.longsunhd.com/collect/';	    
        break;	
    default:
	    $service = 'http://collect.longsunhd.com/collect/';
}

$res = Utility::DoPost($service, $post_data);
//$res =curl38($service."index.php?s_url=".urlencode($s_url)."&gather_type=$gather_type&s=",rand(0,1999999),$post_data);
$res = CJSON::decode($res,false);

$subject = $res->subject;
$message = $res->message;
$status = $res->status;

if($status == 'ok'){
	
			
	if($configs['rewriteopen']){
		if(file_exists(WORD_LIB_PATH)){
			$word_lib_str = file_get_contents(WORD_LIB_PATH);	
			$word_lib_str = unserialize($word_lib_str);	
			
			if(is_array($word_lib_str)){
				
				$source_arr = $target_arr = $reptemp = array();
				$key = 0;
				foreach($word_lib_str as $one){
					$left_str = strtolower(CHARSET)!='utf-8'?iconv(CHARSET, 'utf-8',$one['left_str']):$one['left_str'];
					$right_str = strtolower(CHARSET)!='utf-8'?iconv(CHARSET, 'utf-8',$one['right_str']):$one['right_str'];
					if(!in_array($one['mark'], array('=', '->'))) continue;
					
					$source_arr[] = $left_str;
					$target_arr[] = '[reptemp_'.$key.']';
					$reptemp['[reptemp_'.$key.']'] = $right_str;
					$key++;
					
					if($one['mark'] == '='){						
						$source_arr[] = $right_str;
						$target_arr[] = '[reptemp_'.$key.']';
						$reptemp['[reptemp_'.$key.']'] = $left_str;	
						$key++;							
					}
				}
	
				if(!empty($source_arr[0]) && !empty($target_arr[0])){
					$message = str_replace(
						$source_arr,
						$target_arr,
						$message);	
						
					if($reptemp){
						$message = str_replace(array_keys($reptemp),$reptemp,$message);	
					}						
				}
			}	
		}	
	}
	
	$imgCount = 0;
	
	if($configs['remoteopen']){
		if($positionkey == 4){//门户获取远程图片
			require_once libfile('class/image');
			$upload = new discuz_upload();
			$downremotefile = false;
			$aid = intval(getgpc('aid'));
			$catid = intval(getgpc('catid'));			
			$arrayimageurl = $temp = $imagereplace = array();
			$downremotefile = true;
			preg_match_all("/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]|\[img=\d{1,4}[x|\,]\d{1,4}\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/is", $message, $image1, PREG_SET_ORDER);
			preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $message, $image2, PREG_SET_ORDER);
			$temp = $aids = $existentimg = array();
			if(is_array($image1) && !empty($image1)) {
				foreach($image1 as $value) {
					$temp[] = array(
						'0' => $value[0],
						'1' => trim(!empty($value[1]) ? $value[1] : $value[2])
					);
				}
			}
			if(is_array($image2) && !empty($image2)) {
				foreach($image2 as $value) {
					$temp[] = array(
						'0' => $value[0],
						'1' => trim($value[2])
					);
				}
			}

			if(is_array($temp) && !empty($temp)) {
				foreach($temp as $tempvalue) {
					$tempvalue[1] = str_replace('\"', '', $tempvalue[1]);
					if(strlen($tempvalue[1])){
						$arrayimageurl[] = $tempvalue[1];
					}
				}
				$arrayimageurl = array_unique($arrayimageurl);
				if($arrayimageurl) {
					foreach($arrayimageurl as $tempvalue) {
						$imageurl = $tempvalue;
						$imagereplace['oldimageurl'][] = $imageurl;
						$attach['ext'] = $upload->fileext($imageurl);
						if(!$upload->is_image_ext($attach['ext'])) {
							continue;
						}
						$content = '';
						if(preg_match('/^(http:\/\/|\.)/i', $imageurl)) {
							$content = dfsockopen($imageurl);
						} elseif(checkperm('allowdownlocalimg')) {
							if(preg_match('/^data\/(.*?)\.thumb\.jpg$/i', $imageurl)) {
								$content = file_get_contents(substr($imageurl, 0, strrpos($imageurl, '.')-6));
							} elseif(preg_match('/^data\/(.*?)\.(jpg|jpeg|gif|png)$/i', $imageurl)) {
								$content = file_get_contents($imageurl);
							}
						}
						if(empty($content)) continue;
						$temp = explode('/', $imageurl);
		
						$attach['name'] =  trim($temp[count($temp)-1]);
						$attach['thumb'] = '';
		
						$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
						$attach['extension'] = $upload -> get_target_extension($attach['ext']);
						$attach['attachdir'] = $upload -> get_target_dir('portal');
						$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('portal').'.'.$attach['extension'];
						$attach['target'] = getglobal('setting/attachdir').'./portal/'.$attach['attachment'];
		
						if(!@$fp = fopen($attach['target'], 'wb')) {
							continue;
						} else {
							flock($fp, 2);
							fwrite($fp, $content);
							fclose($fp);
						}
						if(!$upload->get_image_info($attach['target'])) {
							@unlink($attach['target']);
							continue;
						}
						$attach['size'] = filesize($attach['target']);
						$attachs[] = daddslashes($attach);
					}
				}
			}		
			if($attachs) {
			
				foreach($attachs as $attach) {
					if($attach['isimage'] && empty($_G['setting']['portalarticleimgthumbclosed'])) {
						require_once libfile('class/image');
						$image = new image();
						$thumbimgwidth = $_G['setting']['portalarticleimgthumbwidth'] ? $_G['setting']['portalarticleimgthumbwidth'] : 300;
						$thumbimgheight = $_G['setting']['portalarticleimgthumbheight'] ? $_G['setting']['portalarticleimgthumbheight'] : 300;
						$attach['thumb'] = $image->Thumb($attach['target'], '', $thumbimgwidth, $thumbimgheight, 2);
						$image->Watermark($attach['target'], '', 'portal');
					}
			
					if(getglobal('setting/ftp/on') && ((!$_G['setting']['ftp']['allowedexts'] && !$_G['setting']['ftp']['disallowedexts']) || ($_G['setting']['ftp']['allowedexts'] && in_array($attach['ext'], $_G['setting']['ftp']['allowedexts'])) || ($_G['setting']['ftp']['disallowedexts'] && !in_array($attach['ext'], $_G['setting']['ftp']['disallowedexts']))) && (!$_G['setting']['ftp']['minsize'] || $attach['size'] >= $_G['setting']['ftp']['minsize'] * 1024)) {
						if(ftpcmd('upload', 'portal/'.$attach['attachment']) && (!$attach['thumb'] || ftpcmd('upload', 'portal/'.getimgthumbname($attach['attachment'])))) {
							@unlink($_G['setting']['attachdir'].'/portal/'.$attach['attachment']);
							@unlink($_G['setting']['attachdir'].'/portal/'.getimgthumbname($attach['attachment']));
							$attach['remote'] = 1;
						} else {
							if(getglobal('setting/ftp/mirror')) {
								@unlink($attach['target']);
								@unlink(getimgthumbname($attach['target']));
								portal_upload_error(lang('portalcp', 'upload_remote_failed'));
							}
						}
					}
			
					$setarr = array(
						'uid' => $_G['uid'],
						'filename' => $attach['name'],
						'attachment' => $attach['attachment'],
						'filesize' => $attach['size'],
						'isimage' => $attach['isimage'],
						'thumb' => $attach['thumb'],
						'remote' => $attach['remote'],
						'filetype' => $attach['extension'],
						'dateline' => $_G['timestamp'],
						'aid' => $aid
					);
					$setarr['attachid'] = C::t('portal_attachment')->insert($setarr, true);
					if($downremotefile) {
						$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl']).'portal/';
						$imagereplace['newimageurl'][] = $attach['url'].$attach['attachment'];
					}
				}
				if($downremotefile && $imagereplace) {
					$message = str_replace($imagereplace['oldimageurl'], $imagereplace['newimageurl'], $message);
				}
			}			
					
		}else{//帖子获取远程图片
			preg_match_all("/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]|\[img=\d{1,4}[x|\,]\d{1,4}\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/is", $message, $image1, PREG_SET_ORDER);
			preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $message, $image2, PREG_SET_ORDER);
			$temp = $aids = $existentimg = array();
			if(is_array($image1) && !empty($image1)) {
				foreach($image1 as $value) {
					$temp[] = array(
						'0' => $value[0],
						'1' => trim(!empty($value[1]) ? $value[1] : $value[2])
					);
				}
			}
			if(is_array($image2) && !empty($image2)) {
				foreach($image2 as $value) {
					$temp[] = array(
						'0' => $value[0],
						'1' => trim($value[2])
					);
				}
			}
			
			require_once libfile('class/image');
			if(is_array($temp) && !empty($temp)) {
				$upload = new discuz_upload();
				$attachaids = array();
			
				foreach($temp as $value) {
					$imageurl = $value[1];
					$hash = md5($imageurl);
					if(strlen($imageurl)) {
						$imagereplace['oldimageurl'][] = $value[0];
						if(!isset($existentimg[$hash])) {
							$existentimg[$hash] = $imageurl;
							$attach['ext'] = $upload->fileext($imageurl);
							if(!$upload->is_image_ext($attach['ext'])) {
								continue;
							}
							$content = '';
							if(preg_match('/^(http:\/\/|\.)/i', $imageurl)) {
								$content = dfsockopen($imageurl);
							} elseif(preg_match('/^('.preg_quote(getglobal('setting/attachurl'), '/').')/i', $imageurl)) {
								$imagereplace['newimageurl'][] = $value[0];
							}
							
							if(empty($content)) continue;
							$patharr = explode('/', $imageurl);
							$attach['name'] =  trim($patharr[count($patharr)-1]);
							$attach['thumb'] = '';
			
							$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
							$attach['extension'] = $upload -> get_target_extension($attach['ext']);
							$attach['attachdir'] = $upload -> get_target_dir('forum');
							$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('forum').'.'.$attach['extension'];
							$attach['target'] = getglobal('setting/attachdir').'./forum/'.$attach['attachment'];
			
							if(!@$fp = fopen($attach['target'], 'wb')) {
								continue;
							} else {
								flock($fp, 2);
								fwrite($fp, $content);
								fclose($fp);
							}
							if(!$upload->get_image_info($attach['target'])) {
								@unlink($attach['target']);
								continue;
							}
							$attach['size'] = filesize($attach['target']);
							$upload->attach = $attach;
							$thumb = $width = 0;
							if($upload->attach['isimage']) {
								if($_G['setting']['thumbsource'] && $_G['setting']['sourcewidth'] && $_G['setting']['sourceheight']) {
									$image = new image();
									$thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['sourcewidth'], $_G['setting']['sourceheight'], 1, 1) ? 1 : 0;
									$width = $image->imginfo['width'];
									$upload->attach['size'] = $image->imginfo['size'];
								}
								if($_G['setting']['thumbstatus']) {
									$image = new image();
									$thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['thumbwidth'], $_G['setting']['thumbheight'], $_G['setting']['thumbstatus'], 0) ? 1 : 0;
									$width = $image->imginfo['width'];
								}
								if($_G['setting']['thumbsource'] || !$_G['setting']['thumbstatus']) {
									list($width) = @getimagesize($upload->attach['target']);
								}
								if($_G['setting']['watermarkstatus'] && empty($_G['forum']['disablewatermark'])) {
									$image = new image();
									$image->Watermark($attach['target'], '', 'forum');
									$upload->attach['size'] = $image->imginfo['size'];
								}
							}
							$aids[] = $aid = getattachnewaid();
							$setarr = array(
								'aid' => $aid,
								'dateline' => $_G['timestamp'],
								'filename' => $upload->attach['name'],
								'filesize' => $upload->attach['size'],
								'attachment' => $upload->attach['attachment'],
								'isimage' => $upload->attach['isimage'],
								'uid' => $_G['uid'],
								'thumb' => $thumb,
								'remote' => '0',
								'width' => $width
							);
							C::t("forum_attachment_unused")->insert($setarr);
							$attachaids[$hash] = $imagereplace['newimageurl'][] = '[attachimg]'.$aid.'[/attachimg]';
			
						} else {
							$imagereplace['newimageurl'][] = $attachaids[$hash];
						}
					}
				}
				if(!empty($aids)) {
					require_once libfile('function/post');
				}	
				$message = str_replace($imagereplace['oldimageurl'], $imagereplace['newimageurl'], $message);
			}				
		}

	}
	
	$from = trim($res->from);	
	if($configs['showFrom'] && $positionkey != 4){		
		if($from){
			$message .= '[p=30, 2, left]'.checkCharset(lang('plugin/longsun_collect', 'from')).$from.'[/p]';	
		}
	}
	$imgCount = count($imagereplace['newimageurl']);
	
	$data = array(
		'subject' => $subject,
		'imgCount' => $imgCount,
		'message' => $message,
	);
	if($configs['showFrom'] && $positionkey == 4){	
	    $data['from'] = $from;
	}
	json($data, 'sucsses'); 	
}else{
    json(checkCharset(lang('plugin/longsun_collect', 'fail')), 'fail'); 	
}
?>