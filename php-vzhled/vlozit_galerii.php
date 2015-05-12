<?php
if(array_key_exists("vlozit", $_GET)){?>
						
	<form action="php/nova_galerie.php" method="post" style="margin: 10px">
	<table>
		<tr>
			<td style="width: 200px; border: 0px">
				<label for="nadpis">Název galerie:</label>
			</td>
			<td style="border: 0px">
				<input type="text" name="nazev" id="nazev" maxlength="500" style="width: 500px"
					<?php 
						if(isset($_SESSION["udaje"]["nazev"]) && $_SESSION["udaje"]["nazev"] != ""){
							echo('value="' . $_SESSION["udaje"]["nazev"] . '"');
						}
					?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px">
				<label for="nadpis">odkaz:</label>
			</td>
			<td style="border: 0px">
				<input type="text" name="odkaz" id="nazev" maxlength="1000" style="width: 500px"
					<?php 
						if(isset($_SESSION["udaje"]["odkaz"]) && $_SESSION["udaje"]["odkaz"] != ""){
							echo('value="' . $_SESSION["udaje"]["odkaz"] . '"');
						}
					?>
				>
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
						echo("<option value=\"0\" selected=\"selected\">měsíc</option>");
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
						echo("<option value=\"0\" selected=\"selected\">rok</option>");
					}
				
					for($i = 2000; $i < 2021; $i++){
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
						echo("<option value=\"0\" selected=\"selected\">měsíc</option>");
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
						echo("<option value=\"0\" selected=\"selected\">rok</option>");
					}
				
					for($i = 2000; $i < 2021; $i++){
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
			<td style="width: 150px; border: 0px"><label for="role">Autoři fotografií:</label></td>
			<td style="border: 0px" colspan="8">
				<?php 
				$sql = "SELECT prezdivka, profilID FROM profily ORDER BY prezdivka";
				$autori = $databaze->queryObjectArray($sql);
				for($i = 1; $i < 6; $i++){
					?>
					<select name="autor<?php echo("$i")?>">
						<?php				
						if(isset($_SESSION["udaje"]["autor" . $i]) && $_SESSION["udaje"]["autor" . $i] != 0){
							$sql = "SELECT prezdivka FROM profily WHERE profilID = " . 
									$databaze->uprav_na_sql($_SESSION["udaje"]["autor" . $i]);
							$nick = $databaze->querySingleItem($sql);
							
							echo("<option value=\"" .  $_SESSION["udaje"]["autor" . $i] . "\" selected=\"selected\">" .
									 $nick . "</option>");
						}
						else{
							echo('<option value="0" selected="selected">autor ' . $i . '</option>');
						}
						echo('<option value="0"></option>');
						for($j = 0; $j < count($autori); $j++){
							echo("<option value=\"" . $autori[$j]->profilID . "\">" . $autori[$j]->prezdivka . "</option>");
						} 
						?>
					</select>
				<?php }?>
			</td>
		</tr>		
		<tr>
			<td style="width: 200px; border: 0px">
				<label for="dalsi_autori">Další autoři</label>
			</td>
			<td style="border: 0px">
				<input type="text" name="dalsi_autori" id="nazev" maxlength="500" style="width: 500px"
					<?php
					if(isset($_SESSION["udaje"]["dalsi_autori"]) && $_SESSION["udaje"]["dalsi_autori"] != ""){
						echo('value="' . $_SESSION["udaje"]["dalsi_autori"] . '"');
					}
					?>
				>
			</td>
		</tr>
		<tr>
			<td style="width: 200px; border: 0px" colspan="2">
				<label for="nadpis">Přidat zprávu o fotkách do novinek</label>
				<input type="checkbox" name="vlozit_do_novinek" <?php if(isset($_SESSION["udaje"]["vlozit_do_novinek"]) && 
						$_SESSION["udaje"]["vlozit_do_novinek"] == "on"){echo("checked=\"checked\"");}?>>
			</td>
		</tr>
	</table>
	<?php
	if(opravneni(1)){?>
		<input type="hidden" name="aktivni" id="aktivni" value="1">
	<?php	
	}
	else{?>
		<input type="hidden" name="aktivni" id="aktivni" value="0">
	<?php
	}
	?>
	<input type="hidden" name="rok" id="rok" value="<?php echo($_GET["rok"])?>">
	<input type="submit" value="Vložit galerii do databáze">
	</form>
	
	<form action="fotokronika.php?rok=<?php echo($_GET["rok"]); ?>" method="post" style="margin: 10px">
	<input type="submit" value="Zpět">
	</form>
	
	<?php 			
}

else{?>
	<form action="fotokronika.php?vlozit=1" method="post" style="margin: 10px">
	<input type="submit" value="Přidat novou galerii">
	</form>
<?php
}