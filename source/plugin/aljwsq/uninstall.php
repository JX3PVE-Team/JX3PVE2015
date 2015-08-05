<?php
/*
	Install Uninstall Upgrade AutoStat System Code
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//start to put your own code 
$sql = <<<EOF
DROP TABLE IF  EXISTS `pre_aljwsq_autoreply`;
DROP TABLE IF  EXISTS `pre_aljwsq_autoreply_advanced`;
DROP TABLE IF  EXISTS `pre_aljwsq_advanced_column`;
DROP TABLE IF  EXISTS `pre_aljwsq_advanced_columndata`;
DROP TABLE IF  EXISTS `pre_aljwsq_menu`;
DROP TABLE IF  EXISTS `pre_aljwsq_user`;
DROP TABLE IF  EXISTS `pre_aljwsq_ggk_log`;
DROP TABLE IF  EXISTS `pre_aljwsq_ggk_user`;
DROP TABLE IF  EXISTS `pre_aljwsq_citylist`;
DROP TABLE IF  EXISTS `pre_aljwsq_index`;
DROP TABLE IF  EXISTS `pre_aljwsq_c`;
DROP TABLE IF  EXISTS `pre_aljwsq_mes`;
DROP TABLE IF  EXISTS `pre_aljwsq_voice`;
DROP TABLE IF  EXISTS `pre_aljwsq_qrcode`;
DROP TABLE IF  EXISTS `pre_aljwsq_wxqrcode`;
DROP TABLE IF  EXISTS `pre_aljwsq_wxqrcode_record`;
DROP TABLE IF  EXISTS `pre_aljwsq_keywordlog`;
EOF;
runquery($sql);
if(file_exists( DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php')){
	require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
	WeChatHook::delAPIHook('aljwsq');
}
//finish to put your own code
$finish = TRUE;
?>