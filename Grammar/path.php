<?php 
echo __FILE__ ; // ȡ�õ�ǰ�ļ��ľ��Ե�ַ
echo "<br />"; 
echo dirname(__FILE__); // ȡ�õ�ǰ�ļ����ڵľ���Ŀ¼
echo "<br />"; 
echo dirname(dirname(__FILE__)); //ȡ�õ�ǰ�ļ�����һ��Ŀ¼��
echo "<br />"."<br />"; 


//��õ�ǰĿ¼ 
echo getcwd(); 
echo "<br />"; 
//chdir() ����
//�ѵ�ǰ��Ŀ¼�ı�Ϊָ����Ŀ¼�� ���ɹ�����ú������� true�����򷵻� false��
chdir("images"); //�ı�Ϊ images Ŀ¼ 
echo getcwd(); 
echo "<br />"; 


?> 