<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');

    require_once 'funkce.php';
    $databaze = new databaze(); 
    
    $cilova_slozka = "../dokumenty/";
    $cilovy_dokument = $cilova_slozka . basename($_FILES["soubor"]["name"]);
    $nahravani_se_zdarilo = 1;
    $typ_souboru = pathinfo($cilovy_dokument, PATHINFO_EXTENSION);
    
    
    if($nahravani_se_zdarilo == 0){
        echo 'Soubor nebyl nahrán.';
    }  
    else {
        if(move_uploaded_file($_FILES["soubor"]["tmp_name"], $cilovy_dokument)){
            echo 'Soubor ' . basename($_FILES["soubor"]["name"]) . ' byl nahrán.';
        }
        else {
            echo 'Při nahrávání se něco pokazilo.';
        }
    }
    
    
    $nazev = basename($_FILES["soubor"]["name"]);
    $titulek = $_POST['titulek'];
    $datum = date("Y-m-d H:i:s");
    $autor = $_SESSION['ID'];
    
    echo '<br>' . $titulek;
    echo '<br>' . $cilova_slozka;
    echo '<br>' . $cilovy_dokument;
    echo '<br>' . basename($_FILES["soubor"]["name"]);
    
    $sql = "INSERT INTO dokumenty (nazev, titulek, autor, datum, aktivni)
            VALUES('$nazev', '$titulek', '$autor', '$datum', 1)";
    
    if ($databaze->getMysqli()->query($sql)){    
	    //přesměrování
	    header('location: ../dokumenty.php');
	    
    }
  
    