<?php
if(isset($_POST["nombre"]) && isset($_POST["asunto"]) && isset($_POST["email"]) && isset($_POST["comentario"]) ){
    $fecha = date("D-M-y H:i");
	$mymail = "jvaldivia@asomifperu.com";
	$subject = "Formulario Web Asomif";
	$contenido = "Asunto: ".$_POST["asunto"]."\n\n";
	$contenido .= "Empresa: ".$_POST["empresa"]."\n\n";
	$contenido .= "Direccion: ".$_POST["direccion"]."\n\n";
	$contenido .= "Pais: ".$_POST["pais"]."\n\n";
	$contenido .= "Codigo Postal: ".$_POST["postal"]."\n\n";
	$contenido .= "Nombre y Apellido: ".$_POST["nombre"]."\n\n";
	$contenido .= "Cargo: ".$_POST["cargo"]."\n\n";
	$contenido .= "Telefonos: ".$_POST["telefonos"]."\n\n";
	$contenido .= "Fax: ".$_POST["fax"]."\n\n";
	$contenido .= "E-Mail: ".$_POST["email"]."\n\n";
	$contenido .= "Comentario: ".$_POST["comentario"]."\n\n";
	$header = "From:".$_POST["email"]."\nReply-To:".$_POST["email"]."\n";
	$header .= "X-Mailer:PHP/".phpversion()."\n";
	$header .= "Mime-Version: 1.0\n";
	$header .= "Content-Type: text/plain";
	mail($mymail, $subject, utf8_decode($contenido) ,$header);
	header("Location: http://www.asomifperu.com/gracias.htm");
}
?>