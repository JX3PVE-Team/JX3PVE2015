<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Deined');
}

if(submitcheck('formhash')){
	$form = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
	$insertid = C::t('#aljwsq#aljwsq_advanced_columndata')->insert(array(
		'openid' => $_GET['openid'],
		'fid' => $_GET['fid'],
		'value' => serialize($_GET),
		'dateline' => TIMESTAMP,
	),true);
	
	if($insertid){
		if(empty($form['tips'])){
			$form['tips'] = '&#25552;&#20132;&#25104;&#21151;&#65292;&#35874;&#35874;&#21442;&#19982;&#65281;';
		}else{
			$form['tips'] = g2u($form['tips']);
		}
		echo json_encode(array('status'=>'1','info'=>$form['tips'],'url'=>$form['gotourl']));
	}else{
		echo json_encode(array('status'=>'1','info'=>'&#25552;&#20132;&#22833;&#36133;&#65292;&#35831;&#32852;&#31995;&#31649;&#29702;&#21592;&#65281;','url'=>$form['gotourl']));
	}
	exit;
}else{
	$form = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
	$formcolumns = C::t('#aljwsq#aljwsq_advanced_column')->fetch_all_by_fid($_GET['fid']);
	foreach($formcolumns as $fk=>$fv){
		if($fv['columntype']=='radio' || $fv['columntype']=='select' || $fv['columntype']=='checkbox'){
			$columnparam = str_replace("\r", "", $fv['columnmparam']);
			$columnparam = explode("\n", $columnparam);
			foreach($columnparam as $pk => $param){
				$paramlist = explode('|', $param);
				$arr[$pk]['key'] = $paramlist[0];
				$arr[$pk]['value'] = $paramlist[1];
				
			}
			$formcolumns[$fk]['columnmparam'] = $arr;
			unset($arr);
		}
	}
	
	include template('aljwsq:advanced/showform');
}
function g2u($a) {
   return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
}

function u2g($a) {
  return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
}
?>