<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.flaticon.com/icons/svg/1384/1384676.svg" alt=""/>
            <h3>Fast Food</h3>
            <p style="padding: 5px; text-align: left; margin-top: 10px;">1) Realiza tu pedido !</p>
            <p style="padding: 5px;text-align: left;">2) Completa tus datos !</p>
            <p style="padding: 5px;text-align: left;">3) Esperar al cadete !</p>
            <p style="padding: 5px;text-align: left;">4) Es as&iacute; de f&aacute;cil y r&aacute;pido!</p>
            <button type="button" onclick="location.href = '<?= $url ?>'" class="btn btn-light">Login</button>
        </div>
        <div class="col-md-9 register-right">
            <form id="form-realizar-pedido" class="form-horizontal" role="form" action="#" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">REALIZAR PEDIDO</h3>
                        <div class="row register-form">
                            <input type="hidden" class="form-control" name="totalPedido_post" id="totalPedido_post">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="selectComidaPedido" id="selectComidaPedido" class="form-control">
                                        <option value="0" class="hidden"  selected disabled>Qu&eacute; vas a pedir?</option>
                                        <?php
                                        if (!empty($comidas)) {
                                            foreach ($comidas as $key => $value) :
                                                echo '<option value="' . $value['idComida'] . '">' . $value['nombre'] . '</option>';
                                            endforeach;
                                        }
                                        ?> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" minlength="10" maxlength="10" name="comentarioPedido" id="comentarioPedido" class="form-control" placeholder="Realiza un comentario (opcional)" value="" />
                                </div>
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-5" style="padding-right: 5px;">
                                            <label for="totalPedido">Total: $ARS</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" disabled="true" name="totalPedido" id="totalPedido" placeholder="$" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select id="selectFormaPago" name="selectFormaPago" class="form-control">
                                        <option value="0" class="hidden"  selected disabled>Como vas a pagar?</option>
                                        <option value="1">Efectivo</option>
                                        <option value="2">Tarjeta de d&eacute;bito</option>
                                        <option value="3">Tarjeta de cr&eacute;dito</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombrePedido" id="nombrePedido" placeholder="Tu nombre *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="apellidoPedido" id="apellidoPedido" placeholder="Tu apellido *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="domicilioPedido" id="domicilioPedido" placeholder="Tu domicilio *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="telefonoPedido" id="telefonoPedido"  placeholder="Tu tel&eacute;fono *" value="" />
                                </div>

                                <button type="button" onclick="realizar_pedido()" class="btn btn-primary">Realizar Pedido</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>