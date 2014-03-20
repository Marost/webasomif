<?php
include ("../../../conexion/conexion.php");

$tema=$_REQUEST["tema"];
mysql_query("DELETE FROM ap_foro_comentario WHERE id=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:form-ver.php?id=$tema&mensaje=1");
} else {
	mysql_close($conexion);
	header("Location:form-ver.php?id=$tema&mensaje=2");
}

?>