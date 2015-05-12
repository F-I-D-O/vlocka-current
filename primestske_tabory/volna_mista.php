<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<?php set_include_path($_SERVER["DOCUMENT_ROOT"]);
	require 'php-vzhled/meta.php' ?>
	<title>28. oddíl Vločka - Příměstské tábory - volná místa</title>
	
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
			<p style="position:absolute; top: 285px; left: 765px">Aktualizováno dne: 1.5.2014</p>
    		<h1>Příměstské tábory 2014 - volná místa</h1>
    			<p>Na léto 2014 jsme připravili čtyři běhy příměstského tábora pro kluky a holky ve věku 5 - 11 let.</p> 
          <p>Novinkou jsou 2 příměstské táborx pro předškolní děti ve věku 3 - 6 let Za lesními skřítky a Za lesními zvířátky, který připravila lesní školka Medvíďata!</p> 
               	<p>Tábory se uskuteční ve skautských klubovnách u Seneckého rybníka.</p>
                
          <h3>7.7.. - 11. 7. 2014 - Za lesními zvířátky  - NOVĚ PŘIDÁNO! (tábor lesní školky pro děti 3 - 6 let</h3>
    				<p>11 volných míst</p>       
          <h3>28. 7. - 1. 8. 2014 - Za lesními skřítky (tábor lesní školky pro děti 3 - 6 let</h3>
    				<p>obsazeno</p>      
    			<h3>4. - 8. 8. 2014 - Tábor Madagaskar</h3>
    				<p>obsazeno</p>
      			<h3>11. - 15. 8. 2014 - Tábor Šmoulové</h3>
    				<p> 3 volná místa</p>
     			<h3>18. - 22. 8. 2013 - Tábor Divoký západ</h3>
    				<p>obsazeno</p>
    			<h3>25. - 29. 8. 2013 - Tábor ZOO aneb cesta kolem světa</h3>
    				<p>obsazeno</p>
    			<br />	
        		<p class="velke"><a target="_blank" href="http://vlocka-tabory.kambo.us/">Přihlašování na tábory</a> - 
        			přihlašuje se on-line!</p>
        		
            <h2>Průvodci lesních sřítků a lesních zvířátek</h2>
      			<p>Martina, Klára, Anička, Zdeňka, Milča, Eva </p>	
      			<h2>Průvodci Madagaskarem</h2>
      			<p>Lumík, Vendulka, Špulka, Syky, Drak, Gandalf, Zvonek, Rosňa a Vojta</p>				
      			<h2>Šerifové Divokého západu</h2>
      			<p>Lvíče, Medůza, Verča, Gandalf, Drak, Zvonek, Skřet, Bobr, Bára, Petra</p>				
      			<h2>Průvodci na cestě za zvířaty z celého světa </h2>
      			<p>Lvíče,Petra, Medůza,Zubka, Věrka, Inna, Vojta, Matěj, Majda, </p>
      			<h2>Taťkové Šmoulové </h2>
      			<p>Hopsinka, Včelka, Lumík, Věrka, Bobr, Bára, Verča, Bambule</p>
 		</div>
    	<?php require 'primestske_tabory//spodek.php'?>			
	</div>
</body>
</html>