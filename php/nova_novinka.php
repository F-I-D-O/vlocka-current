<?php

require_once 'funkce.php';

session_start();

if(!isset($_SESSION["role"]) || $_SESSION["role"] > 2){
	posledni_strana0();
}

/*
* otestuje zda byl zadán nadpis novinky, pokud zadán nebyl, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["nadpis"] || trim($_POST["nadpis"]) == ""){
	posledni_strana1("chyba_novinka=nezadali jste nadpis");
	exit;
}

/*
* otestuje zda byl zadán text novinky, pokud zadán nebyl, vkládání skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["text"] || trim($_POST["text"]) == ""){
	posledni_strana1("chyba_novinka=nezadali jste žádný text");
	exit;
}

/*
 * Připojení k databázi MySQL - v případě neúspěchu se objeví 
 * chybové hlášení a činnost aplikace se ukončí
 */
$databaze = new databaze(); 

odstran_lomitka($_POST);

vloz_novinku($_POST, $databaze);

// pokus o přihláąení; pokud je to moľné, provede se přesun přímo na soubor newpoll.php
function vloz_novinku($formdata, $databaze){
	$nadpis = $_POST["nadpis"];
	$datum = new DateTime();
	$text = $_POST["text"];
	$aktivni = $_POST["aktivni"];
	
  
	$sql = "INSERT INTO novinky (nadpis, datum, text, aktivni)
			VALUES (" . $databaze->uprav_na_sql($nadpis) . ", "
			 . "'" . $datum->format("Y-m-d H:i:00") . "'" . ", "
			 . $databaze->uprav_na_sql($text) . ", "
			 . "'" . $aktivni . "')";

	//odeslání dat do databáze
	if($databaze->getMysqli()->query($sql)) {    
	    //přesměrování
	   posledni_strana1("uspech_novinka=novinka " . $nadpis . " byla úspěšně vložena do databáze");
	    exit;
	}
	else{
    	posledni_strana1("chyba_novinka=Data se nepodařilo uložit do databáze " . $sql);
	}
}

?>
