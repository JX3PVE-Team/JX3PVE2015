<?php
/**
 * Plugin For Discuz! X2.5-X3.0
 
 * Copyright (c) 2006 - 2016 Zhanzhangzu.com.

 * ����:      ȫ��ӥ
 
 * ����:      641500953@qq.com
 
 * ��վ:      www.zhanzhangzu.com
  
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