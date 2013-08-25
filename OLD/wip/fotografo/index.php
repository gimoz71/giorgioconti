<?php 
include('config.php');
$gallerie=mysql_query('select * from gallerie where tipo_galleria like \''.$tipo."' and pubblicata=1");
$principale='';
            while($ga=mysql_fetch_assoc($gallerie))
            {
            	if($ga['home']==1)
            	{
            	  	$principale=$ga['id_gallerie'];
            	}
            	$ultimo=$ga['id_gallerie'];
            	$gal[]=$ga;
            }
if($principale=='')
            	$principale=$ultimo;
if(!isset($_GET['id_gallerie']))
	$_GET['id_gallerie']=$principale;
$foto=mysql_query("select * from foto where id_gallerie=".$_GET['id_gallerie']);

while($f=mysql_fetch_assoc($foto))
{
	$fo[]=$f;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fotografo - Giorgio Conti</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="" />
<meta name="keywords" content="giorgio conti, pittura, pittore, portfolio eventi artistici, eventi"/>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
<?php 
include(INCLUDEPATH.'header.php');
?>
</head>
<body>
<div id="bg"> <a href="#" class="nextImageBtn" title="next"></a> <a href="#" class="prevImageBtn" title="previous"></a> <img src="../images/big/<?php echo $fo[0]['nome_foto']?>" id="bgimg" /> </div>
<div id="preloader"></div>
<div id="img_title"></div>
<div id="toolbar"><a href="#" title="Maximize" onClick="ImageViewMode('full');return false"><img src="../images/toolbar_fs_icon.png" width="50" height="50"  /></a></div>
<?php 
include(INCLUDEPATH.'nav.php');
?>
<?php /*
include(INCLUDEPATH.'news.php');*/
?>
<?php 
include(INCLUDEPATH.'contatti.php');
?>
<?php 
include(INCLUDEPATH.'bio.php');
?>
<?php 
include(INCLUDEPATH.'galleria.php');
?>
<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<script type="text/javascript" src="../js/function.js"></script> 
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