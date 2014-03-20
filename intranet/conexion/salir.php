<?php
session_start();
include("conexion.php");
include("funciones.php");

//SESIONES DE HORA Y MINUTO
$horaIni=$_SESSION["hora"];
$minutoIni=$_SESSION["minuto"];

//FECHA Y HORA DE SALIDA
$fecha=date('Y-m-d');
$horaFinTotal=date("H:i");


//INSERTA REGISTRO DE SALIDA
mysql_query("UPDATE ap_usuario_intranet_time SET f_salida='$fecha' ,salida='$horaFinTotal' WHERE identificador='".$_SESSION["identificador"]."'", $conexion);

mysql_query("UPDATE ap_usuario_online SET online=0 WHERE usuario='".$_SESSION["user-asomif"]."'", $conexion);

session_destroy();

header("Location:../index.php?nosesion=3");
?>