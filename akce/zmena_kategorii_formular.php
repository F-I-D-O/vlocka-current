
<form id="zmen_kategorie-formular" class="formular" method="post" action="php/zmen_akci.php">
	<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<table id="kategorie-tabulka">
		<tr>
			<td colspan="5">Nové věkové kategorie akce:</td>
		</tr>
		<tr>
			<td class="prvni_sloupec">Akce je pro:</td>
			<td class="nazev_kategorie"><label for="nadpis">předškoláci</label></td>
			<td class="nazev_kategorie"><label for="nadpis">vlčata</label></td>
			<td class="nazev_kategorie"><label for="nadpis">světlušky</label></td>
			<td class="nazev_kategorie"><label for="nadpis">skauti</label></td>
			<td class="nazev_kategorie"><label for="nadpis">skautky</label></td>
			<td class="nazev_kategorie"><label for="nadpis">roveři</label></td>
			<td class="nazev_kategorie"><label for="nadpis">rangers</label></td>
			<td class="nazev_kategorie"><label for="nadpis">vedení</label></td>
		</tr>
		<tr>
			<td style="border: 0px"></td>
			<?php for($i = 1; $i < 9; $i++){
				echo('<td class="checkbox">');
					echo('<input id="kategorie' . $i . '" type="checkbox"');
						if(in_array(kategorie($i), $kategorie_jednotlive)){
							echo('checked="checked"');
						} 
					echo(">");
				echo("</td>");
			} ?>
		</tr>
		<tr>
			<td  id="upresnujici_kategorie-nadpis-bunka" colspan="9">
				<label for="datum">
					Upřesnění kategorie (výprava je "jen pro někoho" apod.):
				</label>
			</td>
		</tr>
		<tr>
			<td id="upresnujici_kategorie-okno-bunka" colspan="9">
				<input type="text" name="special" id="upresnujici_kategorie-okno" 
				<?php echo("value=\"" . $akce->jina_kategorie . "\"");?>
				maxlength="500">
			</td>
		</tr>
		<tr>
			<td><input id="ulozit_kategorie" type="button" value="Uložit"></td>
			<td>
				<?php odkaz_zpet("kategorie") ?>
			</td>
		</tr>
	</table>
</form>
