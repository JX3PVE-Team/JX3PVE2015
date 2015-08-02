<?php

/**
 *------------------------------------------------------------------------------
 * Mysqli数据库操作类
 *------------------------------------------------------------------------------
 * @package   Raid
 * @author	Techvicky <techvicky@outlook.com>
 * @version   $Id: Mysqli.class.php 2791 2012-08-02 19:08:57Z Techvicky $
 *------------------------------------------------------------------------------
 */

class DbMysqli {
	// 数据库连接参数配置
	protected $config = '';
	// 数据库连接ID 支持多个连接
	protected $linkID = array();
	// 当前连接ID
	protected $_linkID =   null;
	// 是否已经连接数据库
	protected $connected = false;
	// 当前查询ID
	protected $queryID = null;
	// 当前SQL指令
	protected $queryStr = '';
	// 最后插入ID
	protected $lastInsID = null;
	// 返回或者影响记录数
	protected $numRows = 0;
	// 返回字段数
	protected $numCols = 0;
	// 错误信息
	protected $error = '';
	// 是否显示调试信息
	protected $debug = false;
	

	/**
	 *----------------------------------------------------------
	 * 架构函数 读取数据库配置信息
	 *----------------------------------------------------------
	 * @access public
	 * @param array $config 数据库配置数组
	 *----------------------------------------------------------
	 */
	public function __construct($config=''){
		if ( !extension_loaded('mysqli') ) {
			throw new Exception('没有安装mysqli模块');
		}
		if(!empty($config)) {
			$this->config = $config;
		}
		$this->connect();
	}

   /**
	 *----------------------------------------------------------
	 * 析构方法
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 */
	public function __destruct() {
		// 释放查询
		if ($this->queryID){
			$this->free();
		}
		// 关闭连接
		$this->close();
	}

	/**
	 *----------------------------------------------------------
	 * 连接数据库方法
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 */
	public function connect($config='',$linkNum=0) {
		if ( !isset($this->linkID[$linkNum]) ) {
			if(empty($config))  $config = $this->config;
			$this->linkID[$linkNum] = new mysqli($config['hostname'],$config['username'],$config['password'],$config['database'],$config['hostport']?intval($config['hostport']):3306);
			if (mysqli_connect_errno()) {
				throw new Exception(mysqli_connect_error());
				exit('no connect');
			}
			$dbVersion = $this->linkID[$linkNum]->server_version;
			$this->linkID[$linkNum]->query("SET NAMES '".$config['charset']."'");
			//设置 sql_model
			if($dbVersion >'5.0.1'){
				$this->linkID[$linkNum]->query("SET sql_mode=''");
			}
			// 标记连接成功
			$this->connected = true;
			$this->_linkID = $this->linkID[$linkNum];
			//注销数据库安全信息
			unset($this->config);
		}
		return $this->linkID[$linkNum];
	}

	/**
	 *----------------------------------------------------------
	 * 初始化数据库连接
	 *----------------------------------------------------------
	 * @access protected
	 * @return void
	 *----------------------------------------------------------
	 */
	protected function initConnect() {
		if ( !$this->connected ) $this->_linkID = $this->connect();
	}

	/**
	 *----------------------------------------------------------
	 * 释放查询结果
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 */
	public function free() {
		$this->queryID->free_result();
		$this->queryID = null;
	}

	/**
	 *----------------------------------------------------------
	 * 执行查询 返回数据集
	 *----------------------------------------------------------
	 * @access public
	 * @param string $str  sql指令
	 * @return mixed
	 *----------------------------------------------------------
	 */
	public function getAll($str) {
		$this->initConnect(false);
		if ( !$this->_linkID ) return false;
		$this->queryStr = $str;
		//释放前次的查询结果
		if ( $this->queryID ) $this->free();
		$this->queryID = $this->_linkID->query($str);
		// 对存储过程改进
		if( $this->_linkID->more_results() ){
			while (($res = $this->_linkID->next_result()) != NULL) {
				$res->free_result();
			}
		}
		if ( false === $this->queryID ) {
			$this->error();
			return false;
		} else {
			$this->numRows = $this->queryID->num_rows;
			$this->numCols = $this->queryID->field_count;
			return $this->_getAll();
		}
	}

