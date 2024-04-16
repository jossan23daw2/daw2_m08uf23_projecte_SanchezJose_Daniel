<?php
    require 'vendor/autoload.php';
	use Laminas\Ldap\Ldap;
	
    session_start();
	ini_set('display_errors', 0);
	if ($_POST['cts'] && $_POST['adm']){
	   $opcions = [
            'host' => 'zend-jodasa.fjeclot.net',
		    'username' => "cn=admin,dc=fjeclot,dc=net",
   		    'password' => 'fjeclot',
   		    'bindRequiresDn' => true,
		    'accountDomainName' => 'fjeclot.net',
   		    'baseDn' => 'dc=fjeclot,dc=net',
       ];
	   $ldap = new Ldap($opcions);
	   $dn='cn='.$_POST['adm'].',dc=fjeclot,dc=net';
	   $ctsnya=$_POST['cts'];
	   try{
	       $ldap->bind($dn,$ctsnya);
	       $_SESSION['novasessio'] = true;
	       header("location: menu.php");
	   } catch (Exception $e){
	       echo "<b style='color:red;'>Contrasenya incorrecta</b><br><br>";	       
	   }
	}
?>
<html>
	<head>
		<title>
		</title>
	</head>
	<body>
		<a href="https://zend-jodasa.fjeclot.net/m08uf23/login.php">Torna a la pàgina inicial</a>
	</body>
</html>