<?php

require_once 'funkce.php';

session_start();

/* Skopírování údajů z formuláře do SESSION pro zpětné vyplnění při chybě */
$udaje["nazev"] = $_POST["nazev"];
$udaje["den_zacatku"] = $_POST["den_zacatku"];
$udaje["mesic_zacatku"] = $_POST["mesic_zacatku"];
$udaje["rok_zacatku"] = $_POST["rok_zacatku"];
$udaje["den_konce"] = $_POST["den_konce"];
$udaje["mesic_konce"] = $_POST["mesic_konce"];
$udaje["rok_konce"] = $_POST["rok_konce"];
$udaje["jednodenni"] = $_POST["jednodenni"];
$udaje["vedouci1"] = $_POST["vedouci1"];
$udaje["vedouci2"] = $_POST["vedouci2"];
$udaje["vedouci3"] = $_POST["vedouci3"];
for($i = 1; $i < 10; $i++){
	$udaje["kategorie" . $i] = $_POST[$i];
}
$udaje["special"] = $_POST["special"];
$udaje["text"] = $_POST["text"];

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
	posledni_strana1("chyba_vlozeni_akce=nezadali jste název akce");
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
	posledni_strana1("chyba_vlozeni_akce=zadali jste neexistující datum - " . 
		$_POST["den_zacatku"] . ". " . $_POST["mesic_zacatku"] . ". " .$_POST["rok_zacatku"]);
	exit;
}
$datum_konec = datum($_POST["den_konce"], $_POST["mesic_konce"], $_POST["rok_konce"]);
if($datum_konec == FALSE){
	posledni_strana1("chyba_vlozeni_akce=zadali jste neexistující datum - " . 
		$_POST["den_konce"] . ". " . $_POST["mesic_konce"] . ". " .$_POST["rok_konce"]);
	exit;
}

/*
* otestuje zda byl zadán alespoň jeden vedoucí akce, pokud zadán nebyl, vkládání akce skončí
* a zobrazí se chybová hláška.
*/
$v = 1;
$vedouci = FALSE;
while($v < 4){
	if(isset($_POST["vedouci" . $v]) && trim($_POST["vedouci" . $v]) != ""){
		$vedouci = TRUE;
	}
	$v++;
}

if($vedouci = FALSE){
	posledni_strana1("chyba_vlozeni_akce=nezadali jste žádného vedoucího");
	exit;
}

/*
* otestuje zda bylo zadána alespoň jedna kategorie, pokud zadána nebyla, vkládání akce skončí
* a zobrazí se chybová hláška.
*/

require_once 'php-konstanty/kategorie.php';

$kategorie = "";
$i = 1; $j = 0;
while($i < 9){
	if(isset($_POST[(string)$i]) && $_POST[(string)$i] == "on"){
		if($j > 0){
			$kategorie = $kategorie . ",";
		}
		$kategorie = $kategorie . kategorie($i);
		$j++;
	}
	$i++;
}
if($j == 0){
	posledni_strana1("chyba_vlozeni_akce=nezadali jste žádnou kategorii");
	exit;
}

//test oprávnění pro určení aktivity akce
if($_SESSION["role"] < 2){
	$aktivni = 1;
}
else{
	$aktivni = 0;
}

odstran_lomitka($_POST);

vloz_profil($databaze, $datum_zacatek, $datum_konec, $vedouci, $kategorie, $aktivni);

/*
 * Hlavní funkce pro vkládání akce do databáze
 */
function vloz_profil($databaze, $datum_zacatek, $datum_konec, $vedouci, $kategorie, $aktivni){
	$nazev= $_POST["nazev"];
	$text = $_POST["text"];
  
	$sql = "INSERT INTO akce (nazev, datum_zacatku, datum_konce, kategorie, jiny_vedouci, jina_kategorie, info, aktivni)
			VALUES (" 	. $databaze->uprav_na_sql($nazev) . ", "
			 			. "'" . $datum_zacatek->format("Y-m-d"). "'" . ", "
			 			. "'" . $datum_konec->format("Y-m-d"). "'" . ", "
			 			. "'" . $kategorie . "'" . ", "
			 			. $databaze->uprav_na_sql($_POST["vedouci3"]) . ", "
			 			. $databaze->uprav_na_sql($_POST["special"]) . ", "
			 			. $databaze->uprav_na_sql($text) . ","
						. "'" . $aktivni . "')";
	
	$uspech = $databaze->getMysqli()->query($sql);
	if(!$uspech){
		posledni_strana1("chyba_vlozeni_akce=" . $sql);
	}
	
	if($uspech){
		$sql = "SELECT akceID FROM akce WHERE nazev = " . $databaze->uprav_na_sql($nazev) . " ORDER BY akceID";
		$akceID = $databaze->querySingleItem($sql);
		
		if(!$akceID){
			posledni_strana1("chyba_vlozeni_akce=" . $sql);
		}
		
		if($uspech){
			for($i = 1; $i < 3; $i++){
				if($_POST["vedouci" . $i] && $_POST["vedouci" . $i] != ""){
					$sql = "INSERT INTO vztah_uzivatel_akce (uzivatelID, akceID) VALUES (" .  
							$databaze->uprav_na_sql($_POST["vedouci" . $i])
					 		. ", " . $databaze->uprav_na_sql($akceID) . ")";
					$uspech = $databaze->getMysqli()->query($sql);
					if(!$uspech){
						posledni_strana1("chyba_vlozeni_akce=" . $sql);
					}
				}
			}	
		}
	}
	if($uspech) {    
	    //přesměrování
	    posledni_strana1("vlozena=" . $nazev);
	    exit;
	}
	else{
    	posledni_strana1("chyba_vlozeni_akce=" . $sql);
	}
}

?>
