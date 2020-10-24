/////////////// DEFINIMOS (INICIALIZAMOS) LAS DATATABLES ///////////////
$(document).ready(function() {
    table_usuarios = $('#listado_usuarios').DataTable();
    table_precipitaciones = $('#listado_precipitaciones').DataTable();
});
////////////// USUARIOS DEL SISTEMA ////////////////////////
$(document).ready(function() {

    /**
     * Funcion para agregar un usuario en el sistema
     */
    //agregar usuario
    $('#agregarUsuario').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var nombrePersona = $('#nombrePersona').val();
        var apellido = $('#apellido').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var password = $('#password').val();
        password = md5(password);
        document.getElementById('password').value = password;
        //        console.log(encrypt);


        if (nombrePersona == null || nombrePersona.length == 0 || nombrePersona == '') {
            //            $("#errorNombrePersona").css("display", "block");
            val1 = false;
        } else {
            $("#errorNombrePersona").css("display", "none");
            val1 = true;
        }
        if (apellido == null || apellido.length == 0 || apellido == '') {
            //            $("#errorApellido").css("display", "block");
            val2 = false;
        } else {
            $("#errorApellido").css("display", "none");
            val2 = true;
        }

        if (email == null || email.length == 0 || email == '' || !(/\S+@\S+\.\S+/.test(email))) {
            //            $("#errorEmail").css("display", "block");
            val3 = false;
        } else {
            $("#errorEmail").css("display", "none");
            val3 = true;
        }
        if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
            //            $("#errorUsuario").css("display", "block");
            val4 = false;
        } else {
            //            $("#errorUsuario").css("display", "none");
            val4 = true;
        }
        if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
            //            $("#errorTelefono").css("display", "block");
            val5 = false;
        } else {
            //            $("#errorTelefono").css("display", "none");
            val5 = true;
        }

        if (password == null || password.length == 0 || password == '') {
            //            $("#errorPassword").css("display", "block");
            val6 = false;
        } else {
            $("#errorPassword").css("display", "none");
            val6 = true;
        }

        if (val1 && val2 && val3 && val4 && val5 && val6) {
            $("#modal-cargando").modal("show").css('z-index', '9999');
            $(".modal-backdrop").remove();
            var formData = new FormData($("#form-agregar-usuario")[0]);
            formData.append("psw", password);
            $.ajax({
                    url: URL + 'usuarios/add_usuario_post/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-agregar-usuario").modal("hide");
                        var table_usuarios = $('#listado_usuarios').DataTable();
                        var acciones = '';
                        acciones = '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Usuario"><i class="fa fa-edit"></i></a> &nbsp;' +
                            '<a onclick="eliminar_usuario(' + dato['usuario'][0]['idUsuario'] + ')"' + ' class="tip deleteUsuario" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';
                        var row = table_usuarios.row.add([
                            dato['usuario'][0]['idUsuario'],
                            dato['usuario'][0]['nombreCompleto'] + ', ' + dato['usuario'][0]['apellido'],
                            dato['usuario'][0]['usuario'],
                            dato['usuario'][0]['email'],
                            acciones
                        ]).draw(false);
                        row.nodes().to$().attr('id', 'fila' + dato['usuario'][0]['idUsuario']);
                        table_usuarios.row(row).column(0).nodes().to$().addClass('text-center');
                        table_usuarios.row(row).column(1).nodes().to$().addClass('text-center');
                        table_usuarios.row(row).column(2).nodes().to$().addClass('text-center');
                        table_usuarios.row(row).column(3).nodes().to$().addClass('text-center');
                        table_usuarios.row(row).column(4).nodes().to$().addClass('text-center');

                        swal({
                            position: 'top-end',
                            icon: 'success',
                            type: "success",
                            title: 'Usuario',
                            html: '<p>Usuario guardado con exito.</p>',
                            showConfirmButton: true
                        });
                    } else {
                        //mostramos sweet alert
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            type: "error",
                            title: 'Usuario',
                            html: '<p>' + dato['msg'] + '</p>',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function() {
                    $("#popUpError").modal("show");
                });
        } else {
            var errorUsuario = '';
            //            nombreC
            if (val1 == false) {
                errorUsuario += '<br>* Nombre ingresado es incorrecto.';
            }
            //                apellido
            if (val2 == false) {
                errorUsuario += '<br>* Apellido ingresado es incorrecto.';
            }
            //            email
            if (val3 == false) {
                errorUsuario += '<br>* Email ingresado es incorrecto.';
            }
            //           nombre usuario
            if (val4 == false) {
                errorUsuario += '<br>* Nombre Usuario ingresado es incorrecto.';
            }
            //            telefono
            if (val5 == false) {
                errorUsuario += '<br>* Teléfono ingresado es incorrecto.';
            }
            //            password
            if (val6 == false) {
                errorUsuario += '<br>* Ingrese una contraseña.';
            }


            swal({
                position: 'top-end',
                icon: 'error',
                type: "error",
                title: 'Usuario',
                html: '<p>' + errorUsuario + '</p>',
                showConfirmButton: true
            });
        }
    });
    /**Funcion
     * abrir el modal de usuarios y setear los datos en los campos para luego modificarlos
     */
    $("#listado_usuarios").on("click", "a.modificarUsuario", function(e) {
        var idUsuario = $(this).data('id');
        //        console.log(idUsuario);
        //        console.log('paso por aca y no tengo id');
        var dataString = 'id=' + idUsuario;
        $.ajax({
                url: URL + 'usuarios/get_usuario_byId/',
                type: 'POST',
                data: dataString
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-editar-usuario").modal("show");
                    document.getElementById("idUsuarioModificar").value = dato['usuario'][0]['idUsuario'];
                    document.getElementById("nombrePersona_edit").value = dato['usuario'][0]['nombreCompleto'];
                    document.getElementById("apellido_edit").value = dato['usuario'][0]['apellido'];
                    document.getElementById("telefono_edit").value = dato['usuario'][0]['telefono'];
                    document.getElementById("email_edit").value = dato['usuario'][0]['email'];
                    document.getElementById("nombreUsuario_edit").value = dato['usuario'][0]['usuario'];
                    document.getElementById("password_edit").value = dato['usuario'][0]['password'];
                } else {
                    //mostramos sweet alert
                    swal({
                        position: 'top-end',
                        icon: 'error',
                        type: "error",
                        title: 'Usuario',
                        html: '<p>Usuario seleccionado no encontrado.</p>',
                        showConfirmButton: true
                    });
                }
            })
            .fail(function() {
                //mostramos sweet alert
                swal({
                    position: 'top-end',
                    icon: 'error',
                    type: "error",
                    title: 'Usuario',
                    html: '<p>Ocurrio un error. Por favor contacte con el administrador del sistema.</p>',
                    showConfirmButton: true
                });;
            });
    });
    $('#modificarUsuarioBTN').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var id = $('#idUsuarioModificar').val();
        var nombrePersona = $('#nombrePersona_edit').val();
        var apellido = $('#apellido_edit').val();
        var telefono = $('#telefono_edit').val();
        var email = $('#email_edit').val();
        var nombreUsuario = $('#nombreUsuario_edit').val();
        var password = $('#password_edit').val();
        if (nombrePersona == null || nombrePersona == '') {

            val1 = false;
        } else {

            val1 = true;
        }
        if (apellido == null || apellido.length == 0 || apellido == '') {

            val2 = false;
        } else {

            val2 = true;
        }
        if (email == null || email.length == 0 || email == '' || !(/\S+@\S+\.\S+/.test(email))) {

            val3 = false;
        } else {

            val3 = true;
        }
        if (telefono == null || telefono.length == 0 || telefono == '') {

            val4 = false;
        } else {

            val4 = true;
        }


        if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {

            val5 = false;
        } else {

            val5 = true;
        }

        if (password == null || password.length == 0 || password == '') {

            val6 = false;
        } else {

            val6 = true;
        }


        if (val1 && val2 && val3 && val4 && val5 && val6) {

            var formData = new FormData($("#form-modificar-usuario")[0]);
            $.ajax({
                    url: URL + 'usuarios/modificar_usuario_post',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false

                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        //para ocultar el div
                        $("#modal-editar-usuario").modal("hide");
                        $('.modal-backdrop').remove();
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            type: "success",
                            title: 'Usuario',
                            html: '<p>Usuario modificado con exito.</p>',
                            showConfirmButton: true,
                        }).then((result) => {
                            table_usuarios.row('#fila' + dato['usuario'][0]['idUsuario']).remove().draw();
                            var acciones = '';
                            acciones = '<a class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Usuario"><i class="fa fa-edit"></i></a> &nbsp;' +
                                '<a onclick="eliminar_usuario(' + "'" + dato['usuario'][0]['idUsuario'] + "'" + ')"' + ' class="tip deleteUsuario" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';
                            var row = table_usuarios.row.add([
                                dato['usuario'][0]['idUsuario'],
                                dato['usuario'][0]['apellido'] + ', ' + dato['usuario'][0]['nombreCompleto'],
                                dato['usuario'][0]['usuario'],
                                dato['usuario'][0]['email'],
                                acciones
                            ]).draw(false);
                            row.nodes().to$().attr('id', 'fila' + dato['usuario'][0]['idUsuario']);
                            table_usuarios.row(row).column(0).nodes().to$().addClass('text-center');
                            table_usuarios.row(row).column(1).nodes().to$().addClass('text-center');
                            table_usuarios.row(row).column(2).nodes().to$().addClass('text-center');
                            table_usuarios.row(row).column(3).nodes().to$().addClass('text-center');
                            table_usuarios.row(row).column(4).nodes().to$().addClass('text-center');
                        });

                        swal({
                            position: 'top-end',
                            icon: 'success',
                            type: "success",
                            title: 'Usuario',
                            html: '<p>Se modificó el usuario con exito</p>',
                            showConfirmButton: true
                        });
                    } else {
                        //mostramos sweet alert
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            type: "error",
                            title: 'Usuario',
                            html: '<p>' + dato['msg'] + '</p>',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function() {
                    swal({
                        position: 'top-end',
                        icon: 'error',
                        type: "error",
                        title: 'Usuario',
                        html: '<p>Ocurrio un error. Contactar al Administrador del sistema.</p>',
                        showConfirmButton: true,
                    });
                });
        } else {

            var errorUsuario = '';
            //            nombreC
            if (val1 == false) {
                errorUsuario += '<br>* Nombre ingresado es incorrecto.';
            }
            //                apellido
            if (val2 == false) {
                errorUsuario += '<br>* Apellido ingresado es incorrecto.';
            }
            //            email
            if (val3 == false) {
                errorUsuario += '<br>* Email ingresado es incorrecto.';
            }
            //           nombre usuario
            if (val4 == false) {
                errorUsuario += '<br>* Teléfono ingresado es incorrecto.';
            }
            //            telefono
            if (val5 == false) {
                errorUsuario += '<br>* Nombre Usuario ingresado es incorrecto.';
            }
            //            password
            if (val6 == false) {
                errorUsuario += '<br>* Ingrese una contraseña.';
            }


            swal({
                position: 'top-end',
                icon: 'error',
                type: "error",
                title: 'Usuario',
                html: '<p>' + errorUsuario + '</p>',
                showConfirmButton: true
            });
        }
    });
});

