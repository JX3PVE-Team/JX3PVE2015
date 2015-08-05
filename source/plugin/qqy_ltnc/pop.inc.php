<?php
/**
 * Plugin For Discuz! X2.5-X3.0
 
 * Copyright (c) 2006 - 2016 Zhanzhangzu.com.

 * зїеп:      ШЋЧђгЅ
 
 * гЪЯф:      641500953@qq.com
 
 * ЭјеО:      www.zhanzhangzu.com
  
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$hidepop = $_POST['hidepop'];
if($hidepop==1){
	dsetcookie('ltncpop',1);
}else{
	include template('qqy_ltnc:pop');
}