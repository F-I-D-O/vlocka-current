<?php

function kategorie($cislo_kategorie){
	
	switch($cislo_kategorie){
		case 1:
		case 01:
			$kategorie = "předškoláci";
			break;
		
		case 2:
		case 02:
			$kategorie = "vlčata";
			break;
			
		case 3:
		case 03:
			$kategorie = "světlušky";
			break;
			
		case 4:
		case 04:
			$kategorie = "skauti";
			break;
			
		case 5:
		case 05:
			$kategorie = "skautky";
			break;

		case 6:
		case 06:
			$kategorie = "roveři";
			break;
		
		case 7:
		case 07:
			$kategorie = "rangers";
			break;
			
		case 8:
		case 08:
			$kategorie = "vedení";
			break;
			
		case 9:
		case 09:
			$kategorie = "special";
			break;
	
		default:
			$kategorie = "neznámá kategorie";
			break;		
	}
	return $kategorie;
}

function cislo_kategorie($kategorie){

	switch($kategorie){
		case "předškoláci":
			$kategorie = 1;
			break;

		case "vlčata":
			$kategorie = 2;
			break;
				
		case "světlušky":
			$kategorie = 3;
			break;
				
		case "skauti":
			$kategorie = 4;
			break;
				
		case "skautky":
			$kategorie = 5;
			break;

		case "roveři":
			$kategorie = 6;
			break;

		case "rangers":
			$kategorie = 7;
			break;
				
		case "vedení":
			$kategorie = 8;
			break;
				
		case "special":
			$kategorie = 9;
			break;

		default:
			$kategorie = "neznámá kategorie";
			break;
	}
	return $kategorie;
}

?>