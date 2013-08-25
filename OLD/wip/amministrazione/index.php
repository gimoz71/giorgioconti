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
	<h2>Buongiorno <?php echo $_SESSION['utente']['nome'];?>.</h2>
	<p>Benvenuto nell'area di amministrazione del sito <strong>giorgioconti.it</strong>. Per gestire le aree dinamiche del sito puoi utilizzare il menu in alto.</p>
    <ul>
    	<li><strong>gestione gallerie</strong>: per inserire, modificare e cancellare le gallerie presenti nel sito</li>
    	<li><strong>gestione notizie/eventi</strong>: per inserire, modificare e cancellare gli eventi presenti nel sito</li>
    </ul>
</div>

<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="js/function.js"></script> 
<script type='text/javascript'>
$(document).ready(function() {
	/*$("#linkcat").toggle(
		function() {
			var $this = $(this);
			$this.addClass('arrow_right').removeClass('arrow_left');
			var $largh = $("#categorie").width() - 45;
			$("#categorie").animate({ 'left': -$largh }, 1000 );
			
		},
		function() {
			var $this = $(this);
			var $largh = $("#categorie").width() - $this.width();
			$("#categorie").animate({ 'left': '0' }, 1000 );
			
			$this.addClass('arrow_left').removeClass('arrow_right');
		});*/
	
	});
</script>
</body>
</html>