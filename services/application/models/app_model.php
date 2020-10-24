<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model extends CI_Model {

    public function compare_user_password($user, $password) {
        $values = array(
            'usuario' => $user,
            'password' => $password
        );
        $this->db->where($values);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    public function get_usuario_info($idUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_localidades() {
        $this->db->select('*');
        $this->db->from('localidades');

        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_provincias() {
        $this->db->select('*');
        $this->db->from('provincias');

        $result = $this->db->get();
        return $result->result_array();
    }

    public function set_usuario($usuario, $password, $nombre, $apellido, $email, $telefono, $provincia, $localidad) {
        $values = array(
            'usuario' => $usuario,
            'password' => $password,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'telefono' => $telefono,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad
        );
        $result = $this->db->insert('usuarios', $values);
    }

    public function get_sexo() {
        $this->db->select('*');
        $this->db->from('sexo');
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function set_log_usuario($idUser, $nombreUser) {
        $values = array(
            'idUsuarioLog' => $idUser,
            'usuarioLog' => $nombreUser
        );
        $result = $this->db->insert('session_logs', $values);
    }

    public function get_usuario_byId($idUsuario) {
        $this->db->select('
            idUsuario,            
            nombreCompleto,
            apellido,
            usuario,
            password,
            email,
            telefono
        ');
        $this->db->from('usuarios');
        $this->db->where('usuarios.eliminado', 0);
        $this->db->where('usuarios.idUsuario', $idUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_usuario_byIdGen($idGenUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('eliminado', 0);
        $this->db->where('idGenUsuario', $idGenUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    public function get_usuario_byUsuario($nombreUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('eliminado', 0);
        $this->db->where('usuario', $nombreUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? true : false;
    }

    public function delete_usuario_by_idUsuario($idUsuario) {

        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function update_usuario($id, $nombre, $apellido, $nombreUsuario, $password, $email, $telefono) {
        $values = array(
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'email' => $email,
            'telefono' => $telefono,
            'eliminado' => 0
        );
        $this->db->where('idUsuario', $id);
        $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : true;
    }

    public function add_usuario($nombre, $apellido, $nombreUsuario, $password, $email, $telefono, $idGenUsuario) {
        $values = array(
            'email' => $email,
            'telefono' => $telefono,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'idGenUsuario' => $idGenUsuario,
            'eliminado' => 0
        );
        $result = $this->db->insert('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    public function get_usuarios() {
        $this->db->select('
            idUsuario,
            nombreCompleto,
            apellido,
            usuario,
            password,
            usuarios.eliminado,
            email,
            telefono
        ');
        $this->db->from('usuarios');
        $this->db->where('usuarios.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Insercion de las precipitaciones
     * @param type $precipitacion
     * @param type $fecha
     * @return type
     */
    public function insert_precipitacion($cantidad, $fecha, $idGenPrecipitacion) {
        $values = array(
            'cantidad' => $cantidad,
            'idGenPrecipitacion' => $idGenPrecipitacion,
            'fechaPrecipitacion' => $fecha
        );
        $result = $this->db->insert('precipitaciones', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * editar una precipitacion
     * @param type $idPrecipitacion
     * @param type $cantidad
     * @param type $fecha
     * @return type
     */
    public function update_precipitacion($idPrecipitacion, $cantidad, $fecha) {
        $values = array(
            'cantidad' => $cantidad,
            'fechaPrecipitacion' => $fecha
        );
        $this->db->where('idPrecipitacion', $idPrecipitacion);
        $result = $this->db->update('precipitaciones', $values);

        return (($this->db->affected_rows() > 0) ? true : true);
    }

    public function get_precipitaciones() {
        $this->db->select('*');
        $this->db->from('precipitaciones');
        $this->db->where('eliminado', 0);

        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_precipitaciones_like_fecha($fecha) {
        $this->db->select('*');
        $this->db->from('precipitaciones');
        $this->db->like('fechaPrecipitacion', $fecha, 'both');
        $this->db->where('eliminado', 0);

        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_precipitacion_byIdGen($idGenPrecipitacion) {
        $this->db->select('*');
        $this->db->from('precipitaciones');
        $this->db->where('idGenPrecipitacion', $idGenPrecipitacion);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_precipitacion_byId($idPrecipitacion) {
        $this->db->select('*');
        $this->db->from('precipitaciones');
        $this->db->where('idPrecipitacion', $idPrecipitacion);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function delete_precipitacion($idPrecipitacion) {
        $values = array(
            'eliminado' => 1
        );
        $this->db->where('idPrecipitacion', $idPrecipitacion);
        $result = $this->db->update('precipitaciones', $values);

        return (($this->db->affected_rows() > 0) ? true : true);
    }

}
