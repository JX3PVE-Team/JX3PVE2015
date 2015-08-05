<?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
   $la=lang("plugin/smart_video");
   if(submitcheck('submit')){
		  $order=$_POST['order'];
		  $name=$_POST['name'];
		  $neworder=$_POST['newcatorder'];
		  $newname=$_POST['newcat'];
		  $newsuborder=$_POST['newsuborder'];
		  $newsubcat=$_POST['newsubcat'];
		  $newtirorder=$_POST['newtirorder'];
		  $newtircat=$_POST['newtircat'];
			foreach($neworder as$k=>$v){//first
			if(empty($newname[$k]))$newname[$k]=$la['no_name'];
				C::t("#smart_video#video")->insert_new("smart_video",array('cup'=>0,'type'=>1,'name'=>daddslashes($newname[$k]),'displayorder'=>$v));
				}	 
			foreach($newsuborder as$k=>$v){//second
				 foreach($v as$kin=>$vin){
					 if(empty($newsubcat[$k][$kin]))$newsubcat[$k][$kin]=$la['no_name'];
					 C::t("#smart_video#video")->insert_new("smart_video",array('cup'=>$k,'type'=>2,'name'=>daddslashes($newsubcat[$k][$kin]),'displayorder'=>$vin));
				}
			 
			 }
			foreach($newtirorder as$k=>$v){//third
					 foreach($v as$kin=>$vin){
						  if(empty($newtircat[$k][$kin]))$newtircat[$k][$kin]=$la['no_name'];
						 C::t("#smart_video#video")->insert_new("smart_video",array('cup'=>$k,'type'=>3,'name'=>daddslashes($newtircat[$k][$kin]),'displayorder'=>$vin));
					}	 
			}
			foreach($order as$k=>$v){
				if(empty($name[$k]))$name[$k]=$la['no_name'];
				C::t("#smart_video#video")->update_by_where("smart_video",array('name'=>daddslashes($name[$k]),'displayorder'=>intval($v)),"cid=$k");
				}
		
		cpmsg($la['success'],'action=plugins&identifier=smart_video&pmod=class','succeed');			 
	}elseif($_GET['dele']&&FORMHASH == $_GET['formhash']){
		$cid=intval($_GET['cid']);$type=intval($_GET['type']);
		if($type<3){
			$is_sub=C::t("#smart_video#video")->result_first("count(cid)","smart_video","cup=$cid");
			if($is_sub)
			cpmsg($la['s6'],'action=plugins&identifier=smart_video&pmod=class','error');
			}
		C::t("#smart_video#video")->delete_by_where("cid=$cid");

	 	cpmsg($la['s5'],'action=plugins&identifier=smart_video&pmod=class','succeed');
	}else{
		 $fclass= C::t("#smart_video#video")->fetch_all("type=1");
		 $sclass= C::t("#smart_video#video")->fetch_all("type=2");
		 $tclass= C::t("#smart_video#video")->fetch_all("type=3");
		showformheader('plugins&operation=config&do='.$_GET['do'].'&identifier=smart_video&pmod=class');
		showtableheader('');
		showsubtitle(array('',lang('plugin/smart_video','s1'),'',lang('plugin/smart_video','s2'),'','',lang('plugin/smart_video','s3')));
		include template("smart_video:class");
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}

?>