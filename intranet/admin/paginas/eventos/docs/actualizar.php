<?php
include ("../../../../conexion/conexion.php");

// REEMPLAZAR ARCHIVO - LOGO
if($_FILES['archivo']['name']!="")
{
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
}
else
{
	$name=$_POST["logo-actual"];
	$name;
}

// REEMPLAZAR ARCHIVO - DOCUMENTO
if($_FILES['documento']['name']!="")
{
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
}
else
{
	$documento=$_POST["doc-actual"];
	$documento;
}

//DECLARACION DE VARIABLES
$taller=$_POST["taller"];
$lugar_fecha=$_POST["lugar_fecha"];
$programa=$_POST["programa"];
$publicar=$_POST["publicar"];
$tipo='Documento';

mysql_query("UPDATE ap_eventos SET taller='$taller', lugar_fecha='$lugar_fecha', programa='$programa', nombre_archivo='$documento', extension='$extension', publicar=$publicar, tipo='$tipo', logo='$name' WHERE id=". $_REQUEST["id"].";", $conexion);
	
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