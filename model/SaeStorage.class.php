<?php
/**
 * SAE数据存储服务
 *
 * @author quanjun
 * @version $Id$
 * @package sae
 *
 */

/**
 * SaeStorage class
 *
 * <code>
 * $s = new SaeStorage();
 * $s->write( 'example' , 'thebook' , 'bookcontent!' );
 * 
 * echo $s->read( 'example' , 'thebook') ; 
 * // will echo 'bookcontent!';
 *
 * echo $s->getUrl( 'example' , 'thebook' );
 * // will echo 'http://exampale.stor.sinaapp.com/thebook';
 *
 *</code>
 *
 * 常见错误码参考：
 *  - errno: 0		 成功
 *  - errno: -2		配额统计错误
 *  - errno: -3		权限不足
 *  - errno: -12	存储服务器返回错误
 *  - errno: -18	 文件不存在
 *  - errno: -101	参数错误
 *  - errno: -102	存储服务器连接失败
 * 
 * @package sae
 * @author  quanjun
 * 
 */

class SaeStorage extends SaeObject 
{
	/**
	 * 用户accessKey
	 * @var string
	 */
	private $accessKey = '';
	/**
	 * 用户secretKey
	 * @var string
	 */
	private $secretKey = '';
	/**
	 * 运行过程中的错误信息
	 * @var string
	 */
	private $errMsg = 'success';
	/**
	 * 运行过程中的错误代码
	 * @var int
	 */
	private $errNum = 0;
	/**
	 * 应用名
	 * @var string
	 */
	private $appName = '';
	/**
	 * @var string
	 */
	private $restUrl = '';
	/**
	 * @var string
	 */
	private $filePath= '';
	/**
	 * 运行过程中的错误信息
	 * @var string
	 */
	private $basedomain = 'stor.sinaapp.com';
	/**
	 * 该类所支持的所有方法
	 * @var array
	 * @ignore
	 */
	protected $_optUrlList = array(
		"uploadfile"=>'?act=uploadfile&ak=_AK_&sk=_SK_&dom=_DOMAIN_&destfile=_DESTFILE_&attr=_ATTR_',
		"getdomfilelist"=>'?act=getdomfilelist&ak=_AK_&sk=_SK_&dom=_DOMAIN_&prefix=_PREFIX_&limit=_LIMIT_&skip=_SKIP_',
		"getfileattr"=>'?act=getfileattr&ak=_AK_&sk=_SK_&dom=_DOMAIN_&filename=_FILENAME_&attrkey=_ATTRKEY_',
		"getfilecontent"=>'?act=getfilecontent&ak=_AK_&sk=_SK_&dom=_DOMAIN_&filename=_FILENAME_',
		"delfile"=>'?act=delfile&ak=_AK_&sk=_SK_&dom=_DOMAIN_&filename=_FILENAME_',
		"getdomcapacity"=>'?act=getdomcapacity&ak=_AK_&sk=_SK_&dom=_DOMAIN_',
		"setdomattr"=>'?act=setdomattr&ak=_AK_&sk=_SK_&dom=_DOMAIN_&attr=_ATTR_',
		"setfileattr"=>'?act=setfileattr&ak=_AK_&sk=_SK_&dom=_DOMAIN_&filename=_FILENAME_&attr=_ATTR_',
	);
	/**
	 * 构造函数
	 * $_accessKey与$_secretKey可以为空，为空的情况下可以认为是公开读文件
	 * @param string $_accessKey
	 * @param string $_secretKey
	 * @return void
	 * @author Elmer Zhang
	 */
	public function __construct( $_accessKey='', $_secretKey='' )
	{
		if( $_accessKey== '' ) $_accessKey = SAE_ACCESSKEY;
		if( $_secretKey== '' ) $_secretKey = SAE_SECRETKEY;

		$this->setAuth( $_accessKey, $_secretKey );
	}

	/**
	 * 设置key
	 *
	 * 当需要访问其他APP的数据时使用
	 *
	 * @param string $akey 
	 * @param string $skey 
	 * @return void
	 * @author Elmer Zhang
	 */
	public function setAuth( $akey , $skey )
	{
		$this->initOptUrlList( $this->_optUrlList);
		$this->init( $akey, $skey );
	}

