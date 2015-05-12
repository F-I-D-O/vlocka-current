<?php
require_once 'funkce.php';

session_start();

if(!$_SESSION["role"] || $_SESSION["role"] > 1){
	posledni_strana0();
}

$databaze = new Databaze();

if(isset($_GET["smaz"])){
	$sql = "DELETE FROM profily WHERE profilID=" . $_GET["smaz"];
	
	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=profil úspěšně smazán", "profilID=" . $_GET["smaz"]);
	}
	else{
		posledni_strana2("chyba=profil se nepodařilo smazat", "profilID=" . $_GET["smaz"]);
	}
}

if(isset($_GET["deaktivace"])){
	$sql = "UPDATE profily SET aktivni = 0 WHERE profilID = " . $_GET["deaktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=profil úspěšně deaktivován", "profilID=" . $_GET["deaktivace"]);
	}
	else{
		posledni_strana2("chyba=profil se nepodařilo deaktivovat", "profilID=" . $_GET["deaktivace"]);
	}
}

if(isset($_GET["aktivace"])){
	$sql = "UPDATE profily SET aktivni = 1 WHERE profilID = " . $_GET["aktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=profil úspěšně aktivován", "profilID=" . $_GET["aktivace"]);
	}
	else{
		posledni_strana2("chyba=profil se nepodařilo aktivovat", "profilID=" . $_GET["aktivace"]);
	}
}

posledni_strana0();
	
?>