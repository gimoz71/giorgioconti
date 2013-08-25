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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/style_<?php echo $tipo;?>.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../css/utility.css" type="text/css" media="screen"/>
</head>
<body style="background-color: #fff;">
<?php 
include(INCLUDEPATH.'news.php');
?>

</body>
</html>