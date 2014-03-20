<?php
include ("../../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$foro=$_POST["foro"];

mysqli_query($conexion, "UPDATE ap_foro SET foro='$foro' WHERE id=". $_REQUEST["id"].";");
	
if (mysql_errno()!=0)
{
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=5");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>