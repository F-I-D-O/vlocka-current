<?php

function odkaz_na_zmenu($parametr_ke_zmene, $text_odkazu){
	echo('<a href="javascript: prohodViditelnost(\'zmen_' . $parametr_ke_zmene . '-odkaz\', \'zmen_' . $parametr_ke_zmene . 
			'-formular\', \'block\')" id="zmen_' . $parametr_ke_zmene . '-odkaz" class="zmena-odkaz">' .
			$text_odkazu . '</a>');
}

function odkaz_zpet($parametr_ke_zmene){
	echo('<a href="javascript: prohodViditelnost(\'zmen_' . $parametr_ke_zmene . '-formular\', \'zmen_' . $parametr_ke_zmene . 
			'-odkaz\', \'inline\')" class="zmena-odkaz">zpět</a>');
}								
?>
