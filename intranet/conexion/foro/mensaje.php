<?php
session_start();
include("../conexion.php");

//BUSQUEDA USUARIO
	$usuario=$_SESSION["user-asomif"];
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE usuario='$usuario';");
	$fila_query=mysqli_fetch_array($rst_query);
	
//DECLARACION DE VARIABLES
	$nombre=$fila_query["nombre"];
	$apellido=$fila_query["apellidos"];
	$nombre_completo=$fila_query["nombre_completo"];
	$mensaje=$_POST["comentar-foro"];

mysqli_query($conexion, "INSERT INTO ap_foro_izq (usuario, nombre, apellido, nombre_completo, mensaje, foro) VALUES ('$usuario', '$nombre', '$apellido', '$nombre_completo', '$mensaje', 1) ");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysqli_close($conexion);
	header("Location:../../frame/foro-comment.php");
}
	
?>