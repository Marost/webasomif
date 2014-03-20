<?php
session_start();
include("../conexion.php");

//USUARIO A ENVIAR CORREO
$user_envio=$_POST["usuario"];
$rst_query1=mysql_query("SELECT * FROM ap_usuario_intranet WHERE usuario='$user_envio'", $conexion);
$fila_query1=mysql_fetch_array($rst_query1);

//USUARIO ACTUAL
$user_actual=$_SESSION["user-asomif"];
$rst_query2=mysql_query("SELECT * FROM ap_usuario_intranet WHERE usuario='$user_actual'", $conexion);
$fila_query2=mysql_fetch_array($rst_query2);

//DECLARACION DE VARIABLES
$asunto_msj=$_POST["asunto"];
$mensaje=$_POST["msj"];
$email_dest=$fila_query1["email"];
$email_user=$fila_query2["email"];

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	
	$destinatario = $email_dest; 
	$asunto = $asunto_msj; 
	$cuerpo = "<html><head><title>$asunto_msj</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		$mensaje
	</body></html>"; 

	//para el envío en formato HTML 
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	
	//dirección del remitente 
	$headers .= 'From: <'.$email_user.'>' . "\r\n";
	mail($destinatario,$asunto,$cuerpo,$headers);
	
	header("Location:../../enviar-correo.php?mensaje=1");
}
?>