<?php
require '../php/funkce.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){
	/*
	* otestuje zda byl zadán alespoň jeden vedoucí akce, pokud zadán nebyl, vkládání akce skončí
	* a zobrazí se chybová hláška.
	*/
	$i = 1;
	$vedouci = FALSE;
	while($i < 4){
		if(isset($_GET["vedouci" . $i]) && trim($_GET["vedouci" . $i]) != ""){
			$vedouci = TRUE;
		}
		$i++;
	}
	
	if($vedouci == TRUE){
		$profily[1] = "";
		$profily[2] = "";
		if(isset($_GET["vedouci3"]) && $_GET["vedouci3"]  != ""){
			$sql = "UPDATE akce SET jiny_vedouci=" . $databaze->uprav_na_sql($_GET["vedouci3"]) . 
			" WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
		}
		else{
			$sql = "UPDATE akce SET jiny_vedouci='NULL' WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
		}
		if(!$databaze->getMysqli()->query($sql)){
			echo('{"status" : "chyba", "text" : "Jiného vedoucího akce se nepodařilo změnit!'. $sql . '"
					, "data" : "' . $_GET["vedouci3"] . '"}');
			exit();
		}
		
		$sql = "DELETE FROM vztah_uzivatel_akce WHERE akceID = " . $databaze->uprav_na_sql($_GET["id"]);
		$uspech = $databaze->getMysqli()->query($sql);
		if(!$uspech){
			echo('{"status" : "chyba", "text" : "Staré vedoucí akce se nepodařilo smazat! '.
					$sql . '", "data" : ""}');
			exit();
		}
		
		for($i = 1; $i < 3; $i++){
			if($_GET["vedouci" . $i] && $_GET["vedouci" . $i] != ""){
				$sql = "INSERT INTO vztah_uzivatel_akce (uzivatelID, akceID) VALUES (" .
						$databaze->uprav_na_sql($_GET["vedouci" . $i])
						. ", " . $databaze->uprav_na_sql($_GET["id"]) . ")";
				$uspech = $databaze->getMysqli()->query($sql);
				if(!$uspech){
					echo('{"status" : "chyba", "text" : "vedoucí akce se nepodařilo změnit!"'. 
						$sql . ', "data" : "' . $_GET["vedouci1"] . $_GET["vedouci2"] . '"}');
					exit();
				}
				
				$sql = "SELECT profilID FROM profily WHERE uzivatelID = " .
						$databaze->uprav_na_sql($_GET["vedouci" . $i]);
				$profily[$i] = $databaze->querySingleItem($sql);
			}
		}
		$vedouci1 = odkaz_na_profil($profily[1], $databaze) ? odkaz_na_profil($profily[1], $databaze) : "";
		$vedouci2 = odkaz_na_profil($profily[2], $databaze) ? odkaz_na_profil($profily[2], $databaze) : "";
		$vedouci3 = $_GET["vedouci3"] ? $_GET["vedouci3"] : "";
		echo('{"status" : "uspech", "text" : "Vedoucí akce byli úspěšně změněni", "data" : ["'
				. odkaz_na_profil($profily[1], $databaze) . '", "' . odkaz_na_profil($profily[2], $databaze) . '", "'
				. $_GET["vedouci3"] . '"]}');
	}
	else{
		echo('{"status" : "chyba", "text" : "Nezadali jste žádného vedoucího!", "data" : ""}');
	}
}
?>