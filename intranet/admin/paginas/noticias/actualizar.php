<?php
include ("../../../conexion/conexion.php");

// IMAGEN
if($_FILES['archivo']['name']!="")
{
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
}
else
{
	$name=$_POST["logo-actual"];
	$name;
}

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$contenido=$_POST["contenido"];

mysql_query("UPDATE ap_noticias SET titulo='$titulo', contenido='$contenido', imagen='$name' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>