<?php


$log='Sql499403';
$pswd='ae8c9566';
$url='62.149.150.140';
$db='Sql499403_1';
mysql_connect($url,$log, $pswd) or die(mysql_error());
mysql_select_db($db) or die("DB non trovato");

?>
