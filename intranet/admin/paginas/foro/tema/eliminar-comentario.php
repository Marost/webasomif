<?php
include ("../../../conexion/conexion.php");

$tema=$_REQUEST["tema"];
mysqli_query($conexion, "DELETE FROM ap_foro_comentario WHERE id=".$_REQUEST["id"].";");

if (mysql_errno()!=0)
{
	mysqli_close($conexion);
	header("Location:form-ver.php?id=$tema&mensaje=1");
} else {
	mysqli_close($conexion);
	header("Location:form-ver.php?id=$tema&mensaje=2");
}

?>