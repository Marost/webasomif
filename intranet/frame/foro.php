<?php
session_start();
include("../conexion/conexion.php");
include("../conexion/verificar_sesion.php");
include("../admin/conexion/funciones.php");
header("Content-Type: text/html; charset=utf-8");

	//FORO IZQUIERDA
	$rst_query1=mysqli_query($conexion, "SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC");
?>
<link rel="stylesheet" type="text/css" href="../css/estilos.css"/>
<meta http-equiv="Refresh" content="3" />
<div id="contenido-foro">
	<?php while($fila_query1=mysqli_fetch_array($rst_query1)){ ?>
      <p class="texto-negro11-Arial">
      	<strong>
			<?php echo $fila_query1["nombre"].":" ?>
      </strong> <?php echo $fila_query1["mensaje"] ?></p>
     <?php } ?>
</div>