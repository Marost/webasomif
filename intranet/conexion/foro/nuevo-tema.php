<?php
session_start();
include("../conexion.php");

//DECLARACION DE VARIABLES
	$foro=$_REQUEST["foro"];
 	$hora2=time(); 
	$hora=date("H:i",$hora2); 
	$fecha=date('Y-m-d');
	$tema=$_POST["tema-foro"];
	$usuario=$_SESSION["user-asomif"];

mysqli_query($conexion, "INSERT INTO ap_foro_temas (tema_foro, fecha, hora, usuario, foro) VALUES ('$tema', '$fecha', '$hora', '$usuario', $foro) ");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro_temas ORDER BY id DESC LIMIT 1;");
	$fila_query=mysqli_fetch_array($rst_query);
	$tema_foro=$fila_query["id"];
	mysqli_close($conexion);
	header("Location:../../debate-foro.php?tema=$tema_foro&foro=$foro");
}
	
?>