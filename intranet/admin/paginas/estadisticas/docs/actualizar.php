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
if($_POST["documento"]!="")
{
	$archivo=$_POST["documento"];
	$final = end(explode('archivos/',$archivo));
}else
{
	$final=$_POST["doc-actual"];
	$final;
}

//DECLARACION DE VARIABLES
$taller=$_POST["taller"];
$lugar_fecha=$_POST["lugar_fecha"];
$programa=$_POST["programa"];
$publicar=$_POST["publicar"];
$tipo='Documento';

mysql_query("UPDATE ap_estadistica SET taller='$taller', lugar_fecha='$lugar_fecha', programa='$programa', nombre_archivo='$final', extension='$extension', publicar=$publicar, tipo='$tipo', logo='$name' WHERE id=". $_REQUEST["id"].";", $conexion);
	
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