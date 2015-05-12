<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
	<?php require 'php-vzhled/meta.php' ?>
	<link 	href="akce/akce.css?<?php echo (urlencode(strftime("%m/%d/%Y %H:%M:%S", filemtime("style.css"))))?>" 
			rel="stylesheet" 
			type="text/css">
	<meta name="title" content="28. oddíl Vločka - Akce">
	<meta name="description" content="28. oddíl Vločka - Akce">
</head>

<body>
	<div id="hlavni">
		<?php
		
		/* Programové závislosti */
		require 'php-konstanty/mesice.php';
		require 'php-konstanty/kategorie.php';
		require 'php/databaze.php';
		/* Načítání dat o akci z databáze */
		$databaze = new databaze();
		
		if(array_key_exists("akceID", $_GET)){
			$sql = "SELECT * FROM akce WHERE akceID = " .  $_GET["akceID"];
			$akce = $databaze->queryObject($sql);

			$sql = "SELECT uzivatelID FROM vztah_uzivatel_akce WHERE akceID = " .  $_GET["akceID"];
			$uzivatele = $databaze->vratSloupec($sql);
			
			if($uzivatele){
				for($i = 0; $i < count($uzivatele); $i++){
					$sql = "SELECT profilID FROM profily WHERE uzivatelID = " .  $uzivatele[$i];
					$profily[$i] = $databaze->querySingleItem($sql);
				}
			}
		}
		
		/* návrat na poslední stranu pokud akce se zadaným ID neexistuje, nebo nebylo zadáno ID */
		if(!$akce){
			posledni_strana0();
		}
		
		$datum_zacatku = new DateTime($akce->datum_zacatku);
		$datum_konce = new DateTime($akce->datum_konce);		
		$kategorie_jednotlive = explode(",", $akce->kategorie);
				
		/* Začátek vykreslování stránky */
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';
		require 'php-vzhled/vlevo_konec.php';
		
		if(opravneni(2)){
			require("akce/akce-funkce.php");
			echo('<script type="text/javascript" src="script/tiny_mce/tiny_mce.js"></script>');
			echo('<script type="text/javascript" src="akce/tiny_mce-config-akce.js"></script>');
		} 
		?>
		
		<div id="obsah" class="obsah">				
			<div id="akce">
				<?php if(opravneni(1)){
					include("akce/maz_menu.php");
				}?>					
				<div id="oblast_parametru">
					<div class="parametr" id="nazev">
						<!--Název akce-->			
						<span id="nazev-text"><?php echo($akce->nazev)?></span>
						<!-- odkaz na formular -->
						<?php if(opravneni(2)){
							odkaz_na_zmenu("nazev", "změnit název");
						} ?>
						
						<!-- editace názvu pro administrátory a vedoucí -->			
						<?php if(opravneni(2)){ 
							include("akce/zmena_nazvu_formular.php");
						} ?>	
					</div>
					<div class="parametr">
						<!--Datum začátku akce-->	
						<div class="parametr-nazev">Začátek akce: </div>
						<div id="datum_zacatku" class="parametr-hodnota">
							<?php echo($datum_zacatku->format("j. n. Y"));?>
							<!-- odkaz na formular -->
							<?php if(opravneni(2)){
								odkaz_na_zmenu("datum_zacatku", "změnit datum začátku");
							} ?>
						</div>
						
						<!-- editace datumu začátku pro administrátory a vedoucí -->		
						<?php if(opravneni(2)){
							include("akce/zmena_datumu_zacatku_formular.php");
						} ?>
					</div>									
					<div class="parametr">			
					<!--Datum konce akce-->	
						<div class="parametr-nazev">Konec akce: </div> 
						<div id="datum_konce" class="parametr-hodnota">
							<?php echo($datum_konce->format("j. n. Y"));?>
							
							<!-- odkaz na formular -->
							<?php if(opravneni(2)){
								odkaz_na_zmenu("datum_konce", "změnit datum konce");
							} ?>
						</div>
						
						<!-- editace datumu konce pro administrátory a vedoucí -->		
						<?php if(opravneni(2)){
							include("akce/zmena_datumu_konce_formular.php");
						} ?>
					</div>
					<div class="parametr">
					<!--Věkové kategorie-->	
						<div class="parametr-nazev">Akce je pro: </div>
						<div id="kategorie" class="parametr-hodnota">
							<?php for ($i = 0; $i < count($kategorie_jednotlive); $i++){
	 								if($i == 0){
	 									echo($kategorie_jednotlive[$i]);
	 								}
	 								else{
	 									echo(', ' . $kategorie_jednotlive[$i]);
	 								}	
							}?>
							<!-- odkaz na formular -->
							<?php if(opravneni(2)){
								odkaz_na_zmenu("kategorie", "změnit věkové kategorie");
							} ?>
							<p id="upresnujici_kategorie">(<?php echo($akce->jina_kategorie)?>)</p>
						</div>
								 
						<!-- editace věkových kategorií pro administrátory a vedoucí -->		
						<?php if(opravneni(2)){
							include("akce/zmena_kategorii_formular.php");
						} ?>
						
					</div>
					<div class="parametr">
						<!--Vedoucí akce-->	
						<div class="parametr-nazev">Vedoucí akce: </div>
						<div id="vedouci" class="parametr-hodnota">
	 						<span id="vedouci-text">
		 						<?php if(isset($profily)){
		 							for ($i = 0; $i < count($profily); $i++){
		 								if($i == 0){
		 									echo(odkaz_na_profil($profily[$i], $databaze));
		 								}
		 								else{
		 									echo(', ' . odkaz_na_profil($profily[$i], $databaze));
		 								}
		 							}	
		 						}
								if($akce->jiny_vedouci != "NULL"){
									if(isset($profily)){
										echo(', ');
									}
									echo($akce->jiny_vedouci);
								} ?>
							</span>
							
							<!-- odkaz na formular -->
							<?php if(opravneni(2)){
								odkaz_na_zmenu("vedouci", "změnit vedoucí");
							} ?>
						</div>
							
						<!--editace vedoucích pro administrátory a vedoucí -->
						<?php if(opravneni(2)){
							include ('akce/zmena_vedoucich_formular.php');
						}?>
					</div>		
				</div>		
				<div id="podrobne_info">	
					<div class="parametr-nazev">Podrobné informace: </div>
					<?php if(opravneni(2)){
						include ('akce/zmena_podrobnosti_formular.php');
					}?>
					<div class="parametr-hodnota">						
						<!-- odkaz na formular -->
						<?php if(opravneni(2)){
							odkaz_na_zmenu("podrobnosti", "změnit podrobné informace");
						} ?>
					</div>
					<div id="podrobne_info-text">
							<?php echo($akce->info);?><br />
					</div>					
				</div>			
			</div>
		</div>
		<?php require 'php-vzhled/spodek.php'?>
		<br>			
	</div>
	<script type="text/javascript" src="script/funkce.js"></script>
	<script type="text/javascript" src="akce/akce.js"></script>
</body>
</html>