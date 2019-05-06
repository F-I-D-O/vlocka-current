<!DOCTYPE html>

<html lang="cs-cz" dir="ltr">
<head>
	<?php require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Pohádkový les</title>
	<meta name="description" content="Jsme oddíl světlušek, vlčat, skautů, skautek a R&amp;R, 
		dohromady je nás okolo 100 VLOČEK - jsme taková malá lavina a klubovnu máme u 
		Seneckého rybníka (Plzeň - Bolevec). Oslavili jsme dvanácté narozeniny...">
	
	<!-- link na ikonu pro facebook -->
	<link rel="image_src" href="http://vlocka.skauting.cz/images/ikonyweb/logo3.png">
</head>

<body>
	<div id="hlavni">
		<?php
		set_include_path($_SERVER["DOCUMENT_ROOT"]);
		require 'php/databaze.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';?>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah">		
    				<!--<img src="obrazky/plakaty/pohadkovyles2014.jpg" alt="foto" width="670" style="border: 0px; margin: 0px 0 0 20px">-->
                                <h1>Pohádkový les u Senečáku</h1>
                                
                                <img src="obrazky/plakaty/PohadkovyLes2019.png" alt="Pohádkový les" width="620">
                </div>
		<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>