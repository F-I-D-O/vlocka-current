
<?php

require_once 'funkce.php';

$databaze = new Databaze();

if(!$_POST["zmen"]){
	posledni_strana0();
}

switch($_POST["zmen"]){
	case "fotka":
		if (!empty($_FILES) && $_FILES['fotka']["name"] != ""){
			if (move_uploaded_file($_FILES['fotka']['tmp_name'], $_SERVER[DOCUMENT_ROOT] . 
				"/fotky/profily/" . $_POST["id"] . "/" . $_POST["fotky"] . ".JPG")){
				
				
				$sql = "UPDATE profily SET fotka=" . $databaze->uprav_na_sql($_POST["fotky"])
			 			 . ", fotky = fotky + 1 " . "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
				if($databaze->getMysqli()->query($sql)){
					posledni_strana2("uspech=fotka úspěšně nahrána", "profilID=" . $_POST["id"]);
				}
				else{
					posledni_strana2("chyba=fotku se nepodařilo nastavit" . $sql, "profilID=" . $_POST["id"] . "&zmen=fotka");
				}
			}
			else{
				switch( $_FILES['fotka']['error']){
					case 0:
						posledni_strana2("chyba=fotku se nepodařilo nahrát na server - chyba při přesunu souboru na servru",
										"profilID=" . $_POST["id"] . "&zmen=fotka");
						break;
						
					case 1:
					case 2:
						posledni_strana2("chyba=fotku se nepodařilo nahrát na server - fotka je příliš velká",
										 "profilID=" . $_POST["id"] . "&zmen=fotka");
						break;
						
					default:
						posledni_strana2("chyba=fotku se nepodařilo nahrát na server - neznámá chyba",
										 "profilID=" . $_POST["id"] . "&zmen=fotka");
						break;
				}
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste žádný soubor", "profilID=" . $_POST["id"] . "&zmen=fotka");
		}
		break;
		
	case "prezdivka":
		if($_POST["nova_prezdivka"] && trim($_POST["nova_prezdivka"]) != ""){
			$sql = "UPDATE profily SET prezdivka=" . $databaze->uprav_na_sql($_POST["nova_prezdivka"])
			. "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
			if($databaze->getMysqli()->query($sql)){
				posledni_strana2("uspech=přezdívka byla úspěšně změněna", "profilID=" . $_POST["id"]);
			}
			else{
				posledni_strana2("chyba=přezdívku se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=prezdivka");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste text přezdívky" . $sql, "profilID=" . $_POST["id"] . "&zmen=prezdivka");
		}
		break;
		
	case "jmeno":
		if($_POST["nove_jmeno"] && trim($_POST["nove_jmeno"]) != ""){
			$jmeno_pole = explode(" ", $_POST["nove_jmeno"]);
			$jmeno = $jmeno_pole[0];
			$prijmeni = $jmeno_pole[1];
			
			if($jmeno && trim($jmeno) != "" && $prijmeni && trim($prijmeni) != "" ){
				$sql = "UPDATE profily SET jmeno=" . $databaze->uprav_na_sql($jmeno)
					 . ", prijmeni = " . $databaze->uprav_na_sql($prijmeni) . "WHERE profilID = "
					 . $databaze->uprav_na_sql($_POST["id"]);
				if($databaze->getMysqli()->query($sql)){
					posledni_strana2("uspech=jméno bylo úspěšně změněno", "profilID=" . $_POST["id"]);
				}
				else{
					posledni_strana2("chyba=jméno se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=jmeno");
				}
			}
			else{
				posledni_strana2("chyba=neplatný formát jména" . $sql, "profilID=" . $_POST["id"] . "&zmen=jmeno");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste žádné jméno" . $sql, "profilID=" . $_POST["id"] . "&zmen=jmeno");
		}
		break;
		
	case "vek":
		if($_POST["den_narozeni"] != "0" && $_POST["mesic_narozeni"] != "0" && $_POST["rok_narozeni"] != "0"){
			$datum_narozeni = datum($_POST["den_narozeni"], $_POST["mesic_narozeni"], $_POST["rok_narozeni"]);		
			if($datum_narozeni){
				$sql = "UPDATE profily SET datum_narozeni=" . "'" . $datum_narozeni->format("Y-m-d") . "'"
				. "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
				if($databaze->getMysqli()->query($sql)){
					posledni_strana2("uspech=datum narození bylo úspěšně změněno", "profilID=" . $_POST["id"]);
				}
				else{
					posledni_strana2("chyba=datum narození se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=vek");
				}
			}
			else{
				posledni_strana2("chyba=zadali jste neplatné datum" . $sql, "profilID=" . $_POST["id"] . "&zmen=vek");
			}
		}
		else{
			posledni_strana2("chyba=nezadali jste kompletní datum" . $sql, "profilID=" . $_POST["id"] . "&zmen=vek");
		}
		break;
		
	case "pohlavi":
		$sql = "UPDATE profily SET pohlavi=" . "'" . $_POST["pohlavi"] . "'"
		. "WHERE profilID = " . $databaze->uprav_na_sql($_POST["id"]);
		if($databaze->getMysqli()->query($sql)){
			posledni_strana2("uspech=pohlaví bylo úspěšně změněno", "profilID=" . $_POST["id"]);
		}
		else{
			posledni_strana2("chyba=dpohlaví se nepodařilo změnit" . $sql, "profilID=" . $_POST["id"] . "&zmen=vek");
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
