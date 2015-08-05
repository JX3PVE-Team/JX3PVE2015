<?php
/**
 *	[êÇ³Æ(ltnc.uninstall)] (C)2012-2099 Powered by È«ÇòÓ¥.
 *	Version: 2.5
 *	Date: 2012-9-1 01:42
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

DB::query("ALTER TABLE ".DB::table('common_member')." DROP `addname`");
$finish = true;

?>