<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
include("../../conexion/funcion-paginacion.php");
header("Content-Type: text/html; charset=utf-8");

$user=$_SESSION["user"];
$cebra=1;
$url="listar.php";
$buscar=$_REQUEST["busqueda"];

		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_sugerencia_contacto WHERE id>0 ORDER BY id DESC;");
		$num_registros=mysqli_num_rows($rst_query);
			
		$registros=10;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
		$inicio=(($pagina-1)*$registros);
		else
		$inicio=0;
		
		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_sugerencia_contacto WHERE id>0 ORDER BY id DESC LIMIT $inicio, $registros;");
		$paginas=ceil($num_registros/$registros);
	
	
	if ($num_registros==0)
	{
		if ($buscar!="")		
			$mensaje2="No hay registros con el nombre: <b>$buscar</b>";
		else
			$mensaje2="No hay registros en la base de datos";
	}
	
	
	//------- MENSAJE DE ERROR
	if($_REQUEST["mensaje"]==1)
	{
		$mensaje="El registro fue agregado exitosamente";
	}elseif($_REQUEST["mensaje"]==2)
			$mensaje="El registro fue modificado exitosamente";
	elseif($_REQUEST["mensaje"]==3)
			$mensaje="El registro fue eliminado exitosamente";
	elseif($_REQUEST["mensaje"]==4)
			$mensaje="Se ha producido un error al ingresar el nuevo registro";
	elseif($_REQUEST["mensaje"]==5)
			$mensaje="Se ha producido un error al modificar el registro";
	elseif($_REQUEST["mensaje"]==6)
			$mensaje="Se ha producido un error al eliminar el registro";
	
	//PRIVILEGIOS USER
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user WHERE usuario='$user'");
	$fila_query3=mysqli_fetch_array($rst_query2);
?>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css">
<script type="text/javascript">
function eliminarComentario(consulta) {
if(confirm("¿Está seguro de borrar esta sugerencia?")) {
	document.location.href="eliminar.php?id="+consulta;
	}
}
</script>
<div id="contenido">
            	<div id="titulo_principal">
            	  <h2>Lista - Sugerencia y Contacto</h2>
				</div><!-- FIN TITULO PRINCIPAL -->
                <div id="contenido_total">
                  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="30" align="center"><p><span class="mensaje"><?php echo $mensaje; ?></span></p></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"><p><strong>Sugerencia y Contacto</strong></p></td>
                  </tr>
                <tr>
                  <td colspan="2" align="center">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <?php while($fila_query2=mysqli_fetch_array($rst_query)){ ?>
                    <tr<?php echo alt($zebra); $zebra++; ?>>
                      <td width="50%"><p>Por: <strong><?php echo $fila_query2["persona"]; ?></strong> 
                      </p></td>
                      <td width="50%" align="center" valign="middle"><p>Operaciones: 
                      <?php if($fila_query3["eliminar"]==1){ ?>
                      <img src="../../images/eliminar_16.png" width="16" height="16" /> 
                      <strong>
                      <a href="javascript:;" onclick="eliminarComentario(<?php echo $fila_query2["id"]; ?>)">Eliminar</a></strong> <?php } ?>
                      </p></td>
                    </tr>
                    <tr<?php echo alt($zebra); $zebra++; ?>>
                      <td colspan="2">
                          <p><?php echo $fila_query2["mensaje"]; ?></p></td>
                    </tr>
                    <tr>
                      <td colspan="2"><hr /></td>
                    </tr>
                    <?php } ?>
                  </table></td>
                  </tr>
                <tr>
                  <td colspan="2" align="center">
					<?php 
                        if ($_REQUEST["btnbuscar"]=="")
                        {
                            if (!isset($_GET["pag"]))
                            $pag = 1;
                            else
                            $pag = $_GET["pag"];
                            echo paginarComentario($pag, $num_registros, $registros, "$url?pag=", 10);
                        }
                    ?>
                  </td>
                    </tr>
                    <tr>
                      <td height="30" align="center"><?php echo $mensaje2; ?></td>
                    </tr>
                  </table>
    </div></div><!-- FIN PANEL DERECHA -->