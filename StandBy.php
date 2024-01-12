<?PHP
require "inc/header.php";

if(isset($_SESSION['idgestion']))
 $_SESSION['idgestion']=-1;//Vuelve a gestionar
echo "<hr>Esperando llamada...<hr>";
include "inc/fin_pagina.php";
?>