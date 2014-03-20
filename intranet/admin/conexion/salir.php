<?php
session_start();
//unset($_SESSION["user"]);//destruye variable por variable/
session_destroy();//destruya todas las variables de sesion
//setcookie("usuario_nombre","",-36000);//borrar las cookies con tiempo
$url_base = $_SERVER['SERVER_NAME'];
header("Location:../index.php?nosesion=3");
//echo "http://".$url_base."/admin/index.php?nosesion=3";
?>