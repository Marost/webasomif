<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - ASOMIF</title>
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
				<form action="conexion/verificar.php" method="post">
<div id="input_login"><span id="sprytextfield1">
				    <input name="user" type="text" id="user" />
			      <span class="textfieldRequiredMsg"></span></span></div>
                <div id="espacio_login"></div>
            <div id="input_login"><span id="sprypassword1">
              <input name="pass" id="pass" type="password" />
              <span class="passwordRequiredMsg">Se necesita un valor.</span></span></div>
                <div id="espacio_login"></div>
                <div id="boton_login"><input name="btn_login" type="image" id="btn_login" src="imagenes/btn-ingresar-login.png" width="89" height="20"  /></div>
                <div id="texto-login">
                	<p>Ingrese usuario y contraseña</p>
                	<p>Luego haga clic en ingresar o presione enter</p>
                	<p><a href='recuperar.php'>¿Olvidaste tu clave?</a></p>
                </div>
                <div id="mensaje">
                  <?php
					if($_REQUEST["nosesion"]==1){
						echo "Inicie sesión para poder ingresar al Panel";
					} elseif($_REQUEST["nosesion"]==2){
						echo "Usuario o contraseña no son correctos";
					} elseif($_REQUEST["nosesion"]==3){
						echo "Salió correctamente del Panel";
					} elseif($_REQUEST["nosesion"]==4){
						echo "Sesión caducada por inactividad en la cuenta.";
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Usuario"});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
//-->
</script>
</body>
</html>