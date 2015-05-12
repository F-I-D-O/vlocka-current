<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<?php set_include_path($_SERVER["DOCUMENT_ROOT"]);
	require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Příměstské tábory - co s sebou</title>
	
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
		require 'primestske_tabory/vlevo_zacatek.php';?>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah">
			<h1>Co s sebou</h1>
				<ul>
					<li>sportovnější boty (pevné, ne sandály, žabky...)</li>
					<li>plavky a ručník</li>
					<li>láhev na pití</li>
					<li>misku na jídlo (ešus)</li>
					<li>lžíci</li>
					<li>hrneček</li>
					<li>nůžky</li>
					<li>dva štětce</li>
					<li>pláštěnku</li>
				</ul>
				<ul class="velky_seznam">
					<li>prosíme o donesení kopií očkovacího průkazu a kartičky pojišťovny</li>
				 	<li>dejte dětem s sebou batůžek , kam si v případě výletu budou moci zabalit věci</li>
				 	<li>věci dejte dětem do podepsané igelitky - děti si je nebudou nosit domů, ale 
				 	nechají si je v klubovně </li>
				 	<li>dřívější vyzvednutí dítěte z tábora je možné po předchozí domluvě</li>
					<li>užívá-li dítě pravidělně léky, předejte je vedoucím</li>
				</ul>
				<br />	
        		<p class="velke"><a target="_blank" href="http://vlocka-tabory.kambo.us/">Přihlašování na tábory</a> - 
        			přihlašuje se on-line!</p>
        		<p><u>Přihlášky vyplňte nejpozději do 31.5.2014</u></p>
		</div>
		<?php require 'primestske_tabory//spodek.php'?>			
	</div>
</body>
</html>