<?php
class azioni{

	var $_properties;
	var $cosa;

	function __construct($elenco=array(),$c='')
	{
		$this->_properties= array();
		$this->cosa=$c;
		$this->post=$p;
        foreach($elenco as $e)
        {
          $this->_properties[]=$e;
        }
	}

    function cancella($nome,$idcosa)
    {
    	 $ris=mysql_fetch_assoc(mysql_query("select * from ".$this->cosa." where id_".$this->cosa."='".$idcosa."'"));
    foreach($this->_properties as $s)
    {
      if($s['tipo']=='file')
      {
        @unlink('../../images/thbn/'.$ris[$s['nome']]);
        @unlink('../../images/grandi/'.$ris[$s['nome']]);
      }
    }
    mysql_query("delete from ".$this->cosa." where id_".$this->cosa."=".$idcosa);
    if(isset($_REQUEST['url']))
	  {
	    header("Location: ".ADMINPATH.'/'.$_REQUEST['url']);
	    exit();
	  }
	  else
	  {
	  	header("Location: ".ADMINPATH."lista.php?cosa=".$this->cosa."&nome=".$nome);
	    exit();
	  }	
    
    }
	
	function cancellaFoto($nomeFoto,$id)
	{
	    $foto=mysql_fetch_assoc(mysql_query("select * from ".$this->cosa." where id_".$this->cosa));
	    mysql_query("update ".$this->cosa." set ".$nomeFoto."='' where id_".$this->cosa."=".$id)or die(mysql_error());		
		@unlink('../../images/thbn/'.$foto[$nomeFoto]);
		@unlink('../../images/big/'.$foto[$nomeFoto]);
		$url=ADMINPATH."modifica.php?cosa=".$this->cosa."&id=".$id."&db=".$this->cosa;
		header("Location: ".$url."&ins=ok&id=".$id."&db=".$this->cosa);
		exit();
		
	}

