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
    <h1>area gestione notizie/eventi</h1>
    <p>In questa sezione puoi gestire l'inserimento e la modifica delle news/eventi con le relative immagini.</p>
    <ul>
        <li><strong>inserisci notizie/eventi</strong>: scegli la tipologia di notizia che desideri, inserisci il titolo la data, il titolo ed il testo. Clicca su 'scegli documento' per inserire l'immagine interessata e clicca su inserisci per registrare le modifiche. Scegli se deve essere pubblicata e se la notizia deve essere pubblicata sulla home page (attivando 'principale')</li>
        <li><strong>modifica notizie/eventi</strong>: scegli dalla lista la notizia da modificare e segui le istruzioni come sopra</li>
    </ul>
</div>
<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="js/function.js"></script>
</body>
</html>