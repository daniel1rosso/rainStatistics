<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    protected $data = array(
        'active' => 'usuarios'
    );

    public function __construct() {
        parent::__construct();

        $this->load->helper('ckeditor');

        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'content',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "550px", //Setting a custom width
                'height' => '100px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
    }

    public function listar_usuarios() {
        $this->data['active'] = 'usuarios';

        $usuarios = $this->app_model->get_usuarios();
        $localidad = $this->app_model->get_localidades();
        $provincia = $this->app_model->get_provincias();

        $this->data['usuarios'] = $usuarios;
        $this->data['localidad'] = $localidad;
        $this->data['provincia'] = $provincia;

        $this->load_view('usuarios/listar_usuarios', $this->data);
    }

    public function add_usuario_post() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $nombre = $this->input->post('nombrePersona', true);
            $apellido = $this->input->post('apellido', true);
            $nombreUsuario = $this->input->post('nombreUsuario', true);
            $password = $this->input->post('password', true);
            $email = $this->input->post('email', true);
            $telefono = $this->input->post('telefono', true);
            $idGenUsuario = $this->generarID();

            if (!empty($telefono) && !empty($email) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password)) {
                $existe_usuario = $this->app_model->get_usuario_byUsuario($nombreUsuario);


                if ($existe_usuario == false) {

                    $result = $this->app_model->add_usuario($nombre, $apellido, $nombreUsuario, $password, $email, $telefono, $idGenUsuario);


                    if ($result) {
                        $usuario_agregado = $this->app_model->get_usuario_byIdGen($idGenUsuario);

                        $msg = "Usuario insertado con exito";
                        $dato = array("valid" => true, "msg" => $msg, "usuario" => $usuario_agregado);
                    } else {
                        $msg = "Error al insertar el usuario, vuelva a intentarlo";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Usuario existente, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {

            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }



        echo json_encode($dato);
    }

    public function add_usuario_perfil_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $id = $this->input->post('idUsuarioAgregar', true);
            $perfil = $this->input->post('fileUserAgregar', true);

            if (!empty($id)) {

                $nombreImg = substr(md5(microtime()), 15, 17);

                $file = 'fileUserAgregar';

                if (!empty($_FILES[$file]['name'])) {
                    $urlCarpeta = './uploads/perfil/' . $nombreImg;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                        mkdir($urlCarpeta . '/thumbs', 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;


                    $config['file_name'] = $nombreImg;


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $resultIMG = false;
                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $nombreImg = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];


                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $nombreImg;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                }

                $resultImg = $this->app_model->update_usuario_perfil($id, $nombreImg);

                if ($resultImg) {
                    $msg = "Usuario registrado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error con respecto a la imagen";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_usuario_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $id = $this->input->post('idUsuarioModificar', true);
            $nombre = $this->input->post('nombrePersona_edit', true);
            $apellido = $this->input->post('apellido_edit', true);
            $nombreUsuario = $this->input->post('nombreUsuario_edit', true);
            $password = $this->input->post('password_edit', true);
            $email = $this->input->post('email_edit', true);
            $telefono = $this->input->post('telefono_edit', true);

            if (!empty($id) && !empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($password) && !empty($email) && !empty($telefono)) {

                $this->app_model->update_usuario($id, $nombre, $apellido, $nombreUsuario, md5($password), $email, $telefono);
                $usuario_editado = $this->app_model->get_usuario_byId($id);
                $msg = "Se modificó el usuario con exito";
                $dato = array("valid" => true, "msg" => $msg, "usuario" => $usuario_editado);
            } else {
                $msg = "Datos vacios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_usuario() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idUsuario = $this->input->post('idUsuario', true);
        $msg = "";

        if (!empty($idUsuario)) {

            $result = $this->app_model->delete_usuario_by_idUsuario($idUsuario);

            if ($result) {
                $msg = "Usuario eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar el usuario, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_usuario_byId() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $id = $this->input->post('id', true);

            if (!empty($id)) {
                $result = $this->app_model->get_usuario_byId($id);

                if ($result) {
                    $msg = "Datos obtenidos con exito";
                    $dato = array("valid" => true, "msg" => $msg, "usuario" => $result);
                } else {
                    $msg = "Error al obtener los datos del usuario, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
