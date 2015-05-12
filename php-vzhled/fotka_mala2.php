
<?php
if(isset($_SESSION["profilID"])){
	if(!isset($databaze)){
		$databaze = new Databaze();
	}
	
	$sql = "SELECT fotka FROM profily WHERE profilID = " . $_SESSION["profilID"];
	$fotka = $databaze->querySingleItem($sql);
	if($fotka > 0 && file_exists("fotky/profily/" . $_SESSION["profilID"] . "/" . $fotka . ".JPG")){
		?>
		<img src="fotky/profily/<?php echo($_SESSION["profilID"] . "/" . $fotka) ?>.JPG" style=" 	width: 70px; 
																								border: 5px solid white;
																								margin: 5px;">
	<?php
	
	}
	else{
		$sql = "SELECT pohlavi FROM profily WHERE profilID = " . $_SESSION["profilID"];
		$pohlavi = $databaze->querySingleItem($sql);
		if($pohlavi > 1){?>
			<img src="obrazky/ikony/muz.PNG" style=" width: 60px; border: 5px solid white;	margin: 5px;">
		<?php	
		}
		else{
		?>
			<img src="obrazky/ikony/zena.PNG" style=" 	width: 60px; border: 5px solid white; margin: 5px;">
		<?php	
		}
	} 
}
?>
