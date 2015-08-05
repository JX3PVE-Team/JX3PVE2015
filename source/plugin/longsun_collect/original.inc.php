<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
define('LONGSUN_PATH',DISCUZ_ROOT.'source/plugin/longsun_collect/');
define('FUN_PATH', LONGSUN_PATH.'functions/');
define('DATA_PATH', LONGSUN_PATH.'data/');
define('WORD_LIB_PATH', DATA_PATH.'word_lib.txt');

require_once(FUN_PATH.'common.php');

if($_POST){
	RecursiveMkdir(DATA_PATH);
    $word_lib = trim($_POST['word_lib']);
	$word_lib = preg_split('/[\s,]+/', $word_lib, -1, PREG_SPLIT_NO_EMPTY);
	$lib_array = array();
	foreach($word_lib as $k=>$one){
	    preg_match_all('/(.*)(=|->)(.*)/', $one, $match);
		$lib_array[$k]['left_str'] = trim($match[1][0]);
		$lib_array[$k]['mark'] = trim($match[2][0]);
		$lib_array[$k]['right_str'] = trim($match[3][0]);
	}
	
	$save_lib = serialize($lib_array);
		
	$handle = fopen(WORD_LIB_PATH, 'w+');
	fwrite($handle,$save_lib);	
	fclose($handle);
	cpmsg(lang('plugin/longsun_collect', 'adv_success'));
}

$word_lib_str = file_get_contents(WORD_LIB_PATH);

$word_lib_str = unserialize($word_lib_str);

include template('longsun_collect:advance');
?>