<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$config = $_G['cache']['plugin']['aljwsq'];
if($_GET['act']=='post'){
	if(file_exists('source/plugin/aljwsq/com/mes.php')){
		include 'source/plugin/aljwsq/com/mes.php';
	}
}else{
	if(file_exists('source/plugin/aljwsq/com/mes.php')){
		$meslist=C::t('#aljwsq#aljwsq_mes')->fetch_all_by_upid();
		include template('aljwsq:mes');
	}
	
}

function g2u($a) {
	return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
   return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}
?>