 	function modifica($_POST,$idcosa)
 	{
		  $query="update ".$this->cosa." set ";
		  $i=0;
		  $foto=array();
		  $file=array();
		  $url='';
		  $cosa=$this->_properties;
		  $url=ADMINPATH."modifica.php?cosa=".$this->cosa."&id=".$idcosa."&db=".$_GET['db'];
		  if(isset($_POST['url']))
		  {
		  	$url=$_POST['url'];
		  }
		  $int=new interfaccia($cosa);
		  $int->genera_controlli_php($url,true);
		  foreach($cosa as $s)
		  {
		    if($s['tipo']!='file' && $s['tipo']!='tab' && $s['tipo']!='tabs' && $s['tipo']!='titolo' && !isset($s['onsubmit']) && !isset($s['id_caratteristiche']))
		    {
		      if($s['tipo']=='textarea' || $s['tipo']=='text')
		      {
		          if($s['controllo']=='data')
		          {
		             $_POST[$s['nome']]=my_date($_POST[$s['nome']]);
		          }
		          else
		          {
		          	if(!isset($s['codice']))
		          	{
		            $_POST[$s['nome']]=addslashes($_POST[$s['nome']]);
		          	}
		          	else
		          	{
		          		$_POST[$s['nome']]=addslashes($_POST[$s['nome']]);
		          	}
		         }
		      }
		      elseif($s['tipo']=='checkbox')
		      {
		        if(isset($s['unico']) && $_POST[$s['nome']]=='1')
		        {
		           $fine='';
		           $query2="update ".$this->cosa." set ".$s['nome']."=0".$fine;
		        }
		        if($_POST[$s['nome']]!='1')
		          $_POST[$s['nome']]=0;
		        else
		          $_POST[$s['nome']]=1;
		      }

		      if($i==0)
		      {
		        $query.=$s['nome'].'='."'".$_POST[$s['nome']]."'";

		        $i++;
		      }
		      else
		      {
		        $query.=','.$s['nome'].'='."'".$_POST[$s['nome']]."'";

		      }
		    }
		    elseif (isset($s['genere']) && !isset($s['onsubmit']))
		    {
		    	$file[]=$s;
		    }
		    elseif(!isset($s['onsubmit']))
		    {
		        $foto[]=$s;
		    }
		  }
		  if($this->cosa!='home')
		  {
		    if(isset($query2))
		    {
		      mysql_query($query2)or die(mysql_error());
		    }

		      $query.=' where id_'.$this->cosa."='".$idcosa."'";
		      //echo("$query");
		      mysql_query($query)or die(mysql_error());
		      $id_modello=$idcosa;


		    $i=0;
		    foreach($foto as $f)
		    {
		      if(isset($f['id_caratteristiche']))
		    {
		      if($f['valore']=='numerico' || $f['tipo']=='checkbox')
		         $valori="valore_int";
		      else
		         $valori="valore";
		       if($f['tipo']=='checkbox')
		       {
		         if($_POST[$f['nome']]=='1')
		           $_POST[$f['nome']]=1;
		         else
		           $_POST[$f['nome']]=0;
		       }
		       //print $id_modello;
		       $query="update caratteristiche_prodotti set
		             ".$valori."='".$_POST[$f['nome']]."'
		             where
		             id_prodotti='".$id_modello."' and
		             id_caratteristiche='".$f['id_caratteristiche']."'
		           ";
		        /*print $f['valore'].'<br />';
		        print $f['nome'].'<br />';
		        print $_POST[$f['nome']].'<br />';
		        print $query.'<br />';  */
		        mysql_query($query)or die(mysql_error());
		      $i++;
		    }
		    else
		    {
		        $descrizione=$id_modello;
		        $nome='';
		      if($_FILES[$f['nome']]['tmp_name']!='')
		      {
		         $foto_inserite=mysql_fetch_assoc(mysql_query("select * from ".$this->cosa." where id_".$this->cosa."='".$id_modello."'"));
		         $nome=ins_foto($_FILES[$f['nome']],$this->cosa.$i,$descrizione);
		         //print $nome;
		      }

		      if(substr($this->cosa,$nome) || $nome=='')
		      {
		        $i++;
		        if($nome!='')
		        {
		          mysql_query("update ".$this->cosa." set ".$f['nome']."='".$nome."' where id_".$this->cosa."='".$id_modello."'")or die(mysql_error());
		        }
		      }
		     }
		    }
		    foreach ($file as $fi)
		  {
		  	if($_FILES[$fi['nome']]['tmp_name']!='')
		  	{
		  	$newName='tool'.$id_modello;
		  	$file_inserite=mysql_fetch_assoc(mysql_query("select * from ".$this->cosa." where id_".$this->cosa."='".$id_modello."'"));
		    if($file_inserite[$fi['nome']]!='')
		    {
		  		@unlink(FILEPATH.$file_inserite[$fi['nome']]);
		    }
		  	$nome=copyFile($_FILES[$fi['nome']],$newName);
		  	if($nome!==false)
		  	{
		  		$i++;
		  		mysql_query("update ".$this->cosa." set ".$fi['nome']."='".$nome."' where id_".$this->cosa."='".$id_modello."'")or die(mysql_error());
		  	}
		  	}
		  	else
		  	{
		  		$i++;
		  	}
		  }
		  }
		  if($i==(count($foto)+count($file)))
		  {
		   header("Location: ".$url."&ins=ok&id=".$idcosa."&db=".$_GET['db']);
		    exit();
		  }
		  else
		  {
		   header("Location: ".$url);
		    exit();
		  }
 	}

