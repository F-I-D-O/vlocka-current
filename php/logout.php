
<?php

require_once "funkce.php";

session_start();

unset($_SESSION['ID']);
unset($_SESSION['login']);
unset($_SESSION['role']);
unset($_SESSION['profilID']);

posledni_strana0();

?>
