<?php

require '../php/funkce.php';

session_start();

$text = "
		<html>
		<head>
		  <title>Změna akce</title>
		</head>
		<body>
		  <h2>Změna akce</h2>
		  <ul>
		  	<li>název: " . $_GET["nazev"] . "</li>
		  	<li>typ změny: " . $_GET["udalost"] . "</li>
		  	<li>dříve: " . $_GET["staraHodnota"] . "</li>
		  	<li>nyní: " . $_GET["novaHodnota"] . "</li>
		  	<li>autor změny: " . $_SESSION["login"] . "</li>
		  	</ul>
		</body>
		</html>";

$adresa = array("david.fido.fiedler@gmail.com");
$hlavicky  = 'MIME-Version: 1.0' . "\r\n";
$hlavicky .= 'Content-type: text/html; charset=utf-8' . "\r\n";
odesli_mail($adresa, "Vločka - změna akce", $text, $hlavicky);

?>