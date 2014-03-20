<?php
include("../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$foro=$_POST["foro"];

mysql_query("INSERT INTO ap_foro (foro) VALUES('$foro');",$conexion);
mysql_query("ALTER TABLE ap_foro_permiso_usuario_intranet ADD $foro INT(1);", $conexion);

if (mysql_errno()!=0)
{
	echo "ERROR: <strong>". mysql_errno() . "</strong> - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>