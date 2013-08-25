<?php session_start();
include_once('conf.php');
include_once(INCLUDEPATH.'cd.php');

if (isset($_GET['logout']))
{
	session_unregister('utente');
	 header("Location: ".HOMEPATH."index.php");
     exit();
}
elseif(isset($_POST['login']))
{
 $utente=mysql_query("select * from utenti where upper(username) like upper('".addslashes($_POST['username'])."') and passwd='".addslashes(md5($_POST['passwd']))."'")or die(mysql_error());
 if(mysql_num_rows($utente)< 1)
 {
   $_SESSION['errori'][]='Username o password errati';
   header("Location: ../../log_ar.php?ins=err");
   exit();
 }
 else
 {
    $_SESSION['utente']=mysql_fetch_assoc($utente);
   	header("Location: ../../amministrazione/index.php");
    exit();
 }
}
?>
