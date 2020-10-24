<!--//////////////////////////// INICIO MODALES GENERICOS ////////////////////////////////-->
<!-- Modal Cargando -->
<div id="modal-cargando" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Aguarde</h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                <div class="alert alert-info fade in" style="text-align:center;width:95%;margin:0px auto;border:1px solid #3A87AD;padding-bottom:30px;">
                    <i id="rotate" style="position: absolute;font-size: 1.5em;" class="fa fa-cog fa-spin fa-1x fa-fw margin-bottom"></i>
                </div>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="modal-delete" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-remove4"></i>Eliminar</h4>
            </div>

            <div class="modal-body with-padding">
                <p>¿Esta seguro que desea eliminar este registro?</p>
            </div>

            <div class="modal-footer">
                <a class="btn btn-primary"> Si</a>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>							
            </div>
        </div>
    </div>
</div>

<!-- Modal Exitoso -->
<div id="modal-exitoso" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Registro actualizado
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning button-ok-modal" data-dismiss="modal">Cerrar</button>							
            </div>            
        </div>
    </div>
</div>

<!--- Modal Error --->
<div id="popUpError" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-times"></span>
                    Error
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Disculpe, ocurri&oacute; un error al procesar su solicitud intentelo nuevamente.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>							
            </div>            
        </div>
    </div>
</div>

<!--//////////////////////////// FIN MODALES GENERICOS ////////////////////////////////-->
<!--//////////////////////////// MODALES DE USUARIOS ////////////////////////////////-->


<!-- Modal Agregar Usuario -->
<div id="modal-agregar-usuario" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4>Agregar Usuario</h4>                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <br>
            <div class="panel-body">                        
                <form id="form-agregar-usuario"class="form-horizontal" role="form" action="#" enctype="multipart/form-data">
                    <!-- Nombre Persona  -->
                    <div class="row form-group">
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Nombre:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombrePersona" id="nombrePersona" class="form-control" >
                                <div id="errorNombrePersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>                                
                            </div>
                        </div>

                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Apellido:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="apellido" id="apellido" class="form-control" >
                                <div id="errorApellido" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un apellido v&aacute;lido
                                </div>                                
                            </div>
                        </div>                       

                    </div>


                    <div class="row form-group">
                        <!--Telefono-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Teléfono:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="telefono" id="telefono" class="form-control" >
                                <div id="errorTelefono" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un número de teléfono v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                        <!--Email-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Email:</span> </label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email" class="form-control" >
                                <div id="errorEmail" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una dirección de correo v&aacute;lida
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <!--Nombre Usuario-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Usuario:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" >
                                <div id="errorUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un usuario v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                        <!--password-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Contraseña:</span> </label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="password" class="form-control" >
                                <div id="errorPassword" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una contraseña v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">	
                <div class="form-actions text-right">
                    <span id="agregarUsuario" class="btn btn-primary">Agregar Usuario</span>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal Editar Usuarios -->

<div id="modal-editar-usuario" class="modal fade in" tabindex="-1" aria-hidden="false" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4>Modificar Usuario</h4>                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <br>
            <div class="panel-body">                        
                <form id="form-modificar-usuario" class="form-horizontal" role="form">
                    <!-- Nombre Persona  -->
                    <div class="row form-group">
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Nombre:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombrePersona_edit" id="nombrePersona_edit" class="form-control" >
                                <input type="hidden" name="idUsuarioModificar" id="idUsuarioModificar">
                                <div id="errorNombrePersona_edit" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>                                
                            </div>
                        </div>

                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Apellido:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="apellido_edit" id="apellido_edit" class="form-control" >
                                <div id="errorApellido_edit" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un apellido v&aacute;lido
                                </div>                                
                            </div>
                        </div>                       

                    </div>


                    <div class="row form-group">
                        <!--Telefono-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Teléfono:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="telefono_edit" id="telefono_edit" class="form-control" >
                                <div id="errorTelefono_edit" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un número de teléfono v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                        <!--Email-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Email:</span> </label>
                            <div class="col-sm-10">
                                <input type="email" name="email_edit" id="email_edit" class="form-control" >
                                <div id="errorEmail_edit" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una dirección de correo v&aacute;lida
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <!--Nombre Usuario-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Usuario:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombreUsuario_edit" id="nombreUsuario_edit" class="form-control" >
                                <div id="errorUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un usuario v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                        <!--password-->
                        <div class="col">
                            <label class="col-sm-2 control-label"><span>Contraseña:</span> </label>
                            <div class="col-sm-10">
                                <input type="password" name="password_edit" id="password_edit" class="form-control" >
                                <div id="errorPassword_edit" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una contraseña v&aacute;lido
                                </div>                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">	

                <div class="form-actions text-right">
                    <span id="modificarUsuarioBTN" class="btn btn-primary">Modificar</span>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>
