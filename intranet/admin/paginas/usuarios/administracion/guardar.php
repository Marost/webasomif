<?php
include ("../../../conexion/conexion.php");

//SUBIDA DE IMAGEN
if(is_uploaded_file($_FILES['file']['tmp_name']))
{ 
	$fileName=$_FILES['file']['name'];
	$uploadDir="../../../../imagenes/upload/";
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
	move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);  
	$name;
}

//DATOS USUARIO
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$usuario=$_POST["usuario"];
$email=$_POST["email"];
$clave=$_POST["clave"];

//PRIVILEGIOS USUARIO
$capacitaciones=$_POST["capacitaciones"];
$evaluacion=$_POST["evaluacion"];
$proyectos=$_POST["proyectos"];
$confidencial=$_POST["confidencial"];
$foro=$_POST["foro"];
$consultas=$_POST["consultas"];
$sugerencia=$_POST["sugerencia"];
$usuarios=$_POST["usuarios"];
$modificar=$_POST["modificar"];
$eliminar=$_POST["eliminar"];

mysql_query("INSERT INTO ap_usuario (usuario, clave, nombre, apellidos, email, foto) VALUES ('$usuario', '$clave', '$nombre', '$apellidos', '$email', '$name');",$conexion);

mysql_query("INSERT INTO ap_privilegio_user (usuario, capacitaciones, evaluacion, proyectos, confidencial, foro, consultas, sugerencia, usuarios, modificar, eliminar) VALUES ('$usuario', $capacitaciones, $evaluacion, $proyectos, $confidencial, $foro, $consultas, $sugerencia, $usuarios, $modificar, $eliminar);", $conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>