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
					echo "�ҵ����ӽУ�".$this->name." �Ա�".$this->sex." �ҵ������ǣ�".$this->age."<br><br>";
				}
				function __destruct()
				{
					echo "�ټ�".$this->name."<br>";
				}
		}
		$p=new Person("test","male","20");
		$p->say();
		$p->name="no test";
		$p->say();
?>

<?php
		echo "<br/><br/><br/><br/>���麯���Ƿ�ֵ isset()<br/>";
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
		echo "<br/><br/><br/><br/>���ò���ķ���ʱ�Զ����õķ���__call()<br/>";
		class Test
		{
				//����һ�����Ե��࣬����û�����Ժͷ���
				//���ò���ķ���ʱ�Զ����õķ�������һ������Ϊ���������ڶ����������������
				function __call($function_name, $args)
				{
						echo $function_name;
						echo "�������õĺ�����$function_name(������";
						print_r($args);
						echo ")�����ڣ�<br>\n";
				}
		}
		//����һ��Test��Ķ���
		$test=new Test();
		//���ö����ﲻ���ڵķ���
		$test->demo("one", "two", "three");
		//���򲻻��˳�����ִ�е�����
		echo "<br/><br/><br/>";
?>



