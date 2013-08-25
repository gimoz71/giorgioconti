<div id="nav">
    <div id="title_admin">
        <h1>amministrazione Giorgio Conti</h1>
        <?php 
        if(isset($_GET['cosa']))
        {
        	if($_GET['cosa']=='categorie')
        	{
        		$sel['gallerie']=' id="selezionato" ';
        		$nome='nome_cat_it';
        		$titolo_letto='categorie';
        	}
            elseif($_GET['cosa']=='gallerie')
        	{
        		$sel['gallerie']=' id="selezionato" ';
        		$nome='nome_galleria_it';
        		$titolo_letto='gallerie';
        	}
         	elseif($_GET['cosa']=='foto')
        	{
        		$sel['gallerie']=' id="selezionato" ';
        		$nome='titolo_foto_it';
        		$titolo_letto='foto';
        	}
        	elseif($_GET['cosa']=='news')
        	{
        		$sel['news']=' id="selezionato" ';
        		$nome='titolo_news_it';
        		$titolo_letto='notizie/eventi';
        	}
        ?>
       <h2><?php echo strtoupper($_GET['cosa'])?></h2>
       <?php 
        }
       ?>
    </div>
    <div id="categorie">
    <?php
    if(isset($_GET['cosa']))
            {
    ?>
        <ul>
            <li><span>></span></li>
            <?php 
            
            if($sel['gallerie']!='')
            {
            ?>
            <li <?php echo $sel['gallerie_ins']?>><a href="inserisci.php?cosa=gallerie">inserisci gallerie</a></li>
            <li <?php echo $sel['gallerie_mod']?>><a href="lista.php?cosa=gallerie&nome=nome_galleria_it">modifica gallerie</a></li>
            <li <?php echo $sel['foto_ins']?>><a href="inserisci.php?cosa=foto">inserisci immagine</a></li>
            <li <?php echo $sel['foto_mod']?>><a href="lista.php?cosa=foto&nome=nome_foto-titolo_foto_it">modifica immagine</a></li>
            <?php 
            }
            else
            { 
            	if(!isset($_GET['cosa']))
            	{
            		$_GET['cosa']='news';
            	}
            ?>
            <li <?php echo $sel['news_ins']?>><a href="inserisci.php?cosa=<?php echo $_GET['cosa']?>">inserisci notizie/eventi</a></li>
            <li <?php echo $sel['news_mod']?>><a href="lista.php?cosa=<?php echo $_GET['cosa']?>&nome=<?php echo $nome;?>">modifica notizie/eventi</a></li>
            <?php 
          	}
			?>
         </ul>
         <?php 
         }
         ?>
    </div>
         <div id="menu">
        <ul>
            <li><span>></span></li>
            <li <?php echo $sel['gallerie']?>><a  id="biografia"  href="gallerie.php?cosa=gallerie">gestione gallerie</a></li>
            <li <?php echo $sel['news']?>><a id="news" href="news.php?cosa=news">gestione notizie/eventi</a></li>
            
       </ul>
    </div>
    
</div>