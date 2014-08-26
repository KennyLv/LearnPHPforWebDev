<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

//使用echo()函数输出数据
echo "这是echo()函数输出的结果";
echo "<br><br>";
//使用echo()函数带有括号的例子
echo "这是'echo(d)'函数带有括号的例子\R\N";
echo "<br><br>";
//使用print()函数输出数据
print "这是print()函数输出的结果";
echo "<br><br>";
//print()函数带有括号的例子
print("这是print()函数带有括号的例子");
echo "<br><br>";

$str1 = "输出没有格式的测试字符串";
$str2 = "<font size='1'>输出带有HTML格式的测试字符串</font>";
$str3 = "<font size='4’>输出带有HTML格式的测试字符串</font>";
echo $str1;
echo "<br><br>";
echo $str2;
print "<br>";
print $str3;


?>