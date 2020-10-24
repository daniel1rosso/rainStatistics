$(document).ready(function () {    
     //cuando cambie el select seteo el precio de la comida     
    $("#selectComidaPedido").change(function () {
        $("#selectComidaPedido option:selected").each(function () {
            idComida = $('#selectComidaPedido').val();
            $.post(URL + 'comidas/get_comida_byId', {
                id: idComida
            }, function (data) {
                 var dato = JSON.parse(data);
                document.getElementById("totalPedido").value = dato['c'][0]['precio'];
                document.getElementById("totalPedido_post").value = dato['c'][0]['precio'];
            });
        });
    });
});

function realizar_pedido() {
    var val1;
    var val2;
    var val3;
    var val4;
    var val5;
    var val6;
    var val7;
    var val8;


    var comida = $('#selectComidaPedido').val();
    var comentario = $('#comentarioPedido').val();
    var total = $('#totalPedido').val();
    var formaPago = $('#selectFormaPago').val();


    var nombre = $('#nombrePedido').val();
    var apellido = $('#apellidoPedido').val();
    var domicilio = $('#domicilioPedido').val();
    var telefono = $('#telefonoPedido').val();

    if (nombre == null || nombre.length == 0 || nombre == '') {

        val1 = false;
    } else {

        val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == '') {
        val2 = false;
    } else {

        val2 = true;
    }

    if (domicilio == null || domicilio.length == 0 || domicilio == '') {
        val3 = false;
    } else {
        val3 = true;
    }


    if (formaPago == null || formaPago == 0 || formaPago == '') {
        val4 = false;
    } else {
        val4 = true;
    }

    if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
        val5 = false;
    } else {
        val5 = true;
    }

    if (total == null || total.length == 0 || total == '') {
        val6 = false;
    } else {
        val6 = true;
    }
    
//    if (comentario == null || comentario.length == 0 || comentario == '') {
//        val7 = false;
//    } else {
//        val7 = true;
//    }
    
    if (comida == null || comida == 0 || comida == '') {
        val8 = false;
    } else {
        val8 = true;
    }

    if (val1 && val2 && val3 && val4 && val5 && val6 && val8) {
//        $("#modal-cargando").modal("show").css('z-index', '9999');
        $(".modal-backdrop").remove();
        var formData = new FormData($("#form-realizar-pedido")[0]);

        $.ajax({
            url: URL + 'dashboard_publico/realizar_pedido/',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
                .done(function (data) {
                    var dato = JSON.parse(data);

                    if (dato['valid']) {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            type: "success",
                            title: 'Exito!',
                            html: '<p>Pedido realizado con exito.</p>',
                            showConfirmButton: true,
                            timer: 4000
                        }).then((result) => {
                            //pedido enviado con exito seteo los campos en blanco

                        });


                    } else {

                        //mostramos sweet alert
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            type: "error",
                            title: 'Upss!',
                            html: '<p>' + dato['msg'] + '</p>',
                            showConfirmButton: true,
                            timer: 4000
                        });

                    }
                })
                .fail(function () {
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
            errorUsuario += '<br>* Domicilio ingresado es incorrecto.';

        }
//           nombre usuario
        if (val4 == false) {
            errorUsuario += '<br>* Forma de pago ingresado es incorrecto.';

        }
//            telefono
        if (val5 == false) {
            errorUsuario += '<br>* Teléfono ingresado es incorrecto.';
        }
//            password
        if (val6 == false) {
            errorUsuario += '<br>* Total ingresado es incorrecto.';
        }
        
        if (val8 == false) {
            errorUsuario += '<br>* Comida ingresada es incorrecta.';
        }


        swal({
            position: 'top-end',
            icon: 'error',
            type: "error",
            title: 'Upss!',
            html: '<p>' + errorUsuario + '</p>',
            showConfirmButton: true,
            timer: 4000
        });



    }
}