<?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class smart_bcs{
private $baidu_bcs;
private $bucket;
public  function __construct($ak, $sk,$bucket,$host='bcs.duapp.com') {
		require_once 'source/plugin/smart_video/api/bcs.class.php';
		$this->baidu_bcs = new BaiduBCS ( $ak, $sk, $host );
		$this->bucket =$bucket;
		
	}
public function create_bucket($bucket) {
	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
	$response = $this->baidu_bcs->create_bucket ($bucket, $acl );
	return $response;
}

public function delete_bucket($bucket) {
	$response = $this->baidu_bcs->delete_bucket ($bucket);
	return $response;
}

public function list_object() {
	global  $fileWriteTo;
	$opt = array (
			'start' => 0, 
			'limit' => 5, 
			'prefix' => '/a' );
	$response = $this->baidu_bcs->list_object ( $this->bucket, $opt );
	return $response;
}

public function list_bucket() {
	$response = $this->baidu_bcs->list_bucket ();
	return $response;
}

public function get_bucket_acl() {
	
	$response = $this->baidu_bcs->get_bucket_acl ( $this->bucket );
	return $response;
}

/**
 * ************************object********************************** *
 * */

public function bs_log($log) {
	trigger_error ( basename ( __FILE__ ) . " [time: " . time () . "][LOG: $log]" );
}

public function create_object($fileUpload, $object,$ext='png',$auto=1) {
	if($auto){
	$y=date("Y");$m=date("m");$d=date("d");
	$dir="/$y/$m/$d/";
	$filename=time().rand(1, 10000).".$ext";
	$object=$dir.$filename;
	}
	$opt = array ();
	$opt ['acl'] = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
	$opt [BaiduBCS::IMPORT_BCS_LOG_METHOD] = "bs_log";
	$opt ['curlopts'] = array (
			CURLOPT_CONNECTTIMEOUT => 120, 
			CURLOPT_TIMEOUT => 1800 );
	$response= $this->baidu_bcs->create_object ( $this->bucket, $object, $fileUpload, $opt );
	$response->dir=$object;
	return $response;
}

public function create_object_superfile($fileUpload, $object) {
	$opt = array ();
	$opt ['acl'] = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
	$opt [BaiduBCS::IMPORT_BCS_LOG_METHOD] = "bs_log";
	$opt ["sub_object_size"] = 1024 * 256;
	$response = $this->baidu_bcs->create_object_superfile ( $this->bucket, $object, $fileUpload, $opt );
	return $response;
}

public function upload_directory($upload_dir) {
	$opt = array (
			"prefix" => "/20110622", 
			"has_sub_directory" => true, 
			BaiduBCS::IMPORT_BCS_PRE_FILTER => "pre_filter", 
			BaiduBCS::IMPORT_BCS_POST_FILTER => "post_filter" );
	$this->baidu_bcs->upload_directory ( $this->bucket, $upload_dir, $opt );
}

public function copy_object($object) {
	$source = 'bs://' . $this->bucket . $object;
	
	$source = array (
			'bucket' => $this->bucket, 
			'object' => $object );
	$dest = array (
			'bucket' => $this->bucket, 
			'object' => $object . 'copy' );
	$response = $this->baidu_bcs->copy_object ( $source, $dest );
	return $response;
	if ($response->isOK ()) {
		echo "you can download from =" . $this->baidu_bcs->generate_get_object_url ( $this->bucket, $dest ['object'] );
	}
}

public function set_object_meta($object) {
	$meta = array (
			"Content-Type" => BCS_MimeTypes::get_mimetype ( "pdf" ) );
	$response = $this->baidu_bcs->set_object_meta ( $this->bucket, $object, $meta );
	return $response;
}

public function get_object($object, $fileWriteTo) {
	$opt = array (
			'fileWriteTo' => $fileWriteTo );
	$response = $this->baidu_bcs->get_object ( $this->bucket, $object, $opt );
	if ($response->isOK ()) {
		echo "response is OK\n";
	} else {
		return $response;
	}
}

public function delete_object($object) {
	$response = $this->baidu_bcs->delete_object( $this->bucket, $object );
	return $response;
}

public function get_object_acl($object) {
	$response = $this->baidu_bcs->get_object_acl ( $this->bucket, $object );
	return $response;
}

public function set_object_acl_by_acl_type() {
	global $object;
	//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_CONTROL;
	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
	//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ_WRITE;
	//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
	//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
	$response = $this->baidu_bcs->set_object_acl ( $this->bucket, $object, $acl );
	return $response;
}

public function is_object_exist($object) {
	$bolRes = $this->baidu_bcs->is_object_exist ( $this->bucket, $object );
	return $bolRes;
}

public function get_object_info($object) {
	$response = $this->baidu_bcs->get_object_info ( $this->bucket, $object );
	return $response;
}

public function generate_get_object_url($object) {
	$opt = array ();
	$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时 
	//$opt ["ip"] = "10.81.42.123"; //可选，限制本链接发起的客户端ip
	return $this->baidu_bcs->generate_get_object_url ( $this->bucket, $object, $opt );
}
private function pre_filter($bucket, $object, $file, &$tmp_opt) {
	//举例在上传文件在$opt中加入一个特定串，在post_filter中取出并打印
	$tmp_opt ["something"] = "something about [$object]";
	return true;
}

private function post_filter($bucket, $object, $file, &$tmp_opt, $response) {
	//配合
	trigger_error ( $tmp_opt ["something"] );
	return;
}
public function generate_put_object_url($object) {
	$opt = array ();
	$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时 
	$opt ["size"] = 1024*1024 * 1024; //可选，用户上传时，限制上传大小，这里限制1MB
	//"ip" => "192.168.1.1"    //可选，限制本链接发起的客户端ip
	

	echo $this->baidu_bcs->generate_put_object_url ( $this->bucket, $object, $opt );
}

public function generate_post_object_url($auto=1,$ext='png',$object) {
	if($auto){
	$y=date("Y");$m=date("m");$d=date("d");
	$dir="/$y/$m/$d/";
	$filename=time().rand(1, 10000).".$ext";
	$object=$dir.$filename;
	}elseif(!$object){
		return array('object'=>'not set','url'=>'error');
		}
	$opt = array ();
	$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时 
	$opt ["size"] = 1024*1024 * 1024; //可选，用户上传时，限制上传大小，这里限制1MB
	//"ip" => "192.168.1.1"    //可选，限制本链接发起的客户端ip
	$return['object']=$object;
    $return['url']=$this->baidu_bcs->generate_post_object_url ( $this->bucket, $object, $opt );
	return $return;
}
public function printResponse($response) {
	echo $response->isOK () ? "OK\n" : "NOT OK\n";
	echo 'Status:' . $response->status . "\n";
	echo 'Body:' . $response->body . "\n";
	echo "Header:\n";
	var_dump ( $response->header );
}		
	}
?>