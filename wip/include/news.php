<?php 
$news=mysql_query("select * from news where pubblicata=1 and tipo_news like '".$tipo."'");
?>

<div style="display: block;">
<div id="newsinline">
<?php 
if(mysql_num_rows($news)>0)
{
while($n=mysql_fetch_assoc($news))
{
	include_once(FUNCTIONPATH.'utilita.php');
?>
        <div class="newsitem">
        	<img src="../images/thbn/<?php echo $n['nome_foto']?>" class="newsthumb" />
            <h2><?php echo stripslashes(strtoupper($n['titolo_news_it']))?> <small><?php echo norm_date($n['data_news'])?></small></h2>
			<?php 
            echo trunc_text(html_entity_decode($n['testo_news_it']),25,'news_dettaglio.php?id='.$n['id_news']);
            ?>
            <div class="clearer twenty"></div>
        </div>
 <?php 
}
?>
</div>
 <?php
}
else 
{?>
<div id="newsinline">
    <div class="newsitem">
    <h2>Non sono presenti News al momento.</h2>
    </div>
</div>
	<?php 
}
 ?>       
        
</div>