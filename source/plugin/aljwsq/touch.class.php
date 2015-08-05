<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Deined');
}

class mobileplugin_aljwsq {

    function index_top_mobile() {
        global $_G;
    }

    function common() {
		
        if ($_GET['openid']) {
            $binduser = C::t('#aljwsq#aljwsq_user')->fetch($_GET['openid']);
			if(empty($binduser) && file_exists(DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php')){
				$binduser=DB::fetch_first('SELECT * FROM %t WHERE openid=%s', array('common_member_wechat', $_GET['openid']));
			}
			//debug($binduser);
            //debug($_GET['openid']);
            if ($binduser) {
                $user = C::t('common_member')->fetch_by_username($binduser['username']);
                require_once libfile('function/member');
                setloginstatus($user, 2592000);
            }
        }
		
    }

}

class mobileplugin_aljwsq_forum extends mobileplugin_aljwsq {

    function post_checkreply_message($param) {
        global $_G;
    }

}

?>