<?php
include ("../../../conexion/conexion.php");

mysqli_query($conexion, "DELETE FROM ap_usuario_intranet WHERE usuario='".$_REQUEST["usuario"]."';");
mysqli_query($conexion, "DELETE FROM ap_privilegio_user_intranet WHERE usuario='".$_REQUEST["usuario"]."';");
mysqli_query($conexion, "DELETE FROM ap_usuario_online WHERE usuario='".$_REQUEST["usuario"]."';");

if (mysql_errno()!=0)
{
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>