<?php
function copyFile($file,$newName)
{
	$tipo=explode('.',$file['name']);
  	$tipo=$tipo[count($tipo)-1];
  	$newName=$newName.'.'.$tipo;

  	if(move_uploaded_file ($file['tmp_name'],FILEPATH.$newName))
  	{
  		return $newName;
  	}
  	return false;
}
function nomePagina($path)
{
	$pagina=explode('/',$path);
	$pag=$pagina[count($pagina)-1];
	return $pag;
}
function esisteEmail($email)
{
	$em=mysql_query("select * from clienti where email_cliente='".$email."'");
	if(mysql_num_rows($em)>0)
		return true;
	return false;
}
function gen_password($tot)
{
    $password='';
  	$char[] = 'a';
  	$char[] = 'b';
  	$char[] = 'c';
  	$char[] = 'd';
  	$char[] = 'e';
  	$char[] = 'f';
  	$char[] = 'g';
  	$char[] = 'h';
  	$char[] = 'i';
  	$char[] = 'j';
  	$char[] = 'k';
	$char[] = 'l';
	$char[] = 'm';
	$char[] = 'n';
	$char[] = 'o';
	$char[] = 'p';
	$char[] = 'q';
	$char[] = 'r';
	$char[] = 's';
	$char[] = 't';
	$char[] = 'u';
	$char[] = 'v';
	$char[] = 'w';
	$char[] = 'x';
	$char[] = 'y';
	$char[] = 'z';
	/*
	Utilizzo di caratteri maiuscoli(aumentare a 60 i numeri random)
	$char[] = 'A';
	$char[] = 'B';
	$char[] = 'C';
	$char[] = 'D';
	$char[] = 'E';
	$char[] = 'F';
	$char[] = 'G';
	$char[] = 'H';
	$char[] = 'I';
	$char[] = 'J';
	$char[] = 'K';
	$char[] = 'L';
	$char[] = 'M';
	$char[] = 'N';
	$char[] = 'O';
	$char[] = 'P';
	$char[] = 'Q';
	$char[] = 'R';
	$char[] = 'S';
	$char[] = 'T';
	$char[] = 'U';
	$char[] = 'V';
	$char[] = 'W';
	$char[] = 'X';
	$char[] = 'Y';
	$char[] = 'Z';

	*/
	$char[] = '0';
	$char[] = '1';
	$char[] = '2';
	$char[] = '3';
	$char[] = '4';
	$char[] = '5';
	$char[] = '6';
	$char[] = '7';
	$char[] = '8';
	$char[] = '9';
	for($i=1;$i<=$tot;$i++)
	{
	 $password=$password.$char[rand(0,36)];
	}
	return $password;
}

function check_email_address ($email)
{
  /*
  @DESCRIPTION: controlla la validitÔøΩ sintattica di un indirizzo email
  @PARAMS: $email ÔøΩ l'indirizzo email da controllare
  @RETURN: true se l'indirizzo ÔøΩ corretto
    false altrimenti
  */

  if ( empty($email) )
  {
   log_debug (
    "Email controllata nulla",
    "wrn",
    __CLASS__,
    __METHOD__
   );

   return false;
  }

  $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
  $domain = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';

  if ( !eregi("^$atom+(\\.$atom+)*@($domain?\\.)+$domain\$", $email) )
  {
   log_debug (
    "Email controllata non corretta: " . $email,
    "wrn",
    __CLASS__,
    __METHOD__
   );

   return false;
  }
  else
   return true;
}

