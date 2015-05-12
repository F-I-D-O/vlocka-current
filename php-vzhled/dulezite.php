<?php 
$sql = "SELECT * FROM dulezite WHERE aktivni > 0 LIMIT 20";
$dulezite = $databaze->queryObjectArray($sql);

if($dulezite){
?>

	<div id="dulezite" style="	width: 210px; 
								height: 150px; 
								background: #E18E5E; 
								margin: 10px;
								border: 5px solid #E15201; 
								border-radius: 10px;
								font-size: 11px;
								font-weight: bold;
								overflow: auto">
				
		<h2>Důležité</h2>
		<?php 
		
		$barva = "#C9532E";
		for($i = count($dulezite) - 1; $i > -1; $i -= 1){
			echo("<p style=\"margin: 0 0px; padding: 0.8em; background:" . $barva . "\">" . $dulezite[$i]->zprava);
				if(isset($_SESSION["role"]) && $_SESSION["role"] < 3){
					echo( "<a href=\"php/dulezite-upravy.php?smaz=" . $dulezite[$i]->ID . "\">");	
						echo("<img src=\"obrazky/ikony/trash.PNG\"></a>");
				}
			echo("</p>");	
			if($barva == "#C9532E"){
				$barva = "#E18E5E";
			}
			else{
				$barva = "#C9532E";
			}
		}
		?>
											
	</div>

<?php
}
if(isset($_SESSION["ID"])){		
	if(isset($_SESSION["role"]) && $_SESSION["role"] < 3){
		if(array_key_exists("dulezite", $_GET)){?>
			<form action="php/nove_dulezite.php" method="post" style="margin: 10px">
			<p style="text-align: left">Text novinky:</p>
			<textarea name="text" id="text" maxlength="200" style="width: 210px; margin: 0 0 10px 0"></textarea>
			<input type="hidden" name="aktivni" id="aktivni" value="1">
			<input type="submit" value="Vložit důležitou zprávu">
			</form>
			
			<form action="index.php" method="post" style="margin: 10px">
			<input type="submit" value="Zpět">		
			</form>
		<?php	
		}
		else{?>
			<form action="index.php?dulezite=1" method="post" style="margin: 10px">
			<input type="submit" value="Přidat důležitou zprávu">
			</form>
		<?php	
		}
		
		if(array_key_exists("chyba_dulezite", $_GET)){?>
			<div class="error">
				<p> <?php echo($_GET["chyba_dulezite"])?> </p>
			</div>
		<?php
		}
		if(array_key_exists("uspech_dulezite", $_GET)){?>
			<div class="succes">
				<p><?php echo($_GET["uspech_dulezite"])?></p>
			</div>
		<?php 
		}
	}
}
?>