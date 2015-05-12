
<div id="maz_menu">	
	<form action="php/smaz_akci.php" method="post">
		<input type="hidden" name="smaz_akci" value="<?php echo($akce->akceID) ?>">
		<input type="submit" value="Smazat akci">
	</form>
	
	<?php
	if($akce->aktivni > 0){
	?>	
		<form action="php/aktivace_akce.php" method="post">
			<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
			<input type="hidden" name="aktivace" value="0">
			<input type="submit" value="Deaktivovat akci">
		</form>	
	<?php
	}
	else{
	?>
		<form action="php/aktivace_akce.php" method="post">
			<input type="hidden" name="id" value="<?php echo($akce->akceID) ?>">
			<input type="hidden" name="aktivace" value="1">
			<input type="submit" value="Aktivovat akci">
		</form>
	<?php
	}
	?>					
</div>