function trunc_text($testo,$num,$url)
{
  $parole=explode(' ',strip_tags(stripslashes($testo)));
  if(count($parole)<=$num)
  {
    return '<p>'.$testo."</p><div class=\"clearer ten\"></div><a class=\"segue\" href=\"".$url."\">leggi tutto &raquo; </a>";
  }
  else
  {
    $risultato='';
    for($i=0;$i<=$num;$i++)
    {
      $risultato.=$parole[$i].' ';
    }
    $risultato='<p>'.$risultato."</p><div class=\"clearer ten\"></div><a class=\"segue\" href=\"".$url."\">leggi tutto &raquo; </a>";
    return $risultato;
  }
}
function invioRichiesta($post,$campi,$to,$msg)
{
	$messaggio="E' stata inviata la seguente richiesta da parte di un utente: \n\r";
	foreach ($campi as $c)
	{
		if($c['tipo']=='checkbox' && $post[$c['nome']]==1)
		{
			$messaggio.=$c['label']."\n\r";
		}
		elseif ($c['tipo']!='checkbox' && $c['tipo']!='file')
		{
			$messaggio.=$c['label'].': '.$post[$c['nome']]."\n\r";
		}
        elseif($c['tipo']=='file')
        {
	     $filename     = $_FILES[$c['nome']]['name'];
		 $tempFilename     = $_FILES[$c['nome']]['tmp_name'];
		 $content_type = $_FILES[$c['nome']]['type'];
		 if(isset($filename)){
			@$fd = fopen($tempFilename, "r");
			@$data = fread($fd, filesize($tempFilename));
			@fclose($fd);
		 }
        }
	
	}
     include(CLASSPATH.'MailAttach.php');
	 $mail = new MailAttach;	
	 $mail->from    = $post['email'];
	 $mail->to      = $to;
	 $mail->subject = $msg;
	 $mail->body    = $messaggio;
	
	 if($filename <> "")
	 {
		$mail->add_attachment($data, $filename, $content_type);
	 }
	 $enviado = $mail->send();
	if($enviado)
	{
		return true;
	}
	return false;
 }

 function invio_emailAdmin($oggetto,$messaggio,$from='info@beatriceweb.it',$address='info@beatriceweb.it')
 {
 	include(CLASSPATH.'class.phpmailer.php');
 	$mail             = new PHPMailer(); // defaults to using php "mail()"
	//$body             = file_get_contents('contents.html');
	$body             = eregi_replace("[\]",'',$body);
	$mail->AddReplyTo($from,"Team HostessPro");
	
	$mail->SetFrom($from, 'Team HostessPro');
	
	$mail->AddAddress($address, "Team HostessPro");
	
	$mail->Subject    = $oggetto;
	
	$mail->AltBody    = strip_tags($messaggio); // optional, comment out and test
	
	$mail->MsgHTML($messaggio);
	
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	
	if(!$mail->Send()) {
	  return "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  return "Message sent!";
	}
    
 }
 