	/**
	 *----------------------------------------------------------
	 * 执行查询 返回单行数据
	 *----------------------------------------------------------
	 * @access public
	 * @param string $str  sql指令
	 * @return mixed
	 *----------------------------------------------------------
	 */
	public function getRow($str) {
		$this->initConnect(false);
		if ( !$this->_linkID ) return false;
		if(strpos('limit',strtolower($str))===false){
			$str .=' LIMIT 1';
		}
		$this->queryStr = $str;
		//释放前次的查询结果
		if ( $this->queryID ) $this->free();
		$this->queryID = $this->_linkID->query($str);
		if ( false === $this->queryID ) {
			$this->error();
			return false;
		} else {
			return $this->queryID->fetch_assoc();
		}
	}

	/**
	 *----------------------------------------------------------
	 * 执行语句
	 *----------------------------------------------------------
	 * @access public
	 * @param string $str  sql指令
	 * @return integer
	 *----------------------------------------------------------
	 */
	public function execute($str) {
		$this->initConnect(true);
		if ( !$this->_linkID ) return false;
		$this->queryStr = $str;
		//释放前次的查询结果
		if ( $this->queryID ) $this->free();
		$result =   $this->_linkID->query($str);
		if ( false === $result ) {
			$this->error();
			return false;
		} else {
			$this->numRows = $this->_linkID->affected_rows;
			$this->lastInsID = $this->_linkID->insert_id;
			return $this->numRows;
		}
	}

	/**
	 *----------------------------------------------------------
	 * 获得所有的查询数据
	 *----------------------------------------------------------
	 * @access private
	 * @param string $sql  sql语句
	 * @return array
	 *----------------------------------------------------------
	 */
	private function _getAll() {
		//返回数据集
		$result = array();
		if($this->numRows>0) {
			//返回数据集
			for($i=0;$i<$this->numRows ;$i++ ){
				$result[$i] = $this->queryID->fetch_assoc();
			}
			$this->queryID->data_seek(0);
		}
		return $result;
	}

	/**
	 *----------------------------------------------------------
	 * 取得数据表的字段信息
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 */
	public function getFields($tableName) {
		$result = $this->query('SHOW COLUMNS FROM '.$tableName);
		$info = array();
		if($result) {
			foreach ($result as $key => $val) {
				$info[$val['Field']] = array(
					'name'	=> $val['Field'],
					'type'	=> $val['Type'],
					'notnull' => (bool) ($val['Null'] === ''),
					'default' => $val['Default'],
					'primary' => (strtolower($val['Key']) == 'pri'),
					'autoinc' => (strtolower($val['Extra']) == 'auto_increment'),
				);
			}
		}
		return $info;
	}


	/**
	 *----------------------------------------------------------
	 * 批量插入记录
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 * @param mixed $datas 数据
	 * @param array $options 参数表达式
	 * @param boolean $replace 是否replace
	 *----------------------------------------------------------
	 * @return false | integer
	 *----------------------------------------------------------
	 */
	public function insertAll($datas,$table,$replace=false) {
		if(!is_array($datas[0])) return false;
		$fields = array_keys($datas[0]);
		array_walk($fields, array($this, 'parseKey'));
		$values = array();
		foreach ($datas as $data){
			$value = array();
			foreach ($data as $key=>$val){
				$val = $this->parseValue($val);
				if(is_scalar($val)) { // 过滤非标量数据
					$value[] = $val;
				}
			}
			$values[] = '('.implode(',', $value).')';
		}
		$sql = ($replace?'REPLACE':'INSERT').' INTO '.$this->parseTable($table).' ('.implode(',', $fields).') VALUES '.implode(',',$values);
	   return $this->execute($sql);
	}

	/**
	 *----------------------------------------------------------
	 * 关闭数据库
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 */
	public function close() {
		if ($this->_linkID){
			$this->_linkID->close();
		}
		$this->_linkID = null;
	}

