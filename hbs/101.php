<?php
/**
 * @Author: Webster
 * @Date:   2015-08-17 01:16:44
 * @Last Modified by:   Webster
 * @Last Modified time: 2015-08-17 01:36:13
 */

// define('APPTYPEID', 2);
// define('CURSCRIPT', 'forum');
require './source/class/class_core.php';
C::app()->init();
include template('diy:forum/index2');
// $post = C::t('forum_post')->fetch('tid:8201', 1093921);
