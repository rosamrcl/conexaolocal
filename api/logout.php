<?php
include ('/laragon/www/conexaolocal/api/config.php');

session_start();
unset($_SESSION["username"]);
unset($_SESSION["senha"]);
session_destroy();
header("Location:index.php");
exit();

?>