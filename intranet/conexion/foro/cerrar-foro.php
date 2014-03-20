<?php
session_start();
include("../conexion.php");

//DECLARACION DE VARIABLES
	$tema=$_REQUEST["tema"];
	$foro=$_REQUEST["foro"];

mysql_query("UPDATE ap_foro_temas SET cerrado=1 WHERE id=$tema ",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:../../debate-foro.php?tema=$tema&foro=$foro");
}
	
?>