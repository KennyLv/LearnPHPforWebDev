<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

echo gettype((bool) "");        // bool(false)
echo "<br/>";
echo gettype((bool) 1);         // bool(true)
echo "<br/>";
echo gettype((bool) -2);        // bool(true)
echo "<br/>";
echo gettype((bool) "foo");     // bool(true)
echo "<br/>";
echo gettype((bool) 2.3e5);     // bool(true)
echo "<br/>";
echo gettype((bool) array(12)); // bool(true)
echo "<br/>";
echo gettype((bool) array());   // bool(false)
echo "<br/>";

echo (int) ( (0.1+0.7) * 10 ); // 显示 7

echo '<br/>++++++++++++++++++++++++<br/>';
echo 'this is a simple string';
echo "<br/>";
echo 'You can also have embedded newlines in strings this way as it is okay to do';
echo "<br/>";
// Outputs: Arnold once said: "I'll be back"
echo 'Arnold once said: "I\'ll be back"';
echo "<br/>";
// Outputs: You deleted C:\*.*?
echo 'You deleted C:\*.*?';
echo "<br/>";
// Outputs: You deleted C:\*.*?
echo "You deleted C:\*.*?";
echo "<br/>";
// Outputs: This will not expand: \n a newline
echo 'This will not expand: \n a newline';
echo "<br/>";
echo "This will not expand: \n a newline";
echo "<br/>";
// Outputs: Variables do not $expand $either
echo 'Variables do not $expand $either';
echo "<br/>";

$str = <<<EOD
Example of string
spanning multiple lines
using heredoc syntax.
EOD;

/* More complex example, with variables. */
class foo
{
	var $foo;
	var $bar;

	function foo()
	{
		$this->foo = 'Foo';
		$this->bar = array('Bar1', 'Bar2', 'Bar3');
	}
}

$foo = new foo();
$name = 'MyName';

echo <<<EOT
<br/>++++++++++++++++++++++++++++++++++++<br/>
My name is "$name". <br/>
I am printing some $foo->foo .<br/>
Now, I am printing some {$foo->bar[1]} .<br/>
This should print a capital 'A': \x41 .
EOT;

echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';
$beer = 'Heineken';
echo "$beer's taste is great"; // works, "'" is an invalid character for varnames
echo "<br/>";
echo "He drank some $beers";   // won't work, 's' is a valid character for varnames
echo "<br/>";
echo "<br/>";
echo "He drank some $beer s";  // works
echo "<br/>";
echo "He drank some ${beer}s"; // works
echo "<br/>";
echo "He drank some {$beer}s"; // works


ECHO "<br/>+++++++++++type convert+++++++++++++++++<br/>";
$foo = "0";  // $foo is string (ASCII 48)
echo "\$foo = \"0\" is a ".gettype($foo)."<br/>";
$foo += 2;   // $foo is now an integer (2)
echo gettype($foo)."<br/>";
$foo = $foo + 1.3;  // $foo is now a float (3.3)
echo gettype($foo)."<br/>";
$foo = 5 + "10 Little Piggies"; // $foo is integer (15)
echo gettype($foo)."<br/>";
$foo = 5 + "10 Small Pigs";     // $foo is integer (15)
echo gettype($foo)."<br/>";


$a = "12345";     // $a 是字符串
var_dump($a);
echo gettype($a)."<br/>";
$a[0] = "a";  // 是字符串偏移量吗？结果会是什么？
var_dump($a); //结果表明a并未转化为数组，而是偏移字符，将第一位替换为‘a’
echo gettype($a)."<br/>";
$a{1} = "b";   // $a 目前为 "afc"
var_dump($a);
echo gettype($a)."<br/>";


$foo = 10;            // $foo is an integer
$str = "$foo";        // $str is a string //仅仅是取值，应该为发生强制转化，
$fst = (string) $foo; // $fst is also a string//强制转化
// This prints out that "they are the same"
if ($fst === $str) {
	echo "two different way to convert the type, but they are the same.<br/>";
}
?>