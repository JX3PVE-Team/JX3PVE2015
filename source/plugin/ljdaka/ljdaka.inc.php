<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 
$config = $_G['cache']['plugin']['ljdaka'];
$dizhi = $config['dizhi'];
$qzmes = $config['qzmes'];
$isqz = $config['isqz'];
if($_G['uid']&&$isqz){
	include template('ljdaka:qz');
}
?>