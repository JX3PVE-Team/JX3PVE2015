<?php

/*
 * 作者：亮剑
 * 联系QQ:578933760
 *
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$config = $_G['cache']['plugin']['aljwsq'];
define("TOKEN", $config['token']);
$wechatObj = new wechatCallbackapi();


if (isset($_GET['echostr'])) {
    $wechatObj->valid();
} else {
    $wechatObj->responsemsg();
}
class wechatCallbackapi {

    public function valid() {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responsemsg() {
        global $_G;
        $config = $_G['cache']['plugin']['aljwsq'];
        define("TOKEN", $config['token']);
		if($_G['wechat']['setting']['wechat_token']){
			$config['token'] = $_G['wechat']['setting']['wechat_token'];
		}
        $postStr = file_get_contents("php://input");

		
		
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if ($postObj->MsgType == 'event' && $postObj->Event == 'CLICK') {
                $contentStr = trim($postObj->EventKey);
                $contentStr = $this->u2g($contentStr);
				
            }else if ($postObj->MsgType == 'event' && $postObj->Event == 'SCAN') {
				$check = C::t('#aljwsq#aljwsq_wxqrcode_record')->count_by_openid_dateline($this->u2g($postObj->FromUserName),TIMESTAMP);
				if(empty($check)){
					DB::query('update %t set num = num+1 where scene_id=%d',array('aljwsq_wxqrcode',$this->u2g($postObj->EventKey)));
					$scene_id = $postObj->EventKey;
					C::t('#aljwsq#aljwsq_wxqrcode_record') -> insert(array(
						'openid' => $this->u2g($postObj->FromUserName),
						'scene_id' => $this->u2g($scene_id),
						'dateline' => TIMESTAMP,
					));
				}
				$scan = C::t('#aljwsq#aljwsq_wxqrcode') -> fetch_by_scene_id($scene_id);
				//echo $this->responsetext($postObj, $scene_id);exit;
            } else if($postObj->MsgType == 'voice'){
				C::t('#aljwsq#aljwsq_voice')->insert(array(
					'toUser' => $this -> u2g($postObj->ToUserName),	
					'fromUser' => $this -> u2g($postObj->FromUserName),	
					'CreateTime' => $this -> u2g($postObj->CreateTime),	
					'MsgType' => $this -> u2g($postObj->MsgType),	
					'MediaId' => $this -> u2g($postObj->MediaId),	
					'Format' => $this -> u2g($postObj->Format),	
					'Recognition' => $this -> u2g($postObj->Recognition),	
					'MsgId' => $this -> u2g($postObj->MsgId),	
				));
				exit;
			}else if ($postObj->MsgType == 'event' && $postObj->Event == 'subscribe') {
                $config = $_G['cache']['plugin']['aljwsq'];
				require_once 'source/plugin/aljwsq/function_core.php';
				if($config['appid'] && $config['appsecret']){
					$wuser = getwuserinfo($postObj, $config['appid'], $config['appsecret']);
				}
				$openid = (string)$this -> u2g($postObj->FromUserName);
                $user = C::t('#aljwsq#aljwsq_user')->fetch($openid);
				if($openid){
					if (!$user && $openid) {
						C::t('#aljwsq#aljwsq_user')->insert(array(
							'openid' => $openid,
							'nickname' => $this->u2g($wuser['nickname']),
							'sex' => $wuser['sex'],
							'city' => $this->u2g($wuser['city']),
							'country' => $this->u2g($wuser['country']),
							'province' => $this->u2g($wuser['province']),
							'language' => $wuser['language'],
							'headimgurl' => $wuser['headimgurl'],
							'subscribe_time' => TIMESTAMP
						));
					} else {
						C::t('#aljwsq#aljwsq_user')->update($this -> u2g($postObj->FromUserName), array(
							'nickname' => $this->u2g($wuser['nickname']),
							'sex' => $wuser['sex'],
							'city' => $this->u2g($wuser['city']),
							'country' => $this->u2g($wuser['country']),
							'province' => $this->u2g($wuser['province']),
							'language' => $wuser['language'],
							'headimgurl' => $wuser['headimgurl']
						));
					}
				}
                $subscribe = C::t('#aljwsq#aljwsq_autoreply')->fetch_by_msgtype('subscribe');
            } else if ($postObj->MsgType == 'event' && strtolower($postObj->Event) == 'location') {
				$location = C::t('#aljwsq#aljwsq_autoreply')->fetch_by_msgtype('location');
			}else {
                $contentStr = $this->u2g(trim($postObj->Content));
            }
	
            if ($contentStr || $subscribe || $location || $scan) {
                if ($subscribe) {
                    if (file_exists('source/plugin/aljwsq/com/subscribe.php')) {
                        include 'source/plugin/aljwsq/com/subscribe.php';
                    }
                } else if($location){
					if (file_exists('source/plugin/aljwsq/com/location.php')) {
                        include 'source/plugin/aljwsq/com/location.php';
                    }
				}else if($scan){
					if (file_exists('source/plugin/aljwsq/com/scan.php')) {
                        include 'source/plugin/aljwsq/com/scan.php';
                    }
				}else {
					C::t('#aljwsq#aljwsq_keywordlog') -> insert(array(
						'keyword' => $contentStr,	
						'openid' => $this->u2g($postObj->FromUserName),	
						'nickname' => $this->u2g($wuser['nickname']),	
						'dateline' => TIMESTAMP,
					));
                    if (strpos($contentStr, lang('plugin/aljwsq', 'w1')) !== false) {
                        $str = mb_substr($contentStr, -2, 2, CHARSET);
                        $str_key = mb_substr($contentStr, 0, -2, CHARSET);
                        if ($str == lang('plugin/aljwsq', 'w1') && !empty($str_key)) {
                            $data = $this->weather($str_key);      
                            if (empty($data[weatherinfo])) {
                                $contentStr = lang('plugin/aljwsq', 'w2'). $str_key .lang('plugin/aljwsq', 'w3');
                            } else {
                                $info = $data['weatherinfo'];
                                $contentStr = $str_key.lang('plugin/aljwsq', 'w4').$info['temp'].lang('plugin/aljwsq', 'w5').$info['SD'].lang('plugin/aljwsq', 'w6').$this->u2g($info['WD']).$info['WSE'].lang('plugin/aljwsq', 'w7');
                            }
                            echo $this->responsetext($postObj, $contentStr);
                        }
                        exit;
                    }
					
                    $news = C::t('#aljwsq#aljwsq_autoreply')->fetch_by_mykeyword($contentStr);
                    $user = DB::fetch_first('select * from %t where openid=%s and bindtime!=0', array('aljwsq_user', $this->u2g($postObj->FromUserName)));
                    if (!$user && $config['isnot'] && $news['msgtype'] != 'bind' && $news['msgtype'] != 'register') {
                        echo $this->responsetext($postObj, $config['btips']);
                        exit;
                    }
                    if ($news['msgtype'] == 'bindkeyword') {
                        if (file_exists('source/plugin/aljwsq/com/bindkeyword.php')) {
                            include 'source/plugin/aljwsq/com/bindkeyword.php';
                        }
                    }
                    
                }
                if ($news['msgtype'] == 'text') {
                    if (file_exists('source/plugin/aljwsq/com/text.php')) {
                        include 'source/plugin/aljwsq/com/text.php';
                    }
                } else if ($news['msgtype'] == 'register') {
					if (file_exists('source/plugin/aljwsq/com/register.php')) {
						include 'source/plugin/aljwsq/com/register.php';
					}
                } else if ($news['msgtype'] == 'index' || $news['msgtype'] == 'ggk' || $news['msgtype'] == 'mes' || $news['msgtype'] == 'brandindex' || $news['msgtype'] == 'wsq' ) {
                    echo $this->responsenews($postObj, $news);
                }else if ($news['msgtype'] == 'bind') {
					if (file_exists('source/plugin/aljwsq/com/bind.php')) {
						include 'source/plugin/aljwsq/com/bind.php';
					}
                }else if ($news['msgtype'] == 'unbind') {
					if (file_exists('source/plugin/aljwsq/com/unbind.php')) {
						include 'source/plugin/aljwsq/com/unbind.php';
					}
                } else if ($news['msgtype'] == 'url') {
                    if (file_exists('source/plugin/aljwsq/com/url.php')) {
                        include 'source/plugin/aljwsq/com/url.php';
                    }
                } else if ($news['msgtype'] == 'singlenews') {
                    if (file_exists('source/plugin/aljwsq/com/singlenews.php')) {
                        include 'source/plugin/aljwsq/com/singlenews.php';
                    }
                } else if ($news['msgtype'] == 'multinews') {
                    if (file_exists('source/plugin/aljwsq/com/multinews.php')) {
                        include 'source/plugin/aljwsq/com/multinews.php';
                    }
                } else if ($news['msgtype'] == 'thread') {
                    if (file_exists('source/plugin/aljwsq/com/thread.php')) {
                        include 'source/plugin/aljwsq/com/thread.php';
                    }
                } else if ($news['msgtype'] == 'forum') {
                    if (file_exists('source/plugin/aljwsq/com/forum.php')) {
                        include 'source/plugin/aljwsq/com/forum.php';
                    }
                } else if ($news['msgtype'] == 'forumlist') {
                    if (file_exists('source/plugin/aljwsq/com/forumlist.php')) {
                        include 'source/plugin/aljwsq/com/forumlist.php';
                    }
                } else if ($news['msgtype'] == 'post') {
                    if (file_exists('source/plugin/aljwsq/com/post.php')) {
                        include 'source/plugin/aljwsq/com/post.php';
                    }
                } else if ($news['msgtype'] == 'hotthread') {
                    if (file_exists('source/plugin/aljwsq/com/hotthread.php')) {
                        include 'source/plugin/aljwsq/com/hotthread.php';
                    }
                } else if ($news['msgtype'] == 'digesthread') {
                    if (file_exists('source/plugin/aljwsq/com/digesthread.php')) {
                        include 'source/plugin/aljwsq/com/digesthread.php';
                    }
                } else if ($news['msgtype'] == 'comb') {
                    if (file_exists('source/plugin/aljwsq/com/comb.php')) {
                        include 'source/plugin/aljwsq/com/comb.php';
                    }
                } else if ($news['msgtype'] == 'newthread') {
                    if (file_exists('source/plugin/aljwsq/com/newthread.php')) {
                        include 'source/plugin/aljwsq/com/newthread.php';
                    }
                } else if ($news['msgtype'] == 'newarticle') {
                    if (file_exists('source/plugin/aljwsq/com/newarticle.php')) {
                        include 'source/plugin/aljwsq/com/newarticle.php';
                    }
                } else if ($news['msgtype'] == 'invite') {
                    if (file_exists('source/plugin/aljwsq/com/invite.php')) {
                        include 'source/plugin/aljwsq/com/invite.php';
                    }
                } else if ($news['msgtype'] == 'sign') {
                    if (file_exists('source/plugin/aljwsq/com/sign.php')) {
                        include 'source/plugin/aljwsq/com/sign.php';
                    }
                } else if ($news['msgtype'] == 'orderlist') {
                    if (file_exists('source/plugin/aljwsq/com/orderlist.php')) {
                        include 'source/plugin/aljwsq/com/orderlist.php';
                    }
                } else if ($news['msgtype'] == 'music') {
                    if (file_exists('source/plugin/aljwsq/com/music.php')) {
                        include 'source/plugin/aljwsq/com/music.php';
                    }
                } else if ($news['msgtype'] == 'voice') {
                    if (file_exists('source/plugin/aljwsq/com/voice.php')) {
                        include 'source/plugin/aljwsq/com/voice.php';
                    }
                } else if ($news['msgtype'] == 'aljbd') {
                    if (file_exists('source/plugin/aljwsq/com/aljbd.php')) {
                        include 'source/plugin/aljwsq/com/aljbd.php';
                    }
                }else {
                    global $_G;
					$config = $_G['cache']['plugin']['aljwsq'];
					$form = C::t('#aljwsq#aljwsq_autoreply_advanced')->fetch_by_mykeyword($contentStr);
					if($form){
						$form['url'] = 'plugin.php?id=aljwsq:form&fid='.$form['id'];
						echo $this->responsenews($postObj, $form);
						exit;
					}
					$tid = intval($contentStr);
					if($config['isthread'] && $tid && is_int($tid)){
						$thread = C::t('forum_thread') -> fetch($tid);
						if($thread){
							$news = $this->getnews($contentStr);
							echo $this->responsenews($postObj, $news);
							exit;
						}						
					}
					$keyword = stripsearchkey($contentStr);
					
					if($config['isservice']){
						if($config['skeywords']){
							$config['skeywords'] = str_replace('\r', '\n', $config['skeywords']);
							$skeywords = explode("\n", $config['skeywords']);
							foreach($skeywords as $wd){
								$wd = trim($wd);
								if($wd == $keyword){
									echo $this->responseservice($postObj);
									exit;
								}
							}
						}else{
							echo $this->responseservice($postObj);
							exit;
						}
					}
                    if (file_exists('source/plugin/aljwsq/com/so.php')) {
						if($config['isso']){
							$threads = C::t('forum_thread')->fetch_all_by_authorid_displayorder('', 'tid', '>=', '', $keyword, 0, $config['sonum']);
						}
                    }
					$keyword = '%'.$keyword.'%';
					if($config['sobrand']){
						$brands = DB::fetch_all('select * from %t where name like %s order by id desc limit 0,9',array('aljbd',$keyword));
					}
                    if ($threads) {
                        if (file_exists('source/plugin/aljwsq/com/so.php')) {
                            include 'source/plugin/aljwsq/com/so.php';
                        }
                    } else if($brands){
						$i = 0;
						foreach ($brands as $brand) {
							$tmp = $this->getbrands($brand['id'], $news);
							if (empty($i)) {
								if (empty($tmp['picurl'])) {
									$tmp['picurl'] = $config['default'];
								}
							}
							$items[] = $tmp;
							$i++;
						}
						echo $this->reponsemultinews($postObj, $items);
					} else if (preg_match('/(http:\/\/)?(.*?)\.(.*?)\.(.*?)/is', $contentStr)) {
                        if (file_exists('source/plugin/aljwsq/com/seo.php')) {
                            include 'source/plugin/aljwsq/com/seo.php';
                        }
                    } else {						
                        $config = $_G['cache']['plugin']['aljwsq'];
						if(file_exists('source/plugin/aljwsq/com/third.php')){
							include 'source/plugin/aljwsq/com/third.php';
						}
						
						if($return && $return!='Request Failed'){
							echo $return;
						}else{
							if($config['so']){
								echo $this->responsetext($postObj, $config['so']);
							}
						}
                    }
                }
            }
        }
    }

    public function responsetext($postObj, $news) {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, TIMESTAMP, $news);
        $resultStr = $this->g2u($resultStr);
        return $resultStr;
    }

    public function responsenews($postObj, $news) {
        global $_G;
        if ($news['url'] && strpos($news['url'], 'http://') === false) {
            $news['url'] = $_G['siteurl'] . $news['url'];
        }
        if (strpos($news['url'], '?') === false) {
            $news['url'] = $news['url'] . '?mobile=2&openid=' . $postObj->FromUserName;
        } else {
            $news['url'] = $news['url'] . '&mobile=2&openid=' . $postObj->FromUserName;
        }
        if ($news['picurl'] && strpos($news['picurl'], 'http://') === false) {
            $news['picurl'] = $_G['siteurl'] . $news['picurl'];
        }
        $textTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>1</ArticleCount>
			<Articles>
			<item>
			<Title><![CDATA[%s]]></Title> 
			<Description><![CDATA[%s]]></Description>
			<PicUrl><![CDATA[%s]]></PicUrl>
			<Url><![CDATA[%s]]></Url>
			</item>
			</Articles>
			</xml> ";
        if (empty($news['picurl'])) {
            $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<ArticleCount>1</ArticleCount>
				<Articles>
				<item>
				<Title><![CDATA[%s]]></Title> 
				<Description><![CDATA[%s]]></Description>
				<Url><![CDATA[%s]]></Url>
				</item>
				</Articles>
				</xml> ";
            $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, TIMESTAMP, $news['title'], $news['description'], $news['url']);
        } else {
            $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, TIMESTAMP, $news['title'], $news['description'], $news['picurl'], $news['url']);
        }

        $resultStr = $this->g2u($resultStr);
        echo $resultStr;
    }

    public function reponsemultinews($postObj, $items) {
        global $_G;
        $CreateTime = time();
        $FuncFlag = $this->setFlag ? 1 : 0;
        $newTplHeader = "<xml>  
            <ToUserName><![CDATA[{$postObj->FromUserName}]]></ToUserName>  
            <FromUserName><![CDATA[{$postObj->ToUserName}]]></FromUserName>  
            <CreateTime>{TIMESTAMP}</CreateTime>  
            <MsgType><![CDATA[news]]></MsgType>  
            <Content><![CDATA[%s]]></Content>  
            <ArticleCount>%s</ArticleCount><Articles>";
        $newTplItem = "<item>  
            <Title><![CDATA[%s]]></Title>
            <Discription><![CDATA[%s]]></Discription>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>  
            </item>";
        $newTplFoot = "</Articles>  
            <FuncFlag>%s</FuncFlag>  
            </xml>";
        $Content = '';
        $itemsCount = count($items);
        $itemsCount = $itemsCount < 10 ? $itemsCount : 10;
        if ($itemsCount) {
            foreach ($items as $key => $item) {
                if ($item['url'] && strpos($item['url'], 'http://') === false) {
                    $item['url'] = $_G['siteurl'] . $item['url'];
                }
                if (strpos($item['url'], '?') === false) {
                    $item['url'] = $item['url'] . '?mobile=2&openid=' . $postObj->FromUserName;
                } else {
                    $item['url'] = $item['url'] . '&mobile=2&openid=' . $postObj->FromUserName;
                }

                if ($item['picurl'] && strpos($item['picurl'], 'http://') === false) {
                    $item['picurl'] = $_G['siteurl'] . $item['picurl'];
                }
                if ($key <= 9) {
                    if (empty($item['picurl'])) {
                        $newTplItem = "<item>  
									   <Title><![CDATA[%s]]></Title>
									   <Discription><![CDATA[%s]]></Discription>
									   <Url><![CDATA[%s]]></Url>  
									   </item>";
                        $Content .= sprintf($newTplItem, $item['title'], $item['discription'], $item['url']);
                    } else {
                        $Content .= sprintf($newTplItem, $item['title'], $item['discription'], $item['picurl'], $item['url']);
                    }
                }
            }
        }
        $header = sprintf($newTplHeader, $newsData['content'], $itemsCount);
        $footer = sprintf($newTplFoot, $FuncFlag);
        $resultStr = $header . $Content . $footer;
        $resultStr = $this->g2u($resultStr);
        return $resultStr;
    }

    public function responsemusic($postObj, $news) {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[music]]></MsgType>
                    <Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    </Music>
                    </xml>";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, TIMESTAMP, $news['title'], $news['description'], $news['bindkeyword'], $news['url']);
        $resultStr = $this->g2u($resultStr);
        return $resultStr;
    }

	public function responsevoice($postObj, $news) {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[voice]]></MsgType>
					<Voice>
					<MediaId><![CDATA[%s]]></MediaId>
					</Voice>
					</xml>";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, TIMESTAMP, $news['title']);
        $resultStr = $this->g2u($resultStr);
        return $resultStr;
    }

	public function responseservice($postObj) {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[transfer_customer_service]]></MsgType>
					</xml>";
        $resultStr = sprintf($textTpl,$postObj->FromUserName,$postObj->ToUserName,TIMESTAMP);
        $resultStr = $this->g2u($resultStr);
        return $resultStr;
    }

    private function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    private function weather($n) {
        $c_name = C::t('#aljwsq#aljwsq_citylist')->fetch_d1_by_d2($n);
        if (!empty($c_name)) {
            $json = file_get_contents("http://www.weather.com.cn/data/sk/" . $c_name . ".html");
            $returninfo=json_decode($json,true);
            return $returninfo;
        } else {
            return null;
        }
    }

    private function g2u($a) {
        return is_array($a) ? array_map('g2u', $a) : diconv($a, CHARSET, 'UTF-8');
    }

    private function u2g($a) {
        return is_array($a) ? array_map('u2g', $a) : diconv($a, 'UTF-8', CHARSET);
    }

    private function getnews($tid, $news) {
        $data = C::t('forum_post')->fetch_threadpost_by_tid_invisible($tid);
        $tableid = getattachtableid($tid);
        $img = C::t('forum_attachment_n')->fetch_max_image($tableid, 'tid', $tid);
        $news['title'] = $data['subject'];
        $message = preg_replace('/\[attach\].+\[\/attach\]/is', '', $data['message']);
        $message = preg_replace('/\[hide\].*?\[\/hide\]/is', '', $message);
        $message = preg_replace('/\{\:soso_e(\d+)\:\}/is', '', $message);
        $message = preg_replace('/\[img\].*?\[\/img\]/is', '', $message);
        $news['description'] = cutstr(strip_tags($message), 250);
        if ($img['aid']) {
            $news['picurl'] = getforumimg($img['aid'], '', '360', '200');
        }
        $news['url'] = $_G['siteurl'] . 'forum.php?mod=viewthread&mobile=2&tid=' . $tid . '&openid=' . $postObj->FromUserName;
        return $news;
    }

	private function getarticlenews($aid, $news) {
        $data = C::t('portal_article_title')->fetch($aid);

        //$img = C::t('portal_attachment')->fetch_by_aid_image($aid);
		
		
        $news['title'] = $data['title'];
        $message = preg_replace('/\[attach\].+\[\/attach\]/is', '', $data['summary']);
        $message = preg_replace('/\[hide\].*?\[\/hide\]/is', '', $message);
        $message = preg_replace('/\{\:soso_e(\d+)\:\}/is', '', $message);
        $message = preg_replace('/\[img\].*?\[\/img\]/is', '', $message);
        $news['description'] = cutstr(strip_tags($message), 250);
        if ($img['attachment']) {
            $news['picurl'] = $data['pic'];
        }
        $news['url'] = $_G['siteurl'] . 'portal.php?mod=view&mobile=2&aid=' . $aid . '&openid=' . $postObj->FromUserName;
		
        return $news;
    }

	private function getbrands($bid, $news) {
        $data = DB::fetch_first('select * from %t where id = %d',array('aljbd',$bid));
        $news['title'] = $data['name'];
        $news['description'] = cutstr(strip_tags($intro), 250);
        $news['picurl'] = $data['logo'];
        
        $news['url'] = $_G['siteurl'] . 'plugin.php?id=aljbd&act=view&bid=' . $bid . '&openid=' . $postObj->FromUserName;
        return $news;
    }

}

?>