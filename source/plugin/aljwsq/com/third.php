<?php
/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}


include_once 'source/plugin/aljwsq/function_core.php';
$curkeyword = DB::fetch_first('select * from %t where mykeyword = %s and msgtype = %s order by displayorder desc',array('aljwsq_autoreply',$contentStr,'third'));
$keywords = DB::fetch_all("select * from %t where mykeyword = '' and msgtype = %s order by displayorder desc",array('aljwsq_autoreply','third'));
if($curkeyword){
	$timestamp = TIMESTAMP;
	$nonce = random(5);
	$token = $curkeyword['description'];
	$tmpArr = array($token, $timestamp, $nonce);
	sort($tmpArr, SORT_STRING);
	$tmpStr = implode($tmpArr);
	$tmpStr = sha1($tmpStr);
	
	if(strpos($curkeyword['url'],'?') === false){
		$curkeyword['url'] = $curkeyword['url'].'?';
	}
	
	$return = https_request($curkeyword['url']."&token={$curkeyword['description']}&signature={$tmpStr}&timestamp={$timestamp}&nonce={$nonce}",$postStr);
}else{
	foreach($keywords as $keyword){
		
		$timestamp = TIMESTAMP;
		$nonce = random(5);
		$token = $keyword['description'];
		$tmpArr = array($token, $timestamp, $nonce);
		
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if(strpos($keyword['url'],'?') === false){
			$keyword['url'] = $keyword['url'].'?';
		}
		
		//logResult($keyword['url']."&token={$keyword['description']}&signature={$tmpStr}&timestamp={$timestamp}&nonce={$nonce}"."\r");
		
		$return = https_request($keyword['url']."&token={$keyword['description']}&signature={$tmpStr}&timestamp={$timestamp}&nonce={$nonce}",$this -> u2g($postStr));
		//logResult($return);
		//logResult($postStr);
		if($return){
			break;
		}
		
	}
}

?>