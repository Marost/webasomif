<?php
session_start();
include("../../conexion/conexion.php");

//DECLARACION DE VARIABLES
$persona=$_SESSION["user_nombre"]." ".$_SESSION["user_apellido"];
$email=$_SESSION["user_email"];
$mensaje=$_POST["msj"];
$identificador=$_POST["identificador"];
$respuesta=1;
$email_dest=$_POST["email"];
$fecha=date('Y-m-d');

mysql_query("INSERT INTO ap_consulta_legal (persona, email, mensaje, identificador, respuesta, fecha) VALUES('$persona', '$email', '$mensaje', $identificador, $respuesta, '$fecha');",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$destinatario = $email_dest; 
	$asunto = "Mensaje Consulta Legal - ASOMIF PERU"; 
	$cuerpo = "<html><head><title>Mensaje Consulta Legal - ASOMIF PERU</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		".$persona." ha respondido tu mensaje de Consulta Legal:<br/><br/>
		<strong>Mensaje:</strong>
		$mensaje<br/>
		<p align='center'><img src='http://marostdevelopers.com/asomif/imagenes/logo-asomif.png'></p>
	</body></html>"; 

	//para el envío en formato HTML 
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	
	//dirección del remitente 
	$headers .= 'From: <'.$email.'>' . "\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers);
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>