<?php 
include('config.php');
include(CLASSPATH.'interfaccia.class.php');
include(INCLUDEPATH.'array.php');

$int=new interfaccia($$_GET['cosa']);
$sel[$_GET['cosa'].'_mod']=' id="selezionato" ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include INCLUDEPATH.'header_admin.php';
?>
</head>
<body>
<?php 
include INCLUDEPATH.'menu_admin.php';
?>
<div id="contenitore">
<?php 
if(isset($_SESSION['errori']))
{
	foreach($_SESSION['errori'] as $e)
	{
		print '<p style="color: red">'.$e.'</p>';
	}
	unset($_SESSION['errori']);
}

?>
	<?php $int->genera_messaggi();?>
<p>
<?php 
if($_GET['cosa']=='foto')
{  
$gallerie=mysql_query("select * from gallerie");
	?>
<div class="riga_form">
<form action="lista.php"  method="get" >
<div class="label_form">Galleria
<input type="hidden" name="nome" value="<?=$_GET['nome']?>">
<input type="hidden" name="cosa" value="<?=$_GET['cosa']?>">
<select name="id_gallerie">
<?php 
while($gal=mysql_fetch_assoc($gallerie))
{
    $sel='';
     if($_GET['id_gallerie']==$gal['id_gallerie'])
     	$sel=' selected="selected" ';
	print '<option value="'.$gal['id_gallerie'].'" '.$sel.'>'.$gal['nome_galleria_it'].'</option>';
}
?>
</select>
</div>
<div class="campo_inserimento">
<input type="submit" name="cerca"  class="button" value="Cerca" /></div>
</form><div class="clear"></div>
</div>
<div style="clear:both;"></div>
 <?
}
if($_GET['cosa']!='foto' || isset($_GET['id_gallerie']))
{
$cond='';
if(isset($_GET['id_gallerie']))
{
  $cond=' where id_gallerie=\''.$_GET['id_gallerie'].'\' ';
}
$int->genera_lista($_GET['cosa'],$_GET['nome'],false,0,'',$cond);
}
?>
</p>
</div>

<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="js/function.js"></script> 
</body>
</html>