<?php
require '../php/funkce.php';
require_once '../php-konstanty/kategorie.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){
	/*
	 * otestuje zda bylo zadána alespoň jedna kategorie, pokud zadána nebyla, vkládání akce skončí
	* a zobrazí se chybová hláška.
	*/	
	$kategorie = "";
	$i = 1; $j = 0;
	while($i < 9){
		if(isset($_POST[$i]) && $_POST[$i] == "on"){
			if($j > 0){
				$kategorie = $kategorie . ",";
			}
			$kategorie = $kategorie . kategorie($i);
			$j++;
		}
		$i++;
	}
	
	if($j > 0){
		$sql = "UPDATE akce SET kategorie='" . $kategorie . "', jina_kategorie=" . 
				$databaze->uprav_na_sql($_POST["upresnujici_kategorie"]) . " WHERE akceID = " . 
				$databaze->uprav_na_sql($_POST["id"]);
		if($databaze->getMysqli()->query($sql)){
			echo('{"status" : "uspech", "text" : "Kategoorie akce byly úspěšně změněny", "data" : {"kategorie" : "' 
					. $kategorie . '", "jina_kategorie" : "' . $_POST["upresnujici_kategorie"] . '"}}');
		}
		else{
			echo('{"status" : "chyba", "text" : "Kategorie akce se nepodařilo změnit!'. $sql . '", "data" : {"kategorie" : "' 
					. $kategorie . '", "jina_kategorie" : "' . $_POST["upresnujici_kategorie"] . '"}}');
		}
	}
	else{
		echo('{"status" : "chyba", "text" : "Nezadali jste žádnou kategorii!", "data" : ""}');
	}
}
?>