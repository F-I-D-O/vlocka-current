<?php

require_once 'funkce.php';

/*
* otestuje zda bylo zadáno uživatelské jméno, pokud zadáno nebylo, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["novy_login"] || trim($_POST["novy_login"]) == ""){
	posledni_strana1("chyba_vlozeni=nezadali jste uživatelské jméno");
	exit;
}

/*
* otestuje zda bylo zadáno heslo, pokud zadáno nebylo, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["nove_heslo"] || trim($_POST["nove_heslo"]) == ""){
	posledni_strana1("chyba_vlozeni=nezadali jste heslo");
	exit;
}

/*
* otestuje zda bylo zadáno heslo i podruhé, a zdali se shoduje s prvním zadáním.
 * Pokud heslo zadáno nebylo nebo se hesla neshodují, vkládání skončí a zobrazí se chybová hláška.
*/
if(!$_POST["nove_heslo2"] || trim($_POST["nove_heslo2"]) == "" || $_POST["nove_heslo2"] != $_POST["nove_heslo"]){
	posledni_strana1("chyba_vlozeni=hesla se neshodují");
	exit;
}

/*
 * Připojení k databázi MySQL - v případě neúspěchu se objeví 
 * chybové hlášení a činnost aplikace se ukončí
 */
$databaze = new databaze(); 

odstran_lomitka($_POST);

vloz_uzivatele($_POST, $databaze);

// pokus o přihláąení; pokud je to moľné, provede se přesun přímo na soubor newpoll.php
function vloz_uzivatele($formdata, $databaze){
	$login = $_POST["novy_login"];
	$heslo = $_POST["nove_heslo"];
	$role = $_POST["nova_role"];
	$aktivni = $_POST["aktivni"];
	
  
	$sql = "INSERT INTO uzivatele (nick, heslo, role, aktivni)
			VALUES (" . $databaze->uprav_na_sql($login) . ", UNHEX(SHA("
			 . $databaze->uprav_na_sql($heslo . $login) . ")), "
			 . $databaze->uprav_na_sql($role) . ", "
			 . $databaze->uprav_na_sql($aktivni) . ")";

	//odeslání dat do databáze
	if($databaze->getMysqli()->query($sql)) {    
	    //přesměrování
	    header("Location: ../vlozit_uzivatele.php?vlozen=$login");
	    exit;
	}
	else{
    	posledni_strana1("chyba_vlozeni=uživatele se nepodařilo vložit do databáze");
	}
}

?>
