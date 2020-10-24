<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_publico extends MY_Controller {

    protected $data = array(
        'active' => 'dashboard_public'
    );

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['active'] = 'dashboard_public';
        $comidas = $this->app_model->get_comidas();
        $this->data['comidas'] = $comidas;

        $this->load_view_public('dashboard_public', $this->data);
    }

    public function realizar_pedido() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $nombre = $this->input->post('nombrePedido', true);
            $apellido = $this->input->post('apellidoPedido', true);
            $domicilio = $this->input->post('domicilioPedido', true);
            $telefono = $this->input->post('telefonoPedido', true);

            $comida = $this->input->post('selectComidaPedido', true);
            $comentario = $this->input->post('comentarioPedido', true);
            $total = $this->input->post('totalPedido_post', true);
            $formaPago = $this->input->post('selectFormaPago', true);
            $idGenPedido = $this->generarID();


            if (!empty($nombre) && !empty($apellido) && !empty($domicilio) 
                    && !empty($telefono) && !empty($comida) && !empty($total) && !empty($formaPago)) {


                $result = $this->app_model->add_pedido_public($nombre, $apellido, $domicilio,
                        $telefono, $comida, $comentario, $total, $formaPago, $idGenPedido);

                if ($result) {

                    $msg = "Todo ok";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Ha ocurrido un error en la inserccion";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {

            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }



        echo json_encode($dato);
    }

}
