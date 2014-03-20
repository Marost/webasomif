<?php
include("conexion.php");
include("funciones.php");

$user=$_POST["user"];
$clave=$_POST["pass"];

$rst=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE usuario='$user' AND clave='$clave';");
$num_registros=mysqli_num_rows($rst);

if($num_registros>0)
{
	$fila=mysqli_fetch_array($rst);
	session_start();
	$_SESSION["user-asomif"]=$fila["usuario"];
	$_SESSION["user_nombre-asomif"]=$fila["nombre"];
	$_SESSION["user_apellido-asomif"]=$fila["apellidos"];
	$_SESSION["user-hora"]=time();
	//FECHA Y HORA DE ENTRADA
	$fecha=date('Y-m-d');
	$hora=date("H");
	$minuto=date("i");
	$horaIniTotal=date("H:i")."<br/>";
	//IDENTIFICADOR ALEATORIO
	$identificador=RandomString(15,TRUE,TRUE,FALSE);
	//VARIABLES DE SESION
	$_SESSION["entrada"]=$horaIniTotal;
	$_SESSION["identificador"]=$identificador;
	$_SESSION["hora"]=$hora;
	$_SESSION["minuto"]=$minuto;
	//INSERTAR REGISTRO DE ENTRADA
	mysqli_query($conexion, "INSERT INTO ap_usuario_intranet_time (identificador, usuario, f_entrada,entrada) VALUES ('$identificador', '".$_SESSION["user-asomif"]."', '$fecha','$horaIniTotal')");
	mysqli_query($conexion, "UPDATE ap_usuario_online SET online=1 WHERE usuario='".$_SESSION["user-asomif"]."'");
	header("Location:../principal.php");
} else {
	mysqli_close($conexion);
	header("Location:../index.php?nosesion=2");
}

?>