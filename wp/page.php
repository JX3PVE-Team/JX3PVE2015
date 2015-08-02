<?php
/**
 * ----------------------------------------------------------
 * $id HashMacro.php
 * $Edit Monday,November 25,2013
 * @简单的SQL取值
 * ----------------------------------------------------------
 */
 
require_once './GetPage/config_inc.php';
function AddMacroHot($id){
	global $db;
	$time = date("ymd");
	$sql = "select * from c_hot where tid = $id and _time = $time";
	$data = $db->getRow($sql);
	if(!$data){
		$insert = array(
			'tid' => $id,
			'_time' => $time
		);
		$db->insert($insert,'c_hot');
	}
	$sql = "update c_hot set hot = hot + 1 where c_hot.tid = $id and c_hot._time = $time";
	$db->execute($sql);
}

header("Content-Type: text/html;charset=utf-8");
if(isset($_GET['id'])){
	$id = is_numeric($_GET['id']) ? $_GET['id'] : exit;
	$sql = "select * from wp_posts where post_status = 'publish' and id = $id";
	//left join c_additional on wp_posts.id = c_additional.post_id
	$data = $db->getRow($sql);
	if($data){
		$tag = 'a|abbr|acronym|address|applet|area|article|aside|audio|b|base|basefont|bgsound|bdo|big|blink|blockquote|body|br|button|caption|canvas|center|cite|code|col|colgroup|command|comment|datagrid|datalist|datatemplate|dd|del|details|dfn|dialog|dir|div|dl|dt|em|embed|eventsource|fieldset|figure|font|footer|form|frame|frameset|h|h1|h2|h3|h4|h5|h6|head|header|hr|hta:application|html|i|iframe|img|input|ins|isindex||kbd|label|legend|li|link|listing|mark|map|marquee|menu|meta|meter|multicol|nav|nest|nextid|nobr|noframes|noscript|object|ol|optgroup|option|output|p|param|plaintext|pre|progress|q|ruby|rp|rt|rule|s|samp|script|section|select|server|small|sound|source|spacer|span|strike|strong|style|sub|sup|table|tbody|td|textarea|textflow|tfoot|th|thead|title|tr|tt|u|ul|var|video|wbr|xmp';
		$data['post_content'] = preg_replace('/<('.$tag.')>/i','',$data['post_content']);
		$data['post_content'] = preg_replace('/<('.$tag.') .*?>/i','',$data['post_content']);
		$tag = str_replace('|','|\/',$tag);
		$data['post_content'] =  preg_replace('/<(\/'.$tag.')>/i','',$data['post_content']);
		$content = str_replace(array(' ',"\r"),array(' ',''),html_entity_decode($data['post_content']));
		$net = "";
		//$net = "\n#net http://www.jx3pve.com/cloud/$id";
		
		if(isset($_GET['String'])){
			$cycle = 7;
			$time = date("ymd") - $cycle;
			
			$sql = "select * from c_hot where tid = $id order by _id desc limit 0,7";//and _time > $time
			$hot = $db->getAll($sql);
			$macro_hot = 0;
			if($hot){
				foreach ($hot as $k => $v){
					$macro_hot = $macro_hot + $v['hot'];
				}
			}
			//$macro_hot = floor($macro_hot / $cycle);
			$echo = array(
				'content' => trim($content),
				'net' => $net,
				'use' => $macro_hot
			);
			echo json_encode($echo,JSON_UNESCAPED_UNICODE);
			// echo trim($content),$net;
			exit();
		}
		
		@$content = iconv('UTF-8','GBK//IGNORE',trim($content)).$net;
		
		switch (isset($_GET['Hash']))
		{
		case true:
			$n = 0;
			for($i = 0; $i < strlen($content); $i++){
				$n = ($n * 131 + ord($content[$i])) % 65536;
			}
			AddMacroHot($id);
			echo '<title>' , strtoupper(str_pad(dechex($n),4,'0',STR_PAD_LEFT)) , /*strlen($char) . */'</title>';
			break;
		default:
			for($i = 0; $i < strlen($content); $i++){
				echo str_pad(dechex(ord($content[$i])),2,'0',STR_PAD_LEFT);
			}
		}
	}
}