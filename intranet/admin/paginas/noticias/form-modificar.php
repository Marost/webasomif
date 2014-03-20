<?php
include("../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");
	
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_noticias WHERE id=". $_REQUEST["id"].";");
	$fila_query=mysqli_fetch_array($rst_query);
?>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="../../js/ckeditor.js" type="text/javascript"></script>
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
   	<h2>Modificar - Noticia</h2>
</div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?id=<?php echo $_REQUEST["id"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Taller:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="titulo" type="text" id="titulo" value="<?php echo $fila_query["titulo"] ?>" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Programa:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea name="contenido" class="jquery_ckeditor" id="contenido"><?php echo $fila_query["contenido"] ?></textarea>
          	          </label>
          	        </p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Logo:</strong></p></td>
            	      <td align="left"><p>
            	        <label for="archivo"></label>
            	        <input type="file" name="archivo" id="archivo" />
          	        </p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Logo Actual:</strong></p></td>
            	      <td align="left"><img src="../../../imagenes/upload/<?php echo $fila_query["imagen"] ?>" />
           	          <input name="logo-actual" type="hidden" id="logo-actual" value="<?php echo $fila_query["imagen"] ?>" /></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><label>
                    <input type="submit" name="guardar" id="guardar" value="Guardar" />
                    &nbsp;
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
