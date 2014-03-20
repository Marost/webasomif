<?php
include ("../../../conexion/conexion.php");

mysql_query("DELETE FROM ap_usuario_intranet WHERE usuario='".$_REQUEST["usuario"]."';",$conexion);
mysql_query("DELETE FROM ap_privilegio_user_intranet WHERE usuario='".$_REQUEST["usuario"]."';",$conexion);
mysql_query("DELETE FROM ap_usuario_online WHERE usuario='".$_REQUEST["usuario"]."';",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>