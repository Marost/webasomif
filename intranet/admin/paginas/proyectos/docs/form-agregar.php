<?php
include("../../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");

	$rst_publicar=mysqli_query($conexion, "SELECT * FROM ap_publicar ORDER BY publicar DESC;");

?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script type="text/javascript" src="../../../../js/jquery.js"></script>
<script type="text/javascript" src="../../../js/ckeditor.js"></script>
<script type="text/javascript" src="../../../js/adapters/jquery.js"></script>
<script type="text/javascript">
//<![CDATA[
	$(function()
	{
		var config = {
			toolbar:
			[
				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'RemoveFormat'],
				['UIColor']
			]
		};
		$('.jquery_ckeditor').ckeditor(config);
	});
//]]>
</script>

<script src="../../../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<div id="contenido">
  <div id="titulo_principal">
   	<h2>Agregar - Documento</h2>
  </div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Taller:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="taller" type="text" id="taller" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Lugar y Fecha:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="lugar_fecha" type="text" id="lugar_fecha" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Programa:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="jquery_ckeditor" name="programa" id="programa"></textarea>
          	          </label>
                      </p></td>
           	        </tr>
            	    <tr>
            	      <td width="20%" height="35" align="right"><p><strong>Publicar:</strong></p></td>
            	      <td width="80%" height="35"><span id="spryselect">
            	        <label>
            	          <select name="publicar" id="publicar3">
            	            <option selected="selected" value="">[Seleccione una opcion]</option>
            	            <?php
							  	while ($fila=mysqli_fetch_array($rst_publicar))
								{
									echo "<option value='". $fila["id"] ."'>". $fila["publicar"] ."</option>";
								}
							  ?>
          	            </select>
          	          </label>
            	        <span class="selectInvalidMsg">Seleccione una opcion</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Documento:</strong></p></td>
            	      <td align="left"><p>
            	        <label for="documento"></label>
            	        <input type="file" name="documento" id="documento" />
          	        </p></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><input type="submit" name="guardar" id="guardar" value="Guardar" />                    <label>
                    <input type="reset" name="button2" id="button2" value="Limpiar Datos" />
                  </label></td>
                  </tr>
              </table>
                </form>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
</div><!-- FIN PANEL DERECHA -->
<script type="text/javascript">
<!--
var spryselect = new Spry.Widget.ValidationSelect("spryselect", {invalidValue:"0"});
//-->
</script>