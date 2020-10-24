
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estad&iacute;sticas Precipitaciones</h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Promedio precipitaciones mensual</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="chart-area">
                                <canvas id="promedioPrecipitacionesMensuales" style="width:15%; height:15%;" ></canvas>
                            </div>
                        </div>

                    </div>
                    <br>
                    <br>

                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Promedio precipitaciones para mes y d&iacute;a que se seleccione</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-12">
                            <h6 class="m-0 font-weight-bold text-primary">Seleccionar mes y d&iacute;a:</h6>

                        </div>
                        <br>
                        <div class="col-sm-3">

                            <select id="selectMesPrecipitacion" name="selectMesPrecipitacion" class="form-control">
                                <option value="00">Seleccionar mes..</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select id="selectDiaPrecipitacion" name="selectDiaPrecipitacion" class="form-control">
                                <option value="0">Seleccionar d&iacute;a..</option>

                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" id="btnBuscarPromedio" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="error_no_precipitaciones">                            
                            <div id="noP" class="row" style="text-align: center; margin-top: 75px;">
<!--                                <div class="col">                                    
                                    <h2>
                                        ERROR !
                                    </h2>
                                    <spam>
                                        NO EXISTEN PRECIPITACIONES PARA LA FECHA SELECCIONADA</spam>
                                </div>-->
                            </div> 
                        </div>
                        <div class="col-sm-8" id="agregar_grafico">
                            <div id="delete_grafico">

<!--                                <div class="chart-area">
                                    <canvas id="promedioPrecipitacionesPorDia" style="width:15%; height:15%;" ></canvas>
                                </div>-->
                            </div>
                        </div>

                        <div class="col-sm-4" id="agregar_promedio">
                            <div id="delete_grafico_promedios">
<!--                                <div class="row" style="text-align: center; margin-top: 75px;">
                                    <div class="col">                                    
                                        <h2 id="promedio_historico">

                                        </h2>
                                        <spam id="promedioHistorico"></spam>
                                    </div>

                                </div>
                                <div class="row" style="text-align: center; margin-top: 50px;">
                                    <div class="col">                                    
                                        <h2 id="moda_historica">

                                        </h2>
                                        <spam id="modaHistorica"></spam>
                                    </div>

                                </div>-->


                            </div>
                        </div>                        

                    </div>

                    <br>
                    <br>


                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->