<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
drop table IF EXISTS `pre_plugin_daka`;
drop table IF EXISTS `pre_plugin_daka_user`;
EOF;
runquery($sql);
$finish = TRUE;
?>