<?php

		/**
		 *
		 *
		 * @version $Id$
		 * @copyright 2011
		 */
		// simple callback example
		class foo
		{
			function do_foo()
			{
				echo "Doing foo.<br/><br/>";
			}
		}
		$bar = new foo;
		$bar->do_foo();
		
		$obj = (object) 'ciao';
		echo $obj->scalar;  // outputs 'ciao'

		echo "<br/><br/><br/><br/><br/>";

		class Person{
				var $name; 
				var $sex;
				var $age;
				function __construct($name, $sex, $age)
				{
					$this->name=$name;
					$this->sex=$sex;
					$this->age=$age;
				}
				function say()
				{
					echo "我的名子叫：".$this->name." 性别：".$this->sex." 我的年龄是：".$this->age."<br><br>";
				}
				function __destruct()
				{
					echo "再见".$this->name."<br>";
				}
		}
		$p=new Person("test","male","20");
		$p->say();
		$p->name="no test";
		$p->say();
?>

<?php
		echo "<br/><br/><br/><br/>检验函数是否赋值 isset()<br/>";
		$var = '';
		if (isset($var)) {
			print "This var is set , so I will print.";
		}
		echo "<br/>";
		$a = "test";
		$b = "anothertest";
		var_dump( isset($a) );      // TRUE
		echo "<br/>";
		var_dump( isset ($a, $b) ); // TRUE
		echo "<br/>";
		unset ($a);
		var_dump( isset ($a) );     // FALSE
		echo "<br/>";
		var_dump( isset ($a, $b) ); // FALSE
		echo "<br/>";
		var_dump( isset ($b) );     // TRUE
		echo "<br/>";
		$foo = NULL;
		var_dump( isset ($foo) );   // FALSE
		echo "<br/>";
?>

<?php
		echo "<br/><br/><br/><br/>调用不存的方法时自动调用的方法__call()<br/>";
		class Test
		{
				//这是一个测试的类，里面没有属性和方法
				//调用不存的方法时自动调用的方法，第一个参数为方法名，第二个参数是数组参数
				function __call($function_name, $args)
				{
						echo $function_name;
						echo "你所调用的函数：$function_name(参数：";
						print_r($args);
						echo ")不存在！<br>\n";
				}
		}
		//产生一个Test类的对象
		$test=new Test();
		//调用对象里不存在的方法
		$test->demo("one", "two", "three");
		//程序不会退出可以执行到这里
		echo "<br/><br/><br/>";
?>



