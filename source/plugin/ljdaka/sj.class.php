<?php
	if(!defined('IN_DISCUZ')) {
	exit('Access Deined');
}
class mobileplugin_ljdaka {
	var $uid;
	var	$config;
	var	$weizhi;
	var	$xianshi;
	var	$sql;
	var	$check;
	function __construct(){
		global $_G;
		$this->uid=$_G['uid'];
		$this->config = $_G['cache']['plugin']['ljdaka'];
		$this->weizhi=$this->config['sjweizhi'];
		$this->xianshi=$this->config['xianshi'];
		$this->sql="select count(*) from ".DB::table('plugin_daka')." where uid=".$this->uid." and curdate()=FROM_UNIXTIME(timestamp,'%Y-%m-%d')";
		$this->check=DB::result_first($this->sql);
	}
	function global_header_mobile() {
		global $_G;
		$config = $_G ['cache'] ['plugin'] ['ljdaka'];
		if(!$config['issjan']){
			return;
		}
		if($this->weizhi==1&&$this->uid){
			if(!$this->check||!empty($this->xianshi)){
				include template('ljdaka:daka');
			}
			
		}
		return $return;
	}
	function global_footer_mobile() {
		global $_G;
		$config = $_G ['cache'] ['plugin'] ['ljdaka'];
		if(!$config['issjan']){
			return;
		}
		if($this->weizhi==2&&$this->uid){
			if(!$this->check||!empty($this->xianshi)){
				include template('ljdaka:daka');
			}
		}
		return $return;
	}
	function index_top_mobile() {
		global $_G;
		$config = $_G ['cache'] ['plugin'] ['ljdaka'];
		
		if(!$config['issjan']){
			return;
		}
		if($_GET['mobile']=='1'){
			$xian='<span class="pipe">|</span>';
		}else{
			$xian='&nbsp;&nbsp;&nbsp;';
		}
		if ($this->weizhi == 3 && $this->uid) {
            if (!$this->check || !empty($this->xianshi)) {
                include template('ljdaka:daka');
            }
        }
		return $xian.$return;
	}
}
class mobileplugin_ljdaka_forum extends mobileplugin_ljdaka {
}
?>