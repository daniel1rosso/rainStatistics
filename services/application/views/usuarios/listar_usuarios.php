
<!--Begin Page Content--> 
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-4 center"> 
            <h1>USUARIOS</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de usuarios</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" style="text-align: right;">
                    <a type="button" data-toggle="modal" href="#modal-agregar-usuario" class="btn btn-info">
                        <i class="fas fa-plus"></i> &nbsp; Nuevo usuario
                    </a>
                </div>
            </div>
            <br/>            
                <table class="table" id="listado_usuarios" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Apellido, Nombre</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $value) { ?>
                            <tr id="fila<?= $value['idUsuario'] ?>">
                                <td class="text-center"><?= $value['idUsuario'] ?></td>
                                <td class="text-center"><?= $value['apellido'], ', ', $value['nombreCompleto'] ?></td>
                                <td class="text-center"><?= $value['usuario'] ?></td>
                                <td class="text-center"><?= $value['email'] ?></td>                               
                                <td class="text-center">
                                    <a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="<?= $value['idUsuario'] ?>" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar"><i class="fas fa-edit"></i></a>
                                    &nbsp;
                                    <a class="tip" role="button" onclick="eliminar_usuario('<?= $value['idUsuario'] ?>')" data-toggle="modal" style="color: #4e73df;" data-original-title="Eliminar"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>	
                        <?php } ?>
                    </tbody>
                </table>            
        </div>
    </div>
</div>

