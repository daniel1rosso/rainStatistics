<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estadisticas extends MY_Controller {

    protected $data = array(
        'active' => 'estadisticas'
    );

    public function index() {

        $this->load_view('estadisticas/estadisticas_precipitaciones', $this->data);
    }

    public function promedioPrecipitacion() {
        $fecha = $this->input->post('fecha', true);

        $precipitaciones_fecha = $this->app_model->get_precipitaciones_like_fecha($fecha);

        if ($precipitaciones_fecha) {

            $cantitadPrecipitaciones = count($precipitaciones_fecha);
            $acu_cantidad = 0;
            $moda = 0;
            $array_cantidades = [];
            $array_anios = [];
            foreach ($precipitaciones_fecha as $value) {
                $acu_cantidad += $value['cantidad'];
                array_push($array_cantidades, $value['cantidad']);
                array_push($array_anios, date("Y", strtotime($value['fechaPrecipitacion'])));
            }

            $promedioPrecipitaciones = $acu_cantidad / $cantitadPrecipitaciones;

            $cuenta = array_count_values($array_cantidades);
            arsort($cuenta);
            $moda = key($cuenta);

            $msg = "Correcto.";
            $dato = array("valid" => true, "msg" => $msg, "precipitaciones_fecha" => $precipitaciones_fecha, "promedioPrecipitaciones" => $promedioPrecipitaciones,
                "moda" => $moda, "array_cantidades" => $array_cantidades, 'array_anios' => $array_anios);
        } else {
            $msg = "Error.";
            $dato = array("valid" => false, "msg" => $msg);
        }


        echo json_encode($dato);
    }
    
    public function promedioPrecipitacionesMensuales() {
        $precipitaciones = $this->app_model->get_precipitaciones();

        if ($precipitaciones) {

//            $cantitadPrecipitaciones = count($precipitaciones);
            $acu_cantidad_01 = 0;
            $acu_cantidad_02 = 0;
            $acu_cantidad_03 = 0;
            $acu_cantidad_04 = 0;
            $acu_cantidad_05 = 0;
            $acu_cantidad_06 = 0;
            $acu_cantidad_07 = 0;
            $acu_cantidad_08 = 0;
            $acu_cantidad_09 = 0;
            $acu_cantidad_10 = 0;
            $acu_cantidad_11 = 0;
            $acu_cantidad_12 = 0;
            $acu_cantidad_precipitaciones_01 = 0;
            $acu_cantidad_precipitaciones_02 = 0;
            $acu_cantidad_precipitaciones_03 = 0;
            $acu_cantidad_precipitaciones_04 = 0;
            $acu_cantidad_precipitaciones_05 = 0;
            $acu_cantidad_precipitaciones_06 = 0;
            $acu_cantidad_precipitaciones_07 = 0;
            $acu_cantidad_precipitaciones_08 = 0;
            $acu_cantidad_precipitaciones_09 = 0;
            $acu_cantidad_precipitaciones_10 = 0;
            $acu_cantidad_precipitaciones_11 = 0;
            $acu_cantidad_precipitaciones_12 = 0;
            $moda = 0;
            $array_cantidades = [];
            foreach ($precipitaciones as $value) {
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "01") {
                    $acu_cantidad_01 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_01++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "02") {
                    $acu_cantidad_02 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_02++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "03") {
                    $acu_cantidad_03 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_03++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "04") {
                    $acu_cantidad_04 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_04++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "05") {
                    $acu_cantidad_05 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_05++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "06") {
                    $acu_cantidad_06 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_06++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "07") {
                    $acu_cantidad_07 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_07++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "08") {
                    $acu_cantidad_08 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_08++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "09") {
                    $acu_cantidad_09 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_09++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "10") {
                    $acu_cantidad_10 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_10++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "11") {
                    $acu_cantidad_11 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_11++;
                }
                if (date("m", strtotime($value['fechaPrecipitacion'])) == "12") {
                    $acu_cantidad_12 += $value['cantidad'];
                    $acu_cantidad_precipitaciones_12++;
                }
            }
            
            array_push($array_cantidades, $acu_cantidad_01/$acu_cantidad_precipitaciones_01);
            array_push($array_cantidades, $acu_cantidad_02/$acu_cantidad_precipitaciones_02);
            array_push($array_cantidades, $acu_cantidad_03/$acu_cantidad_precipitaciones_03);
            array_push($array_cantidades, $acu_cantidad_04/$acu_cantidad_precipitaciones_04);
            array_push($array_cantidades, $acu_cantidad_05/$acu_cantidad_precipitaciones_05);
            array_push($array_cantidades, $acu_cantidad_06/$acu_cantidad_precipitaciones_06);
            array_push($array_cantidades, $acu_cantidad_07/$acu_cantidad_precipitaciones_07);
            array_push($array_cantidades, $acu_cantidad_08/$acu_cantidad_precipitaciones_08);
            array_push($array_cantidades, $acu_cantidad_09/$acu_cantidad_precipitaciones_09);
            array_push($array_cantidades, $acu_cantidad_10/$acu_cantidad_precipitaciones_10);
            array_push($array_cantidades, $acu_cantidad_11/$acu_cantidad_precipitaciones_11);
            array_push($array_cantidades, $acu_cantidad_12/$acu_cantidad_precipitaciones_12);

//            $promedioPrecipitaciones = $acu_cantidad / $cantitadPrecipitaciones;

//            $cuenta = array_count_values($array_cantidades);
//            arsort($cuenta);
//            $moda = key($cuenta);

            $msg = "Correcto.";
            $dato = array("valid" => true, "msg" => $msg, "moda" => $moda, "array_cantidades" => $array_cantidades);
        } else {
            $msg = "Error.";
            $dato = array("valid" => false, "msg" => $msg);
        }


        echo json_encode($dato);
    }

}
