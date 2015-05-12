<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

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
	<meta name="description" content="28. oddíl Vločka - Profily">
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
				<h3>PROFILY</h3>
				<ul>
					<?php
					if(isset($_SESSION["profilID"])){
						echo("<li><a href='profil.php?profilID=" . $_SESSION["profilID"] . "'>MŮJ PROFIL</a></li>");
					}
					?>
				</ul>
			</div>
		<?php 
		require 'php-vzhled/vlevo_konec.php';
		?>
		
		<div class="obsah" >				
			<?php 
			if(!isset($databaze)){
				$databaze = new Databaze();
			}
			if(isset($_SESSION["role"]) && $_SESSION["role"] < 2){
				$sql = "SELECT profilID, prezdivka FROM profily";
			}
			else{
				$sql = "SELECT profilID, prezdivka FROM profily WHERE aktivni > 0";
			}
			
			echo("<h1>Profily</h1>");
			
			$profily = $databaze->queryObjectArray($sql);
			
			if(array_key_exists("uspech", $_GET)){?>
				<div class="succes">
					<p><?php echo($_GET["uspech"])?></p>
				</div>
			<?php
			}
			
			if(!$profily){
				echo("<p style=\"margin: 20px; font-size: 18px\">V databázi nejsou žádné profily");
			}			
			else{
				echo("<div class=\"profily_cele\">");
				$barva = "#FFB96A";
				for($i = 0; $i < count($profily); $i++){
					$profil = $profily[$i];
					echo("<a class=\"profily\" href=\"profil.php?profilID=" . $profil->profilID . 
							"\" style=\"display: block; background-color: " . $barva . "\">");
						
							echo("<span class=\"profily-prezdivka\"><p>" . $profil->prezdivka . "</p></span>");
							echo("<span class=\"profily-fotka\">");
							
							include("php-vzhled/fotka_mala.php");
							echo("</span>");				
						echo("</a>");
					if($barva == "#FFB96A"){
						$barva = "#FFEE9F";
					}
					else{
						$barva = "#FFB96A";
					}
				}
				echo("</div>");
			}
			?>
			
		</div>
		<?php require 'php-vzhled/spodek.php'?>			
	</div>
</body>
</html>