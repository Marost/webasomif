<?php 
$segundos = 3600; //si pasa este tiempo se detecta la inactividad del usuario en el sitio 

if(($_SESSION["user-hora"]+$segundos) < time())
{ 
	include("conexion.php");
	mysqli_query($conexion, "UPDATE ap_usuario_online SET online=0 WHERE usuario='".$_SESSION["user-asomif"]."'");
	session_destroy();
	header("Location:../index.php?nosesion=4");
}else 
   $_SESSION["user-hora"]=time(); 
?>