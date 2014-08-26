<?php
	echo '<br/><h1>数组操作</h1><br/><br/>';

	// Let's show all errors
	error_reporting(E_ALL);
	$fruits = array('strawberry' => 'red', 'banana' => 'yellow');

	// Works but note that this works differently outside string-quotes
	echo "1 A banana is $fruits[banana].";
	echo '<br/><br/>';

	// Works
	echo "2A banana is {$fruits['banana']}.";
	echo '<br/><br/>';

	// Works but PHP looks for a constant named banana first as described below.
	echo "3A banana is {$fruits[banana]}.";
	echo '<br/><br/>';

	// Won't work, use braces.  This results in a parse error.
	//echo "4A banana is $fruits['banana'] .";
	//echo '<br/><br/>';

	// Works
	echo "5A banana is " . $fruits['banana'] . ".";
	echo '<br/><br/>';

	// Won't work. For a solution, see the complex syntax.
	echo "6A banana is $fruits->banana .";
	echo '<br/><br/>';

	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';
	//$myArry=array("somearray" => array(6 => 5, 13 => 9, "a" => 42));

	$aarray=array("q" => 43, 32, 56, "b" => 12);
	print_r($aarray);
	echo '<br/>';
	$aarray=array("5" => 43, 5=> 32, 56, "b" => 12);//"5" 会被5覆盖掉！
	print_r($aarray);
	echo '<br/>';
	$aarray[] = 56;    // This is the same as $arr[7] = 56;
	$aarray["x"] = 42; // This adds a new element to the array with key "x"
	print_r($aarray);
	echo '<br/>';
	unset($aarray[5]); // This removes the element from the array
	//unset($aarray);    // This deletes the whole array
	print_r($aarray);
	echo '<br/><br/>';
	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';


	// 创建一个简单的数组
	$array = array(1, 2, 3, 4, 5);
	print_r($array);
	echo '<br/>';
	// 现在删除其中的所有单元，但保持数组本身的结构
	foreach ($array as $i => $value) {
		unset($array[$i]);
	}
	print_r($array);
	echo '<br/>';
	// 添加一个单元（注意新的键名是 5，而不是你可能以为的 0）
	$array[] = "a new value";
	print_r($array);
	echo '<br/>';
	// 重新索引：
	$array = array_values($array);//重新建立索引，元素从0开始
	$array[] = 7;
	print_r($array);
	echo '<br/><br/>';
	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';

	// Array as (property-)map
	$map = array( 'version'    => 4,
				  'OS'         => 'Linux',
				  'lang'       => 'english',
				  'short_tags' => true
				);
	print_r($map);
	echo '<br/>';
	// strictly numerical keys
	$array = array( 7,
					8,
					0,
					156,
					-10
				  );
	// this is the same as array(0 => 7, 1 => 8, ...)
	print_r($array);
	echo '<br/>';
	$switching = array(         10, // key = 0
						5    =>  6,
						3    =>  7,
						'a'  =>  4,
								11, // key = 6 (maximum of integer-indices was 5)
						'8'  =>  2, // key = 8 (integer!)
						'02' => 77, // key = '02'
						0    => 12  // the value 10 will be overwritten by 12
					  );
	print_r($switching);
	echo '<br/>';
	// empty array
	$empty = array();
	print_r($empty);
	echo '<br/><br/>';
	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';


	$colors = array('red', 'blue', 'green', 'yellow');
	echo "\$colors is $colors";
	echo '<br/>';
	foreach ($colors as $color) {
		echo "Do you like $color?\n";
		echo "<br/>";
	}
	print_r($colors);
	echo '<br/>';
	//
	sort($colors);
	print_r($colors);
	echo '<br/>';

	foreach ($colors as $key => $color) {
		// won't work:
		//$color = strtoupper($color);
		//works:
		$colors[$key] = strtoupper($color);
	}
	print_r($colors);
	echo '<br/><br/>';
	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';

	$dd=array('json'=>'db','xml'=>'djks');
	print_r($dd);
	echo '<br/>';
	foreach($dd as $k=>$v)
	{
		echo $k.'===='.$v.'<br/>';
	}

	echo '<br/>++++++++++++++++++++++++++++++++++++<br/>';
	$arr1 = array(2, 3);
	print_r($arr1);
	echo "<br/><br/>";

	$arr2 = $arr1;
	$arr2[] = "add a arr2"; // $arr2 is changed, $arr1 is still array(2,3)
	print_r($arr1);
	echo "<br/>";
	print_r($arr2);
	echo "<br/><br/>";

	$arr3 =&$arr1;//使用&指向符引用地址
	$arr3[] = "refer arr1, add a arr3"; // now $arr1 and $arr3 are the same
	print_r($arr1);
	echo "<br/>";
	print_r($arr2);
	echo "<br/>";
	print_r($arr3);
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
?>