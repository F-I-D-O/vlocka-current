<?php  
	if(is_array($data)){
		array_map('odstran_odsazeni', $data);
	}
	else{
		$data = strtr($data, $nahradit);
	}
	return $data;
}