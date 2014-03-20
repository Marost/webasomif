<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - ASOMIF - Recuperar contraseña</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
</head>

<body id="login">
<div id="principal">
   <div id="contenido">
   	  <div id="content_login">
        	<div id="img_login">
           	  <img src="imagenes/logo-asomif.png" alt="" width="480" height="119" />
      </div><!-- FIN IMAGEN LOGIN -->
            <div id="formulario_login">
				<form action="conexion/recuperar.php" method="post">
<div id="input_login"><span id="sprytextfield1">
<input name="email" type="text" id="email" />
<span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></div>
                <div id="espacio_login"></div>
                <div id="boton_login">
                  <input type="submit" name="button" id="button" value="Recuperar Contraseña" />
                </div>
                <div id="texto-login">
                	<p>Ingrese email para recuperar contraseña.</p>
                </div>
                <div id="mensaje">
                  <?php
					if($_REQUEST["nosesion"]==1){
						echo "No hay usuario registrado con el email ingresado";
					}
				?>
                </div>             
            </form>
          </div><!-- FIN FORMULARIO LOGIN -->
        </div><!-- FIN CONTENI LOGIN -->
  </div>
</div><!--FIN PRINCIPAL-->
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {hint:"Email"});
//-->
</script>
</body>
</html>