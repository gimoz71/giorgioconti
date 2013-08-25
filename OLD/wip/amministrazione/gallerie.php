<?php 
include('config.php');
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
	<h1>area gestione gallerie</h1>
	<p>In questa sezione puoi gestire l'inserimento e la modifica delle gallerie con le relative immagini.</p>
    <ul>
    	<li><strong>inserisci gallerie</strong>: scegli la tipologia di immagine che desideri, inserisci il titolo della galleria e scegli se deve essere pubblicata e se deve essere l'immagine di riferimento per la galleria (attivando 'principale')</li>
    	<li><strong>modifica gallerie</strong>: scegli dalla lista la galleria da modificare e segui le istruzioni come sopra</li>
        <li><strong>inserisci immagine</strong>: scegli una galleria dalla lista, inserisci il titolo, la descrizione. Clicca su 'scegli documento' per inserire l'immagine interessata e clicca su inserisci per registrare le modifiche.</li>
        <li><strong>modifica immagine</strong>: scegli una galleria dalla lista, clicca su 'cerca' e scegli un'immagine da modificare e segui le istruzioni come sopra</li>
    </ul>
</div>

<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="js/function.js"></script> 
</body>
</html>