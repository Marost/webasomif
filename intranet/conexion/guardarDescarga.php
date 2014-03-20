<?php
session_start();
include("conexion.php");

//VARIABLES
$tipo_pagina=$_REQUEST["tipo_pagina"];
$enlace=$_POST["enlace-descarga"];
$user=$_SESSION["user-asomif"];
$descarga=$_POST["titulo"];
$pagina=$_POST["pagina"];
$tipo=$_POST["tipo"];
$fecha=date("Y-m-d");
$hora=date("H:i");

$rst_query=mysql_query("SELECT * FROM ap_usuario_intranet_descargas WHERE usuario='$user' AND descarga='$descarga' AND pagina='$pagina' AND fecha='$fecha';", $conexion);
$num_registros=mysql_num_rows($rst_query);
	
if($tipo=="documento"){
	if($num_registros==1){
		$rst_query2=mysql_query("SELECT * FROM ap_usuario_intranet_descargas WHERE usuario='$user' AND descarga='$descarga' AND pagina='$pagina' AND fecha='$fecha'", $conexion);
		while($fila_query=mysql_fetch_array($rst_query2)){ $cont=$fila_query["valor"]+1;}
		mysql_query("UPDATE ap_usuario_intranet_descargas SET valor=$cont WHERE usuario='$user' AND descarga='$descarga' AND pagina='$pagina' AND fecha='$fecha'", $conexion);
	}elseif($num_registros==0){
		mysql_query("INSERT INTO ap_usuario_intranet_descargas (usuario, descarga, pagina, fecha, hora, valor) VALUES ('$user', '$descarga', '$pagina', '$fecha', '$hora', 1)", $conexion);
	}
	if (mysql_errno()!=0){
		echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
		//header("Location:listar.php?mensaje=4");
	}else{
		header("Location:../archivos/bajando.php?archivo=$enlace");
	}
}

if($tipo=="video"){
	$id=$_POST["idvideo"];
	if($num_registros==1){
		$rst_query3=mysql_query("SELECT * FROM ap_usuario_intranet_descargas WHERE usuario='$user' AND descarga='$descarga' AND pagina='$pagina' AND fecha='$fecha'", $conexion);
		while($fila_query=mysql_fetch_array($rst_query3)){ 
			$cont=$fila_query["valor"]+1;
		}
		mysql_query("UPDATE ap_usuario_intranet_descargas SET valor=$cont WHERE usuario='$user' AND descarga='$descarga' AND pagina='$pagina' AND fecha='$fecha'", $conexion);
	}elseif($num_registros==0){
		mysql_query("INSERT INTO ap_usuario_intranet_descargas (usuario, descarga, pagina, fecha, hora, valor) VALUES ('$user', '$descarga', '$pagina', '$fecha', '$hora', 1)", $conexion);
	}
	if (mysql_errno()!=0){
		echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
	}else{
		if($tipo_pagina=="evento"){
			mysql_close($conexion);
			header("Location:../eventos.php");
		}elseif($tipo_pagina=="capacitaciones"){
			mysql_close($conexion);
			header("Location:../capacitaciones.php");
		}elseif($tipo_pagina=="estadisticas"){
			mysql_close($conexion);
			header("Location:../estadistica.php");
		}elseif($tipo_pagina=="normas_legales"){
			mysql_close($conexion);
			header("Location:../evaluacion.php");
		}elseif($tipo_pagina=="pro_coop"){
			mysql_close($conexion);
			header("Location:../proyectos-cooperacion.php");
		}
	}
}
?>