<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

echo "A TEST FOR PHP CLASS | METHOD | RESOURCE";
echo "<br/>";

class foo
{
	public $a="this is attribute a";
	public $b="this is attribute b";
	private $c="this is attribute c";
	function do_foo()
	{
		echo "Doing foo.".'<br/>';
	}
}
$bar = new foo;
$bar->do_foo();

foreach($bar as $attribute){
	echo $attribute."<br />";
}

echo "<br/><br/>类型转化<br/>";
$obj = (object) 'ciao';
echo $obj->scalar;  // outputs 'ciao'

?>


<?php
ECHO "<br/><br/><br/><br/><br/>";

// simple callback example
function my_callback_function() {
	echo "call_user_func : hello world!"."<br />";
}
call_user_func("my_callback_function");

// method callback examples
class MyClass {
	function myCallbackMethod() {
		echo "call_user_func : hello world!"."<br/>";
	}
}
// static class method call without instantiating an object
call_user_func(array('MyClass', 'myCallbackMethod'));
// object method call
$obj = new MyClass();
call_user_func(array(&$obj, 'myCallbackMethod'));
call_user_func(array(new MyClass, 'myCallbackMethod'));

?>


<?php
echo "<br/><br/><br/><br/><br/>";
//自定义函数
function aoo($p){
	if($p){
		echo "p is true"."<br />";
		function boo($mes){
			echo "boo is called :".$mes."<br />";
		}
	}else{
		echo "p is false"."<br />";
		boo("boo in call");
	}
	return "boo in return"."<br />";
}
aoo(true);
echo "============ "."<br />";
boo(aoo(false));//booiscboo

//函数的参数————引用传递
$test="qaws";
function coo(&$p){
	echo $p."<br />";
	return $p.='123214';
}
echo $test."#"."<br />";
echo "--------coo---------------"."<br />";
coo($test);
echo "---------coo--------------"."<br />";
echo coo($test)."#"."<br />";
echo "-----------------------"."<br />";
echo $test."#"."<br />";

?>