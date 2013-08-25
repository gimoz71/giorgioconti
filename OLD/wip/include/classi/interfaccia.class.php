<?php
  class interfaccia{
    var $_properties;
    function interfaccia($elenco) {
        $this->_properties= array();
        foreach($elenco as $e)
        {
          $this->_properties[]=$e;
        }
    }
    function genera_script_editor()
    {
    	/*print "<script type=\"text/javascript\">\n";
		$testo= 'tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	skin : "o2k7",
    skin_variant : "black",
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false';
		
		$testo.='});';
   
		print $testo.'
		</script>';*/
		
		print "<script type=\"text/javascript\">\n";
		$testo= 'tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	skin : "o2k7",
    skin_variant : "black",
 	plugins : "-example",
	theme_advanced_buttons1 : "cut,copy,paste,pastetext,|,bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,|,undo,redo,link,unlink,code,cleanup",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false';
	
		$testo.='});';
   
		print $testo.'
		</script>';
    }

    function genera_controlli_php($url)
    {
    	$error=new ArrayObject();
    	foreach($this->_properties as $p)
      {
      	if(isset($p['controllo']))
        {
          if(isset($p['chiave']) && $p['chiave']==1)
      	 {
	         $numero=mysql_query("select * from ".$_GET['cosa']." where ".$p['nome']."='".$_REQUEST[$p['nome']]."'");
	         if(mysql_num_rows($numero)>0)
	         {
	          $n=mysql_fetch_assoc($numero);
	          if(!isset($_GET['id']) || ($n['id_'.$_GET['cosa']] != $_GET['id']))
	          {
	          	$error[]=ucfirst($p['label'])." gi&agrave; in uso per un altro utente";
	          	$_REQUEST[$p['nome']]='';
	          }
	         }
      	 }
      	 elseif(isset($p['unica_db']))
      	 {
      	 	$presente=mysql_query("select * from ".$_GET['cosa']." where ".$p['unica_db']."='".$_REQUEST[$p['unica_db']]."' and ".$p['nome']."='".$_REQUEST[$p['nome']]."'");
      	    if(mysql_num_rows($presente)>0)
      	    {
      	    	$error[]="Valore gi&agrave; inserito";
              	$_REQUEST[$p['nome']]='';
      	    }
      	 }
      	 elseif($p['nome']=='email')
      	 {
      	 	if($_REQUEST[$p['nome']]=='' || !check_email_address($_REQUEST[$p['nome']]))
            {
              	$error[]="Inserire un indirizzo email valido";
              	$_REQUEST[$p['nome']]='';

            }
      	 }
      	 elseif($p['tipo']=='password')
          {
          	if($_REQUEST[$p['nome']]=='' || (strlen($_REQUEST[$p['nome']])<6))
            {
              	$error[]="Inserire una password di minimo 6 caratteri";
              	$_REQUEST[$p['nome']]='';
              	$_REQUEST['c'.$p['nome']]='';
            }
            if($_REQUEST[$p['nome']]!=$_REQUEST['c'.$p['nome']])
            {
             	$error[]="Conferma della password errata";
             	$_REQUEST[$p['nome']]='';
              	$_REQUEST['c'.$p['nome']]='';
            }

          }
          elseif($p['controllo']=='*' && $p['tipo']!='checkbox' && $p['tipo']!='file')
          {
            if($_REQUEST[$p['nome']]=='')
            {
              	$error[]="Inserire testo valido nel campo ".$p['label'];
            }
          }
          elseif($p['controllo']=='*' && $p['tipo']=='checkbox')
          {
            if($_REQUEST[$p['nome']]!='1')
            {
              	$error[]="Accettazione della ".$p['label']." obbligatoria";
            }
          }
          elseif($p['controllo']=='*' && $p['tipo']=='file')
          {
            if($_FILES[$p['nome']]['tmp_name']=='')
            {
              	$error[]="Inserire il percorso del file nel campo ".$p['label'];
            }
          }
          elseif($p['controllo']=='data')
          {
          	$data=split("/",$_REQUEST[$p['nome']]);
          	if(count($data)<>3 || !checkdate($data[1],$data[0],$data[2]))
          	{
          		$error[]="Inserire la data nel formato corretto per il campo ".$p['label'];
          		$_REQUEST[$p['nome']]='';
          	}
          }
          elseif($p['controllo']=='numero')
          {
           if(!is_numeric($_REQUEST[$p['nome']]))
            {
              	$error[]="Inserire un numero nel campo ".$p['label'];
              	$_REQUEST[$p['nome']]='';
            }
          }
        }
      }

      if(count($error)>0)
      {

      	$_SESSION['require']=$_REQUEST;
      	$_SESSION['errori']=$error;

      	header("Location: ".$url);
      	exit();
      }
     }

    function genera_messaggi()
    {
    	if(isset($_GET['ins']) && $_GET['ins']=='ok')
    	{ ?>
    	<p class="ok">
    		<strong>Operazione compiuta con successo</strong>
    	</p>
        <div class="hr light"></div>
    		<?php
    	}
    	elseif (isset($_SESSION['errori']) && count($_SESSION['errori'])>0)
    	{
    		foreach ($_SESSION['errori'] as $er)
    		{?>
    		<p style="color: #ff0000">
    		<strong><?=$er?></strong>
    		</p>
    			<?php
    		}
    		session_unregister('errori');
    	}
    }

    function genera_controlli_js()
    {
      print "<script language=\"JavaScript\">\n";
      print "function cancellaFoto(nome,id,cosa)
      		{
      		    if(confirm('Sei sicuro di voler cancellare questa foto?'))
      		    {
      			location.href='../include/funzioni/azioni.php?azione=cancellaf&nomeF='+nome+'&id='+id+'&cosa='+cosa;
      		    }
      		}
      ";
      print "function invia()
			{
			   var sel=document.lista.prod.selectedIndex;
               var valore=document.lista.prod.options[sel].value;
			   if(valore!=\"\")
			   {
			    document.lista.submit();
			   }
			}";
      print "function verif_date(input)
              {
              var regex = new RegExp(\"[/-]\");
              var date = input.split(regex);
              var nbJours = new Array('',31,28,31,30,31,30,31,31,30,31,30,31);
              var result = true;

              if ( date['2']%4 == 0 && date['2']%100 > 0 || date['2']%400 == 0 )
              nbJours['2'] = 29;

              if( isNaN(date['2']) )
              result=false;

              if ( isNaN(date['1']) || date['1'] > 12 || date['1'] < 1 )
              result=false;

              if ( isNaN(date['0']) || date['0'] > nbJours[Math.round(date['1'])] || date['0'] < 1 )
              result=false;

              return result;
              }\n";
      print "function controllo()\n";
      print "{\n";

      print " var err='';\n";

      foreach($this->_properties as $p)
      {
        if(isset($p['onsubmit']))
        {
          $funSub="function sub".$p['nome']."(){ \n";
          $funSub.="var iniz=document.getElementById(\"".$p['nome']."\"); \n";
          //$funSub.="alert(iniz.selectedIndex); \n";
          $funSub.="var rif=iniz.options[iniz.selectedIndex].value; \n";
          $variabili=split('&',$_SERVER['QUERY_STRING']);
          $var='';
          foreach($variabili as $v)
          {
            $nom=split('=',$v);
            if($nom[0]!=$p['nome'])
            {
                $var.=$v;
            }
          }
          $funSub.="location.href = \"".$_SERVER['PHP_SELF']."?".$var."&".$p['nome']."=\"+rif \n";
          $funSub.="} \n";
        }
        if(isset($p['controllo']))
        {
          if($p['controllo']=='*' && $p['tipo']!='checkbox')
          {
            print " if(document.getElementById(\"".$p['nome']."\").value == '')\n";
            print "   {err=err+'Il campo ".$p['nome']." &egrave; obbligatorio.\\n';}\n";
          }
          elseif($p['controllo']=='*' && $p['tipo']=='checkbox')
          {
            print " if(document.getElementById(\"".$p['nome']."\").checked == false)\n";
            print "   {err=err+'Accettazione della ".$p['nome']." obbligatoria.\\n';}\n";
          }
          elseif($p['controllo']=='data')
          {
            print " if(document.getElementById(\"".$p['nome']."\").value== '' || !verif_date(document.getElementById(\"".$p['nome']."\").value))\n";
            print "   {err=err+'Il campo ".$p['nome']." &egrave; obbligatorio.\\n';}\n";
          }
          elseif($p['controllo']=='numero')
          {
            print " if(isNaN(document.getElementById(\"".$p['nome']."\").value) || document.getElementById(\"".$p['nome']."\").value == '')\n";
            print "   { err=err+'Il campo ".$p['nome']." deve essere un numero.\\n';}\n";
          }
          elseif($p['tipo']=='password')
          {
            print " if(document.getElementById(\"".$p['nome']."\").value== '')\n";
            print "   {err=err+'Il campo ".$p['nome']." &egrave; obbligatorio.\\n';}\n";
            print " if(document.getElementById(\"c".$p['nome']."\").value== '')\n";
            print "   {err=err+'Il campo Conferma ".$p['nome']." &egrave; obbligatorio.\\n';}\n";
            print " if(!document.getElementById(\"".$p['nome']."\").value.equals(document.getElementById(\"c".$p['nome']."\").value))\n";
            print "   {err=err+'Deve essere confermata la password\\n';}\n";
          }
          if(isset($p['dipendenza']) && !isset($p['facoltativo']))
          {
            $dipendenza="function aggiornamento";
          }
        }
      }
      print " if(err!=''){\n";
      print "   alert(err);\n";
      print "   return false; \n";
      print " }\n";
      print "return true;\n";
      print "}\n";
      if(isset($funSub))
      {
        print $funSub;
      }
      print "</script>\n";
    }


    function genera_form_inserimento()
    {
    $dis='';
    $tab=0;
    foreach($this->_properties as $p)
      {
      	$value='';
      	$classeExt=$p['classeExt'];
      	$classe=' class="'.$p['classe'].'" ';
      	if(isset($p['controllo']))
      	{
      		$p['label'].='*';
      	}
        if($p['tipo']=='tabs')
			{
				$tab=1;
				print '<div id="tabs">
							<ul>'."\n";
				foreach ($p['voci'] as $k=>$v)
				{
					print '<li><a href="#'.$k.'">'.$v.'</a></li>'."\n";
				}
				print '</ul><div class="clear"></div>'."\n";
			}
			elseif($p['tipo']=='tab')
			{
				if(!isset($p['primo']))
				{
					print "\n".'</div>'."\n";
				}
				print '<div id="'.$p['nome'].'">'."\n";
			}
			elseif ($p['tipo'] == 'titolo')
			{
				$i = 0;
				print '<h3 class="clear titolo_admin">' . $p['label'] . '</h3>';
			}
			elseif($p['tipo']=='textarea')
        {
        	if(isset($_SESSION['require']))
      		{
      			$value=$_SESSION['require'][$p['nome']];
      		}
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
          print "<div class=\"campo_inserimento\"><textarea id=\"".$p['nome']."\" name=\"".$p['nome']."\" ".$classe." cols=\"35\" rows=\"10\" ".$classe." >".$value."</textarea></div>\n";
          print "</div>\n";
        }
        elseif($p['tipo']=='password')
        {
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" ".$ch."  ".$classe."  /></div>\n";
          print "</div>\n";
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"c".$p['nome']."\">Conferma ".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"c".$p['nome']."\" name=\"c".$p['nome']."\" size=\"28\" ".$ch."  ".$classe." /></div>\n";
          print "</div>\n";
        }
        elseif($p['tipo']=='hidden')
        {
            if(isset($_SESSION['require']))
      		{
      			$value=$_SESSION['require'][$p['nome']];
      		}
      		else
      		{
      			$value=$p['valore'];
      		}
        	print "<input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" value=\"".$value."\" />\n";
        }
        elseif($p['tipo']=='select')
        {
           if(isset($_SESSION['require']))
      		{
      			$value=$_SESSION['require'][$p['nome']];
      		}

           $opt="";
           $fin="";
           if(isset($p['onsubmit']) || isset($p['facoltativo']))
           {
              $opt="<option value=\"\">-- Scegli --</option>";
              $fin=" onchange=\"sub".$p['nome']."()\"";
           }
          $disa='';
          if(isset($p['dipendenza']) && !isset($_GET[$p['dipendenza']['cosa']]) && $p['db']!=$p['dipendenza']['db'] )
               $disa='disabled';
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><select ".$disa." id=\"".$p['nome']."\"  ".$classe." name=\"".$p['nome']."\" ".$fin." >\n";
          print $opt;
          if(isset($p['voci']))
          {
            $sel='';
            foreach($p['voci'] as $v)
            {
              if(substr_count($v,'*')>=1)
              {
              $v=trim($v,'*');
              $sel='selected';
              }
              if($value==$v && $value!='')
                $sel='selected';
              print "<option value=\"".$v."\" ".$sel.">".$v."</option> \n";
              $sel='';
            }
          }
          elseif(isset($p['db']))
          {
             $cond='';
             if(isset($p['facoltativo']))
	           {
	              $opt="<option value=\"\">-- Scegli --</option>";

	           }
             if(isset($p['dipendenza']) && $p['dipendenza']['db']==$p['db'])
             {
                subOpt($p['nome'],$p['dipendenza']['cosa'],$p['db'],$p['campi'][1],0);
             }
             else
             {
               if(isset($p['dipendenza']) && isset($_GET[$p['dipendenza']['cosa']]))
               {
                  $cond=" where ".$p['dipendenza']['cosa']."='".$_GET[$p['dipendenza']['cosa']]."'";
               }
               elseif(isset($p['condizione']))
               {
                  $cond=" where ".$p['condizione'];
               }
               $query=mysql_query("select * from ".$p['db'].$cond);
               if(mysql_num_rows($query) >0)
               {
               while($ris=mysql_fetch_assoc($query))
               {
                 $opzioni='';
                 foreach($p['campi'] as $c)
                 {
                  $opzioni.=' '.$ris[$c];
                 }
                 $sel='';
                 if(isset($p['onsubmit']) && isset($_GET[$p['nome']]) && $_GET[$p['nome']]==$ris['id_'.$p['db']])
                 	$sel='selected';
                 if($value==$ris['id_'.$p['db']] && $value!='')
                	$sel='selected';
                 print "<option value=\"".$ris['id_'.$p['db']]."\" ".$sel.">".$opzioni.$_GET[$p['nome']]."</option>\n";
                }
               }
               elseif(!isset($p['facoltativo']))
               {
                $dis='disabled';
                $db=$p['db'];
               }

             }
          }
          elseif(isset($p['file']))
          {
            include_once('../include/'.$p['file'].'.php');
            foreach($$p['file'] as $el)
            {
            	$sel='';
            	if($value==$el['nome'] && $value!='')
                	$sel='selected';
              	print "<option value=\"".$el['nome']."\" ".$sel.">".$el['label']."</option>\n";
            }
          }
          print "</select></div></div>\n";
        }
        else
        {
          print "<div class=\"riga_form ".$classeExt." \">\n";
          $ch='';
          $privacy='';
          if($p['tipo']=='checkbox')
          {
            $ch="value=\"1\"";
          	if((isset($_SESSION['require']) && $_SESSION['require'][$p['nome']]=='1') || $p['nome']=='privacy')
      		{
      			$value=' checked';
      			if($p['nome']=='privacy')
      			{
      				$privacy='<textarea rows="5" cols="50" name="privacy"  '.$classe.'  readonly>';

$privacy .= "Ai sensi dell'art.13 del D.Lgs. 196/2003 'codice in materia di protezione dei dati personali', La informiamo che i dati
personali che Lei ci fornisce potranno formare oggetto del trattamento, nel rispetto della normativa sopra richiamata e degli obblighi di riservatezza.
Per trattamento di dati personali si intende la loro raccolta, la registrazione, l'organizzazione, la conservazione, la consultazione, l'elaborazione, la modificazione, la selezione, l'estrazione, il raffronto, l'utilizzo, l'interconnessione, il blocco, la comunicazione, la diffusione, la cancellazione e la distruzione di dati, ovvero la combinazione di una o più operazioni.
Il conferimento di tali dati attraverso questo sito ha natura facoltativa.
Il trattamento dei dati avverrà mediante strumenti idonei a garantire la sicurezza e la riservatezza e potrà essere effettuato anche attraverso strumenti automatizzati atti a memorizzare, gestire e trasmettere i dati stessi.
La informiamo inoltre che i dati personali a Lei riferibili saranno trattai nel rispetto delle modalità stabilite dall'art.11 del D. Lgs. 196/2003, che prevede, tra l'altro, che i dati stessi siano trattati in modo lecito e secondo correttezza, raccolti e registrati per scopi determinati, espliciti e legittimi; esatti e, se necessario, aggiornati; pertinenti, completi e non eccedenti rispetto alle finalità del trattamento.
La informiamo altresì che il predetto trattamento dei suoi dati personali saranno gestiti direttamente dall' Avv. Massimo Banchelli.
La informiamo altresì che, in relazione ai predetti trattamenti, Lei potrà esercitare i diritti di cui all'art.7 del D.Lgs. 196/2003 il cui testo è allegato e fa parte integrante della presente informativa.
Ai sensi dell'art.13 Le facciamo presente inoltre che l'eventuale rifiuto di rispondere, al momento della raccolta delle informazioni, o l'eventuale diniego di trattamento dei dati può comportare la nostra oggettiva impossibilità di osservare parte degli obblighi di legge e/o di contratto connessi al Suo rapporto con lo Studio Legale Banchelli

Finalità e modalità del trattamento

I suoi dati personali sono stati da noi acquisiti e saranno da noi trattati
-  per adempiere agli obblighi di legge e contrattuali e per esigenze di tipo operativo gestionale, tecnico e statistico;
-  manualmente e/o mediante strumenti informatici e/o telematici in modo da garantire la sicurezza e la riservatezza degli stessi.
Natura del conferimento e conseguenza del rifiuto
Il conferimento ha natura facoltativa, ai fini di raccogliere curricula vitae e offrire opportunità per instaurare rapporti di lavoro e/o di collaborazione.
Il rifiuto da parte Sua comporterà l'oggettiva impossibilità della prosecuzione o dell'instaurazione dell'acquisizione dei suoi dati e inserimento nelle nostre banche dati.
Diritti dell'interessato
Presso il titolare o i responsabili del trattamento l'interessato potrà accedere ai propri dati personali per verificarne l'utilizzo o, eventualmente per correggerli, aggiornarli nei limiti previsti dalla legge, ovvero per richiedere la cancellazione od opporsi al loro trattamento, se trattati in violazione di legge; i diritti dell'interessato sono elencati nell'art.7 del D.Lgs. 196/2003 qui allegato e parte integrante della presente informativa.
Titolare del Trattamento Dati
Avv. Massimo Banchelli, Via Marradi 171 Livorno (LI)
Restiamo a sua disposizione per ogni ulteriore notizia che si rendesse necessaria e porgiamo distinti saluti.

Art.7 Diritto dell'accesso ai dati personali ed altri diritti

- L'interessato ha diritto di ottenere la conferma dell'esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.

- L'interessato ha diritto di ottenere l'indicazione:
-  dell'origine dei dati personali;
-  delle finalità e modalità di trattamento;
�  della logica applicata in caso di trattamento effettuato con l'ausilio di strumenti elettronici;
�  degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell'art.5 comma 2 del D.Lgs. 196/2003;
�  dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualità di rappresentante designato nel territorio dello Stato, di responsabili o incaricati.

- L'interessato ha diritto di ottenere:
�  l'aggiornamento, la rettificazione, ovvero, quando vi ha interesse, l'integrazione dei dati;
�  la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non è necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;
�  l'attestazione che le operazioni di cui alle lettere a) e b) sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.

- L'interessato ha diritto di opporsi, in tutto o in parte:
�  per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorché pertinenti allo scopo della raccolta;
�  al trattamento di dati personali che lo riguardano a fini di invio di materiale pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazione commerciale.

Consenso del trattamento dei dati personali

In relazione all'informativa sul trattamento dei dati personali sopra riportata e per le finalità connesse alle reciproche obbligazioni derivanti dal rapporto contrattuale da instaurarsi/intercorrente nonché per l'adempimento degli obblighi di legge, contrattuali e di normativa anche secondaria e comunitaria
do il mio consenso
al trattamento dei miei dati personali il cui trattamento non rientri ai sensi dell'art.24 D.Lgs. 196/2003 nei casi di esclusione del consenso;
al trattamento dei miei dati personali da parte di persone fisiche o giuridiche la cui facoltà di accedere ai miei dati sia riconosciuta da disposizioni di legge;
al trattamento dei miei dati personali da parte di persone fisiche o giuridiche che forniscano specifici servizi elaborativi o che svolgono attività strumentali, funzionali o di supporto a quelle dello Studio Legale Banchelli;
qualora ciò sia necessario per i futuri contatti al fine di definire possibili collaborazioni con Avv. Banchelli";
      				$privacy.='</textarea>'."\n";
      			}
      		}
      		elseif (isset($p['checked']))
      		{
      			$value=' checked="checked"';
      		}
          }
          if(isset($_SESSION['require']) && $_SESSION['require'][$p['nome']]!='' && $p['tipo']!='file')
      		{
      			$value=" value=\"".$_SESSION['require'][$p['nome']]."\"";
      		}
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']." </label></div>\n";
          print $privacy;
          print "<div class=\"campo_inserimento\"><input    type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" ".$ch." ".$value." ".$classe." /></div>\n";
          print "</div>\n";
        }
      }
    if($tab==1)
      {
      	print '<!--fine ultimo tab e chiusura div tab -->'."\n";
      	print '</div></div>'."\n";
      }
	  print "<div class=\"clearer twenty\"></div>";
	  print "<div class=\"hr light\"></div>";
	  print "<div class=\"clearer twenty\"></div>";
      print "<div class=\"submit_form\">\n";
        print"<div class=\"label_form\"><input type=\"submit\" value=\"Inserisci\" name=\"inserisci\" ".$dis." class=\"invia\"/></div>\n";
        if($dis!='')
      {
        print "<div class=\"label_form\" style=\"clear: left;\"><p class=\"testo\">Prima procedere all'inserimento di ".$db."</p></div>\n";
      }
      print "</div>\n";
      session_unregister('require');
    }

    function genera_form_modifica($db,$id)
    {  
    	if(isset($p['controllo']))
      	{
      		$p['label'].='*';
      	}
      	$tab=0;
       if($id!=0)
       {
        $uno=mysql_fetch_assoc(mysql_query("select * from ".$db." where id_".$db."=".$id));
       }
       else
       {
        if($db=='home')
          $db='pagine where home=1';
        elseif($db=='pagine')
          $db='pagine where home=0';
        $molti=mysql_query("select * from ".$db);
       }
      if(isset($uno))
      {
       foreach($this->_properties as $p)
      {
      	$cond='';
        $classeExt=$p['classeExt'];
      	$classe=' class="'.$p['classe'].'" ';
      	if($p['controllo']=='data')
      	 {
      	 	$uno[$p['nome']]=norm_date($uno[$p['nome']]);
      	 }
      	 
          if($p['tipo']=='tabs')
			{
				$tab=1;
				print '<div id="tabs">
							<ul>'."\n";
				foreach ($p['voci'] as $k=>$v)
				{
					print '<li><a href="#'.$k.'">'.$v.'</a></li>'."\n";
				}
				print '</ul><div class="clear"></div>'."\n";
			}
			elseif($p['tipo']=='tab')
			{
				if(!isset($p['primo']))
				{
					print "\n".'</div>'."\n";
				}
				print '<div id="'.$p['nome'].'">'."\n";
			}
			elseif ($p['tipo'] == 'titolo')
			{
				$i = 0;
				print '<h3 class="clear titolo_admin">' . $p['label'] . '</h3>';
			}
			elseif($p['tipo']=='textarea')
         {
           print "<div class=\"riga_form ".$classeExt." \">\n";
           print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
           print "<div class=\"campo_inserimento\"><textarea id=\"".$p['nome']."\" name=\"".$p['nome']."\" cols=\"60\" rows=\"5\" ".$classe.">".stripslashes($uno[$p['nome']])."</textarea></div>\n";
           print "</div>\n";
         }
         elseif($p['tipo']=='password')
         {
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" value=\"".stripslashes($uno[$p['nome']])."\"  ".$classe."  /></div>\n";
          print "</div>\n";
          print "<div class=\"riga_form ".$classeExt." \">\n";
          print "<div class=\"label_form\"><label for=\"c".$p['nome']."\">Conferma ".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"c".$p['nome']."\" name=\"c".$p['nome']."\" size=\"28\" value=\"".stripslashes($uno[$p['nome']])."\"  ".$classe."  /></div>\n";
          print "</div>\n";
         }
         elseif($p['tipo']=='select')
         {
            print "<div class=\"riga_form ".$classeExt." \">\n";
            print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
            print "<div class=\"campo_inserimento\"><select id=\"".$p['nome']."\" name=\"".$p['nome']."\"  ".$classe." >\n";
          if(isset($p['facoltativo']))
           {
              print "<option value=\"\">-- Scegli --</option>";

           }
            if(isset($p['modif']) && $p['modif']=='no')
              print "<option value=''>- Mesi -</option>";
            if(isset($p['voci']))
            {
              $sel='';
              foreach($p['voci'] as $v)
              {
                if(substr_count($v,'*')>=1)
                {
                $v=trim($v,'*');
                }
                if(strtoupper($uno[$p['nome']])==strtoupper($v))
                  $sel='selected';
                print "<option value=\"".$v."\" ".$sel.">".$v."</option>\n";
                $sel='';
              }
            print "</select></div></div>\n";
            }
            elseif(isset($p['db']))
            {
              if(isset($p['dipendenza']) && $p['dipendenza']['db']==$p['db'])
             {
                subOpt($p['nome'],$p['dipendenza']['cosa'],$p['db'],$p['campi'][1],$uno[$p['nome']]);
             }
             else
             	{
             	if(isset($p['condizione']))
               	{
                  $cond=" where ".$p['condizione'];
               	}
               	print "select * from ".$p['db'].$cond;
              	$query=mysql_query("select * from ".$p['db'].$cond)or die(mysql_error());

               while($ris=mysql_fetch_assoc($query))
               {
                 $sel='';
                 $opzioni='';
                 foreach($p['campi'] as $c)
                 {
                  $opzioni.=' '.$ris[$c];
                  if(strtoupper($uno[$p['nome']])==strtoupper($ris['id_'.$p['db']]))
                    $sel='selected';
                 }
                 print "<option value=\"".$ris['id_'.$p['db']]."\" ".$sel.">".$opzioni."</option>\n";
                 $sel='';
               }
             }
              print "</select></div></div>\n";
            }
          }
          elseif($p['tipo']=='file')
          {
            print "<div class=\"riga_form ".$classeExt." \">\n";
            $img='';
            if(is_file('../images/thbn/'.$uno[$p['nome']]))
            {
              $img="<img src=\"../images/thbn/".$uno[$p['nome']]."?num=".rand()."\"/ class=\"foto\">\n";
			  print "<div class=\"clearer\"></div>";
			  print "<div class=\"label_img\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
              print "<div class=\"immagine\" >";
              print $img."\n";
              print "<input type=\"button\" name=\"cancella_foto\" value=\"Cancella\"  ".$classe." onclick=\"cancellaFoto('".$p['nome']."','".$id."','".$_GET['cosa']."');\" />";
              print "</div>\n";
			 
            }
             
			 print "<input type=\"".$p['tipo']."\" name=\"".$p['nome']."\" size=\"30\" ".$classe."  />\n";
             print "</div>\n";
			 print "</div>\n";
			
          }
          else
          {
            print "<div class=\"riga_form ".$classeExt." \">\n";
            $ch='';
            if($p['tipo']=='checkbox')
            {
              $ch="value=\"1\"";
              if($uno[$p['nome']]==1)
             	$ch.=" checked";
            }
            else
            {
              $ch="value=\"".stripslashes($uno[$p['nome']])."\"";
            }
            print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
            print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" ".$ch."  ".$classe."  /></div>\n";
            
          }
        }
      }
      else
      {
        while($r=mysql_fetch_assoc($molti))
        {
           foreach($this->_properties as $obj)
           {
            if($obj['nome']==$r['nome'])
            {
              $p=$obj;
              break;
            }
           }
           if($p['tipo']=='textarea')
           {
             print "<div class=\"riga_form ".$classeExt." \">\n";
             print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
             print "<div class=\"campo_inserimento\"><textarea name=\"".$p['nome']."\" id=\"".$p['nome']."\" cols=\"28\" rows=\"5\" ".$classe." >".$r['testo']."</textarea></div>\n";
             print "</div>\n";
           }
        }
      }
     if($tab==1)
      {
      	print '<!--fine ultimo tab e chiusura div tab -->'."\n";
      	print '</div></div>'."\n";
      }
	  print "<div class=\"clearer twenty\"></div>";
	  print "<div class=\"hr light\"></div>";
	  print "<div class=\"clearer twenty\"></div>";
      print "<div class=\"submit_form\">\n";
      print "<div class=\"label_form\"><input type=\"submit\" value=\"Modifica\" name=\"modifica\" class=\"invia\" /></div>\n";
      print "</div>\n";
    }

    function genera_lista($db,$nome,$fun=false,$id=0,$idnome='',$cond=false)
    {
      $fine='';
      $url='';
      if($id>0)
      {
        $fine=' where id_'.$idnome.'='.$nome;
        $url="&amp;idNome=".$idnome;
        if($fun!==false)
        {
        	$url.="&amp;fun=".$fun;
        }
      }
      if($cond)
      {
      	$fine=$cond;
      }
      $query="select * from ".$db.$fine;
     //print $query;
      $elenco=mysql_query("select * from ".$db.$fine)or die($query.' '.mysql_error());
      if(mysql_num_rows($elenco)==0)
      {
        print "<div class=\"testo\">Spiacenti, la ricerca non ha prodotto risultati.</p></div>\n";
      }
      $n=split('-',$nome);
      $lung=count($n);
	  
	  if($db!='foto')
         {
	  	print "<h2>Modifica o cancella una voce:</h2>\n";
		 }
		 else
		 {
		 print "<h2>modifica immagini galleria </h2>\n";
		 }
	  print "<div class=\"clearer ten\"></div>\n";
	  
      while($el=mysql_fetch_assoc($elenco))
      {
         $no='';
         if($fun)
         {
         	$no=$fun($el['id_'.$db]);
         }
         else
         {
	         for($d=0;$d<$lung;$d++)
	         {
	           $no.=$el[$n[$d]].' ';
	         }
         }
         
         print "<form class=\"lista\" action=\"../include/funzioni/azioni.php?azione=cancella&cosa=".$db."&id=".$el['id_'.$db].$url."&amp;nome=".$_GET['nome']."\"  method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Si vuole procedere con la cancellazione di questo oggetto?');\">\n";
         if($db!='foto')
         {
		  print "<div class=\"item\">\n";		 
          print "<div class=\"title_gallery list\"><h3 style=\"margin: 0; padding: 0;\">".$no."</h3></div>\n";
          print "<div class=\"campo_inserimento list\"><input type=\"button\" name=\"modifica\" value=\"Modifica\" class=\"modifica\" onclick=\"javascript:location.replace('./modifica.php?cosa=".$db."&id=".$el['id_'.$db].$url."')\"/>\n";
          print "<br>\n";
		 }
         else
         {
          print "<div class=\"item\">\n";
          print "<div class=\"foto\" ><img src=\"../images/thbn/".$el['nome_foto']."\" width=\"120\" height=\"80\" /><input type=\"hidden\" name=\"nome\" value=\"".$el['nome_foto']."\" /></div>\n";
          print "<div class=\"campo_inserimento list\"><input type=\"button\" name=\"modifica\" value=\"Modifica\" class=\"modifica\" onclick=\"javascript:location.replace('./modifica.php?cosa=".$db."&id=".$el['id_'.$db].$url."')\"/>\n";
		  print "<br>\n";
         }
         print "<input type=\"submit\" name=\"cancella\" value=\"Cancella\" class=\"cancella\" /></div>\n";
		 print "</div>\n";
         print "</form>\n";
		 /*print "<div class=\"clearer twenty\"></div>\n";
		 print "<div class=\"hr light\"></div>\n";
		 print "<div class=\"clearer twenty\"></div>\n";*/
      }
    }

    /*Genera una lista per le tabelle di congiunzione molti a molti*/
    function genera_lista_cond($db1,$db2,$nome,$cond)
    {
      $elenco=mysql_query($cond);
      if(mysql_num_rows($elenco)==0)
      {
        print "<div class=\"testo\">Spiacenti, non sono stati inseriti oggetti.</p></div>\n";
      }
      $n=split('-',$nome);
      $lung=count($n);
      $db=$db1.'_'.$db2;
      while($el=mysql_fetch_assoc($elenco))
      {
         $no='';
         for($d=0;$d<$lung;$d++)
         {
           $no.=$el[$n[$d]].' ';
         }
         print "<form action=\"../include/funzioni/modifica.php?cosa=".$db."&amp;id_".$db1."=".$el['id_'.$db1]."&amp;id_".$db2."=".$el['id_'.$db2]."&amp;nome=".$_GET['nome']."\"  method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Si vuole procedere con la cancellazione di questo oggetto?');\">\n";
         if($db!='foto_prodotti')
         {
          print "<div class=\"label_form\">".$no."</div>\n";
          print "<div class=\"campo_inserimento\">\n";
         }
         else
         {
          print "<div class=\"foto\"><img src=\"../immagini/thbn/".$el['nome']."\" /><input type=\"hidden\" name=\"nome\" value=\"".$el['nome']."\" />\n";
         }
         print "<input type=\"submit\" name=\"cancella\" value=\"Cancella\" class=\"invia\" /></div>\n";
         print "</form>";
      }
    }

    function genera_lista_prod($negozio)
    {
      $elenco=mysql_query("select p.nome_ita,n.id_categorie,p.id_categorie,p.id_prodotti from prodotti p, negozi n where p.id_negozi=n.id_negozi and p.id_negozi='".$negozio."'")or die(mysql_error());
      if(mysql_num_rows($elenco)==0)
      {
        print "<div class=\"testo\">Spiacenti, non sono stati inseriti oggetti.</p></div>\n";
      }
      while($el=mysql_fetch_assoc($elenco))
      {
         print "<form action=\"../include/funzioni/modifica.php?cosa=prodotti&id=".$el['id_prodotti']."&amp;nome=".$_GET['nome']."\"  method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Si vuole procedere con la cancellazione di questo oggetto?');\">\n";
         print "<div class=\"label_form\">".$el['nome_ita']."</div>\n";
         print "<div class=\"campo_inserimento\"><input type=\"button\" name=\"modifica\" value=\"Modifica\" onclick=\"javascript:location.replace('./mod_prodotti_car.php?cat=1&amp;cosa=prodotti&id=".$el['id_prodotti']."')\"/>\n";
         print "<input type=\"button\" name=\"modifica\" value=\"Modifica categoria\" class=\"invia\" onclick=\"javascript:location.replace('./mod_prodotti_car.php?mod=1&amp;id_negozi=".$negozio."&amp;cosa=prodotti&id=".$el['id_prodotti']."&amp;scat=1')\"/>\n";
         print "<input type=\"submit\" name=\"cancella\" value=\"Cancella\" class=\"invia\" /></div>\n";
         print "</form>";
      }
    }

      function genera_form_modifica_prod($id)
    {
      $uno=mysql_fetch_assoc(mysql_query("select * from prodotti where id_prodotti=".$id));
      if(isset($uno))
      {
       foreach($this->_properties as $p)
      {
      	if(isset($p['controllo']))
      	{
      		$p['label'].='*';
      	}
      	 if(isset($p['valore']))
           	$uno[$p['nome']]=$p['valore'];
         if($p['tipo']=='textarea')
         {
           if(isset($p['valore']))
           	$uno[$p['nome']]=$p['valore'];
           print "<div class=\"riga_form\">\n";
           print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
           print "<div class=\"campo_inserimento\"><textarea id=\"".$p['nome']."\" name=\"".$p['nome']."\" cols=\"28\" rows=\"5\">".$uno[$p['nome']]."</textarea></div>\n";
           print "</div>\n";
         }
         elseif($p['tipo']=='password')
         {
          print "<div class=\"riga_form\">\n";
          print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" value=\"".$uno[$p['nome']]."\"  /></div>\n";
          print "</div>\n";
          print "<div class=\"riga_form\">\n";
          print "<div class=\"label_form\"><label for=\"c".$p['nome']."\">Conferma ".$p['label']." </label></div>\n";
          print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"c".$p['nome']."\" name=\"c".$p['nome']."\" size=\"28\" value=\"".$uno[$p['nome']]."\" /></div>\n";
          print "</div>\n";
         }
         elseif($p['tipo']=='select')
         {
            print "<div class=\"riga_form\">\n";
            print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
            print "<div class=\"campo_inserimento\"><select id=\"".$p['nome']."\" name=\"".$p['nome']."\">\n";
            if(isset($p['modif']) && $p['modif']=='no')
              print "<option value=''>- Mesi -</option>";
            if(isset($p['voci']))
            {
              $sel='';
              foreach($p['voci'] as $v)
              {
                if(substr_count($v,'*')>=1)
                {
                $v=trim($v,'*');
                }
                if(strtoupper($uno[$p['nome']])==strtoupper($v))
                  $sel='selected';
                print "<option value=\"".$v."\" ".$sel.">".$v."</option>\n";
                $sel='';
              }
            print "</select></div>\n";
			print "<div class=\"clearer ten\"></div>\n";
            }
            elseif(isset($p['db']))
            {
              if(isset($p['dipendenza']) && $p['dipendenza']['db']==$p['db'])
             {
                subOpt($p['nome'],$p['dipendenza']['cosa'],$p['db'],$p['campi'][1],$uno[$p['nome']]);
             }
             else
             {
             if(isset($p['condizione']))
               {
                  $cond=" where ".$p['condizione'];
               }
              $query=mysql_query("select * from ".$p['db'].$cond);

               while($ris=mysql_fetch_assoc($query))
               {
                 $sel='';
                 $opzioni='';
                 foreach($p['campi'] as $c)
                 {
                  $opzioni.=' '.$ris[$c];
                  if(strtoupper($uno[$p['nome']])==strtoupper($ris['id_'.$p['db']]))
                    $sel='selected';
                 }
                 print "<option value=\"".$ris['id_'.$p['db']]."\" ".$sel.">".$opzioni."</option>\n";
                 $sel='';
               }
             }
              print "</select></div></div>\n";
            }
          }
          elseif($p['tipo']=='file')
          {
            print "<div class=\"riga_form\">\n";
            $img='';
            if(is_file('../immagini/thbn/'.$uno[$p['nome']]))
            {
              $img="<img src=\"../immagini/thbn/".$uno[$p['nome']]."?num=".rand()."\"/><br />\n";

            }
             print "<div class=\"label_img\">".$img."<label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
             print "<div class=\"mod_img\"><input type=\"".$p['tipo']."\" name=\"".$p['nome']."\" size=\"30\" /></div>\n";
             print "</div>\n";
          }
          else
          {
            print "<div class=\"riga_form\">\n";
            $ch='';
            if($p['tipo']=='checkbox')
            {
              $ch="value=\"1\"";
              if($uno[$p['nome']]==1)
               $ch.=" checked";
            }
            else
            {
              $ch="value=\"".$uno[$p['nome']]."\"";
            }
            print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
            print "<div class=\"campo_inserimento\"><input type=\"".$p['tipo']."\" id=\"".$p['nome']."\" name=\"".$p['nome']."\" size=\"28\" ".$ch." /></div>\n";
            print "</div>\n";
          }
        }
      }
      else
      {
        while($r=mysql_fetch_assoc($molti))
        {
           foreach($this->_properties as $obj)
           {
            if($obj['nome']==$r['nome'])
            {
              $p=$obj;
              break;
            }
           }
           if($p['tipo']=='textarea')
           {
             print "<div class=\"riga_form\">\n";
             print "<div class=\"label_form\"><label for=\"".$p['nome']."\">".$p['label']."</label></div>\n";
             print "<div class=\"campo_inserimento\"><textarea name=\"".$p['nome']."\" id=\"".$p['nome']."\" cols=\"28\" rows=\"5\">".$r['testo']."</textarea></div>\n";
             print "</div>\n";
           }
        }
      }
	  print "<div class=\"clearer twenty\"></div>";
	  print "<div class=\"hr light\"></div>";
	  print "<div class=\"clearer twenty\"></div>";
      print "<div class=\"submit_form\">\n";
      print "<div class=\"label_form\"><input type=\"submit\" value=\"Modifica\" name=\"modifica\" class=\"invia\" /></div>\n";
      print "</div>\n";
    }

  }
?>
