<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$url = 'http://collect.longsunhd.com/actives/?charset='.CHARSET;
$content = dfsockopen($url);
echo $content;
?>