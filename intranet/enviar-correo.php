<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Envio de Correo</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="admin/js/ckeditor.js"></script>
<script type="text/javascript" src="admin/js/adapters/jquery.js"></script>
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

</head>

<body>
    <div id="titulo-envio">
        <img src="imagenes/envio-correo.jpg" width="420" height="135" />
    </div>
    <div id="contenido-envio">
      <form action="conexion/foro/envio-correo.php" method="post">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td width="29%" align="center" class="texto-negro15-MyriadProBold"><strong>Asunto:</strong></td>
            <td width="71%"><label for="asunto"></label>
            <input name="asunto" type="text" id="asunto" size="35" /></td>
          </tr>
          <tr>
            <td align="center" class="texto-negro15-MyriadProBold"><strong>Mensaje:</strong></td>
            <td><input name="usuario" type="hidden" id="usuario" value="<?php echo $_REQUEST["usuario"] ?>" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><label for="textarea"></label>
            <textarea class="jquery_ckeditor" name="msj" id="msj"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Enviar mensaje" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
			<?php if($_REQUEST["mensaje"]==1){ ?>
            	<strong>El mensaje se envio con éxito</strong>
                <?php } ?>
            </td>
          </tr>
        </table>
      </form>
</div>
</body>
</html>