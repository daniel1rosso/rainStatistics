<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $url ?>dashboard">
        <div class="sidebar-brand-icon" style="padding-left: 15px;">   
            
            <i class="fas fa-cloud-sun-rain"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CAMPO ONLINE</div>
         
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($active == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= $url ?>dashboard">
            <i class="fa fa-table"></i>
            <span>Men&uacute; Principal</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Acciones
    </div>

    <li class="nav-item <?php echo ($active == 'precipitaciones') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= $url ?>precipitaciones/listar_precipitaciones">
            <i class="fa fa-seedling"></i>
            <span>Precipitaciones</span></a>
    </li>

    <li class="nav-item">
         <a data-toggle="modal" href="#modal-importar-precipitaciones" class="nav-link">
            <i class="fas fa-upload"></i>
            <span>Importar Precipitaciones</span></a>
    </li>
    
    <li class="nav-item <?php echo ($active == 'usuarios') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= $url ?>usuarios/listar_usuarios">
            <i class="fa fa-users"></i>
            <span>Usuarios</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Reportes
    </div>

    <li class="nav-item <?php echo ($active == 'estaditicas') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= $url ?>estadisticas">
            <i class="fa fa-file-pdf"></i>
            <span>Estad&iacute;sticas</span></a>
    </li>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">