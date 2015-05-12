<?php

require_once 'funkce.php';

session_start();

/* Skopírování údajů z formuláře do SESSION pro zpětné vyplnění při chybě */
$udaje["prezdivka"] = $_POST["prezdivka"];
$udaje["jmeno"] = $_POST["jmeno"];
$udaje["prijmeni"] = $_POST["prijmeni"];
$udaje["mesic_narozeni"] = $_POST["mesic_narozeni"];
$udaje["rok_narozeni"] = $_POST["rok_narozeni"];
$udaje["den_narozeni"] = $_POST["den_narozeni"];
$udaje["pohlavi"] = $_POST["pohlavi"];
$udaje["funkce"] = $_POST["funkce"];
$udaje["uzivatel"] = $_POST["uzivatel"];

$_SESSION["udaje"] = $udaje;

/*
* otestuje zda byla zadána přezdívka, pokud zadána nebyla, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["prezdivka"] || trim($_POST["prezdivka"]) == ""){
	posledni_strana2("chyba_vlozeni_profilu=nezadali jste přezdívku", "mod=1");
	exit;
}

/*
* otestuje zda bylo zadáno jméno, pokud zadáno nebylo, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["jmeno"] || trim($_POST["jmeno"]) == ""){
	posledni_strana2("chyba_vlozeni_profilu=nezadali jste jméno", "mod=1");
	exit;
}

/*
* otestuje zda bylo zadáno příjmení, pokud zadáno nebylo, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["prijmeni"] || trim($_POST["prijmeni"]) == ""){
	posledni_strana2("chyba_vlozeni_profilu=nezadali jste příjmení", "mod=1");
	exit;
}

/*
* Připojení k databázi MySQL - v případě neúspěchu se objeví
* chybové hlášení a činnost aplikace se ukončí
*/
$databaze = new databaze();

/*
* Spojí datum dohromady. Pokud nějaké zadané datum neexistuje, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
$datum_narozeni = datum($_POST["den_narozeni"], $_POST["mesic_narozeni"], $_POST["rok_narozeni"]);
if($datum_narozeni == FALSE){
	posledni_strana2("chyba_vlozeni_profilu=zadali jste neplatné datum " . $_POST["den_narozeni"] . ". " . 
			$_POST["mesic_narozeni"] . ". " .$_POST["rok_narozeni"], "mod=1");
	exit;
}

odstran_lomitka($_POST);

vloz_profil($_POST, $databaze, $datum_narozeni);

// pokus o přihláąení; pokud je to moľné, provede se přesun přímo na soubor newpoll.php
function vloz_profil($formdata, $databaze, $datum_narozeni){
	$prezdivka= $_POST["prezdivka"];
	$jmeno = $_POST["jmeno"];
	$prijmeni = $_POST["prijmeni"];
	$pohlavi = $_POST["pohlavi"];
	$funkce = $_POST["funkce"];
	
	$sql = "INSERT INTO profily (prezdivka, jmeno, prijmeni, datum_narozeni, pohlavi, funkce, aktivni)
			VALUES (" 	. $databaze->uprav_na_sql($prezdivka) . ", "
			 			. $databaze->uprav_na_sql($jmeno) . ", "
			 			. $databaze->uprav_na_sql($prijmeni) . ", "
			 			. "'" . $datum_narozeni->format("Y-m-d"). "'" . ", "
			 			. "'" . $pohlavi . "'". ", "
			 			. $databaze->uprav_na_sql($funkce) . ", "
			 			. "'1')";
	
	//odeslání dat do databáze
	if($databaze->getMysqli()->query($sql)) {
		if($_POST["uzivatel"] || trim($_POST["uzivatel"]) != ""){
			$sql = "SELECT profilID FROM profily ORDER BY profilID DESC LIMIT 1";
			$profilID = $databaze->querySingleItem($sql);
			if($profilID){
				$sql = "SELECT ID FROM uzivatele WHERE nick = " . $databaze->uprav_na_sql($_POST["uzivatel"]) . " LIMIT 1";
				$uzivatelID = $databaze->querySingleItem($sql);
				if($profilID){
					$sql = "UPDATE profily SET uzivatelID = " . $databaze->uprav_na_sql($uzivatelID) . 
					"WHERE profilID = " . $databaze->uprav_na_sql($profilID);
					if($databaze->getMysqli()->query($sql)){
						$sql = "UPDATE uzivatele SET profilID = " . $databaze->uprav_na_sql($profilID) . 
						" WHERE ID = " . $databaze->uprav_na_sql($uzivatelID);
						if(!$databaze->getMysqli()->query($sql)){
							posledni_strana2("chyba_vlozeni_profilu=" . $sql, "mod=1");
						}
					}
					else{
						posledni_strana2("chyba_vlozeni_profilu=" . $sql, "mod=1");
					}
				}
				else{
					posledni_strana2("chyba_vlozeni_profilu=" . $sql, "mod=1");
				}
			}
			else{
				posledni_strana2("chyba_vlozeni_profilu=" . $sql, "mod=1");
			}
			
		}
		    
	    //přesměrování
	    header("Location: ../vlozit_uzivatele.php?mod=1&vlozen=$prezdivka");
	    exit;
	}
	else{
    	posledni_strana2("chyba_vlozeni_profilu=" . $sql, "mod=1");
	}
}

?>
