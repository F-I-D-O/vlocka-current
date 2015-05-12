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
		require 'php/databaze.php';
		require 'php-vzhled/zahlavi-default.php';
		require 'php-vzhled/horejsek.php';
		
		$databaze = new databaze();
		if(isset($_SESSION["role"]) == FALSE || $_SESSION["role"] > 2){
			header("Location: index.php");
		}
		
		require 'php-vzhled/vlevo_zacatek.php';
		require 'php-konstanty/mesice.php';

		require 'php-vzhled/vlevo_konec.php';
		?>
		<div class="obsah">				
			<h3>Nová akce</h3>
			
			<form action="php/nova_akce.php" method="post" style="margin: 10px">
			<table style="width: 100%">
				<tr>
					<td style="width: 150px; border: 0px"><label for="datum">Název akce:</label></td>
					<td style="border: 0px" colspan="8">
						<input type="text" name="nazev" id="nazev" <?php if(isset($_SESSION["udaje"]["nazev"])){
						echo("value=\"" . $_SESSION["udaje"]["nazev"] . "\"");}?>maxlength="200" style="width: 300px">
					</td>
				</tr>
				<tr>
					<td style="width: 150px; border: 0px"><label for="role">Datum začátku akce:</label></td>
					<td style="border: 0px" colspan="8">
						<select name="den_zacatku">
							<?php
							if(isset($_SESSION["udaje"]["den_zacatku"]) && $_SESSION["udaje"]["den_zacatku"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["den_zacatku"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["den_zacatku"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 1; $i < 32; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
						<select name="mesic_zacatku">
							<?php
							if(isset($_SESSION["udaje"]["mesic_zacatku"]) && $_SESSION["udaje"]["mesic_zacatku"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["mesic_zacatku"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["mesic_zacatku"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 1; $i < 13; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
						<select name="rok_zacatku">
							<?php
							if(isset($_SESSION["udaje"]["rok_zacatku"]) && $_SESSION["udaje"]["rok_zacatku"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["rok_zacatku"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["rok_zacatku"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 2012; $i < 2021; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 150px; border: 0px"><label for="role">Datum konce akce:</label></td>
					<td style="border: 0px" colspan="8">
						<select name="den_konce">
							<?php
							if(isset($_SESSION["udaje"]["den_konce"]) && $_SESSION["udaje"]["den_konce"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["den_konce"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["den_konce"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 1; $i < 32; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
						<select name="mesic_konce">
							<?php
							if(isset($_SESSION["udaje"]["mesic_konce"]) && $_SESSION["udaje"]["mesic_konce"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["mesic_konce"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["mesic_konce"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 1; $i < 13; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
						<select name="rok_konce">
							<?php
							if(isset($_SESSION["udaje"]["rok_konce"]) && $_SESSION["udaje"]["rok_konce"] != 0){
								echo("<option value=\"" . $_SESSION["udaje"]["rok_konce"] . "\" selected=\"selected\">" .
										 $_SESSION["udaje"]["rok_konce"] . "</option>");
							}
							else{
								echo("<option value=\"0\" selected=\"selected\">den</option>");
							}
						
							for($i = 2012; $i < 2021; $i++){
								echo("<option value=\"" . $i . "\">" . $i . "</option>");
							} 
							?>
						</select>
						<label for="jednodenni">jednodenní akce</label>
						<input type="checkbox" name="jednodenni" <?php if(isset($_SESSION["udaje"]["jednodenni"]) && 
								$_SESSION["udaje"]["jednodenni"] == "on"){echo("checked=\"checked\"");}?>>
					</td>
				</tr>
				<tr>
					<td style="width: 150px; border: 0px"><label for="role">Vedoucí akce:</label></td>
					<td style="border: 0px" colspan="8">
						<select name="vedouci1">
							<?php
							$sql = "SELECT nick, ID FROM uzivatele WHERE role BETWEEN 1 AND 2";
							$vedouci = $databaze->queryObjectArray($sql);
							
							echo('<option value="" selected="selected"></option>');
							if(isset($_SESSION["udaje"]["vedouci1"]) && $_SESSION["udaje"]["rok_konce"] != ""){
								$sql = "SELECT nick, ID FROM uzivatele WHERE ID = " . 
										$databaze->uprav_na_sql($_SESSION["udaje"]["vedouci1"]);
								$nick = $databaze->querySingleItem($sql);
								
								echo("<option value=\"" .  $_SESSION["udaje"]["vedouci1"] . "\" selected=\"selected\">" .
										 $nick . "</option>");
							}
							for($i = 0; $i < count($vedouci); $i++){
								echo("<option value=\"" . $vedouci[$i]->ID . "\">" . $vedouci[$i]->nick . "</option>");
							} 
							?>
						</select>
						
						<select name="vedouci2">		
							<?php
							echo('<option value="" selected="selected"></option>');
							if(isset($_SESSION["udaje"]["vedouci2"]) && $_SESSION["udaje"]["rok_konce"] != ""){
								$sql = "SELECT nick, ID FROM uzivatele WHERE ID = " . 
										$databaze->uprav_na_sql($_SESSION["udaje"]["vedouci2"]);
								$nick = $databaze->querySingleItem($sql);
								
								echo("<option value=\"" .  $_SESSION["udaje"]["vedouci2"] . "\" selected=\"selected\">" .
										 $nick . "</option>");
							}
							for($i = 0; $i < count($vedouci); $i++){
								echo("<option value=\"" . $vedouci[$i]->ID . "\">" . $vedouci[$i]->nick . "</option>");
							} 
							?>
						</select>
						<label for="vedouci3">Jiný vedoucí:</label>
						<input type="text" name="vedouci3" <?php if(isset($_SESSION["udaje"]["vedouci3"])){
							echo("value=\"" . $_SESSION["udaje"]["vedouci3"] . "\"");}?>id="vedouci3" maxlength="20" style="width: 100px">
					</td>
				</tr>
				<tr>
					<td style="width: 150px; border: 0px">Akce je pro:</td>
					<td style="border: 0px; text-align: center"><label for="nadpis">předškoláci</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">vlčata</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">světlušky</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">skauti</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">skautky</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">roveři</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">rangers</label></td>
					<td style="border: 0px; text-align: center"><label for="nadpis">vedení</label></td>
				</tr>
				<tr>
					<td style="border: 0px"></td>
					<?php
					for($i = 1; $i < 9; $i++){
						echo("<td style=\"border: 0px; text-align: center\">");
							echo("<input type=\"checkbox\" name=\"" . $i . "\"");
								if(isset($_SESSION["udaje"]["kategorie" . $i]) && $_SESSION["udaje"]["kategorie" . $i] == "on"){
									echo("checked=\"checked\"");
								} echo(">");
						echo("</td>");
					}
					 ?>
				</tr>
				<tr>
					<td style="width: 150px; border: 0px" colspan="9">
						<label for="datum">Upřesnění kategorie (výprava je "jen pro někoho" apod.):</label>
					</td>
				</tr>
				<tr>
					<td style="border: 0px" colspan="9">
						<input type="text" name="special" id="special" <?php if(isset($_SESSION["udaje"]["special"])){
						echo("value=\"" . $_SESSION["udaje"]["special"] . "\"");}?>maxlength="500" style="width: 690px">
					</td>
				</tr>
			</table>
			<br>
			<textarea name="text" id="text" style="width: 690px; height: 300px"><?php if(isset($_SESSION["udaje"]["text"])){
					echo($_SESSION["udaje"]["text"]);}?>
			</textarea>
			<br>
			<input type="hidden" name="aktivni" id="aktivni" value="1">
			<br>
			<input type="submit" value="Vložit akci do databáze">
			</form>
			<?php
			//chybové zprávy
			if(array_key_exists("chyba_vlozeni_akce", $_GET)){?>	
				<div class="error">
					<p><?php echo($_GET["chyba_vlozeni_akce"])?></p>
				</div>
			<?php 
			}
			//dobré zprávy
			if(array_key_exists("vlozena", $_GET)){?>
				<div class="succes">
					<p><?php echo("Nová akce " . $_GET["vlozena"] . " byla úspěšně vložena")?></p>
				</div>
			<?php 
			}
			?>
		
		</div>
		<?php 
		require 'php-vzhled/spodek.php'?>
		<br>			
	</div>
</body>
</html>