<?php
include ("../../../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$taller=$_POST["taller"];
$lugar_fecha=$_POST["lugar_fecha"];
$programa=$_POST["programa"];
$publicar=$_POST["publicar"];
$enlace=$_POST["enlace"];
$tipo='Video';

mysql_query("UPDATE ap_estadistica SET taller='$taller', lugar_fecha='$lugar_fecha', programa='$programa', enlace_video='$enlace', publicar=$publicar, tipo='$tipo' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>