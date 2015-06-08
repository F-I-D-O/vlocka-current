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

<body>
	<div id="hlavni">
		<?php
		require 'php/databaze.php';
		require 'php/funkce.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';
		require 'php-konstanty/mesice.php' ?>
			<div class="odkazy">
			<h2>Klubovna</h2>
				<ul>
					<li><a target="_blank" href="http://www.mapy.cz/#x=130700224@y=134911488@z=15@mm=FP@ax=130700224@ay=134911488@at=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22@ad=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22@sa=s@st=s@ssq=seneck%C3%BD%20rybn%C3%ADk%20skauti" >KLUBOVNA NA MAPĚ</a></li>
					<li><a target="_blank" href="http://www.mapy.cz/#z=19&amp;c=h&amp;&amp;umc=9eE6fxWLLn&amp;uml=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22%20%E2%80%93%20Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22&amp;q=seneck%C3%BD%20rybn%C3%ADk%20skauti&amp;x=13.393757&amp;y=49.785098&amp;p=-1" >LETECKÝ SNÍMEK KLUBOVNY</a></li>
					<li><a target="_blank" href="http://senecak.skauting.cz/uvod.html" >UBYTOVÁNÍ</a></li>
				</ul>
			</div>
		<?php require 'php-vzhled/vlevo_konec.php'?>
		
		<div class="novinky">				
			<h3>Novinky</h3>			
			<?php
			if(array_key_exists("chyba_novinka", $_GET)){?>
			
				<div class="error">
					<p> <?php echo($_GET["chyba_novinka"])?> </p>
				</div>
			<?php 
			}
			if(array_key_exists("uspech_novinka", $_GET)){?>	
					<div class="succes">
						<p> <?php echo($_GET["uspech_novinka"])?> </p>
					</div>
			<?php 
			}		 
			if(opravneni(2)){
				echo('<script type="text/javascript" src="script/tiny_mce/tiny_mce.js"></script>');
				echo('<script type="text/javascript" src="index/tiny_mce-config-index.js"></script>');
				require "index/vlozit_novinku.php";
			}
			if(!isset($databaze)){
					$databaze = new Databaze();
			}
			if(array_key_exists("archiv", $_GET)){
				$datum_ted = new DateTime($_GET["archiv"]);
			}
			else{
				$datum_ted = new DateTime();
			}
			$zacatek_mesice = clone $datum_ted;
			$zacatek_mesice->modify("-1 month");
			if(opravneni(2)){
				$sql = "SELECT * FROM novinky WHERE datum BETWEEN '" . $zacatek_mesice->format("Y-m-d H:i:00") .
							"' AND '" . $datum_ted->format("Y-m-d H:i:00") . "' ORDER BY datum DESC"; 
			}
			else{
				$sql = "SELECT * FROM novinky WHERE aktivni > 0 AND datum BETWEEN '" . $zacatek_mesice->format("Y-m-d H:i:00") .
							"' AND '" . $datum_ted->format("Y-m-d H:i:00") . "' ORDER BY datum DESC"; 
			}
			
			$novinky_mesic = $databaze->queryObjectArray($sql);
			if($novinky_mesic){
				for($i = 0; $i < count($novinky_mesic); $i++){
					echo("<div class=\"novinka\">");
						$datum_novinky = new DateTime($novinky_mesic[$i]->datum);
						echo("<p class=\"datum\">" . $datum_novinky->format("j. n. Y H:i") . "</p>");
						echo('<p class="nadpis-novinka">' . $novinky_mesic[$i]->nadpis . '</p>');
						echo($novinky_mesic[$i]->text);
						if(opravneni(1)){
							echo("<p class=\"upravy-novinka\">");
								echo("<a href=\"php/novinka-upravy.php?smaz=" . $novinky_mesic[$i]->ID . "\">smaž novinku</a>");
								if($novinky_mesic[$i]->aktivni > 0){
									echo("<a href=\"php/novinka-upravy.php?deaktivace=" . $novinky_mesic[$i]->ID . "\">deaktivuj novinku</a>");
								}
								else{
									echo("<a href=\"php/novinka-upravy.php?aktivace=" . $novinky_mesic[$i]->ID . "\">aktivuj novinku</a>");
								}						
							echo("</p>");
						}						
					echo("</div>");
				}
			}			
			?>
			
			<div id="archiv_novinek">
				<?php 
				$datm_ted = new DateTime();
				$datum_arch = new DateTime($datm_ted->format("Y-m"));
				while($datum_arch > new DateTime("2011-09-01 00:00:00")){					
					$archiv = $datum_arch->format("Y-m-d");
					$datum_arch->modify("-1 month");
					
					echo("<a href=\"index.php?archiv=" . $archiv . "\">" . " " . mesic($datum_arch->format("m")) . " " . 
					$datum_arch->format("Y") . "</a> ");
					
					if($datum_arch->format("Y-m") != "2011-09"){
						echo("|");
					}				
				}				
				?>
			</div>
			<br>
		</div>
		
		<div id="vpravo">		
			<!-- Oblast důležitých zpráv -->		
			<?php require "php-vzhled/dulezite.php";?>
			<br>	
			<!--<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/pohadkovy_les.php") ?>">
				<img src="obrazky/ikony/pohadkovyles2014.jpg" alt="Strašidelný les 2013">
			</a>
			<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/les.php") ?>">
				<img src="obrazky/ikony/ikona_strašidla_2014.jpg" alt="Strašidelný les 2014">
			</a>	
			<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/hroch.php") ?>">
				<img src="obrazky/ikony/ikona-hroch_2014.jpg" alt="Odpoledne jako hroch 2014">
			</a>-->
                        
            <a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/pohadkovy_les.php") ?>">
                <img src="obrazky/ikony/ikona-detsky-den.png" alt="Dětský den">
			</a>
                        
			<a href="<?php echo("http://plzentabor.skauting.cz/") ?>" target="_blank">
				<img src="obrazky/ikony/tabory.PNG" alt="Příměstské tábory 2015">
			</a>
                        
			<a href="http://skolka.skauting.cz/" target="_blank">
				<img src="obrazky/ikony/medvidata.PNG" alt="Lesní školka Medvíďata">
			</a>
			<a href="http://www.rukodelkyusojky.cz/" target="_blank">
				<img src="obrazky/ikony/rukodelky.PNG" alt="Rukodělky u Sojky">
			</a>
			
			<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/prijimame_cleny.php") ?>">
				<img src="obrazky/ikony/ikona-nabor.png" alt="přijímáme členy">
			</a>	
						
			<div id="anketnik"  style="margin: 10px">
	 			<h2>Vzkazovník</h2>
				<!-- BLUEBOARD SHOUTBOARD -->
				<iframe style="border: 0px; width: 222px; height: 320px; overflow: hidden"   
						src="http://www.blueboard.cz/shoutboard.php?hid=cs9fkuk8dxdikj62p2r59cbffa263k">
							<a href="http://www.blueboard.cz/shoutboard.php?hid=cs9fkuk8dxdikj62p2r59cbffa263k">
							ShoutBoard od BlueBoard.cz</a>
				</iframe>
				<!-- BLUEBOARD SHOUTBOARD KONEC -->
			</div>
		</div>
		
		<?php require 'php-vzhled/spodek.php'?>		
	</div>
</body>
</html>