</div>

<!--//////////////////////////// FIN MODALES USUARIOS ////////////////////////////-->

<!--//////////////////////////// INICIO MODAL EXPORTACION DE DATOS DE PRECIPITACIONES  ////////////////////////////-->

<!-- Modal Exportacion de datos de precipitaciones -->
<div id="modal-importar-precipitaciones" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4>Importar Precipitaciones</h4>                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <br>
            <div class="panel-body">                        
                <form id="form-importar-precipitaciones" class="form-horizontal" role="form" action="#" enctype="multipart/form-data">
                    <h6 style="padding-left: 3%;" >A continuacion debe proceder a cargar un archivo de Excel el cual tendra las precipitaciones</h6>                
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 5%;padding-right: 5%;">  
                            <div class="form-group label-floating has-feedback" style="border-style: dotted;" >     
                                <input type="file" name="fileXls" id="fileXls">
                                <div id="errorfileXls" class="btn-danger erroBoxs" style="display: none">
                                    Ingrese un xls para enviar.
                                </div> 
                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>                                
                            </div>    
                        </div>    

                    </div>
                </form>
            </div>
            <div class="modal-footer">	
                <div class="form-actions text-right">
                    <span id="importarPrecipitaciones" onclick="enviarXLSPrecipitacion();" class="btn btn-primary">Importar Precipitaciones</span>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!--//////////////////////////// FIN MODAL EXPORTACION DE DATOS DE PRECIPITACIONES  ////////////////////////////-->

<!-- Modal Agregar Precipitacion -->
<div id="modal-agregar-precipitacion" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4>Agregar Precipitacion</h4>                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <br>
            <div class="panel-body">                        
                <form id="form-agregar-precipitacion" class="form-horizontal" role="form" action="#" enctype="multipart/form-data">
                    <!--Fecha precipitacion  -->
                    <div class="row form-group">
                        <div class="col">
                            <label class="col-sm-12 control-label"><span>Fecha Precipitaci&oacute;n:</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="fechaPrecipitacion_add" id="fechaPrecipitacion_add" class="form-control" >
                                <div id="errorFechaPrecipitacion_add" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una fecha v&aacute;lida
                                </div>                                
                            </div>
                        </div>

                    </div>
                    <div class="row form-group">   
                        <!--cantidad de milimetros de lluvia-->
                        <div class="col">
                            <label class="col-sm-12 control-label"><span>Cantidad en Milimetros:</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="cantidadPrecipitcion_add" id="cantidadPrecipitcion_add" class="form-control" >
                                <div id="errorCantidadPrecipitcion_add" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una cantidad v&aacute;lida
                                </div>                                
                            </div>
                        </div>                       

                    </div>

                </form>
            </div>
            <div class="modal-footer">	
                <div class="form-actions text-right">
                    <span id="agregarPrecipitacion" onclick="add_precipitacion()" class="btn btn-primary">Agregar Precipitacion</span>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal Editar Precipitacion -->
<div id="modal-editar-precipitacion" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                
                <h4>Editar Precipitacion</h4>                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <br>
            <div class="panel-body">                        
                <form id="form-editar-precipitacion"class="form-horizontal" role="form" action="#" enctype="multipart/form-data">
                    <!--Fecha precipitacion  -->
                    <div class="row form-group">
                        <div class="col">
                            <label class="col-sm-12 control-label"><span>Fecha Precipitaci&oacute;n:</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="fechaPrecipitacion_editar" id="fechaPrecipitacion_editar" class="form-control" >
                                <div id="errorFechaPrecipitacion_editar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una fecha v&aacute;lida
                                </div>                                
                            </div>
                        </div>

                    </div>
                    <div class="row form-group">   
                        <!--cantidad de milimetros de lluvia-->
                        <div class="col">
                            <label class="col-sm-12 control-label"><span>Cantidad en Milimetros:</span> </label>
                            <div class="col-sm-6">
                                <input type="text" name="cantidadPrecipitcion_editar" id="cantidadPrecipitcion_editar" class="form-control" >
                                <div id="errorCantidadPrecipitcion_editar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una cantidad v&aacute;lida
                                </div>                                
                            </div>
                        </div>                       

                    </div>

                </form>
            </div>
            <div class="modal-footer">	
                <input type="hidden" id="idPrecipitacionEditar" name="idPrecipitacionEditar">
                <div class="form-actions text-right">
                    <span id="editarPrecipitacion" onclick="editar_precipitacion()" class="btn btn-primary">Editar Precipitacion</span>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>

