<?php
include("../../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");
	$rst_query=mysql_query("SELECT * FROM ap_proyectos WHERE id=". $_REQUEST["id"].";", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />

<div id="contenido">
  <div id="titulo_principal">
   	<h2>Eliminar - Capacitaci&oacute;n</h2>
</div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="eliminar.php?id=<?php echo $_REQUEST["id"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Taller:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><p><?php echo $fila_query["taller"] ?></p></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Lugar y Fecha:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><p><?php echo $fila_query["lugar_fecha"] ?></p></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Programa:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="left"><p><?php echo $fila_query["programa"] ?></p></td>
          	      </tr>
            	    <tr>
            	      <td align="center"><p><strong>Documento:</strong></p></td>
            	      <td align="left"><p><?php echo $fila_query["nombre_archivo"] ?></p></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><label>
                    <input type="submit" name="eliminar" id="eliminar" value="Eliminar" />
                  &nbsp;</label></td>
                  </tr>
              </table>
                </form>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
</div><!-- FIN PANEL DERECHA -->
