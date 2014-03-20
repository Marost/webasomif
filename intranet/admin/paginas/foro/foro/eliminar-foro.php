<?php
include ("../../../conexion/conexion.php");

mysqli_query($conexion, "DELETE FROM ap_foro WHERE id=".$_REQUEST["id"].";");
mysqli_query($conexion, "DELETE FROM ap_foro_temas WHERE foro=".$_REQUEST["id"].";");
mysqli_query($conexion, "DELETE FROM ap_foro_comentario WHERE foro=".$_REQUEST["id"].";");
mysqli_query($conexion, "ALTER TABLE ap_foro_permiso_usuario_intranet DROP ".$_REQUEST["nombre"].";", $conexion );

if (mysql_errno()!=0)
{
	echo "ERROR: <strong>". mysql_errno() . "</strong> - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=6");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>