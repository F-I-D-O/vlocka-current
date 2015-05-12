<?php
require '../php/funkce.php';

session_start();

$databaze = new Databaze();

if(opravneni(2)){	
	$sql = "UPDATE akce SET info=" . $databaze->uprav_na_sql($_POST["nove_info"])
	. " WHERE akceID = " . $databaze->uprav_na_sql($_POST["id"]);
	if($databaze->getMysqli()->query($sql)){
		$odpoved = array("status"=>"uspech", "text"=>"Podrobné informace o akci byly úspěšně změněny", "data"=> 
				$_POST['nove_info']);
		echo(json_encode($odpoved)); 
	}
	else{
		echo('{"status" : "chyba", "text" : "chyba=Podrobné informace se nepodařilo změnit' . $sql . '", 
				"data" : "' . $_POST["nove_info"] . '"}'); 
	}	
}
?>