function eliminar_usuario(idUsuario) {
    swal({
        type: "warning",
        title: "Usuario",
        text: "¿Desea eliminar el usuario?",
        width: "500px",
        confirmButtonText: 'Borrar',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.value) {

            $.ajax({
                    url: URL + 'usuarios/eliminar_usuario/',
                    type: 'POST',
                    cache: false,
                    data: {
                        idUsuario: idUsuario
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {

                        swal(
                            'Usuario',
                            'Usuario eliminado exitosamente',
                            'success'
                        )

                        $('#listado_usuarios').dataTable().fnDeleteRow("#fila" + idUsuario);
                    } else {
                        swal(
                            'Error!',
                            'No se pudo eliminar el usuario',
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    swal(
                        'Error!',
                        'No se pudo eliminar el usuario',
                        'error'
                    )
                });
        }
    })

}

/////////////////////////////////// FUNCIONES GENERALES ////////////////////////////////////////

//--- DROPDOWN MENU TABLE ---//
$(document).ready(function() {
    $('.table-responsive').on('show.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "inherit");
    });
    $('.table-responsive').on('hide.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "auto");
    })
})

/////////////////////////////////// FIN FUNCIONES GENERALES ////////////////////////////////////////

/////////////////////////////////// IMPORTACION DE DATOS ////////////////////////////////////////

