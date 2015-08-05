<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
foreach ($threads as $thread) {
    $ids .= ',' . $thread['tid'];
}

$searchid = C::t('common_searchindex')->insert(array(
    'srchmod' => 2,
    'keywords' => $contentStr,
    'searchstring' => 'forum|title|' . base64_encode($contentStr) . '|0||\'2\'|0|0|all|||0',
    'useip' => $_G['clientip'],
    'uid' => $_G['uid'],
    'dateline' => $_G['timestamp'],
    'expiration' => $expiration,
    'num' => count($threads),
    'ids' => $ids
        ), true);

$i = 0;
foreach ($threads as $thread) {
    if ($i > 5) {
        break;
    }
    $tmp = $this->getnews($thread['tid'], $news);
    if (empty($i)) {
        if (empty($tmp['picurl'])) {
            $tmp['picurl'] = $config['default'];
        }
    }
    $items[] = $tmp;
    $i++;
}
$items[] = array('title' => lang('plugin/aljwsq', 'so1'), 'url' => $_G[siteurl] . 'search.php?mod=forum&searchid=' . $searchid . '&orderby=lastpost&ascdesc=desc&searchsubmit=yes&kw=' . urlencode($contentStr) . '&mobile=2' . "&openid=" . $postObj->FromUserName);
if($items){
	echo $this->reponsemultinews($postObj, $items);
}

?>