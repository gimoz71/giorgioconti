<?php
    class Image{

        var $src_filename;

        var $src_width;

        var $src_height;

        var $src_type;

        var $src_attr;

        var $src_image;
        var $log;



        function Image($filename){

            $this->src_filename = $filename;

            $this->GetImageInfo();
            //$this->log=fopen('log_immagini.txt','a');

        }



        function GetImageInfo(){

            list($this->src_width,$this->src_height, $this->src_type, $this->src_attr) = getimagesize($this->src_filename);

        }

        function verticale()
        {
        	$this->GetImageInfo();
        	if($this->src_width>$this->src_height)
        		return false;
        	return true;	
        } 

        function CreateSourceImage(){
            switch($this->src_type){

                case 1:
                    $this->src_image = imagecreatefromgif($this->src_filename);
                     break;
                case 2:
                    $this->src_image = imagecreatefromjpeg($this->src_filename);
	                break;
                case 3:
                    $this->src_image = imagecreatefrompng($this->src_filename);
	                break;
                default:    return false;
            }
            return true;
        }

        /**
		 * Ridimensiona l'immagine data mantenendo come dimensione fissa la larghezza
		 * @param unknown_type $filename
		 * @param unknown_type $quality
		 * @param unknown_type $height
		 * @param unknown_type $watermark
		 */
		function SaveProportionateImageW($filename, $quality, $height,$watermark=false)
		{
                $dest_width = $height;
               	$ratio = $this->src_width / $dest_width;
               	//fwrite($this->log,'Altezza '.$height.'-'.$filename.'-'.$this->src_type.'-'.$quality."\n");
				$dest_image = imagecreatetruecolor($dest_width,$this->src_height / $ratio);
	            imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0,
                $this->src_width / $ratio,
                $this->src_height / $ratio,
                $this->src_width,
                $this->src_height);
				if($watermark!==false)
                {
                	//fwrite($this->log,'Foto w: '. ($this->src_width/2).'Wt w:'.($watermark->src_width/2).'-'.(($this->src_height/2)-($watermark->src_height/2))."\n");
                	imagecopy($dest_image, $watermark->src_image, ((($this->src_width / $ratio)/2)-($watermark->src_width/2)), ((($this->src_height / $ratio)/2)-($watermark->src_height/2)), 0, 0, $watermark->src_width, $watermark->src_height);
                }
                switch($this->src_type){
                    case 1:
                        imagegif($dest_image, $filename);
                        break;
                    case 2:
                        imagejpeg($dest_image, $filename, $quality);
                        break;
                    case 3:
                        imagepng($dest_image, $filename);
                        break;
			    	default:imagedestroy($dest_image);
			 }
			 $this->Free($dest_image);
		}
		
		/**
		 * Crea un'immagine mantenendo le sue dimensioni originali
		 * @param unknown_type $filename
		 * @param unknown_type $quality
		 * @param unknown_type $watermark
		 */
		function SaveImage($filename, $quality,$watermark=false)
		{
                $dest_height = $height;
				$dest_image = imagecreatetruecolor( $this->src_width ,$this->src_height);
	            imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0,
                $this->src_width ,
                $this->src_height ,
                $this->src_width,
                $this->src_height);
				if($watermark!==false)
                {
                	//fwrite($this->log,'Foto w: '. ($this->src_width/2).'Wt w:'.($watermark->src_width/2).'-'.(($this->src_height/2)-($watermark->src_height/2))."\n");
                	imagecopy($dest_image, $watermark->src_image, ((($this->src_width / $ratio)/2)-($watermark->src_width/2)), ((($this->src_height / $ratio)/2)-($watermark->src_height/2)), 0, 0, $watermark->src_width, $watermark->src_height);
                }
			    switch($this->src_type){
                    case 1:
                        imagegif($dest_image, $filename);
                        break;
                    case 2:
                        imagejpeg($dest_image, $filename, $quality);
                        break;
                    case 3:
                        imagepng($dest_image, $filename);
                        break;
	           		default:imagedestroy($dest_image);
			 }
			  $this->Free($dest_image);
		}
        
        /**
         * Crea un'immagine proporzionata mantenendo come parametro fisso l'atezza
         * @param unknown_type $filename
         * @param unknown_type $quality
         * @param unknown_type $height
         * @param unknown_type $watermark
         */
        function SaveProportionateImage($filename, $quality, $height,$watermark=false)
		{
			
                $dest_height = $height;
               	$ratio = $this->src_height / $dest_height;
				
	            $dest_image = imagecreatetruecolor( $this->src_width / $ratio,$dest_height);
	            imagecopyresampled($dest_image, $this->src_image, 0, 0, 0, 0,
                $this->src_width / $ratio,
                $this->src_height / $ratio,
                $this->src_width,
                $this->src_height);
		        if($watermark!==false)
                {
                	//fwrite($this->log,'Foto w: '. ($this->src_width/2).'Wt w:'.($watermark->src_width/2).'-'.(($this->src_height/2)-($watermark->src_height/2))."\n");
                	imagecopy($dest_image, $watermark->src_image, ((($this->src_width / $ratio)/2)-($watermark->src_width/2)), ((($this->src_height / $ratio)/2)-($watermark->src_height/2)), 0, 0, $watermark->src_width, $watermark->src_height);
                }
                switch($this->src_type){
                    case 1:
                        imagegif($dest_image, $filename);
                        break;
                    case 2:
                        imagejpeg($dest_image, $filename, $quality);
                        break;
                    case 3:
                        imagepng($dest_image, $filename);
                        break;
                	default:imagedestroy($dest_image);
	            }
	            $this->Free($dest_image);
		}
		
		/**
		 * Ridimensiona un'immagine mantendo come parametro fisso l'altezza o la larghezza, a seconda che l'immagine sia verticale o orizzontale
		 * @param unknown_type $filename
		 * @param unknown_type $quality
		 * @param unknown_type $dimH
		 * @param unknown_type $dimW
		 * @param unknown_type $watermark
		 * @return boolean
		 */
		function SaveProportionateImageM($filename, $quality, $dimH=0,$dimW=0,$watermark=false)
		{
			if($dimH>0 || $dimW>0)
			{
                if($this->src_height > $this->src_width)
                {
                	$this->SaveProportionateImage($filename, $quality, $dimH,$watermark);
                	return true;
                }
                else
                  {
                	$this->SaveProportionateImageW($filename, $quality, $dimW,$watermark);
                	return true;
                }
			}
			else
			{
				return false;
			}    			   
		}

		/**
		 * Ridimensiona un'immagine con dei parametri di dimensione massimi sia in altezza che in larghezza
		 * @param unknown_type $filename
		 * @param unknown_type $quality
		 * @param unknown_type $maxH
		 * @param unknown_type $maxW
		 * @param unknown_type $watermark
		 * @return boolean
		 */
		function SaveProportionateImageP($filename, $quality, $maxH=0,$maxW=0,$watermark=false)
		{
			
                if($this->src_height > $this->src_width)
                {
                	$ratio = $this->src_height / $maxH;
                	$ris_w=$this->src_width / $ratio;
                	if($ris_w>$maxW)
                	{
                		$this->SaveProportionateImageW($filename, $quality, $maxW,$watermark);
                	}
                	else
                	    {
                		$this->SaveProportionateImage($filename, $quality, $maxH,$watermark);
                	}
                	return true;
                }
                else
                {
                	$ratio = $this->src_width / $maxW;
                	$ris_h=$this->src_height / $ratio;
                	if($ris_h>$maxH)
                	{
                		$this->SaveProportionateImage($filename, $quality, $maxH,$watermark);
                	}
                	else
                	{
                		$this->SaveProportionateImageW($filename, $quality, $maxW,$watermark);
                	}
                	return true;
                }
			 			   
		}
		
		
		
        function Free($dest_image){
            imagedestroy($dest_image);
        }

    }
    ?>
