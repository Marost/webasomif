<?php
include ("../../../conexion/conexion.php");

mysql_query("DELETE FROM ap_foro_temas WHERE id=".$_REQUEST["id"].";",$conexion);
mysql_query("DELETE FROM ap_foro_comentario WHERE tema_foro=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>