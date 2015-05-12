<?php

function mesic($cislo_mesice){
	
	switch($cislo_mesice){
		case 1:
		case 01:
			$mesic = "leden";
			break;
			
		case 2:
		case 02:
			$mesic = "únor";
			break;
			
		case 3:
		case 03:
			$mesic = "březen";
			break;
			
		case 4:
		case 04:
			$mesic = "duben";
			break;

		case 5:
		case 05:
			$mesic = "květen";
			break;
		
		case 6:
		case 06:
			$mesic = "červen";
			break;
			
		case 7:
		case 07:
			$mesic = "červenec";
			break;
			
		case 8:
		case 08:
			$mesic = "srpen";
			break;
			
		case 9:
		case 09:
			$mesic = "září";
			break;
			
		case 10:
			$mesic = "říjen";
			break;
			
		case 11:
			$mesic = "listopad";
			break;
			
		case 12:
			$mesic = "prosinec";
			break;
			
		default:
			$mesic = "nenalezinec";
			break;		
	}
	return $mesic;
}

?>