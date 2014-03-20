<?php
include("../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");
?>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<script type="text/javascript" src="../../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/ckeditor.js"></script>
<script type="text/javascript" src="../../js/adapters/jquery.js"></script>
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

<div id="contenido">
  <div id="titulo_principal">
   	<h2>Respuesta  - Consulta Legal</h2>
  </div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="left" class="texto_izq"><p><strong>Respuesta:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="identificador" type="hidden" id="identificador" value="<?php echo $_REQUEST["id"] ?>" />
           	          <input name="email" type="hidden" id="email" value="<?php echo $_REQUEST["email"] ?>" /></td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="jquery_ckeditor" name="msj" id="msj"></textarea>
          	          </label>
                      </p></td>
           	        </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" />                    <label>
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