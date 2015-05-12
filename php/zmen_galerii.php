<?php
require_once 'funkce.php';

session_start();

if(!opravneni(1)){
	posledni_strana0();
}

$databaze = new Databaze();

if(isset($_GET["smaz"])){
	$sql = "DELETE FROM fotokronika WHERE ID=" . $_GET["smaz"];
	
	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=galerie úspěšně smazána",  "rok=" . $_GET["rok"]);
	}
	else{
		posledni_strana2("chyba=galerii se nepodařilo smazat",  "rok=" . $_GET["rok"]);
	}
}

if(isset($_GET["deaktivace"])){
	$sql = "UPDATE fotokronika SET aktivni = 0 WHERE ID = " . $_GET["deaktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=galerie úspěšně deaktivována", "rok=" . $_GET["rok"]);
	}
	else{
		posledni_strana2("chyba=galerii se nepodařilo deaktivovat",  "rok=" . $_GET["rok"]);
	}
}

if(isset($_GET["aktivace"])){
	$sql = "UPDATE fotokronika SET aktivni = 1 WHERE ID = " . $_GET["aktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana2("uspech=galerie úspěšně aktivována",  "rok=" . $_GET["rok"]);
	}
	else{
		posledni_strana2("chyba=galerii se nepodařilo aktivovat",  "rok=" . $_GET["rok"]);
	}
}

posledni_strana0();
	
?>