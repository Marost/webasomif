<?php
include ("../../../conexion/conexion.php");

$user=$_REQUEST["usuario"];

mysql_query("UPDATE ap_usuario_online SET online=0 WHERE usuario='$user'", $conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php");
} else {
	mysql_close($conexion);
	header("Location:listar.php");
}

?>