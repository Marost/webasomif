<?php
include("conexion.php");

$user=$_POST["user"];
$clave=$_POST["pass"];
$rst=mysqli_query($conexion, "SELECT * FROM ap_usuario WHERE usuario='$user' AND clave='$clave';");
$num_registros=mysqli_num_rows($rst);


if($num_registros>0)
{
	$fila=mysqli_fetch_array($rst);
	session_start();
	$_SESSION["user"]=$fila["usuario"];
	$_SESSION["user_nombre"]=$fila["nombre"];
	$_SESSION["user_apellido"]=$fila["apellidos"];
	$_SESSION["user_email"]=$fila["email"];
	header("Location:../principal.php");
} else {
	mysqli_close($conexion);
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