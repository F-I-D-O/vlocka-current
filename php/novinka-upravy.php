
<?php
require_once 'funkce.php';

session_start();

if(!$_SESSION["role"] || $_SESSION["role"] > 1){
	posledni_strana0();
}

$databaze = new Databaze();

if(isset($_GET["smaz"])){
	$sql = "DELETE FROM novinky WHERE ID=" . $_GET["smaz"];
	
	if($databaze->getMysqli()->query($sql)){
		posledni_strana1("uspech_novinka=novinka úspěšně smazána");
	}
	else{
		posledni_strana1("chyba_novinka=novinku se nepodařilo smazat");
	}
}

if(isset($_GET["deaktivace"])){
	$sql = "UPDATE novinky SET aktivni = 0 WHERE ID = " . $_GET["deaktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana1("uspech_novinka=novinka úspěšně deaktivována");
	}
	else{
		posledni_strana1("chyba_novinka=novinku se nepodařilo deaktivovat");
	}
}

if(isset($_GET["aktivace"])){
	$sql = "UPDATE novinky SET aktivni = 1 WHERE ID = " . $_GET["aktivace"];

	if($databaze->getMysqli()->query($sql)){
		posledni_strana1("uspech_novinka=novinka úspěšně aktivována");
	}
	else{
		posledni_strana1("chyba_novinka=novinku se nepodařilo aktivovat");
	}
}

posledni_strana0();

posledni_strana0();


	
?>