<?php
include("../../../conexion/conexion.php");

//SUBIR ARCHIVO - LOGO
if(is_uploaded_file($_FILES['archivo']['tmp_name']))
{ 
	$fileName=$_FILES['archivo']['name'];
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
	move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile);  
	$name;
}

//SUBIR ARCHIVO - DOCUMENTO
if(is_uploaded_file($_FILES['documento']['tmp_name']))
{ 
	$fileName=$_FILES['documento']['name'];
	$uploadDir="../../../../archivos/";
	$uploadFile=$uploadDir.$fileName;
	$num = 0;
	$documento = $fileName;
	$extension = end(explode('.',$fileName));     
	$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
	while(file_exists($uploadDir.$documento))
	{
		$num++;         
		$documento = $onlyName."".$num.".".$extension; 
	}
	$uploadFile = $uploadDir.$documento; 
	move_uploaded_file($_FILES['documento']['tmp_name'], $uploadFile);  
	$documento;
}


//DECLARACION DE VARIABLES
$taller=$_POST["taller"];
$lugar_fecha=$_POST["lugar_fecha"];
$programa=$_POST["programa"];
$publicar=$_POST["publicar"];
$tipo='Documento';

mysqli_query($conexion, "INSERT INTO ap_capac_docs (taller, lugar_fecha, programa, nombre_archivo, extension, publicar, tipo, logo) VALUES('$taller', '$lugar_fecha', '$programa', '$documento', '$extension', $publicar, '$tipo', '$name');");

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