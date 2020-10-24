<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Precipitaciones extends MY_Controller {

    protected $data = array(
        'active' => 'precipitaciones'
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

    public function listar_precipitaciones() {
        $this->data['active'] = 'precipitaciones';

        $this->load_view('precipitaciones/listar_precipitaciones', $this->data);
    }

    public function listar_precipitaciones_table() {
        //--- Datos ---//
        $precipitaciones = $this->app_model->get_precipitaciones();

        if (!empty($precipitaciones)) {
            foreach ($precipitaciones as $value) {

                $opciones = '<a href = "#modal-editar-precipitacion" class = "tip modificarPrecipitacion" data-id = "' . $value['idPrecipitacion'] . '" data-toggle = "modal" style = "color: #4e73df;" data-original-title = "Editar"><i class = "fas fa-edit"></i></a>' .
                        '&nbsp;' .
                        '<a class = "tip" role = "button" onclick = "eliminar_precipitacion(' . $value['idPrecipitacion'] . ')" data-toggle = "modal" style = "color: #4e73df;" data-original-title = "Eliminar"><i class = "fas fa-trash"></i></a>';

                $dato[] = array(
                    $value['idPrecipitacion'],
                    $value['cantidad'],
                    date("d-m-Y", strtotime($value['fechaPrecipitacion'])),
                    $opciones,
                    "DT_RowId" => "fila" . $value['idPrecipitacion']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato
        );
        echo json_encode($aa);
    }

    public function add_precipitacion_post() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $fecha = $this->input->post('fechaPrecipitacion', true);
            $cantidad = $this->input->post('cantidad', true);
            $idGenPrecipitacion = $this->generarID();

            if (!empty($cantidad) && !empty($fecha)) {

                $result = $this->app_model->insert_precipitacion($cantidad, $fecha, $idGenPrecipitacion);
                $p_agregada = $this->app_model->get_precipitacion_byIdGen($idGenPrecipitacion);

                if ($result) {
                    $msg = "Precipitación registrada con exito";
                    $dato = array("valid" => true, "msg" => $msg, "p" => $p_agregada);
                } else {
                    $msg = "Ha ocurrido un error en la insercción, vuelva a intentarlo";
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

    public function editar_precipitacion_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $idPrecipitacion = $this->input->post('id', true);
            $cantidad = $this->input->post('cantidad', true);
            $fecha = $this->input->post('fechaPrecipitacion', true);

            if (!empty($idPrecipitacion) && !empty($cantidad) && !empty($fecha)) {

                $this->app_model->update_precipitacion($idPrecipitacion, $cantidad, $fecha);
                $p_editada = $this->app_model->get_precipitacion_byId($idPrecipitacion);

                $msg = "Precipitacion modificada con exito";
                $dato = array("valid" => true, "msg" => $msg, "p" => $p_editada);
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

    public function eliminar_precipitacion() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        $idPrecipitacion = $this->input->post('id', true);

        if (!empty($idPrecipitacion)) {
            $result = $this->app_model->delete_precipitacion($idPrecipitacion);

            if ($result) {
                $msg = "Precipitación eliminada con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar registro, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }
        echo json_encode($dato);
    }

    public function get_precipitacion_byId() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $id = $this->input->post('id', true);

            if (!empty($id)) {
                $precipitacion = $this->app_model->get_precipitacion_byId($id);

                if ($precipitacion) {
                    $msg = "Precipitaciones obtenidas con exito";
                    $dato = array("valid" => true, "msg" => $msg, "p" => $precipitacion);
                } else {
                    $msg = "Error de sistema. Contacte con el Administrador.";
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

    public function importar_precipitaciones() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        $path = './uploads/precipitaciones/';
        require_once( APPPATH . 'third_party/PHPExcel-master/Classes/PHPExcel.php');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileXls')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (empty($error)) {
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $flag = true;
                $i = 1;
                $j = 0;
                $cantidad_update = 0;
                $transaccionsaldadadocount = 0;

//--- Recorro el archivo que se encuentra en el input ---//
                foreach ($allDataInSheet as $key => $value) {
                    if ($key == 1) {
//--- Obtencion de año ---//
                        $anio = $value["A"];
                    } else {
//--- Obtencion y transformacion de mes ---//
                        if ($value["A"] == "Enero") {
                            $mes = "/01/";
                        } elseif ($value["A"] == "Febrero") {
                            $mes = "/02/";
                        } elseif ($value["A"] == "Marzo") {
                            $mes = "/03/";
                        } elseif ($value["A"] == "Abril") {
                            $mes = "/04/";
                        } elseif ($value["A"] == "Mayo") {
                            $mes = "/05/";
                        } elseif ($value["A"] == "Junio") {
                            $mes = "/06/";
                        } elseif ($value["A"] == "Julio") {
                            $mes = "/07/";
                        } elseif ($value["A"] == "Agosto") {
                            $mes = "/08/";
                        } elseif ($value["A"] == "Septiembre") {
                            $mes = "/09/";
                        } elseif ($value["A"] == "Octubre") {
                            $mes = "/10/";
                        } elseif ($value["A"] == "Noviembre") {
                            $mes = "/11/";
                        } elseif ($value["A"] == "Diciembre") {
                            $mes = "/12/";
                        }

//--- Armado de fecha e insercion de datos ---//
                        $fecha = $anio . $mes . "01";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["B"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "02";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["C"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "03";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["D"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "04";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["E"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "05";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["F"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "06";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["G"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "07";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["H"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "08";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["I"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "09";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["J"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "10";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["K"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "11";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["L"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "12";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["M"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "13";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["N"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "14";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["O"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "15";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["P"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "16";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["Q"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "17";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["R"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "18";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["S"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "19";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["T"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "20";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["U"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "21";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["V"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "22";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["W"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "23";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["X"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "24";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["Y"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "25";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["Z"], $fecha, $idGenPrecipitacion);

                        $fecha = $anio . $mes . "26";
                        $idGenPrecipitacion = $this->generarID();
                        $this->app_model->insert_precipitacion($value["AA"], $fecha, $idGenPrecipitacion);

                        if ($value["AB"] != "-") {
                            $fecha = $anio . $mes . "27";
                            $idGenPrecipitacion = $this->generarID();
                            $this->app_model->insert_precipitacion($value["AB"], $fecha, $idGenPrecipitacion);
                        }

                        if ($value["AC"] != "-") {
                            $fecha = $anio . $mes . "28";
                            $idGenPrecipitacion = $this->generarID();
                            $this->app_model->insert_precipitacion($value["AC"], $fecha, $idGenPrecipitacion);
                        }

                        if ($value["AD"] != "-") {
                            $fecha = $anio . $mes . "29";
                            $idGenPrecipitacion = $this->generarID();
                            $this->app_model->insert_precipitacion($value["AD"], $fecha, $idGenPrecipitacion);
                        }

                        if ($value["AE"] != "-") {
                            $fecha = $anio . $mes . "30";
                            $idGenPrecipitacion = $this->generarID();
                            $this->app_model->insert_precipitacion($value["AE"], $fecha, $idGenPrecipitacion);
                        }

                        if ($value["AF"] != "-") {
                            $fecha = $anio . $mes . "31";
                            $idGenPrecipitacion = $this->generarID();
                            $this->app_model->insert_precipitacion($value["AF"], $fecha, $idGenPrecipitacion);
                        }
                    }
                }


                $msg = "Importación de datos exitosa";
                $dato = array("valid" => true, "msg" => $msg);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
        } else {
            $msg = "Error " . $error['error'];
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function promedio_precipitacion_historico() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

//la fecha sin año, solamente contiene mes y dia
        $fechaPrecipitacion = $this->input->post('fechaPrecipitacion', true);

        if (!empty($fechaPrecipitacion)) {
// se buscan todas las cantidades en la fecha recibida y luego se manipulan los datos
            $result = $this->app_model->delete_precipitacion($fechaPrecipitacion);

            if ($result) {
                $msg = "Registro eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar registro, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }
        echo json_encode($dato);
    }

}
