<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_ggk_user extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_ggk_user';
        $this->_pk = 'uid';

        parent::__construct();
    }

}

?>