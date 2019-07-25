<!DOCTYPE html>
<html lang="en">
  <head>

    <title><?= $title ?></title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url('assets/vendors/font-awesome/font-awesome.min.css')?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url('assets/build/css/animate.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url('assets/vendors/nprogress/nprogress.css')?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/build/css/custom.min.css')?>" rel="stylesheet">


    <link rel="shortcut icon" href="<?=base_url('assets/build/images/logo.png')?>" type="image/gif"/>

    <script>
        var base_url = function(loc = ""){
                var url = "<?php echo site_url('" + loc + "'); ?>";
                // var url = "<?php echo base_url();?>";
                return url;
            }
    </script>
    <!-- NProgress JS -->
    <script src="<?=base_url('assets/vendors/nprogress/nprogress.js')?>"></script>
    <style type="text/css">
        .has-error{
            border-color: #f26f6f !important;
        }



    </style>
  </head>

  <body class="login">