<?php

//允许跨域访问
header("Access-Control-Allow-Origin: *");
header("Content-type: text/html; charset=utf-8"); 
?>

<?php
/*
$file=file_get_contents('http://localhost:8056/LearnPHPforWebDev/DEMO/xpath_reader/htmlfile.html'); 
echo $file; 
*/

//echo "使用 DOM 方法来获取 Web 页面的 SimpleXML 版本";
$dom = new DOMDocument();
$dom->loadHTMLFile('http://localhost:8056/LearnPHPforWebDev/DEMO/xpath_reader/htmlfile.html');
//$dom = iconv('utf-8', 'gb2312', $dom);
$xml = simplexml_import_dom($dom);

$Countries_Regions_En = $xml->xpath('//tbody/tr[1]/th[1]/font');
$Countries_Regions_Ch = $xml->xpath('//tbody/tr[1]/th[2]/font');
$Countries_Regions_short = $xml->xpath('//tbody/tr[1]/th[3]/font');
$Countries_Regions_phone = $xml->xpath('//tbody/tr[1]/th[4]/font');
$Countries_Regions_timediff = $xml->xpath('//tbody/tr[1]/th[5]/font');
/*
echo $Countries_Regions_En[0]."<br/>";
echo $Countries_Regions_Ch[0]."<br/>";
echo $Countries_Regions_short[0]."<br/>";
echo $Countries_Regions_phone[0]."<br/>";
echo $Countries_Regions_timediff[0]."<br/>";
*/
/*
$ths = $xml->xpath('//tbody/tr[1]/th/font');
foreach ($ths as $title) {
	echo  $title; // Handle URL iteration here
}
*/
/*
$json_data = array ('id'=>1,'name'=>"mike",'country'=>'usa',"office"=>array("microsoft","oracle"));
echo json_encode($json_data);

$json_string='{"id":1,"name":"mike","country":"usa","office":["microsoft","oracle"]} ';
$obj=json_decode($json_string);

echo $obj->name; //displays mike
echo $obj->office[0]; //displays microsoft

foreach($obj->office as $val){
    echo $val;
}
*/
$json_items = array();

$trs = $xml->xpath('/html/body/div/table/tbody/tr');
foreach ($trs as $tr) {
	if($tr->td){
		$tds = $tr->td;
		
		$json_item_data = array();
		$index = 0;
		
		foreach ($tds as $td) {
			if($td->font){
				$cont = $td->font;
				$json_item_data[$index] = trim($cont."");
			}else{
				$json_item_data[$index] =  trim($td."");
			}
			$index +=1;
		}
		
		array_push($json_items, $json_item_data);
	}
}
echo json_encode( $json_items);



/*
$links = $xml->xpath('//a[@href]');
foreach ($links as $l) {
    $p = parse_url($l['href']);
    if (empty($p['scheme']) || in_array($p['scheme'], array('http', 'https'))) {
        if (empty($p['host']) || ($host == $p['host'])) {
            echo $l['href'], "<br />\n"; // Handle URL iteration here
        }
    }
}
*/




?>


<?php
//echo "例1，用file_get_contents 以get方式获取内容。";

/*$url='http://www.jbxue.com/';
$html = file_get_contents($url);
//print_r($http_response_header);
ec($html);
printhr();
printarr($http_response_header);
printhr();
*/
?>


<?php
//echo "例2，用fopen打开url, 以get方式获取内容。";
/*
$fp = fopen($url, 'r');
printarr(stream_get_meta_data($fp));
printhr();
while(!feof($fp)) {
$result .= fgets($fp, 1024);
}
//echo "url body: $result";
printhr();
fclose($fp);*/
?>

<?php
//echo "例3，用file_get_contents函数，以post方式获取url。";
/*
$data = array ('foo' => 'bar');
$data = http_build_query($data);
$opts = array (
'http' => array (
'method' => 'POST',
'header'=> "Content-type: application/x-www-form-urlencoded" .
"Content-Length: " . strlen($data) . "",
'content' => $data
),
);
$context = stream_context_create($opts);
$html = file_get_contents('http://localhost/e/admin/test.html', false, $context);
//echo $html;
*/
?>


