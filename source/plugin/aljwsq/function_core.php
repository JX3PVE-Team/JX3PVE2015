<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */

function https_request($url, $data = null) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

function getwuserinfo($postObj, $appid, $appsecret) {
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $result = https_request($url);
    $jsoninfo = json_decode($result, true);
    $access_token = $jsoninfo["access_token"];
    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $postObj->FromUserName . "&lang=zh_CN";
    $wuser = https_request($url);
    $wuser = json_decode($wuser, true);
    return $wuser;
}
