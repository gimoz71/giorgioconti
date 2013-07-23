<?php session_start();
$tipo='fotografia';
if(isset($_GET))
{
	foreach ($_GET as $k=>$v)
	{
		if($k!='lan')
			$lg.=$k.'='.$v.'&';
	}
}
	define('INCLUDEPATH','../include/');
	define('CLASSPATH','../include/classi/');
	define('FUNCTIONPATH','../include/funzioni/');
	define('CSS_FOLDER','../css/');
	define('JS_FOLDER','../js/');
	define('IMAGES_FOLDER','../images/');
	define('TOTALPATH','http://www.giorgioconti.it/fotografo/');
	include_once(INCLUDEPATH.'cd.php');
    //define('TOTALPATH','http://192.168.1.10/conti/');
   
  
?>