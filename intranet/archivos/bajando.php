<?php

/*$id = $_REQUEST["archivo"]; 
$enlace = $path_a_tu_doc."/".$id; 
header ("Content-Disposition: attachment; filename=".$id."\n\n"); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);*/

$enlace = $_GET['archivo'];
header ("Content-Disposition: attachment; filename=$enlace ");
header ("Content-Type: application/force-download");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

?>
