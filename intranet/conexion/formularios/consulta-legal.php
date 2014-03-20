<?php
session_start();
include("../conexion.php");

//DECLARACION DE VARIABLES
	$usuario=$_SESSION["user-asomif"];
	$empresa=$_POST["empresa"];
	$cargo=$_POST["cargo"];
	$persona=$_POST["persona"];
	$email=$_POST["email"];
	$movil=$_POST["movil"];
	$mensaje=$_POST["msj"];
	$fecha=date('Y-m-d');

mysqli_query($conexion, "INSERT INTO ap_consulta_legal (empresa, cargo, persona, email, movil, mensaje, fecha) VALUES ('$empresa', '$cargo', '$persona', '$email', '$movil', '$mensaje', '$fecha') ");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$destinatario = "benites@benitesabogados.com.pe"; 
	$asunto = "Mensaje Consulta Legal - ASOMIF PERU"; 
	$cuerpo = "<html><head><title>Mensaje Consulta Legal - ASOMIF PERU</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		".$persona." ha enviado un mensaje de Consulta Legal:<br/><br/>
		<strong>DATOS DE CONTACTO</strong><br/><br/>
		<strong>Empresa:</strong> $empresa<br/>
		<strong>Cargo:</strong> $cargo<br/>
		<strong>Persona:</strong> $persona<br/>
		<strong>Email:</strong> $email<br/>
		<strong>Movil:</strong> $movil<br/>
		<strong>Mensaje:</strong>
		$mensaje<br/>
		<p align='center'><img src='http://marostdevelopers.com/asomif/imagenes/logo-asomif.png'></p>
	</body></html>"; 

	//para el envío en formato HTML 
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	
	//dirección del remitente 
	$headers .= 'From: <webmaster@asomifperu.com>' . "\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers);
		
	mysqli_close($conexion);
	header("Location:../../consulta-legal.php");
}
?>