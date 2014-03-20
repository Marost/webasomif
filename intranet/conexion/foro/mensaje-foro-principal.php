<?php
session_start();
include("../conexion.php");

//USUARIO CREADOR
$user_creador=$_POST["user-creador"];
$rst_query=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE usuario='$user_creador'");
$fila_query=mysqli_fetch_array($rst_query);

//USUARIO ACTUAL
$usuario=$_SESSION["user-asomif"];
$rst_query1=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE usuario='$usuario'");
$fila_query1=mysqli_fetch_array($rst_query1);

//SUBIR ARCHIVO
if(is_uploaded_file($_FILES['archivo']['tmp_name']))
{ 
	$fileName=$_FILES['archivo']['name'];
	$uploadDir="../../archivos/foro/";
	$uploadFile=$uploadDir.$fileName;
	$num = 0;
	$name = $fileName;
	$extension = end(explode('.',$fileName));     
	$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
	while(file_exists($uploadDir.$name))
	{
		$num++;         
		$name = $onlyName."".$num.".".$extension; 
	}
	$uploadFile = $uploadDir.$name; 
	move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile);  
	$name;
}

//DECLARACION DE VARIABLES
	$foro=$_REQUEST["foro"];;
	$tema_foro=$_REQUEST["id"];
 	$hora2=time(); 
	$hora=date("H:i",$hora2); 
	$fecha=date('Y-m-d');
	$mensaje=$_POST["foro-principal"];
	$nombre_tf=$_POST["tema-foro"];
	$nombre_f=$_POST["titulo-foro"];
	$url=$_POST["url-pagina"];

mysqli_query($conexion, "INSERT INTO ap_foro_comentario (user, comentario, fecha, hora, tema_foro, foro, archivo) VALUES ('$usuario', '$mensaje', '$fecha', '$hora', $tema_foro, $foro, '$name') ");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$destinatario = $fila_query["email"]; 
	$asunto = "Mensaje de Foro - ASOMIF PERU"; 
	$cuerpo = "<html><head><title>Mensaje de Foro - ASOMIF PERU</title>
	<style type='text/css'>
		body,td,th {color: #000;}
	</style>
	</head>
	<body>
		".$fila_query1["nombre"]." ".$fila_query1["apellidos"]." ha realizado un comentario en:<br/>
		<strong>Tema:</strong> $nombre_tf<br/>
		<strong>Foro:</strong> $nombre_f<br/>
		<strong>Comentario:</strong>
		$mensaje<br/>
		Puede responder el comentario dando clic <strong><a href=".$url.">AQUI</a></strong>.<br/>
		<p align='center'><img src='http://marostdevelopers.com/asomif/imagenes/logo-asomif.png'></p>
	</body></html>"; 

	//para el envío en formato HTML 
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	
	//dirección del remitente 
	$headers .= 'From: <webmaster@asomifperu.com>' . "\r\n";
	
	//ruta del mensaje desde origen a destino 
	//$headers .= "Return-path: webmaster@asomifperu.com\r\n"; 
	
	//direcciones que recibián copia 
	//$headers .= "Cc: maria@desarrolloweb.com\r\n"; 
	
	//direcciones que recibirán copia oculta 
	//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
	
	mail($destinatario,$asunto,$cuerpo,$headers);
		
	mysqli_close($conexion);
	header("Location:../../debate-foro.php?tema=$tema_foro&foro=$foro");
}
?>