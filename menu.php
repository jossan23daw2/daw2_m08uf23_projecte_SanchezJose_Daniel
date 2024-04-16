<?php
    session_start();
    if(isset($_SESSION["novasessio"])){
        echo "<b style='color:green;'>Has iniciat sessió correctament</b><br><br>";
    }else{
        header("location: https://zend-jodasa.fjeclot.net/m08uf23/login.php");
    }
?>

<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL
		</title>
	</head>
	<body>
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ </h2>
		<h3><a href="/m08uf23/visualitzar.php">Visualitzar un usuari</a></h3>
		<h3><a href="/m08uf23/afegir.php">Afegir un usuari</a></h3>
		<h3><a href="/m08uf23/borrar.php">Esborrar un usuari</a></h3>
		<h3><a href="/m08uf23/modificar.php">Modificar un usuari</a></h3>
		<a href="/m08uf23/index.php">Tanca la sessió</a>
	</body>
</html>