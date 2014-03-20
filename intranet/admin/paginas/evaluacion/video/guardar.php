<?php
include("../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$taller=$_POST["taller"];
$lugar_fecha=$_POST["lugar_fecha"];
$programa=$_POST["programa"];
$publicar=$_POST["publicar"];
$enlace=$_POST["enlace"];
$tipo='Video';

mysqli_query($conexion, "INSERT INTO ap_evaluacion (taller, lugar_fecha, programa, enlace_video, publicar, tipo) VALUES('$taller', '$lugar_fecha', '$programa', '$enlace', $publicar, '$tipo');");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>