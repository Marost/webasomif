<?php
session_start();
include("conexion.php");

$usuario=$_SESSION["user-asomif"];
$rst_query=mysql_query("SELECT * FROM ap_usuario_online WHERE usuario='$usuario'", $conexion);
$fila_query=mysql_fetch_array($rst_query);

if ($usuario=="")
	header("Location:index.php?nosesion=1");
elseif($fila_query["online"]==0)
	header("Location:index.php?nosesion=1");
?>