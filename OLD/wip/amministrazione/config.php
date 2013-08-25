<?php session_start();
if(!isset($_SESSION['utente']))
{
	$_SESSION['err'][]='La tua sessione &egrave; scaduta.';
	header('Location: ../log_ar.php');
	exit();
}
	define('INCLUDEPATH','../include/');
	define('CLASSPATH','../include/classi/');
	define('FUNCTIONPATH','../include/funzioni/');
	define('CSS_FOLDER','../css/');
	define('JS_FOLDER','../js/');
	define('IMAGES_FOLDER','../images/');
	define('FLASH_FOLDER','../flash/');
	include(INCLUDEPATH.'cd.php');
	include(FUNCTIONPATH.'utilita.php');
?>