	/**
	 * 返回运行过程中的错误信息
	 *
	 * @return string
	 * @author Elmer Zhang
	 */
	public function errmsg()
	{
		$ret = $this->errMsg."url(".$this->filePath.")";
		$this->restUrl = '';
		$this->errMsg = 'success!';
		return $ret;
	}

	/**
	 * 返回运行过程中的错误代码
	 *
	 * @return int
	 * @author Elmer Zhang
	 */
	public function errno()
	{
		$ret = $this->errNum;
		$this->errNum = 0;
		return $ret;
	}

	/**
	 * 取得访问存储文件的url
	 *
	 * @param string $domain 
	 * @param string $filename 
	 * @return string
	 * @author Elmer Zhang
	 */
	public function getUrl( $domain, $filename ) {

		// make it full domain
		$domain = trim($domain);
		$filename = trim($filename);
		$domain = $this->getDom($domain);

		$this->filePath = "http://".$domain.'.'.$this->basedomain . "/$filename";
		return $this->filePath;
	}

	/**
	 * @ignore
	 */
	protected function setUrl( $domain , $filename )
	{
		$domain = trim($domain);
		$filename = trim($filename);

		$this->filePath = "http://".$domain.'.'.$this->basedomain . "/$filename";
	}

	/**
	 * 将数据写入存储
	 *
	 * @param string $domain 存储域,在在线管理平台.storage页面可进行管理
	 * @param string $destFile 文件名 
	 * @param string $content 文件内容,支持二进制数据 
	 * @param int $size 写入长度,默认为不限制
	 * @param array $attr 文件属性，可设置的属性请参考 SaeStorage::setFileAttr() 方法
	 * @return string 写入成功时返回该文件的下载地址，否则返回false
	 * @author Elmer Zhang
	 */
	public function write( $domain, $destFile, $content, $size=-1, $attr=array(), $compress = false )
	{
		if ( Empty( $domain ) || Empty( $destFile ) || Empty( $content ) )
		{
			$this->errMsg = 'the value of parameter (domain,destFile,content) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		if ( $size > -1 )
			$content = substr( $content, 0, $size );

		$srcFile = tempnam(SAE_TMP_PATH, 'SAE_STOR_UPLOAD');
		if ($compress) {
			file_put_contents("compress.zlib://" . $srcFile, $content);
		} else {
			file_put_contents($srcFile, $content);
		}

		$re = $this->upload($domain, $destFile, $srcFile, $attr);
		unlink($srcFile);
		return $re;
	}

	/**
	 * 将文件上传入存储
	 *
	 * @param string $domain 存储域,在在线管理平台.storage页面可进行管理
	 * @param string $destFile 目标文件名
	 * @param string $srcFile 源文件名
	 * @param array $attr 文件属性，可设置的属性请参考 SaeStorage::setFileAttr() 方法
	 * @return string 写入成功时返回该文件的下载地址，否则返回false
	 * @author Elmer Zhang
	 */
	public function upload( $domain, $destFile, $srcFile, $attr = array(), $compress = false )
	{
		$domain = trim($domain);
		$destFile = trim($destFile);

		if ( Empty( $domain ) || Empty( $destFile ) || Empty( $srcFile ) )
		{
			$this->errMsg = 'the value of parameter (domain,destFile,srcFile) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		if ($compress) {
			$srcFileNew = tempnam(SAE_TMP_PATH, 'SAE_STOR_UPLOAD');
			file_put_contents("compress.zlib://" . $srcFileNew, file_get_contents($srcFile));
			$srcFile = $srcFileNew;
		}

		// make it full domain
		$domain = $this->getDom($domain);
		$parseAttr = $this->parseFileAttr($attr);

		$this->setUrl( $domain, $destFile );

		$urlStr = $this->optUrlList['uploadfile'];
		$urlStr = str_replace( '_DOMAIN_', $domain , $urlStr );
		$urlStr = str_replace( '_DESTFILE_', $destFile, $urlStr );
		$urlStr = str_replace( '_ATTR_', urlencode(json_encode($parseAttr)), $urlStr );
		$postData = array( 'srcFile'=>"@{$srcFile}" );
		$ret = $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr, $postData ) );
		if ( $ret !== false )
			return $this->filePath;
		else
			return false;
	}


	/**
	 * 获取指定domain下的文件名列表
	 *
	 * <code>
	 * //遍历Domain下所有文件
	 * $stor = new SaeStorage();
	 *
	 * $num = 0;
	 * while ( $ret = $obj->getList("test", "*", 100, $num ) ) { 
	 *		 foreach($ret as $file) {
	 *			 echo "{$file}\n";
	 *			 $num ++; 
	 *		 }   
	 * }
	 * 
	 * echo "\nTOTAL: {$num} files\n";
	 * </code>
	 *
	 * @param string $domain	存储域,在在线管理平台.storage页面可进行管理
	 * @param string $prefix	如 *,abc*,*.txt
	 * @param int $limit		返回条数,最大100条,默认10条
	 * @param int $skip			起始条数。
	 * @return array 执行成功时返回文件列表数组，否则返回false
	 * @author Elmer Zhang
	 */
	public function getList( $domain, $prefix='*', $limit=10, $skip = 0 )
	{
		$domain = trim($domain);

		//echo $prefix;
		if ( Empty( $domain ) )
		{
			//echo "f=".__FILE__.",l=".__LINE__."<br>";
			$this->errMsg = 'the value of parameter (domain,filename) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		// add prefix
		$domain = $this->getDom($domain);

		$urlStr = $this->optUrlList['getdomfilelist'];

		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );

		$urlStr = str_replace( '_PREFIX_', $prefix, $urlStr );

		$urlStr = str_replace( '_LIMIT_', $limit, $urlStr );

		$urlStr = str_replace( '_SKIP_', $skip, $urlStr );

		return $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
	}

	/**
	 * 获取文件属性
	 *
	 * @param string $domain 
	 * @param string $filename 
	 * @param array $attrKey 属性值,如 array("fileName", "length")，当attrKey为空时，以关联数组方式返回该文件的所有属性。
	 * @return array
	 * @author Elmer Zhang
	 */
	public function getAttr( $domain, $filename, $attrKey=array() )
	{
		$domain = trim($domain);
		$filename = trim($filename);

		if ( Empty( $domain ) || Empty( $filename ) )
		{
			$this->errMsg = 'the value of parameter (domain,filename) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		// make it full domain
		$domain = $this->getDom($domain);

		$this->setUrl( $domain, $filename );

		$urlStr = $this->optUrlList['getfileattr'];
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$urlStr = str_replace( '_FILENAME_', $filename, $urlStr );
		$urlStr = str_replace( '_ATTRKEY_', urlencode( json_encode( $attrKey ) ), $urlStr );
        //print_r( $urlStr );
		$ret = $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
        echo $ret;
		if ( is_object( $ret ) )
			return (array)$ret;
		else
			return $ret;
	}

	/**
	 * 获取文件的内容
	 *
	 * @param string $domain 
	 * @param string $filename 
	 * @return mixxed 文件内容
	 * @author Elmer Zhang
	 */
	public function read( $domain, $filename )
	{
		$domain = trim($domain);
		$filename = trim($filename);

		if ( Empty( $domain ) || Empty( $filename ) )
		{
			$this->errMsg = 'the value of parameter (domain,filename) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		//echo $this->getUrl( $domain , $filename );

		// make it full domain
		$domain = $this->getDom($domain);

		$this->setUrl( $domain, $filename );
		$urlStr = $this->optUrlList['getfilecontent'];
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$urlStr = str_replace( '_FILENAME_', $filename, $urlStr );

		$ret =  $this->getJsonContentsAndDecode( $urlStr );
		if ( is_array($ret) && isset( $ret['errno'] ) )
		{
			$this->parseRetData( $ret );
			return false;			
		}
		//var_dump($ret);
		return $ret;
	}

	/**
	 * 删除文件
	 *
	 * @param string $domain 
	 * @param string $filename 
	 * @return bool
	 * @author Elmer Zhang
	 */
	public function delete( $domain, $filename )
	{
		$domain = trim($domain);
		$filename = trim($filename);

		if ( Empty( $domain ) || Empty( $filename ) )
		{
			$this->errMsg = 'the value of parameter (domain,filename) can not be empty!';
			$this->errNum = -101;
			return false;
		}

		// make it full domain
		$domain = $this->getDom($domain);

		$this->setUrl( $domain, $filename );
		$urlStr = $this->optUrlList['delfile'];
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$urlStr = str_replace( '_FILENAME_', $filename, $urlStr );
		$ret = $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
		if ( $ret === false )
			return false;
		if ( $ret[ 'errno' ] == 0 )
			return true;
		else
			return false;
	}


	/**
	 * 设置文件属性
	 *
	 * 目前支持的文件属性
	 *  - expires: 浏览器缓存超时，功能与Apache的Expires配置相同
	 *  - encoding: 设置通过Web直接访问文件时，Header中的Content-Encoding。
	 *  - type: 设置通过Web直接访问文件时，Header中的Content-Type。
	 *
	 * <code>
	 * $stor = new SaeStorage();
	 * 
	 * $attr = array('expires' => 'access plus 1 year');
	 * $ret = $stor->setFileAttr("test", "test.txt", $attr);
	 * if ($ret === false) {
	 *		 var_dump($stor->errno(), $stor->errmsg());
	 * }
	 *
	 * $attr = array('expires' => 'A3600');
	 * $ret = $stor->setFileAttr("test", "expire/*.txt", $attr);
	 * if ($ret === false) {
	 *		 var_dump($stor->errno(), $stor->errmsg());
	 * }
	 * </code>
	 *
	 * @param string $domain 
	 * @param string $filename	 文件名，可以使用通配符"*"和"?"
	 * @param array $attr		 文件属性。格式：array('attr0'=>'value0', 'attr1'=>'value1', ......);
	 * @return bool
	 * @author Elmer Zhang
	 */
	public function setFileAttr( $domain, $filename, $attr = array() )
	{
		$domain = trim($domain);
		$filename = trim($filename);

		if ( Empty( $domain ) || Empty( $filename ) )
		{
			$this->errMsg = 'the value of parameter domain,filename can not be empty!';
			$this->errNum = -101;
			return false;
		}

		$parseAttr = $this->parseFileAttr($attr);
		if ($parseAttr == false) {
			return false;
		}

		// make it full domain
		$domain = $this->getDom($domain);

		$urlStr = $this->optUrlList['setfileattr'];
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$urlStr = str_replace( '_FILENAME_', $filename, $urlStr );
		$urlStr = str_replace( '_ATTR_', urlencode( json_encode( $parseAttr ) ), $urlStr );
		$ret = $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
		if ( $ret === true )
			return true;
		if ( is_array($ret) && $ret[ 'errno' ] === 0 )
			return true;
		else
			return false;
	}
	/**
	 * 设置Domain属性
	 *
	 * 目前支持的Domain属性
	 *  - expires: 浏览器缓存超时，功能与Apache的Expires配置相同
	 *
	 * <code>
	 * $expires = 'ExpiresActive On
	 * ExpiresDefault "access plus 30 days"
	 * ExpiresByType text/html "access plus 1 month 15 days 2 hours"
	 * ExpiresByType image/gif "modification plus 5 hours 3 minutes"
	 * ExpiresByType image/jpg A2592000
	 * ExpiresByType text/plain M604800
	 * ';
	 *
	 * $stor = new SaeStorage();
	 * 
	 * $attr = array('expires'=>$expires);
	 * $ret = $stor->setDomainAttr("test", $attr);
	 * if ($ret === false) {
	 *		 var_dump($stor->errno(), $stor->errmsg());
	 * }
	 *
	 * </code>
	 *
	 * @param string $domain 
	 * @param array $attr		 Domain属性。格式：array('attr0'=>'value0', 'attr1'=>'value1', ......);
	 * @return bool
	 * @author Elmer Zhang
	 */
	public function setDomainAttr( $domain, $attr = array() )
	{
		$domain = trim($domain);

		if ( Empty( $domain ) )
		{
			$this->errMsg = 'the value of parameter domain can not be empty!';
			$this->errNum = -101;
			return false;
		}

		// make it full domain
		$domain = $this->getDom($domain);

		$parseAttr = $this->parseDomainAttr($attr);
		if ($parseAttr == false) {
			return false;
		}

		$urlStr = $this->optUrlList['setdomattr'];
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$urlStr = str_replace( '_ATTR_', urlencode( json_encode( $parseAttr ) ), $urlStr );
		//print_r( $urlStr );
		$ret = $this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
		if ( $ret === true )
			return true;
		if ( is_array($ret) && $ret['errno'] === 0 )
			return true;
		else
			return false;
	}


	// =================================================================

	/**
	 * @ignore
	 */
	protected function parseDomainAttr($attr) {
		$parseAttr = array();

		if ( !is_array( $attr ) || empty( $attr ) ) {
			$this->errMsg = 'the value of parameter attr must be an array, and can not be empty!';
			$this->errNum = -101;
			return false;
		}

		foreach ( $attr as $k => $a ) {
			switch ( strtolower( $k ) ) {
				case 'expires':
					$parseAttr['expires'] = $this->parseExpires($a);
					break;
				default;
					break;
			}
		}

		return $parseAttr;
	}

	/**
	 * @ignore
	 */
	protected function parseFileAttr($attr) {
		$parseAttr = array();

		if ( !is_array( $attr ) || empty( $attr ) ) {
			$this->errMsg = 'the value of parameter attr must be an array, and can not be empty!';
			$this->errNum = -101;
			return false;
		}

		foreach ( $attr as $k => $a ) {
			switch ( strtolower( $k ) ) {
				case 'expires':
					$parseAttr['expires'] = $a;
					break;
				case 'encoding':
					$parseAttr['encoding'] = $a;
					break;
				case 'type':
					$parseAttr['type'] = $a;
					break;
				default;
					break;
			}
		}

		return $parseAttr;
	}

	/**
	 * @ignore
	 */
	protected function parseExpires($expires) {
		$expires = trim($expires);
		$expires_arr = array();
		$expires_arr['active'] = 1;

		$expires = preg_split("/(\n|\r\n)/", $expires);
		if (is_array($expires) && !empty($expires)) {
			foreach ($expires as $e) {
				$e = trim($e);
				if ( preg_match("/^ExpiresActive\s+(on|off)$/i", strtolower($e), $matches) ) { 
					if ($matches[1] == "on") {
						$expires_arr['active'] = 1;
					} else {
						$expires_arr['active'] = 0;
					}
				} elseif ( preg_match("/^ExpiresDefault\s+(A\d+|M\d+|\"(.+)\")$/i", $e, $matches) ) { 
					if (isset($matches[2])) {
						$expires_arr['default'] = $matches[2];
					} else {
						$expires_arr['default'] = $matches[1];
					}
				} elseif ( preg_match("/^ExpiresByType\s+(?P<type>.+)\s+(?P<expires>A\d+|M\d+|\"(.+)\")$/i", $e, $matches) ) { 
					if (isset($matches[3])) {
						$expires_arr['byType'][strtolower($matches['type'])] = $matches[3];
					} else {
						$expires_arr['byType'][strtolower($matches['type'])] = $matches[2];
					}
				}
			}
		}

		return $expires_arr;
	}

	/**
	 * @ignore
	 */	
	protected function initOptUrlList( $_optUrlList=array() )
	{
		$this->optUrlList = array();
		$this->optUrlList = $_optUrlList;

		while ( current( $this->optUrlList ) !== false ) {
			$this->optUrlList[ key( $this->optUrlList ) ] = SAE_STOREHOST.current($this->optUrlList);
			next( $this->optUrlList );
		}

		reset( $this->optUrlList );
		//$this->init( $this->accessKey, $this->secretKey );



	}
	/**
	 * 构造函数运行时替换所有$this->optUrlList值里的accessKey与secretKey 
	 * @param string $_accessKey
	 * @param string $_secretKey
	 * @return void
	 * @ignore
	 */ 
	protected function init( $_accessKey, $_secretKey )
	{
		$_accessKey = trim($_accessKey);
		$_secretKey = trim($_secretKey);

		$this->appName = $_SERVER[ 'HTTP_APPNAME' ];
		$this->accessKey = $_accessKey;
		$this->secretKey = $_secretKey;
		while ( current( $this->optUrlList ) !== false )
		{
			$this->optUrlList[ key( $this->optUrlList ) ] = str_replace( '_AK_', $this->accessKey, current( $this->optUrlList ) );
			$this->optUrlList[ key( $this->optUrlList ) ]= str_replace( '_SK_', $this->secretKey, current( $this->optUrlList ) );
			//echo "l=".$this->optUrlList[ key( $this->optUrlList ) ] ."<br>";
			next( $this->optUrlList );
		}


		reset( $this->optUrlList );
	}

	/**
	 * 最终调用server端方法的rest函数封装
	 * @ignore
	 */
	protected function getJsonContentsAndDecode( $url, $postData = array() ) //获取对应URL的JSON格式数据并解码
	{
		if( empty( $url ) )
			return false;
		$this->restUrl = $url;
		//echo "$url\n";
		$ch=curl_init();

		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HTTPGET, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );


		if ( !Empty( $postData ) )
		{
			curl_setopt($ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
		}


		curl_setopt( $ch, CURLOPT_USERAGENT, 'SAE Online Platform' );
		$content=curl_exec( $ch );
		curl_close($ch);
		if( false !== $content )
		{
			//print_r( $content ."\n");
			$tmp = json_decode( $content , true);
			if ( Empty( $tmp ) )//若非结构数据则直接抛出数据源
				return $content;
			else
				return $tmp;
		}
		else
			return array( 'errno'=>-102, 'errmsg'=>'bad request' );
	}

	/**
	 * 解析并验证server端返回的数据结构
	 * @ignore
	 */
	public function parseRetData( $retData = array() )
	{
		//	print_r( $retData );
		if ( !isset( $retData['errno'] ) || !isset( $retData['errmsg'] ) )
		{
			//	print_r( $retData );
			$this->errMsg = 'bad request';
			$this->errNum = -12;
			return false;
		}
		if ( $retData['errno'] !== 0 )
		{
			$this->errMsg = $retData[ 'errmsg' ];
			$this->errNum = $retData['errno'];
			return false;
		}
		if ( isset( $retData['data'] ) )
			return $retData['data'];
		return $retData;
	}

	/**
	 * 获取domain所占存储的大小
	 *
	 * @param string $domain 
	 * @return int
	 * @author Elmer Zhang
	 * @ignore
	 */
	public function getDomainCapacity( $domain='' )
	{
		$domain = trim($domain);

		if ( Empty( $domain ) )
		{
			$this->errMsg = 'the value of parameter \'$domain\' can not be empty!';
			$this->errNum = -101;
			return false;
		}

		// make it full domain
		$domain = $this->getDom($domain);

		$urlStr = $this->optUrlList['getdomcapacity'];
		//print_r( $urlStr );
		$urlStr = str_replace( '_DOMAIN_', $domain, $urlStr );
		$ret = (array)$this->parseRetData( $this->getJsonContentsAndDecode( $urlStr ) );
		if ( $ret[ 'errno' ] == 0 )
			return $ret['data'];
		else
			return false;
	}

	/**
	 * domain拼接
	 * @param string $domain
	 * @param bool $concat
	 * @return string
	 * @author Elmer Zhang
	 * @ignore
	 */
	protected function getDom($domain, $concat = true) {
		$domain = trim($domain);

		if ($concat) {
			if( isset($_SERVER['HTTP_APPNAME']) && strpos($domain, '.') === false ) {
				$domain = $_SERVER['HTTP_APPNAME'] .'-'. $domain;
			}
		} else {
			if ( ( $pos = strpos($domain, '-') ) !== false ) {
				$domain = substr($domain, $pos + 1);
			}
		}
		return $domain;
	}
}