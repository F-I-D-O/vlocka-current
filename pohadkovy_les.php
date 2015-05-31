<!DOCTYPE html>

<html lang="cs-cz" dir="ltr">
<head>
	<?php require 'php-vzhled/meta.php' ?>
	<title>8. oddíl Vločka - Pohádkový les</title>
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
                                <h1>Dětský den na Senečáku</h1>
                                <p>...tentokrát na téma Lov 13 bobříků!</p>
                                <p>Start bude u vlakové zastávky Bolevec (pod konečnou tramvaje č. 1) 
                                v době od 11 do 15 h, trase povede směrem k Seneckému rybníku. Startovné - zdarma!</p>
                                <p>Skauti, skautky, RaR - sraz je v 9 h na klubovně, sebou oddílové tričko šátek (popř. kroj).</p>
                                <img src="obrazky/plakaty/Mámy mají volno 2015-web.png" alt="Dětský den" width="620">
                </div>
		<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>