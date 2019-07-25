<!DOCTYPE html>
<html lang="en">
    <head>

        <title><?=$title?> | Session name</title>

        <!-- Bootstrap -->
        <link href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?=base_url('assets/vendors/font-awesome/font-awesome.min.css')?>" rel="stylesheet">
        <!-- NProgress -->
        <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->

        <!-- Custom Theme Style -->
        <link href="<?=base_url('assets/build/css/custom.min.css')?>" rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url('assets/vendors/datatables/css/dataTables.bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/vendors/datatables/css/responsive.bootstrap.min.css')?>">
        
        <!-- ChartJS -->
        <script rel="stylesheet" src="<?=base_url('assets/vendors/Chart.min.js')?>"></script>

        <link rel="shortcut icon" href="<?=base_url('assets/build/images/logo.png')?>" type="image/gif"/>
        <style>
            td.details-control {
                background: url("<?=base_url('assets/build/images/details_open.png')?>") no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url("<?=base_url('assets/build/images/details_close.png')?>") no-repeat center center;
            }


            .modal-header {
                padding:9px 15px;
                border-bottom:1px solid #eee;
                background-color: #3f5367;
                -webkit-border-top-left-radius: 5px;
                -webkit-border-top-right-radius: 5px;
                -moz-border-radius-topleft: 5px;
                -moz-border-radius-topright: 5px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }

            .group-line{
                border: thin #3f5367 solid;
                padding:20px;
                border-radius:5px;
            }
            
            .peripheral-line{
                border:thin #3f5367 solid;
                padding:20px;
                border-radius:5px;
            }

            .ui-widget{
                z-index: 9999;
            }

            .switch {
            position: relative;
            display: inline-block;
            width: 75px;
            height: 20px;
            }

            .switch input {display:none;}

            .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
            }

            .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 12px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            }

            input:checked + .slider {
            background-color: #2ab934;
            }

            input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(58px);
            }
            
            /*------ ADDED CSS ---------*/
            .on
            {
            display: none;
            }

            .on, .off
            {
            color: white;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 55%;
            font-size: 9px;
            font-family: Verdana, sans-serif;
            }

            input:checked+ .slider .on
            {display: block;}

            input:checked + .slider .off
            {display: none;}

            /*--------- END --------*/

            /* Rounded sliders */
            .slider.round {
            border-radius: 50px;
            }

            .slider.round:before {
            border-radius: 20px;
            }

            .text-wrap{
            white-space:nowrap;
            height:50px;
            overflow:hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
            }
            .width{
            width:200px;
            }

            .action-wrap{
            width:55px;
            }
            .remarks-wrap{
            width:300px;
            }

            .latestStuffsBody{
            font-size: 3em;
            color: #fff;
            height: 100px;
            font-family: monospace;
            }

            .latestStuffsText{
            font-size:15px;
            }

            .panel-height{
                max-height:300px;
            }

            .margin-top-5{
                margin-top:20px;
            }

            .scroll {
                overflow-y: scroll;
                overflow-x: hidden;
                -ms-overflow-style: scrollbar;
            }

            .dashboard {
                font-size: 15px;
                font-family:monospace;
            }

            .slide {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #f0ad4e;
            -webkit-transition: .4s;
            transition: .4s;
            }

            .deployed
            {
            color: white;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 55%;
            font-size: 9px;
            font-family: Verdana, sans-serif;
            }

            .slide.round {
            border-radius: 50px;
            }

        </style>
        <script>
            var base_url = function(loc){
                    var url = "<?php echo site_url('" + loc + "'); ?>";
                    //var url = "<?php echo base_url();?>";
                    return url;
                }
            
        </script>
    </head>
   
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">