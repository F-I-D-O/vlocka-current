<?php

require_once 'funkce.php';

session_start();

if(!$_SESSION["role"] || $_SESSION["role"] > 2){
	posledni_strana0();
}

/*
* otestuje zda byl zadán text důleřité zprávy, pokud zadán nebyl, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["text"] || trim($_POST["text"]) == ""){
	posledni_strana2("chyba_dulezite=nezadali jste žádnou zprávu", "dulezite=1");
	exit;
}

/*
 * Připojení k databázi MySQL - v případě neúspěchu se objeví 
 * chybové hlášení a činnost aplikace se ukončí
 */
$databaze = new databaze(); 

odstran_lomitka($_POST);

vloz_dulezite($_POST, $databaze);

function vloz_dulezite($formdata, $databaze){
	$text = $_POST["text"];
	$aktivni = $_POST["aktivni"];
	
  
	$sql = "INSERT INTO dulezite (zprava, aktivni)
			VALUES (" . $databaze->uprav_na_sql($text) . ", "
			 . $databaze->uprav_na_sql($aktivni) . ")";

	//odeslání dat do databáze
	if($databaze->getMysqli()->query($sql)) {    
	    //přesměrování
	    posledni_strana1("uspech_dulezite=zpráva úspěšně vložena");
	    exit;
	}
	else{
    	posledni_strana2("chyba_dulezite=Data se nepodařilo uložit do databáze", "dulezite=1");
	}
}

?>
