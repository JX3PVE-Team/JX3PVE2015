<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$config = array();
foreach($pluginvars as $key => $val) {
	$config[$key] = $val['value'];	
}
include 'source/plugin/aljwsq/com/com.php';
include 'source/plugin/aljwsq/include/msgtypes.php';
$columntypes = array(
	'string' => '&#21333;&#34892;&#36755;&#20837;',
	'textarea' => '&#22810;&#34892;&#36755;&#20837;',
	'radio' => '&#21333;&#36873;',
	'checkbox' => '&#22810;&#36873;',
	'select' => '&#19979;&#25289;&#36873;&#25321;',
	'datetime' => '&#26102;&#38388;',
);
if($_GET['act']=='addform'){
	if (submitcheck('formhash')) {
        $keyword=C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch_by_mykeyword($_GET['keyword']);
        if ($keyword && $_GET['keyword']) {
            cpmsg(lang('plugin/aljwsq', 'autoreply15'));
        }
        $pic = 'picurl';
        if ($_FILES[$pic]['tmp_name']) {
            $picname = $_FILES[$pic]['name'];
            $picsize = $_FILES[$pic]['size'];

            if ($picname != "") {
                $type = strstr($picname, '.');
                if ($type != ".gif" && $type != ".jpg" && $type != ".png") {
                    showerror(lang('plugin/aljwsq', 'autoreply16'));
                }
                $rand = rand(100, 999);
                $pics = date("YmdHis") . $rand . $type;
                $img_dir = 'source/plugin/aljwsq/images/advanced/';
                if (!is_dir($img_dir)) {
                    mkdir($img_dir);
                }
                $$pic = $img_dir . $pics;
                if (@copy($_FILES[$pic]['tmp_name'], $$pic) || @move_uploaded_file($_FILES[$pic]['tmp_name'], $$pic)) {
                    $imageinfo = getimagesize($$pic);
                    $w360 = $imageinfo[0] < 360 ? $imageinfo[0] : 360;
                    $h200 = $imageinfo[1] < 200 ? $imageinfo[1] : 200;
                    $w200 = $imageinfo[0] < 640 ? $imageinfo[0] : 200;
                    img2thumb($$pic, $$pic . '.360x200.jpg', $w360, $h200);
                    img2thumb($$pic, $$pic . '.200x200.jpg', $w200, $h200);
                    @unlink($_FILES[$pic]['tmp_name']);
                }
            }
        }
        C::t('#aljwsq#aljwsq_autoreply_advanced')->insert(array(
            'upid' => $_GET['upid'],
            'msgtype' => 'form',
            'mykeyword' => $_GET['keyword'],
            'bindkeyword' => $_GET['bindkeyword'],
            'title' => $_GET['title'],
            'picurl' => $$pic,
            'gotourl' => $_GET['gotourl'],
			'tips' => $_GET['tips'],
            'description' => $_GET['description'],
            'tid' => $_GET['tid'],
            'threadnum' => $_GET['threadnum'],
            'forumnum' => $_GET['forumnum'],
            'addline' => TIMESTAMP,
            'updatetime' => TIMESTAMP,
            'status' => 1,
            'displayorder' => $_GET['displayorder']
        ));
        cpmsg(lang('plugin/aljwsq', 'autoreply17'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced', 'succeed');
	}else{
		include template('aljwsq:advanced/addform');
	}
}else if($_GET['act']=='editform'){
	if ($_GET['fid']) {
        $reply = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
    }
    if (submitcheck('formhash')) {
        $pic = 'picurl';
        if ($_FILES[$pic]['tmp_name']) {
            $picname = $_FILES[$pic]['name'];
            $picsize = $_FILES[$pic]['size'];

            if ($picname != "") {
                $type = strstr($picname, '.');
                if ($type != ".gif" && $type != ".jpg" && $type != ".png") {
                    showerror(lang('plugin/aljwsq', 'autoreply18'));
                }
                $rand = rand(100, 999);
                $pics = date("YmdHis") . $rand . $type;
                $img_dir = 'source/plugin/aljwsq/images/advanced/';
                if (!is_dir($img_dir)) {
                    mkdir($img_dir);
                }
                $$pic = $img_dir . $pics;
                if (@copy($_FILES[$pic]['tmp_name'], $$pic) || @move_uploaded_file($_FILES[$pic]['tmp_name'], $$pic)) {
                    $imageinfo = getimagesize($$pic);
                    $w360 = $imageinfo[0] < 360 ? $imageinfo[0] : 360;
                    $h200 = $imageinfo[1] < 200 ? $imageinfo[1] : 200;
                    $w200 = $imageinfo[0] < 640 ? $imageinfo[0] : 200;
                    img2thumb($$pic, $$pic . '.360x200.jpg', $w360, $h200);
                    img2thumb($$pic, $$pic . '.200x200.jpg', $w200, $h200);
                    @unlink($_FILES[$pic]['tmp_name']);
                }
            }
        }
        $updatearray = array(
            'upid' => $_GET['upid'],
            'msgtype' => 'form',
            'mykeyword' => $_GET['keyword'],
            'bindkeyword' => $_GET['bindkeyword'],
            'title' => $_GET['title'],
            'gotourl' => $_GET['gotourl'],
			'tips' => $_GET['tips'],
            'description' => $_GET['description'],
            'tid' => $_GET['tid'],
            'threadnum' => $_GET['threadnum'],
            'forumnum' => $_GET['forumnum'],
            'updatetime' => TIMESTAMP,
            'status' => 1,
            'displayorder' => $_GET['displayorder']
        );
        if ($$pic) {
            $updatearray['picurl'] = $$pic;
        }
        C::t('#aljwsq#aljwsq_autoreply_advanced')->update($_GET['fid'], $updatearray);
        cpmsg(lang('plugin/aljwsq', 'autoreply19'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced', 'succeed');
    } else {
        //$menus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
        if ($reply['msgtype']) {
            $_GET['gettype'] = $reply['msgtype'];
        }
        include template('aljwsq:advanced/addform');
    }
}else if ($_GET['act'] == 'deleteform') {
    if($_GET['formhash']==formhash()){
        if ($_GET['fid']) {
            C::t('#aljwsq#aljwsq_autoreply_advanced')->delete($_GET['fid']);
			$reply = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
			@unlink($reply['picurl']);
			@unlink($$pic . '.360x200.jpg');
            @unlink($$pic . '.200x200.jpg');
        }
        cpmsg(lang('plugin/aljwsq', 'autoreply20'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced', 'succeed');
    }
}else if ($_GET['act'] == 'formcolumn') {
   $form=C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
   $columnlist=C::t('#aljwsq#aljwsq_advanced_column')->fetch_all_by_fid($_GET['fid']);
   include template('aljwsq:adminadvancednav');
   include template('aljwsq:advanced/formcolumn');
}else if ($_GET['act'] == 'addformcolumn') {
	if(submitcheck('formhash')){
		$insertarray=array(
			'fid' => $_GET['fid'],
			'columnsort' => $_GET['columnsort'],
			'displayorder' => $_GET['displayorder'],
			'columnname' => $_GET['columnname'],
			'columntitle' => $_GET['columntitle'],
			'columntype' => $_GET['columntype'],
			'columnmparam' => $_GET['columnmparam'],
			'columncomment' => $_GET['columncomment'],
			'dateline' => TIMESTAMP,
		);
		C::t('#aljwsq#aljwsq_advanced_column')->insert($insertarray);
		cpmsg('&#23383;&#27573;&#28155;&#21152;&#25104;&#21151;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&act=formcolumn&fid='.$_GET['fid'], 'succeed');
	}else{
	   include template('aljwsq:adminadvancednav');
	   include template('aljwsq:advanced/addformcolumn');
	}
}else if ($_GET['act'] == 'editformcolumn') {
	if(submitcheck('formhash')){
		$updatearray=array(
			'fid' => $_GET['fid'],
			'columnsort' => $_GET['columnsort'],
			'displayorder' => $_GET['displayorder'],
			'columnname' => $_GET['columnname'],
			'columntitle' => $_GET['columntitle'],
			'columntype' => $_GET['columntype'],
			'columnmparam' => $_GET['columnmparam'],
			'columncomment' => $_GET['columncomment'],
		);
		C::t('#aljwsq#aljwsq_advanced_column')->update($_GET['cid'],$updatearray);
		cpmsg('&#26356;&#26032;&#25104;&#21151;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&act=formcolumn&fid='.$_GET['fid'], 'succeed');
	}else{
	   $column=C::t('#aljwsq#aljwsq_advanced_column')->fetch($_GET['cid']);
	   include template('aljwsq:adminadvancednav');
	   include template('aljwsq:advanced/addformcolumn');
	}
}else if ($_GET['act'] == 'deleteformcolumn') {
    if($_GET['formhash']==formhash()){
        if ($_GET['cid']) {
			$column=C::t('#aljwsq#aljwsq_advanced_column')->fetch($_GET['cid']);
            C::t('#aljwsq#aljwsq_advanced_column')->delete($_GET['cid']);
        }
        cpmsg(lang('plugin/aljwsq', 'autoreply20'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&act=formcolumn&fid='.$column['fid'], 'succeed');
    }
}else if($_GET['act'] == 'deleteformcolumndata'){
	C::t('#aljwsq#aljwsq_advanced_columndata')->delete($_GET['did']);
	cpmsg(lang('plugin/aljwsq', 'autoreply20'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&act=adminformcolumndata&fid='.$_GET['fid'], 'succeed');
}else if($_GET['act'] == 'adminformcolumndata'){
	$form = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch($_GET['fid']);
	$formcolumns = C::t('#aljwsq#aljwsq_advanced_column')->fetch_all_by_fid($_GET['fid']);
	$formdatas = C::t('#aljwsq#aljwsq_advanced_columndata')->fetch_all_by_fid($_GET['fid']);
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
		}
	}
	foreach($formdatas as $kk => $formdata){
		$formdatas[$kk]['value'] = unserialize($formdata['value']);
		
	}
	//debug($formdatas);
	include template('aljwsq:adminadvancednav');
	include template('aljwsq:advanced/adminformcolumndata');
}else if($_GET['act'] == 'voicelist'){
	$_GET['gettype'] = 'voice';
	if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
		include 'source/plugin/aljwsq/function_core.php';
		$voicelist = C::t('#aljwsq#aljwsq_voice')->range();
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		if($appid && $appsecret){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$result = https_request($url);
			$jsoninfo = json_decode($result, true);
			$access_token = $jsoninfo["access_token"];
		}
		include template('aljwsq:adminadvancednav');
		include template('aljwsq:advanced/voicelist');
	}else{
		include template('aljwsq:adminadvancednav');
		include template('aljwsq:com');
	}
	
}else if($_GET['act'] == 'deletevoice'){
	if($_GET['formhash'] == FORMHASH && $_GET['vid']){
		C::t('#aljwsq#aljwsq_voice')->delete($_GET['vid']);
	}
	cpmsg('&#21024;&#38500;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=voicelist&act=voicelist', 'succeed');
}else if($_GET['act'] == 'convertvoice'){
	if(submitcheck('formhash')){
		$voice = C::t('#aljwsq#aljwsq_voice')->fetch($_GET['vid']);
		C::t('#aljwsq#aljwsq_autoreply')->insert(array(
            'upid' => $_GET['upid'],
            'msgtype' => 'voice',
            'mykeyword' => $_GET['mykeyword'],
            'bindkeyword' => $_GET['bindkeyword'],
            'title' => $voice['MediaId'],
            'picurl' => $$pic,
            'url' => $_GET['url'],
            'description' => $_GET['description'],
            'tid' => $_GET['tid'],
            'fid' => $_GET['fid'],
            'threadnum' => $_GET['threadnum'],
            'forumnum' => $_GET['forumnum'],
            'addline' => TIMESTAMP,
            'updatetime' => TIMESTAMP,
            'status' => 1,
            'displayorder' => 0
        ));
        cpmsg(lang('plugin/aljwsq', 'autoreply17'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=voicelist&act=voicelist', 'succeed');
	}else{
		include template('aljwsq:advanced/convertvoice');
	}
}else if($_GET['act'] == 'qrcodelist'){
	$qrcodelist = C::t('#aljwsq#aljwsq_qrcode')->range();
	include template('aljwsq:adminadvancednav');
	include template('aljwsq:advanced/qrcodelist');
}else if($_GET['act'] == 'viewqrcode'){
	$qrcode = C::t('#aljwsq#aljwsq_qrcode')->fetch($_GET['qid']);
	include template('aljwsq:advanced/viewqrcode');
}else if($_GET['act'] == 'addqrcode'){
	if(submitcheck('formhash')){
		require_once DISCUZ_ROOT.'source/plugin/aljwsq/class/qrcode.class.php';
		$file = dgmdate(TIMESTAMP, 'YmdHis').random(18).'.jpg';
		$insertid=C::t('#aljwsq#aljwsq_qrcode')->insert(array(
					'url' => $_GET['url'],
					'qrcode' => $file,
					'dateline' => TIMESTAMP,
				  ),true);
		QRcode::png($_G['siteurl'].'plugin.php?id=aljwsq:bind&act=qrcode&qid='.$insertid, 'source/plugin/aljwsq/images/qrcode/'.$file, QR_MODE_STRUCTURE, 8);
		cpmsg(lang('plugin/aljwsq', 'autoreply17'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=qrcodelist&act=qrcodelist', 'succeed');
	}else{
		include template('aljwsq:advanced/addqrcode');
	}
}else if($_GET['act'] == 'deleteqrcode'){
	if($_GET['formhash'] == FORMHASH && $_GET['qid']){
		C::t('#aljwsq#aljwsq_qrcode')->delete($_GET['qid']);
	}
	cpmsg('&#21024;&#38500;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=qrcodelist&act=qrcodelist', 'succeed');
}else if($_GET['act'] == 'wxqrcodelist'){
	$_GET['gettype'] = 'qrcode';
	if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
		include template('aljwsq:adminadvancednav');
		include 'source/plugin/aljwsq/com/'.$_GET['gettype'].'.php';
	}else{
		include template('aljwsq:adminadvancednav');
		include template('aljwsq:com');
	}
	
}else if($_GET['act'] == 'wxviewqrcode'){
	$qrcode = C::t('#aljwsq#aljwsq_wxqrcode')->fetch($_GET['qid']);
	include template('aljwsq:advanced/wxviewqrcode');
}else if($_GET['act'] == 'wxaddqrcode'){
	if(submitcheck('formhash')){
		include 'source/plugin/aljwsq/function_core.php';
		$voicelist = C::t('#aljwsq#aljwsq_voice')->range();
		$appid = $config['appid'];
		$appsecret = $config['appsecret'];
		if($appid && $appsecret){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$result = https_request($url);
			$jsoninfo = json_decode($result, true);
			$access_token = $jsoninfo["access_token"];
			$insertid = DB::result_first('select scene_id from %t where type = %d order by id desc',array('aljwsq_wxqrcode',$_GET['type']));
			$insertid = intval($insertid)+1;
			$scene_id = array(
				'scene' => array('scene_id' => $insertid)	
			);
			
			if(empty($_GET['type'])){
				$postdatas = array(
					'expire_seconds' => '1800',
					'action_name' => 'QR_SCENE',	 
					'action_info' => $scene_id	 
				);
			}else{
				$postdatas = array(
					'action_name' => 'QR_LIMIT_SCENE',	 
					'action_info' => $scene_id	 
				);
			}
			$postdatas = json_encode($postdatas);
			$qrcode = https_request('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token,$postdatas);
			$qrcode = json_decode($qrcode,true);
			if(empty($_GET['type'])){
				$filepath = 'source/plugin/aljwsq/images/wxqrcode_tmp/'.$insertid;
			}else{
				$filepath = 'source/plugin/aljwsq/images/wxqrcode/'.$insertid;
			}	
			$returndata = downloadImage('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$qrcode['ticket'],$filepath);
			C::t('#aljwsq#aljwsq_wxqrcode')->insert(array(
				'scene_id' => $insertid,
				'qrcode' => $returndata['filename'],
				'ticket' => $returndata['ticket'],
				'type' => $_GET['type'],
				'mykeyword' => $_GET['mykeyword'],
				'dateline' => TIMESTAMP,
			));
		}else{
			cpmsg('&#35831;&#30830;&#35748;&#20320;&#30340;&#20844;&#20247;&#21495;&#26159;&#21542;&#25317;&#26377;&#20108;&#32500;&#30721;&#26435;&#38480;&#65292;&#24182;&#22312;&#25554;&#20214;&#35774;&#32622;&#20013;&#22635;&#20889;&#97;&#112;&#112;&#105;&#100;&#21644;&#97;&#112;&#112;&#115;&#101;&#99;&#114;&#101;&#116;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=wxqrcodelist&act=wxqrcodelist', 'error');
		}
		cpmsg(lang('plugin/aljwsq', 'autoreply17'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=wxqrcodelist&act=wxqrcodelist', 'succeed');
	}else{
		include template('aljwsq:advanced/wxaddqrcode');
	}
}else if($_GET['act'] == 'wxdeleteqrcode'){
	if($_GET['formhash'] == FORMHASH && $_GET['qid']){
		C::t('#aljwsq#aljwsq_wxqrcode')->delete($_GET['qid']);
	}
	cpmsg('&#21024;&#38500;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=wxqrcodelist&act=wxqrcodelist', 'succeed');
}else if($_GET['act'] == 'wxrecordlist'){
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=10;
	$start=($currpage-1)*$perpage;
	$num=C::t('#aljwsq#aljwsq_wxqrcode_record')->count_by_scene_id($_GET['qid']);
	$recordlist=C::t('#aljwsq#aljwsq_wxqrcode_record')->fetch_all_by_scene_id($_GET['qid'],$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=wxqrcodelist&act=wxrecordlist&qid='.$_GET['qid'], 0, 11, false, false);
	include template('aljwsq:advanced/wxrecordlist');
}else if($_GET['act'] == 'keywordlog'){
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=15;
	$start=($currpage-1)*$perpage;
	$num=C::t('#aljwsq#aljwsq_keywordlog')->count();
	$recordlist=C::t('#aljwsq#aljwsq_keywordlog')->range($start,$perpage,'desc');
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=keywordlog&act=keywordlog', 0, 11, false, false);
	include template('aljwsq:advanced/keywordlog');
}else if($_GET['act'] == 'keywordlogcount'){
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=15;
	$start=($currpage-1)*$perpage;
	$num=DB::fetch_all('select count(*) num from %t group by keyword',array('aljwsq_keywordlog'));
	$num=count($num);
	$recordlist=DB::fetch_all('select keyword,count(*) num from %t group by keyword limit %d,%d',array('aljwsq_keywordlog',$start,$perpage));
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=advanced&wid=keywordlogcount&act=keywordlogcount', 0, 11, false, false);
	include template('aljwsq:advanced/keywordlogcount');
}else{
	$_GET['gettype'] = 'form';
	if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
		include 'source/plugin/aljwsq/com/'.$_GET['gettype'].'.php';
	}else{
		include template('aljwsq:adminadvancednav');
		include template('aljwsq:com');
	}
}
function downloadImage($url, $filepath) {
	//服务器返回的头信息
	$responseHeaders = array();
	//原始图片名
	$originalfilename = '';
	//图片的后缀名
	$ext = '';
	$ch = curl_init($url);
	//设置curl_exec返回的值包含Http头
	curl_setopt($ch, CURLOPT_HEADER, 1);
	//设置curl_exec返回的值包含Http内容
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 
	//设置抓取跳转（http 301，302）后的页面
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	//设置最多的HTTP重定向的数量
	curl_setopt($ch, CURLOPT_MAXREDIRS, 2);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//禁止直接显示获取的内容 重要

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书下同

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //


	//服务器返回的数据（包括http头信息和内容）
	$html = curl_exec($ch);
	//获取此次抓取的相关信息
	$httpinfo = curl_getinfo($ch);
	curl_close($ch);
	if ($html !== false) {
		//分离response的header和body，由于服务器可能使用了302跳转，所以此处需要将字符串分离为 2+跳转次数 个子串
		$httpArr = explode("\r\n\r\n", $html, 2 + $httpinfo['redirect_count']);
		//倒数第二段是服务器最后一次response的http头
		$header = $httpArr[count($httpArr) - 2];
		//倒数第一段是服务器最后一次response的内容
		$body = $httpArr[count($httpArr) - 1];
		$header.="\r\n";

		//获取最后一次response的header信息
		preg_match_all('/([a-z0-9-_]+):\s*([^\r\n]+)\r\n/i', $header, $matches);
		if (!empty($matches) && count($matches) == 3 && !empty($matches[1]) && !empty($matches[1])) {
			for ($i = 0; $i < count($matches[1]); $i++) {
				if (array_key_exists($i, $matches[2])) {
					$responseHeaders[$matches[1][$i]] = $matches[2][$i];
				}
			}
		}
		//获取图片后缀名
		if (0 < preg_match('{(?:[^\/\\\\]+)\.(jpg|jpeg|gif|png|bmp)$}i', $url, $matches)) {
			$originalfilename = $matches[0];
			$ext = $matches[1];
		} else {
			if (array_key_exists('Content-Type', $responseHeaders)) {
				if (0 < preg_match('{image/(\w+)}i', $responseHeaders['Content-Type'], $extmatches)) {
					$ext = $extmatches[1];
				}
			}
		}
		//保存文件
		if (!empty($ext)) {
			$filepath .= ".$ext";
			//如果目录不存在，则先要创建目录s
			$local_file = fopen($filepath, 'w');
			if (false !== $local_file) {
				if (false !== fwrite($local_file, $body)) {
					fclose($local_file);
					$sizeinfo = getimagesize($filepath);
					return array('filepath' => realpath($filepath), 'width' => $sizeinfo[0], 'height' => $sizeinfo[1], 'orginalfilename' => $originalfilename, 'filename' => pathinfo($filepath, PATHINFO_BASENAME));
					
				}
			}
		}
	}
	return false;
}

function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0) {
    if (!is_file($src_img)) {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;

    if (($width > $src_w && $height > $src_h) || ($height > $src_h && $width == 0) || ($width > $src_w && $height == 0)) {
        $proportion = 1;
    }
    if ($width > $src_w) {
        $dst_w = $width = $src_w;
    }
    if ($height > $src_h) {
        $dst_h = $height = $src_h;
    }

    if (!$width && !$height && !$proportion) {
        return false;
    }
    if (!$proportion) {
        if ($cut == 0) {
            if ($dst_w && $dst_h) {
                if ($dst_w / $src_w > $dst_h / $src_h) {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                } else {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            } else if ($dst_w xor $dst_h) {
                if ($dst_w && !$dst_h) {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h = $src_h * $propor;
                } else if (!$dst_w && $dst_h) {
                    $propor = $dst_h / $src_h;
                    $width = $dst_w = $src_w * $propor;
                }
            }
        } else {
            if (!$dst_h) {
                $height = $dst_h = $dst_w;
            }
            if (!$dst_w) {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int) round($src_w * $propor);
            $dst_h = (int) round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    } else {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width = $dst_w = $src_w * $proportion;
    }

    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    if (function_exists('imagecopyresampled')) {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    } else {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}
?>