<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//define('LONGSUN_PATH',DISCUZ_ROOT.'source/plugin/longsun_collect/');
//define('LIB_PATH', LONGSUN_PATH.'libraries/');

define('BASE_PATH', 'source/plugin/longsun_collect/');
define('JS_PATH',BASE_PATH.'libraries/javascripts/');
define('CSS_PATH',BASE_PATH.'template/images/');


class plugin_longsun_collect {
	var $isfid = false;
	var $isgroupid = false;
	var $isposition = false;
	var $positionkey = 0;
	var $portalstatus = 0;
	function plugin_longsun_collect() {
		global $_G;	
		$configs = $_G['cache']['plugin']['longsun_collect'];		
		$usefids = (array)unserialize($configs['usefids']);
		$usergroups = (array)unserialize($configs['usergroups']);
		$usepositions = (array)unserialize($configs['usepositions']);
		if(empty($usefids[0]) || in_array($_GET['fid'], $usefids)){
			$this->isfid = true;
		}			
		if(empty($usergroups[0]) || in_array($_G['groupid'], $usergroups)){
			$this->isgroupid = true;
		}		
		if(!empty($_GET['infloat'])){
			$positionkey = 3;
		}elseif($_GET['mod'] == 'forumdisplay'){
			$positionkey = 2;
		}elseif($_GET['mod'] == 'portalcp'){
			$positionkey = 4;
		}else{
			$positionkey = 1;
		}
		$this->positionkey = $positionkey;
		if(empty($usepositions[0]) || in_array($positionkey, $usepositions)){
			$this->isposition = true;
		}
		$this->portalstatus = $_G['setting']['portalstatus'];
	}
}

class plugin_longsun_collect_forum extends plugin_longsun_collect {
	function post_top_output() {		
		global $_G;
		if(!$_GET['special'] && $_GET['action']=='newthread' && $this->isfid && $this->isgroupid && $this->isposition) {
			$positionkey = $this->positionkey;
			include template('longsun_collect:index');
		}		
		return trim($return);
	}	
	function forumdisplay_fastpost_content_output() {
		global $_G;		
		if(!$_GET['special'] && $this->isfid && $this->isgroupid && $this->isposition) {
			$positionkey = $this->positionkey;
			include template('longsun_collect:index');
		}		
		return trim($return);
	}	
	function post_infloat_top_output() {
		global $_G;
		if($_GET['action'] != 'newthread') return '';		
		if(!$_GET['special'] && $this->isfid && $this->isgroupid && $this->isposition) {
			$positionkey = $this->positionkey;
			include template('longsun_collect:index');
		}		
		return trim($return);
	}		
}

class plugin_longsun_collect_portal extends plugin_longsun_collect {
	function portalcp_top_output() {
		global $_G;
		if($this->portalstatus && $this->isgroupid && $this->isposition) {
			$positionkey = $this->positionkey;
			include template('longsun_collect:index');			
		}
		return trim($return);
	}
}
?>