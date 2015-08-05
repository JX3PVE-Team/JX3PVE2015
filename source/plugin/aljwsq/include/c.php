<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
$desks=C::t('#aljwsq#aljwsq_c')->fetch_all_by_upid(0);
for($i=1;$i<=25;$i++){
	$pics[$i]='source/plugin/aljwsq/images/index/'.$i.'.png';
}

?>