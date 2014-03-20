<?php
include("../../../conexion/conexion.php");
header("Content-Type: text/html; charset=iso-8859-1");

	$rst_query1=mysql_query("SELECT * FROM ap_usuario WHERE usuario='". $_REQUEST["usuario"]."';", $conexion);
	$fila_query1=mysql_fetch_array($rst_query1);
	
	$rst_query=mysql_query("SELECT * FROM ap_privilegio_user WHERE usuario='". $_REQUEST["usuario"]."';", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
	
	//PRIVILEGIO
	$rst_publicar1=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar2=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar3=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar4=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar5=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar6=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar7=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar8=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar9=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	$rst_publicar10=mysql_query("SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;", $conexion);
	
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script src="../../../../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script><script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../../../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<div id="contenido">
  <div id="titulo_principal">
   	<h2>Modificar - Usuario</h2>
  </div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?usuario=<?php echo $_REQUEST["usuario"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="left"><span class="mensaje">DATOS DE USUARIO</span></td>
           	        </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Usuario:</label>
          	        </strong></p></td>
            	      <td width="80%" align="left"><input name="usuario" type="text" id="usuario" value="<?php echo $fila_query1["usuario"]; ?>" size="30" readonly="readonly" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Contrase&ntilde;a:</label>
          	        </strong></p></td>
<td width="80%" align="left"><span id="spryconfirm1">
            	        <input name="rpt-clave" type="password" id="rpt-clave" value="<?php echo $fila_query1["clave"]; ?>" size="30" />
            	        <span class="confirmRequiredMsg">Ingrese una contrase&ntilde;a</span><span class="confirmInvalidMsg">Las contrase&ntilde;as no coinciden.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Repetir Contrase&ntilde;a:</label>
          	        </strong></p></td>
            	      <td width="80%" align="left"><input name="clave" type="password" id="clave" value="<?php echo $fila_query1["clave"]; ?>" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
            	      <td width="80%">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="left" class="texto_negro16-MyriadPro"><span class="mensaje">DATOS PERSONALES</span></td>
           	        </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Nombre</label>
            	        : </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield2">
            	        <input name="nombre" type="text" id="nombre" value="<?php echo $fila_query1["nombre"]; ?>" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese su Nombre</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Apellidos:</label>
          	        </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield3">
            	        <input name="apellidos" type="text" id="apellidos" value="<?php echo $fila_query1["apellidos"]; ?>" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese su Apellido</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Email:</label>
          	        </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield1">
            	        <input name="email" type="text" id="email" value="<?php echo $fila_query1["email"]; ?>" size="50" />
            	        <span class="textfieldRequiredMsg">Ingrese un Email</span><span class="textfieldInvalidFormatMsg">Email no v&aacute;lido.</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Foto:</strong></p></td>
            	      <td align="left"><p>
            	        <label>
            	          <input type="file" name="file" id="file" />
          	          </label>
          	          </p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Foto Actual:</strong></p></td>
            	      <td height="40"><img src="../../../../imagenes/upload/escala-vp-admin.php?imagen=<?php echo $fila_query1["foto"]; ?>" alt="Imagen" />
            	        <input name="img-actual" type="hidden" id="img-actual" value="<?php echo $fila_query1["foto"]; ?>" /></td>
           	        </tr>
            	    <tr>
            	      <td colspan="2" align="right">&nbsp;</td>
           	        </tr>
            	    <tr>
            	      <td colspan="2" align="left" class="texto_negro16-MyriadPro"><p class="mensaje">PRIVILEGIOS DE USUARIO</p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Capacitaciones:</strong></p></td>
            	      <td><span id="spryselect2">
            	        <select name="capacitaciones" id="capacitaciones">
            	          <option value="0">[ Seleccionar opcion ]</option>
            	          <?php
                            while ($fila1=mysql_fetch_array($rst_publicar1))
                            {
                                if ($fila1["id"]==$fila_query["capacitaciones"])
                                    echo "<option selected=''  value='". $fila1["id"] ."'>". $fila1["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila1["id"] ."'>". $fila1["publicar"] ."</option>";
                            }
                          ?>
          	          </select>
            	        <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Evaluacion:</strong></p></td>
            	      <td><span id="spryselect">
                      <select name="evaluacion" id="evaluacion">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila2=mysql_fetch_array($rst_publicar2))
                            {
                                if ($fila2["id"]==$fila_query["evaluacion"])
                                    echo "<option selected=''  value='". $fila2["id"] ."'>". $fila2["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila2["id"] ."'>". $fila2["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Proyectos de Cooperación:</strong></p></td>
            	      <td><span id="spryselect3">
                      <select name="proyectos" id="proyectos">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila3=mysql_fetch_array($rst_publicar3))
                            {
                                if ($fila3["id"]==$fila_query["proyectos"])
                                    echo "<option selected=''  value='". $fila3["id"] ."'>". $fila3["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila3["id"] ."'>". $fila3["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Confidencial:</strong></p></td>
            	      <td><span id="spryselect4">
                      <select name="confidencial" id="confidencial">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila4=mysql_fetch_array($rst_publicar4))
                            {
                                if ($fila4["id"]==$fila_query["confidencial"])
                                    echo "<option selected=''  value='". $fila4["id"] ."'>". $fila4["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila4["id"] ."'>". $fila4["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Foro:</strong></p></td>
            	      <td><span id="spryselect5">
                      <select name="foro" id="foro">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila5=mysql_fetch_array($rst_publicar5))
                            {
                                if ($fila5["id"]==$fila_query["foro"])
                                    echo "<option selected=''  value='". $fila5["id"] ."'>". $fila5["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila5["id"] ."'>". $fila5["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Consultas Legales:</strong></p></td>
            	      <td><span id="spryselect6">
                      <select name="consultas" id="consultas">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila6=mysql_fetch_array($rst_publicar6))
                            {
                                if ($fila6["id"]==$fila_query["consultas"])
                                    echo "<option selected=''  value='". $fila6["id"] ."'>". $fila6["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila6["id"] ."'>". $fila6["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Sugerencia y Contacto:</strong></p></td>
            	      <td><span id="spryselect10">
            	        <select name="sugerencia" id="sugerencia">
            	          <option value="0">[ Seleccionar opcion ]</option>
            	          <?php
                            while ($fila10=mysql_fetch_array($rst_publicar10))
                            {
                                if ($fila10["id"]==$fila_query["consultas"])
                                    echo "<option selected=''  value='". $fila10["id"] ."'>". $fila10["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila10["id"] ."'>". $fila10["publicar"] ."</option>";
                            }
                          ?>
          	          </select>
            	        <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Usuarios:</strong></p></td>
            	      <td><span id="spryselect7">
                      <select name="usuarios" id="usuarios">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila7=mysql_fetch_array($rst_publicar7))
                            {
                                if ($fila7["id"]==$fila_query["usuarios"])
                                    echo "<option selected=''  value='". $fila7["id"] ."'>". $fila7["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila7["id"] ."'>". $fila7["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Modificar:</strong></p></td>
            	      <td><span id="spryselect8">
                      <select name="modificar" id="modificar">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila8=mysql_fetch_array($rst_publicar8))
                            {
                                if ($fila8["id"]==$fila_query["modificar"])
                                    echo "<option selected=''  value='". $fila8["id"] ."'>". $fila8["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila8["id"] ."'>". $fila8["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Eliminar:</strong></p></td>
            	      <td><span id="spryselect9">
                      <select name="eliminar" id="eliminar">
                        <option value="0">[ Seleccionar opcion ]</option>
                        <?php
                            while ($fila9=mysql_fetch_array($rst_publicar9))
                            {
                                if ($fila9["id"]==$fila_query["eliminar"])
                                    echo "<option selected=''  value='". $fila9["id"] ."'>". $fila9["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila9["id"] ."'>". $fila9["publicar"] ."</option>";
                            }
                          ?>
                      </select>
                      <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
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
<script type="text/javascript">
<!--
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "clave");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"0"});
var spryselect = new Spry.Widget.ValidationSelect("spryselect", {invalidValue:"0"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"0"});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {invalidValue:"0"});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {invalidValue:"0"});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {invalidValue:"0"});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {invalidValue:"0"});
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {invalidValue:"0"});
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {invalidValue:"0"});
var spryselect10 = new Spry.Widget.ValidationSelect("spryselect10", {invalidValue:"0"});
//-->
</script>
