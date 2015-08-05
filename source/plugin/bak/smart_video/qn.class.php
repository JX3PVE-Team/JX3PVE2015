<?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
class smart_qn{ 
private $bucket;
private $putPolicy;
public function __construct($accessKey,$secretKey,$bucket){
	$this->bucket=$bucket;
	require_once("qiniu/rs.php");
	Qiniu_SetKeys($accessKey, $secretKey);
	$putPolicy = new Qiniu_RS_PutPolicy($bucket);
	$this->putPolicy=$putPolicy;
}
public function get_purl(){
	$this->putPolicy->ReturnBody='{ "name": $(fname)}';
	$upToken = $this->putPolicy->Token(null);
	return $upToken;
}
public function get_sign_url($object){
	$domain=$this->bucket.".qiniudn.com";
	$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $object);
	$getPolicy = new Qiniu_RS_GetPolicy();
	$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
	return $privateUrl;
	}
}