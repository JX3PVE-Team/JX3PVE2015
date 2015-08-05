<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
include 'source/plugin/aljwsq/com/com.php';
include 'source/plugin/aljwsq/include/msgtypes.php';
if ($_GET['act'] == 'addautoreply') {
    //debug(submitcheck('formhash'));
    if (submitcheck('formhash')) {
        $keyword=C::t('#aljwsq#aljwsq_autoreply')->fetch_by_mykeyword($_GET['keyword']);
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
					cpmsg(lang('plugin/aljwsq', 'autoreply16'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 'succeed');
                }
                $rand = rand(100, 999);
                $pics = date("YmdHis") . $rand . $type;
                $img_dir = 'source/plugin/aljwsq/images/logo/';
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
		$_GET['keyword'] = str_replace('\r', '\n', $_GET['keyword']);
		$keywordlist = explode("\n", $_GET['keyword']);
		foreach($keywordlist as $keyword){
			C::t('#aljwsq#aljwsq_autoreply')->insert(array(
				'upid' => $_GET['upid'],
				'msgtype' => $_GET['msgtype'],
				'mykeyword' => $keyword,
				'bindkeyword' => $_GET['bindkeyword'],
				'title' => $_GET['title'],
				'picurl' => $$pic,
				'url' => $_GET['url'],
				'description' => $_GET['description'],
				'tid' => $_GET['tid'],
				'fid' => $_GET['fid'],
				'threadnum' => $_GET['threadnum'],
				'forumnum' => $_GET['forumnum'],
				'addline' => TIMESTAMP,
				'updatetime' => TIMESTAMP,
				'status' => $_GET['status'],
				'displayorder' => $_GET['displayorder']
			));
		}
        cpmsg(lang('plugin/aljwsq', 'autoreply17'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 'error');
    } else {
        if ($_GET['gettype']) {
            $reply['msgtype'] = $_GET['gettype'];
        }
        if (file_exists('source/plugin/aljwsq/com/'.$_GET['gettype'].'.php')) {
            if($_GET['gettype'] == 'weather'){
                include 'source/plugin/aljwsq/com/weather.php';
                include template('aljwsq:weather');
                exit;
            }
			if($_GET['gettype'] == 'voice'){
				header('Location: admin.php?action=plugins&operation=config&do=14&identifier=aljwsq&pmod=advanced&wid=voicelist&act=voicelist');
				exit;
			}
            include template('aljwsq:addautoreply');
        }else{
            include template('aljwsq:com');
        }
        
    }
} else if ($_GET['act'] == 'edit') {
    if ($_GET['aid']) {
        $reply = C::t('#aljwsq#aljwsq_autoreply')->fetch($_GET['aid']);
    }
    if (submitcheck('formhash')) {
        $pic = 'picurl';
        if ($_FILES[$pic]['tmp_name']) {
            $picname = $_FILES[$pic]['name'];
            $picsize = $_FILES[$pic]['size'];

            if ($picname != "") {
                $type = strstr($picname, '.');
                if ($type != ".gif" && $type != ".jpg" && $type != ".png") {
                    cpmsg(lang('plugin/aljwsq', 'autoreply18'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 'error');
                }
                $rand = rand(100, 999);
                $pics = date("YmdHis") . $rand . $type;
                $img_dir = 'source/plugin/aljwsq/images/logo/';
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
            'msgtype' => $_GET['msgtype'],
            'mykeyword' => $_GET['keyword'],
            'bindkeyword' => $_GET['bindkeyword'],
            'title' => $_GET['title'],
            'url' => $_GET['url'],
            'description' => $_GET['description'],
            'tid' => $_GET['tid'],
            'fid' => $_GET['fid'],
            'threadnum' => $_GET['threadnum'],
            'forumnum' => $_GET['forumnum'],
            'updatetime' => TIMESTAMP,
            'status' => $_GET['status'],
            'displayorder' => $_GET['displayorder']
        );
        if ($$pic) {
            $updatearray['picurl'] = $$pic;
        }
        C::t('#aljwsq#aljwsq_autoreply')->update($_GET['aid'], $updatearray);
        cpmsg(lang('plugin/aljwsq', 'autoreply19'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 'succeed');
    } else {
        //$menus = C::t('#aljwsq#aljwsq_menu')->fetch_all_by_upid(0);
        if ($reply['msgtype']) {
            $_GET['gettype'] = $reply['msgtype'];
        }
        include template('aljwsq:addautoreply');
    }
} else if ($_GET['act'] == 'delete') {
    if($_GET['formhash']==formhash()){
        if ($_GET['aid']) {
            C::t('#aljwsq#aljwsq_autoreply')->delete($_GET['aid']);
        }
        cpmsg(lang('plugin/aljwsq', 'autoreply20'), 'action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 'succeed');
    }
} else {
	$page = intval($_GET['page']);
    $currpage = $page ? $page : 1;
    $perpage = 11;
	$start = ($currpage - 1) * $perpage;
    $num = C::t('#aljwsq#aljwsq_autoreply')->count_by_status('', $_GET['msgtype']);
    $replys = C::t('#aljwsq#aljwsq_autoreply')->fetch_all_by_status('', $_GET['msgtype'], $start, $perpage);
    $paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do=' . $_GET['do'] . '&identifier=aljwsq&pmod=autoreply', 0, 11, false, false);
    include template('aljwsq:autoreply');
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
