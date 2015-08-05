<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_qrcode extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_qrcode';
        $this->_pk = 'id';
        parent::__construct();
    }

}

?>