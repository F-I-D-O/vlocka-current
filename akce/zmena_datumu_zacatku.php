<?php
require '../php/funkce.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){
	if($_GET["den_zacatku"] != "0" && $_GET["mesic_zacatku"] != "0" && $_GET["rok_zacatku"] != "0"){
		$datum_zacatku = datum($_GET["den_zacatku"], $_GET["mesic_zacatku"], $_GET["rok_zacatku"]);
		if($datum_zacatku){
			$sql = "UPDATE akce SET datum_zacatku=" . "'" . $datum_zacatku->format("Y-m-d") . "'"
			. "WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
			if($databaze->getMysqli()->query($sql)){
				echo('{"status" : "uspech", "text" : "Datum začátku akce byl úspěšně změněn", "data" : "' 
					. $datum_zacatku->format("j. n. Y") . '"}'); 
			}
			else{
				echo('{"status" : "chyba", "text" : "Datum začátku akce se nepodařilo změnit!"'. $sql . ', "data" : "' 
						. $datum_zacatku->format("j. n. Y") . '"}');
			}
		}
		else{
			echo('{"status" : "chyba", "text" : "Zadali jste neplatné datum!"'. $sql . ', "data" : ""}');
		}
	}
	else{
		echo('{"status" : "chyba", "text" : "Nezadali jste kompletní datum!", "data" : ""}');
	}
}
?>