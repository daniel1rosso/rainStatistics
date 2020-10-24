<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function index() {
        $data['user'] = false;
        $data['password'] = false;
        $this->load_view('login', $data);
    }

    public function login() {
        $user = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        if (empty($user) || empty($password)) {
            $data['user'] = (empty($user)) ? null : $user;
            $data['password'] = (empty($password)) ? null : $password;
            $this->load_view('login', $data);
        } else {
            $result = $this->app_model->compare_user_password($user, md5($password));
            if ($result) {
                $user_session = array(
                    'idUsuario' => $result[0]['idUsuario'],                   
                    'apellido' => $result[0]['apellido'],
                    'nombreCompleto' => $result[0]['nombreCompleto'],
                    'email' => $result[0]['email'],
                    'usuario' => $result[0]['usuario'],
                    
                    'logged_in' => true
                );
                $this->app_model->set_log_usuario($user_session['idUsuario'], $user_session['nombreCompleto'] . ' ' . $user_session['apellido']);

                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;

                redirect('/dashboard');
            } else {
                $data['user'] = $user;
                $this->load_view('login', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/admin');
    }

    public function busca_localidad() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idProvincia = $this->input->post('idProvincia', true);
        $localidades = $this->app_model->get_localidades_by_provincia($idProvincia);

        echo '<option></option>';
        foreach ($localidades as $key) {
            echo '<option value="' . $key['idLocalidad'] . '">' . $key['localidad'] . '</option>';
        }
    }

    public function buscar_localidad($idProvincia) {
        $localidades = $this->app_model->get_localidades_byIdProvincia($idProvincia);
        $this->data['localidad']->$localidades;
    }

}
