<?php

/*
 * ���ߣ�����
 * ��ϵQQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_aljwsq_keywordlog extends discuz_table {

    public function __construct() {

        $this->_table = 'aljwsq_keywordlog';
        $this->_pk = 'id';
        parent::__construct();
    }
}

?>