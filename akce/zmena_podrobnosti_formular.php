
<!-- formulář pro změnu podrobných informací -->
<form id="zmen_podrobnosti-formular" class="formular" method="post" action="php/zmen_akci.php">
	<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<p class="bez_mezer"><label for="novy_nazev">Nové informace o akci</label></p>
	<input id="ulozit_podrobnosti" type="button" value="Uložit">		
	<?php odkaz_zpet("podrobnosti") ?>
	<p class="bez_mezer">
		<textarea id="podrobne_info-textarea" class="mceEditor"><?php echo($akce->info)?></textarea>
	</p>			
</form>	