<?php
include ("../../../conexion/conexion.php");

mysqli_query($conexion, "DELETE FROM ap_foro_temas WHERE id=".$_REQUEST["id"].";");
mysqli_query($conexion, "DELETE FROM ap_foro_comentario WHERE tema_foro=".$_REQUEST["id"].";");

if (mysql_errno()!=0)
{
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>