<?php
//CONEXION CON EL SERVIDOR
$conexion=mysql_connect("Localhost","admin","admin@123");
//$conexion=mysql_connect("Localhost","asomifpe_admin","admin@123");
//$conexion=mysql_connect("Localhost","marostd3_admin","admin@123");

//SELECCION DE LA BASE DE DATOS
mysql_select_db("asomif");
//mysql_select_db("asomifpe_asomif");
//mysql_select_db("marostd3_asomif");
?>