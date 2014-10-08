<?php



		$text_unicode = '\u4eca\u5929';
		$text_utf8 = '今天';
		
		echo iconv('GB2312', 'GBK', "中文");
		echo "<br/>===<br/>";
		echo iconv('UCS-2BE', 'GBK', '\u4eca\u5929');
		echo "<br/>===<br/><br/>";
		
		
		echo mb_convert_encoding("中文", "UTF-8", "GBK");
		echo "<br/>===<br/><br/>";
		
		echo preg_replace("#\\\u([0-9a-f]{4}+)#ie", "iconv('UCS-2BE', 'GB2312', pack('H4', '\\1'))", $text_unicode);
		 
		
		echo "<br/><br/>===<br/>";










 echo "
 1, UCS-2 不等于 UTF-16。 UTF-16 每个字节使用 ASCII 字符范围编码，而 UCS-2 对每个字节的编码可以超出 ASCII 字符范围。UCS-2 和 UTF-16 对每个字符至多占两个字节，但是他们的编码是不一样的。
 <br/>
2, 对于 UCS-2, windows 下默认是 UCS-2LE。用 MultibyteToWidechar（或者A2W）生成的是 UCS-2LE 的 unicode。windows记事本可以将文本保存为 UCS-2BE，相当于多了层转换。
 <br/>
3, 对于 UCS-2, linux 下默认是 UCS-2BE。用iconv(指定UCS-2)来转换生成的是 UCS-2BE 的 unicode。如果转换windows平台过来的 UCS-2, 需要指定 UCS-2LE。
 <br/>
4, 鉴于windows和linux等多个平台对 UCS-2 的理解不同（UCS-2LE,UCS-2BE）。MS 主张 unicode 有个引导标志(UCS-2LE FFFE, UCS-2BE FEFF)，以表明下面的字符是 unicode 并且判别 big-endian 或 little-endian。 所以从 windows 平台过来的数据发现有这个前缀，不用慌张。
 <br/>
5, linux 的编码输出，比如从文件输出，从 printf 输出，需要控制台做适当的编码匹配（如果编码不匹配，一般和该程序编译时的编码有若干关系），而控制台的转换输入需要查看当前的系统编码。比如控制台当前的编码是 UTF-8, 那么 UTF-8 编码的东西能正确显示，GBK 就不能；同样，当前编码是 GBK, 就能显示 GBK 编码，后来的系统应该更智能的处理好更多的转换了。不过通过 putty 等终端还是需要设置好终端的编码转换以解除乱码的烦恼。
<br/><br/><br/>";
 
function unescape($str) {
    $str = rawurldecode($str);
    preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);
    $ar = $r[0];
    //print_r($ar);
    foreach($ar as $k=>$v) {
        if(substr($v,0,2) == "%u"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
  }
        elseif(substr($v,0,3) == "&#x"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
  }
        elseif(substr($v,0,2) == "&#") {
             
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
        }
    }
    return join("",$ar);
}
echo unescape("紫星蓝").'<br/><br/><br/>';
 
 function unicode_encode_1($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0)
        {    // 两个字节的文字
            $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}
$name = 'MY,你大爷的';
$unicode_name=unicode_encode_1($name);
echo '<h3>'.$unicode_name.'</h3><br/><br/><br/>';

// 将UNICODE编码后的内容进行解码
function unicode_decode_1($name)
{
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}
echo 'MY,\u4f60\u5927\u7237\u7684 -> '.unicode_decode_1($unicode_name).'<br/><br/><br/>';
 
 
echo '--------------------------------------------------------------------------------------------------<br/><br/><br/>';
 
 
/**
 * $str 原始中文字符串
 * $encoding 原始字符串的编码，默认GBK
 * $prefix 编码后的前缀，默认"&#"
 * $postfix 编码后的后缀，默认";"
 */
function unicode_encode($str, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
    $str = iconv($encoding, 'UCS-2', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    } 
    return $unistr;
} 
 
/**
 * $str Unicode编码后的字符串
 * $decoding 原始字符串的编码，默认GBK
 * $prefix 编码字符串的前缀，默认"&#"
 * $postfix 编码字符串的后缀，默认";"
 */
function unicode_decode($unistr, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
    $arruni = explode($prefix, $unistr);
    $unistr = '';
    for($i = 1, $len = count($arruni); $i < $len; $i++) {
        if (strlen($postfix) > 0) {
            $arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
        } 
        $temp = intval($arruni[$i]);
        $unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
    } 
    return iconv('UCS-2', $encoding, $unistr);
}

//GBK字符串测试
$str = '<b>哈哈</b>';
echo $str.'<br />';
 
$unistr = unicode_encode($str);
echo $unistr.'<br />'; // &#60;&#98;&#62;&#21704;&#21704;&#60;&#47;&#98;&#62;
 
$str2 = unicode_decode($unistr);
echo $str2.'<br />'; //<b>哈哈</b>
 
//UTF-8字符串测试
$utf8_str = iconv('GBK', 'UTF-8', $str);
echo $utf8_str.'<br />'; // <b>鍝堝搱</b> 注：UTF在GBK下显示的乱码！可切换浏览器的编码测试
 
$utf8_unistr = unicode_encode($utf8_str, 'UTF-8');
echo $utf8_unistr.'<br />'; // &#60;&#98;&#62;&#21704;&#21704;&#60;&#47;&#98;&#62;
 
$utf8_str2 = unicode_decode($utf8_unistr, 'UTF-8');
echo $utf8_str2.'<br />'; // <b>鍝堝搱</b>
 
//其它后缀、前缀测试
echo $str.' -- unicode_encode : <br />';
$prefix_unistr = unicode_encode($str, 'GBK', "\\u", '');
echo $prefix_unistr.'<br /><br />'; // \u60\u98\u62\u21704\u21704\u60\u47\u98\u62
 
echo $prefix_unistr.' -- unicode_decode : <br />';
$profix_unistr2 = unicode_decode($prefix_unistr, 'GBK', "\\u", '');
echo $profix_unistr2.'<br /><br />'; //<b>哈哈</b>

?>