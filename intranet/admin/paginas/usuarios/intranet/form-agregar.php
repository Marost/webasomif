<?php
include("../../../conexion/conexion.php");
header("Content-Type: text/html; charset=utf-8");
	
	$rst_publicar=mysqli_query($conexion, "SELECT * FROM ap_publicar WHERE id>0 ORDER BY id ASC;");
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC");
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_foro_permiso_usuario_intranet WHERE id>0");
	$fila_query2=mysqli_query($conexion, $rst_query2);
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script src="../../../../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../../../../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="../../../../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../../../../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<div id="contenido">
  <div id="titulo_principal">
   	<h2>Agregar - Usuario</h2>
  </div><!-- FIN TITULO PRINCIPAL -->
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="2"><span class="mensaje">DATOS DE USUARIO</span></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Usuario:</label>
                  </strong></p></td>
                  <td width="80%" align="left"><input name="usuario" type="text" id="usuario" size="30" /></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Contrase&ntilde;a:</label>
                  </strong></p></td>
                  <td width="80%" align="left"><span id="spryconfirm1">
                  <input name="rpt-clave" type="password" id="rpt-clave" size="30" />
                  <span class="confirmRequiredMsg">Ingrese una contrase&ntilde;a</span><span class="confirmInvalidMsg">Las contrase&ntilde;as no coinciden.</span></span></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Repetir Contrase&ntilde;a:</label>
                  </strong></p></td>
                  <td width="80%" align="left"><input name="clave" type="password" id="clave" size="30" /></td>
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
                    <input name="nombre" type="text" id="nombre" size="50" />
                  <span class="textfieldRequiredMsg">Ingrese su Nombre</span></span></p></td>
                </tr>
                <tr>
                  <td align="right"><p> <strong>
                    <label> Apellidos:</label>
                  </strong></p></td>
                  <td align="left"><p><span id="sprytextfield3">
                    <input name="apellidos" type="text" id="apellidos" size="50" />
                  <span class="textfieldRequiredMsg">Ingrese su Apellido</span></span></p></td>
                </tr>
                <tr>
                  <td align="right"><p> <strong>
                    <label> Email:</label>
                  </strong></p></td>
                  <td align="left"><p><span id="sprytextfield1">
                    <input name="email" type="text" id="email" size="50" />
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
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="2" align="left" class="texto_negro16-MyriadPro"><p class="mensaje">PRIVILEGIOS DE USUARIO</p></td>
                  </tr>
                <tr>
                  <td align="right"><p><strong>Confidencial:</strong></p></td>
                  <td><span id="spryselect2">
                    <select name="confidencial" id="confidencial">
                      <option value="0">[ Seleccionar opcion ]</option>
                      <?php while ($fila2=mysqli_fetch_array($rst_publicar)){
								echo "<option value='". $fila2["id"] ."'>". $fila2["publicar"] ."</option>";
						}?>
                    </select>
                  <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
                </tr>
                <tr>
                  <td align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="left" class="texto_negro16-MyriadPro">
                  
                  <div id="CollapsiblePanel1" class="CollapsiblePanel">
                    <div class="CollapsiblePanelTab" tabindex="0">Foro</div>
                    <div class="CollapsiblePanelContent">
                      <table width="64%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="46%" align="right"><p><strong>Asesores Legales</strong></p></td>
                          <td width="54%"><p>
                            <label for="asesores_legales"></label>
                            <select name="asesores_legales" id="asesores_legales">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Auditores</strong></p></td>
                          <td><p>
                            <select name="auditores" id="auditores">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Consejo Directivo</strong></p></td>
                          <td><p>
                            <select name="consejo_directivo" id="consejo_directivo">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Contadores</strong></p></td>
                          <td><p>
                            <select name="contadores" id="contadores">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Defensa Gremial</strong></p></td>
                          <td><p>
                            <select name="defensa_gremial" id="defensa_gremial">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Gerencia General</strong></p></td>
                          <td><p>
                            <select name="gerencia_general" id="gerencia_general">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Oficiales de Atención al Usuario</strong></p></td>
                          <td><p>
                            <select name="oficiales_atencion" id="oficiales_atencion">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Oficiales de Cumplimiento</strong></p></td>
                          <td><p>
                            <select name="oficiales_cumplimiento" id="oficiales_cumplimiento">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>RRHH</strong></p></td>
                          <td><p>
                            <select name="rrhh" id="rrhh">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>TI</strong></p></td>
                          <td><p>
                            <select name="ti" id="ti">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Unidades de Riesgos</strong></p></td>
                          <td><p>
                            <select name="unidades_riesgos" id="unidades_riesgos">
                            	<option value="2">NO</option>
                            	<option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                        <tr>
                          <td align="right"><p><strong>Cumplimiento Normativo</strong></p></td>
                          <td><p>
                            <select name="cumplimiento_normativo" id="cumplimiento_normativo">
                              <option value="2">NO</option>
                              <option value="1">SI</option>
                            </select>
                          </p></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  
                  </td>
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
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"0"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1");
//-->
</script>
