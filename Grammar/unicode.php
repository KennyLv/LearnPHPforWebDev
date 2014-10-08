<?php



		$text_unicode = '\u4eca\u5929';
		$text_utf8 = '����';
		
		echo iconv('GB2312', 'GBK', "����");
		echo "<br/>===<br/>";
		echo iconv('UCS-2BE', 'GBK', '\u4eca\u5929');
		echo "<br/>===<br/><br/>";
		
		
		echo mb_convert_encoding("����", "UTF-8", "GBK");
		echo "<br/>===<br/><br/>";
		
		echo preg_replace("#\\\u([0-9a-f]{4}+)#ie", "iconv('UCS-2BE', 'GB2312', pack('H4', '\\1'))", $text_unicode);
		 
		
		echo "<br/><br/>===<br/>";










 echo "
 1, UCS-2 ������ UTF-16�� UTF-16 ÿ���ֽ�ʹ�� ASCII �ַ���Χ���룬�� UCS-2 ��ÿ���ֽڵı�����Գ��� ASCII �ַ���Χ��UCS-2 �� UTF-16 ��ÿ���ַ�����ռ�����ֽڣ��������ǵı����ǲ�һ���ġ�
 <br/>
2, ���� UCS-2, windows ��Ĭ���� UCS-2LE���� MultibyteToWidechar������A2W�����ɵ��� UCS-2LE �� unicode��windows���±����Խ��ı�����Ϊ UCS-2BE���൱�ڶ��˲�ת����
 <br/>
3, ���� UCS-2, linux ��Ĭ���� UCS-2BE����iconv(ָ��UCS-2)��ת�����ɵ��� UCS-2BE �� unicode�����ת��windowsƽ̨������ UCS-2, ��Ҫָ�� UCS-2LE��
 <br/>
4, ����windows��linux�ȶ��ƽ̨�� UCS-2 ����ⲻͬ��UCS-2LE,UCS-2BE����MS ���� unicode �и�������־(UCS-2LE FFFE, UCS-2BE FEFF)���Ա���������ַ��� unicode �����б� big-endian �� little-endian�� ���Դ� windows ƽ̨���������ݷ��������ǰ׺�����û��š�
 <br/>
5, linux �ı��������������ļ�������� printf �������Ҫ����̨���ʵ��ı���ƥ�䣨������벻ƥ�䣬һ��͸ó������ʱ�ı��������ɹ�ϵ����������̨��ת��������Ҫ�鿴��ǰ��ϵͳ���롣�������̨��ǰ�ı����� UTF-8, ��ô UTF-8 ����Ķ�������ȷ��ʾ��GBK �Ͳ��ܣ�ͬ������ǰ������ GBK, ������ʾ GBK ���룬������ϵͳӦ�ø����ܵĴ���ø����ת���ˡ�����ͨ�� putty ���ն˻�����Ҫ���ú��ն˵ı���ת���Խ������ķ��ա�
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
echo unescape("������").'<br/><br/><br/>';
 
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
        {    // �����ֽڵ�����
            $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}
$name = 'MY,���ү��';
$unicode_name=unicode_encode_1($name);
echo '<h3>'.$unicode_name.'</h3><br/><br/><br/>';

// ��UNICODE���������ݽ��н���
function unicode_decode_1($name)
{
    // ת�����룬��Unicode����ת���ɿ��������utf-8����
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
 * $str ԭʼ�����ַ���
 * $encoding ԭʼ�ַ����ı��룬Ĭ��GBK
 * $prefix ������ǰ׺��Ĭ��"&#"
 * $postfix �����ĺ�׺��Ĭ��";"
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
 * $str Unicode�������ַ���
 * $decoding ԭʼ�ַ����ı��룬Ĭ��GBK
 * $prefix �����ַ�����ǰ׺��Ĭ��"&#"
 * $postfix �����ַ����ĺ�׺��Ĭ��";"
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

//GBK�ַ�������
$str = '<b>����</b>';
echo $str.'<br />';
 
$unistr = unicode_encode($str);
echo $unistr.'<br />'; // &#60;&#98;&#62;&#21704;&#21704;&#60;&#47;&#98;&#62;
 
$str2 = unicode_decode($unistr);
echo $str2.'<br />'; //<b>����</b>
 
//UTF-8�ַ�������
$utf8_str = iconv('GBK', 'UTF-8', $str);
echo $utf8_str.'<br />'; // <b>哈哈</b> ע��UTF��GBK����ʾ�����룡���л�������ı������
 
$utf8_unistr = unicode_encode($utf8_str, 'UTF-8');
echo $utf8_unistr.'<br />'; // &#60;&#98;&#62;&#21704;&#21704;&#60;&#47;&#98;&#62;
 
$utf8_str2 = unicode_decode($utf8_unistr, 'UTF-8');
echo $utf8_str2.'<br />'; // <b>哈哈</b>
 
//������׺��ǰ׺����
echo $str.' -- unicode_encode : <br />';
$prefix_unistr = unicode_encode($str, 'GBK', "\\u", '');
echo $prefix_unistr.'<br /><br />'; // \u60\u98\u62\u21704\u21704\u60\u47\u98\u62
 
echo $prefix_unistr.' -- unicode_decode : <br />';
$profix_unistr2 = unicode_decode($prefix_unistr, 'GBK', "\\u", '');
echo $profix_unistr2.'<br /><br />'; //<b>����</b>

?>