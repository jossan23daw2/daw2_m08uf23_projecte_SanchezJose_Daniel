<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	
	session_start();
	if(!isset($_SESSION["novasessio"])){
	    header("location: https://zend-jodasa.fjeclot.net/m08uf23/login.php");
	}

	if(isset($_POST['method']) && $_POST['method'] == "PUT"){
	    $atribut=$_POST['ldap_attribute'];
	    $nou_contingut=$_POST['nouContingut'];

	    $uid = $_POST['uid'];
	    $unorg = $_POST['unorg'];
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
	    $entrada = $ldap->getEntry($dn);
	    if ($entrada){
	        Attribute::setAttribute($entrada,$atribut,$nou_contingut);
	        $ldap->update($dn, $entrada);
	        echo "Atribut modificat";
	    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
	}
		
?>
<html>
<body>
    <h2>Modificar dades de usuaris</h2>
    <form action="https://zend-jodasa.fjeclot.net/m08uf23/modificar.php" method="POST">
    	<input type="hidden" name="method" value="PUT">
    	Unitat Organitzativa: <input type="text" name="unorg"><br>
    	Usuari: <input type="text" name="uid"><br>
        Escull el atribut: <br>
        <input type="radio" name="ldap_attribute" value="uidNumber">ID Usuari 
        <input type="radio" name="ldap_attribute" value="gidNumber">ID Grup 
        <input type="radio" name="ldap_attribute" value="homeDirectory">Directori personal<br>
        <input type="radio" name="ldap_attribute" value="loginShell">Shell 
        <input type="radio" name="ldap_attribute" value="cn">Nom Complert 
        <input type="radio" name="ldap_attribute" value="givenName">Nom <br>
        <input type="radio" name="ldap_attribute" value="sn">Cognom 
        <input type="radio" name="ldap_attribute" value="postalAddress">Direcció 
        <input type="radio" name="ldap_attribute" value="mobile">Mobil <br>
        <input type="radio" name="ldap_attribute" value="telephoneNumber">Telefon 
        <input type="radio" name="ldap_attribute" value="title">Titol 
        <input type="radio" name="ldap_attribute" value="description">Descripció <br><br>
        Nou contingut: <input type="text" name="nouContingut"><br><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zend-jodasa.fjeclot.net/m08uf23/menu.php'">Tornar al menú</button>
</body>
</html>