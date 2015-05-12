<div class="obsah">				
	<h3>Nový uživatel</h3>					
	<form action="php/novy_profil.php" method="post" style="margin: 10px">
	<table>
		<tr>
			<td style="width: 200px; border: 0px"><label for="datum">Přezdívka:</label></td>
			<td style="border: 0px">
				<input type="text" name="prezdivka" id="prezdivka" maxlength="20" style="width: 100px"
				<?php 
					if(isset($_SESSION["udaje"]["prezdivka"]) && $_SESSION["udaje"]["prezdivka"] != ""){
						echo('value="' . $_SESSION["udaje"]["prezdivka"] . '"');
					}
				?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="nadpis">Jméno:</label></td>
			<td style="border: 0px">
				<input type="text" name="jmeno" id="jmeno" maxlength="20" style="width: 100px"
				<?php 
					if(isset($_SESSION["udaje"]["jmeno"]) && $_SESSION["udaje"]["jmeno"] != ""){
						echo('value="' . $_SESSION["udaje"]["jmeno"] . '"');
					}
				?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="nadpis">Příjmení:</label></td>
			<td style="border: 0px">
				<input type="text" name="prijmeni" id="prijmeni" maxlength="20" style="width: 100px"
				<?php 
					if(isset($_SESSION["udaje"]["prijmeni"]) && $_SESSION["udaje"]["prijmeni"] != ""){
						echo('value="' . $_SESSION["udaje"]["prijmeni"] . '"');
					}
				?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="role">Datum narození:</label></td>
			<td style="border: 0px">
				<select name="den_narozeni">
					<?php 
					if(isset($_SESSION["udaje"]["den_narozeni"]) && $_SESSION["udaje"]["den_narozeni"] != ""){
						echo('<option value="' . $_SESSION["udaje"]["den_narozeni"] . 
								'" selected="selected">' . $_SESSION["udaje"]["den_narozeni"] . '</option>"');
					}
					else{
						echo('<option value="0" selected="selected">den</option>');
					}
					for($i = 1; $i < 32; $i++){
						echo("<option value=\"" . $i . "\">" . $i . "</option>");
					} 
					?>
				</select>
				<select name="mesic_narozeni">
					<?php 
					if(isset($_SESSION["udaje"]["mesic_narozeni"]) && $_SESSION["udaje"]["mesic_narozeni"] != ""){
						echo('<option value="' . $_SESSION["udaje"]["mesic_narozeni"] . 
								'" selected="selected">' . $_SESSION["udaje"]["mesic_narozeni"] . '</option>"');
					}
					else{
						echo('<option value="0" selected="selected">měsíc</option>');
					}
					for($i = 1; $i < 13; $i++){
						echo("<option value=\"" . $i . "\">" . $i . "</option>");
					} 
					?>
				</select>
				<select name="rok_narozeni">
					<?php 
					if(isset($_SESSION["udaje"]["rok_narozeni"]) && $_SESSION["udaje"]["rok_narozeni"] != ""){
						echo('<option value="' . $_SESSION["udaje"]["rok_narozeni"] . 
								'" selected="selected">' . $_SESSION["udaje"]["rok_narozeni"] . '</option>"');
					}
					else{
						echo('<option value="0" selected="selected">rok</option>');
					}
					for($i = 1951; $i < 2013; $i++){
						echo("<option value=\"" . $i . "\">" . $i . "</option>");
					} 
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="role">Pohlavi:</label></td>
			<td style="border: 0px">
				Žena<input type="radio" name="pohlavi" value="1" <?php if(isset($_SESSION["udaje"]["pohlavi"]) && 
						$_SESSION["udaje"]["pohlavi"] == 1){echo("checked=\"checked\"");}?>></input>
				Muž<input type="radio" name="pohlavi" value="2" <?php if(!isset($_SESSION["udaje"]["pohlavi"]) || 
						$_SESSION["udaje"]["pohlavi"] == 2){echo("checked=\"checked\"");}?>></input>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="nadpis">Funkce v oddíle:</label></td>
			<td style="border: 0px">
				<input type="text" name="funkce" id="funkce" maxlength="100" style="width: 300px"
				<?php 
					if(isset($_SESSION["udaje"]["funkce"]) && $_SESSION["udaje"]["funkce"] != ""){
						echo('value="' . $_SESSION["udaje"]["funkce"] . '"');
					}
				?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px"><label for="nadpis">Uživatel:</label></td>
			<td style="border: 0px">
				<input type="text" name="uzivatel" id="uzivatel" maxlength="100" style="width: 300px"
				<?php 
					if(isset($_SESSION["udaje"]["uzivatel"]) && $_SESSION["udaje"]["uzivatel"] != ""){
						echo('value="' . $_SESSION["udaje"]["uzivatel"] . '"');
					}
				?>
				>
			</td>
		</tr>
	</table>
	<input type="submit" value="Založit profil">
	</form>
	<?php
	//chybové zprávy
	if(array_key_exists("chyba_vlozeni_profilu", $_GET)){?>	
		<div class="error">
			<p><?php echo($_GET["chyba_vlozeni_profilu"])?></p>
		</div>
	<?php 
	}
	//dobré zprávy
	if(array_key_exists("vlozen", $_GET)){?>
		<div class="succes">
			<p><?php echo("Nový profil " . $_GET["vlozen"] . " byl úspěšně vložen")?></p>
		</div>
	<?php 
	}
	?>	
</div>