function sostituzioneCaratteriSpeciali($testo)
{
	$testo=str_replace("&egrave;","e\'",$testo);
	$testo=str_replace("&eacute;","e\'",$testo);
	$testo=str_replace("&igrave;","i\'",$testo);
	$testo=str_replace("&agrave;","a\'",$testo);
	$testo=str_replace("&ugrave;","u\'",$testo);
	$testo=str_replace("&ograve;","o\'",$testo);
	$testo=str_replace("\?","e\'",$testo);
	$testo=str_replace("\?","e\'",$testo);
	$testo=str_replace("\?","i\'",$testo);
	$testo=str_replace("\?","a\'",$testo);
	$testo=str_replace("\?","u\'",$testo);
	$testo=str_replace("\?","o\'",$testo);
	return $testo;
}
function decodificaTitolo($nome)
{
	$nome=stripslashes($nome);
	$nome=str_replace('&agrave;','à',$nome);
	$nome=str_replace('&ograve;','ò',$nome);
	$nome=str_replace('&egrave;','è',$nome);
	$nome=str_replace('&igrave;','ì',$nome);
	$nome=str_replace('&ugrave;','ù',$nome);
	$nome=str_replace('&lt;','-',$nome);
	$nome=str_replace('&gt;','-',$nome);
	$nome=str_replace('\'',' ',$nome);
	$nome=str_replace('/','-',$nome);
	$nome=str_replace('&quot;','',str_replace(' ','-',stripslashes($nome)));
	return urlencode($nome);
}
function cod_titolo($titolo)
{
  return addslashes(htmlentities($titolo));
}
function cod_testo($testo)
{
  return addslashes(htmlentities($testo));
}
function titoloAggiornamento($id)
{
	$pra=mysql_fetch_assoc(mysql_query("select
											data,
											cliente,
											descrizione
									    from
									    	aggiornamenti
									    where
									    	id_aggiornamenti=".$id));
	if($pra['cliente']==1)
	{
		$inizio='Commento cliente del ';
	}
	else
	{
		$inizio='Aggiornamento del ';
	}
	return $inizio.norm_date($pra['data']);

}


function dec_html($stringa)
{
   return html_entity_decode(stripslashes($stringa));
}

function ins_file($file,$tipo,$id_im)
{
	if (is_uploaded_file($file['tmp_name']))
	{
		$tip=explode('\.',$file['name']);
		$ultimo=(count($tip)-1);
		$t=$tip[$ultimo];
		$nome=$tipo.$id_im.'.'.$t;
	    if (move_uploaded_file($file['tmp_name'],'../../files/'.$nome))
	    {
	    	return $nome;
	    }
	    else
	    {
	    	$messaggio='Copia del file fallita';
	     	return $messasggio;
	    }
  	}
  	else
  	{
  		$messaggio="Importazione del file fallita";
    	return $messaggio;
  	}
}

function ins_foto($foto,$tipo,$id_im)
{
	$tipot=explode('/',$foto['type']);
	if(	$tipot[0] != 'image'  )
	{
	    $messaggio='Tipo file non valido: devi inserire file in formato .jpg o .gif...'.$foto['type'];
	   return $messaggio;
	}
	else
	{
	include_once CLASSPATH.'config_img.php';
    include_once CLASSPATH.'upload.class.php';
    if($tipot[1]=='jpeg' || $tipot[1]=='pjpeg')
	   $tipoim='.jpg';
	else
	   $tipoim='.gif';
	$upt = new FileUpload(TMP_DIR);
	$upt->RenameFile($tipo.$id_im.$tipoim);
	$upt->Upload($foto);
	require_once (CLASSPATH.'image.class.php');
    $imgt = new Image(TMP_DIR . '/' . $upt->filename);
		ini_set('memory_limit', '30M');
		$result = $imgt->CreateSourceImage();
		if($result)
	   {
	    	$imgt->SaveProportionateImageP(THUMB_DIR . '/' . $upt->filename, IMAGE_QUALITY, IMAGE_THBN_HEIGHT,IMAGE_THBN_WIDTH);
			$imgt->SaveProportionateImageP(BIG_DIR . '/' . $upt->filename, IMAGE_QUALITY, IMAGE_BIG_HEIGHT,IMAGE_BIG_WIDTH);
		    $upt->DeleteFile();
		    return $upt->filename;
		}
		else
		{
		    $messaggio='Immagine non valida';
	    	$upt->DeleteFile();
			return $messaggio;
       	}
	 }
}

function my_date($data)
{
  $d=explode('/',$data);
  if(count($d)<3)
  {
    $d=explode('-',$data);
  }
  return $d[2]."-".$d[1]."-".$d[0];
}
function norm_date($data)
{
	$t=explode(' ',$data);
    $d=explode('-',$t[0]);
  return $d[2]."/".$d[1]."/".$d[0];
}

function lan2path($url,$lan_o,$lan_n,$variabili)
{
  $u=explode($lan_o,$url,2);
  return $u[0].$lan_n.$u[1]."?".$variabili;
 }

function br2nl($text)
{
  return  preg_replace('/<br\\s*?\/??>/i', '', $text);
}

/*Specifiche per sito radar*/

function visRiferimento($rif)
{
	if($rif!='')
	{
		echo '(Rif.:'.$rif.')';
	}
	return true;
}

function visPrezzo($prezzo,$vis,$descrizione,$lista)
{
	if($prezzo!='')
	{
		if($descrizione=='')
		{
			if($vis==0)
				$testo='';
			else
				$testo=	' &euro;'.number_format($prezzo,0,',','.');
		}
		else 
		{
			if($vis==0)
			{
				$testo=$lista[$descrizione];
			}
			else
			{
				if($descrizione!='trattabili')
					$testo=$lista[$descrizione].' &euro; '.number_format($prezzo,0,',','.');	
			    else 
			    		$testo=' &euro;'.number_format($prezzo,0,',','.').' '.$lista[$descrizione];	
			}
		}
	}
	else 
	{
		$testo='';
	}
	return $testo;
}
function costruisciPath($cosa,$immo,$lan)
    {
    	$la2=$lan;
    	if($lan=='ru')
    		$lan2='en';
    	$pathImmo=LANFOLDER.$cosa.'-'.$immo['categoria_immobile'].'-'.$immo['localita'];
    	if(isset($immo['nome_tipo_'.$lan2]) && $immo['nome_tipo_'.$lan2]!='')
    		$pathImmo.='-'.strtolower(decodificaTitolo($immo['nome_tipo_'.$lan2]));
    	$pathImmo.='-'.$desPrezzo[$immo['contratto']].'/'.$immo['id_immobili'].'_'.decodificaTitolo($immo['nome_immobile_'.$lan2]).'.html';
    	return $pathImmo;
    }
function indicaAnno()
{
	$mese=date('m');
	$anno=date('Y');
	if($m>9)
		return ++$anno;
    return $anno;    			
}    
function elencoLocalita()
{
	$localita=mysql_query("select * from localita");
	$loc='';
	while($l=mysql_fetch_assoc($localita))
	{
		$loc.=$l['localita'].',';
	}
	return $loc;
}
function elencoTipi($lan)
{
	$localita=mysql_query("select * from tipi");
	$loc='';
	while($l=mysql_fetch_assoc($localita))
	{
		$loc.=$l['nome_tipo_'.$lan].',';
	}
	return $loc;
}
function generaKeywords($im,$lan,$listaCat)
{
	$cosa=KEY_IMMOBILE.','.$listaCat[$im['categoria_immobile']];
	if($im['offeta']==1)
	{
		$cosa=KEY_CASE1.','.$listaCat[$im['categoria_immobile']];
	}
	elseif($im['last_minute']==1)
	{
		$cosa=KEY_LAST.','.$listaCat[$im['categoria_immobile']];
	}	
	elseif($im['residence']==1)
	{
		$cosa=KEY_RESIDENCE.','.$listaCat[$im['categoria_immobile']];
	}
	$tipo=$im['nome_tipo_'.$lan].' '.$im['regione'];
	$tipo.=','.$im['nome_tipo_'.$lan].' '.$im['localita'];
	$tipo.=','.$im['regione'].','.$im['localita'];
	if($im['comune']!=$im['localita']);
	{
		$tipo.=','.$im['nome_tipo_'.$lan].' '.$im['comune'];
		$tipo.=','.$im['comune'];
	}	
	return $cosa.','.$tipo;
}
function creaDescription($descrizione)
{
	$des=substr(stripslashes(strip_tags($descrizione)),0,220);
	return $des;	
}
function creaBriciole($cosa,$im,$pagina,$lan,$res=false)
{
	$briciole= '<a href="'.LANFOLDER.$pagina.'" title="'.LISTA.' '.$cosa.'" class="grassetto">'.LISTA.' '.str_replace('_', ' ',$cosa).'</a> >';
	if($im['residence']==0 && $cosa=='residence')
	{
		$briciole.='<a href="'.costruisciPath($cosa, $res, $lan).'" title="'.stripslashes($res['nome_immobile_'.$lan]).'"  class="grassetto">'.stripslashes($res['nome_immobile_'.$lan]).'</a> > ';
	}
    
	if($im['residence']==1)
	{
		$briciole.=stripslashes($im['localita']).' '.stripslashes($im['nome_immobile_'.$lan]);
	}
	else 
	{
	    $briciole.=stripslashes($im['localita']).' '.$im['contratto'].' '.stripslashes(strtolower($im['nome_tipo_'.$lan])).' '.stripslashes($im['nome_immobile_'.$lan]);
	}
    return $briciole;
}
?>
