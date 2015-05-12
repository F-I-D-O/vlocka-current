<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Language" content="cs">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="geo.country" content="CZ">
	<meta name="keywords" content="skauti Plzeň,skauting Plzen,Vločka Plzeň,skauti předškoláci,skautský oddíl Plzeň">
	<meta name="Rating" content="General">
	<meta name="googlebot" content="snippet,archive">
	<meta name="description" content="28. oddíl Vločka - Plán akcí">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="image_src" href="http://vlocka.skauting.cz/images/ikonyweb/logo3.png">
	<link href="http://vlocka.skauting.cz/images/ikonyweb/logo-mini3.ico" rel="Shortcut Icon">
	<title>28. oddíl Vločka Plzeň</title>
</head>

<body>
	<div id="hlavni">
		<?php
		require 'php/databaze.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		require 'php-vzhled/vlevo_zacatek.php';?>
			<div class="odkazy">
				<h3>Plán podle kategorií</h3>
				<ul>
					<li><a href='plan.php?kategorie=4'>PLÁN PŘEDŠKOLÁKŮ</a></li>
					<li><a href='plan.php?kategorie=1'>PLÁN VLČAT A SVĚTLUŠEK</a></li>
					<li><a href='plan.php?kategorie=2'>PLÁN SKAUTŮ A SKAUTEK</a></li>
					<li><a href='plan.php?kategorie=3'>PLÁN R+R</a></li>
				</ul>
			</div>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah">				
			<?php 
			if(!isset($databaze)){
				$databaze = new Databaze();
			}
			
			$datum_ted = new DateTime();
			$typ = 0;
			if(array_key_exists("kategorie", $_GET)){
				switch($_GET["kategorie"]){
					case 1:
						$sql = "SELECT * FROM akce WHERE datum_konce >= '" . 
						        $datum_ted->format("Y-m-d") . "' AND ( FIND_IN_SET('vlčata', kategorie) > 0
                    			OR FIND_IN_SET('světlušky', kategorie) > 0 )
						        ORDER BY datum_konce";
				       	echo("<h3>Plán akcí vlčat a světlušek</h3>");
				       	break;

					case 2:
						$sql = "SELECT * FROM akce WHERE datum_konce >= '" .
								$datum_ted->format("Y-m-d") . "' AND ( FIND_IN_SET('skauti', kategorie) > 0
               					 OR FIND_IN_SET('skautky', kategorie) > 0 )
								ORDER BY datum_konce";
						echo("<h3>Plán akcí skautů a skautek</h3>");
						break;
								
					case 3:
						$sql = "SELECT * FROM akce WHERE datum_konce >= '" .
								$datum_ted->format("Y-m-d") . "' AND ( FIND_IN_SET('roveři', kategorie) > 0
                				OR FIND_IN_SET('rangers', kategorie) > 0 )
								ORDER BY datum_konce";
						echo("<h3>Plán akcí roverů a rangers</h3>");
						break;
						
					case 4:
						$sql = "SELECT * FROM akce WHERE datum_konce >= '" .
								$datum_ted->format("Y-m-d") . "' AND ( FIND_IN_SET('předškoláci', kategorie) > 0)
								ORDER BY datum_konce";
								echo("<h3>Plán akcí roverů a rangers</h3>");
								break;
				}
			}
			else{
				$sql = "SELECT * FROM akce WHERE datum_konce >= '" .
						$datum_ted->format("Y-m-d") . "' ORDER BY datum_konce";
				echo("<h1>Plán akcí</h1>");
			}
			
			$plan_akci = $databaze->queryObjectArray($sql);
			
			if(array_key_exists("uspech", $_GET)){?>
				<div class="succes">
					<p><?php echo($_GET["uspech"])?></p>
				</div>
			<?php
			}
			
			if(opravneni(2)){
				echo('<p style="margin: 20px; font-size: 18px"><a href="vlozit_akci.php">Přidat akci</a></p>');
			}
			
			if(!$plan_akci){
				echo("<p style=\"margin: 20px; font-size: 18px\">Nebyla nalezena žádná akce.</p>");
			}			
			else{
				?>
				<table style="width: 80%; margin: 10px 20px">
					<col style="width: 20%">
					<col style="width: 65%">
					<col style="width: 15%">
					<tr>
						<th>Datum</th>
						<th>Akce</th>
						<th>Pro koho</th>
					</tr>
				</table>
				<?php 
				$barva = "#FFB96A";
				for($i = 0; $i < count($plan_akci); $i++){
					$akce = $plan_akci[$i];
					if($akce->aktivni < 1 && (!isset($_SESSION["role"]) || $_SESSION["role"] > 2)){
						continue;
					}
					$datum_zacatku = new DateTime($akce->datum_zacatku);
					$datum_konce = new DateTime($akce->datum_konce);
					$kategorie = str_replace(",", ", ", $akce->kategorie);
					
					if($akce->aktivni == 0){
						$barva = "#A5A6A7";
					}
					echo("<div class=\"plan-akce\" style=\"background: " . $barva . "\">");
						echo("<div class=\"plan-datum\"><p>");
						if($datum_zacatku != $datum_konce){
							echo($datum_zacatku->format("d.-"));
							echo($datum_konce->format("d. m. Y"));
						}
						else{
							echo($datum_konce->format("d. m. Y"));
						}
						echo("</p></div>");
						if(isset($akce->info)){
							echo("<div class=\"plan-podrobnosti-aktivni\"><p><a href=\"akce.php?akceID=" . $akce->akceID. 
								"\">INFO</A></p></div>");
						}
						else{
							echo("<div class=\"plan-podrobnosti\"><p><a href=\"akce.php?akceID=" . $akce->akceID. 
								"\">INFO</A></p></div>");
						}
						
						//název, v případě neaktivní akce nápis neaktivní
						echo('<div class="plan-nazev"></p>');
							echo('<p style="float: left">' . $akce->nazev);
								if ($akce->aktivni == 0){
									echo('<p style="float: right">NEAKTIVNI</p>');	
								}
						echo('</div>');
								
						if(strlen($akce->kategorie) > 40){
							echo("<div class=\"plan-kategorie\"><p>všichni</p></div>");
						}
						else{
							echo("<div class=\"plan-kategorie\"><p>" . $kategorie . "</p></div>");
						}				
					echo("</div>");
					if($barva == "#FFB96A"){
						$barva = "#FFEE9F";
					}
					else{
						$barva = "#FFB96A";
					}
				}
			}
			?>
		</div>
		<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>