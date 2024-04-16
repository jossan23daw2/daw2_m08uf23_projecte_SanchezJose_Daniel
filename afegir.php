<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	session_start();
	if(!isset($_SESSION["novasessio"])){
	    header("location: https://zend-jodasa.fjeclot.net/m08uf23/login.php");
	}
	
	ini_set('display_errors', 0);

	if(isset($_POST['afegir'])){
	    $uid=$_POST['uid'];
	    $unorg='usuaris';
	    $num_id=$_POST['num_id'];
	    $grup=$_POST['grup'];
	    $dir_pers=$_POST['dir_pers'];
	    $sh=$_POST['sh'];
	    $cn=$_POST['cn'];
	    $sn=$_POST['sn'];
	    $nom=$_POST['nom'];
	    $mobil=$_POST['mobil'];
	    $adressa=$_POST['adressa'];
	    $telefon=$_POST['telefon'];
	    $titol=$_POST['titol'];
	    $descripcio=$_POST['descripcio'];
	    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
	    
	    $domini = 'dc=fjeclot,dc=net';
	    $opcions = [
	        'host' => 'zend-jodasa.fjeclot.net',
	        'username' => "cn=admin,$domini",
	        'password' => 'fjeclot',
	        'bindRequiresDn' => true,
	        'accountDomainName' => 'fjeclot.net',
	        'baseDn' => 'dc=fjeclot,dc=net',
	    ];
	    $ldap = new Ldap($opcions);
	    $ldap->bind();
	    $nova_entrada = [];
	    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
	    Attribute::setAttribute($nova_entrada, 'uid', $uid);
	    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
	    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
	    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
	    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
	    Attribute::setAttribute($nova_entrada, 'cn', $cn);
	    Attribute::setAttribute($nova_entrada, 'sn', $sn);
	    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
	    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
	    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
	    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
	    Attribute::setAttribute($nova_entrada, 'title', $titol);
	    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
	    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";	
	}
	
?>
<html>
<head>
    <title>AFEGEIX UN NOU USUARI</title>
</head>
<body>
    <h2>Formulari</h2>
    <form action="/m08uf23/afegir.php" method="POST">
   		<input type="hidden" name="afegir" value="true">
    	Usuari: <input type="text" name="uid"><br>
        Unitat Organitzativa: <input type="text" name="unorg"><br>
        ID Usuari: <input type="number" name="num_id"><br>
        ID Grup: <input type="number" name="grup"><br>
        Directori personal: <input type="text" name="dir_pers"><br>
        Shell: <input type="text" name="sh"><br>
        Nom Complert: <input type="text" name="cn"><br>
        Nom: <input type="text" name="nom"><br>
        Cognom: <input type="text" name="sn"><br>
        Direcció: <input type="text" name="adressa"><br>
        Mobil: <input type="text" name="mobil"><br>
        Telefon: <input type="text" name="telefon"><br>
        Titol: <input type="text" name="titol"><br>
        Descripció: <input type="text" name="descripcio"><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zend-jodasa.fjeclot.net/m08uf23/menu.php'">Tornar al menú</button>
    </body>
</html>