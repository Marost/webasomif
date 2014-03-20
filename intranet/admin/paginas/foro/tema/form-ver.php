<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");
header("Content-Type: text/html; charset=utf-8");

$url="form-ver.php";

	$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE id=". $_REQUEST["id"].";", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
	
	//PAGINACION DE COMENTARIOS
	$rst_query2=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_comentario WHERE tema_foro=". $_REQUEST["id"].";",$conexion);
	$num_registros=mysql_num_rows($rst_query2);
		
	$registros=10;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina))
	$inicio=(($pagina-1)*$registros);
	else
	$inicio=0;
	
	$rst_query2=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_comentario WHERE tema_foro=". $_REQUEST["id"]." LIMIT $inicio, $registros;", $conexion);
	$paginas=ceil($num_registros/$registros);
	
	//MENSAJE
	if($_REQUEST["mensaje"]==1)
	{
		$mensaje="Se ha producido un error al eliminar el registro";
	}elseif($_REQUEST["mensaje"]==2)
		$mensaje="El registro fue eliminado exitosamente";	
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script type="text/javascript">
function eliminarComentario(comentario,tema) {
if(confirm("¿Está seguro de borrar este comentario?")) {
	document.location.href="eliminar-comentario.php?id="+comentario+"&tema="+tema;
	}
}
</script>
<div id="contenido">
  <div id="titulo_principal">
   	<h2>Ver Comentarios  - <?php echo $fila_query["tema_foro"]; ?></h2>
</div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td width="17%" align="right"><p><strong>Foro:</strong></p></td>
            	      <td width="83%" align="left"><p>
					  <?php
						$foro=$fila_query["foro"];
						$rst_foro=mysql_query("SELECT * FROM ap_foro WHERE id=$foro", $conexion);
						$fila_foro=mysql_fetch_array($rst_foro);
						echo $fila_foro["foro"];
						?></p></td>
          	        </tr>
                <tr>
                  <td align="right"><p><strong>Tema:</strong></p></td>
                  <td align="left"><p><?php echo $fila_query["tema_foro"]; ?></p></td>
                  </tr>
                <tr>
                  <td align="right"><p><strong>Autor y Fecha:</strong></p></td>
                  <td align="left" class="texto_negro16-MyriadPro"><p>Creado por <strong><?php echo $fila_query["usuario"]; ?></strong> el <?php echo $fila_query["fecha2"]; ?></p></td>
                  </tr>
                <tr>
                  <td colspan="2" align="center" class="mensaje"><?php echo $mensaje ?></td>
                  </tr>
                <tr>
                  <td align="left"><p><strong>Comentarios</strong></p></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <?php while($fila_query2=mysql_fetch_array($rst_query2)){ ?>
                    <tr<?php echo alt($zebra); $zebra++; ?>>
                      <td width="70%"><p>Por: <strong><?php echo $fila_query2["user"]; ?></strong> - - Fecha: <strong><?php echo $fila_query2["fecha2"]; ?></strong> a las <strong><?php echo $fila_query2["hora"]; ?></strong></p></td>
                      <td width="30%" align="center" valign="middle"><p>Operaciones: 
                      <img src="../../../images/eliminar_16.png" width="16" height="16" /> 
                      <strong><a href="#" onclick="eliminarComentario(<?php echo $fila_query2["id"]; ?>,<?php echo $fila_query["id"]; ?>)">Eliminar</a></strong></p></td>
                    </tr>
                    <tr<?php echo alt($zebra); $zebra++; ?>>
                      <td colspan="2">
                          <p><?php echo $fila_query2["comentario"]; ?></p><br />
                          <p><strong>Enlace de Archivo:</strong>  <a href="../../../../archivos/foro/bajando.php?f=<?php echo $fila_query2['archivo'] ?>"><?php echo $fila_query2['archivo'] ?></a></p>
                      </td>
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
                  </table>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
</div><!-- FIN PANEL DERECHA -->
