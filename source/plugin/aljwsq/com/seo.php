<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$the_host = $_SERVER ['HTTP_HOST'];
$links = file_get_contents('http://www.seoeye.cn/plugin.php?id=yinqing:superlinks&action=myinfo&siteurl=' . $contentStr); 
$links = json_decode($links, true);
$description = lang('plugin/aljwsq', 'seo1'). $links['kz'] ."\n".lang('plugin/aljwsq', 'seo2'). $links['qz'] ."\n".lang('plugin/aljwsq', 'seo3'). $links['sl'] ."\n".lang('plugin/aljwsq', 'seo4'). $links['pr'] . ";\nalexa:" . $links['alexa'][0];
echo $this->responsetext($postObj, $description);
?>