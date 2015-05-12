<?php

require_once 'php/funkce.php';

if(!$_SESSION["role"] || $_SESSION["role"] > 2){
	posledni_strana();
}

if(array_key_exists("novinka", $_GET)){?>
		
	<form action="php/nova_novinka.php" method="post" style="margin: 10px">
	<table>
		<tr>
			<td style="width: 200px"><label for="nadpis">Nadpis novinky:</label></td>
			<td><input type="text" name="nadpis" id="nadpis" maxlength="120" style="width: 300px"></td>
		</tr>
		<tr>
			<td><label for="text">Text novinky:</label></td>
		</tr>
	</table>
	<textarea name="text" id="novinka-textarea" class="mceEditor" maxlength="10000" style="width: 455px"></textarea>
	<?php
	if($_SESSION["role"] > 1){?>
		<input type="hidden" name="aktivni" id="aktivni" value="0">
	<?php	
	}
	else{?>
		<input type="hidden" name="aktivni" id="aktivni" value="1">
	<?php
	}
	?>
	<input type="submit" value="Vložit novinku do databáze">
	</form>
	
	<form action="index.php" method="post" style="margin: 10px">
	<input type="submit" value="Zpět">
	</form>
	
	<?php
	if(array_key_exists("chyba_novinka", $_GET)){?>
	
		<div class="error">
			<p> <?php echo($_GET["chyba_novinka"])?> </p>
		</div>
	<?php 
	}
	if(array_key_exists("uspech_novinka", $_GET)){?>	
			<div class="succes">
				<p> <?php echo($_GET["uspech_novinka"])?> </p>
			</div>
	<?php 
	}			
}

else{?>
	<form action="index.php?novinka=1" method="post" style="margin: 10px">
	<input type="submit" value="Přidat novou novinku">
	</form>
<?php
}
?>