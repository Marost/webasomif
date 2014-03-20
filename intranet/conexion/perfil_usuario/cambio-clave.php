<?php
session_start();
include("../conexion.php");

$user=$_SESSION["user-asomif"];
$clave=$_POST["clave1"];

mysql_query("UPDATE ap_usuario_intranet SET  clave='$clave' WHERE usuario='$user' ", $conexion);

if (mysql_errno()!=0)
{
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	header("Location:../../perfil-usuario.php?mensaje=1");
} else {
	mysql_close($conexion);
	header("Location:../../perfil-usuario.php?mensaje=2");
}

?>