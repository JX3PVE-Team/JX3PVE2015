<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
$config = $_G['cache']['plugin']['aljwsq'];
$threads = C::t('forum_thread')->fetch_all_by_tid(explode(',',$news['description']));
if ($news['description']) {
	$brands = DB::fetch_all('select * from %t where id in (%i)',array('aljbd',$news['description']));
} else {
	$brands = DB::fetch_all('select * from %t order by id desc limit %d',array('aljbd',$news['forumnum']));
}

$i = 0;
foreach ($brands as $brand) {
    $tmp = $this->getbrands($brand['id'], $news);
    if (empty($i)) {
        if (empty($tmp['picurl'])) {
            $tmp['picurl'] = $config['default'];
        }
    }
    $items[] = $tmp;
    $i++;
}
echo $this->reponsemultinews($postObj, $items);
?>