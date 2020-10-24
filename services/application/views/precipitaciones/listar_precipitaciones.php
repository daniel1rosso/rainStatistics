<!--Begin Page Content--> 
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-4 center"> 
            <h1>Precipitaciones</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado Precipitaciones</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" style="text-align: right;"> 
                    <a type="button" data-toggle="modal" href="#modal-agregar-precipitacion" onclick="vaciado_apertura_modal_new_precipitacion()" class="btn btn-info">
                        <i class="fas fa-plus"></i> &nbsp; Nueva Precipitaci&oacute;n
                    </a>
                </div>
            </div>
            <br/>            
            <table class="table" id="listado_precipitaciones" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Cantidad ML</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>            
        </div>
    </div>
</div>