	function inserisci($_POST)
	{
		  $query="insert into ".$this->cosa." (";
		  $value=" values(";
		  $i=0;
		  $foto=array();
		  $file=array();
		  $url='';
		  $cosa=$this->cosa;
		  if($this->cosa=='utenti')
		  {
          	$url=HOMEPATH."registrazione.php";
		  }
		  else
		  {
		  	$url=ADMINPATH."inserisci.php?cosa=".$this->cosa;
		  }

          if(isset($_REQUEST['url']))
		  {
		  	$url=$_REQUEST['url'];
		  }
		  $int=new interfaccia($this->_properties);

		  $int->genera_controlli_php($url);

		  foreach($this->_properties as $s)
		  {
		   //print $s['tipo'].'<br />';
		    if($s['tipo']!='file' &&  $s['tipo']!='tab' && $s['tipo']!='tabs' && $s['tipo']!='titolo' && !isset($s['onsubmit']))
		    {

		      if($s['tipo']=='checkbox' && $s['nome']!='privacy')
		      {
		        if(isset($s['unico']) && $_POST[$s['nome']]=='1')
		        {
		          $query2="update ".$cosa.' set '.$s['nome'].'=0';
		        }
		        if($_POST[$s['nome']]!='1')
		          $_POST[$s['nome']]=0;
		        else
		          $_POST[$s['nome']]=1;
		      }
		      elseif($s['tipo']=='textarea' || $s['tipo']=='text')
		      {
		      	  if(isset($s['unico']) && $_POST[$s['nome']]!='')
		        {
		          $unico=mysql_query("select * from ".$cosa." where ".$s['nome']."='".$_POST[$s['nome']]."'");
		          if(mysql_num_rows($unico)>0)
		          {
		          	header("Location: ../index.php?ins=err2");
		          	exit;
		          }
		        }
		          if($s['controllo']=='data')
		          {
		             $_POST[$s['nome']]=my_date($_POST[$s['nome']]);
		          }
		          else
		          {
		          	if($s['tipo']=='textarea' && !isset($s['codice']))
		          	{
		          		if(isset($s['editor']))
		          		{
		          			$_POST[$s['nome']]=stripslashes($_POST[$s['nome']]);
		          		}
		          	}
		          	elseif(!isset($s['codice']))
		          	{
		            	$_POST[$s['nome']]=addslashes($_POST[$s['nome']]);
		          	}
		          	else
		          	{
		          		$_POST[$s['nome']]=addslashes($_POST[$s['nome']]);
		          	}
		          }
		      }
		      if($i==0)
		      {
		      	if($s['nome']!='privacy')
		      	{
		        $query.=$s['nome'];
		        $value.="'".$_POST[$s['nome']]."'";
		        $i++;
		      	}
		      }
		      else
		      {
		      	if($s['nome']!='privacy')
		      	{
		        $query.=','.$s['nome'];
		        $value.=",'".$_POST[$s['nome']]."'";
		      	}
		      }
		    }
		    elseif (isset($s['genere']) && !isset($s['onsubmit']))
		    {
		    	$file[]=$s;
		    }
		    elseif(!isset($s['onsubmit']))
		    {
		        $foto[]=$s;
		    }
		  }
		  if(isset($query2))
		  {
		    mysql_query($query2)or die(mysql_error());
		  }
		    if($this->cosa=='utenti')
		    {
		    	$_POST['verificato']=gen_password();
		    	$query.=',verificato';
		    	$value.=",'".$_POST['verificato']."'";
		    }
		    $query.=')';
		    $value.=')';
		    //print $query.$value;
		    mysql_query($query.$value)or die(mysql_error());
		    $id_modello=mysql_insert_id();
		    $descrizione=$id_modello;
            $_POST['id']=$id_modello;
		  $i=0;
		  if(isset($foto))
		  {
		  foreach($foto as $f)
		  {
		    if($_FILES[$f['nome']]['tmp_name']!='')
		      $nome=ins_foto($_FILES[$f['nome']],$cosa.$i,$descrizione);
		    else
		      $nome='';
		    if(substr($cosa,$nome) || $nome=='')
		    {
		      $i++;
		      mysql_query("update ".$cosa." set ".$f['nome']."='".$nome."' where id_".$cosa."='".$id_modello."'")or die(mysql_error());
		    }
		  }
		  }
		  if (isset($file))
		  {
		  foreach ($file as $fi)
		  {
		  	$newName='tool'.$id_modello;
		  	$nome=copyFile($_FILES[$fi['nome']],$newName);
		  	if($nome!==false)
		  	{
		  		$i++;
		  		mysql_query("update ".$cosa." set ".$fi['nome']."='".$nome."' where id_".$cosa."='".$id_modello."'")or die(mysql_error());
		  	}
		  }
		  }

		  if($i==(count($foto)+count($file)))
		  {
		  	header("Location:".$url."&ins=ok");
		  	exit();
		  }
		  else
		  {
		    header("Location:".$url."&ins=err");
		  	exit();
		  }
	}
}
?>