<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */
$headers = getallheaders();
echo $_SERVER['HTTP_REFERER'];
foreach ($_SERVER as $key => $value) { 
    if ('HTTP_' == substr($key, 0, 5)) { 
        $headers[str_replace('_', '-', substr($key, 5))] = $value; 
    } 
}
foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}

//��������
echo $_SERVER["HTTP_USER_AGENT"];
if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {
	echo "<BR/>You are using Internet Explorer<br />";
}
if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {
echo "php ie<br/>";
}
//�����ʾ����Ԥ�������
//phpinfo();
?>
