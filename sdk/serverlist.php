<?php
class JX3ServerCheck {
	public static $status = array();
	public function check($ip, $port){
		if (!isset(self::$status[$ip])){
			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			socket_set_nonblock($sock);
			socket_connect($sock,$ip, $port);
			socket_set_block($sock);
			self::$status[$ip] = socket_select($r = array($sock), $w = array($sock), $f = array($sock), 1);
		}
	}
	public function GetStatus(){
		return self::$status;
	}
}
$file = "/tmp/JX3ServerCheck";
if(time() - filemtime($file) > 30){
	$content = file_get_contents("http://jx3gc.autoupdate.kingsoft.com/jx3gc/zhcn/serverlist/serverlist.ini");
	$content = iconv("GBK", "UTF-8", $content);
	$line = explode("\n", $content);
	$array = array();
	$JX3 = new JX3ServerCheck();
	foreach ($line as $k => $v) {
		if($v){
			$arr = explode("\t", $v);
			$array[$arr[0]][] = $arr;
			$JX3->check($arr[3], $arr[4]);
		}
	}
	$return = array('server' => $array, 'status' => $JX3->GetStatus());
	$return = json_encode($return);
	file_put_contents($file, $return);
	echo $return;
} else {
	echo file_get_contents($file);
}
