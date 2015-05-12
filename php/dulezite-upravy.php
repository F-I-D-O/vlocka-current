
<?php
require_once 'funkce.php';

session_start();

if(!$_SESSION["role"] || $_SESSION["role"] > 1){
	posledni_strana();
}

$databaze = new Databaze();

if(isset($_GET["smaz"])){
	$sql = "DELETE FROM dulezite WHERE ID=" . $_GET["smaz"];
	
	if($databaze->getMysqli()->query($sql)){
		posledni_strana1("uspech_dulezite=zpráva úspěšně smazána");
	}
	else{
		posledni_strana1("chyba_dulezite=zprávu se nepodařilo smazat");
	}
}

	
?>