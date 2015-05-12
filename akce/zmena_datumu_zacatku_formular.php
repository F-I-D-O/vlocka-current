
<!-- formulář pro změnu datumu -->	
<form id="zmen_datum_zacatku-formular" class="formular">
	<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<p class="bez_mezer"><label for="datum_zacatku">nové datum začátku</label></p>
	<p class="bez_mezer">
		<select id="den_zacatku">
			<option value="<?php echo($datum_zacatku->format("j")) ?>"
					selected="selected">
					<?php echo($datum_zacatku->format("j")) ?>
			</option>
			<?php for($i = 1; $i < 32; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<select id="mesic_zacatku">
			<option value="<?php echo($datum_zacatku->format("n")) ?>" 
					selected="selected">
					<?php echo($datum_zacatku->format("n")) ?>
			</option>
			<?php for($i = 1; $i < 13; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<select id="rok_zacatku">
			<option value="<?php echo($datum_zacatku->format("Y")) ?>" 
					selected="selected">
					<?php echo($datum_zacatku->format("Y")) ?>
			</option>
			<?php for($i = 1999; $i < 2014; $i++){
				echo("<option value=\"" . $i . "\">" . $i . "</option>");
			}?>
		</select>
		<input id="ulozit_datum_zacatku" type="button" value="Uložit">
		<?php odkaz_zpet("datum_zacatku") ?>
	</p>
</form>
