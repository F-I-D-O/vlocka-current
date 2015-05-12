<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Language" content="cs">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="title" content="28. oddíl Vločka - Profily">
	<meta name="geo.country" content="CZ">
	<meta name="keywords" content="skauti Plzeň,skauting Plzen,Vločka Plzeň,skauti předškoláci,skautský oddíl Plzeň">
	<meta name="Rating" content="General">
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
		
		if(!isset($databaze)){
			$databaze = new Databaze();
		}
		$id;
		if(isset($_SESSION["ID"])){
			$sql = "SELECT profilID FROM profily WHERE uzivatelID = " . $_SESSION["ID"];
			$muj_id = $databaze->querySingleItem($sql);
		}
		
		if(array_key_exists("profilID", $_GET)){
			$sql = "SELECT profilID FROM profily WHERE profilID = " .  $_GET["profilID"];
			$id = $databaze->querySingleItem($sql);
		}
		else{
			$id = $mujid;
		}
		
		if(!isset($id) || $id == FALSE){
			header("Location: index.php");
		}
		
		$povoleni = 0;
		
		if(isset($muj_id) && $id == $muj_id){
			$povoleni = 1;
		}
		
		if(opravneni(1)){
			$povoleni = 2;
		}
		
		require 'php-vzhled/vlevo_zacatek.php';
		require 'php-konstanty/mesice.php' ?>
		<?php require 'php-vzhled/vlevo_konec.php'?>
		
		<div class="obsah">				
			<h1>Profil</h1>
			
			<?php 
			$sql = "SELECT * FROM profily WHERE profilID = " . $id;
			
			$profil = $databaze->queryObject($sql);
			
			$datum = new DateTime($profil->datum_narozeni);
			$vek = $datum->diff(new DateTime());
			if($povoleni > 1){
				echo("<p class=\"upravy-profil\">");
					echo("<a href=\"php/profil-upravy.php?smaz=" . $profil->profilID . "\">smaž profil</a>");
					if($profil->aktivni > 0){
						echo("<a href=\"php/profil-upravy.php?deaktivace=" . $profil->profilID . "\">deaktivuj profil</a>");
					}
					else{
						echo("<a href=\"php/profil-upravy.php?aktivace=" . $profil->profilID . "\">aktivuj profil</a>");
					}
				echo("</p>");
			}	
			?>
			<div id="profil" style="width: 620px; 
									height: 800px; 
									background: #F9BE3C; 
									border-radius: 10px; 
									margin: 0 20px 20px 20px;
									padding: 20px;
									text-align: left">	
				<div style="float: left; width: 300px; height: 400px;">
					<?php
					if($profil->fotka == "0"){
						if($profil->pohlavi == "1"){
							echo("<img src=\"obrazky/ikony/zena.PNG\" style=\"width: 80px; margin: 0 10px 0 0 \"</img>");
						}
						else{
							echo("<img src=\"obrazky/ikony/muz.PNG\" style=\"width: 80px; margin: 0 10px 0 0 \"</img>");
						}
					}
					else{
						echo("<img src=\"fotky/profily/" . $profil->profilID . "/" . $profil->fotka .
						".JPG\" style=\"width: 250px; margin: 0 10px 0 0 \"</img>");
					}
				 ?>
				</div>
				<div style="border: 0px; padding: 10px; ">
					<p style="font-size: 25px; font-weight: bold"><?php echo($profil->prezdivka);
						if($povoleni > 0){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "prezdivka"){?>
								</p>
								<form method="post" action="php/zmen_profil.php" style="">
									<input type="hidden" name="zmen" value="prezdivka">
									<input type="hidden" name="id" value="<?php echo($id) ?>">
									<label for="nova_prezdivka">nová přezdívka</label>
									<p><input type="text" name="nova_prezdivka">
										<input type="submit" value="Uložit">
										<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
									</p>
								</form>
								
							<?php
							}
							else{
							?>
								<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=prezdivka" 
									style="">změnit přezdívku</a></p>								
							<?php
							}
						}
						?>					
					<p style="font-size: 20px; font-weight: bold"><?php echo($profil->jmeno . " " . $profil->prijmeni);
						if($povoleni > 1){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "jmeno"){?>
								</p>
								<form method="post" action="php/zmen_profil.php" style="">
									<input type="hidden" name="zmen" value="jmeno">
									<input type="hidden" name="id" value="<?php echo($id) ?>">
									<label for="nova_prezdivka">nové jméno a příjmení</label>
									<p><input type="text" name="nove_jmeno">
										<input type="submit" value="Uložit">
										<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
									</p>
								</form>
								
							<?php
							}
							else{
							?>
								<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=jmeno" 
									style="">změnit jméno</a></p>								
							<?php
							}
						}
						?>
					<p style="font-size: 18px; font-weight: bold"><?php echo("Věk: " . $vek->format("%y") . " let");
						if($povoleni > 1){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "vek"){?>
								</p>
								<form method="post" action="php/zmen_profil.php" style="">
									<input type="hidden" name="zmen" value="vek">
									<input type="hidden" name="id" value="<?php echo($id) ?>">
									<label for="novy_vek">nové datum narození</label>
									<p>
										<select name="den_narozeni">
											<option value="0" selected="selected">den</option>
											<?php
											for($i = 1; $i < 32; $i++){
												echo("<option value=\"" . $i . "\">" . $i . "</option>");
											} 
											?>
										</select>
										<select name="mesic_narozeni">
											<option value="0" selected="selected">měsíc</option>
											<?php
											for($i = 1; $i < 13; $i++){
												echo("<option value=\"" . $i . "\">" . $i . "</option>");
											} 
											?>
										</select>
										<select name="rok_narozeni">
											<option value="0" selected="selected">rok</option>
											<?php
											for($i = 1950; $i < 2013; $i++){
												echo("<option value=\"" . $i . "\">" . $i . "</option>");
											} 
											?>
										</select>
										<input type="submit" value="Uložit">
										<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
									</p>
								</form>
								
							<?php
							}
							else{
							?>
								<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=vek" 
									style="">změnit datum narození</a></p>								
							<?php
							}
						}
						?>
					
					<p style="font-size: 18px; font-weight: bold">
						<?php 
						if($profil->pohlavi == 1){
							echo("Žena");
						}
						else{
							echo("Muž");
						}
							
						if($povoleni > 1){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "pohlavi"){?>
								</p>
								<form method="post" action="php/zmen_profil.php" style="">
									<input type="hidden" name="zmen" value="pohlavi">
									<input type="hidden" name="id" value="<?php echo($id) ?>">
									<label for="nove_pohlavi">pohlaví</label>
									<p>
										Žena<input type="radio" name="pohlavi" value="1" checked="checked"></input>
										Muž<input type="radio" name="pohlavi" value="2" ></input>
										<input type="submit" value="Uložit">
										<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
									</p>
								</form>
								
							<?php
							}
							else{
							?>
								<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=pohlavi" 
									style="">změnit pohlaví</a></p>								
							<?php
							}
						}
						?>
					<p style="font-size: 18px; font-weight: bold; margin: 0 0 0 0">Funkce v oddíle:</p>
					<p style="font-size: 16px; margin: 0 0 20px 0"><?php echo($profil->funkce);
						if($povoleni > 1){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "funkce"){?>
							</p>
							<form method="post" action="php/zmen_profil.php" style="">
								<input type="hidden" name="zmen" value="funkce">
								<input type="hidden" name="id" value="<?php echo($id) ?>">
								<label for="nova_funkce">nová funke</label>
								<p><input type="text" name="nova_funkce">
									<input type="submit" value="Uložit">
									<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
								</p>
							</form>
							
						<?php
						}
						else{
						?>
							<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=funkce" 
								style="">změnit funkci</a></p>								
						<?php
						}
					}
					?>	
					<p style="font-size: 18px; font-weight: bold; margin: 0 0 0 0">O mně: </p>
					<p style="font-size: 16px; margin: 0 0 0 0"><?php echo($profil->popis);
						if($povoleni > 0){
							if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "ome"){?>
							</p>
							<form method="post" action="php/zmen_profil.php" style="">
								<input type="hidden" name="zmen" value="ome">
								<input type="hidden" name="id" value="<?php echo($id) ?>">
								<label for="novy_popis">popis</label>
								<p>
									<textarea name="novy_popis" id="text" maxlength="10000" style="	width: 250px;
																									height: 170px">
									</textarea>
									<input type="submit" value="Uložit">
									<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>"style="">zpět</a>
								</p>
							</form>
							
						<?php
						}
						else{
						?>
							<a class="profil_zmena_odkaz" href="profil.php?profilID=<?php echo($id)?>&zmen=ome" 
								style="">změnit popis</a></p>								
						<?php
						}
					}
					?>
				</div>
				<?php
				if($povoleni > 0){
					if(array_key_exists("zmen", $_GET) && $_GET["zmen"] == "fotka"){?>
						<form method="post" enctype="multipart/form-data" action="php/zmen_profil.php" style="clear:both">
							<input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
							<p><input type="file" name="fotka" ACCEPT="image/*" style="width: 250px"></p>
							<p><input type="hidden" name="id" value="<?php echo($id) ?>"></p>
							<p><input type="hidden" name="fotky" value="<?php echo($profil->fotky) ?>"></p>
							<p><input type="hidden" name="zmen" value="fotka"></p>
							<p><input type="submit" value="Vložit novou fotku"></p>
						</form>
					<?php
					}
					else{
					?>
						<a href="profil.php?profilID=<?php echo($id)?>&zmen=fotka" 
							style="clear: both; font-size: 20px; display: block">změnit fotku</a>
						
					<?php
					}
				}

				//chybové zprávy
				if(array_key_exists("chyba", $_GET)){?>	
					<div class="error">
						<p><?php echo($_GET["chyba"])?></p>
					</div>
				<?php
				} 
				?>
				
				<?php
				//dobré zprávy
				if(array_key_exists("uspech", $_GET)){?>	
					<div class="succes">
						<p><?php echo($_GET["uspech"])?></p>
					</div>
				<?php
				} 
				?>		 
			</div>
		</div>
		<?php require 'php-vzhled/spodek.php'?>
		<br>			
	</div>
</body>
</html>