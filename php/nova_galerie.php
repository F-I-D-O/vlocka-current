<?php

require_once 'funkce.php';

session_start();

/* Skopírování údajů z formuláře do SESSION pro zpětné vyplnění při chybě */
$udaje["nazev"] = $_POST["nazev"];
$udaje["odkaz"] = $_POST["odkaz"];
$udaje["den_zacatku"] = $_POST["den_zacatku"];
$udaje["mesic_zacatku"] = $_POST["mesic_zacatku"];
$udaje["rok_zacatku"] = $_POST["rok_zacatku"];
$udaje["den_konce"] = $_POST["den_konce"];
$udaje["mesic_konce"] = $_POST["mesic_konce"];
$udaje["rok_konce"] = $_POST["rok_konce"];
$udaje["rok_konce"] = $_POST["rok_konce"];
$udaje["jednodenni"] = $_POST["jednodenni"];
for($i = 1; $i < 6; $i++){
	$udaje["autor" . $i] = $_POST["autor" . $i];
}
$udaje["dalsi_autori"] = $_POST["dalsi_autori"];
$udaje["vlozit_do_novinek"] = $_POST["vlozit_do_novinek"];


$_SESSION["udaje"] = $udaje;

/*
 * Připojení k databázi MySQL - v případě neúspěchu se objeví
* chybové hlášení a činnost aplikace se ukončí
*/
$databaze = new databaze();


/*
* otestuje zda byl zadán název akce, pokud zadán nebyl, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["nazev"] || trim($_POST["nazev"]) == ""){
	posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=nezadali jste název galerie");
	exit;
}

/*
* otestuje zda byl zadán odkaz na akci, pokud zadán nebyl, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
if(!$_POST["odkaz"] || trim($_POST["odkaz"]) == ""){
	posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=nezadali jste odkaz na galerii");
	exit;
}

//zkopíruje datum začátku do datumu konce akce pokud se jedná o jednodenní akci
if(isset($_POST["jednodenni"]) && $_POST["jednodenni"] == "on"){
	$_POST["mesic_konce"] = $_POST["mesic_zacatku"];
	$_POST["den_konce"] = $_POST["den_zacatku"];
	$_POST["rok_konce"] = $_POST["rok_zacatku"];
}

/*
* Spojí datum dohromady. Pokud nějaké zadané datum neexistuje, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
$datum_zacatek = datum($_POST["den_zacatku"], $_POST["mesic_zacatku"], $_POST["rok_zacatku"]);
if($datum_zacatek == FALSE){
	posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=zadali jste neexistující datum - " . 
		$_POST["den_zacatku"] . ". " . $_POST["mesic_zacatku"] . ". " .$_POST["rok_zacatku"]);
	exit;
}
$datum_konec = datum($_POST["den_konce"], $_POST["mesic_konce"], $_POST["rok_konce"]);
if($datum_konec == FALSE){
	posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=zadali jste neexistující datum - " . 
		$_POST["den_konce"] . ". " . $_POST["mesic_konce"] . ". " .$_POST["rok_konce"]);
	exit;
}

/*
* otestuje zda byl zadán alespoň jeden autor, pokud zadán nebyl, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
$v = 1; 
$autor = FALSE;
while($v < 6){
	if(isset($_POST["autor" . $v]) && trim($_POST["autor" . $v]) != 0){
		$autor = TRUE;
		break;
	}
	$v++;
}

if($autor == FALSE && (!isset($_POST["dalsi_autori"]) || trim($_POST["dalsi_autori"] == ""))){
	posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=nezadali jste žádného autora");
	exit;
}

odstran_lomitka($_POST);

vloz_galerii($databaze, $datum_zacatek, $datum_konec);

/*
 * Hlavní funkce pro vkládání profilu do databáze
 */
function vloz_galerii($databaze, $datum_zacatek, $datum_konec){
	$nazev= $_POST["nazev"];
	$odkaz = $_POST["odkaz"];
	$aktivni = $_POST["aktivni"];
	$autori = $_POST["dalsi_autori"];
  	
	$sql = "INSERT INTO fotokronika (nazev, odkaz, datum_zacatku, datum_konce, autori, aktivni)
			VALUES (" 	. $databaze->uprav_na_sql($nazev) . ", "
						. $databaze->uprav_na_sql($odkaz) . ", "
			 			. "'" . $datum_zacatek->format("Y-m-d"). "'" . ", "
			 			. "'" . $datum_konec->format("Y-m-d"). "'" . ", "
			 			. $databaze->uprav_na_sql($autori) . ", "
						. "'" . $aktivni . "')";
	
	$uspech = $databaze->getMysqli()->query($sql);
	if(!$uspech){
		posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=" . $sql);
	}
	else{
		$sql = "SELECT ID FROM fotokronika WHERE nazev = " . $databaze->uprav_na_sql($nazev) . " ORDER BY akceID DESC LIMIT 1";
		$galerieID = $databaze->querySingleItem($sql);
		
		if(!$galerieID){
			posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=" . $sql);
		}
		else{
			for($i = 1; $i < 6; $i++){
				if(isset($_POST["autor" . $i]) && trim($_POST["autor" . $i]) != "0"){
					$sql = "INSERT INTO vztah_profil_galerie (profilID, galerieID) VALUES (" .  
							$databaze->uprav_na_sql($_POST["autor" . $i])
					 		. ", " . $databaze->uprav_na_sql($galerieID) . ")";
					$uspech = $databaze->getMysqli()->query($sql);
					if(!$uspech){
						posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=" . $sql);
					}
				}
			}
			if($_POST["vlozit_do_novinek"] == "on"){
				$nadpis = "Fotky";
				$text = '<a target="_blank" href="' . $odkaz . '">Fotky z akce ' . $nazev . '</a>';
				$datum = new DateTime();
				$sql = "INSERT INTO novinky (nadpis, datum, text, aktivni)
						VALUES (" 	. $databaze->uprav_na_sql($nadpis) . ", "
						. "'" . $datum->format("Y-m-d H:i:00"). "'" . ", "
			 			. $databaze->uprav_na_sql($text) . ", "
						. "'" . $aktivni . "')";
				$uspech = $databaze->getMysqli()->query($sql);
				if(!$uspech){
					posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "chyba=" . $sql);
				}
			}
			//přesměrování
			posledni_strana2("rok=" . $_POST["rok"] . "&vlozit=1", "uspech=galerie " . $nazev . " byla úspěšně vložena");
			exit;
		}
	}
}

?>
