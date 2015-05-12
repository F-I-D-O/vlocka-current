<!DOCTYPE html>

<html lang="cs-cz" dir="ltr">
<head>
	<?php require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Novinky</title>
	<meta name="description" content="Jsme oddíl světlušek, vlčat, skautů, skautek a R&amp;R, 
		dohromady je nás okolo 100 VLOČEK - jsme taková malá lavina a klubovnu máme u 
		Seneckého rybníka (Plzeň - Bolevec). Oslavili jsme dvanácté narozeniny...">
	
	<!-- link na ikonu pro facebook -->
	<link rel="image_src" href="http://vlocka.skauting.cz/images/ikonyweb/logo3.png">
</head>

<div id="hlavni">
		<?php
		require 'php/databaze.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';?>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah">
			<h1>Odpoledne jako HROCH</h1>
				<img src="fotky/9.jpg" alt="" width="290" />
				<img src="fotky/11.jpg" alt="" width="290" />
				<p>Skautský oddíl Vločka zve kluky a holky s rodiči na Odpoledne jako HROCH</p>
				<p>Akce proběhne <span style="text-decoration: underline">v sobotu 6.září 2014</span>, tak jako každý 
				rok u <span style="text-decoration: underline">Seneckého rybníka</span> poblíž skautských kluboven.
				<span style="text-decoration: underline">Začínat budeme ve 13:30 a končit v 18:00</span></p>
				<p>Zúčastnit se můžou všechny děti i s rodiči, školáci i předškoláci</p>
				<p>Náš oddíl tuto akci pořádá již po patnácté!</p>
				<p>Podívejte se na <a target="_blank" href="https://picasaweb.google.com/115127399689339200500/OdpoledneJakoHroch2011">
				fotografie</a> z minulých let!</p>
				<img src="obrazky/plakaty/hroch_2014.jpg" alt="Odpoledne jako hroch - plakát" width="620" />
		</div>
		<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>
	