<?php
include ("../../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$foro=$_POST["foro"];

mysql_query("UPDATE ap_foro SET foro='$foro' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>