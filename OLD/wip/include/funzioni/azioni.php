<?php
include('conf.php');
include(INCLUDEPATH.'array.php');
include(INCLUDEPATH.'cd.php');
include(FUNCTIONPATH.'utilita.php');
include(CLASSPATH.'azioni.class.php');
include(CLASSPATH.'interfaccia.class.php');

if(isset($_GET['azione']))
{

	switch ($_GET['azione'])
	{
		case 'conferma_data':
			$action=new azioni();
			$action->confermaData($_GET['id'],$_POST);
			break;
		case 'registrazione':
			$action=new azioni($utenti,$_GET['cosa']);
			$action->inserisci($_POST);
			break;	
		case 'recupera':
			$action=new azioni();
			$action->recupera($_POST['email']);
			break;
		case 'voto':
			$action=new azioni();
			$action->voto($_POST['id_affiliato'],$_POST['voto']);
			break;
		case 'commento':
			$action=new azioni();
			$action->commento($_POST['id_affiliato'],$_POST['commento']);
			break;
		case 'modifica':
			$action=new azioni($$_GET['cosa'],$_GET['cosa']);
			$action->modifica($_POST,$_GET['id']);
			break;
		case 'cancella':
			$action=new azioni($$_GET['cosa'],$_GET['cosa']);
			$action->cancella($_GET['nome'],$_GET['id']);
			break;	
		case 'inserisci':
			$action=new azioni($$_GET['cosa'],$_GET['cosa']);
			$action->inserisci($_POST);
			break;
	}
}

?>