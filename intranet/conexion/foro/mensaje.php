<?php
session_start();
include("../conexion.php");

//BUSQUEDA USUARIO
	$usuario=$_SESSION["user-asomif"];
	$rst_query=mysql_query("SELECT * FROM ap_usuario_intranet WHERE usuario='$usuario';", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
	
//DECLARACION DE VARIABLES
	$nombre=$fila_query["nombre"];
	$apellido=$fila_query["apellidos"];
	$nombre_completo=$fila_query["nombre_completo"];
	$mensaje=$_POST["comentar-foro"];

mysql_query("INSERT INTO ap_foro_izq (usuario, nombre, apellido, nombre_completo, mensaje, foro) VALUES ('$usuario', '$nombre', '$apellido', '$nombre_completo', '$mensaje', 1) ",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:../../frame/foro-comment.php");
}
	
?>