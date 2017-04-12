<!DOCTYPE html>

<?php 
require 'php/databaze.php'; 
require 'php/funkce.php';
?>

<html>
<head>
	<?php require 'php-vzhled/meta.php' ?>
	<link 	href="fotokronika/fotokronika.css?<?php echo (urlencode(strftime("%m/%d/%Y %H:%M:%S", filemtime("fotokronika.css"))))?>" 
			rel="stylesheet" 
			type="text/css">
	<title>28. oddíl Vločka - Fotokronika</title>
	<meta name="description" content="28. oddíl Vločka - Fotokronika">
</head>

<body>
	<div id="hlavni">
		<?php
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';?>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah">	
			<?php
			/* inicializace databáze */
			if(!isset($databaze)){
				$databaze = new Databaze();
			}
			
			/* Chybové a jiné zprávy */
			if(array_key_exists("chyba", $_GET)){?>
			<div class="error">
				<p> <?php echo($_GET["chyba"])?> </p>
			</div>
			<?php 
			}
			if(array_key_exists("uspech", $_GET)){?>	
			<div class="succes">
				<p> <?php echo($_GET["uspech"])?> </p>
			</div>
			<?php	
			}
			
			/* Vkládání nové galerie */
			if(opravneni(2)){
				require 'php-vzhled/vlozit_galerii.php';
			}
			
			/* zde se načítá fotokronika pro konkrétní rok */	
			if(array_key_exists("rok", $_GET)){
				
				/* načtení galerií z databáze */
				$sql = "SELECT * FROM fotokronika WHERE YEAR(datum_konce) = " . $_GET["rok"] . " ORDER BY datum_konce";
				$fotokronika = $databaze->queryObjectArray($sql);
				
				
				
				echo("<h1>Fotokronika " . $_GET["rok"] . "</h1>");
				
				if(!$fotokronika){
					echo("<p style=\"margin: 20px; font-size: 18px\">Nebyla nalezena žádná galerie.");
				}
				
				/* Výpis galerií*/
				else{
					$barva = "#FFB96A";
					for($i = 0; $i < count($fotokronika); $i++){
						$galerie = $fotokronika[$i];
						if($galerie->aktivni < 1 && !opravneni(2)){
							continue;
						}
						$datum_zacatku = new DateTime($galerie->datum_zacatku);
						$datum_konce = new DateTime($galerie->datum_konce);
						$sql = "SELECT profilID FROM vztah_profil_galerie WHERE galerieID = " . $galerie->ID;
						$autori = $databaze->queryArray($sql);
						
						if($galerie->aktivni == 0){
							$barva = "#A5A6A7";
						}
						echo("<div class=\"fotokronika\" style=\"background: " . $barva . "\">");
							
							//datum
							echo("<div class=\"fotokronika-datum\">");
								if($datum_zacatku != $datum_konce){
									if($datum_zacatku->format("m") == $datum_konce->format("m")){
										echo($datum_zacatku->format("d.-"));
										echo($datum_konce->format("d. m. Y"));
									}
									else{
										echo($datum_zacatku->format("d. m.-"));
										echo($datum_konce->format("d. m. Y"));
									}							
								}
								else{
									echo($datum_konce->format("d. m. Y"));
								}
							echo("</div>");
												
							//název galerie
							echo('<div class="fotokronika-nazev"><a'); 
							//if(!strpos($galerie->odkaz, "vlocka.skauting.cz")){
								echo(' target="_blank" ');
							//}
							echo(' href="' . $galerie->odkaz . '">' . $galerie->nazev . '</a></div>');
							
							//aktivita
							echo('<div class="fotokronika-aktivita">');
							if(opravneni(1)){
								echo('<a href="php/zmen_galerii.php?rok=' . $_GET["rok"] . '&smaz=' . $galerie->ID . '">');
								echo('<img src="http://' . $_SERVER["SERVER_NAME"] . '/obrazky/ikony/trash2.png">');
								echo("</a>");
								if($galerie->aktivni > 0){
									echo('<a href="php/zmen_galerii.php?rok=' . $_GET["rok"] . '&deaktivace=' . $galerie->ID . '">');
									echo('<img src="http://' . $_SERVER["SERVER_NAME"] . '/obrazky/ikony/globeg.png">');
									echo("</a>");
								}
								else{
									echo('<a href="php/zmen_galerii.php?rok=' . $_GET["rok"] . '&aktivace=' . $galerie->ID . '">');
									echo('<img src="http://' . $_SERVER["SERVER_NAME"] . '/obrazky/ikony/globeb.png">');
									echo("</a>");
								}
							}
							if($galerie->aktivni == 0 && $_SESSION["role"] == 2){
								echo('NEAKTIVNÍ');
							}
							echo("</div>");
							
							//autoři
							echo('<div class="fotokronika-autori">');
							$prvni = TRUE;
							for($j = 0; $j < count($autori); $j++){
								$id = $autori[$j]["profilID"];
								if($id){
									if($prvni == FALSE){
										echo(", ");
									}
									$odkaz = odkaz_na_profil($id, $databaze);
									echo($odkaz);
									$prvni = FALSE;
								}
							}
							if(isset($galerie->autori)){
								if($prvni == FALSE){
									echo(", ");
								}
								echo($galerie->autori);
							}
							echo('</div>');
							
						echo("</div>");
						if($barva == "#FFB96A"){
							$barva = "#FFEE9F";
						}
						else{
							$barva = "#FFB96A";
						}
					}
				}
			}
			/* Výpis menu */
			else{ ?>
				<h1>Fotokronika</h1>
                    <h2>2017</h2>
	    				<a href="fotokronika.php?rok=2017"><img src="fotky/fotokronika/2017.JPG" alt="rok 2017" width="650px"/></a>
					<h2>2016</h2>
	    				<a href="fotokronika.php?rok=2016"><img src="fotky/fotokronika/2016.JPG" alt="rok 2016" width="650px"/></a>
					<h2>2015</h2>
	    				<a href="fotokronika.php?rok=2015"><img src="fotky/fotokronika/2015.JPG" alt="rok 2015" width="650px"/></a>
					<h2>2014</h2>
	    				<a href="fotokronika.php?rok=2014"><img src="fotky/fotokronika/2014.JPG" alt="rok 2014" width="650px"/></a>
					<h2>2013</h2>
	    				<a href="fotokronika.php?rok=2013"><img src="fotky/fotokronika/2013.JPG" alt="rok 2013" width="650px"/></a>
					<h2>2012</h2>
	    				<a href="fotokronika.php?rok=2012"><img src="fotky/fotokronika/2012.JPG" alt="rok 2012" width="650px"/></a>
					<h2>2011</h2>
	    				<a href="fotokronika.php?rok=2011"><img src="fotky/fotokronika/2011.jpg" alt="rok 2011" width="650px"/></a>
					<h2>2010</h2>
	    				<a href="fotokronika.php?rok=2010"><img src="fotky/fotokronika/2010.jpg" alt="rok 2010" width="650px"/></a>
					<h2>2009</h2>
	    				<a href="fotokronika.php?rok=2009"><img src="fotky/fotokronika/2009.JPG" alt="rok 2009" width="650px"/></a>
					<h2>2008</h2>
	    				<a href="fotokronika.php?rok=2008"><img src="fotky/fotokronika/2008.jpg" alt="rok 2008" width="650px"/></a>
					<h2>2007</h2>
	    				<a href="fotokronika.php?rok=2007"><img src="fotky/fotokronika/2007.jpg" alt="rok 2007" width="650px"/></a>
					<h2>2006</h2>
	    				<a href="fotokronika.php?rok=2006"><img src="fotky/fotokronika/2006.JPG" alt="rok 2006" width="650px"/></a>
	    	<?php 
			}
	    	?>
			</div>
			<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>