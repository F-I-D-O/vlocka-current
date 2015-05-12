
<?php

require_once 'funkce.php';

$databaze = new Databaze();

if(!$_POST["zmen"]){
	posledni_strana0();
}

switch($_POST["zmen"]){
	case "nazev":
		if($_POST["novy_nazev"] && trim($_POST["novy_nazev"]) != ""){
			$sql = "UPDATE akce SET nazev=" . $databaze->uprav_na_sql($_POST["novy_nazev"])
			. "WHERE akceID = " . $databaze->uprav_na_sql($_POST["id"]);
			if($databaze->getMysqli()->query($sql)){
				posledni_strana2("uspech=název akce byl úspěšně změněn", "akceID=" . $_POST["id"]);
			}
			else{
				posledni_strana2("chyba=název se nepodařilo změnit" . $sql, "akceID=" . $_POST["id"] . "&zmen=nazev");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste text názvu" . $sql, "akcelID=" . $_POST["id"] . "&zmen=nazev");
		}
		break;
		
	case "datum_zacatku":
		if($_POST["den_zacatku"] != "0" && $_POST["mesic_zacatku"] != "0" && $_POST["rok_zacatku"] != "0"){
			$datum_zacatku = datum($_POST["den_zacatku"], $_POST["mesic_zacatku"], $_POST["rok_zacatku"]);		
			if($datum_zacatku){
				$sql = "UPDATE akce SET datum_zacatku=" . "'" . $datum_zacatku->format("Y-m-d") . "'"
				. "WHERE akceID = " . $databaze->uprav_na_sql($_POST["id"]);
				if($databaze->getMysqli()->query($sql)){
					posledni_strana2("uspech=datum začátku akce bylo úspěšně změněno", "akceID=" . $_POST["id"]);
				}
				else{
					posledni_strana2("chyba=datum začátku akce se nepodařilo změnit" . $sql, "akceID=" . $_POST["id"] . 
									"&zmen=datum_zacatku");
				}
			}
			else{
				posledni_strana2("chyba=zadali jste neplatné datum" . $sql, "akceID=" . $_POST["id"] . "&zmen=datum_zacatku");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste kompletní datum" . $sql, "akceID=" . $_POST["id"] . "&zmen=datum_zacatku");
		}
		break;
		
	case "datum_konce":
		if($_POST["den_konce"] != "0" && $_POST["mesic_konce"] != "0" && $_POST["rok_konce"] != "0"){
			$datum_konce= datum($_POST["den_konce"], $_POST["mesic_konce"], $_POST["rok_konce"]);
			if($datum_konce){
				$sql = "UPDATE akce SET datum_konce=" . "'" . $datum_konce->format("Y-m-d") . "'"
				. "WHERE akceID = " . $databaze->uprav_na_sql($_POST["id"]);
				if($databaze->getMysqli()->query($sql)){
					posledni_strana2("uspech=datum konce akce bylo úspěšně změněno", "akceID=" . $_POST["id"]);
				}
				else{
					posledni_strana2("chyba=datum konce akce se nepodařilo změnit" . $sql, "akceID=" . $_POST["id"] .
							"&zmen=datum_konce");
				}
			}
			else{
				posledni_strana2("chyba=zadali jste neplatné datum" . $sql, "akceID=" . $_POST["id"] . "&zmen=datum_konce");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste kompletní datum" . $sql, "akceID=" . $_POST["id"] . "&zmen=datum_konce");
		}
		break;
			
	case "funkce":
		if($_POST["nova_funkce"] && trim($_POST["nova_funkce"]) != ""){
			$sql = "UPDATE profily SET funkce=" . $databaze->uprav_na_sql($_POST["nova_funkce"])
			. "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
			if($databaze->getMysqli()->query($sql)){
				posledni_strana2("uspech=funkce byla úspěšně změněna", "profilID=" . $_POST["id"]);
			}
			else{
				posledni_strana2("chyba=funkci se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=funkce");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste text funkce" . $sql, "profilID=" . $_POST["id"] . "&zmen=funkce");
		}
		break;
		
	case "ome":
		if($_POST["novy_popis"] && trim($_POST["novy_popis"]) != ""){
			$sql = "UPDATE profily SET popis=" . $databaze->uprav_na_sql($_POST["novy_popis"])
			. "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
			if($databaze->getMysqli()->query($sql)){
				posledni_strana2("uspech=popis byl úspěšně změněn", "profilID=" . $_POST["id"]);
			}
			else{
				posledni_strana2("chyba=popis se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=ome");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste žádný text" . $sql, "profilID=" . $_POST["id"] . "&zmen=ome");
		}
		break;
		
	default:
		posledni_strana0();
}
?>
