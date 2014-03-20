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

mysql_query("INSERT INTO ap_foro_temas (tema_foro, fecha, hora, usuario, foro) VALUES ('$tema', '$fecha', '$hora', '$usuario', $foro) ",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$rst_query=mysql_query("SELECT * FROM ap_foro_temas ORDER BY id DESC LIMIT 1;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
	$tema_foro=$fila_query["id"];
	mysql_close($conexion);
	header("Location:../../debate-foro.php?tema=$tema_foro&foro=$foro");
}
	
?>