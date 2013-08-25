<?

class FileUpload{

    var $up_dir;        //la directory temporanea in cui verrà uploadata l'img

    var $filename;    //il nome del file

    var $new_filename;    //il nuovo nome del file se vogliamo rinominarlo



    function FileUpload($up_dir){

        $this->up_dir = $up_dir;

    }



    function RenameFile($new_filename){

        $this->new_filename = $new_filename;

    }



    function Upload($files,$diretto=0,$nome='temporaneo.jpg'){

        if(!file_exists($this->up_dir))

            die('La directory non esiste!'.$this->up_dir);


         if($diretto==0)
         {
        $this->filename = ($this->new_filename) ? $this->new_filename :$files['name'];

        if(trim($files["name"]) == "")

            die("Non hai indicato il file da uploadare!");



        if(is_uploaded_file($files["tmp_name"])){

            move_uploaded_file($files["tmp_name"],$this->up_dir."/".$this->filename)

            or die("Impossibile spostare il file;controlla l'esistenza o i permessi della directory!");

        }else

            die ("Problemi nell'upload del file ".$files["name"]);
         }
         else
         {
         	$this->filename= $nome;
         	if(is_file($files))
         	{
         		copy($files,$this->up_dir."/".$this->filename);
         	}
         	else
         		die("File inesistente");
         }
    }



    function DeleteFile(){

        unlink($this->up_dir . '/' . $this->filename);

    }

}

?>
