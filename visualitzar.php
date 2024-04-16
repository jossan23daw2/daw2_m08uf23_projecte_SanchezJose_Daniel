<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
if(!isset($_SESSION["novasessio"])){
    header("location: https://zend-jodasa.fjeclot.net/m08uf23/login.php");
}
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
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
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
<head>
    <title>MOSTRANT DADES USUARIS</title>
</head>
<body>
    <h2>Formulari de selecció d'usuari</h2>
    <form action="https://zend-jodasa.fjeclot.net/m08uf23/visualitzar.php" method="GET">
        Unitat organitzativa: <input type="text" name="ou"><br>
        Usuari: <input type="text" name="usr"><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zend-jodasa.fjeclot.net/m08uf23/menu.php'">Tornar al menú</button>
</body>
</html>