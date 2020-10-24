<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Rosso">

        <link rel="shortcut icon" href="<?= $url ?>icon-paraguas.png"/>

        <!-- Custom fonts for this template-->
        <link href="<?= $url ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?= $url ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="<?= $url ?>assets/css/sb-admin-2.css" rel="stylesheet">

        <!--libreria datatable-->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

        <title><?= $title ?></title>


        <script>
            //--- URL BASE ---//
            //LOCAL
            URL = '//localhost/lluviacampo/';


        </script>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= $url ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?= $url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= $url ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= $url ?>assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= $url ?>assets/vendor/chart.js/Chart.min.js"></script>


        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/sparkline.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uniform.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/select2.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/inputmask.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/autosize.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/inputlimit.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/listbox.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/multiselect.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/validate.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/tags.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/switch.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uploader/plupload.full.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uploader/plupload.queue.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/wysihtml5/toolbar.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/daterangepicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/fancybox.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/jgrowl.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/colorpicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/fullcalendar.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/timepicker.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/flot.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/flot.pie.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/charts/full/pie.js"></script>

        <script type="text/javascript" src="<?= $url ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/application.js"></script>

        <!--DatePicker--> 
        <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/jquery.datetimepicker.css"/>
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/build/jquery.datetimepicker.full.js"></script>   
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script> 


        <!--Upload Multiple Files--> 
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.uploadfile.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.uploadfile.min.js"></script>

        <!--datatable script-->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <!--Funciones--> 
        <script type="text/javascript" src="<?= $url ?>assets/js/coreAdmin.js"></script>

        <!--encriptar md5-->
        <script type="text/javascript" src="<?= $url ?>assets/js/md5.js"></script>


        <!--Include jQuery Validator plugin--> 
        <script src="<?= $url ?>assets/js/validator.js"></script>

        <!--Sweet Alert-->  
        <script type="text/javascript" src="<?= $url ?>assets/js/sweetalert2/sweetalert2.all.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    </head>

    <body id="page-top">

