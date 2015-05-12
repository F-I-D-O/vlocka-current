<?php
require '../php/funkce.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){	
	if($_GET["novy_nazev"] && trim($_GET["novy_nazev"]) != ""){
		$sql = "UPDATE akce SET nazev=" . $databaze->uprav_na_sql($_GET["novy_nazev"])
		. "WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
		if($databaze->getMysqli()->query($sql)){
			echo('{"status" : "uspech", "text" : "Název akce byl úspěšně změněn", "data" : "' 
					. $_GET["novy_nazev"] . '"}'); 
		}
		else{
			echo('{"status" : "chyba", "text" : "chyba=název se nepodařilo změnit' . $sql . '", 
					"data" : "' . $_GET["novy_nazev"] . '"}'); 
		}
	}
	else{
		echo('{"status" : "chyba", "text" : "Nezadali jste text názvu!", "data" : "' 
					. $_GET["novy_nazev"] . '"}'); 
	}
}
?>
