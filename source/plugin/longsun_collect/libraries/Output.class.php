<?php
/**
 * @author: shwdai@gmail.com
 */
class Output
{
	static private $tagSon = array();

	static public function SetTagSon($parent, $son) {
		self::$tagSon[$parent] = $son;
	}

	static private function Error($error=0)
	{
		return array( 'error' => intval($error), );
	}

	static public function ArrayToXml($array, $level=0, $topTagName='result')
	{
		if ($topTagName) {
			$xml = str_repeat("\t",$level) . "<$topTagName>\n";
			$level++;
		}

		foreach ($array as $key=>$value) {
			if( is_numeric($key) ){
				$key = self::GetSubTagName($topTagName);
			}   

			if($value===false) $value='false';
			if($value===true) $value='true';

			if (is_array($value)) { 
				$xml .= self::ArrayToXml($value,$level,$key);
			} else {
				if (htmlspecialchars($value) != $value) {
					$xml .= str_repeat("\t",$level)
						."<$key><![CDATA[$value]]></$key>\n";
				} else {
					$xml .= str_repeat("\t",$level).
						"<$key>$value</$key>\n";
				}
			}
		}

		if ($topTagName) {
			$xml .= str_repeat("\t",($level-1)) . "</$topTagName>\n";
		}
		return $xml;
	}

	static public function GetSubTagName($tagName)
	{
		if ( self::$tagSon[$tagName] ) {
			return self::$tagSon[$tagName];
		}
		if ( preg_match( '/ies$/', $tagName ) ) //repl + ies
			return preg_replace( '/(ies)$/', 'y', $tagName );

		if ( preg_match( '/ses$/', $tagName ) )  //status + es
			return preg_replace( '/(es)$/', '', $tagName );

		if ( preg_match( '/s$/', $tagName ) ) //boy + s
			return preg_replace( '/(s)$/', '', $tagName );

		if ( preg_match( '/urlset$/', $tagName ) ) //boy + s
			return 'url';

		return 'item';
	}

	static public function Out($data=null, $error=0)
	{
		$ajax = isset($_SERVER['HTTP_AJAX'])
			? strtoupper($_SERVER['HTTP_AJAX']) : 'JSON';
		switch($ajax)
		{
			case 'XML':
				self::Xml($data, $error);
			case 'FLAG':
				$flag = $error===0 ? '+' : '-';
				self::Flag($data, $flag);
			case 'JSON':
				self::Json($data, $error);
			default:
				self::Json($data, $error);
		}
	}

	static public function Json($data=null, $error=0)
	{
		$result = self::error( $error );
		if ( null !== $data ) 
		{
			$result['data'] = $data;
		}
		die( json_encode($result) );
	}

	static public function Xml($data=null, $error=0)
	{
		$result = self::error( $error );
		if ( null !== $data ) 
		{
			$result['data'] = $data;
		}

		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$xml .= self::ArrayToXml( $result, 0, 'result' );
		die( $xml );
	}

	static public function XmlCustom($data, $parentTag=null) {
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$xml .= self::ArrayToXml( $data, 0, $parentTag );
		die( $xml );
	}

	static public function XmlBaidu($data=null, $error=0)
	{
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$xml .= self::ArrayToXml( $data, 0, 'urlset' );
		die( $xml );
	}

	static public function Flag($string=null, $flag='+')
	{
		$flag = substr( $flag, 0, 1 );
		die( $flag . $data );
	}
}
?>