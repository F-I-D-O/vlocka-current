
<?php
require_once 'funkce.php';

session_start();

if($_SESSION["role"] > 1){
	posledni_strana();
}

$databaze = new Databaze();

if(isset($_POST["smaz_akci"])){
	$sql = "DELETE FROM akce WHERE akceID=" . $_POST["smaz_akci"];
	
	if($databaze->getMysqli()->query($sql)){
		header("Location: ../plan.php?uspech=akce úspěšně odstraněna");
	}
	else{
		posledni_strana("chyba=akci se nepodařilo smazat");
	}
}

	
?>