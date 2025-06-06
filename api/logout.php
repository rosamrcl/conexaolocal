<?php
require_once ('/laragon/www/conexaolocal/api/config.php');

session_start();
unset($_SESSION["username"]);
unset($_SESSION["senha"]);
session_destroy();
header("Location:login.php");
exit();

?>