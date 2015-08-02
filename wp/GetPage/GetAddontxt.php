<?php
header("Content-Type: text/html; charset=UTF-8");

require_once './GetPage/config_inc.php';
$sql = "SELECT * FROM  `jx3pve_bbs`.`pre_forum_post` WHERE  `pid` = 2285";
$a = $db->GetRow($sql);
echo $a['message'];

