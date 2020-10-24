

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu Principal<br><small style="font-size: small;color: darkgray;">Bienvenid@ <?= $user['nombreCompleto'] ?></small></h1>
    </div>

    <!-- Estados del Dia -->
    <div id="msjDia">
        <?= $saludoDia ?>		  
    </div>

    <div class="row">
        <div class="col-lg-3 mb-8">

            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de contacto</h6>
                </div>
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold">Apellido, Nombre:</h6><h6> Rosso, Daniel Alberto</h6>
                    <h6 class="m-0 font-weight-bold">Teléfono:</h6><h6> +5493537512557</h6>
                    <h6 class="m-0 font-weight-bold">eMail:</h6><h6> danielalbertorosso@gmail.com</h6>                   
                </div>
            </div>

        </div>
        <div class="col-lg-9 mb-8">

            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contactenos</h6>
                </div>
                <div class="card-body">

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->