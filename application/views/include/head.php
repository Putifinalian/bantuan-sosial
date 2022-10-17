<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- <meta http-equiv="refresh" content="1"> -->
    <title>Distribusi Bantuan Sosial</title>
    <!-- <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/5/56/Lambang_IPDN.png"> -->
    <link rel="icon" type="image/png" href="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/default/app.min.css" rel="stylesheet'); ?>" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <!-- v1 -->
    <!-- <link href="<?php echo base_url('assets/plugins/jvectormap-next/jquery-jvectormap.css'); ?>" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" /> -->
    <!-- <link href="<?php echo base_url('assets/plugins/gritter/css/jquery.gritter.css'); ?>" rel="stylesheet" /> -->

    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.1/assets/css/docs.css">

    <script src="<?php echo base_url('assets/js/helper.js'); ?>"></script>

    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <style>
        table thead th.table-dark {
            background-color: #26282a;
            border-bottom: 1px solid rgb(255 255 255 / 50%);
        }
        .table-hover .table-dark:hover {
            background-color: #26282af2;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: unset;
        }
        
    </style>
</head>

<body>
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
