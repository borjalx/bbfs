<?php
session_start();
//unset($_SESSION["nome"]);
session_unset();// where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: home.php");
?>

