<?php

echo "<br/><br/>--------------------------_SERVER['REMOTE_ADDR']--------------------------------<br/>";
// Or simply use a Superglobal ($_SERVER or $_ENV)
$iipp=$_SERVER["REMOTE_ADDR"];
echo $iipp;


echo "<br/><br/>-----------------------getenv('REMOTE_ADDR')------------------------------------<br/>";
// Example use of getenv()
$ip = getenv('REMOTE_ADDR');
echo $ip;


echo "<br/><br/>-------_SERVER['HTTP_VIA']----------------_SERVER['HTTP_X_FORWARDED_FOR'] ----------------_SERVER['REMOTE_ADDR']--------------------<br/>";
$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
echo $user_IP;


echo "<br/><br/>----------_SERVER['HTTP_CLIENT_IP']-----------------_SERVER['HTTP_X_FORWARDED_FOR']-------------_SERVER['REMOTE_ADDR']-------------------<br/>";
function get_real_ip(){
		$_ip=false;
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
				$_ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
				if ($_ip) { 
						array_unshift($ips, $_ip); 
						$_ip = FALSE; 
				}
				for ($i = 0; $i < count($ips); $i++) {
						if (!eregi ("^(10|172/.16|192/.168)/.", $ips[$i])) {
								$_ip = $ips[$i];
								break;
						}
				}
		}
		return ($_ip ? $_ip : $_SERVER['REMOTE_ADDR']);
}
echo get_real_ip();


echo "<br/><br/>-----------------------------------------------------------<br/>";
if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]){
		$iip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
}elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"]){
		$iip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
}elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"]){
		$iip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
}elseif (getenv("HTTP_X_FORWARDED_FOR")){
		$iip = getenv("HTTP_X_FORWARDED_FOR");
}elseif (getenv("HTTP_CLIENT_IP")){
		$iip = getenv("HTTP_CLIENT_IP");
}elseif (getenv("REMOTE_ADDR")){
		$iip = getenv("REMOTE_ADDR");
}else{
		$iip = "Unknown";
}
echo "你的IP:".$iip ;


echo "<br/><br/>-----------------------------------------------------------<br/>";
function get_userip(){
		if($_SERVER[HTTP_X_FORWARDED_FOR]==''){
				if($_SERVER[HTTP_REMOTE_ADDR]==''){
						$userip=$_SERVER[HTTP_CLIENT_IP];  
				} else  { 
						$userip=$_SERVER[HTTP_REMOTE_ADDR];
				}
		}  else {
				$userip=$_SERVER[HTTP_X_FORWARDED_FOR];
		}
		return $userip;
}
echo get_userip();


echo "<br/><br/>-----------------------------------------------------------<br/>";
if(getenv('HTTP_CLIENT_IP')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR')) {
		$onlineip = getenv('REMOTE_ADDR');
} else {
		$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
}
echo $onlineip;


echo "<br/><br/>-----------------------------------------------------------<br/>";
echo "但是当Web服务器API是ASAPI (IIS)的时候，getenv函数是不起作用的。";
echo "这种情况下你如果用getenv来取得用户客户端ip的话，得到的将是错误的ip地址。";
echo "因此更为安全和准确的方法是尽量避免使用getenv函数。";



echo "<br/><br/>-----------------------------------------------------------<br/>";
//Get the real client IP ("bullet-proof")
function GetIP(){
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
				$ipp = getenv("HTTP_CLIENT_IP");
		} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
				$ipp = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
				$ipp = getenv("REMOTE_ADDR");
		} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
				$ipp = $_SERVER['REMOTE_ADDR'];
		} else{
				$ipp = "unknown";
		}
		return($ipp);
}
echo GetIP();

/*
echo "<br/><br/>-----------------------------------------------------------<br/>";
$ipe=explode(".",$ip);
print_r($ipe);
if ($ipe[0]==172){ 
		//Header("Location: http://www.baidu.com");
}else{ 
		//Header("Location: http://www.126.com"); 
}
echo "<br/>-----------------------------------------------------------<br/>";
*/
?>