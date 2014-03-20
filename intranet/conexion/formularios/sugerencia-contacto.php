<?php
include("../conexion.php");

//DECLARACION DE VARIABLES
	$empresa=$_POST["empresa"];
	$cargo=$_POST["cargo"];
	$persona=$_POST["persona"];
	$email=$_POST["email"];
	$movil=$_POST["movil"];
	$mensaje=$_POST["msj"];

mysql_query("INSERT INTO ap_sugerencia_contacto (empresa, cargo, persona, email, movil, mensaje) VALUES ('$empresa', '$cargo', '$persona', '$email', '$movil', '$mensaje') ",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$destinatario = "sugerencias@asomifperu.com"; 
	$asunto = "Mensaje Sugerencia y Contacto - ASOMIF PERU"; 
	$cuerpo = "<html><head><title>Mensaje Sugerencia y Contacto - ASOMIF PERU</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		".$persona." ha enviado un mensaje de Sugerencia y Contacto:<br/><br/>
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
	$headers .= 'From: <'.$destinatario.'>' . "\r\n";
	
	//ruta del mensaje desde origen a destino 
	//$headers .= "Return-path: webmaster@asomifperu.com\r\n"; 
	
	//direcciones que recibián copia 
	//$headers .= "Cc: maria@desarrolloweb.com\r\n"; 
	
	//direcciones que recibirán copia oculta 
	//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
	
	mail($destinatario,$asunto,$cuerpo,$headers);
		
	mysql_close($conexion);
	header("Location:../../sugerencia-contacto.php");
}
?>