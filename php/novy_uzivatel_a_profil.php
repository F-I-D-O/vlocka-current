<?php

require_once 'funkce.php';
session_start();

$_SESSION["login2"] = $_POST["novy_login"];

$_SESSION["prezdivka"] = $_POST["prezdivka"];

$_SESSION["role2"] = $_POST["nova_role"];

$_SESSION["jmeno"] = $_POST["jmeno"];

$_SESSION["prijmeni"] = $_POST["prijmeni"];

$_SESSION["den"] = $_POST["den_narozeni"];
$_SESSION["mesic"] = $_POST["mesic_narozeni"];
$_SESSION["rok"] = $_POST["rok_narozeni"];

$_SESSION["pohlavi"] = $_POST["pohlavi"];

$_SESSION["funkce"] = $_POST["funkce"];


/*
* otestuje zda bylo zadáno uživatelské jméno, pokud zadáno nebylo, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["novy_login"] || trim($_POST["novy_login"]) == ""){
	posledni_strana2("chyba_vlozeni=nezadali jste uživatelské jméno",  "mod=2");
	exit;
}

/*
 * otestuje zda bylo zadáno heslo, pokud zadáno nebylo, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["nove_heslo"] || trim($_POST["nove_heslo"]) == ""){
	posledni_strana2("chyba_vlozeni=nezadali jste heslo",  "mod=2");
	exit;
}

/*
 * otestuje zda bylo zadáno heslo i podruhé, a zdali se shoduje s prvním zadáním.
 * Pokud heslo zadáno nebylo nebo se hesla neshodují, vkládání skončí a zobrazí se chybová hláška.
*/
if(!$_POST["nove_heslo2"] || trim($_POST["nove_heslo2"]) == "" || $_POST["nove_heslo2"] != $_POST["nove_heslo"]){
	posledni_strana2("chyba_vlozeni=hesla se neshodují",  "mod=2");
	exit;
}

/*
* otestuje zda byla zadána přezdívka, pokud zadána nebyla, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["prezdivka"] || trim($_POST["prezdivka"]) == ""){
	posledni_strana2("chyba_vlozeni=nezadali jste přezdívku", "mod=2");
	exit;
}

/*
* otestuje zda bylo zadáno jméno, pokud zadáno nebylo, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["jmeno"] || trim($_POST["jmeno"]) == ""){
	posledni_strana2("chyba_vlozeni=nezadali jste jméno" . $_COOKIE["prezdivka"], "mod=2");
	exit;
}

/*
* otestuje zda bylo zadáno příjmení, pokud zadáno nebylo, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["prijmeni"] || trim($_POST["prijmeni"]) == ""){
	posledni_strana2("chyba_vlozeni=nezadali jste příjmení", "mod=2");
	exit;
}

/*
* otestuje zda byl datum narození zadán správně. Pokud zadané datum neexistuje, vkládání profilu skončí
* a zobrazí se chybová hláška.
*/
if(!checkdate($_POST["mesic_narozeni"], $_POST["den_narozeni"], $_POST["rok_narozeni"])){
	posledni_strana2("chyba_vlozeni=zadali jste neexistující datum" . $_POST["den_narozeni"]
						 . ". " .$_POST["mesic_narozeni"] . ". " . $_POST["rok_narozeni"], "mod=2");
	exit;
}

/*
* Připojení k databázi MySQL - v případě neúspěchu se objeví
* chybové hlášení a činnost aplikace se ukončí
*/
$databaze = new databaze();

//spojí datum dohromady
$datum_narozeni = new DateTime($_POST["den_narozeni"] . "-" . $_POST["mesic_narozeni"]
								. "-" . $_POST["rok_narozeni"]);

// posledni_strana2("chyba_vlozeni=zadali jste neexistující datum" . $datum_narozeni->format(""), "mod=2");
// exit;

odstran_lomitka($_POST);

vloz_uzivatele_a_profil($_POST, $databaze, $datum_narozeni);

// pokus o přihláąení; pokud je to moľné, provede se přesun přímo na soubor newpoll.php
function vloz_uzivatele_a_profil($formdata, $databaze, $datum_narozeni){
	$login = $_POST["novy_login"];
	$heslo = $_POST["nove_heslo"];
	$role = $_POST["nova_role"];
	
	
	$prezdivka= $_POST["prezdivka"];
	$jmeno = $_POST["jmeno"];
	$prijmeni = $_POST["prijmeni"];
	$pohlavi = $_POST["pohlavi"];
	$funkce = $_POST["funkce"];
	$aktivni = $_POST["aktivni"];
	
	$sql = "INSERT INTO uzivatele (nick, heslo, role, aktivni)
					VALUES (" 	. $databaze->uprav_na_sql($login) . ", UNHEX(SHA("
								. $databaze->uprav_na_sql($heslo . $login) . ")), "
								. $databaze->uprav_na_sql($role) . ", "
								. "'" . $aktivni . "'" . ")";
	
	if(!$databaze->getMysqli()->query($sql)) {
		posledni_strana2("chyba_vlozeni=" . $sql, "mod=2");
	}
	
	$uzivatelID = $databaze->querySingleItem("SELECT LAST_INSERT_ID()");
	
	if(!$uzivatelID) {
		posledni_strana2("chyba_vlozeni=SELECT LAST_INSERT_ID() selhalo", "mod=2");
	}
  
	$sql = "INSERT INTO profily (prezdivka, jmeno, prijmeni, uzivatelID, datum_narozeni, pohlavi, funkce, aktivni)
			VALUES (" 	. $databaze->uprav_na_sql($prezdivka) . ", "
			 			. $databaze->uprav_na_sql($jmeno) . ", "
			 			. $databaze->uprav_na_sql($prijmeni) . ", "
			 			. $databaze->uprav_na_sql($uzivatelID) . ", "
			 			. $databaze->uprav_na_sql($datum_narozeni->format("Y-m-d")) . ", "
			 			. "'" . $pohlavi . "'". ", "
			 			. $databaze->uprav_na_sql($funkce) . ", "
			 			. "'1')";
	
	if(!$databaze->getMysqli()->query($sql)) {
		posledni_strana2("chyba_vlozeni=" . $sql, "mod=2");
	}
	
	$profilID = $databaze->querySingleItem("SELECT LAST_INSERT_ID()");
		
	if(!$profilID) {
		posledni_strana2("chyba_vlozeni=SELECT LAST_INSERT_ID()(2) selhalo", "mod=2");
	}

	$sql = "UPDATE uzivatele SET profilID = " . $databaze->uprav_na_sql($profilID) . "WHERE ID=$uzivatelID";
	
	if($databaze->getMysqli()->query($sql)) { 
		mkdir("../fotky/profily/" . $profilID);
	    //přesměrování
	    posledni_strana2("vlozen=" . $prezdivka, "mod=2");
	}
	else{
    	posledni_strana2("chyba_vlozeni=" . $sql, "mod=2");
	}
}

?>
