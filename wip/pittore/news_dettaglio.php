<?php 
include('config.php');
include_once(FUNCTIONPATH.'utilita.php');
$news=mysql_query('select * from news where id_news='.$_GET['id']." and pubblicata=1");
$principale='';

$n=mysql_fetch_assoc($news);

/* Ottengo l'url assoluto della pagina */

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
/*echo $url;*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta property="og:title" content="<?php echo stripslashes($n['titolo_news_it']);?>" />
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="http://www.giorgioconti.it/wip/images/thbn/<?php echo $n['nome_foto']?>" />
<meta property="og:site_name" content="Giorgio Conti"/>
<meta property="fb:admins" content="1066317913"/>
<?php /*?><meta property="fb:app_id" content="2374435594748"/><?php */?>
<meta property="og:description" content="leggi le news sul sito!" />

<link rel="stylesheet" href="../css/style_<?php echo $tipo;?>.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/utility.css" type="text/css" media="screen" />
<title><?php echo stripslashes($n['titolo_news_it']);?> - <?php echo norm_date($n['data_news']);?></title>
</head>
<body style="background-color: #fff;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="newsinline">
    <div class="newsitem">
    	<div class="clearer forty"></div>
        <a href="../images/big/<?php echo $n['nome_foto']?>" target="_blank" class="newsthumzoom"><span class="zoom">ingrandisci</span><img src="../images/thbn/<?php echo $n['nome_foto']?>" class="newsthumb" /></a>
    	
        <h2><?php echo stripslashes($n['titolo_news_it']);?> <small><?php echo norm_date($n['data_news']);?></small></h2>
		<?php echo html_entity_decode($n['testo_news_it']); ?>
        
        <div class="newstools">
        <a class="segue" href="news_list.php" >&laquo; torna alla lista delle news</a>
        <fb:like class="fb" href="<?php echo $url; ?>" data-send="true" data-layout="button_count" data-width="180" data-show-faces="false" data-font="segoe ui"></fb:like>
    	</div>
    </div>
</div>
</body>
</html>