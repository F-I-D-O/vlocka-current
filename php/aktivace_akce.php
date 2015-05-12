
<?php

require_once 'funkce.php';

session_start();

if($_SESSION["role"] > 1){
	posledni_strana();
}

$databaze = new Databaze();

if(isset($_POST["aktivace"])){
	$sql = "UPDATE akce SET aktivni=" . "'" . $_POST["aktivace"] . "'"
			 . "WHERE akceID = " . $databaze->uprav_na_sql($_POST["id"]);
	if($_POST["aktivace"] > 0){
		if($databaze->getMysqli()->query($sql)){
			posledni_strana2("uspech=akce úspěšně aktivována", "akceID=" . $_POST["id"]);
		}
		else{
			posledni_strana2("chyba=aktivace se nezdařila", "akceID=" . $_POST["id"]);
		}
	}
	else{
		if($databaze->getMysqli()->query($sql)){
			posledni_strana2("uspech=akce úspěšně deaktivována", "akceID=" . $_POST["id"]);
		}
		else{
			posledni_strana2("chyba=deaktivace se nezdařila", "akceID=" . $_POST["id"]);
		}
	}
	
}

	
?>