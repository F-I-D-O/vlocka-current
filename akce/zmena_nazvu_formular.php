
<!-- formulář pro změnu názvu -->
<form id="zmen_nazev-formular" class="formular">
	<input id="akce-id"type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<p class="bez_mezer"><label for="novy_nazev">nový název akce</label></p>
	<p class="bez_mezer">
		<input 	type="text" 
				id="nazev-formularove_pole" 
				name="novy_nazev" 
				value="<?php echo($akce->nazev)?>">
		<input id="ulozit_nazev" type="button" value="Uložit">
		<?php odkaz_zpet("nazev") ?>
	</p>			
</form>	