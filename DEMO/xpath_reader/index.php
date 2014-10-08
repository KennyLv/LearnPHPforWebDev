<?php

//����������
header("Access-Control-Allow-Origin: *");
header("Content-type: text/html; charset=utf-8"); 
?>

<?php
/*
$file=file_get_contents('http://localhost:8056/LearnPHPforWebDev/DEMO/xpath_reader/htmlfile.html'); 
echo $file; 
*/

//echo "ʹ�� DOM ��������ȡ Web ҳ��� SimpleXML �汾";
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
//echo "��1����file_get_contents ��get��ʽ��ȡ���ݡ�";

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
//echo "��2����fopen��url, ��get��ʽ��ȡ���ݡ�";
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
//echo "��3����file_get_contents��������post��ʽ��ȡurl��";
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
//echo "��4����fsockopen������url����get��ʽ��ȡ���������ݣ�����header��body��";
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
//��ȡurl��html���֣�ȥ��header
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
//echo "��5����fsockopen������url����POST��ʽ��ȡ���������ݣ�����header��body��";
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
//echo "��6��ʹ��curl�⣬curl����Ҫ��php.ini�п���curl��չ��";
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
//echo _url($url); //������� 
*/

//echo "����curl�⣺curl�ٷ���վhttp://curl.haxx.se/";
//echo "curl ��ʹ��URL�﷨�Ĵ����ļ����ߣ�֧��FTP��FTPS��HTTP HTPPS SCP SFTP TFTP TELNET DICT FILE��LDAP��curl ֧��SSL֤�顢HTTP POST��HTTP PUT ��FTP �ϴ���kerberos������HTT��ʽ���ϴ�������cookie���û�������֤�����ļ����ͻָ���http����ͨ���ʹ����������õļ��ɡ�";
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
//echo "7����Щ�����̹ص���php��allow_url_fopenѡ���ʱ�޷�ֱ��ʹ��file_get_contents��ȡԶ��webҳ������ݡ���ʱ����ʹ�ú���curl��������file_get_contents��curl��������ʵ��ͬ�����ܵĲ�ͬ������<br/>";
//echo "file_get_contents����:";
/*
$file_contents = file_get_contents('http://www.jbxue.com/');
//echo $file_contents;
*/
//echo "curl����:";
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
//echo "��רҵ���ʵ�ִ��룬��function_exists�������ж�ĳ�����Ƿ���ڣ�Ȼ��ȷ�����ĸ�������ʵ�֡�";
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
//echo "�и���Ƶ�����Ҫ�����㣬�����������̰�file_get_contents��curl���ر��ˣ����ϵĺ����ᱨ���Ŷ��";
?>



