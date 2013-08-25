<?php 
include('config.php');
include(CLASSPATH.'interfaccia.class.php');
include(INCLUDEPATH.'array.php');

$int=new interfaccia($$_GET['cosa']);
$sel[$_GET['cosa'].'_ins']=' id="selezionato" ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include INCLUDEPATH.'header_admin.php';
$int->genera_controlli_js();
?>
<script type="text/javascript" src="<?=JS_FOLDER?>tiny_mce/tiny_mce.js"></script>
<?php 
$int->genera_script_editor();
?>
</head>
<body>
<?php 
include INCLUDEPATH.'menu_admin.php';
?>
<div id="contenitore">
	<?php $int->genera_messaggi();?>
<form action="<?php echo FUNCTIONPATH;?>azioni.php?azione=inserisci&amp;cosa=<?php echo $_GET['cosa'];?>" enctype="multipart/form-data" onsubmit="return controllo();" method="post">
<?php $int->genera_form_inserimento();?>
</form>
</div>

<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="js/function.js"></script> 
</body>
</html>