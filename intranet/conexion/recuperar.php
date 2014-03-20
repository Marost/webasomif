<?php
include("conexion.php");
$email=$_POST["email"];

$rst_query=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE email='$email'");
$fila_query=mysqli_fetch_array($rst_query);

if($fila_query["email"]==$email){
	$destinatario = $fila_query["email"];
	$asunto = "Recuperacion de Contraseña - ASOMIF PERU"; 
	$cuerpo = "<html><head><title>Recuperacion de Contraseña - ASOMIF PERU</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		Recuperacion de Contraseña:<br/><br/>
		<strong>Usuario:</strong> ".$fila_query["usuario"]."<br/>
		<strong>Contraseña:</strong> ".$fila_query["clave"]."<br/>
		<p align='center'><img src='http://intranet.asomifperu.com/imagenes/logo-asomif.png'></p><br/>
		No responder este mensaje.		
	</body></html>"; 

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	$headers .= 'From: <recuperacion@asomifperu.com.pe>' . "\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers);
	mysqli_close($conexion);
	header("Location:../index.php");
}elseif($fila_query["email"]!=$email){
	header("Location:../recuperar.php?nosesion=1");
}
?>