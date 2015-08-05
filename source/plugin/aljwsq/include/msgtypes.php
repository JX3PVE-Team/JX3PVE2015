<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */

 $msgtypes1 = array(
	'subscribe' => lang('plugin/aljwsq', 'autoreply12'),
    'text' => lang('plugin/aljwsq', 'autoreply1'),
    'url' => lang('plugin/aljwsq', 'autoreply2'),
	'music' => lang('plugin/aljwsq', 'autoreply22'),
    'singlenews' => lang('plugin/aljwsq', 'autoreply3'),
    'multinews' => lang('plugin/aljwsq', 'autoreply4'),
);
$msgtypes2 = array(
    'forum' => lang('plugin/aljwsq', 'autoreply6'),
    'forumlist' => lang('plugin/aljwsq', 'autoreply7'),
);
$msgtypes3 = array(
	'comb' => '&#33258;&#30001;&#32452;&#21512;',
	'post' => lang('plugin/aljwsq', 'autoreply11'),
    'thread' => lang('plugin/aljwsq', 'autoreply5'),
    'newthread' => lang('plugin/aljwsq', 'autoreply8'),
    'hotthread' => lang('plugin/aljwsq', 'autoreply9'),
    'digesthread' => lang('plugin/aljwsq', 'autoreply10'),
);
$msgtypes9 = array(
    'newarticle' => '&#26368;&#26032;&#25991;&#31456;',
);
$msgtypes4 = array(
	'register' => '&#33258;&#21160;&#27880;&#20876;',
    'invite' => lang('plugin/aljwsq', 'com46'),
    'sign' => lang('plugin/aljwsq', 'com47'),
	'bind' => lang('plugin/aljwsq', 'autoreply13'),
	'unbind' => lang('plugin/aljwsq', 'autoreply23'),
);
$msgtypes5= array(
	'bindkeyword' => lang('plugin/aljwsq', 'autoreply14'),
	'orderlist' => lang('plugin/aljwsq', 'autoreply21'),
    'weather' => '&#22825;&#27668;&#39044;&#25253;',
);
$msgtypes6= array(
	'wsq' => '&#24494;&#31038;&#21306;',
	'index' => '&#24494;&#39318;&#39029;',
	'ggk' => '&#21038;&#21038;&#21345;',
	'mes' => '&#30041;&#35328;&#26495;',
	'form' => '&#19975;&#33021;&#34920;&#21333;',
    
);
$msgtypes7 = array(
	'third' => '&#34701;&#21512;&#31532;&#19977;&#26041;',
    'voice' => '&#35821;&#38899;&#36716;&#20851;&#38190;&#35789;',
    'location' => '&#27599;&#27425;&#36827;&#20837;&#20844;&#20247;&#21495;&#22238;&#22797;&#20851;&#38190;&#35789;',
);
$msgtypes8 = array(
    'aljbd' => '&#26368;&#26032;&#21830;&#23478;',
	'brandindex' => '&#21830;&#23478;&#39318;&#39029;',
);
$msgtypes=array_merge($msgtypes1,$msgtypes2,$msgtypes3,$msgtypes4,$msgtypes5,$msgtypes6,$msgtypes7,$msgtypes8,$msgtypes9);
?>