<?php
!defined('IN_DISCUZ') && exit('Access Denied');
!defined('IN_ADMINCP') && exit('Access Denied');

$setting = $_G['cache']['plugin']['k_gaiming'];

if(!submitcheck('submit')) {
	$count = $start = 0;
	
	$perpage = 20;
	$page = max(1, intval($_GET['page']));
	$start = ($page - 1) * $perpage;
	$count = DB::result_first("SELECT count(*) FROM ".DB::table("plugin_k_gaiming_log"));
		
	$query = DB::query("SELECT * FROM ".DB::table("plugin_k_gaiming_log")." ORDER BY dateline DESC LIMIT ".$start.",".$perpage);
	$logs = '';
	while($log = DB::fetch($query)) {
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$log['username'] = getuserbyuid($log['uid']);
		$logs.= showtablerow('', array('class="td25"', 'class="td29"', 'class="td28"', 'class="td29"'), array(
			"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"".$log['lid']."\">",
			"<a href=\"home.php?mod=space&uid=".$log['uid']."\" target=\"_blank\">".$log['username']['username']."</a>&nbsp;(UID:&nbsp;".$log['uid'].")",
			"<font color=\"#2366A8\">".$log['username']['username']."</font>&nbsp;".lang('plugin/k_gaiming', 'logcp_1')."&nbsp;<font color=\"#2366A8\">".$log['dateline']."</font>&nbsp;".lang('plugin/k_gaiming', 'logcp_2')."&nbsp;<font color=\"#2366A8\">".$log['oldname']."</font>&nbsp;".lang('plugin/k_gaiming', 'logcp_3')."&nbsp;<font color=\"#2366A8\">".$log['newname']."</font>",
			$log['creditnum']."&nbsp;".$_G['setting']['extcredits'][$log['creditunit']]['unit'].$_G['setting']['extcredits'][$log['creditunit']]['title'],
			$log['dateline']
		), TRUE);
	}
	$multi = multi($count, $perpage, $page, ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=k_gaiming&pmod=logcp");
	showformheader("plugins&operation=config&identifier=k_gaiming&pmod=logcp&page=".$page, "enctype");
	showtableheader('');
	showsubtitle(array('', lang('plugin/k_gaiming', 'logcp_6'), lang('plugin/k_gaiming', 'logcp_5'), lang('plugin/k_gaiming', 'logcp_4'), lang('plugin/k_gaiming', 'logcp_7')));
	echo $logs;
	showsubmit('submit', lang('plugin/k_gaiming', 'submit'), 'del', '', $multi);
	showtablefooter();
	showformfooter();
}else{
	
	if(is_array($_GET['delete'])) {
		$ids = dimplode($_GET['delete']);
		DB::query("DELETE FROM ".DB::table('plugin_k_gaiming_log')." WHERE lid IN ($ids)");
	}
	cpmsg(lang('plugin/k_gaiming', 'success'), 'action=plugins&operation=config&identifier=k_gaiming&pmod=logcp&page='.$page, 'succeed');
}
?>