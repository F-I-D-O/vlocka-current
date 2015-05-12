<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Language" content="cs">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="image_src" href="http://vlocka.skauting.cz/images/ikonyweb/logo3.png">
	<link href="http://vlocka.skauting.cz/images/ikonyweb/logo-mini3.ico" rel="Shortcut Icon">
	<title>28. oddíl Vločka Plzeň</title>
</head>

<body>
	<div id="hlavni">
		<?php
		@set_include_path($_SERVER[DOCUMENT_ROOT] . '/oddil');
		require 'php/databaze.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		
		if(!isset($databaze)){
			$databaze = new Databaze();
		}
		if(isset($_SESSION["role"]) == FALSE || $_SESSION["role"] > 2){
			header("Location: index.php");
		}
		
		require 'php-vzhled/vlevo_zacatek.php';
		require 'php-konstanty/mesice.php' ?>

		<?php require 'php-vzhled/vlevo_konec.php';
		
		if(array_key_exists("mod", $_GET)){
			if($_GET["mod"] == 1){
				require 'php-vzhled/vlozit_profil.php';
			}
			if($_GET["mod"] == 2){
				require 'php-vzhled/vlozit_uzivatele_a_profil.php';
			} 
		}
		else{
		?>
			<div class="obsah">				
				<h3>Nový uživatel</h3>
				
				<form action="php/novy_uzivatel.php" method="post" style="margin: 10px">
					<table>
						<tr>
							<td style="width: 200px; border: 0px"><label for="datum">Uživatelské jméno:</label></td>
							<td style="border: 0px"><input type="text" name="novy_login" id="login" maxlength="20" style="width: 100px"></td>
						</tr>
						<tr>
							<td style="width: 200px; border: 0px"><label for="nadpis">Heslo:</label></td>
							<td style="border: 0px"><input type="password" name="nove_heslo" id="heslo" maxlength="20" style="width: 100px"></td>
						</tr>
						<tr>
							<td style="width: 200px; border: 0px"><label for="nadpis">Heslo znovu:</label></td>
							<td style="border: 0px"><input type="password" name="nove_heslo2" id="heslo2" maxlength="20" style="width: 100px"></td>
						</tr>
						<tr>
							<td style="width: 200px; border: 0px"><label for="role">Role:</label></td>
							<td style="border: 0px">
								<select name="nova_role">
									<option value="1">Admin</option>
									<option value="2">Vedoucí</option>
									<option value="3" selected="selected">Člen oddílu</option>
								</select>
							</td>
						</tr>
					</table>
					<input type="hidden" name="aktivni" id="aktivni" value="1">
					<input type="submit" value="Vložit uživatele do databáze">
				</form>
				<?php
				//chybové zprávy
				if(array_key_exists("chyba_vlozeni", $_GET)){?>	
					<div class="error">
						<p><?php echo($_GET["chyba_vlozeni"])?></p>
					</div>
				<?php 
				}
				//dobré zprávy
				if(array_key_exists("vlozen", $_GET)){?>
					<div class="succes">
						<p><?php echo("Nový uživatel" . $_GET["vlozen"] . "byl úspěšně vložen")?></p>
					</div>
				<?php 
				}
				?>
			
			</div>
		<?php 
		}
		require 'php-vzhled/spodek.php'?>
		<br>			
	</div>
</body>
</html>