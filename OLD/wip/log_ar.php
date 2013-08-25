<?php 
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pittore - Giorgio Conti</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="" />
<meta name="keywords" content="giorgio conti, pittura, pittore, portfolio eventi artistici, eventi"/>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/admin.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/utility.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
</head>
<body>
<div id="nav">
    <div id="title_admin">
        <h1>GIORGIO CONTI</h1>
    </div>
    <div >
        <ul>
            <li>Benvenuti nel pannello di controllo del sito Giorgio Conti</li>
        </ul>
    </div>
</div>
<div id="login">
    <form action="include/funzioni/login.php" method="post">
        <table width="100%">
        	<tr>
            	<td colspan="2">
                <strong>Inserisci el tue credenziali per accedere</strong>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                <div class="clearer ten"></div>
                <div class="hr light dark ten"></div>
                </td>
            </tr>
            <tr>
                <td>Nome utente</td>
                <td><input type="text" name="username" class="fields" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="passwd" class="fields" /></td>
            </tr>
            <tr>
            	<td colspan="2">
                <div class="clearer ten"></div>
                <div class="hr light dark ten"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="login" value="Login" class="button" /></td>
            </tr>
        </table>
    </form>
        <?php 
if(isset($_SESSION['errori']))
{
	foreach($_SESSION['errori'] as $e)
	{
		print '<p style="color: red">'.$e.'</p>';
	}
	unset($_SESSION['errori']);
}

?>

</div>
<div> <span class="reference">&copy; 2011 Giorgio Conti - Tutti i diritti riservati. </span></div>
<
</body>
</html>