<?php
//echo "例4，用fsockopen函数打开url，以get方式获取完整的数据，包括header和body。";
/*
function get_url ($url,$cookie=false) {
$url = parse_url($url);
$query = $url[path]."?".$url[query];
ec("Query:".$query);
$fp = fsockopen( $url[host], $url[port]?$url[port]:80 , $errno, $errstr, 30);
if (!$fp) {
return false;
} else {
$request = "GET $query HTTP/1.1";
$request .= "Host: $url[host]";
$request .= "Connection: Close";
if($cookie) $request.="Cookie: $cookie\n";
$request.="";
fwrite($fp,$request);
while(!@feof($fp)) {
$result .= @fgets($fp, 1024);
}
fclose($fp);
return $result;
}
}
//获取url的html部分，去掉header
function GetUrlHTML($url,$cookie=false) {
$rowdata = get_url($url,$cookie);
if($rowdata)
{
$body= stristr($rowdata,"");
$body=substr($body,4,strlen($body));
return $body;
}
return false;
}*/
?>


<?php
//echo "例5，用fsockopen函数打开url，以POST方式获取完整的数据，包括header和body。";
/*
function HTTP_Post($URL,$data,$cookie, $referrer="") {
// parsing the given URL
$URL_Info=parse_url($URL);
// Building referrer
if($referrer=="") // if not given use this script as referrer
$referrer="111";
// making string from $data
foreach($data as $key=>$value)
$values[]="$key=".urlencode($value);
$data_string=implode("&",$values);
// Find out which port is needed - if not given use standard (=80)
if(!isset($URL_Info["port"]))
$URL_Info["port"]=80;
// building POST-request:
$request.="POST ".$URL_Info["path"]." HTTP/1.1\n";
$request.="Host: ".$URL_Info["host"]."\n";
$request.="Referer: $referer\n";
$request.="Content-type: application/x-www-form-urlencoded\n";
$request.="Content-length: ".strlen($data_string)."\n";
$request.="Connection: close\n";
$request.="Cookie: $cookie\n";
$request.="\n";
$request.=$data_string."\n";
$fp = fsockopen($URL_Info["host"],$URL_Info["port"]);
fputs($fp, $request);
while(!feof($fp)) {
$result .= fgets($fp, 1024);
}
fclose($fp);
return $result;
}
printhr();
*/
?>


<?php
//echo "例6，使用curl库，curl库需要在php.ini中开启curl扩展。";
/*
$ch = curl_init();
$timeout = 5;
curl_setopt ($ch, CURLOPT_URL, 'http://www.baidu.com/');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
//echo $file_contents;
*/

/*
function _url($Data){ 
    $ch = curl_init(); 
    $timeout = 5; 
    curl_setopt ($ch, CURLOPT_URL, "$Data"); 
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)"); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
    $contents = curl_exec($ch); 
    curl_close($ch); 
    return $contents; 
} 

$url="http://localhost:8056/LearnPHPforWebDev/DEMO/xpath_reader/htmlfile.html"; 
//echo _url($url); //输出内容 
*/

//echo "关于curl库：curl官方网站http://curl.haxx.se/";
//echo "curl 是使用URL语法的传送文件工具，支持FTP、FTPS、HTTP HTPPS SCP SFTP TFTP TELNET DICT FILE和LDAP。curl 支持SSL证书、HTTP POST、HTTP PUT 、FTP 上传，kerberos、基于HTT格式的上传、代理、cookie、用户＋口令证明、文件传送恢复、http代理通道和大量其他有用的技巧。";
/*
function printarr(array $arr)
{
	//echo "<br> Row field count: ".count($arr)."<br>";
	foreach($arr as $key=>$value)
	{
		//echo "$key=$value <br>";
	}
}*/
?>


<?php
//echo "7、有些主机商关掉了php的allow_url_fopen选项，此时无法直接使用file_get_contents获取远程web页面的内容。此时可以使用函数curl。来看看file_get_contents和curl两个函数实现同样功能的不同方法。<br/>";
//echo "file_get_contents函数:";
/*
$file_contents = file_get_contents('http://www.jbxue.com/');
//echo $file_contents;
*/
//echo "curl函数:";
/*
$ch = curl_init();
$timeout = 5;
curl_setopt ($ch, CURLOPT_URL, 'http://www.jbxue.com');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
//echo $file_contents;
*/
?>


<?php
//echo "更专业点的实现代码，用function_exists函数来判断某函数是否存在，然后确定用哪个函数来实现。";
/*
function vita_get_url_content($url) {
if(function_exists('file_get_contents')) {
   $file_contents = file_get_contents($url);
} else {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $file_contents = curl_exec($ch);
  curl_close($ch);
}
return $file_contents;
}*/
?>


<?php
//echo "有个苦逼的事情要告诉你，如果你的主机商把file_get_contents和curl都关闭了，以上的函数会报错的哦。";
?>



