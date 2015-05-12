<?php
require '../php/funkce.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){
	if($_GET["den_konce"] != "0" && $_GET["mesic_konce"] != "0" && $_GET["rok_konce"] != "0"){
		$datum_konce = datum($_GET["den_konce"], $_GET["mesic_konce"], $_GET["rok_konce"]);
		if($datum_konce){
			$sql = "UPDATE akce SET datum_konce=" . "'" . $datum_konce->format("Y-m-d") . "'"
			. "WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
			if($databaze->getMysqli()->query($sql)){
				echo('{"status" : "uspech", "text" : "Datum konce akce byl úspěšně změněn", "data" : "' 
					. $datum_konce->format("j. n. Y") . '"}'); 
			}
			else{
				echo('{"status" : "chyba", "text" : "Datum konce akce se nepodařilo změnit!"'. $sql . ', "data" : "' 
						. $datum_konce->format("j. n. Y") . '"}');
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