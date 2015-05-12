<div class="obsah">				
	<h3>Nový uživatel s profilem</h3>					
	
	<form action="php/novy_uzivatel_a_profil.php" method="post" style="margin: 10px">
		<table>
			<tr>
				<td style="width: 200px; border: 0px"><label for="datum">Uživatelské jméno:</label></td>
				<td style="border: 0px">
					<input type="text" name="novy_login" <?php if(isset($_SESSION["login2"])){
						echo("value=\"" . $_SESSION["login2"] . "\"");}?> id="novy_login" maxlength="20" style="width: 100px">
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
						<option value="1" <?php if(isset($_SESSION["role2"]) && $_SESSION["role2"] == 1 ){
								echo("selected=\"selected\"");} ?>>Admin</option>

						<option value="2" <?php if(isset($_SESSION["role2"]) && $_SESSION["role2"] == 2 ){
								echo("selected=\"selected\"");} ?>>Vedoucí</option>
						<option value="3" <?php if(!isset($_SESSION["role2"]) || $_SESSION["role2"] > 2 ){
								echo("selected=\"selected\"");} ?>>Člen oddílu</option>
					</select>
				</td>
			</tr>
			<tr><td style="border: 0px; height: 20px"></td></tr>

			<tr>
				<td style="width: 200px; border: 0px"><label for="datum">Přezdívka:</label></td>
				<td style="border: 0px">
					<input type="text" name="prezdivka" <?php if(isset($_SESSION["prezdivka"])){
						echo("value=\"" . $_SESSION["prezdivka"] . "\"");}?>id="prezdivka" maxlength="20" style="width: 100px">					
				</td>
			</tr>
			<tr>
				<td style="width: 200px; border: 0px"><label for="nadpis">Jméno:</label></td>
				<td style="border: 0px">
					<input type="text" name="jmeno" <?php if(isset($_SESSION["jmeno"])){
						echo("value=\"" . $_SESSION["jmeno"] . "\"");}?>id="jmeno" maxlength="20" style="width: 100px">
				</td>
			</tr>
			<tr>
				<td style="width: 200px; border: 0px"><label for="nadpis">Příjmení:</label></td>
				<td style="border: 0px">
					<input type="text" name="prijmeni" <?php if(isset($_SESSION["prijmeni"])){
						echo("value=\"" . $_SESSION["prijmeni"] . "\"");}?> id="prijmeni" maxlength="20" style="width: 100px">
				</td>
			</tr>
			<tr>
				<td style="width: 200px; border: 0px"><label for="role">Datum naození:</label></td>
				<td style="border: 0px">
					<select name="den_narozeni">
						<?php
						if(isset($_SESSION["den"]) && $_SESSION["den"] != 0){
							echo("<option value=\"" . $_SESSION["den"] . "\" selected=\"selected\">" . $_SESSION["den"] . "</option>");
						}
						else{
							echo("<option value=\"0\" selected=\"selected\">den</option>");
						}
						
						for($i = 1; $i < 32; $i++){
							echo("<option value=\"" . $i . "\">" . $i . "</option>");
						} 
						?>
					</select>
					<select name="mesic_narozeni">
						<?php
						if(isset($_SESSION["mesic"]) && $_SESSION["mesic"] != 0){
							echo("<option value=\"" . $_SESSION["mesic"] . "\" selected=\"selected\">" . $_SESSION["mesic"] . "</option>");
						}
						else{
							echo("<option value=\"0\" selected=\"selected\">mesic</option>");
						}
						
						for($i = 1; $i < 13; $i++){
							echo("<option value=\"" . $i . "\">" . $i . "</option>");
						} 
						?>
					</select>
					<select name="rok_narozeni">
						<?php
						if(isset($_SESSION["rok"]) && $_SESSION["rok"] != 0){
							echo("<option value=\"" . $_SESSION["rok"] . "\" selected=\"selected\">" . $_SESSION["rok"] . "</option>");
						}
						else{
							echo("<option value=\"0\" selected=\"selected\">rok</option>");
						}
						
						for($i = 1950; $i < 2013; $i++){
							echo("<option value=\"" . $i . "\">" . $i . "</option>");
						} 
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 200px; border: 0px"><label for="role">Pohlavi:</label></td>
				<td style="border: 0px">
					Žena<input type="radio" name="pohlavi" value="1" <?php if(isset($_SESSION["pohlavi"]) && 
							$_SESSION["pohlavi"] == 1){echo("checked=\"checked\"");}?>></input>
					Muž<input type="radio" name="pohlavi" value="2" <?php if(!isset($_SESSION["pohlavi"]) || 
							$_SESSION["pohlavi"] == 2){echo("checked=\"checked\"");}?>></input>
				</td>
			</tr>
			<tr>
				<td style="width: 200px; border: 0px"><label for="funkce">Funkce v oddíle:</label></td>
				<td style="border: 0px">
					<input type="text" name="funkce" <?php if(isset($_SESSION["funkce"])){
						echo("value=\"" . $_SESSION["funkce"] . "\"");}?>id="funkce" maxlength="100" style="width: 300px">
				</td>
			</tr>
		</table>
		<input type="hidden" name="aktivni" id="aktivni" value="1">
		<input type="submit" value="Založit uživatele s profilem">
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
			<p><?php echo("Nový profil " . $_GET["vlozen"] . " byl úspěšně vložen")?></p>
		</div>
	<?php 
	}
	?>	
</div>