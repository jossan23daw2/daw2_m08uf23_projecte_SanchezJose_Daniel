<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	session_start();
	if(!isset($_SESSION["novasessio"])){
	    header("location: https://zend-jodasa.fjeclot.net/m08uf23/login.php");
	}
	
	ini_set('display_errors', 0);

	if(isset($_POST['method']) && $_POST['method']=="DELETE"){
	    $uid = $_POST['usr'];
	    $unorg = $_POST['ou'];
	    
	    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	    
	    $opcions = [
	        'host' => 'zend-jodasa.fjeclot.net',
	        'username' => 'cn=admin,dc=fjeclot,dc=net',
	        'password' => 'fjeclot',
	        'bindRequiresDn' => true,
	        'accountDomainName' => 'fjeclot.net',
	        'baseDn' => 'dc=fjeclot,dc=net',
	    ];
	    
	    $ldap = new Ldap($opcions);
	    $ldap->bind();
	    try{
	        $ldap->delete($dn);
	        echo "<b>Entrada esborrada</b><br>";
	    } catch (Exception $e){
	        echo "<b>Aquesta entrada no existeix</b><br>";
	    }
	}
?>

<html>
	<body>
		<h3>ESBORRAR UN USUARI</h3>
		<form action="https://zend-jodasa.fjeclot.net/m08uf23/borrar.php" method="POST">
    		<input type="hidden" name="method" value="DELETE">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
    	</form>
    	<button onclick="location.href='https://zend-jodasa.fjeclot.net/m08uf23/menu.php'">Tornar al menú</button>
	</body>
</html>