function enviarXLSPrecipitacion() {
    var fileXLS = document.getElementById("fileXls");
    var val1;
    if (fileXLS.files.length == 0) {
        $("#errorfileXls").css("display", "none");
        var val1 = false;
    } else {
        $("#errorfileXls").css("display", "none");
        var val1 = true;
    }

    if (val1) {
        $("#modal-importar-precipitaciones").modal("hide");
        $(".modal-backdrop").remove();
        swal.showLoading();
        var formData = new FormData($("#form-importar-precipitaciones")[0]);
        $.ajax({
                url: URL + 'precipitaciones/importar_precipitaciones',
                type: 'POST',
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                console.log(dato);
                if (dato['valid']) {
                    //--- cerrar modal y vaciado de input ---//
                    document.getElementById('fileXls').value = "";
                    swal.close()
                    swal({
                        title: "Importacion exitosa",
                        text: "exitosa",
                        type: "info",
                        width: "380px",
                        html: "Las precipitaciones fueron registradas al sistema correctamente.",
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
                    })

                } else {
                    swal.close()

                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }
}

/////////////////////////////////// FIN IMPORTACION DE DATOS ////////////////////////////////////////

////////////////////////////////// INICIO AGREGAR PRECIPITACION ////////////////////////////////////
$(document).ready(function() {
    $('#fechaPrecipitacion_add').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaPrecipitacion_editar').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    // MOSTRAR MODAL EDITAR PRECIPITACION
    /**Funcion
     * abrir el modal de editar precipitaciones y setear los datos en los campos para luego modificarlos
     */
    $("#listado_precipitaciones").on("click", "a.modificarPrecipitacion", function(e) {
        var idPrecipitacion = $(this).data('id');
        var dataString = 'id=' + idPrecipitacion;
        $.ajax({
                url: URL + 'precipitaciones/get_precipitacion_byId/',
                type: 'POST',
                data: dataString
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    console.log(dato);
                    document.getElementById("idPrecipitacionEditar").value = dato['p'][0]['idPrecipitacion'];
                    document.getElementById("fechaPrecipitacion_editar").value = moment(dato['p'][0]['fechaPrecipitacion']).format('YYYY-MM-DD');
                    document.getElementById("cantidadPrecipitcion_editar").value = dato['p'][0]['cantidad'];
                    $("#modal-cargando").modal("hide");
                    $("#modal-editar-precipitacion").modal("show");
                } else {
                    //mostramos sweet alert
                    swal({
                        position: 'top-end',
                        icon: 'error',
                        type: "error",
                        title: 'Precipitación',
                        html: '<p>Precipitación seleccionada no encontrada.</p>',
                        showConfirmButton: true
                    });
                }
            })
            .fail(function() {
                //mostramos sweet alert
                swal({
                    position: 'top-end',
                    icon: 'error',
                    type: "error",
                    title: 'Presipitación',
                    html: '<p>Ocurrio un error. Por favor contacte con el administrador del sistema.</p>',
                    showConfirmButton: true
                });;
            });
    });
});

function add_precipitacion() {
    var fechaPrecipitacion = $("#fechaPrecipitacion_add").val();
    var cantidad = $("#cantidadPrecipitcion_add").val();
    var val1, val2;
    if (fechaPrecipitacion == 0 || fechaPrecipitacion == null || fechaPrecipitacion == ' ' || fechaPrecipitacion == '' || fechaPrecipitacion == undefined) {
        $("#errorFechaPrecipitacion_add").css("display", "none");
        val1 = false;
    } else {
        $("#errorFechaPrecipitacion_add").css("display", "none");
        val1 = true;
    }

    if (cantidad == null || cantidad == ' ' || cantidad == '' || cantidad == undefined) {
        $("#errorCantidadPrecipitcion_add").css("display", "none");
        val2 = false;
    } else {
        $("#errorCantidadPrecipitcion_add").css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        swal.showLoading();
        $.ajax({
                url: URL + 'precipitaciones/add_precipitacion_post',
                type: 'POST',
                data: {
                    fechaPrecipitacion: fechaPrecipitacion,
                    cantidad: cantidad
                },
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                console.log(dato);
                if (dato['valid']) {
                    $("#modal-agregar-precipitacion").modal("hide");
                    // se utiliza para sacar la pantalla negra que dejan los modales al cerrarse
                    $(".modal-backdrop").remove();
                    //--- cerrar modal y vaciado de input ---//
                    swal.close();
                    swal({
                        title: "Registro exitoso",
                        text: "Exito",
                        type: "info",
                        width: "380px",
                        html: "Precipitacion registrada con exito!",
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
                    });

                    var table_precipitaciones = $('#listado_precipitaciones').DataTable();
                    var acciones = '';

                    acciones = '<a href = "#modal-editar-precipitacion" class="tip modificarPrecipitacion" data-id="' + dato['p'][0]['idPrecipitacion'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Precipitacion"><i class="fa fa-edit"></i></a> &nbsp;' +
                        '<a onclick="eliminar_precipitacion(' + dato['p'][0]['idPrecipitacion'] + ')"' + ' class="tip deletePrecipitacion" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';

                    var row = table_precipitaciones.row.add([
                        dato['p'][0]['idPrecipitacion'],
                        dato['p'][0]['cantidad'],
                        moment(dato['p'][0]['fechaPrecipitacion']).format('DD-MM-YYYY'),
                        acciones
                    ]).draw(false);

                    row.nodes().to$().attr('id', 'fila' + dato['p'][0]['idPrecipitacion']);
                    table_precipitaciones.row(row).column(0).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(1).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(2).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(3).nodes().to$().addClass('text-center');

                    swal('Precipitación', dato['msg'], 'success');
                } else {
                    swal.close();
                    swal('Error', dato['msg'], 'error');
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }
}

/**
 * Funcion para editar una precipitacion existente en el sistema
 * @return {undefined}
 */

function editar_precipitacion() {

    var id = $('#idPrecipitacionEditar').val();
    var fechaPrecipitacion = $("#fechaPrecipitacion_editar").val();
    var cantidad = $("#cantidadPrecipitcion_editar").val();
    var val1, val2;
    if (fechaPrecipitacion == 0 || fechaPrecipitacion == null || fechaPrecipitacion == ' ' || fechaPrecipitacion == '' || fechaPrecipitacion == undefined) {
        $("#errorFechaPrecipitacion_add").css("display", "none");
        val1 = false;
    } else {
        $("#errorFechaPrecipitacion_add").css("display", "none");
        val1 = true;
    }

    if (cantidad == null || cantidad == ' ' || cantidad == '' || cantidad == undefined) {
        $("#errorCantidadPrecipitcion_add").css("display", "none");
        val2 = false;
    } else {
        $("#errorCantidadPrecipitcion_add").css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        swal.showLoading();
        $.ajax({
                url: URL + 'precipitaciones/editar_precipitacion_post',
                type: 'POST',
                data: {
                    id: id,
                    fechaPrecipitacion: fechaPrecipitacion,
                    cantidad: cantidad
                },
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                console.log(dato);
                if (dato['valid']) {

                    $("#modal-editar-precipitacion").modal("hide");

                    // se utiliza para sacar la pantalla negra que dejan los modales al cerrarse
                    $(".modal-backdrop").remove();

                    //--- cerrar modal y vaciado de input ---//
                    swal.close();
                    swal({
                        title: "Precipitación",
                        text: "Se registro la precipitación con exito",
                        type: "success",
                        width: "380px",
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
                    });

                    var table_precipitaciones = $('#listado_precipitaciones').DataTable();

                    table_precipitaciones.row('#fila' + dato['p'][0]['idPrecipitacion']).remove().draw();

                    var acciones = '';

                    acciones = '<a class="tip modificarPrecipitacion" data-id="' + dato['p'][0]['idPrecipitacion'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Precipitacion"><i class="fa fa-edit"></i></a> &nbsp;' +
                        '<a onclick="eliminar_precipitacion(' + dato['p'][0]['idPrecipitacion'] + ')"' + ' class="tip deletePrecipitacion" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';

                    var row = table_precipitaciones.row.add([
                        dato['p'][0]['idPrecipitacion'],
                        dato['p'][0]['cantidad'],
                        moment(dato['p'][0]['fechaPrecipitacion']).format('DD-MM-YYYY'),
                        acciones
                    ]).draw(false);

                    row.nodes().to$().attr('id', 'fila' + dato['p'][0]['idPrecipitacion']);
                    table_precipitaciones.row(row).column(0).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(1).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(2).nodes().to$().addClass('text-center');
                    table_precipitaciones.row(row).column(3).nodes().to$().addClass('text-center');
                } else {
                    swal.close();
                    swal(
                        'Precipitación',
                        dato['msg'],
                        'error'
                    )
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }

}

function eliminar_precipitacion(id) {
    swal.showLoading();
    swal({
        type: "warning",
        title: "Precipitación",
        text: "¿Desea eliminar la precipitación?",
        width: "500px",
        confirmButtonText: 'Borrar',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        preConfirm: (login) => {
            $.ajax({
                    url: URL + 'precipitaciones/eliminar_precipitacion',
                    type: 'POST',
                    data: { id: id }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    console.log(dato);
                    if (dato['valid']) {
                        //--- cerrar modal y vaciado de input ---//
                        swal.close();
                        swal({
                            title: "Registro eliminado",
                            type: "success",
                            width: "380px",
                            html: "Precipitación eliminada con exito",
                            showCancelButton: false,
                            confirmButtonText: 'Cerrar',
                        });

                        var table_precipitaciones = $('#listado_precipitaciones').DataTable();

                        table_precipitaciones.row('#fila' + id).remove().draw();
                    } else {
                        swal.close();
                        swal(
                            'Precipitación',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });

        },
    })

}

//////////////////////////////////////7 ESTADISTICAS //////////////////////////////////////

//--- PROVINCIA/LOCALIDAD ---//

$(document).ready(function() {
    $("#selectProvincia").change(function() {
        $("#selectProvincia option:selected").each(function() {
            idProvincia = $('#selectProvincia').val();
            $.post(URL + 'admin/busca_localidad', {
                idProvincia: idProvincia
            }, function(data) {
                document.getElementById("selectLocalidad").value = "";
                $("#selectLocalidad").html(data);
            });
        });
    })
});
//--- MES/DIA ---//

$(document).ready(function() {
    $("#selectMesPrecipitacion").change(function() {
        $("#selectMesPrecipitacion option:selected").each(function() {

            var mesSelect = $('#selectMesPrecipitacion').val();
            var cantidadDias = 0;
            if (mesSelect == 2) {
                cantidadDias = 30;
            }

            if (mesSelect == 1 || mesSelect == 3 || mesSelect == 5 || mesSelect == 7 || mesSelect == 8 || mesSelect == 10 || mesSelect == 12) {
                cantidadDias = 32;
            }

            if (mesSelect == 4 || mesSelect == 6 || mesSelect == 9 || mesSelect == 11) {
                cantidadDias = 31;
            }

            var dias_option = '';
            for (var i = 1, cantidadDias; i < cantidadDias; i++) {

                if (i > 0 && i < 10) {
                    dias_option += '<option value="0' + i + '">' + i + '</option>';
                } else {
                    dias_option += '<option value="' + i + '">' + i + '</option>';
                }
            }
            document.getElementById("selectDiaPrecipitacion").value = "";
            $("#selectDiaPrecipitacion").html(dias_option);

        });
    })
});

function dame_color_aleatorio() {
    hexadecimal = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F")
    color_aleatorio = "#";
    for (i = 0; i < 6; i++) {
        posarray = aleatorio(0, hexadecimal.length)
        color_aleatorio += hexadecimal[posarray]
    }
    return color_aleatorio
}

function aleatorio(inferior, superior) {
    numPosibilidades = superior - inferior
    aleat = Math.random() * numPosibilidades
    aleat = Math.floor(aleat)
    return parseInt(inferior) + aleat
}

$(document).ready(function() {

    $("#btnBuscarPromedio").click(function(e) {
        var dia = $('#selectDiaPrecipitacion').val();
        var mes = $('#selectMesPrecipitacion').val();
        console.log(mes);
        console.log(dia);

        var val1;

        if (mes != 0 || mes != undefined) {
            val1 = true;
        } else {
            val1 = false;
        }

        if (val1) {

            var fecha = mes + '-' + dia;
            swal.showLoading();
            $.ajax({
                    url: URL + 'estadisticas/promedioPrecipitacion',
                    type: 'POST',
                    data: {
                        fecha: fecha
                    },
                    //necesario para subir archivos via ajax
                    //            cache: false,
                    //            contentType: false,
                    //            processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    console.log(dato);
                    if (dato['valid']) {

                        $('#delete_grafico').remove(); //Eliminamos el div
                        $('#delete_grafico_promedios').remove(); //Eliminamos el div
                        $('#noP').remove(); //Eliminamos el div

                        //--- cerrar modal y vaciado de input ---//
                        swal.close();

                        if (dato['promedioPrecipitaciones'] != 0) {

                            var fieldHTML = '<div id="delete_grafico_promedios"><div class="row" style="text-align: center; margin-top: 75px;">';
                            fieldHTML += '<div class="col"><h2 id="promedio_historico"></h2><spam id="promedioHistorico"></spam></div></div>';
                            fieldHTML += '<div class="row" style="text-align: center; margin-top: 50px;"><div class="col"><h2 id="moda_historica"></h2>';
                            fieldHTML += '<spam id="modaHistorica"></spam></div></div></div>';

                            $('#agregar_promedio').append(fieldHTML); // Añadimos el HTML

                            var fieldHTML = '<div id="delete_grafico">';
                            fieldHTML += '<div class="chart-area">';
                            fieldHTML += '<canvas id="promedioPrecipitacionesPorDia" style="width:15%; height:15%;" ></canvas>';
                            fieldHTML += '</div></div>';
                            $('#agregar_grafico').append(fieldHTML); // Añadimos el HTML

                            var ctx = document.getElementById('promedioPrecipitacionesPorDia').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: dato['array_anios'],
                                    datasets: [{
                                        label: 'ML historicos a la fecha ' + fecha,
                                        data: dato['array_cantidades'],
                                        backgroundColor: 'rgba(52, 91, 204, 0.4)',
                                        borderColor: 'rgba(52, 91, 204, 0.8)',
                                        borderWidth: 2
                                    }]
                                },
                                options: {

                                }
                            });

                            /// SETEAMOS EL PROMEDIO Y LA MODA
                            document.getElementById('promedio_historico').innerHTML = round(dato['promedioPrecipitaciones'], 2);
                            document.getElementById('promedioHistorico').innerHTML = 'PROMEDIO HISTORICO';
                            document.getElementById('moda_historica').innerHTML = round(dato['moda'], 2);
                            document.getElementById('modaHistorica').innerHTML = 'MODA HISTORICA';


                        } else {

                            var fieldHTML = '<div id="noP" class="row" style="text-align: center; margin-top: 75px;">';
                            fieldHTML += '<div class="col"><h2>ERROR !</h2><spam>NO EXISTEN PRECIPITACIONES PARA LA FECHA SELECCIONADA</spam>';
                            fieldHTML += '</div></div>';
                            $('#error_no_precipitaciones').append(fieldHTML); // Añadimos el HTML




                        }
                    } else {
                        swal.close();
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});

function round(num, decimales = 2) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) //con 0 decimales
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

$(document).ready(function() {
    var URLactual = window.location
    if (URLactual['href'] == "http:" + URL + "estadisticas" || URLactual['href'] == "http:" + URL + "estadisticas/" || URLactual['href'] == "https:" + URL + "estadisticas" || URLactual['href'] == "https:" + URL + "estadisticas/") {
        $.ajax({
                url: URL + 'estadisticas/promedioPrecipitacionesMensuales',
                type: 'POST'
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                console.log(dato);
                if (dato['valid']) {
                    //--- cerrar modal y vaciado de input ---//
                    var ctx = document.getElementById('promedioPrecipitacionesMensuales').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            datasets: [{
                                label: 'ML historicos mensuales ',
                                data: dato['array_cantidades'],
                                backgroundColor: 'rgba(52, 91, 204, 0.4)',
                                borderColor: 'rgba(52, 91, 204, 0.8)',
                                borderWidth: 2
                            }]
                        }
                    });
                } else {
                    swal.close();
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }

});

//--- Vaciado de campos y apertura del modal para una nueva presipitacion ---//
function vaciado_apertura_modal_new_precipitacion() {
    $("#form-agregar-precipitacion").trigger("reset");
    //    $('#modal-agregar-precipitacion').modal("show");

}
//--- Fin vaciado de campos y apertura del modal para una nueva presipitacion ---//