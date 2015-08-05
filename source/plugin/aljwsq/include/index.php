<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
 if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$desks=array(1=>lang('plugin/aljwsq', 'index1'),2=>lang('plugin/aljwsq', 'index2'),3=>lang('plugin/aljwsq', 'index3'));
for($i=1;$i<=25;$i++){
	$pics[$i]='source/plugin/aljwsq/images/index/'.$i.'.png';
}
if(file_exists('source/plugin/aljwsq/com/c.php')){
	include 'source/plugin/aljwsq/com/c.php';
}
?>