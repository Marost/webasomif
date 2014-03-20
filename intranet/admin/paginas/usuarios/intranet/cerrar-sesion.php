<?php
include ("../../../conexion/conexion.php");

$user=$_REQUEST["usuario"];

mysqli_query($conexion, "UPDATE ap_usuario_online SET online=0 WHERE usuario='$user'");

if (mysql_errno()!=0)
{
	mysqli_close($conexion);
	header("Location:listar.php");
} else {
	mysqli_close($conexion);
	header("Location:listar.php");
}

?>