
<!-- formulář pro změnu datumu -->	
<form id="zmen_datum_konce-formular" class="formular" method="post" action="php/zmen_akci.php">
	<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<p class="bez_mezer"><label for="datum_konce">nové datum konce</label></p>
	<p class="bez_mezer">
		<select id="den_konce">
			<option value="<?php echo($datum_konce->format("j")) ?>"
					selected="selected">
					<?php echo($datum_konce->format("j")) ?>
			</option>
			<?php for($i = 1; $i < 32; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<select id="mesic_konce">
			<option value="<?php echo($datum_konce->format("n")) ?>" 
					selected="selected">
					<?php echo($datum_konce->format("n")) ?>
			</option>
			<?php for($i = 1; $i < 13; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<select id="rok_konce">
			<option value="<?php echo($datum_konce->format("Y")) ?>" 
					selected="selected">
					<?php echo($datum_konce->format("Y")) ?>
			</option>
			<?php for($i = 1999; $i < 2014; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<input id="ulozit_datum_konce" type="button" value="Uložit">
		<?php odkaz_zpet("datum_konce") ?>
	</p>
</form>
