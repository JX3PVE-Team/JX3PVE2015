<?php
function json($data, $type='eval') {
    $type = strtolower($type);
    $allow = array('eval','alert','right','notice','sucsses');
    if (false==in_array($type, $allow))
        return false;
    Output::Json(array( 'data' => $data, 'type' => $type,));
}
function RecursiveMkdir($path) {
	if (!file_exists($path)) {
		RecursiveMkdir(dirname($path));
		@mkdir($path, 0777);
	}
}
function checkCharset($str){
    return strtolower(CHARSET)!='utf-8'?iconv(CHARSET, 'utf-8',$str):$str;	
}
?>