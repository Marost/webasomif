<?php
include ("../../../conexion/conexion.php");

mysqli_query($conexion, "DELETE FROM ap_usuario WHERE usuario='".$_REQUEST["usuario"]."';");

if (mysql_errno()!=0)
{
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>