<?php
//����������
header("Access-Control-Allow-Origin: *");
//����URL·��
require_once('controller/Router.php');

$r = new Router;
$r->dispatch();

?>