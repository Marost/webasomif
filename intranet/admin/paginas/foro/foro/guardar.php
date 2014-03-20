<?php
include("../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$foro=$_POST["foro"];

mysqli_query($conexion, "INSERT INTO ap_foro (foro) VALUES('$foro');");
mysqli_query($conexion, "ALTER TABLE ap_foro_permiso_usuario_intranet ADD $foro INT(1);");

if (mysql_errno()!=0)
{
	echo "ERROR: <strong>". mysql_errno() . "</strong> - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>