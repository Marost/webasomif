<?php
include("conexion.php");

$user=$_POST["user"];
$clave=$_POST["pass"];
$rst=mysql_query("SELECT * FROM ap_usuario WHERE usuario='$user' AND clave='$clave';", $conexion);
$num_registros=mysql_num_rows($rst);


if($num_registros>0)
{
	$fila=mysql_fetch_array($rst);
	session_start();
	$_SESSION["user"]=$fila["usuario"];
	$_SESSION["user_nombre"]=$fila["nombre"];
	$_SESSION["user_apellido"]=$fila["apellidos"];
	$_SESSION["user_email"]=$fila["email"];
	header("Location:../principal.php");
} else {
	mysql_close($conexion);
	header("Location:../index.php?nosesion=2");
}


/*$user="asumif";
$pass="admin@123";*/

/*if($user=="asumif" and $pass=="admin@123"){
	session_start();
	$_SESSION["user"]=$user;
	header("Location:../principal.php");
} else {
	header("Location:../index.php?nosesion=2");
}*/

?>