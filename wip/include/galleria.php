<div id="thumbnails_wrapper">
    <div id="outer_container">
        <div class="thumbScroller">
            <div class="container"> 
                <!-- Thumb -->
                <?php 
               foreach($fo as $f)
                {
                ?>
                <div class="content">
                    <div><a href="../images/big/<?php echo $f['nome_foto']?>"><img src="../images/thbn/<?php echo $f['nome_foto']?>" class="thumb" title="<h2><?php echo stripslashes($f['titolo_foto_it'])?></h2><p><?php echo stripslashes($f['descrizione_foto_it'])?></p>" /></a></div>
                </div>
                <?php 
                }
                ?>
                 <!-- Fine Thumb --> 
            </div>
        </div>
    </div>
</div>