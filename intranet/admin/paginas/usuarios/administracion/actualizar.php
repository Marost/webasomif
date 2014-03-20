<?php
include ("../../../conexion/conexion.php");

// IMAGEN
if($_FILES['file']['name']!="")
{
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
}else
{
	$name=$_POST["img-actual"];
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

mysql_query("UPDATE ap_usuario SET clave='$clave', nombre='$nombre', apellidos='$apellidos', email='$email', foto='$name' WHERE usuario='". $_REQUEST["usuario"]."';",$conexion);

mysql_query("UPDATE ap_privilegio_user SET capacitaciones=$capacitaciones, evaluacion=$evaluacion, proyectos=$proyectos, confidencial=$confidencial, foro=$foro, consultas=$consultas, sugerencia=$sugerencia, usuarios=$usuarios, modificar=$modificar, eliminar=$eliminar WHERE usuario='". $_REQUEST["usuario"]."';", $conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>
