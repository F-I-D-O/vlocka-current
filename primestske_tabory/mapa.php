<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<?php set_include_path($_SERVER["DOCUMENT_ROOT"]);
	require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Příměstské tábory - mapa</title>
	
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
	 		<h1>Příměstské tábory 2014 - Mapa</h1>
	 			<img src="../obrazky/mapa_klubovna.JPG" alt="" border="0" width="670"/>
	 			<p>
		 			<a href="http://www.mapy.cz/#z=19&c=h&umc=9eE6fxWLLn&uml=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22%20%E2%80%93%20Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22&q=seneck%25C3%25BD%2520rybn%25C3%25ADk%2520skauti&x=13.393757&y=49.785098&p=-1" target="_blank">
		 			letecký snímek klubovny</a>
	 			</p>
	 		<p class="velke"><a target="_blank" href="http://vlocka-tabory.kambo.us/">Přihlašování na tábory</a> - 
        			přihlašuje se on-line!</p>
        	<p><u>Přihlášky vyplňte nejpozději do 31.5.2014</u></p>
		</div>
		<?php require 'primestske_tabory/spodek.php'?>			
	</div>
</body>
</html>