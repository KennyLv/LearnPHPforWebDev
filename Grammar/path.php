<?php 
echo __FILE__ ; // 取得当前文件的绝对地址
echo "<br />"; 
echo dirname(__FILE__); // 取得当前文件所在的绝对目录
echo "<br />"; 
echo dirname(dirname(__FILE__)); //取得当前文件的上一层目录名
echo "<br />"."<br />"; 


//获得当前目录 
echo getcwd(); 
echo "<br />"; 
//chdir() 函数
//把当前的目录改变为指定的目录。 若成功，则该函数返回 true，否则返回 false。
chdir("images"); //改变为 images 目录 
echo getcwd(); 
echo "<br />"; 


?> 