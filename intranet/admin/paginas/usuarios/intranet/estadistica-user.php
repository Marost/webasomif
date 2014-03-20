<?php
include("../../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");

	$user=$_REQUEST["user"];
	$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_usuario_intranet_descargas WHERE usuario='$user'", $conexion);
	$rst_query2=mysql_query("SELECT *, DATE_FORMAT(f_entrada,'%d/%m/%Y') AS fecha_e, DATE_FORMAT(f_salida,'%d/%m/%Y') AS fecha_s FROM ap_usuario_intranet_time WHERE usuario='$user'", $conexion);
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script src="../../../../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
function cancelar() {
	document.location.href="listar.php";
}
</script>
<link href="../../../../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<div id="contenido">
  <div id="titulo_principal">
   	<h2>Estadistica - Usuario</h2>
  </div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" class="texto_negro16-MyriadPro"><p>Registro de Usuario: <strong><?php echo $user;?></strong></p></td>
                </tr>
                <tr>
                  <td align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" class="texto_negro16-MyriadPro"><div id="TabbedPanels1" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                      <li class="TabbedPanelsTab" tabindex="0">Registros de Descargas</li>
                      <li class="TabbedPanelsTab" tabindex="0">Ingres y Salida de Usuario</li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                      <div class="TabbedPanelsContent">
                      		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="16%" align="center" bgcolor="#CCCCCC"><p><strong>Fecha</strong></p></td>
    <td width="40%" align="center" bgcolor="#CCCCCC"><p><strong>Archivo</strong></p></td>
    <td width="31%" align="center" bgcolor="#CCCCCC"><p><strong>Página</strong></p></td>
    <td width="13%" align="center" bgcolor="#CCCCCC"><p> <strong>Descargas</strong></p></td>
  </tr>
  <?php while($fila=mysql_fetch_array($rst_query)){ ?>
  <tr>
    <td width="16%"><p><?php echo $fila["fecha2"] ?></p></td>
    <td width="40%"><p><?php echo $fila["descarga"] ?></p></td>
    <td width="31%"><p><?php echo $fila["pagina"] ?></p></td>
    <td width="13%" align="center"><p><?php echo $fila["valor"] ?></p></td>
  </tr>
  <?php } ?>
</table>

                      </div>
                      <div class="TabbedPanelsContent">
                      		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" align="center" bgcolor="#CCCCCC"><p><strong>Fecha de Entrada</strong></p></td>
    <td width="25%" align="center" bgcolor="#CCCCCC"><p><strong>Hora Entrada</strong></p></td>
    <td width="25%" align="center" bgcolor="#CCCCCC"><p><strong>Fecha de Salida</strong></p></td>
    <td width="25%" align="center" bgcolor="#CCCCCC"><p><strong>Hora Salida</strong></p></td>
  </tr>
  <?php while($fila2=mysql_fetch_array($rst_query2)){ ?>
  <tr>
    <td width="25%" align="center"><p><?php echo $fila2["fecha_e"]; ?></p></td>
    <td width="25%" align="center"><p><?php echo $fila2["entrada"]; ?></p></td>
    <td width="25%" align="center"><p><?php echo $fila2["fecha_s"]; ?></p></td>
    <td width="25%" align="center"><p><?php echo $fila2["salida"]; ?></p></td>
  </tr>
  <?php } ?>
</table>

                      </div>
                    </div>
                  </div></td>
                </tr>
                <tr>
                  <td width="100%" align="center" class="texto_negro16-MyriadPro"><label><input onclick="cancelar();" type="button" name="button" id="button" value="Salir" /></label></td>
                  </tr>
              </table>
                </form>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
</div><!-- FIN PANEL DERECHA -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
