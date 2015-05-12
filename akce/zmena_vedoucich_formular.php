<!-- editace datumu konce pro administrátory a vedoucí -->

<!-- načtení seznamu vedoucích z databáze -->
<?php $sql = "SELECT nick, ID FROM uzivatele WHERE role BETWEEN 1 AND 2";
$vedouci = $databaze->queryObjectArray($sql); ?>
	
<!-- formulář pro změnu datumu -->	
<form id="zmen_vedouci-formular" class="formular" method="post" action="php/zmen_akci.php">
	<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
	<table id="vedouci-tabulka">
		<tr>
			<td colspan="2">Noví vedoucí akce</td>
		</tr>
		<tr>
			<td class="prvni_sloupec"><label for="vedouci">Vedoucí akce:</label></td>	
			<?php for($h = 1; $h < 3; $h++){
				echo("<td>");		
					echo('<select id="vedouci' . $h . '" class="seznam">');	
						echo('<option value="" selected="selected"></option>');
						for($i = 0; $i < count($vedouci); $i++){
							echo('<option value="' . $vedouci[$i]->ID . '"');
							if(is_array($uzivatele) && array_key_exists($h - 1, $uzivatele) && $vedouci[$i]->ID == $uzivatele[$h - 1]){
								echo('selected="selected"');
							}
							echo('>' . $vedouci[$i]->nick . '</option>');
						} 
					echo('</select>');
				echo("</td>");
			}?>			
			<td><label for="vedouci3">Jiný vedoucí:</label></td>
			<td><input id="vedouci3" type="text"  maxlength="20" value="
					<?php if($akce->jiny_vedouci != "NULL"){
						echo($akce->jiny_vedouci);
					} ?>"></td>
			<td><input id="ulozit_vedouci" type="button" value="Uložit"></td>		
			<td>
				<?php odkaz_zpet("vedouci") ?>
			</td>
		</tr>
	</table>
</form>		
<br>