	/**
	 *----------------------------------------------------------
	 * 数据库错误信息
	 * 并显示当前的SQL语句
	 *----------------------------------------------------------
	 * @static
	 * @access public
	 * @return string
	 *----------------------------------------------------------
	 */
	public function error() {
		$this->error = $this->_linkID->error;
		if($this->debug && '' != $this->queryStr){
			$this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
		}
		return $this->error;
	}

	/**
	 *----------------------------------------------------------
	 * SQL指令安全过滤
	 *----------------------------------------------------------
	 * @static
	 * @access public
	 *----------------------------------------------------------
	 * @param string $str  SQL指令
	 *----------------------------------------------------------
	 * @return string
	 *----------------------------------------------------------
	 */
	public function escapeString($str) {
		if($this->_linkID) {
			return  $this->_linkID->real_escape_string($str);
		}else{
			return addslashes($str);
		}
	}

	/**
	 *----------------------------------------------------------
	 * 字段和表名处理添加`
	 *----------------------------------------------------------
	 * @access protected
	 * @param string $key
	 * @return string
	 *----------------------------------------------------------
	 */
	protected function parseKey(&$key) {
		$key = trim($key);
		if(!preg_match('/[,\'\"\*\(\)`.\s]/',$key)) {
		   $key = '`'.$key.'`';
		}
		return $key;
	}
	
	/**
	 *----------------------------------------------------------
	 * value分析
	 *----------------------------------------------------------
	 * @access protected
	 * @param mixed $value
	 * @return string
	 *----------------------------------------------------------
	 */
	protected function parseValue($value) {
		if(is_string($value)) {
			$value = '\''.$this->escapeString($value).'\'';
		}elseif(is_array($value)) {
			$value = array_map(array($this, 'parseValue'),$value);
		}elseif(is_null($value)){
			$value = 'null';
		}
		return $value;
	}

	/**
	 +----------------------------------------------------------
	 * table分析
	 +----------------------------------------------------------
	 * @access protected
	 * @param mixed $table
	 * @return string
	 +----------------------------------------------------------
	 */
	protected function parseTable($tables) {
		if(is_array($tables)) {// 支持别名定义
			$array = array();
			foreach ($tables as $table=>$alias){
				if(!is_numeric($table))
					$array[] = $this->parseKey($table).' '.$this->parseKey($alias);
				else
					$array[] = $this->parseKey($table);
			}
			$tables = $array;
		}elseif(is_string($tables)){
			$tables = explode(',',$tables);
			array_walk($tables, array(&$this, 'parseKey'));
		}
		return implode(',',$tables);
	}
	
	/**
	 *----------------------------------------------------------
	 * 插入记录
	 *----------------------------------------------------------
	 * @access public
	 *----------------------------------------------------------
	 * @param mixed $data 数据
	 * @param array $options 参数表达式
	 * @param boolean $replace 是否replace
	 * @return false | integer
	 *----------------------------------------------------------
	 */
	public function insert($data,$table,$replace=false) {
		$values = $fields = array();
		foreach ($data as $key=>$val){
			$value = $this->parseValue($val);
			if(is_scalar($value)) { // 过滤非标量数据
				$values[] = $value;
				$fields[] = $this->parseKey($key);
			}
		}
		$sql   =  ($replace?'REPLACE':'INSERT').' INTO '.$this->parseTable($table).' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')';
		return $this->execute($sql);
	}

	/**
	 *----------------------------------------------------------
	 * 获取最近一次查询的sql语句 
	 *----------------------------------------------------------
	 * @access public
	 * @return string
	 *----------------------------------------------------------
	 */
	public function getLastSql() {
		return $this->queryStr;
	}

	/**
	 *----------------------------------------------------------
	 * 获取最近插入的ID
	 *----------------------------------------------------------
	 * @access public
	 * @return string
	 *----------------------------------------------------------
	 */
	public function getLastInsID() {
		return $this->lastInsID;
	}

	/**
	 *----------------------------------------------------------
	 * 获取最近的错误信息
	 *----------------------------------------------------------
	 * @access public
	 * @return string
	 *----------------------------------------------------------
	 */
	public function getError() {
		return $this->error;
	}

}