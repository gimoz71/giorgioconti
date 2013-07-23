<div id="nav">
    <div id="title">
        <h1>GIORGIO CONTI</h1>
        <h2><?php echo strtoupper($tipo)?></h2>
    </div>
    <div id="categorie">
        <ul>
            <li><span>></span></li>
            <?php
            foreach($gal as $g)
            {
            	
            ?>
            <li><a href="index.php?id_gallerie=<?php echo $g['id_gallerie']?>"><?php echo strtolower($g['nome_galleria_it'])?></a></li>
            <?php 
            }
            ?>
         </ul>
    </div>
    <div id="menu">
        <ul>
            <li><span></span></li>
            <li><a href="#biografiainline" id="biografia">biografia</a></li>
            <li><a href="news_list.php" id="news" class="iframe">eventi/notizie</a></li>
            <li><a href="#contattiinline" id="contatti">contatti</a></li>
            <li><a href="../include/video.php" id="video" class="iframe">video</a></li>
            <li><a href="#"><img src="../images/facebook.png" align="absmiddle" /></a></li>
            <li><a href="#"><img src="../images/twitter.png" align="absmiddle" /></a></li>
            <?php
			if ($tipo == "fotografia") {
			?>
            <li><a href="http://www.giorgioconti.it/wip/pittore">vai alla sezione pittura</a></li>
			<?php
			} else {
			?>
            <li><a href="http://www.giorgioconti.it/wip/fotografo">vai alla sezione fotografia</a></li>
            <?php
			}
			?>
        </ul>
    </div>
</div>