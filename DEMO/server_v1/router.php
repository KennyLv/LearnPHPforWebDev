<?php
/**
 *·�������ļ���д˵���� 
 *  ·��������һ��array�����У�һ����¼����һ������
 *  ����ƥ�������͵Ĺ���
 *  key:   ֻ����2�й��� '/{controller}'��'/{controller}/{id}'��{controller}�����ַ���������ĸ�����֣�_
 *  value: ��һ��controller����(�ļ�����ȥ��չ��������������ͬ);
 *         �ڶ���idֻ��Ϊ������(����0)
 *  controller�ļ�����λ��'/controller'�ļ����£������������ļ�����ͬ(��ȥ��չ��.php)�����ִ�Сд��
**/
$routes= array(
    '/resources' => array('resources',''),
    '/resources/id' => array('resources','id'),
);
?>