<?php
include("../../conexion/conexion.php");

//SUBIR ARCHIVO
if(is_uploaded_file($_FILES['archivo']['tmp_name']))
{ 
	$fileName=$_FILES['archivo']['name'];
	$uploadDir="../../../imagenes/upload/";
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
$titulo=$_POST["titulo"];
$contenido=$_POST["contenido"];

mysqli_query($conexion, "INSERT INTO ap_noticias (titulo, contenido, imagen) VALUES('$titulo', '$contenido', '$name');");

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysqli_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysqli_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>