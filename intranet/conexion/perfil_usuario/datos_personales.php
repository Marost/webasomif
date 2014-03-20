<?php
session_start();
include("../conexion.php");

$user=$_SESSION["user-asomif"];
$nombre=$_POST["pu-nombre"];
$apellidos=$_POST["pu-apellidos"];
$email=$_POST["pu-email"];

mysqli_query($conexion, "UPDATE ap_usuario_intranet SET  nombre='$nombre', apellidos='$apellidos', email='$email' WHERE usuario='$user' ");

if (mysql_errno()!=0)
{
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	header("Location:../../perfil-usuario.php?mensaje=1");
} else {
	mysqli_close($conexion);
	header("Location:../../perfil-usuario.php?mensaje=2");
}

?>