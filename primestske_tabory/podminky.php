<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<?php set_include_path($_SERVER["DOCUMENT_ROOT"]);
	require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Příměstské tábory - podmínky účasti</title>
	
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
    		<h1>Podmínky účasti na táboře</h1>
    			<p>Přihlášením na příměstský tábor stvrzujete, že souhlasíte s pravidly táborového řádu a s podmínkami 
    			pro vrácení peněz. (storno podmínky)</p>           	
               	<h2>Podmínky vrácení peněz</h2>
	               	<ul>
	               		<li>při odhlášení do 30. 4. 2014 je vrácena plná výše platby, tedy 1300 Kč a 1 500 Kč.</li>
	               		<li>při Odhlášení do 15. 7. 2014 je vráceno 600 (700) Kč.</li>
	               		<li>při	Odhlášení do 24. 7. 2014 bude rodičům vráceno 300 Kč, v případě nemoci dítěte 600 Kč 
	               			(nutno doložit lékařským potvrzením).</li>
	               		<li>při odhlášení po 24. 7. 2014 do prvního dne tábora bude rodičům vráceno 600 Kč a to pouze v 
	               			případě nemoci dítěte (nutno doložit lékařským potvrzením).</li>
	               		<li>v případě odhlášení dítěte během tábora nebude vracena žádná částka a to ani v případě nemoci.</li>
	               		<li>v případě, že by se dítě dále nemohlo účastnit tábora z důvodu úrazu vzniklého na táboře, bude 
	               		rodičům vrácena plná částka za zbývající dny (240 Kč/den)</li>
	               	</ul>
    			<h2>Táborový řád</h2>
	               	<ol>
	               		<li>Dítě se nesmí bez dovolení vedoucích vzdalovat.</li>
	               		<li>Dítě se nesmí koupat bez dohledu vedoucích.</li>
	               		<li>Dítě si mohou z tábora vyzvednout pouze určené osoby.</li>
	               		<li>Dítě se nechová hrubě k ostatním dětem.</li>
	               		<li>Dítě hlásí všechny zdravotní problémy.</li>
	               		<li>Dítě dodržuje pokyny vedoucího.</li>
	               	</ol>
               	<br />	
        		<p class="velke"><a target="_blank" href="http://vlocka-tabory.kambo.us/">Přihlašování na tábory</a> - 
        			přihlašuje se on-line!</p>
        		<p><u>Přihlášky vyplňte nejpozději do 31.5.2014</u></p>
 		</div>
    	<?php require 'primestske_tabory//spodek.php'?>			
	</div>
</body>
</html>